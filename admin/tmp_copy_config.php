<?php require_once('../Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Tmp")) {
  $insertSQL = sprintf("INSERT INTO demo_tmp (userid, name, title, homeselect, tmpwebwidth, tmpwebwidthunit, tmpfbfanselect, tmpfbfanbkcolor, tmpfbfanboardcolor, type, tmpmainmenu, tmpleftmenu, tmpblock, tmpshowblockname, tmpdftmenu_x, tmpdftmenu_y, tmppicmenu_x, tmppicmenu_y, tmppicmenu_style, tmpbannerpicwidth, tmpbannerpicheight, tmplogomargintop, tmplogomarginleft, tmpwordcolor, tmpwordsize, tmplink, tmplinkvisit, tmplinkhover, tmpheaderminheight, tmpleftminheight, tmpmiddleminheight, tmprightminheight, tmpfooterminheight, tmpbanner, tmpdfmenucolor, tmpmenuselect, tmpbodyselect, tmpmenulimit, tmpbodybackground, tmpanimebackground, tmpbottombackground, tmpheaderbackground, tmpwrpbackground, tmpleftbackground, tmprightbackground, tmpmiddlebackground, tmpfooterbackground, tmpwrpboard, tmpbannerboard, tmpheaderboard, tmpleftboard, tmprightboard, tmptitleboard, tmpmiddleboard, tmpfooterboard, tmpmeger_t_m, tmpheaderpaddingtop, tmpheaderpaddingbttom, tmpheaderpaddingleft, tmpheaderpaddingright, tmpbannerpaddingtop, tmpbannerpaddingbttom, tmpbannerpaddingleft, tmpbannerpaddingright, tmpleftpaddingtop, tmpleftpaddingbttom, tmpleftpaddingleft, tmpleftpaddingright, tmprightpaddingtop, tmprightpaddingbttom, tmprightpaddingleft, tmprightpaddingright, tmpmiddlepaddingtop, tmpmiddlepaddingbttom, tmpmiddlepaddingleft, tmpmiddlepaddingright, tmpfooterpaddingtop, tmpfooterpaddingbttom, tmpfooterpaddingleft, tmpfooterpaddingright, tmpproductboard, tmpproductboardicon, tmpproductboardfontcolor, tmpprojectboard, tmpprojectboardicon, lang, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['homeselect'], "int"),
                       GetSQLValueString($_POST['tmpwebwidth'], "int"),
                       GetSQLValueString($_POST['tmpwebwidthunit'], "text"),
                       GetSQLValueString($_POST['tmpfbfanselect'], "int"),
                       GetSQLValueString($_POST['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($_POST['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['tmpmainmenu'], "int"),
                       GetSQLValueString($_POST['tmpleftmenu'], "int"),
                       GetSQLValueString($_POST['tmpblock'], "int"),
                       GetSQLValueString($_POST['tmpshowblockname'], "int"),
                       GetSQLValueString($_POST['tmpdftmenu_x'], "int"),
                       GetSQLValueString($_POST['tmpdftmenu_y'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_x'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_y'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_style'], "text"),
                       GetSQLValueString($_POST['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($_POST['tmpbannerpicheight'], "int"),
                       GetSQLValueString($_POST['tmplogomargintop'], "int"),
                       GetSQLValueString($_POST['tmplogomarginleft'], "int"),
                       GetSQLValueString($_POST['tmpwordcolor'], "text"),
                       GetSQLValueString($_POST['tmpwordsize'], "text"),
                       GetSQLValueString($_POST['tmplink'], "text"),
                       GetSQLValueString($_POST['tmplinkvisit'], "text"),
                       GetSQLValueString($_POST['tmplinkhover'], "text"),
                       GetSQLValueString($_POST['tmpheaderminheight'], "int"),
                       GetSQLValueString($_POST['tmpleftminheight'], "int"),
                       GetSQLValueString($_POST['tmpmiddleminheight'], "int"),
                       GetSQLValueString($_POST['tmprightminheight'], "int"),
                       GetSQLValueString($_POST['tmpfooterminheight'], "int"),
                       GetSQLValueString($_POST['tmpbanner'], "int"),
                       GetSQLValueString($_POST['tmpdfmenucolor'], "text"),
                       GetSQLValueString($_POST['tmpmenuselect'], "int"),
                       GetSQLValueString($_POST['TmpBodySelect'], "int"),
                       GetSQLValueString($_POST['tmpmenulimit'], "int"),
                       GetSQLValueString($_POST['tmpbodybackground'], "text"),
                       GetSQLValueString($_POST['tmpanimebackground'], "text"),
                       GetSQLValueString($_POST['tmpbottombackground'], "text"),
                       GetSQLValueString($_POST['tmpheaderbackground'], "text"),
                       GetSQLValueString($_POST['tmpwrpbackground'], "text"),
                       GetSQLValueString($_POST['tmpleftbackground'], "text"),
                       GetSQLValueString($_POST['tmprightbackground'], "text"),
                       GetSQLValueString($_POST['tmpmiddlebackground'], "text"),
                       GetSQLValueString($_POST['tmpfooterbackground'], "text"),
                       GetSQLValueString($_POST['tmpwrpboard'], "text"),
                       GetSQLValueString($_POST['tmpbannerboard'], "text"),
                       GetSQLValueString($_POST['tmpheaderboard'], "text"),
                       GetSQLValueString($_POST['tmpleftboard'], "text"),
                       GetSQLValueString($_POST['tmprightboard'], "text"),
                       GetSQLValueString($_POST['tmptitleboard'], "text"),
                       GetSQLValueString($_POST['tmpmiddleboard'], "text"),
                       GetSQLValueString($_POST['tmpfooterboard'], "text"),
                       GetSQLValueString($_POST['tmpmeger_t_m'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingright'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingright'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpproductboard'], "text"),
                       GetSQLValueString($_POST['tmpproductboardicon'], "text"),
                       GetSQLValueString($_POST['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($_POST['tmpprojectboard'], "text"),
                       GetSQLValueString($_POST['tmpprojectboardicon'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "manage_tmp.php?Operate=addSuccess&Opt_Tmp=viewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script><script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<!-- Light box -->
<link rel="stylesheet" href="css/colorbox/colorbox.css" />
<script type="text/javascript" language="javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script>
		$(document).ready(function(){
			$(".colorbox_iframe").colorbox({iframe:true, width:"80%", height:"80%"});
			$(".colorbox_iframe_small").colorbox({iframe:true, width:"1000px", height:"80%"});
			$(".colorbox_iframe_cd").colorbox({iframe:true, width:"99%", height:"99%"});
		});
</script>
<!-- Light box END -->
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jquery.miniColors.min.js">/*顏色選擇*/</script>
<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
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
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<style type="text/css">
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
#apDiv_config {
	position: fixed;
	width: 230px;
	height: 115px;
	z-index: 1;
	float: right;
	right: 0px;
	top: 60px;
}
#wrapper_config div #apDiv_config div span a {
	color: #1C590D;
	font-size: 9px;
}
</style>
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
<div style="padding:10px; margin:10px; position:relative;" id="wrapper_config">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;"> 
  <div id="apDiv_config">
  	<div style="width:160px; padding:5px; background-color:#E0E2FC; position:relative; font-size:11px; color:#666;" >
        <span style="background-color: #DDE9FB;padding: 2px; position: absolute; left: -5px; top: -6px; z-index:5;"><a href="#整體框架">整體框架</a></span>
        <div style="background-color:#D9FDE3; padding:20px; position:relative;">
        <span style="padding: 2px; position: absolute; left: 88px; top: 2px; z-index: 5; width: 93px;"><a href="#整體框架上">整體框架(+)</a></span>
        <div style="background-color:#DDE9FB; padding:5px; position:relative;">
            <span style="background-color:#DDE9FB;padding: 2px; position: absolute; left: -5px; top: -6px;"><a href="#主框架">主框架</a></span>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
          <tr>
            <td colspan="2" align="right" bgcolor="#FDEACC"><span style="padding: 2px;"><a href="#上方區塊">上方區塊</a></span></td>
            </tr>
          <tr>
            <td colspan="2" align="right" bgcolor="#FCDAA7"><span style="padding: 2px;"><a href="#橫幅區塊">橫幅區塊</a></span></td>
            </tr>
          <tr>
            <td width="20" valign="middle" bgcolor="#FBF5AE"><span style="padding: 2px;"><a href="#左方區塊">左方區塊</a></span></td>
            <td height="50" align="right" bgcolor="#E3FDCA"><span style="padding: 2px;"><a href="#中央區塊">中央區塊</a></span></td>
          </tr>
          <tr>
            <td colspan="2" align="right" bgcolor="#DDDAFE"><span style="padding: 2px;"><a href="#下方區塊">下方區塊</a></span></td>
          </tr>
        </table>
        </div>
        </div>
        </div>
  </div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">樣板設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
        </tr>
    </table>
	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="整體框架" id="整體框架"></a>整體框架：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">背景設定：</td>
      <td><br />
<span id="spryradio2">
	<iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpbodybackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe><br />

        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbodyselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="TmpBodySelect" value="1" id="TmpBodySelect_0" />
          獨立</label>
        <a href="tmpbodybackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a><span class="Form_Caption_Word">(限定此樣板使用。)</span><br />
<iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmpBg['TmpBg']; ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbodyselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="TmpBodySelect" value="0" id="TmpBodySelect_1" />
        </label>
        全樣板共通  <a href="tmpbackground_home.php?lang=<?php echo $_SESSION['lang']; ?>" data-original-title="背景選擇" target="_blank">背景指定</a><span class="Form_Caption_Word">(樣板皆使用同背景圖片，更新時需重新載入頁面觀看預覽圖。)</span><br />
        <span class="radioRequiredMsg">請進行選取。</span></span><br />
      </td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="整體框架上" id="整體框架上"></a>整體框架(+)：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">背景1：</td>
      <td><iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpanimebackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
        <br />
        <a href="tmpanimebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a> <span class="Form_Caption_Word">(此背景會位於整體框架之上。)</span></td>
    </tr>
    <tr>
      <td align="right">背景2：</td>
      <td><iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpbottombackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
        <br />
        <a href="tmpbottombackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a> <span class="Form_Caption_Word">(此背景會位於背景1之上。)</span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <a name="主框架" id="主框架"></a><strong>主框架：</strong></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td align="right">外框：</td>
      <td>
      <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmpwrpboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe>
      <br />
      <a href="tmpwrpboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>">外框指定</a>
      </td>
    </tr>
    <tr>
      <td align="right">背景：</td>
      <td>
      <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpwrpbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
      <br />
      <a href="tmpwrpbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定
      </a>
      
      </td>
    </tr>
    <tr>
      <td align="right">文字顏色：</td>
      <td><span id="TmpBackGroundBgColor">
      <label for="tmpwordcolor"></label>
      <input name="tmpwordcolor" type="text" class="color-picker" id="tmpwordcolor" value="<?php echo $row_RecordTmp['tmpwordcolor']; ?>" size="20"/>
      </span>
        <input name="RadomButtom" type="button" id="randomize" value="隨機顏色" /></td>
    </tr>
    <tr>
      <td align="right">文字大小：</td>
      <td><span id="TmpWordSize">
        <label for="tmpwordsize"></label>
        <select name="tmpwordsize" id="tmpwordsize">
          <option value="9px" <?php if (!(strcmp("9px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>9px</option>
          <option value="10px" <?php if (!(strcmp("10px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>10px</option>
          <option value="11px" <?php if (!(strcmp("11px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>11px</option>
          <option value="12px" <?php if (!(strcmp("12px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>12px</option>
          <option value="13px" <?php if (!(strcmp("13px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>13px</option>
          <option value="14px" <?php if (!(strcmp("14px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>14px</option>
          <option value="xx-small" <?php if (!(strcmp("xx-small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>xx-small</option>
          <option value="x-small" <?php if (!(strcmp("x-small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>x-small</option>
          <option value="small" <?php if (!(strcmp("small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>small</option>
          <option value="medium" <?php if (!(strcmp("medium", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>medium</option>
          <option value="large" <?php if (!(strcmp("large", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>large</option>
        </select>
        <span class="selectRequiredMsg">請選取項目。</span></span></td>
    </tr>
    <tr>
      <td align="right">連結：</td>
      <td><span id="TmpBackGroundBgColor2">
      <label for="tmplink"></label>
      <input name="tmplink" type="text" class="color-picker" id="tmplink" value="<?php echo $row_RecordTmp['tmplink']; ?>" size="20"/>
      </span></td>
    </tr>
    <tr>
      <td align="right">連結[已點選]：</td>
      <td><span id="TmpBackGroundBgColor3">
      <label for="tmplinkvisit"></label>
      <input name="tmplinkvisit" type="text" class="color-picker" id="tmplinkvisit" value="<?php echo $row_RecordTmp['tmplinkvisit']; ?>" size="20"/>
      </span></td>
    </tr>
    <tr>
      <td align="right">連結[滑鼠移入]：</td>
      <td><span id="TmpBackGroundBgColor4">
      <label for="tmplinkhover"></label>
      <input name="tmplinkhover" type="text" class="color-picker" id="tmplinkhover" value="<?php echo $row_RecordTmp['tmplinkhover']; ?>" size="20"/>
      </span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="上方區塊" id="上方區塊"></a>上方區塊：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Logo：</td>
      <td><a href="tmplogo_home.php?id_edit=<?php echo $row_RecordTmp['id']; ?>">Logo指定</a><br />
        距離上方 <span id="sprytextfield7">
        
        <input name="tmplogomargintop" type="text" id="tmplogomargintop" value="<?php echo $row_RecordTmp['tmplogomargintop']; ?>" size="3" maxlength="4" />
        <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 距離左方<span id="sprytextfield8">
        <label for="tmplogomarginleft"></label>
        <input name="tmplogomarginleft" type="text" id="tmplogomarginleft" value="<?php echo $row_RecordTmp['tmplogomarginleft']; ?>" size="3" maxlength="4" />
        <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
	<tr>
      <td align="right">主選單：</td>
      <td><label>
        <input <?php if (!(strcmp($row_RecordTmp['tmpmenuselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenuselect" value="0" id="tmpmenuselect_0" />
        通用</label>
       
<label>
  <span id="TmpDfMenuColor">
  <select name="tmpdfmenucolor" id="tmpdfmenucolor">
    <option value="white" <?php if (!(strcmp("white", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>白</option>
    <option value="black" <?php if (!(strcmp("black", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>黑</option>
<option value="red" <?php if (!(strcmp("red", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>紅</option>
    <option value="blue" <?php if (!(strcmp("blue", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>藍</option>
    <option value="green" <?php if (!(strcmp("green", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>綠</option>
    <option value="grey" <?php if (!(strcmp("grey", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>灰</option>
    <option value="lightblue" <?php if (!(strcmp("lightblue", $row_RecordTmp['tmpdfmenucolor']))) {echo "selected=\"selected\"";} ?>>淡藍</option>
  </select>
  <span class="selectRequiredMsg">請選取項目。</span></span><br />
          <div style="display:<?php if($row_RecordTmp['tmpmenulimit'] == '0') { echo 'none';} ?>"><hr />
          <input <?php if (!(strcmp($row_RecordTmp['tmpmenuselect'],"1"))) {echo "checked=\"checked\"";} ?>  type="radio" name="tmpmenuselect" value="1" id="tmpmenuselect_1" />
          樣板</label><br />
          距離右方<span id="sprytextfield39">
          <label for="tmpdftmenu_x"></label>
          <input name="tmpdftmenu_x" type="text" id="tmpdftmenu_x" value="<?php echo $row_RecordTmp['tmpdftmenu_x']; ?>" size="3" maxlength="3" />
          <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 距離上方<span id="sprytextfield40">
          <label for="tmpdftmenu_y"></label>
          <input name="tmpdftmenu_y" type="text" id="tmpdftmenu_y" value="<?php echo $row_RecordTmp['tmpdftmenu_y']; ?>" size="3" maxlength="3" />
          <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</div>
          <a href="tmpmainmenu_home.php?id=<?php echo $row_RecordTmp['id']; ?>">主選單指定</a>
          <div style="display:<?php if($row_RecordTmp['tmpmenulimit'] == '0' || $row_RecordTmp['tmpmenulimit'] == '1') { echo 'none';} ?>">
          <hr />
          <input <?php if (!(strcmp($row_RecordTmp['tmpmenuselect'],"2"))) {echo "checked=\"checked\"";} ?>  type="radio" name="tmpmenuselect" value="2" id="tmpmenuselect_2" />
          圖片</label>
          <br />
          距離左方<span id="sprytextfield41">
          <label for="tmppicmenu_x"></label>
          <input name="tmppicmenu_x" type="text" id="tmppicmenu_x" value="<?php echo $row_RecordTmp['tmppicmenu_x']; ?>" size="3" maxlength="3" />
          <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 距離上方<span id="sprytextfield42">
          <label for="tmppicmenu_y"></label>
          <input name="tmppicmenu_y" type="text" id="tmppicmenu_y" value="<?php echo $row_RecordTmp['tmppicmenu_y']; ?>" size="3" maxlength="3" />
          <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px
          <span id="spryselect3">
          <label for="tmppicmenu_style"></label>
          <select name="tmppicmenu_style" id="tmppicmenu_style">
            <option value="mainmenu_sty01" <?php if (!(strcmp("mainmenu_sty01", $row_RecordTmp['tmppicmenu_style']))) {echo "selected=\"selected\"";} ?>>綠/橘/無外框</option>
            <option value="mainmenu_sty02" <?php if (!(strcmp("mainmenu_sty02", $row_RecordTmp['tmppicmenu_style']))) {echo "selected=\"selected\"";} ?>>黑/橘/無外框</option>
            <option value="mainmenu_sty03" <?php if (!(strcmp("mainmenu_sty03", $row_RecordTmp['tmppicmenu_style']))) {echo "selected=\"selected\"";} ?>>深藍/橘/白框</option>
            <option value="mainmenu_sty04" <?php if (!(strcmp("mainmenu_sty04", $row_RecordTmp['tmppicmenu_style']))) {echo "selected=\"selected\"";} ?>>綠/白/淡灰框</option>
            <option value="mainmenu_sty05" <?php if (!(strcmp("mainmenu_sty05", $row_RecordTmp['tmppicmenu_style']))) {echo "selected=\"selected\"";} ?>>白/橘/英文小字</option>
          </select>
          <span class="selectRequiredMsg">請選取項目。</span></span></div>
          </td>
      </tr>
     <tr>
       <td align="right">背景：</td>
       <td>
       <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpheaderbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
       <br />
         <a href="tmpheaderbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a>
         </td>
     </tr>
      <tr>
      <td align="right">最小高度：</td>
      <td><span id="sprytextfield1">
        <label for="tmpheaderminheight"></label>
        <input name="tmpheaderminheight" type="text" id="tmpheaderminheight" value="<?php echo $row_RecordTmp['tmpheaderminheight']; ?>" size="5" maxlength="5" />
        <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">內距：</td>
      <td><span id="sprytextfield11">
      <label for="tmpheaderpaddingtop">上</label>
      <input name="tmpheaderpaddingtop" type="text" id="tmpheaderpaddingtop" value="<?php echo $row_RecordTmp['tmpheaderpaddingtop']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 下<span id="sprytextfield12">
      <label for="tmpheaderpaddingbttom"></label>
      <input name="tmpheaderpaddingbttom" type="text" id="tmpheaderpaddingbttom" value="<?php echo $row_RecordTmp['tmpheaderpaddingbttom']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 左<span id="sprytextfield13">
      <label for="tmpheaderpaddingleft"></label>
      <input name="tmpheaderpaddingleft" type="text" id="tmpheaderpaddingleft" value="<?php echo $row_RecordTmp['tmpheaderpaddingleft']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 右<span id="sprytextfield14">
      <label for="tmpheaderpaddingright"></label>
      <input name="tmpheaderpaddingright" type="text" id="tmpheaderpaddingright" value="<?php echo $row_RecordTmp['tmpheaderpaddingright']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="橫幅區塊" id="橫幅區塊"></a>橫幅區塊：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">橫幅：</td>
      <td><span id="TmpTmpBanner">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="0" id="tmpbanner_0" />
          不使用
        </label>
        <br />
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="1" id="tmpbanner_1" />
          統一的橫幅(多圖輪播)
        </label>
        <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="橫幅設定" target="_blank">橫幅設定</a><span class="Form_Caption_Word">(樣板可共用橫幅圖片，特殊版型樣板不支援。)</span><br />
           <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="2" id="tmpbanner_2" />
          獨立(多圖輪播)</label>
           <a href="tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordTmp['id']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>" data-original-title="橫幅設定">橫幅設定</a><span class="Form_Caption_Word">(限定此樣板使用。)</span><br />
           <label>
             <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="3" id="tmpbanner_3" />
             單圖</label>
           (Gif / Flash / Jpg)<br />
        <span class="radioRequiredMsg">請進行選取。</span></span>寬度：<span id="sprytextfield35">
        <label for="tmpbannerpicwidth"></label>
        <input name="tmpbannerpicwidth" type="text" id="tmpbannerpicwidth" value="<?php echo $row_RecordTmp['tmpbannerpicwidth']; ?>" size="3" maxlength="4" />
        <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 高度：<span id="sprytextfield36">
        <label for="tmpbannerpicheight"></label>
        <input name="tmpbannerpicheight" type="text" id="tmpbannerpicheight" value="<?php echo $row_RecordTmp['tmpbannerpicheight']; ?>" size="3" maxlength="3" />
        <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px
        <input name="button4" type="button" id="button4" onclick="MM_openBrWindow('uplod_tmpbannerpic.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>','圖片上傳','width=500,height=350')" value="修改上傳資料" /></td>
    </tr>
     <tr>
       <td align="right">外框：</td>
       <td>
       <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmpbannerboard']; ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe>
      <br />
       <a href="tmpbannerboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>">外框指定</a>
       </td>
     </tr>
    <tr>
      <td align="right">內距：</td>
      <td>上<span id="sprytextfield15">
      <label for="tmpbannerpaddingtop"></label>
      <input name="tmpbannerpaddingtop" type="text" id="tmpbannerpaddingtop" value="<?php echo $row_RecordTmp['tmpbannerpaddingtop']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 下<span id="sprytextfield16">
      <label for="tmpbannerpaddingbttom"></label>
      <input name="tmpbannerpaddingbttom" type="text" id="tmpbannerpaddingbttom" value="<?php echo $row_RecordTmp['tmpbannerpaddingbttom']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 左<span id="sprytextfield17">
      <label for="tmpbannerpaddingleft"></label>
      <input name="tmpbannerpaddingleft" type="text" id="tmpbannerpaddingleft" value="<?php echo $row_RecordTmp['tmpbannerpaddingleft']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 右<span id="sprytextfield18">
      <label for="tmpbannerpaddingright"></label>
      <input name="tmpbannerpaddingright" type="text" id="tmpbannerpaddingright" value="<?php echo $row_RecordTmp['tmpbannerpaddingright']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="左方區塊" id="左方區塊"></a>左方區塊：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">選單區塊：</td>
      <td><a href="tmpleftmenu_home.php?id=<?php echo $row_RecordTmp['id']; ?>">選單指定</a></td>
    </tr>
     <tr>
      <td align="right">區塊名稱</td>
      <td><span id="spryradio5">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpshowblockname'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpshowblockname" value="1" id="tmpshowblockname_0" />
          顯示</label>
        
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpshowblockname'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpshowblockname" value="0" id="tmpshowblockname_1" />
          隱藏</label>
        <br />
        <span class="radioRequiredMsg">請進行選取。</span></span></td>
    </tr>
    <tr>
      <td align="right">側邊裝飾外框：</td>
      <td><a href="tmpblock_home.php?id=<?php echo $row_RecordTmp['id']; ?>">側邊裝飾外框指定</a></td>
    </tr>
     <tr>
       <td align="right">背景：</td>
       <td><iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpleftbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
       <br />
       <a href="tmpleftbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a></td>
     </tr>
    <tr>
      <td align="right">最小高度：</td>
      <td><span id="sprytextfield3">
      <label for="tmpleftminheight"></label>
      <input name="tmpleftminheight" type="text" id="tmpleftminheight" value="<?php echo $row_RecordTmp['tmpleftminheight']; ?>" size="5" maxlength="5" />
      <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">內距：</td>
      <td>上<span id="sprytextfield19">
      <label for="tmpleftpaddingtop"></label>
      <input name="tmpleftpaddingtop" type="text" id="tmpleftpaddingtop" value="<?php echo $row_RecordTmp['tmpleftpaddingtop']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 下<span id="sprytextfield20">
      <label for="tmpleftpaddingbttom"></label>
      <input name="tmpleftpaddingbttom" type="text" id="tmpleftpaddingbttom" value="<?php echo $row_RecordTmp['tmpleftpaddingbttom']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 左<span id="sprytextfield21">
      <label for="tmpleftpaddingleft"></label>
      <input name="tmpleftpaddingleft" type="text" id="tmpleftpaddingleft" value="<?php echo $row_RecordTmp['tmpleftpaddingleft']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 右<span id="sprytextfield22">
      <label for="tmpleftpaddingright"></label>
      <input name="tmpleftpaddingright" type="text" id="tmpleftpaddingright" value="<?php echo $row_RecordTmp['tmpleftpaddingright']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="右方區塊" id="右方區塊"></a>右方區塊：</strong></td>
      <td><span class="Form_Caption_Word">(限定三欄式版型使用。)</span></td>
    </tr>
     <tr>
       <td align="right">背景：</td>
       <td>
         <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
       <br />
       <a href="tmprightbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a></td>
     </tr>
    <tr>
      <td align="right">最小高度：</td>
      <td><span id="sprytextfield4">
        <label for="tmprightminheight"></label>
        <input name="tmprightminheight" type="text" id="tmprightminheight" value="<?php echo $row_RecordTmp['tmprightminheight']; ?>" size="5" maxlength="5" />
        <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">內距：</td>
      <td>上<span id="sprytextfield23">
      <label for="tmprightpaddingtop"></label>
      <input name="tmprightpaddingtop" type="text" id="tmprightpaddingtop" value="<?php echo $row_RecordTmp['tmprightpaddingtop']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 下<span id="sprytextfield24">
      <label for="tmprightpaddingbttom"></label>
      <input name="tmprightpaddingbttom" type="text" id="tmprightpaddingbttom" value="<?php echo $row_RecordTmp['tmprightpaddingbttom']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 左<span id="sprytextfield25">
      <label for="tmprightpaddingleft"></label>
      <input name="tmprightpaddingleft" type="text" id="tmprightpaddingleft" value="<?php echo $row_RecordTmp['tmprightpaddingleft']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 右<span id="sprytextfield26">
      <label for="tmprightpaddingright"></label>
      <input name="tmprightpaddingright" type="text" id="tmprightpaddingright" value="<?php echo $row_RecordTmp['tmprightpaddingright']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><a name="中央區塊" id="中央區塊"></a>中央區塊：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">外框：</td>
      <td>
      <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmpmiddleboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe>
      <br />
      <a href="tmpmiddleboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>">外框指定</a>
      </td>
    </tr>
    <tr>
      <td align="right">標題外框：</td>
      <td>
      <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmptitleboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe>
      <br />
      <a href="tmptitleboard_home.php?id=<?php echo $row_RecordTmp['id']; ?>">外框指定</a>
      </td>
    </tr>
     <tr>
      <td align="right">外框合併：</td>
      <td><span class="Form_Caption_Word"><span id="spryradio4">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpmeger_t_m'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmeger_t_m" value="1" id="tmpmeger_t_m_0" />
          合併</label>
        
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpmeger_t_m'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmeger_t_m" value="0" id="tmpmeger_t_m_1" />
          不合併</label>
        <br />
        <span class="radioRequiredMsg">請進行選取。</span></span>(會將上方兩區塊作合併，合併時上下兩外框建議選擇同項目[僅適用於存圖片之外框]。)</span></td>
    </tr>
    <tr>
      <td align="right">標題小圖示：</td>
      <td><iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmptitlebackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
     <br />
      <a href="tmptitlebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>">圖示指定</a></td>
    </tr>
     <tr>
       <td align="right">背景：</td>
       <td><iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpmiddlebackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
         <br />
       <a href="tmpmiddlebackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a></td>
     </tr>
    
    <tr>
      <td align="right">最小高度：</td>
      <td><span id="sprytextfield5">
      <label for="tmpmiddleminheight"></label>
      <input name="tmpmiddleminheight" type="text" id="tmpmiddleminheight" value="<?php echo $row_RecordTmp['tmpmiddleminheight']; ?>" size="5" maxlength="5" />
<span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">內距：</td>
      <td>上<span id="sprytextfield27">
      <label for="tmpmiddlepaddingtop"></label>
      <input name="tmpmiddlepaddingtop" type="text" id="tmpmiddlepaddingtop" value="<?php echo $row_RecordTmp['tmpmiddlepaddingtop']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 下<span id="sprytextfield28">
      <label for="tmpmiddlepaddingbttom"></label>
      <input name="tmpmiddlepaddingbttom" type="text" id="tmpmiddlepaddingbttom" value="<?php echo $row_RecordTmp['tmpmiddlepaddingbttom']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 左<span id="sprytextfield29">
      <label for="tmpmiddlepaddingleft"></label>
      <input name="tmpmiddlepaddingleft" type="text" id="tmpmiddlepaddingleft" value="<?php echo $row_RecordTmp['tmpmiddlepaddingleft']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 右<span id="sprytextfield30">
      <label for="tmpmiddlepaddingright"></label>
      <input name="tmpmiddlepaddingright" type="text" id="tmpmiddlepaddingright" value="<?php echo $row_RecordTmp['tmpmiddlepaddingright']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <a name="下方區塊" id="下方區塊"></a><strong>下方區塊：</strong></td>
      <td>&nbsp;</td>
    </tr>
     <tr>
       <td align="right">背景：</td>
       <td>
       <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpfooterbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
       <br />
       <a href="tmpfooterbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">背景指定</a></td>
     </tr>
    <tr>
      <td align="right">最小高度：</td>
      <td><span id="sprytextfield6">
      <label for="tmpfooterminheight"></label>
      <input name="tmpfooterminheight" type="text" id="tmpfooterminheight" value="<?php echo $row_RecordTmp['tmpfooterminheight']; ?>" size="5" maxlength="5" />
<span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">內距：</td>
      <td>上<span id="sprytextfield31">
      <label for="tmpfooterpaddingtop"></label>
      <input name="tmpfooterpaddingtop" type="text" id="tmpfooterpaddingtop" value="<?php echo $row_RecordTmp['tmpfooterpaddingtop']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 下<span id="sprytextfield32">
      <label for="tmpfooterpaddingbttom"></label>
      <input name="tmpfooterpaddingbttom" type="text" id="tmpfooterpaddingbttom" value="<?php echo $row_RecordTmp['tmpfooterpaddingbttom']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 左<span id="sprytextfield33">
      <label for="tmpfooterpaddingleft"></label>
      <input name="tmpfooterpaddingleft" type="text" id="tmpfooterpaddingleft" value="<?php echo $row_RecordTmp['tmpfooterpaddingleft']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 右<span id="sprytextfield34">
      <label for="tmpfooterpaddingright"></label>
      <input name="tmpfooterpaddingright" type="text" id="tmpfooterpaddingright" value="<?php echo $row_RecordTmp['tmpfooterpaddingright']; ?>" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px</td>
    </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong>功能模組：</strong></td>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td align="right">FB粉絲頁：</td>
      <td>是否使用 - <span id="spryradio3">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpfbfanselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpfbfanselect" value="1" id="tmpfbfanselect_0" />
          啟用</label>
        
        <label>
          <input  <?php if (!(strcmp($row_RecordTmp['tmpfbfanselect'],"0"))) {echo "checked=\"checked\"";} ?> name="tmpfbfanselect" type="radio" id="tmpfbfanselect_1" value="0" />
          關閉</label>
        <br />
        <span class="radioRequiredMsg">請進行選取。</span></span> 
        <br />
        外框顏色 - <span id="sprytextfield37">
        <label for="tmpfbfanboardcolor"></label>
        <input name="tmpfbfanboardcolor" type="text" class="color-picker" id="tmpfbfanboardcolor" value="<?php echo $row_RecordTmp['tmpfbfanboardcolor']; ?>" size="20"/>
</span>
<br />
背景顏色 - <span id="sprytextfield38">
        <label for="tmpfbfanbkcolor"></label>
        <input name="tmpfbfanbkcolor" type="text" class="color-picker" id="tmpfbfanbkcolor" value="<?php echo $row_RecordTmp['tmpfbfanbkcolor']; ?>" size="20"/>
</span>
        </td>
    </tr>
    <tr style="display:<?php if($OptionNewsSelect == '0') { echo 'none';} ?>">
      <td align="right">最新訊息：</td>
      <td><iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpnewsevenbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
        <br />
        <a href="tmpnewsevenbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">奇數列-背景指定</a><br />
        <iframe src="tmp_config_background_view.php?id=<?php echo $row_RecordTmp['tmpnewsoddbackground']  ?>" width="52" marginwidth="0" height="52" marginheight="0" scrolling="no" frameborder="0"></iframe>
        <br />
        <a href="tmpnewsoddbackground_home.php?id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="背景選擇">偶數列-背景指定</a><br /></td>
    </tr>
    <tr style="display:<?php if($OptionProductSelect == '0') { echo 'none';} ?>">
      <td align="right">產品資訊：</td>
      <td>相片外框-<span id="spryselect4">
        <label for="tmpproductboard"></label>
        <select name="tmpproductboard" id="tmpproductboard">
          <option value="base" <?php if (!(strcmp("base", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>基本</option>
          <option value="corner" <?php if (!(strcmp("corner", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>圓角</option>
          <option value="glass01" <?php if (!(strcmp("glass01", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>玻璃圓角</option>
          <option value="glass02" <?php if (!(strcmp("glass02", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>玻璃方角</option>
          <option value="pick" <?php if (!(strcmp("pick", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>切角</option>
          <option value="stamp" <?php if (!(strcmp("stamp", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>郵票</option>
          <option value="photographic" <?php if (!(strcmp("photographic", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙A</option>
          <option value="photographic01" <?php if (!(strcmp("photographic01", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙B</option>
          <option value="photographic02" <?php if (!(strcmp("photographic02", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙C</option>
          <option value="photographic03" <?php if (!(strcmp("photographic03", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙D</option>
          <option value="photographic04" <?php if (!(strcmp("photographic04", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙E</option>
          <option value="photographic05" <?php if (!(strcmp("photographic05", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙F</option>
          <option value="photographic06" <?php if (!(strcmp("photographic06", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙G</option>
          <option value="photographic07" <?php if (!(strcmp("photographic07", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙H</option>
          <option value="photographic08" <?php if (!(strcmp("photographic08", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙I</option>
          <option value="photographic09" <?php if (!(strcmp("photographic09", $row_RecordTmp['tmpproductboard']))) {echo "selected=\"selected\"";} ?>>相紙J</option>
        </select>
        <span class="selectRequiredMsg">請選取項目。</span></span><br />
        相片外框小圖示-<span id="spryselect5">
        <label for="tmpproductboardicon"></label>
        <select name="tmpproductboardicon" id="tmpproductboardicon">
          <option value="" <?php if (!(strcmp("", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>-- 選擇圖示 --</option>
          <option value="photoFram_Block_glossy" <?php if (!(strcmp("photoFram_Block_glossy", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>仿玻璃</option>
          <option value="photoFram_Block_floral-corner" <?php if (!(strcmp("photoFram_Block_floral-corner", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>花紋A</option>
          <option value="photoFram_Block_heraldry" <?php if (!(strcmp("photoFram_Block_heraldry", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>花紋B</option>
          <option value="photoFram_Block_paper-clip" <?php if (!(strcmp("photoFram_Block_paper-clip", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>迴紋針</option>
          <option value="photoFram_Block_pin" <?php if (!(strcmp("photoFram_Block_pin", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>圖釘</option>
          <option value="photoFram_Block_tape" <?php if (!(strcmp("photoFram_Block_tape", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>膠帶</option>
          <option value="photoFram_Block_flower" <?php if (!(strcmp("photoFram_Block_flower", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>花和蝴蝶</option>
          <option value="photoFram_Block_leaf" <?php if (!(strcmp("photoFram_Block_leaf", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>葉子</option>
          <option value="photoFram_Block_clip" <?php if (!(strcmp("photoFram_Block_clip", $row_RecordTmp['tmpproductboardicon']))) {echo "selected=\"selected\"";} ?>>夾子</option>
        </select>
</span><br />
標題文字-<span id="sprytextfield43">
<label for="tmpproductboardfontcolor"></label>
<input name="tmpproductboardfontcolor" type="text" class="color-picker" id="tmpproductboardfontcolor" value="<?php echo $row_RecordTmp['tmpproductboardfontcolor']; ?>" size="20"/>
<span class="textfieldRequiredMsg">需要有一個值。</span></span>      </td>
    </tr>
    <tr style="display:<?php if($OptionProjectSelect == '0') { echo 'none';} ?>">
      <td align="right">工程實績：</td>
      <td>相片外框-<span id="spryselect6">
        <label for="tmpprojectboard"></label>
        <select name="tmpprojectboard" id="tmpprojectboard">
          <option value="base" <?php if (!(strcmp("base", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>基本</option>
          <option value="corner" <?php if (!(strcmp("corner", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>圓角</option>
          <option value="glass01" <?php if (!(strcmp("glass01", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>玻璃圓角</option>
          <option value="glass02" <?php if (!(strcmp("glass02", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>玻璃方角</option>
          <option value="pick" <?php if (!(strcmp("pick", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>切角</option>
          <option value="stamp" <?php if (!(strcmp("stamp", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>郵票</option>
          <option value="photographic" <?php if (!(strcmp("photographic", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙A</option>
          <option value="photographic01" <?php if (!(strcmp("photographic01", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙B</option>
          <option value="photographic02" <?php if (!(strcmp("photographic02", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙C</option>
          <option value="photographic03" <?php if (!(strcmp("photographic03", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙D</option>
          <option value="photographic04" <?php if (!(strcmp("photographic04", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙E</option>
          <option value="photographic05" <?php if (!(strcmp("photographic05", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙F</option>
          <option value="photographic06" <?php if (!(strcmp("photographic06", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙G</option>
          <option value="photographic07" <?php if (!(strcmp("photographic07", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙H</option>
          <option value="photographic08" <?php if (!(strcmp("photographic08", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙I</option>
          <option value="photographic09" <?php if (!(strcmp("photographic09", $row_RecordTmp['tmpprojectboard']))) {echo "selected=\"selected\"";} ?>>相紙J</option>
        </select>
        <span class="selectRequiredMsg">請選取項目。</span></span><br />
        相片外框小圖示-<span id="spryselect7">
        <label for="tmpprojectboardicon"></label>
        <select name="tmpprojectboardicon" id="tmpprojectboardicon">
          <option value="" <?php if (!(strcmp("", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>-- 選擇圖示 --</option>
          <option value="photoFram_Block_glossy" <?php if (!(strcmp("photoFram_Block_glossy", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>仿玻璃</option>
          <option value="photoFram_Block_floral-corner" <?php if (!(strcmp("photoFram_Block_floral-corner", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>花紋A</option>
          <option value="photoFram_Block_heraldry" <?php if (!(strcmp("photoFram_Block_heraldry", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>花紋B</option>
          <option value="photoFram_Block_paper-clip" <?php if (!(strcmp("photoFram_Block_paper-clip", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>迴紋針</option>
          <option value="photoFram_Block_pin" <?php if (!(strcmp("photoFram_Block_pin", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>圖釘</option>
          <option value="photoFram_Block_tape" <?php if (!(strcmp("photoFram_Block_tape", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>膠帶</option>
          <option value="photoFram_Block_flower" <?php if (!(strcmp("photoFram_Block_flower", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>花和蝴蝶</option>
          <option value="photoFram_Block_leaf" <?php if (!(strcmp("photoFram_Block_leaf", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>葉子</option>
          <option value="photoFram_Block_clip" <?php if (!(strcmp("photoFram_Block_clip", $row_RecordTmp['tmpprojectboardicon']))) {echo "selected=\"selected\"";} ?>>夾子</option>
        </select>
</span><br /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="110" align="right">&nbsp;</td>
      <td>
        <input type="submit" name="button" id="button" value="送出填寫資料" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
        <input name="name" type="hidden" id="name" value="<?php echo $row_RecordTmp['name']; ?>" />
        <input name="title" type="hidden" id="title" value="[Copy]<?php echo $row_RecordTmp['title']; ?>" />
        <input name="homeselect" type="hidden" id="homeselect" value="<?php echo $row_RecordTmp['homeselect']; ?>" />
        <input name="tmpwebwidth" type="hidden" id="tmpwebwidth" value="<?php echo $row_RecordTmp['tmpwebwidth']; ?>" />
        <input name="tmpwebwidthunit" type="hidden" id="tmpwebwidthunit" value="<?php echo $row_RecordTmp['tmpwebwidthunit']; ?>" />
        <input name="tmpmenulimit" type="hidden" id="tmpmenulimit" value="<?php echo $row_RecordTmp['tmpmenulimit']; ?>" />
        <input name="type" type="hidden" id="type" value="<?php echo $row_RecordTmp['type']; ?>" />
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $row_RecordTmp['wshop']; ?>" />
        <input name="tmpmainmenu" type="hidden" id="tmpmainmenu" value="<?php echo $row_RecordTmp['tmpmainmenu']; ?>" />
        <input name="tmpleftmenu" type="hidden" id="tmpleftmenu" value="<?php echo $row_RecordTmp['tmpleftmenu']; ?>" />
        <input name="tmpblock" type="hidden" id="tmpblock" value="<?php echo $row_RecordTmp['tmpblock']; ?>" />
        <input name="tmpbodybackground" type="hidden" id="tmpbodybackground" value="<?php echo $row_RecordTmp['tmpbodybackground']; ?>" />
        <input name="tmpanimebackground" type="hidden" id="tmpanimebackground" value="<?php echo $row_RecordTmp['tmpanimebackground']; ?>" />
        <input name="tmpbottombackground" type="hidden" id="tmpbottombackground" value="<?php echo $row_RecordTmp['tmpbottombackground']; ?>" />
        <input name="tmpheaderbackground" type="hidden" id="tmpheaderbackground" value="<?php echo $row_RecordTmp['tmpheaderbackground']; ?>" />
        <input name="tmpwrpbackground" type="hidden" id="tmpwrpbackground" value="<?php echo $row_RecordTmp['tmpwrpbackground']; ?>" />
        <input name="tmpleftbackground" type="hidden" id="tmpleftbackground" value="<?php echo $row_RecordTmp['tmpleftbackground']; ?>" />
        <input name="tmprightbackground" type="hidden" id="tmprightbackground" value="<?php echo $row_RecordTmp['tmprightbackground']; ?>" />
        <input name="tmpmiddlebackground" type="hidden" id="tmpmiddlebackground" value="<?php echo $row_RecordTmp['tmpmiddlebackground']; ?>" />
        <input name="tmpfooterbackground" type="hidden" id="tmpfooterbackground" value="<?php echo $row_RecordTmp['tmpfooterbackground']; ?>" />
        <input name="tmpwrpboard" type="hidden" id="tmpwrpboard" value="<?php echo $row_RecordTmp['tmpwrpboard']; ?>" />
        <input name="tmpbannerboard" type="hidden" id="tmpbannerboard" value="<?php echo $row_RecordTmp['tmpbannerboard']; ?>" />
        <input name="tmpheaderboard" type="hidden" id="tmpheaderboard" value="<?php echo $row_RecordTmp['tmpheaderboard']; ?>" />
        <input name="tmpleftboard" type="hidden" id="tmpleftboard" value="<?php echo $row_RecordTmp['tmpleftboard']; ?>" />
        <input name="tmprightboard" type="hidden" id="tmprightboard" value="<?php echo $row_RecordTmp['tmprightboard']; ?>" />
        <input name="tmptitleboard" type="hidden" id="tmptitleboard" value="<?php echo $row_RecordTmp['tmptitleboard']; ?>" />
        <input name="tmpmiddleboard" type="hidden" id="tmpmiddleboard" value="<?php echo $row_RecordTmp['tmpmiddleboard']; ?>" />
        <input name="tmpfooterboard" type="hidden" id="tmpfooterboard" value="<?php echo $row_RecordTmp['tmpfooterboard']; ?>" />
        <input name="webname" type="hidden" id="webname" value="<?php echo $wshop; ?>" />
        
        </td>
    </tr>
   
    
  </table>
  <input type="hidden" name="MM_insert" value="form_Tmp" />
	</form>
  </div>
</div>
<div id="footer_config"></div>
<script type="text/javascript">
$(document).ready( function() {
		// 把有 .color-picker 的輸入框轉換成 miniColors 效果
		$(".color-picker").miniColors({
			letterCase: 'uppercase'
		});
 
		$("#randomize").click(function(){
			// 產生隨機顏色
			$(".color-picker").each(function(){
				$(this).miniColors('value', '#' + Math.floor(Math.random() * 16777215).toString(16));
			});
		})
	});
</script>
<script type="text/javascript">
var spryradio1 = new Spry.Widget.ValidationRadio("TmpTmpBanner", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("TmpDfMenuColor", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpBackGroundBgColor", "none", {validateOn:["blur"], isRequired:false});
var spryselect2 = new Spry.Widget.ValidationSelect("TmpWordSize", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpBackGroundBgColor2", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpBackGroundBgColor3", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpBackGroundBgColor4", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "integer", {validateOn:["blur"], isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {isRequired:false, validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer", {validateOn:["blur"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "integer", {validateOn:["blur"]});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "integer", {validateOn:["blur"]});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "integer", {validateOn:["blur"]});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "integer", {validateOn:["blur"]});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "integer", {validateOn:["blur"]});
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16", "integer", {validateOn:["blur"]});
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "integer", {validateOn:["blur"]});
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18", "integer", {validateOn:["blur"]});
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19", "integer", {validateOn:["blur"]});
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20", "integer", {validateOn:["blur"]});
var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21", "integer", {validateOn:["blur"]});
var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22", "integer", {validateOn:["blur"]});
var sprytextfield23 = new Spry.Widget.ValidationTextField("sprytextfield23", "integer", {validateOn:["blur"]});
var sprytextfield24 = new Spry.Widget.ValidationTextField("sprytextfield24", "integer", {validateOn:["blur"]});
var sprytextfield25 = new Spry.Widget.ValidationTextField("sprytextfield25", "integer", {validateOn:["blur"]});
var sprytextfield26 = new Spry.Widget.ValidationTextField("sprytextfield26", "integer", {validateOn:["blur"]});
var sprytextfield27 = new Spry.Widget.ValidationTextField("sprytextfield27", "integer", {validateOn:["blur"]});
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "integer", {validateOn:["blur"]});
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "integer", {validateOn:["blur"]});
var sprytextfield30 = new Spry.Widget.ValidationTextField("sprytextfield30", "integer", {validateOn:["blur"]});
var sprytextfield31 = new Spry.Widget.ValidationTextField("sprytextfield31", "integer", {validateOn:["blur"]});
var sprytextfield32 = new Spry.Widget.ValidationTextField("sprytextfield32", "integer", {validateOn:["blur"]});
var sprytextfield33 = new Spry.Widget.ValidationTextField("sprytextfield33", "integer", {validateOn:["blur"]});
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "integer", {validateOn:["blur"]});
var spryradio2 = new Spry.Widget.ValidationRadio("spryradio2");
var sprytextfield35 = new Spry.Widget.ValidationTextField("sprytextfield35", "integer", {isRequired:false, validateOn:["blur"]});
var sprytextfield36 = new Spry.Widget.ValidationTextField("sprytextfield36", "integer", {validateOn:["blur"], isRequired:false});
var spryradio3 = new Spry.Widget.ValidationRadio("spryradio3");
var sprytextfield37 = new Spry.Widget.ValidationTextField("sprytextfield37", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield38 = new Spry.Widget.ValidationTextField("sprytextfield38", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield39 = new Spry.Widget.ValidationTextField("sprytextfield39", "integer", {validateOn:["blur"]});
var sprytextfield40 = new Spry.Widget.ValidationTextField("sprytextfield40", "integer", {validateOn:["blur"]});
var sprytextfield41 = new Spry.Widget.ValidationTextField("sprytextfield41", "integer", {validateOn:["blur"]});
var sprytextfield42 = new Spry.Widget.ValidationTextField("sprytextfield42", "integer", {validateOn:["blur"]});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4", {validateOn:["blur"]});
var spryselect5 = new Spry.Widget.ValidationSelect("spryselect5", {validateOn:["blur"], isRequired:false});
var sprytextfield43 = new Spry.Widget.ValidationTextField("sprytextfield43", "none", {validateOn:["blur"]});
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {isRequired:false, validateOn:["blur"]});
var spryradio4 = new Spry.Widget.ValidationRadio("spryradio4");
var spryradio5 = new Spry.Widget.ValidationRadio("spryradio5");
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>