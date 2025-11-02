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

$maxRows_RecordService = 25;
$pageNum_RecordService = 0;
if (isset($_GET['pageNum_RecordService'])) {
  $pageNum_RecordService = $_GET['pageNum_RecordService'];
}
$startRow_RecordService = $pageNum_RecordService * $maxRows_RecordService;

$colnamelang_RecordService = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordService = $_GET['lang'];
}
$coluserid_RecordService = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordService = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordService = sprintf("SELECT * FROM demo_service WHERE lang = %s && indicate = 1 && userid=%s", GetSQLValueString($colnamelang_RecordService, "text"),GetSQLValueString($coluserid_RecordService, "int"));
$query_limit_RecordService = sprintf("%s LIMIT %d, %d", $query_RecordService, $startRow_RecordService, $maxRows_RecordService);
$RecordService = mysqli_query($DB_Conn, $query_limit_RecordService) or die(mysqli_error($DB_Conn));
$row_RecordService = mysqli_fetch_assoc($RecordService);

if (isset($_GET['totalRows_RecordService'])) {
  $totalRows_RecordService = $_GET['totalRows_RecordService'];
} else {
  $all_RecordService = mysqli_query($DB_Conn, $query_RecordService);
  $totalRows_RecordService = mysqli_num_rows($all_RecordService);
}
$totalPages_RecordService = ceil($totalRows_RecordService/$maxRows_RecordService)-1;


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/booking_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordService);
?>