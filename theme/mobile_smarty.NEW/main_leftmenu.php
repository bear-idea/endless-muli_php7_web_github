<script type='text/javascript' src='<?php echo $TplJsPath; ?>/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-1').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'right'
	});
});
</script>

<div class="dcjq-vertical-mega-menu">
        <ul id="mega-1" class="menu">
    <?php require("leftmenu_dftype.php"); ?>
</ul>
</div>
