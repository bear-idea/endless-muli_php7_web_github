<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/productplus";
	$ppu->extensions = "GIF,JPG";
	$ppu->formName = "form_ProductPlus";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "3000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "true";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "";
	$ppu->maxHeight = "";
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

// Smart Image Processor 1.0.4
if (isset($_GET['GP_upload'])) {
  $sip = new resizeUploadedFiles($ppu);
  $sip->component = "GD2";
  $sip->resizeImages = "true";
  $sip->aspectImages = "true";
  $sip->maxWidth = "350";
  $sip->maxHeight = "350";
  $sip->quality = "100";
  $sip->makeThumb = "true";
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/productplus/thumb";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = "45";
  $sip->maxHeightThumb = "45";
  $sip->qualityThumb = "100";
  $sip->checkVersion("1.0.4");
  $sip->doResize();
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_ProductPlus")) {
  $insertSQL = sprintf("INSERT INTO demo_productplus (pdid, plusname, plusprice, pluspic, pluslink, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pdid'], "int"),
                       GetSQLValueString($_POST['plusname'], "text"),
                       GetSQLValueString($_POST['plusprice'], "int"),
                       GetSQLValueString($_POST['pluspic'], "text"),
					   GetSQLValueString($_POST['pluslink'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "manage_product.php?Operate=addSuccess&Opt=pluspage&lang=" . $_POST['lang'] . "&id=" . $_POST['pdid'] . "&pdname=" . $_POST['pdname'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增加值商品 [<?php echo $langname; ?>編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
        <form action="require_manage_product_plus_add.php?GP_upload=true" method="post" enctype="multipart/form-data" name="form_ProductPlus" id="form_ProductPlus" onsubmit="checkFileUpload(this,'GIF,JPG',true,1500,'','','','','','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>名稱：</td>
                  <td><span id="ProductPlusName">
                    <label for="plusname"></label>
                    <input name="plusname" type="text" id="plusname" maxlength="20" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>價格：</td>
                    <td><span id="ProductPlusPrice">
                    <label for="plusprice"></label>
                    <input name="plusprice" type="text" id="plusprice" maxlength="11" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">網址：</td>
                    <td><span id="ProductPlusLink">
                    <label for="pluslink"></label>
                    <input name="pluslink" type="text" id="pluslink" size="50" maxlength="250" />
<span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>圖片：</td>
                    <td><label for="pluspic"></label>
                    <input name="pluspic" type="file" id="pluspic" onchange="checkOneFileUpload(this,'GIF,JPG',true,1500,'','','','','','')" size="50" /></td>
                  </tr>
                  <tr>
                    <td align="right">描述：</td>
                    <td><span id="ProductPlusSdescription">
                      <label for="sdescription"></label>
                      <input name="sdescription" type="text" id="sdescription" size="100" maxlength="150" />
</span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>狀態：</td>
                  <td><span id="ProductPlusIndicate">
                      <label>
                        <input name="indicate" type="radio" id="RadioGroup1_0" value="1" checked="checked" />
                        公佈
                    </label>
                      <label>
                        <input type="radio" name="indicate" value="0" id="RadioGroup1_1" />
                        隱藏
                  </label>
                    <span class="radioRequiredMsg">請至少選擇一個狀態。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可設定此項目來限制使用者是否可瀏覽此資料。" data-toggle="tooltip" data-placement="right">?</a></span></td>
                  </tr>
                  <tr>
                    <td align="right">備註：</td>
                    <td><label for="notes1"></label>
                      <span id="ProductPlusNotes1">
                      <label for="notes1"></label>
                      <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料" />
                    <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="pdid" type="hidden" id="pdid" value="<?php echo $_GET['pdid']; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" /></td>
                  </tr>
                   
              </table>
              <input type="hidden" name="MM_insert" value="form_ProductPlus" />
        </form>
       
      
   
  </div>
</div>
<script type="text/javascript">
<!--
var spryradio1 = new Spry.Widget.ValidationRadio("ProductPlusIndicate", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("ProductPlusNotes1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("ProductPlusSdescription", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("ProductPlusName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("ProductPlusPrice", "currency", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("ProductPlusLink", "url", {validateOn:["blur"], isRequired:false, hint:"http://#"});
//-->
</script>