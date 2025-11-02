<?php require_once('../Connections/DB_Conn.php'); ?>
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

$colname_RecordTmpAgree = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordTmpAgree = $_SESSION['MM_Username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpAgree = sprintf("SELECT id,account,tmpagree FROM demo_admin WHERE account = %s", GetSQLValueString($colname_RecordTmpAgree, "text"));
$RecordTmpAgree = mysqli_query($DB_Conn, $query_RecordTmpAgree) or die(mysqli_error($DB_Conn));
$row_RecordTmpAgree = mysqli_fetch_assoc($RecordTmpAgree);
$totalRows_RecordTmpAgree = mysqli_num_rows($RecordTmpAgree);

mysqli_free_result($RecordTmpAgree);
?>