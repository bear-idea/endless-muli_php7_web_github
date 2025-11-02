<style type="text/css">
.org_outer_board tr td{margin:0;padding:0}
div .org_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.org_inner_board_relative{position:relative}
.org_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden; border:0px solid #EEE; margin:auto; height: <?php echo floor(floor(((1170/12)*9)/6)); ?>px; width:<?php echo floor(floor(((1170/12)*9)/6)); ?>px}
div .org_inner_board_context{text-align:left}
.org_outer_board { width:<?php echo floor(floor(((1170/12)*9)/6)+40); ?>px; float:left;}
	
@media (max-width: 500px){
	.org_outer_board { float:none;}
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
 
 <div class="post_content padding-3">
  
        
 	  <?php $i=$startRow_RecordOrg + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="col-md-12 col-sm-12 col-xs-12"> 
                
                    <!-- 內容 -->
                    <div class="org_outer_board">
                    <div class="photoFrame_base">
                      <div class="nailthumb-container" data-method="resize">
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
                    <div class="margin-top-10 col-md-8 col-sm-6 col-xs-12">
                    
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
                   
			          </div>
             
          <?php $i++; ?>
          
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
          <hr>
          </div>
          <?php } while ($row_RecordOrg = mysqli_fetch_assoc($RecordOrg)); ?>
           
         
          
          
          <div style="height:10px;"></div>
                    <?php if($totalPages_RecordStronghold > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordStronghold); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordStronghold); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordStronghold, $page+1), $queryString_RecordStronghold); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordStronghold) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordStronghold, $queryString_RecordStronghold); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordStronghold/$maxRows_RecordStronghold); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordStronghold); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordStronghold; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
