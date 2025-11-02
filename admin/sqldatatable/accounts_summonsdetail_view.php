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
$draw = $_POST['draw'];//这个值作者会直接返回给前台

//搜索
$DT_search = $_POST['search']['value'];//获取前台传过来的过滤条件

// 取得自定變數
//$tb_filter_title = $_POST['tb_filter_title'];
//$tb_filter_sortid = $_POST['tb_filter_sortid'];
//$tb_filter_indicate = $_POST['tb_filter_indicate'];

if(isset($_POST['search_type1'])){
	$search_type1 = $_POST['search_type1'];
}else{
	$search_type1 = "-1";
}
if(isset($_POST['search_type2'])){
	$search_type2 = $_POST['search_type2'];
}else{
	$search_type2 = "-1";
}
if(isset($_POST['search_type3'])){
	$search_type3 = $_POST['search_type3'];
}else{
	$search_type3 = "-1";
}
if(isset($_POST['search_type4'])){
	$search_type4 = $_POST['search_type4'];
}else{
	$search_type4 = "-1";
}

$search_aid = $_GET['aid'];

$search_postdate = $_POST['search_postdate'];

$search_postdate_spile = explode(" ",$search_postdate);
$search_startdate = $search_postdate_spile[0];
$search_enddate = $search_postdate_spile[2];

//排序
$order_column = $_POST['order']['0']['column'];//那一列排序，从0开始
$order_dir = $_POST['order']['0']['dir'];//ase desc 升序或者降序

//拼接排序sql
$orderSql = "";
if(isset($order_column)){
    $i = intval($order_column);
    switch($i){
        //case 0;$orderSql = " ORDER BY id ".$order_dir;break;
        case 1;$orderSql = " ORDER BY type ".$order_dir;break;
        case 2;$orderSql = " ORDER BY title ".$order_dir;break;
        case 3;$orderSql = " ORDER BY notes1 ".$order_dir;break;
		case 4;$orderSql = " ORDER BY debitamount ".$order_dir;break;
		case 5;$orderSql = " ORDER BY creditamount ".$order_dir;break;
		case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY id DESC";
}else{
	$orderSql = $orderSql . ",id DESC";
}

//分页
$start = $_POST['start'];//从多少开始
$length = $_POST['length'];//数据长度 共幾筆資料
$limitSql = '';
$limitFlag = isset($_POST['start']) && $length != -1 ;
if ($limitFlag ) {
    $limitSql = " LIMIT ".intval($start).", ".intval($length);
}

//条件过滤后记录数 必要
$recordsFiltered = 0;
//表的总记录数 必要
$recordsTotal = 0;

$maxRows_RecordAccounts_summonsdetail = $length;
$startRow_RecordAccounts_summonsdetail = $start;

$colsearch_RecordAccounts_summonsdetail = "%";
if (isset($DT_search)) {
  $colsearch_RecordAccounts_summonsdetail = $DT_search;
}

//$colnamelang_RecordAccounts_summonsdetail = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAccounts_summonsdetail = $_SESSION['lang'];
}

$colindicate_RecordAccounts_summonsdetail = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordAccounts_summonsdetail = $search_indicate;
}

$coltype1_RecordAccounts_summonsdetail = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordAccounts_summonsdetail = $search_type1;
}
$coltype2_RecordAccounts_summonsdetail = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordAccounts_summonsdetail = $search_type2;
}
$coltype3_RecordAccounts_summonsdetail = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordAccounts_summonsdetail = $search_type3;
}
$coltype4_RecordAccounts_summonsdetail = "%";
if (isset($search_type4) && $search_type4 != "" && $search_type4 != "-1") {
  $coltype4_RecordAccounts_summonsdetail = $search_type4;
}

$colaid_RecordAccounts_summonsdetail = "-1";
if (isset($search_aid)) {
  $colaid_RecordAccounts_summonsdetail = $search_aid;
}

$coluserid_RecordAccounts_summonsdetail = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsdetail = $w_userid;
}

$colstartdate_RecordAccounts_summonsdetail = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordAccounts_summonsdetail = $search_startdate;
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordAccounts_summonsdetail = $dt->format('Y-m-d');
$colenddate_RecordAccounts_summonsdetail .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordAccounts_summonsdetail = $dt->format('Y-m-d');
  $colenddate_RecordAccounts_summonsdetail .= " 23:59:59";
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM invoicing_accounts_summonsdetail WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colnamelang_RecordAccounts_summonsdetail, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordAccounts_summonsdetail, "text"), GetSQLValueString($colindicate_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM invoicing_accounts_summonsdetail WHERE lang = %s && userid=%s && aid=%s",GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colaid_RecordAccounts_summonsdetail, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

//if($DT_search != "") {
 $query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE IFNULL(notes1,1) LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && type4 LIKE %s && lang=%s && userid=%s && aid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordAccounts_summonsdetail . "%", "text"),GetSQLValueString($coltype1_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype2_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype3_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype4_RecordAccounts_summonsdetail, "text"),GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colaid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsdetail, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsdetail, "date"));
/*}else{
	$query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && type4 LIKE %s && lang=%s && userid=%s && aid=%s $orderSql",GetSQLValueString($coltype1_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype2_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype3_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype4_RecordAccounts_summonsdetail, "text"),GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colaid_RecordAccounts_summonsdetail, "int"));
}*/

$colname_RecordAccounts_summonsorder = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordAccounts_summonsorder = $_GET['aid'];
}
$coluserid_RecordAccounts_summonsorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsorder, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"));
$RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
$totalRows_RecordAccounts_summonsorder = mysqli_num_rows($RecordAccounts_summonsorder);

if($draw == "" || $length == '-1') {
    //無分頁
	$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
	$totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($RecordAccounts_summonsdetail);
	
}else{
	//分頁
	$query_limit_RecordAccounts_summonsdetail = sprintf("%s LIMIT %d, %d", $query_RecordAccounts_summonsdetail, $startRow_RecordAccounts_summonsdetail, $maxRows_RecordAccounts_summonsdetail);
	$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_limit_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
	
	if (isset($_GET['totalRows_RecordAccounts_summonsdetail'])) {
	  $totalRows_RecordAccounts_summonsdetail = $_GET['totalRows_RecordAccounts_summonsdetail'];
	} else {
	  $all_RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail);
	  $totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($all_RecordAccounts_summonsdetail);
	}
	$totalPages_RecordAccounts_summonsdetail = ceil($totalRows_RecordAccounts_summonsdetail/$maxRows_RecordAccounts_summonsdetail)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordAccounts_summonsdetail > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "inner_accounts_summons.php?wshop=".$wshop."&amp;Opt=detailaddpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$_GET['aid'];
	//$link_copy = "inner_accounts_summons.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAccounts_summonsdetail['id']."&amp;aid=".$_GET['aid'];
	$link_edit = "inner_accounts_summons.php?wshop=".$wshop."&amp;Opt=detaileditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAccounts_summonsdetail['id']."&amp;aid=".$_GET['aid'];

	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	if($row_RecordAccounts_summonsdetail["state"] == 'system'){
		$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary disabled' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
		$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary disabled' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
		$but_del = "<a href='".$link_del."' class='btn btn-xs btn-danger disabled' style='text-align:center' onclick='delete_datatables(".$row_RecordAccounts_summonsdetail["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	}else{
		$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
		$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
		$but_del = "<a href='".$link_del."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordAccounts_summonsdetail["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	}
	
	
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordAccounts_summonsdetail["id"];
	
  	//$dvalue['chk'] = "<input name='delaccounts_summonsdetail[]' type='checkbox' id='delaccounts_summonsdetail[]' value='".$row_RecordAccounts_summonsdetail["id"]."\'/>";

	if($row_RecordAccounts_summonsdetail["notes1"] != ""){
		$dvalue['notes1'] = "<span id=notes1_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["notes1"]."</span>";
	}else{
		$dvalue['notes1'] = "<span id=notes1_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	$dvalue['title'] = $row_RecordAccounts_summonsdetail["title"];
	
	$dvalue['type'] = $row_RecordAccounts_summonsdetail["type"];
	
	$dvalue['summonsnumber'] = $row_RecordAccounts_summonsdetail["summonsnumber"];
	
	if ($row_RecordAccounts_summonsorder['type'] == '收入'){
		$dvalue['debitamount'] = $row_RecordAccounts_summonsdetail["debitamount"];
	}else{
		//$dvalue['debitamount'] = "<span id=debitamount_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["debitamount"]."</span>";
		$dvalue['debitamount'] = $row_RecordAccounts_summonsdetail["debitamount"];
	}
	
	if ($row_RecordAccounts_summonsorder['type'] == '支出'){
		$dvalue['creditamount'] = $row_RecordAccounts_summonsdetail["creditamount"];
	}else{
		//$dvalue['creditamount'] = "<span id=creditamount_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_creditamount text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["creditamount"]."</span>";
		$dvalue['creditamount'] = $row_RecordAccounts_summonsdetail["creditamount"];
	}

	if($row_RecordAccounts_summonsdetail["indicate"] == '1') {$row_RecordAccounts_summonsdetail["indicate"] = "公佈";}else{$row_RecordAccounts_summonsdetail["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordAccounts_summonsdetail['postdate']); 
	$dvalue['postdate'] = $dt->format('Y-m-d');
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_detail.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordAccounts_summonsdetail["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordAccounts_summonsdetail), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordAccounts_summonsdetail);
?>
