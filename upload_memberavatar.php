<?php header("Content-Type:text/html;charset=utf-8"); /* 指定頁面編碼方式 IE BUG*/  ?>
<?php require_once('Connections/DB_Conn.php'); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("inc/inc_path.php"); ?>
<?php require_once("inc/inc_function.php"); ?>
<?php require_once($Lang_GeneralPath); /* 通用語系檔連結 */ ?>
<?php //require_once($Lang_MemberPath); /* 最新訊息語系檔連結 */ ?>
<?php require_once("inc_title/member.php"); /* 此頁面標題 */ ?>
<?php require_once('require_member_get.php'); ?>
<?php require_once('ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePath . $_POST['wshop'] . "/image/member";
	$ppu->extensions = "JPG";
	$ppu->formName = "form_Member";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "2000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "1500";
	$ppu->maxHeight = "1500";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "600";
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

// Smart Image Processor 1.0.4
if (isset($_GET['GP_upload'])) {
  $sip = new resizeUploadedFiles($ppu);
  $sip->component = "GD2";
  $sip->resizeImages = "true";
  $sip->aspectImages = "true";
  $sip->maxWidth = "380";
  $sip->maxHeight = "380";
  $sip->quality = "100";
  $sip->makeThumb = "true";
  $sip->pathThumb = $SiteImgFilePath . $_POST['wshop'] . "/image/member/thumb";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = "200";
  $sip->maxHeightThumb = "200";
  $sip->qualityThumb = "100";
  $sip->checkVersion("1.0.4");
  $sip->doResize();
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Member")) {
  echo $updateSQL = sprintf("UPDATE demo_member SET avatar=IFNULL(%s,avatar) WHERE id=%s",
                       GetSQLValueString($_POST['avatar'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error());
  
  /* 刪除原先圖片 */
  @unlink($SiteImgFilePath . $_POST['wshop'] . '/image/member/' . $_POST['oldavatar']);
  @unlink($SiteImgFilePath . $_POST['wshop'] . '/image/member/thumb/small_' . GetFileThumbExtend($_POST['oldavatar']));

  $updateGoTo = "upload_memberavatar.php?UploadState=Success";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}
?>

<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
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
<title>後台管理系統</title>
<!-- ╭───────────────  JS LINK ────────────────╮ -->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery.corners.min.js"></script>
<script type="text/javascript" src="js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="js/noty/layouts/center.js"></script>
<!-- You can add more layouts if you want -->
<script type="text/javascript" src="js/noty/themes/default.js"></script>
<script type="text/javascript"> 
  function generatetip(title, type) {
  	var n = noty({
  		text: title,
  		type: type,
      dismissQueue: true,
      modal: true,
  		layout: 'center',
  		theme: 'defaultTheme'
  	});
  	console.log('html: '+n.options.id);
  }
</script> 
<script type="text/javascript" src="../js/iframe.js"></script> 
<script>$(document).ready( function(){
  $('.rounded').corners();
});</script>
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->


<!-- ╭─────────────── CSS LINK ────────────────╮ -->
<link href="admin/css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="admin/css/styleless.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' src='ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
<style type="text/css">
body {
}
#wrapper {
	background-image: none;
	background-color: #EAEDE9;
}

#wrapper #header #context{
	background-image: none;
	height: 0px;
}
#wrapper #Left_column {
	width: 0px;
	float: left;
}
#wrapper #Content_containter #Main_content #context {
	/*height: 200px;*/
	margin-left: 0px;
}

#wrapper #Content_containter #Main_content #context {
	background-image: none;
}

#wrapper #footer #context{
	background-image: none;
}
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
</head>

<body>
<div id="wrapper">
  <div id="header">
    <div id="context">
    	
    	<br />
        
    </div>
  </div>
  <div id="banner">
  	<div id="context">
    	
        
    </div>
  </div>
  
</div>
  <div id="Content_containter">
  	<div id="Main_content">
      <div id="context">
      	
      	<div>
    <div>
          <?php 
	  switch($_GET['UploadState']) 
	  {
		  case "Success":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('檔案上傳成功！！','success');});</script>\n";
			break;
		  default:
		  	break;
	  }
	  
	  ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h4><strong><font color="#756b5b">修改圖片 </font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
        <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Member" id="form_Member" onsubmit="checkFileUpload(this,'JPG',true,'','','','','','','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td align="right">圖片預覽：</td>
                    <td>
                    <?php if ($row_RecordMember['avatar'] != "") { ?>
                    <img src="<?php echo $SiteImgFilePath; ?><?php echo $_GET['wshop']; ?>/image/member/thumb/small_<?php echo $row_RecordMember['avatar']; ?>" />
                    <?php } else { ?>
                    <img src="images/100x80_noimage.jpg" width="100" height="80" />
                    <?php }  ?>
                    </td>
                  </tr>
                  <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>圖片上傳：</td>
                  <td><label for="avatar"></label>
                    <input name="avatar" type="file" id="avatar" onchange="checkOneFileUpload(this,'JPG',true'','','','','','','')" size="50" maxlength="50" /><br />
<span class="Form_Caption_Word">(圖片上傳尺寸 500x500以內 [ 請勿使用中文檔名及特殊字元 ]。)</span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料" />
                    <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordMember['id']; ?>" />
                    <input name="oldavatar" type="hidden" id="oldavatar" value="<?php echo $row_RecordMember['avatar']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" /></td>
                  </tr>
              </table>
            <input type="hidden" name="MM_insert" value="form_Member" />
              <input type="hidden" name="MM_update" value="form_Member" />
        </form>
       
      
   
  </div>
</div>
		
      </div>
  	</div>
    <div id="Rght_column">
      <div id="context">     
      	
       
        
      </div> 
    </div>
  </div>
  <div id="footer">
  	<div id="context">
    	 
    	
    </div>
  </div>
</div>
</body>
</html>
<?php
//mysqli_free_result($RecordMember);

//$endTime = getMicroTime(); //页面结尾定义
//echo getRunTime($startTime, $endTime); //最后调用函数
?>