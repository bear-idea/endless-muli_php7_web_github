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

$maxRows_RecordKnowledge = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordKnowledge = $page * $maxRows_RecordKnowledge;

$colname_RecordKnowledge = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordKnowledge = $_GET['searchkey'];
}
$coluserid_RecordKnowledge = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordKnowledge = $_SESSION['userid'];
}
$coltype1_RecordKnowledge = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordKnowledge = $_GET['type1'];
}
$coltype2_RecordKnowledge = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordKnowledge = $_GET['type2'];
}
$coltype3_RecordKnowledge = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordKnowledge = $_GET['type3'];
}
$colnamelang_RecordKnowledge = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordKnowledge = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledge = sprintf("SELECT * FROM demo_knowledge WHERE ((name LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordKnowledge . "%", "text"),GetSQLValueString($colnamelang_RecordKnowledge, "text"),GetSQLValueString($coltype1_RecordKnowledge, "text"),GetSQLValueString($coltype2_RecordKnowledge, "text"),GetSQLValueString($coltype3_RecordKnowledge, "text"),GetSQLValueString($coluserid_RecordKnowledge, "int"));
$query_limit_RecordKnowledge = sprintf("%s LIMIT %d, %d", $query_RecordKnowledge, $startRow_RecordKnowledge, $maxRows_RecordKnowledge);
$RecordKnowledge = mysqli_query($DB_Conn, $query_limit_RecordKnowledge) or die(mysqli_error($DB_Conn));
$row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge);

if (isset($_GET['totalRows_RecordKnowledge'])) {
  $totalRows_RecordKnowledge = $_GET['totalRows_RecordKnowledge'];
} else {
  $all_RecordKnowledge = mysqli_query($DB_Conn, $query_RecordKnowledge);
  $totalRows_RecordKnowledge = mysqli_num_rows($all_RecordKnowledge);
}
$totalPages_RecordKnowledge = ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge)-1;

$queryString_RecordKnowledge = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordKnowledge") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordKnowledge = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordKnowledge = sprintf("&totalRows_RecordKnowledge=%d%s", $totalRows_RecordKnowledge, $queryString_RecordKnowledge);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/knowledge_home_mobile.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordKnowledge);
?>
