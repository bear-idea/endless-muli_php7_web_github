<?php 

// Script By Qassim Hassan, wp-time.com

session_start();

if( isset($_SESSION['success_fb_login_backstage']) ){ // check is user is logged in
	$title = "Logged in as ".$_SESSION["first_name"]." ".$_SESSION["last_name"]; // page title
}

else{
	$title = "Login With Facebook"; // page title
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
</head>
<body>

<?php
	if( isset($_SESSION['success_fb_login_backstage']) ){ // if user is logged in
		?>
			<h3>Welcome <?php echo $_SESSION["first_name"]; ?> <?php echo $_SESSION["last_name"]; ?> !</h3>
			<p><img src="<?php echo $_SESSION['picture']; ?>"></p>
			<p>Your Email is: <?php echo $_SESSION["email"]; ?></p>
			<p><a href="logout.php">Logout</a></p>
		<?php
	}

	else{ // if user is not logged in
		echo '<a href="login.php">Login With Facebook</a>';
	}

?>

<p><a target="_blank" href="http://wp-time.com/login-with-facebook-using-api-in-php/">Download Script & Usage</a></p>

</body>
</html>