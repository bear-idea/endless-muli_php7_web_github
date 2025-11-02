<style type="text/css">
.org_outer_board tr td{margin:0;padding:0}
div .org_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:200px;width:200px}
.org_inner_board_relative{position:relative}
.org_inner_board_relative_buttom{position:relative}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
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

                <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_RecordOrg['title']; ?></span></h1>
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
<!--標題外框-->
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
 
 

                     
                     <span style="float:right; margin-right:5px; width:350px; text-align:right;">
					 	
                        <?php require("require_sharelink.php"); ?>
                       </span>
                     
                     <?php //require("require_fb_like.php"); ?>
                     
                    
    
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="250">
                    <!-- 內容 -->
                    <div class="photoFrame_photographic03">
                    <div class="org_inner_board_relative">
                      <div class="div_table-cell">
                      <?php if ($row_RecordOrg['avatar'] != "") { ?>	 
                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/org/<?php echo GetFileThumbExtend($row_RecordOrg['avatar']); ?>" alt="<?php echo $row_RecordOrg['sdescription']; ?>" alumb="true" _w="200" _h="200"/><span></span>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a><span></span>
                      <?php } ?>
                      </div> 
                    </div>
                    </div>
                    <!-- 內容 End-->
                    </td>
                    <td valign="top">
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
                      </td>
                  </tr>
                </table>
               
			<?php //echo pageBreak($row_RecordOrg['content']); ?>
                        
                        <hr>
                        
                        
                        <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-10" role="tablist">
                        <?php //if ($row_RecordOrg['content'] != '') { ?>
                        <li role="presentation" class="active"><a href="#tabs-1" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content_Org //詳細資料 ?></a></li>
                        <?php //} ?> 
                        <?php if ($row_RecordOrg['content1'] != '') { ?>
                        <li role="presentation"><a href="#tabs-2" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content1_Org //經驗歷程 ?></a></li>
                        <?php } ?> 
                        <?php if ($row_RecordOrg['content2'] != '') { ?>
                        <li role="presentation"><a href="#tabs-3" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content2_Org //專長領域 ?></a></li>
                        <?php } ?>
                        <?php if ($row_RecordOrg['content3'] != '') { ?>
                        <li role="presentation"><a href="#tabs-4" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content3_Org //榮譽事蹟 ?></a></li>
                        <?php } ?>
                        <?php if ($row_RecordOrg['content4'] != '') { ?>
                        <li role="presentation"><a href="#tabs-5" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content4_Org //補充說明 ?></a></li>
                        <?php } ?>
                        </ul>
                        
                        <div class="tab-content padding-top-20">
                        
                        <?php //if ($row_RecordOrg['content'] != '') { ?>
                        <div id="tabs-1" class="tab-pane fade in active">
                            <div class="container left_ct_board"><?php echo pageBreak($row_RecordOrg['content']); ?></div> 
                        </div>
                        <?php //} ?>
                        <?php if ($row_RecordOrg['content1'] != '') { ?>
                        <div id="tabs-2"  class="tab-pane fade">
                            <div class="container left_ct_board"><?php echo $row_RecordOrg['content1']; ?></div> 
                        </div>
                        <?php } ?>
                        <?php if ($row_RecordOrg['content2'] != '') { ?>
                        <div id="tabs-3"  class="tab-pane fade">
                            <div class="container left_ct_board"><?php echo $row_RecordOrg['content2']; ?></div> 
                        </div>
                        <?php } ?>  
                        <?php if ($row_RecordOrg['content3'] != '') { ?>
                        <div id="tabs-4"  class="tab-pane fade">
                            <div class="container left_ct_board"><?php echo $row_RecordOrg['content3']; ?></div> 
                        </div>
                        <?php } ?>  
                        <?php if ($row_RecordOrg['content4'] != '') { ?>
                        <div id="tabs-5"  class="tab-pane fade">
                            <div class="container left_ct_board"><?php echo $row_RecordOrg['content4']; ?></div> 
                        </div>
                        <?php } ?>  
                        
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