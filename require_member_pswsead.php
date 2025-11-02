<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once("inc/inc_function.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="member.php?Opt_Member=regpage&RegMsg=error&lang=" . $_POST['lang'];
  $loginUsername = $_POST['account'];
  $LoginRS__query = sprintf("SELECT account FROM demo_member WHERE account=%s", GetSQLValueString($loginUsername, "text"));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Member")) {
  $insertSQL = sprintf("INSERT INTO demo_member (account, psw, name, nickname, sex, birthday, mail, tel, cellphone, addr1, fax, serviceunits, web, job, indicate, notes1, lang, auth) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString(md5($_POST['psw']), "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['serviceunits'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['auth'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // <!-- ╭─────────────────────────────────────╮ -->
  if($MemberMailAuthSead == '1') {
  // 發送認證信
  $AuthUrl = $DefaultSiteUrl . "regiest/auth.php?account=" . $_POST['account'] . "&auth=" . $_POST['auth'] . "&lang=" . $_POST['lang'];
  $Body = "親愛的 " . $_POST['account'] . " 您好！<br>" 
        . "歡迎您加入『" . $DefaultSiteName . "』會員。<br>"
		. "請啟動您的帳號以完成最後的註冊！以下為您的認證網址！<br><br>"
		. "<a href=\"" . $AuthUrl . "\">"
		. "請在此點擊認證您的帳號 </a><br><br>" 
		. "如果認證信重複寄送，請以最後一封認證信啟動，會員資料將以最終啟動會員帳號的 Email 為準！<br>"
		. "本信件為系統自動發送(請勿回信！！！)";

  $From= "From: " . "=?UTF-8?B?" . base64_encode($DefaultSiteMailAuthor) . "?=" . " <" . $DefaultSiteMail . "> \n\r";
  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
  $Header=$From.$Type;
  $Subject="=?UTF-8?B?" . base64_encode($DefaultSiteMailSubject) . "?=";
	
  mail($_POST['mail'], $Subject, $Body, $Header); 
  }
  //

  $insertGoTo = "login_member.php?Operate=regSuccess&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
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

	var req = Spry.Utils.loadURL("GET","admin/checkform/member_check_repet.php?username="+account, false, myCallBack, {userData: objUserData});
}
//-->
</script>
<div style="background-color:#7a7a7a; padding:5px 1px;" class="rounded {6px}">
    <div style="background-color:#fff; padding:5px;" class="rounded {6px}">
      <!-- ╭─────────────────────────────────────╮ -->
      <form id="form_Member" name="form_Member" method="post" action="require_member_reg.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
      	<tr>
            <td align="center"><?php if ($_GET[RegMsg] == "error") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> 你註冊的帳號已被使用！！請重新註冊！！</div><?php } ?></td>
        </tr>
          <tr>
            <td><h4><strong><font color="#756b5b">註冊會員資料 <span style="display:none">[<?php echo $langname; ?>編輯介面]</span></font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>帳號資料填寫：</strong><font color="#999999">填寫你的登入基本資料</font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>帳號：</td>
      <td><span id="MemberAccount">
      <input name="account" type="text" id="account" size="30" maxlength="30" class="AccountPswWidth"/>
      <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldMinCharsMsg">低於所限制之字數。</span><span class="textfieldMaxCharsMsg">高於所限制之字數。</span></span><font color="#999999">(請輸入6-20字的帳號)</font>
      <input type="button" name="button3" id="button3" value="檢查帳號" onclick="return CheckFields();"/>
      </td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>密碼：</td>
      <td><span id="MemberPsw">
            <input name="psw" type="password" id="psw" size="30" maxlength="20" class="AccountPswWidth"/>
            <span class="passwordRequiredMsg">欄位不可為空。</span><span class="passwordMinCharsMsg">低於所限制之字數。</span><span class="passwordMaxCharsMsg">高於所限制之字數。</span></span><font color="#999999">(請輸入6-20字的密碼)</font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>密碼：</td>
      <td><span id="MemberCheckPsw">
            <input name="checkpsw" type="password" id="checkpsw" size="30" maxlength="20" class="AccountPswWidth"/>
            <span class="confirmRequiredMsg">欄位不可為空。</span><span class="confirmInvalidMsg">所輸入的值與密碼欄位不相符或未輸入密碼。</span></span><font color="#999999">(再次確認您輸入的密碼)</font></td>
        </tr>
        <tr>
          <td align="right"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>個人資料填寫：</strong><font color="#999999">填寫你的個人資料</font></td>
        </tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span>姓名：</td>
      <td><span id="MemberName">
      <label>
        <input name="name" type="text" id="name" size="30" maxlength="30" />
      </label>
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
        <tr>
          <td align="right">暱稱：</td>
      <td><span id="MemberNickname">
            <input name="nickname" type="text" id="nickname" size="30" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>性別：</td>
      <td><span id="MemberSex">
            <label>
              <input type="radio" name="sex" value="男" id="sex_0" />
              男</label>
            <label>
              <input type="radio" name="sex" value="女" id="sex_1" />
              女</label>
            <span class="radioRequiredMsg">請選取你的性別。</span></span></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>生日：</td>
      <td><span id="MemberBirthday">
            <input type="text" name="birthday" id="birthday" />
            <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">輸入的日期格式錯誤。</span></span><font color="#999999">YYYY/MM/DD</font></td>
        </tr>
        <tr>
          <td align="right"><span class="Form_Required_Item">*</span>電子郵件：</td>
      <td><span id="MemberMail">
            <input name="mail" type="text" id="mail" size="50" maxlength="50" />
            <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式輸入錯誤。</span></span><font color="#999999">請確實填寫！！系統將發送認證信到此信箱！！為避免收不到信件，請盡量避免使用免費信箱！！</font></td>
        </tr>
        <tr>
          <td align="right">電話：</td>
      <td><span id="MemberTel">
            <input name="tel" type="text" id="tel" size="20" maxlength="20" />
            <span class="textfieldInvalidFormatMsg">格式無效。</span></span><font color="#999999">Ex: 04-12345678</font></td>
        </tr>
        <tr>
          <td align="right">行動：</td>
      <td><span id="MemberCellphone">
            <input name="cellphone" type="text" id="cellphone" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right">傳真：</td>
      <td><span id="MemberFax">
            <input name="fax" type="text" id="fax" size="20" maxlength="20" />
          </span></td>
        </tr>
        <tr>
          <td align="right">網頁：</td>
      <td><span id="MemberWeb">
            <input name="web" type="text" id="web" size="50" maxlength="50" />
            <span class="textfieldInvalidFormatMsg">格式錯誤。Ex: http://www.myweb.com</span></span></td>
        </tr>
        <tr>
          <td align="right">職稱：</td>
      <td><span id="MemberJob">
            <input name="job" type="text" id="job" size="30" maxlength="30" />
          </span></td>
        </tr>
        <tr>
          <td align="right">服務單位：</td>
      <td><span id="MemberServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " size="50" maxlength="50" />
          </span></td>
        </tr>
        
        <tr>
          <td align="right" valign="top">地址：</td>
      <td><span id="MemberAddr1">
            <input name="addr1" type="text" id="addr1" size="100" maxlength="100" />
          </span></td>
        </tr>
        <tr>
          <td align="right">備註：</td>
          <td><label for="notes1"></label>
      <span id="MemberNotes1">
              <label for="notes1"></label>
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
              <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
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
            <input name="auth" type="hidden" id="auth" value="<?php echo $authcode=substr(md5(uniqid(rand())), 0, 10); ?>" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      
          <input type="hidden" name="MM_insert" value="form_Member" />
      </form>
       
      
   
  </div>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("MemberName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("MemberNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("MemberSex", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("MemberAccount", "none", {validateOn:["blur"], minChars:6, maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("MemberPsw", {validateOn:["blur"], minChars:6, maxChars:20});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("MemberCheckPsw", "psw", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("MemberNickname", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("MemberBirthday", "date", {format:"yyyy/mm/dd", validateOn:["blur"]});
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