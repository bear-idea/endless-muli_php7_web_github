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
        //case 1;$orderSql = " ORDER BY InsuranceLevel ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY type ".$order_dir;break;
        //case 3;$orderSql = " ORDER BY InsuranceMoney ".$order_dir;break;
		//case 4;$orderSql = " ORDER BY InsuranceDay ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY HealthSharing ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY EmployerSharing ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY InsuranceLevel ASC";
}else{
	$orderSql = $orderSql . ",InsuranceLevel ASC";
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

$maxRows_RecordHealth = $length;
$startRow_RecordHealth = $start;

$colsearch_RecordHealth = "%";
if (isset($DT_search)) {
  $colsearch_RecordHealth = $DT_search;
}

//$colnamelang_RecordHealth = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordHealth = $_SESSION['lang'];
}

$colindicate_RecordHealth = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordHealth = $search_indicate;
}

$coltype_RecordHealth = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordHealth = $search_type;
}

$coluserid_RecordHealth = "-1";
if (isset($w_userid)) {
  $coluserid_RecordHealth = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM salary_health WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordHealth, "int"),GetSQLValueString($colnamelang_RecordHealth, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordHealth = sprintf("SELECT * FROM salary_health WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordHealth, "text"), GetSQLValueString($colindicate_RecordHealth, "text"),GetSQLValueString($coluserid_RecordHealth, "int"),GetSQLValueString($collang_RecordHealth, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM salary_health WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordHealth, "text"),GetSQLValueString($coluserid_RecordHealth, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordHealth = sprintf("SELECT * FROM salary_health WHERE indicate LIKE %s && type LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString($colindicate_RecordHealth, "text"), GetSQLValueString($coltype_RecordHealth, "text"),GetSQLValueString($collang_RecordHealth, "text"),GetSQLValueString($coluserid_RecordHealth, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordHealth = mysqli_query($DB_Conn, $query_RecordHealth) or die(mysqli_error($DB_Conn));
	$row_RecordHealth = mysqli_fetch_assoc($RecordHealth);
	$totalRows_RecordHealth = mysqli_num_rows($RecordHealth);
	
}else{
	//分頁
	$query_limit_RecordHealth = sprintf("%s LIMIT %d, %d", $query_RecordHealth, $startRow_RecordHealth, $maxRows_RecordHealth);
	$RecordHealth = mysqli_query($DB_Conn, $query_limit_RecordHealth) or die(mysqli_error($DB_Conn));
	$row_RecordHealth = mysqli_fetch_assoc($RecordHealth);
	
	if (isset($_GET['totalRows_RecordHealth'])) {
	  $totalRows_RecordHealth = $_GET['totalRows_RecordHealth'];
	} else {
	  $all_RecordHealth = mysqli_query($DB_Conn, $query_RecordHealth);
	  $totalRows_RecordHealth = mysqli_num_rows($all_RecordHealth);
	}
	$totalPages_RecordHealth = ceil($totalRows_RecordHealth/$maxRows_RecordHealth)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordHealth > '0') { ?>
<?php do { ?>
  <?php 

  	//$nestedData = array();
	$dvalue['id'] = $row_RecordHealth["id"];
  	//$dvalue['chk'] = "<input name='delHealth[]' type='checkbox' id='delHealth[]' value='".$row_RecordHealth["id"]."\'/>";

	$dvalue['InsuranceLevel'] = $row_RecordHealth["InsuranceLevel"];
	
	if($row_RecordHealth["type"] == '1') {$row_RecordHealth["type"] = "外國籍";}else{$row_RecordHealth["type"] = "本國籍";}
	$dvalue['type'] = "<span id='type_".$row_RecordHealth["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["type"]."</span>";
	
	
	$dvalue['InsuranceMoney'] = "<span id='InsuranceMoney_".$row_RecordHealth["id"]."' class='ed_InsuranceMoney' data-type='text' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["InsuranceMoney"]."</span>";
	
	$dvalue['HealthSharing'] = "<span id='HealthSharing_".$row_RecordHealth["id"]."' class='ed_HealthSharing' data-type='text' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["HealthSharing"]."</span>";
	
	$dvalue['HealthSharingAdd1'] = "<span id='HealthSharingAdd1_".$row_RecordHealth["id"]."' class='ed_HealthSharingAdd1' data-type='text' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["HealthSharingAdd1"]."</span>";
	
	$dvalue['HealthSharingAdd2'] = "<span id='HealthSharingAdd2_".$row_RecordHealth["id"]."' class='ed_HealthSharingAdd2' data-type='text' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["HealthSharingAdd2"]."</span>";
	
	$dvalue['HealthSharingAdd3'] = "<span id='HealthSharingAdd3_".$row_RecordHealth["id"]."' class='ed_HealthSharingAdd3' data-type='text' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["HealthSharingAdd3"]."</span>";
	
	$dvalue['EmployerSharing'] = "<span id='EmployerSharing_".$row_RecordHealth["id"]."' class='ed_EmployerSharing' data-type='text' data-pk='".$row_RecordHealth["id"]."' data-placement='top'>".$row_RecordHealth["EmployerSharing"]."</span>";
	
	//$dvalue['content'] = $row_RecordHealth["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordHealth = mysqli_fetch_assoc($RecordHealth)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordHealth), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordHealth);
?>
