<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Classify_Login; // 登入 ?></span></h1>
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
  <div class="row">
  <?php if ($_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Member') {?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                          <td width="189"><?php echo $Lang_Classify_Login_Successful; //登入成功 ?></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="center"></td>
                  </tr>
                </table>
<?php } else { ?>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-push-6">
                

							<!-- ALERT -->
                            
                        <?php if ($_GET['authcode'] == "ok") { ?>
                        <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip09; //您的會員已認證成功!!請由此登入!! ?></div>
                        <?php } ?>
                        
                            <?php if ($_GET['authcode'] == "ok") { ?>
                        <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip09; //您的會員已認證成功!!請由此登入!! ?></div>
                        <?php } ?>
                        
                        <?php if ($_GET['Operate'] == "regSuccess" && $MemberMailAuthSead == "1") { ?>
                        <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip10; //註冊成功!!系統已寄發認證信!!請到您註冊之信箱取得認證信 ?></div>
                        <?php } else if ($_GET['Operate'] == "regSuccess" && $MemberMailAuthSead == "0"){ ?>
                        <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip11; //註冊成功!!需等待管理員審核寄發認證信 ?></div>
                        <?php } else if ($_GET['Operate'] == "regSuccess"){ ?>
                        <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip12; //註冊成功 ?></div>
                        <?php } ?>
                        <?php if($_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Test_Member') {?>
                        <div class="alert alert-mini alert-danger margin-bottom-30"><i class="fa fa-times-circle"></i> <?php echo $Lang_Classify_Tip13; //目前此帳號需等待管理員驗證 ?></div>
                        <?php } ?>
                        <?php if ($_GET['errMsg'] == "y") { ?>
                        <div class="alert alert-mini alert-danger margin-bottom-30"><i class="fa fa-times-circle"></i> <?php echo $Lang_Classify_Tip07; //帳號或密碼錯誤!!請重新輸入 ?></div><?php } ?>
						<?php if ($_GET['errMsg'] == "auth") { ?><div class="alert alert-mini alert-danger margin-bottom-30"><i class="fa fa-times-circle"></i> <?php echo $Lang_Classify_Tip08; //帳號尚未認證 ?></div><?php } ?>
							
							<!-- login form -->
                            <form id="ADlogin" name="ADlogin" method="POST" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);?>" class="sky-form boxed" style="background-color: rgba(255, 255, 255, 0.6);">
								<header><i class="fa fa-users"></i> Sign In</header>
								
								<fieldset class="nomargin">	
								
									<label class="label margin-top-20"><?php echo $Lang_Classify_Context_Account_Member; //帳號 ?></label>
									<label class="input">
										<i class="ico-append fa fa-user"></i>
										<input name="account" type="text" class="Input_field" id="account"  maxlength="30"  />
										
									</label>
								
									<label class="label margin-top-20"><?php echo $Lang_Classify_Context_Psw_Member; // 密碼 ?></label>
									<label class="input">
										<i class="ico-append fa fa-lock"></i>
										<input name="psw" type="password" class="Input_field" id="psw"  maxlength="30" />
										
									</label>
									

								</fieldset>
								<footer class="celarfix">
									<button type="submit" class="btn btn-success noradius pull-right"><i class="fa fa-check"></i> <?php echo $Lang_Classify_Login; //登入 ?></button>
									<div class="login-forgot-password pull-left">
										<?php echo $Lang_Classify_Not_Yet_A_Member; ?> <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Click_Here_To_Register; ?></a><br />
»<a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'pswfgt'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Forgot_Psw ?></a>
									</div>
                                    
                                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
								</footer>
							</form>
							<!-- /login form -->
                            
                            <div class="margin-top-20">
                            
							<div class="socials margin-top10 text-center">
                                <?php if ($fb_app_id != "" && $fb_app_secret != "") { ?>
                                <a href="<?php echo $SiteBaseUrl; ?>Thirdparty/facebook/oauth/login.php?wshop=<?php echo $_GET['wshop'] ?>" class="btn btn-block btn-social btn-facebook margin-top-10" style="color:#FFF;">
                                  <i class="fa fa-facebook"></i> 透過 Facebook 登入或註冊
                                </a>
                                <?php } ?>
                                <?php if ($line_app_id != "" && $line_app_secret != "") { ?>
                                <a href="<?php echo $SiteBaseUrl; ?>Thirdparty/line/oauth/login.php?wshop=<?php echo $_GET['wshop'] ?>" class="btn btn-block btn-social btn-line margin-top-10" style="color:#FFF;">
                                  <i class="icon-line"></i> 透過 LINE 登入或註冊
                                </a>
                                <?php } ?>
							</div>
                            </div>

						</div>


		  <div class="col-xs-12 col-md-6 col-lg-6 col-sm-12 col-md-pull-6">

		    <h2 class="size-20 text-center-xs margin-top-10">【會員中心】 </h2>

							<br />
<p>在「會員中心」裡，您可以查看、修改、管理與您相關的各項資料。<br />
請您安心地進行各項資料的維護。<br />
<br />
「會員中心」提供如下數種服務： </p>

			  <ul class="list-unstyled login-features">
				  <li>
					  修改我的個人基本資料，例如地址、e-mail等。 </li>
				  <li>
					  修改/查詢我的個人密碼。 </li>
		    </ul>

			</div>
</div>
<?php } ?>




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
<script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '<?php echo $Lang_Classify_Send_Verify_Tip; ?>',
		txtUnlock : '<?php echo $Lang_Classify_Send_Verify_Unlock; ?>',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : '<?php echo $SiteBaseUrl ?>Qaptcha.jquery.php'
	});
  });
</script> 
<script type="text/javascript"> 
$(document).ready(function(){
    $('.member_inner_board_context').jcolumn();
  });
</script>
