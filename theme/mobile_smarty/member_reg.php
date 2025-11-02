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
<style>
.columnName{display:block;width:100%;padding:9px 0;line-height:1.428571429;color:#555;vertical-align:middle}
.form-control{margin-bottom:10px}</style>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Content_Title_Member_Reg; // 標題文字 ?></span></h1>
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
<?php if ($MemberRegSelect == "1") { // 判斷是否開放會員註冊功能?>
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

<?php if(isset($_GET['RegMsg']) && $_GET['RegMsg'] == "error") { ?>
<div class="alert alert-mini alert-danger margin-bottom-30"><i class="fa fa-times-circle"></i> <?php echo $Lang_Member_Beuse_Error; ?></div>
<?php } ?>
<?php if ($_GET['RegMsg'] == "CodeError") { ?>
<div class="alert alert-mini alert-danger margin-bottom-30"><i class="fa fa-times-circle"></i> <?php echo $Lang_Post_Message_Contact_CheckError; ?></div>
<?php } ?>

<?php if ($_POST['RegStep'] == '1' || $_GET['RegMsg'] == 'error' || $_SESSION['RegStep'] == '1') { ?>
<form id="form_Member" name="form_Member" method="post" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>">

      <fieldset>
      <div class="padding-10">
      <i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Account_Edit; ?>：</strong>
      </div>
      
     <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Account_Member; // 帳號 ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberAccount">
      <input name="account" type="text" id="account" size="30" maxlength="30" class="AccountPswWidth text form-control"/>
      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldMinCharsMsg"><?php echo $Lang_Classify_Send_Error07; ?></span><span class="textfieldMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; ?></span></span><font color="#999999"><?php echo $Lang_Account_Input_Tip; ?></font>
		  </div>
	  </div>
      
     <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Psw_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberPsw">
            <input name="psw" type="password" id="psw" size="30" maxlength="20" class="AccountPswWidth text form-control"/>
            <span class="passwordRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="passwordMinCharsMsg"><?php echo $Lang_Classify_Send_Error07; ?></span><span class="passwordMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06; ?></span></span><font color="#999999"><?php echo $Lang_Psw_Input_Tip; ?></font>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Pswcheck_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberCheckPsw">
            <input name="checkpsw" type="password" id="checkpsw" size="30" maxlength="20" class="AccountPswWidth text form-control"/>
            <span class="confirmRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="confirmInvalidMsg"><?php echo $Lang_Psw_Check_Error; ?></span></span><font color="#999999"><?php echo $$Lang_Psw_Re_Check_Tip; ?></font>
		  </div>
	  </div>
      
      <div class="padding-10">
      <i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Person_Edit; ?>：</strong>
      </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Name_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberName">
      <label>
        <input name="name" type="text" id="name" size="30" maxlength="30" class="text form-control"/>
      </label>
      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Nickname_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberNickname">
            <input name="nickname" type="text" id="nickname" size="30" maxlength="20" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Sex_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberSex">
             
            <label class="radio" style="line-height:37px; ">
              <input name="sex" type="radio" id="sex_0" value="男" checked="checked" />
              <i></i><?php echo $Lang_Classify_Context_Boy_Member ?></label>
            <label class="radio" style="line-height:37px; ">
              <input type="radio" name="sex" value="女" id="sex_1" />
              <i></i><?php echo $Lang_Classify_Context_Girl_Member ?></label>
            <span class="radioRequiredMsg"><?php echo $Lang_Classify_Send_Error09; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Birthday_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberBirthday">
            <input type="text" name="birthday" id="birthday" class="datepicker text form-control" />
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error08; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Mail_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberMail">
            <input name="mail" type="text" id="mail" size="50" maxlength="50" class="text form-control"/>
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span><font color="#999999"><?php echo $Lang_Classify_Tip01; ?><?php if ($MemberMailAuthSead == '1') {?><?php echo $Lang_Classify_Tip02; ?><?php } ?></font>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Tel_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberTel">
            <input name="tel" type="text" id="tel" size="20" maxlength="20" class="text form-control"/>
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cellphone_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberCellphone">
            <input name="cellphone" type="text" id="cellphone" size="20" maxlength="20" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Fax_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberFax">
            <input name="fax" type="text" id="fax" size="20" maxlength="20" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group" style="display:none">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Web_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberWeb">
            <input name="web" type="text" id="web" size="50" maxlength="50" class="text form-control"/>
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?> Ex: http://www.myweb.com</span></span>
		  </div>
	  </div>
      
      <div class="form-group" style="display:none">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Job_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberJob">
            <input name="job" type="text" id="job" size="30" maxlength="30" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group" style="display:none">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Serviceunits_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " size="50" maxlength="50" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Addr_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberAddr1">
            <input name="addr1" type="text" id="addr1" size="70" maxlength="100" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Note_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <label for="notes1"></label>
      <span id="MemberNotes1">
              <label for="notes1"></label>
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="text form-control"/>
              <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
          <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Send_Verify; //解鎖 ?>:<span class="txtImportant">*</span></span> </label>
          <div class="col-md-10 col-sm-10 col-xs-12">
              <p> <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
            
            &nbsp; <br />
            <strong><?php echo $Lang_Classify_Send_Verify_Input; ?>:<span class="txtImportant">*</span></strong><br />
            <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
            <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; //欄位不可為空。?></span></span><a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $SiteBaseUrl; ?>securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false" class="btn btn-3d btn-white"><i class="fa fa-refresh"></i><?php echo $Lang_Classify_Send_Verify_Unlock_Refresh; ?></a></p>
          </div>
      </div>
      
      <div class="form-group">
          <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Send_Unlock; //驗證 ?><span class="txtImportant">*</span></span></label>
          <div class="col-md-10 col-sm-10 col-xs-12">
              <div class="QapTcha"></div>
          </div>
      </div>
      
      <div class="form-group">
      	<div class="col-md-10 col-sm-12 col-xs-12 padding-10 margin-top-10 " style="background-color:#FFE8E9; color:#900;">
      <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $Lang_Classify_Tip03; ?>
            <br />
          <label class="radio" >
            <input name="agreemailsend" type="radio" id="agreemailsend_0" value="1" checked="checked" />
            <i></i><?php echo $Lang_Classify_Agree; ?></label>
          <label class="radio" >
            <input type="radio" name="agreemailsend" value="0" id="agreemailsend_1" />
            <i></i><?php echo $Lang_Classify_NoAgree; ?></label>
        </div>
      </div>
      
      
      
      <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12 margin-top-50">
              <div class="col-md-5 col-sm-6 col-xs-6 col-md-push-2">
                  <input type="submit" value="<?php echo $Lang_Classify_Send_OK; //確定送出 ?>" class="btn btn-3d btn-white btn-block"/>
              </div>
              <div class="col-md-5 col-sm-6 col-xs-6 col-md-push-2">
                  <input type="reset" value="<?php echo $Lang_Classify_Send_Cancer; //重新輸入 ?>" class="btn btn-3d btn-white btn-block"/>
              </div>
          </div>
      </div>
      
      <input name="indicate" type="hidden" id="indicate" value="1" />
      <input name="auth" type="hidden" id="auth" value="<?php echo $authcode=substr(md5(uniqid(rand())), 0, 10); ?>" />
      <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" />
      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
      <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
      <input name="agreeprovision" type="hidden" id="agreeprovision" value="1" /> 
      <!--<input name="RegStep" type="hidden" id="RegStep" value="<?php //echo $_POST['RegStep'] ?>" />-->
      <input name="regdate" type="hidden" id="regdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" />
      <input type="hidden" name="MM_insert" value="form_Member" />
      
      </fieldset>    
      </form>
      
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("MemberName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("MemberNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("MemberSex", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("MemberAccount", "none", {validateOn:["blur"], minChars:6, maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("MemberPsw", {validateOn:["blur"], minChars:6, maxChars:20});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("MemberCheckPsw", "psw", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("MemberNickname", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("MemberBirthday", "date", {format:"yyyy-mm-dd", validateOn:["blur"], isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("MemberMail", "email", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("MemberTel", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("MemberCellphone", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("MemberAddr1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("MemberFax", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("MemberWeb", "url", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("MemberJob", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("MemberServiceunits", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("Ct_Captcha", "none", {validateOn:["blur"]});
//-->
</script>
<?php } else { ?>
<form id="form_Member" name="form_Member" method="post" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>">
<div style="padding:10px;">
<div class="Scroll_Bar" style="height:500px; border:1px solid #DDD; padding:10px;">
<?php echo $row_RecordSystemConfigOtr['memberprovision'] ?>
</div>
<div>
<br />
<span id="sprycheckbox1">
<label class="checkbox">
	<input type="checkbox" name="AgreeMemberProvision" id="AgreeMemberProvision" />
	<i></i> <?php echo $Lang_Member_Agree; ?>
</label>
<span class="checkboxRequiredMsg"><?php echo $Lang_Classify_Send_Error04; ?></span></span>
<div style="float:right;"><button type="submit" class="btn btn-success noradius pull-right"><i class="fa fa-check"></i> <?php echo $Lang_Classify_Next; ?></button></div>
<br />
</div>
</div>
<input type="hidden" name="RegStep" value="1" />
</form>
<style type="text/css">
.Auto_Block_Wrp {
}
.Scroll_Bar {overflow:hidden; padding:5px;}
.Scroll_Bar_horizontal {overflow:hidden; padding:5px;}
</style>
<script>
(function($){
		$(window).load(function(){
			$(".Scroll_Bar").mCustomScrollbar({
				scrollButtons:{
					enable:true
				},
				theme:"dark-thin"
			});
			$(".Scroll_Bar_horizontal").mCustomScrollbar({
				scrollButtons:{
					enable:true
				},
				horizontalScroll:true,
				theme:"dark-thin"
			});
		});
	})(jQuery);
</script>
<script type="text/javascript">
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {validateOn:["blur"]});
</script>
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
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  
<?php if ($MemberRegSelect == "0") { // 判斷是否開放會員註冊功能?>
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
          <td width="189"><?php echo $Lang_Member_Now_No_Registered_Error; ?></td>
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
