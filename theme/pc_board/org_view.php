<style type="text/css">
.org_outer_board tr td{margin:0;padding:0}
div .org_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.org_inner_board_relative{position:relative}
.org_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden;height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16); ?>px;width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
div .org_inner_board_context{text-align:left}
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Org']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordOrg > 0 ) { // Show if recordset not empty 
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordOrg + 1) ?> - <?php echo min($startRow_RecordOrg + $maxRows_RecordOrg, $totalRows_RecordOrg) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordOrg ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($OrgSearchSelect == "1") { ?>
      <form id="form_Org" name="form_Org" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Org; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordOrg = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordOrg = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordOrg = buildNavigation($page,$totalPages_RecordOrg,$prev_RecordOrg,$next_RecordOrg,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordOrg); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordOrg[0]; ?> 
      <?php print $pages_navigation_RecordOrg[1]; ?> 
      <?php print $pages_navigation_RecordOrg[2]; ?>
      <?php if ($page < $totalPages_RecordOrg) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordOrg, $queryString_RecordOrg); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordOrg/$maxRows_RecordOrg) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordOrg/$maxRows_RecordOrg); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
 
              <?php $i=$startRow_RecordOrg + 1; // 取得頁面第一項商品之編號 ?>
              <?php do { ?> 
              <div data-scroll-reveal="enter top after 0.1s">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4); ?>">
                    <!-- 內容 -->
                    <div class="photoFrame_<?php echo $TmpOrgBoard; ?>">
                    <div class="org_inner_board_relative">
                    <div class='<?php echo $TmpOrgBoardIcon; ?>'></div>
                      <div class="nailthumb-container">
                      <?php if ($row_RecordOrg['avatar'] != "") { ?>
						  <?php if ($row_RecordOrg['content'] != '' || $row_RecordOrg['content1'] != '' || $row_RecordOrg['content2'] != '' || $row_RecordOrg['content3'] != '' || $row_RecordOrg['content4'] != '' ) { ?>
                          <a href="<?php echo $SiteBaseUrl . url_rewrite('org',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordOrg['id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/org/<?php echo GetFileThumbExtend($row_RecordOrg['avatar']); ?>" alt="<?php echo $row_RecordOrg['sdescription']; ?>" alumb="true" _w="150" _h="150"/></a><span></span>
                      <?php } else { ?>
                      	  <a href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/org/<?php echo GetFileThumbExtend($row_RecordOrg['avatar']); ?>" title="<?php echo $row_RecordOrg['name']; ?>" rel="prettyPhoto[pp_gal]"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/org/<?php echo GetFileThumbExtend($row_RecordOrg['avatar']); ?>" alt="<?php echo $row_RecordOrg['sdescription']; ?>" /></a>
                      <?php } ?>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                      </div> 
                    </div>
                    </div>
                    <!-- 內容 End-->
                    </td>
                    <td valign="top">
                    <br />

                      <span style="color:#060; font-size:16px; font-weight:bolder">[ <?php echo $row_RecordOrg['type']; ?> ]</span>
                      <br />
                      <?php echo $Lang_Classify_Context_Name_Org //姓名： ?><?php echo $row_RecordOrg['name']; ?><br />
                      <?php echo $Lang_Classify_Context_TitleName_Org //職稱： ?><?php echo $row_RecordOrg['title']; ?><br />
                      <?php if ($row_RecordOrg['education'] != ''){ ?>
                      <?php echo $Lang_Classify_Context_Education_Org //學歷： ?><?php echo $row_RecordOrg['education']; ?><br />
                      <?php } ?>
                      <?php if ($row_RecordOrg['speciality'] != ''){ ?>
                      <?php echo $Lang_Classify_Context_Speciality_Org //專長： ?><?php echo $row_RecordOrg['speciality']; ?><br />
                      <?php } ?>
                      <?php if ($row_RecordOrg['phone'] != ''){ ?>
                      <?php echo $Lang_Classify_Context_Phone_Org //電話： ?><?php echo $row_RecordOrg['phone']; ?><br />
                      <?php } ?>
                      <?php if ($row_RecordOrg['mail'] != ''){ ?>
                      <?php echo $Lang_Classify_Context_Email_Org //信箱： ?><a href="mailto:<?php echo $row_RecordOrg['mail']; ?>"><?php echo $row_RecordOrg['mail']; ?></a><br />
                      <?php } ?>
					  <?php //if ($row_RecordOrg['notes1'] != ''){ ?>
                      <?php echo $Lang_Classify_Context_Notes1_Org //備註： ?><?php echo $row_RecordOrg['notes1']; ?><br />
                      <?php //} ?>
                      <br />
                      <?php if ($row_RecordOrg['content'] != '' || $row_RecordOrg['content1'] != '' || $row_RecordOrg['content2'] != '' || $row_RecordOrg['content3'] != '' || $row_RecordOrg['content4'] != '' ) { ?>
                      <img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" width="18" height="18" /><a href="<?php echo $SiteBaseUrl . url_rewrite('org',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordOrg['id']),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Detailed_Org //詳細資料 ?></a>
                      <?php }  ?>
                      </td>
                  </tr>
                </table>
                </div>
               <?php $i++; ?>
          <?php echo "<hr>";?>
          <?php } while ($row_RecordOrg = mysqli_fetch_assoc($RecordOrg)); ?>

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
if ($totalRows_RecordOrg == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Org']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
