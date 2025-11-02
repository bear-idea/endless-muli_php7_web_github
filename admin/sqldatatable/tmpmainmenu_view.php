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

$maxRows_RecordTmpMainmenu = $length;
$startRow_RecordTmpMainmenu = $start;

$colsearch_RecordTmpMainmenu = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpMainmenu = $DT_search;
}

//$colnamelang_RecordTmpMainmenu = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpMainmenu = $_SESSION['lang'];
}

$colindicate_RecordTmpMainmenu = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpMainmenu = $search_indicate;
}

$coltype_RecordTmpMainmenu = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpMainmenu = $search_type;
}

$coluserid_RecordTmpMainmenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpMainmenu = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmpmainmenu WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpMainmenu, "int"),GetSQLValueString($colnamelang_RecordTmpMainmenu, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpMainmenu = sprintf("SELECT * FROM demo_tmpmainmenu WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpMainmenu, "text"), GetSQLValueString($colindicate_RecordTmpMainmenu, "text"),GetSQLValueString($coluserid_RecordTmpMainmenu, "int"),GetSQLValueString($collang_RecordTmpMainmenu, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmpmainmenu WHERE userid=%s",GetSQLValueString($coluserid_RecordTmpMainmenu, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpMainmenu = sprintf("SELECT * FROM demo_tmpmainmenu WHERE name LIKE %s && indicate LIKE %s && type LIKE %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpMainmenu . "%", "text"), GetSQLValueString($colindicate_RecordTmpMainmenu, "text"), GetSQLValueString($coltype_RecordTmpMainmenu, "text"),GetSQLValueString($coluserid_RecordTmpMainmenu, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpMainmenu = mysqli_query($DB_Conn, $query_RecordTmpMainmenu) or die(mysqli_error($DB_Conn));
	$row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainmenu);
	$totalRows_RecordTmpMainmenu = mysqli_num_rows($RecordTmpMainmenu);
	
}else{
	//分頁
	$query_limit_RecordTmpMainmenu = sprintf("%s LIMIT %d, %d", $query_RecordTmpMainmenu, $startRow_RecordTmpMainmenu, $maxRows_RecordTmpMainmenu);
	$RecordTmpMainmenu = mysqli_query($DB_Conn, $query_limit_RecordTmpMainmenu) or die(mysqli_error($DB_Conn));
	$row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainmenu);
	
	if (isset($_GET['totalRows_RecordTmpMainmenu'])) {
	  $totalRows_RecordTmpMainmenu = $_GET['totalRows_RecordTmpMainmenu'];
	} else {
	  $all_RecordTmpMainmenu = mysqli_query($DB_Conn, $query_RecordTmpMainmenu);
	  $totalRows_RecordTmpMainmenu = mysqli_num_rows($all_RecordTmpMainmenu);
	}
	$totalPages_RecordTmpMainmenu = ceil($totalRows_RecordTmpMainmenu/$maxRows_RecordTmpMainmenu)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordTmpMainmenu > '0') { ?>
<?php do { ?>
  <?php 
                                            
	if ($SiteBaseUrlOuter != '' && $row_RecordTmpMainMenu['userid'] == '1') {
		$link_topmainmenu_l = $SiteImgUrlOuter.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_l_img'];
		$link_topmainmenu_r = $SiteImgUrlOuter.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_r_img'];
		$link_topmainmenu_h = $SiteImgUrlOuter.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_hover_img'];
		$link_topmainmenu_o = $SiteImgUrlOuter.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_o_img'];
		$link_topmainmenu_s = $SiteImgUrlOuter.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_img'];
	}else{
		$link_topmainmenu_l = $SiteImgUrlAdmin.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_l_img'];
		$link_topmainmenu_r = $SiteImgUrlAdmin.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_r_img'];
		$link_topmainmenu_h = $SiteImgUrlAdmin.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_hover_img'];
		$link_topmainmenu_o = $SiteImgUrlAdmin.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_o_img'];
		$link_topmainmenu_s = $SiteImgUrlAdmin.$row_RecordTmpMainMenu['webname']."/image/tmpmainmenu/".$row_RecordTmpMainMenu['tmp_mainmenu_img'];
	}
	
	$css_menu = "<ul id='navcss3' style='background-image:url(".$link_topmainmenu_o."); width:600px; background-position:bottom'>";
	
	if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] != '') { 
		$css_menu .= "<li class='topmainmenu_l' style='line-height:".$row_RecordTmpMainMenu['tmp_mainmenupic_height']."px;'><img src='".$link_topmainmenu_l."' /></li>";
	} 
	if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") {
		$css_menu .= "<li class='' style='line-height:".$row_RecordTmpMainMenu['tmp_mainmenupic_height']."px;'><a href='#'><img src='".$link_topmainmenu_h."' width='".$row_RecordTmpMainMenu['tmp_mainmenu_width']."px;'/></a></li>";
	} else {
		$css_menu .= "<li class='' style='line-height:".$row_RecordTmpMainMenu['tmp_mainmenupic_height']."px;'><a href='#'><img src='images/block.png' width='".$row_RecordTmpMainMenu['tmp_mainmenu_width']."px;'/></a></li>";
	}
	
	if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") {
		$css_menu .= "<li class='' style='line-height:".$row_RecordTmpMainMenu['tmp_mainmenupic_height']."px;'><a href='#'><img src='".$link_topmainmenu_s."' width='".$row_RecordTmpMainMenu['tmp_mainmenu_width']."px;'/></a></li>";
	} else {
		$css_menu .= "<li class='' style='line-height:".$row_RecordTmpMainMenu['tmp_mainmenupic_height']."px;'><a href='#'><img src='images/block.png' width='".$row_RecordTmpMainMenu['tmp_mainmenu_width']."px;'/></a></li>";
	}
	
	if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] != '') { 
		$css_menu .= "<li class='topmainmenu_r' style='line-height:".$row_RecordTmpMainMenu['tmp_mainmenupic_height']."px;'><img src='".$link_topmainmenu_r."' /></li>";
	} 
	
	$css_menu .= "</ul>";
    
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpMainMenu["id"];
	
	$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpMainMenu['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5 overflow-x-hidden overflow-y-hidden'><div class='' style='width:500px;height:100px;'>".$css_menu."</div></div>";
  
    $link_add = "manage_tmp.php?wshop=".$wshop."&amp;Opt=tmpaddmainmenu&amp;lang=".$_SESSION['lang'];
	
	$link_edit = "manage_tmp.php?wshop=".$wshop."&amp;Opt=tmpeditmainmenu&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmpMainMenu['id'];
	
	$link_start = "manage_tmp.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordTmpMainMenu["id"].",\"".""."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpMainMenu["id"];
	
  	$dvalue['chk'] = "<input name='delTmpMainmenu[]' type='checkbox' id='delTmpMainmenu[]' value='".$row_RecordTmpMainMenu["id"]."\'/>";
	
	if ($row_RecordTmpMainMenu['userid'] == $w_userid) { 
		$dvalue['name'] = "<span id='name_".$row_RecordTmpMainMenu["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordTmpMainMenu["id"]."' data-placement='top'>".$row_RecordTmpMainMenu["name"]."</span>";
	}else{
		$dvalue['name'] = $row_RecordTmpMainMenu["name"];
	}
	
	if ($row_RecordTmpMainMenu['userid'] == $w_userid) { 
		$dvalue['type'] = "<span id='type_".$row_RecordTmpMainMenu["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordTmpMainMenu["id"]."' data-placement='top'>".$row_RecordTmpMainMenu["type"]."</span>";
	}else{
		$dvalue['type'] = $row_RecordTmpMainMenu["type"];
	}
	
	if ($row_RecordTmpMainMenu['userid'] == $w_userid) { 
		$dvalue['sortid'] = "<span id='sortid_".$row_RecordTmpMainMenu["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordTmpMainMenu["id"]."' data-placement='top'>".$row_RecordTmpMainMenu["sortid"]."</span>";
	}else{
		$dvalue['sortid'] = $row_RecordTmpMainMenu["sortid"];
	}
	
	if($row_RecordTmpMainMenu["indicate"] == '1') {$row_RecordTmpMainMenu["indicate"] = "公佈";}else{$row_RecordTmpMainMenu["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordTmpMainMenu["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordTmpMainMenu["id"]."' data-placement='top'>".$row_RecordTmpMainMenu["indicate"]."</span>";
	
	$dvalue['webname'] = $row_RecordTmpMainMenu["webname"];
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordTmpMainMenu["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainmenu)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpMainmenu), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpMainmenu);
?>
