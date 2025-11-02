<style type="text/css">
.ct_board_project_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .project_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .project_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Project']; // 標題文字 ?></span></h1>
                </div>
  <div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
  <?php
  // 計算高度
   if ($TmpProjectImageBoard == '0') { 
   		$project_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpProjectImageBoard == '1') { 
        $project_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
   <?php do { ?> 
   <div class="photoFrame_<?php echo $TmpProjectBoard; ?>"> 
        <div class="imgLiquid" data-fill="<?php echo $TmpProjectImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpProjectImageBoard; /* 方型 or 矩形 */ ?>">
		<!-- project image(s) -->
											  <?php if ($row_RecordProject['pic'] != "") { ?>	 
                        <a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordProject['act_id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/project/thumb/small_<?php echo GetFileThumbExtend($row_RecordProject['pic']); ?>" alt="<?php echo $row_RecordProject['sdescription']; ?>"/></a><span></span>
                  <?php } else { ?>      
                  <a><img src="images/100x100_noimage.jpg"/></a><span></span>
                  <?php } ?>
											<!-- /project image(s) -->
		</div>
		<div class="project_inner_board_context">
                              <a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordProject['act_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordProject['title']; ?></a>
                 </div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordProject = mysqli_fetch_assoc($RecordProject)); ?>
</div>
<script type="text/javascript"> 
    $('.project_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
</script>