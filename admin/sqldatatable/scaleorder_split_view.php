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
//$tb_filter_splitdicate = $_POST['tb_filter_splitdicate'];

$search_carnumber = $_POST['search_carnumber'];
$search_startdate = $_POST['search_startdate'];
//$_POST['search_state'] = "";

/*if($_POST['search_state'] == ""){
	$splitdate = "startdate";
}else{
	$splitdate = "enddate";
}*/

$search_startdate_spile = explode(" ",$search_startdate);

$search_startdate = $search_startdate_spile[0];
$search_enddate = $search_startdate_spile[2];

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
		case 1;$orderSql = " ORDER BY oserial ".$order_dir;break;
        case 2;$orderSql = " ORDER BY startdate ".$order_dir;break;
        case 3;$orderSql = " ORDER BY Estimatedday ".$order_dir;break;
		case 4;$orderSql = " ORDER BY carnumber ".$order_dir;break;
        case 5;$orderSql = " ORDER BY bigweight ".$order_dir;break;
		case 6;$orderSql = " ORDER BY enddate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY oid DESC";
}else{
	$orderSql = $orderSql . ",oid DESC";
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

$maxRows_RecordSplitorder = $length;
$startRow_RecordSplitorder = $start;

$colsearch_RecordSplitorder = "%";
if (isset($DT_search)) {
  $colsearch_RecordSplitorder = $DT_search;
}

//$colnamelang_RecordSplitorder = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSplitorder = $_SESSION['lang'];
}

$colindicate_RecordSplitorder = "%";
if (isset($search_splitdicate) && $search_splitdicate != "") {
  if($search_splitdicate == "公佈") {$search_splitdicate = '1';}
  if($search_splitdicate == "隱藏") {$search_splitdicate = '0';}
  $colindicate_RecordSplitorder = $search_splitdicate;
}

$colcarnumber_RecordSplitorder = "%";
if (isset($search_carnumber) && $search_carnumber != "") {
  $colcarnumber_RecordSplitorder = $search_carnumber;
}

$coluserid_RecordSplitorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorder = $w_userid;
}

$colstartdate_RecordSplitorder = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordSplitorder = $search_startdate;
}

$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordSplitorder = $dt->format('Y-m-d');
$colenddate_RecordSplitorder .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordSplitorder = $dt->format('Y-m-d');
  $colenddate_RecordSplitorder .= " 23:59:59";
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scaleorder_split WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordSplitorder, "int"),GetSQLValueString($colnamelang_RecordSplitorder, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordSplitorder = sprintf("SELECT * FROM erp_scaleorder_split WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordSplitorder, "text"), GetSQLValueString($colindicate_RecordSplitorder, "text"),GetSQLValueString($coluserid_RecordSplitorder, "int"),GetSQLValueString($collang_RecordSplitorder, "text"));

$query_RecordCount = sprintf("SELECT count(oid) as sum FROM erp_splitorder WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordSplitorder, "text"),GetSQLValueString($coluserid_RecordSplitorder, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordSplitorder = sprintf("SELECT * FROM erp_splitorder WHERE (notes1 LIKE binary %s || notes1 IS NULL) && (carnumber LIKE binary %s || carnumber IS NULL) && indicate LIKE %s && lang = %s && userid=%s && startdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordSplitorder . "%", "text"), GetSQLValueString("%" . $colcarnumber_RecordSplitorder . "%", "text"), GetSQLValueString($colindicate_RecordSplitorder, "text"), GetSQLValueString($collang_RecordSplitorder, "text"),GetSQLValueString($coluserid_RecordSplitorder, "int"),GetSQLValueString($colstartdate_RecordSplitorder, "date"),GetSQLValueString($colenddate_RecordSplitorder, "date"));

if($draw == "" || $length == '-1') {
    //無分頁
	$RecordSplitorder = mysqli_query($DB_Conn, $query_RecordSplitorder) or die(mysqli_error($DB_Conn));
	$row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder);
	$totalRows_RecordSplitorder = mysqli_num_rows($RecordSplitorder);
	
}else{
	//分頁
	$query_limit_RecordSplitorder = sprintf("%s LIMIT %d, %d", $query_RecordSplitorder, $startRow_RecordSplitorder, $maxRows_RecordSplitorder);
	$RecordSplitorder = mysqli_query($DB_Conn, $query_limit_RecordSplitorder) or die(mysqli_error($DB_Conn));
	$row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder);
	
	if (isset($_GET['totalRows_RecordSplitorder'])) {
	  $totalRows_RecordSplitorder = $_GET['totalRows_RecordSplitorder'];
	} else {
	  $all_RecordSplitorder = mysqli_query($DB_Conn, $query_RecordSplitorder);
	  $totalRows_RecordSplitorder = mysqli_num_rows($all_RecordSplitorder);
	}
	$totalPages_RecordSplitorder = ceil($totalRows_RecordSplitorder/$maxRows_RecordSplitorder)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordSplitorder > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_view = "manage_scaleorder_split_index_detailed.php?oid=" . $row_RecordSplitorder['oid'] . "&amp;lang=" . $_SESSION['lang'];
    $link_add = "manage_scaleorder_split.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scaleorder_split.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordSplitorder['oid'];
	$link_edit = "manage_scaleorder_split.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordSplitorder['oid'];
	$link_start = "manage_scaleorder_split.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary colorbox_iframe' style='text-align:center'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordSplitorder["oid"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordSplitorder["oid"];
	
  	$dvalue['chk'] = "<input name='delSplitorder[]' type='checkbox' id='delSplitorder[]' value='".$row_RecordSplitorder["oid"]."\'/>";
    
	$dvalue['oserial'] = $row_RecordSplitorder["oserial"];
	
	$dvalue['carnumber'] = "<span id='carnumber_".$row_RecordSplitorder["oid"]."' class='ed_carnumber' data-type='select' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$row_RecordSplitorder["carnumber"]."</span>";
	
	$dvalue['bigweight'] = "<span id='bigweight_".$row_RecordSplitorder["oid"]."' class='ed_carnumber' data-type='select' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$row_RecordSplitorder["bigweight"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordSplitorder["oid"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$row_RecordSplitorder["sortid"]."</span>";
	
	$dvalue['Estimatedday'] = "<span id='Estimatedday_".$row_RecordSplitorder["oid"]."' class='ed_Estimatedday' data-type='text' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$row_RecordSplitorder["Estimatedday"]."</span>";
	
	if($row_RecordSplitorder["indicate"] == '1') {$row_RecordSplitorder["indicate"] = "公佈";}else{$row_RecordSplitorder["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordSplitorder["oid"]."' class='ed_splitdicate' data-type='select' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$row_RecordSplitorder["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordSplitorder['startdate']); 
	$dvalue['startdate'] = "<span id='startdate_".$row_RecordSplitorder["oid"]."' class='ed_startdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$dt->format('Y-m-d H:i A')."</span>";
	
	if($row_RecordSplitorder['enddate'] != "") {
		$dt = new DateTime($row_RecordSplitorder['enddate']); 
		$dvalue['enddate'] = "<span id='enddate_".$row_RecordSplitorder["oid"]."' class='ed_enddate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".$dt->format('Y-m-d H:i A')."</span>";
	}else{
		$dt = new DateTime(); 
	$dvalue['enddate'] = "<span id='enddate_".$row_RecordSplitorder["oid"]."' class='ed_enddate editable-click editable-empty' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordSplitorder["oid"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	$dvalue['action'] = "<div class='btn-group'>".$but_view.$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordSplitorder["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordSplitorder), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordSplitorder);
?>
