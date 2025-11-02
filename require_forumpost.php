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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Forum_Post")) {
  $insertSQL = sprintf("INSERT INTO demo_forum (name, author, type, content, postdate, editdate, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "forum.php?Operate=addSuccess&Opt=viewpage&lang=" . $_POST['lang'] . "&wshop=" . $_POST['wshop'] ;
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_RecordForumClass = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordForumClass = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumClass = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 2 && lang=%s && level='0' ORDER BY subitem_id", GetSQLValueString($colname_RecordForumClass, "text"));
$RecordForumClass = mysqli_query($DB_Conn, $query_RecordForumClass) or die(mysqli_error($DB_Conn));
$row_RecordForumClass = mysqli_fetch_assoc($RecordForumClass);
$totalRows_RecordForumClass = mysqli_num_rows($RecordForumClass);$colname_RecordForumClass = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordForumClass = $_GET['lang'];
}
$coluserid_RecordForumClass = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordForumClass = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumClass = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 2 && lang=%s && level='0' && userid=%s ORDER BY subitem_id", GetSQLValueString($colname_RecordForumClass, "text"),GetSQLValueString($coluserid_RecordForumClass, "int"));
$RecordForumClass = mysqli_query($DB_Conn, $query_RecordForumClass) or die(mysqli_error($DB_Conn));
$row_RecordForumClass = mysqli_fetch_assoc($RecordForumClass);
$totalRows_RecordForumClass = mysqli_num_rows($RecordForumClass);
?>
<?php if ($MSTMP == 'default') { ?>
<script type="text/javascript" src="ckeditor/ckeditor_basic.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'content',{width : '90%', toolbar : 'Basic'} );
};
</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Forum; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
            		<form name="Forum_Post" action="require_forumpost.php" method="POST" id="Forum_Post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
                      <tr>
                        <td width="100" align="right">主題：</td>
                        <td><span id="ForumName">
                          <label for="name"></label>
                          <input name="name" type="text" id="name" size="50" maxlength="30" />
                        <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
                      </tr>
                      <tr>
                        <td align="right">類別：</td>
                        <td><span id="ForumClass">
                          <label for="type"></label>
                          <select name="type" id="type">
                            <option value="">-- 選擇類別 --</option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_RecordForumClass['itemname']?>"><?php echo $row_RecordForumClass['itemname']?></option>
                            <?php
} while ($row_RecordForumClass = mysqli_fetch_assoc($RecordForumClass));
  $rows = mysqli_num_rows($RecordForumClass);
  if($rows > 0) {
      mysqli_data_seek($RecordForumClass, 0);
	  $row_RecordForumClass = mysqli_fetch_assoc($RecordForumClass);
  }
?>
                          </select>
                        <span class="selectRequiredMsg">請選取項目。</span></span></td>
                      </tr>
                      <tr>
                        <td align="right">內容：</td>
                        <td><span id="ForumContent">
                          <label for="content"></label>
                          <textarea name="content" cols="50" rows="20" id="content"></textarea>
                        <span class="textareaRequiredMsg">需要有一個值。</span></span></td>
                      </tr>
                      <tr>
                        <td align="right">&nbsp;</td>
                        <td><input type="submit" name="button" id="button" value="發表" />
                          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                          <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y/m/d H:i:s"); ?>" />
                          <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" />
                        <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" /></td>
                      </tr>
                    </table>
                    <input type="hidden" name="MM_insert" value="Forum_Post" />
                    </form>
            	</div>
          	</div>
        </div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("ForumName", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("ForumClass", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("ForumContent", {validateOn:["blur"]});
</script>
<?php } else { ?>
<?php include($TplPath . "/forum_post.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordForumClass);
?>

