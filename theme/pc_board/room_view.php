<style type="text/css">
.ct_board_room_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.room_outer_board tr td{margin:0;padding:0}
div .room_inner_board{background-color:#FFF;margin:1px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:120px;width:160px}
.room_inner_board_relative{position:relative}
.room_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden;height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px;width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
div .room_inner_board_context{width:100%;margin-top:5px;text-align:left;overflow:hidden}
div .room_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;font:bold 11px Sans-Serif;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#666;background:transparent;cursor:pointer}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
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
        <?php print $pages_navigation_RecordRoom[0]; ?> <?php print $pages_navigation_RecordRoom[1]; ?> <?php print $pages_navigation_RecordRoom[2]; ?>
        <?php if ($page < $totalPages_RecordRoom) { // Show if not last page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordRoom, $queryString_RecordRoom); ?>"><i class="fa fa-angle-double-right"></i></a>
        <?php } // Show if not last page ?>
        <?php if (ceil($totalRows_RecordRoom/$maxRows_RecordRoom) > 1) { ?>
        <span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordRoom/$maxRows_RecordRoom); ?></span>
        <?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
<?php // 顯示方式 ?>
 <div class="columns on-1">
      <div class="container board">
	  <?php $i=$startRow_RecordRoom + 1; // 取得頁面第一項商品之編號 ?>
          <div class="column">
                    <?php do { ?> 
              <div class="container room_inner_board" data-scroll-reveal="enter top after 0.1s">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4); ?>">
                    <div class="photoFrame_base">
                <div class="room_inner_board_relative">
                <div class='<?php echo $TmpRoomBoardIcon; ?>'></div>
                  <div class="nailthumb-container">
                  <?php // 判斷商品所在之層級
                                if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] == '-1' && $row_RecordRoom['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                     <?php if ($level == '2') { ?>          
					  <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2'],'type3'=>$row_RecordRoom['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '1') { ?>
                      <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '0') { ?>
                      <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else { ?>
                      <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } ?>
                  </div> 
                </div>
                
                       
                   
                </div></td>
                    <td valign="top"><div class="room_inner_board_context">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              
                              
                              
                              
                              <?php if ($level == '2') { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2'],'type3'=>$row_RecordRoom['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right; <?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } else if ($level == '1') { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right;<?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } else if ($level == '0') { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right;<?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoom['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } else { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right;<?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } ?>
                             
                              </td>
                            </tr>
                            <tr>
                            <td>
                            <div style="margin-bottom:3px;">訂價：<span style="background-color:#069; color:#FFF; padding:2px;-webkit-border-radius:4px; -moz-border-radius:4px; -o-border-radius:4px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.2); -webkit-box-shadow:0 1px 3px rgba(0,0,0,.2); -moz-box-shadow:0 1px 3px rgba(0,0,0,.2); -o-box-shadow:0 1px 3px rgba(0,0,0,.2);">住宿</span>$NT <span style="color:#F00;"><?php echo $row_RecordRoom['listprice']; ?></span> 元</div>
                            <div style="margin-bottom:3px;">優惠：<span style="background-color:#093; color:#FFF; padding:2px;-webkit-border-radius:4px; -moz-border-radius:4px; -o-border-radius:4px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.2); -webkit-box-shadow:0 1px 3px rgba(0,0,0,.2); -moz-box-shadow:0 1px 3px rgba(0,0,0,.2); -o-box-shadow:0 1px 3px rgba(0,0,0,.2);">平日</span>$NT <span style="color:#F00;"><?php echo $row_RecordRoom['weekprice']; ?></span> 元 <span style=" background-color:#C00;color:#FFF; padding:2px;-webkit-border-radius:4px; -moz-border-radius:4px; -o-border-radius:4px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.2); -webkit-box-shadow:0 1px 3px rgba(0,0,0,.2); -moz-box-shadow:0 1px 3px rgba(0,0,0,.2); -o-box-shadow:0 1px 3px rgba(0,0,0,.2);">假日</span>$NT <span style="color:#F00;"><?php echo $row_RecordRoom['holidayprice']; ?></span> 元</div>
                            <div style="margin-bottom:3px;">住房人數： <span style="color:#F00;"><?php echo $row_RecordRoom['peoplenum']; ?></span> 位 / 房間數： <span style="color:#F00;"><?php echo $row_RecordRoom['roomnum']; ?></span> 間</div>
                           <div style="color:#999"><?php echo $row_RecordRoom['sdescription']; ?></div>
                            </td>
                            </tr>
                        </table>
                  </div></td>
                  </tr>
                </table>

                <!-- 內容 -->
                
                
                
                <!-- 內容 End-->
              </div>
			  <?php $i++; ?>
          <?php } while ($row_RecordRoom = mysqli_fetch_assoc($RecordRoom)); ?>
          </div>
          
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
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Room']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
        jQuery(document).ready(function() {
            jQuery('.nailthumb-container').nailthumb({
				method:'resize', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".acc_container:not('.acc_container:first')").hide();
    $('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) {
            $('.acc_trigger').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
	}else{
            $(this).toggleClass('active');
            $(this).next().slideUp();
        }
	return false;
    });
	
});
</script> 