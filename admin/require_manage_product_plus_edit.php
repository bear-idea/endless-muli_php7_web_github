<?php require_once('../Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_ProductPlus")) {
  $updateSQL = sprintf("UPDATE demo_productplus SET plusname=%s, plusprice=%s, pluslink=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['plusname'], "text"),
                       GetSQLValueString($_POST['plusprice'], "int"),
					   GetSQLValueString($_POST['pluslink'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $updateGoTo =  "manage_product.php?Operate=editSuccess&Opt=pluspage&lang=" . $_POST['lang'] . "&id=" . $_POST['pdid'] . "&pdname=" . $_POST['pdname'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordProductPlus = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordProductPlus = $_GET['id_edit'];
}
$coluserid_RecordProductPlus = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductPlus = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPlus = sprintf("SELECT * FROM demo_productplus WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProductPlus, "int"),GetSQLValueString($coluserid_RecordProductPlus, "int"));
$RecordProductPlus = mysqli_query($DB_Conn, $query_RecordProductPlus) or die(mysqli_error($DB_Conn));
$row_RecordProductPlus = mysqli_fetch_assoc($RecordProductPlus);
$totalRows_RecordProductPlus = mysqli_num_rows($RecordProductPlus);
?>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">修改加值商品 [<?php echo $langname; ?>編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
        <form action="require_manage_product_plus_edit.php" method="POST" enctype="multipart/form-data" name="form_ProductPlus" id="form_ProductPlus" onsubmit="checkFileUpload(this,'GIF,JPG',true,1500,'','','','','','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>名稱：</td>
                  <td><span id="ProductPlusName">
                    <label for="plusname"></label>
                    <input name="plusname" type="text" id="plusname" value="<?php echo $row_RecordProductPlus['plusname']; ?>" maxlength="20" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>價格：</td>
                    <td><span id="ProductPlusPrice">
                    <label for="plusprice"></label>
                    <input name="plusprice" type="text" id="plusprice" value="<?php echo $row_RecordProductPlus['plusprice']; ?>" maxlength="11" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">網址：</td>
                    <td><span id="ProductPlusLink">
                      <label for="pluslink"></label>
                      <input name="pluslink" type="text" id="pluslink" value="<?php echo $row_RecordProductPlus['pluslink']; ?>" size="50" maxlength="250" />
                      <span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
                  </tr> 
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>圖片：</td>
                    <td><label for="pluspic">
                      <input name="button3" type="button" id="button3" onclick="MM_openBrWindow('uplod_productplus.php?id_edit=<?php echo $row_RecordProductPlus['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>','圖片上傳','resizable=yes,width=500,height=350')" value="修改產品圖片" />
                    </label></td>
                  </tr>
                  <tr>
                    <td align="right">描述：</td>
                    <td><span id="ProductPlusSdescription">
                      <label for="sdescription"></label>
                      <input name="sdescription" type="text" id="sdescription" value="<?php echo $row_RecordProductPlus['indicate']; ?>" size="100" maxlength="150" />
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
                      <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordProductPlus['notes1']; ?>" size="50" maxlength="50" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料" />
                    <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="pdid" type="hidden" id="pdid" value="<?php echo $_GET['pdid']; ?>" /></td>
                  </tr>
                  
              </table>
              <input type="hidden" name="MM_update" value="form_ProductPlus" />
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
var sprytextfield5 = new Spry.Widget.ValidationTextField("ProductPlusLink", "url", {validateOn:["blur"], isRequired:false, hint:"http//#"});
//-->
</script>
<?php
mysqli_free_result($RecordProductPlus);
?>
