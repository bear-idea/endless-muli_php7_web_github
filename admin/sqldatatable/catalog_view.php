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
        case 3;$orderSql = " ORDER BY type ".$order_dir;break;
        case 4;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 5;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordCatalog = $length;
$startRow_RecordCatalog = $start;

$colsearch_RecordCatalog = "%";
if (isset($DT_search)) {
  $colsearch_RecordCatalog = $DT_search;
}

//$colnamelang_RecordCatalog = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCatalog = $_SESSION['lang'];
}

$colindicate_RecordCatalog = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordCatalog = $search_indicate;
}

$coltype_RecordCatalog = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordCatalog = $search_type;
}

$coluserid_RecordCatalog = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCatalog = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_catalog WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordCatalog, "int"),GetSQLValueString($colnamelang_RecordCatalog, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordCatalog = sprintf("SELECT * FROM demo_catalog WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordCatalog, "text"), GetSQLValueString($colindicate_RecordCatalog, "text"),GetSQLValueString($coluserid_RecordCatalog, "int"),GetSQLValueString($collang_RecordCatalog, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_catalog WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordCatalog, "text"),GetSQLValueString($coluserid_RecordCatalog, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordCatalog = sprintf("SELECT * FROM demo_catalog WHERE title LIKE %s && indicate LIKE %s && type LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordCatalog . "%", "text"), GetSQLValueString($colindicate_RecordCatalog, "text"), GetSQLValueString($coltype_RecordCatalog, "text"),GetSQLValueString($collang_RecordCatalog, "text"),GetSQLValueString($coluserid_RecordCatalog, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordCatalog = mysqli_query($DB_Conn, $query_RecordCatalog) or die(mysqli_error($DB_Conn));
	$row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog);
	$totalRows_RecordCatalog = mysqli_num_rows($RecordCatalog);
	
}else{
	//分頁
	$query_limit_RecordCatalog = sprintf("%s LIMIT %d, %d", $query_RecordCatalog, $startRow_RecordCatalog, $maxRows_RecordCatalog);
	$RecordCatalog = mysqli_query($DB_Conn, $query_limit_RecordCatalog) or die(mysqli_error($DB_Conn));
	$row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog);
	
	if (isset($_GET['totalRows_RecordCatalog'])) {
	  $totalRows_RecordCatalog = $_GET['totalRows_RecordCatalog'];
	} else {
	  $all_RecordCatalog = mysqli_query($DB_Conn, $query_RecordCatalog);
	  $totalRows_RecordCatalog = mysqli_num_rows($all_RecordCatalog);
	}
	$totalPages_RecordCatalog = ceil($totalRows_RecordCatalog/$maxRows_RecordCatalog)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordCatalog > '0') { ?>
<?php do { ?>
  <?php 

    $link_add = "manage_catalog.php?wshop=".$wshop."&amp;Opt=addpage_s&amp;lang=".$_SESSION['lang'];
	
	if($row_RecordCatalog['menutype'] == 'file') {
		$link_edit = "manage_catalog.php?wshop=".$wshop."&amp;Opt=editpage_d&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCatalog['id'];
	}else if($row_RecordCatalog['menutype'] == 'link'){
		$link_edit = "manage_catalog.php?wshop=".$wshop."&amp;Opt=editpage_l&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCatalog['id'];
	}else if($row_RecordCatalog['menutype'] == 'page'){
		$link_edit = "manage_catalog.php?wshop=".$wshop."&amp;Opt=editpage_p&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCatalog['id'];
	}
	
	$link_start = "manage_catalog.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$link_mix = "manage_catalog.php?wshop=".$wshop."&amp;Opt=mix&amp;lang=".$_SESSION['lang']."&amp;id_choose=".$row_RecordCatalog['id'];
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordCatalog["id"].",\"".$row_RecordCatalog["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordCatalog["id"];
	
  	$dvalue['chk'] = "<input name='delCatalog[]' type='checkbox' id='delCatalog[]' value='".$row_RecordCatalog["id"]."\'/>";
	
	if ($row_RecordCatalog['pic'] != "") {
		switch(GetFileExtend($row_RecordCatalog['pic']))
		{
			case ".pdf":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_01.png\" alt=\"ADOBE PDF\"/></a>\n";			
				break;
			case ".xlsx":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_02.png\" alt=\"EXCEL\"/></a>\n";			
				break;
			case ".xls":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_02.png\" alt=\"EXCEL\"/></a>\n";			
				break;
			case ".doc":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_03.png\" alt=\"WORD\"/></a>\n";			
				break;
			case ".docx":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_03.png\" alt=\"WORD\"/></a>\n";			
				break;
			case ".rar":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_04.png\" alt=\"壓縮檔\"/></a>\n";			
				break;
			case ".zip":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_04.png\" alt=\"壓縮檔\"/></a>\n";	
				break;
			case ".avi":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_07.png\" alt=\"影片檔\"/></a>\n";	
				break;
			case ".ppt":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_08.png\" alt=\"POWERPOINT\"/></a>\n";			
				break;
			case ".pptx":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_08.png\" alt=\"POWERPOINT\"/></a>\n";			
				break;
			case ".jpg":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";			
				break;
			case ".gif":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";			
				break;
			case ".png":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";			
				break;
			case ".bmp":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";
				break;
			case ".jpeg":
				$dvalue['pic'] = "<a href=\"" . $SiteImgUrlAdmin . $wshop . "/image/catalog/" . $row_RecordCatalog['pic'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";	
				break;	
			default:
				$dvalue['pic'] = "<img src=\"images/sicon/cat_06.png\" alt=\"未知格式\"/>\n";
				break;
		}
	}else{
		if ($row_RecordCatalog['link'] != "") {
			$dvalue['pic'] = "<a href=\"" . $row_RecordCatalog['link'] . "\"" . "target=\"_blank\"><img src=\"images/sicon/cat_link.png\" /></a>\n";
		}else{
			$dvalue['pic'] = "<img src=\"images/sicon/cat_06.png\" alt=\"未知格式\"/>\n";
		}
	}
						
	//$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordCatalog["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordCatalog["id"]."' data-placement='top'>".$row_RecordCatalog["title"]."</span>";
	
	if($OptionProductSelect == "1") {
		if($row_RecordCatalog['productmixid'] != "")
		{
			$dvalue['title'] .= $dvalue['title']."<a href='".$link_mix."' class='btn btn-warning btn-xs pull-right' data-original-title='若您有需要可將此資料加入至".$ModuleName['Product']."，若".$ModuleName['Product']."頁面中無任何資料則該區塊不會顯示。' data-toggle='tooltip' data-placement='right'><i class='fa fa-check-circle'></i> 整合至".$ModuleName['Product']."<a>";
		}else{
			$dvalue['title'] .= $dvalue['title']."<a href='".$link_mix."' class='btn btn-grey btn-xs pull-right' data-original-title='若您有需要可將此資料加入至".$ModuleName['Product']."，若".$ModuleName['Product']."頁面中無任何資料則該區塊不會顯示。' data-toggle='tooltip' data-placement='right'><i class='fa fa-circle'></i> 整合至".$ModuleName['Product']."<a>";
		}
	}

    if($row_RecordCatalog["sdescription"] != ""){
		$dvalue['title'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordCatalog["id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordCatalog["id"]."' data-placement='top'>".$row_RecordCatalog["sdescription"]."</span></div>";
	}else{
		$dvalue['title'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordCatalog["id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordCatalog["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	
	$dvalue['type'] = "<span id='type_".$row_RecordCatalog["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordCatalog["id"]."' data-placement='top'>".$row_RecordCatalog["type"]."</span>";
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordCatalog["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordCatalog["id"]."' data-placement='top'>".$row_RecordCatalog["sortid"]."</span>";
	
	if($row_RecordCatalog["indicate"] == '1') {$row_RecordCatalog["indicate"] = "公佈";}else{$row_RecordCatalog["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordCatalog["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordCatalog["id"]."'>".$row_RecordCatalog["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordCatalog['postdate']);
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordCatalog["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordCatalog["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordCatalog["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordCatalog), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordCatalog);
?>
