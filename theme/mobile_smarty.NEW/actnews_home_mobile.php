<style type="text/css">
.ct_board_actnews_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .actnews_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .actnews_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php if($row_RecordTmpConfig['tmphomeactnewsshowtype'] == "1") {echo $row_RecordActnewsMultiTypeMenu_l1['itemname']; } else {echo $ModuleName['Actnews']; } ?></span></h1>
                </div>
  <!--<div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>-->
  <?php
  // 計算高度
   if ($TmpActnewsImageBoard == '0') { 
   		$actnews_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpActnewsImageBoard == '1') { 
        $actnews_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
<div class="row">
   <?php do { ?> 
   <div class="col-md-3 col-sm-6 col-xs-6">
   <div class="photoFrame_base">                                 
	     <div class="imgLiquid" data-fill="<?php echo 'resize'; /* resize or crop */ ?>" data-board="<?php echo '1'; /* 方型 or 矩形 */ ?>">
		<!-- actnews image(s) -->
										
												  <?php if ($row_RecordActnews['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("actnews",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordActnews['id']; ?>" title="<?php echo $row_RecordActnews['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/actnews/thumb/small_<?php echo GetFileThumbExtend($row_RecordActnews['pic']); ?>" alt="<?php echo $row_RecordActnews['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
								
											<!-- /actnews image(s) -->
		</div>
		<div class="actnews_inner_board_context">
		<h4>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("actnews",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordActnews['id']; ?>"><?php echo $row_RecordActnews['title']; ?>&nbsp; <?php echo date('Y-m-d',strtotime($row_RecordActnews['postdate'])); ?></a>
                            </h4>
		
	
	   </div>
	</div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordActnews = mysqli_fetch_assoc($RecordActnews)); ?>
	</div>
<!--</div>-->
<script type="text/javascript"> 
    $('.actnews_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
</script>