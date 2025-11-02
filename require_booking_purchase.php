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

$colname_RecordService = "-1";
if (isset($_GET['id'])) {
  $colname_RecordService = $_GET['id'];
}
$coluserid_RecordService = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordService = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordService = sprintf("SELECT * FROM demo_service WHERE id = %s && userid=%s && indicate=1", GetSQLValueString($colname_RecordService, "int"),GetSQLValueString($coluserid_RecordService, "int"));
$RecordService = mysqli_query($DB_Conn, $query_RecordService) or die(mysqli_error($DB_Conn));
$row_RecordService = mysqli_fetch_assoc($RecordService);
$totalRows_RecordService = mysqli_num_rows($RecordService);

$colname_RecordEmployees = "-1";
if (isset($_GET['id'])) {
  $colname_RecordEmployees = $_GET['id'];
}
$coluserid_RecordEmployees = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordEmployees = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployees = sprintf("SELECT * FROM demo_employees WHERE serviceid REGEXP %s && userid=%s", GetSQLValueString($colname_RecordEmployees, "int"),GetSQLValueString($coluserid_RecordEmployees, "int"));
$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/booking_purchase.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordService);
?>