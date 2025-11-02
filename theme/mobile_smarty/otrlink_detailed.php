<?php do { ?>

<?php if($row_RecordOtrlinkDetailed['link'] != "" && $row_RecordOtrlinkDetailed['link'] != "http://#") { ?>
<div class="col-md-6 col-sm-6 col-xs-12 margin-bottom-10"><i class="fa fa-caret-right" aria-hidden="true"></i> <a href="<?php echo $row_RecordOtrlinkDetailed['link']; ?>" title="<?php echo $row_RecordOtrlinkDetailed['sdescription']; ?>" target="_blank"><?php echo $row_RecordOtrlinkDetailed['name']; ?></a></div>
<?php } else { ?>

<?php } ?>

<?php } while ($row_RecordOtrlinkDetailed = mysqli_fetch_assoc($RecordOtrlinkDetailed)); ?>