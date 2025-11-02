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

$maxRows_RecordNews = 8;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordNews = $page * $maxRows_RecordNews;

$colname_RecordNews = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordNews = $_GET['searchkey'];
}
$coluserid_RecordNews = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNews = $_SESSION['userid'];
}
$collang_RecordNews = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNews = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE ((title LIKE %s) || (type LIKE %s) || (postdate LIKE %s) || (author LIKE %s)) && (indicate=1) && (lang = %s)  && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordNews . "%", "text"),GetSQLValueString("%" . $colname_RecordNews . "%", "text"),GetSQLValueString("%" . $colname_RecordNews . "%", "text"),GetSQLValueString("%" . $colname_RecordNews . "%", "text"),GetSQLValueString($collang_RecordNews, "text"),GetSQLValueString($coluserid_RecordNews, "int"));
$query_limit_RecordNews = sprintf("%s LIMIT %d, %d", $query_RecordNews, $startRow_RecordNews, $maxRows_RecordNews);
$RecordNews = mysqli_query($DB_Conn, $query_limit_RecordNews) or die(mysqli_error($DB_Conn));
$row_RecordNews = mysqli_fetch_assoc($RecordNews);

if (isset($_GET['totalRows_RecordNews'])) {
  $totalRows_RecordNews = $_GET['totalRows_RecordNews'];
} else {
  $all_RecordNews = mysqli_query($DB_Conn, $query_RecordNews);
  $totalRows_RecordNews = mysqli_num_rows($all_RecordNews);
}
$totalPages_RecordNews = ceil($totalRows_RecordNews/$maxRows_RecordNews)-1;

$queryString_RecordNews = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordNews") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordNews = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordNews = sprintf("&totalRows_RecordNews=%d%s", $totalRows_RecordNews, $queryString_RecordNews);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/news_home_mobile.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordNews);
?>
