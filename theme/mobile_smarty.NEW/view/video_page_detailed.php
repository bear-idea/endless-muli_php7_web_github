<?php if ($rows_moduleCount[$Tp_Page] > 0 ) { ?>
<?php require($TplPath . "/layout/board/layout_board_middle_title_top.php"); ?>
<div class="ct_title">
  <h1 style="font-size:large" class="<?php echo $ClassMaquree ?>">
    <?php if($TmpTitleBgImage != ''){ ?>
    <span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span>
    <?php } ?>
    <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_data['name']; ?></span></h1>
</div>
<?php require($TplPath . "/layout/board/layout_board_middle_title_bottom.php"); ?>
<?php require($TplPath . "/layout/board/layout_board_middle_content_top.php"); ?>
<div class="post_content padding-3">
	<div class="clearfix"></div>
	    <script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.oembed.min.js"></script>
		<div class="embed-responsive embed-responsive-16by9">
        	<a href="<?php echo $row_data['link']; ?>" class="oembed"></a>
        </div>
	    <script type="text/javascript">
		  $(document).ready(function() {
			  $(".oembed").oembed(null, { 
		  embedMethod: "replace", 
		  maxWidth: 1000, 
		  maxHeight: 1000 });
		  });
		</script> 
	<?php echo $row_data['sdescription']; ?><br />
  	<div class="pull-left"><?php require("app/other/sharelink/sharelink.php"); ?></div>
  	<div class="clearfix"></div>
</div>
<?php require($TplPath . "/layout/board/layout_board_middle_content_bottom.php"); ?>
<?php } ?>
<?php 
if ($rows_moduleCount[$Tp_Page] == 0 ) {
	require($TplPath . '/view/error_component_404.php');
} 
?>