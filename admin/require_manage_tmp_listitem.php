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
/* 新增類別項目 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpitem (list_id, itemname, lang) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
                       GetSQLValueString($_POST['lang'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_tmpitem SET list_id=%s, itemname=%s, lang=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_tmpitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordTmpListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordTmpListItem = $_GET['lang'];
}
$collistid_RecordTmpListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordTmpListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListItem = sprintf("SELECT demo_tmpitem.item_id, demo_tmplist.list_id, demo_tmplist.listname, demo_tmpitem.itemname, demo_tmpitem.lang FROM demo_tmplist LEFT OUTER JOIN demo_tmpitem ON demo_tmplist.list_id = demo_tmpitem.list_id WHERE demo_tmplist.list_id = %s && demo_tmpitem.lang=%s", GetSQLValueString($collistid_RecordTmpListItem, "int"),GetSQLValueString($collang_RecordTmpListItem, "text"));
$RecordTmpListItem = mysqli_query($DB_Conn, $query_RecordTmpListItem) or die(mysqli_error($DB_Conn));
$row_RecordTmpListItem = mysqli_fetch_assoc($RecordTmpListItem);
$totalRows_RecordTmpListItem = mysqli_num_rows($RecordTmpListItem);
?>

<div>
    <div>
      
      <?php 
	  switch($_POST['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料修改成功！！','information');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料刪除成功！！','warning');});</script>\n";
			break;	
		  default:
		  	break;
	  }
	  ?>
       
       
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">次分類設定 - <?php echo $row_RecordTmpListItem['listname']; ?> [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>
      
      
      
      <?php if ($ManageTmpListSelect == '1') {?>
      <?php if ($totalRows_RecordTmpListItem > 0) { // Show if recordset not empty ?>
  <form id="form_TmpItemEdit" name="form_TmpItemEdit" method="POST" action="<?php echo $editFormAction; ?>">    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <tr>
        <td width="100" align="right">編輯欄位：</td>
        <td></td>
      </tr>
      <?php do { ?>
        <tr>
          <td width="100" align="right">項目名稱：</td>
          <td><label for="itemname[]"></label>
            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordTmpListItem['itemname']; ?>" maxlength="30" /> 
            刪除：
            <input name="deltype[]" type="checkbox" id="deltype[]" value="<?php echo $row_RecordTmpListItem['item_id']; ?>" />
            <label for="deltype[]">
              <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordTmpListItem['item_id']; ?>" />
              <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordTmpListItem['list_id']; ?>" />
              <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordTmpListItem['lang']; ?>" />
              <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
            </label><input type="submit" name="button3" id="button3" value="送出修改資料" />
          </td>
        </tr>
        <?php } while ($row_RecordTmpListItem = mysqli_fetch_assoc($RecordTmpListItem)); ?>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form_TmpItemEdit" />
  </form>
  <?php } // Show if recordset not empty ?>
<form id="form_TmpItemAdd" name="form_TmpItemAdd" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right">新增欄位：</td>
                  	<td></td>
                  </tr>
                  
                <tr>
                      <td width="100" align="right">項目名稱：</td>
                      <td><span id="TmpItem">
                        <label for="itemname"></label>
                      <input name="itemname" type="text" id="itemname" maxlength="30" />
                      <span class="textfieldRequiredMsg">欄位不可為空。</span></span>                        
                      <input type="submit" name="button" id="button" value="送出新增資料" />
                      <input type="reset" name="button2" id="button2" value="重置新增資料" />
                  <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
                  <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                  <input name="Operate" type="hidden" id="Operate" value="addSuccess" /></td>
        </tr>
                    
				  <tr>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form_TmpItemAdd" />
      </form>
      <?php } else {?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font color="#FF0000">您未擁有編輯此區塊的權限！！</font></td>
        </tr>
      </table>
      <?php } ?>
      
      
  </div>
</div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("TmpItem", "none", {validateOn:["blur"]});
</script>
<?php
mysqli_free_result($RecordTmpListItem);
?>
