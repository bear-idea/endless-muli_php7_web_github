<?php require_once('../../../../Connections/DB_Conn.php'); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
$w_userid = $_SESSION['w_userid'];
?>
<?php //require_once("../../../inc_permission.php"); ?>
<?php

session_start();

// Script By Qassim Hassan, wp-time.com
if( isset($_SESSION['success_line_login_backstage']) && ( ( isset( $_SESSION[ 'MM_Username' ] ) ) && ( isAuthorized( "", $MM_authorizedUsers, $_SESSION[ 'MM_Username' ], $_SESSION[ 'MM_UserGroup' ] ) ) )){ // check if user is logged in
    /* QRCODE 掃描判斷 */
	if($_GET['key'] != "")
	{
		header("location: qrlogin.php?key=" . $_GET['key']); // redirect user to index page
	}else{
		header("location: ../../../index.php"); // redirect user to index page
	}
	
	return false;
}

include 'config.php'; // include app info

$_SESSION['line_login']= 1; // 使用LINE登入

/* QRCODE 掃描判斷 */
if($_GET['key'] != "")
{
	$_SESSION['qr_login'] = $_GET['key'];
}

$state=substr(md5(rand()),0,6);

// http://localhost/endless-muli_php7/admin/Thirdparty/line/oauth/login.php
header("location: https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=12345abcde&scope=$scope");
//header("location: https://access.line.me/dialog/oauth/weblogin?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=$state");  // redirect user to oauth page
//echo "https://access.line.me/dialog/oauth/weblogin?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=123abc";
//echo "https://access.line.me/dialog/oauth/weblogin?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=$state";

?>