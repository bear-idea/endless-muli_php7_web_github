<?php
/*======================================================================*\
 || <?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?><?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>############## ||
 || #                  深藍UTF-8正體簡體轉換函數 1.0                   # ||
 || # 台灣深藍vBulletin技術論壇 http://www.twvbb.com 站長:ckmarkhsu    # ||
 || # ---------------------------------------------------------------- # ||
 || # Copyright 2006 台灣深藍vBulletin技術論壇 All Rights Reserved.    # ||
 || # 歡迎轉載，唯轉載請保留版權宣告，並請勿自行修改發布               # ||
 || # 2006/03/13                                                       # ||
 || <?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?><?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>############## ||
 \*======================================================================*/

function dbcconv($text, $encode = 1) {
	$path = dirname(__FILE__);
	if ($encode == 0) {
		require ("{$path}/dbcconv_cht.php");
	} elseif ($encode == 1) {
		require ("{$path}/dbcconv_chs.php");
	}
	$tmp = '';
	$textLength = strlen($text);
	for ($i = 0; $i < $textLength; $i++) {
		if ($i + 3 > $textLength) {
			$tmp .= substr($text, $i, 1);
		} else {
			$str = substr($text, $i, 3);
			if (dbcconv_isChinese($str)) {
				$tmp .= $data[dbcconv_id($str)];
				$i = $i + 2;
			} else {
				$tmp .= substr($text, $i, 1);
			}
		}
	}
	return $tmp;
}

function dbcconv_id($str) {
	$tmp = 0;
	if (strlen($str) === 3) {
		$tmp = ((ord($str[0]) - 228) * 4096) + ((ord($str[1]) - 184) * 64) + (ord($str[2]) - 128);
	}
	return $tmp;
}

function dbcconv_isChinese($str) {
	$id = dbcconv_id($str);
	if ($id <= 20901 && $id >= 0) {
		return true;
	} else {
		return false;
	}
}
?>