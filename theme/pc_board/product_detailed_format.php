<?php if ($totalRows_RecordProductFormat > 0) { // Show if recordset not empty ?>
<div style="height:5px;"></div>
<div class="product_inner_board_detailed">
<div class="product_inner_board_detailed_title"><?php echo $Lang_Classify_Context_Model_Product_Select //規格： ?></div>
<table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
<?php $ic=0; ?>
<?php do { ?>
<tr><td width="70" align="right"><?php echo $row_RecordProductFormat['formatname']; ?>： </td><td>

<label for="formatselect<?php echo $row_RecordProductFormat['pid']; ?>"></label>
<select name="formatselect<?php echo $row_RecordProductFormat['pid']; ?>" id="formatselect<?php echo $row_RecordProductFormat['pid']; ?>">
<?php
$arr_format = explode(';', $row_RecordProductFormat['formatselect']);
for($i = 0; $i < count($arr_format); $i++){ 
?>
  <option value="<?php echo $arr_format[$i]; ?>"><?php echo $arr_format[$i]; ?></option>

<?php
}
?>  
</select>
</td></tr>
<?php } while ($row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat)); ?>
<?php echo $fmt ?>
</table>
</div>
<?php } // Show if recordset not empty ?>