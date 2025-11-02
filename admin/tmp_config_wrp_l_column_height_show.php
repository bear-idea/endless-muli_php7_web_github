<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpleftminheight">區塊最小高度:</label>
<input type="text" id="tmpleftminheight" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-header"></div>
<br />
<div style="color:#F00;">*區塊高度會依內部資料的高度作依據，若您設定的背景因為內部資料不夠多而無法完整顯示，您可強制指定此區塊的最小高度,0為不設定高度。</div>
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" /> 
<script>
$(function() {
  $( "#slider-header" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpleftminheight']; ?>",
	min: 0,
	max: 1500,
	slide: function( event, ui ) {
	  $("#tmpleftminheight" ).val(ui.value);
	  $("#Left_column #context").css("min-height",ui.value+"px");
	}
  });
  $( "#tmpleftminheight" ).val( "" + $( "#slider-header" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var h_val= $("#tmpleftminheight").val(); 
$.ajax({
		type: "GET",
		url: "sqlgettmp/column_l_height_config_get.php?h="+ h_val + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
</div>
</div>