<style type="text/css">

.room_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .room_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}

/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 100px;
	margin: 0px;
}

.room_inner_board_relative{
	position: relative; /* FF 定位 */
}

.room_inner_board_relative_buttom{
	position: relative; /* FF 定位 */
}

/* 圖片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	background-color: #FFF;
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

div .room_inner_board_context{
	text-align: left;
}
</style>

<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<?php
#
# ============== [title] ============== #
#
# 標題部分
?>
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Room']; // 標題文字 ?></span></h1>
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
# ============== [/title] ============== #
?> 
<?php
#
# ============== [rs date] ============== #
#
# 顯示資料集分頁
?>

<?php
#
# ============== [/rs date] ============== #
?> 
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordRoom > 0) { // Show if recordset not empty 
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordRoom + 1) ?> - <?php echo min($startRow_RecordRoom + $maxRows_RecordRoom, $totalRows_RecordRoom) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordRoom ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($RoomSearchSelect == "1") { ?>
      <form id="form_Room" name="form_Room" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Room; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordRoom = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordRoom = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordRoom = buildNavigation($page,$totalPages_RecordRoom,$prev_RecordRoom,$next_RecordRoom,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordRoom); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordRoom[0]; ?> 
      <?php print $pages_navigation_RecordRoom[1]; ?> 
      <?php print $pages_navigation_RecordRoom[2]; ?>
      <?php if ($page < $totalPages_RecordRoom) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordRoom, $queryString_RecordRoom); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordRoom/$maxRows_RecordRoom) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordRoom/$maxRows_RecordRoom); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
 <div class="columns on-4">
      <div class="container board">
      <?php $i=$startRow_RecordRoom + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?>
          <div class="column">
              <div class="container room_inner_board">
                <!-- 內容 -->
                <div class="photoFrame_<?php echo $TmpRoomBoard; ?>">
                <div class="room_inner_board_relative">
                <div class='<?php echo $TmpRoomBoardIcon; ?>'></div>
                  <div class="div_table-cell">
                  <?php // 判斷商品所在之層級
                                if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] == '-1' && $row_RecordRoom['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                  <?php if ($row_RecordRoom['pic'] != "") { ?>	 
                        <a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Room&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordRoom['type1']; ?>&amp;type2=<?php echo $row_RecordRoom['type2']; ?>&amp;type3=<?php echo $row_RecordRoom['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>" alumb="true" _w="100" _h="100"/></a><span></span>
                  <?php } else { ?>      
                  <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
                  <?php } ?>
                  </div> 
                </div>  
                </div>
                <form id="form1" name="form1" method="post" action="cart.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
                    <div class="room_inner_board_context">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="50" align="right" valign="top">名稱：</td>
                            <td>
                            <a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Room&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordRoom['type1']; ?>&amp;type2=<?php echo $row_RecordRoom['type2']; ?>&amp;type3=<?php echo $row_RecordRoom['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordRoom['id']; ?>"><span style="color: <?php echo $TmpRoomBoardFontColor; ?>"><u><?php echo $row_RecordRoom['name']; ?></u></span></a>
                            </td>
                          </tr>
                          <?php if ($row_RecordRoom['pdseries'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordRoom['model'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordRoom['price'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordRoom['spprice'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordRoom['sdescription'] !='') { ?>
                          <?php } ?>
                        </table>
                  </div>   
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordRoom['id']; ?>" />
                    <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordRoom['pdseries']; ?>" />
                    <input name="name" type="hidden" id="name" value="<?php echo $row_RecordRoom['name']; ?>" />
                    <input name="price" type="hidden" id="price" value="<?php echo $row_RecordRoom['price']; ?>" />
                </form>
                
                <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%4 == 1) {echo "<div class=\"column span-4\"><div class=\"container room_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordRoom = mysqli_fetch_assoc($RecordRoom)); ?>
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
if ($totalRows_RecordRoom == 0) { // Show if recordset empty 
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
          <td width="189">目前尚無資料</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">您可登入後台之維護介面：  <strong style="color:#090;">產品維護  →  新增</strong> 來建立該項目</td>
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