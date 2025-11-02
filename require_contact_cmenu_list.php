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

$coltype1_RecordContactCMenu = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordContactCMenu = $_GET['type1'];
}
$coluserid_RecordContactCMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordContactCMenu = $_SESSION['userid'];
}
$coltype2_RecordContactCMenu = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordContactCMenu = $_GET['type2'];
}
$coltype3_RecordContactCMenu = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordContactCMenu = $_GET['type3'];
}
$colnamelang_RecordContactCMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordContactCMenu = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactCMenu = sprintf("SELECT * FROM demo_contact WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordContactCMenu, "text"),GetSQLValueString($coltype1_RecordContactCMenu, "int"),GetSQLValueString($coltype2_RecordContactCMenu, "int"),GetSQLValueString($coltype3_RecordContactCMenu, "int"),GetSQLValueString($coluserid_RecordContactCMenu, "int"));
$RecordContactCMenu = mysqli_query($DB_Conn, $query_RecordContactCMenu) or die(mysqli_error($DB_Conn));
$row_RecordContactCMenu = mysqli_fetch_assoc($RecordContactCMenu);
$totalRows_RecordContactCMenu = mysqli_num_rows($RecordContactCMenu);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/contact_cmenu_list.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordContactCMenu);
?>
