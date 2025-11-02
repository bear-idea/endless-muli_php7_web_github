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

$maxRows_RecordPartner = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordPartner = $page * $maxRows_RecordPartner;

$colname_RecordPartner = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordPartner = $_GET['searchkey'];
}
$coluserid_RecordPartner = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPartner = $_SESSION['userid'];
}
$colnamelang_RecordPartner = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordPartner = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPartner = sprintf("SELECT * FROM demo_partner WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY rand()", GetSQLValueString("%" . $colname_RecordPartner . "%", "text"),GetSQLValueString("%" . $colname_RecordPartner . "%", "text"),GetSQLValueString($colnamelang_RecordPartner, "text"),GetSQLValueString($coluserid_RecordPartner, "int"));
$query_limit_RecordPartner = sprintf("%s LIMIT %d, %d", $query_RecordPartner, $startRow_RecordPartner, $maxRows_RecordPartner);
$RecordPartner = mysqli_query($DB_Conn, $query_limit_RecordPartner) or die(mysqli_error($DB_Conn));
$row_RecordPartner = mysqli_fetch_assoc($RecordPartner);

if (isset($_GET['totalRows_RecordPartner'])) {
  $totalRows_RecordPartner = $_GET['totalRows_RecordPartner'];
} else {
  $all_RecordPartner = mysqli_query($DB_Conn, $query_RecordPartner);
  $totalRows_RecordPartner = mysqli_num_rows($all_RecordPartner);
}
$totalPages_RecordPartner = ceil($totalRows_RecordPartner/$maxRows_RecordPartner)-1;

$queryString_RecordPartner = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordPartner") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordPartner = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordPartner = sprintf("&totalRows_RecordPartner=%d%s", $totalRows_RecordPartner, $queryString_RecordPartner);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/partner_home.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordPartner);
?>
