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

$search_ordertype = $_POST['search_ordertype'];

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
        //case 1;$orderSql = " ORDER BY postdate ".$order_dir;break;
		case 2;$orderSql = " ORDER BY ordertype ".$order_dir;break;
		case 3;$orderSql = " ORDER BY summonsnumber ".$order_dir;break;
		//case 4;$orderSql = " ORDER BY type ".$order_dir;break;
        case 5;$orderSql = " ORDER BY title ".$order_dir;break;
		case 6;$orderSql = " ORDER BY debitamount ".$order_dir;break;
		case 7;$orderSql = " ORDER BY creditamount ".$order_dir;break;
		case 8;$orderSql = " ORDER BY openingbalance ".$order_dir;break;
		case 9;$orderSql = " ORDER BY notes1 ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY type ASC, postdate ASC";
}else{
	$orderSql = $orderSql . ",type ASC, postdate ASC";
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

$colordertype_RecordAccounts_summonsdetail = "%";
if (isset($search_ordertype) && $search_ordertype != "" && $search_ordertype != "-1") {
  $colordertype_RecordAccounts_summonsdetail = $search_ordertype;
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

$coluserid_RecordAccounts_summonsdetail = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsdetail = $w_userid;
}

$colstartdate_RecordAccounts_summonsdetail = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
	$dt = new DateTime($search_startdate);
	//$interval = new DateInterval('P1Y');
	//$dt->sub($interval);
    $colstartdate_RecordAccounts_summonsdetail = $dt->format('Y-01-01');
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

$query_RecordCount = sprintf("SELECT count(id) as sum FROM invoicing_accounts_summonsdetail WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

//if($DT_search != "") {
 $query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE IFNULL(notes1,1) LIKE %s && ordertype LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && type4 LIKE %s && lang=%s && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordAccounts_summonsdetail . "%", "text"),GetSQLValueString($colordertype_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype1_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype2_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype3_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype4_RecordAccounts_summonsdetail, "text"),GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsdetail, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsdetail, "date"));
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
<?php 
// 期初餘額
$colname_RecordAccounts_beginningamount = "zh-tw";
if (isset($_SESSION['lang'])) {
$colname_RecordAccounts_beginningamount = $_SESSION['lang'];
}
$coluserid_RecordAccounts_beginningamount = "-1";
if (isset($w_userid)) {
$coluserid_RecordAccounts_beginningamount = $w_userid;
}
$colpostdate_RecordAccounts_beginningamount = "%";
if (isset($search_startdate)) {
    $dt = new DateTime($search_startdate);
	//$interval = new DateInterval('P1Y');
	//$dt->sub($interval);
    $colpostdate_RecordAccounts_beginningamount = $dt->format('Y-01-01');
}
$colstartdate_RecordAccounts_beginningamount = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
	$dt = new DateTime($search_startdate);
	$interval = new DateInterval('P1Y');
	$dt->sub($interval);
    $colstartdate_RecordAccounts_beginningamount = $dt->format('Y-01-01');
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordAccounts_beginningamount = $dt->format('Y-m-d');
$colenddate_RecordAccounts_beginningamount .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordAccounts_beginningamount = $dt->format('Y-m-d');
  $colenddate_RecordAccounts_beginningamount .= " 23:59:59";
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
/*$query_RecordAccounts_beginningamount = sprintf("SELECT * FROM invoicing_accounts_beginningamount WHERE postdate=%s && lang=%s && userid=%s ORDER BY postdate ASC", GetSQLValueString($colpostdate_RecordAccounts_beginningamount, "date"), GetSQLValueString($colname_RecordAccounts_beginningamount, "text"),GetSQLValueString($coluserid_RecordAccounts_beginningamount, "int"));
$RecordAccounts_beginningamount = mysqli_query($DB_Conn, $query_RecordAccounts_beginningamount) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_beginningamount = mysqli_fetch_assoc($RecordAccounts_beginningamount);
$totalRows_RecordAccounts_beginningamount = mysqli_num_rows($RecordAccounts_beginningamount);*/
$query_RecordAccounts_beginningamount = sprintf("SELECT type, title, type1, type2, type3, type4, lang, userid, postdate, SUM(debitamount) AS NowDebitBalance, COUNT(debitamount) AS NumDebit, SUM(creditamount) AS NowCreditBalance, COUNT(creditamount) AS NumCredit FROM invoicing_accounts_summonsdetail WHERE type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && type4 LIKE %s && lang=%s && userid=%s && postdate BETWEEN %s AND %s GROUP BY type $orderSql",GetSQLValueString($coltype1_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype2_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype3_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coltype4_RecordAccounts_summonsdetail, "text"),GetSQLValueString($collang_RecordAccounts_summonsdetail, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"),GetSQLValueString($colstartdate_RecordAccounts_beginningamount, "date"),GetSQLValueString($colenddate_RecordAccounts_beginningamount, "date"));
$RecordAccounts_beginningamount = mysqli_query($DB_Conn, $query_RecordAccounts_beginningamount) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_beginningamount = mysqli_fetch_assoc($RecordAccounts_beginningamount);
$totalRows_RecordAccounts_beginningamount = mysqli_num_rows($RecordAccounts_beginningamount);

// 取得所有會計項目
/*$query_RecordAccounts_trialbalance = sprintf("SELECT type, lang, userid, postdate FROM invoicing_accounts_summonsdetail WHERE lang=%s && userid=%s && postdate BETWEEN %s AND %s GROUP BY type $orderSql",GetSQLValueString($colname_RecordAccounts_beginningamount, "text"),GetSQLValueString($coluserid_RecordAccounts_beginningamount, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsdetail, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsdetail, "date"));
$RecordAccounts_trialbalance = mysqli_query($DB_Conn, $query_RecordAccounts_trialbalance) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_trialbalance = mysqli_fetch_assoc($RecordAccounts_trialbalance);
$totalRows_RecordAccounts_trialbalance = mysqli_num_rows($RecordAccounts_trialbalance);*/
?>
<?php if ($totalRows_RecordAccounts_summonsdetail > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_detail = "inner_accounts_summons.php?wshop=".$wshop."&amp;Opt=detailpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordAccounts_summonsdetail['aid'];
  	//$nestedData = array();
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['id'] = $row_RecordAccounts_summonsdetail["id"];
	
  	//$dvalue_detail['chk'] = "<input name='delaccounts_summonsdetail[]' type='checkbox' id='delaccounts_summonsdetail[]' value='".$row_RecordAccounts_summonsdetail["id"]."\'/>";

	if($row_RecordAccounts_summonsdetail["notes1"] != ""){
		$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['notes1'] = "<span id=notes1_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["notes1"]."</span>";
	}else{
		$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['notes1'] = "<span id=notes1_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	//$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['title'] = $row_RecordAccounts_summonsdetail["title"];
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['title'] = '';
	
	//$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['type'] = $row_RecordAccounts_summonsdetail["type"];
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['type'] = '';
		
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['ordertype'] = $row_RecordAccounts_summonsdetail["ordertype"];
	
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['summonsnumber'] = "<a href='".$link_detail."' class='btn btn-xs btn-link colorbox_iframe_cd' style='text-align:center'><i class='fa fa-link'></i> ".$row_RecordAccounts_summonsdetail["summonsnumber"]."</a>";
	
	if ($row_RecordAccounts_summonsorder['type'] == '收入'){
		$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['debitamount'] = $row_RecordAccounts_summonsdetail["debitamount"];
	}else{
		//$dvalue_detail['debitamount'] = "<span id=debitamount_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["debitamount"]."</span>";
		$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['debitamount'] = $row_RecordAccounts_summonsdetail["debitamount"];
	}
	
	if ($row_RecordAccounts_summonsorder['type'] == '支出'){
		$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['creditamount'] = $row_RecordAccounts_summonsdetail["creditamount"];
	}else{
		//$dvalue_detail['creditamount'] = "<span id=creditamount_".$row_RecordAccounts_summonsdetail["id"]."' class='ed_creditamount text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsdetail["id"]."' data-placement='top'>".$row_RecordAccounts_summonsdetail["creditamount"]."</span>";
		$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['creditamount'] = $row_RecordAccounts_summonsdetail["creditamount"];
	}

	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['openingbalance'] = $EndBalanceSelect;
	
	$dt = new DateTime($row_RecordAccounts_summonsdetail['postdate']); 
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['postdate'] = $dt->format('Y-m-d');
	
	$colitem_id_RecordAccounts_summonsitem = "-1";
	if (isset($row_RecordAccounts_summonsdetail['type1'])) {
	  $colitem_id_RecordAccounts_summonsitem = $row_RecordAccounts_summonsdetail['type1'];
	}
	$collang_RecordAccounts_summonsitem = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordAccounts_summonsitem = $_SESSION['lang'];
	}
	$coluserid_RecordAccounts_summonsitem = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAccounts_summonsitem = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAccounts_summonsitem = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && item_id = %s && lang = %s && userid=%s ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($colitem_id_RecordAccounts_summonsitem, "text"), GetSQLValueString($collang_RecordAccounts_summonsitem, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsitem, "int"));
	$RecordAccounts_summonsitem = mysqli_query($DB_Conn, $query_RecordAccounts_summonsitem) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsitem = mysqli_fetch_assoc($RecordAccounts_summonsitem);
	$totalRows_RecordAccounts_summonsitem = mysqli_num_rows($RecordAccounts_summonsitem);
	
	$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]]['type1_itemvalue'] = $row_RecordAccounts_summonsitem['itemvalue'];
	
	$data_detail[$row_RecordAccounts_summonsdetail["type"]][] = $dvalue_detail[$row_RecordAccounts_summonsdetail["type"]];
	
	//$dvalue_detail['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_detail.$but_del.$but_more."</div>";
	//$dvalue_detail['content'] = $row_RecordAccounts_summonsdetail["content"];
	//$dvalue_detail[$row_RecordAccounts_summonsdetail["type"]] = $dvalue_detail;
	
	//$data[] = $dvalue_detail;
	
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail)); ?>
<?php } ?>
<?php 
if ($totalRows_RecordAccounts_beginningamount > 0) {
do {
  //if(in_array($row_RecordAccounts_trialbalance['type'], (array)$row_RecordAccounts_beginningamount['type'])){
  //}else{
	  // 期初餘額
	  $colname_RecordAccounts_beginningamountGet = "zh-tw";
	  if (isset($_SESSION['lang'])) {
	  $colname_RecordAccounts_beginningamountGet = $_SESSION['lang'];
	  }
	  $coluserid_RecordAccounts_beginningamountGet = "-1";
	  if (isset($w_userid)) {
	  $coluserid_RecordAccounts_beginningamountGet = $w_userid;
	  }
	  $coltype_RecordAccounts_beginningamountGet = "-1";
	  if (isset($row_RecordAccounts_beginningamount["type"])) {
	  $coltype_RecordAccounts_beginningamountGet = $row_RecordAccounts_beginningamount["type"];
	  }
	  $colpostdate_RecordAccounts_beginningamountGet = "%";
	  if (isset($search_startdate)) {
		  $dt = new DateTime($search_startdate);
		  //$interval = new DateInterval('P1Y');
	      //$dt->sub($interval);
		  $colpostdate_RecordAccounts_beginningamountGet = $dt->format('Y-01-01');
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordAccounts_beginningamountGet = sprintf("SELECT * FROM invoicing_accounts_beginningamount WHERE type=%s && postdate=%s && lang=%s && userid=%s ORDER BY type ASC", GetSQLValueString($coltype_RecordAccounts_beginningamountGet, "text"), GetSQLValueString($colpostdate_RecordAccounts_beginningamountGet, "date"), GetSQLValueString($colname_RecordAccounts_beginningamountGet, "text"),GetSQLValueString($coluserid_RecordAccounts_beginningamountGet, "int"));
	  $RecordAccounts_beginningamountGet = mysqli_query($DB_Conn, $query_RecordAccounts_beginningamountGet) or die(mysqli_error($DB_Conn));
	  $row_RecordAccounts_beginningamountGet = mysqli_fetch_assoc($RecordAccounts_beginningamountGet);
	  $totalRows_RecordAccounts_beginningamountGet = mysqli_num_rows($RecordAccounts_beginningamountGet);
	  // 期初餘額
	  
	  $dvalue['id'] = '';
	  $dvalue['notes1'] = '期初餘額';
	  $dvalue['title'] = $row_RecordAccounts_beginningamount['title'];
	  $dvalue['type'] = $row_RecordAccounts_beginningamount['type'];
	  $dvalue['ordertype'] = '';
	  //$dvalue['debitamount'] = $row_RecordAccounts_beginningamountGet['BeginDebitBalance'];
	  //$dvalue['creditamount'] = $row_RecordAccounts_beginningamountGet['BeginCreditBalance'];
	  $dvalue['debitamount'] = '';
	  $dvalue['creditamount'] = '';
	  $dvalue['summonsnumber'] = '';
	  
	  $EndBalanceSelect = ($row_RecordAccounts_beginningamountGet['BeginDebitBalance']) - ($row_RecordAccounts_beginningamountGet['BeginCreditBalance']);
	  
	    $colitem_id_RecordAccounts_summonsitem = "-1";
		if (isset($row_RecordAccounts_beginningamountGet['type1'])) {
		  $colitem_id_RecordAccounts_summonsitem = $row_RecordAccounts_beginningamountGet['type1'];
		}
		$collang_RecordAccounts_summonsitem = "zh-tw";
		if (isset($_SESSION['lang'])) {
		  $collang_RecordAccounts_summonsitem = $_SESSION['lang'];
		}
		$coluserid_RecordAccounts_summonsitem = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordAccounts_summonsitem = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordAccounts_summonsitem = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && item_id = %s && lang = %s && userid=%s ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($colitem_id_RecordAccounts_summonsitem, "text"), GetSQLValueString($collang_RecordAccounts_summonsitem, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsitem, "int"));
		$RecordAccounts_summonsitem = mysqli_query($DB_Conn, $query_RecordAccounts_summonsitem) or die(mysqli_error($DB_Conn));
		$row_RecordAccounts_summonsitem = mysqli_fetch_assoc($RecordAccounts_summonsitem);
		$totalRows_RecordAccounts_summonsitem = mysqli_num_rows($RecordAccounts_summonsitem);
	  
	  
	    //echo $EndBalanceSelect;
	    //$row_RecordAccounts_summonsitem['itemvalue']; echo '@@@@@@@@@';
	    // 貸方餘額(Credit Balance) 借方餘額 Debit balance
		switch($row_RecordAccounts_summonsitem['itemvalue'])
		{
		  case 1:   // 1 資產 借方+ 貸方-
		  case 5:   // 5 營業成本 借方+ 貸方-
		  case 6:   // 6 營業費用 借方+ 貸方-
			if($EndBalanceSelect > 0){ // 位於借方
		      $balance = $row_RecordAccounts_beginningamountGet['BeginDebitBalance'];
			}else if($EndBalanceSelect < 0){ // 位於貸方
			  $balance =  0 - $row_RecordAccounts_beginningamountGet['BeginCreditBalance'];
			}else{
			  $balance =  0;
			}
		  break;
		  case 2:   // 2 負債 借方- 貸方+
		  case 3:   // 3 權益 借方- 貸方+
		  case 4:   // 4 營業收入 借方- 貸方+
		  case 7:   // 7 營業外收益及費損 借方- 貸方+
		  case 8:   // 8 綜合損益總額 借方- 貸方+
			if($EndBalanceSelect > 0){ // 位於借方
			  $balance =  0 - $row_RecordAccounts_beginningamountGet['BeginDebitBalance'];
			}else if($EndBalanceSelect < 0){ // 位於貸方
			  $balance =  $row_RecordAccounts_beginningamountGet['BeginCreditBalance'];
			}else{
			  $balance =  0;
			}
		  break;
		}
      
	  if($EndBalanceSelect != ''){
	  	 $dvalue['openingbalance'] = $balance;
	  }else{
		 $dvalue['openingbalance'] = 0;
	  }
	  //$dvalue['openingbalance'] = $EndBalanceSelect;
	  $dvalue['postdate'] = '';
	  $data[] = $dvalue;
	  
	  //$data[] = $data_detail;
	  
	  //var_dump( $data_detail[$row_RecordAccounts_beginningamount['type']] );
	  
	  // 
	  $balance = 0;
	  $openingbalance_before = $dvalue['openingbalance'];
	  
	  //$row_RecordAccounts_summonsitem['itemvalue'] = 1;
	  
	  foreach ($data_detail[$row_RecordAccounts_beginningamount['type']] as $k1 => $v1) {
		  foreach ($v1 as $k2 => $v2) {
			  $dvalue_slect[$k2] = $v2;
		  }
		  $EndBalanceSelect = ($dvalue_slect['debitamount']) - ($dvalue_slect['creditamount']);
		  switch($dvalue_slect['type1_itemvalue'])
			{
			  case 1:   // 1 資產 借方+ 貸方-
			  case 5:   // 5 營業成本 借方+ 貸方-
			  case 6:   // 6 營業費用 借方+ 貸方-
				if($EndBalanceSelect > 0){ // 位於借方
				  $balance = $dvalue_slect['debitamount']+$openingbalance_before;
				  $openingbalance_before = $balance;
				}else if($EndBalanceSelect < 0){ // 位於貸方
				  $balance =  0 - $dvalue_slect['creditamount']+$openingbalance_before;
				  $openingbalance_before = $balance;
				}else{
				  $balance =  0+$openingbalance_before;
				  $openingbalance_before = $balance;
				}
			  break;
			  case 2:   // 2 負債 借方- 貸方+
			  case 3:   // 3 權益 借方- 貸方+
			  case 4:   // 4 營業收入 借方- 貸方+
			  case 7:   // 7 營業外收益及費損 借方- 貸方+
			  case 8:   // 8 綜合損益總額 借方- 貸方+
				if($EndBalanceSelect > 0){ // 位於借方
				  $balance =  0 - $dvalue_slect['debitamount']+$openingbalance_before;
				  $openingbalance_before = $balance;
				}else if($EndBalanceSelect < 0){ // 位於貸方
				  $balance =  $dvalue_slect['creditamount']+$openingbalance_before;
				  $openingbalance_before = $balance;
				}else{
				  $balance =  0+$openingbalance_before;
				  $openingbalance_before = $balance;
				}
			  break;
			}
 
		  if($EndBalanceSelect != ''){
			 $dvalue_slect['openingbalance'] = $balance;
		  }else{
			 $dvalue_slect['openingbalance'] = 0;
		  }
		  $data[] = $dvalue_slect;
		  //var_dump($value);
		  //echo '<br>@@@<br>';
		  //echo $row_RecordAccounts_beginningamount['type'] . ' ' . $key . ' ' . $value . '<br>';
		  //$dvalue_all[$row_RecordAccounts_beginningamount['type']][$key] = $value;
		  //$data[] = $dvalue_all[$row_RecordAccounts_beginningamount['type']];
	  }
	  
	  //var_dump($data_detail[$row_RecordAccounts_beginningamount['type']]);
	  //echo '<br>@@@<br>';
	  //$data[] = $data_detail[$row_RecordAccounts_beginningamount['type']];
	  
  //}
} while ($row_RecordAccounts_beginningamount = mysqli_fetch_assoc($RecordAccounts_beginningamount));
}
// 期初餘額
?>


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
