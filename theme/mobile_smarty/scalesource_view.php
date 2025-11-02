<style type="text/css">
.member_opt_list{padding:5px;width:400px;border:1px solid #DDD;margin:2px auto}
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Member']; // 標題文字 ?></span></h1>
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
                    
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-2 col-sm-6 col-xs-6">
                            
                            <div class="imgLiquid img-rounded" data-fill="resize" data-board="0" style="background-color:#FFF;">
                            	<?php if ($row_RecordMember['avatar'] != "") { ?>
                                <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/member/thumb/small_<?php echo $row_RecordMember['avatar']; ?>" />
                                <?php } else { ?>
                                <img src="<?php echo $SiteBaseUrl ?>images/no_face.jpg" width="100" height="80" />
                                <?php }  ?>
                            </div>
                         </div>
                         <div class="col-md-10 col-sm-6 col-xs-6">   
                            <div style="font-size:16px;">
                            <?php if (isset($_SESSION['MM_Username_' . $_GET['wshop']])) { ?>
                            <i class="fa fa-user"></i> 會員 
                            <?php if($row_RecordMember['name'] != "") { echo $row_RecordMember['name'] . "(".$_SESSION['MM_Username_' . $_GET['wshop']].")"; } else { echo $_SESSION['MM_Username_' . $_GET['wshop']];} ?>
                            <?php }else if (isset($_SESSION['fb_id']) && $_SESSION['success_fb_login_backstage_'.$_GET['wshop']] == '1') { ?>
                            <i class="fa fa-facebook"></i> 會員 
                            <?php if($row_RecordMember['name'] != "") { echo $row_RecordMember['name'] . "(".$row_RecordMember['fbid'].")"; } else { echo $row_RecordMember['fbid'];} ?>
                            <?php }else if (isset($_SESSION['line_id']) && $_SESSION['success_line_login_backstage_'.$_GET['wshop']] == '1') { ?>
                            <i class="icon-line"></i> 會員 
                            <?php if($row_RecordMember['name'] != "") { echo $row_RecordMember['name'] . "(".$row_RecordMember['lineid'].")"; } else { echo $row_RecordMember['lineid'];} ?>
                            <?php }else if (isset($_SESSION['google_id']) && $_SESSION['success_google_login_backstage_'.$_GET['wshop']] == '1') { ?>
                            <i class="fa fa-google"></i> 會員 
                            <?php if($row_RecordMember['name'] != "") { echo $row_RecordMember['name'] . "(".$row_RecordMember['googleid'].")"; } else { echo $row_RecordMember['googleid'];} ?>
                            <?php } ?>
                            
                            <?php if ($row_RecordMember['accountid'] != "") { ?><br /><i class="fa fa-dot-circle-o"></i> 會員編號 <?php echo $row_RecordMember['accountid']; ?><?php } ?><br />
                            <i class="fa fa fa-calendar-o"></i> 登錄時間 <?php echo date("Y-m-d H:i A",strtotime($row_RecordMember['logdate'])); ?>
                            
                            </div>

                           
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    

          <div class="row">
                        <?php if(!((isset($_SESSION["fb_id"]))) && !((isset($_SESSION["line_id"]))) && !((isset($_SESSION["google_id"])))) { ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                          <div class="box-image text-center" style="margin:10px 0; background-color:#FFF;">
            
                                        <div class="box-icon">
                                            <a class="box-icon-title" href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'accountpage'),'',$UrlWriteEnable);?>">
                                                
                                                <h3><i class="fa fa-address-book" aria-hidden="true"></i> 修改帳號資料</h3>
                                            </a>
                                            <p class="text-muted"></p>
                                        </div>
            
                                    </div>
                        </div>
                        <?php } ?>
                        
                        <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box-image text-center" style="margin:10px 0; background-color:#FFF;">

							<div class="box-icon">
								<a class="box-icon-title" href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'editpage'),'',$UrlWriteEnable);?>">
									
									<h3><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 修改個人資料</h3>
								</a>
								<p class="text-muted"></p>
							</div>

						</div>
                        </div>  
                        
                        <?php //if($OptionCartSelect == '1') { ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box-image text-center" style="margin:10px 0; background-color:#FFF;">

							<div class="box-icon">
								<a class="box-icon-title" href="<?php echo $SiteBaseUrl . url_rewrite('scalesource',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'order'),'',$UrlWriteEnable);?>">
									
									<h3><i class="fa fa-address-book" aria-hidden="true"></i> 查詢貨源資料</h3>
								</a>
								<p class="text-muted"></p>
							</div>

						</div>
                        </div>
                        <?php //} ?>
                        
                        <?php if($OptionCartSelect == '1') { ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box-image text-center" style="margin:10px 0; background-color:#FFF;">

							<div class="box-icon">
								<a class="box-icon-title" href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'order'),'',$UrlWriteEnable);?>">
									
									<h3><i class="fa fa-address-book" aria-hidden="true"></i> 查詢訂單資料</h3>
								</a>
								<p class="text-muted"></p>
							</div>

						</div>
                        </div>
                        <?php } ?>
                        
                        <?php if($OptionCartSelect == '1') { ?>
                        <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box-image text-center" style="margin:10px 0; background-color:#FFF;">

							<div class="box-icon">
							  <a class="box-icon-title" href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'FAQ'),'',$UrlWriteEnable);?>">
									
									<h3><i class="fa fa-question-circle" aria-hidden="true"></i> 問與答紀錄</h3>
								</a>
								<p class="text-muted"></p>
							</div>

						</div>
                        </div>
                        <?php } ?>
                        
                        <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box-image text-center" style="margin:10px 0; background-color:#FFF;">

							<div class="box-icon">
							  <a class="box-icon-title" href="<?php echo $logoutAction ?>">
									
									<h3><i class="fa fa-question-circle" aria-hidden="true"></i> 登出系統</h3>
								</a>
								<p class="text-muted"></p>
							</div>

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