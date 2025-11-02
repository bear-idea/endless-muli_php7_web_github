<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('inc_setting.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once("../../inc/inc_function.php"); // 取得模組名稱?>
<?php //require_once("../../inc/inc_function.php"); ?>
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

$maxRows_RecordDfType = $length;
$startRow_RecordDfType = $start;

$colsearch_RecordDfType = "%";
if (isset($DT_search)) {
  $colsearch_RecordDfType = $DT_search;
}

//$colnamelang_RecordDfType = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordDfType = $_SESSION['lang'];
}

$colindicate_RecordDfType = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordDfType = $search_indicate;
}

$coluserid_RecordDfType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfType = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_dftype WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordDfType, "int"),GetSQLValueString($colnamelang_RecordDfType, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordDfType = sprintf("SELECT * FROM demo_dftype WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordDfType, "text"), GetSQLValueString($colindicate_RecordDfType, "text"),GetSQLValueString($coluserid_RecordDfType, "int"),GetSQLValueString($collang_RecordDfType, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum, sum(home) as homesum FROM demo_dftype WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordDfType, "text"),GetSQLValueString($coluserid_RecordDfType, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordDfType = sprintf("SELECT * FROM demo_dftype WHERE title LIKE %s && indicate LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordDfType . "%", "text"), GetSQLValueString($colindicate_RecordDfType, "text"),GetSQLValueString($collang_RecordDfType, "text"),GetSQLValueString($coluserid_RecordDfType, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType) or die(mysqli_error($DB_Conn));
	$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
	$totalRows_RecordDfType = mysqli_num_rows($RecordDfType);
	
}else{
	//分頁
	$query_limit_RecordDfType = sprintf("%s LIMIT %d, %d", $query_RecordDfType, $startRow_RecordDfType, $maxRows_RecordDfType);
	$RecordDfType = mysqli_query($DB_Conn, $query_limit_RecordDfType) or die(mysqli_error($DB_Conn));
	$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
	
	if (isset($_GET['totalRows_RecordDfType'])) {
	  $totalRows_RecordDfType = $_GET['totalRows_RecordDfType'];
	} else {
	  $all_RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType);
	  $totalRows_RecordDfType = mysqli_num_rows($all_RecordDfType);
	}
	$totalPages_RecordDfType = ceil($totalRows_RecordDfType/$maxRows_RecordDfType)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordDfType > '0') { ?>
<?php do { ?>
  <?php 
  
	  switch($row_RecordDfType['typemenu']) // 抓取模組代碼
	  {
		  case "News":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['News']."\" data-toggle=\"tooltip\"><img src=\"images/mt_001.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Coupons":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Coupons']."\" data-toggle=\"tooltip\"><img src=\"images/mt_056.png.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Timeline":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Timeline']."\" data-toggle=\"tooltip\"><img src=\"images/mt_057.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Imageshow":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Imageshow']."\" data-toggle=\"tooltip\"><img src=\"images/mt_058.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Stronghold":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Stronghold']."\" data-toggle=\"tooltip\"><img src=\"images/mt_059.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Picasa":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Picasa']."\" data-toggle=\"tooltip\"><img src=\"images/mt_052.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "About":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['About']."\" data-toggle=\"tooltip\"><img src=\"images/mt_041.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Article":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Article']."\" data-toggle=\"tooltip\"><img src=\"images/mt_008.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Product":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Product']."\" data-toggle=\"tooltip\"><img src=\"images/mt_002.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Guestbook":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Guestbook']."\" data-toggle=\"tooltip\"><img src=\"images/mt_007.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Activities":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Activities']."\" data-toggle=\"tooltip\"><img src=\"images/mt_014.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Project":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Project']."\" data-toggle=\"tooltip\"><img src=\"images/mt_032.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Frilink":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Frilink']."\" data-toggle=\"tooltip\"><img src=\"images/mt_006.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Modlink":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Modlink']."\" data-toggle=\"tooltip\"><img src=\"images/mt_065.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Otrlink":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Otrlink']."\" data-toggle=\"tooltip\"><img src=\"images/mt_051.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Sponsor":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Sponsor']."\" data-toggle=\"tooltip\"><img src=\"images/mt_011.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Publish":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Publish']."\" data-toggle=\"tooltip\"><img src=\"images/mt_003.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Letters":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Letters']."\" data-toggle=\"tooltip\"><img src=\"images/mt_020.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Meeting":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Meeting']."\" data-toggle=\"tooltip\"><img src=\"images/mt_009.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Donation":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Donation']."\" data-toggle=\"tooltip\"><img src=\"images/mt_015.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Org":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Org']."\" data-toggle=\"tooltip\"><img src=\"images/mt_017.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Member":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Member']."\" data-toggle=\"tooltip\"><img src=\"images/mt_013.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Careers":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Careers']."\" data-toggle=\"tooltip\"><img src=\"images/mt_016.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Actnews":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Actnews']."\" data-toggle=\"tooltip\"><img src=\"images/mt_021.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Faq":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Faq']."\" data-toggle=\"tooltip\"><img src=\"images/mt_024.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Catalog":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Catalog']."\" data-toggle=\"tooltip\"><img src=\"images/mt_033.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Cart":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Cart']."\" data-toggle=\"tooltip\"><img src=\"images/mt_036.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Forum":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Forum']."\" data-toggle=\"tooltip\"><img src=\"images/mt_029.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Contact":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Contact']."\" data-toggle=\"tooltip\"><img src=\"images/mt_040.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Blog":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Blog']."\" data-toggle=\"tooltip\"><img src=\"images/mt_047.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Album":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Album']."\" data-toggle=\"tooltip\"><img src=\"images/mt_012.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "MailSend":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['MailSend']."\" data-toggle=\"tooltip\"><img src=\"images/mt_005.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Knowledge":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Knowledge']."\" data-toggle=\"tooltip\"><img src=\"images/mt_031.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "EPaper":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['EPaper']."\" data-toggle=\"tooltip\"><img src=\"images/mt_022.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Partner":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Partner']."\" data-toggle=\"tooltip\"><img src=\"images/mt_026.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "AD":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['AD']."\" data-toggle=\"tooltip\"><img src=\"images/mt_028.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Video":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Video']."\" data-toggle=\"tooltip\"><img src=\"images/mt_010.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Artlist":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Artlist']."\" data-toggle=\"tooltip\"><img src=\"images/mt_027.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Room":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Room']."\" data-toggle=\"tooltip\"><img src=\"images/mt_067.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Attractions":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Attractions']."\" data-toggle=\"tooltip\"><img src=\"images/mt_068.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Dealer":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Dealer']."\" data-toggle=\"tooltip\"><img src=\"images/mt_077.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "DfType":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['DfType']."\" data-toggle=\"tooltip\"><img src=\"images/mt_043.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "DfPage":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['DfPage']."\" data-toggle=\"tooltip\"><img src=\"images/mt_043.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  case "Home":
			  $mod_show = "<a data-original-title=\"目前模組:"."首頁"."\" data-toggle=\"tooltip\"><img src=\"images/mt_019.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Scalesource":
			  $mod_show = "<a data-original-title=\"目前模組:"."貨源管理"."\" data-toggle=\"tooltip\"><img src=\"images/mt_101.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Splitorder":
			  $mod_show = "<a data-original-title=\"目前模組:"."物料拆分"."\" data-toggle=\"tooltip\"><img src=\"images/mt_107.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Booking":
			  $mod_show = "<a data-original-title=\"目前模組:"."預約系統"."\" data-toggle=\"tooltip\"><img src=\"images/mt_105.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Cart_Note":
			  $mod_show = "<a data-original-title=\"目前模組:"."購物車 - 購物需知"."\" data-toggle=\"tooltip\"><img src=\"images/mt_091.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "Cart_Pay":
			  $mod_show = "<a data-original-title=\"目前模組:"."購物車 - 匯款通知"."\" data-toggle=\"tooltip\"><img src=\"images/mt_088.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
		  case "AnchorPoint":
			  $mod_show = "<a data-original-title=\"目前模組:"."錨點"."\" data-toggle=\"tooltip\"><img src=\"images/mt_125.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;	
		  default:
			  $mod_show = "<a data-original-title=\"目前模組:"."無"."\" data-toggle=\"tooltip\"><img src=\"images/mt_054.png\" alt=\"\" width=\"60\" height=\"60\" /></a>";
			  break;
	  }
  
    if (($totalRows_RecordDfType < $Site_DfPage_Limit_Page_Num) || $_SESSION['MM_UserGroup'] == 'superadmin') {
    	$link_add = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=typeaddpage&amp;lang=".$_SESSION['lang'];
    }else{
     	$link_add = "#";
    }
	//$link_copy = "manage_dftype.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfType['id'];
	if ($row_RecordDfType['typemenu'] == 'Link' || $row_RecordDfType['typemenu'] == 'LinkPage') {
		$link_edit = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=typelinkeditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfType['id'];
	}elseif($row_RecordDfType['typemenu'] == 'AnchorPoint'){
		$link_edit = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=typeanchorpointeditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfType['id'];
	}else{
		$link_edit = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=typeeditpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordDfType['id'];
	}
	$link_start = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
	$link_page = "manage_dfpage.php?wshop=".$wshop."&amp;Opt=viewpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordDfType['id']."&amp;tpt=".$row_RecordDfType['title'];
    //$link_del = "#modal-alert";
	if (($totalRows_RecordDfType < $Site_DfPage_Limit_Page_Num) || $_SESSION['MM_UserGroup'] == 'superadmin') {
		$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	}else{
		$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary disabled' style='text-align:center' data-original-title='已達可新增上限，目前你所能新增的選單至多【".$Site_DfPage_Limit_Page_Num."】個。' data-toggle='tooltip' data-placement='top'><i class='fa fa-plus'></i> 新增</a>";
	}
	
	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	if ($row_RecordDfType['typemenu'] == 'DfType' || $row_RecordDfType['typemenu'] == 'DfPage') {
		$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables_page(".$row_RecordDfType["id"].",event)'><i class='far fa-trash-alt'></i> 刪除</a>";
	}else{
		$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordDfType["id"].",event)'><i class='far fa-trash-alt'></i> 刪除</a>";
	}
	
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordDfType["id"];
  	$dvalue['chk'] = "<input name='delDfType[]' type='checkbox' id='delDfType[]' value='".$row_RecordDfType["id"]."\'/>";
	$dvalue['title'] = "<span id='title_".$row_RecordDfType["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordDfType["id"]."' data-placement='top'>".$row_RecordDfType["title"]."</span>";
	if($row_RecordCount['homesum'] == '0') { $HaveSetStartPage = '(此項目必須設定一個)'; }else{  $HaveSetStartPage = ''; }
	if($row_RecordDfType['home'] == 1){$dvalue['title'] = $dvalue['title']."<a href='".$link_start."' class='btn btn-warning btn-xs pull-right'><i class='fa fa-check-circle'></i> 起始頁".$HaveSetStartPage."<a>";}else{$dvalue['title'] = $dvalue['title']."<a href='".$link_start."' class='btn btn-grey btn-xs pull-right'><i class='fa fa-circle'></i> 起始頁".$HaveSetStartPage."<a>";}
	if($row_RecordDfType['typemenu'] == 'DfType' || $row_RecordDfType['typemenu'] == 'DfPage'){
		$dvalue['title'] = $dvalue['title']."<a href='".$link_page."' class='btn btn-primary btn-xs pull-right m-r-5' data-original-title='點選查看此項目下的所有文章或分類' data-toggle='tooltip' data-placement='right'><i class='far fa-file-alt'></i> 頁面內容<a>";
	}else if(($row_RecordDfType['typemenu'] != 'DfType' || $row_RecordDfType['typemenu'] != 'DfPage') && $_SESSION['MM_UserGroup'] == 'superadmin'){
		$dvalue['title'] = $dvalue['title']."<a href='".$link_page."' class='btn btn-danger btn-xs pull-right m-r-5' data-original-title='點選查看此項目下的所有文章或分類' data-toggle='tooltip' data-placement='right'><i class='far fa-file-alt'></i> 頁面內容<a>";
	}
	
	if($row_RecordDfType['typemenu'] == "DfType" || $row_RecordDfType['typemenu'] == "DfPage") {
		$pagelink = $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfType['typemenu']),array('wshop'=>$wshop,'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','aid'=>$row_RecordDfType['id']),'',$UrlWriteEnable);
	}
	
	else if ($row_RecordDfType['typemenu'] == 'Link' || $row_RecordDfType['typemenu'] == 'LinkPage') {
		$pagelink = $row_RecordDfType['link'];
	}
	
	else if ($row_RecordDfType['typemenu'] == 'Cart_Note') {
		$pagelink = $SiteBaseUrl . url_rewrite(strtolower("cart"),array('wshop'=>$wshop,'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes','aid'=>$row_RecordDfType['id']),'',$UrlWriteEnable);
	}
	
	else if ($row_RecordDfType['typemenu'] == 'Cart_Pay') {
		$pagelink = $SiteBaseUrl . url_rewrite(strtolower("cart"),array('wshop'=>$wshop,'lang'=>$_SESSION['lang'],'Opt'=>'payok','aid'=>$row_RecordDfType['id']),'',$UrlWriteEnable);
	}
	
	else if ($row_RecordDfType['typemenu'] == 'AnchorPoint') {
		$pagelink = "#AnchorPoint_" . $row_RecordDfType['link'];
	}
	
	else if ($row_RecordDfType['typemenu'] == 'Booking') {
		$pagelink = $SiteBaseUrl . url_rewrite(strtolower("booking"),array('wshop'=>$wshop,'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);
	}
	
	else {
		$pagelink = $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfType['typemenu']),array('wshop'=>$wshop,'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);
	}
	
	
	$dvalue['title'] .= "<div>"."<a href='$pagelink' class='btn btn-link btn-xs'>".$pagelink."</a>"."</div>";
	
	//$dvalue['title'] = $dvalue['title'] . "<div><span class='label label-lime'>網址</span> ".$row_RecordDfType['typemenu']."</div>";
	
	$dvalue['mod'] = $mod_show;
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordDfType["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordDfType["id"]."' data-placement='top'>".$row_RecordDfType["sortid"]."</span>";
	if($row_RecordDfType["indicate"] == '1') {$row_RecordDfType["indicate"] = "公佈";}else{$row_RecordDfType["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordDfType["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordDfType["id"]."' data-placement='top'>".$row_RecordDfType["indicate"]."</span>";;
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordDfType["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordDfType = mysqli_fetch_assoc($RecordDfType)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordDfType), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordDfType);
?>
