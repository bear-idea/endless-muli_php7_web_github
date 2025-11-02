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

$maxRows_RecordPublish = 8;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordPublish = $page * $maxRows_RecordPublish;

$colname_RecordPublish = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordPublish = $_GET['searchkey'];
}
$coluserid_RecordPublish = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPublish = $_SESSION['userid'];
}
$collang_RecordPublish = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordPublish = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublish = sprintf("SELECT * FROM demo_publish WHERE ((title LIKE %s) || (type LIKE %s) || (postdate LIKE %s) || (author LIKE %s)) && (indicate=1) && (lang = %s)  && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordPublish . "%", "text"),GetSQLValueString("%" . $colname_RecordPublish . "%", "text"),GetSQLValueString("%" . $colname_RecordPublish . "%", "text"),GetSQLValueString("%" . $colname_RecordPublish . "%", "text"),GetSQLValueString($collang_RecordPublish, "text"),GetSQLValueString($coluserid_RecordPublish, "int"));
$query_limit_RecordPublish = sprintf("%s LIMIT %d, %d", $query_RecordPublish, $startRow_RecordPublish, $maxRows_RecordPublish);
$RecordPublish = mysqli_query($DB_Conn, $query_limit_RecordPublish) or die(mysqli_error($DB_Conn));
$row_RecordPublish = mysqli_fetch_assoc($RecordPublish);

if (isset($_GET['totalRows_RecordPublish'])) {
  $totalRows_RecordPublish = $_GET['totalRows_RecordPublish'];
} else {
  $all_RecordPublish = mysqli_query($DB_Conn, $query_RecordPublish);
  $totalRows_RecordPublish = mysqli_num_rows($all_RecordPublish);
}
$totalPages_RecordPublish = ceil($totalRows_RecordPublish/$maxRows_RecordPublish)-1;

$queryString_RecordPublish = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordPublish") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordPublish = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordPublish = sprintf("&totalRows_RecordPublish=%d%s", $totalRows_RecordPublish, $queryString_RecordPublish);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/publish_home_mobile.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordPublish);
?>
