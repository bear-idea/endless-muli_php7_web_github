<?php //require("inc/inc_lang_change.php"); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_GET['lang']) && $_GET['lang'] != "" && isset($tplname)) {
/* ----------通用路徑---------- */
$Lang_GeneralPath = 'lang/' . $_SESSION['lang'] . '/lang_general.php'; // 通用語系檔

/* ----------購物車路徑---------- */
$Lang_CartPath = 'lang/' . $_SESSION['lang'] . '/lang_cart.php'; // 通用語系檔
 
/* ----------圖片位置路徑---------- */
$Lang_ImagePath = 'theme/' . $tplname . '/images/' . $_SESSION['lang']; // 圖片路徑

/* ----------樣板路徑---------- */
$TplPath =  'theme/' . $tplname ; // 樣板路徑

/* ----------Assets 路徑---------- */
if ($SiteBaseUrlOuter != "") {
    $TplAssetsPath = $SiteBaseUrlOuter . 'assets/' . $tplname;
} else {
    $TplAssetsPath = $SiteBaseUrl . 'assets/' . $tplname;
}

/* ----------AssetsUser 路徑---------- */
$TplAssetsUserPath = $SiteBaseUrl . 'assets/' . $tplname;

/* ----------共用 CSS 路徑---------- */
if ($SiteBaseUrlOuter != "") {
    $TplCssPath = $SiteBaseUrlOuter . 'assets/css';
} else {
    $TplCssPath = $SiteBaseUrl . 'assets/css';
}

/* ----------共用 JS 路徑---------- */
if ($SiteBaseUrlOuter != "") {
    $TplJsPath = $SiteBaseUrlOuter . 'assets/js';
} else {
    $TplJsPath = $SiteBaseUrl . 'assets/js';
}

/* ----------共用 Plugins 路徑---------- */
if ($SiteBaseUrlOuter != "") {
    $TplPluginsPath = $SiteBaseUrlOuter . 'assets/plugins';
} else {
    $TplPluginsPath = $SiteBaseUrl . 'assets/plugins';
}

/* ----------樣板圖片路徑---------- */
$TplImagePath = $SiteBaseUrl . 'theme/' . $tplname . '/resources/images/' . $_SESSION['lang']; // 樣板圖片路徑

/* ----------樣板圖片路徑 (無語系)---------- */
$TplNoLangImagePath = $SiteBaseUrl . 'theme/' . $tplname . '/resources/images'; // 樣板圖片路徑
}
?>