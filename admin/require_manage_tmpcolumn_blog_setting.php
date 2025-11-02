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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpColumn")) {
  $updateSQL = sprintf("UPDATE demo_tmpblogcolumn SET customname=%s, sortid=%s, indicatewrp=%s, indicatetitle=%s, indicatemiddle=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['customname'], "text"),
                       GetSQLValueString($_POST['sortid'], "int"),
					   GetSQLValueString($_POST['indicatewrp'], "int"),
					   GetSQLValueString($_POST['indicatetitle'], "int"),
					   GetSQLValueString($_POST['indicatemiddle'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $updateGoTo = "manage_tmp.php?Operate=addSuccess&Opt=tmpblogcolumn&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */

$colname_RecordTmpColumn = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmpColumn = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmpblogcolumn WHERE id = %s", GetSQLValueString($colname_RecordTmpColumn, "int"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);
/* 插入資料 */
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
</script>
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">編輯 [<?php echo $row_RecordTmpColumn['dftname']; ?>] 區塊 [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_tmpcolumn_blog_setting.php" method="POST" enctype="multipart/form-data" name="form_TmpColumn" id="form_TmpColumn">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
  	<tr>
      <td align="right">欄位型態</td>
      <td><?php echo $row_RecordTmpColumn['dftname']; ?></td>
    </tr>
    <tr>
      <td width="150" align="right"><span class="Form_Required_Item">*</span>自訂標題：</td>
      <td><span id="TmpColumnName">
        <label>
          <input name="customname" type="text" id="customname" value="<?php echo $row_RecordTmpColumn['customname']; ?>" size="50" maxlength="10" />
        </label>
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>排序：</td>
      <td><span id="sprytextfield2">
      <label for="sortid"></label>
      <input name="sortid" type="text" id="sortid" value="<?php echo $row_RecordTmpColumn['sortid']; ?>" size="5" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinValueMsg">輸入的值小於所需的最小值。</span><span class="textfieldMaxValueMsg">輸入的值大於所允許的最大值。</span></span><span class="Form_Caption_Word">(0 ~ 100。)</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>外框區塊顯示：</td>
      <td><span id="spryradio2">
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['indicatewrp'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatewrp" value="1" id="indicatewrp_0" />
          顯示</label>
        
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['indicatewrp'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatewrp" value="0" id="indicatewrp_1" />
          隱藏</label>
        <span class="radioRequiredMsg">請進行選取。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="設定目前此區塊功能是否要套用側邊裝飾外框中的《整體外框》樣式，您可在側邊裝飾外框的新增/修改頁面觀看範例圖和項目。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>標題區塊顯示：</td>
      <td><span id="spryradio1">
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['indicatetitle'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatetitle" value="1" id="titleindicate_0" />
          顯示</label>
        
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['indicatetitle'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatetitle" value="0" id="titleindicate_1" />
          隱藏</label>
        <span class="radioRequiredMsg">請進行選取。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="設定目前此區塊功能是否要套用側邊裝飾外框中的《標題部分》樣式，您可在側邊裝飾外框的新增/修改頁面觀看範例圖和項目。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
     <tr>
      <td align="right"><span class="Form_Required_Item">*</span>內容/底部區塊顯示：</td>
      <td><span id="spryradio3">
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['indicatemiddle'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatemiddle" value="1" id="indicatemiddle_0" />
          顯示</label>
        
        <label>
          <input <?php if (!(strcmp($row_RecordTmpColumn['indicatemiddle'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatemiddle" value="0" id="indicatemiddle_1" />
          隱藏</label>
        <span class="radioRequiredMsg">請進行選取。</span></span><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="設定目前此區塊功能是否要套用側邊裝飾外框中的《內容部分》和《底部部分》樣式，您可在側邊裝飾外框的新增/修改頁面觀看範例圖和項目。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" onclick="return CheckFields();" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" /></td>
    </tr>
   
  </table>
  <input type="hidden" name="MM_update" value="form_TmpColumn" />
</form>

</div>
</div>
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
</script>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("TmpColumnName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {validateOn:["blur"], minValue:0, maxValue:100});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
var spryradio2 = new Spry.Widget.ValidationRadio("spryradio2");
var spryradio3 = new Spry.Widget.ValidationRadio("spryradio3");
//-->
</script>
<?php
mysqli_free_result($RecordTmpColumn);
?>
