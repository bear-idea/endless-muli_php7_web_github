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
$search_level = $_POST['search_level'];
$search_TimeSlot = $_POST['search_TimeSlot'];

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
        case 1;$orderSql = " ORDER BY level ".$order_dir;break;
        case 2;$orderSql = " ORDER BY TimeSlot ".$order_dir;break;
		case 3;$orderSql = " ORDER BY calculate ".$order_dir;break;
		case 4;$orderSql = " ORDER BY coefficient ".$order_dir;break;
		case 5;$orderSql = " ORDER BY FixedAmount ".$order_dir;break;
		case 6;$orderSql = " ORDER BY unit ".$order_dir;break;
        case 7;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 8;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 9;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordOvertimepay = $length;
$startRow_RecordOvertimepay = $start;

$colsearch_RecordOvertimepay = "%";
if (isset($DT_search)) {
  $colsearch_RecordOvertimepay = $DT_search;
}

//$colnamelang_RecordOvertimepay = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordOvertimepay = $_SESSION['lang'];
}

$colindicate_RecordOvertimepay = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordOvertimepay = $search_indicate;
}

$collevel_RecordOvertimepay = "%";
if (isset($search_level) && $search_level != "") {
  $collevel_RecordOvertimepay = $search_level;
}

$colTimeSlot_RecordOvertimepay = "%";
if (isset($search_TimeSlot) && $search_TimeSlot != "") {
  $colTimeSlot_RecordOvertimepay = $search_TimeSlot;
}

$coluserid_RecordOvertimepay = "-1";
if (isset($w_userid)) {
  $coluserid_RecordOvertimepay = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM salary_overtimepay WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordOvertimepay, "int"),GetSQLValueString($colnamelang_RecordOvertimepay, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordOvertimepay = sprintf("SELECT * FROM salary_overtimepay WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordOvertimepay, "text"), GetSQLValueString($colindicate_RecordOvertimepay, "text"),GetSQLValueString($coluserid_RecordOvertimepay, "int"),GetSQLValueString($collang_RecordOvertimepay, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM salary_overtimepay WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordOvertimepay, "text"),GetSQLValueString($coluserid_RecordOvertimepay, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordOvertimepay = sprintf("SELECT * FROM salary_overtimepay WHERE title LIKE %s && indicate LIKE %s && level LIKE %s && TimeSlot LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordOvertimepay . "%", "text"), GetSQLValueString($colindicate_RecordOvertimepay, "text"), GetSQLValueString($collevel_RecordOvertimepay, "text"), GetSQLValueString($colTimeSlot_RecordOvertimepay, "text"),GetSQLValueString($collang_RecordOvertimepay, "text"),GetSQLValueString($coluserid_RecordOvertimepay, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordOvertimepay = mysqli_query($DB_Conn, $query_RecordOvertimepay) or die(mysqli_error($DB_Conn));
	$row_RecordOvertimepay = mysqli_fetch_assoc($RecordOvertimepay);
	$totalRows_RecordOvertimepay = mysqli_num_rows($RecordOvertimepay);
	
}else{
	//分頁
	$query_limit_RecordOvertimepay = sprintf("%s LIMIT %d, %d", $query_RecordOvertimepay, $startRow_RecordOvertimepay, $maxRows_RecordOvertimepay);
	$RecordOvertimepay = mysqli_query($DB_Conn, $query_limit_RecordOvertimepay) or die(mysqli_error($DB_Conn));
	$row_RecordOvertimepay = mysqli_fetch_assoc($RecordOvertimepay);
	
	if (isset($_GET['totalRows_RecordOvertimepay'])) {
	  $totalRows_RecordOvertimepay = $_GET['totalRows_RecordOvertimepay'];
	} else {
	  $all_RecordOvertimepay = mysqli_query($DB_Conn, $query_RecordOvertimepay);
	  $totalRows_RecordOvertimepay = mysqli_num_rows($all_RecordOvertimepay);
	}
	$totalPages_RecordOvertimepay = ceil($totalRows_RecordOvertimepay/$maxRows_RecordOvertimepay)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordOvertimepay > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_overtimepay.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_overtimepay.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordOvertimepay['id'];
	$link_edit = "manage_overtimepay.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordOvertimepay['id'];
	$link_start = "manage_overtimepay.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordOvertimepay["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordOvertimepay["id"];
	
  	//$dvalue['chk'] = "<input name='delOvertimepay[]' type='checkbox' id='delOvertimepay[]' value='".$row_RecordOvertimepay["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordOvertimepay["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["title"]."</span>";
	if($row_RecordOvertimepay['pushtop'] == 1){$dvalue['title'] = $dvalue['title']."<span class='label label-warning pull-right'><i class='fa fa-check-circle'></i> 置頂<span>";}
	
	$dvalue['type'] = "<span id='type_".$row_RecordOvertimepay["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["type"]."</span>";
	
	$dvalue['level'] = "<span id='level_".$row_RecordOvertimepay["id"]."' class='ed_level' data-type='select' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["level"]."</span>";
	
	$dvalue['TimeSlot'] = "<span id='TimeSlot_".$row_RecordOvertimepay["id"]."' class='ed_TimeSlot' data-type='select' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["TimeSlot"]."</span>";
	
	if($row_RecordOvertimepay["calculate"] == '0') {$row_RecordOvertimepay["calculate"] = "固定所得 x 加班係數";}
	if($row_RecordOvertimepay["calculate"] == '1') {$row_RecordOvertimepay["calculate"] = "薪資總額 x 加班係數";}
	if($row_RecordOvertimepay["calculate"] == '2') {$row_RecordOvertimepay["calculate"] = "固定金額";}
	$dvalue['calculate'] = $row_RecordOvertimepay["calculate"];
	
	$dvalue['coefficient'] = "<span id='coefficient_".$row_RecordOvertimepay["id"]."' class='ed_coefficient' data-type='text' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["coefficient"]."</span>";
	
	$dvalue['FixedAmount'] = "<span id='FixedAmount_".$row_RecordOvertimepay["id"]."' class='ed_FixedAmount' data-type='text' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["FixedAmount"]."</span>";
	
	if($row_RecordOvertimepay["unit"] == "hour") { $row_RecordOvertimepay["unit"] = "時"; }
	$dvalue['unit'] = $row_RecordOvertimepay["unit"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordOvertimepay["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["sortid"]."</span>";
	
	if($row_RecordOvertimepay["indicate"] == '1') {$row_RecordOvertimepay["indicate"] = "公佈";}else{$row_RecordOvertimepay["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordOvertimepay["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$row_RecordOvertimepay["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordOvertimepay['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordOvertimepay["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordOvertimepay["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordOvertimepay["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordOvertimepay = mysqli_fetch_assoc($RecordOvertimepay)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordOvertimepay), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordOvertimepay);
?>
