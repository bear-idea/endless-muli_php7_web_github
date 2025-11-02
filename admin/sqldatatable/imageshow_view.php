<?php require_once('../../Connections/DB_Conn.php'); ?>
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
        case 1;$orderSql = " ORDER BY name ".$order_dir;break;
        case 2;$orderSql = " ORDER BY type ".$order_dir;break;
        case 3;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 4;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 5;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordImageshow = $length;
$startRow_RecordImageshow = $start;

$colsearch_RecordImageshow = "%";
if (isset($DT_search)) {
  $colsearch_RecordImageshow = $DT_search;
}

//$colnamelang_RecordImageshow = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordImageshow = $_SESSION['lang'];
}

$colindicate_RecordImageshow = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordImageshow = $search_indicate;
}

$coltype_RecordImageshow = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordImageshow = $search_type;
}

$coluserid_RecordImageshow = "-1";
if (isset($w_userid)) {
  $coluserid_RecordImageshow = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_imageshow WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordImageshow, "int"),GetSQLValueString($colnamelang_RecordImageshow, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordImageshow = sprintf("SELECT * FROM demo_imageshow WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordImageshow, "text"), GetSQLValueString($colindicate_RecordImageshow, "text"),GetSQLValueString($coluserid_RecordImageshow, "int"),GetSQLValueString($collang_RecordImageshow, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_imageshow WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordImageshow, "text"),GetSQLValueString($coluserid_RecordImageshow, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordImageshow = sprintf("SELECT * FROM demo_imageshow WHERE name LIKE %s && indicate LIKE %s && type LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordImageshow . "%", "text"), GetSQLValueString($colindicate_RecordImageshow, "text"), GetSQLValueString($coltype_RecordImageshow, "text"),GetSQLValueString($collang_RecordImageshow, "text"),GetSQLValueString($coluserid_RecordImageshow, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordImageshow = mysqli_query($DB_Conn, $query_RecordImageshow) or die(mysqli_error($DB_Conn));
	$row_RecordImageshow = mysqli_fetch_assoc($RecordImageshow);
	$totalRows_RecordImageshow = mysqli_num_rows($RecordImageshow);
	
}else{
	//分頁
	$query_limit_RecordImageshow = sprintf("%s LIMIT %d, %d", $query_RecordImageshow, $startRow_RecordImageshow, $maxRows_RecordImageshow);
	$RecordImageshow = mysqli_query($DB_Conn, $query_limit_RecordImageshow) or die(mysqli_error($DB_Conn));
	$row_RecordImageshow = mysqli_fetch_assoc($RecordImageshow);
	
	if (isset($_GET['totalRows_RecordImageshow'])) {
	  $totalRows_RecordImageshow = $_GET['totalRows_RecordImageshow'];
	} else {
	  $all_RecordImageshow = mysqli_query($DB_Conn, $query_RecordImageshow);
	  $totalRows_RecordImageshow = mysqli_num_rows($all_RecordImageshow);
	}
	$totalPages_RecordImageshow = ceil($totalRows_RecordImageshow/$maxRows_RecordImageshow)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordImageshow > '0') { ?>
<?php do { ?>
  <?php 
  
    if($row_RecordImageshow['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/imageshow/'.GetFileThumbExtend($row_RecordImageshow['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
  
    $link_add = "manage_imageshow.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_imageshow.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordImageshow['id'];
	

	$link_edit = "manage_imageshow.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordImageshow['id'];
	
	$link_start = "manage_imageshow.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordImageshow["id"].",\"".$row_RecordImageshow["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordImageshow["id"];
	
  	$dvalue['chk'] = "<input name='delImageshow[]' type='checkbox' id='delImageshow[]' value='".$row_RecordImageshow["id"]."\'/>";
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordImageshow["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordImageshow["id"]."' data-placement='top'>".$row_RecordImageshow["name"]."</span>";

    if($row_RecordImageshow["sdescription"] != ""){
		$dvalue['name'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordImageshow["id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordImageshow["id"]."' data-placement='top'>".$row_RecordImageshow["sdescription"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordImageshow["id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordImageshow["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	
	$dvalue['type'] = "<span id='type_".$row_RecordImageshow["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordImageshow["id"]."' data-placement='top'>".$row_RecordImageshow["type"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordImageshow["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordImageshow["id"]."' data-placement='top'>".$row_RecordImageshow["sortid"]."</span>";
	
	if($row_RecordImageshow["indicate"] == '1') {$row_RecordImageshow["indicate"] = "公佈";}else{$row_RecordImageshow["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordImageshow["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordImageshow["id"]."'>".$row_RecordImageshow["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordImageshow['postdate']);
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordImageshow["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordImageshow["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_copy.$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordImageshow["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordImageshow = mysqli_fetch_assoc($RecordImageshow)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordImageshow), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordImageshow);
?>
