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

$collang_RecordNewsMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsMultiTopMenu_l1 = $_GET['lang'];
}
$coluserid_RecordNewsMultiTopMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsMultiTopMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsMultiTopMenu_l1 = sprintf("SELECT * FROM demo_newsitem WHERE list_id = 1 && lang = %s && userid = %s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordNewsMultiTopMenu_l1, "text"), GetSQLValueString($coluserid_RecordNewsMultiTopMenu_l1, "int"));
$RecordNewsMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordNewsMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordNewsMultiTopMenu_l1 = mysqli_fetch_assoc($RecordNewsMultiTopMenu_l1);
$totalRows_RecordNewsMultiTopMenu_l1 = mysqli_num_rows($RecordNewsMultiTopMenu_l1);
?>