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

$colname_RecordCatalog = "-1";
if (isset($_GET['id'])) {
  $colname_RecordCatalog = $_GET['id'];
}
$coluserid_RecordCatalog = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCatalog = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalog = sprintf("SELECT * FROM demo_catalog WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordCatalog, "int"),GetSQLValueString($coluserid_RecordCatalog, "int"));
$RecordCatalog = mysqli_query($DB_Conn, $query_RecordCatalog) or die(mysqli_error($DB_Conn));
$row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog);
$totalRows_RecordCatalog = mysqli_num_rows($RecordCatalog);
?>

<!--前後筆資料-->
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/catalog_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordCatalog);
?>
