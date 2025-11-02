<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('ecpay_order_get_key.php'); ?>
<?php include("ECPay.Payment.Integration.php"); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Employeeshoilday")) {
    
    
    $_SESSION['OrderID'] = date("Ymd") . rand(100000,999999);
    $_POST['D_OrderID'] = $_SESSION['OrderID'];
    $_POST['ocfreepriceok'] = '0';
    $_POST['ocexpriceselect'] = '0';
        
  echo $insertSQL = sprintf("INSERT INTO demo_cartorders (oserial, ocname, ocaddr, ocphone, ocmail, ocgender, ocbuyname, ocbuyphone, ocbuytel, ocbuymail, ocbuygender, ocpdprice, octel, ocrfreight, ocfreightprice, ocinvoiceformat, ocinvoiceetselect, ocinvoicesupportno, ocinvoiceloveno, ocinvoicecompanyno, ocinvoicetitle, ocinvoiceusername, ocinvoiceaddr, ocinvoiceprice, ocfreepriceok, ocfreepricedesc, ocexpriceselect, ocexpricename, ocexprice, ocpaymentselect, ocfreightselect, ocreceipt, ocfreightdesc, ocotherprice, oczip, occounty, ocdistrict, octotal, postdate, ocnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Employeeshoilday")) {
	//foreach($_POST['dcproductname'] as $i => $val){	
  echo $insertSQL = sprintf("INSERT INTO demo_cartdetail (dcserial, pdseries, dcproductname, dcprice, dcquantiry, dcitemtotal, dcformat, dcnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['pdseries'], "text"),
                       GetSQLValueString($_POST['dcproductname'], "text"),
                       GetSQLValueString($_POST['dcprice'], "text"),
                       GetSQLValueString($_POST['dcquantiry'], "text"),
                       GetSQLValueString($_POST['dcitemtotal'], "text"),
					   GetSQLValueString($_POST['dcformat'], "text"),
					   GetSQLValueString($_POST['dcnotes1'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	//}

		// $insertGoTo = "allpay_order_send_cart.php";

	  
	
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
<?php //include("AllPay.Payment.Integration.php"); ?>
<?php 

   //特殊字元置換
	function _replaceChar($value)
	{
		$search_list = array('%2d', '%5f', '%2e', '%21', '%2a', '%28', '%29');
		$replace_list = array('-', '_', '.', '!', '*', '(', ')');
		$value = str_replace($search_list, $replace_list ,$value);
		
		return $value;
	}
	//產生檢查碼
	function _getMacValue($hash_key, $hash_iv, $form_array)
	{
		$encode_str = "HashKey=" . $hash_key;
		foreach ($form_array as $key => $value)
		{
			$encode_str .= "&" . $key . "=" . $value;
		}
		$encode_str .= "&HashIV=" . $hash_iv;
		$encode_str = strtolower(urlencode($encode_str));
		$encode_str = _replaceChar($encode_str);
		return md5($encode_str);
	}
/*
* 產生訂單的範例程式碼。
*/
    
    $allpaypaymentHashKey = "3070603";
	$oPayment->HashIV      = "g7Wgpfy6M4dA4Sdd";                                         //測試用HashIV，請自行帶入ECPay提供的HashIV
	$oPayment->MerchantID  = "a1mJKY48lTbZXAfc";
    
try
{
	$oPayment = new ECPay_AllInOne();
   
	//服務參數                
	$oPayment->ServiceURL  = "https://payment.ecpay.com.tw/Cashier/AioCheckOut/V2"; //服務位置
	$oPayment->HashKey     = $allpaypaymentHashKey;                                          //測試用Hashkey，請自行帶入ECPay提供的HashKey
	$oPayment->HashIV      = $allpaypaymentHashIV;                                         //測試用HashIV，請自行帶入ECPay提供的HashIV
	$oPayment->MerchantID  = $allpaypaymentnumber;                                                //測試用MerchantID，請自行帶入ECPay提供的MerchantID


	//基本參數(請依系統規劃自行調整)
	$oPayment->Send['ReturnURL']         = "http://" . $_SERVER['HTTP_HOST'] . "/booking_order_get_cart.php?wshop=" . $_POST['wshop'];    //付款完成通知回傳的網址
	$oPayment->Send['MerchantTradeNo']   = $_POST['D_OrderID'];                             //訂單編號
	$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                        //交易時間
	$oPayment->Send['TotalAmount']       = (int) $_POST['octotal'];                                     //交易金額
	$oPayment->Send['TradeDesc']         = "線上金流";                  //交易描述
	
    
    $_POST['ocpaymentselect'] = 'allpay_CVS';
        
	if($_POST['ocpaymentselect'] == 'allpay_Credit') {
		$oPayment->Send['ChoosePayment']     = ECPay_PaymentMethod::Credit ;                        
	}else if($_POST['ocpaymentselect'] == 'allpay_BARCODE') {
		$oPayment->Send['ChoosePayment']     = ECPay_PaymentMethod::BARCODE ;                       
	}else if($_POST['ocpaymentselect'] == 'allpay_CVS') {
		$oPayment->Send['ChoosePayment']     = ECPay_PaymentMethod::CVS ;                       
	}else{
		$oPayment->Send['ChoosePayment']     = ECPay_PaymentMethod::ALL ;                        //付款方式:全功能
	}

	//訂單的商品資料
	//array_push($obj->Send['Items'], array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
			   //'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));
			   
			   
			   
// Allpay			   
//$oPayment = new AllInOne();
/* 服務參數 */
/*$oPayment->ServiceURL ="http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";*/
/* 正式 */
/*$oPayment->ServiceURL ="https://payment.ecpay.com.tw/Cashier/AioCheckOut";
$oPayment->HashKey = $_POST['HashKey'];
$oPayment->HashIV = $_POST['HashIV'];
$oPayment->MerchantID = $_POST['MerchantID'];*/
/* 基本參數 */
/*$oPayment->Send['ReturnURL'] = "http://" . $_SERVER['HTTP_HOST'] . "/allpay_order_get_cart.php?wshop=" . $_POST['wshop'];
$oPayment->Send['ClientBackURL'] = "";
$oPayment->Send['OrderResultURL'] = "";*/
//$oPayment->Send['MerchantTradeNo'] = $_POST['D_OrderID'];//"<<訂單交易編號>>";
/*$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
$oPayment->Send['TotalAmount'] = (int) $_POST['octotal'];
$oPayment->Send['TradeDesc'] = "線上金流";
$oPayment->Send['ChoosePayment'] = PaymentMethod::ALL;
$oPayment->Send['Remark'] = "";
$oPayment->Send['ChooseSubPayment'] = PaymentMethodItem::None;
$oPayment->Send['NeedExtraPaidInfo'] = "Y";
$oPayment->Send['DeviceSource'] = DeviceType::PC;*/
//$oPayment->Send['IgnorePayment'] = "TopUpUsed#APPBARCODE#AccountLink"; // 例(排除支付寶與財富通): Alipay#Tenpay
// 加入選購商品資料。
//foreach($_POST['dcproductname'] as $i => $val){	
//array_push($oPayment->Send['Items'], array('Name' => "總金額", 'Price' => (int) $_POST['octotal'],'Currency' => "元(NTD.)", 'Quantity' => (int) "1", 'URL' => ""));
//}
//foreach($_POST['dcproductname'] as $i => $val){	
array_push($oPayment->Send['Items'], array('Name' => $_POST['dcproductname'], 'Price' => (int) $_POST['dcprice'],
'Currency' => "元(NTD.)", 'Quantity' => (int) $_POST['dcquantiry'], 'URL' => ""));
//}


/* 產生訂單 */
$oPayment->CheckOut();
/* 產生產生訂單 Html Code 的方法 */
$szHtml = $oPayment->CheckOutString();
}
catch (Exception $e)
{
// 例外錯誤處理。
throw $e;
}
?>
</body>
</html>