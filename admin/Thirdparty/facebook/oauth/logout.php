<?php

session_start();

/* Script By Qassim Hassan, wp-time.com */
	
// if user is logged in, destroy all facebook sessions
if( isset($_SESSION['success_fb_login_backstage']) or isset($_SESSION['access_token']) or isset($_SESSION['login']) ){
	unset( $_SESSION['success_fb_login_backstage'] ); // destroy
	unset( $_SESSION['access_token'] ); // destroy
	unset( $_SESSION['login'] ); // destroy
	header("location: index.php"); // redirect user to index page
}

else{ // if user is not logged in
	header("location: index.php"); // redirect user to index page
}

?>