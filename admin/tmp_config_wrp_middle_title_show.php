<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmp_middle_title_height">區塊高度:</label>
<input type="text" id="tmp_middle_title_height" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-header"></div>
<br />
<label for="tmp_middle_title_x">文字偏移:</label>
<input type="text" id="tmp_middle_title_x" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-tmp_middle_title_x"></div>
<br />
<label for="tmp_middle_title_font_color">文字顏色:</label>
<input name="tmp_middle_title_font_color" type="text" class="color-picker" id="tmp_middle_title_font_color" value="<?php echo $row_RecordTmp['tmp_middle_title_font_color']; ?>" size="20"/>
<br /><br />

<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
</div> 
</div>
<script>
$(function() {
  $( "#slider-header" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmp_middle_title_height']; ?>",
	min: 0,
	max: 100,
	slide: function( event, ui ) {
	  $("#tmp_middle_title_height" ).val(ui.value);
	  $(".ct_title").css({"min-height":ui.value+"px", "line-height":ui.value+"px"});
	}
  });
  $( "#tmp_middle_title_height" ).val( "" + $( "#slider-header" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var h_val= $("#tmp_middle_title_height").val();
var x_val= $("#tmp_middle_title_height").val();
var f_color= $("#tmp_middle_title_font_color").val(); 
f_color_change = f_color.replace("#", "");
$.ajax({
		type: "GET",
		url: "sqlgettmp/middle_title_config_get.php?h="+ h_val + "&x="+ x_val + "&f_color=" + f_color_change + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!");
			//alert(data); 
		 }
	  });
});
</script> 
<script language="javascript" type="text/javascript">
$(function() {
  $( "#slider-tmp_middle_title_x" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmp_middle_title_x']; ?>",
	min: 0,
	max: 50,
	slide: function( event, ui ) {
	  $("#tmp_middle_title_x" ).val(ui.value);
	  $(".ct_title").css({"padding-left":ui.value+"px"});
	}
  });
  $( "#tmp_middle_title_x" ).val( "" + $( "#slider-tmp_middle_title_x" ).slider( "value" ) );
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".color-picker").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$(".ct_title, .ct_title a").css({"color":hex});
	}
	});
});
</script>
