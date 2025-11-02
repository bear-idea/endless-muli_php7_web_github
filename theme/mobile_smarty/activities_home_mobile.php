<style type="text/css">
.ct_board_activities_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .activities_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .activities_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Activities']; // 標題文字 ?></span></h1>
                </div>
  <div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
  <?php
  // 計算高度
   if ($TmpActivitiesImageBoard == '0') { 
   		$activities_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpActivitiesImageBoard == '1') { 
        $activities_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
   <?php do { ?> 
   <div class="photoFrame_<?php echo $TmpActivitiesBoard; ?>">
        <div class="imgLiquid" data-fill="<?php echo $TmpActivitiesImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpActivitiesImageBoard; /* 方型 or 矩形 */ ?>">
		<!-- activities image(s) -->
											  <?php if ($row_RecordActivities['pic'] != "") { ?>	 
                        <a href="<?php echo $SiteBaseUrl . url_rewrite('activities',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/activities/thumb/small_<?php echo GetFileThumbExtend($row_RecordActivities['pic']); ?>" alt="<?php echo $row_RecordActivities['sdescription']; ?>"/></a><span></span>
                  <?php } else { ?>      
                  <a><img src="images/100x100_noimage.jpg"/></a><span></span>
                  <?php } ?>
											<!-- /activities image(s) -->
		</div>
		<div class="activities_inner_board_context">
                              <a href="<?php echo $SiteBaseUrl . url_rewrite('activities',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordActivities['title']; ?></a>
                 </div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities)); ?>
</div>
<script type="text/javascript"> 
    $('.activities_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
</script>