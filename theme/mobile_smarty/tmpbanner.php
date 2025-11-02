 <?php if ($row_RecordAds['pic'] != "" && $totalRows_RecordAds > 0 && is_file($SiteImgUrl . $row_RecordAds['webname'] . "/image/banner/" . $row_RecordAds['pic'])) { // Show if recordset not empty ?>
<?php
      $arr = getimagesize($SiteImgUrl . $row_RecordAds['webname'] . "/image/banner/" . $row_RecordAds['pic']);
      /*
      * 這裡$arr為一個數組類型
      * $arr[0] 為圖像的寬度
      * $arr[1] 為圖像的高度
      * $arr[2] 為圖像的格式，包括jpg、gif和png等
      * $arr[3] 為圖像的寬度和高度，內容為 width="xxx" height="yyy" */ 
      //echo $arr[1]*(886/$row_RecordAds['bwight']) . '\n';
      //echo $arr[1];
	  //echo $TmpBannerPicWidth;
      $banner_height = $arr[1]*(($TmpWebWidth-$Tmp_Banner_L_T_Width-$Tmp_Banner_R_T_Width)/$arr[0]); // 圖片原高度 * 版面寬度 / 圖片原寬度
  ?>
  <div class="box_skitter box_skitter_normal" style="height:<?php if($row_RecordAds['bhight'] != '') { echo $row_RecordAds['bhight'] . "px"; } else {echo $banner_height . "px";}  ?>;">
      <ul>
      <?php do { ?>
          <li>
              <a href="<?php if($row_RecordAds['link'] != '') {echo $row_RecordAds['link'];} else {echo "#";} ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordAds['webname']; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" alt="<?php echo $row_RecordAds['title']; ?>" class="<?php echo $row_RecordAds['animation']; ?>" /></a>
              <div class="label_text">
                <p><?php echo $row_RecordAds['sdescription']; ?></p>
              </div>
          </li>
        <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
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
  <!--<img src="images/nobanner.jpg" />-->
  <?php }?>
