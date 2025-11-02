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

$maxRows_RecordAbout = 1;
$pageNum_RecordAbout = 0;
if (isset($_GET['pageNum_RecordAbout'])) {
  $pageNum_RecordAbout = $_GET['pageNum_RecordAbout'];
}
$startRow_RecordAbout = $pageNum_RecordAbout * $maxRows_RecordAbout;

$colnamelang_RecordAbout = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAbout = $_GET['lang'];
}
$coluserid_RecordAbout = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAbout = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAbout = sprintf("SELECT * FROM demo_about WHERE lang = %s && home = 1 && indicate = 1 && userid=%s", GetSQLValueString($colnamelang_RecordAbout, "text"),GetSQLValueString($coluserid_RecordAbout, "int"));
$query_limit_RecordAbout = sprintf("%s LIMIT %d, %d", $query_RecordAbout, $startRow_RecordAbout, $maxRows_RecordAbout);
$RecordAbout = mysqli_query($DB_Conn, $query_limit_RecordAbout) or die(mysqli_error($DB_Conn));
$row_RecordAbout = mysqli_fetch_assoc($RecordAbout);

if (isset($_GET['totalRows_RecordAbout'])) {
  $totalRows_RecordAbout = $_GET['totalRows_RecordAbout'];
} else {
  $all_RecordAbout = mysqli_query($DB_Conn, $query_RecordAbout);
  $totalRows_RecordAbout = mysqli_num_rows($all_RecordAbout);
}
$totalPages_RecordAbout = ceil($totalRows_RecordAbout/$maxRows_RecordAbout)-1;
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/about_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAbout);
?>