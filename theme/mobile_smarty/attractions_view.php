<?php if ($GoogleMapAPICode != "") { ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>"></script>
<script type="text/javascript" src="js/jQuery.bMap.1.3.1.min.js"></script>
<?php } ?>
<style type="text/css">
#map{height:300px; width:100%}
#sideBar{overflow:auto;width:100%;height:100px;text-align:center;background:#fff; overflow:scroll-x;}
#sideBar div{padding:2px 0;cursor:pointer}
#sideBar div:hover{text-decoration:underline}
#buttons{clear:both;text-align:center}
.bSideSelect{background:#FEEBCF}
.g_btn{margin-left:10px}
.attractions_outer_board tr td{margin:0;padding:0}
div .attractions_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.attractions_inner_board_relative{position:relative}
.attractions_inner_board_relative_buttom{position:relative}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
div .attractions_inner_board_context{text-align:left}
.Googlemap_label{font-size:12px;background:rgba(22,22,22,0.6);color:#fff;padding:.25em}
.MapBtn,.MapBtn input,.MapBtn input:hover,.MapBtn input:active{padding:0;border:none}
.masonry,.masonry .masonry-brick{-webkit-transition-duration:.7s;-moz-transition-duration:.7s;-ms-transition-duration:.7s;-o-transition-duration:.7s;transition-duration:.7s}
.masonry{-webkit-transition-property:height,width;-moz-transition-property:height,width;-ms-transition-property:height,width;-o-transition-property:height,width;transition-property:height,width}
.masonry .masonry-brick{-webkit-transition-property:left,right,top;-moz-transition-property:left,right,top;-ms-transition-property:left,right,top;-o-transition-property:left,right,top;transition-property:left,right,top}
.item_rwd img{display:block;width:100%}
.item_rwd{margin:5px;float:left;border:1px solid #dedede;text-align:center;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;}
.item-sizer, .item_rwd{width:260px;}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Attractions']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordAttractions > 0 ) { // Show if recordset not empty 
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
<div class="post-content">
<?php if ($TmpTypeMenuBtnIndicate == "1") { // 分類標籤 ?>
<?php include('app/typemenu/typemenu_tp.php');?>
<?php } ?>
<?php if ($GoogleMapAPICode != "") { ?>
<?php $SiteCounter=1; ?>
<script type="text/javascript">
$(document).ready(function(){ 
	$("#map").bMap({
		mapZoom: 13,
		mapCenter:[<?php if($row_RecordContactMail['SiteAddrX'] != '') {echo $row_RecordContactMail['SiteAddrX'];}else{echo "24.2332076";} ?>,<?php if($row_RecordContactMail['SiteAddrY'] != '') {echo $row_RecordContactMail['SiteAddrY'];}else{echo "120.94173679999994";} ?>],
		mapSidebar:"sideBar", //id of the div to use as the sidebar
		markers:{"data":[{"lat":"<?php echo $row_RecordContactMail['SiteAddrX']; ?>","lng":"<?php echo $row_RecordContactMail['SiteAddrY']; ?>","title":"<?php echo $row_RecordContactMail['SiteSName']; ?>","rnd":"1","body":"<div style=\"width:300px;text-align:left;\"></div></div><div style=\"width:95%;text-align:left;margin:5px;\"><?php if ($row_RecordContactMail['SitePhone'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block; text-align:center;\"><i class=\"fa fa-phone\"></i></span> <?php echo $Lang_Footer_Tel; ?>：<?php echo $row_RecordContactMail['SitePhone']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteCell'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-tablet\"></i></span> <?php echo $Lang_Footer_Cell; ?>：<?php echo $row_RecordContactMail['SiteCell']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteFax'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-print\"></i></span> <?php echo $Lang_Footer_Fax; ?>：<?php echo $row_RecordContactMail['SiteFax']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteAddr'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-map-marker\"></i></span> <?php echo $Lang_Footer_Addr; ?>：<?php echo $row_RecordContactMail['SiteAddr']; ?></div><?php } ?></div><div style=\"width:300px;text-align:left;\"></div><hr/><?php if ($row_RecordContactMail['SiteAddr'] != '') { ?><a href=\"https://maps.google.com.tw/maps?q=<?php echo urlencode($row_RecordContactMail['SiteAddr']); ?>&hl=zh-TW&t=m&z=14&vpsrc=6&iwloc=A&f=d&hnear=<?php echo urlencode($row_RecordContactMail['SiteAddr']); ?>\" target=\"_blank\" class=\"g_btn\">路線規劃</a><a href=\"https://maps.google.com.tw/maps?near=<?php echo urlencode($row_RecordContactMail['SiteAddr']); ?>&amp;q=停車場&amp;hl=zh-TW\" target=\"_blank\" class=\"g_btn\">搜尋附近停車場</a><a href=\"https://maps.google.com.tw/maps?near=<?php echo urlencode($row_RecordContactMail['SiteAddr']); ?>&amp;q=美食&amp;hl=zh-TW\" target=\"_blank\" class=\"g_btn\">搜尋附近美食</a><?php } ?>", "icon":"images/googlemap/pin1.png"},<?php do { /* 印出地圖 */?><?php if($row_RecordAttractionsMap['addr'] != "") { ?>{"lat":"<?php echo $row_RecordAttractionsMap['addrx']; ?>","lng":"<?php echo $row_RecordAttractionsMap['addry']; ?>","title":"<?php echo $row_RecordAttractionsMap['name']; ?> <a href=\"<?php if($row_RecordAttractionsMap['link'] != ''){echo $row_RecordAttractionsMap['link'];} else {echo "#";}?>\" target=\"_blank\" ></a>","rnd":"1","body":"<div style=\"width:350px\"><?php echo $row_RecordAttractionsMap['sdescription']; ?><?php if ($row_RecordAttractionsMap['addr'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><span style=\"width:15px;display:inline-block;text-align:center;\"><i class=\"fa fa-map-marker\"></i></span> <?php echo $Lang_Footer_Addr; ?>：<?php echo $row_RecordAttractionsMap['addr']; ?></div><?php } ?><hr/><?php if ($row_RecordAttractionsMap['addr'] != '') { ?><a href=\"https://maps.google.com.tw/maps?q=<?php echo urlencode($row_RecordAttractionsMap['addr']); ?>&hl=zh-TW&t=m&z=14&vpsrc=6&iwloc=A&f=d&hnear=<?php echo urlencode($row_RecordAttractionsMap['addr']); ?>\" target=\"_blank\" class=\"g_btn\">路線規劃</a><a href=\"https://maps.google.com.tw/maps?near=<?php echo urlencode($row_RecordAttractionsMap['addr']); ?>&amp;q=停車場&amp;hl=zh-TW\" target=\"_blank\" class=\"g_btn\">搜尋附近停車場</a><a href=\"https://maps.google.com.tw/maps?near=<?php echo urlencode($row_RecordAttractionsMap['addr']); ?>&amp;q=美食&amp;hl=zh-TW\" target=\"_blank\" class=\"g_btn\">搜尋附近美食</a><?php } ?></div>", "icon":"images/googlemap/<?php echo $row_RecordAttractionsMap['markstyle']; ?>"}<?php if ($totalRows_RecordAttractionsMap > $SiteCounter) { echo ","; }?><?php $SiteCounter++; ?><?php  } ?><?php } while ($row_RecordAttractionsMap = mysqli_fetch_assoc($RecordAttractionsMap)); ?>
		]}
	});
});
</script>
              <a name="Top"></a>
              <div data-scroll-reveal="enter top">
			  <div id="map"></div><div id="sideBar" class="Scroll_Bar"></div>
              </div>
              <!--<div id="GoogleMap_a" class="map tinyMap"></div>-->
<?php } ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordAttractions + 1) ?> - <?php echo min($startRow_RecordAttractions + $maxRows_RecordAttractions, $totalRows_RecordAttractions) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordAttractions ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($AttractionsSearchSelect == "1") { ?>
      <form id="form_Attractions" name="form_Attractions" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Attractions; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordAttractions = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordAttractions = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordAttractions = buildNavigation($page,$totalPages_RecordAttractions,$prev_RecordAttractions,$next_RecordAttractions,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordAttractions); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordAttractions[0]; ?> 
      <?php print $pages_navigation_RecordAttractions[1]; ?> 
      <?php print $pages_navigation_RecordAttractions[2]; ?>
      <?php if ($page < $totalPages_RecordAttractions) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordAttractions, $queryString_RecordAttractions); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordAttractions/$maxRows_RecordAttractions) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordAttractions/$maxRows_RecordAttractions); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>

<?php $m_count=1; ?>
<?php $i=$startRow_RecordAttractions + 1; // 取得頁面第一項商品之編號 ?>
<div id="container_rwd" style="margin: 0 auto;">
     <div class="item-sizer"></div>
                <?php do { ?>
               
        <div class="item_rwd"><?php if ($row_RecordAttractions['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/attractions/<?php echo $row_RecordAttractions['pic'];?>" rel="prettyPhoto[pp_gal]" title="<?php echo $row_RecordAttractions['sdescription']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/attractions/thumb/small_<?php echo  GetFileThumbExtend($row_RecordAttractions['pic']);?>" alt="<?php echo $row_RecordAttractions['sdescription']; ?>" alumb="true" _w="150" _h="150"/></a><span></span>
                      <?php } else { ?>      
                      <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a><span></span>
                      <?php } ?>
          
            <span>
              <div class="caption" style="text-align:center;">
                  <div class="SpanTitle"><h3><a href="<?php if($row_RecordAttractions['link'] != ''){echo $row_RecordAttractions['link'];} else {echo "#";}?>" target="_blank"><?php echo $row_RecordAttractions['name']; ?></a></h3></div>
                  <br />
                  
                  <?php if ($row_RecordAttractions['supplement'] != '') {?>
                    <span data-scroll-reveal="enter left after 0.3s"><?php echo $row_RecordAttractions['supplement']; ?></span><br />
                    <?php } ?>


              </div>
            </span>
          <div style="height:5px;"></div>
        </div>
        
        
         <?php $m_count++; ?>
          <?php $i++; ?>
          <script type="text/javascript">
			//Javascript
			$(document)
						.on('click', 'a[data-url=anchor]', function (e) {
						e.preventDefault();
						$('html,body').animate({
							scrollTop: ($(this.hash).offset().top - 50)
						}, 'slow');
					})
					.on('click', '#panto<?php echo $row_RecordAttractions['id']; ?>', function () {
						$('#GoogleMap').tinyMapPanTo('<?php echo $row_RecordAttractions['addrx']; ?>,<?php echo $row_RecordAttractions['addry']; ?>');
					});
		  </script>
          
          <?php } while ($row_RecordAttractions = mysqli_fetch_assoc($RecordAttractions)); ?>
</div>


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
if ($totalRows_RecordAttractions == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Attractions']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>

<script type="text/javascript">
jQuery(document).ready(function() { 
var $container = $('#container_rwd');
$container.imagesLoaded(function(){
  $container.masonry({
	columnWidth : 280,//'.item_sizer',
    itemSelector : '.item_rwd',
	percentPosition: true,
	isAnimated: !Modernizr.csstransitions,
    isFitWidth: true,
  });
});
});
</script>

<script type="text/javascript" charset="utf-8">
var distance = new GLatLng(39.917, 116.397).distanceFrom(new GLatLng(37.4419, -122.1419));  
  alert(parseInt(distance/1000,10) + "公里");
</script>