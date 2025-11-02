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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_NewsReply")) {
  $updateSQL = sprintf("UPDATE demo_newsreply SET content=%s, notes1=%s, lang=%s WHERE rid=%s",
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['rid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $updateGoTo = "manage_news.php?Operate=replyeditSuccess&Opt=replypage&lang=" . $_POST['lang'] . "&post_id=" . $_POST['post_id'] . "&pd_id=" . $_POST['pd_id'] . "&pdname=" . $_POST['pdname'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordNewsReply = "-1";
if (isset($_GET['post_id'])) {
  $colname_RecordNewsReply = $_GET['post_id'];
}
$coluserid_RecordNewsReply = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNewsReply = $w_userid;
}
$colreplyid_RecordNewsReply = "-1";
if (isset($_GET['rid'])) {
  $colreplyid_RecordNewsReply = $_GET['rid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsReply = sprintf("SELECT * FROM demo_newsreply WHERE pid = %s && rid = %s && userid=%s", GetSQLValueString($colname_RecordNewsReply, "int"),GetSQLValueString($colreplyid_RecordNewsReply, "int"),GetSQLValueString($coluserid_RecordNewsReply, "int"));
$RecordNewsReply = mysqli_query($DB_Conn, $query_RecordNewsReply) or die(mysqli_error($DB_Conn));
$row_RecordNewsReply = mysqli_fetch_assoc($RecordNewsReply);
$totalRows_RecordNewsReply = mysqli_num_rows($RecordNewsReply);

$colname_RecordNewsReplyView = "-1";
if (isset($_GET['post_id'])) {
  $colname_RecordNewsReplyView = $_GET['post_id'];
}
$coluserid_RecordNewsReplyView = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNewsReplyView = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsReplyView = sprintf("SELECT * FROM demo_newspost WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordNewsReplyView, "int"),GetSQLValueString($coluserid_RecordNewsReplyView, "int"));
$RecordNewsReplyView = mysqli_query($DB_Conn, $query_RecordNewsReplyView) or die(mysqli_error($DB_Conn));
$row_RecordNewsReplyView = mysqli_fetch_assoc($RecordNewsReplyView);
$totalRows_RecordNewsReplyView = mysqli_num_rows($RecordNewsReplyView);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageNewsReplyEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageNewsReplyEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageNewsReplyEditorSelect == '1' || $ManageNewsReplyEditorSelect == '2') { ?>
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
            <td><h5><strong><font color="#756b5b">回應問答紀錄 [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_news_reply_edit.php" id="form_NewsReply" name="form_NewsReply" method="POST">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="100" align="right">提問者：</td>
      <td><font color="#2865A2"><strong><?php echo $row_RecordNewsReplyView['author']; ?></strong></font></td>
    </tr>
    <tr>
      <td align="right" valign="top"><span class="Form_Required_Item">*</span>內文：</td>
      <td><span id="NewsReplyContent">
        <label for="content"></label>
        <textarea name="content" id="content" cols="100%" rows="35"><?php echo $row_RecordNewsReply['content']; ?></textarea>
        <span class="textareaRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">備註：</td>
      <td><label for="notes1"></label>
        <span id="NewsReplyNotes1">
          <label for="notes1"></label>
          <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordNewsReply['note1']; ?>" size="50" maxlength="50" />
          <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="post_id" type="hidden" id="post_id" value="<?php echo $_GET['post_id']; ?>" />
        <input name="rid" type="hidden" id="rid" value="<?php echo $_GET['rid'] ?>" />
        <input name="pd_id" type="hidden" id="pd_id" value="<?php echo $_GET['pd_id']; ?>" />
        <input name="pdname" type="hidden" id="pdname" value="<?php echo $_GET['pdname']; ?>" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form_NewsReply" />
</form>
<script type="text/javascript">
        <!--
        var sprytextarea1 = new Spry.Widget.ValidationTextarea("NewsReplyContent", {validateOn:["blur"], isRequired:false});
        var sprytextfield4 = new Spry.Widget.ValidationTextField("NewsReplyNotes1", "none", {validateOn:["blur"], isRequired:false});
        //-->
        </script>

</div>
</div>
<?php
mysqli_free_result($RecordNewsReply);

mysqli_free_result($RecordNewsReplyView);
?>
