<?php header("Content-Type:text/html;charset=utf-8"); /* 指定頁面編碼方式 IE BUG*/  ?>
<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
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
if($_GET['Opt'] == 'viewpage' && $_GET['tmpname'] != '')
{
$colname_RecordTmpBannerConfine = "-1";
if (isset($_GET['tmpname'])) {
  $colname_RecordTmpBannerConfine = $_GET['tmpname'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBannerConfine = sprintf("SELECT * FROM demo_tmpbanner WHERE tmpname = %s", GetSQLValueString($colname_RecordTmpBannerConfine, "text"));
$RecordTmpBannerConfine = mysqli_query($DB_Conn, $query_RecordTmpBannerConfine) or die(mysqli_error($DB_Conn));
$row_RecordTmpBannerConfine = mysqli_fetch_assoc($RecordTmpBannerConfine);
$totalRows_RecordTmpBannerConfine = mysqli_num_rows($RecordTmpBannerConfine);

if($totalRows_RecordTmpBannerConfine == 0)
{
	$insertSQLBanner = sprintf("INSERT INTO demo_tmpbanner (tmpname, title, sdescription, bwight, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
	                   GetSQLValueString($_GET['tmpname'], "text"),
					   GetSQLValueString("橫幅輪播圖片", "text"),
					   GetSQLValueString("高度若不設定請留空，會自行依據寬度來縮放，圖片單位為像素(px)", "text"),
					   GetSQLValueString("1200", "int"),
					   GetSQLValueString($_SESSION['lang'], "text"),
                       GetSQLValueString($w_userid, "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultBanner = mysqli_query($DB_Conn, $insertSQLBanner) or die(mysqli_error($DB_Conn));

$insertGoTo = "tmp_manage_banner.php?Opt=viewpage&lang=" . $_SESSION['lang'] . "&id=" . $_GET['id'] . "&tmpname=" . $_GET['tmpname'];
  //$insertGoTo = "tmp_manage_banner.php?Opt_Tmp=viewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
?>

<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if ($_SESSION['lang'] == "") {
	$_SESSION['lang'] = $defaultlang; 
}else {
	$_SESSION['lang'] = $_GET['lang'];
}
if($_SESSION['lang'] != '') {
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
}
?>

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
	$(function() {
		$('#SiteKeyWord,#skeyword').tagsInput({
			width:'auto',
			defaultText:'加入關鍵字'
		});
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
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
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
<link rel="stylesheet" type="text/css" media="all" href="../css/date/calendar-blue.css"  />  
<script type="text/javascript" src="../js/jquery.dynDateTime.js"></script>  
<script type="text/javascript" src="../js/calendar-big5.js"></script>  
<script type="text/javascript">
        $(document).ready(function() {
            $("#startdate, #enddate").dynDateTime({
                ifFormat: "%Y-%m-%d",
                isCht: false, // 預設為 false，設為 true 表示回傳值為民國年
                ChtYearLen: 2, // 預設為 2，表示回傳的年份位數
				button: ".next()" //next sibling to input field
            });
        });
		
</script>
<!-- [ clearbox ] -->
<script src="../js/clearbox.js" type="text/javascript">
</script>
<!-- [ clearbox End ] -->
<style>
.tbutt{float:left;padding:5px;background-color:#666;color:#FFF;margin:0 5px 10px 0}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:100px;width:100px;margin:5px}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
.bg_board:hover{background-color:#E95516}
.bg_active{background-color:#B37583}
.TmpBgSelectIcon{position:absolute;z-index:1;height:65px;width:93px;background-image:url(images/select.png);background-repeat:no-repeat}
.button_a{display:inline-block;border-width:1px 0;border-color:#BBB;border-style:solid;vertical-align:middle;text-decoration:none;color:#333}
.button_b{float:left;background:#e3e3e3;border-width:0 1px;border-color:#BBB;border-style:solid;margin:0 -1px;position:relative}
.button_c{display:block;line-height:.6em;background:#f9f9f9;border-bottom:2px solid #eee}
.button_d{display:block;padding:.1em .6em;margin-top:-.6em;cursor:pointer}
.button_a:hover{border-color:#999;text-decoration:none}
.button_a:hover .button_b{border-color:#999;text-decoration:none}
.InnerPage_design_st{float:right; margin-right:2px; margin-top:5px; margin-bottom:5px}
.InnerPage_design_st a{font-weight:700;border:1px solid #d83526;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:1px 1px 0 #98231a;-webkit-box-shadow:inset 1px 1px 0 0 #fab3ad;-moz-box-shadow:inset 1px 1px 0 0 #fab3ad;box-shadow:inset 1px 1px 0 0 #97c4fe;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#d83526;padding:4px 8px;text-decoration:none}
.InnerPage_design_st a:hover, .InnerPage_design_st a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fa665a',endColorstr='#d34639');background:0 color-stop(100%,#d34639) );background-color:#fa665a}
.InnerPage_design{float:right; margin-right:2px; margin-top:5px; margin-bottom:5px}
.InnerPage_design a{font-weight:700;border:1px solid #337fed;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:1px 1px 0 #1570cd;-webkit-box-shadow:inset 1px 1px 0 0 #97c4fe;-moz-box-shadow:inset 1px 1px 0 0 #97c4fe;box-shadow:inset 1px 1px 0 0 #97c4fe;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#3d94f6;padding:4px 8px;text-decoration:none}
.InnerPage_design a:hover, .InnerPage_design a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0',endColorstr='#3d94f6');background:0 color-stop(100%,#3d94f6) );background-color:#1e62d0}
.InnerPage_n{float:right;margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerPage_n a{font-weight:700;border:1px solid #CCCCCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:1px 1px 0 #DDDDDD;-webkit-box-shadow:inset 1px 1px 0 0 #CCCCCC;-moz-box-shadow:inset 1px 1px 0 0 #CCCCCC;box-shadow:inset 1px 1px 0 0 #FFF;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#DDDDDD;padding:4px 8px;text-decoration:none}
.InnerPage_n a:hover,.InnerPage_n a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0',endColorstr='#3d94f6');background:0 color-stop(100%,#DDDDDD) );background-color:#DDDDDD}
.InnerPage_n a:active{position:relative;top:1px}
</style>
</head>

<body>
<div style="padding:10px; margin:10px;">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
          <tr>
            <td><?php require("inc_managelangselect.php"); ?></td>
            <td width="" align="right">
            <span class = "InnerPage_design" style="float:right;"><a href="template_home.php?lang=zh-tw" data-original-title="在此區您可以替換目前網頁外觀" class="colorbox_iframe_cd" rel="tipsy_l"><strong> <i class="fa fa-check-square"></i> 回版型套用</strong></a></span><span class = "InnerPage_design" style="float:right;"><a href="tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $_GET['id']; ?>&amp;tmpname=<?php echo $_GET['id']; ?>" class="colorbox_iframe_cd" data-original-title="您可在此修改您的版型，您可選擇基本設計/所見即得模式來做切換設計" rel="tipsy_l"><i class="fa fa-tachometer"></i> 回輪播分類</a></span>
            </td>
        </tr>
    </table>
		<?php //require("inc_managelangselect.php"); ?>
      	<?php
			switch($_GET['Opt'])
			{
				case "viewpage":
					include_once("require_tmp_manage_ads_index.php");			
					break;
				case "addpage":
					include_once("require_tmp_manage_ads_add.php");
					break;
				case "editpage":
					include_once("require_tmp_manage_ads_edit.php"); 
					break;
				case "photoviewpage":
					include_once("require_tmp_manage_ads_photo_index.php");			
					break;
				case "photoaddpage":
					include_once("require_tmp_manage_ads_photo_add.php");
					break;
				case "photoeditpage":
					include_once("require_tmp_manage_ads_photo_edit.php"); 
					break;
				case "deletepage":
					include_once("require_tmp_manage_ads_delete.php");
					break;
				case "listpage":
					include_once("require_tmp_manage_ads_list.php");
					break;
				case "listitempage":
					include_once("require_tmp_manage_ads_listitem.php");
					break;
				case "configpage":
					include_once("require_tmp_manage_ads_config.php");
					break;
				default:
					include_once("require_tmp_manage_ads_index.php");
					break;
			}
		?>
	  </div>
  	</div>
</body>
<script language="javascript">
jQuery(document).ready(function() {
  	fontResizer('80%','90%','100%');
	jQuery("div#fontdisplay").css('display', 'block' );
});
</script>
</html>
<?php
//mysqli_free_result($RecordTmpBannerConfine);

//

//$endTime = getMicroTime(); //页面结尾定义
//echo getRunTime($startTime, $endTime); //最后调用函数
?>