<?php require_once('../../../Connections/DB_Conn.php'); ?>
<?php require_once("../../../inc/inc_function.php"); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

// 取得是否註冊
$colname_RecordSystemConfigFr = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordSystemConfigFr = $_SESSION['userid'];
}

$query_RecordSystemConfigFr = sprintf("SELECT MemberRegSelect FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordSystemConfigFr, "int"));
$RecordSystemConfigFr = mysqli_query($DB_Conn, $query_RecordSystemConfigFr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigFr = mysqli_fetch_assoc($RecordSystemConfigFr);
$totalRows_RecordSystemConfigFr = mysqli_num_rows($RecordSystemConfigFr);

$MemberRegSelect = $row_RecordSystemConfigFr['MemberRegSelect']; // 註冊功能是否開啟

if (isset($_POST['Wshop_account']) && isset($_SESSION["line_id"])  && isset($_SESSION['success_line_login_backstage']) ) {
  $loginUsername=$_POST['Wshop_account'];
  $password=$_POST['psw'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);
  $MM_redirectLoginFailed = "binding.php?errMsg=y";
  $MM_redirectLoginHaveThirdpartyID = "binding.php?errMsg=h";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level, lineid, userid FROM demo_member WHERE account=%s && psw=%s && userid=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString(md5($password), "text"), GetSQLValueString($_SESSION['userid'], "int")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysqli_result($LoginRS,0,'level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username_' . $_GET['wshop']] = $loginUsername;
    $_SESSION['MM_UserGroup_' . $_GET['wshop']] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	// 檢查是否有重覆ID
	if($_SESSION["line_id"] != "") {
		$colname_RecordThirdparty = "-1";
		if (isset($_SESSION["line_id"])) {
		  $colname_RecordThirdparty = $_SESSION["line_id"];
		}
		$query_RecordThirdparty = sprintf("SELECT lineid FROM demo_admin WHERE lineid = %s", GetSQLValueString($colname_RecordThirdparty, "text"));
		$RecordThirdparty = mysqli_query($DB_Conn, $query_RecordThirdparty) or die(mysqli_error($DB_Conn));
		$row_RecordThirdparty = mysqli_fetch_assoc($RecordThirdparty);
		$totalRows_RecordThirdparty = mysqli_num_rows($RecordThirdparty);
	}
	// 紀錄 LINE 第三方 ID
	if($row_LoginRS['lineid'] == "" && $totalRows_RecordThirdparty == 0) {
	$updateThirdpartySQL = sprintf("UPDATE demo_admin SET lineid=%s WHERE account=%s",
                       GetSQLValueString($_SESSION["line_id"], "text"),
                       GetSQLValueString($loginUsername, "text"));
	}else if($totalRows_RecordThirdparty > 0){
		$_SESSION['MM_Username_' . $_GET['wshop']] = "";
        $_SESSION['MM_UserGroup_' . $_GET['wshop']] = "";	
		header("Location: ". $MM_redirectLoginHaveManyThirdpartyID );
	}else{
		$_SESSION['MM_Username_' . $_GET['wshop']] = "";
    $_SESSION['MM_UserGroup_' . $_GET['wshop']] = "";	
		header("Location: ". $MM_redirectLoginHaveThirdpartyID );
	}

	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$ResultThirdparty = mysqli_query($DB_Conn, $updateThirdpartySQL) or die(mysqli_error($DB_Conn));
	
	$updateSQL = sprintf("UPDATE demo_member SET logdate=NOW() WHERE lineid=%s",
                       GetSQLValueString($_SESSION["line_id"], "text"));
	//mysqli_select_db($database_DB_Conn, $DB_Conn);	
	$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<?php //require_once("inc_setting.php"); ?>
<?php //require_once("../inc/inc_function.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>後台管理系統</title>
<!-- mobile settings -->
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
<!-- CORE CSS -->
<link href="<?php echo $SiteBaseUrl; ?>admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- THEME CSS -->
<link href="<?php echo $SiteBaseUrl; ?>admin/assets/css/essentials.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>admin/assets/css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>admin/assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
<link rel="stylesheet" type="text/css" href="../../../fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="smoothscroll enable-animation">
<div id="wrapper" style="background-image:url(<?php echo $SiteBaseUrl; ?>assets/images/patterns/pattern11.png)">    

<!-- HEADER -->
<header id="header">

    <!-- Logo -->
    <span class="logo pull-left">
       
    </span>

    

</header>
<!-- /HEADER -->  
<div class="padding-15">

    <div class="login-box" style="margin-top:5%;">
        
        
        <!-- login form -->
        <form id="ADlogin" name="ADlogin" method="post" action="<?php echo $loginFormAction; ?>" class="sky-form boxed">
            <header>
            <div>您好!! <i class="icon-line"></i> <?php echo $_SESSION["line_name"]; ?></div>
            </header>
			<?php if ($_GET['errMsg'] == "n") { ?>
            <div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
                您尚未綁定您的 LINE 帳號<br>
                請在下方輸入您欲連結的官網帳號
            </div>
			<?php } ?>
            <?php if ($_GET['errMsg'] == "y") { ?>
            <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                <i class="fa fa-times-circle"></i> 帳號或密碼錯誤！！請重新輸入！！
            </div>
            <?php } ?>
            <?php if ($_GET['errMsg'] == "h") { ?>
            <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                <i class="fa fa-times-circle"></i> 此帳號已有綁訂的 LINE 帳號！！ <br>
請確認您登入的 LINE 是否正確！！ 
            </div>
            <?php } ?>
			<?php if ($_GET['errMsg'] == "m") { ?>
            <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                <i class="fa fa-times-circle"></i> 此 LINE 帳號已註冊過！！ <br>
請更換您登入的 LINE 帳號！！ 
            </div>
            <?php } ?>
        
            <fieldset>	
            
                <section>
                    <label class="label">連結帳號</label>
                    <label class="input">
                        <i class="icon-append fa fa-user" aria-hidden="true"></i>
                        <input name="Wshop_account" id="Wshop_account" value="<?php echo $_COOKIE['w_user']; ?>">
                        <span class="tooltip tooltip-top-right">請輸入帳號</span>
                    </label>
                </section>
                
                <section>
                    <label class="label">密碼</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input name="psw" type="password" id="psw" value="<?php echo $_COOKIE['w_psw']; ?>">
                        <b class="tooltip tooltip-top-right">請輸入密碼</b>
                    </label>
                    
                </section>

            </fieldset>

            <footer>
              <button type="submit" class="btn btn-primary pull-right">綁定帳號</button>
                <div class="forgot-password pull-left">
                    <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_SESSION['login_wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable); ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 返回登入頁</a> <br />
              </div>
            </footer>
        </form>
        <?php if ($MemberRegSelect == "1") { // 判斷是否開放會員註冊功能?>
        <div class="margin-bottom-20 text-center margin-top-20">
				&ndash; <b>OR</b> &ndash;
			</div>
        <form id="ADReg" name="ADReg" method="post" action="reg.php" class="">
            <div class="text-center">
              <button type="submit" class="btn btn-block btn-social btn-line margin-top-10"><i class="icon-line"></i> 使用此 LINE 註冊新帳號</button>
            </div>
        <input name="MM_insert" type="hidden" id="MM_insert" value="1">
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $_SESSION['login_wshop']; ?>">
        </form>
        <?php } // 判斷是否開放會員註冊功能?>
    </div>

</div>

</div>

<footer id="footer" class="sticky">
	<div class="copyright" style="background-color:#333; color:#FFF; text-align:center; padding:10px;">
		<div class="container_full">
			<?php //require_once("../../../require_manage_footer_login.php"); ?>
		</div>
	</div>
</footer>



<!-- JAVASCRIPT FILES -->
<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-2.2.3.min.js"></script>
<!--<script type="text/javascript" src="assets/js/app.js"></script>-->
        
</body>
</html>