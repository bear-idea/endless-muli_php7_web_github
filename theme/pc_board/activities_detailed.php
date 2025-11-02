<style type="text/css">
.activities_outer_board tr td{margin:0;padding:0}
div .activities_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:130px;width:190px;margin:0}
.activities_inner_board_relative{position:relative}
.activities_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden;<?php if ($TmpActivitiesImageBoard == '0') { ?>height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16); ?>px;<?php } else if ($TmpActivitiesImageBoard == '1') { ?>height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75; ?>px;<?php } ?>width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
div .activities_inner_board_context{text-align:left}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Activities']; // 標題文字 ?></span></h1>
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
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordActivities > 0) { // Show if recordset not empty 
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
        <!-- 主題資訊 -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordActivities + 1) ?> - <?php echo min($startRow_RecordActivities + $maxRows_RecordActivities, $totalRows_RecordActivities) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordActivities ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ActivitiesSearchSelect == "1") { ?>
      <form id="form_Activities" name="form_Activities" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Activities; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordActivities = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordActivities = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordActivities = buildNavigation($page,$totalPages_RecordActivities,$prev_RecordActivities,$next_RecordActivities,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordActivities); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordActivities[0]; ?> 
      <?php print $pages_navigation_RecordActivities[1]; ?> 
      <?php print $pages_navigation_RecordActivities[2]; ?>
      <?php if ($page < $totalPages_RecordActivities) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordActivities, $queryString_RecordActivities); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordActivities/$maxRows_RecordActivities) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordActivities/$maxRows_RecordActivities); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
        <div class="activities_other_board">
        <?php if ($row_RecordActivities['location'] != '') { ?><?php echo $Lang_Classify_Context_Location_Activities //地點： ?><?php echo $row_RecordActivities['location']; ?><?php } ?> <?php if  ($row_RecordActivities['startdate'] != '' || $row_RecordActivities['enddate'] != '') { ?><strong><?php echo $Lang_Classify_Context_Date_Activities //時間： ?></strong><?php echo $row_RecordActivities['startdate']; ?><?php if  ($row_RecordActivities['startdate'] != '' && $row_RecordActivities['enddate'] != '') { ?>~<?php } ?><?php echo $row_RecordActivities['enddate']; ?><?php } ?>
        </div>

        <!-- 詳細內容資訊 -->
        <div class="activities_context_board">
            <?php echo $row_RecordActivities['content']; ?>
        </div>
      </div>
      </div>
     </div>
 </div>
 <?php if ($row_RecordActivities['content'] != '') { ?>
 <hr />
 <?php } ?>
 <div class="columns on-3">
      <div class="container board">
	  <?php $i=$startRow_RecordActivities + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container activities_inner_board">
                   <!-- 內容 -->
                   <div class="photoFrame_<?php echo $TmpActivitiesBoard; ?>">
                	<div class="activities_inner_board_relative">
                	<div class='<?php echo $TmpActivitiesBoardIcon; ?>'></div>
                       <div class="nailthumb-container">	 
                       <?php if ($row_RecordActivities['pic'] != "") { ?>
                         <a href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/activities/<?php echo $row_RecordActivities['pic']; ?>" title="<?php echo $row_RecordActivities['name']; ?>" rel="prettyPhoto[pp_gal]"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/activities/thumb/small_<?php echo GetFileThumbExtend($row_RecordActivities['pic']); ?>" alt="<?php echo $row_RecordActivities['sdescription']; ?>" /></a>
                         <?php } else { ?>      
                          <a><img src="<?php echo $TplNoLangImagePath ?>/190x130_noimage.jpg"/></a>
                          <?php } ?>
                       </div> 
                     </div>  
                   </div>
                   <div class="activities_inner_board_context">
                   </div>
                   <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%3 == 1) {echo "<div class=\"column span-3\"><div class=\"container activities_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities)); ?>
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
if ($totalRows_RecordActivities == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;">工程實績  →  新增</strong> 來建立該項目<?php } ?></td>
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
?>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.nailthumb-container').nailthumb({
				method:'<?php echo $TmpActivitiesImageMethods; ?>', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>

<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        //$(".activities_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>