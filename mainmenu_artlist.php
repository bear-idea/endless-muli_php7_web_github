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
$collang_RecordArtlistMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordArtlistMultiTopMenu_l1 = $_GET['lang'];
}
$coluserid_RecordArtlistMultiTopMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArtlistMultiTopMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArtlistMultiTopMenu_l1 = sprintf("SELECT * FROM demo_artlistitem WHERE list_id = 1 && lang = %s && userid=%s ORDER BY item_id DESC", GetSQLValueString($collang_RecordArtlistMultiTopMenu_l1, "text"),GetSQLValueString($coluserid_RecordArtlistMultiTopMenu_l1, "int"));
$RecordArtlistMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordArtlistMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordArtlistMultiTopMenu_l1 = mysqli_fetch_assoc($RecordArtlistMultiTopMenu_l1);
$totalRows_RecordArtlistMultiTopMenu_l1 = mysqli_num_rows($RecordArtlistMultiTopMenu_l1);
?>