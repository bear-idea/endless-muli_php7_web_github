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

$collang_RecordTimelineDetailed = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTimelineDetailed = $_SESSION['lang'];
}
$coluserid_RecordTimelineDetailed = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTimelineDetailed = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTimelineDetailed = sprintf("SELECT * FROM demo_timeline WHERE lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($collang_RecordTimelineDetailed, "text"),GetSQLValueString($coluserid_RecordTimelineDetailed, "int"));
$RecordTimelineDetailed = mysqli_query($DB_Conn, $query_RecordTimelineDetailed) or die(mysqli_error($DB_Conn));
$row_RecordTimelineDetailed = mysqli_fetch_assoc($RecordTimelineDetailed);
$totalRows_RecordTimelineDetailed = mysqli_num_rows($RecordTimelineDetailed);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/timeline_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordTimelineDetailed);
?>
