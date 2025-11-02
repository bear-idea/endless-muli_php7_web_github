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

if(isset($_POST['search_homeselect'])){
	$search_homeselect = $_POST['search_homeselect'];
}else{
	$search_homeselect = "";
}
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
if(isset($_POST['search_name'])){
	$search_name = $_POST['search_name'];
}else{
	$search_name = "";
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
        //case 1;$orderSql = " ORDER BY title ".$order_dir;break;
        case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		case 4;$orderSql = " ORDER BY homeselect ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY webname ".$order_dir;break;
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

$maxRows_RecordTmpLeftMenu = $length;
$startRow_RecordTmpLeftMenu = $start;

$colsearch_RecordTmpLeftMenu = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpLeftMenu = $DT_search;
}

//$colnamelang_RecordTmpLeftMenu = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpLeftMenu = $_SESSION['lang'];
}

$colindicate_RecordTmpLeftMenu = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpLeftMenu = $search_indicate;
}

$colname_RecordTmpLeftMenu = "%";
if (isset($search_name) && $search_name != "") {
  $colname_RecordTmpLeftMenu = $search_name;
}

$coltype_RecordTmpLeftMenu = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpLeftMenu = $search_type;
}

$coluserid_RecordTmpLeftMenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLeftMenu = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmpleftmenu WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"),GetSQLValueString($colnamelang_RecordTmpLeftMenu, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpLeftMenu, "text"), GetSQLValueString($colindicate_RecordTmpLeftMenu, "text"),GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"),GetSQLValueString($collang_RecordTmpLeftMenu, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmpleftmenu WHERE (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE (name LIKE %s || id LIKE %s) && indicate LIKE %s && type LIKE %s && (userid=%s || userid=1) $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpLeftMenu . "%", "text"), GetSQLValueString("%" . $colsearch_RecordTmpLeftMenu . "%", "text"), GetSQLValueString($colindicate_RecordTmpLeftMenu, "text"), GetSQLValueString($coltype_RecordTmpLeftMenu, "text"),GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
	$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);
	$totalRows_RecordTmpLeftMenu = mysqli_num_rows($RecordTmpLeftMenu);
	
}else{
	//分頁
	$query_limit_RecordTmpLeftMenu = sprintf("%s LIMIT %d, %d", $query_RecordTmpLeftMenu, $startRow_RecordTmpLeftMenu, $maxRows_RecordTmpLeftMenu);
	$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_limit_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
	$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);
	
	if (isset($_GET['totalRows_RecordTmpLeftMenu'])) {
	  $totalRows_RecordTmpLeftMenu = $_GET['totalRows_RecordTmpLeftMenu'];
	} else {
	  $all_RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu);
	  $totalRows_RecordTmpLeftMenu = mysqli_num_rows($all_RecordTmpLeftMenu);
	}
	$totalPages_RecordTmpLeftMenu = ceil($totalRows_RecordTmpLeftMenu/$maxRows_RecordTmpLeftMenu)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordTmpLeftMenu > '0') { ?>
<?php do { ?>
  <?php 
  
    //$link_view = "../tmpleftmenu_demo_". $row_RecordTmpLeftMenu['name'].".php?tmpleftmenuid=".$row_RecordTmpLeftMenu['id'];
  
    if ($SiteBaseUrlOuter != '' && $row_RecordTmpLeftMenu['userid'] == '1') {
		$link_tmp_title_pic = $SiteImgUrlOuter.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_title_pic'];
		$link_tmp_middle_o_pic = $SiteImgUrlOuter.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_middle_o_pic'];
		$link_tmp_middle_pic = $SiteImgUrlOuter.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_middle_pic'];
		$link_tmp_bottom_pic = $SiteImgUrlOuter.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_bottom_pic'];
	}else{
		$link_tmp_title_pic = $SiteImgUrlAdmin.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_title_pic'];
		$link_tmp_middle_o_pic = $SiteImgUrlAdmin.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_middle_o_pic'];
		$link_tmp_middle_pic = $SiteImgUrlAdmin.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_middle_pic'];
		$link_tmp_bottom_pic = $SiteImgUrlAdmin.$row_RecordTmpLeftMenu['webname']."/image/tmpleftmenu/".$row_RecordTmpLeftMenu['tmp_bottom_pic'];
	}
	
	$left_menu = "";
	
	if ($row_RecordTmpLeftMenu['tmp_title_pic'] != '') {
		$left_menu .= "<img src='".$link_tmp_title_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	if ($row_RecordTmpLeftMenu['tmp_middle_o_pic'] != '') {
		$left_menu .= "<img src='".$link_tmp_middle_o_pic."' class='width-full m-0' style='display:block;'/>";
	}else{
		$left_menu .= "<img src='".$link_tmp_middle_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	$left_menu .= "<img src='".$link_tmp_middle_pic."' class='width-full m-0' style='display:block;'/>";
	
	if ($row_RecordTmpLeftMenu['tmp_bottom_pic'] != '') {
		$left_menu .= "<img src='".$link_tmp_bottom_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpLeftMenu["id"];
	
  	$dvalue['chk'] = "<input name='delTmpLeftMenu[]' type='checkbox' id='delTmpLeftMenu[]' value='".$row_RecordTmpLeftMenu["id"]."\'/>";
	
	$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpLeftMenu['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5 overflow-x-hidden overflow-y-hidden'><div class='' style='width:100%;height:100px;'>".$left_menu."</div></div>";


	 $dvalue['name'] = "<div class='hidden-text'>".$row_RecordTmpLeftMenu["name"]."</div>";

	
	//$dvalue['name'] = $row_RecordTmpLeftMenu["name"];
	
	
	if ($row_RecordTmpLeftMenu['userid'] == $w_userid) { 
		$dvalue['type'] = "<span>".$row_RecordTmpLeftMenu["type"]."</span>";
	}else{
		$dvalue['type'] = $row_RecordTmpLeftMenu["type"];
	}
	
	if ($row_RecordTmpLeftMenu['userid'] == $w_userid) { 
		$dvalue['sortid'] = "<span id='sortid_".$row_RecordTmpLeftMenu["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordTmpLeftMenu["id"]."' data-placement='top'>".$row_RecordTmpLeftMenu["sortid"]."</span>";
	}else{
		$dvalue['sortid'] = $row_RecordTmpLeftMenu["sortid"];
	}

            
	if($row_RecordTmpLeftMenu["indicate"] == '1') {$row_RecordTmpLeftMenu["indicate"] = "公佈";}else{$row_RecordTmpLeftMenu["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordTmpLeftMenu["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordTmpLeftMenu["id"]."' data-placement='top'>".$row_RecordTmpLeftMenu["indicate"]."</span>";
	
	$dvalue['webname'] = $row_RecordTmpLeftMenu["webname"];
	
	$dvalue['action'] = "<div class='radio radio-css radio-inline'><input type='radio' name='TmpLeftMenuSelect' value='".$row_RecordTmpLeftMenu["id"]."' id='TmpLeftMenuSelect_".$row_RecordTmpLeftMenu["id"]."' data-parsley-trigger='blur' data-parsley-errors-container='#error_action' required=''><label for='TmpLeftMenuSelect_".$row_RecordTmpLeftMenu["id"]."'>選擇目前選單樣式</label></div>";
	//$dvalue['content'] = $row_RecordTmpLeftMenu["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpLeftMenu), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpLeftMenu);
?>
