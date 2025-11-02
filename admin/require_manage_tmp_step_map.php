<?php
/* 取得作者列表 */

?>

<style>
.Menu_ListView_Index{padding:5px}
.mod_board{margin:2px; float:left; width:100px; border:1px dotted #DDD; height:160px; position:relative}

.mod_pic{text-align:center; vertical-align:middle; padding:5px}

.mod_text{text-align:center; vertical-align:middle}
.InnerPage{float:none; text-align:center; padding-top:10px}
.mod_tip{height:30px}
.font_color{color:#090; font-weight:bolder}
ol{counter-reset:li; list-style:none; *list-style:decimal; font:15px 'trebuchet MS','lucida sans'; padding:0; margin-bottom:4em; text-shadow:0 1px 0 rgba(255,255,255,.5)}

ol ol{margin:0 0 0 2em}
.rounded-list a{position:relative; display:block; padding:.4em .4em .4em 2em; *padding:.4em; margin:.5em 0; background:#E9EBFE; color:#444; text-decoration:none; border-radius:.3em; transition:all .3s ease-out}
.rounded-list li{margin-left:40px; position:relative}

.rounded-list .li_tip{position:relative; display:block; padding:.4em .4em .4em 2em; *padding:.4em; margin:.5em 0; background:#FEF3D3; color:#090; text-decoration:none; border-radius:.3em; transition:all .3s ease-out; margin-left:40px; font-weight:bolder; list-style-type:none}

.rounded-list a:hover{background:#DDD}

.rounded-list a:hover:before{ transform:rotate(360deg)}

.rounded-list a:before{content:counter(li); counter-increment:li; position:absolute; left:-1.3em; top:50%; margin-top:-1.3em; background:#87ceeb; height:2em; width:2em; line-height:2em; border:.3em solid #fff; text-align:center; font-weight:bold; border-radius:2em; transition:all .3s ease-out}
.box h3{color:#C30; font-size:20px; position:relative; line-height:50px; padding-left:10px}
.box{height:50px; background:#FFF; margin:5px auto}

.effect8{  position:relative;           -webkit-box-shadow:0 1px 4px rgba(0,0,0,0.3),0 0 40px rgba(0,0,0,0.1) inset;        -moz-box-shadow:0 1px 4px rgba(0,0,0,0.3),0 0 40px rgba(0,0,0,0.1) inset;             box-shadow:0 1px 4px rgba(0,0,0,0.3),0 0 40px rgba(0,0,0,0.1) inset}
.effect8:before, .effect8:after{content:"";     position:absolute;     z-index:-1;     -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);     -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);     box-shadow:0 0 20px rgba(0,0,0,0.8);     top:10px;     bottom:10px;     left:0;     right:0;     -moz-border-radius:100px / 10px;     border-radius:100px / 10px}

.effect8:after{right:10px;  left:auto;  -webkit-transform:skew(8deg) rotate(3deg);  -moz-transform:skew(8deg) rotate(3deg);   -ms-transform:skew(8deg) rotate(3deg);   -o-transform:skew(8deg) rotate(3deg);  transform:skew(8deg) rotate(3deg)}

</style>
<script type="text/javascript">
$(document).ready(function() 
{
   $('.tip_img_tmp').qtip({
      content: '<img src="images/tip/tip002.jpg" width="300" height="327" />'
   });
   $('.tip_img_column').qtip({
      content: '<img src="images/tip/tip003.jpg" width="124" height="500" />'
   });
   $('.tip_img_publish').qtip({
      content: '<img src="images/tip/tip004.jpg" width="500" height="85" />'
   });
   $('.tip_img_frilink').qtip({
      content: '<img src="images/tip/tip007.jpg" width="250" height="247" />'
   });
});
</script>
<script type="text/javascript">
 $(function() {
   $('a[rel=tipsy_s]').tipsy({fade: true, gravity: 'n'});
 });
</script>
<script>
$(document).ready(function(){$(".youtube").colorbox({iframe:true, innerWidth:560, innerHeight:315});});
</script>
<div>
  <div style="position:relative;">
      
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">步驟地圖</font></strong></h5></td>
        </tr>
    </table>
     
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    	<tr>
          <td colspan="2" style="padding:5px;">
          <div style="width:100%;">
          <div class="box effect8">
            <h3>我想直接套用官方版型<span style="font-size:12px; color:#6F6F6F"> 功能少但設定簡單，僅可以替換LOGO</span></h3>
          </div>
          <ol class="rounded-list">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&Opt=logoaddpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank">建立您的Logo【若您已建立過可略過此步驟】</a></li>
            <li><a href="logo_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_cd">選擇您要使用的Logo【此選擇會套用所有的官方版型】</a></li>
            <li><a href="template_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_cd">選擇並套用您想要的外觀</a></li>	
            <li class="li_tip">註：此版型橫幅不可替換</li>					
          </ol>
          </div>
          <div style="width:100%;">
          <div class="box effect8">
            <h3>我想自行設計版型 【直接由現有的版型來作複製修改】<span style="font-size:12px; color:#6F6F6F"> 給您一個大致的輪廓範例供您修改設計</span></h3>
          </div>
          <ol class="rounded-list">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&Opt=logoaddpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank">建立您的Logo【若您已建立過可略過此步驟】</a></li>
            <li><a href="template_get.php?lang=<?php echo $_SESSION['lang']; ?>" target="_blank" class="colorbox_iframe_cd">選擇一個您喜歡的版型來作複製</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">找到並點選您剛才建立的版型去做版型設定【您可替換各個區塊的樣式、底圖、選單外觀；也可選擇您的Logo、上傳您的橫幅、調整區塊的高度等等...】</a></li>	
            <li><a href="template_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_cd">套用您剛才所設計的外觀</a></li>	
            <li class="li_tip">註：Logo必須在您剛所建立的版型設定畫面中去做選擇</li>					
          </ol>
          </div>
          
          <div style="width:100%;">
          <div class="box effect8">
            <h3>我想自行設計版型 【建立一空白版型來做設計】<span style="font-size:12px; color:#6F6F6F"> 給您一個空白版面從頭描繪建立</span></h3>
          </div>
          <ol class="rounded-list">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&Opt=logoaddpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank">建立您的Logo【若您已建立過可略過此步驟】</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新版型" target="_blank" data-toggle="tooltip" data-placement="right">新增並建立一個空白的版型</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">找到並點選您剛才建立的版型去做版型設定【您可替換各個區塊的樣式、底圖、選單外觀；也可選擇您的Logo、上傳您的橫幅、調整區塊的高度等等...】</a></li>	
            <li><a href="template_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_cd">套用您剛才所設計的外觀</a></li>	
            <li class="li_tip">註：Logo必須在您剛所建立的版型設定畫面中去做選擇</li>					
          </ol>
          </div>
          </td>
        </tr>
    </table>

      
  </div>   
</div>
