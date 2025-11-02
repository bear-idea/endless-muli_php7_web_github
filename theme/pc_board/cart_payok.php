<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<style type="text/css">.txtImportant {color: #F00; }</style>
<?php 
  switch($_GET['Operate']) 
  {
	  case "CheckError":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Contact_CheckError . "','warning');});</script>\n";
		break;
	  default:
		break;
  }
?>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Payok; // 標題文字 ?></span></h1>
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
	  <?php if ($_SESSION['mailsend_message'] == "On") { ?>
         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                      <td width="189"><?php echo $Lang_Classify_Context_Mail_Send_Success; /*信件已送出*/ ?></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
              </tr>
          </table>
		<?php $_SESSION['mailsend_message'] = "Off"; ?>
		<?php } else { ?>     
      	<form id="Mail_Send_Form" name="Mail_Send_Form" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("sendmail_payok",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'send'),'',$UrlWriteEnable);?>" onsubmit="return document.MM_returnValue">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
            <tr>
              <td><div data-scroll-reveal="enter top"><?php echo $row_RecordContactMail['contactcontent']; ?></div></td>
            </tr>
          </table>
          <?php //if ($row_RecordContactMail['formindicate'] == '0') { ?>
          <table width="100%" cellpadding="0" cellspacing="0" class="TB_General_style00" data-scroll-reveal="enter left">
                        
                            <tbody>
                                <tr>
                                    <td width="120" align="right" class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Context_Mail_Send_Name; //姓名 ?>:</td>
                                    <td><span id="sprytextfield2">
                                      <input name="name" type="text"  class="text" id="name" value="<?php echo $_COOKIE['Ct_Name'];; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //<?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
                                    <td align="right" class="columnName"><?php echo $Lang_Classify_Context_Mail_Send_Phone; //電話 ?>:</td>
                                    <td><span id="sprytextfield6">
                                      <input name="phone" type="text"  class="text" id="phone" value="<?php echo $_COOKIE['Ct_Phone']; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
                                    <td align="right" class="columnName">Email:</td>
                                    <td><span id="sprytextfield8">
                                    <input name="mail" type="text"  class="text" id="mail" value="<?php echo $_COOKIE['Ct_Mail']; ?>"/>
                                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; //格式無效。 ?></span></span></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="center" ><span class="txtImportant">*</span><?php echo $Lang_Classify_Context_Mail_Send_PayDate; //匯款日期 ?>:</td>
                                  <td valign="center" ><span id="sprytextfield1">
                                  <label for="paydate"></label>
                                  <input name="paydate" type="text" id="paydate" maxlength="20" />
                                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; //格式無效。 ?></span></span></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="center" ><span class="txtImportant">*</span><?php echo $Lang_Classify_Context_Mail_Send_PayNumber; //匯款帳號末五碼 ?>:</td>
                                  <td valign="center" ><span id="sprytextfield4">
                                  <label for="paynumber"></label>
                                  <input name="paynumber" type="text" id="paynumber" maxlength="10" />
                                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; //格式無效。 ?></span></span></td>
                                </tr>
                              <tr>
                                  <td align="right" valign="center" ><span class="txtImportant">*</span><?php echo $Lang_Classify_Context_Mail_Send_PayMoney; //匯款金額 ?>:</td>
                                  <td valign="center" ><span id="sprytextfield5">
                                  <label for="paymoney"></label>
                                  <input name="paymoney" type="text" id="paymoney" maxlength="10" />
                                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; //格式無效。 ?></span></span></td>
                              </tr>
                                <tr>
                                    <td align="right" class="columnName"><?php echo $Lang_Classify_Context_Mail_Send_Message; //備註事項 ?> :</td>
                                    <td><span id="sprytextarea1">
                                    <label for="message"></label>
                                      <textarea name="message" id="message" cols="45" rows="5"><?php echo $_COOKIE['Ct_Message']; ?></textarea>
                                    <span class="textareaRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                                </tr>
                                <tr>
              <td valign="center" align="right"><span class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Send_Verify; //解鎖 ?> :</span></td>
              <td valign="center" >
              <p>
                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                        <object type="application/x-shockwave-flash" data="<?php echo $SiteBaseUrl; ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl; ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl; ?>securimage/securimage_play.php" height="32" width="32" wmode="transparent">
                        <param name="movie" value="<?php echo $SiteBaseUrl; ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl; ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl; ?>securimage/securimage_play.php" wmode="transparent" height="32" width="32"/>
                        </object>
                        &nbsp;
                        <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="<?php echo $SiteBaseUrl; ?>securimage/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
                        <strong>Enter Code*:</strong><br />
                         <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                         <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                         <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span></p>
              </td>
                              </tr>
                              <tr>
              <td valign="center" align="right"><span class="columnName"><span class="txtImportant">*</span> <?php echo $Lang_Classify_Send_Unlock; //驗證 ?> :</span></td>
              <td valign="center" ><div class="QapTcha"></div></td>
                              </tr>
            <tr>
              <td valign="center" >&nbsp;</td>
              <td valign="center" >&nbsp;</td>
            </tr>
            <tr>
              <td valign="center" >&nbsp;</td>
              <td valign="center" >&nbsp;</td>
            </tr>
                            
        
            <tr>
              <td valign="center" align="middle" colspan="2"><input type="submit" value="<?php echo $Lang_Classify_Send_OK; //確定送出 ?>" onclick="return CheckFields();"/>
                <input type="reset" value="<?php echo $Lang_Classify_Send_Cancer; //重新輸入 ?>" /></td>
            </tr>
                    </tbody>
          </table>
          <?php } ?>
          <?php //} ?>
          <input type="hidden" name="Mail_Send_Form" value="Mail_Send_On" />
      	  <input name="SiteMail" type="hidden" id="SiteMail" value="<?php echo $row_RecordCartMail['CartPayMail']; ?>" />
      	  <input name="SiteAuthor" type="hidden" id="SiteAuthor" value="<?php echo $SiteSName; ?>" />
      	  <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
      	  <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
      	  <input name="subject" type="hidden" id="subject" value="匯款通知" />
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
		txtLock : '<?php echo $Lang_Classify_Send_Verify_Tip; //移動按鈕拖曳至右方以解鎖按鈕 ?>',
		txtUnlock : '<?php echo $Lang_Classify_Send_Verify_Unlock; //按鈕解鎖 ?>',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : '<?php echo $SiteBaseUrl; ?>Qaptcha.jquery.php'
	});
  });
</script> 
<script type="text/javascript">
<!--
function CheckFields()
{	
	var fieldvalue = document.getElementById("name").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Name . ")"; ?>");
		document.getElementById("name").focus();
		return false;
	}
	var fieldvalue = document.getElementById("paydate").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Name . ")"; ?>");
		document.getElementById("paydate").focus();
		return false;
	}
	var fieldvalue = document.getElementById("paynumber").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Name . ")"; ?>");
		document.getElementById("paynumber").focus();
		return false;
	}
	var fieldvalue = document.getElementById("paymoney").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Name . ")"; ?>");
		document.getElementById("paymoney").focus();
		return false;
	}
	var fieldvalue = document.getElementById("ct_captcha").value;
	if (fieldvalue == "")
	{
		alert("<?php echo $Lang_Classify_Send_Error03 . "(" . $Lang_Classify_Context_Mail_Send_Verify . ")"; ?>");
		document.getElementById("ct_captcha").focus();
		return false;
	}
}
//-->
</script>
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "email", {validateOn:["blur"], isRequired:false});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("Ct_Captcha", "none", {validateOn:["blur"]});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {validateOn:["blur"], format:"yyyy-mm-dd"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {validateOn:["blur"], minValue:0});
</script>
<script type="text/javascript">
  $(function() {
    $( "#paydate" ).datepicker({dateFormat: 'yy-mm-dd'});
  });
</script>