<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/tmp";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_Tmp";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "500";
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
  $sip->maxWidth = "100";
  $sip->maxHeight = "100";
  $sip->quality = "100";
  $sip->makeThumb = "false";
  $sip->pathThumb = "";
  $sip->aspectThumb = "true";
  $sip->naming = "suffix";
  $sip->suffix = "_small";
  $sip->maxWidthThumb = "";
  $sip->maxHeightThumb = "";
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
/* 取得類別列表 */
$colname_RecordTmpListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordTmpListType = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListType = sprintf("SELECT * FROM demo_tmpitem WHERE list_id = 1 && lang=%s", GetSQLValueString($colname_RecordTmpListType, "text"));
$RecordTmpListType = mysqli_query($DB_Conn, $query_RecordTmpListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
$totalRows_RecordTmpListType = mysqli_num_rows($RecordTmpListType);

/* 取得作者列表 */

/* 插入資料 並於之後插入 樣板橫幅的名稱 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Tmp")) {
  $insertSQL = sprintf("INSERT INTO demo_tmp (title, name, homeselect, tmpwebwidth, tmpwebwidthunit, type, pic, indicate, sdescription, tmpmenulimit, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['homeselect'], "int"),
                       GetSQLValueString($_POST['tmpwebwidth'], "int"),
                       GetSQLValueString($_POST['tmpwebwidthunit'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['tmpmenulimit'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 插入橫幅
  //$insertSQLBanner = sprintf("INSERT INTO demo_tmpbanner (tmpname) VALUES (%s)",
  //                     GetSQLValueString($_POST['name'], "text"));

 // //mysqli_select_db($database_DB_Conn, $DB_Conn);
  //$ResultBanner = mysqli_query($DB_Conn, $insertSQLBanner) or die(mysqli_error($DB_Conn));

  $insertGoTo = "manage_tmp.php?Operate=addSuccess&Opt=viewpage&lang=" . $_POST['lang'];
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
	// 檢查『名稱』欄位
	var fieldvalue = document.getElementById("name").value;
	if (fieldvalue == "") 
	{
		alert("名稱欄位尚未填寫！！");
		document.getElementById("name").focus();
		return false;
	}
	
	// 檢查『狀態』欄位
	var fieldvalue = document.getElementById("indicate").checked;
	if (fieldvalue == "") 
	{
		alert("狀態欄位尚未選擇！！");
		document.getElementById("indicate").focus();
		return false;
	}
	
	return true;
}
//-->
</script>
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增樣板 [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_tmp_add.php?GP_upload=true" method="post" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp" onsubmit="checkFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,500,'','',1500,1500,'','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="100" align="right"><span class="Form_Required_Item">*</span>名稱：</td>
      <td><span id="TmpTitle">
        <label>
          <input name="title" type="text" id="title" size="50" maxlength="50" />
        </label>
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">分類：</td>
      <td><span id="TmpType">
        <label for="type"></label>
        <select name="type" id="type">
          <option value="-1">-- 選擇分類 --</option>
          <?php
				do {  
				?>
          <option value="<?php echo $row_RecordTmpListType['itemname']?>"><?php echo $row_RecordTmpListType['itemname']?></option>
          <?php
				} while ($row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType));
				  $rows = mysqli_num_rows($RecordTmpListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordTmpListType, 0);
					  $row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
				  }
				?>
        </select>
</span></td>
    </tr>
     <tr>
      <td align="right"><span class="Form_Required_Item">*</span>風格：</td>
      <td><div id="TmpName">
        <table width="500">
          <tr>
            <td width="100" style="border-bottom-width:0px;"><img src="images/sty01.jpg" width="100" height="100" /></td>
            <td width="100" style="border-bottom-width:0px;"><img src="images/sty02.jpg" width="100" height="100" /></td>
            <td width="100" style="border-bottom-width:0px;">&nbsp;</td>
            <td width="100" style="border-bottom-width:0px;">&nbsp;</td>
            <td style="border-bottom-width:0px;">&nbsp;</td>
          </tr>
          <tr>
            <td style="border-bottom-width:0px;"><label>
              <input name="name" type="radio" id="RadioGroup1_2" value="board001" checked="checked" />
              風格1</label></td>
            <td style="border-bottom-width:0px;"><input type="radio" name="name" value="board002" id="RadioGroup1_3" />
風格2</td>
            <td colspan="3" style="border-bottom-width:0px;">&nbsp;</td>
          </tr>
        </table>
        <span class="radioRequiredMsg">請進行選取。</span></div></td>
    </tr>
    <tr <?php if ($_SESSION['MM_UserGroup'] != 'superadmin') { ?>style="display:none;"<?php } ?>>
      <td align="right"><span class="Form_Required_Item">*</span>有無首頁：</td>
      <td><span id="spryradio3">
        <label>
          <input name="homeselect" type="radio" id="homeselect_0" value="0" checked="checked" />
          無</label>
        
        <label>
          <input type="radio" name="homeselect" value="1" id="homeselect_1" />
          有</label>
        <br />
        <span class="radioRequiredMsg">請進行選取。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>選單限制：</td>
      <td><span id="TmpMenuLimit">
        <label>
          <input type="radio" name="tmpmenulimit" value="0" id="tmpmenulimit_0" />
          預設</label>
          <br />
        <label>
          <input type="radio" name="tmpmenulimit" value="1" id="tmpmenulimit_1" />
          預設+樣板</label>
          
        <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?><br /><label>
          <input type="radio" name="tmpmenulimit" value="2" id="tmpmenulimit_2" />
          預設+樣板+圖片</label><?php } ?>
        
<br />
        <span class="radioRequiredMsg">請進行選取。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>網站寬度：</td>
      <td><span id="sprytextfield3">
        <input name="tmpwebwidth" type="text" id="tmpwebwidth" value="960" size="4" maxlength="4" <?php if ($_SESSION['MM_UserGroup'] != 'superadmin') {?>readonly="readonly"<?php } ?> />
        <span class="textfieldRequiredMsg">需要有一個值。</span></span><span id="spryselect2">
        <label for="tmpwebwidthunit"></label>
        <select name="tmpwebwidthunit" id="tmpwebwidthunit" <?php if ($_SESSION['MM_UserGroup'] != 'superadmin') {?>readonly="readonly"<?php } ?>>
          <option value="px" selected="selected">px</option>
          <option value="%">%</option>
        </select>
        <span class="selectRequiredMsg">請選取項目。</span></span><span id="TmpIndicate2">
        <label> </label>
        <span class="radioRequiredMsg">請至少選擇一個狀態。</span></span><span class="Form_Caption_Word"> (無須更改。)</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>圖片：</td>
      <td><label for="pic"></label>
        <input name="pic" type="file" id="pic" onchange="checkOneFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,500,'','',1500,1500,'','')" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td align="right">描述：</td>
      <td><span id="TmpSdescription">
        <label for="sdescription"></label>
        <input name="sdescription" type="text" id="sdescription" size="100" maxlength="100" />
      </span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>狀態：</td>
      <td><span id="TmpIndicate">
        <label>
          <input name="indicate" type="radio" id="RadioGroup1_0" value="1" checked="checked" />
          公佈 </label>
        <label>
          <input type="radio" name="indicate" value="0" id="RadioGroup1_1" />
          隱藏 </label>
        <span class="radioRequiredMsg">請至少選擇一個狀態。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可設定此項目來限制使用者是否可瀏覽此資料。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right">備註：</td>
      <td><label for="notes1"></label>
        <span id="TmpNotes1">
          <label for="notes1"></label>
          <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
          <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" onclick="return CheckFields();" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
        <input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" />
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form_Tmp" />
</form>

</div>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("TmpTitle", "none", {validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("TmpIndicate", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("TmpNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryselect1 = new Spry.Widget.ValidationSelect("TmpType", {validateOn:["blur"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpSdescription", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("TmpMenuLimit", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryradio3 = new Spry.Widget.ValidationRadio("spryradio3", {validateOn:["blur"]});
var spryradio4 = new Spry.Widget.ValidationRadio("TmpName");
//-->
</script>
<?php
mysqli_free_result($RecordTmpListType);
?>
