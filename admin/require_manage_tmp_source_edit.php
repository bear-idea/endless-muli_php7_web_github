<?php require_once('../Connections/DB_Conn.php'); ?>
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
  $updateSQL = sprintf("UPDATE demo_tmp_source SET title=%s, name=%s, homeselect=%s, tmpwebwidth=%s, tmpwebwidthunit=%s, type=%s, indicate=%s, sdescription=%s, tmpmenulimit=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['homeselect'], "int"),
					   GetSQLValueString($_POST['tmpwebwidth'], "int"),
                       GetSQLValueString($_POST['tmpwebwidthunit'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['tmpmenulimit'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $updateGoTo = "manage_tmp.php?Operate=editSuccess&Opt=sourceviewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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

/* 取得贊助企業資料 */
$colname_RecordTmp = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmp = $_GET['id_edit'];
}
$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp_source WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordTmp, "int"),GetSQLValueString($coluserid_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);

?>
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
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
            <td><h5><strong><font color="#756b5b">修改樣板 [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_tmp_source_edit.php" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="100" align="right"><span class="Form_Required_Item">*</span>名稱：</td>
      <td><span id="TmpTitle">
        <label>
          <input name="title" type="text" id="title" value="<?php echo $row_RecordTmp['title']; ?>" size="50" maxlength="50" />
        </label>
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span><font color="#999999">
        <input name="button3" type="button" id="button3" onclick="MM_openBrWindow('uplod_tmp.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>','圖片上傳','width=500,height=350')" value="修改上傳圖片" />
        </font></td>
    </tr>
    <tr>
      <td align="right">分類：</td>
      <td><span id="TmpType">
        <label for="type"></label>
        <select name="type" id="type">
          <option value="-1" <?php if (!(strcmp(-1, $row_RecordTmp['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
          <?php
do {  
?>
          <option value="<?php echo $row_RecordTmpListType['itemname']?>"<?php if (!(strcmp($row_RecordTmpListType['itemname'], $row_RecordTmp['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordTmpListType['itemname']?></option>
          <?php
} while ($row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType));
  $rows = mysqli_num_rows($RecordTmpListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpListType, 0);
	  $row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
  }
?>
        </select>
        <span class="selectInvalidMsg">請選取有效的項目。</span><span class="selectRequiredMsg">請選取項目。</span></span></td>
    </tr>
    <tr <?php if ($_SESSION['MM_UserGroup'] != 'superadmin') { ?>style="display:none;"<?php } ?>>
      <td align="right"><span class="Form_Required_Item">*</span>有無首頁：</td>
      <td><span id="spryradio3">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['homeselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="homeselect" value="0" id="homeselect_0" />
          無</label>
        
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['homeselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="homeselect" value="1" id="homeselect_1" />
          有</label>
        <br />
        <span class="radioRequiredMsg">請進行選取。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>選單限制：</td>
      <td><span id="TmpMenuLimit">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpmenulimit'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenulimit" value="0" id="tmpmenulimit_0" />
          預設</label>
        <br />
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpmenulimit'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenulimit" value="1" id="tmpmenulimit_1" />
          預設+樣板</label>
          <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
          <br />
          <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpmenulimit'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmenulimit" value="2" id="tmpmenulimit_2" />
預設+樣板+圖片        </label><?php } ?><br />
        <span class="radioRequiredMsg">請進行選取。</span></span></td>
    </tr>
     <tr>
      <td align="right"><span class="Form_Required_Item">*</span>網站寬度：</td>
      <td><span id="sprytextfield3">
        <label for="tmpwebwidth"></label>
        <input name="tmpwebwidth" type="text" id="tmpwebwidth" value="<?php echo $row_RecordTmp['tmpwebwidth']; ?> " size="4" maxlength="4" readonly="readonly" <?php if ($_SESSION['MM_UserGroup'] != 'superadmin') {?>readonly="readonly"<?php } ?> />
        <span class="textfieldRequiredMsg">需要有一個值。</span></span><span id="spryselect2">
        <label for="tmpwebwidthunit"></label>
        <select name="tmpwebwidthunit" id="tmpwebwidthunit" <?php if ($_SESSION['MM_UserGroup'] != 'superadmin') {?>readonly="readonly"<?php } ?>>
          <option value="px" <?php if (!(strcmp("px", $row_RecordTmp['tmpwebwidthunit']))) {echo "selected=\"selected\"";} ?>>px</option>
          <!--<option value="%" <?php if (!(strcmp("%", $row_RecordTmp['tmpwebwidthunit']))) {echo "selected=\"selected\"";} ?>>%</option>-->
        </select>
        <span class="selectRequiredMsg">請選取項目。</span></span></td>
    </tr>
    <tr>
      <td align="right">描述：</td>
      <td><span id="TmpSdescription">
        <label for="sdescription"></label>
        <input name="sdescription" type="text" id="sdescription" value="<?php echo $row_RecordTmp['sdescription']; ?>" size="100" maxlength="100" />
        </span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>狀態：</td>
      <td><span id="TmpIndicate">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" value="1" id="RadioGroup1_0" />
          公佈 </label>
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" value="0" id="RadioGroup1_1" />
          隱藏 </label>
        <span class="radioRequiredMsg">請至少選擇一個狀態。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可設定此項目來限制使用者是否可瀏覽此資料。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right">備註：</td>
      <td><label for="notes1"></label>
        <span id="TmpNotes1">
          <label for="notes1"></label>
          <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordTmp['notes1']; ?>" size="50" maxlength="50" />
          <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmp['id']; ?>" />
        <input name="name" type="hidden" id="name" value="<?php echo $row_RecordTmp['name']; ?>" /></td>
    </tr>
    
    
   
    
    
  </table>
  <input type="hidden" name="MM_update" value="form_Tmp" />
</form>

</div>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("TmpTitle", "none", {validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("TmpIndicate", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("TmpNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryselect1 = new Spry.Widget.ValidationSelect("TmpType", {validateOn:["blur"], invalidValue:"-1"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpSdescription", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("TmpMenuLimit", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur"]});
var spryradio3 = new Spry.Widget.ValidationRadio("spryradio3");
//-->
</script>
<?php
mysqli_free_result($RecordTmpListType);

mysqli_free_result($RecordTmp);
?>
