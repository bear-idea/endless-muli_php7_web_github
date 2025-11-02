<div style="clear:both;">
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpmeger_t_m">區塊合併:</label><br />

  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpmeger_t_m'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmeger_t_m" value="1" id="RadioGroup1_0" />
    合併</label>
  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpmeger_t_m'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpmeger_t_m" value="0" id="RadioGroup1_1" />
    不合併</label>
<br />
<br />
<label for="tmpmiddleminheight">區塊高度:</label>
<input type="text" id="tmpmiddleminheight" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-header"></div>
<br />
<br />
<label for="tmpmiddlepadding">內距:</label>
<input type="text" id="tmpmiddlepadding" style="border:0; color:#f6931f; font-weight:bold;" size="5" readonly="readonly" />
<div id="slider-padding"></div>
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />

</div>
</div>

<script language="javascript" type="text/javascript">
$(function() {
  $( "#slider-header" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpmiddleminheight']; ?>",
	min: 0,
	max: 500,
	slide: function( event, ui ) {
	  $("#tmpmiddleminheight" ).val(ui.value);
	  $("#wrapper #Content_containter #Main_content #context").css("min-height",ui.value+"px");
	}
  });
  $( "#tmpmiddleminheight" ).val( "" + $( "#slider-header" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$(function() {
  $( "#slider-padding" ).slider({
	range: "min",
	value: "<?php echo $row_RecordTmp['tmpmiddlepaddingtop']; ?>",
	min: 0,
	max: 10,
	slide: function( event, ui ) {
	  $("#tmpmiddlepadding" ).val(ui.value);
	  $("#wrapper #Content_containter #Main_content #context").css("padding",ui.value+"px");
	}
  });
  $( "#tmpmiddlepadding" ).val( "" + $( "#slider-padding" ).slider( "value" ) );
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var h_val= $("#tmpmiddleminheight").val();
var middle_padding_val= $("#tmpmiddlepadding").val();
var meger_val= $("input[name='tmpmeger_t_m']:checked").val();
$.ajax({
		type: "GET",
		url: "sqlgettmp/middle_config_get.php?h="+ h_val + "&padding=" + middle_padding_val + "&meger=" + meger_val +"&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert(data); 
			//alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 

</div><script type="text/javascript">
	$('document').ready(
		function(){
			$('input:radio').click(
				function(){
					var cop = $("input[name='tmpmeger_t_m']:checked").val();
					//alert('changed');  
					if(cop == '1')
					{
						$(".mdtitle_b").css({"display":"none"});
						$(".mdmiddle_t").css({"display":"none"});
					}else{
						$(".mdtitle_b").css({"display":"block"});
						$(".mdmiddle_t").css({"display":"block"});
						$(".mdtitle_b_l").css({"width":"<?php echo $Tmp_Title_L_B_Width; ?>px","height":"<?php echo $Tmp_Title_L_B_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_L_B_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Title_L_B_Repeat; ?>","background-attachment":"scroll","background-position":"left top"});
						$(".mdtitle_b_r").css({"width":"<?php echo $Tmp_Title_R_B_Width; ?>px","height":"<?php echo $Tmp_Title_R_B_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_R_B_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Title_R_B_Repeat; ?>","background-attachment":"scroll","background-position":"left top"});
						$(".mdtitle_b_c").css({"height":"<?php echo $Tmp_Title_M_B_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_M_B_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Title_M_B_Repeat; ?>","background-attachment":"scroll","background-position":"left top","margin":"0px <?php echo $Tmp_Title_R_B_Width; ?>px 0px <?php echo $Tmp_Title_L_B_Width; ?>px"});
						$(".mdmiddle_t_l").css({"width":"<?php echo $Tmp_Middle_L_T_Width; ?>px","height":"<?php echo $Tmp_Middle_L_T_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_L_T_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Middle_L_T_Repeat; ?>","background-attachment":"scroll","background-position":"left top"});
					$(".mdmiddle_t_r").css({"width":"<?php echo $Tmp_Middle_R_T_Width; ?>px","height":"<?php echo $Tmp_Middle_R_T_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_R_T_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Middle_R_T_Repeat; ?>","background-attachment":"scroll","background-position":"left top"});
					$(".mdmiddle_t_c").css({"height":"<?php echo $Tmp_Middle_M_T_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_M_T_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Middle_M_T_Repeat; ?>","background-attachment":"scroll","background-position":"left top","margin":"0px <?php echo $Tmp_Middle_R_T_Width; ?>px 0px <?php echo $Tmp_Middle_L_T_Width; ?>px"});
					}
				}
			);  
		}
	);

</script>