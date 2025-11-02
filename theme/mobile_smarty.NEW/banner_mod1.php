<div class="skitter <?php if ($row_RecordAds['tool'] == "2" || $row_RecordAds['tool'] == "3") { echo "with-dots"; } ?>" data-theme="<?php echo $row_RecordAds['theme']; ?>" data-tool="<?php echo $row_RecordAds['tool']; ?>" data-navigationstate="<?php echo $row_RecordAds['navigationstate']; ?>" data-label="<?php echo $row_RecordAds['label']; ?>" data-interval="<?php echo $row_RecordAds['interval']; ?>">
  <ul>
    <?php do { ?>
    <li><a href="<?php echo $row_RecordAds['link']; ?>#<?php echo $row_RecordAds['animation']; ?>" target="<?php if($row_RecordAds['link'] == "") {echo "_self";}else{echo $row_RecordAds['linktarget'];} ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" class="<?php echo $row_RecordAds['animation']; ?>" /></a>
      <?php //if ($row_RecordAds['label'] == "true") { ?>
      <div class="label_text">
        <p><?php echo $row_RecordAds['sdescription']; ?></p>
      </div>
    </li>
    <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
  </ul>
</div>
