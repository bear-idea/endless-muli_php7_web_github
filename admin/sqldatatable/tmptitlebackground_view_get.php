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

/*if(isset($_POST['search_homeselect'])){
	$search_homeselect = $_POST['search_homeselect'];
}else{
	$search_homeselect = "";
}*/
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
        case 1;$orderSql = " ORDER BY title ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		//case 4;$orderSql = " ORDER BY homeselect ".$order_dir;break;
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

$maxRows_RecordTmpBackGround = $length;
$startRow_RecordTmpBackGround = $start;

$colsearch_RecordTmpBackGround = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpBackGround = $DT_search;
}

//$colnamelang_RecordTmpBackGround = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpBackGround = $_SESSION['lang'];
}

$colindicate_RecordTmpBackGround = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpBackGround = $search_indicate;
}

$colname_RecordTmpBackGround = "%";
if (isset($search_name) && $search_name != "") {
  $colname_RecordTmpBackGround = $search_name;
}

$coltype_RecordTmpBackGround = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpBackGround = $search_type;
}

$coluserid_RecordTmpBackGround = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBackGround = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmpbackground WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpBackGround, "int"),GetSQLValueString($colnamelang_RecordTmpBackGround, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpBackGround = sprintf("SELECT * FROM demo_tmpbackground WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpBackGround, "text"), GetSQLValueString($colindicate_RecordTmpBackGround, "text"),GetSQLValueString($coluserid_RecordTmpBackGround, "int"),GetSQLValueString($collang_RecordTmpBackGround, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmpbackground WHERE (userid=%s || userid=1) && localicon=1",GetSQLValueString($coluserid_RecordTmpBackGround, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpBackGround = sprintf("SELECT * FROM demo_tmpbackground WHERE (name LIKE %s || id LIKE %s) && indicate LIKE %s && type LIKE %s && (userid=%s || userid=1) && localicon=1 $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpBackGround . "%", "text"), GetSQLValueString("%" . $colsearch_RecordTmpBackGround . "%", "text"), GetSQLValueString($colindicate_RecordTmpBackGround, "text"), GetSQLValueString($coltype_RecordTmpBackGround, "text"),GetSQLValueString($coluserid_RecordTmpBackGround, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpBackGround = mysqli_query($DB_Conn, $query_RecordTmpBackGround) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBackGround = mysqli_fetch_assoc($RecordTmpBackGround);
	$totalRows_RecordTmpBackGround = mysqli_num_rows($RecordTmpBackGround);
	
}else{
	//分頁
	$query_limit_RecordTmpBackGround = sprintf("%s LIMIT %d, %d", $query_RecordTmpBackGround, $startRow_RecordTmpBackGround, $maxRows_RecordTmpBackGround);
	$RecordTmpBackGround = mysqli_query($DB_Conn, $query_limit_RecordTmpBackGround) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBackGround = mysqli_fetch_assoc($RecordTmpBackGround);
	
	if (isset($_GET['totalRows_RecordTmpBackGround'])) {
	  $totalRows_RecordTmpBackGround = $_GET['totalRows_RecordTmpBackGround'];
	} else {
	  $all_RecordTmpBackGround = mysqli_query($DB_Conn, $query_RecordTmpBackGround);
	  $totalRows_RecordTmpBackGround = mysqli_num_rows($all_RecordTmpBackGround);
	}
	$totalPages_RecordTmpBackGround = ceil($totalRows_RecordTmpBackGround/$maxRows_RecordTmpBackGround)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>


<?php if ($totalRows_RecordTmpBackGround > '0') { ?>
<?php do { ?>
  <?php 
  
    //$link_view = "../tmpbackground_demo_". $row_RecordTmpBackGround['name'].".php?tmpbackgroundid=".$row_RecordTmpBackGround['id'];
  
	
	if ($row_RecordTmpBackGround['bgimage'] != "") {
		if ($SiteBaseUrlOuter != '' && $row_RecordTmpBackGround['userid'] == '1') {
    		$link_pic = $SiteImgUrlOuter.$row_RecordTmpBackGround['webname'].'/image/tmpbackground/'.GetFileThumbExtend($row_RecordTmpBackGround['bgimage']);
		}else{
			$link_pic = $SiteImgUrlAdmin.$row_RecordTmpBackGround['webname'].'/image/tmpbackground/'.GetFileThumbExtend($row_RecordTmpBackGround['bgimage']);
		}
		$link_pic_css = "background-size：contain;background-image:url(" . $link_pic . ");";
	}else{
		$link_pic_css = "background-size：contain;";
	}
	
	/* 判斷背景圖位置 */
	
	$link_pic_css .= "background-position:" . "center center" . ";";
	/* 判斷背景重複 */
	$link_pic_css .= "background-repeat:" . "no-repeat" . ";";
	
	$link_pic_css .= "background-color:" . "#FFF" . ";";
    
  
	$dvalue['id'] = $row_RecordTmpBackGround["id"];
	
  	$dvalue['chk'] = "<input name='delTmpBackGround[]' type='checkbox' id='delTmpBackGround[]' value='".$row_RecordTmpBackGround["id"]."\'/>";
	

	$dvalue['bgimage'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBackGround['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5'><div class='imgLiquidFill' style='width:100%;height:100px;".$link_pic_css."'></div></div>";
	
	$dvalue['name'] = "<div class='hidden-text'>".$row_RecordTmpBackGround["name"]."</div>";

	//$dvalue['name'] = $row_RecordTmpBackGround["name"];
	
	
	$dvalue['type'] = $row_RecordTmpBackGround["type"];
	
	$dvalue['sortid'] = $row_RecordTmpBackGround["sortid"];
	
	 $dvalue['webname'] = $row_RecordTmpBackGround["webname"];
	
	$dvalue['action'] = "<div class='radio radio-css radio-inline'><input type='radio' name='TmpBackGroundBgSelect' value='".$row_RecordTmpBackGround["id"]."' id='TmpBackGroundSelect".$row_RecordTmpBackGround["id"]."' data-parsley-trigger='blur' data-parsley-errors-container='#error_action' require=''><label for='TmpBackGroundSelect".$row_RecordTmpBackGround["id"]."' >選擇目前背景</label></div>";
	//$dvalue['content'] = $row_RecordTmpBackGround["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpBackGround = mysqli_fetch_assoc($RecordTmpBackGround)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpBackGround), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpBackGround);
?>
