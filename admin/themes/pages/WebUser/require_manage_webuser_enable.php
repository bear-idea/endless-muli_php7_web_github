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
	$loginWebname = $_POST['webname'];
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
  if($loginFoundUser_Webname){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
	ob_end_flush(); // 輸出緩衝區結束
    exit;
  }
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Webuser")) {
  $updateSQL = sprintf("UPDATE demo_admin SET name=%s, webname=%s, `level`=%s, notes1=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
   $insertSQLSetting = sprintf("INSERT INTO demo_setting (OptionNewsSelect, OptionFaqSelect, OptionProductSelect, OptionFrilinkSelect, OptionPublishSelect, OptionGuestbookSelect, OptionActivitiesSelect, OptionProjectSelect, OptionArticleSelect, OptionAboutSelect, OptionContactSelect, OptionDfPageSelect, OptionCatalogSelect, OptionCartSelect, OptionRoomSelect, OptionAttractionsSelect, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("0", "int"), // 最新訊息
					   GetSQLValueString("0", "int"), // 常見問答
					   GetSQLValueString("0", "int"), // 商品櫥窗
					   GetSQLValueString("1", "int"), // 友站連結
					   GetSQLValueString("0", "int"), // 發布資訊
					   GetSQLValueString("1", "int"), // 留言訊息
					   GetSQLValueString("0", "int"), // 活動花絮
					   GetSQLValueString("0", "int"), // 工程實績
					   GetSQLValueString("0", "int"), // 文章管理
					   GetSQLValueString("1", "int"), // 關於我們
					   GetSQLValueString("1", "int"), // 聯絡我們
					   GetSQLValueString("1", "int"), // 自訂頁面
					   GetSQLValueString("0", "int"), // 產品型錄
					   GetSQLValueString("0", "int"), // 購物車
					   GetSQLValueString("1", "int"), // 房型展示
					   GetSQLValueString("1", "int"), // 景點導覽
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSetting = mysqli_query($DB_Conn, $insertSQLSetting) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingFr = sprintf("INSERT INTO demo_setting_fr (MSTmpSelect, productlistLock, frilinkLock, alllistLock, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("40", "int"), // 版型選擇
					   GetSQLValueString("0", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("1", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("1", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingFr = mysqli_query($DB_Conn, $insertSQLSettingFr) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingOtr = sprintf("INSERT INTO demo_setting_otr (userid) VALUES (%s)",
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingOtr = mysqli_query($DB_Conn, $insertSQLSettingOtr) or die(mysqli_error($DB_Conn));
  
  // 插入自訂頁面
  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("關於我們", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("房型展示", "text"),
					   GetSQLValueString("Room", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeProject = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("景點推薦", "text"),
					   GetSQLValueString("Attractions", "text"),
					   GetSQLValueString("3", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProject = mysqli_query($DB_Conn, $insertSQLDftypeProject) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeProject = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("訪客交流", "text"),
					   GetSQLValueString("Guestbook", "text"),
					   GetSQLValueString("4", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProject = mysqli_query($DB_Conn, $insertSQLDftypeProject) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("聯絡我們", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("5", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  
  // 插入自訂頁面 - END
  
  // 插入自訂欄位
  $insertSQLTmpColumnTypeMenu = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("alltypelist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("次選單", "text"),
					   GetSQLValueString("次選單", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnTypeMenu = mysqli_query($DB_Conn, $insertSQLTmpColumnTypeMenu) or die(mysqli_error($DB_Conn));
  
  $insertSQLTmpColumnFrilink = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("frilink", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnFrilink = mysqli_query($DB_Conn, $insertSQLTmpColumnFrilink) or die(mysqli_error($DB_Conn));
  
  // 插入自訂欄位 - END
  
  // 插入關於我們資料
  $desc_show_about = "<img src=\"http://www.shop3500.com/images/desc_01.jpg\" width=\"700\" height=\"566\" />";
  $insertSQLAbout = sprintf("INSERT INTO demo_about (title, content, home, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("關於我們", "text"), // 
					   GetSQLValueString($desc_show_about, "text"), // 
					   GetSQLValueString("1", "int"), // 
                       GetSQLValueString($_POST['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultAbout = mysqli_query($DB_Conn, $insertSQLAbout) or die(mysqli_error($DB_Conn));

// --------------------------------------------------------------------------

  $updateGoTo = "manage_webuser.php?Operate=editSuccess&Opt=viewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordWebuser = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordWebuser = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebuser = sprintf("SELECT * FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordWebuser, "int"));
$RecordWebuser = mysqli_query($DB_Conn, $query_RecordWebuser) or die(mysqli_error($DB_Conn));
$row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
$totalRows_RecordWebuser = mysqli_num_rows($RecordWebuser);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">註冊網站使用者 [<?php echo $langname; ?>編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong></h4></td>
        </tr>
      </table>
      
        <form id="form_Webuser" name="form_Webuser" method="POST" action="require_manage_webuser_enable.php">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                <tr>
                    <td width="100" align="right"><span class="Form_Required_Item">*</span>中文名稱：</td>
                  <td><span id="WebuserName">
                      <label>
                        <input name="name" type="text" id="name" value="<?php echo $row_RecordWebuser['name']; ?>" maxlength="30" />
                      </label>
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                </tr>
                  <tr>
                    <td align="right"><span class="Form_Required_Item">*</span>網站域名：</td>
                    <td><span id="WebuserWebName">
                      <label for="webname"></label>
                      <input name="webname" type="text" id="webname" value="<?php echo $row_RecordWebuser['webname']; ?>" maxlength="20" />
                    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
                  </tr>
                <tr>
                    <td align="right" valign="top"><span class="Form_Required_Item">*</span>等級：</td>
        <td><span id="spryselect1">
          <label for="level"></label>
          <select name="level" id="level">
            <option value="" <?php if (!(strcmp("", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>-- 選擇權限 -- </option>
            <option value="superadmin" <?php if (!(strcmp("superadmin", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>最高管理者</option>
            <option value="admin" <?php if (!(strcmp("admin", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>一般會員</option>
          </select>
          <span class="selectRequiredMsg">請選取項目。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">備註：</td>
                    <td><label for="notes1"></label>
                      <span id="WebuserNotes1">
                      <label for="notes1"></label>
                      <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordWebuser['notes1']; ?>" size="50" maxlength="50" />
                    <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button" id="button" value="送出填寫資料" />
                    <input type="reset" name="button2" id="button2" value="重置填寫資料" />
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordWebuser['id']; ?>" /></td>
                  </tr>
              </table>
              <input type="hidden" name="MM_update" value="form_Webuser" />
        </form>
       
      
   
  </div>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("WebuserName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("WebuserNotes1", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("WebuserWebName", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["blur"]});
//-->
</script>
<?php
mysqli_free_result($RecordWebuser);
?>
