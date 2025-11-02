<style>
.icon_block div, .icon_wrapper {
    text-align: center;
}
.badge.badge-corner-f{
	top: -8px !important;
    /*right: -6px !important;*/
    position: absolute !important;
    color: #fff !important;
}
</style>
<div class="hidden-lg">
<div id="sidepanel_mainmenu" class="sidepanel-light <?php if ($TmpMainmenuPosition == '1') { ?>sidepanel-inverse<?php } ?>" style="overflow-y:scroll; overflow-x:hidden;">
	<a id="sidepanel_mainmenu_close" href="#"><!-- close -->
		<i class="glyphicon glyphicon-remove"></i>
	</a>
    <div class="sidepanel-content">
    <?php include("slidepanel_dftype.php"); ?>
    </div>
</div>
</div>
<!-- /SIDE PANEL -->