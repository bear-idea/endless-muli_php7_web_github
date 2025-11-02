<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Content_Title_Member_Reg; // 標題文字 ?></span></h1>
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
<?php $MemberRegSelect = "1"; if ($MemberRegSelect == "1") { // 判斷是否開放會員註冊功能?>
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
              <?php if ($_GET['Operate'] == "editSuccess") { ?>
              <script type="text/javascript">
			  	$(document).ready(function() {generatetip('<?php echo $Lang_Classify_Tip14; ?>','success');});
              </script>
              <?php } ?>
<form id="form_Member" name="form_Member" method="POST" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'editpage'),'',$UrlWriteEnable);?>">     
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
        <tr>
          <td colspan="2"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Person_Edit; ?>：</strong></span><strong><span style="float:right;"><?php echo $Lang_Classify_Context_Regdate_Member ?>：<font color="#2865A2"><?php echo date('Y-m-d  g:i A',strtotime($row_RecordMember['regdate'])); ?></font></span></strong></td>
        </tr>   
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Name_Member ?>：</td>
      <td><span id="MemberName">
      <label>
        <input name="name" type="text" id="name" value="<?php echo $row_RecordMember['name'] ?>" size="30" maxlength="30" />
      </label>
      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Job_Member ?>：</td>
      <td><span id="MemberNickname">
            <input name="nickname" type="text" id="nickname" value="<?php echo $row_RecordMember['nickname'] ?>" size="30" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Sex_Member ?>：</td>
      <td><span id="MemberSex">
            <label>
              <input <?php if (!(strcmp($row_RecordMember['sex'],"男"))) {echo "checked=\"checked\"";} ?> name="sex" type="radio" id="sex_0" value="男" checked="checked" />
              <?php echo $Lang_Classify_Context_Boy_Member ?></label>
            <label>
              <input <?php if (!(strcmp($row_RecordMember['sex'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" value="女" id="sex_1" />
              <?php echo $Lang_Classify_Context_Girl_Member ?></label>
            <span class="radioRequiredMsg"><?php echo $Lang_Classify_Send_Error09; ?></span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Birthday_Member ?>：</td>
      <td><span id="MemberBirthday">
            <input name="birthday" type="text" class="datepicker" id="birthday" value="<?php echo $row_RecordMember['birthday']; ?>"/>
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error08; ?></span></span><font color="#999999">YYYY-MM-DD</font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Mail_Member ?>：</td>
      <td><span id="MemberMail">
            <input name="mail" type="text" id="mail" value="<?php echo $row_RecordMember['mail']; ?>" size="50" maxlength="50" />
          <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span><br /><font color="#999999"><?php echo $Lang_Classify_Tip01; ?><?php if ($MemberMailAuthSead == '1') {?><?php echo $Lang_Classify_Tip02; ?><?php } ?></font></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Tel_Member ?>：</td>
      <td><span id="MemberTel">
            <input name="tel" type="text" id="tel" value="<?php echo $row_RecordMember['tel']; ?>" size="20" maxlength="20" />
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span><font color="#999999">Ex: 04-12345678</font></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Cellphone_Member ?>：</td>
      <td><span id="MemberCellphone">
            <input name="cellphone" type="text" id="cellphone" value="<?php echo $row_RecordMember['cellphone']; ?>" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Fax_Member ?>：</td>
      <td><span id="MemberFax">
            <input name="fax" type="text" id="fax" value="<?php echo $row_RecordMember['fax']; ?>" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Web_Member ?>：</td>
      <td><span id="MemberWeb">
            <input name="web" type="text" id="web" value="<?php echo $row_RecordMember['web']; ?>" size="50" maxlength="50" />
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?> Ex: http://www.myweb.com</span></span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Job_Member ?>：</td>
      <td><span id="MemberJob">
            <input name="job" type="text" id="job" value="<?php echo $row_RecordMember['job']; ?>" size="30" maxlength="30" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Serviceunits_Member ?>：</td>
      <td><span id="MemberServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " value="<?php echo $row_RecordMember['serviceunits']; ?>" size="50" maxlength="50" />
          </span></td>
        </tr>
        
        <tr>
          <td align="right" valign="top"><?php echo $Lang_Classify_Context_Addr_Member ?>：</td>
      <td><span id="MemberAddr1">
            <input name="addr1" type="text" id="addr1" value="<?php echo $row_RecordMember['addr1']; ?>" size="70" maxlength="100" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Note_Member ?>：</td>
          <td><label for="notes1"></label>
      <span id="MemberNotes1">
              <label for="notes1"></label>
              <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordMember['notes1']; ?>" size="50" maxlength="50" />
              <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="<?php echo $Lang_Classify_Send_OK; ?>"/>
            <input type="reset" name="button2" id="button2" value="<?php echo $Lang_Classify_Send_Cancer; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordMember['id']; ?>" />
            <input name="auth" type="hidden" id="auth" value="<?php echo $row_RecordMember['auth']; ?>" />
            <input name="indicate" type="hidden" id="indicate" value="<?php echo $row_RecordMember['indicate']; ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form_Member" />
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
</script>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("MemberName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("MemberNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("MemberSex", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("MemberNickname", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("MemberBirthday", "date", {format:"yyyy-mm-dd", validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("MemberMail", "email", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("MemberTel", "phone_number", {isRequired:false, validateOn:["blur"], format:"phone_custom", pattern:"00-00000000"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("MemberCellphone", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("MemberAddr1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("MemberFax", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("MemberWeb", "url", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("MemberJob", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("MemberServiceunits", "none", {validateOn:["blur"], isRequired:false});
//-->
</script>
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
          <td width="189"><?php echo $Lang_Member_Now_No_Registered_Error ?></td>
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
