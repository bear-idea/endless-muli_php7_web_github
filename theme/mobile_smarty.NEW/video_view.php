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
<!--標題外框-->
<div style="position:relative;">
  <div class="mdtitle TitleBoardStyle">
    <div class="mdtitle_t">
      <div class="mdtitle_t_l"> </div>
      <div class="mdtitle_t_r"> </div>
      <div class="mdtitle_t_c"><!--標題--></div>
      <div class="mdtitle_t_m"><!--更多--></div>
    </div><!--mdtitle_t-->
    <div class="mdtitle_c g_p_hide">
      <div class="mdtitle_c_l g_p_fill"> </div>
      <div class="mdtitle_c_r g_p_fill"> </div>
      <div class="mdtitle_c_c">
        <!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
  <!--標題外框--> 
 
        <div class="ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Video']; // 標題文字 ?></span></h1>
                </div>

  <!--標題外框-->
        <!--</div>
					<div class="mdtitle_m_b"></div>-->
        </div>
    </div><!--mdtitle_c-->
    <div class="mdtitle_b">
      <div class="mdtitle_b_l"> </div>
      <div class="mdtitle_b_r"> </div>
      <div class="mdtitle_b_c"> </div>
    </div><!--mdtitle_b-->
  </div><!--mdtitle-->
</div>
<!-- 標題外框-->

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordVideo > 0 ) { // Show if recordset not empty 
?>
<!--外框-->
<div style="position:relative;">
  <div class="mdmiddle MiddleBoardStyle">
    <div class="mdmiddle_t">
      <div class="mdmiddle_t_l"> </div>
      <div class="mdmiddle_t_r"> </div>
      <div class="mdmiddle_t_c"><!--標題--></div>
      <div class="mdmiddle_t_m"><!--更多--></div>
      </div><!--mdmiddle_t-->
    <div class="mdmiddle_c g_p_hide">
      <div class="mdmiddle_c_l g_p_fill"> </div>
      <div class="mdmiddle_c_r g_p_fill"> </div>
      <div class="mdmiddle_c_c">
        <!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
  <!--外框--> 
 <div class="post_content padding-3">
 <?php if ($TmpTypeMenuBtnIndicate == "1") { // 分類標籤 ?>
<?php include('app/typemenu/typemenu_tp.php');?>
<?php } ?>
 <ul class="list-inline row nomargin">
       
          <?php $m_count=1; ?>
 	  <?php $i=$startRow_RecordVideo + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
       
                
                      <!-- 內容 -->
                    <li class="col-md-4 col-sm-6 col-xs-12">
                      <div class="photoFrame_base">
                        <div class="video_inner_board_relative">
                          <div class="shop-item nomargin">                                     
                             <div class="center-cropped-img">
                            <?php if ($row_RecordVideo['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/video/<?php echo  GetFileThumbExtend($row_RecordVideo['pic']);?>" alt="<?php echo $row_RecordVideo['sdescription']; ?>"/></a>
                            <?php } else { ?>  
                                <a href="<?php echo $SiteBaseUrl . url_rewrite('video',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordVideo['id']),'',$UrlWriteEnable);?>"><div id="thumb<?php echo $row_RecordVideo['id'] ?>" class="youtube_thumb" ></div></a>
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
                          </div>
                      <!-- 內容 End-->
                    <div class="video_inner_board_context">
                    <div class="shop-item-summary text-center"><?php echo $row_RecordVideo['name']; ?></div>
                    </div>
                   
     
          <?php $m_count++; ?>
          <?php $i++; ?>
          </li>
          <?php } while ($row_RecordVideo = mysqli_fetch_assoc($RecordVideo)); ?>
</ul>
          
          
          <div style="height:10px;"></div>
                    <?php if($totalPages_RecordVideo > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordVideo); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordVideo); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordVideo, $page+1), $queryString_RecordVideo); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordVideo) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordVideo, $queryString_RecordVideo); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-right"></i>
                            <span><?php echo $Lang_Last; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div> 
                            <div class="col-md-3 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_PageNum; ?></span>
                            </a>
                            </div>
                            <div class="col-md-3 col-xs-4">
                            <div style="margin:2px 0px 2px 0px;">
                                <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                    <?php for($i=0; $i<ceil($totalRows_RecordVideo/$maxRows_RecordVideo); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordVideo); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordVideo; ?><?php echo $Lang_Content_Count_Lots; ?></span>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <div style="clear:both;"></div>
       
 </div>
  <!--外框-->
        <!--</div>
					<div class="mdmiddle_m_b"></div>-->
        </div>
      </div><!--mdmiddle_c-->
    <div class="mdmiddle_b">
      <div class="mdmiddle_b_l"> </div>
      <div class="mdmiddle_b_r"> </div>
      <div class="mdmiddle_b_c"> </div>
      </div><!--mdmiddle_b-->
  </div><!--mdmiddle-->
</div>
<!--外框-->
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
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框-->
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
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
	  </div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
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
