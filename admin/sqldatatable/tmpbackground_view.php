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

$maxRows_RecordTmpBackground = $length;
$startRow_RecordTmpBackground = $start;

$colsearch_RecordTmpBackground = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpBackground = $DT_search;
}

//$colnamelang_RecordTmpBackground = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpBackground = $_SESSION['lang'];
}

$colindicate_RecordTmpBackground = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpBackground = $search_indicate;
}

$coltype_RecordTmpBackground = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpBackground = $search_type;
}

$coluserid_RecordTmpBackground = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBackground = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmpbackground WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpBackground, "int"),GetSQLValueString($colnamelang_RecordTmpBackground, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpBackground = sprintf("SELECT * FROM demo_tmpbackground WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpBackground, "text"), GetSQLValueString($colindicate_RecordTmpBackground, "text"),GetSQLValueString($coluserid_RecordTmpBackground, "int"),GetSQLValueString($collang_RecordTmpBackground, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmpbackground WHERE userid=%s",GetSQLValueString($coluserid_RecordTmpBackground, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpBackground = sprintf("SELECT * FROM demo_tmpbackground WHERE name LIKE %s && indicate LIKE %s && type LIKE %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpBackground . "%", "text"), GetSQLValueString($colindicate_RecordTmpBackground, "text"), GetSQLValueString($coltype_RecordTmpBackground, "text"),GetSQLValueString($coluserid_RecordTmpBackground, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpBackground = mysqli_query($DB_Conn, $query_RecordTmpBackground) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBackground = mysqli_fetch_assoc($RecordTmpBackground);
	$totalRows_RecordTmpBackground = mysqli_num_rows($RecordTmpBackground);
	
}else{
	//分頁
	$query_limit_RecordTmpBackground = sprintf("%s LIMIT %d, %d", $query_RecordTmpBackground, $startRow_RecordTmpBackground, $maxRows_RecordTmpBackground);
	$RecordTmpBackground = mysqli_query($DB_Conn, $query_limit_RecordTmpBackground) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBackground = mysqli_fetch_assoc($RecordTmpBackground);
	
	if (isset($_GET['totalRows_RecordTmpBackground'])) {
	  $totalRows_RecordTmpBackground = $_GET['totalRows_RecordTmpBackground'];
	} else {
	  $all_RecordTmpBackground = mysqli_query($DB_Conn, $query_RecordTmpBackground);
	  $totalRows_RecordTmpBackground = mysqli_num_rows($all_RecordTmpBackground);
	}
	$totalPages_RecordTmpBackground = ceil($totalRows_RecordTmpBackground/$maxRows_RecordTmpBackground)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordTmpBackground > '0') { ?>
<?php do { ?>
  <?php 
	
    if ($row_RecordTmpBackground['bgimage'] != "") {
		if ($SiteBaseUrlOuter != '' && $row_RecordTmpBackground['userid'] == '1') {
    		$link_pic = $SiteImgUrlOuter.$row_RecordTmpBackground['webname'].'/image/tmpbackground/'.GetFileThumbExtend($row_RecordTmpBackground['bgimage']);
		}else{
			$link_pic = $SiteImgUrlAdmin.$row_RecordTmpBackground['webname'].'/image/tmpbackground/'.GetFileThumbExtend($row_RecordTmpBackground['bgimage']);
		}
		
		if($row_RecordTmpBackground["type"] != '區塊底圖' && $row_RecordTmpBackground["type"] != '特色單圖')
		{
			$link_pic_css = "background-size：contain;background-image:url(" . $link_pic . ");";
		}
	}else{
		$link_pic_css = "background-size：contain;";
	}
	
	/* 判斷背景圖位置 */
	
	$link_pic_css .= "background-position:" . $row_RecordTmpBackground['bgposition'] . ";";
	/* 判斷背景重複 */
	$link_pic_css .= "background-repeat:" . $row_RecordTmpBackground['bgrepeat'] . ";";
	
	$link_pic_css .= "background-color:" . $row_RecordTmpBackground['bgcolor'] . ";";
	
	if($row_RecordTmpBackground['type'] == "標題圖示") {
		$link_pic_css .= "background-position:" . "center center" . ";";
		/* 判斷背景重複 */
		$link_pic_css .= "background-repeat:" . "no-repeat" . ";";
		
		$link_pic_css .= "background-color:" . "#FFF" . ";";
	}
	
	
  	//$nestedData = array();
	
	if($row_RecordTmpBackground["type"] == '區塊底圖' || $row_RecordTmpBackground["type"] == '特色單圖'){
		$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBackground['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5'><div class='imgLiquidFill' style='width:100%;height:100px;".$link_pic_css."'><img src=".$link_pic." class='img-fluid'></div></div>";
	}else{
		$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBackground['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5'><div class='imgLiquidFill' style='width:100%;height:100px;".$link_pic_css."'></div></div>";
	}
  
    $link_add = "manage_tmp.php?wshop=".$wshop."&amp;Opt=tmpaddbk&amp;lang=".$_SESSION['lang'];
	
	$link_edit = "manage_tmp.php?wshop=".$wshop."&amp;Opt=tmpeditbk&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmpBackground['id'];
	
	$link_start = "manage_tmp.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordTmpBackground["id"].",\"".""."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpBackground["id"];
	
  	$dvalue['chk'] = "<input name='delTmpBackground[]' type='checkbox' id='delTmpBackground[]' value='".$row_RecordTmpBackground["id"]."\'/>";
	
	if ($row_RecordTmpBackground['userid'] == $w_userid) { 
		$dvalue['name'] = "<span id='name_".$row_RecordTmpBackground["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordTmpBackground["id"]."' data-placement='top'>".$row_RecordTmpBackground["name"]."</span>";
	}else{
		$dvalue['name'] = $row_RecordTmpBackground["name"];
	}
	
	if ($row_RecordTmpBackground['userid'] == $w_userid) { 
		$dvalue['type'] = "<span id='type_".$row_RecordTmpBackground["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordTmpBackground["id"]."' data-placement='top'>".$row_RecordTmpBackground["type"]."</span>";
	}else{
		$dvalue['type'] = $row_RecordTmpBackground["type"];
	}
	
	if ($row_RecordTmpBackground['userid'] == $w_userid) { 
		$dvalue['sortid'] = "<span id='sortid_".$row_RecordTmpBackground["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordTmpBackground["id"]."' data-placement='top'>".$row_RecordTmpBackground["sortid"]."</span>";
	}else{
		$dvalue['sortid'] = $row_RecordTmpBackground["sortid"];
	}
	
	if($row_RecordTmpBackground["indicate"] == '1') {$row_RecordTmpBackground["indicate"] = "公佈";}else{$row_RecordTmpBackground["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordTmpBackground["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordTmpBackground["id"]."' data-placement='top'>".$row_RecordTmpBackground["indicate"]."</span>";
	
	$dvalue['webname'] = $row_RecordTmpBackground["webname"];
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordTmpBackground["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpBackground = mysqli_fetch_assoc($RecordTmpBackground)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpBackground), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpBackground);
?>
