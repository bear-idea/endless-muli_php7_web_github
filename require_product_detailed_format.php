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

$colname_RecordProductFormat = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductFormat = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductFormat = sprintf("SELECT * FROM demo_productformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductFormat, "text"));
$RecordProductFormat = mysqli_query($DB_Conn, $query_RecordProductFormat) or die(mysqli_error($DB_Conn));
$row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat);
$totalRows_RecordProductFormat = mysqli_num_rows($RecordProductFormat);

$colname_RecordProductAjaxFormat = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductAjaxFormat = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductAjaxFormat = sprintf("SELECT * FROM demo_productformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductAjaxFormat, "text"));
$RecordProductAjaxFormat = mysqli_query($DB_Conn, $query_RecordProductAjaxFormat) or die(mysqli_error($DB_Conn));
$row_RecordProductAjaxFormat = mysqli_fetch_assoc($RecordProductAjaxFormat);
$totalRows_RecordProductAjaxFormat = mysqli_num_rows($RecordProductAjaxFormat);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/product_detailed_format.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProductFormat);
?>
<?php //mysqli_free_result($RecordProductAjaxFormat); // 移至 詳細內容頁 ?>

