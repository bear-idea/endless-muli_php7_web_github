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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Timeline']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordTimelineType > 0) { // Show if recordset not empty 
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
     <!-- <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordTimelineType + 1) ?> - <?php echo min($startRow_RecordTimelineType + $maxRows_RecordTimelineType, $totalRows_RecordTimelineType) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordTimelineType ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">-->
      
      <?php if ($TimelineSearchSelect == "1") { ?>
      <form id="form_Timeline" name="form_Timeline" method="get" action="<?php echo $editFormAction; ?>">
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
      $prev_RecordTimelineType = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordTimelineType = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordTimelineType = buildNavigation($pageNum_RecordTimelineType,$totalPages_RecordTimelineType,$prev_RecordTimelineType,$next_RecordTimelineType,$separator,$max_links,true); 
       ?>
      <?php if ($pageNum_RecordTimelineType > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RecordTimelineType=%d%s", $currentPage, 0, $queryString_RecordTimelineType); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordTimelineType[0]; ?> 
      <?php print $pages_navigation_RecordTimelineType[1]; ?> 
      <?php print $pages_navigation_RecordTimelineType[2]; ?>
      <?php if ($pageNum_RecordTimelineType < $totalPages_RecordTimelineType) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_RecordTimelineType=%d%s", $currentPage, $totalPages_RecordTimelineType, $queryString_RecordTimelineType); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordTimelineType/$maxRows_RecordTimelineType) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordTimelineType+1; ?> / <?php echo ceil($totalRows_RecordTimelineType/$maxRows_RecordTimelineType); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
        <div class="columns on-1">
          <div class="container board">
    <!-- HTML5 shim, for IE6-8 support of HTML elements--><!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!-- BEGIN Timeline Embed -->
  <script type="text/javascript" src="<?php echo $SiteBaseUrl ?>compiled/js/storyjs-embed.js"></script>
		<script>
			$(document).ready(function() {
				createStoryJS({
					lang:       'en',
					type:		'timeline',
					width:		'100%',
					height:		'600',
					source:		
					{
						"timeline":
						{
							"headline":"", // 此標題
							"type":"default",
							"text":"", // 標題描述
							"startDate":"", // 1999,99,99
							"date": [
							<?php $i=0; ?> 
							<?php do { ?> 
								{
									"startDate":"<?php echo $row_RecordTimelineType['year']; ?><?php if($row_RecordTimelineType['month'] != '0') {echo ',' . $row_RecordTimelineType['month'];} ?><?php if($row_RecordTimelineType['day'] != '0' && $row_RecordTimelineType['day'] != '0') {echo ',' . $row_RecordTimelineType['day'];} ?>",
									"endDate":"",
									"headline":"<?php echo $row_RecordTimelineType['name']; ?>",
									"text":"<?php if($row_RecordTimelineType['link'] != '' && $row_RecordTimelineType['pic'] != '') { echo $row_RecordTimelineType['content']; } ?>",
									"asset":
									{
										"media":"<?php if($row_RecordTimelineType['mediastyle'] == '0' && $row_RecordTimelineType['pic'] != ''){ echo $SiteImgUrl . $_GET['wshop'] . "/image/timeline/" . $row_RecordTimelineType['pic']; } else if($row_RecordTimelineType['link'] != ''){ echo $row_RecordTimelineType['link'];} else {echo $row_RecordTimelineType['content'];} ?> ",
										"credit":"<?php if($row_RecordTimelineType['link'] != '' && $row_RecordTimelineType['pic'] != '') { echo $row_RecordTimelineType['pictitle']; } ?>",
										"caption":"<?php if($row_RecordTimelineType['link'] != '' && $row_RecordTimelineType['pic'] != '') { echo $row_RecordTimelineType['piccontent']; } ?>"
									}
								} <?php $i++; ?><?php if ($i < $totalRows_RecordTimelineType) {echo ',';}?>
							
						    <?php } while ($row_RecordTimelineType = mysqli_fetch_assoc($RecordTimelineType)); ?>
					 
							]
						}
				},
					embed_id:	'my-timeline',
					//debug:		true
				});
			});
		</script>
		<!-- END TimelineJS -->
        <div data-scroll-reveal="enter top after 0.1s">
                    <div id="my-timeline"></div>
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
if ($totalRows_RecordTimelineType == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Timeline']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
