<?php require_once('Connections/DB_Conn.php'); ?>
<script type='text/javascript' src='js/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script><script type='text/javascript' src='<?php echo $TplJsPath; ?>/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script>
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
<link href="css/vertical-mega-menu/vertical_menu_basic.css" rel="stylesheet" type="text/css" />
<div class="dcjq-vertical-mega-menu">
        <ul id="mega-1" class="menu">
             <li class="child">
            <a href="org.php?Opt=viewpage&lang=<?php echo $_SESSION['lang']; ?>&tp=Org"><?php echo $Lang_Content_Title_Org; ?></a>
            </li>
        </ul>
</div>
