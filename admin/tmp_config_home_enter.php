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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Tmp")) {
  $updateSQL = sprintf("UPDATE demo_tmp SET tmphomeenterselect=%s, tmphomeenterdefaultpic=%s, tmphomeentermarginbottom=%s, tmphomeentermarginright=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmphomeenterselect'], "int"),
                       GetSQLValueString($_POST['tmphomeenterdefaultpic'], "text"),
                       GetSQLValueString($_POST['tmphomeentermarginbottom'], "int"),
                       GetSQLValueString($_POST['tmphomeentermarginright'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
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
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script><script type="text/javascript">
	
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
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">樣板設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td align="right"><div>
                  <a href="tmp_config_<?php echo $_GET['board']; // 為版型風格?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>" class="button_a">
                     <span class="button_b">
                         <span class="button_c"> </span>
                         <span class="button_d">回上一頁</span>
                      </span>
                   </a>
               </div></td>
      </tr>
    </table>
	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td align="right"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong>Enter：</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Enter：</td>
      <td><div style="border:1px #CCCCCC dotted; width:600px; margin-left:25px; margin-top:5px; padding:10px;position:relative;">
        <div style="border:1px #CCCCCC dotted; width:580px; position:relative; height:500px;">
            <div style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; right: 50px; bottom: 50px;border:#CCC dotted 1px; width:180px; text-align:center;">Enter</div>
            <div style="position: absolute; left: 408px; bottom: 116px;"><img src="images/z_line_h.png" width="21" height="63" /></div>
            <div style="position: absolute; left: 409px; bottom: 3px;"><img src="images/z_w.png" width="44" height="44" /></div>
              <div style="position: absolute; left: 535px; bottom: 68px;"><img src="images/z_h.png" alt="" width="44" height="44" /></div>
              <div style="padding: 5px; position: absolute; right: -128px; bottom: 164px; width: 268px;">按鈕圖片<font color="#999999">
                <input name="button4" type="button" id="button4" onclick="MM_openBrWindow('uplod_tmphomeenter.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>','圖片上傳','width=500,height=350')" value="修改按鈕圖片" />
              </font> <span class = "InnerPage" style="float:none;"><a href="tmp_config_homeboard002.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="colorbox_iframe" data-original-title="在此上傳您的按鈕圖片，此為進入內頁點選的按鈕<?php if ($OptionDfPageSelect == '1') { ?>，而進入的網頁頁面為您在《自訂頁面》中《起始首頁設定》所設定的值<?php } ?>。" data-toggle="tooltip" data-placement="right">?</a></span></div>
              <div style="padding: 5px; position: absolute; right: -232px; bottom: 112px; width: 268px;">
              距離右方<span id="sprytextfield8">
            <label for="tmphomeentermarginright"></label>
            <input name="tmphomeentermarginright" type="text" id="tmphomeentermarginright" value="<?php echo $row_RecordTmp['tmphomeentermarginright']; ?>" size="3" maxlength="4" />
            <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px <span class = "InnerPage" style="float:none;"><a href="tmp_config_homeboard002.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="colorbox_iframe" data-original-title="在此輸入X軸的距離，可允許輸入負值，例如若您輸入數字為5代表此區塊會左移5px；輸入的數字為-3代表此區塊會向右移3px。" data-toggle="tooltip" data-placement="right">?</a></span>
              </div>
              <div style="padding: 5px; position: absolute; right: -153px; bottom: 3px; width: 268px;">
               距離下方 <span id="sprytextfield7">
          <input name="tmphomeentermarginbottom" type="text" id="tmphomeentermarginbottom" value="<?php echo $row_RecordTmp['tmphomeentermarginbottom']; ?>" size="3" maxlength="4" />
          <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px <span class = "InnerPage" style="float:none;"><a href="tmp_config_homeboard002.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="colorbox_iframe" data-original-title="在此輸入Y軸的距離，可允許輸入負值，例如若您輸入數字為5代表此區塊會上移5px；輸入的數字為-3代表此區塊會向下移3px。" data-toggle="tooltip" data-placement="right">?</a></span>
              </div>
                  
          <span style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; left: 5px; bottom: 5px;">中央區塊</span>
            </div>
          </div>
     </td>
    </tr>
    <tr>
      <td align="right">按鈕模式：</td>
      <td>
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmphomeenterselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterselect" value="0" id="tmphomeenterselect_0" />
          使用預設按鈕圖示</label>

        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmphomeenterselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterselect" value="1" id="tmphomeenterselect_1" />
          自行上傳按鈕圖示</label>

      <span class = "InnerPage" style="float:none;"><a href="tmp_config_homeboard002.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="colorbox_iframe" data-original-title="您可以設定您的按鈕圖示所要讀取的圖示為下方預設按鈕或者使用由上方自行上傳的按鈕圖示。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right">預設按鈕：</td>
      <td>
      <table width="">
                  <tr>
                    <td width="100" align="center" valign="middle" style="border-bottom-width:0px;"><a data-original-title="" data-toggle="tooltip" data-placement="right"><img src="../images/enter/enter001.png" width="100" height="15" /></a></td>
                    <td width="100" align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter002.png" alt="" width="100" height="46" /></td>
                    <td width="100" align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter003.png" width="100" height="100" /></td>
                    <td width="100" align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter004.png" width="100" height="27" /></td>
                    <td width="100" align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter005.png" width="100" height="46" /></td>
                  </tr>
                  <tr>
                    <td style="border-bottom-width:0px;"><label>
                      <input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter001.png"))) {echo "checked=\"checked\"";} ?> name="tmphomeenterdefaultpic" type="radio" id="RadioGroup1_2" value="enter001.png" />
                    風格1</label></td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter002.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter002.png" id="RadioGroup1_2" />
        風格2</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter003.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter003.png" id="RadioGroup1_3" />
風格3</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter004.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter004.png" id="RadioGroup1_4" />
風格4</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter005.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter005.png" id="RadioGroup1_5" />
風格5</td>
                  </tr>
                  <tr>
                    <td align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter006.png" width="57" height="57" /></td>
                    <td align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter007.png" alt="" width="95" height="34" /></td>
                    <td align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter008.png" alt="" width="71" height="71" /></td>
                    <td align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter009.png" alt="" width="97" height="87" /></td>
                    <td align="center" valign="middle" style="border-bottom-width:0px;"><img src="../images/enter/enter010.png" alt="" width="100" height="100" /></td>
                  </tr>
                  <tr>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter006.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter006.png" id="RadioGroup1_6" />
風格6</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter007.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter007.png" id="RadioGroup1_7" />
風格7</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter008.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter008.png" id="RadioGroup1_8" />
風格8</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter009.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter009.png" id="RadioGroup1_9" />
風格9</td>
                    <td style="border-bottom-width:0px;"><input  <?php if (!(strcmp($row_RecordTmp['tmphomeenterdefaultpic'],"enter010.png"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmphomeenterdefaultpic" value="enter010.png" id="RadioGroup1_10" />
風格10</td>
                  </tr>
                </table>
      </td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="110" align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmp['id']; ?>" /></td>
    </tr>
   
    
  </table>
  <input type="hidden" name="MM_update" value="form_Tmp" />
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
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "integer", {validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>