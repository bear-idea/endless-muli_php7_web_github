<?php
/*********************************************************************
 # 主頁面留言訊息 - 發表留言
 *********************************************************************/
?>
<?php 
  switch($_GET['Operate']) 
  {
	  case "addSuccess":
		echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Guestbook . "','success');});</script>\n";
		break;
	  case "TimeOut":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Guestbook_TimeOut . "','warning');});</script>\n";
		break;
	  case "CheckError":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Guestbook_CheckError . "','warning');});</script>\n";
		break;
	  default:
		break;
  }
?>
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<style type="text/css">
.txtImportant{color:red}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_PostMessage; ?></span></h1>
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
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
      
        <form id="form_Guestbook" name="form_Guestbook" method="post" action="<?php echo $SiteBaseUrl . url_rewrite('guestbook',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>">    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right"> <span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Title_Guestbook; // 標題 ?>：</td>
                  <td><span id="GuestbookTitle">
                    <label for="title"></label>
                    <input name="title" type="text" id="title" value="<?php echo $_COOKIE['Gs_Title']; ?>" size="40" maxlength="40" />
                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Author_Guestbook; //留言者?>：</td>
                  <td><span id="GuestbookAuthor">
                    <label for="author"></label>
                    <input name="author" type="text" id="author" value="<?php echo $_COOKIE['Gs_Author']; ?>" maxlength="10" />
                    <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                  </tr>
                  <tr>
                     <td align="right"><span class="Form_Required_Item">*</span>Mail：</td>
                     <td><span id="GuestbookMail">
                  <label for="mail"></label>
                  <input name="mail" type="text" id="mail" value="<?php echo $_COOKIE['Gs_Mail']; ?>" size="30" maxlength="30" />
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span></td>
          </tr>
                   <tr>
                     <td align="right">Skype：</td>
                     <td>
                     <span id="GuestbookMsn">
                <label for="msn"></label>
                    <input name="msn" type="text" id="msn" value="<?php echo $_COOKIE['Gs_Msn']; ?>" size="30" maxlength="30" />
				  </span>
                  </td>
                   </tr>
                         <tr>
                    <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_State_Guestbook; //狀態 ?>：</td>
                  <td><span id="GuestbookWhisper">
                    <label>
                      <input name="whisper" type="radio" id="whisper_0" value="0" checked="checked" />

                  <?php echo $Lang_Classify_Context_QA1_Guestbook; //公開詢問 ?></label>
                    <label>
                      <input type="radio" name="whisper" value="1" id="whisper_1" />
                    <?php echo $Lang_Classify_Context_QA2_Guestbook; //私密留言 ?></label>
                    <span class="radioRequiredMsg"><?php echo $Lang_Classify_Send_Error04; ?></span></span><span class="Form_Caption_Word"><?php echo $Lang_Post_Message_Guestbook_Admin_See; ?></span></td>
                  </tr>
				  <tr>
                    <td align="right" valign="top"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Content_Guestbook; ?>：</td>
        <td><span id="GuestbookContent">
        <label for="content"></label>
        <textarea name="content" id="content" rows="5" class = "Form_Texture_Area"><?php echo $_COOKIE['Gs_Content']; ?></textarea>
        <span class="textareaRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span><span class="textareaMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; //已超所所限制之字數 ?></span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Note_Guestbook; ?>：</td>
                    <td><label for="notes1"></label>
                      <span id="GuestbookNotes1">
                      <label for="notes1"></label>
                      <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
                      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></td>
                  </tr>
				  <?php
				 //if($GuestbookCaptchaSelect == "1") { /* 判斷是否開啟認證碼 */
				  ?>
                  <tr>
                     <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Send_Unlock; //驗證 ?>：</td>
                     <td>
                     <p>
                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                        <object type="application/x-shockwave-flash" data="<?php echo $SiteBaseUrl ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl ?>securimage/securimage_play.php" height="32" width="32" wmode="transparent">
                        <param name="movie" value="<?php echo $SiteBaseUrl ?>securimage/securimage_play.swf?icon_file=<?php echo $SiteBaseUrl ?>securimage/images/audio_icon.png&amp;audio_file=<?php echo $SiteBaseUrl ?>securimage/securimage_play.php" wmode="transparent" height="32" width="32"/>
                        </object>
                        &nbsp;
                        <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="<?php echo $SiteBaseUrl ?>securimage/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
                        <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
                         <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                         <input type="text" name="ct_captcha" size="12" maxlength="16" />
                         <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //<?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span></p>
                     </td>
                   </tr>
                  <tr>
                     <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Send_Unlock; //解鎖 ?>：</td>
                     <td><div class="QapTcha"></div></td>
                   </tr>
                    <?php
					//	 } 
					/*   */
					 ?>  
                     <div id="hidden_fields"><?php echo $hidden_fields_for_NoSpamNX; /*NoSpamNX 隱藏驗證*/?></div>
                   <tr>
                     <td align="right">&nbsp;</td>
                     <td onfocus="YY_checkform('form_Guestbook','aa','aa','6','Field \'aa\' is not valid.');return document.MM_returnValue"><input type="submit" name="submit" id="button" value="<?php echo $Lang_Classify_Send_OK; //確定送出 ?>" />
                       <input type="reset" name="button2" id="button2" value="<?php echo $Lang_Classify_Send_Cancer; //重新輸入 ?>" />
                       <input name="button3" type="button" id="button3" onclick="MM_goToURL('parent','javascript:history.back(-1)');return document.MM_returnValue" value="<?php echo $Lang_BackPage; // 返回前一頁 ?>" />
                       <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                     <input name="ip" type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; // 管理者留言ip未設值 ?>" />
                     <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
                     <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" /></td>
                   </tr>
                   
                   
              </table> 
            <input type="hidden" name="MM_insert" value="form_Guestbook" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
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
var sprytextarea1 = new Spry.Widget.ValidationTextarea("GuestbookContent", {validateOn:["blur"], maxChars:150});
var sprytextfield4 = new Spry.Widget.ValidationTextField("GuestbookNotes1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield1 = new Spry.Widget.ValidationTextField("GuestbookTitle", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("GuestbookAuthor", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("GuestbookMail", "email", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("GuestbookMsn", "none", {validateOn:["blur"], isRequired:false});
var spryradio1 = new Spry.Widget.ValidationRadio("GuestbookWhisper", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("Ct_Captcha", "none", {validateOn:["blur"]});
</script>

