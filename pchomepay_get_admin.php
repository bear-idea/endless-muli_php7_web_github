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

$colwebname_RecordAllpayData = "-1";
if (isset($_GET['wshop'])) {
  $colwebname_RecordAllpayData = $_GET['wshop'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAllpayData = sprintf("SELECT pchomepaypaymentAppid, pchomepaypaymentSecret, pchomepaypaymentlinkmod FROM demo_setting_otr WHERE userid = (SELECT id FROM demo_admin WHERE webname=%s)", GetSQLValueString($colwebname_RecordAllpayData, "text"));
$RecordAllpayData = mysqli_query($DB_Conn, $query_RecordAllpayData) or die(mysqli_error($DB_Conn));
$row_RecordAllpayData = mysqli_fetch_assoc($RecordAllpayData);
$totalRows_RecordAllpayData = mysqli_num_rows($RecordAllpayData);
?>
<?php 
$PCHOMEAppid = $row_RecordAllpayData['pchomepaypaymentAppid']; 
$PCHOMESecret = $row_RecordAllpayData['pchomepaypaymentSecret'];
$PCHOMELinkmod = $row_RecordAllpayData['pchomepaypaymentlinkmod'];  //1:正式 0:測試
?>
<?php
mysqli_free_result($RecordAllpayData);
?>
