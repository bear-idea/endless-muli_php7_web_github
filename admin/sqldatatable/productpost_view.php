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
        case 3;$orderSql = " ORDER BY demo_productpost.author ".$order_dir;break;
        case 4;$orderSql = " ORDER BY demo_productpost.postdate ".$order_dir;break;
        //case 5;$orderSql = " ORDER BY indicate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY demo_productpost.id DESC";
}else{
	$orderSql = $orderSql . ",demo_productpost.id DESC";
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

$maxRows_RecordProductPost = $length;
$startRow_RecordProductPost = $start;

$colsearch_RecordProductPost = "%";
if (isset($DT_search)) {
  $colsearch_RecordProductPost = $DT_search;
}

//$colnamelang_RecordProductPost = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProductPost = $_SESSION['lang'];
}

$colindicate_RecordProductPost = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordProductPost = $search_indicate;
}

$coluserid_RecordProductPost = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductPost = $w_userid;
}

$coltype1_RecordProductPost = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordProductPost = $search_type1;
}
$coltype2_RecordProductPost = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordProductPost = $search_type2;
}
$coltype3_RecordProductPost = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordProductPost = $search_type3;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_productpost WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordProductPost, "int"),GetSQLValueString($colnamelang_RecordProductPost, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordProductPost = sprintf("SELECT * FROM demo_productpost WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordProductPost, "text"), GetSQLValueString($colindicate_RecordProductPost, "text"),GetSQLValueString($coluserid_RecordProductPost, "int"),GetSQLValueString($collang_RecordProductPost, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_productpost WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordProductPost, "text"),GetSQLValueString($coluserid_RecordProductPost, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


//$query_RecordProductPost = sprintf("SELECT * FROM demo_productpost WHERE name LIKE %s && indicate LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordProductPost . "%", "text"), GetSQLValueString($colindicate_RecordProductPost, "text"),GetSQLValueString($coltype1_RecordProductPost, "text"),GetSQLValueString($coltype2_RecordProductPost, "text"),GetSQLValueString($coltype3_RecordProductPost, "text"),GetSQLValueString($collang_RecordProductPost, "text"),GetSQLValueString($coluserid_RecordProductPost, "int"));
$query_RecordProductPost = sprintf("SELECT demo_productpost.id, demo_productpost.pid, demo_productpost.userid, demo_productpost.content, demo_productpost.author, demo_productpost.postdate , demo_productreply.rid FROM demo_productpost LEFT OUTER JOIN demo_productreply ON demo_productpost.id = demo_productreply.pid GROUP BY demo_productpost.id HAVING ((demo_productpost.postdate LIKE %s) || (demo_productpost.author LIKE %s)) && demo_productpost.userid=%s ORDER BY demo_productpost.id DESC", GetSQLValueString("%" . $colsearch_RecordProductPost . "%", "text"),GetSQLValueString("%" . $colsearch_RecordProductPost . "%", "text"),GetSQLValueString($coluserid_RecordProductPost, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordProductPost = mysqli_query($DB_Conn, $query_RecordProductPost) or die(mysqli_error($DB_Conn));
	$row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost);
	$totalRows_RecordProductPost = mysqli_num_rows($RecordProductPost);
	
}else{
	//分頁
	$query_limit_RecordProductPost = sprintf("%s LIMIT %d, %d", $query_RecordProductPost, $startRow_RecordProductPost, $maxRows_RecordProductPost);
	$RecordProductPost = mysqli_query($DB_Conn, $query_limit_RecordProductPost) or die(mysqli_error($DB_Conn));
	$row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost);
	
	if (isset($_GET['totalRows_RecordProductPost'])) {
	  $totalRows_RecordProductPost = $_GET['totalRows_RecordProductPost'];
	} else {
	  $all_RecordProductPost = mysqli_query($DB_Conn, $query_RecordProductPost);
	  $totalRows_RecordProductPost = mysqli_num_rows($all_RecordProductPost);
	}
	$totalPages_RecordProductPost = ceil($totalRows_RecordProductPost/$maxRows_RecordProductPost)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordProductPost > '0') { ?>
<?php do { ?>
  <?php
    // 取得商品資料 
    $colname_RecordProduct = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $colname_RecordProduct = $_SESSION['lang'];
	}
	$colid_RecordProduct = "-1";
	if (isset($row_RecordProductPost['pid'])) {
	  $colid_RecordProduct = $row_RecordProductPost['pid'];
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

    $link_add = "manage_product.php?wshop=".$wshop."&amp;Opt=postaddpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_product.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProductPost['id'];
	$link_edit = "manage_product.php?wshop=".$wshop."&amp;Opt=posteditpage&amp;lang=".$_SESSION['lang']."&amp;post_id=".$row_RecordProductPost['id']."&amp;pd_id=".$row_RecordProductPost['pid'];
	
	$link_reply = "inner_product.php?wshop=".$wshop."&amp;Opt=replypage&amp;lang=".$_SESSION['lang']."&amp;post_id=".$row_RecordProductPost['id']."&amp;pd_id=".$row_RecordProductPost['pid'];

	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_reply = "<a href='".$link_reply."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='fa fa-eye'></i> 回應一覽</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordProductPost["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordProductPost["id"];

  	$dvalue['chk'] = "<input name='delProductPost[]' type='checkbox' id='delProductPost[]' value='".$row_RecordProductPost["id"]."\'/>";
	
	$dvalue['title'] = $row_RecordProduct["name"];
	
	if($row_RecordProductPost['rid'] != "") {
		$dvalue['replay'] = "已回覆";
	}else{
		$dvalue['replay'] = "未回覆";
	}
                            
	$dvalue['content'] = "<span id='content_".$row_RecordProductPost["id"]."' class='ed_content' data-type='text' data-pk='".$row_RecordProductPost["id"]."' data-placement='top'>".$row_RecordProductPost["content"]."</span>";
	
	$dvalue['author'] = "<span class='label label-danger'><span id='author_".$row_RecordProductPost["id"]."' class='ed_author' data-type='text' data-pk='".$row_RecordProductPost["id"]."' data-placement='top'>".$row_RecordProductPost["author"]."</span></span>";
	
	$dt = new DateTime($row_RecordProductPost['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordProductPost["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordProductPost["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";

	$dvalue['action'] = "<div class='btn-group'>".$but_reply.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordProductPost["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordProductPost), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordProductPost);
?>
