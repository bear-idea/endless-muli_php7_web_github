<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 主框架 - 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpwordcolor">文字顏色:</label>
<input name="tmpwordcolor" type="text" class="color-picker" id="tmpwordcolor" value="<?php echo $row_RecordTmp['tmpwordcolor']; ?>" size="20"/>
<br />
<font color="#999999">(文字顏色會被網頁結構最內層區塊顏色所覆蓋)</font>
<br /><br />
<label for="tmpwordsize">文字大小:</label>
<select name="tmpwordsize" id="tmpwordsize">
          <option value="9px" <?php if (!(strcmp("9px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>9px</option>
          <option value="10px" <?php if (!(strcmp("10px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>10px</option>
          <option value="11px" <?php if (!(strcmp("11px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>11px</option>
          <option value="12px" <?php if (!(strcmp("12px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>12px</option>
          <option value="13px" <?php if (!(strcmp("13px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>13px</option>
          <option value="14px" <?php if (!(strcmp("14px", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>14px</option>
          <option value="xx-small" <?php if (!(strcmp("xx-small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>xx-small</option>
          <option value="x-small" <?php if (!(strcmp("x-small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>x-small</option>
          <option value="small" <?php if (!(strcmp("small", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>small</option>
          <option value="medium" <?php if (!(strcmp("medium", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>medium</option>
          <option value="large" <?php if (!(strcmp("large", $row_RecordTmp['tmpwordsize']))) {echo "selected=\"selected\"";} ?>>large</option>
        </select>
<br /><br />
<label for="tmplink">超連結:</label>
<input name="tmplink" type="text" class="color-picker" id="tmplink" value="<?php echo $row_RecordTmp['tmplink']; ?>" size="20"/>
<br /><br />
<label for="tmplinkvisit">超連結[已點選]:</label>
<input name="tmplinkvisit" type="text" class="color-picker" id="tmplinkvisit" value="<?php echo $row_RecordTmp['tmplinkvisit']; ?>" size="20"/>
<br /><br />
<label for="tmplinkhover">超連結[滑鼠移入]:</label>
<input name="tmplinkhover" type="text" class="color-picker" id="tmplinkhover" value="<?php echo $row_RecordTmp['tmplinkhover']; ?>" size="20"/>
<br />
<br />
<label for="tmpwrpboardindicate">上下外框隱藏:</label>

  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpwrpboardindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpwrpboardindicate" value="1" id="RadioGroup1_0" />
    維持原設定</label>
  <label>
    <input <?php if (!(strcmp($row_RecordTmp['tmpwrpboardindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpwrpboardindicate" value="0" id="RadioGroup1_1" />
    強制隱藏上下外框</label>
<br />
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
</div> 
</div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 欄位區塊 - 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpleftfontcolor">文字顏色:</label>
<input name="tmpleftfontcolor" type="text" class="color-picker" id="tmpleftfontcolor" value="<?php echo $row_RecordTmp['tmpleftfontcolor']; ?>" size="20"/><input name="TransparentButtom1" type="button" id="TransparentButtom1" value="設為透明" /><br />
<font color="#999999">(設為透明會沿用主框架文字顏色設定)</font>
<br /><br />
<input type="button" name="use_tmp_left_config" id="use_tmp_left_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
</div>
</div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 中央區塊 - 細部設定</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpmiddlefontcolor">文字顏色:</label>
<input name="tmpmiddlefontcolor" type="text" class="color-picker" id="tmpmiddlefontcolor" value="<?php echo $row_RecordTmp['tmpmiddlefontcolor']; ?>" size="20"/><input name="TransparentButtom2" type="button" id="TransparentButtom2" value="設為透明" /><br />
<font color="#999999">(設為透明會沿用主框架文字顏色設定)</font>
<br /><br />
<input type="button" name="use_tmp_middle_config" id="use_tmp_middle_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
</div>
</div>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var f_color= $("#tmpwordcolor").val(); 
var f_color_change = f_color.replace("#", "");

var f_color_link= $("#tmplink").val(); 
var f_color_change_link = f_color_link.replace("#", "");

var f_color_hover= $("#tmplinkhover").val(); 
var f_color_change_hover = f_color_hover.replace("#", "");

var f_color_visit= $("#tmplinkvisit").val(); 
var f_color_change_visit = f_color_visit.replace("#", "");

var f_size= $("#tmpwordsize").find(":selected").val();

$.ajax({
		type: "GET",
		url: "sqlgettmp/wrp_config_get.php?f_color_change="+ f_color_change + "&f_color_change_link="+ f_color_change_link + "&f_color_change_hover=" + f_color_change_hover + "&f_color_change_visit=" + f_color_change_visit  + "&f_size=" + f_size + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!");
			//alert(data); 
		 }
	  });
});
</script> 
<script language="javascript" type="text/javascript">
$("#use_tmp_left_config").click(function(){
var f_color= $("#tmpleftfontcolor").val(); 
if(f_color != 'transparent'){
	var f_color_change = f_color.replace("#", "");
}else{
	var f_color_change = 'transparent';
}

$.ajax({
		type: "GET",
		url: "sqlgettmp/wrp_config_left_get.php?f_color_change="+ f_color_change + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!");
			//alert(data); 
		 }
	  });
});
</script>
<script language="javascript" type="text/javascript">
$("#use_tmp_middle_config").click(function(){
var f_color= $("#tmpmiddlefontcolor").val(); 
if(f_color != 'transparent'){
	var f_color_change = f_color.replace("#", "");
}else{
	var f_color_change = 'transparent';
}
$.ajax({
		type: "GET",
		url: "sqlgettmp/wrp_config_middle_get.php?f_color_change="+ f_color_change + "&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			alert("已套用設定項目，您可刷新頁面觀看結果!!");
			//alert(data); 
		 }
	  });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#tmpwordcolor").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("#wrp_body").css({"color":hex});
	}
	});
});
$(document).ready(function(){
	$("#tmplink").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("a:link").css({"color":hex});
	}
	});
});
$(document).ready(function(){
	$("#tmplinkvisit").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("a:visited").css({"color":hex});
	}
	});
});
$(document).ready(function(){
	$("#tmplinkhover").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("a:hover").css({"color":hex});
	}
	});
});
$(document).ready(function(){
	$("#tmpleftfontcolor").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("#wrapper #Left_column #context").css({"color":hex});
	}
	});
});
$(document).ready(function(){
	$("#tmpmiddlefontcolor").miniColors({
		letterCase:"uppercase",
		change: function(hex, opacity) {
		$("#wrapper #Content_containter #Main_content #context").css({"color":hex});
	}
	});
});
$(document).ready( function() {
		$("#TransparentButtom1").click(function(){
			// 設定透明
			$("#tmpleftfontcolor").val("transparent");
			$("#wrapper #Left_column #context").css({"color":$("#tmpwordcolor").val()});
		});
		<?php if ($row_RecordTmp['tmpleftfontcolor'] == "transparent") { ?>
			$("#tmpleftfontcolor").val("transparent");		
		<?php } ?>
		
		$("#TransparentButtom2").click(function(){
			// 設定透明
			$("#tmpmiddlefontcolor").val("transparent");
			$("#wrapper #Content_containter #Main_content #context").css({"color":$("#tmpwordcolor").val()});
		});
		<?php if ($row_RecordTmp['tmpmiddlefontcolor'] == "transparent") { ?>
			$("#tmpmiddlefontcolor").val("transparent");
		<?php } ?>
	});
</script>
<script type="text/javascript">
	$('document').ready(
		function(){
			$("#tmpwordsize").change(
				function(){
					var cop = $("#tmpwordsize").find(":selected").val();
					//alert(cop);  
					$("#wrp_body").css({"font-size":cop});
					
				}
			);  
		}
	);

</script>
<script type="text/javascript">
	$('document').ready(
		function(){
			$('input:radio').click(
				function(){
					var cop = $("input[name='tmpwrpboardindicate']:checked").val();
					//alert('changed');  
					if(cop == '0')
					{
						$("div.WrpBoardStyle .mdl_t_l").css({"display":"none"});
						$("div.WrpBoardStyle .mdl_t_c").css({"display":"none"});
						$("div.WrpBoardStyle .mdl_t_r").css({"display":"none"});
						$("div.WrpBoardStyle .mdl_b_l").css({"display":"none"});
						$("div.WrpBoardStyle .mdl_b_c").css({"display":"none"});
						$("div.WrpBoardStyle .mdl_b_r").css({"display":"none"});
					}else{
						//$("div.WrpBoardStyle .mdl_t").css({"position":"relative","display":"block"});
						$("div.WrpBoardStyle .mdl_t_l").css({"display":"block"});
						//$("div.WrpBoardStyle .mdl_t_c").css({"display":"block"});
						//$("div.WrpBoardStyle .mdl_t_r").css({"display":"block"});
						$("div.WrpBoardStyle .mdl_b_l").css({"display":"block"});
						//$("div.WrpBoardStyle .mdl_b_c").css({"display":"block"});
						//$("div.WrpBoardStyle .mdl_b_r").css({"display":"block"});
						
						$("div.WrpBoardStyle .mdl_t_l").css({"width":"<?php echo $Tmp_Wrp_L_T_Width; ?>px","height":"<?php echo $Tmp_Wrp_L_T_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_L_T_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Wrp_L_T_Repeat; ?>", "top":"0px","overflow":"hidden","left":"0"});
						
					$("div.WrpBoardStyle .mdl_t_r").css({"width":"<?php echo $Tmp_Wrp_R_T_Width; ?>px","height":"<?php echo $Tmp_Wrp_R_T_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_R_T_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Wrp_R_T_Repeat; ?>", "top":"0px","overflow":"hidden","right":"0", "float":"right"});
					$("div.WrpBoardStyle .mdl_t_c").css({"height":"<?php echo $Tmp_Wrp_M_T_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_M_T_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Wrp_M_T_Repeat; ?>","background-attachment":"scroll","background-position":"left top","margin":"0px <?php echo $Tmp_Wrp_R_T_Width; ?>px 0px <?php echo $Tmp_Wrp_L_T_Width; ?>px","position":"relative", "text-align":"left", "overflow":"hidden"});
					
					$("div.WrpBoardStyle .mdl_b_l").css({"width":"<?php echo $Tmp_Wrp_L_B_Width; ?>px","height":"<?php echo $Tmp_Wrp_L_B_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_L_B_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Wrp_L_B_Repeat; ?>","background-attachment":"scroll","background-position":"left top", "font-size":"1px","left":"0"});
						$("div.WrpBoardStyle .mdl_b_r").css({"width":"<?php echo $Tmp_Wrp_R_B_Width; ?>px","height":"<?php echo $Tmp_Wrp_R_B_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_R_B_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Wrp_R_B_Repeat; ?>","background-attachment":"scroll","background-position":"left top","position":"absolute","font-size":"1px","right":"0"});
						$("div.WrpBoardStyle .mdl_b_c").css({"height":"<?php echo $Tmp_Wrp_M_B_Height; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_M_B_Background_Img; ?>)","background-repeat":"<?php echo $Tmp_Wrp_M_B_Repeat; ?>","background-attachment":"scroll","background-position":"left top","margin":"0px <?php echo $Tmp_Wrp_R_B_Width; ?>px 0px <?php echo $Tmp_Wrp_L_B_Width; ?>px"});
					}
				}
			);  
		}
	);

</script>
