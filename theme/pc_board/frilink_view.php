<style type="text/css">
.frilink_outer_board tr td{margin:0;padding:0}
div .frilink_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:60px;width:198px}
.frilink_inner_board_relative{position:relative}
.frilink_inner_board_relative_buttom{position:relative}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
div .frilink_inner_board_context{text-align:left}
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Frilink']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordFrilink > 0 ) { // Show if recordset not empty 
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
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordFrilink + 1) ?> - <?php echo min($startRow_RecordFrilink + $maxRows_RecordFrilink, $totalRows_RecordFrilink) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordFrilink ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($FrilinkSearchSelect == "1") { ?>
      <form id="form_Frilink" name="form_Frilink" method="get" action="<?php echo $editFormAction; ?>">
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
      $prev_RecordFrilink = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordFrilink = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordFrilink = buildNavigation($page,$totalPages_RecordFrilink,$prev_RecordFrilink,$next_RecordFrilink,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordFrilink); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordFrilink[0]; ?> 
      <?php print $pages_navigation_RecordFrilink[1]; ?> 
      <?php print $pages_navigation_RecordFrilink[2]; ?>
      <?php if ($page < $totalPages_RecordFrilink) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordFrilink, $queryString_RecordFrilink); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordFrilink/$maxRows_RecordFrilink) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordFrilink/$maxRows_RecordFrilink); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
        <div class="columns on-1">
          <div class="container board">
 	  <?php $i=$startRow_RecordFrilink + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container frilink_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="250">
                    <!-- 內容 -->
                    <div class="photoFrame_<?php echo $TmpFrilinkBoard; ?>">
                    <div class="frilink_inner_board_relative">
                    <div class='<?php echo $TmpFrilinkBoardIcon; ?>'></div>
                        <div class="div_table-cell">
                        <?php if ($row_RecordFrilink['typemenu'] == 'Link') { ?>
                            <?php if ($row_RecordFrilink['link'] != "" && $row_RecordFrilink['link'] != "http://#") { ?>
                                <?php if ($row_RecordFrilink['modselect'] == "1") { ?>
                                    <?php if ($row_RecordFrilink['pic'] != "") { ?>
                                    <a href="<?php echo $row_RecordFrilink['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
                                    <?php } else { ?>
                                    <a href="<?php echo $row_RecordFrilink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl; ?>images/fri_noimage.jpg" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
                                    <?php } ?>
                                <?php } else { ?>
                                <a href="<?php echo $row_RecordFrilink['link']; ?>" target="_blank"><div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordFrilink['name']; ?></div></a><a href="<?php echo $row_RecordFrilink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl; ?>images/link/<?php echo $row_RecordFrilink['picname']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($row_RecordFrilink['modselect'] == "1") { ?>
                                <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/>
                                <?php } else { ?>
                                <div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordFrilink['name']; ?></div><img src="<?php echo $SiteBaseUrl; ?>images/link/<?php echo $row_RecordFrilink['picname']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                        <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordFrilink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
                        <?php } ?>
                        </div>
                    </div>
                    </div>
                    <!-- 內容 End-->
                    </td>
                    <td valign="middle">
						<?php 
                        #
                        # ============== [if] ============== #
                        #
                        # 判斷是否顯示分類項目
                        if($row_RecordFrilink['type'] != "") { 
                        ?>
                        <span class="TipTypeStyle">[<?php echo $row_RecordFrilink['type']; ?>]</span> 
                        <?php 
                        } 
                        # 
                        # ============== [/if] ============== #
                        ?>
						<?php echo $row_RecordFrilink['name']; ?><br />
                        <?php echo $row_RecordFrilink['sdescription']; ?>
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%1 == 0) {echo "<div class=\"column \"><div class=\"container frilink_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordFrilink = mysqli_fetch_assoc($RecordFrilink)); ?>
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
if ($totalRows_RecordFrilink == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Frilink']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
