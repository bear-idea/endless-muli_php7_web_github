<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/catalog";
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	$ppu->formName = "form_Catalog";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "500";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "300";
	$ppu->maxHeight = "300";
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
$colname_RecordCatalogListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCatalogListType = $_GET['lang'];
}
$coluserid_RecordCatalogListType = "-1";
if (isset($wuserid)) {
  $coluserid_RecordCatalogListType = $wuserid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogListType = sprintf("SELECT * FROM demo_catalogitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCatalogListType, "text"),GetSQLValueString($coluserid_RecordCatalogListType, "int"));
$RecordCatalogListType = mysqli_query($DB_Conn, $query_RecordCatalogListType) or die(mysqli_error($DB_Conn));
$row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType);
$totalRows_RecordCatalogListType = mysqli_num_rows($RecordCatalogListType);$colname_RecordCatalogListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCatalogListType = $_GET['lang'];
}
$coluserid_RecordCatalogListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCatalogListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogListType = sprintf("SELECT * FROM demo_catalogitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCatalogListType, "text"),GetSQLValueString($coluserid_RecordCatalogListType, "int"));
$RecordCatalogListType = mysqli_query($DB_Conn, $query_RecordCatalogListType) or die(mysqli_error($DB_Conn));
$row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType);
$totalRows_RecordCatalogListType = mysqli_num_rows($RecordCatalogListType);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModList = "SELECT * FROM demo_configitem";
$RecordModList = mysqli_query($DB_Conn, $query_RecordModList) or die(mysqli_error($DB_Conn));
$row_RecordModList = mysqli_fetch_assoc($RecordModList);
$totalRows_RecordModList = mysqli_num_rows($RecordModList);

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Catalog")) {
  $insertSQL = sprintf("INSERT INTO demo_catalog (name, type, typemenu, link, pic, sdescription, modselect, picname, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['typemenu'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
					   GetSQLValueString($_POST['modselect'], "int"),
					   GetSQLValueString($_POST['picname'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "manage_catalog.php?Operate=addSuccess&Opt=viewpage&lang=" . $_POST['lang'];
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
	
	// 檢查『分類』欄位
	var fieldvalue = document.getElementById("type").value;
	if (fieldvalue == "" || fieldvalue == "-1") 
	{
		alert("分類欄位尚未選擇！！");
		document.getElementById("type").focus();
		return false;
	}
	
	// 檢查『網址』欄位
	var fieldvalue = document.getElementById("link").value;
	if (fieldvalue == "") 
	{
		alert("網址欄位尚未填寫！！");
		document.getElementById("link").focus();
		return false;
	}
	
	// 檢查『上傳』欄位
	var fieldvalue = document.getElementById("pic").value.split("\\");

	if (fieldvalue[fieldvalue.length-1].indexOf(" ") >= 0) 
	{
			alert("上傳檔案名稱中不可有空白符號！！");
			document.getElementById("pic").focus();
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
<script type="text/javascript">
$(document).ready(function() 
{
   $('.tip_img_catalog').qtip({
      content: '<img src="images/tip/tip007.jpg" width="250" height="247" />'
   });
   $('.tip_img_sort').qtip({
      content: '<img src="images/tip/tip015.jpg" width="350" height="323" />'
   });
});
</script>
<style>
.mod_board {
	margin: 2px;
	float: left;
	width: 100px;
	border: 1px dotted #DDD;
	height: 130px;
}

.mod_pic {
	text-align: center;
	vertical-align: middle;
	padding: 5px;
}

.mod_text {
		text-align: center;
	vertical-align: middle;
}
.InnerPage {
	float: none;
	text-align: center;
	padding-top: 10px;
}
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增<?php echo $ModuleName['Catalog']; ?> [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_catalog_add.php?GP_upload=true" method="post" enctype="multipart/form-data" name="form_Catalog" id="form_Catalog" onsubmit="checkFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,500,'','',300,300,'','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="100" align="right"><span class="Form_Required_Item">*</span>名稱：</td>
      <td><span id="CatalogName">
        <label>
          <input name="name" type="text" id="name" size="50" maxlength="50" />
        </label>
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span>
        <input name="button3" type="button" id="button3" onclick="MM_openBrWindow('catalog_link_photo.php','範例圖片','resizable=yes,width=500,height=500')" value="範例圖片" /></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>分類：</td>
      <td><span id="CatalogType">
        <label for="type"></label>
        <select name="type" id="type">
          <option value="-1">-- 選擇分類 --</option>
          <?php
				do {  
				?>
          <option value="<?php echo $row_RecordCatalogListType['itemname']?>"><?php echo $row_RecordCatalogListType['itemname']?></option>
          <?php
				} while ($row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType));
				  $rows = mysqli_num_rows($RecordCatalogListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordCatalogListType, 0);
					  $row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType);
				  }
				?>
        </select>
        <span class="selectInvalidMsg">請選取有效的項目。</span><span class="selectRequiredMsg">請選取項目。</span></span></td>
    </tr>
    <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>模組頁面：</td>
          <td><?php $i=0 ?>
         
           <div class="mod_board"><div class="mod_pic"><a href="http://easy.shop3500.com/" data-original-title="此模組會外連到外部網站，選擇此項目後在《他網網址》輸入網址即可。" target="_blank" data-toggle="tooltip" data-placement="right"><img src="images/mt_053.png" width="60" height="60" /></a></div><div class="mod_text">
             <label>
             <input name="typemenu"  type="radio" id="typemenu_<?php echo $i ?>" value="Link" checked="checked" />
             <a>它網連結</a></label></div><div class = "InnerPage"><a href="http://www.google.com.tw/" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
            <div style="clear:both; color:#C30">註：此選項代表您所要連結的頁面；例如您想連結至您的Blog，選擇「他網連結」並於下方輸入網址即可。<br />
註：若您有快速連結<a class="tip_img_catalog" style=" background-color:#C60; color:#FFF"> ? </a>的區塊，請注意只會顯示10個在您的頁面上，但您可在該模組主頁面中調整排列順序<a class="tip_img_sort" style=" background-color:#C60; color:#FFF"> ? </a>來作顯示。<br />
            </div>
</td>
                  </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>網址：</td>
      <td><span id="CatalogIink">
        <label for="link"></label>
        <input name="link" type="text" id="link" value="http://#" size="50" maxlength="250" />
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="當您需要連結外部網站時，您必須在此欄填寫網址；當您需要連結目前網站的功能模組頁面時，您僅需選擇您要的模組頁面選項即可，本欄網址就不需要填寫。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>模式選擇：</td>
      <td><p>
        <label>
          <input name="modselect" type="radio" id="modselect_0" value="0" checked="checked" />
          使用內建圖片</label>
        
        <label>
          <input type="radio" name="modselect" value="1" id="modselect_1" />
          使用自訂圖片</label> <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可設定此項目來選擇顯示方式，若欲使用自訂圖片請在自訂圖片欄位上傳圖片。" data-toggle="tooltip" data-placement="right">?</a></span>
        <br />
      </p></td>
    </tr>
    <tr>
      <td align="right">內建圖片：</td>
      <td><table width="1000" class="TB_General_style01">
        <tr>
          <td width="200"><img src="../images/link/fri_mod01.jpg" width="198" height="60" /></td>
          <td width="200"><img src="../images/link/fri_mod02.jpg" alt="" width="198" height="60" /></td>
          <td width="200"><img src="../images/link/fri_mod03.jpg" alt="" width="198" height="60" /></td>
          <td width="200"><img src="../images/link/fri_mod04.jpg" alt="" width="198" height="60" /></td>
          <td width="200"><img src="../images/link/fri_mod05.jpg" alt="" width="198" height="60" /></td>
          </tr>
        <tr>
          <td><input type="radio" name="picname" value="fri_mod01.jpg" id="RadioGroup1_1" checked="checked" />
01</td>
          <td><input type="radio" name="picname" value="fri_mod02.jpg" id="RadioGroup1_2" />
02</td>
          <td><input type="radio" name="picname" value="fri_mod03.jpg" id="RadioGroup1_3" />
03</td>
          <td><input type="radio" name="picname" value="fri_mod04.jpg" id="RadioGroup1_4" />
04</td>
          <td><input type="radio" name="picname" value="fri_mod05.jpg" id="RadioGroup1_5" />
05</td>
        </tr>
        <tr>
          <td><img src="../images/link/fri_mod06.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod07.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod08.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod09.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod10.jpg" alt="" width="198" height="60" /></td>
        </tr>
        <tr>
          <td><input type="radio" name="picname" value="fri_mod06.jpg" id="RadioGroup1_6" />
06</td>
          <td><input type="radio" name="picname" value="fri_mod07.jpg" id="RadioGroup1_7" />
07</td>
          <td><input type="radio" name="picname" value="fri_mod08.jpg" id="RadioGroup1_8" />
08</td>
          <td><input type="radio" name="picname" value="fri_mod09.jpg" id="RadioGroup1_9" />
09</td>
          <td><input type="radio" name="picname" value="fri_mod10.jpg" id="RadioGroup1_10" />
10</td>
        </tr>
        <tr>
          <td><img src="../images/link/fri_mod11.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod12.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod13.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod14.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod15.jpg" alt="" width="198" height="60" /></td>
        </tr>
        <tr>
          <td><input type="radio" name="picname" value="fri_mod11.jpg" id="RadioGroup1_11" />
11</td>
          <td><input type="radio" name="picname" value="fri_mod12.jpg" id="RadioGroup1_12" />
12</td>
          <td><input type="radio" name="picname" value="fri_mod13.jpg" id="RadioGroup1_13" />
13</td>
          <td><input type="radio" name="picname" value="fri_mod14.jpg" id="RadioGroup1_14" />
14</td>
          <td><input type="radio" name="picname" value="fri_mod15.jpg" id="RadioGroup1_15" />
15</td>
        </tr>
        <tr>
          <td><img src="../images/link/fri_mod16.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod17.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod18.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod19.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod20.jpg" alt="" width="198" height="60" /></td>
        </tr>
        <tr>
          <td><input type="radio" name="picname" value="fri_mod16.jpg" id="RadioGroup1_16" />
16</td>
          <td><input type="radio" name="picname" value="fri_mod17.jpg" id="RadioGroup1_17" />
17</td>
          <td><input type="radio" name="picname" value="fri_mod18.jpg" id="RadioGroup1_18" />
18</td>
          <td><input type="radio" name="picname" value="fri_mod19.jpg" id="RadioGroup1_19" />
19</td>
          <td><input type="radio" name="picname" value="fri_mod20.jpg" id="RadioGroup1_20" />
20</td>
        </tr>
        <tr>
          <td><img src="../images/link/fri_mod21.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod22.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod23.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod24.jpg" alt="" width="198" height="60" /></td>
          <td><img src="../images/link/fri_mod25.jpg" alt="" width="198" height="60" /></td>
        </tr>
         <tr>
          <td><input type="radio" name="picname" value="fri_mod21.jpg" id="RadioGroup1_21" />
21</td>
          <td><input type="radio" name="picname" value="fri_mod22.jpg" id="RadioGroup1_22" />
22</td>
          <td><input type="radio" name="picname" value="fri_mod23.jpg" id="RadioGroup1_23" />
23</td>
          <td><input type="radio" name="picname" value="fri_mod24.jpg" id="RadioGroup1_24" />
24</td>
          <td><input type="radio" name="picname" value="fri_mod25.jpg" id="RadioGroup1_25" />
25</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>自訂圖片：</td>
      <td><label for="pic"></label>
        <input name="pic" type="file" id="pic" onchange="checkOneFileUpload(this,'GIF,JPG,JPEG,BMP,PNG',false,500,'','',300,300,'','')" size="50" maxlength="50" />
        <font color="#999999">上傳大小：300x300px 以內，建議尺寸240x70px為最佳瀏覽效果</font></td>
    </tr>
    <tr>
      <td align="right">描述：</td>
      <td><span id="CatalogSdescription">
        <label for="sdescription"></label>
        <input name="sdescription" type="text" id="sdescription" size="100" maxlength="100" />
      </span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>狀態：</td>
      <td><span id="CatalogIndicate">
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
        <span id="CatalogNotes1">
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
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form_Catalog" />
</form>

</div>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("CatalogName", "none", {validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("CatalogIndicate", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("CatalogNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryselect1 = new Spry.Widget.ValidationSelect("CatalogType", {invalidValue:"-1", validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("CatalogSdescription", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("CatalogIink", "none", {validateOn:["blur"]});
//-->
</script>
<?php
mysqli_free_result($RecordCatalogListType);

mysqli_free_result($RecordModList);
?>
