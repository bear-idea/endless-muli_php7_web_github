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
$search_department = $_POST['search_department'];
$search_job = $_POST['search_job'];

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
        case 1;$orderSql = " ORDER BY code ".$order_dir;break;
        case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        case 3;$orderSql = " ORDER BY department ".$order_dir;break;
		case 4;$orderSql = " ORDER BY job ".$order_dir;break;
		case 5;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 6;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 7;$orderSql = " ORDER BY arrivaldate ".$order_dir;break;
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

$maxRows_RecordStaff = $length;
$startRow_RecordStaff = $start;

$colsearch_RecordStaff = "%";
if (isset($DT_search)) {
  $colsearch_RecordStaff = $DT_search;
}

//$colnamelang_RecordStaff = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordStaff = $_SESSION['lang'];
}

$colindicate_RecordStaff = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordStaff = $search_indicate;
}

$coldepartment_RecordStaff = "%";
if (isset($search_department) && $search_department != "") {
  $coldepartment_RecordStaff = $search_department;
}

$coljob_RecordStaff = "%";
if (isset($search_job) && $search_job != "") {
  $coljob_RecordStaff = $search_job;
}

$coluserid_RecordStaff = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaff = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM salary_staff WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordStaff, "int"),GetSQLValueString($colnamelang_RecordStaff, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordStaff, "text"), GetSQLValueString($colindicate_RecordStaff, "text"),GetSQLValueString($coluserid_RecordStaff, "int"),GetSQLValueString($collang_RecordStaff, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM salary_staff WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordStaff, "text"),GetSQLValueString($coluserid_RecordStaff, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE name LIKE %s && indicate LIKE %s && (department LIKE %s || department IS NULL) && (job LIKE %s || job IS NULL) && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordStaff . "%", "text"), GetSQLValueString($colindicate_RecordStaff, "text"), GetSQLValueString($coldepartment_RecordStaff, "text"), GetSQLValueString($coljob_RecordStaff, "text"),GetSQLValueString($collang_RecordStaff, "text"),GetSQLValueString($coluserid_RecordStaff, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff) or die(mysqli_error($DB_Conn));
	$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
	$totalRows_RecordStaff = mysqli_num_rows($RecordStaff);
	
}else{
	//分頁
	$query_limit_RecordStaff = sprintf("%s LIMIT %d, %d", $query_RecordStaff, $startRow_RecordStaff, $maxRows_RecordStaff);
	$RecordStaff = mysqli_query($DB_Conn, $query_limit_RecordStaff) or die(mysqli_error($DB_Conn));
	$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
	
	if (isset($_GET['totalRows_RecordStaff'])) {
	  $totalRows_RecordStaff = $_GET['totalRows_RecordStaff'];
	} else {
	  $all_RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff);
	  $totalRows_RecordStaff = mysqli_num_rows($all_RecordStaff);
	}
	$totalPages_RecordStaff = ceil($totalRows_RecordStaff/$maxRows_RecordStaff)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordStaff > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_capital = "manage_staff.php?wshop=".$wshop."&amp;Opt=capital&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordStaff['id'];
	$link_yearend = "manage_staff.php?wshop=".$wshop."&amp;Opt=yearend&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordStaff['id'];
    $link_view = "manage_staff_index_detailed.php?id=" . $row_RecordStaff['id'] . "&amp;lang=" . $_SESSION['lang'];
    $link_add = "manage_staff.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_staff.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordStaff['id'];
	$link_edit = "manage_staff.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordStaff['id'];
	$link_start = "manage_staff.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary colorbox_iframe' style='text-align:center'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordStaff["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	$but_capital = "<a href='".$link_capital."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fas fa-pound-sign'></i> 新資設定</a>";
	$but_yearend = "<a href='".$link_yearend."' class='btn btn-xs btn-primary' style='text-align:center'><i class='far fa-money-bill-alt'></i> 年終獎金</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordStaff["id"];
	
  	$dvalue['chk'] = "<input name='delStaff[]' type='checkbox' id='delStaff[]' value='".$row_RecordStaff["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordStaff["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$row_RecordStaff["name"]."</span>";
	
	$dvalue['code'] = "<span id='code_".$row_RecordStaff["id"]."' class='ed_code' data-type='text' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$row_RecordStaff["code"]."</span>";
	
	$dvalue['department'] = "<span id='department_".$row_RecordStaff["id"]."' class='ed_department' data-type='select' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$row_RecordStaff["department"]."</span>";
	
	$dvalue['job'] = "<span id='job_".$row_RecordStaff["id"]."' class='ed_job' data-type='select' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$row_RecordStaff["job"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordStaff["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$row_RecordStaff["sortid"]."</span>";
	
	if($row_RecordStaff["indicate"] == '1') {$row_RecordStaff["indicate"] = "公佈";}else{$row_RecordStaff["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordStaff["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$row_RecordStaff["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordStaff['arrivaldate']); 
	$dvalue['arrivaldate'] = "<span id='arrivaldate_".$row_RecordStaff["id"]."' class='ed_arrivaldate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordStaff["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div><div class='btn-group'>".$but_view.$but_add.$but_edit.$but_del."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_capital.$but_yearend."</div></div>";
	//$dvalue['content'] = $row_RecordStaff["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordStaff = mysqli_fetch_assoc($RecordStaff)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordStaff), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordStaff);
?>
