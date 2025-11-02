<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpheaderminheight">區塊高度:</label>
<input type="text" id="tmpheaderminheight" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-header"></div>
<br />
<label for="tmpmeger_t_m">主選單區塊:</label>
<br />

  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpmainmenuindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmainmenuindicate" value="1" id="RadioGroup1_0" />
    顯示</label>
  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpmainmenuindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmainmenuindicate" value="0" id="RadioGroup1_1" />
    隱藏</label><br />
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" /> 
<script>
$(function() {
  $( "#slider-header" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpheaderminheight']; ?>",
	min: 0,
	max: 500,
	slide: function( event, ui ) {
	  $("#tmpheaderminheight" ).val(ui.value);
	  $("#header #context").css("min-height",ui.value+"px");
	}
  });
  $( "#tmpheaderminheight" ).val( "" + $( "#slider-header" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var h_val= $("#tmpheaderminheight").val(); 
var show_val= $("input[name='tmpmainmenuindicate']:checked").val()
$.ajax({
		type: "GET",
		url: "sqlgettmp/header_config_get.php?h="+ h_val + "&show_val=" + show_val + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
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
					var cop = $("input[name='tmpmainmenuindicate']:checked").val();
					//alert('changed');  
					if(cop == '1')
					{
						$("#ajax_mainmenu_location0").css({"display":"block"})
					}else{
						$("#ajax_mainmenu_location0").css({"display":"none"})
					}
				}
			);  
		}
	);
</script>
</div>
</div>