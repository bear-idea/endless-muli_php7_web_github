<style type="text/css">
.video_outer_board tr td{margin:0;padding:0}
div .video_inner_board{margin:5px}
.video_inner_board_relative{position:relative}
.video_inner_board_relative_buttom{position:relative}
div .video_inner_board_context{text-align:left}
.youtube_thumb img{background-repeat:no-repeat;}
.center-cropped-img{width:100%;overflow:hidden;margin:auto;position:relative}
.center-cropped-img img{position:absolute;left:-100%;right:-100%;top:-100%;bottom:-100%;margin:auto;min-height:100%;min-width:100%}
</style>
<ul class="list-inline row nomargin">
      <?php $m_count=1; ?>
 	  <?php $i=$startRow_RecordVideo + 1; // 取得頁面第一項商品之編號 ?>
       <?php foreach ($row_data as $row_data) { ?>
                    <li class="col-md-4 col-sm-6 col-xs-12">
                      <div class="photoFrame_base">
                        <div class="video_inner_board_relative">
                          <div class="shop-item nomargin">                                     
                             <div class="center-cropped-img">
                            <?php if ($row_data['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_data['id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/video/<?php echo  GetFileThumbExtend($row_data['pic']);?>" alt="<?php echo $row_data['sdescription']; ?>"/></a>
                            <?php } else { ?>  
                                <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_data['id']),'',$UrlWriteEnable);?>"><div id="thumb<?php echo $row_data['id'] ?>" class="youtube_thumb" ></div></a>
                            <script type="text/javascript">
                                $(function(){ 
                                    // 透過完整的影片網址來取得指定的小圖片
                                    $("<img />").attr("src", $.jYoutube("<?php echo $row_data['link'] ?>", "big")).appendTo("#thumb<?php echo $row_data['id'] ?>");
                                });
                            </script>
                            <?php } ?>
                                </div> 
                              </div>
                            </div> 
                          </div>
                      <!-- 內容 End-->
                    <div class="video_inner_board_context">
                    <div class="shop-item-summary text-center"><?php echo $row_data['name']; ?></div>
                    </div>
                   
     
          <?php $m_count++; ?>
          <?php $i++; ?>
          </li>
          <?php } ?>
</ul>
<script type="text/javascript">
$(document).ready(function () {
    heightMan();

    $(window).resize(function () {
        heightMan();
    });
});

function heightMan() {	
	var _dw = jQuery(".shop-item").width();
	var _w = jQuery(".shop-item").width();
	var _wItem	= _w;
	var _hItem = _wItem*0.75;
	//console.log(_dw);
    var container_node = $('.center-cropped-img');
    //var container_height = container_node.height();
    container_height = _hItem;

    container_node.css('height', container_height);
}
</script>
<script type="text/javascript"> 
    $('.video_inner_board_context').jcolumn();
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
