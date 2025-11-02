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

$maxRows_RecordArticle = $length;
$startRow_RecordArticle = $start;

$colsearch_RecordArticle = "%";
if (isset($DT_search)) {
  $colsearch_RecordArticle = $DT_search;
}

//$colnamelang_RecordArticle = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordArticle = $_SESSION['lang'];
}

$colindicate_RecordArticle = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordArticle = $search_indicate;
}
$coltype1_RecordArticle = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordArticle = $search_type1;
}
$coltype2_RecordArticle = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordArticle = $search_type2;
}
$coltype3_RecordArticle = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordArticle = $search_type3;
}

$coluserid_RecordArticle = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticle = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_article WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordArticle, "int"),GetSQLValueString($colnamelang_RecordArticle, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordArticle = sprintf("SELECT * FROM demo_article WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordArticle, "text"), GetSQLValueString($colindicate_RecordArticle, "text"),GetSQLValueString($coluserid_RecordArticle, "int"),GetSQLValueString($collang_RecordArticle, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum, sum(home) as homesum FROM demo_article WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordArticle, "text"),GetSQLValueString($coluserid_RecordArticle, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordArticle = sprintf("SELECT * FROM demo_article WHERE title LIKE %s && indicate LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordArticle . "%", "text"), GetSQLValueString($colindicate_RecordArticle, "text"),GetSQLValueString($coltype1_RecordArticle, "text"),GetSQLValueString($coltype2_RecordArticle, "text"),GetSQLValueString($coltype3_RecordArticle, "text"),GetSQLValueString($collang_RecordArticle, "text"),GetSQLValueString($coluserid_RecordArticle, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordArticle = mysqli_query($DB_Conn, $query_RecordArticle) or die(mysqli_error($DB_Conn));
	$row_RecordArticle = mysqli_fetch_assoc($RecordArticle);
	$totalRows_RecordArticle = mysqli_num_rows($RecordArticle);
	
}else{
	//分頁
	$query_limit_RecordArticle = sprintf("%s LIMIT %d, %d", $query_RecordArticle, $startRow_RecordArticle, $maxRows_RecordArticle);
	$RecordArticle = mysqli_query($DB_Conn, $query_limit_RecordArticle) or die(mysqli_error($DB_Conn));
	$row_RecordArticle = mysqli_fetch_assoc($RecordArticle);
	
	if (isset($_GET['totalRows_RecordArticle'])) {
	  $totalRows_RecordArticle = $_GET['totalRows_RecordArticle'];
	} else {
	  $all_RecordArticle = mysqli_query($DB_Conn, $query_RecordArticle);
	  $totalRows_RecordArticle = mysqli_num_rows($all_RecordArticle);
	}
	$totalPages_RecordArticle = ceil($totalRows_RecordArticle/$maxRows_RecordArticle)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordArticle > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_article.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_article.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordArticle['id'];
	$link_edit = "manage_article.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordArticle['id'];
	$link_start = "manage_article.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordArticle["id"].",event)'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordArticle["id"];
  	$dvalue['chk'] = "<input name='delArticle[]' type='checkbox' id='delArticle[]' value='".$row_RecordArticle["id"]."\'/>";
	$dvalue['title'] = "<span id='title_".$row_RecordArticle["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordArticle["id"]."' data-placement='top'>".$row_RecordArticle["title"]."</span>";
	if($row_RecordCount['homesum'] == '0') { $HaveSetStartPage = '(此項目必須設定一個)'; }else{  $HaveSetStartPage = ''; }
	if($row_RecordArticle['home'] == 1){$dvalue['title'] = $dvalue['title']."<a href='".$link_start."' class='btn btn-warning btn-xs pull-right'><i class='fa fa-check-circle'></i> 起始頁".$HaveSetStartPage."<a>";}else{$dvalue['title'] = $dvalue['title']."<a href='".$link_start."' class='btn btn-grey btn-xs pull-right'><i class='fa fa-circle'></i> 起始頁".$HaveSetStartPage."<a>";}
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordArticle["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordArticle["id"]."' data-placement='top'>".$row_RecordArticle["sortid"]."</span>";
	if($row_RecordArticle["indicate"] == '1') {$row_RecordArticle["indicate"] = "公佈";}else{$row_RecordArticle["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordArticle["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordArticle["id"]."' data-placement='top'>".$row_RecordArticle["indicate"]."</span>";;
	$dvalue['action'] = "<div class='btn-group'>".$but_copy.$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordArticle["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordArticle = mysqli_fetch_assoc($RecordArticle)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordArticle), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordArticle);
?>
