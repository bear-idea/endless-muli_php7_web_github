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
//$search_level = $_POST['search_level'];
//$search_TimeSlot = $_POST['search_TimeSlot'];

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
        case 1;$orderSql = " ORDER BY code ".$order_dir;break;
        case 2;$orderSql = " ORDER BY title ".$order_dir;break;
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

$maxRows_RecordWeeksheet = $length;
$startRow_RecordWeeksheet = $start;

$colsearch_RecordWeeksheet = "%";
if (isset($DT_search)) {
  $colsearch_RecordWeeksheet = $DT_search;
}

//$colnamelang_RecordWeeksheet = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWeeksheet = $_SESSION['lang'];
}

$colindicate_RecordWeeksheet = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordWeeksheet = $search_indicate;
}

$collevel_RecordWeeksheet = "%";
if (isset($search_level) && $search_level != "") {
  $collevel_RecordWeeksheet = $search_level;
}

$colTimeSlot_RecordWeeksheet = "%";
if (isset($search_TimeSlot) && $search_TimeSlot != "") {
  $colTimeSlot_RecordWeeksheet = $search_TimeSlot;
}

$coluserid_RecordWeeksheet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWeeksheet = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM salary_weeksheet WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordWeeksheet, "int"),GetSQLValueString($colnamelang_RecordWeeksheet, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordWeeksheet = sprintf("SELECT * FROM salary_weeksheet WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordWeeksheet, "text"), GetSQLValueString($colindicate_RecordWeeksheet, "text"),GetSQLValueString($coluserid_RecordWeeksheet, "int"),GetSQLValueString($collang_RecordWeeksheet, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM salary_weeksheet WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordWeeksheet, "text"),GetSQLValueString($coluserid_RecordWeeksheet, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordWeeksheet = sprintf("SELECT * FROM salary_weeksheet WHERE title LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordWeeksheet . "%", "text"),GetSQLValueString($collang_RecordWeeksheet, "text"),GetSQLValueString($coluserid_RecordWeeksheet, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordWeeksheet = mysqli_query($DB_Conn, $query_RecordWeeksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWeeksheet = mysqli_fetch_assoc($RecordWeeksheet);
	$totalRows_RecordWeeksheet = mysqli_num_rows($RecordWeeksheet);
	
}else{
	//分頁
	$query_limit_RecordWeeksheet = sprintf("%s LIMIT %d, %d", $query_RecordWeeksheet, $startRow_RecordWeeksheet, $maxRows_RecordWeeksheet);
	$RecordWeeksheet = mysqli_query($DB_Conn, $query_limit_RecordWeeksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWeeksheet = mysqli_fetch_assoc($RecordWeeksheet);
	
	if (isset($_GET['totalRows_RecordWeeksheet'])) {
	  $totalRows_RecordWeeksheet = $_GET['totalRows_RecordWeeksheet'];
	} else {
	  $all_RecordWeeksheet = mysqli_query($DB_Conn, $query_RecordWeeksheet);
	  $totalRows_RecordWeeksheet = mysqli_num_rows($all_RecordWeeksheet);
	}
	$totalPages_RecordWeeksheet = ceil($totalRows_RecordWeeksheet/$maxRows_RecordWeeksheet)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordWeeksheet > 0) { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_weeksheet.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_weeksheet.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordWeeksheet['id'];
	$link_edit = "manage_weeksheet.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordWeeksheet['id'];
	$link_start = "manage_weeksheet.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordWeeksheet["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordWeeksheet["id"];
	
  	//$dvalue['chk'] = "<input name='delweeksheet[]' type='checkbox' id='delweeksheet[]' value='".$row_RecordWeeksheet["id"]."\'/>";
	
	$dvalue['code'] = $row_RecordWeeksheet["code"];

    
    $dvalue['title'] = "<span id='title_".$row_RecordWeeksheet["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordWeeksheet["id"]."' data-placement='top'>".$row_RecordWeeksheet["title"]."</span>";
	
	
    //for($i=0; $i<=7; $i++) {
		
    $dvalue['dayline'] = "";
	
	/*$row_RecordWeeksheet["day0"]="";
	$row_RecordWeeksheet["day1"]="";
	$row_RecordWeeksheet["day2"]="";
	$row_RecordWeeksheet["day3"]="";
	$row_RecordWeeksheet["day4"]="";
	$row_RecordWeeksheet["day5"]="";
	$row_RecordWeeksheet["day6"]="";*/
	
	
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day0"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day0"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
    $row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);
	
	//do {
	//$dvalue['dayline'] = "";
	$row_RecordWeeksheet["day0"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-danger'>日</span> " . $row_RecordWeeksheet['day0'] . "</div>";
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day1"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day1"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);
	
	//$dvalue['dayline'] = "";
	$row_RecordWeeksheet["day1"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-dark'>一</span> " . $row_RecordWeeksheet["day1"] . "</div>";
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day2"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day2"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);

	//$dvalue['dayline'] = "";
	$row_RecordWeeksheet["day2"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-dark'>二</span> " . $row_RecordWeeksheet["day2"] . "</div>";
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day3"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day3"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);

	$row_RecordWeeksheet["day3"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-dark'>三</span> " . $row_RecordWeeksheet["day3"] . "</div>";
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day4"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day4"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);
	
	//$dvalue['dayline'] = "";
	$row_RecordWeeksheet["day4"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-dark'>四</span> " . $row_RecordWeeksheet["day4"] . "</div>";
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day5"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day5"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);

	//$dvalue['dayline'] = "";
	$row_RecordWeeksheet["day5"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-dark'>五</span> " . $row_RecordWeeksheet["day5"] . "</div>";
	
	$colname_RecordWorksheet = "-1";
	if (isset($row_RecordWeeksheet["day6"])) {
	  $colname_RecordWorksheet = $row_RecordWeeksheet["day6"];
	}
	$coluserid_RecordWorksheet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordWorksheet = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE id = %s && userid=%s LIMIT 1", GetSQLValueString($colname_RecordWorksheet, "int"),GetSQLValueString($coluserid_RecordWorksheet, "int"));
	$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
	$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
	$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);
	
	$row_RecordWeeksheet["day6"] = $row_RecordWorksheet['code'] . $row_RecordWorksheet['title']."[上班時段 ".$row_RecordWorksheet['worktimestart']." - ".$row_RecordWorksheet['worktimeend'] ."]"."[上班時數 " . $row_RecordWorksheet['everydayworkhour'] . " 小時]"."[休息時段 ".$row_RecordWorksheet['resttimestart']." - ".$row_RecordWorksheet['resttimeend'] ."]"."[遲到 ".$row_RecordWorksheet['worktimelate']."]";

	$dvalue['dayline'] .= "<div class='m-t-5'><span class='label label-green'>六</span> " . $row_RecordWeeksheet["day6"] . "</div>";/**/

	
	
	
	$dvalue['type'] = "<span id='type_".$row_RecordWeeksheet["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordWeeksheet["id"]."' data-placement='top'>".$row_RecordWeeksheet["type"]."</span>";

	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordWeeksheet["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordWeeksheet["id"]."' data-placement='top'>".$row_RecordWeeksheet["sortid"]."</span>";
	
	if($row_RecordWeeksheet["indicate"] == '1') {$row_RecordWeeksheet["indicate"] = "公佈";}else{$row_RecordWeeksheet["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordWeeksheet["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordWeeksheet["id"]."' data-placement='top'>".$row_RecordWeeksheet["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordWeeksheet['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordWeeksheet["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordWeeksheet["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordWeeksheet["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordWeeksheet = mysqli_fetch_assoc($RecordWeeksheet)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordWeeksheet), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordWeeksheet);
?>
