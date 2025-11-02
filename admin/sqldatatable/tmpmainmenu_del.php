<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  
  /* 先取得資料庫是否有圖 */
  $colname_RecordTmpmainmenuGet = "-1";
  if (isset($_GET['id_del'])) {
	$colname_RecordTmpmainmenuGet = $_GET['id_del'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordTmpmainmenuGet = sprintf("SELECT * FROM demo_tmpmainmenu WHERE id = %s", GetSQLValueString($colname_RecordTmpmainmenuGet, "int"));
  $RecordTmpmainmenuGet = mysqli_query($DB_Conn, $query_RecordTmpmainmenuGet) or die(mysqli_error($DB_Conn));
  $row_RecordTmpmainmenuGet = mysqli_fetch_assoc($RecordTmpmainmenuGet);
  $totalRows_RecordTmpmainmenuGet = mysqli_num_rows($RecordTmpmainmenuGet);
  
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpmainmenu/' . $row_RecordTmpmainmenuGet['tmp_mainmenu_l_img']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpmainmenu/' . $row_RecordTmpmainmenuGet['tmp_mainmenu_r_img']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpmainmenu/' . $row_RecordTmpmainmenuGet['tmp_mainmenu_o_img']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpmainmenu/' . $row_RecordTmpmainmenuGet['tmp_mainmenu_img']);
  @unlink('../' . $SiteImgFilePathAdmin . $wshop . '/image/tmpmainmenu/' . $row_RecordTmpmainmenuGet['tmp_mainmenu_hover_img']);
  
  $deleteSQL = sprintf("DELETE FROM demo_tmpmainmenu WHERE userid=%s && id=%s",
                       GetSQLValueString($w_userid, "int"),
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
}

?>