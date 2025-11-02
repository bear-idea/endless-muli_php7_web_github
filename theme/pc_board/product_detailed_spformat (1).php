<?php if ($totalRows_RecordProducSptFormat > 0) { // Show if recordset not empty ?>
<div style="height:5px;"></div>
<div class="product_inner_board_detailed">
<div class="product_inner_board_detailed_title"><?php echo $Lang_Classify_Context_Model_Product_Select_Sp //規格： ?></div>
<table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
<tr><td width="70" align="right"><?php echo $Lang_Classify_Context_Model_Product //規格： ?> </td><td>
<?php $spformatcount=1; ?>
  <?php
do {  
?>

  <label>
    <input name="spformat" type="radio" id="spformat_0" onclick="return Checkspformat();" value="<?php echo $row_RecordProducSptFormat['price']?>#<?php echo $row_RecordProducSptFormat['spprice']?>#<?php echo $row_RecordProducSptFormat['formatname']?>" <?php if ($spformatcount=='1'){ ?>checked="checked"<?php } ?>/>
    <?php echo $row_RecordProducSptFormat['formatname']?></label>
    <?php $spformatcount++; ?>
  <?php
} while ($row_RecordProducSptFormat = mysqli_fetch_assoc($RecordProducSptFormat));
  $rows = mysqli_num_rows($RecordProducSptFormat);
?>
</select>
</td></tr>
</table>
</div>

<script type="text/javascript">
function Checkspformat(){
	var item = $('input[name=spformat]:checked').val();
	var arr=new Array();
	arr = item.split('#');
	//alert(arr[0]); // 價格
	//alert(arr[1]); // 優惠價
	$("#Cg_Price").html('<?php echo $Lang_Classify_Context_Currency_units; ?>'+arr[0]);
	$("#Cg_SpPrice").html('<?php echo $Lang_Classify_Context_Currency_units; ?>'+arr[1]);
	$("#price").val(arr[0]);
	$("#spprice").val(arr[1]);
};
</script>
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
		var item = $('input[name=spformat]:checked').val();
		if(item != "") {
			var arr=new Array();
	        arr = item.split('#');
			$("#Cg_Price").html('<?php echo $Lang_Classify_Context_Currency_units; ?>'+arr[0]);
			$("#Cg_SpPrice").html('<?php echo $Lang_Classify_Context_Currency_units; ?>'+arr[1]);
			$("#price").val(arr[0]);
			$("#spprice").val(arr[1]);
		}
    });
</script>
<?php } // Show if recordset not empty ?>