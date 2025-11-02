<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php //require_once('inc_setting.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
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

$maxRows_RecordAds = $length;
$startRow_RecordAds = $start;

$colsearch_RecordAds = "%";
if (isset($DT_search)) {
  $colsearch_RecordAds = $DT_search;
}

//$colnamelang_RecordAds = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAds = $_SESSION['lang'];
}

$colindicate_RecordAds = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "顯示") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordAds = $search_indicate;
}

$coluserid_RecordAds = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAds = $w_userid;
}

$colact_id_RecordAds = "-1";
if (isset($search_act_id)) {
  $colact_id_RecordAds = $search_act_id;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_adtype_sub WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordAds, "int"),GetSQLValueString($colnamelang_RecordAds, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordAds = sprintf("SELECT * FROM demo_adtype_sub WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordAds, "text"), GetSQLValueString($colindicate_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"),GetSQLValueString($collang_RecordAds, "text"));

$query_RecordCount = sprintf("SELECT count(actphoto_id) as sum FROM demo_adtype_sub WHERE lang=%s && userid=%s && act_id=%s",GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"),GetSQLValueString($colact_id_RecordAds, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

if($DT_search != "") {
	$query_RecordAds = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype_sub.sdescription, demo_adtype_sub.pic, demo_adtype_sub.indicate, demo_adtype_sub.modshow, demo_adtype.modstyle, demo_adtype.author, demo_adtype.startdate, demo_adtype.enddate, demo_adtype.style, demo_adtype.modstyle, demo_adtype.navigationstate, demo_adtype.tool, demo_adtype.theme, demo_adtype_sub.actphoto_id, demo_adtype_sub.sortid, demo_adtype_sub.animation, demo_adtype_sub.datatransition , demo_adtype.lang FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id HAVING (demo_adtype.act_id = %s) && (demo_adtype.lang = %s) && (demo_adtype_sub.sdescription LIKE %s) && (demo_adtype_sub.indicate LIKE %s) && demo_adtype.userid=%s ORDER BY demo_adtype_sub.actphoto_id DESC", GetSQLValueString($colact_id_RecordAds, "int"),GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString("%" . $colsearch_RecordAds . "%", "text"), GetSQLValueString($colindicate_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"));
	//$query_RecordAds = sprintf("SELECT * FROM demo_adtype_sub WHERE (sdescription LIKE %s) && indicate LIKE %s && lang=%s && userid=%s && act_id=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordAds . "%", "text"), GetSQLValueString($colindicate_RecordAds, "text"),GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"),GetSQLValueString($colact_id_RecordAds, "int"));
}else{
	$query_RecordAds = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype_sub.sdescription, demo_adtype_sub.pic, demo_adtype_sub.indicate, demo_adtype_sub.modshow, demo_adtype.modstyle, demo_adtype.author, demo_adtype.startdate, demo_adtype.enddate, demo_adtype.style, demo_adtype.modstyle, demo_adtype.navigationstate, demo_adtype.tool, demo_adtype.theme, demo_adtype_sub.actphoto_id, demo_adtype_sub.sortid, demo_adtype_sub.animation, demo_adtype_sub.datatransition , demo_adtype.lang FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id HAVING (demo_adtype.act_id = %s) && (demo_adtype.lang = %s) && (demo_adtype_sub.indicate LIKE %s) && demo_adtype.userid=%s ORDER BY demo_adtype_sub.actphoto_id DESC", GetSQLValueString($colact_id_RecordAds, "int"),GetSQLValueString($collang_RecordAds, "text"), GetSQLValueString($colindicate_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"));
	
	//$query_RecordAds = sprintf("SELECT * FROM demo_adtype_sub WHERE indicate LIKE %s && lang=%s && userid=%s && act_id=%s $orderSql", GetSQLValueString($colindicate_RecordAds, "text"),GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"),GetSQLValueString($colact_id_RecordAds, "int"));
}



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
	$row_RecordAds = mysqli_fetch_assoc($RecordAds);
	$totalRows_RecordAds = mysqli_num_rows($RecordAds);
	
}else{
	//分頁
	$query_limit_RecordAds = sprintf("%s LIMIT %d, %d", $query_RecordAds, $startRow_RecordAds, $maxRows_RecordAds);
	$RecordAds = mysqli_query($DB_Conn, $query_limit_RecordAds) or die(mysqli_error($DB_Conn));
	$row_RecordAds = mysqli_fetch_assoc($RecordAds);
	
	if (isset($_GET['totalRows_RecordAds'])) {
	  $totalRows_RecordAds = $_GET['totalRows_RecordAds'];
	} else {
	  $all_RecordAds = mysqli_query($DB_Conn, $query_RecordAds);
	  $totalRows_RecordAds = mysqli_num_rows($all_RecordAds);
	}
	$totalPages_RecordAds = ceil($totalRows_RecordAds/$maxRows_RecordAds)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordAds > '0') { ?>
<?php do { ?>
  <?php 
  
    switch($row_RecordAds['modshow']) // 抓取模組代碼
	  {
		  case "News":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['News']."\" data-toggle=\"tooltip\"><img src=\"images/mt_001.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['News']."</div></a>";
			  break;
		  case "Coupons":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Coupons']."\" data-toggle=\"tooltip\"><img src=\"images/mt_056.png.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Coupons']."</div></a>";
			  break;
		  case "Timeline":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Timeline']."\" data-toggle=\"tooltip\"><img src=\"images/mt_057.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Timeline']."</div></a>";
			  break;
		  case "Imageshow":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Imageshow']."\" data-toggle=\"tooltip\"><img src=\"images/mt_058.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Imageshow']."</div></a>";
			  break;
		  case "Stronghold":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Stronghold']."\" data-toggle=\"tooltip\"><img src=\"images/mt_059.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Stronghold']."</div></a>";
			  break;
		  case "Picasa":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Picasa']."\" data-toggle=\"tooltip\"><img src=\"images/mt_052.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Picasa']."</div></a>";
			  break;
		  case "About":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['About']."\" data-toggle=\"tooltip\"><img src=\"images/mt_041.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['About']."</div></a>";
			  break;	
		  case "Article":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Article']."\" data-toggle=\"tooltip\"><img src=\"images/mt_008.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Article']."</div></a>";
			  break;	
		  case "Product":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Product']."\" data-toggle=\"tooltip\"><img src=\"images/mt_002.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Product']."</div></a>";
			  break;	
		  case "Guestbook":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Guestbook']."\" data-toggle=\"tooltip\"><img src=\"images/mt_007.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Guestbook']."</div></a>";
			  break;	
		  case "Activities":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Activities']."\" data-toggle=\"tooltip\"><img src=\"images/mt_014.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Activities']."</div></a>";
			  break;	
		  case "Project":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Project']."\" data-toggle=\"tooltip\"><img src=\"images/mt_032.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Project']."</div></a>";
			  break;	
		  case "Frilink":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Frilink']."\" data-toggle=\"tooltip\"><img src=\"images/mt_006.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Frilink']."</div></a>";
			  break;	
		  case "Modlink":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Modlink']."\" data-toggle=\"tooltip\"><img src=\"images/mt_065.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Modlink']."</div></a>";
			  break;	
		  case "Otrlink":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Otrlink']."\" data-toggle=\"tooltip\"><img src=\"images/mt_051.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Otrlink']."</div></a>";
			  break;	
		  case "Sponsor":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Sponsor']."\" data-toggle=\"tooltip\"><img src=\"images/mt_011.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Sponsor']."</div></a>";
			  break;	
		  case "Publish":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Publish']."\" data-toggle=\"tooltip\"><img src=\"images/mt_003.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Publish']."</div></a>";
			  break;	
		  case "Letters":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Letters']."\" data-toggle=\"tooltip\"><img src=\"images/mt_020.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Letters']."</div></a>";
			  break;	
		  case "Meeting":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Meeting']."\" data-toggle=\"tooltip\"><img src=\"images/mt_009.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Meeting']."</div></a>";
			  break;	
		  case "Donation":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Donation']."\" data-toggle=\"tooltip\"><img src=\"images/mt_015.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Donation']."</div></a>";
			  break;	
		  case "Org":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Org']."\" data-toggle=\"tooltip\"><img src=\"images/mt_017.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Org']."</div></a>";
			  break;	
		  case "Member":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Member']."\" data-toggle=\"tooltip\"><img src=\"images/mt_013.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Member']."</div></a>";
			  break;
		  case "Careers":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Careers']."\" data-toggle=\"tooltip\"><img src=\"images/mt_016.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Careers']."</div></a>";
			  break;	
		  case "Actnews":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Actnews']."\" data-toggle=\"tooltip\"><img src=\"images/mt_021.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Actnews']."</div></a>";
			  break;	
		  case "Faq":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Faq']."\" data-toggle=\"tooltip\"><img src=\"images/mt_024.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Faq']."</div></a>";
			  break;	
		  case "Catalog":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Catalog']."\" data-toggle=\"tooltip\"><img src=\"images/mt_033.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Catalog']."</div></a>";
			  break;	
		  case "Cart":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Cart']."\" data-toggle=\"tooltip\"><img src=\"images/mt_036.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Cart']."</div></a>";
			  break;	
		  case "Forum":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Forum']."\" data-toggle=\"tooltip\"><img src=\"images/mt_029.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Forum']."</div></a>";
			  break;	
		  case "Contact":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Contact']."\" data-toggle=\"tooltip\"><img src=\"images/mt_040.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Contact']."</div></a>";
			  break;	
		  case "Blog":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Blog']."\" data-toggle=\"tooltip\"><img src=\"images/mt_047.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Blog']."</div></a>";
			  break;	
		  case "Album":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Album']."\" data-toggle=\"tooltip\"><img src=\"images/mt_012.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Album']."</div></a>";
			  break;	
		  case "MailSend":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['MailSend']."\" data-toggle=\"tooltip\"><img src=\"images/mt_005.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['MailSend']."</div></a>";
			  break;	
		  case "Knowledge":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Knowledge']."\" data-toggle=\"tooltip\"><img src=\"images/mt_031.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Knowledge']."</div></a>";
			  break;	
		  case "EPaper":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['EPaper']."\" data-toggle=\"tooltip\"><img src=\"images/mt_022.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['EPaper']."</div></a>";
			  break;	
		  case "Partner":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Partner']."\" data-toggle=\"tooltip\"><img src=\"images/mt_026.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Partner']."</div></a>";
			  break;
		  case "AD":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['AD']."\" data-toggle=\"tooltip\"><img src=\"images/mt_028.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['AD']."</div></a>";
			  break;	
		  case "Video":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Video']."\" data-toggle=\"tooltip\"><img src=\"images/mt_010.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Video']."</div></a>";
			  break;	
		  case "Artlist":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Artlist']."\" data-toggle=\"tooltip\"><img src=\"images/mt_027.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Artlist']."</div></a>";
			  break;
		  case "Room":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Room']."\" data-toggle=\"tooltip\"><img src=\"images/mt_067.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Room']."</div></a>";
			  break;	
		  case "Attractions":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Attractions']."\" data-toggle=\"tooltip\"><img src=\"images/mt_068.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Attractions']."</div></a>";
			  break;
		  case "Dealer":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['Dealer']."\" data-toggle=\"tooltip\"><img src=\"images/mt_077.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['Dealer']."</div></a>";
			  break;	
		  case "DfType":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['DfType']."\" data-toggle=\"tooltip\"><img src=\"images/mt_043.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['DfType']."</div></a>";
			  break;	
		  case "DfPage":
			  $mod_show = "<a data-original-title=\"目前模組:".$ModuleName['DfPage']."\" data-toggle=\"tooltip\"><img src=\"images/mt_043.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">".$ModuleName['DfPage']."</div></a>";
			  break;	
		  case "Home":
			  $mod_show = "<a data-original-title=\"目前模組:"."首頁"."\" data-toggle=\"tooltip\"><img src=\"images/mt_019.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">首頁</div></a>";
			  break;	
		  case "All":
			  $mod_show = "<a data-original-title=\"目前模組:"."全部"."\" data-toggle=\"tooltip\"><img src=\"images/mt_084.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">全部</div></a>";
			  break;	
		  default:
			  $mod_show = "<a data-original-title=\"目前模組:"."無"."\" data-toggle=\"tooltip\"><img src=\"images/mt_054.png\" alt=\"\" width=\"60\" height=\"60\" /><div class=\"text-center\">無</div></a>";
			  break;
	  }
  
    if($row_RecordAds['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/banner/thumb/small_'.GetFileThumbExtend($row_RecordAds['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "inner_ads.php?wshop=".$wshop."&amp;Opt=photoaddpage&amp;lang=".$_SESSION['lang'] . "&amp;act_id=" . $_GET['act_id'];
	$link_copy = "inner_ads.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;actphoto_id=".$row_RecordAds['actphoto_id'] . "&amp;act_id=" . $_GET['act_id'];
	$link_edit = "inner_ads.php?wshop=".$wshop."&amp;Opt=photoeditpage&amp;lang=".$_SESSION['lang']."&amp;actphoto_id=".$row_RecordAds['actphoto_id'] . "&amp;act_id=" . $_GET['act_id'];
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordAds["actphoto_id"].",\"".$row_RecordAds["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordAds["actphoto_id"];
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
  	$dvalue['chk'] = "<input name='delAds[]' type='checkbox' id='delAds[]' value='".$row_RecordAds["actphoto_id"]."\'/>";
	
	if($row_RecordAds["sdescription"] != ""){
			$dvalue['sdescription'] = "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordAds["actphoto_id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordAds["actphoto_id"]."' data-placement='top'>".$row_RecordAds["sdescription"]."</span></div>";
	}else{
			$dvalue['sdescription'] = "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordAds["actphoto_id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordAds["actphoto_id"]."' data-placement='top'>".'Empty'."</span></div>";
	}     
	
	$dvalue['mod'] = $mod_show;
	
	
	if($row_RecordAds['modstyle'] == "0") { 
          $dvalue['anime'] ="<div class='ed_animation' id='animation_". $row_RecordAds['actphoto_id']."' data-type='select' data-pk='".$row_RecordAds["actphoto_id"]."' data-placement='top'>".$row_RecordAds['animation']."</div>";
    } else if ($row_RecordAds['modstyle'] == "1") {
		  $dvalue['anime'] ="<div class='ed_datatransition' id='datatransition_". $row_RecordAds['actphoto_id']."' data-type='select' data-pk='".$row_RecordAds["actphoto_id"]."' data-placement='top'>".$row_RecordAds['datatransition']."</div>";
    }                 
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordAds["actphoto_id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordAds["actphoto_id"]."' data-placement='top'>".$row_RecordAds["sortid"]."</span>";
	
	if($row_RecordAds["indicate"] == '1') {$row_RecordAds["indicate"] = "顯示";}else{$row_RecordAds["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordAds["actphoto_id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordAds["actphoto_id"]."' data-placement='top'>".$row_RecordAds["indicate"]."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordAds["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordAds), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordAds);
?>
