<link rel="stylesheet" href="css/QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch.js"></script>
<script type="text/javascript" src="js/QapTcha.jquery.js"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
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
<?php //if ($DealerRegSelect == "1") { // 判斷是否開放會員註冊功能?>
<div class="post-content">
<form id="form_Dealer" name="form_Dealer" method="POST" action="require_dealer_edit.php">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>帳號資料：</strong><font color="#999999">修改你的帳號資料</font><span style="float:right;"><strong>註冊時間：<font color="#2865A2"><?php echo date('Y-m-d  g:i A',strtotime($row_RecordDealer['regdate'])); ?></font></strong></span></td>
        </tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span>帳號：</td>
      <td>&nbsp;<?php echo $_SESSION['MM_Username_' . $_GET['wshop']] ?></td>
        </tr>
        <tr>
          <td align="right">密碼：</td>
      <td><span id="DealerPsw">
            <input name="nickname" type="password" id="nickname" size="30" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>確認密碼：</td>
      <td><span id="DealerCheck">
        <label for="pswcheck"></label>
        <input name="pswcheck" type="password" id="pswcheck" size="30" maxlength="20" />
        <span class="confirmRequiredMsg">欄位不可為空。</span><span class="confirmInvalidMsg">值不相符。</span></span></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value="送出填寫資料"/>
            <input type="reset" name="button2" id="button2" value="重置填寫資料" />
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
var sprytextfield3 = new Spry.Widget.ValidationTextField("DealerPsw", "none", {validateOn:["blur"], isRequired:false});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("DealerCheck", "nickname", {validateOn:["blur"]});
//-->
</script>
<?php 
//} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  

