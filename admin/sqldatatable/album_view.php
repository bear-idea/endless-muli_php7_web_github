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
        case 2;$orderSql = " ORDER BY type ".$order_dir;break;
        case 3;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 4;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 5;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY act_id DESC";
}else{
	$orderSql = $orderSql . ",act_id DESC";
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

$maxRows_RecordAlbum = $length;
$startRow_RecordAlbum = $start;

$colsearch_RecordAlbum = "%";
if (isset($DT_search)) {
  $colsearch_RecordAlbum = $DT_search;
}

//$colnamelang_RecordAlbum = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAlbum = $_SESSION['lang'];
}

$colindicate_RecordAlbum = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordAlbum = $search_indicate;
}

$coltype_RecordAlbum = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordAlbum = $search_type;
}

$coluserid_RecordAlbum = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAlbum = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_album WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordAlbum, "int"),GetSQLValueString($colnamelang_RecordAlbum, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordAlbum = sprintf("SELECT * FROM demo_album WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordAlbum, "text"), GetSQLValueString($colindicate_RecordAlbum, "text"),GetSQLValueString($coluserid_RecordAlbum, "int"),GetSQLValueString($collang_RecordAlbum, "text"));

$query_RecordCount = sprintf("SELECT count(act_id) as sum FROM demo_album WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordAlbum, "text"),GetSQLValueString($coluserid_RecordAlbum, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordAlbum = sprintf("SELECT demo_album.act_id, demo_album.userid, demo_album.title, demo_album.type, demo_album.sdescription, demo_album.indicate, demo_album.author, demo_album.postdate, demo_albumphoto.pic, demo_album.sortid, demo_albumphoto.actphoto_id, demo_album.lang, count(demo_albumphoto.act_id) AS photonum FROM demo_album LEFT OUTER JOIN demo_albumphoto ON demo_album.act_id = demo_albumphoto.act_id GROUP BY demo_album.act_id HAVING (demo_album.lang = %s) && (demo_album.type LIKE %s) && (demo_album.title LIKE %s) && demo_album.userid=%s ORDER BY demo_album.act_id DESC", GetSQLValueString($collang_RecordAlbum, "text"),GetSQLValueString($coltype_RecordAlbum, "text"),GetSQLValueString("%" . $colsearch_RecordAlbum . "%", "text"),GetSQLValueString($coluserid_RecordAlbum, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordAlbum = mysqli_query($DB_Conn, $query_RecordAlbum) or die(mysqli_error($DB_Conn));
	$row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum);
	$totalRows_RecordAlbum = mysqli_num_rows($RecordAlbum);
	
}else{
	//分頁
	$query_limit_RecordAlbum = sprintf("%s LIMIT %d, %d", $query_RecordAlbum, $startRow_RecordAlbum, $maxRows_RecordAlbum);
	$RecordAlbum = mysqli_query($DB_Conn, $query_limit_RecordAlbum) or die(mysqli_error($DB_Conn));
	$row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum);
	
	if (isset($_GET['totalRows_RecordAlbum'])) {
	  $totalRows_RecordAlbum = $_GET['totalRows_RecordAlbum'];
	} else {
	  $all_RecordAlbum = mysqli_query($DB_Conn, $query_RecordAlbum);
	  $totalRows_RecordAlbum = mysqli_num_rows($all_RecordAlbum);
	}
	$totalPages_RecordAlbum = ceil($totalRows_RecordAlbum/$maxRows_RecordAlbum)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordAlbum > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_album.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_album.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAlbum['act_id'];
	$link_edit = "manage_album.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAlbum['act_id'];
	$link_mutiphoto = "inner_album.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;act_id=".$row_RecordAlbum['act_id'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordAlbum["act_id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	$but_mutiphoto = "<a href='".$link_mutiphoto."' class='btn btn-xs btn-primary colorbox_iframe_cd' style=text-align:center'><i class='fa fa-image'></i> 圖片一覽</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordAlbum["act_id"];
	
  	$dvalue['chk'] = "<input name='delAlbum[]' type='checkbox' id='delAlbum[]' value='".$row_RecordAlbum["act_id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordAlbum["act_id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordAlbum["act_id"]."' data-placement='top'>".$row_RecordAlbum["title"]."</span>";
	
	$dvalue['type'] = "<span id='type_".$row_RecordAlbum["act_id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordAlbum["act_id"]."' data-placement='top'>".$row_RecordAlbum["type"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordAlbum["act_id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordAlbum["act_id"]."' data-placement='top'>".$row_RecordAlbum["sortid"]."</span>";
	
	if($row_RecordAlbum["indicate"] == '1') {$row_RecordAlbum["indicate"] = "公佈";}else{$row_RecordAlbum["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordAlbum["act_id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordAlbum["act_id"]."' data-placement='top'>".$row_RecordAlbum["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordAlbum['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordAlbum["act_id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordAlbum["act_id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['photonum'] = "<span class='label label-secondary'>".$row_RecordAlbum['photonum']."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_mutiphoto.$but_del."</div>";
	//$dvalue['content'] = $row_RecordAlbum["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordAlbum), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordAlbum);
?>
