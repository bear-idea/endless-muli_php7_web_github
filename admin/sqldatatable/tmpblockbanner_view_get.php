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
        //case 1;$orderSql = " ORDER BY title ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        //case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		//case 4;$orderSql = " ORDER BY homeselect ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY webname ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY act_id DESC";
}else{
	$orderSql = $orderSql . ",act_id DESC";
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

$maxRows_RecordTmpBlockBanner = $length;
$startRow_RecordTmpBlockBanner = $start;

$colsearch_RecordTmpBlockBanner = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpBlockBanner = $DT_search;
}

//$colnamelang_RecordTmpBlockBanner = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpBlockBanner = $_SESSION['lang'];
}

$colindicate_RecordTmpBlockBanner = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpBlockBanner = $search_indicate;
}

$colname_RecordTmpBlockBanner = "%";
if (isset($search_name) && $search_name != "") {
  $colname_RecordTmpBlockBanner = $search_name;
}

$coltype_RecordTmpBlockBanner = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpBlockBanner = $search_type;
}

$coluserid_RecordTmpBlockBanner = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBlockBanner = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmpbackground WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpBlockBanner, "int"),GetSQLValueString($colnamelang_RecordTmpBlockBanner, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpBlockBanner = sprintf("SELECT * FROM demo_tmpbackground WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpBlockBanner, "text"), GetSQLValueString($colindicate_RecordTmpBlockBanner, "text"),GetSQLValueString($coluserid_RecordTmpBlockBanner, "int"),GetSQLValueString($collang_RecordTmpBlockBanner, "text"));

$query_RecordCount = sprintf("SELECT count(act_id) as sum FROM demo_adtype WHERE lang = %s && userid=%s && type='contentbannerimage'",GetSQLValueString($collang_RecordTmpBlockBanner, "text"),GetSQLValueString($coluserid_RecordTmpBlockBanner, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpBlockBanner = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype.bwight, demo_adtype.bhight, demo_adtype.swight, demo_adtype.shight, demo_adtype.velocity, demo_adtype.numbers, demo_adtype.navigation, demo_adtype.thumbs, demo_adtype.label, demo_adtype.interval, demo_adtype.hideTools, demo_adtype.dots, demo_adtype.sdescription, demo_adtype.indicate, demo_adtype.author, demo_adtype.postdate, demo_adtype_sub.pic, demo_adtype.sortid, demo_adtype_sub.actphoto_id, demo_adtype.lang, count(demo_adtype_sub.act_id) AS photonum FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id GROUP BY demo_adtype.act_id HAVING (demo_adtype.lang = %s) && demo_adtype.userid=%s && demo_adtype.type='contentbannerimage' ORDER BY demo_adtype.act_id DESC", GetSQLValueString($collang_RecordTmpBlockBanner, "text"),GetSQLValueString($coluserid_RecordTmpBlockBanner, "int"));


if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpBlockBanner = mysqli_query($DB_Conn, $query_RecordTmpBlockBanner) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBlockBanner = mysqli_fetch_assoc($RecordTmpBlockBanner);
	$totalRows_RecordTmpBlockBanner = mysqli_num_rows($RecordTmpBlockBanner);
	
}else{
	//分頁
	$query_limit_RecordTmpBlockBanner = sprintf("%s LIMIT %d, %d", $query_RecordTmpBlockBanner, $startRow_RecordTmpBlockBanner, $maxRows_RecordTmpBlockBanner);
	$RecordTmpBlockBanner = mysqli_query($DB_Conn, $query_limit_RecordTmpBlockBanner) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBlockBanner = mysqli_fetch_assoc($RecordTmpBlockBanner);
	
	if (isset($_GET['totalRows_RecordTmpBlockBanner'])) {
	  $totalRows_RecordTmpBlockBanner = $_GET['totalRows_RecordTmpBlockBanner'];
	} else {
	  $all_RecordTmpBlockBanner = mysqli_query($DB_Conn, $query_RecordTmpBlockBanner);
	  $totalRows_RecordTmpBlockBanner = mysqli_num_rows($all_RecordTmpBlockBanner);
	}
	$totalPages_RecordTmpBlockBanner = ceil($totalRows_RecordTmpBlockBanner/$maxRows_RecordTmpBlockBanner)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>


<?php if ($totalRows_RecordTmpBlockBanner > '0') { ?>
<?php do { ?>
  <?php 
  
    //$link_view = "../tmpbackground_demo_". $row_RecordTmpBlockBanner['name'].".php?tmpbackgroundid=".$row_RecordTmpBlockBanner['id'];
  
	/* 判斷背景圖位置 */
	
	if($row_RecordTmpBlockBanner['pic'] !=""){
		if ($SiteBaseUrlOuter != '' && $row_RecordTmpBlockBanner['userid'] == '1') {
    		$link_pic = $SiteImgUrlOuter.$wshop."/image/banner/".$row_RecordTmpBlockBanner['pic'];
		}else{
			$link_pic = $SiteImgUrlAdmin.$wshop."/image/banner/".$row_RecordTmpBlockBanner['pic'];
		}
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
  
	$dvalue['id'] = $row_RecordTmpBlockBanner["act_id"];
	
  	//$dvalue['chk'] = "<input name='delTmpBackGround[]' type='checkbox' id='delTmpBackGround[]' value='".$row_RecordTmpBlockBanner["id"]."\'/>";
	

	$dvalue['pic'] = "<span class='label label-purple' data-original-title='編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBlockBanner['act_id']."</span>"."<div class='img-thumbnail m-t-5'><div class='imgLiquidFill' style='width:100%; height:100px;'><img src=".$link_pic." class='img-fluid' ></div></div>";
	
	$dvalue['title'] = "";
	
	//$dvalue['name'] = "<div class='hidden-text'>".$row_RecordTmpBlockBanner["name"]."</div>";

	//$dvalue['name'] = $row_RecordTmpBlockBanner["name"];
	
	$dvalue['photonum'] = $row_RecordTmpBlockBanner["photonum"] . "張圖片";
	
	
	$dvalue['action'] = "<div class='radio radio-css radio-inline'><input type='radio' name='TmpBgSelect' value='".$row_RecordTmpBlockBanner["act_id"]."' id='TmpBgSelect".$row_RecordTmpBlockBanner["act_id"]."' data-parsley-trigger='blur' data-parsley-errors-container='#error_action' ><label for='TmpBgSelect".$row_RecordTmpBlockBanner["act_id"]."' >選擇目前背景</label></div>";
	//$dvalue['content'] = $row_RecordTmpBlockBanner["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpBlockBanner = mysqli_fetch_assoc($RecordTmpBlockBanner)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpBlockBanner), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpBlockBanner);
?>
