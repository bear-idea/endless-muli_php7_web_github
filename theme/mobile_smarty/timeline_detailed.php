<ul id="issues">
<?php do { ?>
<li id="<?php echo $row_RecordTimelineDetailed['type']; ?>"><p><?php echo $row_RecordTimelineDetailed['name']; ?></p></li>
<?php } while ($row_RecordTimelineDetailed = mysqli_fetch_assoc($RecordTimelineDetailed)); ?>
</ul>
<a href="#" id="next">+</a> 
<a href="#" id="prev">-</a> 