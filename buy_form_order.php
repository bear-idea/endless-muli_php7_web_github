<?php 
include("AllPay.Payment.Integration.php");

/*
* 全功能介接的建構範例程式碼。
*/
//$oPayment = new AllInOne();
/* 服務參數 */
//$oPayment->ServiceMethod = HttpMethod::HttpPOST;
//$oPayment->ServiceURL = "http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";//"<<您要呼叫的服務位址>>";
//$oPayment->HashKey = "5294y06JbISpM5x9"; //"<<AllPay提供給您的Hash Key>>";
//$oPayment->HashIV = "v77hoKGq4kWxNNIS"; //"<<AllPay提供給您的Hash IV>>";
//$oPayment->MerchantID = "2000132"; //"<<AllPay提供給您的特店編號>>";


/*
* 產生訂單的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */
$oPayment->ServiceURL = "http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";//"<<您要呼叫的服務位址>>";
$oPayment->HashKey = "5294y06JbISpM5x9"; //"<<AllPay提供給您的Hash Key>>";
$oPayment->HashIV = "v77hoKGq4kWxNNIS"; //"<<AllPay提供給您的Hash IV>>";
$oPayment->MerchantID = "2000132"; //"<<AllPay提供給您的特店編號>>";
/* 基本參數 */
$oPayment->Send['ReturnURL'] = "http://www.shop3500.com/check.php";//"<<您要收到付款完成通知的伺服器端網址>>";
$oPayment->Send['ClientBackURL'] = "http://www.shop3500.com";//"<<您要綠界返回按鈕導向的瀏覽器端網址>>";
$oPayment->Send['OrderResultURL'] = "";//"<<您要收到付款完成通知的瀏覽器端網址>>";
$oPayment->Send['MerchantTradeNo'] = "Allpay_1234";//"<<您此筆訂單交易編號>>";
$oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
$oPayment->Send['TotalAmount'] = (int) "1000"; //(int) "<<您此筆訂單的交易總金額>>";
$oPayment->Send['TradeDesc'] = "DSC";//"<<您該筆訂單的描述>>";
$oPayment->Send['ChoosePayment'] = PaymentMethod::ALL;
$oPayment->Send['Remark'] = "NOTE"; //"<<您要填寫的其他備註>>";
$oPayment->Send['ChooseSubPayment'] = PaymentMethodItem::None;
$oPayment->Send['NeedExtraPaidInfo'] = ExtraPaymentInfo::No;
$oPayment->Send['DeviceSource'] = DeviceType::PC;
$oPayment->Send['IgnorePayment'] = ""; //"<<您不要顯示的付款方式>>"; // 例(排除支付寶與財富通): Alipay#Tenpay
// 加入選購商品資料。
array_push($oPayment->Send['Items'], array('Name' => "產品A", 'Price' => (int)"100",
'Currency' => "NTD", 'Quantity' => (int) "1", 'URL' => "S"));

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
