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
            <td colspan="2" align="center"><?php if ($_GET[RegMsg] == "error") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> 你註冊的帳號已被使用！！請重新註冊！！</div><?php } ?></td>
        </tr>
        </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>公司資料：</strong><font color="#999999">修改你的公司資料</font></span><strong><span style="float:right;">註冊時間：<font color="#2865A2"><?php echo date('Y-m-d  g:i A',strtotime($row_RecordDealer['regdate'])); ?></font></span></strong></td>
        </tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span>公司寶號：</td>
      <td><span id="DealerName">
            <label>
              <input name="name" type="text" id="name" value="<?php echo $row_RecordDealer['name']; ?>" size="30" maxlength="30" />
            </label>
            <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>聯絡人：</td>
      <td><span id="DealerNickname">
            <input name="nickname" type="text" id="nickname" value="<?php echo $row_RecordDealer['nickname']; ?>" size="30" maxlength="20" />
            <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>性別：</td>
      <td><span id="DealerSex">
            <label>
              <input <?php if (!(strcmp($row_RecordDealer['sex'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" value="男" id="sex_0" />
              男</label>
            <label>
              <input <?php if (!(strcmp($row_RecordDealer['sex'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" value="女" id="sex_1" />
              女</label>
            <span class="radioRequiredMsg">請選取你的性別。</span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>電子郵件：</td>
          <td><span id="DealerMail">
            <input name="mail" type="text" id="mail" value="<?php echo $row_RecordDealer['mail']; ?>" size="50" maxlength="50" />
            <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式輸入錯誤。</span></span></td>
        </tr>
        <tr>
          <td align="right">電話：</td>
      <td><span id="DealerTel">
            <input name="tel" type="text" id="tel" value="<?php echo $row_RecordDealer['tel']; ?>" size="20" maxlength="20" />
            <span class="textfieldInvalidFormatMsg">格式無效。</span></span><font color="#999999">00-00000000</font></td>
        </tr>
        <tr>
          <td align="right">行動：</td>
      <td><span id="DealerCellphone">
            <input name="cellphone" type="text" id="cellphone" value="<?php echo $row_RecordDealer['cellphone']; ?>" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right">傳真：</td>
      <td><span id="DealerFax">
            <input name="fax" type="text" id="fax" value="<?php echo $row_RecordDealer['fax']; ?>" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right">貴公司網站：</td>
      <td><span id="DealerWeb">
            <input name="web" type="text" id="web" value="<?php echo $row_RecordDealer['web']; ?>" size="50" maxlength="50" />
            <span class="textfieldInvalidFormatMsg">格式錯誤。Ex: http://www.myweb.com</span></span></td>
        </tr>
        <tr>
          <td align="right">行業別：</td>
      <td><span id="DealerJob">
            <input name="job" type="text" id="job" value="<?php echo $row_RecordDealer['job']; ?>" size="30" maxlength="30" />
          </span></td>
        </tr>
        <tr>
          <td align="right">營業項目：</td>
      <td><span id="DealerServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " value="<?php echo $row_RecordDealer['serviceunits']; ?>" size="50" maxlength="150" />
          </span></td>
        </tr>
        
        <tr>
          <td align="right" valign="top">地址：</td>
      <td><span id="DealerAddr1">
            <input name="addr1" type="text" id="addr1" value="<?php echo $row_RecordDealer['addr1']; ?>" size="100" maxlength="100" />
          </span></td>
        </tr>
        <tr>
          <td align="right">備註：</td>
          <td><label for="notes1"></label>
      <span id="DealerNotes1">
              <label for="notes1"></label>
              <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordDealer['notes1']; ?>" size="50" maxlength="50" />
              <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="送出填寫資料"/>
            <input type="reset" name="button2" id="button2" value="重置填寫資料" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDealer['id']; ?>" />
            <input name="auth" type="hidden" id="auth" value="<?php echo $row_RecordDealer['auth']; ?>" />
            <input name="indicate" type="hidden" id="indicate" value="<?php echo $row_RecordDealer['indicate']; ?>" />
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
		txtLock : '移動按鈕拖曳至右方以解鎖按鈕',
		txtUnlock : '按鈕解鎖',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : 'Qaptcha.jquery.php'
	});
  });
</script>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("DealerName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("DealerNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("DealerSex", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("DealerNickname", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("DealerMail", "email", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("DealerTel", "phone_number", {isRequired:false, validateOn:["blur"], format:"phone_custom", pattern:"00-00000000"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("DealerCellphone", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("DealerAddr1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("DealerFax", "none", {isRequired:false, validateOn:["blur"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("DealerWeb", "url", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("DealerJob", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("DealerServiceunits", "none", {validateOn:["blur"], isRequired:false});
//-->
</script>

