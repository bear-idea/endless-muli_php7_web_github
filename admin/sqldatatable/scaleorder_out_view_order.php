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

$search_people = $_POST['search_people'];
$search_author = $_POST['search_author'];
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
        case 1;$orderSql = " ORDER BY oserial ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY title ".$order_dir;break;
        case 3;$orderSql = " ORDER BY driver ".$order_dir;break;
		case 4;$orderSql = " ORDER BY carnumber ".$order_dir;break;
		case 5;$orderSql = " ORDER BY warehouse ".$order_dir;break;
		case 6;$orderSql = " ORDER BY author ".$order_dir;break;
		case 7;$orderSql = " ORDER BY postdate ".$order_dir;break;
		case 8;$orderSql = " ORDER BY arrivals ".$order_dir;break;
		case 9;$orderSql = " ORDER BY manufacturer ".$order_dir;break;
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

$coltype_RecordScaleorder_in = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordScaleorder_in = $search_type;
}

$colpeople_RecordScaleorder_in = "%";
if (isset($search_people) && $search_people != "") {
  $colpeople_RecordScaleorder_in = $search_people;
}

$colauthor_RecordScaleorder_in = "%";
if (isset($search_author) && $search_author != "") {
  $colauthor_RecordScaleorder_in = $search_author;
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

$query_RecordCount = sprintf("SELECT count(oid) as sum FROM erp_scaleorderout WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScaleorder_in = sprintf("SELECT * FROM erp_scaleorderout WHERE (oserial LIKE binary %s) && (author LIKE binary %s || author IS NULL) && lang = %s && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordScaleorder_in . "%", "text"), GetSQLValueString("%" . $colauthor_RecordScaleorder_in . "%", "text"),GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($colstartdate_RecordScaleorder_in, "date"),GetSQLValueString($colenddate_RecordScaleorder_in, "date"));

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

$coluserid_RecordSystemConfigOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfigOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfigOtr, "int"));
$RecordSystemConfigOtr = mysqli_query($DB_Conn, $query_RecordSystemConfigOtr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigOtr = mysqli_fetch_assoc($RecordSystemConfigOtr);
$totalRows_RecordSystemConfigOtr = mysqli_num_rows($RecordSystemConfigOtr);
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScaleorder_in > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_view = "manage_scale_index_detailed.php?wshop=".$wshop."&amp;Serial=".$row_RecordScaleorder_in["oserial"]."&amp;lang=".$_SESSION['lang'];
    $link_add = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=outaddpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_in['oid'];
	$link_edit = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=outeditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_in['oid'];
	$link_start = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    
	$link_floorscale = "uplod_floorscale.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 地磅單 */
	$link_floorscale2 = "uplod_floorscale2.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 五金地磅單 */
	$link_scalesnumber = "uplod_scalesnumber.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 聯單照片 */
	$link_scalesnumber2 = "uplod_scalesnumber2.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 補充聯單照片 */
	$link_scalesnumber8 = "uplod_scalesnumber8.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 聯單照片(應付) */
	$link_scalesnumber9 = "uplod_scalesnumber9.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 聯單照片(無償) */
	$link_scalesnumber7 = "uplod_scalesnumber7.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 聯單照片(應收) */
	$link_carnumber = "uplod_carnumber.php?id_edit=".$row_RecordScaleorder_in['oid']."&amp;lang=".$_SESSION['lang']; /* 載運照片 */
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScaleorder_in["oid"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
	if($row_RecordScaleorder_in["pic2"] == "") {
	    $but_floorscale = "<a href='".$link_floorscale."' class='btn btn-xs bg-green-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 地磅單</a>";
	}else{
		$but_floorscale = "<a href='".$link_floorscale."' class='btn btn-xs bg-gradient-green text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 地磅單</a>";
	}
	
	if($row_RecordScaleorder_in["pic5"] == "") {
	    $but_floorscale2 = "<a href='".$link_floorscale2."' class='btn btn-xs bg-green-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 五金地磅單</a>";
	}else{
		$but_floorscale2 = "<a href='".$link_floorscale2."' class='btn btn-xs bg-gradient-green text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 五金地磅單</a>";
	}
	
	if($row_RecordScaleorder_in["pic1"] == "") {
	    $but_scalesnumber = "<a href='".$link_scalesnumber."' class='btn btn-xs bg-blue-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 主要聯單</a>";
	}else{
		$but_scalesnumber = "<a href='".$link_scalesnumber."' class='btn btn-xs bg-gradient-blue text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 主要聯單</a>";
	}
	
	if($row_RecordScaleorder_in["pic3"] == "") {
	    $but_scalesnumber2 = "<a href='".$link_scalesnumber2."' class='btn btn-xs bg-blue-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 補充聯單</a>";
	}else{
		$but_scalesnumber2 = "<a href='".$link_scalesnumber2."' class='btn btn-xs bg-gradient-blue text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 補充聯單</a>";
	}
	
	if($row_RecordScaleorder_in["pic8"] == "") {
	    $but_scalesnumber8 = "<a href='".$link_scalesnumber8."' class='btn btn-xs bg-orange-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 聯單(應付)</a>";
	}else{
		$but_scalesnumber8 = "<a href='".$link_scalesnumber8."' class='btn btn-xs bg-gradient-orange text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 聯單(應付)</a>";
	}
	
	if($row_RecordScaleorder_in["pic9"] == "") {
	    $but_scalesnumber9 = "<a href='".$link_scalesnumber9."' class='btn btn-xs bg-orange-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 聯單(無償)</a>";
	}else{
		$but_scalesnumber9 = "<a href='".$link_scalesnumber9."' class='btn btn-xs bg-gradient-orange text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 聯單(無償)</a>";
	}
	
	if($row_RecordScaleorder_in["pic7"] == "") {
	    $but_scalesnumber7 = "<a href='".$link_scalesnumber7."' class='btn btn-xs bg-orange-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 聯單(應收)</a>";
	}else{
		$but_scalesnumber7 = "<a href='".$link_scalesnumber7."' class='btn btn-xs bg-gradient-orange text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 聯單(應收)</a>";
	}
	
	if($row_RecordScaleorder_in["pic4"] == "") {
	    $but_carnumber = "<a href='".$link_carnumber."' class='btn btn-xs bg-pink-transparent-4 text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 載運照片</a>";
	}else{
		$but_carnumber = "<a href='".$link_carnumber."' class='btn btn-xs bg-gradient-pink text-white colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 載運照片</a>";
	}

	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScaleorder_in["oid"];
	
  	$dvalue['chk'] = "<input name='delScaleorder_in[]' type='checkbox' id='delScaleorder_in[]' value='".$row_RecordScaleorder_in["oid"]."\'/>";
	
	$dvalue['oserial'] = "<a href='".$link_view."' class='btn btn-xs btn-link colorbox_iframe_cd' style='text-align:center'><i class='fa fa-link'></i> ".$row_RecordScaleorder_in["oserial"]."</a>";
	if($row_RecordScaleorder_in["notes1"] != ""){
		$dvalue['oserial'] .= "<div class='m-t-5'><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordScaleorder_in["oid"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["notes1"]."</span></div>";
	}else{
		$dvalue['oserial'] .= "<div class='m-t-5'><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordScaleorder_in["oid"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	if($row_RecordScaleorder_in["carnumok"] != ""){
		$dvalue['oserial'] .= "<div class='m-t-5'><span class='label label-success'>放行單</span> <span id=carnumok_".$row_RecordScaleorder_in["oid"]."' class='ed_carnumok text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["carnumok"]."</span></div>";
	}else{
		$dvalue['oserial'] .= "<div class='m-t-5'><span class='label label-success'>放行單</span> <span id=carnumok_".$row_RecordScaleorder_in["oid"]."' class='ed_carnumok editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	if($row_RecordScaleorder_in["bigweight"] != ""){
		$dvalue['oserial'] .= "<div class='m-t-5'><span class='label label-pink'>玉門淨重</span> <span id=bigweight_".$row_RecordScaleorder_in["oid"]."' class='ed_bigweight text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["bigweight"]."</span></div>";
	}else{
		$dvalue['oserial'] .= "<div class='m-t-5'><span class='label label-pink'>玉門淨重</span> <span id=bigweight_".$row_RecordScaleorder_in["oid"]."' class='ed_bigweight editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span></div>";
	}

    $dvalue['snumber'] = "<div class='clearfix'></div>";
	
    if($row_RecordScaleorder_in["snumber"] != ""){
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["snumber"]."</span>";
		$dvalue['snumber'] .= "<span class='label label-primary pull-right'>主要 <i class='fa fa-info-circle text-white' data-original-title='此聯單號碼不區分應收、應付、無償' data-toggle='tooltip' data-placement='top'></i></span>";
	}else{
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span>";
		$dvalue['snumber'] .= "<span class='label label-primary pull-right'>主要 <i class='fa fa-info-circle text-white' data-original-title='此聯單號碼不區分應收、應付、無償' data-toggle='tooltip' data-placement='top'></i></span>";
	}
	
	$dvalue['snumber'] .= "<div class='clearfix'></div>";
	
	if($row_RecordScaleorder_in["snumber2"] != ""){
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber2_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber2' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["snumber2"]."</span>";
		$dvalue['snumber'] .= "<span class='label label-success pull-right'>補充 <i class='fa fa-info-circle text-white' data-original-title='此聯單號碼為此出貨單需要多填寫聯單號碼時可作為補充之用' data-toggle='tooltip' data-placement='top'></i></span>";
	}else{
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber2_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber2 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span>";
		$dvalue['snumber'] .= "<span class='label label-success pull-right'>補充 <i class='fa fa-info-circle text-white' data-original-title='此聯單號碼為此出貨單需要多填寫聯單號碼時可作為補充之用' data-toggle='tooltip' data-placement='top'></i></span>";
	}
	
	$dvalue['snumber'] .= "<div class='clearfix'></div>";
	
	if($row_RecordScaleorder_in["snumber8"] != ""){
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber8_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber8' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["snumber8"]."</span>";
		$dvalue['snumber'] .= "<span class='label label-warning pull-right'>應付 <i class='fa fa-info-circle text-white' data-original-title='若出貨單含我方付費，對方取款之物料則需填寫' data-toggle='tooltip' data-placement='top'></i></span>";
	}else{
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber8_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber8 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span>";
		$dvalue['snumber'] .= "<span class='label label-warning pull-right'>應付 <i class='fa fa-info-circle text-white' data-original-title='若出貨單含我方付費，對方取款之物料則需填寫' data-toggle='tooltip' data-placement='top'></i></span>";
	}
	
	$dvalue['snumber'] .= "<div class='clearfix'></div>";
	
	if($row_RecordScaleorder_in["snumber9"] != ""){
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber9_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber9' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["snumber9"]."</span>";
		$dvalue['snumber'] .= "<span class='label label-secondary pull-right'>無償 <i class='fa fa-info-circle text-white' data-original-title='若出貨單含不須付費之物料則需填寫' data-toggle='tooltip' data-placement='top'></i></span>";
	}else{
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber9_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber9 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span>";
		$dvalue['snumber'] .= "<span class='label label-secondary pull-right'>無償 <i class='fa fa-info-circle text-white' data-original-title='若出貨單含不須付費之物料則需填寫' data-toggle='tooltip' data-placement='top'></i></span>";
	}
	
	$dvalue['snumber'] .= "<div class='clearfix'></div>";
	
	if($row_RecordScaleorder_in["snumber9"] != ""){
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber7_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber7' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["snumber7"]."</span>";
		$dvalue['snumber'] .= "<span class='label label-lime pull-right'>應收 <i class='fa fa-info-circle text-white' data-original-title='若出貨單含對方付費，我方收款之物料則需填寫' data-toggle='tooltip' data-placement='top'></i></span>";
	}else{
		$dvalue['snumber'] .= $row_RecordSystemConfigOtr['erpcompanyordernum'] ."-". "<span id='snumber7_".$row_RecordScaleorder_in["oid"]."' class='ed_snumber7 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".'Empty'."</span>";
		$dvalue['snumber'] .= "<span class='label label-lime pull-right'>應收 <i class='fa fa-info-circle text-white' data-original-title='若出貨單含對方付費，我方收款之物料則需填寫' data-toggle='tooltip' data-placement='top'></i></span>";
	}
	
	$dvalue['driver'] = $row_RecordScaleorder_in["driver"];
	
	$dvalue['carnumber'] = $row_RecordScaleorder_in["carnumber"];

	$dvalue['warehouse'] = $row_RecordScaleorder_in["warehouse"];
	
	$dvalue['author'] = $row_RecordScaleorder_in["author"];
	
	$dvalue['arrivals'] = $row_RecordScaleorder_in["arrivals"];
	
	$dvalue['manufacturer'] = $row_RecordScaleorder_in["manufacturer"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScaleorder_in["oid"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["sortid"]."</span>";
	
	if($row_RecordScaleorder_in["indicate"] == '1') {$row_RecordScaleorder_in["indicate"] = "公佈";}else{$row_RecordScaleorder_in["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScaleorder_in["oid"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScaleorder_in["oid"]."' data-placement='top'>".$row_RecordScaleorder_in["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordScaleorder_in['postdate']); 
	$dvalue['postdate'] = $dt->format('Y-m-d H:i A');
	
	$dvalue['action'] = "<div class='btn-group'>".$but_view.$but_add.$but_edit.$but_del.$but_more."</div>";
	
	$dvalue['action'] .= "<div class='btn-group'>".$but_floorscale.$but_floorscale2."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_scalesnumber.$but_scalesnumber2."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_scalesnumber8.$but_scalesnumber9."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_scalesnumber7.$but_carnumber."</div>";
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
