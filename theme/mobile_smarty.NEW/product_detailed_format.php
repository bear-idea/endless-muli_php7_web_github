<?php if ($totalRows_RecordProductFormat > 0) { // Show if recordset not empty ?>
<div style="height:5px;"></div>
<div class="product_inner_board_detailed">
<div class="product_inner_board_detailed_title"><?php echo $Lang_Classify_Context_Model_Product_Select //規格： ?></div>
<div id="text-radio">
<table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
<?php $ic=0; $fmtpid=""; ?>
<?php do { ?>
<tr><td width="70" align="right"><?php echo $row_RecordProductFormat['formatname']; ?>： </td><td>
<?php
$arr_format = explode(';', $row_RecordProductFormat['formatselect']);
for($i = 0; $i < count($arr_format); $i++){ 
?>
<input class="text-nicelabel" data-nicelabel='{"position_class": "text_radio", "checked_text": "<?php echo $arr_format[$i]; ?>", "unchecked_text": "<?php echo $arr_format[$i]; ?>"}' checked type="radio" name="formatselect<?php echo $row_RecordProductFormat['pid']; ?>" value="<?php echo $arr_format[$i]; ?>"/>
<?php
}
?>
</td></tr>
<?php $fmtpid.=$row_RecordProductFormat['pid'].";"; // 取得pid?>
<?php } while ($row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat)); ?>
</table>
</div>
</div>
<?php } // Show if recordset not empty ?>

<script>
	$('#text-radio input').nicelabel({ uselabel: false});
</script>