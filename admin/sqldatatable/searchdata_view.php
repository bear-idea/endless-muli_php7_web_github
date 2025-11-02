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
$search_mode = $_POST['search_mode'];

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
        case 2;$orderSql = " ORDER BY mail ".$order_dir;break;
		case 3;$orderSql = " ORDER BY type ".$order_dir;break;
        case 4;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 5;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 6;$orderSql = " ORDER BY mode ".$order_dir;break;
		case 7;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordSearchdata = $length;
$startRow_RecordSearchdata = $start;

$colsearch_RecordSearchdata = "%";
if (isset($DT_search)) {
  $colsearch_RecordSearchdata = $DT_search;
}

//$colnamelang_RecordSearchdata = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSearchdata = $_SESSION['lang'];
}

$colindicate_RecordSearchdata = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordSearchdata = $search_indicate;
}

$colmode_RecordSearchdata = "%";
if (isset($search_mode) && $search_mode != "") {
  $colmode_RecordSearchdata = $search_mode;
}

$coltype_RecordSearchdata = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordSearchdata = $search_type;
}

$coluserid_RecordSearchdata = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdata = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM mail_searchdata WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordSearchdata, "int"),GetSQLValueString($colnamelang_RecordSearchdata, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordSearchdata = sprintf("SELECT * FROM mail_searchdata WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordSearchdata, "text"), GetSQLValueString($colindicate_RecordSearchdata, "text"),GetSQLValueString($coluserid_RecordSearchdata, "int"),GetSQLValueString($collang_RecordSearchdata, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM mail_searchdata WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordSearchdata, "text"),GetSQLValueString($coluserid_RecordSearchdata, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordSearchdata = sprintf("SELECT * FROM mail_searchdata WHERE (title LIKE %s || mail LIKE %s) && indicate LIKE %s && mode LIKE %s && type LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordSearchdata . "%", "text"), GetSQLValueString("%" . $colsearch_RecordSearchdata . "%", "text"), GetSQLValueString($colindicate_RecordSearchdata, "text"), GetSQLValueString($colmode_RecordSearchdata, "text"), GetSQLValueString($coltype_RecordSearchdata, "text"),GetSQLValueString($collang_RecordSearchdata, "text"),GetSQLValueString($coluserid_RecordSearchdata, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordSearchdata = mysqli_query($DB_Conn, $query_RecordSearchdata) or die(mysqli_error($DB_Conn));
	$row_RecordSearchdata = mysqli_fetch_assoc($RecordSearchdata);
	$totalRows_RecordSearchdata = mysqli_num_rows($RecordSearchdata);
	
}else{
	//分頁
	$query_limit_RecordSearchdata = sprintf("%s LIMIT %d, %d", $query_RecordSearchdata, $startRow_RecordSearchdata, $maxRows_RecordSearchdata);
	$RecordSearchdata = mysqli_query($DB_Conn, $query_limit_RecordSearchdata) or die(mysqli_error($DB_Conn));
	$row_RecordSearchdata = mysqli_fetch_assoc($RecordSearchdata);
	
	if (isset($_GET['totalRows_RecordSearchdata'])) {
	  $totalRows_RecordSearchdata = $_GET['totalRows_RecordSearchdata'];
	} else {
	  $all_RecordSearchdata = mysqli_query($DB_Conn, $query_RecordSearchdata);
	  $totalRows_RecordSearchdata = mysqli_num_rows($all_RecordSearchdata);
	}
	$totalPages_RecordSearchdata = ceil($totalRows_RecordSearchdata/$maxRows_RecordSearchdata)-1;
}

$colname_RecordSearchdataListType = "zh-tw";
if (isset($_SESSION["lang"])) {
  $colname_RecordSearchdataListType = $_SESSION["lang"];
}
$coluserid_RecordSearchdataListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdataListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSearchdataListType = sprintf("SELECT * FROM mail_searchdataitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordSearchdataListType, "text"),GetSQLValueString($coluserid_RecordSearchdataListType, "int"));
$RecordSearchdataListType = mysqli_query($DB_Conn, $query_RecordSearchdataListType) or die(mysqli_error($DB_Conn));
$row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
$totalRows_RecordSearchdataListType = mysqli_num_rows($RecordSearchdataListType);

?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordSearchdata > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_searchdata.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_searchdata.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordSearchdata['id'];
	$link_edit = "manage_searchdata.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordSearchdata['id'];
	$link_start = "manage_searchdata.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordSearchdata["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	$but_blacklist = "<a href='".$link_del."' class='btn btn-xs btn-dark' style='text-align:center' onclick='add_datatables_blacklist(".$row_RecordSearchdata["id"].",event);'><i class='fa fa-plus'></i> 加入黑名單</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordSearchdata["id"];
	
	if($row_RecordSearchdata["mode"] == '1') {
		$row_RecordSearchdata["mode"] = "自傳 E-mail";
	}else if($row_RecordSearchdata["mode"] == '0'){
		$row_RecordSearchdata["mode"] = "搜尋 E-mail";
	}
	$dvalue['mode'] = $row_RecordSearchdata["mode"];
	
  	//$dvalue['chk'] = "<input name='delSearchdata[]' type='checkbox' id='delSearchdata[]' value='".$row_RecordSearchdata["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordSearchdata["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordSearchdata["id"]."' data-placement='top'>".$row_RecordSearchdata["title"]."</span>";
	
	$pagelink = "//" . $row_RecordSearchdata["link"];
	
	$dvalue['title'] .= "<div>"."<a href='$pagelink' class='btn btn-link btn-xs'>".$pagelink."</a>"."</div>";
	
	
	do {
		
	if (!(strcmp($row_RecordSearchdataListType['item_id'], $row_RecordSearchdata['type']))) {$row_RecordSearchdata["type"] = $row_RecordSearchdataListType["itemname"];}
		
	$dvalue['type'] = "<span id='type_".$row_RecordSearchdata["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordSearchdata["id"]."' data-placement='top'>".$row_RecordSearchdata["type"]."</span>";
	} while ($row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType));
  $rows = mysqli_num_rows($RecordSearchdataListType);
  if($rows > 0) {
      mysqli_data_seek($RecordSearchdataListType, 0);
	  $row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
  }
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordSearchdata["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordSearchdata["id"]."' data-placement='top'>".$row_RecordSearchdata["sortid"]."</span>";
	
	$dvalue['mail'] = "<span id='mail_".$row_RecordSearchdata["id"]."' class='ed_mail' data-type='text' data-pk='".$row_RecordSearchdata["id"]."' data-placement='top'>".$row_RecordSearchdata["mail"]."</span>";
	
	if($row_RecordSearchdata["indicate"] == '1') {$row_RecordSearchdata["indicate"] = "公佈";}else{$row_RecordSearchdata["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordSearchdata["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordSearchdata["id"]."' data-placement='top'>".$row_RecordSearchdata["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordSearchdata['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordSearchdata["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordSearchdata["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_blacklist.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordSearchdata["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordSearchdata = mysqli_fetch_assoc($RecordSearchdata)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordSearchdata), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordSearchdata);

mysqli_free_result($RecordSearchdataListType);
?>
