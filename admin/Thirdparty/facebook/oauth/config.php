<?php require_once('../../../../Connections/DB_Conn.php'); ?>
<?php

// Script By Qassim Hassan, wp-time.com

// go to https://developers.facebook.com and create a new app

$SiteFileUrlName = pathinfo($_SERVER['PHP_SELF']); // 網站放置位置 echo $SiteFileUrlName['dirname']
$SiteFileUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $SiteFileUrlName['dirname']; // 網站放置位置

$redirect_uri = $SiteFileUrl  . "/callback.php"; // enter your redirect url (Site URL from app settings)

$scope = "public_profile,email"; // we need scope of public_profile and email, but you can change it for another result, check list of scopes: https://developers.facebook.com/docs/facebook-login/permissions

?>