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

$search_searchtype = $_POST['search_searchtype'];
$search_type = $_POST['search_type'];
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
        case 1;$orderSql = " ORDER BY postdate ".$order_dir;break;
        case 2;$orderSql = " ORDER BY type ".$order_dir;break;
        case 3;$orderSql = " ORDER BY summonsnumber ".$order_dir;break;
		case 4;$orderSql = " ORDER BY totalnumber ".$order_dir;break;
		case 5;$orderSql = " ORDER BY sumamount ".$order_dir;break;
		case 6;$orderSql = " ORDER BY sourcedocument ".$order_dir;break;
		case 7;$orderSql = " ORDER BY notes1 ".$order_dir;break;
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

$maxRows_RecordAccounts_summonsorder = $length;
$startRow_RecordAccounts_summonsorder = $start;

$colsearch_RecordAccounts_summonsorder = "%";
if (isset($DT_search)) {
  $colsearch_RecordAccounts_summonsorder = $DT_search;
}

//$colnamelang_RecordAccounts_summonsorder = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAccounts_summonsorder = $_SESSION['lang'];
}

$colindicate_RecordAccounts_summonsorder = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordAccounts_summonsorder = $search_indicate;
}

$coltype_RecordAccounts_summonsorder = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordAccounts_summonsorder = $search_type;
}


$coluserid_RecordAccounts_summonsorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsorder = $w_userid;
}

$colstartdate_RecordAccounts_summonsorder = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordAccounts_summonsorder = $search_startdate;
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordAccounts_summonsorder = $dt->format('Y-m-d');
$colenddate_RecordAccounts_summonsorder .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordAccounts_summonsorder = $dt->format('Y-m-d');
  $colenddate_RecordAccounts_summonsorder .= " 23:59:59";
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM invoicing_accounts_summonsorder WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"),GetSQLValueString($colnamelang_RecordAccounts_summonsorder, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordAccounts_summonsorder, "text"), GetSQLValueString($colindicate_RecordAccounts_summonsorder, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"),GetSQLValueString($collang_RecordAccounts_summonsorder, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM invoicing_accounts_summonsorder WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordAccounts_summonsorder, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

if(isset($search_searchtype) && $search_searchtype != "" && isset($DT_search) && $DT_search != ""){
	$query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE IFNULL(type,1) LIKE %s && IFNULL($search_searchtype,1) LIKE %s && lang = %s && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString($coltype_RecordAccounts_summonsorder, "text"), GetSQLValueString("%" . $colsearch_RecordAccounts_summonsorder . "%", "text"),GetSQLValueString($collang_RecordAccounts_summonsorder, "text"), GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsorder, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsorder, "date"));
}else{
	$query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE IFNULL(type,1) LIKE %s && lang = %s && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString($coltype_RecordAccounts_summonsorder, "text"),GetSQLValueString($collang_RecordAccounts_summonsorder, "text"), GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsorder, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsorder, "date"));
}



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
	$totalRows_RecordAccounts_summonsorder = mysqli_num_rows($RecordAccounts_summonsorder);
	
}else{
	//分頁
	$query_limit_RecordAccounts_summonsorder = sprintf("%s LIMIT %d, %d", $query_RecordAccounts_summonsorder, $startRow_RecordAccounts_summonsorder, $maxRows_RecordAccounts_summonsorder);
	$RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_limit_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
	$row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
	
	if (isset($_GET['totalRows_RecordAccounts_summonsorder'])) {
	  $totalRows_RecordAccounts_summonsorder = $_GET['totalRows_RecordAccounts_summonsorder'];
	} else {
	  $all_RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder);
	  $totalRows_RecordAccounts_summonsorder = mysqli_num_rows($all_RecordAccounts_summonsorder);
	}
	$totalPages_RecordAccounts_summonsorder = ceil($totalRows_RecordAccounts_summonsorder/$maxRows_RecordAccounts_summonsorder)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordAccounts_summonsorder > '0') { ?>
<?php do { ?>
  <?php 
  
    //$link_add = "manage_accounts_summons.php?wshop=".$wshop."&amp;Opt=orderaddpage&amp;lang=".$_SESSION['lang']; // 單一order
	$link_add = "manage_accounts_summons.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang']; // 包含主項和細項
	$link_copy = "manage_accounts_summons.php?wshop=".$wshop."&amp;Opt=ordercopypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAccounts_summonsorder['id'];
	$link_edit = "manage_accounts_summons.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAccounts_summonsorder['id'];
	$link_start = "manage_accounts_summons.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
	$link_detail = "inner_accounts_summons.php?wshop=".$wshop."&amp;Opt=detailpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordAccounts_summonsorder['id'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_detail = "<a href='".$link_detail."' class='btn btn-xs btn-primary colorbox_iframe_cd' style=text-align:center'><i class='far fa-file-alt'></i> 細項</a>";
	$but_del = "<a href='".$link_del."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordAccounts_summonsorder["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordAccounts_summonsorder["id"];
	
  	//$dvalue['chk'] = "<input name='delaccounts_summonsorder[]' type='checkbox' id='delaccounts_summonsorder[]' value='".$row_RecordAccounts_summonsorder["id"]."\'/>";
	

	if($row_RecordAccounts_summonsorder["notes1"] != ""){
		$dvalue['notes1'] = "<span id=notes1_".$row_RecordAccounts_summonsorder["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordAccounts_summonsorder["id"]."' data-placement='top'>".$row_RecordAccounts_summonsorder["notes1"]."</span>";
	}else{
		$dvalue['notes1'] = "<span id=notes1_".$row_RecordAccounts_summonsorder["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordAccounts_summonsorder["id"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	
	$dvalue['type'] = $row_RecordAccounts_summonsorder["type"];
	
	$dvalue['summonsnumber'] = "<a href='".$link_detail."' class='btn btn-xs btn-link colorbox_iframe_cd' style='text-align:center'><i class='fa fa-link'></i> ".$row_RecordAccounts_summonsorder["summonsnumber"]."</a>";
	
	$dvalue['totalnumber'] = $row_RecordAccounts_summonsorder["totalnumber"];
	
	$dvalue['sumamount'] = $row_RecordAccounts_summonsorder["sumamount"];
	
	if($row_RecordAccounts_summonsorder["errorcheck"] == 1){
		$dvalue['sumamount'] .= "<span class='label label-danger'>借貸不平衡</span>";
	}
	
	$dvalue['sourcedocument'] = $row_RecordAccounts_summonsorder["sourcedocument"];
	
	if($row_RecordAccounts_summonsorder["indicate"] == '1') {$row_RecordAccounts_summonsorder["indicate"] = "公佈";}else{$row_RecordAccounts_summonsorder["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordAccounts_summonsorder["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordAccounts_summonsorder["id"]."' data-placement='top'>".$row_RecordAccounts_summonsorder["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordAccounts_summonsorder['postdate']); 
	$dvalue['postdate'] = $dt->format('Y-m-d');
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_detail.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordAccounts_summonsorder["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordAccounts_summonsorder), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordAccounts_summonsorder);
?>
