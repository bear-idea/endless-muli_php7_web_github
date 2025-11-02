<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpshowblockname">區塊標題名稱:</label><br />

  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpshowblockname'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpshowblockname" value="1" id="RadioGroup1_0" />
    顯示
  </label>
  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpshowblockname'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpshowblockname" value="0" id="RadioGroup1_1" />
    隱藏</label><br />
    <span style=" color:#C30">註:此區之資料您可至【<a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">自訂欄位</a>】中增加功能項目和更改標題!!</span>
<br /><br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />

</div>
</div>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var show_val= $("input[name='tmpshowblockname']:checked").val();
$.ajax({
		type: "GET",
		url: "sqlgettmp/column_l_block_config_get.php?show_val="+ show_val +"&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			//alert(data); 
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
<script type="text/javascript">
	$('document').ready(
		function(){
			$('input:radio').click(
				function(){
					var cop = $("input[name='tmpshowblockname']:checked").val();
					//alert('changed');  
					if(cop == '1')
					{
						$(".BlockTitle").html("標題");
					}else{
						$(".BlockTitle").html("");
					}
				}
			);  
		}
	);

</script>
