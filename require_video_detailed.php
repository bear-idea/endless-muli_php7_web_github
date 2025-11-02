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

$maxRows_RecordVideo = 1;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordVideo = $page * $maxRows_RecordVideo;

$coluserid_RecordVideo = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordVideo = $_SESSION['userid'];
}
$colid_RecordVideo = "-1";
if (isset($_GET['id'])) {
  $colid_RecordVideo = $_GET['id'];
}
$collang_RecordVideo = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordVideo = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordVideo = sprintf("SELECT * FROM demo_video WHERE lang = %s && id = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($collang_RecordVideo, "text"),GetSQLValueString($colid_RecordVideo, "int"),GetSQLValueString($coluserid_RecordVideo, "int"));
$query_limit_RecordVideo = sprintf("%s LIMIT %d, %d", $query_RecordVideo, $startRow_RecordVideo, $maxRows_RecordVideo);
$RecordVideo = mysqli_query($DB_Conn, $query_limit_RecordVideo) or die(mysqli_error($DB_Conn));
$row_RecordVideo = mysqli_fetch_assoc($RecordVideo);

if (isset($_GET['totalRows_RecordVideo'])) {
  $totalRows_RecordVideo = $_GET['totalRows_RecordVideo'];
} else {
  $all_RecordVideo = mysqli_query($DB_Conn, $query_RecordVideo);
  $totalRows_RecordVideo = mysqli_num_rows($all_RecordVideo);
}
$totalPages_RecordVideo = ceil($totalRows_RecordVideo/$maxRows_RecordVideo)-1;


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/video_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordVideo);
?>