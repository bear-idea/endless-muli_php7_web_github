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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpColumn")) {
    $updateSQL = sprintf("UPDATE demo_tmphomeblockcolumn SET customname=%s, content=%s, indicatetitle=%s, sortid=%s, height=%s, backgroundcolor=%s, boardcolor=%s, boardenable=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['customname'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['indicatetitle'], "int"),
					   GetSQLValueString($_POST['sortid'], "int"),
					   GetSQLValueString($_POST['height'], "int"),
					   GetSQLValueString($_POST['backgroundcolor'], "text"),
					   GetSQLValueString($_POST['boardcolor'], "text"),
					   GetSQLValueString($_POST['boardenable'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

/* 取得類別列表 */

$colname_RecordTmpColumn = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmpColumn = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmphomeblockcolumn WHERE id = %s", GetSQLValueString($colname_RecordTmpColumn, "int"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);
?>

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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script><script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script><script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
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
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
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
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content',{width : '460px', toolbar : 'Full'} );
};
</script>
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
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
<div style="padding:10px; margin:10px; position:relative; min-width:1000px;" id="wrapper_config">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">樣板設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td align="right"><div>
                  <a href="tmp_config_<?php echo $_GET['board']; ?>_block<?php if($_SESSION['lang']=="zh-cn") {echo "_cn";} else if($_SESSION['lang']=="en"){echo "_en";}?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_tmp']; ?>&amp;board=<?php echo $_GET['board']; ?>" class="button_a">
                     <span class="button_b">
                         <span class="button_c"> </span>
                         <span class="button_d">回上一頁</span>
                      </span>
                   </a>
               </div></td>
      </tr>
    </table>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_TmpColumn" id="form_TmpColumn">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
  	<tr>
      <td align="right">欄位型態</td>
      <td><?php echo $row_RecordTmpColumn['dftname']; ?> <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="注意此區塊寬度為460px，您在填寫內容必須以此寬度為基準。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td width="150" align="right"><span class="Form_Required_Item">*</span>自訂標題：</td>
      <td><span id="TmpColumnName">
        <label>
          <input name="customname" type="text" id="customname" value="<?php echo $row_RecordTmpColumn['customname']; ?>" size="50" maxlength="10" />
        </label>
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span><span class="Form_Caption_Word">(此名稱您可至<a href="tmp_config_home_wrp_m_column.php?id_edit=<?php echo $_GET['id_tmp']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">版型設計</a>畫面中設定是否顯示)</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>內容：</td>
      <td><span id="sprytextarea1">
      <label for="content"></label>
      <textarea name="content" id="content" cols="100%" rows="35"><?php echo $row_RecordTmpColumn['content']; ?></textarea>
      <span class="textareaRequiredMsg">需要有一個值。</span><span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>排序：</td>
      <td><span id="sprytextfield2">
      <label for="sortid"></label>
      <input name="sortid" type="text" id="sortid" value="<?php echo $row_RecordTmpColumn['sortid']; ?>" size="5" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinValueMsg">輸入的值小於所需的最小值。</span><span class="textfieldMaxValueMsg">輸入的值大於所允許的最大值。</span></span><span class="Form_Caption_Word">(0 ~ 100。)</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>內容區塊高度：</td>
      <td><span id="sprytextfield1">
      <label for="height"></label>
      <input name="height" type="text" id="height" value="<?php echo $row_RecordTmpColumn['height']; ?>" size="5" maxlength="4" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="目前此區塊的高度，若輸入資料內容多於此高則會啟用Scroll Bar。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>背景顏色：</td>
      <td><span id="sprytextfield3">
        <label for="backgroundcolor"></label>
        <input name="backgroundcolor" type="text" class="color-picker" id="backgroundcolor" value="<?php echo $row_RecordTmpColumn['backgroundcolor']; ?>"/>
        <span class="textfieldRequiredMsg">需要有一個值。</span></span>
        <input name="TransparentButtom" type="button" id="TransparentButtom" value="設為透明" />
        <input name="RadomButtom" type="button" id="randomize" value="隨機顏色" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>外框是否啟用：</td>
      <td><p><span id="spryradio1">
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['boardenable'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="boardenable" value="1" id="boardenable_0" />
          啟用</label>

        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['boardenable'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="boardenable" value="0" id="boardenable_1" />
          關閉</label>
        <span class="radioRequiredMsg">請進行選取。</span></span> <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="目前此區塊是否繪製框線而框線顏色可由《外框背景顏色》設定" data-toggle="tooltip" data-placement="right">?</a></span><br />
      </p></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>外框顏色：</td>
      <td><span id="sprytextfield4">
        <label for="boardcolor"></label>
        <input name="boardcolor" type="text" class="color-picker" id="boardcolor" value="<?php echo $row_RecordTmpColumn['boardcolor']; ?>"/>
        <span class="textfieldRequiredMsg">需要有一個值。</span></span>
        <input name="TransparentButtom2" type="button" id="TransparentButtom2" value="設為透明" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>標題區塊：</td>
      <td><span id="spryradio2">
      <label>
        <input <?php if (!(strcmp($row_RecordTmpColumn['indicatetitle'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatetitle" value="1" id="indicatetitle_0" />
        顯示</label>
      <label>
        <input <?php if (!(strcmp($row_RecordTmpColumn['indicatetitle'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatetitle" value="0" id="indicatetitle_1" />
        隱藏</label>
      <br />
      <span class="radioRequiredMsg">請進行選取。</span></span></td>
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
      <td><input type="submit" name="button" id="button" value="送出填寫資料" onclick="return CheckFields();" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
<input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
        <input name="id_tmp" type="hidden" id="id_tmp" value="<?php echo $_GET['id_tmp']; ?>" /></td>
    </tr>
    
    
    
    
  </table>
  <input type="hidden" name="MM_update" value="form_TmpColumn" />
    </form>
  </div>
  
</div>

<div id="footer_config"></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var spryradio2 = new Spry.Widget.ValidationRadio("spryradio2");
</script>
</body>
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
		});
		
		$("#TransparentButtom").click(function(){
			// 設定透明
			$("#backgroundcolor").val("transparent")
		});
		<?php if ($row_RecordTmpColumn['backgroundcolor'] == "transparent") { ?>
			$("#backgroundcolor").val("transparent");
		<?php } ?>
		$("#TransparentButtom2").click(function(){
			// 設定透明
			$("#boardcolor").val("transparent")
		});
		<?php if ($row_RecordTmpColumn['boardcolor'] == "transparent") { ?>
			$("#boardcolor").val("transparent");
		<?php } ?>
	});
</script>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("TmpColumnName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"], minValue:0, maxValue:100});
//-->
</script>
</html>
<?php
mysqli_free_result($RecordTmpColumn);
?>