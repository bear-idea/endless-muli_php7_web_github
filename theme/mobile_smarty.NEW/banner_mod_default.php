<section id="slider" class="slider fullwidthbanner-container roundedcorners" style="background-color:transparent">
  <?php 
				$TmpWebWidth = "1170";
				$arr = getimagesize($_SERVER['DOCUMENT_ROOT'] . $SiteBaseUrl . "site/" . $_GET['wshop'] . "/image/banner/" . $row_RecordAds['pic']);
				$banner_height = $arr[1]*(($TmpWebWidth-$Tmp_Banner_L_T_Width-$Tmp_Banner_R_T_Width)/$arr[0]); 
				/* 圖片原高度 * 版面寬度 / 圖片原寬度 */
					/*Navigation Styles:
					
						data-navigationStyle="" theme default navigation
						
						data-navigationStyle="preview1"
						data-navigationStyle="preview2"
						data-navigationStyle="preview3"
						data-navigationStyle="preview4"
						
					Bottom Shadows
						data-shadow="1"
						data-shadow="2"
						data-shadow="3"
						
					Slider Height (do not use on fullscreen mode)
						data-height="300"
						data-height="350"
						data-height="400"
						data-height="450"
						data-height="500"
						data-height="550"
						data-height="600"
						data-height="650"
						data-height="700"
						data-height="750"
						data-height="800"*/
				?>
  <div class="fullwidthbanner" data-height="<?php echo $banner_height; ?>" data-navigationStyle="preview0">
    <ul class="hide">
      
      <!-- SLIDE  -->
      <?php do { ?>
      <li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off"  data-title="Slide" <?php if($row_RecordAds['link'] != '') { ?>data-link="<?php echo $row_RecordAds['link']; ?>"<?php } ?>> <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" data-lazyload="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat" /> </li>
      <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
    </ul>
    <div class="tp-bannertimer"></div>
  </div>
</section>
