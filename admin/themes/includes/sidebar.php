<?php
	$appSidebarClass = (!empty($appSidebarTransparent)) ? 'app-sidebar-transparent' : '';
?>
<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar <?php echo $appSidebarClass; ?>" data-bs-theme="dark">
	<!-- BEGIN scrollbar -->
	<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
		<div class="menu">
			<?php if (!$appSidebarSearch) { ?>
			<div class="menu-profile">
				<a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
					<div class="menu-profile-cover with-shadow" style=""></div>
					<div class="menu-profile-image">

					</div>
					<div class="menu-profile-info">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1">
                                <?php echo $_SESSION['MM_Username']; ?>
							</div>
							<div class="menu-caret ms-auto"></div>
						</div>
						<small>Website Management</small>
					</div>
				</a>
			</div>
			<div id="appSidebarProfileMenu" class="collapse">
				<div class="menu-item pt-5px">
					<a href="manage_state.php?wshop=<?php echo $wshop;?>&amp;Opt_State=settingpage_user&amp;lang=<?php echo $_SESSION['lang']; ?>" class="menu-link">
						<div class="menu-icon"><i class="fa fa-cog"></i></div>
						<div class="menu-text">個人資料</div>
					</a>
				</div>
				<div class="menu-divider m-0"></div>
			</div>
			<?php } ?>

            <?php require_once($page_view_sidebar); ?>

			<!-- BEGIN minify-button -->
			<div class="menu-item d-flex">
				<a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
			</div>
			<!-- END minify-button -->
		
		</div>
		<!-- END menu -->
	</div>
	<!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
<!-- END #sidebar -->

