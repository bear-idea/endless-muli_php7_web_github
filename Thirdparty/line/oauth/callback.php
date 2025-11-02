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
//$_SESSION['success_fb_login_backstage'];

if( isset($_SESSION['success_line_login_backstage_'.$_SESSION['login_wshop']]) && ( ( isset( $_SESSION[ 'MM_Username_' . $_GET['wshop'] ] ) ) && ( isAuthorized( "", $MM_authorizedUsers, $_SESSION[ 'MM_Username_' . $_GET['wshop'] ], $_SESSION[ 'MM_UserGroup_' . $_GET['wshop'] ] ) ) )){ // check if user is logged in
	header("location:" . $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)); // redirect user to index page
	return false;
}
//echo "0";

include 'config.php';

$code = str_replace("#_=_", "", $_GET['code']); // CODE from code parameter: http://localhost/login-with-facebook/callback.php?code=XXXXXX

$str_url = "https://api.line.me/oauth2/v2.1/token";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_URL,$str_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("grant_type"=>"authorization_code", "code"=>$code, "client_id"=>$line_app_id, "client_secret"=>$line_app_secret, "redirect_uri"=>$redirect_uri)));
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$result = curl_exec($ch);
curl_close($ch);


$json = json_decode($result, true); // convert result to json array

$access_token = $json['access_token']; // user access token

//$_SESSION['access_token_fb_login_backstage'] = $access_token; // save user access token in session

$get_info = "https://api.line.me/v2/profile";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
curl_setopt($ch, CURLOPT_URL,$get_info);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, null);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$content_info = curl_exec($ch);
curl_close($ch);

$info_json = json_decode($content_info, true);

//var_dump($info_json);
$_SESSION['login_wshop'];
$_SESSION["line_id"] = $info_json['userId'];
$_SESSION["line_name"] = $info_json['displayName']; // save user first name in session
//$_SESSION["fb_last_name"] = $info_json['last_name']; // save user last name in session
//$_SESSION["fb_email"] = $info_json['email']; // save user email in session

$_SESSION['success_line_login_backstage_'.$_SESSION['login_wshop']] = 1;

header("location: check.php?wshop=" . $_GET['wshop']);
?>