<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username_' . $_GET['wshop']] = NULL;
  $_SESSION['MM_UserGroup_' . $_GET['wshop']] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username_' . $_GET['wshop']]);
  unset($_SESSION['MM_UserGroup_' . $_GET['wshop']]);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['success_line_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_google_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_fb_login_backstage_'.$_GET['wshop']]);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php require_once("inc_setting_fr_tmp_demo.php"); ?>
<?php require_once("inc/inc_path.php"); ?>
<?php require_once("inc/inc_function.php"); ?>
<?php require_once($Lang_GeneralPath); // 通用語系檔連結?>
<?php //require_once($Lang_AboutPath); // 最新訊息語系檔連結?>
<?php require_once("inc_title/about.php"); // 此頁面標題?>
<?php include_once("require_template_demo.php"); ?>