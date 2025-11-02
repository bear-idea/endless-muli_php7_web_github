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
            <h3>我想加入各種元件到我的網站中</h3>
          </div>
          <ol class="rounded-list">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在右方【可新增欄位】選擇加入您想要的元件</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在左方您可對您的元件作排序並且可進入修改</a></li>
            <li class="li_tip">註：選單您也可選擇【次選單】，代表每個選單項目都會列出自己的分類，即主頁面都會有自己的分類</li>
            <li class="li_tip">註：建議選單類的只設定一種就好較為美觀</li>
            <li class="li_tip">註：若要顯示各個元件的標題名稱，您可以在目前所使用的版型設計界面中《欄位區塊→更多設定→區塊標題名稱》去做設定</li>			
          </ol>
          </div>
          
          <div style="width:100%;">
          <div class="box effect8">
            <h3>我想加入網路上各種寫好的外部元件(Ex:部落格元件、廣告等...)</h3>
          </div>
          <ol class="rounded-list">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在右方【可新增欄位】選擇【自由欄位】元件加入</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在左方您可對您剛新增的元件作排序並且可進入修改</a></li>
            <li><a href="https://www.google.com.tw/search?q=%E9%83%A8%E8%90%BD%E6%A0%BC%E5%B0%8F%E7%8E%A9%E6%84%8F&oq=%E9%83%A8%E8%90%BD%E6%A0%BC%E5%B0%8F%E7%8E%A9%E6%84%8F" target="_blank">您可透過搜尋引擎去找尋網站現有的元件，例如:部落格小玩意</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在修改畫面的《內容》欄位【即Html編輯器】，您可在編輯器中點選【原始碼】切換編輯模式貼上網路上提供的語法即可完成加入</a></li>
            <li class="li_tip">註：若要顯示各個元件的標題名稱，您可以在目前所使用的版型設計界面中《欄位區塊→更多設定→區塊標題名稱》去做設定</li>
            <li class="li_tip">註：建議您所加入的元件、圖片寬度以200px以內為佳</li>
            <li class="li_tip">註：若要調整區塊高度您可在修改頁面調整</li>			
          </ol>
          </div>
          
          <div style="width:100%;">
          <div class="box effect8">
            <h3>我想加入Facebook粉絲頁</h3>
          </div>
          <ol class="rounded-list">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在右方【可新增欄位】選擇加入您想要的元件</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">在左方您可對您的元件作排序並且可進入修改</a></li>
            <li><a href="manage_config.php?wshop=<?php echo $wshop;?>&Opt=settingpage_bs&lang=<?php echo $_SESSION['lang']; ?>" target="_blank">您必須在網站設定中填寫您的粉絲頁網址</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank">若粉絲頁仍未顯示代表此版型此功能被關閉，您必須在目前所套用的版型《版型設定→FB粉絲頁》中去開啟它</a></li>
            <li class="li_tip">註：若要顯示各個元件的標題名稱，您可以在目前所使用的版型設計界面中《欄位區塊→更多設定→區塊標題名稱》去做設定</li>
            <li class="li_tip">註：若要調整區塊高度您可在修改頁面調整</li>		
          </ol>
          </div>
          
          </td>
        </tr>
    </table>

      
  </div>   
</div>
