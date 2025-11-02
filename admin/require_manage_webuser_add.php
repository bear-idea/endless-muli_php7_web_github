<?php require_once('../Connections/DB_Conn.php'); ?>
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

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
	$MM_dupKeyRedirect="manage_webuser.php?wshop=&Opt=addpage&RegMsg=error&lang=" . $_POST['lang'];
	$loginUsername = $_POST['account'];
	$loginWebname = $_POST['webname'];
	$LoginRS__query = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($loginUsername, "text"));
	$LoginRS__query_Webname = sprintf("SELECT * FROM demo_admin WHERE webname = %s", GetSQLValueString($loginWebname, "text"));
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
	$row_LoginRS = mysqli_fetch_assoc($LoginRS);
	$totalRows_LoginRS = mysqli_num_rows($LoginRS);
	$loginFoundUser = mysqli_num_rows($LoginRS); //取得結果中列的數目
	
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$LoginRS_Webname=mysqli_query($DB_Conn, $LoginRS__query_Webname) or die(mysqli_error($DB_Conn));
	$row_LoginRS_Webname = mysqli_fetch_assoc($LoginRS_Webname);
	$totalRows_LoginRS_Webname = mysqli_num_rows($LoginRS_Webname);
	$loginFoundUser_Webname = mysqli_num_rows($LoginRS_Webname); //取得結果中列的數目

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser || $loginFoundUser_Webname){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
	ob_end_flush(); // 輸出緩衝區結束
    exit;
  }
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Webuser")) {
  $insertSQL = sprintf("INSERT INTO demo_admin (account, psw, name, webname, `level`, notes1) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前新增資料
	$colname_RecordWebuserUserid = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordWebuserUserid = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWebuserUserid = sprintf("SELECT id FROM demo_admin WHERE webname = %s", GetSQLValueString($colname_RecordWebuserUserid, "text"));
	$RecordWebuserUserid = mysqli_query($DB_Conn, $query_RecordWebuserUserid) or die(mysqli_error($DB_Conn));
	$row_RecordWebuserUserid = mysqli_fetch_assoc($RecordWebuserUserid);
	$totalRows_RecordWebuserUserid = mysqli_num_rows($RecordWebuserUserid);

	//echo $row_RecordWebuserUserid['id']; //抓取之id直
  // 插入設定檔案
  $insertSQLSetting = sprintf("INSERT INTO demo_setting (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSetting = mysqli_query($DB_Conn, $insertSQLSetting) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingFr = sprintf("INSERT INTO demo_setting_fr (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingFr = mysqli_query($DB_Conn, $insertSQLSettingFr) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingOtr = sprintf("INSERT INTO demo_setting_otr (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingOtr = mysqli_query($DB_Conn, $insertSQLSettingOtr) or die(mysqli_error($DB_Conn));
  

  $insertGoTo = "manage_webuser.php?Operate=addSuccess&Opt=viewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增網站使用者 [<?php echo $langname; ?>編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      <?php 
	  switch($_GET['RegMsg']) 
	  {
		  case "error":
		  	echo "<div class=\"ErrorTipMessage\">帳號或網站域名重複！！</div><br />\n";
			break;
	  }
	  
	  ?>
        <form id="form_Webuser" name="form_Webuser" method="post" action="require_manage_webuser_add.php">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>中文名稱：</td>
                  <td><span id="WebuserName">
                      <label>
                        <input name="name" type="text" id="name" maxlength="30" />
                      </label>
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>網站域名：</td>
                    <td><span id="WebuserWebName">
                      <label for="webname"></label>
                      <input name="webname" type="text" id="webname" maxlength="20" onblur="this.value = this.value.toLowerCase();"/>
                    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>帳號：</td>
                    <td><span id="sprytextfield3">
                      <label for="account"></label>
                      <input name="account" type="text" id="account" maxlength="20" onblur="this.value = this.value.toLowerCase();"/>
                    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>密碼：</td>
                  <td><span id="sprytextfield5">
                    <label for="psw"></label>
                    <input name="psw" type="password" id="psw" maxlength="20" />
                    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="Form_Required_Item">*</span>等級：</td>
        <td><span id="spryselect1">
          <label for="level"></label>
          <select name="level" id="level">
            <option>-- 選擇權限 -- </option>
            <option value="superadmin">最高管理者</option>
            <option value="admin">一般會員</option>
          </select>
          <span class="selectRequiredMsg">請選取項目。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">備註：</td>
                    <td><label for="notes1"></label>
                      <span id="WebuserNotes1">
                      <label for="notes1"></label>
                      <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料" />
                    <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" /></td>
                  </tr>
              </table>
              <input type="hidden" name="MM_insert" value="form_Webuser" />
        </form>
       
      
   
  </div>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("WebuserName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("WebuserNotes1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("WebuserWebName", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
//-->
</script>
