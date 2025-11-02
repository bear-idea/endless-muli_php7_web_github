
	
<?php if ($MSTMP == 'default') { ?>
<?php if ($TmpBanner1 != "") { // Show if recordset not empty ?>
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
	$banner_height = $arr[1]*($TmpWebWidth/$arr[0]); // 圖片原高度 * 版面寬度 / 圖片原寬度
?>
<div class="box_skitter box_skitter_normal" style="height:<?php echo $banner_height . "px";  ?>;">
    <ul>
        <li>
            <a href="<?php echo "#"; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/image/<?php echo $TmpBanner1; ?>"/></a>
            <div class="label_text">
            </div>
        </li>
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
<?php } else {// Show if recordset not empty ?>
<img src="images/banner.jpg" />
<?php }?>

<?php } else { ?>
<?php include($TplPath . "/tmpbannermuli.php"); ?>
<?php } ?>
