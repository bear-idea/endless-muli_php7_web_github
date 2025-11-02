<?php require_once('../../../Connections/DB_Conn.php'); ?>
<?php require_once("../../../inc/inc_function.php"); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
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

$colname_RecordThirdparty = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordThirdparty = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordThirdparty = sprintf("SELECT LINELoginAppID, LINELoginSecret FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordThirdparty, "int"));
$RecordThirdparty = mysqli_query($DB_Conn, $query_RecordThirdparty) or die(mysqli_error($DB_Conn));
$row_RecordThirdparty = mysqli_fetch_assoc($RecordThirdparty);
$totalRows_RecordThirdparty = mysqli_num_rows($RecordThirdparty);
?>
<?php

// Script By Qassim Hassan, wp-time.com

// go to https://developers.facebook.com and create a new app
if($row_RecordThirdparty['LINELoginAppID'] != "" && $row_RecordThirdparty['LINELoginSecret'] != ""){
	$line_app_id = $row_RecordThirdparty['LINELoginAppID'];
	$line_app_secret = $row_RecordThirdparty['LINELoginSecret'];
}

$SiteFileUrlName = pathinfo($_SERVER['PHP_SELF']); // 網站放置位置 echo $SiteFileUrlName['dirname']
$SiteFileUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $SiteFileUrlName['dirname']; // 網站放置位置

$redirect_uri = $SiteFileUrl  . "/callback.php?wshop=" . $_GET['wshop']; // enter your redirect url (Site URL from app settings)

$scope = "openid%20profile"; // we need scope of public_profile and email, but you can change it for another result, check list of scopes: https://developers.facebook.com/docs/facebook-login/permissions
?>