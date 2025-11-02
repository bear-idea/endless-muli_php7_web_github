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

if(isset($_POST['search_type1'])){
	$search_type1 = $_POST['search_type1'];
}else{
	$search_type1 = "";
}
if(isset($_POST['search_type2'])){
	$search_type2 = $_POST['search_type2'];
}else{
	$search_type2 = "";
}
if(isset($_POST['search_type3'])){
	$search_type3 = $_POST['search_type3'];
}else{
	$search_type3 = "";
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
        case 2;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 3;$orderSql = " ORDER BY indicate ".$order_dir;break;
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

$maxRows_RecordScalesource = $length;
$startRow_RecordScalesource = $start;

$colsearch_RecordScalesource = "%";
if (isset($DT_search)) {
  $colsearch_RecordScalesource = $DT_search;
}

//$colnamelang_RecordScalesource = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScalesource = $_SESSION['lang'];
}

$colindicate_RecordScalesource = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordScalesource = $search_indicate;
}

$coluserid_RecordScalesource = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalesource = $w_userid;
}

$coltype1_RecordScalesource = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordScalesource = $search_type1;
}
$coltype2_RecordScalesource = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordScalesource = $search_type2;
}
$coltype3_RecordScalesource = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordScalesource = $search_type3;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scalesource WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScalesource, "int"),GetSQLValueString($colnamelang_RecordScalesource, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScalesource = sprintf("SELECT * FROM erp_scalesource WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScalesource, "text"), GetSQLValueString($colindicate_RecordScalesource, "text"),GetSQLValueString($coluserid_RecordScalesource, "int"),GetSQLValueString($collang_RecordScalesource, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scalesource WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordScalesource, "text"),GetSQLValueString($coluserid_RecordScalesource, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScalesource = sprintf("SELECT * FROM erp_scalesource WHERE name LIKE %s && indicate LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordScalesource . "%", "text"), GetSQLValueString($colindicate_RecordScalesource, "text"),GetSQLValueString($coltype1_RecordScalesource, "text"),GetSQLValueString($coltype2_RecordScalesource, "text"),GetSQLValueString($coltype3_RecordScalesource, "text"),GetSQLValueString($collang_RecordScalesource, "text"),GetSQLValueString($coluserid_RecordScalesource, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScalesource = mysqli_query($DB_Conn, $query_RecordScalesource) or die(mysqli_error($DB_Conn));
	$row_RecordScalesource = mysqli_fetch_assoc($RecordScalesource);
	$totalRows_RecordScalesource = mysqli_num_rows($RecordScalesource);
	
}else{
	//分頁
	$query_limit_RecordScalesource = sprintf("%s LIMIT %d, %d", $query_RecordScalesource, $startRow_RecordScalesource, $maxRows_RecordScalesource);
	$RecordScalesource = mysqli_query($DB_Conn, $query_limit_RecordScalesource) or die(mysqli_error($DB_Conn));
	$row_RecordScalesource = mysqli_fetch_assoc($RecordScalesource);
	
	if (isset($_GET['totalRows_RecordScalesource'])) {
	  $totalRows_RecordScalesource = $_GET['totalRows_RecordScalesource'];
	} else {
	  $all_RecordScalesource = mysqli_query($DB_Conn, $query_RecordScalesource);
	  $totalRows_RecordScalesource = mysqli_num_rows($all_RecordScalesource);
	}
	$totalPages_RecordScalesource = ceil($totalRows_RecordScalesource/$maxRows_RecordScalesource)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScalesource > '0') { ?>
<?php do { ?>
  <?php 
  
    if($row_RecordScalesource['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/scalesource/thumb/small_'.GetFileThumbExtend($row_RecordScalesource['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "manage_scalesource.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scalesource.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScalesource['id'];
	$link_edit = "manage_scalesource.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScalesource['id'];
	$link_start = "manage_scalesource.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	$link_mainphoto = "uplod_scalesource.php?id_edit=".$row_RecordScalesource['id']."&amp;lang=".$_SESSION['lang'];
	$link_mutiphoto = "inner_scalesource.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordScalesource['id']."&amp;tn=".$row_RecordScalesource['name'];
	$link_tab = "inner_scalesource.php?wshop=".$wshop."&amp;Opt=edittabpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScalesource['id'];
	
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScalesource["id"].",\"".$row_RecordScalesource["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
	$but_more = "<a href='#' class='btn btn-xs btn-default hidden-xs'>更多</a><a href='#' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'></a><ul class='dropdown-menu pull-left'>";
	$but_more .= "<li><a href='".$link_mainphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 主要相片</a></li>";
	//$but_more .= "<li><a href='".$link_mutiphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 內頁相片(".$totalRows_RecordScalesourcePhotoCount.")</a></li>";
	//$but_more .= "<li><a href='".$link_tab."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 細部資料</a></li>";
	//if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { $but_more .= "<li><a href='#'>特殊規格</a></li>"; }
	$but_more .= "</ul>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScalesource["id"];
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
  	$dvalue['chk'] = "<input name='delScalesource[]' type='checkbox' id='delScalesource[]' value='".$row_RecordScalesource["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordScalesource["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordScalesource["id"]."' data-placement='top'>".$row_RecordScalesource["name"]."</span>";
	
	$dvalue['homeshow'] = "<span id='homeshow_".$row_RecordScalesource["id"]."' class='ed_homeshow' data-type='select' data-pk='".$row_RecordScalesource["id"]."'>".$row_RecordScalesource["homeshow"]."</span>";
	
	
  switch($row_RecordScalesource['plot'])
	  {
		  case "1":
			  $row_RecordScalesource['plot'] = "Hot";			
			  break;
		  case "2":
			  $row_RecordScalesource['plot']="Act";			
			  break;
		  case "3":
			  $row_RecordScalesource['plot']="Sale";			
			  break;
		  case "4":
			  $row_RecordScalesource['plot']="New";			
			  break;	
		  default:
			  $row_RecordScalesource['plot']="None";
			  break;			
	  }
                            
	$dvalue['code'] = "<span class='label label-danger'><span id='code_".$row_RecordScalesource["id"]."' class='ed_code' data-type='text' data-pk='".$row_RecordScalesource["id"]."' data-placement='top'>".$row_RecordScalesource["code"]."</span></span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScalesource["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScalesource["id"]."' data-placement='top'>".$row_RecordScalesource["sortid"]."</span>";
	
	if($row_RecordScalesource["indicate"] == '1') {$row_RecordScalesource["indicate"] = "上架";}else{$row_RecordScalesource["indicate"] = "下架";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScalesource["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScalesource["id"]."' data-placement='top'>".$row_RecordScalesource["indicate"]."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordScalesource["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScalesource = mysqli_fetch_assoc($RecordScalesource)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScalesource), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScalesource);
?>
