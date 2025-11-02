<?php require_once('Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Forum_Reply")) {
  $insertSQL = sprintf("INSERT INTO demo_forumpost (pid, author, content, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pid'], "int"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $updateSQL = "UPDATE demo_forum SET replycount=replycount+1 WHERE id = " . $_POST['pid'];
  /*執行更新動作*/
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = $_SERVER['PHP_SELF'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $insertGoTo));
  echo("<script language='javascript'>location.href='" . $insertGoTo . "'</script>");
}
?>
<link rel="stylesheet" href="css/QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch.js"></script>
<script type="text/javascript" src="js/QapTcha.jquery.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor_basic.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'content',{width : '660px', toolbar : 'Basic', height : '200px'} );
};
</script>

<?php if ($ManageForumPostEditorSelect == '1' || $ManageForumPostEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<div id='Tcha' style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC;">
  <form name="Forum_Reply" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" id="Forum_Reply">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="100"><span id="sprytextarea1">
                          <span id="ForumPostContent">
                          <label for="content"></label>
                          <textarea name="content" id="content" cols="100%" rows="5"></textarea>
                        <span class="textareaRequiredMsg">欄位不可為空。</span></span></span>      </td>
                        </tr>
                        <tr>
                        <td height="5" ></td>
                      </tr>
                        <tr>
                        <td><div class="QapTcha"></div></td>
                      </tr>
                      <tr>
                        <td>
                          <input type="submit" name="button" id="button" value="送出"/>
                          <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />    
                          <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" />
                          <input name="author" type="hidden" id="author" value="<?php echo $_SESSION['MM_Username_' . $_GET['wshop']]; ?>" />                      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                          <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" /></td>
                        </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="Forum_Reply" />
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '移動按鈕拖曳至右方以解鎖按鈕',
		txtUnlock : '按鈕解鎖',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : 'Qaptcha.jquery.php'
	});
  });
</script> 
<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("ForumPostContent", {validateOn:["blur"], isRequired:false});
</script>
