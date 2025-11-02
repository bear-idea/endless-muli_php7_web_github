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

if(isset($_POST['search_homeselect'])){
	$search_homeselect = $_POST['search_homeselect'];
}else{
	$search_homeselect = "";
}
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
if(isset($_POST['search_name'])){
	$search_name = $_POST['search_name'];
}else{
	$search_name = "";
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
        //case 1;$orderSql = " ORDER BY title ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        //case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		//case 4;$orderSql = " ORDER BY homeselect ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY webname ".$order_dir;break;
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

$maxRows_RecordTmpBanner = $length;
$startRow_RecordTmpBanner = $start;

$colsearch_RecordTmpBanner = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmpBanner = $DT_search;
}

//$colnamelang_RecordTmpBanner = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmpBanner = $_SESSION['lang'];
}

$colindicate_RecordTmpBanner = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmpBanner = $search_indicate;
}

$colname_RecordTmpBanner = "%";
if (isset($search_name) && $search_name != "") {
  $colname_RecordTmpBanner = $search_name;
}

$coltype_RecordTmpBanner = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmpBanner = $search_type;
}

$coluserid_RecordTmpBanner = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBanner = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_bannershow WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmpBanner, "int"),GetSQLValueString($colnamelang_RecordTmpBanner, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmpBanner = sprintf("SELECT * FROM demo_bannershow WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmpBanner, "text"), GetSQLValueString($colindicate_RecordTmpBanner, "text"),GetSQLValueString($coluserid_RecordTmpBanner, "int"),GetSQLValueString($collang_RecordTmpBanner, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_bannershow WHERE (userid=1)");
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordTmpBanner = sprintf("SELECT * FROM demo_bannershow WHERE (id LIKE %s) && indicate LIKE %s && (userid=1) $orderSql", GetSQLValueString("%" . $colsearch_RecordTmpBanner . "%", "text"), GetSQLValueString($colindicate_RecordTmpBanner, "text"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmpBanner = mysqli_query($DB_Conn, $query_RecordTmpBanner) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBanner = mysqli_fetch_assoc($RecordTmpBanner);
	$totalRows_RecordTmpBanner = mysqli_num_rows($RecordTmpBanner);
	
}else{
	//分頁
	$query_limit_RecordTmpBanner = sprintf("%s LIMIT %d, %d", $query_RecordTmpBanner, $startRow_RecordTmpBanner, $maxRows_RecordTmpBanner);
	$RecordTmpBanner = mysqli_query($DB_Conn, $query_limit_RecordTmpBanner) or die(mysqli_error($DB_Conn));
	$row_RecordTmpBanner = mysqli_fetch_assoc($RecordTmpBanner);
	
	if (isset($_GET['totalRows_RecordTmpBanner'])) {
	  $totalRows_RecordTmpBanner = $_GET['totalRows_RecordTmpBanner'];
	} else {
	  $all_RecordTmpBanner = mysqli_query($DB_Conn, $query_RecordTmpBanner);
	  $totalRows_RecordTmpBanner = mysqli_num_rows($all_RecordTmpBanner);
	}
	$totalPages_RecordTmpBanner = ceil($totalRows_RecordTmpBanner/$maxRows_RecordTmpBanner)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordTmpBanner > '0') { ?>
<?php do { ?>
  <?php 
  
    //$link_view = "../tmpselectbannerid_demo_". $row_RecordTmpBanner['name'].".php?tmpselectbanneridid=".$row_RecordTmpBanner['id'];
  
    if($row_RecordTmpBanner['pic'] !=""){
		if ($SiteBaseUrlOuter != '' && $row_RecordTmpBanner['userid'] == '1') {
    		$link_pic = $SiteImgUrlOuter.$row_RecordTmpBanner['webname'].'/image/bannershow/'.GetFileThumbExtend($row_RecordTmpBanner['pic']);
		}else{
			$link_pic = $SiteImgUrlAdmin.$row_RecordTmpBanner['webname'].'/image/bannershow/'.GetFileThumbExtend($row_RecordTmpBanner['pic']);
		}
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
	$link_edit = "uplod_bannershow.php?lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmpBanner['id'];
	
	// http://localhost/endless-muli_php7/admin/bannerdownload.php?f=201509301556181.jpg&mod=banner
	if ($SiteBaseUrlOuter != '' && $row_RecordTmpBanner['userid'] == '1') {
		$link_download = "bannerdownload.php?f=".$row_RecordTmpBanner['pic']."&amp;mod=banner&amp;linkmod=outer";
	}else{
		$link_download = "bannerdownload.php?f=".$row_RecordTmpBanner['pic']."&amp;mod=banner";
	}
	
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary colorbox_iframe_cd' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	
	$but_download = "<a href='".$link_download."' class='btn btn-xs btn-primary btn-block' style=text-align:center'><i class='fa fa-cloud-download-alt'></i> 下載</a>";
	
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmpBanner["id"];
	
  	$dvalue['chk'] = "<input name='delTmpBanner[]' type='checkbox' id='delTmpBanner[]' value='".$row_RecordTmpBanner["id"]."\'/>";
	
	$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmpBanner['id']."</span>"."<div class='img-thumbnail'><div class='imgLiquidFill' style='width:100%; height:100px;'><img src=".$link_pic." class='img-fluid' ></div></div>";


	 $dvalue['name'] = "<div class='hidden-text'>".$row_RecordTmpBanner["name"]."</div>";

	
	//$dvalue['name'] = $row_RecordTmpBanner["name"];
     
	if($row_RecordTmpBanner["indicate"] == '1') {$row_RecordTmpBanner["indicate"] = "公佈";}else{$row_RecordTmpBanner["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordTmpBanner["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordTmpBanner["id"]."' data-placement='top'>".$row_RecordTmpBanner["indicate"]."</span>";
	
	$dvalue['webname'] = $row_RecordTmpBanner["webname"];
	
	if($w_userid == "1") {
		$dvalue['action'] = "<div class='btn-group'>".$but_edit.$but_download."</div>";
	}else{
		$dvalue['action'] = $but_download;
	}
	
	//$dvalue['content'] = $row_RecordTmpBanner["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordTmpBanner = mysqli_fetch_assoc($RecordTmpBanner)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmpBanner), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmpBanner);
?>
