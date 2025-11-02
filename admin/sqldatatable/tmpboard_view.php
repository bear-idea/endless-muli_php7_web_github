<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php //require_once('inc_setting.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
<?php //include('mysqli_to_json.class.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

//获取Datatables发送的参数 必要
if(isset($_POST['draw'])){
	$draw = $_POST['draw'];//这个值作者会直接返回给前台
}else{
	$draw = "";
}

//搜索
if(isset($_POST['search']['value'])){
	$DT_search = $_POST['search']['value'];//获取前台传过来的过滤条件
}else{
	$DT_search = "";
}

// 取得自定變數
//$tb_filter_title = $_POST['tb_filter_title'];
//$tb_filter_sortid = $_POST['tb_filter_sortid'];
//$tb_filter_indicate = $_POST['tb_filter_indicate'];

if(isset($_POST['search_indicate'])){
	$search_indicate = $_POST['search_indicate'];
}else{
	$search_indicate = "";
}
if(isset($_POST['search_type'])){
	$search_type = $_POST['search_type'];
}else{
	$search_type = "";
}

//排序
if(isset($_POST['order']['0']['column'])){
	$order_column = $_POST['order']['0']['column'];//那一列排序，从0开始
}else{
	$order_column = "";
}
if(isset($_POST['order']['0']['dir'])){
	$order_dir = $_POST['order']['0']['dir'];//ase desc 升序或者降序
}else{
	$order_dir = "";
}

//拼接排序sql
$orderSql = "";
if(isset($order_column)){
    $i = intval($order_column);
    switch($i){
        //case 0;$orderSql = " ORDER BY id ".$order_dir;break;
        case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        case 3;$orderSql = " ORDER BY type ".$order_dir;break;
        case 4;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 5;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 6;$orderSql = " ORDER BY webname ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY id DESC";
}else{
	$orderSql = $orderSql . ",id DESC";
}

//分页
if(isset($_POST['start'])){
	$start = $_POST['start'];//从多少开始
}else{
	$start = "";
}
if(isset($_POST['length'])){
	$length = $_POST['length'];//数据长度 共幾筆資料
}else{
	$length = "";
}
$limitSql = '';
$limitFlag = isset($_POST['start']) && $length != -1 ;
if ($limitFlag ) {
    $limitSql = " LIMIT ".intval($start).", ".intval($length);
}

//条件过滤后记录数 必要
$recordsFiltered = 0;
//表的总记录数 必要
$recordsTotal = 0;

$maxRows_RecordTmpBoard = $length;
$startRow_RecordTmpBoard = $start;

$colsearch_RecordTmpBoard = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpBoard = $DT_search;
}

//$colnamelang_RecordTmpBoard = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpBoard = $_SESSION['lang'];
}

$colindicate_RecordTmpBoard = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpBoard = $search_indicate;
}

$coltype_RecordTmpBoard = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpBoard = $search_type;
}

$coluserid_RecordTmpBoard = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBoard = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmpboard WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpBoard, "int"),GetSQLValueString($colnamelang_RecordTmpBoard, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpBoard, "text"), GetSQLValueString($colindicate_RecordTmpBoard, "text"),GetSQLValueString($coluserid_RecordTmpBoard, "int"),GetSQLValueString($collang_RecordTmpBoard, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmpboard WHERE userid=%s",GetSQLValueString($coluserid_RecordTmpBoard, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE name LIKE %s && indicate LIKE %s && type LIKE %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpBoard . "%", "text"), GetSQLValueString($colindicate_RecordTmpBoard, "text"), GetSQLValueString($coltype_RecordTmpBoard, "text"),GetSQLValueString($coluserid_RecordTmpBoard, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpBoard = mysqli_query($DB_Conn, $query_RecordTmpBoard) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard);
	$totalRows_RecordTmpBoard = mysqli_num_rows($RecordTmpBoard);
	
}else{
	//分頁
	$query_limit_RecordTmpBoard = sprintf("%s LIMIT %d, %d", $query_RecordTmpBoard, $startRow_RecordTmpBoard, $maxRows_RecordTmpBoard);
	$RecordTmpBoard = mysqli_query($DB_Conn, $query_limit_RecordTmpBoard) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard);
	
	if (isset($_GET['totalRows_RecordTmpBoard'])) {
	  $totalRows_RecordTmpBoard = $_GET['totalRows_RecordTmpBoard'];
	} else {
	  $all_RecordTmpBoard = mysqli_query($DB_Conn, $query_RecordTmpBoard);
	  $totalRows_RecordTmpBoard = mysqli_num_rows($all_RecordTmpBoard);
	}
	$totalPages_RecordTmpBoard = ceil($totalRows_RecordTmpBoard/$maxRows_RecordTmpBoard)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordTmpBoard > '0') { ?>
<?php do { ?>
  <?php 
	
	$block = "";
	
	if ($SiteBaseUrlOuter != '' && $row_RecordTmpBoard['userid'] == '1') {

	$block .= "<div class='mdl' style='background-color:".$row_RecordTmpBoard['tmp_w_background_color'].";border:".$row_RecordTmpBoard['tmp_w_board_width']."px ".$row_RecordTmpBoard['tmp_w_board_style']." ".$row_RecordTmpBoard['tmp_w_board_color'].";background-image: url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_w_background_img'].");-webkit-border-radius: ".$row_RecordTmpBoard['borderradius_t_l']."px ".$row_RecordTmpBoard['borderradius_t_r']."px ".$row_RecordTmpBoard['borderradius_b_r']."px ".$row_RecordTmpBoard['borderradius_b_l']."px;-moz-border-radius: ".$row_RecordTmpBoard['borderradius_t_l']."px ".$row_RecordTmpBoard['borderradius_t_r']."px ".$row_RecordTmpBoard['borderradius_b_r']."px ".$row_RecordTmpBoard['borderradius_b_l']."px;border-radius: ".$row_RecordTmpBoard['borderradius_t_l']."px ".$row_RecordTmpBoard['borderradius_t_r']."px ".$row_RecordTmpBoard['borderradius_b_r']."px ".$row_RecordTmpBoard['borderradius_b_l']."px;-webkit-box-shadow: ".$row_RecordTmpBoard['boxshadow_x']."px ".$row_RecordTmpBoard['boxshadow_y']."px ".$row_RecordTmpBoard['boxshadow_size']."px ".$row_RecordTmpBoard['boxshadow_color'].";-moz-box-shadow: ".$row_RecordTmpBoard['boxshadow_x']."px ".$row_RecordTmpBoard['boxshadow_y']."px ".$row_RecordTmpBoard['boxshadow_size']."px ".$row_RecordTmpBoard['boxshadow_color'].";box-shadow: ".$row_RecordTmpBoard['boxshadow_x']."px ".$row_RecordTmpBoard['boxshadow_y']."px ".$row_RecordTmpBoard['boxshadow_size']."px ".$row_RecordTmpBoard['boxshadow_color'].";background: -webkit-gradient(linear, 0 0, 0 bottom, from(".$row_RecordTmpBoard['lineargradient_top']."), to(".$row_RecordTmpBoard['lineargradient_bottom']."));background: -webkit-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: -moz-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: -ms-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: -o-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");-pie-background: linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");'><div class='mdl_t'><div class='mdl_t_l' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_l_t_background_img'].") ".$row_RecordTmpBoard['tmp_l_t_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_l_t_width']."px;height:".$row_RecordTmpBoard['tmp_l_t_height']."px;'></div><div class='mdl_t_r' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_r_t_background_img'].") ".$row_RecordTmpBoard['tmp_r_t_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_r_t_width']."px;height:".$row_RecordTmpBoard['tmp_r_t_height']."px;'></div><div class='mdl_t_c' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_m_t_background_img'].") ".$row_RecordTmpBoard['tmp_m_t_repeat']." scroll left top;height:".$row_RecordTmpBoard['tmp_r_t_height']."px;margin:0px ".$row_RecordTmpBoard['tmp_r_t_width']."px 0px ".$row_RecordTmpBoard['tmp_l_t_width']."px;'></div><div class='mdl_t_m'></div></div><div class='mdl_c g_p_hide'><div class='mdl_c_l g_p_fill' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_l_m_background_img'].") ".$row_RecordTmpBoard['tmp_l_m_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_l_m_width']."px;'></div><div class='mdl_c_r g_p_fill' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_r_m_background_img'].") ".$row_RecordTmpBoard['tmp_r_m_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_r_m_width']."px;'></div><div class='mdl_c_c' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_m_m_background_img'].") ".$row_RecordTmpBoard['tmp_m_m_repeat']." scroll left top;margin:0px ".$row_RecordTmpBoard['tmp_r_m_width']."px 0px ".$row_RecordTmpBoard['tmp_l_m_width']."px;'><div class='mdl_m_c' style='width:50px; height:50px;'></div></div></div><div class='mdl_b'><div class='mdl_b_l' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_l_b_background_img'].") ".$row_RecordTmpBoard['tmp_l_b_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_l_b_width']."px;height:".$row_RecordTmpBoard['tmp_l_b_height']."px;'></div><div class='mdl_b_r' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_r_b_background_img'].") ".$row_RecordTmpBoard['tmp_r_b_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_r_b_width']."px;height:".$row_RecordTmpBoard['tmp_r_b_height']."px;'></div><div class='mdl_b_c' style='background:url(".$SiteImgUrlOuter."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_m_b_background_img'].") ".$row_RecordTmpBoard['tmp_m_b_repeat']." scroll left top;height:".$row_RecordTmpBoard['tmp_m_b_height']."px;margin:0px ".$row_RecordTmpBoard['tmp_r_b_width']."px 0px ".$row_RecordTmpBoard['tmp_l_b_width']."px;'></div></div></div>";
	
	}else{
	
	$block .= "<div class='mdl' style='background-color:".$row_RecordTmpBoard['tmp_w_background_color'].";border:".$row_RecordTmpBoard['tmp_w_board_width']."px ".$row_RecordTmpBoard['tmp_w_board_style']." ".$row_RecordTmpBoard['tmp_w_board_color'].";background-image: url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_w_background_img'].");-webkit-border-radius: ".$row_RecordTmpBoard['borderradius_t_l']."px ".$row_RecordTmpBoard['borderradius_t_r']."px ".$row_RecordTmpBoard['borderradius_b_r']."px ".$row_RecordTmpBoard['borderradius_b_l']."px;-moz-border-radius: ".$row_RecordTmpBoard['borderradius_t_l']."px ".$row_RecordTmpBoard['borderradius_t_r']."px ".$row_RecordTmpBoard['borderradius_b_r']."px ".$row_RecordTmpBoard['borderradius_b_l']."px;border-radius: ".$row_RecordTmpBoard['borderradius_t_l']."px ".$row_RecordTmpBoard['borderradius_t_r']."px ".$row_RecordTmpBoard['borderradius_b_r']."px ".$row_RecordTmpBoard['borderradius_b_l']."px;-webkit-box-shadow: ".$row_RecordTmpBoard['boxshadow_x']."px ".$row_RecordTmpBoard['boxshadow_y']."px ".$row_RecordTmpBoard['boxshadow_size']."px ".$row_RecordTmpBoard['boxshadow_color'].";-moz-box-shadow: ".$row_RecordTmpBoard['boxshadow_x']."px ".$row_RecordTmpBoard['boxshadow_y']."px ".$row_RecordTmpBoard['boxshadow_size']."px ".$row_RecordTmpBoard['boxshadow_color'].";box-shadow: ".$row_RecordTmpBoard['boxshadow_x']."px ".$row_RecordTmpBoard['boxshadow_y']."px ".$row_RecordTmpBoard['boxshadow_size']."px ".$row_RecordTmpBoard['boxshadow_color'].";background: -webkit-gradient(linear, 0 0, 0 bottom, from(".$row_RecordTmpBoard['lineargradient_top']."), to(".$row_RecordTmpBoard['lineargradient_bottom']."));background: -webkit-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: -moz-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: -ms-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: -o-linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");background: linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");-pie-background: linear-gradient(".$row_RecordTmpBoard['lineargradient_top'].", ".$row_RecordTmpBoard['lineargradient_bottom'].");'><div class='mdl_t'><div class='mdl_t_l' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_l_t_background_img'].") ".$row_RecordTmpBoard['tmp_l_t_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_l_t_width']."px;height:".$row_RecordTmpBoard['tmp_l_t_height']."px;'></div><div class='mdl_t_r' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_r_t_background_img'].") ".$row_RecordTmpBoard['tmp_r_t_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_r_t_width']."px;height:".$row_RecordTmpBoard['tmp_r_t_height']."px;'></div><div class='mdl_t_c' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_m_t_background_img'].") ".$row_RecordTmpBoard['tmp_m_t_repeat']." scroll left top;height:".$row_RecordTmpBoard['tmp_r_t_height']."px;margin:0px ".$row_RecordTmpBoard['tmp_r_t_width']."px 0px ".$row_RecordTmpBoard['tmp_l_t_width']."px;'></div><div class='mdl_t_m'></div></div><div class='mdl_c g_p_hide'><div class='mdl_c_l g_p_fill' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_l_m_background_img'].") ".$row_RecordTmpBoard['tmp_l_m_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_l_m_width']."px;'></div><div class='mdl_c_r g_p_fill' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_r_m_background_img'].") ".$row_RecordTmpBoard['tmp_r_m_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_r_m_width']."px;'></div><div class='mdl_c_c' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_m_m_background_img'].") ".$row_RecordTmpBoard['tmp_m_m_repeat']." scroll left top;margin:0px ".$row_RecordTmpBoard['tmp_r_m_width']."px 0px ".$row_RecordTmpBoard['tmp_l_m_width']."px;'><div class='mdl_m_c' style='width:50px; height:50px;'></div></div></div><div class='mdl_b'><div class='mdl_b_l' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_l_b_background_img'].") ".$row_RecordTmpBoard['tmp_l_b_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_l_b_width']."px;height:".$row_RecordTmpBoard['tmp_l_b_height']."px;'></div><div class='mdl_b_r' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_r_b_background_img'].") ".$row_RecordTmpBoard['tmp_r_b_repeat']." scroll left top;width:".$row_RecordTmpBoard['tmp_r_b_width']."px;height:".$row_RecordTmpBoard['tmp_r_b_height']."px;'></div><div class='mdl_b_c' style='background:url(".$SiteImgUrlAdmin."".$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_m_b_background_img'].") ".$row_RecordTmpBoard['tmp_m_b_repeat']." scroll left top;height:".$row_RecordTmpBoard['tmp_m_b_height']."px;margin:0px ".$row_RecordTmpBoard['tmp_r_b_width']."px 0px ".$row_RecordTmpBoard['tmp_l_b_width']."px;'></div></div></div>";
	
	}
    
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpBoard["id"];
	
	$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBoard['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5 overflow-x-hidden overflow-y-hidden'><div class='' style='width:200px;height:100px;'>".$block."</div></div>";
  
    $link_add = "manage_tmp.php?wshop=".$wshop."&amp;Opt=tmpaddboard&amp;lang=".$_SESSION['lang'];
	
	$link_edit = "manage_tmp.php?wshop=".$wshop."&amp;Opt=tmpeditboard&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmpBoard['id'];
	
	$link_start = "manage_tmp.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordTmpBoard["id"].",\"".""."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpBoard["id"];
	
  	$dvalue['chk'] = "<input name='delTmpBoard[]' type='checkbox' id='delTmpBoard[]' value='".$row_RecordTmpBoard["id"]."\'/>";
	
	if ($row_RecordTmpBoard['userid'] == $w_userid) { 
		$dvalue['name'] = "<span id='name_".$row_RecordTmpBoard["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordTmpBoard["id"]."' data-placement='top'>".$row_RecordTmpBoard["name"]."</span>";
	}else{
		$dvalue['name'] = $row_RecordTmpBoard["name"];
	}
	
	if ($row_RecordTmpBoard['userid'] == $w_userid) { 
		$dvalue['type'] = "<span id='type_".$row_RecordTmpBoard["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordTmpBoard["id"]."' data-placement='top'>".$row_RecordTmpBoard["type"]."</span>";
	}else{
		$dvalue['type'] = $row_RecordTmpBoard["type"];
	}
	
	if ($row_RecordTmpBoard['userid'] == $w_userid) { 
		$dvalue['sortid'] = "<span id='sortid_".$row_RecordTmpBoard["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordTmpBoard["id"]."' data-placement='top'>".$row_RecordTmpBoard["sortid"]."</span>";
	}else{
		$dvalue['sortid'] = $row_RecordTmpBoard["sortid"];
	}
	
	if($row_RecordTmpBoard["indicate"] == '1') {$row_RecordTmpBoard["indicate"] = "公佈";}else{$row_RecordTmpBoard["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordTmpBoard["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordTmpBoard["id"]."' data-placement='top'>".$row_RecordTmpBoard["indicate"]."</span>";
	
	$dvalue['webname'] = $row_RecordTmpBoard["webname"];
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordTmpBoard["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpBoard), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpBoard);
?>
