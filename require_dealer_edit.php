<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('require_dealer_limit_login.php'); // 限制存取頁面?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Dealer")) {
  $updateSQL = sprintf("UPDATE demo_dealer SET name=%s, nickname=%s, sex=%s, mail=%s, auth=%s, tel=%s, cellphone=%s, addr1=%s, fax=%s, serviceunits=%s, web=%s, job=%s, indicate=%s, notes1=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['auth'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['serviceunits'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $updateGoTo = "dealer.php?wshop=" . $_POST['wshop'] . "&Opt=editpage&Operate=editSuccess&Opt=viewpage&lang=" . $_SESSION['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得資料 */
$colname_RecordDealer = "-1";
if (isset($_SESSION['MM_Username_' . $_GET['wshop']])) {
  $colname_RecordDealer = $_SESSION['MM_Username_' . $_GET['wshop']];
}
$collang_RecordDealer = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDealer = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDealer = sprintf("SELECT * FROM demo_dealer WHERE account = %s && lang = %s", GetSQLValueString($colname_RecordDealer, "text"),GetSQLValueString($collang_RecordDealer, "text"));
$RecordDealer = mysqli_query($DB_Conn, $query_RecordDealer) or die(mysqli_error($DB_Conn));
$row_RecordDealer = mysqli_fetch_assoc($RecordDealer);
$totalRows_RecordDealer = mysqli_num_rows($RecordDealer);

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="dealer.php?wshop=" . $_POST['wshop'] . "&Opt=editpage&RegMsg=error&lang=" . $_SESSION['lang'];
  $loginUsername = $_POST['account'];
  $LoginRS__query = sprintf("SELECT account FROM demo_dealer WHERE account=%s", GetSQLValueString($loginUsername, "text"));
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
?>
<?php if ($MSTMP == 'default') { ?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Dealer_UserDate; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
	  </div>
      
      <div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
      <form id="form_Dealer" name="form_Dealer" method="POST" action="require_dealer_edit.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      	<tr>
            <td colspan="2" align="center"><?php if ($_GET[RegMsg] == "error") { ?><div class="ErrorInputWord"><i class="fa fa-times-circle"></i> 你註冊的帳號已被使用！！請重新註冊！！</div><?php } ?></td>
        </tr>
          <tr>
            <td width="50%"><h4>&nbsp;</h4></td>
            <td align="right"><strong>註冊時間：<font color="#2865A2"><?php echo date('Y-m-d  g:i A',strtotime($row_RecordDealer['regdate'])); ?></font></strong></td>
        </tr>
         
        </table>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
        <tr>
          <td colspan="2"><img src="images/sicon/icon.gif" width="8" height="11" /> <strong>個人資料：</strong><font color="#999999">修改你的個人資料</font></td>
        </tr>
        <tr>
          <td width="100" align="right"><span class="Form_Required_Item">*</span>姓名：</td>
      <td><span id="DealerName">
            <label>
              <input name="name" type="text" id="name" value="<?php echo trim($row_RecordDealer['name']); ?>" size="30" maxlength="30" />
            </label>
            <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
        </tr>
        <tr>
          <td align="right">暱稱：</td>
      <td><span id="DealerNickname">
            <input name="nickname" type="text" id="nickname" value="<?php echo $row_RecordDealer['nickname']; ?>" size="30" maxlength="20" />
          </span></td>
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
          <td align="right"><span class="Form_Required_Item">*</span>生日：</td>
      <td><span id="DealerBirthday">
            <input name="birthday" type="text" id="birthday" value="<?php echo $row_RecordDealer['birthday']; ?>" />
            <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">輸入的日期格式錯誤。</span></span><font color="#999999">YYYY-MM-DD</font></td>
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
          <td align="right">網頁：</td>
      <td><span id="DealerWeb">
            <input name="web" type="text" id="web" value="<?php echo $row_RecordDealer['web']; ?>" size="50" maxlength="50" />
            <span class="textfieldInvalidFormatMsg">格式錯誤。Ex: http://www.myweb.com</span></span></td>
        </tr>
        <tr>
          <td align="right">職稱：</td>
      <td><span id="DealerJob">
            <input name="job" type="text" id="job" value="<?php echo $row_RecordDealer['job']; ?>" size="30" maxlength="30" />
          </span></td>
        </tr>
        <tr>
          <td align="right">服務單位：</td>
      <td><span id="DealerServiceunits">
            <input name="serviceunits" type="text" id="serviceunits " value="<?php echo $row_RecordDealer['serviceunits']; ?>" size="50" maxlength="50" />
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
      
      
      
       
     
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("DealerName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("DealerNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryradio2 = new Spry.Widget.ValidationRadio("DealerSex", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("DealerNickname", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("DealerBirthday", "date", {format:"yyyy-mm-dd", validateOn:["blur"]});
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
<?php } else { ?>
<?php include($TplPath . "/dealer_edit.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordDealer);
?>
