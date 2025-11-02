<?php require_once('Connections/DB_Conn.php'); ?>
<?php //require_once('admin/upload_get_admin.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
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
  $insertSQL = sprintf("INSERT INTO demo_exmodcartorders (oserial, ocname, ocaddr, ocphone, ocmail, ocpdprice, octel, ocrfreight, ocfreight, oczip, octotal, postdate, ocnotes1, ocwshop, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['ocname'], "text"),
                       GetSQLValueString($_POST['ocaddr'], "text"),
                       GetSQLValueString($_POST['ocphone'], "text"),
                       GetSQLValueString($_POST['ocmail'], "text"),
                       GetSQLValueString($_POST['ocpdprice'], "text"),
                       GetSQLValueString($_POST['octel'], "text"),
					   GetSQLValueString($_POST['ocrfreight'], "text"),
                       GetSQLValueString($_POST['ocfreight'], "text"),
                       GetSQLValueString($_POST['oczip'], "text"),
                       GetSQLValueString($_POST['octotal'], "int"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['ocnotes1'], "text"),
					   GetSQLValueString($_POST['ocwshop'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	foreach($_POST['dcproductname'] as $i => $val){	
  $insertSQL = sprintf("INSERT INTO demo_exmodcartdetail (dcserial, pdseries, dcproductname, dcprice, dcquantiry, dcitemtotal, dcnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['pdseries'][$i], "text"),
                       GetSQLValueString($_POST['dcproductname'][$i], "text"),
                       GetSQLValueString($_POST['dcprice'][$i], "text"),
                       GetSQLValueString($_POST['dcquantiry'][$i], "text"),
                       GetSQLValueString($_POST['dcitemtotal'][$i], "text"),
					   GetSQLValueString($_POST['dcnotes1'][$i], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
	
	if(is_array($_POST['dcproductplusname']) && !empty($_POST['dcproductplusname'])){
	//foreach($_POST['dcproductname'] as $i => $val){
	  foreach($_POST['dcproductplusname'] as $k => $val2) {
		  $insertSQL = sprintf("INSERT INTO demo_excartdetail (dcserial, dcstate, dcproductname, dcprice, dcquantiry, dcitemtotal, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
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
	//$insertGoTo = "cart.php?wshop=" . $_POST['wshop'] . "&Opt=sendpage&lang=" . $_SESSION['lang'] . "&ID=" . $_POST['D_OrderID'] . "&PR=" . $_POST['octotal'];
	$insertGoTo = "../allpay_order_send_mod.php";
	  
  /* 清空購物車 */
  $wshop = $_POST['ocwshop'];
  if(is_array($_SESSION['CartMod_' . $wshop]) && !empty($_SESSION['CartMod_' . $wshop])){
  foreach($_SESSION['CartMod_' . $wshop] as $i => $val){
		unset ($_SESSION['CartMod_' . $wshop][$i]);
		unset ($_SESSION['Name'][$i]);
		unset ($_SESSION['PdSeries'][$i]);
		unset ($_SESSION['Quantity'][$i]);
		unset ($_SESSION['Price'][$i]);
		unset ($_SESSION['SpPrice'][$i]);
		unset ($_SESSION['itemTotal'][$i]);
		unset ($_SESSION['Notes1'][$i]);
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
		
	  mail($SiteMail, $Subject, $Body, $Header); */
	  //
	
  //header(sprintf("Location: %s", $insertGoTo));
 // ob_end_flush(); // 輸出緩衝區結束
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>訂單送出</title>
</head>

<body>
<?php include("AllPay.Payment.Integration.php"); ?>
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
//$_POST['D_OrderID'] = time();
//$_POST['ocpdprice'] = "999";
try
{
$oPayment = new ECPay_AllInOne();
/* 服務參數 */
/*$oPayment->ServiceURL ="http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";*/
/* 正式 */
$oPayment->ServiceURL ="https://payment.ecpay.com.tw/Cashier/AioCheckOut";
$oPayment->HashKey = "JQa2L5rldLhDuFtI";
$oPayment->HashIV = "Qvmk6zxyNKlFPFnt";
$oPayment->MerchantID ="3001259";
/* 基本參數 */
$oPayment->Send['ReturnURL'] = "http://" . $_SERVER['HTTP_HOST'] . "/allpay_order_get_mod.php";
$oPayment->Send['ClientBackURL'] = "";
$oPayment->Send['OrderResultURL'] = "";
$oPayment->Send['MerchantTradeNo'] = $_POST['D_OrderID'];//"<<訂單交易編號>>";
$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
$oPayment->Send['TotalAmount'] = (int) $_POST['ocpdprice'];
$oPayment->Send['TradeDesc'] = "Shop3500 是一個全新型態的自由創作架站平台，首創採用《輕設計》的概念，架設公司網站不再是件困難的事情";
$oPayment->Send['ChoosePayment'] = PaymentMethod::ALL;
$oPayment->Send['Remark'] = "";
$oPayment->Send['ChooseSubPayment'] = PaymentMethodItem::None;
$oPayment->Send['NeedExtraPaidInfo'] = "Y";
$oPayment->Send['DeviceSource'] = DeviceType::PC;
$oPayment->Send['IgnorePayment'] = "Alipay#Tenpay#TopUpUsed#APPBARCODE#AccountLink"; // 例(排除支付寶與財富通): Alipay#Tenpay
// 加入選購商品資料。
foreach($_POST['dcproductname'] as $i => $val){	
array_push($oPayment->Send['Items'], array('Name' => $_POST['dcproductname'][$i], 'Price' => (int) $_POST['dcprice'][$i],
'Currency' => "元(NTD.)", 'Quantity' => (int) $_POST['dcquantiry'][$i], 'URL' => "http://www.shop3500.com/Event_DM.php"));
}
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