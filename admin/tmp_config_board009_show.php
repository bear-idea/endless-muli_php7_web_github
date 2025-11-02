<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('inc_mdname.php'); ?>
<?php require_once("../inc_setting_fr_tmp_show.php"); ?>
<?php require_once("../inc/inc_path.php"); ?>
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
<link href="../assets/plugins/slider.revolution/css/extralayers.css" rel="stylesheet" type="text/css" />
<link href="../assets/plugins/slider.revolution/css/settings.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/layout-font-rewrite.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/color_scheme/color.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<script type="text/javascript" src="../assets/plugins/skitter-master/dist/jquery.skitter.min.js"></script>
<script type="text/javascript" src="../assets/plugins/slider.revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="../assets/plugins/slider.revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="../assets/js/view/demo.revolution_slider.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.timers.js"></script>
<script type="text/javascript" src="../js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="../js/jquery.dropshadow.js"></script>
<script type="text/javascript" src="js/jquery.miniColors.min.js">/*顏色選擇*/</script>
<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
$(function(){$("#SiteKeyWord,#skeyword").tagsInput({width:"auto",defaultText:"\u52a0\u5165\u95dc\u9375\u5b57"})});
</script>
<script type="text/javascript" src="js/jquery.hint.js"></script>
<style type="text/css">
input.blur {
	color: #999;
}
</style>
<script type="text/javascript">
	$(function(){$("input[title!='']").hint();}); // data-original-title="?"
</script>
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
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
<?php $SiteImgUrl = "../site/"; ?>
<?php 
// 設定讀取版型
$tplname = $row_RecordTmp['name']; 
?>
<?php 
if(isset($tplname) && ($tplname == "board001" || $tplname == "board002" || $tplname == "board003" || $tplname == "board007"|| $tplname == "board009" || $tplname == "board010")) {
	$wrp_full = 0;
}else if(isset($tplname) && ($tplname == "board004" || $tplname == "board005" || $tplname == "board006" || $tplname == "board008")){
	$wrp_full = 1;
}
if(isset($tplname) && ($tplname == "board007" || $tplname == "board008")) {
	$wrp_column_plus = 1;
}
?>
<?php $TplCssPath = 'theme/' . "mobile_smarty" . '/css'; // 樣板路徑 ?>
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/layout.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/header-1.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/layout-font-rewrite.css" rel="stylesheet" type="text/css" />
<link href="../assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link href="../assets/css/layout-shop.css" rel="stylesheet" type="text/css" />
<?php require_once("../inc/inc_css_setting.mobile.smarty.min.php"); // 自訂樣式 ?>
<?php $TplPath = "../" . $TplPath; ?>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css">
</link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
<style type="text/css">
.InnerPage{float:right;margin-right:2px;margin-top:5px;margin-bottom:5px}.InnerPage_Type a{color:#FF7171;font-weight:700}.InnerPage_Type a:hover{color:red;font-weight:700}.InnerPage a{font-weight:700;border:1px solid #337fed;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:1px 1px 0 #1570cd;-webkit-box-shadow:inset 1px 1px 0 0 #97c4fe;-moz-box-shadow:inset 1px 1px 0 0 #97c4fe;box-shadow:inset 1px 1px 0 0 #97c4fe;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#3d94f6;padding:4px 8px;text-decoration:none}.InnerPage a:hover,.InnerPage a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0',endColorstr='#3d94f6');background:0 color-stop(100%,#3d94f6));background-color:#1e62d0}.InnerPage a:active{position:relative;top:1px}.InnerPage_design{float:right;margin-right:2px;margin-top:0}.InnerPage_design a{font-weight:700;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #d83526;text-decoration:none;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fa665a',endColorstr='#d34639');background:0 color-stop(100%,#d34639));background-color:#fa665a;color:#fff;display:inline-block;text-shadow:1px 1px 0 #98231a;-webkit-box-shadow:inset 1px 1px 0 0 #fab3ad;-moz-box-shadow:inset 1px 1px 0 0 #fab3ad;box-shadow:inset 1px 1px 0 0 #fab3ad;padding:4px 4px}.InnerPage_design a:hover,.InnerPage_design a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d34639',endColorstr='#fa665a');background:0 color-stop(100%,#fa665a));background-color:#d34639}.InnerPage_design a:active{position:relative;top:1px}#Bk_Anime_Wrapper,#Bk_Home_Anime_Wrapper,#Bk_Home_Bottom_Wrapper,#Bk_Home_Body_Wrapper{position:relative;top:0}
#wrp_body { background-image:url(<?php echo $SiteImgUrl; ?><?php echo $TmpBodyWebName; ?>/image/tmpbackground/<?php echo $TmpBodyBgImage;
?>);background-attachment:<?php echo $TmpBodyBgAttachment;?>;background-repeat:<?php echo $TmpBodyBgRepeat;?>;
background-position:<?php echo $TmpBodyBgPosition;?>;background-color:<?php echo $TmpBodyBgColor;?>;font-size:<?php echo $TmpWordSize;?>;
color:<?php echo $TmpWordColor;?>}#logo a, #logo a:hover {color:<?php echo $TmpLogoLogoColor;?>;font-size:<?php echo $TmpLogoLogoFontSize;?>;text-decoration: none;}
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
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<body style="background-image:none; background-color:#FFF; font-size:small; color:#000;" class="bg-style-color <?php if($tplrwdboxed == '1') {echo "boxed";}?> clearfix">
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
<?php if($row_RecordTmp['userid'] == $w_userid) { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="400" valign="top" style="background-color:#FFF;"><div style="width:400px; position:fixed; background-color:#033; z-index:1000">
        <div style="background-color:#8a807c; color:#FFF; text-align:center; padding:5px;">
          <form name="form" id="form">
            <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('self',this,0)">
              <option value="#" style="color:#FFF; background-color:#996E5C;">----- 選擇操作區塊 -----</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 外框架 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=owrp_1&amp;type=拼貼材質">背景底圖(最下圖層)</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=owrp_2&amp;type=裝飾拼貼圖片">背景底圖(中間圖層)</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=owrp_3&amp;type=裝飾拼貼圖片">背景底圖(最上圖層)</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 主框架 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_board">外框樣式</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_bg&amp;type=拼貼材質">背景底圖</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_other">網站預設文字及連結顏色</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 頁首區塊 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=header&amp;type=拼貼材質">背景底圖和細部設定</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《LOGO》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=logo">LOGO</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《主選單》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=mainmenu">外觀和位置調整</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 橫幅 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_b_board">外框樣式</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=banner_other">模式選擇</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 欄位區塊 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=column_l_bg&amp;type=拼貼材質">背景底圖</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《選單風格》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=column_block">側邊裝飾外框</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《側邊選單樣式》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=lmenu">側邊選單外觀</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 中央區塊 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_m_other&amp;type=拼貼材質">背景底圖和細部設定</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《導覽列區塊》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_v_board">外框樣式</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《標題區塊》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_t_board">外框樣式</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_t_line&amp;type=拼貼材質">背景底圖</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_t_icon&amp;type=標題圖示">小圖示</option>
              <option value="#" style="color:#FFF; background-color:#C30;">--- 《內文區塊》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=wrp_m_board">外框樣式</option>
              <option value="#" style="color:#FFF; background-color:#404040;">--- 《++ 頁尾區塊 ++》 ---</option>
              <option value="tmp_config_<?php echo $row_RecordTmp['name']; ?>_show.php?lang=<?php echo $_SESSION['lang'] ?>&amp;tmpid=<?php echo $_GET['tmpid']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>&amp;tmpmenu=footer&amp;type=拼貼材質">背景底圖和細部設定</option>
            </select>
            <div class="InnerPage_design"><a href="tmp_config_<?php echo $row_RecordTmp['name']; ?>.php?id_edit=<?php echo $_GET['id_edit'] ?>&amp;tmpid=<?php echo $_GET['id_edit'] ?>"><i class="fa fa-chevron-circle-right"></i> 切換至基本模式</a></div>
          </form>
        </div>
        <?php
			switch($_GET['tmpmenu'])
			{
				case "owrp_1":
				    require("tmpbodybackground_home_show.php"); 
					break;
				case "owrp_2":
				    require("tmpanimebackground_decorative_home_show.php"); 
					break;
				case "owrp_3":
				    require("tmpbottombackground_home_show.php"); 
					break;
				case "wrp_board":
				    require("tmpwrpboard_home_show.php");
					break;
				case "wrp_bg":
				    require("tmpwrpbackground_home_show.php"); 
					break;
				case "wrp_other":
				    require("tmp_config_wrp_show.php"); 
					break;
				case "header":
				    require("tmpheaderbackground_home_show.php"); 
					require("tmp_config_wrp_header_show.php");
					break;
				case "header_other":
				    require("tmp_config_wrp_header_show.php"); 
					break;
				case "logo":
				    require("tmplogo_home_show.php"); 
					require("tmp_config_wrp_header_logo_show.php"); 
					break;	
				case "mainmenu":
					require("tmpmainmenu_home_show_rwd.php"); 
                    require("tmp_config_wrp_header_menu_show.php");	
					break;
				case "wrp_b_board":
				    require("tmpbannerboard_home_show.php"); 
					break;	
				case "banner_other":
				    require("tmp_config_wrp_banner_show.php"); 
					break;	
				case "column_block":
				    require("tmpblock_home_show.php");	
					require("tmp_config_wrp_l_column_block_show.php");	
					break;	
				case "lmenu":
				    require("tmpleftmenu_home_show.php");	
					break;
				case "column_l_bg":
				    require("tmpleftbackground_home_show.php"); 
					require("tmp_config_wrp_l_column_height_show.php");	
					break;
				case "wrp_v_board":
				    require("tmpviewlineboard_home_show.php");
					break;
				case "wrp_t_board":
				    require("tmptitleboard_home_show.php");
					break;
				case "wrp_t_line":
				    require("tmptitlelinebackground_home_show.php");
					require("tmp_config_wrp_middle_title_show.php");
					break;
				case "wrp_t_icon":
				    require("tmptitleiconbackground_home_show.php");
					require("tmp_config_wrp_middle_title_show.php");
					break;
				case "wrp_t_other":
					require("tmp_config_wrp_middle_title_show.php");
					break;	
				case "wrp_m_board":
				    require("tmpmiddleboard_home_show.php");
					break;
				case "wrp_m_other":
				    require("tmpmiddlebackground_home_show.php"); 
					require("tmp_config_wrp_m_column_show.php");
					break;	
				case "footer":
				    require("tmpfooterbackground_home_show.php"); 
					require("tmp_config_wrp_footer_show.php");	
					break;				
				default:
					require("tmpmainmenu_home_show.php"); 
                    require("tmp_config_wrp_header_menu_show.php");	
					break;
			}
		?>
      </div></td>
    <td valign="top">
    
	<div id="Bk_Anime_Wrapper">
<div id="Bk_Bottom_Wrapper">
<!-- wrapper -->
<div id="wrapper"> 
  <!-- Top Bar -->
  <div id="topBar">
    <div class="container">      
      <!-- right -->
	  <?php //require("inc/inc_frontlangselect_mobile.php"); ?>
      <!-- left -->
      <ul class="top-links list-inline pull-left" >
        <?php if ($SiteFBShowImage != '') { ?>
        <!--<li class="hidden-xs"><a tabindex="-1" href="#"><img src="<?php //echo $SiteImgUrl; ?><?php //echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>" style="height:20px;"/></a></li>-->
        <?php } else { ?>
        <!--<li><a tabindex="-1" href="#"><img src="<?php //echo $SiteBaseUrl ?>images/no_face.jpg" style="height:20px;"/></a></li>-->
        <?php } ?>
        <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $WshopTopName; ?></a></li>
      </ul>
    </div>
  </div>
  <!-- /Top Bar -->
  <div id="header" class="clearfix header-auto"> 
    <!-- TOP NAV -->
    <header id="topNav">
      <div class="container"> 
        <!-- Mobile Menu Button -->
        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse"><i class="fa fa-bars" style="text-shadow:1px 1px 0px #FFFFFF"></i> </button>
        <!-- Logo -->
        <div id="logo">
          <?php //require($TplPath . "/mobilelogo.php"); ?>
        </div>
        <div style="clear:both"></div>
        <?php  // submenu-dark = dark sub menu ?>
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0' && $TmpMainmenuIndicate == 1) { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
        <div class="navbar-collapse nav-main-collapse collapse">
          <nav class="nav-main">
            <div id="apDiv_outmenu" data-scroll-reveal='enter right after 0.3s'>
              <div id="apDiv_dftmenu">
                <ul id="topMain" class="nav nav-pills nav-main">
                  <?php //require("../mainmenu_dftype_mobile.php"); ?>
                </ul>
              </div>
            </div>
          </nav>
        </div>
        <?php } ?>
      </div>
    </header>
    <!-- /Top Nav --> 
    
  </div>
  <!-- /PAGE HEADER -->
  <?php if ($TmpMainMenuLocation == '1' && $wrp_full == "0" && $TmpMainmenuIndicate == 1) { // 當自定選單採用100%寬度時採用?>
  <div <?php if ($TmpMainMenuOImg != "") { ?>style="background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuOImg; ?>); background-repeat: repeat-x;"<?php } ?>>
  <div class="container">
  <div id="topNav">
    <div id="apDiv_outmenu">
      <div class="navbar-collapse nav-main-collapse collapse" style="width:100%">
        <nav class="nav-main">
          <ul id="topMain" class="nav nav-pills nav-main list-group">
            <?php //require("mainmenu_dftype_mobile.php"); ?>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  </div>
  </div>
  <?php } ?>
  
  <!-- SLIDER -->
  <?php 
		if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $TmpHomeBannerSelect == '1') { // 當目前版面為首頁時讀取首頁橫幅
				include("require_banner_homeimage_mobile.php"); // 共通
		}else {
		// 當版型修改的功能被關閉時 統一使用共通樣版
		if ($OptionTmpSelect == '0' && $TmpBanner != '0') {$TmpBanner = '1'; }
		//{
			switch($TmpBanner)
			{
				case "0":
					// 不使用
					//include("require_banner_slick.php"); // 共通
				break;
				case "1":
					include("../require_banner.php"); // 共通
				break;
				case "2":
					include("../require_tmpbanner.php"); // 獨立
				break;
				case "3":
				    if($TmpBannerChooseSelect == '1')
					{
						include("../require_selectbanner.php"); // 單圖選擇
					}else{
						require($TplPath . "/bannerpic.php"); // 單圖
					}
					
				break;
				case "4":
					include("../require_tmpbannermuli.php"); // 獨立
				break;
				default:
				break;
			}
		}
		//}
  ?>
  <!-- /SLIDER -->
  
  <?php 
                /*PAGE HEADER 
                
                CLASSES:
                    .page-header-xs	= 20px margins
                    .page-header-md	= 50px margins
                    .page-header-lg	= 80px margins
                                .page-header-xlg= 130px margins
                    .dark		= dark page header
                    .light		= light page header*/
            ?>
  <?php if ($TmpWrpViewLineLocate == '2') { ?>
  <!--導覽列外框-->
  <div style="position:relative;">
    <div class="mdviewline ViewlineBoardStyle">
      <div class="mdviewline_t">
        <div class="mdviewline_t_l"> </div>
        <div class="mdviewline_t_r"> </div>
        <div class="mdviewline_t_c"><!--標題--></div>
        <div class="mdviewline_t_m"><!--更多--></div>
      </div>
      <!--mdviewline_t-->
      <div class="mdviewline_c g_p_hide">
        <div class="mdviewline_c_l g_p_fill"> </div>
        <div class="mdviewline_c_r g_p_fill"> </div>
        <div class="mdviewline_c_c"> 
          <!-- <div class="mdviewline_m_t"></div>
                                <div class="mdviewline_m_c">  --> 
          <!--導覽列外框-->
          <section class="page-header page-header-xxs">
            <div class="container">
              <h1><!-- name="標題文字" --><!--  --></h1>
              <!-- name="導覽列" --> <!--  --> </div>
          </section>
          <!--導覽列外框--> 
          <!--</div>
                                              <div class="mdviewline_m_b"></div>--> 
        </div>
      </div>
      <!--mdviewline_c-->
      <div class="mdviewline_b">
        <div class="mdviewline_b_l"> </div>
        <div class="mdviewline_b_r"> </div>
        <div class="mdviewline_b_c"> </div>
      </div>
      <!--mdviewline_b--> 
    </div>
    <!--mdviewline--> 
  </div>
  <!-- 導覽列外框-->
  <?php } ?>
  <section>
    <div class="container">
      <div class="row">
        <?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
		<?php //require_once("require_publish_marquee_sty01.php");?>
        <?php  } ?>
        <?php if($tplname_original == "board010") { ?>
        <?php } else { ?>
        <div class="col-md-3 col-sm-4">
          <div id="l_column">
            <?php 
			if ($_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home'){
				//require_once("require_leftmenu_home_column_mobile.php");
			} else {
				//require_once("require_leftmenu_column_mobile.php");
			}
			?>
          </div>
        </div>
        <?php } ?>
        <div class="<?php if($tplname_original == "board010") { ?>col-md-12 col-sm-12<?php } else { ?>col-md-9 col-sm-8<?php } ?>"> <!-- name="主內容" --> <!--  --> </div>
      </div>
    </div>
  </section>
  <!-- / --> 
  
  
  
  <!-- FOOTER -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12 nomargin">
          <?php //require('require_tmpfooter_mobile.php'); ?>
        </div>
      </div>
    </div>
  </footer>
  <!-- /FOOTER --> 
  
  <?php if ($OptionCartSelect == '1') { ?>
  <?php //require_once("require_footer_menu_mobile.php"); ?>
  <?php } ?>
  
</div>
</div>
</div>
    
      </td>
  </tr>
</table>
<?php } ?>
<script type="text/javascript">
$(document).ready(function(){$(".color-picker").miniColors({letterCase:"uppercase"});$("#randomize").click(function(){$(".color-picker").each(function(){$(this).miniColors("value","#"+Math.floor(16777215*Math.random()).toString(16))})})});
</script> 
<script type="text/javascript">
	$('.PageRefresh').click(function() {
    	      location.reload();
	});
</script> 
<script type="text/javascript">
jQuery(document).ready(function() {
    var _leftheight = jQuery("#wrapper #Left_column #context").height();
        _rightheight = jQuery("#wrapper #Content_containter #Main_content").height();
        if(_leftheight > _rightheight ) {
            jQuery("#wrapper #Content_containter #Main_content").height(_leftheight);
        }
        else {
            jQuery("#wrapper #Left_column #context").height(_rightheight);
        }
    }); 
</script> 
<script type="text/javascript"> 
$(document).ready(function(){
    $(".Acc_Content:not('.Acc_Content:first')").hide();
	$(".Acc_Change:not('.Acc_Change:first')").html("<i class=\"fa fa-minus-square\"></i>");

    $('.Acc_Title').click(function(){
	if( $(this).next().is(':hidden') ) {
            $('.Acc_Title').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
			$(".Acc_Title").click(function(){
				$(".Acc_Change").html("<i class=\"fa fa-minus-square\"></i>");
			});
	}else{
            $(this).toggleClass('active');
            $(this).next().slideUp();
			$(".Acc_Title").click(function(){
				$(".Acc_Change").html("<i class=\"fa fa-plus-square\"></i>");
			});
        }
	return false;
    });
	
});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>