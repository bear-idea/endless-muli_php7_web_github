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

$colname_RecordDfTypeHomeSelect = $_SESSION['lang'];
if (isset($_GET['lang'])) {
  $colname_RecordDfTypeHomeSelect = $_GET['lang'];
}
$coluserid_RecordDfTypeHomeSelect = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfTypeHomeSelect = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfTypeHomeSelect = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && indicate=1 && home=1 && userid=%s", GetSQLValueString($colname_RecordDfTypeHomeSelect, "text"),GetSQLValueString($coluserid_RecordDfTypeHomeSelect, "int"));
$RecordDfTypeHomeSelect = mysqli_query($DB_Conn, $query_RecordDfTypeHomeSelect) or die(mysqli_error($DB_Conn));
$row_RecordDfTypeHomeSelect = mysqli_fetch_assoc($RecordDfTypeHomeSelect);
$totalRows_RecordDfTypeHomeSelect = mysqli_num_rows($RecordDfTypeHomeSelect);
?>
<?php $HomeType = $row_RecordDfTypeHomeSelect['typemenu']; ?>
<?php $HomeTypeID = $row_RecordDfTypeHomeSelect['id']; ?>
<?php
mysqli_free_result($RecordDfTypeHomeSelect);
?>
