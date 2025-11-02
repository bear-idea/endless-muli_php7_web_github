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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Tmp")) {
  $updateSQL = sprintf("UPDATE demo_tmp SET tmpstrongholdboard=%s, tmpstrongholdboardicon=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmpstrongholdboard'], "text"),
                       GetSQLValueString($_POST['tmpstrongholdboardicon'], "text"),
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

<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.stronghold/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.stronghold/1999/xhtml">
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
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
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
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script><script type="text/javascript">
	
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
#column_t{
	color: #CCC;
	font-size: 30px;
	font-weight: bolder;
	border: #CCC dotted 1px;
	width: 197px;;
	height: 50px;
	margin-right:auto;
	margin-left:auto;;
}
#column_t:hover{
	border: 1px dotted #C30;
}
#column_m{	
	margin-right: auto;
	margin-left: auto;
	margin-top: 5px;
	margin-bottom: 5px;
}
#column_m:hover .column_m_block{	
	border: 1px dotted #C30;
}
.column_m_block{
	margin-right: auto;
	margin-left: auto;
	width: 197px;
	height: 50px;
	border: #CCC dotted 1px;
	margin-bottom: 5px;
}
#column_b{
	color: #CCC;
	font-size: 30px;
	font-weight: bolder;
	border: #CCC dotted 1px;
	width: 197px;;
	height: 50px;
	margin-right:auto;
	margin-left:auto;;
}
#column_b:hover{
	border: 1px dotted #C30;
}
</style>
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
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
                  <a href="tmp_config_<?php echo $row_RecordTmp['name']; // 為版型風格?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="button_a">
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
      <td colspan="2"><i class="fa fa-chevron-right" style="color:#F00"></i> <strong><?php echo $ModuleName['Stronghold']; ?>：</strong></td>
      </tr>
    <tr>
      <td align="right">相片外框：</td>
      <td><span id="spryselect6">
      <label for="tmpstrongholdboard"></label>
      <select name="tmpstrongholdboard" id="tmpstrongholdboard">
        <option value="base" <?php if (!(strcmp("base", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>基本</option>
        <option value="corner" <?php if (!(strcmp("corner", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>圓角</option>
        <option value="glass01" <?php if (!(strcmp("glass01", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>玻璃圓角</option>
        <option value="glass02" <?php if (!(strcmp("glass02", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>玻璃方角</option>
        <option value="pick" <?php if (!(strcmp("pick", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>切角</option>
        <option value="stamp" <?php if (!(strcmp("stamp", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>郵票</option>
        <option value="photographic" <?php if (!(strcmp("photographic", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙A</option>
        <option value="photographic01" <?php if (!(strcmp("photographic01", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙B</option>
        <option value="photographic02" <?php if (!(strcmp("photographic02", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙C</option>
        <option value="photographic03" <?php if (!(strcmp("photographic03", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙D</option>
        <option value="photographic04" <?php if (!(strcmp("photographic04", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙E</option>
        <option value="photographic05" <?php if (!(strcmp("photographic05", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙F</option>
        <option value="photographic06" <?php if (!(strcmp("photographic06", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙G</option>
        <option value="photographic07" <?php if (!(strcmp("photographic07", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙H</option>
        <option value="photographic08" <?php if (!(strcmp("photographic08", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙I</option>
        <option value="photographic09" <?php if (!(strcmp("photographic09", $row_RecordTmp['tmpstrongholdboard']))) {echo "selected=\"selected\"";} ?>>相紙J</option>
      </select>
      </span><br /></td>
    </tr>
    <tr>
      <td align="right">相片外框圖示：</td>
      <td><span id="spryselect7">
      <label for="tmpstrongholdboardicon"></label>
      <select name="tmpstrongholdboardicon" id="tmpstrongholdboardicon">
        <option value="" <?php if (!(strcmp("", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>-- 選擇圖示 --</option>
        <option value="photoFram_Block_glossy" <?php if (!(strcmp("photoFram_Block_glossy", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>仿玻璃</option>
        <option value="photoFram_Block_floral-corner" <?php if (!(strcmp("photoFram_Block_floral-corner", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>花紋A</option>
        <option value="photoFram_Block_heraldry" <?php if (!(strcmp("photoFram_Block_heraldry", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>花紋B</option>
        <option value="photoFram_Block_paper-clip" <?php if (!(strcmp("photoFram_Block_paper-clip", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>迴紋針</option>
        <option value="photoFram_Block_pin" <?php if (!(strcmp("photoFram_Block_pin", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>圖釘</option>
        <option value="photoFram_Block_tape" <?php if (!(strcmp("photoFram_Block_tape", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>膠帶</option>
        <option value="photoFram_Block_flower" <?php if (!(strcmp("photoFram_Block_flower", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>花和蝴蝶</option>
        <option value="photoFram_Block_leaf" <?php if (!(strcmp("photoFram_Block_leaf", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>葉子</option>
        <option value="photoFram_Block_clip" <?php if (!(strcmp("photoFram_Block_clip", $row_RecordTmp['tmpstrongholdboardicon']))) {echo "selected=\"selected\"";} ?>>夾子</option>
      </select>
      </span></td>
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
var spryselect6 = new Spry.Widget.ValidationSelect("spryselect6", {validateOn:["blur"]});
var spryselect7 = new Spry.Widget.ValidationSelect("spryselect7", {isRequired:false, validateOn:["blur"]});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>