<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> LOGO設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmplogomargintop">選單移動(Y軸):</label>
<input type="text" id="tmplogomargintop" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-tmplogomargintop"></div>
<label for="tmplogomarginleft">選單移動(X軸):</label>
<input type="text" id="tmplogomarginleft" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-tmplogomarginleft"></div>
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
<script>
$(function() {
  $( "#slider-tmplogomargintop" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmplogomargintop']; ?>",
	min: -100,
	max: 350,
	slide: function( event, ui ) {
	  $("#tmplogomargintop" ).val(ui.value);
	  $("#logo").css("top",ui.value-(<?php echo $row_RecordTmp['tmplogomargintop']; ?>));
	}
  });
  $( "#tmplogomargintop" ).val( "" + $( "#slider-tmplogomargintop" ).slider( "value" ) );
});
$(function() {
  $( "#slider-tmplogomarginleft" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmplogomarginleft']; ?>",
	min: -250,
	max: 1000,
	slide: function( event, ui ) {
	  $( "#tmplogomarginleft" ).val(ui.value );
	  $("#logo").css("left",ui.value-(<?php echo $row_RecordTmp['tmplogomarginleft']; ?>));
	}
  });
  $( "#tmplogomarginleft" ).val( "" + $( "#slider-tmplogomarginleft" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var x_val= $("#tmplogomarginleft").val(); 
var y_val= $("#tmplogomargintop").val();  
$.ajax({
		type: "GET",
		url: "sqlgettmp/logo_config_get.php?x="+ x_val + "&y=" + y_val + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
</div>
</div>