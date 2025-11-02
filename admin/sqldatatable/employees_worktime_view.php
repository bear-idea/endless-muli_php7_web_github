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
$search_aid = $_GET['aid'];

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
        //case 3;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 4;$orderSql = " ORDER BY indicate ".$order_dir;break;
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

$maxRows_RecordEmployees = $length;
$startRow_RecordEmployees = $start;

$colsearch_RecordEmployees = "%";
if (isset($DT_search)) {
  $colsearch_RecordEmployees = $DT_search;
}

//$colnamelang_RecordEmployees = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordEmployees = $_SESSION['lang'];
}

$colindicate_RecordEmployees = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上班日") {$search_indicate = '1';}
  if($search_indicate == "休假日") {$search_indicate = '0';}
  $colindicate_RecordEmployees = $search_indicate;
}

$coluserid_RecordEmployees = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployees = $w_userid;
}

$colaid_RecordEmployees = "-1";
if (isset($search_aid)) {
  $colaid_RecordEmployees = $search_aid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_employees WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($colnamelang_RecordEmployees, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordEmployees = sprintf("SELECT * FROM demo_employees WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordEmployees, "text"), GetSQLValueString($colindicate_RecordEmployees, "text"),GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($collang_RecordEmployees, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_employeesworktime WHERE lang=%s && userid=%s && aid=%s",GetSQLValueString($collang_RecordEmployees, "text"),GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($colaid_RecordEmployees, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

if($DT_search != "") {
	$query_RecordEmployees = sprintf("SELECT * FROM demo_employeesworktime WHERE (sdescription LIKE %s) && indicate LIKE %s && lang=%s && userid=%s && aid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordEmployees . "%", "text"), GetSQLValueString($colindicate_RecordEmployees, "text"),GetSQLValueString($collang_RecordEmployees, "text"),GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($colaid_RecordEmployees, "int"));
}else{
	$query_RecordEmployees = sprintf("SELECT * FROM demo_employeesworktime WHERE indicate LIKE %s && lang=%s && userid=%s && aid=%s $orderSql", GetSQLValueString($colindicate_RecordEmployees, "text"),GetSQLValueString($collang_RecordEmployees, "text"),GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($colaid_RecordEmployees, "int"));
}



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
	$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
	$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);
	
}else{
	//分頁
	$query_limit_RecordEmployees = sprintf("%s LIMIT %d, %d", $query_RecordEmployees, $startRow_RecordEmployees, $maxRows_RecordEmployees);
	$RecordEmployees = mysqli_query($DB_Conn, $query_limit_RecordEmployees) or die(mysqli_error($DB_Conn));
	$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
	
	if (isset($_GET['totalRows_RecordEmployees'])) {
	  $totalRows_RecordEmployees = $_GET['totalRows_RecordEmployees'];
	} else {
	  $all_RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees);
	  $totalRows_RecordEmployees = mysqli_num_rows($all_RecordEmployees);
	}
	$totalPages_RecordEmployees = ceil($totalRows_RecordEmployees/$maxRows_RecordEmployees)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordEmployees > '0') { ?>
<?php do { ?>
  <?php 
  
    if($row_RecordEmployees['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/employees/thumb/small_'.GetFileThumbExtend($row_RecordEmployees['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "inner_employees.php?wshop=".$wshop."&amp;Opt=worktimeaddpage&amp;lang=".$_SESSION['lang'] . "&amp;aid=" . $_GET['aid'];
	$link_copy = "inner_employees.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordEmployees['id'] . "&amp;aid=" . $_GET['aid'];
	$link_edit = "inner_employees.php?wshop=".$wshop."&amp;Opt=worktimeeditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordEmployees['id'] . "&amp;aid=" . $_GET['aid'];
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordEmployees["id"].",\"".""."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordEmployees["id"];
								
	switch($row_RecordEmployees["day"])
	{
		case "Monday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-dark pull-right'>一</span>";		
			break;
		case "Tuesday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-dark pull-right'>二</span>";		
			break;
		case "Wednesday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-dark pull-right'>三</span>";				
			break;
		case "Thursday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-dark pull-right'>四</span>";				
			break;
		case "Friday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-dark pull-right'>五</span>";				
			break;
		case "Saturday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-lime pull-right'>六</span>";				
			break;
		case "Sunday":
			$row_RecordEmployees["day"] = $row_RecordEmployees["day"] . " <span class='label label-danger pull-right'>日</span>";		
			break;
	}
					
	$dvalue['day'] = $row_RecordEmployees["day"];
	
  	$dvalue['chk'] = "<input name='delEmployees[]' type='checkbox' id='delEmployees[]' value='".$row_RecordEmployees["id"]."\'/>";
	
	if($row_RecordEmployees["sdescription"] != ""){
			$dvalue['sdescription'] = "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordEmployees["id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordEmployees["id"]."' data-placement='top'>".$row_RecordEmployees["sdescription"]."</span></div>";
	}else{
			$dvalue['sdescription'] = "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordEmployees["id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordEmployees["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}                         
	
	$dvalue['worktime'] = $row_RecordEmployees['WorkingTimeFrom'] . "-" . $row_RecordEmployees['WorkingTimeTo'];
	
	$dvalue['lunchbreak'] = $row_RecordEmployees['LunchBreakFrom'] . "-" . $row_RecordEmployees['LunchBreakTo'];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordEmployees["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordEmployees["id"]."' data-placement='top'>".$row_RecordEmployees["sortid"]."</span>";
	
	if($row_RecordEmployees["indicate"] == '1') {$row_RecordEmployees["indicate"] = "上班日";}else{$row_RecordEmployees["indicate"] = "休假日";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordEmployees["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordEmployees["id"]."' data-placement='top'>".$row_RecordEmployees["indicate"]."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordEmployees["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordEmployees), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordEmployees);
?>
