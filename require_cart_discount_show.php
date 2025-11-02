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

$colname_RecordDiscountShow = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDiscountShow = $_GET['lang'];
}
$colaid_RecordDiscountShow = "-1";
if (isset($row_RecordCartlist['discountid'])) {
  $colaid_RecordDiscountShow = $row_RecordCartlist['discountid'];
}
$coluserid_RecordDiscountShow = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDiscountShow = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscountShow = sprintf("SELECT * FROM demo_productdiscount WHERE lang=%s && id = %s && userid=%s && (DATEDIFF(enddate,NOW()) >= 0 || limitdate = 0) && indicate=1 ORDER BY id", GetSQLValueString($colname_RecordDiscountShow, "text"),GetSQLValueString($colaid_RecordDiscountShow, "int"),GetSQLValueString($coluserid_RecordDiscountShow, "int"));
$RecordDiscountShow = mysqli_query($DB_Conn, $query_RecordDiscountShow) or die(mysqli_error($DB_Conn));
$row_RecordDiscountShow = mysqli_fetch_assoc($RecordDiscountShow);
$totalRows_RecordDiscountShow = mysqli_num_rows($RecordDiscountShow);
?>
<?php
mysqli_free_result($RecordDiscountShow);
?>
