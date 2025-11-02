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
<?php $TplCssPath = 'theme/' . "pc_board" . '/css'; // 樣板路徑 ?>
<?php require_once("../inc/inc_css_setting.min.php"); // 自訂樣式 ?>
<?php
	echo "<link href=\"../". $TplCssPath ."/incstyle_".$tplname.".css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"../". $TplCssPath ."/styleless.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"../". $TplCssPath . "/vertical-mega-menu/vertical_menu_basic.css\" rel=\"stylesheet\" type=\"text/css\" />";
?>
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
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.min.css" />
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
<body style="background-image:none; background-color:#FFF; font-size:small; color:#000;">
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
					require("tmpmainmenu_home_show.php"); 
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
    <td valign="top"><div id="Top_Content"></div>
      <div id="wrp_body">
        <div id="Bk_Anime_Wrapper">
          <div id="Bk_Anime_Destroy"></div>
          <div id="Bk_Bottom_Wrapper">
            <?php if ($wrp_full == "1") { ?>
            <div id="header_full" >
              <div id="context">
                <div id="wrapper">
                 
    <?php // ********************************************************** ?>
    <link rel="stylesheet" href="../css/css3menu.css" type="text/css" />
	<style type="text/css">
	#apDiv_outmenu {height: <?php echo $TmpMainMenuHeight; ?>px; width: 100%; z-index: 10; right: 0px; <?php if ($TmpMainMenuLocation == '0') { // 當自定選單採用100%寬度時採用?>position: absolute; top: <?php echo $TmpDftMenu_Y; ?>px;<?php } ?> background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuOImg; ?>); background-repeat: repeat-x;}
	#apDiv_dftmenu {position: absolute;z-index: 10;margin-left: auto;margin-right: 0px;right: <?php echo $TmpDftMenu_X; ?>px;top: 0px;}
	#apDiv_picmenu {position: absolute;z-index: 10;left: <?php echo $TmpPicMenu_X; ?>px;top: <?php echo $TmpPicMenu_Y; ?>px;float: right;}
	</style>
	<?php // ************************** LOGO ************************** ?>
		<div id="logo" style="position: absolute; z-index: 11;">
        <?php if ($TmpLogoLogoType == 0) { //類型 ?>
		<?php if ($TmpLogo != "" && GetFileExtend($TmpLogo) != '.swf') { ?>
			<a href="#"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoWebname; ?>/logo/<?php echo $TmpLogo; ?>" alt="<?php echo $SiteName; ?>"  width="<?php echo $TmpLogoWidth; ?>" height="<?php echo $TmpLogoHeight; ?>"/></a>
		<?php } else if (GetFileExtend($TmpLogo) == '.swf'){ ?>
		  <embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop'] ?>/logo/<?php echo $TmpLogo; ?>" width="<?php echo $TmpLogoWidth; ?>" height="<?php echo $TmpLogoHeight; ?>" play="true" loop="true" quality="high" pluginspage="index.php?wshop=<?php echo $_GET['wshop'] ?>" wmode="transparent"> </embed>
		<?php } else { ?>
		  <a href="#"><img src="../images/logo_default_tmp.png" width="149" height="50" /></a>
		<?php }  ?>
        <?php } else { // 類型 ?>
    <span><a><?php echo $TmpLogoLogoName; ?></a></span>
    <?php }  // 類型 ?>
		</div>
	<?php // ************************** LOGO ********************************* ?>
	<div style="text-align:right;"><?php //require_once("require_epaper_send.php"); ?></div>
	<?php if ($TmpMainmenuIndicate == 1) { // 如果主選單設定為顯示  ?>
        <div id="ajax_mainmenu_location0">
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
        <div id="apDiv_outmenu"><div id="apDiv_dftmenu">
        <ul id="navcss3"><?php if ($TmpMainMenuLImg != '') { ?><span class="topmainmenu_l"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuLImg; ?>"/></span><?php } ?><?php require("mainmenu_dftype.php"); ?><?php if ($TmpMainMenuRImg != '') { ?><span class="topmainmenu_r"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuRImg; ?>"/></span><?php } ?></ul>
    </div></div>
        <?php } ?>
        </div>
        <?php //} ?>
        <?php //if ($MSLMenu != 1) { //  ?>
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '2') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現)?>
        <div id="apDiv_picmenu"><?php require_once($TplPath . "/mainmenu_pic.php"); ?></div>
        <?php } ?>
	<?php } ?>
    <?php if ($TmpMainmenuIndicate == 0) { // 如果主選單設定為不顯示  ?>
    	        <div id="ajax_mainmenu_location0" style="display:none;">
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
        
        <div id="apDiv_outmenu"><div id="apDiv_dftmenu">
        <ul id="navcss3"><?php if ($TmpMainMenuLImg != '') { ?><span class="topmainmenu_l"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuLImg; ?>"/></span><?php } ?><?php require("mainmenu_dftype.php"); ?><?php if ($TmpMainMenuRImg != '') { ?><span class="topmainmenu_r"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuRImg; ?>"/></span><?php } ?></ul>
    </div></div>
        <?php } ?>
        </div>
        <?php //} ?>
        <?php //if ($MSLMenu != 1) { //  ?>
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '2') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現)?>
        <div id="apDiv_picmenu"><?php require_once($TplPath . "/mainmenu_pic.php"); ?></div>
        <?php } ?>
    <?php }  ?>
    <?php // ********************************************************** ?>
    
                </div>
              </div>
            </div>
            <?php if ($TmpMainMenuLocation == '1') { // 當自定選單採用100%寬度時採用?>
            <div id="mainmenu" style="position:relative;">
            <div id="ajax_mainmenu_location1">
            <div id="apDiv_outmenu">
              <div style="position:relative; width:<?php echo ($TmpWebWidth+$Tmp_Wrp_R_M_Width+$Tmp_Wrp_L_M_Width) .  $TmpWebWidthUnit; ?>; margin-left:auto; margin-right:auto;">
                <div id="apDiv_dftmenu">
    <ul id="navcss3"><?php if ($TmpMainMenuLImg != '') { ?><span class="topmainmenu_l"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuLImg; ?>"/></span><?php } ?><?php require("mainmenu_dftype.php"); ?><?php if ($TmpMainMenuRImg != '') { ?><span class="topmainmenu_r"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuRImg; ?>"/></span><?php } ?></ul>
</div>
              </div>
            </div>
            </div>
            </div>
            <?php } ?>
            <?php } ?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" id="Main_Wrapper" none="true">
              <tr>
                <td id="Left_Background">&nbsp;</td>
                <td id="Middle_Wrapper"><div style="position:relative;"><!--For FireFox-->
                    <div id="abgne_float_right_menu" style="display:none"> <img src="images/floatmenu_tb.png" width="50" height="20">
                      <div id="abgne_float_right_top"> <img src="images/floatmenu_top_A.png" width="50" height="35"> </div>
                      <div id="abgne_float_right_context"> <a href="index.php"><img src="images/floatmenu_home_A.png" width="50" height="35"></a>
                        <?php if ($OptionCartSelect == '1') { ?>
                        <a href="cart.php?Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/floatmenu_cart_A.png" width="50" height="35"></a>
                        <?php } ?>
                        <a href="javascript:history.go(-1); "><img src="images/floatmenu_back_A.png" width="50" height="35"></a> </div>
                      <div id="abgne_float_right_bottom"> <img src="images/floatmenu_down_A.png" width="50" height="35"> </div>
                      <img src="images/floatmenu_db.png" width="50" height="20"> </div>
                  </div>
                  <div class="mdl WrpBoardStyle">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="mdl_t_l"></td>
                        <td class="mdl_t_c"></td>
                        <td class="mdl_t_r"></td>
                      </tr>
                      <tr>
                        <td class="mdl_c_l"></td>
                        <td class="mdl_c_c"><div id="wrapper"> 
                            <!--<div id="abgne_float_lang_menu"> 
    	<?php //require("inc/inc_frontlangselect.php"); ?>
    </div>--> 
                            <!--<div id="abgne_float_left_menu">
    	<div id="abgne_float_left_top">
        	<img src="../images/floatmenu_top.png" width="50" height="50" />
        </div>
        <div id="abgne_float_left_context">
        	<a href="index.php"><img src="../images/floatmenu_home.png" width="50" height="50" /></a>
            <a href="javascript:history.go(-1); "><img src="../images/floatmenu_back.png" width="50" height="50" /></a>
        </div>
        <div id="abgne_float_left_bottom">
        	<img src="../images/floatmenu_down.png" width="50" height="50" />
        </div>
    </div>-->
                            <?php if ($wrp_full == "0") { ?>
                            <div id="header" _height="none">
    <div id="context">
    <?php // ********************************************************** ?>
    <link rel="stylesheet" href="../css/css3menu.css" type="text/css" />
	<style type="text/css">
	#apDiv_outmenu {height: <?php echo $TmpMainMenuHeight; ?>px; width: 100%; z-index: 10; right: 0px; <?php if ($TmpMainMenuLocation == '0') { // 當自定選單採用100%寬度時採用?>position: absolute; top: <?php echo $TmpDftMenu_Y; ?>px;<?php } ?> background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuOImg; ?>); background-repeat: repeat-x;}
	#apDiv_dftmenu {position: absolute;z-index: 10;margin-left: auto;margin-right: 0px;right: <?php echo $TmpDftMenu_X; ?>px;top: 0px;}
	#apDiv_picmenu {position: absolute;z-index: 10;left: <?php echo $TmpPicMenu_X; ?>px;top: <?php echo $TmpPicMenu_Y; ?>px;float: right;}
	</style>
	<?php // ************************** LOGO ************************** ?>
		<div id="logo" style="position: absolute; z-index: 11;">
        <?php if ($TmpLogoLogoType == 0) { //類型 ?>
		<?php if ($TmpLogo != "" && GetFileExtend($TmpLogo) != '.swf') { ?>
			<a href="#"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoWebname; ?>/logo/<?php echo $TmpLogo; ?>" alt="<?php echo $SiteName; ?>"  width="<?php echo $TmpLogoWidth; ?>" height="<?php echo $TmpLogoHeight; ?>"/></a>
		<?php } else if (GetFileExtend($TmpLogo) == '.swf'){ ?>
		  <embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop'] ?>/logo/<?php echo $TmpLogo; ?>" width="<?php echo $TmpLogoWidth; ?>" height="<?php echo $TmpLogoHeight; ?>" play="true" loop="true" quality="high" pluginspage="index.php?wshop=<?php echo $_GET['wshop'] ?>" wmode="transparent"> </embed>
		<?php } else { ?>
		  <a href="#"><img src="../images/logo_default_tmp.png" width="149" height="50" /></a>
		<?php }  ?>
        <?php } else { // 類型 ?>
    <span><a><?php echo $TmpLogoLogoName; ?></a></span>
    <?php }  // 類型 ?>
		</div>
	<?php // ************************** LOGO ********************************* ?>
	<div style="text-align:right;"><?php //require_once("require_epaper_send.php"); ?></div>
	<?php if ($TmpMainmenuIndicate == 1) { // 如果主選單設定為顯示  ?>
        <div id="ajax_mainmenu_location0">
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
        <div id="apDiv_outmenu"><div id="apDiv_dftmenu">
        <ul id="navcss3"><?php if ($TmpMainMenuLImg != '') { ?><span class="topmainmenu_l"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuLImg; ?>"/></span><?php } ?><?php require("mainmenu_dftype.php"); ?><?php if ($TmpMainMenuRImg != '') { ?><span class="topmainmenu_r"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuRImg; ?>"/></span><?php } ?></ul>
    </div></div>
        <?php } ?>
        </div>
        <?php //} ?>
        <?php //if ($MSLMenu != 1) { //  ?>
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '2') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現)?>
        <div id="apDiv_picmenu"><?php require_once($TplPath . "/mainmenu_pic.php"); ?></div>
        <?php } ?>
	<?php } ?>
    <?php if ($TmpMainmenuIndicate == 0) { // 如果主選單設定為不顯示  ?>
    	        <div id="ajax_mainmenu_location0" style="display:none;">
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
        
        <div id="apDiv_outmenu"><div id="apDiv_dftmenu">
        <ul id="navcss3"><?php if ($TmpMainMenuLImg != '') { ?><span class="topmainmenu_l"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuLImg; ?>"/></span><?php } ?><?php require("mainmenu_dftype.php"); ?><?php if ($TmpMainMenuRImg != '') { ?><span class="topmainmenu_r"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuRImg; ?>"/></span><?php } ?></ul>
    </div></div>
        <?php } ?>
        </div>
        <?php //} ?>
        <?php //if ($MSLMenu != 1) { //  ?>
        <?php if ($MSMenu == '1' && $TmpMenuSelect == '2') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現)?>
        <div id="apDiv_picmenu"><?php require_once($TplPath . "/mainmenu_pic.php"); ?></div>
        <?php } ?>
    <?php }  ?>
    <?php // ********************************************************** ?>
    </div>
  </div>
                            <?php } ?>
                            <div id="mainmenu" style="position:relative;">
                              <div id="ajax_mainmenu_location1">
                                <?php if ($TmpMainMenuLocation == '1' && $wrp_full == "0") { // 當自定選單採用100%寬度時採用?>
                                <div id="apDiv_outmenu"><div id="apDiv_dftmenu">
                                <ul id="navcss3"><?php if ($TmpMainMenuLImg != '') { ?><span class="topmainmenu_l"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuLImg; ?>"/></span><?php } ?><?php require("mainmenu_dftype.php"); ?><?php if ($TmpMainMenuRImg != '') { ?><span class="topmainmenu_r"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuRImg; ?>"/></span><?php } ?></ul>
                            </div></div>
                                <?php } ?>
                              </div>
                              </div>
                            <!--  Banner  -->
                            <div id="banner" _height="none">
                              <div class="mdbanner BannerBoardStyle">
                                <div class="mdbanner_t">
                                  <div class="mdbanner_t_l"> </div>
                                  <div class="mdbanner_t_r"> </div>
                                  <div class="mdbanner_t_c"><!--標題--></div>
                                  <div class="mdbanner_t_m"><!--更多--></div>
                                </div>
                                <!--mdbanner_t-->
                                <div class="mdbanner_c g_p_hide">
                                  <div class="mdbanner_c_l g_p_fill"> </div>
                                  <div class="mdbanner_c_r g_p_fill"> </div>
                                  <div class="mdbanner_c_c"> 
                                    <!-- <div class="mdbanner_m_t"></div>
					<div class="mdbanner_m_c">  -->
                                    <div id="context">
                                    <?php $_GET['wshop'] = $row_RecordTmp['webname']; ?>
                                      <?php 
		if(($Tp_Page == 'Main' || $Tp_Page == 'Home') && $TmpHomeBannerSelect == '1') { // 當目前版面為首頁時讀取首頁橫幅
				//include("require_banner_homeimage.php"); // 共通
		}else {
		// 當版型修改的功能被關閉時 統一使用共通樣版
		if ($OptionTmpSelect == '0' && $TmpBanner != '0') {$TmpBanner = '1'; }
		//{
			switch($TmpBanner)
			{
				case "0":
					// 不使用
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
                                    </div>
                                    <!--</div>
					<div class="mdbanner_m_b"></div>--> 
                                  </div>
                                </div>
                                <!--mdbanner_c-->
                                <div class="mdbanner_b">
                                  <div class="mdbanner_b_l"> </div>
                                  <div class="mdbanner_b_r"> </div>
                                  <div class="mdbanner_b_c"> </div>
                                </div>
                                <!--mdbanner_b--> 
                              </div>
                              <!--mdbanner--> 
                            </div>
                            <!--  Banner  END -->
                            <div id="mqo" _height="none">
                              <?php if($TmpPublishIndicate == '1' && $OptionPublishSelect == '1'){ ?>
                              <?php //require_once("require_publish_marquee_sty01.php");?>
                              <?php  } ?>
                            </div>
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
                                    <div class="xbreadcrumbs" style="padding:5px 0px;"> <a href="#" class="home">首頁 » 示範頁面</a></div>
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
                            <div id="Left_column" >
                              <div id="context">
                                <?php // ********************************************************** ?>
                                <script type="text/javascript" src='../js/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script> 
                                <script type="text/javascript">
        $(document).ready(function($){
            $('#mega-tp').dcVerticalMegaMenu({
                rowItems: '3',
                speed: 'fast',
                effect: 'slide',
                direction: 'right'
            });
        });
        </script>
                                <div class="BlockWrp">
                                  <div class="BlockTitle">
  <?php if ($TmpShowBlockName == '1') { ?><div class="BlockTitleWord">標題</div><?php } ?><?php if ($TmpBlockTitlePic != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockTitlePic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?></div>
                                  <div class="BlockContent">
                                    <div id="ajax_leftmenu_location">
                                      <?php 
		              if($TmpLeftMenuTitlePic != "") {
					  echo"<img src=\"".$SiteImgUrl. $TmpLeftMenuWebName. "/image/tmpleftmenu/" . $TmpLeftMenuTitlePic . "\"/>  "."";}
					  echo "<div class=\"dcjq-vertical-mega-menu\">\n"; 
					  echo "        <ul id=\"mega-tp\" class=\"menu\">\n";
?>
                                      <li><a>關於我們</a></li>
                                      <li><a>經營理念</a></li>
                                      <li><a>歷史事紀</a></li>
                                      <?php
					  echo "        </ul>\n"; 
                      echo "</div>\n";
					  if($TmpLeftMenuBottomPic != "") {
					  echo"<img src=\"".$SiteImgUrl. $TmpLeftMenuWebName. "/image/tmpleftmenu/" . $TmpLeftMenuBottomPic . "\"/>  ".""; 		}	
?>
                                    </div>
                                  </div>
                                  <div class="Block_Bottom">
                                    <?php if ($TmpBlockBottomPic != '' && $row_RecordLeftMenuColumn['indicatemiddle'] == '1') { ?>
                                    <img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockBottomPic; ?>" style="display:block; margin:auto; width:100%"/>
                                    <?php } ?>
                                  </div>
                                </div>
                                <?php /* *********************************************************** */?>
                                <div class="BlockWrp">
                                  <div class="BlockTitle">
  <?php if ($TmpShowBlockName == '1') { ?><div class="BlockTitleWord">標題</div><?php } ?><?php if ($TmpBlockTitlePic != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockTitlePic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?></div>
                                  <div class="BlockContent"> 可放置文字、圖片、Flash<br />
                                    等各種不同語法 </div>
                                  <div class="Block_Bottom">
                                    <?php if ($TmpBlockBottomPic != '' && $row_RecordLeftMenuColumn['indicatemiddle'] == '1') { ?>
                                    <img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockBottomPic; ?>" style="display:block; margin:auto; width:100%"/>
                                    <?php } ?>
                                  </div>
                                </div>
                                <?php // ********************************************************** ?>
                                <div class="BlockWrp">
                                  <div class="BlockTitle">
  <?php if ($TmpShowBlockName == '1') { ?><div class="BlockTitleWord">標題</div><?php } ?><?php if ($TmpBlockTitlePic != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockTitlePic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?></div>
                                  <div class="BlockContent"> <img src="images/linkphoto/yahoo_shop_link_photo.jpg" width="198" height="60" />
                                    <div style="height:5px;"></div>
                                    <img src="images/linkphoto/facebook_link_photo.jpg" width="198" height="60" />
                                    <div style="height:5px;"></div>
                                    <img src="images/linkphoto/youtube_link_photo.jpg" width="198" height="60" /> </div>
                                  <div class="Block_Bottom">
                                    <?php if ($TmpBlockBottomPic != '' && $row_RecordLeftMenuColumn['indicatemiddle'] == '1') { ?>
                                    <img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockBottomPic; ?>" style="display:block; margin:auto; width:100%"/>
                                    <?php } ?>
                                  </div>
                                </div>
                                <?php // ********************************************************** ?>
                              </div>
                            </div>
                            <div id="shangxia">
                              <div id="shang"></div>
                              <div id="comt"></div>
                              <div id="xia"></div>
                            </div>
                            <div id="Content_containter" _height="auto">
                            
                              <div id="Main_content">
      <div id="context" >
      	<!--  name="主內容" -->
        <div class="columns on-1">
                                    <div class="container">
                                      <div class="column">
                                        <div class="container">
                                          <?php if ($TmpWrpViewLineLocate == '1') { ?>
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
                                                  <div class="xbreadcrumbs" style="padding:5px 0px;"> <a href="#" class="home">首頁 » 示範頁面</a></div>
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
                                        </div>
                                      </div>
                                    </div>
                                  </div>
        <?php // ********************************************************** ?>
        <!--標題外框-->
        <div style="position:relative;">
        <div class="mdtitle TitleBoardStyle">
            <div class="mdtitle_t">
                    <div class="mdtitle_t_l"> </div>
                    <div class="mdtitle_t_r"> </div>
                    <div class="mdtitle_t_c"><!--標題--></div>
                    <div class="mdtitle_t_m"><!--更多--></div>
            </div><!--mdtitle_t-->
            <div class="mdtitle_c g_p_hide">
                    <div class="mdtitle_c_l g_p_fill"> </div>
                    <div class="mdtitle_c_r g_p_fill"> </div>
                    <div class="mdtitle_c_c">
                            <!-- <div class="mdtitle_m_t"></div>
                            <div class="mdtitle_m_c">  --> 
        <!--標題外框--> 
        <div class="columns on-1">
                <div class="container">
                    <div class="column">
                        <div class="container ct_board ct_title"><h3><span class="titlesicon"><?php if($TmpTitleBgImage != ''){ ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /><?php } ?></span>標題名稱</h3></div>
                    </div>
                </div>        
        </div>
        <!--標題外框-->
                        <!--</div>
                            <div class="mdtitle_m_b"></div>-->
                    </div>
            </div><!--mdtitle_c-->
            <div class="mdtitle_b">
                    <div class="mdtitle_b_l"> </div>
                    <div class="mdtitle_b_r"> </div>
                    <div class="mdtitle_b_c"> </div>
            </div><!--mdtitle_b-->
        </div><!--mdtitle-->
        </div>
        <!-- 標題外框-->
        <?php // ********************************************************** ?>
        <div style="position:relative;">
        <div class="mdmiddle MiddleBoardStyle">
            <div class="mdmiddle_t">
                    <div class="mdmiddle_t_l"> </div>
                    <div class="mdmiddle_t_r"> </div>
                    <div class="mdmiddle_t_c"><!--標題--></div>
                    <div class="mdmiddle_t_m"><!--更多--></div>
            </div><!--mdmiddle_t-->
            <div class="mdmiddle_c g_p_hide">
                    <div class="mdmiddle_c_l g_p_fill"> </div>
                    <div class="mdmiddle_c_r g_p_fill"> </div>
                    <div class="mdmiddle_c_c">
                      <div class="show_sample">
                        <p><br />
                        <div style="background:#DF8E0B; color:#FFFFFF; text-align:center; font-size:32px;">此處為預覽頁面，非真實網站資料</div>
                           <div style="margin-bottom:10px; margin-top:10px;">
		<a href="http://www.shop3500.com"><img src="http://www.shop3500.com/images/home/shop3500_l.png" alt="Shop3500" width="500" height="55" /></a></div>
	<div>
	    <h1>平台特點</h1>
      </div>
	<div>
      <p><br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  免費架站</strong><br />
        <br />
        網站架設內容管和更新一概免費，可無限次更新內容。<br />
        <br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  十分鐘就上線</strong><br />
        <br />
        只要10分鐘就可建立網站。我們提供最新穎、最有質感的圖案與設計，美化您的網站。<br />
        <br />
        <br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  簡單快速</strong></p>
      <p><br />
        依照我們的圖示操作，您就可以建立公司專屬的網站。<br />
        <br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  專屬網域</strong><br />
        <br />
        我們在Shop3500附增一個免費網址, 也可使用您原有的網域於您的網站中 (例如： www.域名.com) ，或可以透過 shop3500 註冊購買新的網域名稱去做指向。<br />
        <br />
        <br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  多變化的版型橫幅</strong></p>
      <p><br />
        Shop3500現有提供25組版型,此版型可無限廣充變化，美化您的網站。</p>
      <p><br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  提昇網站曝光率</strong><br />
        <br />
        shop3500採用搜尋引擎最佳化(SEO)和先進的相關技術。提昇您的網站曝光率。<br />
        <br />
        <br />
        <strong><strong><i class="fa fa-bookmark-o"></i> </strong>  多功能</strong><strong>模組</strong></p>
      <p><br />
        増添工程實蹟、影片模組、活動花絮、討論區等, 讓您的網站內容更豐富。<br />
      </p>
      <p><strong><strong><i class="fa fa-bookmark-o"></i> </strong>  設身處地為您著想</strong></p>
      <p><br />
        Shoop3500針對不同業務類別，建立各種專業的網站內容。為您美化網站內容, 也為您節省時間和金錢。<br />
      </p>
      <p><strong><strong><i class="fa fa-bookmark-o"></i> </strong>  推陳出新</strong></p>
      <p><br />
        Shop3500不斷推出週邊服務。例如:企業部落格、討論區及電子行銷等, 幫您吸引新客戶。<br />
    <br />
    <br />
	</p>
	</div>

                          <div style="background:#DF8E0B; color:#FFFFFF; text-align:center; font-size:32px;">此處為預覽頁面，非真實網站資料</div>
                      </div> 
                    </div>
            </div><!--mdmiddle_c-->
            <div class="mdmiddle_b">
                    <div class="mdmiddle_b_l"> </div>
                    <div class="mdmiddle_b_r"> </div>
                    <div class="mdmiddle_b_c"> </div>
            </div><!--mdmiddle_b-->
        </div><!--mdmiddle-->
        </div>
        <?php // ********************************************************** ?>
      	
      </div>
  	</div>
                              <div id="Right_column">
                                <div id="context">
                                  <?php 
		    if($wrp_column_plus == '1') {
				if($_GET['tp'] == 'Blog' || $Tp_Page == 'Blog'){
					//require_once("require_leftmenu_blog_column.php");
				}else if ($_GET['tp'] == 'Home' || $Tp_Page == 'Main' || $Tp_Page == 'Home'){
					//require_once("require_rightmenu_home_column.php");
				} else {
					//require_once("require_rightmenu_column.php");
				}
			}
		?>
                                </div>
                              </div>
                            </div>
                            <div style="clear:both"></div>
                            <?php if ($wrp_full == "0") { ?>
                            <div id="footer" _height="none"> 
                              <!--<div id="floatblock">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%" align="left" valign="bottom"><img src="../images/left_float_footer.png" width="200" height="100" /></td>
            <td width="50%" align="right"><img src="../images/right_float_footer.png" width="200" height="150" /></td>
            <td>&nbsp;</td>
            </tr>
        </table> 
	</div> 	-->
                              <div id="context">
                                <div style="font-size:small; vertical-align: middle; text-align:center; height:<?php echo $TmpFooterMinHeight; ?>px; width:<?php echo $TmpWebWidth .  $TmpWebWidthUnit; ?>">
                                  <div style="height:10px;"></div>
                                  <span style="color:#<?php echo $TmpFooterFontColor; ?>"><a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">關於我們</a> |  <a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">最新訊息</a> |  <a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">產品資訊</a>  |  <a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">聯絡我們</a></span>  <br />
                                  電話：○○-○○○○○○○○ 傳真：○○-○○○○○○○ Mail：<a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">○○○○○○</a> 行動：○○○○-○○○○○○<br />
                                  地址：○○○○○○○○○○○○○○○○○<br />
                                  Fullvision Copyright © 2009 - 2017 Design by <a href="http://www.fullrich.com.tw/" target="_blank"style="color:<?php echo $TmpFooterFontColor; ?>">Fullvision</a> </div>
                              </div>
                            </div>
                            <?php } ?>
                          </div></td>
                        <td class="mdl_c_r"></td>
                      </tr>
                      <tr>
                        <td class="mdl_b_l"></td>
                        <td class="mdl_b_c"></td>
                        <td class="mdl_b_r"></td>
                      </tr>
                    </table>
                  </div>
                  
                  <!--mdl--></td>
                <td  id="Right_Background">&nbsp;</td>
              </tr>
            </table>
          </div>
          <?php if ($wrp_full == "1") { ?>
          <div id="footer_full">
            <div id="context">
              <div style="font-size:small; vertical-align: middle; text-align:center; height:<?php echo $TmpFooterMinHeight; ?>px;">
                <div style="height:10px;"></div>
                <span style="color:#<?php echo $TmpFooterFontColor; ?>"><a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">關於我們</a> |  <a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">最新訊息</a> |  <a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">產品資訊</a>  |  <a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">聯絡我們</a></span>  <br />
                電話：○○-○○○○○○○○ 傳真：○○-○○○○○○○ Mail：<a href="#"style="color:<?php echo $TmpFooterFontColor; ?>">○○○○○○</a> 行動：○○○○-○○○○○○<br />
                地址：○○○○○○○○○○○○○○○○○<br />
                Fullvision Copyright © 2009 - 2017 Design by <a href="http://www.fullrich.com.tw/" target="_blank"style="color:<?php echo $TmpFooterFontColor; ?>">Fullvision</a> </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div></td>
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