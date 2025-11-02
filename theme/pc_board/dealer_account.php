<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.ui.touch.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>QapTcha.jquery.js"></script>
<script src="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl ?>SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
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
<!-- 標題外框-->
<script type="text/javascript">
<!--
function CheckFields()
{	
	// 檢查『帳號』欄位
	var fieldvalue = document.getElementById("account").value;
	if (fieldvalue == "") 
	{
		alert("帳號欄位尚未填寫！！");
		document.getElementById("account").focus();
		return false;
	}
	else if (fieldvalue.length < 6 || fieldvalue.length > 20) 
	{
		alert("帳號欄位的長度必須是6~20個字元!");
		document.getElementById("username").focus();
		return false;
	}
	// 檢查帳號是否已經存在?
	checkUsernameExist(document.getElementById("account").value);
		
	return true;
}

function myCallBack(req) 
{
   var count = req.xhRequest.responseText;
   
   if (count > 0) 
   {	  		
		alert(req.userData.account + "\r\n已有相同的帳號, 請您重新輸入！"); 
		// 不要插入新的會員記錄
		//document.getElementById("MM_insert").value = "";
   }
   if(count == 0)
   {
	   alert(req.userData.account + "\r\n此帳號可以使用！"); 
   }
   
}

function checkUsernameExist(account)
{
    var objUserData = new Object;
	objUserData.account = account;

	var req = Spry.Utils.loadURL("GET","admin/checkform/dealer_check_repet.php?username="+account, false, myCallBack, {userData: objUserData});
}
//-->
</script>
<?php //if ($DealerRegSelect == "1") { // 判斷是否開放會員註冊功能?>
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
<form id="form_Dealer" name="form_Dealer" method="POST" action="require_dealer_edit.php">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong><?php echo $Lang_Content_Title_Account_Edit; //帳號資料 ?>：</strong></td>
        </tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Account_Member; //帳號 ?>：</td>
      <td>&nbsp;<?php echo $_SESSION['MM_Username_' . $_GET['wshop']] ?></td>
        </tr>
        <tr>
          <td align="right"><?php echo $Lang_Classify_Context_Psw_Member; //密碼 ?>：</td>
      <td><span id="DealerPsw">
            <input name="nickname" type="password" id="nickname" size="30" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span><?php echo $Lang_Classify_Context_Pswcheck_Member; //確認密碼 ?>：</td>
      <td><span id="DealerCheck">
        <label for="pswcheck"></label>
        <input name="pswcheck" type="password" id="pswcheck" size="30" maxlength="20" />
        <span class="confirmRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span><span class="confirmInvalidMsg"><?php echo $Lang_Psw_Check_Error ?></span></span></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="<?php echo $Lang_Classify_Send_OK; ?>"/>
            <input type="reset" name="button2" id="button2" value="<?php echo $Lang_Classify_Send_Cancer; ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form_Dealer" />
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
var sprytextfield3 = new Spry.Widget.ValidationTextField("DealerPsw", "none", {validateOn:["blur"], isRequired:false});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("DealerCheck", "nickname", {validateOn:["blur"]});
//-->
</script>
<?php 
//} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  

