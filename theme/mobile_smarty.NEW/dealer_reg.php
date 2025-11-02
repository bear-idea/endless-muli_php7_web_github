<link rel="stylesheet" href="css/QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch.js"></script>
<script type="text/javascript" src="js/QapTcha.jquery.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />

<h4 class="classic-title"><span><?php echo $Lang_Content_Title_Dealer_Reg; // 標題文字 ?></span></h4>	

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
<?php if ($DealerRegSelect == "1") { // 判斷是否開放會員註冊功能?>
<div class="post-content">
<form id="form_Dealer" name="form_Dealer" method="post" action="require_dealer_reg.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      	<tr>
            <td align="center"><?php if(isset($_GET['RegMsg']) && $_GET['RegMsg'] == "error") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> 你註冊的帳號已被使用！！請重新註冊！！</div><?php } ?><?php if ($_GET['RegMsg'] == "CodeError") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> 驗證碼錯誤！！</div><?php } ?></td>
        </tr>
      </table>
      
      <div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>帳號資料填寫：</strong><font color="#999999">填寫你的登入基本資料</font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>帳號：</td>
      <td><span id="DealerAccount">
      <input name="account" type="text" id="account" size="30" maxlength="30" class="AccountPswWidth"/>
      <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldMinCharsMsg">低於所限制之字數。</span><span class="textfieldMaxCharsMsg">高於所限制之字數。</span></span><font color="#999999">(請輸入6-20字的帳號)</font>
      <input type="button" name="button3" id="button3" value="檢查帳號" onclick="return CheckFields();"/>
      </td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>密碼：</td>
      <td><span id="DealerPsw">
            <input name="psw" type="password" id="psw" size="30" maxlength="20" class="AccountPswWidth"/>
            <span class="passwordRequiredMsg">欄位不可為空。</span><span class="passwordMinCharsMsg">低於所限制之字數。</span><span class="passwordMaxCharsMsg">高於所限制之字數。</span></span><font color="#999999">(請輸入6-20字的密碼)</font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>驗證密碼：</td>
      <td><span id="DealerCheckPsw">
            <input name="checkpsw" type="password" id="checkpsw" size="30" maxlength="20" class="AccountPswWidth"/>
            <span class="confirmRequiredMsg">欄位不可為空。</span><span class="confirmInvalidMsg">所輸入的值與密碼欄位不相符或未輸入密碼。</span></span><font color="#999999">(再次確認您輸入的密碼)</font></td>
        </tr>
        <tr>
          <td align="right"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>公司資料填寫：</strong><font color="#999999">填寫你的公司資料</font></td>
        </tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span>公司寶號：</td>
      <td><span id="DealerName">
      <label>
        <input name="name" type="text" id="name" size="30" maxlength="30" />
      </label>
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
        <tr>
          <td align="right">聯絡人：</td>
      <td><span id="DealerNickname">
            <input name="nickname" type="text" id="nickname" size="30" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>性別：</td>
      <td><span id="DealerSex">
            <label>
              <input name="sex" type="radio" id="sex_0" value="男" checked="checked" />
              男</label>
            <label>
              <input type="radio" name="sex" value="女" id="sex_1" />
              女</label>
            <span class="radioRequiredMsg">請選取你的性別。</span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>電子郵件：</td>
          <td><span id="DealerMail">
            <input name="mail" type="text" id="mail" size="50" maxlength="50" />
            <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式輸入錯誤。</span></span><font color="#999999"><br />
              請確實填寫！！
              密碼忘記會以此信箱寄送！使用 Yahoo、hotmail 等免費信箱，密碼信有可能被誤判為垃圾信，請先至「垃圾信匣」查看。
              <?php if ($DealerMailAuthSead == '1') {?>
              系統將發送認證信到此信箱！！<?php } ?></font></td>
        </tr>
        <tr>
          <td align="right">電話：</td>
      <td><span id="DealerTel">
            <input name="tel" type="text" id="tel" size="20" maxlength="20" />
            <span class="textfieldInvalidFormatMsg">格式無效。</span></span><font color="#999999">Ex: 04-12345678</font></td>
        </tr>
        <tr>
          <td align="right">行動：</td>
      <td><span id="DealerCellphone">
            <input name="cellphone" type="text" id="cellphone" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right">傳真：</td>
      <td><span id="DealerFax">
            <input name="fax" type="text" id="fax" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right">貴公司網站：</td>
      <td><span id="DealerWeb">
            <input name="web" type="text" id="web" size="50" maxlength="50" />
            <span class="textfieldInvalidFormatMsg">格式錯誤。Ex: http://www.myweb.com</span></span></td>
        </tr>
        <tr>
          <td align="right">行業別：</td>
      <td><span id="DealerJob">
            <input name="job" type="text" id="job" size="30" maxlength="30" />
          </span></td>
        </tr>
        <tr>
          <td align="right">營業項目：</td>
      <td><span id="DealerServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " size="50" maxlength="150" />
          </span></td>
        </tr>
        
        <tr>
          <td align="right" valign="top">地址：</td>
      <td><span id="DealerAddr1">
            <input name="addr1" type="text" id="addr1" size="100" maxlength="100" />
          </span></td>
        </tr>
        <tr>
          <td align="right">備註：</td>
          <td>
      <span id="DealerNotes1">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
              <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
        <tr>
              <td valign="center" align="right"><span class="columnName"><span class="Form_Required_Item">*</span> <?php echo "解鎖"; //解鎖 ?> :</span></td>
              <td valign="center" >
              <p>
                        <img id="siimage" style="border: 1px solid #000; margin-right: 15px" src="securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left" />
                        <object type="application/x-shockwave-flash" data="securimage/securimage_play.swf?icon_file=securimage/images/audio_icon.png&amp;audio_file=securimage/securimage_play.php" height="32" width="32" wmode="transparent">
                        <param name="movie" value="securimage/securimage_play.swf?icon_file=securimage/images/audio_icon.png&amp;audio_file=securimage/securimage_play.php" wmode="transparent" height="32" width="32"/>
                        </object>
                        &nbsp;
                        <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = 'securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="securimage/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()" align="bottom" border="0" /></a><br />
                        <strong>Enter Code*:</strong><br />
                         <?php echo @$_SESSION['ctform']['captcha_error'] ?><span id="Ct_Captcha">
                         <input type="text" name="ct_captcha" size="12" maxlength="16" id="ct_captcha"/>
                         <span class="textfieldRequiredMsg">需要有一個值。</span></span></p>
              </td>
                              </tr>
        <tr>
                     <td align="right"><span class="Form_Required_Item">*</span>驗證：</td>
                     <td><div class="QapTcha"></div></td>
                   </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="送出填寫資料"/>
            <input type="reset" name="button2" id="button2" value="重置填寫資料" />
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

<script type="text/javascript">
$(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '移動按鈕拖曳至右方以解鎖按鈕',
		txtUnlock : '按鈕解鎖',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : 'Qaptcha.jquery.php'
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
var sprytextfield7 = new Spry.Widget.ValidationTextField("DealerTel", "phone_number", {isRequired:false, validateOn:["blur"], format:"phone_custom", pattern:"00-00000000"});
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189">抱歉！！目前暫不提供會員註冊功能！</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<br />
<br />
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
