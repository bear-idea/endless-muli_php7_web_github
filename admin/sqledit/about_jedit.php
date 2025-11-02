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
$updateSQL = sprintf("UPDATE demo_about SET $field='$value' WHERE id='$id'");
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//將值傳回前端
if($field == 'type')
{
	/*由於儲存在MYSQL中資料為數字分類因此在顯示時要將之轉換為中文*/
	/* 取得文章管理資訊 */
	$collang_RecordAbout = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordAbout = $_SESSION['lang'];
	}
	$coltype_RecordAbout = "-1";
	if (isset($value)) {
	  $coltype_RecordAbout = $value;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAbout = sprintf("SELECT demo_about.title, demo_about.menuname, demo_about.indicate, demo_about.type, demo_about.id, demo_about.sortid, demo_aboutitem.itemname, demo_about.lang FROM demo_about LEFT OUTER JOIN demo_aboutitem ON demo_about.type = demo_aboutitem.item_id WHERE demo_about.lang = %s && (demo_about.type = %s) ORDER BY demo_aboutitem.item_id ASC, demo_about.sortid ASC", GetSQLValueString($collang_RecordAbout, "text"),GetSQLValueString($coltype_RecordAbout, "int"));
	$RecordAbout = mysqli_query($DB_Conn, $query_RecordAbout) or die(mysqli_error($DB_Conn));
	$row_RecordAbout = mysqli_fetch_assoc($RecordAbout);
	$totalRows_RecordAbout = mysqli_num_rows($RecordAbout);

	echo $row_RecordAbout['itemname'];
	mysqli_free_result($RecordAbout);
}else{
	echo $value;
}
?>
