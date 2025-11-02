<?php

session_start();

// Script By Qassim Hassan, wp-time.com


include 'config.php';

echo $access_token = $_SESSION['access_token_fb_login_backstage']; // user access token


if( isset($_SESSION['success_fb_login_backstage']) || !isset($_SESSION['fb_login']) ){ // check if user is logged in
	header("location: ../../../index.php"); // redirect user to index page
	return false;
}


/****************************************************************************************/

/* Get User Picture */

/*$width = 160; // picture width, change it if you want

$height = 160; // picture height, change it if you want

echo $get_picture = "https://graph.facebook.com/me/picture?redirect=0&width=$width&height=$height&access_token=$access_token";

$content_picture = file_get_contents($get_picture);

$picture_json = json_decode($content_picture, true);

$user_picture = $picture_json["data"]["url"]; // user picture link
*/

/* Get User Info */

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

$_SESSION["first_name"] = $info_json['first_name']; // save user first name in session

$_SESSION["last_name"] = $info_json['last_name']; // save user last name in session

$_SESSION["email"] = $info_json['email']; // save user email in session

$_SESSION["picture"] = $user_picture; // save user picture link in session

$_SESSION['success_fb_login_backstage'] = 1;

header("location: index.php"); // finally, redirect user to index page

?>