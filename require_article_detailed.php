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

$maxRows_RecordArticle = 1;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordArticle = $page * $maxRows_RecordArticle;

$coltype1_RecordArticle = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordArticle = $_GET['type1'];
}
$coluserid_RecordArticle = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticle = $_SESSION['userid'];
}
$colid_RecordArticle = "-1";
if (isset($_GET['id'])) {
  $colid_RecordArticle = $_GET['id'];
}
$coltype2_RecordArticle = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordArticle = $_GET['type2'];
}
$coltype3_RecordArticle = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordArticle = $_GET['type3'];
}
$colnamelang_RecordArticle = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordArticle = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticle = sprintf("SELECT * FROM demo_article WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s && id = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordArticle, "text"),GetSQLValueString($coltype1_RecordArticle, "int"),GetSQLValueString($coltype2_RecordArticle, "int"),GetSQLValueString($coltype3_RecordArticle, "int"),GetSQLValueString($colid_RecordArticle, "int"),GetSQLValueString($coluserid_RecordArticle, "int"));
$query_limit_RecordArticle = sprintf("%s LIMIT %d, %d", $query_RecordArticle, $startRow_RecordArticle, $maxRows_RecordArticle);
$RecordArticle = mysqli_query($DB_Conn, $query_limit_RecordArticle) or die(mysqli_error($DB_Conn));
$row_RecordArticle = mysqli_fetch_assoc($RecordArticle);

if (isset($_GET['totalRows_RecordArticle'])) {
  $totalRows_RecordArticle = $_GET['totalRows_RecordArticle'];
} else {
  $all_RecordArticle = mysqli_query($DB_Conn, $query_RecordArticle);
  $totalRows_RecordArticle = mysqli_num_rows($all_RecordArticle);
}
$totalPages_RecordArticle = ceil($totalRows_RecordArticle/$maxRows_RecordArticle)-1;


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/article_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordArticle);
?>