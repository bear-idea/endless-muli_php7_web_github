<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $pagetitle; ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
    <link rel='bookmark' href='favicon.ico' type='image/x-icon' />
    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
    <?php require_once('theme/includes/head-core.php'); ?>
    <?php require_once('theme/includes/head-home.php'); ?>
</head>

<?php require_once('theme/config.php'); ?>

<?php include('theme/includes/component/page-loader.php'); ?>

<div id="app" class="app app-sidebar-fixed <?php echo @$appClass; ?>">

    <?php include('theme/includes/header.php'); ?>

    <?php
    if (!$appSidebarHide) {
        include('theme/includes/sidebar.php');
    }
    ?>
    <div id="content" class="app-content <?php echo @$appContentClass; ?> p-10px">

        <?php require_once($view_page); ?>

    </div>

    <div id="footer" class="footer p-4" style="background-color:#333; color:#FFF; text-align:center; margin:0">
        <?php require_once("require_manage_proverb.php"); ?>
        <?php require_once("require_manage_footer_login.php"); ?>
    </div>

    <?php include('theme/includes/component/scroll-top-btn.php'); ?>

</div>

</body>
</html>

<?php include('theme/includes/foot-core.php'); ?>
<?php include('theme/includes/foot-home.php'); ?>
