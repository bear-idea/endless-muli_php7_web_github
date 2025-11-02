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

if(isset($_GET['aid'])){
	$search_aid = $_GET['aid'];
}else{
	$search_aid = "All";
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
        case 1;$orderSql = " ORDER BY title ".$order_dir;break;
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

$maxRows_RecordDfPage = $length;
$startRow_RecordDfPage = $start;

$colsearch_RecordDfPage = "%";
if (isset($DT_search)) {
  $colsearch_RecordDfPage = $DT_search;
}

//$colnamelang_RecordDfPage = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordDfPage = $_SESSION['lang'];
}

$colindicate_RecordDfPage = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordDfPage = $search_indicate;
}

$coluserid_RecordDfPage = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfPage = $w_userid;
}

$colaid_RecordDfPage = "-1";
if (isset($search_aid)) {
  $colaid_RecordDfPage = $search_aid;
}
$coltype1_RecordDfPage = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordDfPage = $_GET['type1'];
}
$coltype2_RecordDfPage = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordDfPage = $_GET['type2'];
}
$coltype3_RecordDfPage = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordDfPage = $_GET['type3'];
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_dfpage WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordDfPage, "int"),GetSQLValueString($colnamelang_RecordDfPage, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordDfPage = sprintf("SELECT * FROM demo_dfpage WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordDfPage, "text"), GetSQLValueString($colindicate_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"),GetSQLValueString($collang_RecordDfPage, "text"));

if($search_aid == "All") {		
	$query_RecordCount = sprintf("SELECT count(id) as sum, sum(home) as homesum FROM demo_dfpage WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"));
	$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
	$row_RecordCount = mysqli_fetch_assoc($RecordCount);
	
	
	$query_RecordDfPage = sprintf("SELECT * FROM demo_dfpage WHERE title LIKE %s && indicate LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordDfPage . "%", "text"), GetSQLValueString($colindicate_RecordDfPage, "text"),GetSQLValueString($collang_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"));
}else if(isset($search_aid)) {		
	$query_RecordCount = sprintf("SELECT count(id) as sum, sum(home) as homesum FROM demo_dfpage WHERE aid=%s && lang = %s && userid=%s",GetSQLValueString($colaid_RecordDfPage, "int"),GetSQLValueString($collang_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"));
	$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
	$row_RecordCount = mysqli_fetch_assoc($RecordCount);
	
	
	$query_RecordDfPage = sprintf("SELECT * FROM demo_dfpage WHERE aid=%s && title LIKE %s && indicate LIKE %s && lang = %s && userid=%s $orderSql",GetSQLValueString($colaid_RecordDfPage, "int"), GetSQLValueString("%" . $colsearch_RecordDfPage . "%", "text"), GetSQLValueString($colindicate_RecordDfPage, "text"),GetSQLValueString($collang_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"));
}




if($draw == "" || $length == '-1') {
    //無分頁
	$RecordDfPage = mysqli_query($DB_Conn, $query_RecordDfPage) or die(mysqli_error($DB_Conn));
	$row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage);
	$totalRows_RecordDfPage = mysqli_num_rows($RecordDfPage);
	
}else{
	//分頁
	$query_limit_RecordDfPage = sprintf("%s LIMIT %d, %d", $query_RecordDfPage, $startRow_RecordDfPage, $maxRows_RecordDfPage);
	$RecordDfPage = mysqli_query($DB_Conn, $query_limit_RecordDfPage) or die(mysqli_error($DB_Conn));
	$row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage);
	
	if (isset($_GET['totalRows_RecordDfPage'])) {
	  $totalRows_RecordDfPage = $_GET['totalRows_RecordDfPage'];
	} else {
	  $all_RecordDfPage = mysqli_query($DB_Conn, $query_RecordDfPage);
	  $totalRows_RecordDfPage = mysqli_num_rows($all_RecordDfPage);
	}
	$totalPages_RecordDfPage = ceil($totalRows_RecordDfPage/$maxRows_RecordDfPage)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordDfPage > '0') { ?>
<?php do { ?>
  <?php 
  
    if($search_aid == "All") {	
		$link_add = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordDfPage["aid"];
		$link_copy = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfPage['id']."&amp;aid=".$row_RecordDfPage["aid"];
		$link_edit = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfPage['id']."&amp;aid=".$row_RecordDfPage["aid"];
		$link_start = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=startpage_sub&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordDfPage["aid"];
	}else{
		$link_add = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$search_aid;
		$link_copy = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfPage['id']."&amp;aid=".$search_aid;
		$link_edit = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfPage['id']."&amp;aid=".$search_aid;
		$link_start = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=startpage_sub&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordDfPage["aid"];

	}
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordDfPage["id"].",event)'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordDfPage["id"];
  	$dvalue['chk'] = "<input name='delDfPage[]' type='checkbox' id='delDfPage[]' value='".$row_RecordDfPage["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordDfPage["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordDfPage["id"]."' data-placement='top'>".$row_RecordDfPage["title"]."</span>";
	if($row_RecordCount['homesum'] == '0') { $HaveSetStartPage = '(此項目必須設定一個)'; }else{  $HaveSetStartPage = ''; }
	if($row_RecordDfPage['home'] == 1){$dvalue['title'] = $dvalue['title']."<a href='".$link_start."' class='btn btn-warning btn-xs pull-right'><i class='fa fa-check-circle'></i> 起始頁".$HaveSetStartPage."<a>";}else{$dvalue['title'] = $dvalue['title']."<a href='".$link_start."' class='btn btn-grey btn-xs pull-right'><i class='fa fa-circle'></i> 起始頁".$HaveSetStartPage."<a>";}
	
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordDfType = sprintf("SELECT title FROM demo_dftype WHERE id = %s && userid=%s", GetSQLValueString($row_RecordDfPage["aid"], "int"),GetSQLValueString($w_userid, "int"));
	$RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType) or die(mysqli_error($DB_Conn));
	$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
	$totalRows_RecordDfType = mysqli_num_rows($RecordDfType);

	$dvalue['typetitle'] = $row_RecordDfType['title'];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordDfPage["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordDfPage["id"]."' data-placement='top'>".$row_RecordDfPage["sortid"]."</span>";
	if($row_RecordDfPage["indicate"] == '1') {$row_RecordDfPage["indicate"] = "公佈";}else{$row_RecordDfPage["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordDfPage["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordDfPage["id"]."' data-placement='top'>".$row_RecordDfPage["indicate"]."</span>";;
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordDfPage["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordDfPage), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordDfPage);
?>
