<?php 
$UseMod = "About"; // 目前使用模組
ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG
require('../vendor/autoload.php');
?>
<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB;
// 创建链接
$db->addConnection($database);
// 设置全局静态可访问
$db->setAsGlobal();
// 启动Eloquent
$db->bootEloquent();
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('app/Support/helpers_form.php'); ?>



<?php
define('BASEPATH', dirname(__DIR__, 1));
define('SITEPATH', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'site');
define('ADMINPATH', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'admin');
define('BASEURL', rtrim($SiteBaseUrl, '/'));
define('ADMINURL', $SiteBaseUrl . rtrim($SiteBaseAdminPath, '/'));
define('CONNPATH', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . '');

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // 生成安全的隨機 Token
    }
    return $_SESSION['csrf_token'];
}


$useLayout = 'page-with-sidebar.php';

switch($_GET['Opt'])
{
    case "viewpage":
        $page_view = "require_manage_about_index.php";
        $page_view = "themes/pages/About/viewPage.php";
        break;
    case "viewpage_sub":
        include_once("require_manage_about_index_sub.php");
        break;
    case "addpage":
        include_once("require_manage_about_add.php");
        break;
    case "editpage":
        include_once("require_manage_about_edit.php");
        break;
    case "copypage":
        include_once("require_manage_about_copy.php");
        break;
    case "startpage":
        include_once("require_manage_about_start.php");
        break;
    case "listpage":
        include_once("require_manage_about_list.php");
        break;
    case "listitempage":
        include_once("require_manage_about_listitem.php");
        break;
    case "mulilistitempage":
        include_once("require_manage_about_mulilistitem.php");
        break;
    case "sub_mulilistitempage":
        include_once("require_manage_about_mulilistitem_sub.php");
        break;
    case "configpage":
        include_once("require_manage_about_config.php");
        break;
    default:
        $page_view = "require_manage_permission_error.php";
        break;
}

require_once(__DIR__ . '/themes/layouts/' . $useLayout);

?>