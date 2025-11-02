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
.nailthumb-container{overflow:hidden; border:0px solid #EEE; margin:auto; height: 60px; width:200px;}
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Frilink']; // 標題文字 ?></span></h1>
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
  
      <div class="post_content padding-3">
      <div class="row">
      
 	  <?php $i=$startRow_RecordFrilink + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="col-lg-12 clearfix">
          <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
          <div class="photoFrame_<?php echo $TmpFrilinkBoard; ?>">
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
          
          <div class="col-md-8 col-sm-6 col-xs-12">
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
          </div>

          <?php $i++; ?>
          
          </div>
          <?php } while ($row_RecordFrilink = mysqli_fetch_assoc($RecordFrilink)); ?>
          </div>
          
          
          
          
         <div style="height:10px;"></div>
                    <?php if($totalPages_RecordAbout > 1) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordAbout); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordAbout); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordAbout, $page+1), $queryString_RecordAbout); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordAbout) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordAbout, $queryString_RecordAbout); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-right"></i>
                            <span><?php echo $Lang_Last; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div> 
                            <div class="col-md-3 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_PageNum; ?></span>
                            </a>
                            </div>
                            <div class="col-md-3 col-xs-4">
                            <div style="margin:2px 0px 2px 0px;">
                                <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                    <?php for($i=0; $i<ceil($totalRows_RecordAbout/$maxRows_RecordAbout); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordAbout); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordAbout; ?><?php echo $Lang_Content_Count_Lots; ?></span>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <div style="clear:both;"></div>
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
