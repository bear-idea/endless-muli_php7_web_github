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

$coltype1_RecordAboutCMenu = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordAboutCMenu = $_GET['type1'];
}
$coluserid_RecordAboutCMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutCMenu = $_SESSION['userid'];
}
$coltype2_RecordAboutCMenu = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordAboutCMenu = $_GET['type2'];
}
$coltype3_RecordAboutCMenu = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordAboutCMenu = $_GET['type3'];
}
$colnamelang_RecordAboutCMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAboutCMenu = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutCMenu = sprintf("SELECT * FROM demo_about WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordAboutCMenu, "text"),GetSQLValueString($coltype1_RecordAboutCMenu, "int"),GetSQLValueString($coltype2_RecordAboutCMenu, "int"),GetSQLValueString($coltype3_RecordAboutCMenu, "int"),GetSQLValueString($coluserid_RecordAboutCMenu, "int"));
$RecordAboutCMenu = mysqli_query($DB_Conn, $query_RecordAboutCMenu) or die(mysqli_error($DB_Conn));
$row_RecordAboutCMenu = mysqli_fetch_assoc($RecordAboutCMenu);
$totalRows_RecordAboutCMenu = mysqli_num_rows($RecordAboutCMenu);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/about_cmenu_list.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAboutCMenu);
?>
