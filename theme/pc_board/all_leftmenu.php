<script type='text/javascript' src='<?php echo $TplJsPath; ?>/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script><script type='text/javascript' src='<?php echo $TplJsPath; ?>/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-all').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'right'
	});
});
</script>
<?php if ($TmpLeftMenuTitlePic != '' && $row_RecordLeftMenuColumn['indicatetopmenu'] == '1') { ?>
<img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLeftMenuWebName ?>/image/tmpleftmenu/<?php echo $TmpLeftMenuTitlePic ?>" /><?php } ?>
<div class="dcjq-vertical-mega-menu">
        <ul id="mega-all" class="menu">
      		 <?php require("leftmenu_dftype.php"); ?>
        </ul>
</div>
<?php if($TmpLeftMenuBottomPic != '' && $row_RecordLeftMenuColumn['indicatebottommenu'] == '1'){
			echo"<img src=\"" . $SiteImgUrl . $TmpLeftMenuWebName. "/image/tmpleftmenu/" . $TmpLeftMenuBottomPic . "\"/>  "."";
	}?>