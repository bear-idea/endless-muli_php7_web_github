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
//$_SESSION['success_fb_login_backstage'];

if( isset($_SESSION['success_fb_login_backstage']) && ( ( isset( $_SESSION[ 'MM_Username' ] ) ) && ( isAuthorized( "", $MM_authorizedUsers, $_SESSION[ 'MM_Username' ], $_SESSION[ 'MM_UserGroup' ] ) ) )){ // check if user is logged in
	header("location: ../../../index.php"); // redirect user to index page
	return false;
}
//echo "0";

include 'config.php';

$code = str_replace("#_=_", "", $_GET['code']); // CODE from code parameter: http://localhost/login-with-facebook/callback.php?code=XXXXXX

$str_url = "https://graph.facebook.com/oauth/access_token?client_id=$fb_app_id&redirect_uri=$redirect_uri&client_secret=$fb_app_secret&code=$code";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$str_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, null);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$result = curl_exec($ch);
curl_close($ch);


$json = json_decode($result, true); // convert result to json array

$access_token = $json['access_token']; // user access token

//$_SESSION['access_token_fb_login_backstage'] = $access_token; // save user access token in session

$get_info = "https://graph.facebook.com/me/?fields=email,name,first_name,last_name,id&access_token=$access_token";

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
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

$_SESSION["fb_id"] = $info_json['id'];
$_SESSION["fb_first_name"] = $info_json['first_name']; // save user first name in session
$_SESSION["fb_last_name"] = $info_json['last_name']; // save user last name in session
$_SESSION["fb_email"] = $info_json['email']; // save user email in session

$_SESSION['success_fb_login_backstage'] = 1;

header("location: check.php");
?>