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

$maxRows_RecordDfPage = 1;
$pageNum_RecordDfPage = 0;
if (isset($_GET['pageNum_RecordDfPage'])) {
  $pageNum_RecordDfPage = $_GET['pageNum_RecordDfPage'];
}
$startRow_RecordDfPage = $pageNum_RecordDfPage * $maxRows_RecordDfPage;

$colname_RecordDfPage = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordDfPage = $_GET['searchkey'];
}
$colaid_RecordDfPage = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPage = $_GET['aid'];
}
$coltype1_RecordDfPage = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordDfPage = $_GET['type1'];
}
$coluserid_RecordDfPage = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfPage = $_SESSION['userid'];
}
$coltype2_RecordDfPage = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordDfPage = $_GET['type2'];
}
$coltype3_RecordDfPage = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordDfPage = $_GET['type3'];
}
$colnamelang_RecordDfPage = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordDfPage = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPage = sprintf("SELECT * FROM demo_dfpage WHERE ((title LIKE %s)) && lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && aid=%s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordDfPage . "%", "text"),GetSQLValueString($colnamelang_RecordDfPage, "text"),GetSQLValueString($coltype1_RecordDfPage, "int"),GetSQLValueString($coltype2_RecordDfPage, "int"),GetSQLValueString($coltype3_RecordDfPage, "int"),GetSQLValueString($colaid_RecordDfPage, "int"),GetSQLValueString($coluserid_RecordDfPage, "int"));
$query_limit_RecordDfPage = sprintf("%s LIMIT %d, %d", $query_RecordDfPage, $startRow_RecordDfPage, $maxRows_RecordDfPage);
$RecordDfPage = mysqli_query($DB_Conn, $query_limit_RecordDfPage) or die(mysqli_error($DB_Conn));
$row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage);

if (isset($_GET['totalRows_RecordDfPage'])) {
  $totalRows_RecordDfPage = $_GET['totalRows_RecordDfPage'];
} else {
  $all_RecordDfPage = mysqli_query($DB_Conn, $query_RecordDfPage);
  $totalRows_RecordDfPage = mysqli_num_rows($all_RecordDfPage);
}
$totalPages_RecordDfPage = ceil($totalRows_RecordDfPage/$maxRows_RecordDfPage)-1;


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/dfpage_type.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordDfPage);
?>