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
$search_act_id = $_GET['act_id'];

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
        case 3;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 4;$orderSql = " ORDER BY indicate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY actphoto_id DESC";
}else{
	$orderSql = $orderSql . ",actphoto_id DESC";
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

$maxRows_RecordProject = $length;
$startRow_RecordProject = $start;

$colsearch_RecordProject = "%";
if (isset($DT_search)) {
  $colsearch_RecordProject = $DT_search;
}

//$colnamelang_RecordProject = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProject = $_SESSION['lang'];
}

$colindicate_RecordProject = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "顯示") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordProject = $search_indicate;
}

$coluserid_RecordProject = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProject = $w_userid;
}

$colact_id_RecordProject = "-1";
if (isset($search_act_id)) {
  $colact_id_RecordProject = $search_act_id;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_project WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordProject, "int"),GetSQLValueString($colnamelang_RecordProject, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordProject = sprintf("SELECT * FROM demo_project WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordProject, "text"), GetSQLValueString($colindicate_RecordProject, "text"),GetSQLValueString($coluserid_RecordProject, "int"),GetSQLValueString($collang_RecordProject, "text"));

$query_RecordCount = sprintf("SELECT count(actphoto_id) as sum FROM demo_projectalbumphoto WHERE lang=%s && userid=%s && act_id=%s",GetSQLValueString($collang_RecordProject, "text"),GetSQLValueString($coluserid_RecordProject, "int"),GetSQLValueString($colact_id_RecordProject, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

if($DT_search != "") {
	$query_RecordProject = sprintf("SELECT * FROM demo_projectalbumphoto WHERE (sdescription LIKE %s) && indicate LIKE %s && lang=%s && userid=%s && act_id=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordProject . "%", "text"), GetSQLValueString($colindicate_RecordProject, "text"),GetSQLValueString($collang_RecordProject, "text"),GetSQLValueString($coluserid_RecordProject, "int"),GetSQLValueString($colact_id_RecordProject, "int"));
}else{
	$query_RecordProject = sprintf("SELECT * FROM demo_projectalbumphoto WHERE indicate LIKE %s && lang=%s && userid=%s && act_id=%s $orderSql", GetSQLValueString($colindicate_RecordProject, "text"),GetSQLValueString($collang_RecordProject, "text"),GetSQLValueString($coluserid_RecordProject, "int"),GetSQLValueString($colact_id_RecordProject, "int"));
}



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordProject = mysqli_query($DB_Conn, $query_RecordProject) or die(mysqli_error($DB_Conn));
	$row_RecordProject = mysqli_fetch_assoc($RecordProject);
	$totalRows_RecordProject = mysqli_num_rows($RecordProject);
	
}else{
	//分頁
	$query_limit_RecordProject = sprintf("%s LIMIT %d, %d", $query_RecordProject, $startRow_RecordProject, $maxRows_RecordProject);
	$RecordProject = mysqli_query($DB_Conn, $query_limit_RecordProject) or die(mysqli_error($DB_Conn));
	$row_RecordProject = mysqli_fetch_assoc($RecordProject);
	
	if (isset($_GET['totalRows_RecordProject'])) {
	  $totalRows_RecordProject = $_GET['totalRows_RecordProject'];
	} else {
	  $all_RecordProject = mysqli_query($DB_Conn, $query_RecordProject);
	  $totalRows_RecordProject = mysqli_num_rows($all_RecordProject);
	}
	$totalPages_RecordProject = ceil($totalRows_RecordProject/$maxRows_RecordProject)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordProject > '0') { ?>
<?php do { ?>
  <?php 
  
    if($row_RecordProject['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/project/thumb/small_'.GetFileThumbExtend($row_RecordProject['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "inner_project.php?wshop=".$wshop."&amp;Opt=photoaddpage&amp;lang=".$_SESSION['lang'] . "&amp;act_id=" . $_GET['act_id'];
	$link_copy = "inner_project.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProject['actphoto_id'] . "&amp;act_id=" . $_GET['act_id'];
	$link_edit = "inner_project.php?wshop=".$wshop."&amp;Opt=photoeditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProject['actphoto_id'] . "&amp;act_id=" . $_GET['act_id'];
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordProject["actphoto_id"].",\"".$row_RecordProject["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordProject["actphoto_id"];
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
  	$dvalue['chk'] = "<input name='delProject[]' type='checkbox' id='delProject[]' value='".$row_RecordProject["actphoto_id"]."\'/>";
	
	if($row_RecordProject["sdescription"] != ""){
			$dvalue['sdescription'] = "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordProject["actphoto_id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordProject["actphoto_id"]."' data-placement='top'>".$row_RecordProject["sdescription"]."</span></div>";
	}else{
			$dvalue['sdescription'] = "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordProject["actphoto_id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordProject["actphoto_id"]."' data-placement='top'>".'Empty'."</span></div>";
	}                         
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordProject["actphoto_id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordProject["actphoto_id"]."' data-placement='top'>".$row_RecordProject["sortid"]."</span>";
	
	if($row_RecordProject["indicate"] == '1') {$row_RecordProject["indicate"] = "顯示";}else{$row_RecordProject["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordProject["actphoto_id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordProject["actphoto_id"]."' data-placement='top'>".$row_RecordProject["indicate"]."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordProject["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordProject = mysqli_fetch_assoc($RecordProject)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordProject), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordProject);
?>
