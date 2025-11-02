<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "superadmin,admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
} 
?>
<?php require_once('incPureUpload.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = "../" . $SiteImgFilePathAdmin . $_POST['webname'] . "/images";
	$ppu->extensions = "";
	$ppu->formName = "form_TmpLogo";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "10000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "5000";
	$ppu->maxHeight = "5000";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "3600";
	$ppu->progressBar = "fileCopyProgress.htm";
	$ppu->progressWidth = "300";
	$ppu->progressHeight = "100";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}
$GP_uploadAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING']."&GP_upload=true";
	} else {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING'];
	}
} else {
  $GP_uploadAction .= "?"."GP_upload=true";
}

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

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title>圖片裁切</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/jquery-ui-1.7.2.custom.css" rel="Stylesheet" type="text/css" /> 
<style type="text/css">
input, textarea{padding:5px; border:solid 1px #CCC; outline:0; background:#FFF left top repeat-x; box-shadow:rgba(0,0,0,0.1) 0px 0px 8px inset; -moz-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px inset; -webkit-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px inset; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px}

textarea{}

input:hover, textarea:hover, 
input:focus, textarea:focus{border-color:#C9C9C9; -webkit-box-shadow:rgba(0,0,0,0.25) 0px 0px 8px}

input:disabled{ background-color:#EEE;}

.form label{margin-left:10px; color:#999}

.submit input{width:auto; padding:9px 15px; background:#617798; border:0; color:#FFF; -moz-border-radius:5px; -webkit-border-radius:5px}

select{ background:transparent;  padding:5px;  line-height:1;  border:solid 1px #CCC;  -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; box-shadow:rgba(0,0,0,0.1) 0px 0px 8px; -moz-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px; -webkit-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px}

select option{ border:solid 1px #CCC}
*{margin:0px;font-size:12px}
.crop{width:1200px; margin:20px auto; border:1px solid #d3d3d3; padding:4px; background:#fff}
#cropzoom_container{float:left; width:960px}
#preview{float:left; width:1200px; height:440px; border:1px solid #999; background:#f7f7f7; margin-top:20px;}
.page_btn{float:right; width:250px;  margin-top:20px; line-height:30px; text-align:center}
.clear{clear:both}
.btn{cursor:pointer}
.TB_General_style01{border:1px solid #CCC; box-shadow:rgba(0,0,0,0.1) 0px 0px 8px; -moz-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px; -webkit-box-shadow:rgba(0,0,0,0.1) 0px 0px 8px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px}
.TB_General_style01 tr{}
.TB_General_style01 tr td{border-top-width:0px; border-right-width:0px; border-bottom-width:1px; border-left-width:0px; border-top-style:solid; border-right-style:solid; border-bottom-style:solid; border-left-style:solid; border-top-color:#CCC; border-right-color:#CCC; border-bottom-color:#CCC; border-left-color:#CCC; margin:5px; padding:5px}
</style>
<style type="text/css"> 
#uploadPreview{
	position:absolute; left:700px; top:200px; border:1px #CCCCCC solid;cursor: move;
}
#uploadPreview img{
	max-width:300px;
	max-height:300px;
}
</style>
<link href="../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function CheckFields()
{		
	// 檢查『分類』欄位
	var fieldvalue = document.getElementById("width").value;
	if (fieldvalue == "" || fieldvalue == NULL) 
	{
		alert("寬度欄位尚未填寫！！");
		document.getElementById("width").focus();
		return false;
	}
	
	// 檢查『分類』欄位
	var fieldvalue = document.getElementById("select_type").value;
	if (fieldvalue == "-1" || fieldvalue == "") 
	{
		alert("適用類型尚未選擇！！");
		document.getElementById("select_type").focus();
		return false;
	}
	return true;
}
//-->
</script>
<script language='JavaScript' src='incPureUpload.js' type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.cropzoom.js"></script>
<script type="text/javascript">
<?php // 取得圖片預覽 ?>
$(document).ready(function() {
// var url = window.URL || window.webkitURL; // alternate use
function readImage(file) {
  
    var reader = new FileReader();
    var image  = new Image();
	
	fileName = 'aaa.txt';
extIndex = fileName.lastIndexOf('.');
if (extIndex != -1) {
    fileName = fileName.substr(extIndex+1, fileName.length);
}

  
    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            //$('#uploadPreview').html('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+t+' '+n+'<br>');
			$('#uploadPreview').html('<div style="background-color:#FFF; padding:10px;"><img src="'+ this.src +'"> '+'<br/>'+w+'x'+h+' '+s+' '+'</div>');
		    $("#width").val(w); // 自動填入寬度
            $("#height").val(h); // 自動填入高度
			$( "#uploadPreview" ).draggable(); // 使此區塊可拖曳
        };
        image.onerror= function() {
			if(file.type == "application/x-shockwave-flash")
			{
			}else{
					alert('Invalid file type: '+ file.type);
			}  
        };      
    };
    
}
$("#logoimage").change(function (e) { // 上傳檔案的ID
    if(this.disabled) return alert('File upload not supported!');
    var F = this.files;
    if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
});
});  
</script>
<script type="text/javascript">
<?php
switch($_POST['select_type'])
{
	case "1":
	    $crop_free_enable = "0";		
		$crop_s_w = "960";		
		$crop_s_h = "200";		
		break;
	case "2":
	    $crop_free_enable = "0";
		$crop_s_w = "960";		
		$crop_s_h = "300";	
		break;
	case "3":
	    $crop_free_enable = "0";
		$crop_s_w = "960";		
		$crop_s_h = "440";			
		break;
	case "4":
	    $crop_free_enable = "0";
		$crop_s_w = "700";		
		$crop_s_h = "100";	
		break;
	case "5":
	    $crop_free_enable = "0";
		$crop_s_w = "700";		
		$crop_s_h = "120";	
		break;
	case "6":
	    $crop_free_enable = "0";
		$crop_s_w = "240";		
		$crop_s_h = "180";
		break;
	case "7":
	    $crop_free_enable = "0";
		$crop_s_w = "160";		
		$crop_s_h = "120";	
		break;
	case "8":
	    $crop_free_enable = "0";
		$crop_s_w = "200";		
		$crop_s_h = "200";
		break;
	case "9":
	    $crop_free_enable = "1";
		break;
	default:
		break;
}
?>
$(function() {
     var cropzoom = $('#cropzoom_container').cropzoom({
          width: 1200,
          height: 500,
          bgColor: '#ccc',
          enableRotation: true,
          enableZoom: true,
		  expose:{
                slidersOrientation: 'horizontal',
                zoomElement: '#zoom',
                rotationElement: '#rot',
                elementMovement:'#movement'
            },
          selector: {
			   <?php if($crop_free_enable == '0') { ?>
			   w:<?php echo $crop_s_w; ?>,
			   h:<?php echo $crop_s_h; ?>,
			   <?php } ?>
			   showPositionsOnDrag:true,
			   showDimetionsOnDrag:false,
               centered: true,
			   bgInfoLayer:'#fff',
               borderColor: 'blue',
			   animated: false,
			   <?php if($crop_free_enable == '0') { ?>
			   maxWidth:<?php echo $crop_s_w; ?>,
			   maxHeight:<?php echo $crop_s_h; ?>,
			   <?php } ?>
			   onSelectorResize:true,
               borderColorHover: 'yellow'
           },
           image: {
			   <?php $ext = substr($_POST['logoimage'], strrpos($_POST['logoimage'], '.') + 1); ?>
               source: '<?php echo "../" . $SiteImgFilePathAdmin . $_POST['webname'] . "/images/cropimage." . $ext; ?>',
               width: <?php echo $_POST['width']; ?>,
               height: <?php echo $_POST['height']; ?>,
               minZoom: 30,
               maxZoom: 150
            }
      });
	 $("#crop").click(function(){
		  cropzoom.send('resize_and_crop.php?webname=<?php echo $_POST['webname'];?>', 'POST', {}, function(imgRet) {
               $("#generated").attr("src", imgRet);
          });			   
	 });
	 $("#restore").click(function(){
		  $("#generated").attr("src", "tmp/head.gif");
		  cropzoom.restore();					  
	 });
});
</script>

</head>

<body style="background-image:url(bgnoise_lg.jpg);">
<!--JS代码网头部--><!--JS代码网头部-->
<div id="main">
 
<div class="crop">
<?php if($_POST['MM_Crop_Upload'] == '1') { ?>
   <div id="cropzoom_container"></div>
   
   <div class="page_btn">
      <input type="button" value="回上一頁" onclick="self.location.href='index.php'"/>
      <input type="button" class="btn" id="crop" value="裁切圖片" />
      <input type="button" class="btn" id="restore" value="圖片歸位" />
   </div>

   <div id="preview"><img id="generated" src="tmp/head.gif"  /></div>
   
   <div class="clear"></div>
   <?php } else { ?>
   <form action="index.php?GP_upload=true" method="post" enctype="multipart/form-data" name="form_TmpLogo" id="form_TmpLogo" onsubmit="checkFileUpload(this,'',false,3000,'','',1500,1500,'','');showProgressWindow('../fileCopyProgress.htm',300,100);return document.MM_returnValue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="11%" align="right"><h2><strong>圖片裁切工具</strong></h2></td>
      <td width="89%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>圖片：</td>
      <td><label for="logoimage"></label>
        <input name="logoimage" type="file" id="logoimage" onchange="checkOneFileUpload(this,'',false,3000,'','',1500,1500,'','');readImage(this);" size="50" maxlength="200" /> <div id="uploadPreview"></div><span>註：圖片長寬必須小於1500px</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>寬度：</td>
      <td>
      <label for="width"></label>
      <input name="width" type="text" id="width" size="3" maxlength="3" readonly="readonly"/>
      </td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>高度：</td>
      <td>
      <label for="height"></label>
      <input name="height" type="text" id="height" size="3" maxlength="3" readonly="readonly" />
      </td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>適用類型：</td>
      <td><label for="select_type"></label>
        <span id="spryselect1">
        <select name="select_type" id="select_type">
          <option value="1">橫幅(960*200)</option>
          <option value="2">橫幅(960*300)</option>
          <option value="3">橫幅(960*440)</option>
          <option value="4">頁面大圖(700*100)</option>
          <option value="5">頁面大圖(700*120)</option>
          <option value="6">頁面小圖(240*180)</option>
          <option value="7">頁面小圖(160*120)</option>
          <option value="8">頭像(200*200)</option>
          <option value="9">自由調整大小</option>
        </select>
        <span>註：上傳的圖片必須比您所選擇的圖片適用類型還大張才好調整</span>
        <span class="selectInvalidMsg">請選取有效的項目。</span><span class="selectRequiredMsg">請選取項目。</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="下一步" onclick="return CheckFields();" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
        <input name="MM_Crop_Upload" type="hidden" id="MM_Crop_Upload" value="1" /></td>
    </tr> 
  </table>
  <input type="hidden" name="MM_insert" value="form_TmpLogo" />
</form>
<?php } ?>

</div>
</div>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"], invalidValue:"-1"});
</script>
</body>
</html>
