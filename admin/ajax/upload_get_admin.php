<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
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

$colname_RecordAccount = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordAccount = $_SESSION['MM_Username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccount = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($colname_RecordAccount, "text"));
$RecordAccount = mysqli_query($DB_Conn, $query_RecordAccount) or die(mysqli_error($DB_Conn));
$row_RecordAccount = mysqli_fetch_assoc($RecordAccount);
$totalRows_RecordAccount = mysqli_num_rows($RecordAccount);
?>
<?php $wshop = $row_RecordAccount['webname']; /*需先指定變數後面才會讀*/ ?>
<?php $w_userid = $row_RecordAccount['id']; ?>
<?php
mysqli_free_result($RecordAccount);
?>
