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

$maxRows_RecordLetters = 6;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordLetters = $page * $maxRows_RecordLetters;

$colname_RecordLetters = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordLetters = $_GET['searchkey'];
}
$coluserid_RecordLetters = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordLetters = $_SESSION['userid'];
}
$collang_RecordLetters = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordLetters = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLetters = sprintf("SELECT * FROM demo_letters WHERE ((title LIKE %s) || (type LIKE %s) || (postdate LIKE %s) || (author LIKE %s)) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordLetters . "%", "text"),GetSQLValueString("%" . $colname_RecordLetters . "%", "text"),GetSQLValueString("%" . $colname_RecordLetters . "%", "text"),GetSQLValueString("%" . $colname_RecordLetters . "%", "text"),GetSQLValueString($collang_RecordLetters, "text"),GetSQLValueString($coluserid_RecordLetters, "int"));
$query_limit_RecordLetters = sprintf("%s LIMIT %d, %d", $query_RecordLetters, $startRow_RecordLetters, $maxRows_RecordLetters);
$RecordLetters = mysqli_query($DB_Conn, $query_limit_RecordLetters) or die(mysqli_error($DB_Conn));
$row_RecordLetters = mysqli_fetch_assoc($RecordLetters);

if (isset($_GET['totalRows_RecordLetters'])) {
  $totalRows_RecordLetters = $_GET['totalRows_RecordLetters'];
} else {
  $all_RecordLetters = mysqli_query($DB_Conn, $query_RecordLetters);
  $totalRows_RecordLetters = mysqli_num_rows($all_RecordLetters);
}
$totalPages_RecordLetters = ceil($totalRows_RecordLetters/$maxRows_RecordLetters)-1;

$queryString_RecordLetters = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordLetters") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordLetters = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordLetters = sprintf("&totalRows_RecordLetters=%d%s", $totalRows_RecordLetters, $queryString_RecordLetters);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/letters_home.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordLetters);
?>
