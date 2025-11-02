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

$maxRows_RecordProductPost = 10;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordProductPost = $pagePost * $maxRows_RecordProductPost;

$colname_RecordProductPost = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductPost = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPost = sprintf("SELECT * FROM demo_productpost WHERE pid = %s ORDER BY postdate DESC", GetSQLValueString($colname_RecordProductPost, "int"));
$query_limit_RecordProductPost = sprintf("%s LIMIT %d, %d", $query_RecordProductPost, $startRow_RecordProductPost, $maxRows_RecordProductPost);
$RecordProductPost = mysqli_query($DB_Conn, $query_limit_RecordProductPost) or die(mysqli_error($DB_Conn));
$row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost);
if (isset($_GET['totalRows_RecordProductPost'])) {
  $totalRows_RecordProductPost = $_GET['totalRows_RecordProductPost'];
} else {
  $all_RecordProductPost = mysqli_query($DB_Conn, $query_RecordProductPost);
  $totalRows_RecordProductPost = mysqli_num_rows($all_RecordProductPost);
}
$totalPages_RecordProductPost = ceil($totalRows_RecordProductPost/$maxRows_RecordProductPost)-1;

$queryString_RecordProductPost = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pagePost") == false && 
        stristr($param, "totalRows_RecordProductPost") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProductPost = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProductPost = sprintf("&totalRows_RecordProductPost=%d%s", $totalRows_RecordProductPost, $queryString_RecordProductPost);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/product_post.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProductPost);
?>
