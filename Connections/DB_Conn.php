<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
error_reporting(E_ALL ^ E_DEPRECATED && ~E_NOTICE); // 新版本避免警告
date_default_timezone_set('Asia/Taipei');

$defaultlang = "zh-tw";
$WebSiteDesigner = "Fullvision";
$WebSitePublisher = "Fullvision";
$WebSiteCopyright = "Fullvision";
$WebSiteDesignerCrossName1 = "Fullvision";
$WebSiteDesignerCrossLink1 = "http://www.fullrich.com.tw";
$WebSiteDesignerCrossDesc1 = "富視網科技有限公司";
$WebSiteDesignerCrossName2 = "Shop3500";
$WebSiteDesignerCrossLink2 = "http://www.shop3500.com";
$WebSiteDesignerCrossDesc2 = "創造與設計概念的創意架站平台";
	
$hostname_DB_Conn = "localhost";
//$database_DB_Conn = "sample-muli-test";
$database_DB_Conn = "sample-muli_202406";
$database_DB_Conn = "yuanyiweb";
//$database_DB_Conn = "shop3500";
$username_DB_Conn = "root";
$password_DB_Conn = "Jss218579";
$DB_Conn = mysqli_connect($hostname_DB_Conn, $username_DB_Conn, $password_DB_Conn, $database_DB_Conn) or die("無法連接Mysql");
mysqli_set_charset($DB_Conn,"utf8mb4");

$database = [
    'driver'    => 'mysql',
    'host'      => $hostname_DB_Conn,
    'database'  => $database_DB_Conn,
    'username'  => $username_DB_Conn,
    'password'  => $password_DB_Conn,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

/*try {
	$pdo = new PDO("mysql:host={$hostname_DB_Conn};dbname={$database_DB_Conn}", $username_DB_Conn, $password_DB_Conn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
}
catch( PDOException $ex ) {
    echo "Connection error :" . $ex->getMessage();
}*/

$UseCdn = "1";

$SiteOldMode = '0'; // 是否開啟舊版型模式
/*  內連設定 */
$SiteBaseUrl = "/";
$SiteBaseUrl = "/8.3/endless-muli_php7_web_github/";
/*  外連設定 */
$SiteBaseUrlOuter = "https://img.shop3500.com/";
//$SiteBaseUrlOuter = "";

$SiteImgUrl = $SiteBaseUrl . "site/";
$SiteJsUrl  = $SiteBaseUrl . "js/"; // 前台Js位置路徑
$SiteCssUrl  = $SiteBaseUrl . "css/"; // 前台Js位置路徑

$SiteBaseAdminPath = "admin/";
//$SiteBaseAdminPath = "admin_color/"; // 管理路徑

$SiteImgUrlAdmin = "../site/"; // 後台圖片位置路徑
$SiteImgFilePathAdmin = "../site/"; // 後台上傳圖片位置路徑(相對路徑)
$SiteImgFilePath = "site/"; // 後台上傳圖片位置路徑(相對路徑

$SiteImgUrlOuter = $SiteBaseUrlOuter  . "site/";
$SiteJsUrlOuter  = $SiteBaseUrlOuter . "js/"; // 前台Js位置路徑
$SiteCssUrlOuter  = $SiteBaseUrlOuter . "css/"; // 前台Js位置路徑


$fb_app_id = "";
$fb_app_secret = "";
$line_app_id = "";
$line_app_secret = "95a7a91d8886a98e85ead2433a78b26c";
?>