<?php
	$appHeaderClass = (!empty($appHeaderInverse)) ? 'app-header-inverse ' : '';
	$appHeaderMenu = (!empty($appHeaderMenu)) ? $appHeaderMenu : '';
	$appHeaderMegaMenu = (!empty($appHeaderMegaMenu)) ? $appHeaderMegaMenu : '';
	$appHeaderTopMenu = (!empty($appHeaderTopMenu)) ? $appHeaderTopMenu : '';
?>


<!-- BEGIN #header -->
<div id="header" class="app-header <?php echo $appHeaderClass; ?>">
	<!-- BEGIN navbar-header -->
	<div class="navbar-header">
		<?php if ($appSidebarTwo) { ?>
            <button type = "button" class="navbar-mobile-toggler" data-toggle = "app-sidebar-end-mobile" >
			<span class="icon-bar" ></span >
			<span class="icon-bar" ></span >
			<span class="icon-bar" ></span >
		</button >
		<?php } ?>
        <a href="<?php echo $SiteAdminPath; ?>home?lang=<?php echo $_SESSION['lang'] ?>" class="navbar-brand"><?php //require_once ADMINPATH . '/themes/includes/component/logo.php'; ?><?php echo renderIcon('line-md:cog-filled-loop','fs-24px'); ?> <b>Cetus</b> Alchemy</a>
		<?php if ($appHeaderMegaMenu && !$appSidebarTwo) { ?>
		<button type="button" class="navbar-mobile-toggler" data-bs-toggle="collapse" data-bs-target="#top-navbar">
			<span class="fa-stack fa-lg">
				<i class="far fa-square fa-stack-2x"></i>
				<i class="fa fa-cog fa-stack-1x mt-1px"></i>
			</span>
		</button>
		<?php } ?>
		<?php if($appTopMenu && !$appSidebarHide && !$appSidebarTwo) { ?>
		<button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
			<span class="fa-stack fa-lg">
				<i class="far fa-square fa-stack-2x"></i>
				<i class="fa fa-cog fa-stack-1x mt-1px"></i>
			</span>
		</button>
        <?php } ?>
		<?php if($appTopMenu && $appSidebarHide && !$appSidebarTwo) { ?>
		<button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
        <?php } ?>
		<?php if (!$appSidebarHide) { ?>
		<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
        <?php } ?>
	</div>

	<?php if($appHeaderMegaMenu) { include('component/header-mega-menu.php'); } ?>

	<!-- BEGIN header-nav -->
	<div class="navbar-nav">
        <?php if($appHeaderNotification) { ?>
		<div class="navbar-item dropdown">
			<a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
				<i class="fa fa-bell"></i>
				<span class="badge">5</span>
			</a>
			<?php include('component/header-dropdown-notification.php'); ?>
		</div>
        <?php } ?>

        <?php
        if($appHeaderLanguageBar){
            include('component/header-language-bar.php');
        }
        ?>

		<div class="navbar-item navbar-user dropdown">
			<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <i class="fa fa-user-circle"></i> &nbsp;
				<span>
					<span class="d-none d-md-inline"><?php echo $_SESSION['MM_Username']; ?></span>
					<b class="caret"></b>
				</span>
			</a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="manage_siteconfig.php?wshop=<?php echo $wshop;?>&amp;Opt_Config=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>" class="dropdown-item"><i class="fa fa-cogs"></i> 網站資訊</a>
                <a href="manage_state.php?wshop=<?php echo $wshop;?>&amp;Opt_State=settingpage_user&amp;lang=<?php echo $_SESSION['lang']; ?>" class="dropdown-item"><i class="fa fa-user-circle" aria-hidden="true"></i> 個人資料</a>
                <div class="dropdown-divider"></div>
                <a href="<?php $logoutAction = 'logout'; echo $logoutAction ?>" class="dropdown-item"><i class="fa fa-sign-out-alt fa-fw"></i> 登出</a>
            </div>
		</div>

		<?php if($appSidebarTwo) { ?>
		<div class="navbar-divider d-none d-md-block"></div>
		<div class="navbar-item d-none d-md-block">
			<a href="javascript:;" data-toggle="app-sidebar-end" class="navbar-link icon">
				<i class="fa fa-th"></i>
			</a>
		</div>
        <?php } ?>
	</div>
	<!-- END header-nav -->
</div>
<!-- END #header -->
