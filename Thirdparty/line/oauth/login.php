<?php require_once('../../../Connections/DB_Conn.php'); ?>
<?php require_once("../../../inc/inc_function.php"); ?>
<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
$MM_authorizedUsers = "Wshop_Member";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized( $strUsers, $strGroups, $UserName, $UserGroup ) {
	// For security, start by assuming the visitor is NOT authorized. 
	$isValid = False;

	// When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
	// Therefore, we know that a user is NOT logged in if that Session variable is blank. 
	if ( !empty( $UserName ) ) {
		// Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
		// Parse the strings into arrays. 
		$arrUsers = Explode( ",", $strUsers );
		$arrGroups = Explode( ",", $strGroups );
		if ( in_array( $UserName, $arrUsers ) ) {
			$isValid = true;
		}
		// Or, you may restrict access to only certain users based on their username. 
		if ( in_array( $UserGroup, $arrGroups ) ) {
			$isValid = true;
		}
		if ( ( $strUsers == "" ) && false ) {
			$isValid = true;
		}
	}
	return $isValid;
}
?>
<?php

session_start();

// Script By Qassim Hassan, wp-time.com
if( isset($_SESSION['success_line_login_backstage']) && ( ( isset( $_SESSION[ 'MM_Username_' . $_GET['wshop'] ] ) ) && ( isAuthorized( "", $MM_authorizedUsers, $_SESSION[ 'MM_Username_' . $_GET['wshop'] ], $_SESSION[ 'MM_UserGroup_' . $_GET['wshop'] ] ) ) )){ // check if user is logged in
	header("location:" . $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)); // redirect user to index page
	return false;
}

include 'config.php'; // include app info

$_SESSION['line_login']= 1; // 使用LINE登入
$_SESSION['login_wshop'] = $_GET['wshop']; // 紀錄目前網站

$state=substr(md5(rand()),0,6);

// http://localhost/endless-muli_php7/admin/Thirdparty/line/oauth/login.php
header("location: https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=$state&scope=$scope");
//header("location: https://access.line.me/dialog/oauth/weblogin?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=$state");  // redirect user to oauth page
//echo "https://access.line.me/dialog/oauth/weblogin?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=123abc";
//echo "https://access.line.me/dialog/oauth/weblogin?response_type=code&client_id=$line_app_id&redirect_uri=$redirect_uri&state=$state";

?>