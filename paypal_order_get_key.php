<?php require_once('Connections/DB_Conn.php'); ?>
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

$colname_RecordPaypalAccount = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordPaypalAccount = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPaypalAccount = sprintf("SELECT * FROM demo_setting_otr WHERE userid = %s", GetSQLValueString($colname_RecordPaypalAccount, "int"));
$RecordPaypalAccount = mysqli_query($DB_Conn, $query_RecordPaypalAccount) or die(mysqli_error($DB_Conn));
$row_RecordPaypalAccount = mysqli_fetch_assoc($RecordPaypalAccount);
$totalRows_RecordPaypalAccount = mysqli_num_rows($RecordPaypalAccount);
?>
<?php $paypalpaymentApiname = $row_RecordPaypalAccount['paypalpaymentApiname']; ?>
<?php $paypalpaymentApipsw = $row_RecordPaypalAccount['paypalpaymentApipsw']; ?>
<?php $paypalpaymentSignature = $row_RecordPaypalAccount['paypalpaymentSignature']; ?>
<?php
mysqli_free_result($RecordPaypalAccount);
?>
