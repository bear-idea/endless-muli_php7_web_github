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
if( isset($_SESSION['success_fb_login_backstage']) && ( ( isset( $_SESSION[ 'MM_Username' ] ) ) && ( isAuthorized( "", $MM_authorizedUsers, $_SESSION[ 'MM_Username' ], $_SESSION[ 'MM_UserGroup' ] ) ) )){ // check if user is logged in
	if($_GET['key'] != "")
	{
		header("location: qrlogin.php?key=" . $_GET['key']); // redirect user to index page
	}else{
		header("location: ../../../index.php"); // redirect user to index page
	}
	return false;
}

include 'config.php'; // include app info

$_SESSION['fb_login']= 1; // 使用Fb登入

/* QRCODE 掃描判斷 */
if($_GET['key'] != "")
{
	$_SESSION['qr_login'] = $_GET['key'];
}

//echo "https://www.facebook.com/dialog/oauth?client_id=$app_id&scope=$scope&redirect_uri=$redirect_uri";
header("location: https://www.facebook.com/v2.0/dialog/oauth?client_id=$fb_app_id&scope=$scope&redirect_uri=$redirect_uri"); // redirect user to oauth page


?>