<style type="text/css">
.ct_board_product_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .product_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .product_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php if($row_RecordTmpConfig['tmphomeproductshowtype'] == "1") {echo $row_RecordProductMultiTypeMenu_l1['itemname']; } else {echo $ModuleName['Product']; } ?></span></h1>
                </div>
  <div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
  <?php
  // 計算高度
   if ($TmpProductImageBoard == '0') { 
   		$product_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpProductImageBoard == '1') { 
        $product_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
   <?php do { ?> 
   <div class="photoFrame_<?php echo $TmpProductBoard; ?>">                                 
	    <div class="imgLiquid" data-fill="<?php echo $TmpProductImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpProductImageBoard; /* 方型 or 矩形 */ ?>">
		<!-- product image(s) -->
											<?php // 判斷商品所在之層級
												if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] != '-1') { $level='2'; }
												else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] == '-1') { $level='1'; }
												else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] == '-1' && $row_RecordProduct['type3'] == '-1') { $level='0'; }
												else { $level=''; }
												?>
											  <?php if ($level == '2') { ?>          
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											  <?php } else if ($level == '1') { ?>
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>

												  <?php } ?>
											  <?php } else if ($level == '0') { ?>
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											  <?php } else { ?>
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											  <?php } ?>
											<!-- /product image(s) -->
		</div>
		<div class="product_inner_board_context">
		<h4><?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?></h4>
		
	
	   </div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
</div>
<script type="text/javascript"> 
    $('.product_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
</script>