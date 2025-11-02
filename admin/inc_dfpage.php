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

$colname_RecordTpt = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordTpt = $_GET['aid'];
}
$collang_RecordTpt = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTpt = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTpt = sprintf("SELECT title FROM demo_dftype WHERE id = %s && lang=%s", GetSQLValueString($colname_RecordTpt, "int"),GetSQLValueString($collang_RecordTpt, "text"));
$RecordTpt = mysqli_query($DB_Conn, $query_RecordTpt) or die(mysqli_error($DB_Conn));
$row_RecordTpt = mysqli_fetch_assoc($RecordTpt);
$totalRows_RecordTpt = mysqli_num_rows($RecordTpt);
?>
<?php 
mysqli_free_result($RecordTpt);
?>