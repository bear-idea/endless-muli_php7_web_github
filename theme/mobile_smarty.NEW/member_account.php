<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
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
<?php if ($MemberRegSelect == "1" || (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) { // 判斷是否開放會員註冊功能?>
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
              <div class="alert alert-mini alert-success margin-bottom-30"><i class="fa fa-exclamation-circle"></i> '<?php echo $Lang_Classify_Tip14; ?></div>
              <?php } ?>
              
<form id="form_Member" name="form_Member" method="POST" action="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'accountpage'),'',$UrlWriteEnable);?>">
     <fieldset>
     <div class="padding-10">
      <i class="fa fa-angle-double-right" aria-hidden="true"></i> <strong><?php echo $Lang_Content_Title_Account_Edit ?>：</strong>
      </div>
      
     <div class="form-group" style="height:30px;">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Account_Member; //帳號 ?>:</span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <?php echo $_SESSION['MM_Username_' . $_GET['wshop']] ?>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Psw_Member; //密碼 ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberPsw">
            <input name="psw" type="password" id="psw" size="30" maxlength="20" class="text form-control"/>
          </span>
		  </div>
	  </div>
      
      <div class="form-group">
		  <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Pswcheck_Member; //確認密碼 ?>:<span class="Form_Required_Item">*</span></span></label>
		  <div class="col-md-10 col-sm-10 col-xs-12">
              <span id="MemberCheck">
        <label for="pswcheck"></label>
        <input name="pswcheck" type="password" id="pswcheck" size="30" maxlength="20" class="text form-control"/>
        <span class="confirmRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span><span class="confirmInvalidMsg"><?php echo $Lang_Psw_Check_Error ?></span></span>
		  </div>
	  </div>
      
      <div class="form-group text-center" >
              	  <div class="col-md-12 col-sm-12 col-xs-12 margin-top-50">
                      <div class="col-md-5 col-sm-6 col-xs-6 col-md-push-2">
                          <input type="submit" value="<?php echo $Lang_Classify_Send_OK; //確定送出 ?>"  class="btn btn-3d btn-white btn-block"/>
                      </div>
                      <div class="col-md-5 col-sm-6 col-xs-6 col-md-push-2">
                          <input type="reset" value="<?php echo $Lang_Classify_Send_Cancer; //重新輸入 ?>" class="btn btn-3d btn-white btn-block"/>
                      </div>
                  </div>
              </div>

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
var sprytextfield3 = new Spry.Widget.ValidationTextField("MemberPsw", "none", {validateOn:["blur"], isRequired:false});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("MemberCheck", "nickname", {validateOn:["blur"]});
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
