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
<script src="../js/thiagosf-SkitterSlideshow/jquery.animate-colors-min.js"></script>
<script src="../js/thiagosf-SkitterSlideshow/jquery.skitter.min.js"></script>
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
input.blur {color: #999;}
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
<link href="theme/mobile001/css/incstyle.css" rel="stylesheet" type="text/css" /><link href="theme/mobile001/css/styleless.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css" />
<!-- Buttom Style -->
<link rel="stylesheet" type="text/css" href="buttons/buttons.css" /><!-- Buttom Style -->
<link rel="stylesheet" href="css/jqui/smoothness/jquery-ui-1.8.17.custom.css" />
<link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<link href="../theme/mobile001/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../theme/mobile001/css/mobile.css" rel="stylesheet" type="text/css">
<link href="../theme/mobile001/css/jquery.mmenu.css" rel="stylesheet" type="text/css">
<link href="../theme/mobile001/css/flexslider.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.mmenu.js"></script>
<script src="../js/respond.min.js"></script>
<script src="../js/jquery.wookmark.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('nav#menu').mmenu();
	});
</script>
<style type="text/css">
/* Mobile */
body { background-image:url(images/wood_bk.jpg)}
a:link{color:#3D6560}
a:visited{color:#538882}
a:hover{color:#D25400}
.TipTypeStyle{background-color:#ffc477; color:#033}
.Mobile_Block:hover{background-color:#000}
.TitleLine{background-color:#F90;color:#FFF;font-size:24px; margin:0 0 10px; line-height:45px; padding:0px 10px;}
#Logo { color:#FFF;}
.Mobile_Top_Menu,.Mobile_Top_Menu:hover{color:#FFF}
div.PageSelectBoard a,div.PageSelectBoard a:hover,.div.PageSelectBoard a:focus{background-color:#F60; color:#090}
div.PageSelectBoard span{background-color:#F60;color:#F60}
.ca-menu li{background:#F60;}
.ca-menu li a{color:#FFF;}
.ca-menu li:hover{background:#000;}
.ca-menu li a:hover{ color:#ccc;}

.InnerPage{float:right; margin-right:2px; margin-top:5px; margin-bottom:5px}
.InnerPage_Type a{color:#FF7171; font-weight:bold}
.InnerPage_Type a:hover{color:#F00; font-weight:bold}
.InnerPage a{font-weight:700;border:1px solid #337fed;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:1px 1px 0 #1570cd;-webkit-box-shadow:inset 1px 1px 0 0 #97c4fe;-moz-box-shadow:inset 1px 1px 0 0 #97c4fe;box-shadow:inset 1px 1px 0 0 #97c4fe;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#3d94f6;padding:4px 8px;text-decoration:none;}
.InnerPage a:hover,.InnerPage a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0',endColorstr='#3d94f6');background:0 color-stop(100%,#3d94f6) );background-color:#1e62d0}
.InnerPage a:active{position:relative;top:1px}
.InnerPage_design{float:right; margin-right:2px; margin-top:5px; margin-bottom:5px}
.InnerPage_design a{font-weight:700;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #d83526;text-decoration:none;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fa665a',endColorstr='#d34639');background:0 color-stop(100%,#d34639) );background-color:#fa665a;color:#fff;display:inline-block;text-shadow:1px 1px 0 #98231a;-webkit-box-shadow:inset 1px 1px 0 0 #fab3ad;-moz-box-shadow:inset 1px 1px 0 0 #fab3ad;box-shadow:inset 1px 1px 0 0 #fab3ad;padding:4px 4px}
.InnerPage_design a:hover, .InnerPage_design a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d34639',endColorstr='#fa665a');background:0 color-stop(100%,#fa665a) );background-color:#d34639}
.InnerPage_design a:active{ position:relative;top:1px}
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
<?php $TplPath = "../" . $TplPath;?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="400" valign="top" style="background-color:#FFF;">
    <div style="width:400px; position:fixed; background-color:#033; z-index:1000">
    <div style="background-color:#8a807c; color:#FFF; text-align:center; padding:5px;">
    
      
    </div>
    
        </div>
    </td>
    <td valign="top">
<div class="" style="width:350px;">
    <div id="wrapper">
  <div id="header" _height="none">
    <div id="context">
   <div id="TopLine" class="mm-fixed-top">
			<a href="#menu" style="position:relative;"><i class="fa fa-bars Mobile_Top_Menu" style="position:absolute; left:10px; line-height:45px; text-align:center;"></i></a>
            <div style="float:right; line-height:45px; text-align:center; margin-right:10px;"><a href="home.php?wshop=<?php echo $_GET['wshop'] ?>&Opt=viewpage&tp=Home&lang=<?php echo $defaultlang; ?>"><i class="fa fa-home Mobile_Top_Menu" style="position:absolute; right:10px; line-height:45px; text-align:center;"></i></a></div>
            <div id="Logo"><h1>Shop3500</h1></div>
            
        </div>
        <div id="MainMenu">
            <nav id="menu">
            <ul class="ca-menu">
                             <li class="child">
                <a href="#">其他事項                </a>
                </li>
                            <li class="child">
                <a href="#">一般訊息                </a>
                </li>
                            <li class="child">
                <a href="#">公告事項                </a>
                </li>
            
</ul>
        </nav>
        </div>
    </div>
  </div>
<!--  Banner  -->      
  <div id="banner" _height="none">
  	<div id="context">
      <!--<div class="flexslider">
              <ul class="slides">
                 <li><img src="images/pic1.jpg" /></li>
                 <li><img src="images/pic2.jpg" /></li>
                 <li><img src="images/pic3.jpg" /></li>
                 <li><img src="images/pic4.jpg" /></li>
              </ul>
      </div>-->
    </div>
  </div>
<!--  Banner  END -->
  <div id="Left_column" >
  	<div id="context" style="min-height:0px;">
		<?php //require("require_tp_leftmenu_vertical_mega_menu.php"); ?>
    </div>
  </div>
  <div id="Content_containter" _height="auto">
  	<div id="Main_content">
      <div id="context" >
      
        <div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container">
                
                </div>
            </div>
        </div>        
		</div>
        

      
      </div>
  	</div>  
    <div id="Rght_column">
      <div id="context">     
      
    </div>
  </div>
  </div>

  <div id="footer" _height="none">
  
  	<div id="context">
			
    </div>
  </div>
</div>
</div>
    </td>
    
  </tr>
</table>
<script type="text/javascript">
$(document).ready(function(){$(".color-picker").miniColors({letterCase:"uppercase"});$("#randomize").click(function(){$(".color-picker").each(function(){$(this).miniColors("value","#"+Math.floor(16777215*Math.random()).toString(16))})})});
</script>
<script type="text/javascript">
	$('.PageRefresh').click(function() {
    	      location.reload();
	});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>