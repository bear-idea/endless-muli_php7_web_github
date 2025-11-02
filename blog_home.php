<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
require('vendor/autoload.php');
require_once('app/init/bootstrap.php');
require_once($Lang_GeneralPath);
?>
<?php include("home_blog_type.php"); ?>
