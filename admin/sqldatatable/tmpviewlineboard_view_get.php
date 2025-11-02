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

$colname_RecordTmpBoard = "%";
if (isset($search_name) && $search_name != "") {
  $colname_RecordTmpBoard = $search_name;
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

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmpboard WHERE (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordTmpBoard, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE (name LIKE %s || id LIKE %s) && indicate LIKE %s && type LIKE %s && (userid=%s || userid=1) $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpBoard . "%", "text"), GetSQLValueString("%" . $colsearch_RecordTmpBoard . "%", "text"), GetSQLValueString($colindicate_RecordTmpBoard, "text"), GetSQLValueString($coltype_RecordTmpBoard, "text"),GetSQLValueString($coluserid_RecordTmpBoard, "int"));



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
  
    //$link_view = "../tmpboard_demo_". $row_RecordTmpBoard['name'].".php?tmpboardid=".$row_RecordTmpBoard['id'];
	if ($SiteBaseUrlOuter != '' && $row_RecordTmpBoard['userid'] == '1') {
		$link_tmp_title_pic = $SiteImgUrlOuter.$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_title_pic'];
		$link_tmp_middle_pic = $SiteImgUrlOuter.$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_middle_pic'];
		$link_tmp_bottom_pic = $SiteImgUrlOuter.$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_bottom_pic'];
	}else{
		$link_tmp_title_pic = $SiteImgUrlAdmin.$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_title_pic'];
		$link_tmp_middle_pic = $SiteImgUrlAdmin.$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_middle_pic'];
		$link_tmp_bottom_pic = $SiteImgUrlAdmin.$row_RecordTmpBoard['webname']."/image/tmpboard/".$row_RecordTmpBoard['tmp_bottom_pic'];
	}
	
	$block = "";
	
	$block .= "<div style='border:".$row_RecordTmpBoard['tmp_block_width']."px ".$row_RecordTmpBoard['tmp_block_style']. " ". $row_RecordTmpBoard['tmp_block_color'] . "; background-color:".$row_RecordTmpBoard['tmp_block_background_color'] . "'>";
	
	if ($row_RecordTmpBoard['tmp_title_pic'] != '') {
		$block .= "<img src='".$link_tmp_title_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	if ($row_RecordTmpBoard['tmp_middle_pic'] != '') {
	$block .= "<img src='".$link_tmp_middle_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	if ($row_RecordTmpBoard['tmp_middle_pic'] != '') {
	$block .= "<img src='".$link_tmp_middle_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	if ($row_RecordTmpBoard['tmp_bottom_pic'] != '') {
		$block .= "<img src='".$link_tmp_bottom_pic."' class='width-full m-0' style='display:block;'/>";
	}
	
	$block .= "</div>";
	
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpBoard["id"];
	
  	$dvalue['chk'] = "<input name='delTmpBoard[]' type='checkbox' id='delTmpBoard[]' value='".$row_RecordTmpBoard["id"]."\'/>";
	
	$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBoard['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5 overflow-x-hidden overflow-y-hidden'><div class='' style='width:100%;height:100px;'>".$block."</div></div>";


	 $dvalue['name'] = "<div class='hidden-text'>".$row_RecordTmpBoard["name"]."</div>";

	
	//$dvalue['name'] = $row_RecordTmpBoard["name"];
	
	
	if ($row_RecordTmpBoard['userid'] == $w_userid) { 
		$dvalue['type'] = "<span>".$row_RecordTmpBoard["type"]."</span>";
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
	
	$dvalue['action'] = "<div class='radio radio-css radio-inline'><input type='radio' name='TmpBoardSelect' value='".$row_RecordTmpBoard["id"]."' id='TmpBoardSelect_".$row_RecordTmpBoard["id"]."' data-parsley-trigger='blur' data-parsley-errors-container='#error_action' ><label for='TmpBoardSelect_".$row_RecordTmpBoard["id"]."'>選擇目前選單樣式</label></div>";
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
