<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 橫幅模式</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC;">
<label for="tmpbanner">橫幅模式:</label>
<br />

<div style="width:350px;"><hr/></div>
      <div class="B_w">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="0" id="tmpbanner_0" />
          不使用 </label><span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此選項代表不使用橫幅圖片。" data-toggle="tooltip" data-placement="top">?</a></span>
  </div>
        <div style="width:350px;"><hr/></div>
        <div class="B_w">
        <?php //if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="1" id="tmpbanner_1" />
          使用公版橫幅(可多圖輪播) </label><span class = "InnerPage" style="float:none;"><a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="點選進入橫幅上傳畫面。" target="_blank" class="tip_img001" data-toggle="tooltip" data-placement="top">橫幅設定</a></span>
        <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此選項代表選擇此項目的樣板皆使用一個統一的橫幅，而此橫幅之圖片可在在後台首頁的《輪播系統》中修改，並且可在其功能中設定各圖片的轉場特效。" data-toggle="tooltip" data-placement="top">?</a></span><input name="button3" type="button" id="button3" onclick="MM_openBrWindow('banner_link_photo.php','範例圖片','resizable=yes,width=1030,height=500')" value="範例圖片" /><br />
        <span style=" color:#C30">任一版型橫幅設定選擇此項目，版型皆會套用此圖片輪播，為一共用的橫幅。</span></div>
        <div style="width:350px;"><hr/></div>
        <?php //} ?>
		<?php //if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
        <div class="B_w">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="2" id="tmpbanner_2" />
          使用樣版橫幅(可多圖輪播)</label>
        <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="點選進入橫幅上傳畫面。" target="_blank" class="tip_img001" data-toggle="tooltip" data-placement="top"><span onclick="MM_openBrWindow('tmp_manage_banner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordTmp['id']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $row_RecordTmp['name']; ?>','','resizable=yes,width=1200,height=600')">橫幅設定</span></a></span>
        <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此選項代表目前此樣板使用之橫幅，其他的樣版並不會套用，並且可在其功能中設定各圖片的轉場特效且不限制您的上傳圖片數量，但不建議上傳過多，過多圖片可能會導致網頁載入過慢。" data-toggle="tooltip" data-placement="top">?</a></span><input name="button3" type="button" id="button3" onclick="MM_openBrWindow('banner_link_photo.php','範例圖片','resizable=yes,width=1030,height=500')" value="範例圖片" /></div>
        <span style=" color:#C30">此橫幅設定僅會套用您目前在設定的版型!!為此版獨立使用的橫幅。</span>
  <div style="width:350px;"><hr/></div>
		<?php //} ?>
        <!--<div class="B_w">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="4" id="tmpbanner_4" />
          多圖輪播(簡單)</label>
        <span class = "InnerPage" style="float:none;"><a href="tmp_config_wrp_banner_muli.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="點選進入橫幅上傳畫面。" target="_blank" class="tip_img001" data-toggle="tooltip" data-placement="top">橫幅設定</a></span>
        <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此選項代表目前此樣板使用之橫幅，其他的樣版並不會套用，並且至多允許上傳5張圖片。" data-toggle="tooltip" data-placement="top">?</a></span><input name="button3" type="button" id="button3" onclick="MM_openBrWindow('banner_link_photo.php','範例圖片','resizable=yes,width=1030,height=500')" value="範例圖片" /></div>
<span style=" color:#C30">此橫幅設定僅會套用您目前在設定的版型!!轉場特效會使用預設效果。</span>
        <div style="width:350px;"><hr/></div>-->
        <div class="B_w">
        <label>
          <input <?php if (!(strcmp($row_RecordTmp['tmpbanner'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbanner" value="3" id="tmpbanner_3" />
          使用單圖橫幅</label>
        (Gif / Flash / Jpg) <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此選項代表僅使用一張圖片作上傳，但允許上傳Flash之媒體、Jpg、Gif之格式，下面之長寬為此選項之特定設定，建議上傳之物件寬度為960px，為版面之寬度，高度不設限，若未填寫某些瀏覽器會判斷您的物件高度為0，即不會顯示。" data-toggle="tooltip" data-placement="top" class="tip_img001">?</a></span><input name="button3" type="button" id="button3" onclick="MM_openBrWindow('banner_link_photo.php','範例圖片','resizable=yes,width=1030,height=500')" value="範例圖片" /></div><span class="radioRequiredMsg">請進行選取。</span>
        
        <div style="padding:10px;margin-bottom:10px; border:1px #ECDBD3 solid; color:#B37C67; font-weight:bolder; background-color:#F0F0F0; margin-left:25px;">
        <p>
          <label>
            <input <?php if (!(strcmp($row_RecordTmp['tmpbannerselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbannerselect" value="1" id="tmpbannerselect_0" />
            預設圖片</label> <span class = "InnerPage" style="float:none;" id="Step_Add"><a href="bannershow_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>" data-original-title="點選進入選擇橫幅畫面。" data-toggle="tooltip" data-placement="top">圖片選擇</a></span>
          <br />
          <label>
            <input <?php if (!(strcmp($row_RecordTmp['tmpbannerselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpbannerselect" value="0" id="tmpbannerselect_1" />
            自訂圖片</label>(支援Gif / Flash / Jpg) <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此選項代表僅使用一張圖片作上傳，但允許上傳Flash之媒體、Jpg、Gif之格式，下面之長寬為此選項之特定設定，建議上傳之物件寬度為960px，為版面之寬度，高度不設限，若未填寫某些瀏覽器會判斷您的物件高度為0，即不會顯示。" data-toggle="tooltip" data-placement="top" class="tip_img001">?</a></span>
          <br />
        </p>
        <div style="margin-left:25px; margin-top:5px;">
寬度：<span id="sprytextfield35">
          <label for="tmpbannerpicwidth"></label>
          <input name="tmpbannerpicwidth" type="text" id="tmpbannerpicwidth" value="<?php echo $row_RecordTmp['tmpbannerpicwidth']; ?>" size="3" maxlength="4" />
          <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px 高度：<span id="sprytextfield36">
            <label for="tmpbannerpicheight"></label>
            <input name="tmpbannerpicheight" type="text" id="tmpbannerpicheight" value="<?php echo $row_RecordTmp['tmpbannerpicheight']; ?>" size="3" maxlength="3" />
            <span class="textfieldInvalidFormatMsg">格式無效。</span></span>px
        <input name="button4" type="button" id="button4" onclick="MM_openBrWindow('uplod_tmpbannerpic.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>','圖片上傳','width=500,height=350')" value="修改上傳資料" /><br />
<span style=" color:#C30">當您使用Flash及圖片時不要忘了填寫寬高，某些版本瀏覽器並無法自動判斷寬高(例如:IE),，建議填寫。</span></div></div>
        
        <div style="width:350px;"><hr/></div>
        
<br />
<input type="button" name="use_tmp_config" id="use_tmp_config" value="套用" />
<input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />

</div>
</div>
<script language="javascript" type="text/javascript">
$("#use_tmp_config").click(function(){
var cop= $("input[name='tmpbanner']:checked").val();
var copsl= $("input[name='tmpbannerselect']:checked").val();
$.ajax({
		type: "GET",
		url: "sqlgettmp/tmpbanner_config_get.php?cop="+ cop +"&copsl="+ copsl +"&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&webname=<?php echo $wshop; ?>&theme=<?php echo $row_RecordTmp['name']; ?>&bwidth=<?php echo $TmpWebWidth; ?>&userid=<?php echo $w_userid ?>&<?php echo time();?>",
		success: function(data){ 
			if(data == "No_Image") {
				$("#banner #context").html("");
				alert("此選項您尚未上傳任何圖片!!");
			}else{
				$("#banner #context").html(data);
				alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
			}
		 }
	  });
});
</script> 
<script type="text/javascript">
	$('document').ready(
		function(){
			$('input:radio').click(
				function(){
					var cop = $("input[name='tmpbanner']:checked").val();
					//alert('changed');  
					if(cop == '0')
					{
						//$(".BlockTitle").html("標題");
					}else if(cop == '1'){
						<?php //include("../require_banner.php"); // 共通 ?>
						//alert('changed1');  
					}else if(cop == '2'){
						//$(".BlockTitle").html("");
					}else if(cop == '3'){
						//$(".BlockTitle").html("");
					}else if(cop == '4'){
						//$(".BlockTitle").html("");
					}
				}
			);  
		}
	);

</script>