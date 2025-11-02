<?php require_once('../../../../Connections/DB_Conn.php'); ?>
<?php require_once("../../../../inc/inc_function.php"); ?>
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

if (isset($_POST['Wshop_account']) && isset($_SESSION["line_id"])  && isset($_SESSION['success_line_login_backstage']) ) {
  $loginUsername=$_POST['Wshop_account'];
  $password=$_POST['psw'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "../../../index.php";
  $MM_redirectLoginFailed = "binding.php?errMsg=y";
  $MM_redirectLoginHaveThirdpartyID = "binding.php?errMsg=h";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level, lineid FROM demo_admin WHERE account=%s AND psw=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysqli_result($LoginRS,0,'level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

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
		$_SESSION['MM_Username'] = "";
        $_SESSION['MM_UserGroup'] = "";	
		header("Location: ". $MM_redirectLoginHaveManyThirdpartyID );
	}else{
		$_SESSION['MM_Username'] = "";
    $_SESSION['MM_UserGroup'] = "";	
		header("Location: ". $MM_redirectLoginHaveThirdpartyID );
	}

	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$ResultThirdparty = mysqli_query($DB_Conn, $updateThirdpartySQL) or die(mysqli_error($DB_Conn));
		
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
<head>
	<meta charset="utf-8" />
    <title>後台管理系統 - Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="robots" content="noindex,nofollow" />
	<meta content="" name="description" />
	<meta content="" name="author" />
<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />-->
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/default/style.min.css" rel="stylesheet" />
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/css/default/theme/default.min.css" rel="stylesheet" id="theme" />
    <link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
    <link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/parsley/src/parsley.min.css" rel="stylesheet" />
    <!-- ================== END NECESSARY ALL PAGE JS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/js-cookie/js.cookie.min.js"></script>
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/js/theme/default.min.js"></script>
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/js/apps.min.js"></script>
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/parsley/dist/parsley.min.js"></script>
    <script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/parsley/dist/i18n/zh_tw.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
    <!-- ================== END NECESSARY ALL PAGE JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/js/demo/login-v2.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // ==========================================================================================================================
        // 建立 Socket IO 連線
        // ==========================================================================================================================
		
		var nodejs_server = "<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . (empty($_SERVER["HTTPS"]) ? ":8085" : ":8082"); ?>";
		var socket = io.connect(nodejs_server);
        "undefined" != typeof console && console.log("user enter via mobile");
        // ==========================================================================================================================

        "undefined" != typeof console && console.log("enter mobile page");
		
		
        socket.emit("send", {
            key: "<?php echo $_GET['key'];?>",
            act: "enter",
			qrid: "<?php echo $_SESSION["line_id"]; ?>",
			qrby: "line"
        });

        $("#change_btn").click(function(){
            "undefined" != typeof console && console.log("send change color command");
            socket.emit("send", {
                key: "<?php echo $_GET['key'];?>",
                act: "changebg"
            });
        });

    });
    </script>
</head>
<body class="pace-top">

    <div class="login-cover">
	    <div class="login-cover-image" style="background-image: url(../../../images/login_bg-3.jpg)" data-id="login-cover-image"></div>
	    <div class="bg-aqua-transparent-1"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login bg-aqua-transparent-6 animated fadeInDown">
            <!-- begin brand -->
            <div class="login-header">
                <img src="../../../images/loginpic.png" width="263" height="95">
<div class="icon">
          <i class="fa fa-lock"></i>
        </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <?php if ($_GET['errMsg'] == "n") { ?>
                <div class="alert alert-warning fade show m-b-10">
                    <span class="close" data-dismiss="alert">×</span>
                     <i class="fa fa-times-circle"></i> 您尚未綁定您的 LINE 帳號<br>請在下方輸入您欲連結的官網帳號
                </div>
                <?php } ?>
                
                <?php if ($_GET['errMsg'] == "y") { ?>
                <div class="alert alert-danger fade show m-b-10">
                    <span class="close" data-dismiss="alert">×</span>
                     <i class="fa fa-times-circle"></i> 帳號或密碼錯誤！！請重新輸入！！
                </div>
                <?php } ?>
                
                <?php if ($_GET['errMsg'] == "h") { ?>
                <div class="alert alert-danger fade show m-b-10">
                    <span class="close" data-dismiss="alert">×</span>
                     <i class="fa fa-times-circle"></i> 此帳號已有綁訂的 LINE 帳號！！ <br>請確認您登入的 LINE 是否正確！！ 
                </div>
                <?php } ?>
                
                <?php if ($_GET['errMsg'] == "m") { ?>
                <div class="alert alert-danger fade show m-b-10">
                    <span class="close" data-dismiss="alert">×</span>
                     <i class="fa fa-times-circle"></i> 此 LINE 帳號已註冊過！！ <br>請更換您登入的 LINE 帳號！！
                </div>
                <?php } ?>
                
                <div class="note note-secondary m-b-15">
                    <b>您好!! <i class="fab fa-line"></i> <?php echo $_SESSION["line_name"]; ?></b>
                </div>
                
                <form id="ADlogin" name="ADlogin" method="post" action="<?php echo $loginFormAction; ?>" data-parsley-validate="">
                    <div class="form-group">
                    
                        <input type="text" name="Wshop_account" id="Wshop_account" class="form-control form-control-lg" placeholder="連結帳號" value="<?php echo $_COOKIE['w_user']; ?>" required />
                    
                    </div>
                    <div class="form-group">
                        <input name="psw" type="password" id="psw" value="<?php echo $_COOKIE['w_psw']; ?>" class="form-control form-control-lg" placeholder="密碼" required />
                    </div>
                    
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-default btn-block btn-lg">綁定帳號</button>
                    </div>
                    <div class="m-t-20 m-b-20">
                        <a href="../../../index.php" class="text-silver-lighter"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 返回登入頁</a>
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->

        <?php //require_once("require_manage_footer_login.php"); ?>
	</div>
	<!-- end page container -->



<script>
	$(document).ready(function() {
		App.init();
		//LoginV2.init();
	});
</script>
        
</body>
</html>