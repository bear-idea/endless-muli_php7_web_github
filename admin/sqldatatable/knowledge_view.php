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

if(isset($_POST['search_type1'])){
	$search_type1 = $_POST['search_type1'];
}else{
	$search_type1 = "";
}
if(isset($_POST['search_type2'])){
	$search_type2 = $_POST['search_type2'];
}else{
	$search_type2 = "";
}
if(isset($_POST['search_type3'])){
	$search_type3 = $_POST['search_type3'];
}else{
	$search_type3 = "";
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
        case 1;$orderSql = " ORDER BY name ".$order_dir;break;
        case 2;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 3;$orderSql = " ORDER BY indicate ".$order_dir;break;
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

$maxRows_RecordKnowledge = $length;
$startRow_RecordKnowledge = $start;

$colsearch_RecordKnowledge = "%";
if (isset($DT_search)) {
  $colsearch_RecordKnowledge = $DT_search;
}

//$colnamelang_RecordKnowledge = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordKnowledge = $_SESSION['lang'];
}

$colindicate_RecordKnowledge = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordKnowledge = $search_indicate;
}
$coltype1_RecordKnowledge = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordKnowledge = $search_type1;
}
$coltype2_RecordKnowledge = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordKnowledge = $search_type2;
}
$coltype3_RecordKnowledge = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordKnowledge = $search_type3;
}

$coluserid_RecordKnowledge = "-1";
if (isset($w_userid)) {
  $coluserid_RecordKnowledge = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_knowledge WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordKnowledge, "int"),GetSQLValueString($colnamelang_RecordKnowledge, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordKnowledge = sprintf("SELECT * FROM demo_knowledge WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordKnowledge, "text"), GetSQLValueString($colindicate_RecordKnowledge, "text"),GetSQLValueString($coluserid_RecordKnowledge, "int"),GetSQLValueString($collang_RecordKnowledge, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_knowledge WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordKnowledge, "text"),GetSQLValueString($coluserid_RecordKnowledge, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordKnowledge = sprintf("SELECT * FROM demo_knowledge WHERE name LIKE %s && indicate LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordKnowledge . "%", "text"), GetSQLValueString($colindicate_RecordKnowledge, "text"),GetSQLValueString($coltype1_RecordKnowledge, "text"),GetSQLValueString($coltype2_RecordKnowledge, "text"),GetSQLValueString($coltype3_RecordKnowledge, "text"),GetSQLValueString($collang_RecordKnowledge, "text"),GetSQLValueString($coluserid_RecordKnowledge, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordKnowledge = mysqli_query($DB_Conn, $query_RecordKnowledge) or die(mysqli_error($DB_Conn));
	$row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge);
	$totalRows_RecordKnowledge = mysqli_num_rows($RecordKnowledge);
	
}else{
	//分頁
	$query_limit_RecordKnowledge = sprintf("%s LIMIT %d, %d", $query_RecordKnowledge, $startRow_RecordKnowledge, $maxRows_RecordKnowledge);
	$RecordKnowledge = mysqli_query($DB_Conn, $query_limit_RecordKnowledge) or die(mysqli_error($DB_Conn));
	$row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge);
	
	if (isset($_GET['totalRows_RecordKnowledge'])) {
	  $totalRows_RecordKnowledge = $_GET['totalRows_RecordKnowledge'];
	} else {
	  $all_RecordKnowledge = mysqli_query($DB_Conn, $query_RecordKnowledge);
	  $totalRows_RecordKnowledge = mysqli_num_rows($all_RecordKnowledge);
	}
	$totalPages_RecordKnowledge = ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordKnowledge > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_knowledge.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_knowledge.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordKnowledge['id'];
	$link_edit = "manage_knowledge.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordKnowledge['id'];
	$link_start = "manage_knowledge.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordKnowledge["id"].",event)'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordKnowledge["id"];
  	$dvalue['chk'] = "<input name='delKnowledge[]' type='checkbox' id='delKnowledge[]' value='".$row_RecordKnowledge["id"]."\'/>";
	$dvalue['name'] = "<span id='name_".$row_RecordKnowledge["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordKnowledge["id"]."' data-placement='top'>".$row_RecordKnowledge["name"]."</span>";
	
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordKnowledge["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordKnowledge["id"]."' data-placement='top'>".$row_RecordKnowledge["sortid"]."</span>";
	if($row_RecordKnowledge["indicate"] == '1') {$row_RecordKnowledge["indicate"] = "公佈";}else{$row_RecordKnowledge["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordKnowledge["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordKnowledge["id"]."' data-placement='top'>".$row_RecordKnowledge["indicate"]."</span>";;
	$dvalue['action'] = "<div class='btn-group'>".$but_copy.$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordKnowledge["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordKnowledge), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordKnowledge);
?>
