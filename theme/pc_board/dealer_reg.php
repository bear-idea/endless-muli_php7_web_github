<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>datepicker-zh-TW.js"></script>
<script>$( function() {$( ".datepicker" ).datepicker({changeYear : true,changeMonth : true,dateFormat : "yy-mm-dd"});} );</script>
<style>.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year { width: 45%;}</style>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Content_Title_Dealer_Reg; // 標題文字 ?></span></h1>
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
<?php if ($DealerRegSelect == "1") { // 判斷是否開放會員註冊功能?>
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
<form id="form_Dealer" name="form_Dealer" method="post" action="<?php echo $SiteBaseUrl . url_rewrite('dealer',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      	<tr>
            <td><?php if(isset($_GET['RegMsg']) && $_GET['RegMsg'] == "error") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> <?php echo $Lang_Dealer_Beuse_Error; ?></div><?php } ?><?php if ($_GET['RegMsg'] == "CodeError") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> <?php echo $Lang_Post_Message_Contact_CheckError; ?></div><?php } ?></td>
        </tr>
      </table>
      
      <div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
        <tr>
          <td colspan="2"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Account_Edit; ?>：</strong></td>
          </tr>
        <tr>
        <tr>
          <td width="120" align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Account_Dealer; // 帳號 ?>：</td>
      <td><span id="DealerAccount">
      <input name="account" type="text" id="account" size="30" maxlength="30" class="AccountPswWidth"/>
      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldMinCharsMsg"><?php echo $Lang_Classify_Send_Error07; ?></span><span class="textfieldMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; ?></span></span><font color="#999999"><?php echo $Lang_Account_Input_Tip; ?></font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Psw_Dealer ?>：</td>
      <td><span id="DealerPsw">
            <input name="psw" type="password" id="psw" size="30" maxlength="20" class="AccountPswWidth"/>
            <span class="passwordRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldMinCharsMsg"><?php echo $Lang_Classify_Send_Error07; ?></span><span class="textfieldMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; ?></span></span><font color="#999999"><?php echo $Lang_Psw_Input_Tip; ?></font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Pswcheck_Dealer ?>：</td>
      <td><span id="DealerCheckPsw">
            <input name="checkpsw" type="password" id="checkpsw" size="30" maxlength="20" class="AccountPswWidth"/>
            <span class="confirmRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="confirmInvalidMsg"><?php echo $Lang_Psw_Check_Error; ?></span></span><font color="#999999"><?php echo $$Lang_Psw_Re_Check_Tip; ?></font></td>
        </tr>
        <tr>
          <td align="right"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Person_Edit; ?>：</strong></td>
          </tr>
        <tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Name_Dealer ?>：</td>
      <td><span id="DealerName">
      <label>
        <input name="name" type="text" id="name" size="30" maxlength="30" />
      </label>
      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Job_Member ?>：</td>
      <td><span id="DealerNickname">
            <input name="nickname" type="text" id="nickname" size="30" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Sex_Dealer ?>：</td>
      <td><span id="DealerSex">
            <label>
              <input name="sex" type="radio" id="sex_0" value="男" checked="checked" />
              <?php echo $Lang_Classify_Context_Boy_Member ?></label>
            <label>
              <input type="radio" name="sex" value="女" id="sex_1" />
              <?php echo $Lang_Classify_Context_Girl_Member ?></label>
            <span class="radioRequiredMsg"><?php echo $Lang_Classify_Send_Error09; ?></span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Mail_Dealer ?>：</td>
      <td><span id="DealerMail">
            <input name="mail" type="text" id="mail" size="50" maxlength="50" />
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span><br /><font color="#999999"><?php echo $Lang_Classify_Tip01; ?><?php if ($DealerMailAuthSead == '1') {?><?php echo $Lang_Classify_Tip02; ?><?php } ?></font></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Tel_Dealer ?>：</td>
      <td><span id="DealerTel">
            <input name="tel" type="text" id="tel" size="20" maxlength="20" />
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span><font color="#999999">Ex: 04-12345678</font></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Cellphone_Dealer ?>：</td>
      <td><span id="DealerCellphone">
            <input name="cellphone" type="text" id="cellphone" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Fax_Dealer ?>：</td>
      <td><span id="DealerFax">
            <input name="fax" type="text" id="fax" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Web_Dealer ?>：</td>
      <td><span id="DealerWeb">
            <input name="web" type="text" id="web" size="50" maxlength="50" />
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?> Ex: http://www.myweb.com</span></span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Job_Dealer ?>：</td>
      <td><span id="DealerJob">
            <input name="job" type="text" id="job" size="30" maxlength="30" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Serviceunits_Dealer ?>：</td>
      <td><span id="DealerServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " size="50" maxlength="50" />
          </span></td>
        </tr>
        
        <tr>
          <td align="right" valign="top"><?php echo $Lang_Classify_Context_Addr_Dealer ?>：</td>
      <td><span id="DealerAddr1">
            <input name="addr1" type="text" id="addr1" size="70" maxlength="100" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Note_Dealer ?>：</td>
          <td><label for="notes1"></label>
      <span id="DealerNotes1">
              <label for="notes1"></label>
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
              <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span></td>
        </tr>
        <tr>
              <td valign="center" align="right"><span class="columnName"><span class="Form_Required_Item">*</span> <?php echo $Lang_Classify_Send_Unlock; ?>：</span></td>
              <td valign="center" >
              <p>
                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                        <object type="application/x-shockwave-flash" data="<?php echo $SiteBaseUrl ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl ?>securimage/securimage_play.php" height="32" width="32" wmode="transparent">
                        <param name="movie" value="<?php echo $SiteBaseUrl ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl ?>securimage/securimage_play.php" wmode="transparent" height="32" width="32"/>
                        </object>
                        &nbsp;
                        <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="<?php echo $SiteBaseUrl ?>securimage/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
                        <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:</strong><br />
                         <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                         <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                         <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span></p>
              </td>
                            </tr>
        <tr>
                     <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Send_Verify; ?>：</td>
                     <td><div class="QapTcha"></div></td>
                   </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="<?php echo $Lang_Classify_Send_OK; ?>"/>
            <input type="reset" name="button2" id="button2" value="<?php echo $Lang_Classify_Send_Cancer; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="indicate" type="hidden" id="indicate" value="1" />
            <input name="auth" type="hidden" id="auth" value="<?php echo $authcode=substr(md5(uniqid(rand())), 0, 10); ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" />
            <input name="wshop" type="hidden" id="userid2" value="<?php echo $_GET['wshop']; ?>" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
                      </div>
            </div>
        </div>        
</div>
          <input type="hidden" name="MM_insert" value="form_Dealer" />
      </form>
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
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("DealerName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("DealerNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("DealerSex", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("DealerAccount", "none", {validateOn:["blur"], minChars:6, maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("DealerPsw", {validateOn:["blur"], minChars:6, maxChars:20});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("DealerCheckPsw", "psw", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("DealerNickname", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("DealerMail", "email", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("DealerTel", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("DealerCellphone", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("DealerAddr1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("DealerFax", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("DealerWeb", "url", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("DealerJob", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("DealerServiceunits", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("Ct_Captcha", "none", {validateOn:["blur"]});
//-->
</script>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  
<?php if ($DealerRegSelect == "0") { // 判斷是否開放會員註冊功能?>
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
          <td width="189"><?php echo $Lang_Dealer_Now_No_Registered_Error; ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
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
