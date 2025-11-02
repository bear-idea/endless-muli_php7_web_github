<style type="text/css">
.ct_board_video_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
div .video_inner_board_context{margin-top:5px;text-align:left;min-height:60px;overflow:hidden}
div .video_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
.nailthumb-container{}
</style>
               <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Video']; // 標題文字 ?></span></h1>
                </div>
  <div class="owl-carousel owl-padding-0 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false}'>
  <?php
  // 計算高度
   if ($TmpVideoImageBoard == '0') { 
   		$video_height = floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16;
   } else if ($TmpVideoImageBoard == '1') { 
        $video_height = floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75;
   }
   ?>
   <?php do { ?> 
   <div class="photoFrame_base">
        <div class="imgLiquid" data-fill="<?php echo $TmpVideoImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpVideoImageBoard; /* 方型 or 矩形 */ ?>">
		<!-- video image(s) -->
							<?php if ($row_RecordVideo['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/video/<?php echo  GetFileThumbExtend($row_RecordVideo['pic']);?>" alt="<?php echo $row_RecordVideo['sdescription']; ?>"/></a>
                            <?php } else { ?>  
                                <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><div id="thumb<?php echo $row_RecordVideo['id'] ?>" class="youtube_thumb" ></div></a>
                            <?php } ?>
		</div>
        <script type="text/javascript">
			$(function(){ 
				// 透過完整的影片網址來取得指定的小圖片
				$("<img style=\"display:none\"/>").attr("src", $.jYoutube("<?php echo $row_RecordVideo['link'] ?>", "big")).appendTo("#thumb<?php echo $row_RecordVideo['id'] ?>");
			});
		</script>
		<div class="video_inner_board_context">
                              <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordVideo['name']; ?></a>
                 </div>
	</div>
	<?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordVideo = mysqli_fetch_assoc($RecordVideo)); ?>
</div>
<script type="text/javascript"> 
    $('.video_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, // Every document width smaller than maxWidth will not use jcolumn
	resize:true
	});
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
