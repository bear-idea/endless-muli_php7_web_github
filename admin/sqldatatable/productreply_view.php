<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php //require_once('inc_setting.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
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
$search_post_id = $_GET['post_id'];

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
        //case 3;$orderSql = " ORDER BY author ".$order_dir;break;
        case 2;$orderSql = " ORDER BY postdate ".$order_dir;break;
        //case 5;$orderSql = " ORDER BY indicate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY rid DESC";
}else{
	$orderSql = $orderSql . ",rid DESC";
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

$maxRows_RecordProductReply = $length;
$startRow_RecordProductReply = $start;

$colsearch_RecordProductReply = "%";
if (isset($DT_search)) {
  $colsearch_RecordProductReply = $DT_search;
}

//$colnamelang_RecordProductReply = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProductReply = $_SESSION['lang'];
}

$colindicate_RecordProductReply = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordProductReply = $search_indicate;
}

$coluserid_RecordProductReply = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductReply = $w_userid;
}

$colpost_id_RecordProductReply = "-1";
if (isset($search_post_id)) {
  $colpost_id_RecordProductReply = $search_post_id;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_productpost WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordProductReply, "int"),GetSQLValueString($colnamelang_RecordProductReply, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordProductReply = sprintf("SELECT * FROM demo_productpost WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordProductReply, "text"), GetSQLValueString($colindicate_RecordProductReply, "text"),GetSQLValueString($coluserid_RecordProductReply, "int"),GetSQLValueString($collang_RecordProductReply, "text"));

$query_RecordCount = sprintf("SELECT count(rid) as sum FROM demo_productreply WHERE lang = %s && userid=%s && pid=%s",GetSQLValueString($collang_RecordProductReply, "text"),GetSQLValueString($coluserid_RecordProductReply, "int"),GetSQLValueString($colpost_id_RecordProductReply, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordProductReply = sprintf("SELECT * FROM demo_productreply WHERE postdate LIKE %s && lang = %s && userid=%s && pid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordProductReply . "%", "text"),GetSQLValueString($collang_RecordProductReply, "text"),GetSQLValueString($coluserid_RecordProductReply, "int"),GetSQLValueString($colpost_id_RecordProductReply, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordProductReply = mysqli_query($DB_Conn, $query_RecordProductReply) or die(mysqli_error($DB_Conn));
	$row_RecordProductReply = mysqli_fetch_assoc($RecordProductReply);
	$totalRows_RecordProductReply = mysqli_num_rows($RecordProductReply);
	
}else{
	//分頁
	$query_limit_RecordProductReply = sprintf("%s LIMIT %d, %d", $query_RecordProductReply, $startRow_RecordProductReply, $maxRows_RecordProductReply);
	$RecordProductReply = mysqli_query($DB_Conn, $query_limit_RecordProductReply) or die(mysqli_error($DB_Conn));
	$row_RecordProductReply = mysqli_fetch_assoc($RecordProductReply);
	
	if (isset($_GET['totalRows_RecordProductReply'])) {
	  $totalRows_RecordProductReply = $_GET['totalRows_RecordProductReply'];
	} else {
	  $all_RecordProductReply = mysqli_query($DB_Conn, $query_RecordProductReply);
	  $totalRows_RecordProductReply = mysqli_num_rows($all_RecordProductReply);
	}
	$totalPages_RecordProductReply = ceil($totalRows_RecordProductReply/$maxRows_RecordProductReply)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordProductReply > '0') { ?>
<?php do { ?>
  <?php
    // 取得商品資料 
    $colname_RecordProduct = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $colname_RecordProduct = $_SESSION['lang'];
	}
	$colid_RecordProduct = "-1";
	if (isset($row_RecordProductReply['pid'])) {
	  $colid_RecordProduct = $row_RecordProductReply['pid'];
	}
	$coluserid_RecordProduct = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordProduct = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE lang=%s && id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordProduct, "text"),GetSQLValueString($colid_RecordProduct, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
	$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
	$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
	$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
  ?>
  <?php 

    $link_add = "inner_product.php?wshop=".$wshop."&amp;Opt=postaddpage&amp;lang=".$_SESSION['lang']."&amp;post_id=".$row_RecordProductReply['pid']."&amp;pd_id=".$row_RecordProductReply['pid'];
	$link_copy = "inner_product.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProductReply['rid'];
	$link_edit = "inner_product.php?wshop=".$wshop."&amp;Opt=replyeditpage&amp;lang=".$_SESSION['lang']."&amp;rid=".$row_RecordProductReply['rid']."&amp;post_id=".$row_RecordProductReply['pid']."&amp;pd_id=".$row_RecordProductReply['pid'];
	
	$link_reply = "inner_product.php?wshop=".$wshop."&amp;Opt=replyaddpage&amp;lang=".$_SESSION['lang']."&amp;post_id=".$row_RecordProductReply['pid']."&amp;pd_id=".$row_RecordProductReply['pid'];

	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_reply = "<a href='".$link_reply."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 回應</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordProductReply['rid'].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordProductReply['rid'];

  	$dvalue['chk'] = "<input name='delProductReply[]' type='checkbox' id='delProductReply[]' value='".$row_RecordProductReply['rid']."\'/>";
	
	$dvalue['title'] = $row_RecordProduct["name"];
	
	if($row_RecordProductReply['rid'] != "") {
		$dvalue['replay'] = "已回覆";
	}else{
		$dvalue['replay'] = "未回覆";
	}
                            
	$dvalue['content'] = "<span id='content_".$row_RecordProductReply['rid']."' class='ed_content' data-type='text' data-pk='".$row_RecordProductReply['rid']."' data-placement='top'>".$row_RecordProductReply["content"]."</span>";
	
	$dvalue['author'] = "<span class='label label-danger'><span id='author_".$row_RecordProductReply['rid']."' class='ed_author' data-type='text' data-pk='".$row_RecordProductReply['rid']."' data-placement='top'>".$row_RecordProductReply["author"]."</span></span>";
	
	$dt = new DateTime($row_RecordProductReply['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordProductReply['rid']."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordProductReply['rid']."' data-placement='top'>".$dt->format('Y-m-d')."</span>";

	$dvalue['action'] = "<div class='btn-group'>".$but_reply.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordProductReply["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordProductReply = mysqli_fetch_assoc($RecordProductReply)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordProductReply), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordProductReply);
?>
