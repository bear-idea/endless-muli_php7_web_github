<?php do { ?>
<?php if($row_RecordOtrlinkDetailed['link'] != "" && $row_RecordOtrlinkDetailed['link'] != "http://#") { ?>
<div class="otrlink_content"><a href="<?php echo $row_RecordOtrlinkDetailed['link']; ?>" title="<?php echo $row_RecordOtrlinkDetailed['sdescription']; ?>" target="_blank"><?php echo $row_RecordOtrlinkDetailed['name']; ?></a></div>
<?php } else { ?>
<div class="otrlink_content"><?php echo $row_RecordOtrlinkDetailed['name']; ?></div>
<?php } ?>
<?php } while ($row_RecordOtrlinkDetailed = mysqli_fetch_assoc($RecordOtrlinkDetailed)); ?>