<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

$SiteFileUrlName = pathinfo($_SERVER['PHP_SELF']); // 網站放置位置 echo $SiteFileUrlName['dirname']
$SiteFileUrl = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . $SiteFileUrlName['dirname']; // 網站放置位置

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Wshop_account'])) {
  $loginUsername=$_POST['Wshop_account'];
  $password=$_POST['psw'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php?errMsg=y";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level FROM demo_admin WHERE account=%s AND psw=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
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
	
	// 記住帳密
	if($_POST['rember_check'] == '1') {
		setcookie("w_user", $_POST['Wshop_account'], time()+3600*24*30);
		setcookie("w_psw", $_POST['psw'], time()+3600*24*30);
	}
	
	$updateSQL = sprintf("UPDATE demo_admin SET logindate=%s, logincount=logincount+1 WHERE account=%s",
                       GetSQLValueString(date("Y-m-d H:i:s"), "date"),
                       GetSQLValueString($_POST['Wshop_account'], "text"));
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
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-Hant">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
    <title>後台管理系統 - Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="robots" content="noindex,nofollow" />
	<meta content="" name="description" />
	<meta content="" name="author" />
<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<!--<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />
	<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
	<?php //if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>
	<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style.min.css" rel="stylesheet" />
	<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/theme/default.min.css" rel="stylesheet" id="theme" />
    <link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
    <link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/src/parsley.min.css" rel="stylesheet" />
    <!-- ================== END NECESSARY ALL PAGE JS ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/dist/parsley.min.js"></script>
    <script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/dist/i18n/zh_tw.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
    <!-- ================== END NECESSARY ALL PAGE JS ================== --> 

<script src="<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . (empty($_SERVER["HTTPS"]) ? ":8085" : ":8082"); ?>/socket.io/socket.io.js" type="text/javascript"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js" type="text/javascript"></script>-->
<?php 
/* 產生QRCODE */
$fb_qr_url = $SiteFileUrl . "/Thirdparty/facebook/oauth/login.php"; 
$line_qr_url = $SiteFileUrl . "/Thirdparty/line/oauth/login.php"; 
$google_qr_url = $SiteFileUrl . "/Thirdparty/google/oauth/login.php"; 
?>
<script type="text/javascript">
            // 用來產生類似 GUID 的字串
            function S4() {
               return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
            }

            function NewGuid() {
               return (S4()+S4());
            }

            $(document).ready(function(){

                var key = NewGuid();
                console.log(key);
				var fb_qr_url = encodeURIComponent("<?php echo $fb_qr_url; ?>");
				var line_qr_url = encodeURIComponent("<?php echo $line_qr_url; ?>");
				var google_qr_url = encodeURIComponent("<?php echo $google_qr_url; ?>");
                $("#qrcode_fb").append("<img src='https://chart.apis.google.com/chart?chs=312x312&cht=qr&chl=" + fb_qr_url + "?key=" + key + "&choe=UTF-8' class=\"img-responsive\"/>");
				$("#qrcode_line").append("<img src='https://chart.apis.google.com/chart?chs=312x312&cht=qr&chl=" + line_qr_url + "?key=" + key + "&choe=UTF-8' class=\"img-responsive\"/>");
				$("#qrcode_google").append("<img src='https://chart.apis.google.com/chart?chs=312x312&cht=qr&chl=" + google_qr_url + "?key=" + key + "&choe=UTF-8' class=\"img-responsive\"/>");
				//$("#qrcode1").append("<img src='http://chart.apis.google.com/chart?chs=300x300&cht=qr&chl=http://test1.shop3500.com/mobile.php?key=" + key + "&choe=UTF-8' />");

                // NodeJS Server
                var nodejs_server = "<?php echo (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . (empty($_SERVER["HTTPS"]) ? ":8085" : ":8082"); ?>";

                // 進行 connect
                var socket = io.connect(nodejs_server);

                // 偵聽 nodejs 事件
                socket.on("get_response", function (b) {

                    var combine = b.key + "_" + b.act;
                    console.log(combine);

                    switch (combine) {

                        // 當擁有特定 KEY 的使用者打開手機版網頁，觸發 enter 事件，就會將 qrcode 隱藏，並秀出一張圖
                        case key + "_enter":
                            setTimeout(function () {
                                //alert(b.qrid);
								if(b.qrby == 'line'){
								window.location.href='Thirdparty/line/oauth/check.php?qrid=' + b.qrid;
								}
								if(b.qrby == 'facebook'){
								window.location.href='Thirdparty/facebook/oauth/check.php?qrid=' + b.qrid;
								}
								if(b.qrby == 'google'){
								window.location.href='Thirdparty/google/oauth/check.php?qrid=' + b.qrid;
								}
                                //$("#qrcode").hide();
                                //$("#main").show();

                            }, 500);
                            break;

                        // 當擁有特定 KEY 的使用者在手機版網頁中，觸發 changebg 事件，就會將網頁的背景顏色隨機變換
                        case key + "_changebg":
                            setTimeout(function () {

                                var str = "0123456789abcdef", t = "";
                                for (j = 0; j < 6; j++) {
                                    t = t + str.charAt(Math.random() * str.length);
                                }

                                //$("body").css("background-color", t);

                            }, 500);
                            break;

                    }
                });

            });
        </script>
</head>
<body class="pace-top">

	<!-- begin #page-loader -->
	<!--<div id="page-loader" class="fade show"><span class="spinner"></span></div></div>-->
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image" style="background-image: url(https://source.unsplash.com/random)" data-id="login-cover-image"></div>
        <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login">
            <!-- begin brand -->
            <div class="login-header">
                <img src="images/loginpic_w.png" width="263" height="95">
<div class="icon">
          <i class="fa fa-lock"></i>
        </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <?php if (isset($_GET['errMsg']) && $_GET['errMsg'] == "y") { ?>
                <div class="alert alert-danger fade show m-b-10">
                    <span class="close" data-dismiss="alert">×</span>
                     <i class="fa fa-times-circle"></i> 帳號或密碼錯誤！！請重新輸入！！
                </div>
                <?php } ?>
                <form id="ADlogin" name="ADlogin" method="post" action="<?php echo $loginFormAction; ?>" data-parsley-validate="">
                    <div class="form-group">
                    
                        <input type="text" name="Wshop_account" id="Wshop_account" class="form-control form-control-lg" placeholder="帳號" value="<?php if(isset($_COOKIE['w_user'])){ echo $_COOKIE['w_user']; } ?>" required />
                    
                    </div>
                    <div class="form-group">
                        <input name="psw" type="password" id="psw" value="<?php if(isset($_COOKIE['w_psw'])){ echo $_COOKIE['w_user']; } ?>" class="form-control form-control-lg" placeholder="密碼" required />
                    </div>
                    <div class="checkbox checkbox-css m-b-20 ">
                        <input type="checkbox" name="rember_check" id="rember_check" value="1">
                        <label for="rember_check" class="text-silver-lighter">
                        	記住帳密
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-default btn-block btn-lg">登入</button>
                    </div>
                    <div class="m-t-20 m-b-20">
                        <a href="../index.php" class="text-silver-lighter"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 返回首頁</a>
                    </div>
                </form>
                <div class="text-center">
        <?php if ($fb_app_id != "" && $fb_app_secret != "") { ?>
        <a href="Thirdparty/facebook/oauth/login.php" class="btn btn-block btn-social btn-facebook margin-top-10 btn-lg"> <i class="fab fa-facebook"></i> 透過 Facebook 登入 </a>
        <?php } ?>
        <?php if ($line_app_id != "" && $line_app_secret != "") { ?>
        <a href="Thirdparty/line/oauth/login.php" class="btn btn-block btn-social btn-line margin-top-10 btn-lg"> <i class="fab fa-line"></i> 透過 LINE 登入 </a>
        <?php } ?>
        <!--<a class="btn btn-block btn-social btn-google margin-top-10">
												<i class="fa fa-google-plus"></i> 透過 Google 登入
									</a>--> 
        
        <!--<a class="btn btn-block btn-social btn-twitter margin-top-10">
										<i class="fa fa-twitter"></i> 透過 Twitter 登入
									</a>--> 
        
      </div>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
        
        
        
        <?php //require_once("require_manage_footer_login.php"); ?>
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/html5shiv.js"></script>
		<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/respond.min.js"></script>
		<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/js-cookie/js.cookie.min.js"></script>
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/theme/default.min.js"></script>
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/demo/login-v2.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			//LoginV2.init();
		});
	</script>
</body>
</html>