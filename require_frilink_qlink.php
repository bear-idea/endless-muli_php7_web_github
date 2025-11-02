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

$maxRows_RecordFrilinkQLinkQLink = 10;
$pageQLinkQLink = 0;
if (isset($_GET['pageQLinkQLink'])) {
  $pageQLinkQLink = $_GET['pageQLinkQLink'];
}
$startRow_RecordFrilinkQLinkQLink = $pageQLinkQLink * $maxRows_RecordFrilinkQLinkQLink;

$colnamelang_RecordFrilinkQLinkQLink = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordFrilinkQLinkQLink = $_GET['lang'];
}
$coluserid_RecordFrilinkQLinkQLink = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordFrilinkQLinkQLink = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFrilinkQLinkQLink = sprintf("SELECT * FROM demo_frilink WHERE lang = %s && userid=%s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordFrilinkQLinkQLink, "text"),GetSQLValueString($coluserid_RecordFrilinkQLinkQLink, "int"));
$RecordFrilinkQLinkQLink = mysqli_query($DB_Conn, $query_RecordFrilinkQLinkQLink) or die(mysqli_error($DB_Conn));
$row_RecordFrilinkQLinkQLink = mysqli_fetch_assoc($RecordFrilinkQLinkQLink);
$totalRows_RecordFrilinkQLinkQLink = mysqli_num_rows($RecordFrilinkQLinkQLink);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/frilink_qlink.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordFrilinkQLinkQLink);
?>
