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

$colname_RecordCartMail = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordCartMail = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartMail = sprintf("SELECT id, userid, CartPayMail FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordCartMail, "int"));
$RecordCartMail = mysqli_query($DB_Conn, $query_RecordCartMail) or die(mysqli_error($DB_Conn));
$row_RecordCartMail = mysqli_fetch_assoc($RecordCartMail);
$totalRows_RecordCartMail = mysqli_num_rows($RecordCartMail);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/cart_payok.php"); ?>
<?php } 
mysqli_free_result($RecordCartMail); 
?>