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
$search_particularyear = $_POST['search_particularyear'];
$search_job = $_POST['search_job'];
$search_department = $_POST['search_department'];

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
		case 2;$orderSql = " ORDER BY department ".$order_dir;break;
        case 3;$orderSql = " ORDER BY job ".$order_dir;break;
        case 4;$orderSql = " ORDER BY arrivaldate ".$order_dir;break;
		case 5;$orderSql = " ORDER BY leavedate ".$order_dir;break;
		case 6;$orderSql = " ORDER BY particularyear ".$order_dir;break;
		case 7;$orderSql = " ORDER BY totolworkday ".$order_dir;break;
		case 8;$orderSql = " ORDER BY particularyear ".$order_dir;break;
		case 9;$orderSql = " ORDER BY endyearprice ".$order_dir;break;
		case 10;$orderSql = " ORDER BY FuneralDay ".$order_dir;break;
		case 11;$orderSql = " ORDER BY LeaveDay ".$order_dir;break;
		case 12;$orderSql = " ORDER BY SickDay ".$order_dir;break;
		case 13;$orderSql = " ORDER BY LetterDay ".$order_dir;break;
		case 14;$orderSql = " ORDER BY TotalRestHour ".$order_dir;break;
		case 15;$orderSql = " ORDER BY Assessment ".$order_dir;break;
		case 16;$orderSql = " ORDER BY plusprice ".$order_dir;break;
		case 17;$orderSql = " ORDER BY endyearpriceget ".$order_dir;break;
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

$maxRows_RecordYearend = $length;
$startRow_RecordYearend = $start;

$colsearch_RecordYearend = "%";
if (isset($DT_search)) {
  $colsearch_RecordYearend = $DT_search;
}

//$colnamelang_RecordYearend = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordYearend = $_SESSION['lang'];
}

$colindicate_RecordYearend = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordYearend = $search_indicate;
}

$colparticularyear_RecordYearend = "%";
if (isset($search_particularyear) && $search_particularyear != "") {
  $colparticularyear_RecordYearend = $search_particularyear;
}

$coljob_RecordYearend = "%";
if (isset($search_job) && $search_job != "") {
  $coljob_RecordYearend = $search_job;
}

$coldepartment_RecordYearend = "%";
if (isset($search_department) && $search_department != "") {
  $coldepartment_RecordYearend = $search_department;
}

$coluserid_RecordYearend = "-1";
if (isset($w_userid)) {
  $coluserid_RecordYearend = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM salary_yearend WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordYearend, "int"),GetSQLValueString($colnamelang_RecordYearend, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordYearend = sprintf("SELECT * FROM salary_yearend WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordYearend, "text"), GetSQLValueString($colindicate_RecordYearend, "text"),GetSQLValueString($coluserid_RecordYearend, "int"),GetSQLValueString($collang_RecordYearend, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM salary_yearend WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordYearend, "text"),GetSQLValueString($coluserid_RecordYearend, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordYearend = sprintf("SELECT * FROM salary_yearend WHERE name LIKE %s && particularyear LIKE %s && (job LIKE %s || job IS NULL) && (department LIKE %s || department IS NULL) && indicate LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordYearend . "%", "text"), GetSQLValueString($colparticularyear_RecordYearend, "text"), GetSQLValueString("%" . $coljob_RecordYearend . "%", "text"), GetSQLValueString("%" . $coldepartment_RecordYearend . "%", "text"), GetSQLValueString($colindicate_RecordYearend, "text"),GetSQLValueString($collang_RecordYearend, "text"),GetSQLValueString($coluserid_RecordYearend, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordYearend = mysqli_query($DB_Conn, $query_RecordYearend) or die(mysqli_error($DB_Conn));
	$row_RecordYearend = mysqli_fetch_assoc($RecordYearend);
	$totalRows_RecordYearend = mysqli_num_rows($RecordYearend);
	
}else{
	//分頁
	$query_limit_RecordYearend = sprintf("%s LIMIT %d, %d", $query_RecordYearend, $startRow_RecordYearend, $maxRows_RecordYearend);
	$RecordYearend = mysqli_query($DB_Conn, $query_limit_RecordYearend) or die(mysqli_error($DB_Conn));
	$row_RecordYearend = mysqli_fetch_assoc($RecordYearend);
	
	if (isset($_GET['totalRows_RecordYearend'])) {
	  $totalRows_RecordYearend = $_GET['totalRows_RecordYearend'];
	} else {
	  $all_RecordYearend = mysqli_query($DB_Conn, $query_RecordYearend);
	  $totalRows_RecordYearend = mysqli_num_rows($all_RecordYearend);
	}
	$totalPages_RecordYearend = ceil($totalRows_RecordYearend/$maxRows_RecordYearend)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordYearend > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_view = "manage_yearend_index_detailed.php?id=" . $row_RecordYearend['id'] . "&amp;lang=" . $_SESSION['lang'];
    $link_add = "manage_yearend.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_yearend.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordYearend['id'];
	$link_edit = "manage_yearend.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordYearend['id'];
	$link_start = "manage_yearend.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary colorbox_iframe' style='text-align:center'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordYearend["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordYearend["id"];
	
  	$dvalue['chk'] = "<input name='delYearend[]' type='checkbox' id='delYearend[]' value='".$row_RecordYearend["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordYearend["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["name"]."</span>";
	
	$dvalue['job'] = "<span id='job_".$row_RecordYearend["id"]."' class='ed_job' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["job"]."</span>";
	
	$dvalue['type'] = "<span id='type_".$row_RecordYearend["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["type"]."</span>";
	
	$dvalue['department'] = "<span id='department_".$row_RecordYearend["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["department"]."</span>";
	
	$dvalue['particularyear'] = "<span id='particularyear_".$row_RecordYearend["id"]."' class='ed_particularyear' data-type='select' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["particularyear"]."</span>";
	
	$dvalue['endyearprice'] = "<span id='endyearprice_".$row_RecordYearend["id"]."' class='ed_endyearprice' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["endyearprice"]."</span>";
	
	$dvalue['FuneralDay'] = "<span id='FuneralDay_".$row_RecordYearend["id"]."' class='ed_FuneralDay' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["FuneralDay"]."</span>";
	
	$dvalue['LeaveDay'] = "<span id='LeaveDay_".$row_RecordYearend["id"]."' class='ed_LeaveDay' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["LeaveDay"]."</span>";
	
	$dvalue['SickDay'] = "<span id='SickDay_".$row_RecordYearend["id"]."' class='ed_SickDay' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["SickDay"]."</span>";
	
	$dvalue['LetterDay'] = "<span id='LetterDay_".$row_RecordYearend["id"]."' class='ed_LetterDay' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["LetterDay"]."</span>";
	
	$dvalue['TotalRestHour'] = "<span id='TotalRestHour_".$row_RecordYearend["id"]."' class='ed_TotalRestHour' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["TotalRestHour"]."</span>";
	
	if($row_RecordYearend["Assessment"] == '1') {$row_RecordYearend["Assessment"] = "已審核";}else{$row_RecordYearend["Assessment"] = "未審核";}
	$dvalue['Assessment'] = "<span id='Assessment_".$row_RecordYearend["id"]."' class='ed_Assessment' data-type='select' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["Assessment"]."</span>";
	
	$dvalue['yearworkday'] = "<span id='yearworkday_".$row_RecordYearend["id"]."' class='ed_yearworkday' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["yearworkday"]."</span>";
	
	$dvalue['totolworkday'] = "<span id='totolworkday_".$row_RecordYearend["id"]."' class='ed_totolworkday' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["totolworkday"]."</span>";
		
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordYearend["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["sortid"]."</span>";
	
	$dvalue['plusprice'] = $row_RecordYearend["plusprice"];
	$dvalue['endyearpriceget'] = $row_RecordYearend['endyearprice'] + $row_RecordYearend["plusprice"];
	
	if($row_RecordYearend["indicate"] == '1') {$row_RecordYearend["indicate"] = "公佈";}else{$row_RecordYearend["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordYearend["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$row_RecordYearend["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordYearend['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordYearend["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dt = new DateTime($row_RecordYearend['arrivaldate']); 
	$dvalue['arrivaldate'] = "<span id='arrivaldate_".$row_RecordYearend["id"]."' class='ed_arrivaldate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	if($row_RecordYearend['leavedate'] != ""){
	$dt = new DateTime($row_RecordYearend['leavedate']); 
		$dvalue['leavedate'] = "<span id='leavedate_".$row_RecordYearend["id"]."' class='ed_leavedate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordYearend["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	}else{
		$dvalue['leavedate'] = "------";
	}
	
	$dvalue['action'] = "<div class='btn-group'>".$but_view.$but_edit."</div>";
	//$dvalue['content'] = $row_RecordYearend["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordYearend = mysqli_fetch_assoc($RecordYearend)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordYearend), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordYearend);
?>
