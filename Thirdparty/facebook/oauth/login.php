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
if( isset($_SESSION['success_fb_login_backstage_'.$_SESSION['login_wshop']]) && ( ( isset( $_SESSION[ 'MM_Username_' . $_GET['wshop'] ] ) ) && ( isAuthorized( "", $MM_authorizedUsers, $_SESSION[ 'MM_Username_' . $_GET['wshop'] ], $_SESSION[ 'MM_UserGroup_' . $_GET['wshop'] ] ) ) )){ // check if user is logged in
	header("location:" . $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)); // redirect user to index page
	return false;
}

include 'config.php'; // include app info

$_SESSION['fb_login']= 1; // 使用Fb登入
$_SESSION['login_wshop'] = $_GET['wshop']; // 紀錄目前網站

//echo "https://www.facebook.com/dialog/oauth?client_id=$app_id&scope=$scope&redirect_uri=$redirect_uri";
header("location: https://www.facebook.com/v3.1/dialog/oauth?client_id=$fb_app_id&scope=$scope&redirect_uri=$redirect_uri"); // redirect user to oauth page


?>