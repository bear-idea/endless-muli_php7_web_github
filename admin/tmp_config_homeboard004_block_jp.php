<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('inc_mdname.php'); ?>
<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $_GET['userid'] == $w_userid) {
  $deleteSQL = sprintf("DELETE FROM demo_tmphomeblockcolumn WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));
  if($_GET['type'] == 'News' || $_GET['type'] == 'Publish' || $_GET['type'] == 'Letters' || $_GET['type'] == 'Actnews' || $_GET['type'] == 'Partner' || $_GET['type'] == 'Video' || $_GET['type'] == 'Product' || $_GET['type'] == 'Project' || $_GET['type'] == 'Activities' || $_GET['type'] == 'Sponsor')
  {
	  // 鎖定
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=0 WHERE userid=%s",
	                       GetSQLValueString("Home" . $_GET['type'] . "Lock_jp", "none"),
						   GetSQLValueString($_GET['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $deleteGoTo = "tmp_config_" . $_GET['board'] . "_block.php?lang=" . $_SESSION['lang'] . "&board=" . $_GET['board'] . "&id_edit=" . $_GET['id_edit'];
  //if (isset($_SERVER['QUERY_STRING'])) {
  //  $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
  //  $deleteGoTo .= $_SERVER['QUERY_STRING'];
  //}
  header(sprintf("Location: %s", $deleteGoTo));
  ob_end_flush(); // 輸出緩衝區結束
  exit;
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "TmpColumnFree")) {
  $insertSQL = sprintf("INSERT INTO demo_tmphomeblockcolumn (type, style, dftname, customname, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['style'], "text"),
					   GetSQLValueString($_POST['dftname'], "text"),
					   GetSQLValueString($_POST['dftname'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));
					   
  if($_POST['type'] == 'News' || $_POST['type'] == 'Publish' || $_POST['type'] == 'Letters' || $_POST['type'] == 'Actnews' || $_POST['type'] == 'Partner' || $_POST['type'] == 'Video' || $_POST['type'] == 'Product' || $_POST['type'] == 'Project' || $_POST['type'] == 'Activities' || $_POST['type'] == 'Sponsor')
  {
	  // 鎖定
	  //$_POST['type'];
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=1 WHERE userid=%s",
	  					   GetSQLValueString("Home" . $_POST['type'] . "Lock_jp", "none"),
						   GetSQLValueString($_POST['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordTmpColumn = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordTmpColumn = $_GET['lang'];
}
$coluserid_RecordTmpColumn = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpColumn = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmphomeblockcolumn WHERE lang=%s && userid=%s ORDER BY sortid ASC, id ASC", GetSQLValueString($collang_RecordTmpColumn, "text"),GetSQLValueString($coluserid_RecordTmpColumn, "int"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpAddColumn = "SELECT * FROM demo_tmpaddhomecolumn WHERE class = 'block' && type != 'Free'";
$RecordTmpAddColumn = mysqli_query($DB_Conn, $query_RecordTmpAddColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpAddColumn = mysqli_fetch_assoc($RecordTmpAddColumn);
$totalRows_RecordTmpAddColumn = mysqli_num_rows($RecordTmpAddColumn);

$coluserid_RecordSettingLock = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingLock = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingLock = sprintf("SELECT HomeNewsLock_jp, HomePublishLock_jp, HomeLettersLock_jp, HomeActnewsLock_jp, HomePartnerLock_jp, HomeVideoLock_jp, HomeProductLock_jp, HomeProjectLock_jp, HomeActivitiesLock_jp, HomeSponsorLock_jp FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($coluserid_RecordSettingLock, "text"));
$RecordSettingLock = mysqli_query($DB_Conn, $query_RecordSettingLock) or die(mysqli_error($DB_Conn));
$row_RecordSettingLock = mysqli_fetch_assoc($RecordSettingLock);
$totalRows_RecordSettingLock = mysqli_num_rows($RecordSettingLock);

$colname_RecordTmp = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmp = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);

$coluserid_RecordTmpBg = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBg = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBg = sprintf("SELECT TmpBg FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpBg, "int"));
$RecordTmpBg = mysqli_query($DB_Conn, $query_RecordTmpBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpBg = mysqli_fetch_assoc($RecordTmpBg);
$totalRows_RecordTmpBg = mysqli_num_rows($RecordTmpBg);

$collang_RecordTmpColumnShow = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordTmpColumnShow = $_GET['lang'];
}
$coluserid_RecordTmpColumnShow = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpColumnShow = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumnShow = sprintf("SELECT * FROM demo_tmphomeblockcolumn WHERE lang=%s && userid=%s ORDER BY sortid ASC, id ASC", GetSQLValueString($collang_RecordTmpColumnShow, "text"),GetSQLValueString($coluserid_RecordTmpColumnShow, "int"));
$RecordTmpColumnShow = mysqli_query($DB_Conn, $query_RecordTmpColumnShow) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumnShow = mysqli_fetch_assoc($RecordTmpColumnShow);
$totalRows_RecordTmpColumnShow = mysqli_num_rows($RecordTmpColumnShow);
?>

<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" /> 
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富視網科技網頁設計" />  
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="noindex,nofollow" />
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<script type="text/javascript" src="js/jquery.miniColors.min.js">/*顏色選擇*/</script>
<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
$(function(){$("#SiteKeyWord,#skeyword").tagsInput({width:"auto",defaultText:"\u52a0\u5165\u95dc\u9375\u5b57"})});
</script>
<script type="text/javascript" src="js/jquery.hint.js"></script>
<style type="text/css">
	input.blur {color: #999;}
</style>
<script type="text/javascript">
	$(function(){$("input[title!='']").hint();}); // data-original-title="?"
</script>
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
<script language="javascript" src="js/jquery.qtip-1.0.0-rc3.min.js">/*Tip*/</script>
<script type="text/javascript">
$(document).ready(function() 
{
   $('.tip_img_tmp').qtip({
      content: '<img src="images/tip/tip014.jpg" width="300" height="302" />'
   });
});
</script>
<script language="javascript" src="js/jquery.tipsy.js">/*Tip*/</script>
<link href="css/tipsy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 $(function() {
   $('a[rel=tipsy]').tipsy({fade: true, gravity: 'w'});
   $('a[rel=tipsy_n]').tipsy({fade: true, gravity: 's'});
   $('a[rel=tipsy_l]').tipsy({fade: true, gravity: 'ne'});
   $('a[rel=tipsy_html]').tipsy({fade: true, gravity: 's', html: true});
 });
</script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.cookie.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.hoverIntent.minified.js'></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script>
jQuery(window).load(function(){
  $(function(){
	var $container = $('.Auto_Block_Wrp');
	$container.isotope({
	  itemSelector: '.Auto_Block',
	  layoutMode : 'masonry',
	  masonry: {
    columnWidth: 150
  }
	});
  });
});
</script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.dcjqaccordion.2.7.min.js'></script> 
<link href="css/vertical-accordion-menu/skins/grey.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(a){a("#accordion-2").dcAccordion({eventType:"click",autoClose:!1,saveState:!0,disableLink:!0,speed:"fast",classActive:"active",showCount:!1})});</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$.editable.addInputType("datepicker",{element:function(){var a=$('<input class="input" />');a.attr("readonly","readonly");$(this).append(a);return a},plugin:function(){$("input",this).datepicker({changeMoneth:!0,changeYear:!0,dateFormat:"yy-mm-dd"})}});
</script> 
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script language=javascript src="js/address.js"></script><!--引入郵遞區號.js檔案-->
<script type="text/javascript" src="../js/iframe.js"></script>
<script type="text/javascript" src="../js/fontsizer.jquery.js"></script>
<script src="../js/jquery.d.checkbox.min.js"></script> 
<script>
$(document).ready(function(){$(":checkbox").d_checkbox();$(":radio").d_radio()});
</script>
<script type="text/javascript">
$(document).ready( function(){
  $('.rounded').corners();
});</script>
<!-- [ Sort Table ] -->
<script language="javascript" src="../js/jquery.tablesorter.min.js"></script>
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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<style type="text/css">
.isotope-item{}

.isotope-hidden.isotope-item{
 pointer-events:none;
 z-index:1}

.isotope,
.isotope .isotope-item{
 -webkit-transition-duration:0.8s;
 -moz-transition-duration:0.8s;
 -ms-transition-duration:0.8s;
 -o-transition-duration:0.8s;
 transition-duration:0.8s}

.isotope{
 -webkit-transition-property:height,width;
 -moz-transition-property:height,width;
 -ms-transition-property:height,width;
 -o-transition-property:height,width;
 transition-property:height,width}

.isotope .isotope-item{
 -webkit-transition-property:-webkit-transform,opacity;
 -moz-transition-property: -moz-transform,opacity;
 -ms-transition-property: -ms-transform,opacity;
 -o-transition-property: -o-transform,opacity;
 transition-property: transform,opacity}

.isotope.no-transition,
.isotope.no-transition .isotope-item,
.isotope .isotope-item.no-transition{
 -webkit-transition-duration:0s;
 -moz-transition-duration:0s;
 -ms-transition-duration:0s;
 -o-transition-duration:0s;
 transition-duration:0s}

.isotope.infinite-scrolling{
 -webkit-transition:none;
 -moz-transition:none;
 -ms-transition:none;
 -o-transition:none;
 transition:none}
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<style type="text/css"><?php if ($_SESSION['lang'] == 'en') { ?>#wrapper_config_content { background-image:url(images/Main_content_en_bg.jpg); background-repeat:no-repeat; background-position:1px 0px;}<?php } else if ($_SESSION['lang'] == 'zh-cn') { ?>#wrapper_config_content { background-image:url(images/Main_content_jp_bg.jpg); background-repeat:no-repeat; background-position:1px 0px;}<?php } ?></style>
</head>
<body> 
<?php
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	switch($_GET['lang'])
	{
		case "zh-tw":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "繁體";
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "簡體";
			break;
		case "en":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "英文";
			break;	
		case "jp":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "日文";
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
			$langname = "繁體";
	}
 ?> 
<style type="text/css">
.TB_General_style01 tr td{
	border: solid 1px #CCCCCC;
}
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
.button_a{display:inline-block; border-width:1px 0; border-color:#BBBBBB; border-style:solid; vertical-align:middle;text-decoration:none; color:#333333;}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBBBBB; border-style:solid; margin:0 -1px; position:relative;}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eeeeee;}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer;}
.button_a:hover{border-color:#999999;text-decoration:none;}
.button_a:hover .button_b{border-color:#999999;text-decoration:none;}

.Auto_Block_Wrp{ width:642px; padding:10px;}
.Auto_Content_Board { border:1px dotted #DDDDDD; width:99%; height:90px; padding:1px;}
.Auto_Title { margin:1px; background-color:#FEE498; height:<?php echo $row_RecordTmp['tmp_middle_title_height']; ?>px; line-height:<?php echo $row_RecordTmp['tmp_middle_title_height']; ?>px; text-align:center; vertical-align:middle;}
.Auto_Content{ padding:10px;background-color:#FFF;margin:1px;height:100px; position:relative;}
.Auto_Block{ background-color:#CCCCCC; margin-left:1px; margin-right:1px; margin-top:3px; margin-bottom:4px;}
.Auto_Block1{width:148px; overflow:hidden; }
.Auto_Block2{width:298px; overflow:hidden; }
.Auto_Block3{width:448px; overflow:hidden; }
.Auto_Block4{width:598px; overflow:hidden; }
.Auto_Edit { position:absolute; right:5px; bottom:10px;border:1px dotted #DDDDDD; padding:5px;}

</style>

<div style="padding:10px; margin:10px; position:relative; min-width:1000px;" id="wrapper_config">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;" id="wrapper_config_content">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">樣板設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td align="right"><div>
                  <a href="tmp_config_<?php echo $_GET['board']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>" class="button_a">
                     <span class="button_b">
                         <span class="button_c"> </span>
                         <span class="button_d">回上一頁</span>
                      </span>
                   </a>
               </div></td>
      </tr>
    </table>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">首頁功能區塊設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><form id="form_TmpColumnList" name="form_TmpColumnList" method="post" action="">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="center"><strong>欄位型態</strong></td>
                  	<td align="center"><strong>區塊名稱</strong></td>
                  	<td width="100" align="center"><strong>排序</strong></td>
                  	<td width="90" align="center"><strong>操作</strong></td>
               	  </tr>
				  <?php do { ?>
                   <tr>
                     <?php if ($totalRows_RecordTmpColumn > 0) { // Show if recordset not empty ?>
  <td width="100" align="center"><?php echo $row_RecordTmpColumn['type']; ?></td>
                     <td align="center"><span class="ed_customname" id="customname_<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['customname']; ?></span></td>
                     <td align="center"><span class="sortid" id="sortid_<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['sortid']; ?></span></td>
                     <td><?php if ($row_RecordTmpColumn['style'] == 'free' && $row_RecordTmpColumn['type'] == 'Free1') { ?><a href="tmp_config_home_block_setting_free_block1.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php }else if ($row_RecordTmpColumn['style'] == 'free' && $row_RecordTmpColumn['type'] == 'Free2') { ?><a href="tmp_config_home_block_setting_free_block2.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php }else if ($row_RecordTmpColumn['style'] == 'free' && $row_RecordTmpColumn['type'] == 'Free3') { ?><a href="tmp_config_home_block_setting_free_block3.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php }else if ($row_RecordTmpColumn['style'] == 'free' && $row_RecordTmpColumn['type'] == 'Free4') { ?><a href="tmp_config_home_block_setting_free_block4.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else if($row_RecordTmpColumn['style'] == 'menu') { ?><a href="tmp_config_home_block_setting_menu.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else { ?><a href="tmp_config_home_block_setting_free_mod.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpcolumn_setting_menu&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>"></a><a href="tmp_config_<?php echo $_GET['board']; ?>_block.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>"><img src="images/del.gif" width="45" height="18" /></a></td>
                       <?php } // Show if recordset not empty ?>
                   </tr>
				   <?php } while ($row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn)); ?>
              </table>
      </form></td>
        <td width="50%" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-right:10px;border:solid 1px #CCCCCC;" class="TB_General_style01">
          <tr>
            <td colspan="2" align="center"><strong>可新增區塊</strong></td>
          </tr>
		  <?php do { ?>
          <?php if (
		  ($row_RecordTmpAddColumn['type'] == 'News' && ($row_RecordSettingLock['HomeNewsLock_jp'] == '1' OR $OptionNewsSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'Publish' && ($row_RecordSettingLock['HomePublishLock_jp'] == '1' OR $OptionPublishSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Letters' && ($row_RecordSettingLock['HomeLettersLock_jp'] == '1' OR $OptionLettersSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Actnews' && ($row_RecordSettingLock['HomeActnewsLock_jp'] == '1' OR $OptionActnewsSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Partner' && ($row_RecordSettingLock['HomePartnerLock_jp'] == '1' OR $OptionPartnerSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Video' && ($row_RecordSettingLock['HomeVideoLock_jp'] == '1' OR $OptionVideoSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Product' && ($row_RecordSettingLock['HomeProductLock_jp'] == '1' OR $OptionProductSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Project' && ($row_RecordSettingLock['HomeProjectLock_jp'] == '1' OR $OptionProjectSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Activities' && ($row_RecordSettingLock['HomeActivitiesLock_jp'] == '1' OR $OptionActivitiesSelect == '0')) ||
		  ($row_RecordTmpAddColumn['type'] == 'Sponsor' && ($row_RecordSettingLock['HomeSponsorLock_jp'] == '1' OR $OptionSponsorSelect == '0'))
		  ) { ?>
          <?php } else { ?>
          <form name="TmpColumn" action="<?php echo $editFormAction; ?>" method="POST" id="TmpColumn<?php echo $row_RecordTmpAddColumn['type']; ?>">
          <tr>  
              <td align="center" valign="middle">
              <?php 
				switch($row_RecordTmpAddColumn['type']) // 抓取模組代碼
				{
					case "Free":
					    $ModuleName = "自由區塊";
						echo $ModuleName;
						break;
					case "Free1":
					    $ModuleName = "自由區塊";
						echo $ModuleName;
						break;
					case "Free2":
					    $ModuleName = "自由區塊";
						echo $ModuleName;
						break;
					case "Free3":
					    $ModuleName = "自由區塊";
						echo $ModuleName;
						break;
					case "Free4":
					    $ModuleName = "自由區塊";
						echo $ModuleName;
						break;
					case "News":
					    $ModuleName = $ModuleName['News'];
						echo $ModuleName['News'];
						break;
					case "Coupons":
					    $ModuleName = $ModuleName['Coupons'];
						echo $ModuleName['Coupons'];
						break;
					case "Timeline":
					    $ModuleName = $ModuleName['Timeline'];
						echo $ModuleName['Timeline'];
						break;
					case "Imageshow":
					    $ModuleName = $ModuleName['Imageshow'];
						echo $ModuleName['Imageshow'];
						break;
					case "Stronghold":
					    $ModuleName = $ModuleName['Stronghold'];
						echo $ModuleName['Stronghold'];
						break;
					case "Picasa":
						$ModuleName = $ModuleName['Picasa'];
						echo $ModuleName['Picasa'];
						break;
					case "About":
						$ModuleName = $ModuleName['About'];
						echo $ModuleName['About'];
						break;	
					case "Article":
						$ModuleName = $ModuleName['Article'];
						echo $ModuleName['Article'];
						break;	
					case "Product":
						$ModuleName = $ModuleName['Product'];
						echo $ModuleName['Product'];
						break;	
					case "Guestbook":
						$ModuleName = $ModuleName['Guestbook'];
						echo $ModuleName['Guestbook'];
						break;	
					case "Activities":
						$ModuleName = $ModuleName['Activities'];
						echo $ModuleName['Activities'];
						break;	
					case "Project":
						$ModuleName = $ModuleName['Project'];
						echo $ModuleName['Project'];
						break;	
					case "Frilink":
						$ModuleName = $ModuleName['Frilink'];
						echo $ModuleName['Frilink'];
						break;	
					case "Otrlink":
						$ModuleName = $ModuleName['Otrlink'];
						echo $ModuleName['Otrlink'];
						break;	
					case "Sponsor":
						$ModuleName = $ModuleName['Sponsor'];
						echo $ModuleName['Sponsor'];
						break;	
					case "Publish":
						$ModuleName = $ModuleName['Publish'];
						echo $ModuleName['Publish'];
						break;	
					case "Letters":
						$ModuleName = $ModuleName['Letters'];
						echo $ModuleName['Letters'];
						break;	
					case "Meeting":
						$ModuleName = $ModuleName['Meeting'];
						echo $ModuleName['Meeting'];
						break;	
					case "Donation":
						$ModuleName = $ModuleName['Donation'];
						echo $ModuleName['Donation'];
						break;	
					case "Org":
						$ModuleName = $ModuleName['Org'];
						echo $ModuleName['Org'];
						break;	
					case "Member":
						$ModuleName = $ModuleName['Member'];
						echo $ModuleName['Member'];
						break;
					case "Careers":
						$ModuleName = $ModuleName['Careers'];
						echo $ModuleName['Careers'];
						break;	
					case "Actnews":
						$ModuleName = $ModuleName['Actnews'];
						echo $ModuleName['Actnews'];
						break;	
					case "Faq":
						$ModuleName = $ModuleName['Faq'];
						echo $ModuleName['Faq'];
						break;	
					case "Catalog":
						$ModuleName = $ModuleName['News'];
						echo $ModuleName['Catalog'];
						break;	
					case "Cart":
						$ModuleName = $ModuleName['Cart'];
						echo $ModuleName['Cart'];
						break;	
					case "Forum":
						$ModuleName = $ModuleName['Forum'];
						echo $ModuleName['Forum'];
						break;	
					case "Contact":
						$ModuleName = $ModuleName['Contact'];
						echo $ModuleName['Contact'];
						break;	
					case "Blog":
						$ModuleName = $ModuleName['Blog'];
						echo $ModuleName['Blog'];
						break;	
					case "Album":
						$ModuleName = $ModuleName['Album'];
						echo $ModuleName['Album'];
						break;	
					case "MailSend":
						$ModuleName = $ModuleName['MailSend'];
						echo $ModuleName['MailSend'];
						break;	
					case "Knowledge":
						$ModuleName = $ModuleName['Knowledge'];
						echo $ModuleName['Knowledge'];
						break;	
					case "EPaper":
						$ModuleName = $ModuleName['EPaper'];
						echo $ModuleName['EPaper'];
						break;	
					case "Partner":
						$ModuleName = $ModuleName['Partner'];
						echo $ModuleName['Partner'];
						break;
					case "AD":
						$ModuleName = $ModuleName['AD'];
						echo $ModuleName['AD'];
						break;	
					case "Video":
						$ModuleName = $ModuleName['Video'];
						echo $ModuleName['Video'];
						break;	
					case "Artlist":
						$ModuleName = $ModuleName['Artlist'];
						echo $ModuleName['Artlist'];
						break;	
					case "DfType":
						$ModuleName = $ModuleName['DfType'];
						echo $ModuleName['DfType'];
						break;	
					case "DfPage":
						$ModuleName = $ModuleName['DfPage'];
						echo $ModuleName['DfPage'];
						break;	
					case "Home":
						$ModuleName = $ModuleName['Home'];
						echo $ModuleName['Home'];
					default:
						break;
				}
				?>
              <br />
                <span style=" color:#090;"><?php echo $row_RecordTmpAddColumn['desc']; ?></span>
                <input name="type" type="hidden" id="type" value="<?php echo $row_RecordTmpAddColumn['type']; ?>" />
                <input name="dftname" type="hidden" id="dftname" value="<?php echo $UseModuleName; ?>" />
                <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmpAddColumn['id']; ?>" />
                <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                <input name="style" type="hidden" id="style" value="<?php echo $row_RecordTmpAddColumn['style']; ?>" /></td>
              <td width="50" align="center" valign="middle"><input type="submit" name="button" id="button" value="新增" /></td>
              
          </tr>
          <input type="hidden" name="MM_insert" value="TmpColumnFree" />
          </form>
          <?php } ?>
		  <?php } while ($row_RecordTmpAddColumn = mysqli_fetch_assoc($RecordTmpAddColumn)); ?>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
          </tr>
        </table>
        <?php if ($totalRows_RecordTmpColumnShow > 0) { // Show if recordset not empty ?>
  <div style="width:588px; margin-bottom:0px; margin-left:10px; margin-right:10px; margin-top:10px; background-color:#FAB9B6; padding:5px; border:1px #CCCCCC solid; text-align:center; color:#FFFFFF;">此為產生畫面之狀態，您也可由此編輯 <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此預覽圖必須根據您目前所選取的版型為準，實際區塊高度為目前所設定的【標題欄位高度+內容區塊高度+內容區塊內距大小】，而標題欄位高度會依據您所選擇的樣板而有所變動，假設您設定內容區塊高度為240px，標題欄位高度為35px《一般預設35px》，內容區塊內距固定為5px，因此一區塊高度可得【240+35+(5x2)=285】而標題欄位的區塊高度您可至目前樣板之《版型設定》的《標題區塊》中做設定，另外區塊和區塊之間的間距為10px。" data-toggle="tooltip" data-placement="top" class="tip_img_tmp">?</a></span></div>
          <div class="Auto_Block_Wrp">
            <?php do { ?>
              <?php 
		  switch($row_RecordTmpColumnShow['type']) // 抓取模組代碼
		  {
			  case "Free1":
				  $Auto_Block = "Auto_Block1";
				  break;
			  case "Free2":
				  $Auto_Block = "Auto_Block2";
				  break;
			  case "Free3":
				  $Auto_Block = "Auto_Block3";
				  break;
			  case "Free4":
				  $Auto_Block = "Auto_Block4";
				  break;
			  default:
			      $Auto_Block = "Auto_Block3";
				  break;
		  }
	  ?>
              <div class="Auto_Block <?php echo $Auto_Block; ?>">
                <div class="Auto_Title" <?php if($row_RecordTmpColumnShow['indicatetitle'] == '0') { ?>style="height:0px;"<?php } ?>><?php echo $row_RecordTmpColumnShow['type']; ?> <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="高度為<?php echo $row_RecordTmp['tmp_middle_title_height']; ?>px。" data-toggle="tooltip" data-placement="right">↕</a></span></div>
                <div class="Auto_Content" style="height:<?php echo $row_RecordTmpColumnShow['height']; ?>px;">
                  <span class="ed_customnameshow" id="customname_<?php echo $row_RecordTmpColumnShow['id']; ?>"><?php echo $row_RecordTmpColumnShow['customname']; ?></span> <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="高度為<?php echo $row_RecordTmpColumnShow['height']; ?>px / 內距為5px。" data-toggle="tooltip" data-placement="right">↕</a></span>
                  <div class="Auto_Edit">
                    <?php if ($row_RecordTmpColumnShow['style'] == 'free' && $row_RecordTmpColumnShow['type'] == 'Free1') { ?><a href="tmp_config_home_block_setting_free_block1.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php }else if ($row_RecordTmpColumnShow['style'] == 'free' && $row_RecordTmpColumnShow['type'] == 'Free2') { ?><a href="tmp_config_home_block_setting_free_block2.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php }else if ($row_RecordTmpColumnShow['style'] == 'free' && $row_RecordTmpColumnShow['type'] == 'Free3') { ?><a href="tmp_config_home_block_setting_free_block3.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php }else if ($row_RecordTmpColumnShow['style'] == 'free' && $row_RecordTmpColumnShow['type'] == 'Free4') { ?><a href="tmp_config_home_block_setting_free_block4.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else if($row_RecordTmpColumnShow['style'] == 'menu') { ?><a href="tmp_config_home_block_setting_menu.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else { ?><a href="tmp_config_home_block_setting_free_mod.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_tmp=<?php echo $_GET['id_edit']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpcolumn_setting_menu&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>"></a><a href="tmp_config_<?php echo $_GET['board']; ?>_block.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordTmpColumnShow['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumnShow['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumnShow['type']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>"><img src="images/del.gif" width="45" height="18" /></a>
                    </div>
                  </div>
              </div>
              <?php } while ($row_RecordTmpColumnShow = mysqli_fetch_assoc($RecordTmpColumnShow)); ?>
          </div>
          <?php } // Show if recordset not empty ?></td>
      </tr>
    </table>
    
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".sortid").editable("sqledit/tmphomeblockcolumn_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".ed_customname").editable("sqledit/tmphomeblockcolumn_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "250px"
	});
	
	$(".ed_customnameshow").editable("sqledit/tmphomeblockcolumn_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "120px"
	});
});
</script>
  </div>
  
</div>

<div id="footer_config"></div>

</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);

mysqli_free_result($RecordTmpColumnShow);

mysqli_free_result($RecordTmpColumn);

mysqli_free_result($RecordTmpAddColumn);

mysqli_free_result($RecordSettingLock);
?>