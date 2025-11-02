<?php
// 主題設定
$appHeaderMegaMenu = true;
$appHeaderLanguageBar = true;
$appHeaderNotification = false;
$appSidebarHide = true;
require_once ADMINPATH . '/themes/config.php';
?>
<!DOCTYPE html>
<html lang="zh_TW">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $page_title; ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
    <link rel='bookmark' href='favicon.ico' type='image/x-icon' />
    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
    <?php require_once ADMINPATH . '/themes/includes/head-core.php'; ?>
</head>
<body class='pace-top'>
<?php //require_once ADMINPATH . '/themes/includes/component/page-loader.php'; ?>

<div id="app" class="app">

    <?php require_once($page_view); ?>

    <?php require_once ADMINPATH . '/themes/includes/component/scroll-top-btn.php'; ?>

</div>

</body>
</html>

<?php require_once ADMINPATH . '/themes/includes/foot-core.php'; ?>
