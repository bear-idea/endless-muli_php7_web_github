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

$colname_RecordDealer = "-1";
if (isset($_GET['username'])) {
  $colname_RecordDealer = $_GET['username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDealer = sprintf("SELECT account FROM demo_dealer WHERE account = %s", GetSQLValueString($colname_RecordDealer, "text"));
$RecordDealer = mysqli_query($DB_Conn, $query_RecordDealer) or die(mysqli_error($DB_Conn));
$row_RecordDealer = mysqli_fetch_assoc($RecordDealer);
$totalRows_RecordDealer = mysqli_num_rows($RecordDealer);
?>
<?php
echo $totalRows_RecordDealer; // 取得抓到的資料筆數
mysqli_free_result($RecordDealer);
?>
