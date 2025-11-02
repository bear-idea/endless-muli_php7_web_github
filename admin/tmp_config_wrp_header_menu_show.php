<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 主選單設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpdftmenu_y">選單移動(Y軸):</label>
<input type="text" id="tmpdftmenu_y" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly />
<div id="slider-tmpdftmenu_y"></div>
<label for="tmpdftmenu_x">選單移動(X軸):</label>
<input type="text" id="tmpdftmenu_x" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly />
<div id="slider-tmpdftmenu_x"></div>
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
<script>
$(function() {
  $( "#slider-tmpdftmenu_y" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpdftmenu_y']; ?>",
	min: -250,
	max: 500,
	slide: function( event, ui ) {
	  $("#tmpdftmenu_y" ).val(ui.value);
	  $("#apDiv_dftmenu").css("top",ui.value-(<?php echo $row_RecordTmp['tmpdftmenu_y']; ?>));
	}
  });
  $( "#tmpdftmenu_y" ).val( "" + $( "#slider-tmpdftmenu_y" ).slider( "value" ) );
});
$(function() {
  $( "#slider-tmpdftmenu_x" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpdftmenu_x']; ?>",
	min: -250,
	max: 500,
	slide: function( event, ui ) {
	  $( "#tmpdftmenu_x" ).val(ui.value );
	  $("#apDiv_dftmenu").css("right",ui.value);
	}
  });
  $( "#tmpdftmenu_x" ).val( "" + $( "#slider-tmpdftmenu_x" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var x_val= $("#tmpdftmenu_x").val(); 
var y_val= $("#tmpdftmenu_y").val();  
$.ajax({
		type: "GET",
		url: "sqlgettmp/mainmenu_config_get.php?id=<?php echo $row_RecordTmpMainMenuShow['id']; ?>&x="+ x_val + "&y=" + y_val + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
</div>
</div>