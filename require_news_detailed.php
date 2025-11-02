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
//if($_GET['news_id'] != ""){$_GET['id'] = $_GET['news_id'];}
$colname_RecordNews = "-1";
if (isset($_GET['id'])) {
  $colname_RecordNews = $_GET['id'];
}
$coluserid_RecordNews = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNews = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE id = %s && userid=%s && indicate=1", GetSQLValueString($colname_RecordNews, "int"),GetSQLValueString($coluserid_RecordNews, "int"));
$RecordNews = mysqli_query($DB_Conn, $query_RecordNews) or die(mysqli_error($DB_Conn));
$row_RecordNews = mysqli_fetch_assoc($RecordNews);
$totalRows_RecordNews = mysqli_num_rows($RecordNews);

$colid_RecordNewsPrev = "-1";
if (isset($_GET['id'])) {
  $colid_RecordNewsPrev = $_GET['id'];
}
$coluserid_RecordNewsPrev = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsPrev = $_SESSION['userid'];
}
$collang_RecordNewsPrev = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsPrev = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsPrev = sprintf("SELECT * FROM demo_news WHERE id<%s && lang=%s && (indicate=1) && userid=%s ORDER BY id DESC LIMIT 1", GetSQLValueString($colid_RecordNewsPrev, "int"),GetSQLValueString($collang_RecordNewsPrev, "text"),GetSQLValueString($coluserid_RecordNewsPrev, "int"));
$RecordNewsPrev = mysqli_query($DB_Conn, $query_RecordNewsPrev) or die(mysqli_error($DB_Conn));
$row_RecordNewsPrev = mysqli_fetch_assoc($RecordNewsPrev);
$totalRows_RecordNewsPrev = mysqli_num_rows($RecordNewsPrev);

$colid_RecordNewsNext = "-1";
if (isset($_GET['id'])) {
  $colid_RecordNewsNext = $_GET['id'];
}
$coluserid_RecordNewsNext = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsNext = $_SESSION['userid'];
}
$collang_RecordNewsNext = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsNext = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsNext = sprintf("SELECT * FROM demo_news WHERE id>%s && lang=%s && (indicate=1) && userid=%s ORDER BY id ASC LIMIT 1", GetSQLValueString($colid_RecordNewsNext, "int"),GetSQLValueString($collang_RecordNewsNext, "text"),GetSQLValueString($coluserid_RecordNewsNext, "int"));
$RecordNewsNext = mysqli_query($DB_Conn, $query_RecordNewsNext) or die(mysqli_error($DB_Conn));
$row_RecordNewsNext = mysqli_fetch_assoc($RecordNewsNext);
$totalRows_RecordNewsNext = mysqli_num_rows($RecordNewsNext);
?>

<!--前後筆資料-->
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
    <?php include($TplPath . "/news_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordNews);

mysqli_free_result($RecordNewsPrev);

mysqli_free_result($RecordNewsNext);
?>
