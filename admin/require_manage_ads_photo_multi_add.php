<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/banner";
	$ppu->extensions = "JPG";
	$ppu->formName = "form_Activities";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "3000";
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
  $sip->resizeImages = "false";
  $sip->aspectImages = "true";
  $sip->maxWidth = "";
  $sip->maxHeight = "";
  $sip->quality = "100";
  $sip->makeThumb = "true";
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/banner/thumb";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = "200";
  $sip->maxHeightThumb = "100";
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

$colname_RecordAds = "-1";
if (isset($_GET['act_id'])) {
  $colname_RecordAds = $_GET['act_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT * FROM demo_adtype WHERE act_id = %s", GetSQLValueString($colname_RecordAds, "int"));
$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);
$totalRows_RecordAds = mysqli_num_rows($RecordAds);$colname_RecordAds = "-1";
if (isset($_GET['act_id'])) {
  $colname_RecordAds = $_GET['act_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT * FROM demo_adtype WHERE act_id = %s", GetSQLValueString($colname_RecordAds, "int"));
$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);
$totalRows_RecordAds = mysqli_num_rows($RecordAds);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Activities")) {
	for($i=0; $i<6; $i++)
	{
		if($_POST['pic' . $i] != "" || $_POST['sdescription'][$i] != "")
		{
  $insertSQL = sprintf("INSERT INTO demo_adtype_sub (act_id, sdescription, pic, lang) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['act_id'], "int"),
                       GetSQLValueString($_POST['sdescription'][$i], "text"),
                       GetSQLValueString($_POST['pic' . $i], "text"),
                       GetSQLValueString($_POST['lang'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
		}
	}

  $insertGoTo = "manage_ads.php?Operate=photoaddSuccess&Opt=photoviewpage&lang=" . $_POST['lang'] . "&act_id=" . $_POST['act_id'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
<script type="text/javascript">
<!--
function CheckFields()
{	
	// 檢查『描述』欄位
	var fieldvalue = document.getElementById("sdescription").value;
	if (fieldvalue == "") 
	{
		alert("描述欄位尚未填寫！！");
		document.getElementById("sdescription").focus();
		return false;
	}	
	
	return true;
}
//-->
</script>

<div>
  <div>
      
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增輪播圖片 [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_ads_photo_multi_add.php?GP_upload=true" method="post" enctype="multipart/form-data" name="form_Activities" id="form_Activities" onsubmit="checkFileUpload(this,'JPG',false,500,'','',800,800,'','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="100" align="right">目前主題：</td>
      <td><font color="#2865A2"><strong><?php echo $row_RecordAds['title']; ?></strong></font></td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>照片：</td>
      <td><label for="pic0"></label>
        <input name="pic0" type="file" id="pic0" onchange="checkOneFileUpload(this,'JPG',false,500,'','',800,800,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>描述：</td>
      <td><label for="notes1">
        <input name="sdescription[]" type="text" id="sdescription[]" size="100" maxlength="100" />
        </label></td>
    </tr>
     <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>照片：</td>
      <td><label for="pic0"></label>
        <input name="pic1" type="file" id="pic1" onchange="checkOneFileUpload(this,'JPG',false,1500,'','',1500,1500,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>描述：</td>
      <td><label for="notes1">
        <input name="sdescription[]" type="text" id="sdescription[]" size="100" maxlength="100" />
        </label></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>照片：</td>
      <td><label for="pic0"></label>
        <input name="pic2" type="file" id="pic2" onchange="checkOneFileUpload(this,'JPG',false,1500,'','',1500,1500,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>描述：</td>
      <td><label for="notes1">
        <input name="sdescription[]" type="text" id="sdescription[]" size="100" maxlength="100" />
        </label></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>照片：</td>
      <td><label for="pic0"></label>
        <input name="pic3" type="file" id="pic3" onchange="checkOneFileUpload(this,'JPG',false,500,'','',800,800,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>描述：</td>
      <td><label for="notes1">
        <input name="sdescription[]" type="text" id="sdescription[]" size="100" maxlength="100" />
        </label></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>照片：</td>
      <td><label for="pic0"></label>
        <input name="pic4" type="file" id="pic4" onchange="checkOneFileUpload(this,'JPG',false,500,'','',800,800,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>描述：</td>
      <td><label for="notes1">
        <input name="sdescription[]" type="text" id="sdescription[]" size="100" maxlength="100" />
        </label></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>照片：</td>
      <td><label for="pic0"></label>
        <input name="pic5" type="file" id="pic5" onchange="checkOneFileUpload(this,'JPG',false,500,'','',800,800,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>描述：</td>
      <td><label for="notes1">
        <input name="sdescription[]" type="text" id="sdescription[]" size="100" maxlength="100" />
        </label></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="act_id" type="hidden" id="act_id" value="<?php echo $_GET['act_id']; ?>" />
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form_Activities" />
</form>

</div>
</div>
<?php
mysqli_free_result($RecordAds);
?>

