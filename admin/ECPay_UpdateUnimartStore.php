<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php //include("ECPay.Logistics.Integration.php"); ?>
<?php header("Content-Type:text/html;charset=utf-8"); /* 指定頁面編碼方式 IE BUG*/  ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "superadmin,admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$colname_RecordCart = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCart = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCart = sprintf("SELECT * FROM demo_cartorders WHERE oserial = %s", GetSQLValueString($colname_RecordCart, "text"));
$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
$row_RecordCart = mysqli_fetch_assoc($RecordCart);
$totalRows_RecordCart = mysqli_num_rows($RecordCart);

$colname_RecordCartDetailed = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed = sprintf("SELECT * FROM demo_cartdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
$RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
$totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);

$colname_RecordCartListFreight = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListFreight = $_GET['lang'];
}
$coluserid_RecordCartListFreight = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListFreight = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListFreight = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListFreight, "text"),GetSQLValueString($coluserid_RecordCartListFreight, "int"));
$RecordCartListFreight = mysqli_query($DB_Conn, $query_RecordCartListFreight) or die(mysqli_error($DB_Conn));
$row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
$totalRows_RecordCartListFreight = mysqli_num_rows($RecordCartListFreight);

$coluserid_RecordSystemConfigOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfigOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfigOtr, "int"));
$RecordSystemConfigOtr = mysqli_query($DB_Conn, $query_RecordSystemConfigOtr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigOtr = mysqli_fetch_assoc($RecordSystemConfigOtr);
$totalRows_RecordSystemConfigOtr = mysqli_num_rows($RecordSystemConfigOtr);
?>
        <?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
        <?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
        <?php require_once("../inc/inc_function.php"); ?>
        <?php //$startTime = getMicroTime(); //页面开头定义：?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <meta name="keywords" content="" />
        <meta name="DESCRIPTION" content="" />
        <meta name ="author" content="富視網科技網頁設計" />
        <meta name="designer" content="富視網科技網頁設計" />
        <meta name="abstract" content="富視網科技網頁設計" />
        <meta name="publisher" content="富視網科技網頁設計" />
        <meta name="copyright" content="富視網科技網頁設計" />
        <meta name="robots" content="all" />
        <meta name="robots" content="index,follow" />
        <meta name="revisit-after" content="7 days" />
        <meta name="rating" content="general" />
        <meta name="distribution" content="global" />
        <meta name="content-Language" content="zh-tw" />
        <meta http-equiv="expires" content="0" />
        <meta name="spiders" content="all" />
        <meta name="webcrawlers" content="all" />
        <link rel='icon' href='favicon.ico' type='image/x-icon' />
        <link rel='bookmark' href='favicon.ico' type='image/x-icon' />
        <link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
        <title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title>
        <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
        <script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
        <script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
        <script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
        <script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
        <script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
        <script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
        <script type="text/javascript" src="../js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="../js/jquery.corners.min.js"></script>
        <script type="text/javascript" src="js/jquery.jqprint-0.3.js"></script>
        <script type="text/javascript" src="../js/noty/jquery.noty.js"></script>
        <script type="text/javascript" src="../js/noty/layouts/topCenter.js"></script>
        <script type="text/javascript" src="../js/noty/layouts/center.js"></script>
        <!-- You can add more layouts if you want -->
        <script type="text/javascript" src="../js/noty/themes/default.js"></script>
        <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
        <script type="text/javascript"> 
  function generatetip(title, type) {
  	var n = noty({
  		text: title,
  		type: type,
      dismissQueue: true,
      modal: true,
  		layout: 'center',
  		theme: 'defaultTheme'
  	});
  	console.log('html: '+n.options.id);
  }
        </script>
        <script type="text/javascript" src="../js/iframe.js"></script>
        <script>$(document).ready( function(){
  $('.rounded').corners();
});</script>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
        <!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
        <!-- ╭─────────────── CSS LINK ────────────────╮ -->
        <link href="css/incstyle.css" rel="stylesheet" type="text/css" />
        <link href="css/styleless.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
#wrapper{background-image:none}
#wrapper #Left_column{width:0;float:left}
#wrapper #Content_containter #Main_content #context{margin-left:0;background-image:none}
.keytag a{background-color:#F5F5F5;padding:3px 5px;margin:2px;color:#000;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;display:inline-block}
.keytag a:link{background-color:#F5F5F5;padding:3px 5px;margin:2px;color:#000;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;display:inline-block}
.keytag a:visited{text-decoration:none;color:#000}
.keytag a:hover{text-decoration:none;background-color:#F90;color:#FFF}
.TB_General_style00 {}
.TB_General_style00 tr td{padding:5px;font-size:20px;}
.payok{ background-image:url(images/payok.png); background-repeat:no-repeat; background-position:right center}
        </style>
        <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
        <div id="wrapper">
          <div id="header">
            <div id="context" style="height:0px;"></div>
          </div>
        </div>
        <div id="Content_containter">
          <div id="Main_content">
            <div id="context">
              <div>
                <div style="padding:10px;	border: 0px solid #CCC; margin:5px; width:980px; margin-left:auto; margin-right:auto;">
                  
                    
                    
                    
                    
<?php if ($row_RecordCart['ocfreightselect'] == "familyshop" || $row_RecordCart['ocfreightselect'] == "familyshopnopay") { ?>                    
<?php

    // 更新門市(統一超商C2C)
    require('ECPay.Logistics.Integration.php');
    try {
        $AL = new ECPayLogistics();
        $AL->HashKey = $row_RecordSystemConfigOtr['allpayfreightHashKey']; 
        $AL->HashIV = $row_RecordSystemConfigOtr['allpayfreightHashIV']; 
        $AL->Send = array(
            'MerchantID' => $row_RecordSystemConfigOtr['allpaypaymentnumber'],
            'AllPayLogisticsID' => $row_RecordCart['ocAllPayLogisticsID'],
            'CVSPaymentNo' => $row_RecordCart['ocCVSPaymentNo'],
            //'CVSValidationNo' => $row_RecordCart['ocCVSValidationNo'],
            'StoreType' => $_POST['StoreType'],
            'ReceiverStoreID' => $_POST['ocCVSStoreID'],
            'PlatformID' => ''
        );
        // UpdateUnimartStore()
        $Result = $AL->UpdateUnimartStore();
        echo '<pre>' . print_r($Result, true) . '</pre>';
    } catch(Exception $e) {
        echo $e->getMessage();
    }
?>
<?php } ?>

<?php if ($row_RecordCart['ocfreightselect'] == "sevenshop" || $row_RecordCart['ocfreightselect'] == "sevenshopnopay") { ?>                    
<?php

    // 更新門市(統一超商C2C)
    require('ECPay.Logistics.Integration.php');
    try {
        $AL = new ECPayLogistics();
        $AL->HashKey = $row_RecordSystemConfigOtr['allpayfreightHashKey']; 
        $AL->HashIV = $row_RecordSystemConfigOtr['allpayfreightHashIV']; 
        $AL->Send = array(
            'MerchantID' => $row_RecordSystemConfigOtr['allpaypaymentnumber'],
            'AllPayLogisticsID' => $row_RecordCart['ocAllPayLogisticsID'],
            'CVSPaymentNo' => $row_RecordCart['ocCVSPaymentNo'],
            'CVSValidationNo' => $row_RecordCart['ocCVSValidationNo'],
            'StoreType' => $_POST['StoreType'],
            'ReceiverStoreID' => $_POST['ocCVSStoreID'],
            'PlatformID' => ''
        );
        // UpdateUnimartStore()
        $Result = $AL->UpdateUnimartStore();
        echo '<pre>' . print_r($Result, true) . '</pre>';
    } catch(Exception $e) {
        echo $e->getMessage();
    }
?>
<?php } ?>
                    
                    
             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
                      <thead>
                        <tr>
                          <th colspan="2" align="center" class="btit"><strong>取件門市更新</strong></tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td width="100" class="tit"><span class="Form_Required_Item">*</span>廠商編號</td>
                        <td class=""><?php echo $row_RecordSystemConfigOtr['allpaypaymentnumber']; ?></td>
                      </tr>
                      <tr>
                        <td class="tit"><span class="Form_Required_Item">*</span>物流交易編號 </td>
                        <td class=""><?php echo $row_RecordCart['ocAllPayLogisticsID']; ?></td>
                      </tr>
                      <tr>
                        <td class="tit"><span class="Form_Required_Item">*</span>寄貨編號</td>
                        <td class=""><?php echo $row_RecordCart['ocCVSPaymentNo']; ?></td>
                      </tr>
                      <tr>
                        <td class="tit"><span class="Form_Required_Item">*</span>驗證碼</td>
                        <td class=""><?php echo $row_RecordCart['ocCVSValidationNo']; ?></td>
                      </tr>
                      <tr>
                        <td class="tit"><span class="Form_Required_Item">*</span>門市類型</td>
                        <td class="">
                        <?php if ($_POST['StoreType'] == "01") { ?>  
                        取件門市更新
                        <?php } ?> 
                        <?php if ($_POST['StoreType'] == "02") { ?>  
                        退件門市更新
                        <?php } ?>  
                        </td>
                      </tr>
                      <tr>
                        <td class="tit"><span class="Form_Required_Item">*</span>物流訂單取貨門市</td>
                        <td class="">
                        
                        <?php echo $_POST['ocCVSStoreID']; ?>
                          
                           
                        </td>
                      </tr>
                      <tr>
                        <td class="tit">&nbsp;</td>
                        <td class="" style="color:#F00;">&nbsp;</td>
                      </tr>
                      <tr>
                        <td class="tit">&nbsp;</td>
                        <td class="" style="color:#F00;"></td>
                      </tr>
                      
                      
                      </tbody>
                      
                    </table>       
                    
                    
                    
                </div>
                </div>
              </div>
            </div>
          </div>
          <div id="Rght_column">
            <div id="context"> </div>
          </div>
        </div>
        <div id="footer">
          <div id="context"></div>
        </div>
        </div>
        </body>
        </html>
        <script language="javascript">
function  a(){
        $("#jq_print").jqprint();
    }
        </script>
        <?php
mysqli_free_result($RecordCart);

mysqli_free_result($RecordCartDetailed);

mysqli_free_result($RecordCartListFreight);

mysqli_free_result($RecordSystemConfigOtr);
?>
