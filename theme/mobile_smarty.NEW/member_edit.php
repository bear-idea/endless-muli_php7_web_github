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
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
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
  <div class="post_content padding-3">
  
  
  <?php if ($_GET['Operate'] == "editSuccess") { ?>
  <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> <?php echo $Lang_Classify_Tip14; ?></div>
  <?php } ?>
              
<form id="form_Member" name="form_Member" method="POST" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'editpage'),'',$UrlWriteEnable);?>"> 


      <fieldset>
      <div class="padding-10">
      <i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Person_Edit; ?>：</strong>
      </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">頭像:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <input name="button3" type="button" id="button3" onclick="MM_openBrWindow('<?php echo $SiteBaseUrl; ?>upload_memberavatar.php?wshop=<?php echo $_GET['wshop']; ?>&amp;lang=<?php echo $_GET['lang']; ?>','圖片上傳','resizable=yes,width=500,height=350')" value="修改圖片" />
		  </div>
          <div class="clearfix"></div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Name_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberName">
      <label>
        <input name="name" type="text" id="name" size="30" maxlength="30" class="text form-control" value="<?php echo $row_RecordMember['name'] ?>"/>
      </label>
      <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Job_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberNickname">
            <input name="nickname" type="text" class="text form-control" id="nickname" value="<?php echo $row_RecordMember['nickname'] ?>" size="30" maxlength="20"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Sex_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberSex">
             
            <label class="radio" style="line-height:37px; ">
              <input name="sex" <?php if (!(strcmp($row_RecordMember['sex'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" id="sex_0" value="男" checked="checked" />
              <i></i><?php echo $Lang_Classify_Context_Boy_Member ?></label>
            <label class="radio" style="line-height:37px; ">
              <input <?php if (!(strcmp($row_RecordMember['sex'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" value="女" id="sex_1" />
              <i></i><?php echo $Lang_Classify_Context_Girl_Member ?></label>
            <span class="radioRequiredMsg"><?php echo $Lang_Classify_Send_Error09; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Birthday_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberBirthday">
            <input name="birthday" type="text" class="datepicker text form-control" id="birthday" value="<?php echo $row_RecordMember['birthday']; ?>" />
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error08; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Mail_Member ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberMail">
            <input name="mail" type="text" class="text form-control" id="mail" value="<?php echo $row_RecordMember['mail']; ?>" size="50" maxlength="50"/>
            <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span><font color="#999999"><?php echo $Lang_Classify_Tip01; ?><?php if ($MemberMailAuthSead == '1') {?><?php echo $Lang_Classify_Tip02; ?><?php } ?></font>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Tel_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberTel">
            <input name="tel" type="text" class="text form-control" id="tel" value="<?php echo $row_RecordMember['tel']; ?>" size="20" maxlength="20"/>
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cellphone_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberCellphone">
            <input name="cellphone" type="text" class="text form-control" id="cellphone" value="<?php echo $row_RecordMember['cellphone']; ?>" size="20" maxlength="20"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Fax_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberFax">
            <input name="fax" type="text" class="text form-control" id="fax" value="<?php echo $row_RecordMember['fax']; ?>" size="20" maxlength="20"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Web_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberWeb">
            <input name="web" type="text" class="text form-control" id="web" value="<?php echo $row_RecordMember['web']; ?>" size="50" maxlength="50"/>
            <span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05; ?> Ex: http://www.myweb.com</span></span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Job_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberJob">
            <input name="job" type="text" class="text form-control" id="job" value="<?php echo $row_RecordMember['job']; ?>" size="30" maxlength="30"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Serviceunits_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberServiceunits">
            <input name="serviceunits" type="text" class="text form-control" id="serviceunits " value="<?php echo $row_RecordMember['serviceunits']; ?>" size="50" maxlength="50"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Addr_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberAddr1">
            <input name="addr1" type="text" class="text form-control" id="addr1" value="<?php echo $row_RecordMember['addr1']; ?>" size="70" maxlength="100"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Note_Member ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <label for="notes1"></label>
      <span id="MemberNotes1">
              <label for="notes1"></label>
              <input name="notes1" type="text" class="text form-control" id="notes1" value="<?php echo $row_RecordMember['notes1']; ?>" size="50" maxlength="50"/>
              <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03; ?></span></span>
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
      <input name="id" type="hidden" id="id" value="<?php echo $row_RecordMember['id']; ?>" />
      <input name="auth" type="hidden" id="auth" value="<?php echo $row_RecordMember['auth']; ?>" />
      <input name="indicate" type="hidden" id="indicate" value="<?php echo $row_RecordMember['indicate']; ?>" />
      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
       
      <input type="hidden" name="MM_update" value="form_Member" />
      </fieldset>
      
           
</form>

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
