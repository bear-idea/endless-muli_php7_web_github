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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Activities")) {
  $insertSQL = sprintf("INSERT INTO demo_actalbum (title, author, type, location, sdescription, content, startdate, enddate, indicate, notes1, lang) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['location'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['startdate'], "date"),
                       GetSQLValueString($_POST['enddate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "manage_activities.php?Operate=addSuccess&Opt_Actavities=viewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

/* 取得類別資料 */
$collang_RecordActivitiesListType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivitiesListType = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListType = sprintf("SELECT * FROM demo_actitem WHERE list_id = 1 && lang = %s", GetSQLValueString($collang_RecordActivitiesListType, "text"));
$RecordActivitiesListType = mysqli_query($DB_Conn, $query_RecordActivitiesListType) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
$totalRows_RecordActivitiesListType = mysqli_num_rows($RecordActivitiesListType);

/* 取得發布單位資料 */
$collang_RecordActivitiesListAuthor = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivitiesListAuthor = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListAuthor = sprintf("SELECT * FROM demo_actitem WHERE list_id = 2 && lang = %s", GetSQLValueString($collang_RecordActivitiesListAuthor, "text"));
$RecordActivitiesListAuthor = mysqli_query($DB_Conn, $query_RecordActivitiesListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListAuthor = mysqli_fetch_assoc($RecordActivitiesListAuthor);
$totalRows_RecordActivitiesListAuthor = mysqli_num_rows($RecordActivitiesListAuthor);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageNewsEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageNewsEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageNewsEditorSelect == '1' || $ManageNewsEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增</font><font color="#756b5b">活動花絮主題 [<?php echo $langname; ?>編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
        <form id="form_Activities" name="form_Activities" method="POST" action="require_manage_activities_add.php">    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>標題：</td>
                  <td><span id="ActivitiesTitle">
                    <label for="title"></label>
                    <input name="title" type="text" id="title" size="50" maxlength="50" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>類別：</td>
                    <td><span id="ActivitiesType">
                      <label for="type"></label>
                      <select name="type" id="type">
                        <option value="-1">-- 選擇類別 --</option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_RecordActivitiesListType['itemname']?>"><?php echo $row_RecordActivitiesListType['itemname']?></option>
                        <?php
} while ($row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType));
  $rows = mysqli_num_rows($RecordActivitiesListType);
  if($rows > 0) {
      mysqli_data_seek($RecordActivitiesListType, 0);
	  $row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
  }
?>
                      </select>
                      <span class="selectInvalidMsg">請選取有效的項目。</span><span class="selectRequiredMsg">請選取項目。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>發佈單位：</td>
                    <td><span id="ActivitiesAuthor">
                      <label for="author"></label>
                      <select name="author" id="author">
                        <option value="-1">-- 選擇發布單位 --</option>
                        <?php
do {  
?>
                        <option value="<?php echo $row_RecordActivitiesListAuthor['itemname']?>"><?php echo $row_RecordActivitiesListAuthor['itemname']?></option>
                        <?php
} while ($row_RecordActivitiesListAuthor = mysqli_fetch_assoc($RecordActivitiesListAuthor));
  $rows = mysqli_num_rows($RecordActivitiesListAuthor);
  if($rows > 0) {
      mysqli_data_seek($RecordActivitiesListAuthor, 0);
	  $row_RecordActivitiesListAuthor = mysqli_fetch_assoc($RecordActivitiesListAuthor);
  }
?>
                      </select>
                      <span class="selectInvalidMsg">請選取有效的項目。</span><span class="selectRequiredMsg">請選取項目。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">地點：</td>
                    <td><span id="ActivitiesLocalation">
                      <label for="location"></label>
                      <input name="location" type="text" id="location" size="30" maxlength="20" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>活動時間：</td>
                    <td><span id="ActivitiesStartDate">
                    <label for="startdate"></label>
                    <input type="text" name="startdate" id="startdate" />
                    <img src="images/calendar.png" alt="小日曆" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>- <span id="ActivitiesEndDate">
                    <label for="enddate"></label>
                    <input type="text" name="enddate" id="enddate" />
                    <img src="images/calendar.png" alt="小日曆" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span><font color="#999999">YYYY-MM-DD</font></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>簡要描述：</td>
                    <td><span id="ActivitiesSdescription">
                      <label for="sdescription"></label>
                      <input name="sdescription" type="text" id="sdescription" size="100" maxlength="100" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>狀態：</td>
                    <td><span id="ActitiviesIndicate">
                      <label>
                        <input name="indicate" type="radio" id="indicate_0" value="1" checked="checked" />
                        公佈</label>
                      <label>
                        <input type="radio" name="indicate" value="0" id="indicate_1" />
                        隱藏</label>
                    <span class="radioRequiredMsg">請進行選取。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="Form_Required_Item">*</span>詳細內容：</td>
                    <td><label for="content"></label>
                      <span id="ActivitiesContent">
                      <label for="content"></label>
                      <textarea name="content" id="content" cols="100%" rows="35"></textarea>
                    <span class="textareaRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">備註：</td>
                    <td><span id="ActivitiesNotes1">
                      <label for="notes1"></label>
                      <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
</span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料"/>
                      <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" /></td>
                  </tr> 
              </table>
    <input type="hidden" name="MM_insert" value="form_Activities" />
      </form>
      <script type="text/javascript">
        <!--
		var sprytextfield1 = new Spry.Widget.ValidationTextField("ActivitiesTitle", "none", {validateOn:["blur"]});
        //-->
        </script>
      
   
  </div>
</div>
<?php
mysqli_free_result($RecordActivitiesListType);

mysqli_free_result($RecordActivitiesListAuthor);
?>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("ActivitiesType", {invalidValue:"-1", validateOn:["blur"]});
var spryselect2 = new Spry.Widget.ValidationSelect("ActivitiesAuthor", {invalidValue:"-1", validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("ActivitiesLocalation", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("ActivitiesStartDate", "date", {validateOn:["blur"], format:"yyyy-mm-dd"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("ActivitiesEndDate", "date", {validateOn:["blur"], format:"yyyy-mm-dd"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("ActivitiesSdescription", "none", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("ActivitiesContent", {validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("ActivitiesNotes1", "none", {isRequired:false, validateOn:["blur"]});
var spryradio1 = new Spry.Widget.ValidationRadio("ActitiviesIndicate", {validateOn:["blur"]});
</script>
