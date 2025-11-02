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
try
{
$oPayment = new AllInOne();
/* 服務參數 */
/*$oPayment->ServiceURL ="https://payment.allpay.com.tw/Cashier/AioCheckOut";
$oPayment->HashKey = "5AoputFBfqhcCRD9";
$oPayment->HashIV = "XsPpSIZm3XMjodnr";
$oPayment->MerchantID ="1050060";*/
$oPayment->ServiceURL ="http://payment-stage.ecpay.com.tw/Cashier/AioCheckOut";
$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";
/* 基本參數 */
$oPayment->Send['ReturnURL'] = "http://" . $_SERVER['HTTP_HOST'] . "allpay_order_get.php";
$oPayment->Send['ClientBackURL'] = "";
$oPayment->Send['OrderResultURL'] = "";
$oPayment->Send['MerchantTradeNo'] = "Shop3500" . time();//"<<訂單交易編號>>";
$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
$oPayment->Send['TotalAmount'] = (int) "3500";
$oPayment->Send['TradeDesc'] = "Shop3500 是一個全新型態的自由創作架站平台，首創採用《輕設計》的概念，架設公司網站不再是件困難的事情";
$oPayment->Send['ChoosePayment'] = PaymentMethod::ALL;
$oPayment->Send['Remark'] = "";
$oPayment->Send['ChooseSubPayment'] = PaymentMethodItem::None;
$oPayment->Send['NeedExtraPaidInfo'] = "Y";
$oPayment->Send['DeviceSource'] = DeviceType::PC;
$oPayment->Send['IgnorePayment'] = "Alipay#Tenpay#TopUpUsed#APPBARCODE#AccountLink"; // 例(排除支付寶與財富通): Alipay#Tenpay
// 加入選購商品資料。
array_push($oPayment->Send['Items'], array('Name' => "Shop3500企業網站", 'Price' => (int)"3500",
'Currency' => "元(NTD.)", 'Quantity' => (int) "1", 'URL' => "http://www.shop3500.com/Event_DM.php"));
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