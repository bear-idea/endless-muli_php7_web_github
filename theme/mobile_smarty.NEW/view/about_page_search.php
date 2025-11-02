<?php if ($rows_moduleCount[$Tp_Page] > 0 ) { ?>
<?php require($TplPath . "/layout/board/layout_board_middle_title_top.php"); ?>
<div class="ct_title">
  <h1 style="font-size:large" class="<?php echo $ClassMaquree ?>">
    <?php if($TmpTitleBgImage != ''){ ?>
    <span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span>
    <?php } ?>
    <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName[$Tp_Page]; ?></span></h1>
</div>
<?php require($TplPath . "/layout/board/layout_board_middle_title_bottom.php"); ?>
<?php require($TplPath . "/layout/board/layout_board_middle_content_top.php"); ?>
<div class="post_content padding-3">
	<?php require($TplPath . '/layout/component/layout_component_tablelist.php'); ?>
    <?php require($TplPath . '/layout/component/layout_component_pagination.php'); ?>
</div>
<?php require($TplPath . "/layout/board/layout_board_middle_content_bottom.php"); ?>
<?php } ?>
<?php 
if ($rows_moduleCount[$Tp_Page] == 0 ) {
	require($TplPath . '/view/error_component_404.php');
} 
?>