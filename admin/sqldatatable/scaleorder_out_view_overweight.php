<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

$search_scale = $_POST['search_scale'];
if(isset($_POST['search_postdate'])){
	$search_postdate = $_POST['search_postdate'];
}else{
	$search_postdate = "";
}

if(isset($search_postdate)){
	$search_postdate_spile = explode(" ",$search_postdate);
	$search_startdate = $search_postdate_spile[0];
	if(isset($search_postdate_spile[2])){
		$search_enddate = $search_postdate_spile[2];
	}
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
        case 0;$orderSql = " ORDER BY title ".$order_dir;break;
		case 1;$orderSql = " ORDER BY Totalweight ".$order_dir;break;
		case 2;$orderSql = " ORDER BY Minweight ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
		case 4;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordScaleorder_in = $length;
$startRow_RecordScaleorder_in = $start;

$colsearch_RecordScaleorder_in = "%";
if (isset($DT_search)) {
  $colsearch_RecordScaleorder_in = $DT_search;
}

//$colnamelang_RecordScaleorder_in = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder_in = $_SESSION['lang'];
}

$colindicate_RecordScaleorder_in = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordScaleorder_in = $search_indicate;
}

$colscale_RecordScaleorder_in = "%";
if (isset($search_scale) && $search_scale != "") {
  $colscale_RecordScaleorder_in = $search_scale;
}

$coluserid_RecordScaleorder_in = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder_in = $w_userid;
}

$colstartdate_RecordScaleorder_in = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder_in = $search_startdate;
}

$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordScaleorder_in = $dt->format('Y-m-d');
$colenddate_RecordScaleorder_in .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordScaleorder_in = $dt->format('Y-m-d');
  $colenddate_RecordScaleorder_in .= " 23:59:59";
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scaleorder_out WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($colnamelang_RecordScaleorder_in, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScaleorder_in = sprintf("SELECT * FROM erp_scaleorder_out WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScaleorder_in, "text"), GetSQLValueString($colindicate_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($collang_RecordScaleorder_in, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scaleorderindetail WHERE lang = %s && userid=%s && bound ='out'",GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScaleorder_in = sprintf("SELECT * FROM erp_scaleorderindetail WHERE (num LIKE binary %s) && (title LIKE binary %s) && num != '' && lang = %s && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordScaleorder_in . "%", "text"), GetSQLValueString("%" . $colscale_RecordScaleorder_in . "%", "text"),GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($colstartdate_RecordScaleorder_in, "date"),GetSQLValueString($colenddate_RecordScaleorder_in, "date"));

if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScaleorder_in = mysqli_query($DB_Conn, $query_RecordScaleorder_in) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in);
	$totalRows_RecordScaleorder_in = mysqli_num_rows($RecordScaleorder_in);
	
}else{
	//分頁
	$query_limit_RecordScaleorder_in = sprintf("%s LIMIT %d, %d", $query_RecordScaleorder_in, $startRow_RecordScaleorder_in, $maxRows_RecordScaleorder_in);
	$RecordScaleorder_in = mysqli_query($DB_Conn, $query_limit_RecordScaleorder_in) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in);
	
	if (isset($_GET['totalRows_RecordScaleorder_in'])) {
	  $totalRows_RecordScaleorder_in = $_GET['totalRows_RecordScaleorder_in'];
	} else {
	  $all_RecordScaleorder_in = mysqli_query($DB_Conn, $query_RecordScaleorder_in);
	  $totalRows_RecordScaleorder_in = mysqli_num_rows($all_RecordScaleorder_in);
	}
	$totalPages_RecordScaleorder_in = ceil($totalRows_RecordScaleorder_in/$maxRows_RecordScaleorder_in)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScaleorder_in > '0') { ?>
<?php do { ?>
  <?php 

  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScaleorder_in["id"];

	$dvalue['scale'] = $row_RecordScaleorder_in["title"];

	$dvalue['num'] = $row_RecordScaleorder_in["num"];
	
	$dvalue['Totalweight'] = $row_RecordScaleorder_in["Totalweight"];
	
	$dvalue['Minweight'] = $row_RecordScaleorder_in["Minweight"];
	
	$dvalue['Oriweight'] = $row_RecordScaleorder_in["Totalweight"] - $row_RecordScaleorder_in["Minweight"];
	
	$dt = new DateTime($row_RecordScaleorder_in['postdate']); 
	$dvalue['postdate'] = $dt->format('Y-m-d H:i A');
	
	//$dvalue['content'] = $row_RecordScaleorder_in["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScaleorder_in), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScaleorder_in);
?>
