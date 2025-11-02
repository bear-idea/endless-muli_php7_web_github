<?php require_once('Connections/DB_Conn.php'); ?>
<?php require("inc/mobile_detect.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double": 
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

/*
// *** Validate request to login to this site.
*/

if (!isset($_SESSION)) {
  session_start();
}
/* 取得唯一 SESSION 當使用者進入網站 */
if (!isset($_SESSION['UserAccess']) || $_SESSION['UserAccess'] == "") { 
  $_SESSION['UserAccess'] = md5(uniqid());
}

/* =================================================================================================================*/
// 獨立網址判斷
/* =================================================================================================================*/
if($_SERVER['HTTP_HOST'] != "www.shop3500.com")
{
	/*
	//echo $_SERVER['HTTP_HOST'];
	// 抓取目前網址的域名比對目前帳號資料庫
	
	// 將網址轉為 xxx.com [http/https/www]
	// echo pure_url('http://www.example.com/directory/index.php'); 
	*/
	function pure_url($url) {
	   return implode('/', array_slice(explode('/', preg_replace('/https?:\/\/|www./', '', $url)), 0, 1));
	}
	
	$AnsWebUrl = pure_url($_SERVER['HTTP_HOST']); /* 分析Url */
	
	$GetUrlAry = array("http://" . $AnsWebUrl, "https://" . $AnsWebUrl, "http://www." . $AnsWebUrl, "https://www." . $AnsWebUrl);
	
	foreach ($GetUrlAry as $value) {	
		$colname_RecordPlatformAccount = "-1";
		if (isset($value)) {
		  $colname_RecordPlatformAccount = $value;
		}
		
		$query_RecordPlatformAccount = sprintf("SELECT * FROM demo_admin WHERE urllink = %s || urllink2 = %s", GetSQLValueString($colname_RecordPlatformAccount, "text"), GetSQLValueString($colname_RecordPlatformAccount, "text"));
		$RecordPlatformAccount = mysqli_query($DB_Conn, $query_RecordPlatformAccount) or die(mysqli_error($DB_Conn));
		$row_RecordPlatformAccount = mysqli_fetch_assoc($RecordPlatformAccount);
		$totalRows_RecordPlatformAccount = mysqli_num_rows($RecordPlatformAccount);	
		
		if($totalRows_RecordPlatformAccount > 0)
		{
			$_GET['wshop'] = $row_RecordPlatformAccount['webname'];
		}
	}
}
/* =================================================================================================================*/
// \獨立網址判斷
/* =================================================================================================================*/

// 美安串接
if (isset($_GET['RID'])) {
	$_SESSION['RID'] = $_GET['RID'];
}
if (isset($_GET['Click_ID'])) {
	$_SESSION['Click_ID'] = $_GET['Click_ID'];
}

// 指定單一網站
$_GET['wshop'] = 'playweb';
// 是否為shop3500
$web_only_exclusive = "1";

$colname_RecordAccount = "-1";
if (isset($_GET['wshop'])) {
  $colname_RecordAccount = $_GET['wshop'];
}

$query_RecordAccount = sprintf("SELECT * FROM demo_admin WHERE webname = %s", GetSQLValueString($colname_RecordAccount, "text"));
$RecordAccount = mysqli_query($DB_Conn, $query_RecordAccount) or die(mysqli_error($DB_Conn));
$row_RecordAccount = mysqli_fetch_assoc($RecordAccount);
$totalRows_RecordAccount = mysqli_num_rows($RecordAccount);

/* --------- BOT CHECK --------*/
$_SESSION['Bot_Check_Value'] = true;
/* =================================================================================================================*/
if ($totalRows_RecordAccount > 0) { // 若搜尋到網域資料則執行下列程式
/* =================================================================================================================*/
/* ----------店家選擇---------- */
$_SESSION['userid'] = $row_RecordAccount['id'];
/* ----------店家選擇---------- */

$coluserid_RecordSystemConfig = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSystemConfig = $_SESSION['userid'];
}

$query_RecordSystemConfig = sprintf("SELECT * FROM demo_setting WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfig, "int"));
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);

$colname_RecordSystemConfigFr = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordSystemConfigFr = $_SESSION['userid'];
}

$query_RecordSystemConfigFr = sprintf("SELECT * FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordSystemConfigFr, "int"));
$RecordSystemConfigFr = mysqli_query($DB_Conn, $query_RecordSystemConfigFr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigFr = mysqli_fetch_assoc($RecordSystemConfigFr);
$totalRows_RecordSystemConfigFr = mysqli_num_rows($RecordSystemConfigFr);

$colname_RecordSystemConfigOtr = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordSystemConfigOtr = $_SESSION['userid'];
}

$query_RecordSystemConfigOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid = %s", GetSQLValueString($colname_RecordSystemConfigOtr, "int"));
$RecordSystemConfigOtr = mysqli_query($DB_Conn, $query_RecordSystemConfigOtr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigOtr = mysqli_fetch_assoc($RecordSystemConfigOtr);
$totalRows_RecordSystemConfigOtr = mysqli_num_rows($RecordSystemConfigOtr);

/* --  取得版型 -- */
if($row_RecordSystemConfigFr['Mobile_Enable'] == '0') { // 單版型(之前pc 目前統一)
	$SQL_MSTmpSelect = "MSTmpSelect";
}else if ($row_RecordSystemConfigFr['Mobile_Enable'] == '2'){ // 單版型(之前rwd 目前統一)
	$SQL_MSTmpSelect = "MSTmpSelectRWD";
}else if ($browser_t == 'smartphone' || $browser_t == 'mobile'){ // 依照瀏覽工具自動判別
    $SQL_MSTmpSelect = "MSTmpSelectRWD"; 
}else {
	$SQL_MSTmpSelect = "MSTmpSelect";
}

$coluserid_RecordTmpConfig = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpConfig = $_SESSION['userid'];
}

$query_RecordTmpConfig = sprintf("SELECT * FROM demo_tmp WHERE id = (SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpConfig, "int"));
$RecordTmpConfig = mysqli_query($DB_Conn, $query_RecordTmpConfig) or die(mysqli_error($DB_Conn));
$row_RecordTmpConfig = mysqli_fetch_assoc($RecordTmpConfig);
$totalRows_RecordTmpConfig = mysqli_num_rows($RecordTmpConfig);

//$coluserid_RecordTmpBg = "-1";
//if (isset($_SESSION['userid'])) {
//  $coluserid_RecordTmpBg = $_SESSION['userid'];
//}

//$query_RecordTmpBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT TmpBg FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpBg, "int"));
//$RecordTmpBg = mysqli_query($DB_Conn, $query_RecordTmpBg) or die(mysqli_error($DB_Conn));
//$row_RecordTmpBg = mysqli_fetch_assoc($RecordTmpBg);
//$totalRows_RecordTmpBg = mysqli_num_rows($RecordTmpBg);

$coluserid_RecordTmpHeaderBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpHeaderBg = $_SESSION['userid'];
}

$query_RecordTmpHeaderBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpheaderbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s))", GetSQLValueString($coluserid_RecordTmpHeaderBg, "int"));
$RecordTmpHeaderBg = mysqli_query($DB_Conn, $query_RecordTmpHeaderBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpHeaderBg = mysqli_fetch_assoc($RecordTmpHeaderBg);
$totalRows_RecordTmpHeaderBg = mysqli_num_rows($RecordTmpHeaderBg);

$coluserid_RecordTmpWrpBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpWrpBg = $_SESSION['userid'];
}

$query_RecordTmpWrpBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpwrpbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpWrpBg, "int"));
$RecordTmpWrpBg = mysqli_query($DB_Conn, $query_RecordTmpWrpBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpWrpBg = mysqli_fetch_assoc($RecordTmpWrpBg);
$totalRows_RecordTmpWrpBg = mysqli_num_rows($RecordTmpWrpBg);

$coluserid_RecordTmpLeftBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpLeftBg = $_SESSION['userid'];
}

$query_RecordTmpLeftBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpleftbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpLeftBg, "int"));
$RecordTmpLeftBg = mysqli_query($DB_Conn, $query_RecordTmpLeftBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftBg = mysqli_fetch_assoc($RecordTmpLeftBg);
$totalRows_RecordTmpLeftBg = mysqli_num_rows($RecordTmpLeftBg);

$coluserid_RecordTmpRightBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpRightBg = $_SESSION['userid'];
}

$query_RecordTmpRightBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmprightbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpRightBg, "int"));
$RecordTmpRightBg = mysqli_query($DB_Conn, $query_RecordTmpRightBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpRightBg = mysqli_fetch_assoc($RecordTmpRightBg);
$totalRows_RecordTmpRightBg = mysqli_num_rows($RecordTmpRightBg);

$coluserid_RecordTmpMiddleBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpMiddleBg = $_SESSION['userid'];
}

$query_RecordTmpMiddleBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpmiddlebackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpMiddleBg, "int"));
$RecordTmpMiddleBg = mysqli_query($DB_Conn, $query_RecordTmpMiddleBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpMiddleBg = mysqli_fetch_assoc($RecordTmpMiddleBg);
$totalRows_RecordTmpMiddleBg = mysqli_num_rows($RecordTmpMiddleBg);

$coluserid_RecordTmpFooterBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpFooterBg = $_SESSION['userid'];
}

$query_RecordTmpFooterBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpfooterbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpFooterBg, "int"));
$RecordTmpFooterBg = mysqli_query($DB_Conn, $query_RecordTmpFooterBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpFooterBg = mysqli_fetch_assoc($RecordTmpFooterBg);
$totalRows_RecordTmpFooterBg = mysqli_num_rows($RecordTmpFooterBg);

$coluserid_RecordTmpHomeBoard = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpHomeBoard = $_SESSION['userid'];
}

$query_RecordTmpHomeBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = (SELECT tmphomeboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpHomeBoard, "int"));
$RecordTmpHomeBoard = mysqli_query($DB_Conn, $query_RecordTmpHomeBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpHomeBoard = mysqli_fetch_assoc($RecordTmpHomeBoard);
$totalRows_RecordTmpHomeBoard = mysqli_num_rows($RecordTmpHomeBoard);

$coluserid_RecordTmpWrpBoard = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpWrpBoard = $_SESSION['userid'];
}

$query_RecordTmpWrpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = (SELECT tmpwrpboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpWrpBoard, "int"));
$RecordTmpWrpBoard = mysqli_query($DB_Conn, $query_RecordTmpWrpBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpWrpBoard = mysqli_fetch_assoc($RecordTmpWrpBoard);
$totalRows_RecordTmpWrpBoard = mysqli_num_rows($RecordTmpWrpBoard);

$coluserid_RecordTmpBannerBoard = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpBannerBoard = $_SESSION['userid'];
}

$query_RecordTmpBannerBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = (SELECT tmpbannerboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpBannerBoard, "int"));
$RecordTmpBannerBoard = mysqli_query($DB_Conn, $query_RecordTmpBannerBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpBannerBoard = mysqli_fetch_assoc($RecordTmpBannerBoard);
$totalRows_RecordTmpBannerBoard = mysqli_num_rows($RecordTmpBannerBoard);

$coluserid_RecordTmpViewlineBoard = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpViewlineBoard = $_SESSION['userid'];
}

$query_RecordTmpViewlineBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = (SELECT tmpviewlineboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpViewlineBoard, "int"));
$RecordTmpViewlineBoard = mysqli_query($DB_Conn, $query_RecordTmpViewlineBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpViewlineBoard = mysqli_fetch_assoc($RecordTmpViewlineBoard);
$totalRows_RecordTmpViewlineBoard = mysqli_num_rows($RecordTmpViewlineBoard);

$coluserid_RecordTmpMiddleBoard = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpMiddleBoard = $_SESSION['userid'];
}

$query_RecordTmpMiddleBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = (SELECT tmpmiddleboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpMiddleBoard, "int"));
$RecordTmpMiddleBoard = mysqli_query($DB_Conn, $query_RecordTmpMiddleBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpMiddleBoard = mysqli_fetch_assoc($RecordTmpMiddleBoard);
$totalRows_RecordTmpMiddleBoard = mysqli_num_rows($RecordTmpMiddleBoard);

$coluserid_RecordTmpTitleBoard = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpTitleBoard = $_SESSION['userid'];
}

$query_RecordTmpTitleBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = (SELECT tmptitleboard FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpTitleBoard, "int"));
$RecordTmpTitleBoard = mysqli_query($DB_Conn, $query_RecordTmpTitleBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpTitleBoard = mysqli_fetch_assoc($RecordTmpTitleBoard);
$totalRows_RecordTmpTitleBoard = mysqli_num_rows($RecordTmpTitleBoard);

$coluserid_RecordTmpTitleBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpTitleBg = $_SESSION['userid'];
}

$query_RecordTmpTitleBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmptitlebackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpTitleBg, "int"));
$RecordTmpTitleBg = mysqli_query($DB_Conn, $query_RecordTmpTitleBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpTitleBg = mysqli_fetch_assoc($RecordTmpTitleBg);
$totalRows_RecordTmpTitleBg = mysqli_num_rows($RecordTmpTitleBg);

$coluserid_RecordTmpTitleLineBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpTitleLineBg = $_SESSION['userid'];
}

$query_RecordTmpTitleLineBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmptitlelinebackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpTitleLineBg, "int"));
$RecordTmpTitleLineBg = mysqli_query($DB_Conn, $query_RecordTmpTitleLineBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpTitleLineBg = mysqli_fetch_assoc($RecordTmpTitleLineBg);
$totalRows_RecordTmpTitleLineBg = mysqli_num_rows($RecordTmpTitleLineBg);

$coluserid_RecordTmpBodyBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpBodyBg = $_SESSION['userid'];
}

$query_RecordTmpBodyBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpbodybackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpBodyBg, "int"));
$RecordTmpBodyBg = mysqli_query($DB_Conn, $query_RecordTmpBodyBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpBodyBg = mysqli_fetch_assoc($RecordTmpBodyBg);
$totalRows_RecordTmpBodyBg = mysqli_num_rows($RecordTmpBodyBg);

$coluserid_RecordTmpLeftMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpLeftMenu = $_SESSION['userid'];
}

$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE id = (SELECT tmpleftmenu FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"));
$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);
$totalRows_RecordTmpLeftMenu = mysqli_num_rows($RecordTmpLeftMenu);

$coluserid_RecordTmpAnimeBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpAnimeBg = $_SESSION['userid'];
}

$query_RecordTmpAnimeBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpanimebackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpAnimeBg, "int"));
$RecordTmpAnimeBg = mysqli_query($DB_Conn, $query_RecordTmpAnimeBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpAnimeBg = mysqli_fetch_assoc($RecordTmpAnimeBg);
$totalRows_RecordTmpAnimeBg = mysqli_num_rows($RecordTmpAnimeBg);

$coluserid_RecordTmpNewsEvenBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpNewsEvenBg = $_SESSION['userid'];
}

$query_RecordTmpNewsEvenBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpnewsevenbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpNewsEvenBg, "int"));
$RecordTmpNewsEvenBg = mysqli_query($DB_Conn, $query_RecordTmpNewsEvenBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpNewsEvenBg = mysqli_fetch_assoc($RecordTmpNewsEvenBg);
$totalRows_RecordTmpNewsEvenBg = mysqli_num_rows($RecordTmpNewsEvenBg);

$coluserid_RecordTmpNewsOddBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpNewsOddBg = $_SESSION['userid'];
}

$query_RecordTmpNewsOddBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpnewsoddbackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpNewsOddBg, "int"));
$RecordTmpNewsOddBg = mysqli_query($DB_Conn, $query_RecordTmpNewsOddBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpNewsOddBg = mysqli_fetch_assoc($RecordTmpNewsOddBg);
$totalRows_RecordTmpNewsOddBg = mysqli_num_rows($RecordTmpNewsOddBg);

$coluserid_RecordTmpMainMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpMainMenu = $_SESSION['userid'];
}

$query_RecordTmpMainMenu = sprintf("SELECT * FROM demo_tmpmainmenu WHERE id = (SELECT tmpmainmenu FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpMainMenu, "int"));
$RecordTmpMainMenu = mysqli_query($DB_Conn, $query_RecordTmpMainMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainMenu);
$totalRows_RecordTmpMainMenu = mysqli_num_rows($RecordTmpMainMenu);

$coluserid_RecordTmpLogo = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpLogo = $_SESSION['userid'];
}

$query_RecordTmpLogo = sprintf("SELECT * FROM demo_tmplogo WHERE id = (SELECT tmplogoid FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpLogo, "int"));
$RecordTmpLogo = mysqli_query($DB_Conn, $query_RecordTmpLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo);
$totalRows_RecordTmpLogo = mysqli_num_rows($RecordTmpLogo);

$coluserid_RecordTmpHomeLogo = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpHomeLogo = $_SESSION['userid'];
}

$query_RecordTmpHomeLogo = sprintf("SELECT * FROM demo_tmplogo WHERE id = (SELECT tmphomelogoid FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpHomeLogo, "int"));
$RecordTmpHomeLogo = mysqli_query($DB_Conn, $query_RecordTmpHomeLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpHomeLogo = mysqli_fetch_assoc($RecordTmpHomeLogo);
$totalRows_RecordTmpHomeLogo = mysqli_num_rows($RecordTmpHomeLogo);

$coluserid_RecordTmpLogoDefault = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpLogoDefault = $_SESSION['userid'];
}

$query_RecordTmpLogoDefault = sprintf("SELECT * FROM demo_tmplogo WHERE id = (SELECT TmpLogoID FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpLogoDefault, "int"));
$RecordTmpLogoDefault = mysqli_query($DB_Conn, $query_RecordTmpLogoDefault) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoDefault = mysqli_fetch_assoc($RecordTmpLogoDefault);
$totalRows_RecordTmpLogoDefault = mysqli_num_rows($RecordTmpLogoDefault);

$coluserid_RecordTmpBlock = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpBlock = $_SESSION['userid'];
}

$query_RecordTmpBlock = sprintf("SELECT * FROM demo_tmpblock WHERE id = (SELECT tmpblock FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpBlock, "int"));
$RecordTmpBlock = mysqli_query($DB_Conn, $query_RecordTmpBlock) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlock = mysqli_fetch_assoc($RecordTmpBlock);
$totalRows_RecordTmpBlock = mysqli_num_rows($RecordTmpBlock);

$coluserid_RecordTmpBottomBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpBottomBg = $_SESSION['userid'];
}

$query_RecordTmpBottomBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmpbottombackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpBottomBg, "int"));
$RecordTmpBottomBg = mysqli_query($DB_Conn, $query_RecordTmpBottomBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpBottomBg = mysqli_fetch_assoc($RecordTmpBottomBg);
$totalRows_RecordTmpBottomBg = mysqli_num_rows($RecordTmpBottomBg);

$coluserid_RecordTmpHomeBodyBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpHomeBodyBg = $_SESSION['userid'];
}

$query_RecordTmpHomeBodyBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmphomebodybackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpHomeBodyBg, "int"));
$RecordTmpHomeBodyBg = mysqli_query($DB_Conn, $query_RecordTmpHomeBodyBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpHomeBodyBg = mysqli_fetch_assoc($RecordTmpHomeBodyBg);
$totalRows_RecordTmpHomeBodyBg = mysqli_num_rows($RecordTmpHomeBodyBg);

$coluserid_RecordTmpHomeAnimeBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpHomeAnimeBg = $_SESSION['userid'];
}

$query_RecordTmpHomeAnimeBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmphomeanimebackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpHomeAnimeBg, "int"));
$RecordTmpHomeAnimeBg = mysqli_query($DB_Conn, $query_RecordTmpHomeAnimeBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpHomeAnimeBg = mysqli_fetch_assoc($RecordTmpHomeAnimeBg);
$totalRows_RecordTmpHomeAnimeBg = mysqli_num_rows($RecordTmpHomeAnimeBg);

$coluserid_RecordTmpHomeBottomBg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpHomeBottomBg = $_SESSION['userid'];
}

$query_RecordTmpHomeBottomBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = (SELECT tmphomebottombackground FROM demo_tmp WHERE id=(SELECT $SQL_MSTmpSelect FROM demo_setting_fr WHERE userid=%s)) ", GetSQLValueString($coluserid_RecordTmpHomeBottomBg, "int"));
$RecordTmpHomeBottomBg = mysqli_query($DB_Conn, $query_RecordTmpHomeBottomBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpHomeBottomBg = mysqli_fetch_assoc($RecordTmpHomeBottomBg);
$totalRows_RecordTmpHomeBottomBg = mysqli_num_rows($RecordTmpHomeBottomBg);

/* ----------通用功能設定---------- */
date_default_timezone_set('Asia/Taipei'); // 設定時區時間 echo date("Y-m-d H-i-s"); Asia/Taipei  Etc/GMT-8

//$MySiteUrlGet = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
//$MySiteUrl = dirname($MySiteUrlGet);

$SiteFileUrlName = pathinfo($_SERVER['PHP_SELF']); // 網站放置位置 echo $SiteFileUrlName['dirname']
$SiteFileUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $SiteFileUrlName['dirname']; // 網站放置位置 echo $SiteFileUrlName['dirname']
$LeftMenuEnable = '1'; //左選單是否有內容 部落格左選單需清空 inc/title  設定

$UrlWriteEnable = $row_RecordSystemConfigFr['urlwriteenable']; // 網址SEO
if($UrlWriteEnable == '1') {
	$tag_params = "?tag=";
	$key_params = "?searchkey=";
	$id_params = "?id=";
	$operate_params = "?Operate=";
	$file_params = "?f=";
	$type_params = "?type=";
	$RegMsg_params = "?RegMsg=";
	$errMsg_params = "?errMsg=";
	$id_del_params = "?id_del=";
	$plusid_del_params = "?plusid_del=";
	$page_params = "?page=";
	$discount_params = "?discountid=";
}else{
	$tag_params = "&tag=";
	$key_params = "&searchkey=";
	$id_params = "&id=";
	$operate_params = "&Operate=";
	$file_params = "&f=";
	$type_params = "&type=";
	$RegMsg_params = "&RegMsg=";
	$errMsg_params = "&errMsg=";
	$id_del_params = "&id_del=";
	$plusid_del_params = "&plusid_del=";
	$page_params = "&page=";
	$discount_params = "&discountid=";
}

// 當無抓取到時則使用預設語系
if ($row_RecordSystemConfig['Defaultlang'] == 'auto') { 
preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
$NowBrowserLang = $matches[1];
    switch ($NowBrowserLang) {
        case 'zh-tw' :
		case 'zh-TW' :
                $defaultlang = "zh-tw";
                break;
        case 'zh-cn' :
		case 'zh-CN' :
		        if($row_RecordSystemConfig['LangChooseZHCN'] == '1'){
					$defaultlang = "zh-cn";
				}else{
					$defaultlang = "zh-tw";
				}
                break;
		case 'jp' :
		case 'JP' :
                if($row_RecordSystemConfig['LangChooseJP'] == '1'){
					$defaultlang = "jp";
				}else{
					$defaultlang = "zh-tw";
				}
                break;
		case 'kr' :
		case 'KR' :
                if($row_RecordSystemConfig['LangChooseKR'] == '1'){
					$defaultlang = "kr";
				}else{
					$defaultlang = "zh-tw";
				}
                break;
		case 'sp' :
		case 'SP' :
                if($row_RecordSystemConfig['LangChooseSP'] == '1'){
					$defaultlang = "sp";
				}else{
					$defaultlang = "zh-tw";
				}
                break;
        default:
		        if($row_RecordSystemConfig['LangChooseEN'] == '1'){
					echo $defaultlang = "en";
				}else{
					$defaultlang = "zh-tw";
				}
                break;
	}
}else if ($row_RecordSystemConfig['Defaultlang'] != ''){
	$defaultlang = $row_RecordSystemConfig['Defaultlang']; // 預設語系
}else{
	$defaultlang = 'zh-tw';
}
if(isset($_GET['lang']) && $_GET['lang'] != ''){}else{$_GET['lang'] = $defaultlang;}

$HighlightSelect = $row_RecordSystemConfig['HighlightSelect']; // 搜索文字提示是否開啟

// 網站隱私
$SitePrivate = $row_RecordSystemConfigFr['SitePrivate']; // 網站隱私

// Google 分析工具
$GoogleAnalyticsCodeID = $row_RecordSystemConfigFr['GoogleAnalyticsCodeID']; // Google 追蹤程式碼

// Google GTM
$GoogleAnalyticsGTM = $row_RecordSystemConfigFr['GoogleAnalyticsGTM']; // Google GTM

// Facebook 像素
$FBPixelCodeID = $row_RecordSystemConfigFr['FBPixelCodeID']; // FB 追蹤程式碼

// Facebook fb:admins
$FBPixelCodeID = $row_RecordSystemConfigFr['FBAdminID']; // FB fb:admins

// Facebook fb:appid
$FBPixelCodeID = $row_RecordSystemConfigFr['FBAppID']; // FB fb:appid

// Google 驗證網站
$GoogleVerificationCode = $row_RecordSystemConfigFr['GoogleVerificationCode']; // Google 驗證

// Yahoo 驗證網站
$YahooVerificationCode = $row_RecordSystemConfigFr['YahooVerificationCode']; // Yahoo 驗證

// Google Map API
$GoogleMapAPICode1 = $row_RecordSystemConfigFr['GoogleMapAPICode1']; // GoogleMap
$GoogleMapAPICode2 = $row_RecordSystemConfigFr['GoogleMapAPICode2']; // GoogleMap
$GoogleMapAPITime1 = $row_RecordSystemConfigFr['GoogleMapAPITime1']; // GoogleMap
$GoogleMapAPITime2 = $row_RecordSystemConfigFr['GoogleMapAPITime2']; // GoogleMap

// 第三方登入
if($_SERVER['HTTP_HOST'] == "www.shop3500.com" || $_SERVER['HTTP_HOST'] == "shop3500.com" || $_SERVER['HTTP_HOST'] == "www.1881shop.com" || $_SERVER['HTTP_HOST'] == "1881shop.com" || $_SERVER['HTTP_HOST'] == "www.e-sales123.com" || $_SERVER['HTTP_HOST'] == "e-sales123.com" || $_SERVER['HTTP_HOST'] == "localhost"){
}else{
$fb_app_id = $row_RecordSystemConfigFr['FacebookLoginAppID'];
$fb_app_secret = $row_RecordSystemConfigFr['FacebookLoginSecret'];
$line_app_id = $row_RecordSystemConfigFr['LINELoginAppID'];
$line_app_secret = $row_RecordSystemConfigFr['LINELoginSecret'];
$google_app_id = $row_RecordSystemConfigFr['GoogleLoginAppID'];
$google_app_secret = $row_RecordSystemConfigFr['GoogleLoginSecret'];
}

$GoogleMapAPICode = $GoogleMapAPICode1;
if(date("H") > $GoogleMapAPITime1 && $GoogleMapAPICode2 != "" && $GoogleMapAPITime1 != ""){$GoogleMapAPICode = $GoogleMapAPICode2;}

// 目前店家資訊
$WshopTopPic = $row_RecordAccount['pic'];
$WshopTopName = $row_RecordAccount['name'];

// 繁體中文
$SiteName = $row_RecordSystemConfigFr['SiteName']; // 網站名稱
$SiteKeyWord = $row_RecordSystemConfigFr['SiteKeyWord']; // 關鍵字
$SiteDesc = $row_RecordSystemConfigFr['SiteDesc']; // 描述
$SiteFBShowImage = $row_RecordSystemConfigFr['SiteFBShowImage']; // fb圖片
$SiteIcon = $row_RecordSystemConfigFr['SiteIcon']; // 小圖示
$SiteSName = $row_RecordSystemConfigFr['SiteSName']; // fb 粉絲頁
$SiteFBFan = $row_RecordSystemConfigFr['SiteFBFan']; // fb 粉絲頁
$SitePhone = $row_RecordSystemConfigFr['SitePhone']; // 電話
$SiteCell = $row_RecordSystemConfigFr['SiteCell']; // 電話
$SiteFax = $row_RecordSystemConfigFr['SiteFax']; // 電話
$SiteLINE = $row_RecordSystemConfigFr['SiteLINE']; // 電話
$SiteAddr = $row_RecordSystemConfigFr['SiteAddr']; // 電話
$SiteIndicate = $row_RecordSystemConfigFr['SiteIndicate']; // 電話
$SiteIndicateDesc = $row_RecordSystemConfigFr['SiteIndicateDesc']; // 電話
$SiteMail = $row_RecordSystemConfigFr['SiteMail']; // 電話
$SiteCopyLock = $row_RecordSystemConfigFr['SiteCopyLock']; // 電話
$SiteAnimeCheck = $row_RecordSystemConfigFr['SiteAnimeCheck']; // 動畫

// 英文
$SiteName_en = $row_RecordSystemConfigFr['SiteName_en']; // 網站名稱
$SiteKeyWord_en = $row_RecordSystemConfigFr['SiteKeyWord_en']; // 關鍵字
$SiteDesc_en = $row_RecordSystemConfigFr['SiteDesc_en']; // 描述
$SiteSName_en = $row_RecordSystemConfigFr['SiteSName_en']; // fb 粉絲頁
$SitePhone_en = $row_RecordSystemConfigFr['SitePhone_en']; // 電話
$SiteCell_en = $row_RecordSystemConfigFr['SiteCell_en']; // 電話
$SiteFax_en = $row_RecordSystemConfigFr['SiteFax_en']; // 電話
$SiteAddr_en = $row_RecordSystemConfigFr['SiteAddr_en']; // 電話
$SiteMail_en = $row_RecordSystemConfigFr['SiteMail_en']; // 電話

// 簡體中文
$SiteName_cn = $row_RecordSystemConfigFr['SiteName_cn']; // 網站名稱
$SiteKeyWord_cn = $row_RecordSystemConfigFr['SiteKeyWord_cn']; // 關鍵字
$SiteDesc_cn = $row_RecordSystemConfigFr['SiteDesc_cn']; // 描述
$SiteSName_cn = $row_RecordSystemConfigFr['SiteSName_cn']; // fb 粉絲頁
$SitePhone_cn = $row_RecordSystemConfigFr['SitePhone_cn']; // 電話
$SiteCell_cn = $row_RecordSystemConfigFr['SiteCell_cn']; // 電話
$SiteFax_cn = $row_RecordSystemConfigFr['SiteFax_cn']; // 電話
$SiteAddr_cn = $row_RecordSystemConfigFr['SiteAddr_cn']; // 電話
$SiteMail_cn = $row_RecordSystemConfigFr['SiteMail_cn']; // 電話

// 日文
$SiteName_jp = $row_RecordSystemConfigFr['SiteName_jp']; // 網站名稱
$SiteKeyWord_jp = $row_RecordSystemConfigFr['SiteKeyWord_jp']; // 關鍵字
$SiteDesc_jp = $row_RecordSystemConfigFr['SiteDesc_jp']; // 描述
$SiteSName_jp = $row_RecordSystemConfigFr['SiteSName_jp']; // fb 粉絲頁
$SitePhone_jp = $row_RecordSystemConfigFr['SitePhone_jp']; // 電話
$SiteCell_jp = $row_RecordSystemConfigFr['SiteCell_jp']; // 電話
$SiteFax_jp = $row_RecordSystemConfigFr['SiteFax_jp']; // 電話
$SiteAddr_jp = $row_RecordSystemConfigFr['SiteAddr_jp']; // 電話
$SiteMail_jp = $row_RecordSystemConfigFr['SiteMail_jp']; // 電話

// 韓文
$SiteName_kr = $row_RecordSystemConfigFr['SiteName_kr']; // 網站名稱
$SiteKeyWord_kr = $row_RecordSystemConfigFr['SiteKeyWord_kr']; // 關鍵字
$SiteDesc_kr = $row_RecordSystemConfigFr['SiteDesc_kr']; // 描述
$SiteSName_kr = $row_RecordSystemConfigFr['SiteSName_kr']; // fb 粉絲頁
$SitePhone_kr = $row_RecordSystemConfigFr['SitePhone_kr']; // 電話
$SiteCell_kr = $row_RecordSystemConfigFr['SiteCell_kr']; // 電話
$SiteFax_kr = $row_RecordSystemConfigFr['SiteFax_kr']; // 電話
$SiteAddr_kr = $row_RecordSystemConfigFr['SiteAddr_kr']; // 電話
$SiteMail_kr = $row_RecordSystemConfigFr['SiteMail_kr']; // 電話

// 西班牙語
$SiteName_sp = $row_RecordSystemConfigFr['SiteName_sp']; // 網站名稱
$SiteKeyWord_sp = $row_RecordSystemConfigFr['SiteKeyWord_sp']; // 關鍵字
$SiteDesc_sp = $row_RecordSystemConfigFr['SiteDesc_sp']; // 描述
$SiteSName_sp = $row_RecordSystemConfigFr['SiteSName_sp']; // fb 粉絲頁
$SitePhone_sp = $row_RecordSystemConfigFr['SitePhone_sp']; // 電話
$SiteCell_sp = $row_RecordSystemConfigFr['SiteCell_sp']; // 電話
$SiteFax_sp = $row_RecordSystemConfigFr['SiteFax_sp']; // 電話
$SiteAddr_sp = $row_RecordSystemConfigFr['SiteAddr_sp']; // 電話
$SiteMail_sp = $row_RecordSystemConfigFr['SiteMail_sp']; // 電話

// 購物車
$CartDesc = $row_RecordSystemConfigFr['CartDesc']; // 備註
$RoomDesc = $row_RecordSystemConfigFr['RoomDesc']; // 備註

$CartPayMail = $row_RecordSystemConfigFr['CartPayMail']; // 匯款Mail

// 地圖
$Strongholdcenter = $row_RecordSystemConfigFr['strongholdcenter']; // 電話
$Strongholdzoom = $row_RecordSystemConfigFr['strongholdzoom']; // 電話

// 三欄是否開啟
$Tmp_Column_Plus = $row_RecordSystemConfig['tmp_column_plus'];

/* ----------擁有語系選擇設定---------- */
$LangChooseZHTW = $row_RecordSystemConfig['LangChooseZHTW'];
$LangChooseZHCN = $row_RecordSystemConfig['LangChooseZHCN'];
$LangChooseEN = $row_RecordSystemConfig['LangChooseEN'];
$LangChooseJP = $row_RecordSystemConfig['LangChooseJP'];
$LangChooseKR = $row_RecordSystemConfig['LangChooseKR'];
$LangChooseSP = $row_RecordSystemConfig['LangChooseSP'];

/* ----------它網連結---------- */
$FBICONChoose = $row_RecordSystemConfig['FBICONChoose'];
$GOOGLEICONChoose = $row_RecordSystemConfig['GOOGLEICONChoose'];
$PLURKICONChoose = $row_RecordSystemConfig['PLURKICONChoose'];

/* ----------功能連結---------- */
$SITEMAPICONChoose = $row_RecordSystemConfig['SITEMAPICONChoose'];
$RSSICONChoose = $row_RecordSystemConfig['RSSICONChoose'];
$MSNICONChoose = $row_RecordSystemConfig['MSNICONChoose'];
$MAILICONChoose = $row_RecordSystemConfig['MAILICONChoose'];

// 以下在會員認證信發送會使用到
$DefaultSiteName = $row_RecordSystemConfigOtr['DefaultSiteName']; //　網站名稱
$DefaultSiteUrl = $row_RecordSystemConfigOtr['DefaultSiteUrl']; // 網站網址
$DefaultSiteMail = $row_RecordSystemConfigOtr['DefaultSiteMail']; // 會員註冊信發送電子郵件
$DefaultSiteMailAuthor = $row_RecordSystemConfigOtr['DefaultSiteMailAuthor']; //會員註冊信發送作者
$DefaultSiteMailSubject = $row_RecordSystemConfigOtr['DefaultSiteMailSubject']; //會員註冊信主旨

// 隱私權
$PrivacyContext = $row_RecordSystemConfigOtr['privacycontext']; //　隱私權政策

// 驗證碼
$_SESSION['CaptchaViewState'] = $row_RecordSystemConfigOtr['captchastate']; //　驗證碼顯示
$CaptchaUseMobilButtom = $row_RecordSystemConfigOtr['captchausemobilbuttom']; //　使用滑動解鎖                                                

/* ----------功能啟用設定---------- */
$OptionTmpSelect = $row_RecordSystemConfig['OptionTmpSelect']; // 版型修改是否啟用
$OptionNewsSelect = $row_RecordSystemConfig['OptionNewsSelect']; // 最新訊息是否啟用
$OptionLettersSelect = $row_RecordSystemConfig['OptionLettersSelect']; // 新聞快報是否啟用
$OptionActnewsSelect = $row_RecordSystemConfig['OptionActnewsSelect']; // 活動快訊是否啟用
$OptionFaqSelect = $row_RecordSystemConfig['OptionFaqSelect']; // 常見問答是否啟用
$OptionProductSelect = $row_RecordSystemConfig['OptionProductSelect']; // 產品功能是否啟用
$OptionMeetingSelect = $row_RecordSystemConfig['OptionMeetingSelect']; // 會議紀錄是否啟用
$OptionSponsorSelect = $row_RecordSystemConfig['OptionSponsorSelect']; // 贊助企業是否啟用
$OptionFrilinkSelect = $row_RecordSystemConfig['OptionFrilinkSelect']; // 友站連結是否啟用
$OptionOtrlinkSelect = $row_RecordSystemConfig['OptionOtrlinkSelect']; // 相關連結是否啟用
$OptionCareersSelect = $row_RecordSystemConfig['OptionCareersSelect']; // 求職徵才是否啟用
$OptionPublishSelect = $row_RecordSystemConfig['OptionPublishSelect']; // 公佈資訊是否啟用
$OptionGuestbookSelect = $row_RecordSystemConfig['OptionGuestbookSelect']; // 留言管理是否啟用
$OptionMemberSelect = $row_RecordSystemConfig['OptionMemberSelect']; // 會員資料是否啟用
$OptionActivitiesSelect = $row_RecordSystemConfig['OptionActivitiesSelect']; // 活動花絮是否啟用
$OptionProjectSelect = $row_RecordSystemConfig['OptionProjectSelect']; // 工程實績是否啟用
$OptionAdsSelect = $row_RecordSystemConfig['OptionAdsSelect']; // 廣告輪播是否啟用
$OptionDonationSelect = $row_RecordSystemConfig['OptionDonationSelect']; // 捐款名錄是否啟用
$OptionAboutSelect = $row_RecordSystemConfig['OptionAboutSelect']; // 關於我們是否啟用
$OptionArticleSelect = $row_RecordSystemConfig['OptionArticleSelect']; // 文章管理是否啟用
$OptionDfPageSelect = $row_RecordSystemConfig['OptionDfPageSelect']; // 自訂頁面是否啟用
$OptionAboutSelect = $row_RecordSystemConfig['OptionAboutSelect']; // 關於我們是否啟用
$OptionContactSelect = $row_RecordSystemConfig['OptionContactSelect']; // 聯絡我們是否啟用
$OptionCatalogSelect = $row_RecordSystemConfig['OptionCatalogSelect']; // 產品型錄是否啟用
$OptionKnowledgeSelect = $row_RecordSystemConfig['OptionKnowledgeSelect']; // 知識學習是否啟用
$OptionCartSelect = $row_RecordSystemConfig['OptionCartSelect']; // 購物車功能是否啟用
$OptionTicketsSelect = $row_RecordSystemConfig['OptionTicketsSelect']; // 訂票系統是否啟用
$OptionOrgSelect = $row_RecordSystemConfig['OptionOrgSelect']; // 成員幹部是否啟用
$OptionFileMangSelect = $row_RecordSystemConfig['OptionFileMangSelect']; // 檔案管理是否啟用
$OptionAnalysisSelect = $row_RecordSystemConfig['OptionAnalysisSelect']; // 統計資料是否啟用
$OptionWebSiteSelect = $row_RecordSystemConfig['OptionWebSiteSelect']; // 網站資訊是否啟用
$OptionEPaperSelect = $row_RecordSystemConfig['OptionEPaperSelect']; // 電子期刊是否啟用
$OptionBlogSelect = $row_RecordSystemConfig['OptionBlogSelect']; // 部落格是否啟用
$OptionPicasaSelect = $row_RecordSystemConfig['OptionPicasaSelect']; // 雲端相簿是否啟用
$OptionPartnerSelect = $row_RecordSystemConfig['OptionPartnerSelect']; // 合作夥伴是否啟用
$OptionForumSelect = $row_RecordSystemConfig['OptionForumSelect']; // 討論專區是否啟用
$OptionArtlistSelect = $row_RecordSystemConfig['OptionArtlistSelect']; // 藝文專欄是否啟用
$OptionVideoSelect = $row_RecordSystemConfig['OptionVideoSelect']; // 影片管理是否啟用
$OptionCouponsSelect = $row_RecordSystemConfig['OptionCouponsSelect']; // 優惠票卷是否啟用
$OptionTimelineSelect = $row_RecordSystemConfig['OptionTimelineSelect']; // 歷史沿革是否啟用
$OptionImageshowSelect = $row_RecordSystemConfig['OptionImageshowSelect']; // 圖片展示是否啟用
$OptionAlbumSelect = $row_RecordSystemConfig['OptionAlbumSelect']; // 相簿管理是否啟用
$OptionStrongholdSelect = $row_RecordSystemConfig['OptionStrongholdSelect']; // 經營據點是否啟用
$OptionTmpHomeSelect = $row_RecordSystemConfig['OptionTmpHomeSelect']; // 版型修改首頁是否啟用
$OptionRoomSelect = $row_RecordSystemConfig['OptionRoomSelect']; // 房型展示是否啟用
$OptionAttractionsSelect = $row_RecordSystemConfig['OptionAttractionsSelect']; // 鄰近景點是否啟用
$OptionMobileSelect = $row_RecordSystemConfig['OptionMobileSelect']; // 行動裝置是否啟用
$OptionDealerSelect = $row_RecordSystemConfig['OptionDealerSelect']; // 經銷商資料是否啟用
$OptionSocialChatSelect = $row_RecordSystemConfig['OptionSocialChatSelect']; // 社群聊天是否啟用
$OptionBookingSelect = $row_RecordSystemConfig['OptionBookingSelect']; // 預約系統是否啟用

/* ----------地磅系統啟用設定---------- */
$OptionScaleSourceSelect = $row_RecordSystemConfig['OptionScaleSourceSelect']; // 貨源管理是否啟用
$OptionSplitOrderSelect = $row_RecordSystemConfig['OptionSplitOrderSelect']; // 物料拆分是否啟用
$OptionScaleClearanceSelect = $row_RecordSystemConfig['OptionScaleClearanceSelect']; // 清運明細是否啟用

/* --以下未有功能--*/
$OptionMailSendSelect = $row_RecordSystemConfig['OptionMailSendSelect']; // 郵件發送是否啟用
$OptionADWallSelect = $row_RecordSystemConfig['OptionADWallSelect']; // 廣告發布是否啟用
$OptionDailySelect = $row_RecordSystemConfig['OptionDailySelect']; // 主題日誌是否啟用
$OptionCalendarSelect = $row_RecordSystemConfig['OptionCalendarSelect']; // 年度行事是否啟用
$OptionMenuMaintainSelect = $row_RecordSystemConfig['OptionMenuMaintainSelect']; // 選單維護是否啟用

/* ----------前台功能設定---------- */

/* 關於我們功能設定 */
//$AboutSearchSelect = $row_RecordSystemConfigFr['AboutSearchSelect']; // 搜索功能是否開啟
/* 最新訊息功能設定 */
$NewsSearchSelect = $row_RecordSystemConfigFr['NewsSearchSelect']; // 搜索功能是否開啟
/* 新聞快報功能設定 */
$LettersSearchSelect = $row_RecordSystemConfigFr['LettersSearchSelect']; // 搜索功能是否開啟
/* 活動快訊功能設定 */
$ActnewsSearchSelect = $row_RecordSystemConfigFr['ActnewsSearchSelect']; // 搜索功能是否開啟
/* 常見問答功能設定 */
$FaqSearchSelect = $row_RecordSystemConfigFr['FaqSearchSelect']; // 搜索功能是否開啟
/* 產品功能設定 */
$ProductSearchSelect = $row_RecordSystemConfigFr['ProductSearchSelect']; // 搜索功能是否開啟
/* 會議紀錄功能設定 */
$MeetingSearchSelect = $row_RecordSystemConfigFr['MeetingSearchSelect']; // 搜索功能是否開啟
/* 贊助企業功能設定 */
$SponsorSearchSelect = $row_RecordSystemConfigFr['SponsorSearchSelect']; // 搜索功能是否開啟
/* 友站連結功能設定 */
$FrilinkSearchSelect = $row_RecordSystemConfigFr['FrilinkSearchSelect']; // 搜索功能是否開啟
/* 求職徵才功能設定 */
$CareersSearchSelect = $row_RecordSystemConfigFr['CareersSearchSelect']; // 搜索功能是否開啟
/* 公佈資訊功能設定 */
$PublishSearchSelect = $row_RecordSystemConfigFr['PublishSearchSelect']; // 搜索功能是否開啟
/* 留言管理功能設定 */
$GuestbookCaptchaSelect = $row_RecordSystemConfigFr['GuestbookCaptchaSelect']; // 驗證碼開啟
$GuestbookSearchSelect = $row_RecordSystemConfigFr['GuestbookSearchSelect']; // 搜索功能是否開啟
/* 會員資料功能設定 */
$MemberSearchSelect = $row_RecordSystemConfigFr['MemberSearchSelect']; // 搜索功能是否開啟
$MemberSeeAuthSelect = $row_RecordSystemConfigFr['MemberSeeAuthSelect']; // 會員一覽是否開放非認證會員可以觀看
$MemberMailAuthSead = $row_RecordSystemConfigFr['MemberMailAuthSead']; // 是否在註冊完後會發送認證信（若上一項設為未開放的話請將此項設為1，或者管理員自行在後台手動開放要開放會員）
$MemberRegSelect = $row_RecordSystemConfigFr['MemberRegSelect']; // 註冊功能是否開啟
/* 經銷中心功能設定 */
$DealerSearchSelect = $row_RecordSystemConfigFr['DealerSearchSelect']; // 搜索功能是否開啟
$DealerSeeAuthSelect = $row_RecordSystemConfigFr['DealerSeeAuthSelect']; // 會員一覽是否開放非認證會員可以觀看
$DealerMailAuthSead = $row_RecordSystemConfigFr['DealerMailAuthSead']; // 是否在註冊完後會發送認證信（若上一項設為未開放的話請將此項設為1，或者管理員自行在後台手動開放要開放會員）
$DealerRegSelect = $row_RecordSystemConfigFr['DealerRegSelect']; // 註冊功能是否開啟
/* 活動花絮功能設定 */
$ActivitiesSearchSelect = $row_RecordSystemConfigFr['ActivitiesSearchSelect']; // 搜索功能是否開啟
/* 工程實績功能設定 */
$ProjectSearchSelect = $row_RecordSystemConfigFr['ProjectSearchSelect']; // 搜索功能是否開啟
/* 廣告輪播功能設定 */
/* 捐款名錄功能設定 */
$DonationSearchSelect = $row_RecordSystemConfigFr['DonationSearchSelect']; // 搜索功能是否開啟
/* 文章管理功能設定 */
$ArticleSearchSelect = $row_RecordSystemConfigFr['ArticleSearchSelect']; // 搜索功能是否開啟
/* 聯絡我們功能設定 */
//$AboutSearchSelect = $row_RecordSystemConfigFr['AbouteSearchSelect']; // 搜索功能是否開啟
/* 產品型錄功能設定 */
$CatalogSearchSelect = $row_RecordSystemConfigFr['CatalogSearchSelect']; // 搜索功能是否開啟
/* 購物車功能設定 */
/* 知識學習功能設定 */
$KnowledgeSearchSelect = $row_RecordSystemConfigFr['KnowledgeSearchSelect']; // 搜索功能是否開啟表
/* 成員幹部功能設定 */
$OrgSearchSelect = $row_RecordSystemConfigFr['OrgSearchSelect']; // 搜索功能是否開啟

$Mobile_Enable_For_User = $row_RecordSystemConfigFr['Mobile_Enable']; // 使用者是否要開啟行動裝置外觀

$CartRegSelect = $row_RecordSystemConfigFr['CartRegSelect']; // 是否要開啟註冊後購物功能

/* ----------前台功能選擇---------- */
// 主版面
$MSHome = $row_RecordSystemConfigFr['MSHome']; // 初始頁
$MSTMP = $row_RecordSystemConfigFr['MSTMP']; // 使用版型
$SiteFontSize = $row_RecordSystemConfigFr['SiteFontSize']; // 強制文字大小
//$MSBanner = $row_RecordSystemConfigFr['MSBanner']; // 橫幅
//$MSPublish = $row_RecordSystemConfigFr['MSPublish']; // 跑馬燈
// 主選單
$MSMenu = $row_RecordSystemConfigFr['MSMenu'];
// 左選單
$MSLMenu = $row_RecordSystemConfigFr['MSLMenu'];
$MSNewsNLink = $row_RecordSystemConfigFr['MSNewsNLink']; // 快訊
$MSProductHot = $row_RecordSystemConfigFr['MSProductHot']; // 人氣選單
$MSMemberLeftLogin = $row_RecordSystemConfigFr['MSMemberLeftLogin']; // 會員登入
$MSFriLinkQLink = $row_RecordSystemConfigFr['MSFriLinkQLink']; // 友站連結
$MSLMenuArticlePlus = $row_RecordSystemConfigFr['MSLMenuArticlePlus']; // 文章加值
$MSFbFan = $row_RecordSystemConfigFr['MSFbFan']; // 粉絲專頁

// 右選單
$MSNewsNLinkR = $row_RecordSystemConfigFr['MSNewsNLinkR']; // 快訊
$MSProductHotR = $row_RecordSystemConfigFr['MSProductHotR']; // 人氣選單
$MSMemberLeftLoginR = $row_RecordSystemConfigFr['MSMemberLeftLoginR']; // 會員登入
$MSFriLinkQLinkR = $row_RecordSystemConfigFr['MSFriLinkQLinkR']; // 友站連結
$MSFbFanR = $row_RecordSystemConfigFr['MSFbFanR']; // 粉絲專頁

// 初始統計人次
$SiteStartCounter = $row_RecordSystemConfigFr['SiteStartCounter']; // 初始統計人次

// 最新訊息
$MSNews = $row_RecordSystemConfigFr['MSNews']; // 版面
$MSNewsShare = $row_RecordSystemConfigFr['MSNewsShare']; // 分享連結
$MSNewsRadom = $row_RecordSystemConfigFr['MSNewsRadom']; // 隨機文章
$MSNewsPNPage = $row_RecordSystemConfigFr['MSNewsPNPage']; // 上下頁連結
$MSNewsGood = $row_RecordSystemConfigFr['MSNewsGood']; // FB案讚
$MSNewsQA = $row_RecordSystemConfigFr['MSNewsQA']; // 問答紀錄
// 問答紀錄
$MSFaq = $row_RecordSystemConfigFr['MSFaq'];
// 產品資訊
$MSProduct = $row_RecordSystemConfigFr['MSProduct']; // 主版面
$MSProductContent = $row_RecordSystemConfigFr['MSProductContent']; // 內容版面
//$MSProductMutiContent = $row_RecordSystemConfigFr['MSProductMutiContent']; // 細部資料功能
$MSProductMutiContent = 1; // 細部資料功能
//$MSProductMutiPic = $row_RecordSystemConfigFr['MSProductMutiPic']; // 產品多圖
$MSProductMutiPic = 1; // 產品多圖
$MSProductQA = $row_RecordSystemConfigFr['MSProductQA']; // 問答紀錄
$MSProductPlus = $row_RecordSystemConfigFr['MSProductPlus']; // 加購
$MSProductShare = $row_RecordSystemConfigFr['MSProductShare']; // 分享連結
$MSProductStar = $row_RecordSystemConfigFr['MSProductStar']; // 星級評分
$MSProductCart = $row_RecordSystemConfigFr['MSProductCart']; // 購物功能

/* ----------個別樣式設定------------ */ 
//$TmpBgImage =  $row_RecordTmpBg['bgimage']; // 背景
//$TmpBgColor =  $row_RecordTmpBg['bgcolor']; // 底色
//$TmpBgRepeat=  $row_RecordTmpBg['bgrepeat']; // 重複
//$TmpBgPosition =  $row_RecordTmpBg['bgposition']; // 位置
//$TmpBgAttachment =  $row_RecordTmpBg['bgattachment']; // 定位
//$TmpBgWebName =  $row_RecordTmpBg['webname'];

$TmpLogoDefaultImg =  $row_RecordTmpLogoDefault['logoimage']; // 預設之logo
$TmpLogoDefaultWidth =  $row_RecordTmpLogoDefault['width']; // 預設之logo
$TmpLogoDefaultHeight =  $row_RecordTmpLogoDefault['height']; // 預設之logo
$TmpLogoDefaultImg_en =  $row_RecordTmpLogoDefault['logoimage_en']; // 預設之logo
$TmpLogoDefaultWidth_en =  $row_RecordTmpLogoDefault['width_en']; // 預設之logo
$TmpLogoDefaultHeight_en =  $row_RecordTmpLogoDefault['height_en']; // 預設之logo
$TmpLogoDefaultImg_cn =  $row_RecordTmpLogoDefault['logoimage_cn']; // 預設之logo
$TmpLogoDefaultWidth_cn =  $row_RecordTmpLogoDefault['width_cn']; // 預設之logo
$TmpLogoDefaultHeight_cn =  $row_RecordTmpLogoDefault['height_cn']; // 預設之logo
$TmpLogoDefaultWebName =  $row_RecordTmpLogoDefault['webname'];

$TmpLogoDefaultLogoName =  $row_RecordTmpLogoDefault['logoname'];
$TmpLogoDefaultLogoName_en =  $row_RecordTmpLogoDefault['logoname_en'];
$TmpLogoDefaultLogoName_cn =  $row_RecordTmpLogoDefault['logoname_cn'];
$TmpLogoDefaultLogoColor =  $row_RecordTmpLogoDefault['logocolor'];
$TmpLogoDefaultLogoFontSize =  $row_RecordTmpLogoDefault['logofontsize'];
$TmpLogoDefaultLogoType =  $row_RecordTmpLogoDefault['logotype'];

// 會員資訊
/* ----------樣板名稱設定------------ */ 
//$tplname = 'mobile001'; // 設定樣板之預設名稱
$tplname = $row_RecordTmpConfig['name']; // 指定樣板 此改為版面之風格
$tplid = $row_RecordTmpConfig['id']; // 指定樣板橫幅使用
$tplwebname = $row_RecordTmpConfig['webname']; // 使用設定檔之上傳資料夾名稱

$WebnameOrigin = $row_RecordTmpConfig['webnameorigin']; // 樣板的來源版型

$tplrwdboxed = $row_RecordTmpConfig['boxed']; // 版面顯示
$tplrwdboxedwidth = $row_RecordTmpConfig['boxwidth']; // 版面寬度大小
$tplrwdbasiccolor = $row_RecordTmpConfig['tmpbasiccolor']; // 版面基本色系
$tplrwdboxedhome = $row_RecordTmpConfig['boxedhome']; // 首頁版面顯示
$tplrwdhomeboxview = $row_RecordTmpConfig['tmphomeboxview']; // 版面是否沿用內頁設定

/* ----------Top Line------------ */ 
$tplrwdtoplinebgcolor = $row_RecordTmpConfig['tmptoplinebgcolor']; // 背景
$tplrwdtoplinefontcolor = $row_RecordTmpConfig['tmptoplinefontcolor']; // 文字
$tplrwdtoplinetransparent = $row_RecordTmpConfig['tmptoplinetransparent']; // 透明
$tplrwdtoplineindicate = $row_RecordTmpConfig['tmptoplineindicate']; // 顯示
$tmptoplinelangshow = $row_RecordTmpConfig['tmptoplinelangshow']; // 顯示
$tmptoplinelangicon = $row_RecordTmpConfig['tmptoplinelangicon']; // 顯示

/* ----------Mobile Menu------------ */ 
$tplrwdfootmenubgcolor = $row_RecordTmpConfig['tmpfootmenubgcolor']; // 背景
$tplrwdfootmenufontcolor = $row_RecordTmpConfig['tmpfootmenufontcolor']; // 文字
$tplrwdfootmenufontindicate = $row_RecordTmpConfig['tmpfootmenufontindicate']; // 文字隱藏 0:僅圖示 1:圖示+文字
$tplrwdfootmenutransparent = $row_RecordTmpConfig['tmpfootmenutransparent']; // 透明
$tplrwdfootmenuindicate = $row_RecordTmpConfig['tmpfootmenuindicate']; // 顯示
$tplrwdfootmenutexture = $row_RecordTmpConfig['tmpfootmenutexture']; // 紋理

/* ----------樣板功能設定---------- */
$HomeSelect = $row_RecordTmpConfig['homeselect']; // 是否有網站首頁
$HomeStyle = $row_RecordTmpConfig['homestyle']; // 網站首頁的外觀
$MobileHomeStyle = $row_RecordTmpConfig['mobilehomestyle']; // 網站首頁的外觀

$TmpMainmenuIndicate = $row_RecordTmpConfig['tmpmainmenuindicate']; // 主選單是否顯示
$TmpSubMainmenuIndicate = $row_RecordTmpConfig['tmpsubmainmenuindicate']; // 子選單是否顯示

$TmpMainmenuMod = $row_RecordTmpConfig['tmpmainmenumod']; // 行動裝置主選單適用模式
$TmpMainmenuPosition = $row_RecordTmpConfig['tmpmainmenuposition']; // 行動裝置主選單顯示位置
$TmpFootmenuData = $row_RecordTmpConfig['tmpfootmenudata']; // 頁尾選單使用資料
$TmpRwdOptimization = $row_RecordTmpConfig['tmprwdoptimization']; // 行動裝置優化

$TmpWebWidth =  $row_RecordTmpConfig['tmpwebwidth']; // 網站寬度
$TmpWebWidthUnit =  $row_RecordTmpConfig['tmpwebwidthunit']; // 網站寬度單位

$TmpWrpBoardIndicate =  $row_RecordTmpConfig['tmpwrpboardindicate']; // 網站上下邊框
$TmpWrpViewLineLocate =  $row_RecordTmpConfig['tmpviewlinelocate']; // 導覽列

$TmpLogoLocation =  $row_RecordTmpConfig['tmplogolocation']; // LOGO初始位置

$TmpMenuLocation =  $row_RecordTmpConfig['tmpmenulocation']; // MENU初始位置

$TmpMenuEffect =  $row_RecordTmpConfig['tmpmenueffect']; // MENU效果

// FB粉絲頁
$TmpFBFanSelect =  $row_RecordTmpConfig['tmpfbfanselect']; // FB粉絲頁
$TmpFBFanBoardColor =  $row_RecordTmpConfig['tmpfbfanboardcolor']; // FB粉絲頁
$TmpFBFanBkColor =  $row_RecordTmpConfig['tmpfbfanbkcolor']; // FB粉絲頁

$TmpBanner =  $row_RecordTmpConfig['tmpbanner'];
$TmpMenuSelect = $row_RecordTmpConfig['tmpmenuselect']; // 選單使用 /0/1
$TmpBodySelect = $row_RecordTmpConfig['tmpbodyselect']; // 背景使用 /0/1
$TmpDFMenuColor = $row_RecordTmpConfig['tmpdfmenucolor']; // 預設選單使用樣式 
$TmpMenuLimit = $row_RecordTmpConfig['tmpmenulimit']; // 選單限制 0:不可自訂 1:可自訂[自訂選單]

$TmpShowBlockName = $row_RecordTmpConfig['tmpshowblockname']; // 是否顯示各區塊名稱

// 首頁橫幅選擇
$TmpHomeBannerSelect = $row_RecordTmpConfig['tmphomebannerselect']; // 選擇使用哪個首頁橫幅

// 橫幅選擇
$TmpBannerChooseSelect = $row_RecordTmpConfig['tmpbannerselect']; // 

/* ----------樣板功能模組---------- */
$TmpProductBoard = $row_RecordTmpConfig['tmpproductboard']; // 產品外框
$TmpProductBoardIcon = $row_RecordTmpConfig['tmpproductboardicon']; // 產品外框小圖
$TmpProductBoardFontColor = $row_RecordTmpConfig['tmpproductboardfontcolor']; // 產品外框文字標題
$TmpProductImageMethods = $row_RecordTmpConfig['tmpproductimagemethods']; // 產品圖片顯示方式
$TmpProductImageBoard = $row_RecordTmpConfig['tmpproductimageboard']; // 產品圖片顯示外框
$TmpProductViewColumn = $row_RecordTmpConfig['tmpproductviewcolumn']; // 產品顯示方式
$TmpProjectBoard = $row_RecordTmpConfig['tmpprojectboard']; // 工程實績外框
$TmpProjectBoardIcon = $row_RecordTmpConfig['tmpprojectboardicon']; // 外框小圖
$TmpProjectImageMethods = $row_RecordTmpConfig['tmpprojectimagemethods']; // 工程實績圖片顯示方式
$TmpProjectImageBoard = $row_RecordTmpConfig['tmpprojectimageboard']; // 工程實績圖片顯示外框
$TmpAlbumBoard = $row_RecordTmpConfig['tmpalbumboard']; // 相簿展示外框
$TmpAlbumBoardIcon = $row_RecordTmpConfig['tmpalbumboardicon']; // 相簿展示外框小圖
$TmpActivitiesBoard = $row_RecordTmpConfig['tmpactivitiesboard']; // 活動花絮外框
$TmpActivitiesBoardIcon = $row_RecordTmpConfig['tmpactivitiesboardicon']; // 活動花絮外框小圖
$TmpActivitiesImageMethods = $row_RecordTmpConfig['tmpactivitiesimagemethods']; // 活動花絮圖片顯示方式
$TmpActivitiesImageBoard = $row_RecordTmpConfig['tmpactivitiesimageboard']; // 活動花絮圖片顯示外框
$TmpFrilinkBoard = $row_RecordTmpConfig['tmpfrilinkboard']; // 友站連結外框
$TmpFrilinkBoardIcon = $row_RecordTmpConfig['tmpfrilinkboardicon']; // 友站連結外框小圖
$TmpOrgBoard = $row_RecordTmpConfig['tmporgboard']; // 組織成員外框
$TmpOrgBoardIcon = $row_RecordTmpConfig['tmporgboardicon']; // 組織成員外框小圖
$TmpSponsorBoard = $row_RecordTmpConfig['tmpsponsorboard']; // 品牌介紹外框
$TmpSponsorBoardIcon = $row_RecordTmpConfig['tmpsponsorboardicon']; // 品牌介紹外框小圖
$TmpPartnerBoard = $row_RecordTmpConfig['tmppartnerboard']; // 合作夥伴外框
$TmpPartnerBoardIcon = $row_RecordTmpConfig['tmppartnerboardicon']; // 合作夥伴外框小圖
$TmpArtlistBoard = $row_RecordTmpConfig['tmpartlistboard']; // 藝文專欄外框
$TmpArtlistBoardIcon = $row_RecordTmpConfig['tmpartlistboardicon']; // 藝文專欄外框小圖
$TmpPublishIndicate =  $row_RecordTmpConfig['tmppublishindicate']; // 發布資訊是否顯示(預設顯示)
$TmpFaqState =  $row_RecordTmpConfig['tmpfaqstate']; // 常見問答顯示狀態
$TmpFaqTitleFontColor =  $row_RecordTmpConfig['tmpfaqtitlefontcolor']; // 常見問答文字顏色
$TmpFaqTitleFontSize =  $row_RecordTmpConfig['tmpfaqtitlefontsize']; // 常見問答文字大小
$TmpFaqBgColor =  $row_RecordTmpConfig['tmpfaqbgcolor']; // 常見問答背景顏色
$TmpFaqShadow =  $row_RecordTmpConfig['tmpfaqshadow']; // 常見問答陰影狀態

/* ----------樣板功能模組(首頁)---------- */
$TmpHomeProductMod = $row_RecordTmpConfig['tmphomeproductmod']; // 產品首頁顯示模式

/* ----------樣板整站設定---------- */
$TmpLogo =  $row_RecordTmpLogo['logoimage']; // logo
$TmpLogoWidth =  $row_RecordTmpLogo['width']; // logo
$TmpLogoHeight =  $row_RecordTmpLogo['height']; // logo
$TmpLogo_en =  $row_RecordTmpLogo['logoimage_en']; // logo
$TmpLogoWidth_en =  $row_RecordTmpLogo['width_en']; // logo
$TmpLogoHeight_en =  $row_RecordTmpLogo['height_en']; // logo
$TmpLogo_cn =  $row_RecordTmpLogo['logoimage_cn']; // logo
$TmpLogoWidth_cn =  $row_RecordTmpLogo['width_cn']; // logo
$TmpLogoHeight_cn =  $row_RecordTmpLogo['height_cn']; // logo
$TmpLogo_jp =  $row_RecordTmpLogo['logoimage_jp']; // logo
$TmpLogoWidth_jp =  $row_RecordTmpLogo['width_jp']; // logo
$TmpLogoHeight_jp =  $row_RecordTmpLogo['height_jp']; // logo
//$TmpLogo =  $row_RecordTmpConfig['tmplogo']; // logo
//$TmpLogoWidth =  $row_RecordTmpConfig['tmplogowidth']; // logo
//$TmpLogoHeight =  $row_RecordTmpConfig['tmplogoheight']; // logo
$TmpLogoMarginTop =  $row_RecordTmpConfig['tmplogomargintop']; // logo
$TmpLogoMarginLeft =  $row_RecordTmpConfig['tmplogomarginleft']; // logo
$TmpLogoWebname =  $row_RecordTmpLogo['webname']; // logo

$TmpLogoLogoName =  $row_RecordTmpLogo['logoname'];
$TmpLogoLogoName_en =  $row_RecordTmpLogo['logoname_en'];
$TmpLogoLogoName_cn =  $row_RecordTmpLogo['logoname_cn'];
$TmpLogoLogoName_jp =  $row_RecordTmpLogo['logoname_jp'];
$TmpLogoLogoColor =  $row_RecordTmpLogo['logocolor'];
$TmpLogoLogoFontSize =  $row_RecordTmpLogo['logofontsize'];
$TmpLogoLogoType =  $row_RecordTmpLogo['logotype'];

$TmpHomeLogo =  $row_RecordTmpHomeLogo['logoimage']; // logo
$TmpHomeLogoWidth =  $row_RecordTmpHomeLogo['width']; // logo
$TmpHomeLogoHeight =  $row_RecordTmpHomeLogo['height']; // logo
$TmpHomeLogo_en =  $row_RecordTmpHomeLogo['logoimage_en']; // logo
$TmpHomeLogoWidth_en =  $row_RecordTmpHomeLogo['width_en']; // logo
$TmpHomeLogoHeight_en =  $row_RecordTmpHomeLogo['height_en']; // logo
$TmpHomeLogo_cn =  $row_RecordTmpHomeLogo['logoimage_cn']; // logo
$TmpHomeLogoWidth_cn =  $row_RecordTmpHomeLogo['width_cn']; // logo
$TmpHomeLogoHeight_cn =  $row_RecordTmpHomeLogo['height_cn']; // logo
$TmpHomeLogoMarginTop =  $row_RecordTmpConfig['tmphomelogomargintop']; // logo
$TmpHomeLogoMarginLeft =  $row_RecordTmpConfig['tmphomelogomarginleft']; // logo
$TmpHomeLogoWebname =  $row_RecordTmpHomeLogo['webname']; // logo

$TmpHomeLogoName =  $row_RecordTmpHomeLogo['logoname'];
$TmpHomeLogoName_en =  $row_RecordTmpHomeLogo['logoname_en'];
$TmpHomeLogoName_cn =  $row_RecordTmpHomeLogo['logoname_cn'];
$TmpHomeLogoName_jp =  $row_RecordTmpHomeLogo['logoname_jp'];
$TmpHomeLogoColor =  $row_RecordTmpHomeLogo['logocolor'];
$TmpHomeLogoFontSize =  $row_RecordTmpHomeLogo['logofontsize'];
$TmpHomeLogoType =  $row_RecordTmpHomeLogo['logotype'];

$TmpHomeEnterSelect =  $row_RecordTmpConfig['tmphomeenterselect']; // enter
$TmpHomeEnterDefaultPic =  $row_RecordTmpConfig['tmphomeenterdefaultpic']; // enter
$TmpHomeEnterPic =  $row_RecordTmpConfig['tmphomeenterpic']; // enter
$TmpHomeEnterPicSource =  $row_RecordTmpConfig['tmphomeenterpicsource']; // enter
$TmpHomeEnterMarginBottom =  $row_RecordTmpConfig['tmphomeentermarginbottom']; // enter
$TmpHomeEnterMarginRight =  $row_RecordTmpConfig['tmphomeentermarginright']; // enter

$TmpBanner1 =  $row_RecordTmpConfig['tmpautobanner1']; // 橫幅
$TmpBanner2 =  $row_RecordTmpConfig['tmpautobanner2']; // 橫幅
$TmpBanner3 =  $row_RecordTmpConfig['tmpautobanner3']; // 橫幅
$TmpBanner4 =  $row_RecordTmpConfig['tmpautobanner4']; // 橫幅
$TmpBanner5 =  $row_RecordTmpConfig['tmpautobanner5']; // 橫幅

$TmpDftMenu_X =  $row_RecordTmpConfig['tmpdftmenu_x']; // 樣板選單
$TmpDftMenu_Y =  $row_RecordTmpConfig['tmpdftmenu_y']; // 樣板選單

$TmpPicMenu_X =  $row_RecordTmpConfig['tmppicmenu_x']; // 圖片選單
$TmpPicMenu_Y =  $row_RecordTmpConfig['tmppicmenu_y']; // 圖片選單
$TmpPicMenu_Style =  $row_RecordTmpConfig['tmppicmenu_style']; // 圖片選單

$TmpBannerPic =  $row_RecordTmpConfig['tmpbannerpic']; // 橫幅
$TmpBannerPicWidth =  $row_RecordTmpConfig['tmpbannerpicwidth']; // 橫幅
$TmpBannerPicHeight =  $row_RecordTmpConfig['tmpbannerpicheight']; // 橫幅

$TmpWordColor =  $row_RecordTmpConfig['tmpwordcolor']; // 文字顏色
$TmpWordSize =  $row_RecordTmpConfig['tmpwordsize']; // 文字大小
$TmpLink =  $row_RecordTmpConfig['tmplink']; // 文字連結
$TmpLinkVisit =  $row_RecordTmpConfig['tmplinkvisit']; // 文字連結
$TmpLinkHover =  $row_RecordTmpConfig['tmplinkhover']; // 文字連結

$TmpHeaderMinHeight =  $row_RecordTmpConfig['tmpheaderminheight']; // 最小高度
$TmpLeftMinHeight =  $row_RecordTmpConfig['tmpleftminheight']; // 最小高度
$TmpMiddleMinHeight =  $row_RecordTmpConfig['tmpmiddleminheight']; // 最小高度
$TmpRightMinHeight =  $row_RecordTmpConfig['tmprightminheight']; // 最小高度
$TmpFooterMinHeight =  $row_RecordTmpConfig['tmpfooterminheight']; // 最小高度

$TmpHeaderPaddingTop =  $row_RecordTmpConfig['tmpheaderpaddingtop']; // 內距
$TmpHeaderPaddingBottom =  $row_RecordTmpConfig['tmpheaderpaddingbttom']; // 內距
$TmpHeaderPaddingLeft =  $row_RecordTmpConfig['tmpheaderpaddingleft']; // 內距
$TmpHeaderPaddingRight =  $row_RecordTmpConfig['tmpheaderpaddingright']; // 內距

$TmpBannerPaddingTop =  $row_RecordTmpConfig['tmpbannerpaddingtop']; // 內距
$TmpBannerPaddingBottom =  $row_RecordTmpConfig['tmpbannerpaddingbttom']; // 內距
$TmpBannerPaddingLeft =  $row_RecordTmpConfig['tmpbannerpaddingleft']; // 內距
$TmpBannerPaddingRight =  $row_RecordTmpConfig['tmpbannerpaddingright']; // 內距

$TmpLeftPaddingTop =  $row_RecordTmpConfig['tmpleftpaddingtop']; // 內距
$TmpLeftPaddingBottom =  $row_RecordTmpConfig['tmpleftpaddingbttom']; // 內距
$TmpLeftPaddingLeft =  $row_RecordTmpConfig['tmpleftpaddingleft']; // 內距
$TmpLeftPaddingRight =  $row_RecordTmpConfig['tmpleftpaddingright']; // 內距

$TmpLeftFontColor =  $row_RecordTmpConfig['tmpleftfontcolor']; // 文字顏色

$TmpRightPaddingTop =  $row_RecordTmpConfig['tmprightpaddingtop']; // 內距
$TmpRightPaddingBottom =  $row_RecordTmpConfig['tmprightpaddingbttom']; // 內距
$TmpRightPaddingLeft =  $row_RecordTmpConfig['tmprightpaddingleft']; // 內距
$TmpRightPaddingRight =  $row_RecordTmpConfig['tmprightpaddingright']; // 內距

$TmpMiddlePaddingTop =  $row_RecordTmpConfig['tmpmiddlepaddingtop']; // 內距
$TmpMiddlePaddingBottom =  $row_RecordTmpConfig['tmpmiddlepaddingbttom']; // 內距
$TmpMiddlePaddingLeft =  $row_RecordTmpConfig['tmpmiddlepaddingleft']; // 內距
$TmpMiddlePaddingRight =  $row_RecordTmpConfig['tmpmiddlepaddingright']; // 內距

$TmpMiddleFontColor =  $row_RecordTmpConfig['tmpmiddlefontcolor']; // 文字顏色

$TmpFooterPaddingTop =  $row_RecordTmpConfig['tmpfooterpaddingtop']; // 內距
$TmpFooterPaddingBottom =  $row_RecordTmpConfig['tmpfooterpaddingbttom']; // 內距
$TmpFooterPaddingLeft =  $row_RecordTmpConfig['tmpfooterpaddingleft']; // 內距
$TmpFooterPaddingRight =  $row_RecordTmpConfig['tmpfooterpaddingright']; // 內距

// 外框合併
$TmpMergerTitleAndMiddle = $row_RecordTmpConfig['tmpmeger_t_m']; // 中央區塊標題

// 分類標籤
$TmpTypeMenuBtnIndicate = $row_RecordTmpConfig['typemenubtnindicate']; // 是否顯示
$TmpTypeMenuBtnBgColor = $row_RecordTmpConfig['typemenubtnbgcolor']; // 背景色
$TmpTypeMenuBtnFontColor = $row_RecordTmpConfig['typemenubtnfontcolor']; // 文字顏色

// ToTop
$TmpToTopMode = $row_RecordTmpConfig['tmptotopmode']; 
$TmpToTopWidth = $row_RecordTmpConfig['tmptotopimgwidth']; 
$TmpToTopHeight = $row_RecordTmpConfig['tmptotopimgheight']; 
$TmpToTopImg = $row_RecordTmpConfig['tmptotopimg']; 

/* ----------樣板區塊主選單設定---------- */
$TmpMainMenuLImg = $row_RecordTmpMainMenu['tmp_mainmenu_l_img'];
$TmpMainMenuRImg = $row_RecordTmpMainMenu['tmp_mainmenu_r_img'];
$TmpMainMenuOImg = $row_RecordTmpMainMenu['tmp_mainmenu_o_img'];
$TmpMainMenuLocation = $row_RecordTmpMainMenu['tmp_mainmenu_location']; // 0 原始位置 1 放置於header下方
$TmpMainMenuHeight = $row_RecordTmpMainMenu['tmp_mainmenupic_height'];
$TmpMainMenuColor = $row_RecordTmpMainMenu['tmp_mainmenu_color'];
$TmpMainMenuWidth = $row_RecordTmpMainMenu['tmp_mainmenu_width'];
$TmpMainMenuImg = $row_RecordTmpMainMenu['tmp_mainmenu_img'];
$TmpMainMenuHoverColor = $row_RecordTmpMainMenu['tmp_mainmenu_hovercolor'];
$TmpMainMenuHoverImg = $row_RecordTmpMainMenu['tmp_mainmenu_hover_img'];
$TmpMainMenuFontSize = $row_RecordTmpMainMenu['tmp_mainmenu_font_size'];
$TmpMainMenuFontStyle = $row_RecordTmpMainMenu['tmp_mainmenu_font_style'];
$TmpMainMenuWebName = $row_RecordTmpMainMenu['webname'];

/* ----------樣板區塊左選單設定---------- */
$TmpLeftMenuTitlePic = $row_RecordTmpLeftMenu['tmp_title_pic'];
$TmpLeftMenuMiddlePic = $row_RecordTmpLeftMenu['tmp_middle_pic'];
$TmpLeftMenuMiddleOPic = $row_RecordTmpLeftMenu['tmp_middle_o_pic'];
$TmpLeftMenuBottomPic = $row_RecordTmpLeftMenu['tmp_bottom_pic'];
$TmpLeftMenuFontColor = $row_RecordTmpLeftMenu['tmp_a_font_color'];
$TmpLeftMenuFontOColor = $row_RecordTmpLeftMenu['tmp_a_o_font_color'];
$TmpLeftMenuFontLocation = $row_RecordTmpLeftMenu['tmp_a_font_location'];
$TmpLeftMenuWebName = $row_RecordTmpLeftMenu['webname'];

/* ----------樣板區塊背景設定---------- */
// HomeBody框架
$TmpHomeBodyBgImage =  $row_RecordTmpHomeBodyBg['bgimage']; // 背景
$TmpHomeBodyBgColor =  $row_RecordTmpHomeBodyBg['bgcolor']; // 底色
$TmpHomeBodyBgRepeat=  $row_RecordTmpHomeBodyBg['bgrepeat']; // 重複
$TmpHomeBodyBgPosition =  $row_RecordTmpHomeBodyBg['bgposition']; // 位置
$TmpHomeBodyBgAttachment =  $row_RecordTmpHomeBodyBg['bgattachment']; // 定位
$TmpHomeBodyBgWebName = $row_RecordTmpHomeBodyBg['webname'];

// HomeAnime框架
$TmpHomeAnimeBgImage =  $row_RecordTmpHomeAnimeBg['bgimage']; // 背景
$TmpHomeAnimeBgColor =  $row_RecordTmpHomeAnimeBg['bgcolor']; // 底色
$TmpHomeAnimeBgRepeat=  $row_RecordTmpHomeAnimeBg['bgrepeat']; // 重複
$TmpHomeAnimeBgPosition =  $row_RecordTmpHomeAnimeBg['bgposition']; // 位置
$TmpHomeAnimeBgAttachment =  $row_RecordTmpHomeAnimeBg['bgattachment']; // 定位
$TmpHomeAnimeBgWebName = $row_RecordTmpHomeAnimeBg['webname'];

// HomeBottom框架
$TmpHomeBottomBgImage =  $row_RecordTmpHomeBottomBg['bgimage']; // 背景
$TmpHomeBottomBgColor =  $row_RecordTmpHomeBottomBg['bgcolor']; // 底色
$TmpHomeBottomBgRepeat=  $row_RecordTmpHomeBottomBg['bgrepeat']; // 重複
$TmpHomeBottomBgPosition =  $row_RecordTmpHomeBottomBg['bgposition']; // 位置
$TmpHomeBottomBgAttachment =  $row_RecordTmpHomeBottomBg['bgattachment']; // 定位
$TmpHomeBottomBgWebName = $row_RecordTmpHomeBottomBg['webname'];

// Body框架
$TmpBodyBgImage =  $row_RecordTmpBodyBg['bgimage']; // 背景
$TmpBodyBgColor =  $row_RecordTmpBodyBg['bgcolor']; // 底色
$TmpBodyBgRepeat=  $row_RecordTmpBodyBg['bgrepeat']; // 重複
$TmpBodyBgPosition =  $row_RecordTmpBodyBg['bgposition']; // 位置
$TmpBodyBgAttachment =  $row_RecordTmpBodyBg['bgattachment']; // 定位
$TmpBodyWebName = $row_RecordTmpBodyBg['webname'];

// Anime框架
$TmpAnimeBgImage =  $row_RecordTmpAnimeBg['bgimage']; // 背景
$TmpAnimeBgColor =  $row_RecordTmpAnimeBg['bgcolor']; // 底色
$TmpAnimeBgRepeat=  $row_RecordTmpAnimeBg['bgrepeat']; // 重複
$TmpAnimeBgPosition =  $row_RecordTmpAnimeBg['bgposition']; // 位置
$TmpAnimeBgAttachment =  $row_RecordTmpAnimeBg['bgattachment']; // 定位
$TmpAnimeBgWebName = $row_RecordTmpAnimeBg['webname'];

// Bottom框架
$TmpBottomBgImage =  $row_RecordTmpBottomBg['bgimage']; // 背景
$TmpBottomBgColor =  $row_RecordTmpBottomBg['bgcolor']; // 底色
$TmpBottomBgRepeat=  $row_RecordTmpBottomBg['bgrepeat']; // 重複
$TmpBottomBgPosition =  $row_RecordTmpBottomBg['bgposition']; // 位置
$TmpBottomBgAttachment =  $row_RecordTmpBottomBg['bgattachment']; // 定位
$TmpBottomBgWebName = $row_RecordTmpBottomBg['webname'];

// 整站框架
$TmpWrpBgImage =  $row_RecordTmpWrpBg['bgimage']; // 背景
$TmpWrpBgColor =  $row_RecordTmpWrpBg['bgcolor']; // 底色
$TmpWrpBgRepeat=  $row_RecordTmpWrpBg['bgrepeat']; // 重複
$TmpWrpBgPosition =  $row_RecordTmpWrpBg['bgposition']; // 位置
$TmpWrpBgAttachment =  $row_RecordTmpWrpBg['bgattachment']; // 定位
$TmpWrpBgWebName = $row_RecordTmpWrpBg['webname'];

// 上方區塊
$TmpHeaderBgImage =  $row_RecordTmpHeaderBg['bgimage']; // 背景
$TmpHeaderBgColor =  $row_RecordTmpHeaderBg['bgcolor']; // 底色
$TmpHeaderBgRepeat=  $row_RecordTmpHeaderBg['bgrepeat']; // 重複
$TmpHeaderBgPosition =  $row_RecordTmpHeaderBg['bgposition']; // 位置
$TmpHeaderBgAttachment =  $row_RecordTmpHeaderBg['bgattachment']; // 定位
$TmpHeaderBgSize =  $row_RecordTmpHeaderBg['bgsize']; // 縮放
$TmpHeaderBgWebName = $row_RecordTmpHeaderBg['webname'];
$TmpHeaderBgWebName = $row_RecordTmpHeaderBg['webname'];

// 左區塊
$TmpLeftBgImage =  $row_RecordTmpLeftBg['bgimage']; // 背景
$TmpLeftBgColor =  $row_RecordTmpLeftBg['bgcolor']; // 底色
$TmpLeftBgRepeat=  $row_RecordTmpLeftBg['bgrepeat']; // 重複
$TmpLeftBgPosition =  $row_RecordTmpLeftBg['bgposition']; // 位置
$TmpLeftBgAttachment =  $row_RecordTmpLeftBg['bgattachment']; // 定位
$TmpLeftBgWebName = $row_RecordTmpLeftBg['webname'];

// 右區塊
$TmpRightBgImage =  $row_RecordTmpRightBg['bgimage']; // 背景
$TmpRightBgColor =  $row_RecordTmpRightBg['bgcolor']; // 底色
$TmpRightBgRepeat=  $row_RecordTmpRightBg['bgrepeat']; // 重複
$TmpRightBgPosition =  $row_RecordTmpRightBg['bgposition']; // 位置
$TmpRightBgAttachment =  $row_RecordTmpRightBg['bgattachment']; // 定位
$TmpRightBgWebName = $row_RecordTmpRightBg['webname'];

// 中央區塊
$TmpMiddleBgImage =  $row_RecordTmpMiddleBg['bgimage']; // 背景
$TmpMiddleBgColor =  $row_RecordTmpMiddleBg['bgcolor']; // 底色
$TmpMiddleBgRepeat=  $row_RecordTmpMiddleBg['bgrepeat']; // 重複
$TmpMiddleBgPosition =  $row_RecordTmpMiddleBg['bgposition']; // 位置
$TmpMiddleBgAttachment =  $row_RecordTmpMiddleBg['bgattachment']; // 定位
$TmpMiddleBgWebName = $row_RecordTmpMiddleBg['webname'];

// 表尾區塊
$TmpFooterBgImage =  $row_RecordTmpFooterBg['bgimage']; // 背景
$TmpFooterBgColor =  $row_RecordTmpFooterBg['bgcolor']; // 底色
$TmpFooterBgRepeat=  $row_RecordTmpFooterBg['bgrepeat']; // 重複
$TmpFooterBgPosition =  $row_RecordTmpFooterBg['bgposition']; // 位置
$TmpFooterBgAttachment =  $row_RecordTmpFooterBg['bgattachment']; // 定位
$TmpFooterBgWebName = $row_RecordTmpFooterBg['webname'];

$TmpFooterFontColor = $row_RecordTmpConfig['tmpfooterfontcolor']; // 文字顏色

// 標題區塊
$TmpTitleBgImage =  $row_RecordTmpTitleBg['bgimage']; // 背景
$TmpTitleBgColor =  $row_RecordTmpTitleBg['bgcolor']; // 底色
$TmpTitleBgRepeat=  $row_RecordTmpTitleBg['bgrepeat']; // 重複
$TmpTitleBgPosition =  $row_RecordTmpTitleBg['bgposition']; // 位置
$TmpTitleBgAttachment =  $row_RecordTmpTitleBg['bgattachment']; // 定位
$TmpTitleBgWebName = $row_RecordTmpTitleBg['webname'];

// 標題區塊(LINE)
$TmpTitleLineBgImage =  $row_RecordTmpTitleLineBg['bgimage']; // 背景
$TmpTitleLineBgColor =  $row_RecordTmpTitleLineBg['bgcolor']; // 底色
$TmpTitleLineBgRepeat=  $row_RecordTmpTitleLineBg['bgrepeat']; // 重複
$TmpTitleLineBgPosition =  $row_RecordTmpTitleLineBg['bgposition']; // 位置
$TmpTitleLineBgAttachment =  $row_RecordTmpTitleLineBg['bgattachment']; // 定位
$TmpTitleLineBgWebName = $row_RecordTmpTitleLineBg['webname'];

$TmpTitleLineFontColor = $row_RecordTmpConfig['tmp_middle_title_font_color'];
$TmpTitleLineX = $row_RecordTmpConfig['tmp_middle_title_x'];
$TmpTitleLineHeight = $row_RecordTmpConfig['tmp_middle_title_height'];
$TmpTitleLineIndicate = $row_RecordTmpConfig['tmp_middle_title_indicate'];

$TmpTitleLineLocation = $row_RecordTmpConfig['tmp_middle_title_location'];
$TmpTitleLineWidth = $row_RecordTmpConfig['tmp_middle_title_width'];
$TmpTitleLineLocationY = $row_RecordTmpConfig['tmp_middle_title_location_y'];
$TmpTitleLineLocationX = $row_RecordTmpConfig['tmp_middle_title_location_x'];
$TmpTitleLineBlockY = $row_RecordTmpConfig['tmp_middle_title_block_y'];
$TmpTitleLinePostContentY = $row_RecordTmpConfig['tmp_middle_title_post_content_y'];
$TmpTitleLineMarquee = $row_RecordTmpConfig['tmp_middle_title_marquee'];
if($TmpTitleLineMarquee == '1') { $ClassMaquree = "marquee"; } /* 設定跑馬燈類別 */

// 側邊裝飾外框
$TmpBlockWebName =  $row_RecordTmpBlock['webname'];
$TmpBlockTitlePic =  $row_RecordTmpBlock['tmp_title_pic']; 
$TmpBlockTitleFontColor =  $row_RecordTmpBlock['tmp_a_font_color']; 
$TmpBlockBottomPic=  $row_RecordTmpBlock['tmp_bottom_pic']; 
$TmpBlockMiddlePic =  $row_RecordTmpBlock['tmp_middle_pic']; 
$TmpBlockStyle =  $row_RecordTmpBlock['tmp_block_style'];
$TmpBlockWidth = $row_RecordTmpBlock['tmp_block_width'];
$TmpBlockColor = $row_RecordTmpBlock['tmp_block_color'];
$TmpBlockBgColor = $row_RecordTmpBlock['tmp_block_background_color'];
$TmpBlockTitleHight = $row_RecordTmpBlock['tmp_b_t_hight'];
$TmpBlockTitleLeft = $row_RecordTmpBlock['tmp_b_t_left'];
$TmpBlockTitleRepet = $row_RecordTmpBlock['tmp_b_t_repet'];
$TmpBlockTitlePosition = $row_RecordTmpBlock['tmp_b_t_position'];
$TmpBlockMiddleRepet = $row_RecordTmpBlock['tmp_b_m_repet'];
$TmpBlockMiddlePosition = $row_RecordTmpBlock['tmp_b_m_position'];

/* ----------樣板更能模組設定---------- */
// 最新訊息
$TmpNewsEvenBgImage =  $row_RecordTmpNewsEvenBg['bgimage']; // 背景
$TmpNewsEvenBgColor =  $row_RecordTmpNewsEvenBg['bgcolor']; // 底色
$TmpNewsEvenBgRepeat=  $row_RecordTmpNewsEvenBg['bgrepeat']; // 重複
$TmpNewsEvenBgPosition =  $row_RecordTmpNewsEvenBg['bgposition']; // 位置
$TmpNewsEvenBgWebName = $row_RecordTmpNewsEvenBg['webname'];

$TmpNewsOddBgImage =  $row_RecordTmpNewsOddBg['bgimage']; // 背景
$TmpNewsOddBgColor =  $row_RecordTmpNewsOddBg['bgcolor']; // 底色
$TmpNewsOddBgRepeat=  $row_RecordTmpNewsOddBg['bgrepeat']; // 重複
$TmpNewsOddBgPosition =  $row_RecordTmpNewsOddBg['bgposition']; // 位置
$TmpNewsOddBgWebName = $row_RecordTmpNewsOddBg['webname'];

/* ----------樣板區塊外框設定---------- */
// 首頁
$Tmp_Home_W_Marge_Top =  $row_RecordTmpHomeBoard['tmp_w_marge_top']; // 外框間距
$Tmp_Home_W_Marge_Bottom =  $row_RecordTmpHomeBoard['tmp_w_marge_bottom']; // 外框間距
$Tmp_Home_W_Marge_Left =  $row_RecordTmpHomeBoard['tmp_w_marge_left']; // 外框間距
$Tmp_Home_W_Marge_Right =  $row_RecordTmpHomeBoard['tmp_w_marge_right']; // 外框間距

$Tmp_Home_W_Padding_Top =  $row_RecordTmpHomeBoard['tmp_w_padding_top']; // 內框間距
$Tmp_Home_W_Padding_Bottom =  $row_RecordTmpHomeBoard['tmp_w_padding_bottom']; // 內框間距
$Tmp_Home_W_Padding_Left =  $row_RecordTmpHomeBoard['tmp_w_padding_left']; // 內框間距
$Tmp_Home_W_Padding_Right =  $row_RecordTmpHomeBoard['tmp_w_padding_right']; // 內框間距

$Tmp_Home_W_Font_Color =  $row_RecordTmpHomeBoard['tmp_w_font_color']; // 文字顏色
$Tmp_Home_W_Board_Style =  $row_RecordTmpHomeBoard['tmp_w_board_style']; // 邊框樣式
$Tmp_Home_W_Board_Width =  $row_RecordTmpHomeBoard['tmp_w_board_width']; // 邊框寬度
$Tmp_Home_W_Board_Color =  $row_RecordTmpHomeBoard['tmp_w_board_color']; // 邊框顏色
$Tmp_Home_W_Background_Color =  $row_RecordTmpHomeBoard['tmp_w_background_color']; // 背景顏色
$Tmp_Home_W_Background_Img =  $row_RecordTmpHomeBoard['tmp_w_background_img']; // 背景
$Tmp_Home_W_Background_WebName = $row_RecordTmpHomeBoard['webname'];

//only css3
$Tmp_Home_BorderRadius_T_L = $row_RecordTmpHomeBoard['borderradius_t_l'];
$Tmp_Home_BorderRadius_T_R = $row_RecordTmpHomeBoard['borderradius_t_r'];
$Tmp_Home_BorderRadius_B_L = $row_RecordTmpHomeBoard['borderradius_b_l'];
$Tmp_Home_BorderRadius_B_R = $row_RecordTmpHomeBoard['borderradius_b_r'];
$Tmp_Home_BoxShadow_X = $row_RecordTmpHomeBoard['boxshadow_x'];
$Tmp_Home_BoxShadow_Y = $row_RecordTmpHomeBoard['boxshadow_y'];
$Tmp_Home_BoxShadow_Size = $row_RecordTmpHomeBoard['boxshadow_size'];
$Tmp_Home_BoxShadow_Color = $row_RecordTmpHomeBoard['boxshadow_color'];
$Tmp_Home_LinearGradient_Top = $row_RecordTmpHomeBoard['lineargradient_top'];
$Tmp_Home_LinearGradient_Bottom = $row_RecordTmpHomeBoard['lineargradient_bottom'];

$Tmp_Home_L_T_Background_Img =  $row_RecordTmpHomeBoard['tmp_l_t_background_img']; // 九宮格
$Tmp_Home_L_T_Repeat =  $row_RecordTmpHomeBoard['tmp_l_t_repeat']; // 九宮格
$Tmp_Home_L_T_Width =  $row_RecordTmpHomeBoard['tmp_l_t_width']; // 九宮格
$Tmp_Home_L_T_Height =  $row_RecordTmpHomeBoard['tmp_l_t_height']; // 九宮格

$Tmp_Home_M_T_Background_Img =  $row_RecordTmpHomeBoard['tmp_m_t_background_img']; // 九宮格
$Tmp_Home_M_T_Repeat =  $row_RecordTmpHomeBoard['tmp_m_t_repeat']; // 九宮格
$Tmp_Home_M_T_Height =  $row_RecordTmpHomeBoard['tmp_m_t_height']; // 九宮格

$Tmp_Home_R_T_Background_Img =  $row_RecordTmpHomeBoard['tmp_r_t_background_img']; // 九宮格
$Tmp_Home_R_T_Repeat =  $row_RecordTmpHomeBoard['tmp_r_t_repeat']; // 九宮格
$Tmp_Home_R_T_Width =  $row_RecordTmpHomeBoard['tmp_r_t_width']; // 九宮格
$Tmp_Home_R_T_Height =  $row_RecordTmpHomeBoard['tmp_r_t_height']; // 九宮格

$Tmp_Home_L_M_Background_Img =  $row_RecordTmpHomeBoard['tmp_l_m_background_img']; // 九宮格
$Tmp_Home_L_M_Repeat =  $row_RecordTmpHomeBoard['tmp_l_m_repeat']; // 九宮格
$Tmp_Home_L_M_Width =  $row_RecordTmpHomeBoard['tmp_l_m_width']; // 九宮格

$Tmp_Home_M_M_Background_Img =  $row_RecordTmpHomeBoard['tmp_m_m_background_img']; // 九宮格
$Tmp_Home_M_M_Repeat =  $row_RecordTmpHomeBoard['tmp_m_m_repeat']; // 九宮格

$Tmp_Home_R_M_Background_Img =  $row_RecordTmpHomeBoard['tmp_r_m_background_img']; // 九宮格
$Tmp_Home_R_M_Repeat =  $row_RecordTmpHomeBoard['tmp_r_m_repeat']; // 九宮格
$Tmp_Home_R_M_Width =  $row_RecordTmpHomeBoard['tmp_r_m_width']; // 九宮格

$Tmp_Home_L_B_Background_Img =  $row_RecordTmpHomeBoard['tmp_l_b_background_img']; // 九宮格
$Tmp_Home_L_B_Repeat =  $row_RecordTmpHomeBoard['tmp_l_b_repeat']; // 九宮格
$Tmp_Home_L_B_Width =  $row_RecordTmpHomeBoard['tmp_l_b_width']; // 九宮格
$Tmp_Home_L_B_Height =  $row_RecordTmpHomeBoard['tmp_l_b_height']; // 九宮格

$Tmp_Home_M_B_Background_Img =  $row_RecordTmpHomeBoard['tmp_m_b_background_img']; // 九宮格
$Tmp_Home_M_B_Repeat =  $row_RecordTmpHomeBoard['tmp_m_b_repeat']; // 九宮格
$Tmp_Home_M_B_Height =  $row_RecordTmpHomeBoard['tmp_m_b_height']; // 九宮格

$Tmp_Home_R_B_Background_Img =  $row_RecordTmpHomeBoard['tmp_r_b_background_img']; // 九宮格
$Tmp_Home_R_B_Repeat =  $row_RecordTmpHomeBoard['tmp_r_b_repeat']; // 九宮格
$Tmp_Home_R_B_Width =  $row_RecordTmpHomeBoard['tmp_r_b_width']; // 九宮格
$Tmp_Home_R_B_Height =  $row_RecordTmpHomeBoard['tmp_r_b_height']; // 九宮格

// 大外框
$Tmp_Wrp_W_Marge_Top =  $row_RecordTmpWrpBoard['tmp_w_marge_top']; // 外框間距
$Tmp_Wrp_W_Marge_Bottom =  $row_RecordTmpWrpBoard['tmp_w_marge_bottom']; // 外框間距
$Tmp_Wrp_W_Marge_Left =  $row_RecordTmpWrpBoard['tmp_w_marge_left']; // 外框間距
$Tmp_Wrp_W_Marge_Right =  $row_RecordTmpWrpBoard['tmp_w_marge_right']; // 外框間距

$Tmp_Wrp_W_Padding_Top =  $row_RecordTmpWrpBoard['tmp_w_padding_top']; // 內框間距
$Tmp_Wrp_W_Padding_Bottom =  $row_RecordTmpWrpBoard['tmp_w_padding_bottom']; // 內框間距
$Tmp_Wrp_W_Padding_Left =  $row_RecordTmpWrpBoard['tmp_w_padding_left']; // 內框間距
$Tmp_Wrp_W_Padding_Right =  $row_RecordTmpWrpBoard['tmp_w_padding_right']; // 內框間距

$Tmp_Wrp_W_Font_Color =  $row_RecordTmpWrpBoard['tmp_w_font_color']; // 文字顏色
$Tmp_Wrp_W_Board_Style =  $row_RecordTmpWrpBoard['tmp_w_board_style']; // 邊框樣式
$Tmp_Wrp_W_Board_Width =  $row_RecordTmpWrpBoard['tmp_w_board_width']; // 邊框寬度
$Tmp_Wrp_W_Board_Color =  $row_RecordTmpWrpBoard['tmp_w_board_color']; // 邊框顏色
$Tmp_Wrp_W_Background_Color =  $row_RecordTmpWrpBoard['tmp_w_background_color']; // 背景顏色
$Tmp_Wrp_W_Background_Img =  $row_RecordTmpWrpBoard['tmp_w_background_img']; // 背景
$Tmp_Wrp_W_Background_WebName = $row_RecordTmpWrpBoard['webname'];

//only css3
$Tmp_Wrp_BorderRadius_T_L = $row_RecordTmpWrpBoard['borderradius_t_l'];
$Tmp_Wrp_BorderRadius_T_R = $row_RecordTmpWrpBoard['borderradius_t_r'];
$Tmp_Wrp_BorderRadius_B_L = $row_RecordTmpWrpBoard['borderradius_b_l'];
$Tmp_Wrp_BorderRadius_B_R = $row_RecordTmpWrpBoard['borderradius_b_r'];
$Tmp_Wrp_BoxShadow_X = $row_RecordTmpWrpBoard['boxshadow_x'];
$Tmp_Wrp_BoxShadow_Y = $row_RecordTmpWrpBoard['boxshadow_y'];
$Tmp_Wrp_BoxShadow_Size = $row_RecordTmpWrpBoard['boxshadow_size'];
$Tmp_Wrp_BoxShadow_Color = $row_RecordTmpWrpBoard['boxshadow_color'];
$Tmp_Wrp_LinearGradient_Top = $row_RecordTmpWrpBoard['lineargradient_top'];
$Tmp_Wrp_LinearGradient_Bottom = $row_RecordTmpWrpBoard['lineargradient_bottom'];

$Tmp_Wrp_L_T_Background_Img =  $row_RecordTmpWrpBoard['tmp_l_t_background_img']; // 九宮格
$Tmp_Wrp_L_T_Repeat =  $row_RecordTmpWrpBoard['tmp_l_t_repeat']; // 九宮格
$Tmp_Wrp_L_T_Width =  $row_RecordTmpWrpBoard['tmp_l_t_width']; // 九宮格
$Tmp_Wrp_L_T_Height =  $row_RecordTmpWrpBoard['tmp_l_t_height']; // 九宮格

$Tmp_Wrp_M_T_Background_Img =  $row_RecordTmpWrpBoard['tmp_m_t_background_img']; // 九宮格
$Tmp_Wrp_M_T_Repeat =  $row_RecordTmpWrpBoard['tmp_m_t_repeat']; // 九宮格
$Tmp_Wrp_M_T_Height =  $row_RecordTmpWrpBoard['tmp_m_t_height']; // 九宮格

$Tmp_Wrp_R_T_Background_Img =  $row_RecordTmpWrpBoard['tmp_r_t_background_img']; // 九宮格
$Tmp_Wrp_R_T_Repeat =  $row_RecordTmpWrpBoard['tmp_r_t_repeat']; // 九宮格
$Tmp_Wrp_R_T_Width =  $row_RecordTmpWrpBoard['tmp_r_t_width']; // 九宮格
$Tmp_Wrp_R_T_Height =  $row_RecordTmpWrpBoard['tmp_r_t_height']; // 九宮格

$Tmp_Wrp_L_M_Background_Img =  $row_RecordTmpWrpBoard['tmp_l_m_background_img']; // 九宮格
$Tmp_Wrp_L_M_Repeat =  $row_RecordTmpWrpBoard['tmp_l_m_repeat']; // 九宮格
$Tmp_Wrp_L_M_Width =  $row_RecordTmpWrpBoard['tmp_l_m_width']; // 九宮格

$Tmp_Wrp_M_M_Background_Img =  $row_RecordTmpWrpBoard['tmp_m_m_background_img']; // 九宮格
$Tmp_Wrp_M_M_Repeat =  $row_RecordTmpWrpBoard['tmp_m_m_repeat']; // 九宮格

$Tmp_Wrp_R_M_Background_Img =  $row_RecordTmpWrpBoard['tmp_r_m_background_img']; // 九宮格
$Tmp_Wrp_R_M_Repeat =  $row_RecordTmpWrpBoard['tmp_r_m_repeat']; // 九宮格
$Tmp_Wrp_R_M_Width =  $row_RecordTmpWrpBoard['tmp_r_m_width']; // 九宮格

$Tmp_Wrp_L_B_Background_Img =  $row_RecordTmpWrpBoard['tmp_l_b_background_img']; // 九宮格
$Tmp_Wrp_L_B_Repeat =  $row_RecordTmpWrpBoard['tmp_l_b_repeat']; // 九宮格
$Tmp_Wrp_L_B_Width =  $row_RecordTmpWrpBoard['tmp_l_b_width']; // 九宮格
$Tmp_Wrp_L_B_Height =  $row_RecordTmpWrpBoard['tmp_l_b_height']; // 九宮格

$Tmp_Wrp_M_B_Background_Img =  $row_RecordTmpWrpBoard['tmp_m_b_background_img']; // 九宮格
$Tmp_Wrp_M_B_Repeat =  $row_RecordTmpWrpBoard['tmp_m_b_repeat']; // 九宮格
$Tmp_Wrp_M_B_Height =  $row_RecordTmpWrpBoard['tmp_m_b_height']; // 九宮格

$Tmp_Wrp_R_B_Background_Img =  $row_RecordTmpWrpBoard['tmp_r_b_background_img']; // 九宮格
$Tmp_Wrp_R_B_Repeat =  $row_RecordTmpWrpBoard['tmp_r_b_repeat']; // 九宮格
$Tmp_Wrp_R_B_Width =  $row_RecordTmpWrpBoard['tmp_r_b_width']; // 九宮格
$Tmp_Wrp_R_B_Height =  $row_RecordTmpWrpBoard['tmp_r_b_height']; // 九宮格

// 橫幅
$Tmp_Banner_W_Marge_Top =  $row_RecordTmpBannerBoard['tmp_w_marge_top']; // 外框間距
$Tmp_Banner_W_Marge_Bottom =  $row_RecordTmpBannerBoard['tmp_w_marge_bottom']; // 外框間距
$Tmp_Banner_W_Marge_Left =  $row_RecordTmpBannerBoard['tmp_w_marge_left']; // 外框間距
$Tmp_Banner_W_Marge_Right =  $row_RecordTmpBannerBoard['tmp_w_marge_right']; // 外框間距

$Tmp_Banner_W_Padding_Top =  $row_RecordTmpBannerBoard['tmp_w_padding_top']; // 內框間距
$Tmp_Banner_W_Padding_Bottom =  $row_RecordTmpBannerBoard['tmp_w_padding_bottom']; // 內框間距
$Tmp_Banner_W_Padding_Left =  $row_RecordTmpBannerBoard['tmp_w_padding_left']; // 內框間距
$Tmp_Banner_W_Padding_Right =  $row_RecordTmpBannerBoard['tmp_w_padding_right']; // 內框間距

$Tmp_Banner_W_Font_Color =  $row_RecordTmpBannerBoard['tmp_w_font_color']; // 文字顏色
$Tmp_Banner_W_Board_Style =  $row_RecordTmpBannerBoard['tmp_w_board_style']; // 邊框樣式
$Tmp_Banner_W_Board_Width =  $row_RecordTmpBannerBoard['tmp_w_board_width']; // 邊框寬度
$Tmp_Banner_W_Board_Color =  $row_RecordTmpBannerBoard['tmp_w_board_color']; // 邊框顏色
$Tmp_Banner_W_Background_Color =  $row_RecordTmpBannerBoard['tmp_w_background_color']; // 背景顏色
$Tmp_Banner_W_Background_Img =  $row_RecordTmpBannerBoard['tmp_w_background_img']; // 背景
$Tmp_Banner_W_Background_WebName = $row_RecordTmpBannerBoard['webname'];

//only css3
$Tmp_Banner_BorderRadius_T_L = $row_RecordTmpBannerBoard['borderradius_t_l'];
$Tmp_Banner_BorderRadius_T_R = $row_RecordTmpBannerBoard['borderradius_t_r'];
$Tmp_Banner_BorderRadius_B_L = $row_RecordTmpBannerBoard['borderradius_b_l'];
$Tmp_Banner_BorderRadius_B_R = $row_RecordTmpBannerBoard['borderradius_b_r'];
$Tmp_Banner_BoxShadow_X = $row_RecordTmpBannerBoard['boxshadow_x'];
$Tmp_Banner_BoxShadow_Y = $row_RecordTmpBannerBoard['boxshadow_y'];
$Tmp_Banner_BoxShadow_Size = $row_RecordTmpBannerBoard['boxshadow_size'];
$Tmp_Banner_BoxShadow_Color = $row_RecordTmpBannerBoard['boxshadow_color'];
$Tmp_Banner_LinearGradient_Top = $row_RecordTmpBannerBoard['lineargradient_top'];
$Tmp_Banner_LinearGradient_Bottom = $row_RecordTmpBannerBoard['lineargradient_bottom'];

$Tmp_Banner_L_T_Background_Img =  $row_RecordTmpBannerBoard['tmp_l_t_background_img']; // 九宮格
$Tmp_Banner_L_T_Repeat =  $row_RecordTmpBannerBoard['tmp_l_t_repeat']; // 九宮格
$Tmp_Banner_L_T_Width =  $row_RecordTmpBannerBoard['tmp_l_t_width']; // 九宮格
$Tmp_Banner_L_T_Height =  $row_RecordTmpBannerBoard['tmp_l_t_height']; // 九宮格

$Tmp_Banner_M_T_Background_Img =  $row_RecordTmpBannerBoard['tmp_m_t_background_img']; // 九宮格
$Tmp_Banner_M_T_Repeat =  $row_RecordTmpBannerBoard['tmp_m_t_repeat']; // 九宮格
$Tmp_Banner_M_T_Height =  $row_RecordTmpBannerBoard['tmp_m_t_height']; // 九宮格

$Tmp_Banner_R_T_Background_Img =  $row_RecordTmpBannerBoard['tmp_r_t_background_img']; // 九宮格
$Tmp_Banner_R_T_Repeat =  $row_RecordTmpBannerBoard['tmp_r_t_repeat']; // 九宮格
$Tmp_Banner_R_T_Width =  $row_RecordTmpBannerBoard['tmp_r_t_width']; // 九宮格
$Tmp_Banner_R_T_Height =  $row_RecordTmpBannerBoard['tmp_r_t_height']; // 九宮格

$Tmp_Banner_L_M_Background_Img =  $row_RecordTmpBannerBoard['tmp_l_m_background_img']; // 九宮格
$Tmp_Banner_L_M_Repeat =  $row_RecordTmpBannerBoard['tmp_l_m_repeat']; // 九宮格
$Tmp_Banner_L_M_Width =  $row_RecordTmpBannerBoard['tmp_l_m_width']; // 九宮格

$Tmp_Banner_M_M_Background_Img =  $row_RecordTmpBannerBoard['tmp_m_m_background_img']; // 九宮格
$Tmp_Banner_M_M_Repeat =  $row_RecordTmpBannerBoard['tmp_m_m_repeat']; // 九宮格

$Tmp_Banner_R_M_Background_Img =  $row_RecordTmpBannerBoard['tmp_r_m_background_img']; // 九宮格
$Tmp_Banner_R_M_Repeat =  $row_RecordTmpBannerBoard['tmp_r_m_repeat']; // 九宮格
$Tmp_Banner_R_M_Width =  $row_RecordTmpBannerBoard['tmp_r_m_width']; // 九宮格

$Tmp_Banner_L_B_Background_Img =  $row_RecordTmpBannerBoard['tmp_l_b_background_img']; // 九宮格
$Tmp_Banner_L_B_Repeat =  $row_RecordTmpBannerBoard['tmp_l_b_repeat']; // 九宮格
$Tmp_Banner_L_B_Width =  $row_RecordTmpBannerBoard['tmp_l_b_width']; // 九宮格
$Tmp_Banner_L_B_Height =  $row_RecordTmpBannerBoard['tmp_l_b_height']; // 九宮格

$Tmp_Banner_M_B_Background_Img =  $row_RecordTmpBannerBoard['tmp_m_b_background_img']; // 九宮格
$Tmp_Banner_M_B_Repeat =  $row_RecordTmpBannerBoard['tmp_m_b_repeat']; // 九宮格
$Tmp_Banner_M_B_Height =  $row_RecordTmpBannerBoard['tmp_m_b_height']; // 九宮格

$Tmp_Banner_R_B_Background_Img =  $row_RecordTmpBannerBoard['tmp_r_b_background_img']; // 九宮格
$Tmp_Banner_R_B_Repeat =  $row_RecordTmpBannerBoard['tmp_r_b_repeat']; // 九宮格
$Tmp_Banner_R_B_Width =  $row_RecordTmpBannerBoard['tmp_r_b_width']; // 九宮格

$Tmp_Banner_R_B_Height =  $row_RecordTmpBannerBoard['tmp_r_b_height']; // 九宮格

// 導航欄
$Tmp_Viewline_W_Marge_Top =  $row_RecordTmpViewlineBoard['tmp_w_marge_top']; // 外框間距
$Tmp_Viewline_W_Marge_Bottom =  $row_RecordTmpViewlineBoard['tmp_w_marge_bottom']; // 外框間距
$Tmp_Viewline_W_Marge_Left =  $row_RecordTmpViewlineBoard['tmp_w_marge_left']; // 外框間距
$Tmp_Viewline_W_Marge_Right =  $row_RecordTmpViewlineBoard['tmp_w_marge_right']; // 外框間距

$Tmp_Viewline_W_Padding_Top =  $row_RecordTmpViewlineBoard['tmp_w_padding_top']; // 內框間距
$Tmp_Viewline_W_Padding_Bottom =  $row_RecordTmpViewlineBoard['tmp_w_padding_bottom']; // 內框間距
$Tmp_Viewline_W_Padding_Left =  $row_RecordTmpViewlineBoard['tmp_w_padding_left']; // 內框間距
$Tmp_Viewline_W_Padding_Right =  $row_RecordTmpViewlineBoard['tmp_w_padding_right']; // 內框間距

$Tmp_Viewline_W_Font_Color =  $row_RecordTmpViewlineBoard['tmp_w_font_color']; // 文字顏色
$Tmp_Viewline_W_Board_Style =  $row_RecordTmpViewlineBoard['tmp_w_board_style']; // 邊框樣式
$Tmp_Viewline_W_Board_Width =  $row_RecordTmpViewlineBoard['tmp_w_board_width']; // 邊框寬度
$Tmp_Viewline_W_Board_Color =  $row_RecordTmpViewlineBoard['tmp_w_board_color']; // 邊框顏色
$Tmp_Viewline_W_Background_Color =  $row_RecordTmpViewlineBoard['tmp_w_background_color']; // 背景顏色
$Tmp_Viewline_W_Background_Img =  $row_RecordTmpViewlineBoard['tmp_w_background_img']; // 背景
$Tmp_Viewline_W_Background_WebName = $row_RecordTmpViewlineBoard['webname'];

//only css3
$Tmp_Viewline_BorderRadius_T_L = $row_RecordTmpViewlineBoard['borderradius_t_l'];
$Tmp_Viewline_BorderRadius_T_R = $row_RecordTmpViewlineBoard['borderradius_t_r'];
$Tmp_Viewline_BorderRadius_B_L = $row_RecordTmpViewlineBoard['borderradius_b_l'];
$Tmp_Viewline_BorderRadius_B_R = $row_RecordTmpViewlineBoard['borderradius_b_r'];
$Tmp_Viewline_BoxShadow_X = $row_RecordTmpViewlineBoard['boxshadow_x'];
$Tmp_Viewline_BoxShadow_Y = $row_RecordTmpViewlineBoard['boxshadow_y'];
$Tmp_Viewline_BoxShadow_Size = $row_RecordTmpViewlineBoard['boxshadow_size'];
$Tmp_Viewline_BoxShadow_Color = $row_RecordTmpViewlineBoard['boxshadow_color'];
$Tmp_Viewline_LinearGradient_Top = $row_RecordTmpViewlineBoard['lineargradient_top'];
$Tmp_Viewline_LinearGradient_Bottom = $row_RecordTmpViewlineBoard['lineargradient_bottom'];

$Tmp_Viewline_L_T_Background_Img =  $row_RecordTmpViewlineBoard['tmp_l_t_background_img']; // 九宮格
$Tmp_Viewline_L_T_Repeat =  $row_RecordTmpViewlineBoard['tmp_l_t_repeat']; // 九宮格
$Tmp_Viewline_L_T_Width =  $row_RecordTmpViewlineBoard['tmp_l_t_width']; // 九宮格
$Tmp_Viewline_L_T_Height =  $row_RecordTmpViewlineBoard['tmp_l_t_height']; // 九宮格

$Tmp_Viewline_M_T_Background_Img =  $row_RecordTmpViewlineBoard['tmp_m_t_background_img']; // 九宮格
$Tmp_Viewline_M_T_Repeat =  $row_RecordTmpViewlineBoard['tmp_m_t_repeat']; // 九宮格
$Tmp_Viewline_M_T_Height =  $row_RecordTmpViewlineBoard['tmp_m_t_height']; // 九宮格

$Tmp_Viewline_R_T_Background_Img =  $row_RecordTmpViewlineBoard['tmp_r_t_background_img']; // 九宮格
$Tmp_Viewline_R_T_Repeat =  $row_RecordTmpViewlineBoard['tmp_r_t_repeat']; // 九宮格
$Tmp_Viewline_R_T_Width =  $row_RecordTmpViewlineBoard['tmp_r_t_width']; // 九宮格
$Tmp_Viewline_R_T_Height =  $row_RecordTmpViewlineBoard['tmp_r_t_height']; // 九宮格

$Tmp_Viewline_L_M_Background_Img =  $row_RecordTmpViewlineBoard['tmp_l_m_background_img']; // 九宮格
$Tmp_Viewline_L_M_Repeat =  $row_RecordTmpViewlineBoard['tmp_l_m_repeat']; // 九宮格
$Tmp_Viewline_L_M_Width =  $row_RecordTmpViewlineBoard['tmp_l_m_width']; // 九宮格

$Tmp_Viewline_M_M_Background_Img =  $row_RecordTmpViewlineBoard['tmp_m_m_background_img']; // 九宮格
$Tmp_Viewline_M_M_Repeat =  $row_RecordTmpViewlineBoard['tmp_m_m_repeat']; // 九宮格

$Tmp_Viewline_R_M_Background_Img =  $row_RecordTmpViewlineBoard['tmp_r_m_background_img']; // 九宮格
$Tmp_Viewline_R_M_Repeat =  $row_RecordTmpViewlineBoard['tmp_r_m_repeat']; // 九宮格
$Tmp_Viewline_R_M_Width =  $row_RecordTmpViewlineBoard['tmp_r_m_width']; // 九宮格

$Tmp_Viewline_L_B_Background_Img =  $row_RecordTmpViewlineBoard['tmp_l_b_background_img']; // 九宮格
$Tmp_Viewline_L_B_Repeat =  $row_RecordTmpViewlineBoard['tmp_l_b_repeat']; // 九宮格
$Tmp_Viewline_L_B_Width =  $row_RecordTmpViewlineBoard['tmp_l_b_width']; // 九宮格
$Tmp_Viewline_L_B_Height =  $row_RecordTmpViewlineBoard['tmp_l_b_height']; // 九宮格

$Tmp_Viewline_M_B_Background_Img =  $row_RecordTmpViewlineBoard['tmp_m_b_background_img']; // 九宮格
$Tmp_Viewline_M_B_Repeat =  $row_RecordTmpViewlineBoard['tmp_m_b_repeat']; // 九宮格
$Tmp_Viewline_M_B_Height =  $row_RecordTmpViewlineBoard['tmp_m_b_height']; // 九宮格

$Tmp_Viewline_R_B_Background_Img =  $row_RecordTmpViewlineBoard['tmp_r_b_background_img']; // 九宮格
$Tmp_Viewline_R_B_Repeat =  $row_RecordTmpViewlineBoard['tmp_r_b_repeat']; // 九宮格
$Tmp_Viewline_R_B_Width =  $row_RecordTmpViewlineBoard['tmp_r_b_width']; // 九宮格
$Tmp_Viewline_R_B_Height =  $row_RecordTmpViewlineBoard['tmp_r_b_height']; // 九宮格

// Middle
$Tmp_Middle_W_Marge_Top =  $row_RecordTmpMiddleBoard['tmp_w_marge_top']; // 外框間距
$Tmp_Middle_W_Marge_Bottom =  $row_RecordTmpMiddleBoard['tmp_w_marge_bottom']; // 外框間距
$Tmp_Middle_W_Marge_Left =  $row_RecordTmpMiddleBoard['tmp_w_marge_left']; // 外框間距
$Tmp_Middle_W_Marge_Right =  $row_RecordTmpMiddleBoard['tmp_w_marge_right']; // 外框間距

$Tmp_Middle_W_Padding_Top =  $row_RecordTmpMiddleBoard['tmp_w_padding_top']; // 內框間距
$Tmp_Middle_W_Padding_Bottom =  $row_RecordTmpMiddleBoard['tmp_w_padding_bottom']; // 內框間距
$Tmp_Middle_W_Padding_Left =  $row_RecordTmpMiddleBoard['tmp_w_padding_left']; // 內框間距
$Tmp_Middle_W_Padding_Right =  $row_RecordTmpMiddleBoard['tmp_w_padding_right']; // 內框間距

$Tmp_Middle_W_Font_Color =  $row_RecordTmpMiddleBoard['tmp_w_font_color']; // 文字顏色
$Tmp_Middle_W_Board_Style =  $row_RecordTmpMiddleBoard['tmp_w_board_style']; // 邊框樣式
$Tmp_Middle_W_Board_Width =  $row_RecordTmpMiddleBoard['tmp_w_board_width']; // 邊框寬度
$Tmp_Middle_W_Board_Color =  $row_RecordTmpMiddleBoard['tmp_w_board_color']; // 邊框顏色
$Tmp_Middle_W_Background_Color =  $row_RecordTmpMiddleBoard['tmp_w_background_color']; // 背景顏色
$Tmp_Middle_W_Background_Img =  $row_RecordTmpMiddleBoard['tmp_w_background_img']; // 背景
$Tmp_Middle_W_Background_WebName = $row_RecordTmpMiddleBoard['webname'];

//only css3
$Tmp_Middle_BorderRadius_T_L = $row_RecordTmpMiddleBoard['borderradius_t_l'];
$Tmp_Middle_BorderRadius_T_R = $row_RecordTmpMiddleBoard['borderradius_t_r'];
$Tmp_Middle_BorderRadius_B_L = $row_RecordTmpMiddleBoard['borderradius_b_l'];
$Tmp_Middle_BorderRadius_B_R = $row_RecordTmpMiddleBoard['borderradius_b_r'];
$Tmp_Middle_BoxShadow_X = $row_RecordTmpMiddleBoard['boxshadow_x'];
$Tmp_Middle_BoxShadow_Y = $row_RecordTmpMiddleBoard['boxshadow_y'];
$Tmp_Middle_BoxShadow_Size = $row_RecordTmpMiddleBoard['boxshadow_size'];
$Tmp_Middle_BoxShadow_Color = $row_RecordTmpMiddleBoard['boxshadow_color'];
$Tmp_Middle_LinearGradient_Top = $row_RecordTmpMiddleBoard['lineargradient_top'];
$Tmp_Middle_LinearGradient_Bottom = $row_RecordTmpMiddleBoard['lineargradient_bottom'];

$Tmp_Middle_L_T_Background_Img =  $row_RecordTmpMiddleBoard['tmp_l_t_background_img']; // 九宮格
$Tmp_Middle_L_T_Repeat =  $row_RecordTmpMiddleBoard['tmp_l_t_repeat']; // 九宮格
$Tmp_Middle_L_T_Width =  $row_RecordTmpMiddleBoard['tmp_l_t_width']; // 九宮格
$Tmp_Middle_L_T_Height =  $row_RecordTmpMiddleBoard['tmp_l_t_height']; // 九宮格

$Tmp_Middle_M_T_Background_Img =  $row_RecordTmpMiddleBoard['tmp_m_t_background_img']; // 九宮格
$Tmp_Middle_M_T_Repeat =  $row_RecordTmpMiddleBoard['tmp_m_t_repeat']; // 九宮格
$Tmp_Middle_M_T_Height =  $row_RecordTmpMiddleBoard['tmp_m_t_height']; // 九宮格

$Tmp_Middle_R_T_Background_Img =  $row_RecordTmpMiddleBoard['tmp_r_t_background_img']; // 九宮格
$Tmp_Middle_R_T_Repeat =  $row_RecordTmpMiddleBoard['tmp_r_t_repeat']; // 九宮格
$Tmp_Middle_R_T_Width =  $row_RecordTmpMiddleBoard['tmp_r_t_width']; // 九宮格
$Tmp_Middle_R_T_Height =  $row_RecordTmpMiddleBoard['tmp_r_t_height']; // 九宮格

$Tmp_Middle_L_M_Background_Img =  $row_RecordTmpMiddleBoard['tmp_l_m_background_img']; // 九宮格
$Tmp_Middle_L_M_Repeat =  $row_RecordTmpMiddleBoard['tmp_l_m_repeat']; // 九宮格
$Tmp_Middle_L_M_Width =  $row_RecordTmpMiddleBoard['tmp_l_m_width']; // 九宮格

$Tmp_Middle_M_M_Background_Img =  $row_RecordTmpMiddleBoard['tmp_m_m_background_img']; // 九宮格
$Tmp_Middle_M_M_Repeat =  $row_RecordTmpMiddleBoard['tmp_m_m_repeat']; // 九宮格

$Tmp_Middle_R_M_Background_Img =  $row_RecordTmpMiddleBoard['tmp_r_m_background_img']; // 九宮格
$Tmp_Middle_R_M_Repeat =  $row_RecordTmpMiddleBoard['tmp_r_m_repeat']; // 九宮格
$Tmp_Middle_R_M_Width =  $row_RecordTmpMiddleBoard['tmp_r_m_width']; // 九宮格

$Tmp_Middle_L_B_Background_Img =  $row_RecordTmpMiddleBoard['tmp_l_b_background_img']; // 九宮格
$Tmp_Middle_L_B_Repeat =  $row_RecordTmpMiddleBoard['tmp_l_b_repeat']; // 九宮格
$Tmp_Middle_L_B_Width =  $row_RecordTmpMiddleBoard['tmp_l_b_width']; // 九宮格
$Tmp_Middle_L_B_Height =  $row_RecordTmpMiddleBoard['tmp_l_b_height']; // 九宮格

$Tmp_Middle_M_B_Background_Img =  $row_RecordTmpMiddleBoard['tmp_m_b_background_img']; // 九宮格
$Tmp_Middle_M_B_Repeat =  $row_RecordTmpMiddleBoard['tmp_m_b_repeat']; // 九宮格
$Tmp_Middle_M_B_Height =  $row_RecordTmpMiddleBoard['tmp_m_b_height']; // 九宮格

$Tmp_Middle_R_B_Background_Img =  $row_RecordTmpMiddleBoard['tmp_r_b_background_img']; // 九宮格
$Tmp_Middle_R_B_Repeat =  $row_RecordTmpMiddleBoard['tmp_r_b_repeat']; // 九宮格
$Tmp_Middle_R_B_Width =  $row_RecordTmpMiddleBoard['tmp_r_b_width']; // 九宮格
$Tmp_Middle_R_B_Height =  $row_RecordTmpMiddleBoard['tmp_r_b_height']; // 九宮格

// title
$Tmp_Title_W_Marge_Top =  $row_RecordTmpTitleBoard['tmp_w_marge_top']; // 外框間距
$Tmp_Title_W_Marge_Bottom =  $row_RecordTmpTitleBoard['tmp_w_marge_bottom']; // 外框間距
$Tmp_Title_W_Marge_Left =  $row_RecordTmpTitleBoard['tmp_w_marge_left']; // 外框間距
$Tmp_Title_W_Marge_Right =  $row_RecordTmpTitleBoard['tmp_w_marge_right']; // 外框間距

$Tmp_Title_W_Padding_Top =  $row_RecordTmpTitleBoard['tmp_w_padding_top']; // 內框間距
$Tmp_Title_W_Padding_Bottom =  $row_RecordTmpTitleBoard['tmp_w_padding_bottom']; // 內框間距
$Tmp_Title_W_Padding_Left =  $row_RecordTmpTitleBoard['tmp_w_padding_left']; // 內框間距
$Tmp_Title_W_Padding_Right =  $row_RecordTmpTitleBoard['tmp_w_padding_right']; // 內框間距

$Tmp_Title_W_Font_Color =  $row_RecordTmpTitleBoard['tmp_w_font_color']; // 文字顏色
$Tmp_Title_W_Board_Style =  $row_RecordTmpTitleBoard['tmp_w_board_style']; // 邊框樣式
$Tmp_Title_W_Board_Width =  $row_RecordTmpTitleBoard['tmp_w_board_width']; // 邊框寬度
$Tmp_Title_W_Board_Color =  $row_RecordTmpTitleBoard['tmp_w_board_color']; // 邊框顏色
$Tmp_Title_W_Background_Color =  $row_RecordTmpTitleBoard['tmp_w_background_color']; // 背景顏色
$Tmp_Title_W_Background_Img =  $row_RecordTmpTitleBoard['tmp_w_background_img']; // 背景
$Tmp_Title_W_Background_WebName = $row_RecordTmpTitleBoard['webname'];

//only css3
$Tmp_Title_BorderRadius_T_L = $row_RecordTmpTitleBoard['borderradius_t_l'];
$Tmp_Title_BorderRadius_T_R = $row_RecordTmpTitleBoard['borderradius_t_r'];
$Tmp_Title_BorderRadius_B_L = $row_RecordTmpTitleBoard['borderradius_b_l'];
$Tmp_Title_BorderRadius_B_R = $row_RecordTmpTitleBoard['borderradius_b_r'];
$Tmp_Title_BoxShadow_X = $row_RecordTmpTitleBoard['boxshadow_x'];
$Tmp_Title_BoxShadow_Y = $row_RecordTmpTitleBoard['boxshadow_y'];
$Tmp_Title_BoxShadow_Size = $row_RecordTmpTitleBoard['boxshadow_size'];
$Tmp_Title_BoxShadow_Color = $row_RecordTmpTitleBoard['boxshadow_color'];
$Tmp_Title_LinearGradient_Top = $row_RecordTmpTitleBoard['lineargradient_top'];
$Tmp_Title_LinearGradient_Bottom = $row_RecordTmpTitleBoard['lineargradient_bottom'];

$Tmp_Title_L_T_Background_Img =  $row_RecordTmpTitleBoard['tmp_l_t_background_img']; // 九宮格
$Tmp_Title_L_T_Repeat =  $row_RecordTmpTitleBoard['tmp_l_t_repeat']; // 九宮格
$Tmp_Title_L_T_Width =  $row_RecordTmpTitleBoard['tmp_l_t_width']; // 九宮格
$Tmp_Title_L_T_Height =  $row_RecordTmpTitleBoard['tmp_l_t_height']; // 九宮格

$Tmp_Title_M_T_Background_Img =  $row_RecordTmpTitleBoard['tmp_m_t_background_img']; // 九宮格
$Tmp_Title_M_T_Repeat =  $row_RecordTmpTitleBoard['tmp_m_t_repeat']; // 九宮格
$Tmp_Title_M_T_Height =  $row_RecordTmpTitleBoard['tmp_m_t_height']; // 九宮格

$Tmp_Title_R_T_Background_Img =  $row_RecordTmpTitleBoard['tmp_r_t_background_img']; // 九宮格
$Tmp_Title_R_T_Repeat =  $row_RecordTmpTitleBoard['tmp_r_t_repeat']; // 九宮格
$Tmp_Title_R_T_Width =  $row_RecordTmpTitleBoard['tmp_r_t_width']; // 九宮格
$Tmp_Title_R_T_Height =  $row_RecordTmpTitleBoard['tmp_r_t_height']; // 九宮格

$Tmp_Title_L_M_Background_Img =  $row_RecordTmpTitleBoard['tmp_l_m_background_img']; // 九宮格
$Tmp_Title_L_M_Repeat =  $row_RecordTmpTitleBoard['tmp_l_m_repeat']; // 九宮格
$Tmp_Title_L_M_Width =  $row_RecordTmpTitleBoard['tmp_l_m_width']; // 九宮格

$Tmp_Title_M_M_Background_Img =  $row_RecordTmpTitleBoard['tmp_m_m_background_img']; // 九宮格
$Tmp_Title_M_M_Repeat =  $row_RecordTmpTitleBoard['tmp_m_m_repeat']; // 九宮格

$Tmp_Title_R_M_Background_Img =  $row_RecordTmpTitleBoard['tmp_r_m_background_img']; // 九宮格
$Tmp_Title_R_M_Repeat =  $row_RecordTmpTitleBoard['tmp_r_m_repeat']; // 九宮格
$Tmp_Title_R_M_Width =  $row_RecordTmpTitleBoard['tmp_r_m_width']; // 九宮格

$Tmp_Title_L_B_Background_Img =  $row_RecordTmpTitleBoard['tmp_l_b_background_img']; // 九宮格
$Tmp_Title_L_B_Repeat =  $row_RecordTmpTitleBoard['tmp_l_b_repeat']; // 九宮格
$Tmp_Title_L_B_Width =  $row_RecordTmpTitleBoard['tmp_l_b_width']; // 九宮格
$Tmp_Title_L_B_Height =  $row_RecordTmpTitleBoard['tmp_l_b_height']; // 九宮格

$Tmp_Title_M_B_Background_Img =  $row_RecordTmpTitleBoard['tmp_m_b_background_img']; // 九宮格
$Tmp_Title_M_B_Repeat =  $row_RecordTmpTitleBoard['tmp_m_b_repeat']; // 九宮格
$Tmp_Title_M_B_Height =  $row_RecordTmpTitleBoard['tmp_m_b_height']; // 九宮格

$Tmp_Title_R_B_Background_Img =  $row_RecordTmpTitleBoard['tmp_r_b_background_img']; // 九宮格
$Tmp_Title_R_B_Repeat =  $row_RecordTmpTitleBoard['tmp_r_b_repeat']; // 九宮格
$Tmp_Title_R_B_Width =  $row_RecordTmpTitleBoard['tmp_r_b_width']; // 九宮格
$Tmp_Title_R_B_Height =  $row_RecordTmpTitleBoard['tmp_r_b_height']; // 九宮格

/*魔法特效*/
$magic_background = $row_RecordSystemConfigFr['magic_background']; // 背景特效類別
/* 飄雪 */
$magic_snow_image_enable = $row_RecordSystemConfigFr['magic_snow_image_enable'];; // 使用圖片
$magic_snow_image = $row_RecordSystemConfigFr['magic_snow_image'];; // 圖片名稱
$magic_snow_min = $row_RecordSystemConfigFr['magic_snow_min'];; // 最小尺寸 5 - 10
$magic_snow_max = $row_RecordSystemConfigFr['magic_snow_max'];; // 最大尺寸 8 - 32
$magic_snow_count = $row_RecordSystemConfigFr['magic_snow_count'];; // 數量 20-35
$magic_snow_zindex = $row_RecordSystemConfigFr['magic_snow_zindex'];; // 0為不覆蓋主畫面
/* 螢火蟲 */
$magic_firefly = $row_RecordSystemConfigFr['magic_firefly'];; // 效果
/* 花 */
$magic_flower = $row_RecordSystemConfigFr['magic_flower'];; // 效果

/* 到期判斷 */
if ($row_RecordAccount['webrenewdate'] != '' && $row_RecordAccount['usetime'] != '') {
function count_date1($input_date,$add_years)
{  
	$date = new DateTime($input_date);
	$day = new DateInterval('P'.$add_years.'Y'); // 兩年四天六小時又八分，中間的 T 是時間的意思
	$date->add($day); 
	$done_date = $date->format('Y-m-d') ;
    
    return $done_date;
}
function margin1($begin, $end){  
	$datetime_start = new DateTime($begin);  
	$datetime_end = new DateTime($end);  
	$day = $datetime_start->diff($datetime_end)->days;
	if($datetime_start > $datetime_end){
		return -$day;
	}else{
		return $day;
	}
     
}  
$t_end = count_date1($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
$t_now = date("Y-m-d");
$t_dt = margin1($t_now, $t_end);

if($t_dt < 0) {header("Location: close.php");}
}

/* =================================================================================================================*/
} // \若搜尋到網域資料則執行下列程式
/* =================================================================================================================*/

if($_SERVER['HTTP_HOST'] != "www.shop3500.com")
{
	mysqli_free_result($RecordPlatformAccount);
}

mysqli_free_result($RecordAccount);


if($totalRows_RecordAccount == 0) {
	if(isset($_GET['lang']) && $_GET['lang'] != ''){ $_SESSION['lang'] = $_GET['lang']; }else{ $_SESSION['lang'] = $_GET['lang'] = $defaultlang; }
}

/* =================================================================================================================*/
if ($totalRows_RecordAccount > 0) { // 若搜尋到網域資料則執行下列程式
/* =================================================================================================================*/

mysqli_free_result($RecordSystemConfig);

mysqli_free_result($RecordSystemConfigFr);

mysqli_free_result($RecordSystemConfigOtr);

mysqli_free_result($RecordTmpConfig);

//mysqli_free_result($RecordTmpBg);

mysqli_free_result($RecordTmpHeaderBg);

mysqli_free_result($RecordTmpWrpBg);

mysqli_free_result($RecordTmpLeftBg);

mysqli_free_result($RecordTmpRightBg);

mysqli_free_result($RecordTmpMiddleBg);

mysqli_free_result($RecordTmpFooterBg);

mysqli_free_result($RecordTmpHomeBoard);

mysqli_free_result($RecordTmpWrpBoard);

mysqli_free_result($RecordTmpBannerBoard);

mysqli_free_result($RecordTmpViewlineBoard);

mysqli_free_result($RecordTmpMiddleBoard);

mysqli_free_result($RecordTmpTitleBoard);

mysqli_free_result($RecordTmpTitleBg);

mysqli_free_result($RecordTmpTitleLineBg);

mysqli_free_result($RecordTmpBodyBg);

mysqli_free_result($RecordTmpLeftMenu);

mysqli_free_result($RecordTmpAnimeBg);

mysqli_free_result($RecordTmpNewsEvenBg);

mysqli_free_result($RecordTmpNewsOddBg);

mysqli_free_result($RecordTmpMainMenu);

mysqli_free_result($RecordTmpLogo);

mysqli_free_result($RecordTmpHomeLogo);

mysqli_free_result($RecordTmpLogoDefault);

mysqli_free_result($RecordTmpBlock);

mysqli_free_result($RecordTmpBottomBg);

mysqli_free_result($RecordTmpHomeBodyBg);

mysqli_free_result($RecordTmpHomeAnimeBg);

mysqli_free_result($RecordTmpHomeBottomBg);

/* =================================================================================================================*/
} // \若搜尋到網域資料則執行下列程式
/* =================================================================================================================*/
?>
<?php require_once('inc_mdname.php'); // 模組名稱?>
<?php 
/* =================================================================================================================*/
if ($totalRows_RecordAccount > 0) { // 若搜尋到網域資料則執行下列程式
/* =================================================================================================================*/
?>
<?php include('require_count.php'); // 判斷各頁面之計數?>
<?php 
/* =================================================================================================================*/
} // \若搜尋到網域資料則執行下列程式
/* =================================================================================================================*/
?>
<?php
// 可用來判斷找不到頁面發生情形!!
if (isset($SiteIndicate) && $SiteIndicate != '1') { // 0:關閉網站 1:開放
	//header("Location: error.php"); // 網誌關閉就跳轉到error 頁面
}

if(isset($_GET['wshop'] ) && $_GET['wshop'] == "playweb") {
	$SiteIndicate = '1';
}
// 如果抓不到版型資料的話 
//if($tplname == '') {header("Location: error.php");}
?>
<?php 
if(isset($tplname) && ($tplname == "board001" || $tplname == "board002" || $tplname == "board003" || $tplname == "board007"|| $tplname == "board009" || $tplname == "board010")) {
	$wrp_full = 0;
}else if(isset($tplname) && ($tplname == "board004" || $tplname == "board005" || $tplname == "board006" || $tplname == "board008")){
	$wrp_full = 1;
}
if(isset($tplname) && ($tplname == "board007" || $tplname == "board008")) {
	$wrp_column_plus = 1;
}
?>
<?php 
/* 行動裝置判斷 */
if(isset($_SESSION['mt'])){}else{$_SESSION['mt'] = "";}
if((($browser_t == 'smartphone' || $browser_t == 'mobile') && $OptionMobileSelect == '1' && $Mobile_Enable_For_User == '1') || (isset($_GET['wshop']) && $_SESSION['mt'] == md5($_GET['wshop']))) { 
// 手機版 當功能開啟 及 使用者設定行動裝置外觀模式
    $tplname_original = $tplname; // 取得原始版型
	$tplname = "mobile_smarty"; 
    //$HomeSelect = "0";
    //$HomeStyle = $MobileHomeStyle; // 更換成手機首頁名稱
}else if((isset($Mobile_Enable_For_User) && $Mobile_Enable_For_User == '2') || isset($tplname) && ($tplname == 'board009' || $tplname == 'board010')){
	//$tplname = "mobile_bootstrap"; 
	$tplname_original = $tplname; // 取得原始版型
	$tplname = "mobile_smarty"; 
    //$HomeSelect = "0";
    //$HomeStyle = $MobileHomeStyle; // 更換成手機首頁名稱
}else if(isset($tplname)){
	//電腦版
	$tplname_original = $tplname; // 取得原始版型
	$tplname = "pc_board"; 
	//$tplname = "mobile_bootstrap"; // 測試用
	//$HomeSelect = "1";
    //$HomeStyle = "mobileboard001";
}
?>