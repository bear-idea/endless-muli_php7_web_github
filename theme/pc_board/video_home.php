<style type="text/css">
.video_outer_board tr td{margin:0;padding:0}
div .video_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell_video{overflow:hidden;height:140px;width:180px}
.video_inner_board_relative{position:relative}
.video_inner_board_relative_buttom{position:relative}
.youtube_thumb img{width:180px;height:140px}
.nailthumb-container{
	border:1px solid #EEE;
	height: <?php echo floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	margin:auto;
	width: <?php echo floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px;
}
</style>
  <div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Video']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordVideo > 0 ) { // Show if recordset not empty 
?>
        <div class="columns on-3">
          <div class="container board Scroll_Bar_horizontal">
 	  <?php $i=$startRow_RecordVideo + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container video_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <!-- 內容 -->
                      <div class="photoFrame_base">
                        <div class="video_inner_board_relative">
                          <div class='<?php echo $TmpVideoBoardIcon; ?>'></div>
                          <div class="nailthumb-container">
                            <?php if ($row_RecordVideo['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("video",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/video/<?php echo  GetFileThumbExtend($row_RecordVideo['pic']);?>" alt="<?php echo $row_RecordVideo['sdescription']; ?>"/></a>
                            <?php } else { ?>      
                            <div class="nailthumb-container">
                                <a href="<?php echo $SiteBaseUrl . url_rewrite("video",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><div id="thumb<?php echo $row_RecordVideo['id'] ?>" class="youtube_thumb"></div></a>
                            </div>
                            <script type="text/javascript">
                                $(function(){ 
                                    // 透過完整的影片網址來取得指定的小圖片
                                    $("<img />").attr("src", $.jYoutube("<?php echo $row_RecordVideo['link'] ?>", "big")).appendTo("#thumb<?php echo $row_RecordVideo['id'] ?>");
                                });
                            </script>
                            <?php } ?>
                            </div> 
                          </div>
                        </div>
                      <!-- 內容 End-->
                    </td>
                    </tr>
                  <tr>
                    <td align="center"><?php echo $row_RecordVideo['name']; ?></td>
                    </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php //if ($i%3 == 1) {echo "<div class=\"column span-3 \"><div class=\"container video_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordVideo = mysqli_fetch_assoc($RecordVideo)); ?>
            </div>
          </div>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordVideo == 0) { // Show if recordset empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Video']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
  </tr>
</table>
<br />
<br />
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.video_inner_board_relative .nailthumb-container').nailthumb({
				method:'resize', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>

<script type="text/javascript">
(function($){
	$.extend({
		jYoutube: function( url, size ){
			if(url === null){ return ""; }

			size = (size === null) ? "big" : size;
			var vid;
			var results;

			results = url.match("[\\?&]v=([^&#]*)");

			vid = ( results === null ) ? url : results[1];

			if(size == "small"){
				return "http://img.youtube.com/vi/"+vid+"/2.jpg";
			}else {
				return "http://img.youtube.com/vi/"+vid+"/0.jpg";
			}
		}
	})
})(jQuery);
</script>
<script type="text/javascript">
	$(function(){
		var thumbSize = 'large',		// 設定要取得的縮圖是大圖還是小圖
										// 大圖寬高為 480X360；小圖寬高為 120X90
			imgWidth = '240',			// 限制圖片的寬及 YouTube 影片的寬
			imgHeight = '180',			// 限制圖片的高及 YouTube 影片的高
			autoPlay = '&autoplay=1',	// 是否載入 YouTube 影片後自動播放；若不要自動播放則設成 0
			fullScreen = '&fs=1';		// 是否允許播放 YouTube 影片時能全螢幕播放

		$('ul.playlist>li>a').each(function(){
			// 取得要連結轉換的網址及訊息內容
			var _this =  $(this),
				_url = _this.attr('href'),
				_info = _this.text(),
				_type = (thumbSize == 'large') ? 0 : 2;
			
			// 取得 vid
			var vid = _url.match('[\\?&]v=([^&#]*)')[1];

			// 取得縮圖
			var thumbUrl = "http://img.youtube.com/vi/"+vid+"/" + _type + ".jpg";
			
			// 把目前超連結的內容轉換成圖片並加入 click 事件
			_this.html('<img src="'+thumbUrl+'" alt="'+_info+'" title="'+_info+'" width="'+imgWidth+'" height="'+imgHeight+'" />').click(function(){
				return false;
			}).focus(function(){
				this.blur();
			}).children('img').click(function(){
				// 當點擊到圖片時就轉換成 YouTube 影片
				var swf  = '<object width="'+imgWidth+'" height="'+imgHeight+'">';
				swf += '<param name="movie" value="http://www.youtube.com/v/'+vid+autoPlay+fullScreen+'"></param>';
				swf += '<param name="wmode" value="transparent"></param>';
				swf += (fullScreen == '&fs=1') ? '<param name="allowfullscreen" value="true"></param>' : '';
				
				swf += '<embed type="application/x-shockwave-flash" src="http://www.youtube.com/v/'+vid+autoPlay+fullScreen+'" ';
				swf += (fullScreen == '&fs=1') ? 'allowfullscreen="true" ' : '';
				swf += 'wmode="transparent" width="'+imgWidth+'" height="'+imgHeight+'""></embed>';

				swf += '</object/>';
				
				$(this).parent('a').html(swf);

				return false;
			});
		});
	});
</script>
