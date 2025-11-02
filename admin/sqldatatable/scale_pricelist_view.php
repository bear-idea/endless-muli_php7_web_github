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

$search_search_mode = $_POST['search_search_mode'];
if(isset($_POST['search_indicate'])){
	$search_indicate = $_POST['search_indicate'];
}else{
	$search_indicate = "";
}
$search_code = $_GET['code'];

//$search_type1 = $_POST['search_type1'];
//$search_type2 = $_POST['search_type2'];
//$search_type3 = $_POST['search_type3'];

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
		case 2;$orderSql = " ORDER BY price ".$order_dir;break;
		case 3;$orderSql = " ORDER BY startdate ".$order_dir;break;
		case 4;$orderSql = " ORDER BY enddate ".$order_dir;break;
		case 5;$orderSql = " ORDER BY code ".$order_dir;break;
		case 6;$orderSql = " ORDER BY manufacturer ".$order_dir;break;
        case 7;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 8;$orderSql = " ORDER BY indicate ".$order_dir;break;
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

$maxRows_RecordScalepricelist = $length;
$startRow_RecordScalepricelist = $start;

$colsearch_RecordScalepricelist = "%";
if (isset($DT_search)) {
  $colsearch_RecordScalepricelist = $DT_search;
}

$colmanufacturer_RecordScalepricelist = "%";
if (isset($search_manufacturer)) {
  $colmanufacturer_RecordScalepricelist = $search_manufacturer;
}

//$colnamelang_RecordScalepricelist = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScalepricelist = $_SESSION['lang'];
}

$colindicate_RecordScalepricelist = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordScalepricelist = $search_indicate;
}

$coluserid_RecordScalepricelist = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalepricelist = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scale WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScalepricelist, "int"),GetSQLValueString($colnamelang_RecordScalepricelist, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScalepricelist = sprintf("SELECT * FROM erp_scale WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScalepricelist, "text"), GetSQLValueString($colindicate_RecordScalepricelist, "text"),GetSQLValueString($coluserid_RecordScalepricelist, "int"),GetSQLValueString($collang_RecordScalepricelist, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scalepricelist WHERE lang = %s && userid=%s && code=%s",GetSQLValueString($collang_RecordScalepricelist, "text"),GetSQLValueString($coluserid_RecordScalepricelist, "int"),GetSQLValueString($search_code, "text"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScalepricelist = sprintf("SELECT * FROM erp_scalepricelist WHERE name LIKE %s && indicate LIKE %s && lang = %s && userid=%s && code=%s  $orderSql", GetSQLValueString("%" . $colsearch_RecordScalepricelist . "%", "text"), GetSQLValueString($colindicate_RecordScalepricelist, "text"),GetSQLValueString($collang_RecordScalepricelist, "text"),GetSQLValueString($coluserid_RecordScalepricelist, "int"),GetSQLValueString($search_code, "text"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScalepricelist = mysqli_query($DB_Conn, $query_RecordScalepricelist) or die(mysqli_error($DB_Conn));
	$row_RecordScalepricelist = mysqli_fetch_assoc($RecordScalepricelist);
	$totalRows_RecordScalepricelist = mysqli_num_rows($RecordScalepricelist);
	
}else{
	//分頁
	$query_limit_RecordScalepricelist = sprintf("%s LIMIT %d, %d", $query_RecordScalepricelist, $startRow_RecordScalepricelist, $maxRows_RecordScalepricelist);
	$RecordScalepricelist = mysqli_query($DB_Conn, $query_limit_RecordScalepricelist) or die(mysqli_error($DB_Conn));
	$row_RecordScalepricelist = mysqli_fetch_assoc($RecordScalepricelist);
	
	if (isset($_GET['totalRows_RecordScalepricelist'])) {
	  $totalRows_RecordScalepricelist = $_GET['totalRows_RecordScalepricelist'];
	} else {
	  $all_RecordScalepricelist = mysqli_query($DB_Conn, $query_RecordScalepricelist);
	  $totalRows_RecordScalepricelist = mysqli_num_rows($all_RecordScalepricelist);
	}
	$totalPages_RecordScalepricelist = ceil($totalRows_RecordScalepricelist/$maxRows_RecordScalepricelist)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScalepricelist > '0') { ?>
<?php do { ?>
  <?php 
  
    if($row_RecordScalepricelist['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/scale/thumb/small_'.GetFileThumbExtend($row_RecordScalepricelist['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "inner_scale.php?wshop=".$wshop."&amp;Opt=pricelistadd&amp;lang=".$_SESSION['lang']."&amp;code=".$_GET['code'];
	$link_copy = "inner_scale.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScalepricelist['id']."&amp;code=".$_GET['code'];
	$link_edit = "inner_scale.php?wshop=".$wshop."&amp;Opt=pricelistedit&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScalepricelist['id']."&amp;code=".$_GET['code'];
	$link_start = "manage_scale.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	$link_mainphoto = "uplod_scale.php?id_edit=".$row_RecordScalepricelist['id']."&amp;lang=".$_SESSION['lang'];
	$link_mutiphoto = "inner_scale.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordScalepricelist['id']."&amp;tn=".$row_RecordScalepricelist['name'];
	$link_tab = "inner_scale.php?wshop=".$wshop."&amp;Opt=edittabpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScalepricelist['id'];
	$link_pricelist = "inner_scale.php?wshop=".$wshop."&amp;Opt=pricelist&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordScalepricelist['id']."&amp;tn=".$row_RecordScalepricelist['name'];
	
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScalepricelist["id"].",\"".$row_RecordScalepricelist["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
	$but_more = "<a href='#' class='btn btn-xs btn-default hidden-xs'>更多</a><a href='#' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'></a><ul class='dropdown-menu pull-left'>";
	$but_more .= "<li><a href='".$link_mainphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 主要相片</a></li>";
	$but_mainphoto = "<a href='".$link_mainphoto."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 主要相片</a>";
	$but_pricelist = "<a href='".$link_pricelist."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-list-alt'></i> 區間價格</a>";
	//$but_more .= "<li><a href='".$link_mutiphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 內頁相片(".$totalRows_RecordScalepricelistPhotoCount.")</a></li>";
	//$but_more .= "<li><a href='".$link_tab."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 細部資料</a></li>";
	//if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { $but_more .= "<li><a href='#'>特殊規格</a></li>"; }
	$but_more .= "</ul>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScalepricelist["id"];
	
  	$dvalue['chk'] = "<input name='delScale[]' type='checkbox' id='delScale[]' value='".$row_RecordScalepricelist["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordScalepricelist["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordScalepricelist["id"]."' data-placement='top'>".$row_RecordScalepricelist["name"]."</span>";
                       
	$dvalue['code'] = "<span class='label label-danger'><span id='code_".$row_RecordScalepricelist["id"]."' class='ed_code' data-type='text' data-pk='".$row_RecordScalepricelist["id"]."' data-placement='top'>".$row_RecordScalepricelist["code"]."</span></span>";
	
	$dvalue['startdate'] = $row_RecordScalepricelist["startdate"];
	
	$dvalue['enddate'] = $row_RecordScalepricelist["enddate"];
	
	$dvalue['price'] = $row_RecordScalepricelist["price"];
	
	if($row_RecordScalepricelist["price"] != "" && $row_RecordScalepricelist["price"] > 0){
		$dvalue['price'] .= "<span class='label label-success pull-right'>應收</span>";
	}elseif($row_RecordScalepricelist["price"] != "" && $row_RecordScalepricelist["price"] < 0){
		$dvalue['price'] .= "<span class='label label-warning pull-right'>應付</span>";
	}elseif($row_RecordScalepricelist["price"] != "" && $row_RecordScalepricelist["price"] = 0){
		$dvalue['price'] .= "<span class='label label-secondary pull-right'>無償</span>";
	}
	
	$dvalue['mode'] = "";
	
	if($row_RecordScalepricelist["mode"] == 0){
		$dvalue['mode'] .= "依重量";
	}
	
	if($row_RecordScalepricelist["mode"] == 1){
		$dvalue['mode'] .= "依趟次";
	}
	
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScalepricelist["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScalepricelist["id"]."' data-placement='top'>".$row_RecordScalepricelist["sortid"]."</span>";
	
	if($row_RecordScalepricelist["indicate"] == '1') {$row_RecordScalepricelist["indicate"] = "上架";}else{$row_RecordScalepricelist["indicate"] = "下架";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScalepricelist["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScalepricelist["id"]."' data-placement='top'>".$row_RecordScalepricelist["indicate"]."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordScalepricelist["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScalepricelist = mysqli_fetch_assoc($RecordScalepricelist)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScalepricelist), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScalepricelist);
?>
