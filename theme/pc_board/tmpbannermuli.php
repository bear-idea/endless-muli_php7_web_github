<?php if ($TmpBanner1 != "" || $TmpBanner2 != "" || $TmpBanner3 != "" || $TmpBanner4 != "" || $TmpBanner5 != "") { // Show if recordset not empty ?>
<?php
	$arr = getimagesize($SiteImgUrl . $tplwebname . "/image/" . $TmpBanner1);
	/*
	* 這裡$arr為一個數組類型
	* $arr[0] 為圖像的寬度
	* $arr[1] 為圖像的高度
	* $arr[2] 為圖像的格式，包括jpg、gif和png等
	* $arr[3] 為圖像的寬度和高度，內容為 width="xxx" height="yyy" */ 
	//echo $arr[1]*(886/$row_RecordAds['bwight']) . '\n';
	//echo $arr[1];
	$banner_height = $arr[1]*(($TmpWebWidth-$Tmp_Banner_L_T_Width-$Tmp_Banner_R_T_Width)/$arr[0]); // 圖片原高度 * 版面寬度 / 圖片原寬度
?>
<script>
	$(document).ready(function(){
		$('.box_skitter_normal').css({width: <?php echo $arr[0]; ?>}).skitter(
		{
			velocity: 1, // 動畫速度
			//animation: 'all', 
			numbers: true, // 顯示編號
			navigation: false, // 顯示導覽工具
			thumbs: false,
			label: false, // 標籤顯示
			interval: 500, // 轉場時間
			//easing_default: 'block',
			//animateNumberOut: {backgroundColor:'#000', color:'#ccc'},
			//animateNumberOver: {backgroundColor:'#000', color:'#ccc'},
			//animateNumberActive: {backgroundColor:'#000', color:'#ccc'},
			hideTools: false, // 隱藏導覽工具
			dots: false,
			//show_randomly: false,
			fullscreen: false
			
		});	
		// Highlight
	});
</script>
<div class="box_skitter box_skitter_normal" style="height:<?php echo $banner_height . "px";  ?>;">
    <ul>
    <?php if ($TmpBanner1 != "") { // Show if recordset not empty ?>
        <li>
            <a href="<?php echo "#"; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/image/<?php echo $TmpBanner1; ?>" class="cubeJelly"/></a>
            <div class="label_text">
            </div>
        </li>
    <?php }?>
    <?php if ($TmpBanner2 != "") { // Show if recordset not empty ?>
        <li>
            <a href="<?php echo "#"; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/image/<?php echo $TmpBanner2; ?>" class="cubeJelly"/></a>
            <div class="label_text">
            </div>
        </li>
    <?php }?>
    <?php if ($TmpBanner3 != "") { // Show if recordset not empty ?>
        <li>
            <a href="<?php echo "#"; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/image/<?php echo $TmpBanner3; ?>" class="cubeJelly"/></a>
            <div class="label_text">
            </div>
        </li>
    <?php }?>
    <?php if ($TmpBanner4 != "") { // Show if recordset not empty ?>
        <li>
            <a href="<?php echo "#"; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/image/<?php echo $TmpBanner4; ?>" class="cubeJelly"/></a>
            <div class="label_text">
            </div>
        </li>
    <?php }?>
    <?php if ($TmpBanner5 != "") { // Show if recordset not empty ?>
        <li>
            <a href="<?php echo "#"; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/image/<?php echo $TmpBanner5; ?>" class="cubeJelly"/></a>
            <div class="label_text">
            </div>
        </li>
    <?php }?>
    </ul>
</div>
<style>
 .box_skitter_normal{
      max-width: 100%;
  }
  .box_skitter_normal img{
      height:<?php echo $banner_height;?>px;
  }
</style>
<?php }?>