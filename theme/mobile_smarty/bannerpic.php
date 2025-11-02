<?php if ($TmpBannerPic != "" && GetFileExtend($TmpBannerPic) != '.swf') { ?>
<img src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/banner/<?php echo $TmpBannerPic; ?>" width="<?php echo $TmpWebWidth-$Tmp_Banner_L_T_Width-$Tmp_Banner_R_T_Width; ?>px"/>
<?php } else if (GetFileExtend($TmpBannerPic) == '.swf'){ ?>
<embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $tplwebname; ?>/banner/<?php echo $TmpBannerPic; ?>" width="<?php echo $TmpWebWidth-$Tmp_Banner_L_T_Width-$Tmp_Banner_R_T_Width; ?>" height="<?php echo $TmpBannerPicHeight; ?>" play="true" loop="true" quality="high" wmode="transparent"></embed>
<?php }  ?>
