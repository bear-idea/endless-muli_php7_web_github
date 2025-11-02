<?php
require_once dirname(__DIR__, 3) .'/admin/app/init/bootstrap_admin.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['MM_Username'])) {
    require_once(__DIR__."/inc_setting.php");
    require_once(__DIR__.'/inc_admin.php');
}
require_once(__DIR__.'/inc_permission.php');
require_once(dirname(__DIR__, 3) ."/inc/inc_function.php");
//require_once(__DIR__."/inc_lang.php"); // 取得目前語系
require_once(__DIR__."/inc_mdname.php"); // 取得模組名稱