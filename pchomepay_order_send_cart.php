<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('pchomepay_order_get_key.php'); ?>
<?php 
ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php //require_once('admin/upload_get_admin.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO demo_cartorders (oserial, ocname, ocaddr, ocphone, ocmail, ocgender, ocbuyname, ocbuyphone, ocbuytel, ocbuymail, ocbuygender, ocpdprice, octel, ocrfreight, ocfreightprice, ocinvoiceformat, ocinvoiceetselect, ocinvoicesupportno, ocinvoiceloveno, ocinvoicecompanyno, ocinvoicetitle, ocinvoiceusername, ocinvoiceaddr, ocinvoiceprice, ocfreepriceok, ocfreepricedesc, ocexpriceselect, ocexpricename, ocexprice, ocpaymentselect, ocfreightselect, ocreceipt, ocfreightdesc, ocotherprice, oczip, occounty, ocdistrict, octotal, postdate, ocnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['ocname'], "text"),
                       GetSQLValueString($_POST['ocaddr'], "text"),
                       GetSQLValueString($_POST['ocphone'], "text"),
                       GetSQLValueString($_POST['ocmail'], "text"),
					   GetSQLValueString($_POST['ocgender'], "text"),				   
					   GetSQLValueString($_POST['ocbuyname'], "text"),
					   GetSQLValueString($_POST['ocbuyphone'], "text"),
					   GetSQLValueString($_POST['ocbuytel'], "text"),
					   GetSQLValueString($_POST['ocbuymail'], "text"),
					   GetSQLValueString($_POST['ocbuygender'], "text"),	   
                       GetSQLValueString($_POST['ocpdprice'], "text"),
                       GetSQLValueString($_POST['octel'], "text"),
					   GetSQLValueString($_POST['ocrfreight'], "text"),
                       GetSQLValueString($_POST['ocfreightprice'], "text"),
					   GetSQLValueString($_POST['ocinvoiceformat'], "text"),
					   GetSQLValueString($_POST['ocinvoiceetselect'], "int"),
					   GetSQLValueString($_POST['ocinvoicesupportno'], "text"),
					   GetSQLValueString($_POST['ocinvoiceloveno'], "text"),
					   GetSQLValueString($_POST['ocinvoicecompanyno'], "text"),
					   GetSQLValueString($_POST['ocinvoicetitle'], "text"),
					   GetSQLValueString($_POST['ocinvoiceusername'], "text"),
					   GetSQLValueString($_POST['ocinvoiceaddr'], "text"),
					   GetSQLValueString($_POST['ocinvoiceprice'], "text"),
					   GetSQLValueString($_POST['ocfreepriceok'], "int"),
					   GetSQLValueString($_POST['ocfreepricedesc'], "text"),
					   GetSQLValueString($_POST['ocexpriceselect'], "int"),
					   GetSQLValueString($_POST['ocexpricename'], "text"),
					   GetSQLValueString($_POST['ocexprice'], "text"),
					   GetSQLValueString($_POST['ocpaymentselect'], "text"),
					   GetSQLValueString($_POST['ocfreightselect'], "int"),
					   GetSQLValueString($_POST['ocreceipt'], "text"),
					   GetSQLValueString($_POST['ocfreightdesc'], "text"),
					   GetSQLValueString($_POST['ocotherprice'], "int"),
                       GetSQLValueString($_POST['oczip'], "text"),
					   GetSQLValueString($_POST['occounty'], "text"),
					   GetSQLValueString($_POST['ocdistrict'], "text"),
                       GetSQLValueString($_POST['octotal'], "int"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['ocnotes1'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	foreach($_POST['dcproductname'] as $i => $val){	
  $insertSQL = sprintf("INSERT INTO demo_cartdetail (dcserial, pdseries, dcproductname, dcprice, dcquantiry, dcitemtotal, dcformat, dcnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['pdseries'][$i], "text"),
                       GetSQLValueString($_POST['dcproductname'][$i], "text"),
                       GetSQLValueString($_POST['dcprice'][$i], "text"),
                       GetSQLValueString($_POST['dcquantiry'][$i], "text"),
                       GetSQLValueString($_POST['dcitemtotal'][$i], "text"),
					   GetSQLValueString($_POST['dcformat'][$i], "text"),
					   GetSQLValueString($_POST['dcnotes1'][$i], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
	
	//foreach($_POST['dcproductname'] as $i => $val){
	if(is_array($_POST['dcproductplusname']) && !empty($_POST['dcproductplusname'])){
	  foreach($_POST['dcproductplusname'] as $k => $val2) {
		  $insertSQL = sprintf("INSERT INTO demo_cartdetail (dcserial, dcstate, dcproductname, dcprice, dcquantiry, dcitemtotal, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
					   GetSQLValueString(1, "int"),
                       GetSQLValueString($_POST['dcproductplusname'][$k], "text"),
                       GetSQLValueString($_POST['dcproductplusprice'][$k], "text"),
                       GetSQLValueString($_POST['dcproductplusquantity'][$k], "text"),
					   GetSQLValueString($_POST['dcplusitemtotal'][$k], "text"),
                       GetSQLValueString($_POST['userid'], "int"));
					   //mysqli_select_db($database_DB_Conn, $DB_Conn);
  					   $Result2 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  }
	}
  //}

		//$insertGoTo = "pchomepay_order_send_cart.php";

	  
  /* 清空購物車 */
  if(is_array($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID']) && !empty($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID'])){
  foreach($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val){
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i]);
		unset ($_SESSION['Cart_' . $_POST['wshop'] . '_' . $_SESSION['lang']]['Format'][$i]);
	}
  }
	unset ($_SESSION['OrderID']); // 清除訂單編號
	
	if(is_array($_SESSION['PlusId']) && !empty($_SESSION['PlusId'])){
	foreach($_SESSION['PlusId'] as $i => $val1){
		foreach($val1 as $j => $val2){
			unset ($_SESSION['PlusId'][$i][$j]);
			unset ($_SESSION['PlusName'][$i][$j]);
			unset ($_SESSION['PlusPrice'][$i][$j]);
			unset ($_SESSION['PlusQuantity'][$i][$j]);
			unset ($_SESSION['PlusitemTotal'][$i][$j]);
		}
	}
	}
	
	  // <!-- ╭─────────────────────────────────────╮ -->
	  // 發送訂購通知(購買人)
	  /*$DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/cart_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "親愛的 " . $_POST['ocname'] . " 您好！\n" 
			. "歡迎您在『" . $SiteName . "』購物。\n"
			. "您的訂單編號：" . $_POST['D_OrderID'] . " \n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為您所訂購知詳細資料！\n\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url . " \n\n"
			. "本信件為系統自動發送(請勿回信！！！)";
	
	  $From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $_POST['ocmail'] . "> \n\r";
	  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  $Header = $From . $Type;
	  $Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購成功確認通知") . "?=";
		
	  mail($_POST['ocmail'], $Subject, $Body, $Header);
	  
	  // 發送訂購通知(商家)
	  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/cart_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "您的客戶 " . $_POST['ocname'] . "！於您的網站購物\n" 
			. "訂單編號：" . $_POST['D_OrderID'] . "\n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url
			. "";
	
	  $From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $SiteMail . "> \n\r";
	  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  $Header = $From . $Type;
	  $Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購通知") . "?=";
		
	  mail($SiteMail, $Subject, $Body, $Header); 
	  //
	  header(sprintf("Location: %s", $insertGoTo));*/
	  
  ob_end_flush(); // 輸出緩衝區結束
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>訂單送出</title>
</head>
<body>


<?php
//取得新的 token, 如果 token 還在有效期內的話請不要重複取得
if($pchomepaypaymentlinkmod == "1") {
	$str_url = 'https://api.pchomepay.com.tw/v1/token'; // 正式
}else{
	$str_url = 'https://sandbox-api.pchomepay.com.tw/v1/token'; // 測試
}
//
$headers = array(
'Content-Type:application/json',
//將帳號密碼以 base64 encode 後帶在 header 中取得 token
'Authorization: Basic '.
base64_encode($pchomepaypaymentAppid.":".$pchomepaypaymentSecret)
);
$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL,$str_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, null);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$result = curl_exec($ch);
curl_close($ch);
//echo $result;




//use the token to call api
$token = json_decode($result);
if($pchomepaypaymentlinkmod == "1") {
	$str_url = 'https://api.pchomepay.com.tw/v1/payment';
}else{
	$str_url = 'https://sandbox-api.pchomepay.com.tw/v1/payment';
}
$headers = array(
'Content-Type:application/json',
'pcpay-token:'.$token->token);

	
$arr = array ('order_id'=>$_POST['D_OrderID'],'pay_type'=>array("CARD"),'amount'=>(int) $_POST['octotal'],'return_url'=>"http://" . $_SERVER['HTTP_HOST'] . "/cart.php?wshop=" . $_POST['wshop'] . "&Opt=sendpage&lang=" . $_SESSION['lang']."&ID=".$_POST['D_OrderID']."&PR=".$_POST['octotal']."",'item_name'=>"網路商品", 'item_url'=>"http://" . $_SERVER['HTTP_HOST'], 'buyer_email'=>$_POST['ocbuymail'], 'atm_info'=>array("expire_days" =>3));

$requestPayload = json_encode($arr);

$ch = curl_init();


curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL,$str_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPayload);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$result = curl_exec($ch);
curl_close($ch);
/**
* result when success
* {"order_id":"J2016101000005","payment_url":"https:\/\/pay.pchomepay.com.tw\/
* ppwf?_pwfkey_=rVKHID0O1KIltnH-MHD5vHtheBCUYLEQtYZxrGsjG9K6IXPSyp6lnx4nOQ__"}
*/
/**
* result when fail
* {"error_type":"invalid_request_error","code":20001,"message":"order id duplicate"}
*/
//echo $result;

$de_result = json_decode($result,true);

//echo $de_result['payment_url'];

$de_resultGoTo = $de_result['payment_url'];

header("Location: $de_resultGoTo");

?>
</body>
</html>