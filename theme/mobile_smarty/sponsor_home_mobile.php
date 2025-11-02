<style type="text/css">
.ct_board_sponsor_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .sponsor_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .sponsor_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Sponsor']; // 標題文字 ?></span></h1>
                </div>
  <div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
  <?php
  // 計算高度
   if ($TmpSponsorImageBoard == '0') { 
   		$sponsor_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpSponsorImageBoard == '1') { 
        $sponsor_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
   <?php do { ?> 
   <div class="photoFrame_<?php echo $TmpSponsorBoard; ?>"> 
        <div class="imgLiquid" data-fill="resize" data-board="<?php echo $TmpSponsorImageBoard; /* 方型 or 矩形 */ ?>">
		<!-- sponsor image(s) -->
											  <?php if ($row_RecordSponsor['pic'] != "") { ?>	 
                        <a href="<?php echo $row_RecordSponsor['link'];?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/sponsor/<?php echo GetFileThumbExtend($row_RecordSponsor['pic']); ?>" alt="<?php echo $row_RecordSponsor['sdescription']; ?>"/></a><span></span>
                  <?php } else { ?>      
                  <a><img src="images/100x100_noimage.jpg"/></a><span></span>
                  <?php } ?>
											<!-- /sponsor image(s) -->
		</div>
		<div class="sponsor_inner_board_context">
                              <a href="<?php echo $row_RecordSponsor['link'];?>"><?php echo $row_RecordSponsor['name']; ?></a>
                 </div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor)); ?>
</div>
<script type="text/javascript"> 
    $('.sponsor_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
</script>