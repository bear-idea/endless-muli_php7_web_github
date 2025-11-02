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
<div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Classify_Login; // 登入 ?></span></h1>
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
                <?php //echo $_SESSION['MM_UserGroup_' . $_GET['wshop']] ?>
                <?php if ((isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) {?>
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
                <form id="ADlogin" name="ADlogin" method="POST" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);?>">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="middle" class="ErrorInputWord">
                        <?php if (isset($_GET['errMsg']) && $_GET['errMsg'] == "y") { ?><i class="fa fa-times-circle"></i> <?php echo $Lang_Classify_Tip07; //帳號或密碼錯誤!!請重新輸入 ?><?php } ?><?php if (isset($_GET['errMsg']) && $_GET['errMsg'] == "auth") { ?><i class="fa fa-times-circle"></i> <?php echo $Lang_Classify_Tip08; //帳號尚未認證 ?><?php } ?></td>
                      </tr>
                    <tr>
                      <td valign="middle" class="TipBrowser"><span class="ErrorInputWord">
                        <?php if (isset($_GET['authcode']) && $_GET['authcode'] == "ok") { ?>
                        <div style="color:#009900"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip09; //您的會員已認證成功!!請由此登入!! ?></div>
                        <?php } ?>
                        </span></td>
                      </tr>
                    <tr>
                      <td valign="middle" class="TipBrowser"><span class="ErrorInputWord">
                        <?php if (isset($_GET['Operate']) && $_GET['Operate'] == "regSuccess" && $MemberMailAuthSead == "1") { ?>
                        <div style="color:#009900"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip10; //註冊成功!!系統已寄發認證信!!請到您註冊之信箱取得認證信 ?></div>
                        <?php } else if (isset($_GET['Operate']) && $_GET['Operate'] == "regSuccess" && $MemberMailAuthSead == "0"){ ?>
                        <div style="color:#009900"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip11; //註冊成功!!需等待管理員審核寄發認證信 ?></div>
                        <?php } else if (isset($_GET['Operate']) && $_GET['Operate'] == "regSuccess"){ ?>
                        <div style="color:#009900"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip12; //註冊成功 ?></div>
                        <?php } ?>
                        </span>
                        <?php if(isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Test_Member') {?>
                        <i class="fa fa-times-circle"></i> <?php echo $Lang_Classify_Tip13; //目前此帳號需等待管理員驗證 ?>
                        <?php } ?>
                        </td>
                      </tr>
                    <tr>
                      <td height="15" valign="middle"><!--<img src="images/hr_login.png" width="500" height="1" />--></td>
                      </tr>
                      <tr>
                      <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="59%">
                          <div style="border:1px #DDD solid; padding:5px;" class="member_inner_board_context">
                          <p class="member_center_style6"><span class="member_center_style5"><br />
                            <br />
                            【會員中心】 </span><br />
                            <br />
                            在「會員中心」裡，您可以查看、修改、管理與您相關的各項資料。 <br />
                            請您安心地進行各項資料的維護。 <br />
  <br />
                            「會員中心」提供如下數種服務： </p>
                            <ol>
                              <li class="member_center_style6"> 修改我的個人基本資料，例如地址、e-mail等。 </li>
                              <li class="member_center_style6"> 修改/查詢我的個人密碼。 </li>
                            </ol>
                            </div>
                            </td>
                          <td width="41%">
                          <div style="border:1px #DDDDDD solid; padding:5px; margin-left:10px; margin-right:5px;" class="member_inner_board_context">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="100"><?php echo $Lang_Classify_Context_Account_Member; //帳號 ?>：</td>
                              <td align="left"><input name="account" type="text" class="Input_field" id="account" size="30" maxlength="30"  style="width:88%"/></td>
                            </tr>
                            <tr>
                              <td height="5" colspan="2"></td>
                              </tr>
                            <tr>
                              <td><?php echo $Lang_Classify_Context_Psw_Member; // 密碼 ?>：</td>
                              <td align="left"><input name="psw" type="password" class="Input_field" id="psw" size="30" maxlength="30" style="width:88%"/></td>
                            </tr>
                            <tr>
                              <td><?php echo $Lang_Classify_Send_Verify; // 驗證 ?>：</td>
                              <td><div class="QapTcha" style="padding-top:5px;"></div></td>
                            </tr>
                            <tr>
                              <td height="5" colspan="2"></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td><input type="submit" name="button" id="button" value="<?php echo $Lang_Classify_Login; //登入 ?>" />
                                <input type="reset" name="button2" id="button2" value="<?php echo $Lang_Classify_Refill; //重填 ?>" />
                                </td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2"><?php echo $Lang_Classify_Not_Yet_A_Member; ?> <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Click_Here_To_Register; ?></a></td>
                            </tr>
                            <tr>
                              <td colspan="2">»<a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'pswfgt'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Forgot_Psw ?></a></td>
                            </tr>
                          </table>
                          </div>
                            </td>
                        </tr>
                      </table></td>
                      </tr>
                      <tr>
                      <td valign="middle"><p class="member_center_style6">&nbsp;</p></td>
                      
                    </table>
                </form>
                 <?php } ?>
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
