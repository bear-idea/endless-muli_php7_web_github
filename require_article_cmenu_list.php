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

$coltype1_RecordArticleCMenu = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordArticleCMenu = $_GET['type1'];
}
$coluserid_RecordArticleCMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleCMenu = $_SESSION['userid'];
}
$coltype2_RecordArticleCMenu = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordArticleCMenu = $_GET['type2'];
}
$coltype3_RecordArticleCMenu = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordArticleCMenu = $_GET['type3'];
}
$colnamelang_RecordArticleCMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordArticleCMenu = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleCMenu = sprintf("SELECT * FROM demo_article WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordArticleCMenu, "text"),GetSQLValueString($coltype1_RecordArticleCMenu, "int"),GetSQLValueString($coltype2_RecordArticleCMenu, "int"),GetSQLValueString($coltype3_RecordArticleCMenu, "int"),GetSQLValueString($coluserid_RecordArticleCMenu, "int"));
$RecordArticleCMenu = mysqli_query($DB_Conn, $query_RecordArticleCMenu) or die(mysqli_error($DB_Conn));
$row_RecordArticleCMenu = mysqli_fetch_assoc($RecordArticleCMenu);
$totalRows_RecordArticleCMenu = mysqli_num_rows($RecordArticleCMenu);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/article_cmenu_list.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordArticleCMenu);
?>
