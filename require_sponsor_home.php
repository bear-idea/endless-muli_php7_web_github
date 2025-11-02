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


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordSponsor = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordSponsor = $page * $maxRows_RecordSponsor;

$colname_RecordSponsor = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordSponsor = $_GET['searchkey'];
}
$coluserid_RecordSponsor = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSponsor = $_SESSION['userid'];
}
$colnamelang_RecordSponsor = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordSponsor = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSponsor = sprintf("SELECT * FROM demo_sponsor WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordSponsor . "%", "text"),GetSQLValueString("%" . $colname_RecordSponsor . "%", "text"),GetSQLValueString($colnamelang_RecordSponsor, "text"),GetSQLValueString($coluserid_RecordSponsor, "int"));
$query_limit_RecordSponsor = sprintf("%s LIMIT %d, %d", $query_RecordSponsor, $startRow_RecordSponsor, $maxRows_RecordSponsor);
$RecordSponsor = mysqli_query($DB_Conn, $query_limit_RecordSponsor) or die(mysqli_error($DB_Conn));
$row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor);

if (isset($_GET['totalRows_RecordSponsor'])) {
  $totalRows_RecordSponsor = $_GET['totalRows_RecordSponsor'];
} else {
  $all_RecordSponsor = mysqli_query($DB_Conn, $query_RecordSponsor);
  $totalRows_RecordSponsor = mysqli_num_rows($all_RecordSponsor);
}
$totalPages_RecordSponsor = ceil($totalRows_RecordSponsor/$maxRows_RecordSponsor)-1;

$queryString_RecordSponsor = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordSponsor") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSponsor = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSponsor = sprintf("&totalRows_RecordSponsor=%d%s", $totalRows_RecordSponsor, $queryString_RecordSponsor);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/sponsor_home.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordSponsor);
?>
