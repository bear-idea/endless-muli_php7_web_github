<?php require("inc/inc_lang_change.php"); ?>
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

/* ----------CSS 路徑---------- */
$TplCssPath = $SiteBaseUrl . 'theme/' . $tplname . '/css'; // 樣板路徑

/* ----------JS 路徑---------- */
$TplJsPath = $SiteBaseUrl . 'theme/' . $tplname . '/js'; // 樣板路徑

/* ----------樣板圖片路徑---------- */
$TplImagePath = $SiteBaseUrl . 'theme/' . $tplname . '/images/' . $_SESSION['lang']; // 樣板圖片路徑

/* ----------樣板圖片路徑 (無語系)---------- */
$TplNoLangImagePath = $SiteBaseUrl . 'theme/' . $tplname . '/images'; // 樣板圖片路徑
}
?>