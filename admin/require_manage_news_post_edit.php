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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_NewsPost")) {
   $updateSQL = sprintf("UPDATE demo_newspost SET author=%s, content=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

    $updateGoTo = "manage_news.php?Operate=editSuccess&Opt=postpage&lang=" . $_POST['lang'] . "&id=" . $_POST['pid'] . "&pdname=" . $_POST['pdname'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordNewsPost = "-1";
if (isset($_GET['post_id'])) {
  $colname_RecordNewsPost = $_GET['post_id'];
}
$coluserid_RecordNewsPost = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNewsPost = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsPost = sprintf("SELECT * FROM demo_newspost WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordNewsPost, "int"),GetSQLValueString($coluserid_RecordNewsPost, "int"));
$RecordNewsPost = mysqli_query($DB_Conn, $query_RecordNewsPost) or die(mysqli_error($DB_Conn));
$row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost);
$totalRows_RecordNewsPost = mysqli_num_rows($RecordNewsPost);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageNewsPostEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageNewsPostEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageNewsPostEditorSelect == '1' || $ManageNewsPostEditorSelect == '2') { ?>
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
            <td><h5><strong><font color="#756b5b">修改</font><font color="#756b5b">問答紀錄 [<?php echo $langname; ?>編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
        <form action="require_manage_news_post_edit.php" id="form_NewsPost" name="form_NewsPost" method="POST">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>提問者：</td>
                  <td><span id="NewsPostAuthor">
                    <label for="author"></label>
                    <input name="author" type="text" id="author" value="<?php echo $row_RecordNewsPost['author']; ?>" size="30" maxlength="10" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
				  <tr>
                    <td align="right" valign="top"><span class="Form_Required_Item">*</span>內文：</td>
        <td><span id="NewsPostContent">
                      <label for="content"></label>
                      <textarea name="content" id="content" cols="100%" rows="35"><?php echo $row_RecordNewsPost['content']; ?></textarea>
<span class="textareaRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">備註：</td>
                    <td><label for="notes1"></label>
                      <span id="NewsPostNotes1">
                      <label for="notes1"></label>
                      <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordNewsPost['notes1']; ?>" size="50" maxlength="50" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料" />
                    <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="id" type="hidden" id="id" value="<?php echo $_GET['post_id']; ?>" />
                    <input type="hidden" name="pid" id="pid" value="<?php echo $_GET['pd_id']; ?>" />
                    <input name="pdname" type="hidden" id="pdname" value="<?php echo $_GET['pdname']; ?>" /></td>
                  </tr>
              </table>
              <input type="hidden" name="MM_update" value="form_NewsPost" />
        </form>
      <script type="text/javascript">
        <!--
        var sprytextarea1 = new Spry.Widget.ValidationTextarea("NewsPostContent", {validateOn:["blur"], isRequired:false});
        var sprytextfield4 = new Spry.Widget.ValidationTextField("NewsPostNotes1", "none", {validateOn:["blur"], isRequired:false});
		var sprytextfield2 = new Spry.Widget.ValidationTextField("NewsPostAuthor", "none", {validateOn:["blur"]});
        //-->
        </script>
      
   
  </div>
</div>
<?php
mysqli_free_result($RecordNewsPost);
?>
