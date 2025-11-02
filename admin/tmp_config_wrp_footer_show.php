<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpfooterminheight">區塊高度:</label>
<input type="text" id="tmpfooterminheight" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly">
<div id="slider-header"></div>
<br />
<label for="tmpfooterfontcolor">文字顏色:</label>
<input name="tmpfooterfontcolor" type="text" class="color-picker" id="tmpfooterfontcolor" value="<?php echo $row_RecordTmp['tmpfooterfontcolor']; ?>" size="20"/>
<br /><br />

<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
</div> 
</div>
<script>
$(function() {
  $( "#slider-header" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpfooterminheight']; ?>",
	min: 0,
	max: 500,
	slide: function( event, ui ) {
	  $("#tmpfooterminheight" ).val(ui.value);
	  $("#footer #context").css("min-height",ui.value+"px");
	}
  });
  $( "#tmpfooterminheight" ).val( "" + $( "#slider-header" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var h_val= $("#tmpfooterminheight").val();
var f_color= $("#tmpfooterfontcolor").val(); 
f_color_change = f_color.replace("#", "");
$.ajax({
		type: "GET",
		url: "sqlgettmp/footer_config_get.php?h="+ h_val + "&f_color=" + f_color_change + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!");
			//alert(data); 
		 }
	  });
});
</script> 
<script type="text/javascript">
$(document).ready(function(){
	$(".color-picker").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("#footer #context, #footer #context a").css({"color":hex});
	}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){$(".color-picker").miniColors({letterCase:"uppercase"});$("#randomize").click(function(){$(".color-picker").each(function(){$(this).miniColors("value","#"+Math.floor(16777215*Math.random()).toString(16))})})});
</script>
