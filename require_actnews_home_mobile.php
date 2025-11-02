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
}if (!function_exists("GetSQLValueString")) {
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordActnews = 16;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordActnews = $page * $maxRows_RecordActnews;

$colname_RecordActnews = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordActnews = $_GET['searchkey'];
}
$coluserid_RecordActnews = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActnews = $_SESSION['userid'];
}
$collang_RecordActnews = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActnews = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActnews = sprintf("SELECT * FROM demo_actnews WHERE ((title LIKE %s) || (type LIKE %s) || (postdate LIKE %s) || (author LIKE %s)) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordActnews . "%", "text"),GetSQLValueString("%" . $colname_RecordActnews . "%", "text"),GetSQLValueString("%" . $colname_RecordActnews . "%", "text"),GetSQLValueString("%" . $colname_RecordActnews . "%", "text"),GetSQLValueString($collang_RecordActnews, "text"),GetSQLValueString($coluserid_RecordActnews, "int"));
$query_limit_RecordActnews = sprintf("%s LIMIT %d, %d", $query_RecordActnews, $startRow_RecordActnews, $maxRows_RecordActnews);
$RecordActnews = mysqli_query($DB_Conn, $query_limit_RecordActnews) or die(mysqli_error($DB_Conn));
$row_RecordActnews = mysqli_fetch_assoc($RecordActnews);

if (isset($_GET['totalRows_RecordActnews'])) {
  $totalRows_RecordActnews = $_GET['totalRows_RecordActnews'];
} else {
  $all_RecordActnews = mysqli_query($DB_Conn, $query_RecordActnews);
  $totalRows_RecordActnews = mysqli_num_rows($all_RecordActnews);
}
$totalPages_RecordActnews = ceil($totalRows_RecordActnews/$maxRows_RecordActnews)-1;

$queryString_RecordActnews = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordActnews") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordActnews = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordActnews = sprintf("&totalRows_RecordActnews=%d%s", $totalRows_RecordActnews, $queryString_RecordActnews);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/actnews_home_mobile.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordActnews);
?>
