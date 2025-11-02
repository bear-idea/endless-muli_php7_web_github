<style type="text/css">
.artlist_outer_board tr td{margin:0;padding:0}
div .artlist_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.artlist_inner_board_relative{position:relative}
.artlist_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden; border:0px solid #EEE; margin:auto; height: <?php echo floor(floor(((1170/12)*9)/6)); ?>px; width:<?php echo floor(floor(((1170/12)*9)/6)); ?>px}
div .artlist_inner_board_context{text-align:left}
.artlist_outer_board { width:<?php echo floor(floor(((1170/12)*9)/6)+40); ?>px; float:left;}
	
@media (max-width: 500px){
	.artlist_outer_board { float:none;}
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Artlist']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordArtlist > 0 ) { // Show if recordset not empty 
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
 <?php if ($TmpTypeMenuBtnIndicate == "1") { // 分類標籤 ?>
<?php include('app/typemenu/typemenu_tp.php');?>
<?php } ?>
        
 	  <?php $i=$startRow_RecordArtlist + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="col-md-12 col-sm-12 col-xs-12"> 
                
                    <!-- 內容 -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="photoFrame_<?php echo $TmpArtlistBoard; ?>">
                    <div class='<?php echo $TmpArtlistBoardIcon; ?> hidden-xs'></div>
                      <div class="imgLiquid" data-fill="resize" data-board="1">
                       <?php if ($row_RecordArtlist['pic'] != "") { ?>	 
                            <a href="<?php echo $SiteBaseUrl . url_rewrite('artlist',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordArtlist['id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/artlist/<?php echo  GetFileThumbExtend($row_RecordArtlist['pic']);?>" alt="<?php echo $row_RecordArtlist['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a>
                      <?php } ?>
                      </div> 
                    </div>
                    </div>
                    
                    
                    <!-- 內容 End-->
                    <div class="col-md-9 col-sm-8 col-xs-12 margin-top-10">
                    
						<?php 
                        #
                        # ============== [if] ============== #
                        #
                        # 判斷是否顯示分類項目
                        if($row_RecordArtlist['type'] != "") { 
                        ?>
                        <span class="TipTypeStyle">[<?php echo $row_RecordArtlist['type']; ?>]</span> 
                        <?php 
                        } 
                        # 
                        # ============== [/if] ============== #
                        ?>
						<?php echo $row_RecordArtlist['title']; ?><br />
                        <?php if ($row_RecordArtlist['startdate'] != '') { ?>
                        <?php if ($row_RecordArtlist['startdate'] == $row_RecordArtlist['enddate']) { ?>
                        <?php echo $row_RecordArtlist['startdate']; ?>
                        <?php } else { ?>
                        <?php echo $row_RecordArtlist['startdate']; ?> ~ <?php echo $row_RecordArtlist['enddate']; ?>
                        <?php } ?>
                        <br />
                        <?php } ?>
                        <?php if ($row_RecordArtlist['location'] != '') { ?>
                        <?php echo $row_RecordArtlist['location']; ?><br />
                        <?php } ?>
                        <span style="color:#666"><?php echo TrimByLength(trim(strip_tags($row_RecordArtlist['content'])), 150, false); ?></span>
                        <br /><br />
            <a href="<?php echo $SiteBaseUrl . url_rewrite('artlist',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordArtlist['id']),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Detauled_Artlist //(繼續閱讀...) ?></a>
                   
			</div>
             
          <?php $i++; ?>
          
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
          <hr>
          </div>
          <?php } while ($row_RecordArtlist = mysqli_fetch_assoc($RecordArtlist)); ?>
           
         
          
          
          <div style="height:10px;"></div>
                    <?php if($totalPages_RecordArtlist > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordArtlist); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordArtlist); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordArtlist, $page+1), $queryString_RecordArtlist); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordArtlist) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordArtlist, $queryString_RecordArtlist); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordArtlist/$maxRows_RecordArtlist); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordArtlist); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordArtlist; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordArtlist == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Artlist']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
