<?php require_once('../../Connections/DB_Conn.php'); ?>
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
?>
<?php
$_POST['id'] = $_POST['name'] . "_" . $_POST['pk'];

$id = $_POST['id'];
$value = trim(htmlspecialchars($_POST['value']));

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
list($field, $id) = explode('_', $id);

//mysql query
$updateSQL = sprintf("UPDATE demo_contact SET $field='$value' WHERE id='$id'");
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//將值傳回前端
if($field == 'type')
{
	/*由於儲存在MYSQL中資料為數字分類因此在顯示時要將之轉換為中文*/
	/* 取得文章管理資訊 */
	$collang_RecordContact = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordContact = $_SESSION['lang'];
	}
	$coltype_RecordContact = "-1";
	if (isset($value)) {
	  $coltype_RecordContact = $value;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordContact = sprintf("SELECT demo_contact.title, demo_contact.menuname, demo_contact.indicate, demo_contact.type, demo_contact.id, demo_contact.sortid, demo_contactitem.itemname, demo_contact.lang FROM demo_contact LEFT OUTER JOIN demo_contactitem ON demo_contact.type = demo_contactitem.item_id WHERE demo_contact.lang = %s && (demo_contact.type = %s) ORDER BY demo_contactitem.item_id ASC, demo_contact.sortid ASC", GetSQLValueString($collang_RecordContact, "text"),GetSQLValueString($coltype_RecordContact, "int"));
	$RecordContact = mysqli_query($DB_Conn, $query_RecordContact) or die(mysqli_error($DB_Conn));
	$row_RecordContact = mysqli_fetch_assoc($RecordContact);
	$totalRows_RecordContact = mysqli_num_rows($RecordContact);

	echo $row_RecordContact['itemname'];
	mysqli_free_result($RecordContact);
}else{
	echo $value;
}
?>
