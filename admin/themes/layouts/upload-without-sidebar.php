<?php
// 主題設定
$appHeaderMegaMenu = true;
$appHeaderLanguageBar = true;
$appHeaderNotification = false;
$appSidebarHide = true;
$appHeaderHide = true;
require_once ADMINPATH . '/themes/config.php';
?>
<!DOCTYPE html>
<html lang="zh">
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
    <?php //require_once('themes/includes/head-home.php'); ?>
</head>
<body>
<?php //require_once ADMINPATH . '/themes/includes/component/page-loader.php'; ?>

<div id="app" class="app app-sidebar-fixed <?php echo $appClass; ?>">

    <?php //include('themes/includes/header.php'); ?>

    <?php
    if (!$appSidebarHide) {
        //include('themes/includes/sidebar.php');
    }
    ?>
    <div class="app-content <?php echo $appContentClass; ?> p-10px">

        <?php require_once($page_view); ?>

    </div>

    <div id="footer" class="footer p-4" style="background-color:#333; color:#FFF; text-align:center; margin:0">
        <?php //require_once("require_manage_proverb.php"); ?>
        <?php //require_once("require_manage_footer_login.php"); ?>
    </div>

    <?php require_once ADMINPATH . '/themes/includes/component/scroll-top-btn.php'; ?>

</div>

</body>
<?php require_once ADMINPATH . '/themes/includes/foot-core.php'; ?>
<?php //include('themes/includes/foot-home.php'); ?>
</html>
