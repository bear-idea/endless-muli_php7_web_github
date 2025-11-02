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

$search_mode = $_POST['search_mode'];
if(isset($_POST['search_postdate'])){
	$search_postdate = $_POST['search_postdate'];
}else{
	$search_postdate = "";
}

$search_startdate = $search_enddate = $search_postdate;

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
		case 1;$orderSql = " ORDER BY tb_o.bigtype ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY tb_o.type ".$order_dir;break;
	    case 3;$orderSql = " ORDER BY tb_o.wastecode ".$order_dir;break;
        case 4;$orderSql = " ORDER BY tb_o.title ".$order_dir;break;
        //case 4;$orderSql = " ORDER BY snumber ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY Totalweight ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY Minweight ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
		//case 7;$orderSql = " ORDER BY warehouse ".$order_dir;break;
		//case 8;$orderSql = " ORDER BY price ".$order_dir;break;
		//case 9;$orderSql = " ORDER BY carnumber ".$order_dir;break;
		//case 10;$orderSql = " ORDER BY carnumber ".$order_dir;break;
		//case 11;$orderSql = " ORDER BY author ".$order_dir;break;
		//case 10;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY tb_o.type ASC";
}else{
	$orderSql = $orderSql . ",tb_o.type ASC";
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

$maxRows_RecordScaleorder_clearance = $length;
$startRow_RecordScaleorder_clearance = $start;

$colsearch_RecordScaleorder_clearance = "%";
if (isset($DT_search)) {
  $colsearch_RecordScaleorder_clearance = $DT_search;
}

//$colnamelang_RecordScaleorder_clearance = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder_clearance = $_SESSION['lang'];
}

$colindicate_RecordScaleorder_clearance = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordScaleorder_clearance = $search_indicate;
}

$coltype_RecordScaleorder_clearance = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordScaleorder_clearance = $search_type;
}

$colcarnumber_RecordScaleorder_clearance = "%";
if (isset($search_carnumber) && $search_carnumber != "") {
  $colcarnumber_RecordScaleorder_clearance = $search_carnumber;
}

$colmanufacturer_RecordScaleorder_clearance = "%";
if (isset($search_manufacturer) && $search_manufacturer != "") {
  $colmanufacturer_RecordScaleorder_clearance = $search_manufacturer;
}

$colauthor_RecordScaleorder_clearance = "%";
if (isset($search_author) && $search_author != "") {
  $colauthor_RecordScaleorder_clearance = $search_author;
}

$coluserid_RecordScaleorder_clearance = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder_clearance = $w_userid;
}

$dt = new DateTime($search_startdate);
$dt->modify('first day of this month');
$colstartdate_RecordScaleorder_clearance = $dt->format('Y-m-d');
/*if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder_clearance = $search_startdate;
}*/

$dt = new DateTime($search_startdate);
$dt->modify('last day of this month');
$colenddate_RecordScaleorder_clearance = $dt->format('Y-m-d');
$colenddate_RecordScaleorder_clearance .= " 23:59:59";
/*if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  $interval = new DateInterval('P1D');
  $dt->add($interval);
  $colenddate_RecordScaleorder_clearance = $dt->format('Y-m-d');
}*/

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scaleclearanceorder_clearance WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colnamelang_RecordScaleorder_clearance, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScaleorder_clearance = sprintf("SELECT * FROM erp_scaleclearanceorder_clearance WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScaleorder_clearance, "text"), GetSQLValueString($colindicate_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($collang_RecordScaleorder_clearance, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scaleorderclearancedetail WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


/*$query_RecordScaleorder_clearance = sprintf("SELECT * FROM erp_scaleorderclearancedetail WHERE (title LIKE binary %s || snumber LIKE binary %s) && (author LIKE binary %s || author IS NULL) && (manufacturer LIKE binary %s || manufacturer IS NULL) && (carnumber LIKE binary %s || carnumber IS NULL) && indicate LIKE %s && (type LIKE %s || type IS NULL) && lang = %s && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordScaleorder_clearance . "%", "text"), GetSQLValueString("%" . $colsearch_RecordScaleorder_clearance . "%", "text"), GetSQLValueString("%" . $colauthor_RecordScaleorder_clearance . "%", "text"), GetSQLValueString("%" . $colmanufacturer_RecordScaleorder_clearance . "%", "text"), GetSQLValueString("%" . $colcarnumber_RecordScaleorder_clearance . "%", "text"), GetSQLValueString($colindicate_RecordScaleorder_clearance, "text"), GetSQLValueString($coltype_RecordScaleorder_clearance, "text"),GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"));*/

if($search_mode == 'sell'){
	$query_RecordScaleorder_clearance = sprintf("SELECT tb_o.title, erp_scalepricelist.startdate, erp_scalepricelist.enddate, erp_scalepricelist.price, erp_scalepricelist.mode, erp_scalepricelist.name, COUNT(tb_o.type) AS Count_Type, SUM(tb_o.Totalweight) AS Sum_Totalweight, SUM(tb_o.Minweight) AS Sum_Minweight, tb_o.code, tb_o.type, tb_o.bigtype, tb_o.Totalweight, tb_o.Minweight, tb_o.userid, tb_o.carnumber, tb_o.oserial, tb_o.wastecode, tb_o.postdate, tb_o.id, tb_o.lang FROM (SELECT * FROM erp_scaleorderclearancedetail WHERE lang = %s && userid=%s && postdate BETWEEN %s AND %s) AS tb_o LEFT OUTER JOIN erp_scalepricelist ON tb_o.code = erp_scalepricelist.code && tb_o.postdate BETWEEN erp_scalepricelist.startdate AND erp_scalepricelist.enddate + INTERVAL 1 DAY GROUP BY tb_o.type HAVING tb_o.postdate BETWEEN %s AND %s && (tb_o.title LIKE binary %s) && erp_scalepricelist.price > 0 $orderSql", GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString('%'.$colsearch_RecordScaleorder_clearance.'%', "text"));
}else if($search_mode == 'pay'){
	$query_RecordScaleorder_clearance = sprintf("SELECT tb_o.title, erp_scalepricelist.startdate, erp_scalepricelist.enddate, erp_scalepricelist.price, erp_scalepricelist.mode, erp_scalepricelist.name, COUNT(tb_o.type) AS Count_Type, SUM(tb_o.Totalweight) AS Sum_Totalweight, SUM(tb_o.Minweight) AS Sum_Minweight, tb_o.code, tb_o.type, tb_o.bigtype, tb_o.Totalweight, tb_o.Minweight, tb_o.userid, tb_o.carnumber, tb_o.oserial, tb_o.wastecode, tb_o.postdate, tb_o.id, tb_o.lang FROM (SELECT * FROM erp_scaleorderclearancedetail WHERE lang = %s && userid=%s && postdate BETWEEN %s AND %s) AS tb_o LEFT OUTER JOIN erp_scalepricelist ON tb_o.code = erp_scalepricelist.code && tb_o.postdate BETWEEN erp_scalepricelist.startdate AND erp_scalepricelist.enddate + INTERVAL 1 DAY GROUP BY tb_o.type HAVING tb_o.postdate BETWEEN %s AND %s && (tb_o.title LIKE binary %s) && erp_scalepricelist.price < 0 $orderSql", GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString('%'.$colsearch_RecordScaleorder_clearance.'%', "text"));
}else if($search_mode == 'free'){
	$query_RecordScaleorder_clearance = sprintf("SELECT tb_o.title, erp_scalepricelist.startdate, erp_scalepricelist.enddate, erp_scalepricelist.price, erp_scalepricelist.mode, erp_scalepricelist.name, COUNT(tb_o.type) AS Count_Type, SUM(tb_o.Totalweight) AS Sum_Totalweight, SUM(tb_o.Minweight) AS Sum_Minweight, tb_o.code, tb_o.type, tb_o.bigtype, tb_o.Totalweight, tb_o.Minweight, tb_o.userid, tb_o.carnumber, tb_o.oserial, tb_o.wastecode, tb_o.postdate, tb_o.id, tb_o.lang FROM (SELECT * FROM erp_scaleorderclearancedetail WHERE lang = %s && userid=%s && postdate BETWEEN %s AND %s) AS tb_o LEFT OUTER JOIN erp_scalepricelist ON tb_o.code = erp_scalepricelist.code && tb_o.postdate BETWEEN erp_scalepricelist.startdate AND erp_scalepricelist.enddate + INTERVAL 1 DAY GROUP BY tb_o.type HAVING tb_o.postdate BETWEEN %s AND %s && (tb_o.title LIKE binary %s) && erp_scalepricelist.price = 0 $orderSql", GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString('%'.$colsearch_RecordScaleorder_clearance.'%', "text"));
}else{
	$query_RecordScaleorder_clearance = sprintf("SELECT tb_o.title, erp_scalepricelist.startdate, erp_scalepricelist.enddate, erp_scalepricelist.price, erp_scalepricelist.mode, erp_scalepricelist.name, COUNT(tb_o.type) AS Count_Type, SUM(tb_o.Totalweight) AS Sum_Totalweight, SUM(tb_o.Minweight) AS Sum_Minweight, tb_o.code, tb_o.type, tb_o.bigtype, tb_o.Totalweight, tb_o.Minweight, tb_o.userid, tb_o.carnumber, tb_o.oserial, tb_o.wastecode, tb_o.postdate, tb_o.id, tb_o.lang FROM (SELECT * FROM erp_scaleorderclearancedetail WHERE lang = %s && userid=%s && postdate BETWEEN %s AND %s) AS tb_o LEFT OUTER JOIN erp_scalepricelist ON tb_o.code = erp_scalepricelist.code && tb_o.postdate BETWEEN erp_scalepricelist.startdate AND erp_scalepricelist.enddate + INTERVAL 1 DAY GROUP BY tb_o.type HAVING tb_o.postdate BETWEEN %s AND %s && (tb_o.title LIKE binary %s) $orderSql", GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString('%'.$colsearch_RecordScaleorder_clearance.'%', "text"));
}


if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScaleorder_clearance = mysqli_query($DB_Conn, $query_RecordScaleorder_clearance) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_clearance = mysqli_fetch_assoc($RecordScaleorder_clearance);
	$totalRows_RecordScaleorder_clearance = mysqli_num_rows($RecordScaleorder_clearance);
	
}else{
	//分頁
	$query_limit_RecordScaleorder_clearance = sprintf("%s LIMIT %d, %d", $query_RecordScaleorder_clearance, $startRow_RecordScaleorder_clearance, $maxRows_RecordScaleorder_clearance);
	$RecordScaleorder_clearance = mysqli_query($DB_Conn, $query_limit_RecordScaleorder_clearance) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_clearance = mysqli_fetch_assoc($RecordScaleorder_clearance);
	
	if (isset($_GET['totalRows_RecordScaleorder_clearance'])) {
	  $totalRows_RecordScaleorder_clearance = $_GET['totalRows_RecordScaleorder_clearance'];
	} else {
	  $all_RecordScaleorder_clearance = mysqli_query($DB_Conn, $query_RecordScaleorder_clearance);
	  $totalRows_RecordScaleorder_clearance = mysqli_num_rows($all_RecordScaleorder_clearance);
	}
	$totalPages_RecordScaleorder_clearance = ceil($totalRows_RecordScaleorder_clearance/$maxRows_RecordScaleorder_clearance)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScaleorder_clearance > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_scaleorder_clearance.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scaleorder_clearance.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_clearance['id'];
	$link_edit = "manage_scaleorder_clearance.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_clearance['id'];
	$link_start = "manage_scaleorder_clearance.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScaleorder_clearance["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScaleorder_clearance["id"];
	
  	//$dvalue['chk'] = "<input name='delScaleorder_clearance[]' type='checkbox' id='delScaleorder_clearance[]' value='".$row_RecordScaleorder_clearance["id"]."\'/>";
	
	$dvalue['title'] = $row_RecordScaleorder_clearance["title"];
	
	if($row_RecordScaleorder_clearance["notes1"] != ""){
		$dvalue['title'] .= "<div><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordScaleorder_clearance["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".$row_RecordScaleorder_clearance["notes1"]."</span></div>";
	}else{
		$dvalue['title'] .= "<div><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordScaleorder_clearance["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['bigtype'] = $row_RecordScaleorder_clearance["bigtype"];

	$dvalue['type'] = $row_RecordScaleorder_clearance["type"];
	
	if($row_RecordScaleorder_clearance["snumber"] != ""){
		$dvalue['snumber'] = "<span id=snumber_".$row_RecordScaleorder_clearance["id"]."' class='ed_v text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".$row_RecordScaleorder_clearance["snumber"]."</span>";
	}else{
		$dvalue['snumber'] = "<span id=snumber_".$row_RecordScaleorder_clearance["id"]."' class='ed_snumber editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	$dvalue['wastecode'] = $row_RecordScaleorder_clearance["wastecode"];
	
	$dvalue['Totalweight'] = $row_RecordScaleorder_clearance["Sum_Totalweight"];
	
	$dvalue['Minweight'] = $row_RecordScaleorder_clearance["Sum_Minweight"];
	
	$dvalue['Oriweight'] = $row_RecordScaleorder_clearance["Sum_Totalweight"] - $row_RecordScaleorder_clearance["Sum_Minweight"];
	
	$dvalue['manufacturer'] = $row_RecordScaleorder_clearance["manufacturer"];
	
	$dvalue['price'] = $row_RecordScaleorder_clearance["price"];
	
	if($row_RecordScaleorder_clearance['mode'] == '0')
	{
		$dvalue['allprice'] = ($row_RecordScaleorder_clearance["Sum_Totalweight"] - $row_RecordScaleorder_clearance["Sum_Minweight"])*$row_RecordScaleorder_clearance["price"];
	}else if($row_RecordScaleorder_clearance['mode'] == '1'){
		$dvalue['allprice'] = ($row_RecordScaleorder_clearance["price"] * $row_RecordScaleorder_clearance["Count_Type"]);
	}else{
		$dvalue['allprice'] = ($row_RecordScaleorder_clearance["Totalweight"] - $row_RecordScaleorder_clearance["Minweight"])*$row_RecordScaleorder_clearance["price"];
	}
	
	$dvalue['carnumber'] = $row_RecordScaleorder_clearance["carnumber"];
	
	$dvalue['people'] = $row_RecordScaleorder_clearance["people"];
	
	if($row_RecordScaleorder_clearance["bound"] == 'in') { $dvalue['bound'] = "入庫"; }
	if($row_RecordScaleorder_clearance["bound"] == 'out') { $dvalue['bound'] = "出庫"; }
	
	$dvalue['author'] = $row_RecordScaleorder_clearance["author"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScaleorder_clearance["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".$row_RecordScaleorder_clearance["sortid"]."</span>";
	
	if($row_RecordScaleorder_clearance["indicate"] == '1') {$row_RecordScaleorder_clearance["indicate"] = "公佈";}else{$row_RecordScaleorder_clearance["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScaleorder_clearance["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".$row_RecordScaleorder_clearance["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordScaleorder_clearance['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordScaleorder_clearance["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordScaleorder_clearance["id"]."' data-placement='top'>".$dt->format('Y-m')."</span>";
	
	
	if($row_RecordScaleorder_clearance['mode'] == '0')
	{
		$dvalue['notes'] = "";
	}else if($row_RecordScaleorder_clearance['mode'] == '1'){
		$dvalue['notes'] = $row_RecordScaleorder_clearance["Count_Type"] . "趟";
	}else{
		$dvalue['notes'] = "";
	}
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordScaleorder_clearance["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScaleorder_clearance = mysqli_fetch_assoc($RecordScaleorder_clearance)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScaleorder_clearance), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScaleorder_clearance);
?>
