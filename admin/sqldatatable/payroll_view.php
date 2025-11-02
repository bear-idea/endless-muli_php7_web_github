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
if(isset($_POST['search_type'])){
	$search_type = $_POST['search_type'];
}else{
	$search_type = "";
}
$search_taxable = $_POST['search_taxable'];

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
        case 2;$orderSql = " ORDER BY DefaultAmount ".$order_dir;break;
		case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		case 4;$orderSql = " ORDER BY taxable ".$order_dir;break;
		case 5;$orderSql = " ORDER BY FixedSalary ".$order_dir;break;
		case 6;$orderSql = " ORDER BY PublicProject ".$order_dir;break;
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

$maxRows_RecordPayroll = $length;
$startRow_RecordPayroll = $start;

$colsearch_RecordPayroll = "%";
if (isset($DT_search)) {
  $colsearch_RecordPayroll = $DT_search;
}

//$colnamelang_RecordPayroll = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordPayroll = $_SESSION['lang'];
}

$colindicate_RecordPayroll = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordPayroll = $search_indicate;
}

$coltype_RecordPayroll = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordPayroll = $search_type;
}

$coltaxable_RecordPayroll = "%";
if (isset($search_taxable) && $search_taxable != "") {
  $coltaxable_RecordPayroll = $search_taxable;
}

$coluserid_RecordPayroll = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPayroll = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM salary_payroll WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordPayroll, "int"),GetSQLValueString($colnamelang_RecordPayroll, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordPayroll = sprintf("SELECT * FROM salary_payroll WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordPayroll, "text"), GetSQLValueString($colindicate_RecordPayroll, "text"),GetSQLValueString($coluserid_RecordPayroll, "int"),GetSQLValueString($collang_RecordPayroll, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM salary_payroll WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordPayroll, "text"),GetSQLValueString($coluserid_RecordPayroll, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordPayroll = sprintf("SELECT * FROM salary_payroll WHERE title LIKE %s && indicate LIKE %s && type LIKE %s && taxable LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordPayroll . "%", "text"), GetSQLValueString($colindicate_RecordPayroll, "text"), GetSQLValueString($coltype_RecordPayroll, "text"), GetSQLValueString($coltaxable_RecordPayroll, "text"),GetSQLValueString($collang_RecordPayroll, "text"),GetSQLValueString($coluserid_RecordPayroll, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordPayroll = mysqli_query($DB_Conn, $query_RecordPayroll) or die(mysqli_error($DB_Conn));
	$row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
	$totalRows_RecordPayroll = mysqli_num_rows($RecordPayroll);
	
}else{
	//分頁
	$query_limit_RecordPayroll = sprintf("%s LIMIT %d, %d", $query_RecordPayroll, $startRow_RecordPayroll, $maxRows_RecordPayroll);
	$RecordPayroll = mysqli_query($DB_Conn, $query_limit_RecordPayroll) or die(mysqli_error($DB_Conn));
	$row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
	
	if (isset($_GET['totalRows_RecordPayroll'])) {
	  $totalRows_RecordPayroll = $_GET['totalRows_RecordPayroll'];
	} else {
	  $all_RecordPayroll = mysqli_query($DB_Conn, $query_RecordPayroll);
	  $totalRows_RecordPayroll = mysqli_num_rows($all_RecordPayroll);
	}
	$totalPages_RecordPayroll = ceil($totalRows_RecordPayroll/$maxRows_RecordPayroll)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordPayroll > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_payroll.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_payroll.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordPayroll['id'];
	$link_edit = "manage_payroll.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordPayroll['id'];
	$link_start = "manage_payroll.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordPayroll["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordPayroll["id"];
	
  	//$dvalue['chk'] = "<input name='delPayroll[]' type='checkbox' id='delPayroll[]' value='".$row_RecordPayroll["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordPayroll["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["title"]."</span>";

    if($row_RecordPayroll["type"] == '1') {$row_RecordPayroll["type"] = "應扣薪資";}else{$row_RecordPayroll["type"] = "應領薪資";}
	$dvalue['type'] = "<span id='type_".$row_RecordPayroll["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["type"]."</span>";
	
	if($row_RecordPayroll["taxable"] == '1') {$row_RecordPayroll["taxable"] = "是";}else{$row_RecordPayroll["taxable"] = "否";}
	$dvalue['taxable'] = "<span id='taxable_".$row_RecordPayroll["id"]."' class='ed_taxable' data-type='select' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["taxable"]."</span>";
	
	$dvalue['DefaultAmount'] = "<span id='DefaultAmount_".$row_RecordPayroll["id"]."' class='ed_DefaultAmount' data-type='text' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["DefaultAmount"]."</span>";
	
	if($row_RecordPayroll["FixedSalary"] == '1') {$row_RecordPayroll["FixedSalary"] = "是";}else{$row_RecordPayroll["FixedSalary"] = "否";}
	$dvalue['FixedSalary'] = "<span id='FixedSalary_".$row_RecordPayroll["id"]."' class='ed_FixedSalary' data-type='text' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["FixedSalary"]."</span>";
	
	if($row_RecordPayroll["PublicProject"] == '1') {$row_RecordPayroll["PublicProject"] = "是";}else{$row_RecordPayroll["PublicProject"] = "否";}
	$dvalue['PublicProject'] = "<span id='PublicProject_".$row_RecordPayroll["id"]."' class='ed_PublicProject' data-type='select' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["PublicProject"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordPayroll["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["sortid"]."</span>";
	
	if($row_RecordPayroll["indicate"] == '1') {$row_RecordPayroll["indicate"] = "公佈";}else{$row_RecordPayroll["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordPayroll["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$row_RecordPayroll["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordPayroll['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordPayroll["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordPayroll["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordPayroll["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordPayroll), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordPayroll);
?>
