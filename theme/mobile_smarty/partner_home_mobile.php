<style type="text/css">
.ct_board_partner_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .partner_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .partner_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Partner']; // 標題文字 ?></span></h1>
                </div>
  <div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
  <?php
  // 計算高度
   if ($TmpPartnerImageBoard == '0') { 
   		$partner_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpPartnerImageBoard == '1') { 
        $partner_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
   <?php do { ?> 
   <div class="photoFrame_base">                                 
	    <div class="imgLiquid" data-fill="<?php echo $TmpPartnerImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpPartnerImageBoard; /* 方型 or 矩形 */ ?>">
		<!-- partner image(s) -->
						<?php if ($row_RecordPartner['pic'] != "") { ?>	 
                            <a href="<?php echo $row_RecordPartner['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/partner/<?php echo  GetFileThumbExtend($row_RecordPartner['pic']);?>" alt="<?php echo $row_RecordPartner['sdescription']; ?>" /></a>
                            <?php } else { ?>      
                            <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a><span></span>
                            <?php } ?>
											<!-- /partner image(s) -->
		</div>
		<div class="partner_inner_board_context">
                              <?php echo $row_RecordPartner['name']; ?>
                 </div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordPartner = mysqli_fetch_assoc($RecordPartner)); ?>
</div>
<script type="text/javascript"> 
    $('.partner_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
</script>