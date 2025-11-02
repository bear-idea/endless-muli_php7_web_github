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

$maxRows_RecordModlinkQLinkQLink = 10;
$pageNum_RecordModlinkQLinkQLink = 0;
if (isset($_GET['pageNum_RecordModlinkQLinkQLink'])) {
  $pageNum_RecordModlinkQLinkQLink = $_GET['pageNum_RecordModlinkQLinkQLink'];
}
$startRow_RecordModlinkQLinkQLink = $pageNum_RecordModlinkQLinkQLink * $maxRows_RecordModlinkQLinkQLink;

$colnamelang_RecordModlinkQLinkQLink = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordModlinkQLinkQLink = $_GET['lang'];
}
$coluserid_RecordModlinkQLinkQLink = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordModlinkQLinkQLink = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkQLinkQLink = sprintf("SELECT * FROM demo_modlink WHERE lang = %s && userid=%s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordModlinkQLinkQLink, "text"),GetSQLValueString($coluserid_RecordModlinkQLinkQLink, "int"));
$query_limit_RecordModlinkQLinkQLink = sprintf("%s LIMIT %d, %d", $query_RecordModlinkQLinkQLink, $startRow_RecordModlinkQLinkQLink, $maxRows_RecordModlinkQLinkQLink);
$RecordModlinkQLinkQLink = mysqli_query($DB_Conn, $query_limit_RecordModlinkQLinkQLink) or die(mysqli_error($DB_Conn));
$row_RecordModlinkQLinkQLink = mysqli_fetch_assoc($RecordModlinkQLinkQLink);

if (isset($_GET['totalRows_RecordModlinkQLinkQLink'])) {
  $totalRows_RecordModlinkQLinkQLink = $_GET['totalRows_RecordModlinkQLinkQLink'];
} else {
  $all_RecordModlinkQLinkQLink = mysqli_query($DB_Conn, $query_RecordModlinkQLinkQLink);
  $totalRows_RecordModlinkQLinkQLink = mysqli_num_rows($all_RecordModlinkQLinkQLink);
}
$totalPages_RecordModlinkQLinkQLink = ceil($totalRows_RecordModlinkQLinkQLink/$maxRows_RecordModlinkQLinkQLink)-1;
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/modlink_qlink.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordModlinkQLinkQLink);
?>
