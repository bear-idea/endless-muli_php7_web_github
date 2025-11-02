<?php require_once('../../Connections/DB_Conn.php'); ?>
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
        case 1;$orderSql = " ORDER BY name ".$order_dir;break;
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

$maxRows_RecordFrilink = $length;
$startRow_RecordFrilink = $start;

$colsearch_RecordFrilink = "%";
if (isset($DT_search)) {
  $colsearch_RecordFrilink = $DT_search;
}

//$colnamelang_RecordFrilink = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordFrilink = $_SESSION['lang'];
}

$colindicate_RecordFrilink = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordFrilink = $search_indicate;
}

$coltype_RecordFrilink = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordFrilink = $search_type;
}

$coluserid_RecordFrilink = "-1";
if (isset($w_userid)) {
  $coluserid_RecordFrilink = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_frilink WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordFrilink, "int"),GetSQLValueString($colnamelang_RecordFrilink, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordFrilink = sprintf("SELECT * FROM demo_frilink WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordFrilink, "text"), GetSQLValueString($colindicate_RecordFrilink, "text"),GetSQLValueString($coluserid_RecordFrilink, "int"),GetSQLValueString($collang_RecordFrilink, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_frilink WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordFrilink, "text"),GetSQLValueString($coluserid_RecordFrilink, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordFrilink = sprintf("SELECT * FROM demo_frilink WHERE name LIKE %s && indicate LIKE %s && type LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordFrilink . "%", "text"), GetSQLValueString($colindicate_RecordFrilink, "text"), GetSQLValueString($coltype_RecordFrilink, "text"),GetSQLValueString($collang_RecordFrilink, "text"),GetSQLValueString($coluserid_RecordFrilink, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordFrilink = mysqli_query($DB_Conn, $query_RecordFrilink) or die(mysqli_error($DB_Conn));
	$row_RecordFrilink = mysqli_fetch_assoc($RecordFrilink);
	$totalRows_RecordFrilink = mysqli_num_rows($RecordFrilink);
	
}else{
	//分頁
	$query_limit_RecordFrilink = sprintf("%s LIMIT %d, %d", $query_RecordFrilink, $startRow_RecordFrilink, $maxRows_RecordFrilink);
	$RecordFrilink = mysqli_query($DB_Conn, $query_limit_RecordFrilink) or die(mysqli_error($DB_Conn));
	$row_RecordFrilink = mysqli_fetch_assoc($RecordFrilink);
	
	if (isset($_GET['totalRows_RecordFrilink'])) {
	  $totalRows_RecordFrilink = $_GET['totalRows_RecordFrilink'];
	} else {
	  $all_RecordFrilink = mysqli_query($DB_Conn, $query_RecordFrilink);
	  $totalRows_RecordFrilink = mysqli_num_rows($all_RecordFrilink);
	}
	$totalPages_RecordFrilink = ceil($totalRows_RecordFrilink/$maxRows_RecordFrilink)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordFrilink > '0') { ?>
<?php do { ?>
  <?php 
  
    if ($row_RecordFrilink['modselect'] == "1") {
    if($row_RecordFrilink['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/frilink/'.GetFileThumbExtend($row_RecordFrilink['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	}else{
		$link_pic = "../images/link/".$row_RecordFrilink['picname'];
	}
  
    $link_add = "manage_frilink.php?wshop=".$wshop."&amp;Opt=addpage_s&amp;lang=".$_SESSION['lang'];
	if($row_RecordFrilink['modselect'] == '0') {
		$link_copy = "manage_frilink.php?wshop=".$wshop."&amp;Opt=copypage_d&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordFrilink['id'];
	}else{
		$link_copy = "manage_frilink.php?wshop=".$wshop."&amp;Opt=copypage_c&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordFrilink['id'];
	}
	
	if($row_RecordFrilink['modselect'] == '0') {
		$link_edit = "manage_frilink.php?wshop=".$wshop."&amp;Opt=editpage_d&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordFrilink['id'];
	}else{
		$link_edit = "manage_frilink.php?wshop=".$wshop."&amp;Opt=editpage_c&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordFrilink['id'];
	}
	
	$link_start = "manage_frilink.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordFrilink["id"].",\"".$row_RecordFrilink["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordFrilink["id"];
	
  	$dvalue['chk'] = "<input name='delFrilink[]' type='checkbox' id='delFrilink[]' value='".$row_RecordFrilink["id"]."\'/>";
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordFrilink["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordFrilink["id"]."' data-placement='top'>".$row_RecordFrilink["name"]."</span>";

    if($row_RecordFrilink["sdescription"] != ""){
		$dvalue['name'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordFrilink["id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordFrilink["id"]."' data-placement='top'>".$row_RecordFrilink["sdescription"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordFrilink["id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordFrilink["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	
	$dvalue['type'] = "<span id='type_".$row_RecordFrilink["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordFrilink["id"]."' data-placement='top'>".$row_RecordFrilink["type"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordFrilink["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordFrilink["id"]."' data-placement='top'>".$row_RecordFrilink["sortid"]."</span>";
	
	if($row_RecordFrilink["indicate"] == '1') {$row_RecordFrilink["indicate"] = "公佈";}else{$row_RecordFrilink["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordFrilink["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordFrilink["id"]."'>".$row_RecordFrilink["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordFrilink['postdate']);
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordFrilink["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordFrilink["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_copy.$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordFrilink["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordFrilink = mysqli_fetch_assoc($RecordFrilink)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordFrilink), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordFrilink);
?>
