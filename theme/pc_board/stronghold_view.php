<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.tinyMap-2.4.4.min.js"></script>
<style type="text/css">
.stronghold_outer_board tr td{margin:0;padding:0}
div .stronghold_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.stronghold_inner_board_relative{position:relative}
.stronghold_inner_board_relative_buttom{position:relative}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
div .stronghold_inner_board_context{text-align:left}
.Googlemap_label{font-size:12px;background:rgba(22,22,22,0.6);color:#fff;padding:.25em}
.MapBtn,.MapBtn input,.MapBtn input:hover,.MapBtn input:active{padding:0;border:none}
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
  <div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Stronghold']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
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
if ($totalRows_RecordStronghold > 0 ) { // Show if recordset not empty 
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
  <script type="text/javascript">
		  <?php $i=1;?>
			  $(function () {
				  $('#GoogleMap').tinyMap({
					  center: '<?php if($Strongholdcenter == '') {echo $row_RecordStrongholdMap['addrx'] . ',' . $row_RecordStrongholdMap['addry'];} else { echo $Strongholdcenter;} ?>',
					  scaleControl: false,
					  zoom: <?php echo $Strongholdzoom; ?>,
					  marker: [
					  <?php do { ?> 
						  {addr: '<?php echo $row_RecordStrongholdMap['addrx']; ?>,<?php echo $row_RecordStrongholdMap['addry']; ?>', text: '<?php echo $row_RecordStrongholdMap['sdescription']; ?>', label: '<?php echo $row_RecordStrongholdMap['name']; ?>', css: 'Googlemap_label'}<?php if ($totalRows_RecordStrongholdMap > $i) {echo ',';} ?><?php $i++; ?>
				      <?php } while ($row_RecordStrongholdMap = mysqli_fetch_assoc($RecordStrongholdMap)); ?>
					  ]
				  });
			  });
			  </script>
              <a name="Top"></a>
              <div data-scroll-reveal="enter top">
			  <div id="GoogleMap" class="map" style="width:100%; height:350px; float:right; margin-top:5px;"></div>
              </div>
              <!--<div id="GoogleMap_a" class="map tinyMap"></div>-->
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordStronghold + 1) ?> - <?php echo min($startRow_RecordStronghold + $maxRows_RecordStronghold, $totalRows_RecordStronghold) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordStronghold ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($StrongholdSearchSelect == "1") { ?>
      <form id="form_Stronghold" name="form_Stronghold" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordStronghold = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordStronghold = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordStronghold = buildNavigation($page,$totalPages_RecordStronghold,$prev_RecordStronghold,$next_RecordStronghold,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordStronghold); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordStronghold[0]; ?> 
      <?php print $pages_navigation_RecordStronghold[1]; ?> 
      <?php print $pages_navigation_RecordStronghold[2]; ?>
      <?php if ($page < $totalPages_RecordStronghold) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordStronghold, $queryString_RecordStronghold); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordStronghold/$maxRows_RecordStronghold) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordStronghold/$maxRows_RecordStronghold); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>

        <div class="columns on-1">
          <div class="container board">
 	  <?php $i=$startRow_RecordStronghold + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column" data-scroll-reveal="enter top after 0.1s">
              <div class="container stronghold_inner_board">
                        
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="200" valign="top">
                    <!-- 內容 -->
                    <div class="photoFrame_base">
                    <div class="stronghold_inner_board_relative">
                      <div class="div_table-cell">
                      <?php if ($row_RecordStronghold['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/stronghold/<?php echo $row_RecordStronghold['pic'];?>" rel="prettyPhoto[pp_gal]" title="<?php echo $row_RecordStronghold['sdescription']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/stronghold/thumb/small_<?php echo  GetFileThumbExtend($row_RecordStronghold['pic']);?>" alt="<?php echo $row_RecordStronghold['sdescription']; ?>" alumb="true" _w="150" _h="150"/></a><span></span>
                      <?php } else { ?>      
                      <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a><span></span>
                      <?php } ?>
                      </div> 
                    </div>
                    </div>
                    <!-- 內容 End-->
                    </td>
                    <td valign="top">
                   
                    <!--<div id="GoogleMap" class="map" style="width:300px; height:300px; float:right;"></div>-->
                    
                    <br />
                    <h2><?php echo $row_RecordStronghold['name']; ?></h2>
                    <br />
                    <?php $Lang_Classify_Context_Addr_Stronghold; //地址：?><?php echo $row_RecordStronghold['addr']; ?><a href="#Top" title="<?php echo $Lang_Classify_Context_SeeMap_Stronghold; ?>" id="top" rel="tipsy" class="MapBtn"><input type="image" name="pencil" src="<?php echo $SiteBaseUrl ?>images/map-icon1.png" id="panto<?php echo $row_RecordStronghold['id']; ?>"/></a>
                    <?php if ($row_RecordStronghold['phone1'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Phone_Stronghold; //電話： ?><?php echo $row_RecordStronghold['phone1']; ?><?php if ($row_RecordStronghold['phone2'] != '') { echo '/'; } ?> <?php echo $row_RecordStronghold['phone2']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['fax'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Fax_Stronghold; //傳真： ?><?php echo $row_RecordStronghold['fax']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['skype'] != '') {?>
                    <br />
                    Skype：<?php echo $row_RecordStronghold['skype']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['mail'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Mail_Stronghold; //信箱： ?><?php echo $row_RecordStronghold['mail']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['link'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Url_Stronghold; //網址： ?><?php echo $row_RecordStronghold['link']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['supplement'] != '') {?>
                    <br />
                    <?php $Lang_Classify_Context_Supplement_Stronghold; //補充：?><?php echo $row_RecordStronghold['supplement']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['openinghours'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Openinghours_Stronghold; //營業時間： ?><?php echo $row_RecordStronghold['openinghours']; ?>
                    <?php } ?>
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
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
					.on('click', '#panto<?php echo $row_RecordStronghold['id']; ?>', function () {
						$('#GoogleMap').tinyMapPanTo('<?php echo $row_RecordStronghold['addrx']; ?>,<?php echo $row_RecordStronghold['addry']; ?>');
					});
		  </script>
          <?php if ($i%1 == 0) {echo "<div class=\"column \"><div class=\"container stronghold_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordStronghold = mysqli_fetch_assoc($RecordStronghold)); ?>
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
if ($totalRows_RecordStronghold == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Stronghold']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
