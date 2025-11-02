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

$coltype1_RecordDfPageCMenu = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordDfPageCMenu = $_GET['type1'];
}
$coluserid_RecordDfPageCMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfPageCMenu = $_SESSION['userid'];
}
$colaid_RecordDfPageCMenu = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPageCMenu = $_GET['aid'];
}
$coltype2_RecordDfPageCMenu = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordDfPageCMenu = $_GET['type2'];
}
$coltype3_RecordDfPageCMenu = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordDfPageCMenu = $_GET['type3'];
}
$colnamelang_RecordDfPageCMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordDfPageCMenu = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageCMenu = sprintf("SELECT * FROM demo_dfpage WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && aid=%s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordDfPageCMenu, "text"),GetSQLValueString($coltype1_RecordDfPageCMenu, "int"),GetSQLValueString($coltype2_RecordDfPageCMenu, "int"),GetSQLValueString($coltype3_RecordDfPageCMenu, "int"),GetSQLValueString($colaid_RecordDfPageCMenu, "int"),GetSQLValueString($coluserid_RecordDfPageCMenu, "int"));
$RecordDfPageCMenu = mysqli_query($DB_Conn, $query_RecordDfPageCMenu) or die(mysqli_error($DB_Conn));
$row_RecordDfPageCMenu = mysqli_fetch_assoc($RecordDfPageCMenu);
$totalRows_RecordDfPageCMenu = mysqli_num_rows($RecordDfPageCMenu);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/dfpage_cmenu_list.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordDfPageCMenu);
?>
