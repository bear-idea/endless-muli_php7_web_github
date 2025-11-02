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
        case 2;$orderSql = " ORDER BY name ".$order_dir;break;
		case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		case 4;$orderSql = " ORDER BY splitscale ".$order_dir;break;
		case 5;$orderSql = " ORDER BY code ".$order_dir;break;
        case 6;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 7;$orderSql = " ORDER BY indicate ".$order_dir;break;
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

$maxRows_RecordScale = $length;
$startRow_RecordScale = $start;

$colsearch_RecordScale = "%";
if (isset($DT_search)) {
  $colsearch_RecordScale = $DT_search;
}

//$colnamelang_RecordScale = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScale = $_SESSION['lang'];
}

$colindicate_RecordScale = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordScale = $search_indicate;
}

$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}

$coltype1_RecordScale = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordScale = $search_type1;
}
$coltype2_RecordScale = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordScale = $search_type2;
}
$coltype3_RecordScale = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordScale = $search_type3;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scale WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScale, "int"),GetSQLValueString($colnamelang_RecordScale, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScale, "text"), GetSQLValueString($colindicate_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"),GetSQLValueString($collang_RecordScale, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scale WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE name LIKE %s && indicate LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordScale . "%", "text"), GetSQLValueString($colindicate_RecordScale, "text"),GetSQLValueString($coltype1_RecordScale, "text"),GetSQLValueString($coltype2_RecordScale, "text"),GetSQLValueString($coltype3_RecordScale, "text"),GetSQLValueString($collang_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
	$row_RecordScale = mysqli_fetch_assoc($RecordScale);
	$totalRows_RecordScale = mysqli_num_rows($RecordScale);
	
}else{
	//分頁
	$query_limit_RecordScale = sprintf("%s LIMIT %d, %d", $query_RecordScale, $startRow_RecordScale, $maxRows_RecordScale);
	$RecordScale = mysqli_query($DB_Conn, $query_limit_RecordScale) or die(mysqli_error($DB_Conn));
	$row_RecordScale = mysqli_fetch_assoc($RecordScale);
	
	if (isset($_GET['totalRows_RecordScale'])) {
	  $totalRows_RecordScale = $_GET['totalRows_RecordScale'];
	} else {
	  $all_RecordScale = mysqli_query($DB_Conn, $query_RecordScale);
	  $totalRows_RecordScale = mysqli_num_rows($all_RecordScale);
	}
	$totalPages_RecordScale = ceil($totalRows_RecordScale/$maxRows_RecordScale)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScale > '0') { ?>
<?php do { ?>
  <?php 
  
    if($row_RecordScale['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/scale/thumb/small_'.GetFileThumbExtend($row_RecordScale['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "manage_scale.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scale.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScale['id'];
	$link_edit = "manage_scale.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScale['id'];
	$link_start = "manage_scale.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	$link_mainphoto = "uplod_scale.php?id_edit=".$row_RecordScale['id']."&amp;lang=".$_SESSION['lang'];
	$link_mutiphoto = "inner_scale.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordScale['id']."&amp;tn=".$row_RecordScale['name'];
	$link_tab = "inner_scale.php?wshop=".$wshop."&amp;Opt=edittabpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScale['id'];
	$link_pricelist = "inner_scale.php?wshop=".$wshop."&amp;Opt=pricelist&amp;lang=".$_SESSION['lang']."&amp;code=".$row_RecordScale['code']."&amp;id=".$row_RecordScale['id']."&amp;pdname=".urlencode($row_RecordScale['name']);
	
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScale["id"].",\"".$row_RecordScale["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
	$but_more = "<a href='#' class='btn btn-xs btn-default hidden-xs'>更多</a><a href='#' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'></a><ul class='dropdown-menu pull-left'>";
	$but_more .= "<li><a href='".$link_mainphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 主要相片</a></li>";
	$but_mainphoto = "<a href='".$link_mainphoto."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 主要相片</a>";
	$but_pricelist = "<a href='".$link_pricelist."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-list-alt'></i> 區間價格</a>";
	//$but_more .= "<li><a href='".$link_mutiphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 內頁相片(".$totalRows_RecordScalePhotoCount.")</a></li>";
	//$but_more .= "<li><a href='".$link_tab."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 細部資料</a></li>";
	//if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { $but_more .= "<li><a href='#'>特殊規格</a></li>"; }
	$but_more .= "</ul>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScale["id"];
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
  	$dvalue['chk'] = "<input name='delScale[]' type='checkbox' id='delScale[]' value='".$row_RecordScale["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordScale["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordScale["id"]."' data-placement='top'>".$row_RecordScale["name"]."</span>";
	
  $colname_RecordScalepricelist = "-1";
  if (isset($row_RecordScale["code"])) {
	$colname_RecordScalepricelist = $row_RecordScale["code"];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordScalepricelist = sprintf("SELECT * FROM erp_scalepricelist WHERE code = %s && userid=%s ORDER BY enddate DESC LIMIT 1", GetSQLValueString($colname_RecordScalepricelist, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
  $RecordScalepricelist = mysqli_query($DB_Conn, $query_RecordScalepricelist) or die(mysqli_error($DB_Conn));
  $row_RecordScalepricelist = mysqli_fetch_assoc($RecordScalepricelist);
  $totalRows_RecordScalepricelist = mysqli_num_rows($RecordScalepricelist);
  
	if($row_RecordScalepricelist["enddate"] != ""){
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>最新日期 <i class='fa fa-info-circle text-white' data-original-title='顯示價格列表中最新一筆資訊' data-toggle='tooltip' data-placement='top'></i></span> <span class='text-lime-darker'>".$row_RecordScalepricelist["enddate"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>最新日期 <i class='fa fa-info-circle text-white' data-original-title='顯示價格列表中最新一筆資訊' data-toggle='tooltip' data-placement='top'></i></span> <span class='editable-empty'>".'Empty'."</span></div>";
	}
	
	if($row_RecordScalepricelist["enddate"] != ""){
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>最新價格 <i class='fa fa-info-circle text-white' data-original-title='顯示價格列表中最新一筆資訊' data-toggle='tooltip' data-placement='top'></i></span> <span class='text-lime-darker'>".$row_RecordScalepricelist["price"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>最新價格 <i class='fa fa-info-circle text-white' data-original-title='顯示價格列表中最新一筆資訊' data-toggle='tooltip' data-placement='top'></i></span> <span class='editable-empty'>".'Empty'."</span></div>";
	}
	
	if($row_RecordScale["state"] != ""){
		if($row_RecordScale["state"] == 'sell') {$row_RecordScale["state"] = "應收(對方付費，我方收款)";}
		if($row_RecordScale["state"] == 'buy') {$row_RecordScale["state"] = "應付(我方付費，對方取款)";}
	    if($row_RecordScale["state"] == 'free') {$row_RecordScale["state"] = "無償(無須付費)";}
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>即時狀況 <i class='fa fa-info-circle text-white' data-original-title='即時顯示價格狀況' data-toggle='tooltip' data-placement='top'></i></span> <span class='text-lime-darker'>".$row_RecordScale["state"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>即時狀況 <i class='fa fa-info-circle text-white' data-original-title='即時顯示價格狀況' data-toggle='tooltip' data-placement='top'></i></span> <span class='editable-empty'>".'Empty'."</span></div>";
	}
	
	$dvalue['homeshow'] = "<span id='homeshow_".$row_RecordScale["id"]."' class='ed_homeshow' data-type='select' data-pk='".$row_RecordScale["id"]."'>".$row_RecordScale["homeshow"]."</span>";	
	           
	$dvalue['code'] = "<span class='label label-danger'><span id='code_".$row_RecordScale["id"]."' class='ed_code' data-type='text' data-pk='".$row_RecordScale["id"]."' data-placement='top'>".$row_RecordScale["code"]."</span></span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScale["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScale["id"]."' data-placement='top'>".$row_RecordScale["sortid"]."</span>";
	
	if($row_RecordScale["type"] != ""){
		$dvalue['type'] = "<span id='type_".$row_RecordScale["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordScale["id"]."' data-placement='top'>".$row_RecordScale["type"]."</span>";
	}else{
		$dvalue['type'] = "<span id='type_".$row_RecordScale["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordScale["id"]."' data-placement='top'>"."<span class='editable-empty'>".'Empty'."</span>"."</span>";
	}
	
	if($row_RecordScale["indicate"] == '1') {$row_RecordScale["indicate"] = "上架";}else{$row_RecordScale["indicate"] = "下架";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScale["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScale["id"]."' data-placement='top'>".$row_RecordScale["indicate"]."</span>";
	
	if($row_RecordScale["state"] == 'sell') {$row_RecordScale["state"] = "應收(對方付費，我方收款)";}
	if($row_RecordScale["state"] == 'pay') {$row_RecordScale["state"] = "應付(我方付費，對方取款)";}
	if($row_RecordScale["state"] == 'free') {$row_RecordScale["state"] = "無償(無須付費)";}
	$dvalue['state'] = $row_RecordScale["state"];
	
	if($row_RecordScale["splitscale"] == '1') {$row_RecordScale["splitscale"] = "大磅";}else{$row_RecordScale["splitscale"] = "小磅";}
	$dvalue['splitscale'] = "<span id='splitscale_".$row_RecordScale["id"]."' class='ed_splitscale' data-type='select' data-pk='".$row_RecordScale["id"]."' data-placement='top'>".$row_RecordScale["splitscale"]."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_mainphoto.$but_pricelist."</div>";
	//$dvalue['content'] = $row_RecordScale["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScale = mysqli_fetch_assoc($RecordScale)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScale), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScale);
?>
