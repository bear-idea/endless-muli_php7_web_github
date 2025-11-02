<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('inc_setting.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once("../../inc/inc_function.php"); // 取得模組名稱?>
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
$search_usegroup = $_POST['search_usegroup'];
$search_module = $_POST['search_module'];

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

$maxRows_RecordPermission = $length;
$startRow_RecordPermission = $start;

$colsearch_RecordPermission = "%";
if (isset($DT_search)) {
  $colsearch_RecordPermission = $DT_search;
}

//$colnamelang_RecordPermission = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordPermission = $_SESSION['lang'];
}

$colindicate_RecordPermission = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordPermission = $search_indicate;
}

$coltype_RecordPermission = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordPermission = $search_type;
}

$colusegroup_RecordPermission = "%";
if (isset($search_usegroup) && $search_usegroup != "") {
  $colusegroup_RecordPermission = $search_usegroup;
}

$colmodule_RecordPermission = "%";
if (isset($search_module) && $search_module != "") {
  $colmodule_RecordPermission = $search_module;
}

$coluserid_RecordPermission = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermission = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_permission WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordPermission, "int"),GetSQLValueString($colnamelang_RecordPermission, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordPermission = sprintf("SELECT * FROM demo_permission WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordPermission, "text"), GetSQLValueString($colindicate_RecordPermission, "text"),GetSQLValueString($coluserid_RecordPermission, "int"),GetSQLValueString($collang_RecordPermission, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_permission WHERE userid=%s",GetSQLValueString($coluserid_RecordPermission, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

$query_RecordPermission = sprintf("SELECT * FROM demo_permission WHERE title LIKE %s && indicate LIKE %s && type LIKE %s && module LIKE %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordPermission . "%", "text"), GetSQLValueString($colindicate_RecordPermission, "text"), GetSQLValueString($coltype_RecordPermission, "text"), GetSQLValueString($colmodule_RecordPermission, "text"),GetSQLValueString($coluserid_RecordPermission, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordPermission = mysqli_query($DB_Conn, $query_RecordPermission) or die(mysqli_error($DB_Conn));
	$row_RecordPermission = mysqli_fetch_assoc($RecordPermission);
	$totalRows_RecordPermission = mysqli_num_rows($RecordPermission);
	
}else{
	//分頁
	$query_limit_RecordPermission = sprintf("%s LIMIT %d, %d", $query_RecordPermission, $startRow_RecordPermission, $maxRows_RecordPermission);
	$RecordPermission = mysqli_query($DB_Conn, $query_limit_RecordPermission) or die(mysqli_error($DB_Conn));
	$row_RecordPermission = mysqli_fetch_assoc($RecordPermission);
	
	if (isset($_GET['totalRows_RecordPermission'])) {
	  $totalRows_RecordPermission = $_GET['totalRows_RecordPermission'];
	} else {
	  $all_RecordPermission = mysqli_query($DB_Conn, $query_RecordPermission);
	  $totalRows_RecordPermission = mysqli_num_rows($all_RecordPermission);
	}
	$totalPages_RecordPermission = ceil($totalRows_RecordPermission/$maxRows_RecordPermission)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordPermission > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_permission.php?wshop=".$wshop."&amp;Opt=addpage_rule&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_permission.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordPermission['id'];
	$link_edit = "manage_permission.php?wshop=".$wshop."&amp;Opt=editpage_rule&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordPermission['id'];
	$link_start = "manage_permission.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordPermission["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordPermission["id"];
	
  	$dvalue['chk'] = "<input name='delPermission[]' type='checkbox' id='delPermission[]' value='".$row_RecordPermission["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordPermission["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$row_RecordPermission["title"]."</span>";

    
	$pagelink = "manage_".strtolower($row_RecordPermission["module"]).".php?Opt=".$row_RecordPermission["opt"]."&lang=" . $_SESSION['lang'];
	
	$dvalue['title'] .= "<div>"."<a href='$pagelink' class='btn btn-link btn-xs'>".$pagelink."</a>"."</div>";
	
	//$dvalue['title'] .= "<br><span class='label label-lime'>檔名</span> " . $row_RecordPermission["link"];
	
	$dvalue['opt'] = "<span id='opt_".$row_RecordPermission["id"]."' class='ed_opt' data-type='text' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$row_RecordPermission["opt"]."</span>";
	
	$dvalue['module'] = "<span id='module_".$row_RecordPermission["id"]."' class='ed_module' data-type='select' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$row_RecordPermission["module"]."</span>";
	
	$dvalue['type'] = "<span id='type_".$row_RecordPermission["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$row_RecordPermission["type"]."</span>";
	
	// 取得 PermissionRuleUsegroup 是否有設定
	$coluserid_RecordPermissionRuleUsegroupGet = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordPermissionRuleUsegroupGet = $w_userid;
	}
	$colitemid_RecordPermissionRuleUsegroupGet = "-1";
	if (isset($row_RecordPermission["id"])) {
	  $colitemid_RecordPermissionRuleUsegroupGet = $row_RecordPermission["id"];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordPermissionRuleUsegroupGet = sprintf("SELECT * FROM demo_permissionruleusegroup WHERE itemid=%s && userid=%s",GetSQLValueString($colitemid_RecordPermissionRuleUsegroupGet, "int"),GetSQLValueString($coluserid_RecordPermissionRuleUsegroupGet, "int"));
	$RecordPermissionRuleUsegroupGet = mysqli_query($DB_Conn, $query_RecordPermissionRuleUsegroupGet) or die(mysqli_error($DB_Conn));
	$row_RecordPermissionRuleUsegroupGet = mysqli_fetch_assoc($RecordPermissionRuleUsegroupGet);
	$totalRows_RecordPermissionRuleUsegroupGet = mysqli_num_rows($RecordPermissionRuleUsegroupGet);
	
	$dvalue['usegroup'] = $row_RecordPermissionRuleUsegroupGet["grouptype"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordPermission["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$row_RecordPermission["sortid"]."</span>";
	
	if($row_RecordPermission["indicate"] == '1') {$row_RecordPermission["indicate"] = "公佈";}else{$row_RecordPermission["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordPermission["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$row_RecordPermission["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordPermission['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordPermission["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordPermission["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordPermission["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordPermission = mysqli_fetch_assoc($RecordPermission)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordPermission), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordPermission);
?>
