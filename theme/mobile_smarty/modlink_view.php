<style type="text/css">
.modlink_outer_board{
}

.modlink_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .modlink_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}

/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 60px; /* 設定區塊高度 */
	width: 198px;
	/*margin: 5px;*/
}

.modlink_inner_board_relative{
	position: relative; /* FF 定位 */
}

.modlink_inner_board_relative_buttom{
	position: relative; /* FF 定位 */
}

/* 圖片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_table-cell span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_table-cell *{ vertical-align:middle;}

div .modlink_inner_board_context{
	text-align: left;
}
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Modlink']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordModlink > 0 ) { // Show if recordset not empty 
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordModlink + 1) ?> - <?php echo min($startRow_RecordModlink + $maxRows_RecordModlink, $totalRows_RecordModlink) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordModlink ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ModlinkSearchSelect == "1") { ?>
      <form id="form_Modlink" name="form_Modlink" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Modlink; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordModlink = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordModlink = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordModlink = buildNavigation($pageNum_RecordModlink,$totalPages_RecordModlink,$prev_RecordModlink,$next_RecordModlink,$separator,$max_links,true); 
       ?>
      <?php if ($pageNum_RecordModlink > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RecordModlink=%d%s", $currentPage, 0, $queryString_RecordModlink); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordModlink[0]; ?> 
      <?php print $pages_navigation_RecordModlink[1]; ?> 
      <?php print $pages_navigation_RecordModlink[2]; ?>
      <?php if ($pageNum_RecordModlink < $totalPages_RecordModlink) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_RecordModlink=%d%s", $currentPage, $totalPages_RecordModlink, $queryString_RecordModlink); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordModlink/$maxRows_RecordModlink) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordModlink+1; ?> / <?php echo ceil($totalRows_RecordModlink/$maxRows_RecordModlink); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
        <div class="columns on-1">
          <div class="container board">
 	  <?php $i=$startRow_RecordModlink + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container modlink_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="250">
                    <!-- 內容 -->
                    <div class="photoFrame_<?php echo $TmpModlinkBoard; ?>">
                    <div class="modlink_inner_board_relative">
                    <div class='<?php echo $TmpModlinkBoardIcon; ?>'></div>
                      <div class="div_table-cell">
                      <?php if ($row_RecordModlink['pic'] != "") { ?>	 
                            <?php if ($row_RecordModlink['typemenu'] == 'Link') { ?>
                            <a href="<?php echo $row_RecordModlink['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo  GetFileThumbExtend($row_RecordModlink['pic']);?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
                            <?php } else { ?>
                            <a href="<?php echo strtolower($row_RecordModlink['typemenu']) ?>.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=<?php echo $row_RecordModlink['typemenu']; ?>&amp;lang=<?php echo $_SESSION['lang'] ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo  GetFileThumbExtend($row_RecordModlink['pic']);?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
                            <?php } ?>
                      <?php } else { ?>      
                      <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a><span></span>
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
                        if($row_RecordModlink['type'] != "") { 
                        ?>
                        <span class="TipTypeStyle">[<?php echo $row_RecordModlink['type']; ?>]</span> 
                        <?php 
                        } 
                        # 
                        # ============== [/if] ============== #
                        ?>
						<?php echo $row_RecordModlink['name']; ?><br />
                        <?php echo $row_RecordModlink['sdescription']; ?>
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%1 == 0) {echo "<div class=\"column \"><div class=\"container modlink_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordModlink = mysqli_fetch_assoc($RecordModlink)); ?>
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
if ($totalRows_RecordModlink == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Modlink']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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

<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        //$(".modlink_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
