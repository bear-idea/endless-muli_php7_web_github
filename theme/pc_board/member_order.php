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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Member']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordCart > 0 ) { // Show if recordset not empty 
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
        <div class="columns on-1">
          <div class="container board">
            <div class="column">
              <div class="container ct_board">
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
  <tr>
    <td width="20%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordCart + 1) ?> - <?php echo min($startRow_RecordCart + $maxRows_RecordCart, $totalRows_RecordCart) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordCart ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
    <td width="80%" align="right">
      <div class="PageSelectBoard">
        <?php 
      # variable declaration
      $prev_RecordCart = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordCart = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordCart = buildNavigation($page,$totalPages_RecordCart,$prev_RecordCart,$next_RecordCart,$separator,$max_links,true); 
       ?>
        <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordCart); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
        <?php print $pages_navigation_RecordCart[0]; ?> <?php print $pages_navigation_RecordCart[1]; ?> <?php print $pages_navigation_RecordCart[2]; ?>
        <?php if ($page < $totalPages_RecordCart) { // Show if not last page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordCart, $queryString_RecordCart); ?>"><i class="fa fa-angle-double-right"></i></a>
        <?php } // Show if not last page ?>
        <?php if (ceil($totalRows_RecordCart/$maxRows_RecordCart) > 1) { ?>
        <span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordCart/$maxRows_RecordCart); ?></span>
        <?php } ?>
      </div></td>
  </tr>
</table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      <?php if ($totalRows_RecordCart > 0) { // Show if recordset not empty ?>
      <?php
      do { 
      ?>
                    <tr class= "<?php echo $chahgecolorcount; ?>">
                      <td width="20" align="center" valign="middle"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" style="max-width:none"/></td>
                      <td valign="top">
                        <a href="<?php echo $SiteBaseUrl; ?>cart_orders_see.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;Serial=<?php echo $row_RecordCart['oserial']; ?>" target="_blank"><?php echo $row_RecordCart['oserial']; ?></a></td>
                      <td width="100" valign="top" class="hidden-xs"><?php echo highLight(date('Y-m-d',strtotime($row_RecordCart['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td>
                      </tr>
                    <?php 
		   $startRow_RecordCart++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
                    <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordCart = mysqli_fetch_assoc($RecordCart)); 
      ?>
      <?php } ?>
                  </table>
                </div>
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
if ($totalRows_RecordCart == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Member']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
