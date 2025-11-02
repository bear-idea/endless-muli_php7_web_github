<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordAds,$totalRows_RecordAds;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordAds") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordAds=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordAds) + 1;
					$max_l = ($a*$maxRows_RecordAds >= $totalRows_RecordAds) ? $totalRows_RecordAds : ($a*$maxRows_RecordAds);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordAds=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordAds=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}
?>
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

/* 刪除活動花絮主題資料 */
if ((isset($_GET['act_del_id'])) && ($_GET['act_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype WHERE act_id=%s",
                       GetSQLValueString($_GET['act_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除活動花絮相片資料 */
if ((isset($_GET['act_del_id'])) && ($_GET['act_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE act_id=%s",
                       GetSQLValueString($_GET['act_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
}
/* 刪除多筆活動花絮主題資料 */
if ((isset($_POST['deladsalbum'])) && ($_POST['deladsalbum'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype WHERE act_id in (%s)", implode(",", $_POST['deladsalbum']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除多筆活動花絮相片資料 */
if ((isset($_POST['deladsalbum'])) && ($_POST['deladsalbum'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE act_id in (%s)", implode(",", $_POST['deladsalbum']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}


/* 讀取資料 */
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$maxRows_RecordAds = 15;
$pageNum_RecordAds = 0;
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$collang_RecordAds = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAds = $_GET['lang'];
}
$colname_RecordAds = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAds = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT demo_adtype.act_id, demo_adtype.title, demo_adtype.type, demo_adtype.bwight, demo_adtype.bhight, demo_adtype.swight, demo_adtype.shight, demo_adtype.velocity, demo_adtype.numbers, demo_adtype.navigation, demo_adtype.thumbs, demo_adtype.label, demo_adtype.interval, demo_adtype.hideTools, demo_adtype.dots, demo_adtype.sdescription, demo_adtype.indicate, demo_adtype.author, demo_adtype.postdate, demo_adtype_sub.pic, demo_adtype.sortid, demo_adtype_sub.actphoto_id, demo_adtype.lang, count(demo_adtype_sub.act_id) AS photonum FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id GROUP BY demo_adtype.act_id HAVING (demo_adtype.lang = %s) && ((demo_adtype.title LIKE %s) || (demo_adtype.postdate LIKE %s) || (demo_adtype.author LIKE %s)) ORDER BY demo_adtype.act_id DESC", GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"));
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

/* 取得類別資料 */
?>


<?php //$startTime = getMicroTime(); //页面开头定义：?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="keywords" content="" /> 
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富視網科技網頁設計" />    
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />
<meta name="webcrawlers" content="all" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script src="../SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$(function() {

		$('#SiteKeyWord,#skeyword').tagsInput({
			width:'auto',
			defaultText:'加入關鍵字'
		});
// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});		

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
	});

</script>
<link rel="stylesheet" href="css/colorbox/colorbox.css" />
<script type="text/javascript" language="javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script>
		$(document).ready(function(){
			$(".colorbox_iframe_xs").colorbox({iframe:true, width:"90%", height:"90%"});
		});
</script>
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.cookie.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.dcjqaccordion.2.7.min.js'></script> 
<link href="css/vertical-accordion-menu/skins/grey.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function($){
	$('#accordion-2').dcAccordion({
		eventType: 'click', // click/hover
		autoClose: false,
		saveState: true,
		disableLink: true,
		speed: 'fast',
		classActive: 'active',
		showCount: false // 選單個數
	});
});
</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$(document).ready(function() { /* jeditable 日曆 */
	$.editable.addInputType('datepicker', { 
    element : function(settings, original) { 
        var input = $('<input>'); 
        if (settings.width  != 'none') { input.width(settings.width);  } 
    if (settings.height != 'none') { input.height(settings.height); } 
        input.attr('autocomplete','off'); 
    $(this).append(input); 
    return(input); 
    }, 
    plugin : function(settings, original) { 
        /* Workaround for missing parentNode in IE */ 
    var form = this; 
    settings.onblur = 'ignore'; 
    $(this).find('input').datepicker().bind('click', function() { 
    $(this).datepicker('show'); 
            return false; 
        }).bind('dateSelected', function(e, selectedDate, $td) { 
            $(form).submit(); 
        }); 
    } 
}); 
})
</script> 
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script type="text/javascript" src="../js/iframe.js"></script>
<script type="text/javascript" src="../js/fontsizer.jquery.js"></script>
<script src="../js/jquery.d.checkbox.min.js"></script> 
<script>
$(document).ready(function(){
		$(':checkbox').d_checkbox();
		$(':radio').d_radio();
});
</script>
<script>
$(document).ready( function(){
  $('.rounded').corners();
});</script>
<!-- [ Sort Table ] -->
<script language="javascript" src="../js/jquery.tablesorter.js"></script>
<script>
$(document).ready(function(){         
  $("#TBSort").tablesorter({widgets: ['zebra']});
}); 
</script>
<!-- [ Sort Table End ] -->
<!-- [ reflection ] -->
<script type="text/javascript" src="../js/reflection.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	$("#ref_thumb img").reflect();
})
</script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<!-- [ reflection End ] -->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<style>
.tbutt{
	float:left;
	padding:5px;
	background-color:#666666;
	color:#FFFFFF;
	margin-right:5px;
	margin-left: 0px;
	margin-top: 0px;
	margin-bottom: 10px;
}
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 100px;
	margin: 5px;
}

/* 圖片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_table-cell span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_table-cell *{ vertical-align:middle;}

.InnerPage{display:none;}
.bg_board:hover{
	background-color: #E95516;
}
.bg_active{
	background-color: #B37583;
}
.TmpBgSelectIcon{
	position: absolute;
	z-index: 1;
	height: 65px;
	width: 93px;
	background-image: url(images/select.png);
	background-repeat: no-repeat;
}
.button_a{display:inline-block; border-width:1px 0; border-color:#BBBBBB; border-style:solid; vertical-align:middle;text-decoration:none; color:#333333;}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBBBBB; border-style:solid; margin:0 -1px; position:relative;}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eeeeee;}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer;}
.button_a:hover{border-color:#999999;text-decoration:none;}
.button_a:hover .button_b{border-color:#999999;text-decoration:none;}
</style>
<link href="../SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="padding:10px; margin:10px;">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">輪播分類</font><font color="#756b5b"> [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td width="155" align="right">
               <div>
                  <a href="tmp_config.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id']; ?>" class="button_a">
                     <span class="button_b">
                         <span class="button_c"> </span>
                         <span class="button_d">回上一頁</span>
                      </span>
                   </a>
               </div>
            </td>
        </tr>
    </table>
    
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
      <tr>
        <td width="50%"> 顯示 <?php echo ($startRow_RecordAds + 1) ?> - <?php echo min($startRow_RecordAds + $maxRows_RecordAds, $totalRows_RecordAds) ?> 筆 共計 <?php echo $totalRows_RecordAds ?> 筆</td>
        <td width="50%" align="right">
          
          <?php if ($ManageAdsSearchSelect == "1") { // 搜索功能開啟設定?>
          <form id="form_Ads" name="form_Ads" method="get" action="<?php echo $editFormAction; ?>">
            <label for="type"></label>
            <label>
              <input name="Opt" type="hidden" id="Opt" value="viewpage" />
              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
              <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
              <input type="text" name="searchkey" id="searchkey" />
              <input type="submit" name="button" id="button" value="搜索" />
            </label>
          </form>
          <?php } ?>
          
           
          <div class="PageSelectBoard">
          <?php 
			# variable declaration
			$prev_RecordAds = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordAds = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordAds = buildNavigation($pageNum_RecordAds,$totalPages_RecordAds,$prev_RecordAds,$next_RecordAds,$separator,$max_links,true); 
			
			print $pages_navigation_RecordAds[0]; 
			?>
          <?php print $pages_navigation_RecordAds[1]; ?> 
          <?php print $pages_navigation_RecordAds[2]; ?>
          </div>
          
        </td>
        </tr>
      <tr>
        <td colspan="2"><hr></td>
        </tr>
    </table>
    
    <?php 
	  switch($_POST['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類修改成功！！','information');});</script>\n";
			break;
		  case "photoaddSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片新增成功！！','success');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類刪除成功！！','warning');});</script>\n";
			break;	
		  default:
		  	switch($_GET['Operate']) 
	  		{
			  case "addSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類新增成功！！','success');});</script>\n";
				break;
			  case "editSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類修改成功！！','information');});</script>\n";
				break;
			  case "photoaddSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片新增成功！！','success');});</script>\n";
				break;
			  case "delSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類刪除成功！！','warning');});</script>\n";
				break;	
			  default:
				break;
	 		 }
		  	break;
	  }
	  
	  ?>
    <?php if ($totalRows_RecordAds > 0) { // Show if recordset not empty ?>
    <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <thead>
        <tr>
          <th width="23">&nbsp;</th>
          <th><strong>標題 / 描述</strong></th>
          <th width="80">大圖寬度</th>
          <th width="80">大圖高度</th>
          <th width="80">縮圖寬度</th>
          <th width="80">縮圖高度</th>
          <th width="60"><strong>張數</strong></th>
          <th colspan="4"><strong>輪播分類管理操作</strong></th>
          </tr>
        </thead>
        <tbody>  
        <?php do { ?>
          <tr>
            <td align="center" valign="middle">
            <?php 
		//
		if($ManageAdsAlbumBatchDeleteSelect == "1") { /* 判斷是否開啟多筆刪除功能 */
		?>
        <input name="deladsalbum[]" type="checkbox" id="deladsalbum[]" value="<?php echo $row_RecordAds['act_id']; ?>" />
        <?php } else {?>
        <img src="images/sicon/play.gif" width="18" height="18" />

        <?php
		 } 
		 //
		 ?>
         </td>
            <td valign="middle">
              <span class="title" id="title_<?php echo $row_RecordAds['act_id']; ?>">
                <?php echo highLight($row_RecordAds['title'], @$_GET['searchkey'], $HighlightSelect); ?></span>	&nbsp;&nbsp;&nbsp;&nbsp;
              <?php 
			/* 判斷顯示新增回應或者回應一覽 */
			if($row_RecordAds['actphoto_id'] == "") {
			?>
              <span class = "InnerPage1">
                <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=photoaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>">[新增輪播圖片]</a>
                </span><?php } else {?>
              <span class = "InnerPage1">
                <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=photoviewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>">[輪播圖片一覽]</a>
                </span>
              
			<?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <font color="#CC6600">&nbsp;&nbsp;&nbsp;&nbsp; *區域：
            <span class="ed_type" id="type_<?php echo $row_RecordAds['act_id']; ?>">
			<?php echo $row_RecordAds['type']; ?>
            </span></font>
            <?php } ?>
              <br />
              
              <div class="descriptionword">
              <span class="sdescription" id="sdescription_<?php echo $row_RecordAds['act_id']; ?>">
                <?php echo nl2br($row_RecordAds['sdescription']); ?>
              </span> 
              </div>   
                      </td>
            <td valign="middle"><span class="bwight" id="bwight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['bwight']; ?></span></td>
            <td valign="middle"><span class="bhight" id="bhight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['bhight']; ?></span></td>
            <td valign="middle"><span class="swight" id="swight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['swight']; ?></span></td>
            <td valign="middle"><span class="shight" id="shight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['shight']; ?></span></td>
            <td align="center" valign="middle">
              <?php 
		    /* 顯示相片總數 */
		  	if($row_RecordAds['photonum'] != "") {
		  		echo "<span class=\"TipTypeStyle\">[";
		  		echo $row_RecordAds['photonum'];
				echo "]</span>"; 
			}
		 	?>
            </td>
            <td width="45" align="left" valign="middle"class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
            <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nadd.gif" alt="" width="45" height="18" /></td>
            <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nedit.gif" alt="" width="45" height="18" /></td>
            <td width="49" align="left" valign="middle" class="MenuViewPage"><img src="images/ndel.gif" width="45" height="18" /></td>
          </tr>
           <tr>
             <td align="right" valign="middle">&nbsp;</td>
             <td colspan="16" valign="middle"><strong>細部設定(點選修改)</strong></td>
             </tr>
           <tr>
             <td align="right" valign="middle">&nbsp;</td>
             <td colspan="16" valign="middle">
               ★動畫速度：<span class="ed_velocity" id="velocity_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['velocity']; ?></span><font color="#999999"> 設定轉場速度</font><br />
			   ★顯示編號：<span class="ed_numbers" id="numbers_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['numbers']; ?></span><font color="#999999"> 左上角是否顯示編號導覽列</font><br />
               ★左右方向按鈕：<span class="ed_navigation" id="navigation_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['navigation']; ?></span><font color="#999999">是否顯示左右方向導覽列</font><br />
               ★縮圖導覽：<span class="ed_thumbs" id="thumbs_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['thumbs']; ?></span><font color="#999999"> 下方是否顯示縮圖導覽列〈須將隱藏工具列選項打開〉</font><br />
               ★標籤顯示：<span class="ed_label" id="label_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['label']; ?><font color="#999999"> 下方是否顯示該圖片敘述</font></span><font color="#999999">〈縮圖導覽和標籤顯示只能同時存在一種〉</font><br />
               ★隱藏工具列：<span class="ed_hideTools" id="hideTools_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['hideTools']; ?></span><font color="#999999"> 滑鼠移出時是否會隱藏工具列</font></td>
             </tr>
           <tr>
             <td align="right" valign="middle">&nbsp;</td>
             <td colspan="16" valign="middle">&nbsp;</td>
             </tr>
          <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
          </tbody>
          <?php
		   //
		   if($ManageAdsAlbumBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
		   ?>
           <tfoot>
           <tr>
            <td align="right" valign="middle">└</td>
            <td colspan="6" valign="middle">
              <input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form1',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全選" />
              <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form1',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反選" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form1',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" />
              <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可在左方選取您欲刪除的項目，亦可透過左側之按鈕項目來配合使用，選擇完後點選右側《刪除選取項目》按鈕來進行多筆刪除。" data-toggle="tooltip" data-placement="right">?</a></span></td>
            <td colspan="10" align="right"><input type="submit" name="button2" id="button2" value="刪除選取項目" onclick="tfm_confirmLink('此動作會刪除所有選取活動花絮及其內容！！確定刪除紀錄嗎？');return document.MM_returnValue" />
            </td>
          </tr>
          <?php 
		} 
		//
		?>
        </tfoot>
      </table>
    </form>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordAds == 0) { // Show if recordset empty ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="top"><font color="#FF0000">目前尚無資料！！</font></td>
        </tr>
      </table>
      <?php } // Show if recordset empty ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".sortid").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".title").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".sdescription").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".bwight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".bhight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".swight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".shight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".ed_numbers").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_navigation").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_thumbs").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_label").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_hideTools").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_velocity").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_adstype_velocity?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_type").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/adtype_list_type.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
});
</script>
<?php
mysqli_free_result($RecordAds);
?>