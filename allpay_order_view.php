<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>付款狀態</title>
</head>

<body>
<?php include("AllPay.Payment.Integration.php"); ?>
<?php 
/*
* 查詢訂單的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */
$oPayment->ServiceURL = "http://payment-stage.ecpay.com.tw/Cashier/QueryTradeInfo";
$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";
/* 基本參數 */
$oPayment->Query['MerchantTradeNo'] = "Shop35001437067427";//"<<您要查詢的訂單交易編號>>";
/* 查詢訂單 */
$arQueryFeedback = $oPayment ->QueryTradeInfo();
// 取回所有資料
//echo sizeof($arQueryFeedback);
if (sizeof($arQueryFeedback) > 0) { 
foreach ($arQueryFeedback as $key => $value) {
	//echo $key . "=" . $value . "###";
switch ($key)
{
/* 使用 Credit 定期定額交易時回傳的參數 */
case "MerchantID": $szMerchantID = $value; break;
case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
case "TradeNo": $szTradeNo = $value; break;
case "TradeAmt": $szTradeAmt = $value; break;
case "PaymentDate": $szPaymentDate = $value; break;
case "HandlingCharge": $szHandlingCharge = $value; break;
case "PaymentType": $szPaymentType = $value; break;
case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
case "TradeDate": $szTradeDate = $value; break;
case "TradeStatus": $szTradeStatus = $value; break;
case "ItemName": $szItemName = $value; break;
/* 使用 WebATM 交易時回傳的參數 */
case "WebATMAccBank": $szWebATMAccBank = $value; break;
case "WebATMAccNo": $szWebATMAccNo = $value; break;
/* 使用 ATM 交易時回傳的參數 */
case "ATMAccBank": $szATMAccBank = $value; break;
case "ATMAccNo": $szATMAccNo = $value; break;
/* 使用 CVS 或 BARCODE 交易時回傳的參數 */
case "PaymentNo": $szPaymentNo = $value; break;
case "PayFrom": $szPayFrom = $value; break;
/* 使用 Alipay 交易時回傳的參數 */
case "AlipayID": $szAlipayID = $value; break;
case "AlipayTradeNo": $szAlipayTradeNo = $value; break;
/* 使用 Tenpay 交易時回傳的參數 */
case "TenpayTradeNo": $szTenpayTradeNo = $value; break;
/* 使用 Credit 交易時回傳的參數 */
case "gwsr": $szGwsr = $value; break;
case "process_date": $szProcessDate = $value; break;
case "auth_code": $szAuthCode = $value; break;
case "amount": $szAmount = $value; break;
case "stage": $szStage = $value; break;
case "stast": $szStast = $value; break;
case "staed": $szStaed = $value; break;
case "eci": $szECI = $value; break;
case "card4no": $szCard4No = $value; break;
case "card6no": $szCard6No = $value; break;
case "red_dan": $szRedDan = $value; break;
case "red_de_amt": $szRedDeAmt = $value; break;
case "red_ok_amt": $szRedOkAmt = $value; break;
case "red_yet": $szRedYet = $value; break;
case "PeriodType": $szPeriodType = $value; break;
case "Frequency": $szFreqquency = $value; break;
case "ExecTimes": $szExecTimes = $value; break;
case "PeriodAmount": $szPeriodAmount = $value; break;
case "TotalSuccessTimes": $szTotalSuccessTimes = $value; break;
case "TotalSuccessAmount": $szTotalSuccessAmount = $value; break;
default: break;
}
}
// 其他資料處理。
//………
//echo "其他資料處理";
?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;border-top-width:1px;border-bottom-width:1px;}
.tg .btit{background-color:#b9c9fe; color:#FFF;}
.tg .tit{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#d2e4fc;border-top-width:1px;border-bottom-width:1px;}
.tg .tg-vn4c{background-color:#D2E4FC}
</style>
<table class="tg" style="width: 99%; margin:10px auto;">
  <tr>
    <td colspan="2" align="center" class="btit"><strong>基本資訊</strong></td>
  </tr>
  <tr>
    <td width="100" class="tit">交易編號</td>
    <td class=""><?php echo $szMerchantTradeNo ?></td>
  </tr>
  <tr>
    <td class="tit">交易金額</td>
    <td class=""><?php echo $szTradeAmt ?></td>
  </tr>
  <tr>
    <td class="tit">付款時間</td>
    <td class=""><?php echo $szPaymentDate ?></td>
  </tr>
  <tr>
    <td class="tit">付款方式</td>
    <td class="">
    <?php
		switch ($szPaymentType)
		{
		case "None": echo "不指定"; break;
		case "WebATM_TAISHIN": echo "台新銀行(網路ATM)"; break;
		case "WebATM_ESUN": echo "玉山銀行(網路ATM)"; break;
		case "WebATM_HUANAN": echo "華南銀行(網路ATM)"; break;
		case "WebATM_BOT": echo "台灣銀行(網路ATM)"; break;
		case "WebATM_FUBON": echo "台北富邦(網路ATM)"; break;
		case "WebATM_CHINATRUST": echo "中國信託(網路ATM)"; break;
		case "WebATM_FIRST": echo "第一銀行(網路ATM)"; break;
		case "WebATM_CATHAY": echo "國泰世華(網路ATM)"; break;
		case "WebATM_MEGA": echo "兆豐銀行(網路ATM)"; break;
		case "WebATM_YUANTA": echo "元大銀行(網路ATM)"; break;
		case "WebATM_LAND": echo "土地銀行(網路ATM)"; break;
		case "ATM_TAISHIN": echo "台新銀行(自動櫃員機)"; break;
		case "ATM_ESUN": echo "玉山銀行(自動櫃員機)"; break;
		case "HUANAN": echo "華南銀行(自動櫃員機)"; break;
		case "ATM_BOT": echo "台灣銀行(自動櫃員機)"; break;
		case "ATM_FUBON": echo "台北富邦(自動櫃員機)"; break;
		case "ATM_CHINATRUST": echo "中國信託(自動櫃員機)"; break;
		case "ATM_FIRST": echo "第一銀行(自動櫃員機)"; break;
		case "CVS": echo "超商代碼繳款"; break;
		case "CVS_CVS": echo "超商代碼繳款"; break;
		case "CVS_OK": echo "OK超商代碼繳款"; break;
		case "CVS_FAMILY": echo "全家超商代碼繳款"; break;
		case "CVS_HILIFE": echo "萊爾富超商代碼繳款"; break;
		case "CVS_IBON": echo "7-11 ibon代碼繳款"; break;
		case "Alipay": echo "支付寶"; break;
		case "Tenpay": echo "財付通"; break;
		case "TopUpUsed_AllPay": echo "儲值/餘額消費(綠界)"; break;
		case "TopUpUsed_ESUN": echo "儲值/餘額消費(玉山)"; break;
		case "BARCODE": echo "超商條碼繳款"; break;
		case "BARCODE_BARCODE": echo "超商條碼繳款"; break;
		case "Credit": echo "信用卡(MasterCard/JCB/VISA)"; break;
		case "Credit_CreditCard": echo "信用卡(MasterCard/JCB/VISA)"; break;
		case "COD": echo "貨到付款"; break;
		default:  echo $szPaymentType; break;
		}
	?>
    </td>
  </tr>
  <tr>
    <td class="tit">手續費合計</td>
    <td class=""><?php echo $szHandlingCharge ?></td>
  </tr>
  <tr>
    <td class="tit">訂單成立時間</td>
    <td class=""><?php echo $szTradeDate ?></td>
  </tr>
  <tr>
    <td class="tit">交易狀態</td>
    <td class="">
	<?php
		switch ($szTradeStatus)
		{
		case "0": echo "訂單成立，等待付款"; break;
		case "1": echo "履約交易完成"; break;
		case "100": echo "已付款"; break;
		case "110": echo "等待退款給買家"; break;
		case "111": echo "等待匯款給賣家"; break;
		case "112": echo "出貨取消，等待退款"; break;
		case "113": echo "訂單取消退款"; break;
		case "114": echo "重新出貨準備中"; break;
		case "127": echo "等待買家同意退款"; break;
		case "2": echo "退款完成"; break;
		case "3": echo "部份退款完成"; break;
		case "300": echo "已出貨"; break;
		case "302": echo "商品異常等待處理"; break;
		case "340": echo "已付款交易取消中"; break;
		case "370": echo "通知賣家取消訂單"; break;
		case "700": echo "客服處理中"; break;
		default: break;
		}
	?>
    </td>
  </tr>
  <tr>
    <td class="tit">商品名稱</td>
    <td class=""><?php echo $szItemName ?></td>
  </tr>
</table>
<table class="tg" style="width: 99%; margin:10px auto;">
  <tr>
    <td colspan="2" align="center" class="btit"><strong>付款資訊</strong></td>
  </tr>
  <?php
		switch ($szPaymentType)
		{
		case "None": 
		case "WebATM_TAISHIN": 
		case "WebATM_ESUN": 
		case "WebATM_HUANAN": 
		case "WebATM_BOT": 
		case "WebATM_FUBON": 
		case "WebATM_CHINATRUST": 
		case "WebATM_FIRST": 
		case "WebATM_CATHAY": 
		case "WebATM_MEGA": 
		case "WebATM_YUANTA": 
		case "WebATM_LAND": 
	?>
  <tr>
    <td width="100" class="tit">付款人銀行代碼</td>
    <td class=""><?php echo $szWebATMAccBank ?></td>
  </tr>
  <tr>
    <td class="tit">付款人銀行帳號後五碼</td>
    <td class=""><?php echo $szWebATMAccNo ?></td>
  </tr>
  <tr>
    <td width="100" class="tit">銀行名稱</td>
    <td class=""><?php echo $szWebATMBankName ?></td>
  </tr>
  <?php
  		break;
		case "ATM_TAISHIN": 
		case "ATM_ESUN": 
		case "HUANAN": 
		case "ATM_BOT":
		case "ATM_FUBON": 
		case "ATM_CHINATRUST": 
		case "ATM_FIRST": 
	?>
  <tr>
    <td width="100" class="tit">付款人銀行代碼</td>
    <td class=""><?php echo $szATMAccBank ?></td>
  </tr>
  <tr>
    <td class="tit">付款人銀行帳號後五碼</td>
    <td class=""><?php echo $szATMAccNo ?></td>
  </tr>
  <?php
  		break;
		case "CVS": 
		case "CVS_CVS": 
		case "CVS_OK": 
		case "CVS_FAMILY": 
		case "CVS_HILIFE": 
		case "CVS_IBON":
		case "BARCODE":
		case "BARCODE_BARCODE":
	?>
  <tr>
    <td width="100" class="tit">繳費代碼</td>
    <td class=""><?php echo $szATMAccBank ?></td>
  </tr>
  <tr>
    <td class="tit">繳費超商</td>
    <td class=""><?php echo $szPayFrom ?></td>
  </tr>
  <?php
  		break;
		case "Alipay":
	?>
  <tr>
    <td width="100" class="tit">付款人在支付寶的系統編號</td>
    <td class=""><?php echo $szAlipayID ?></td>
  </tr>
  <tr>
    <td width="100" class="tit">支付寶交易編號</td>
    <td class=""><?php echo $szAlipayTradeNo ?></td>
  </tr>
  <?php
  		break;
		case "Tenpay":
	?>
  <tr>
    <td width="100" class="tit">財付通交易編號</td>
    <td class=""><?php echo $szTenpayTradeNo ?></td>
  </tr>
  <?php
  		break;
		case "Credit":
		case "Credit_CreditCard":	
	?>
  <tr>
    <td width="100" class="tit">授權交易單號</td>
    <td class=""><?php echo $szgwsr ?></td>
  </tr>
  <tr>
    <td class="tit">授權碼</td>
    <td class=""><?php echo $szauth_code ?></td>
  </tr>
  <tr>
    <td class="tit">卡片的末4碼</td>
    <td class=""><?php echo $szcard4no ?></td>
  </tr>
  <tr>
    <td class="tit">訂單處理動作</td>
    <td class=""><?php echo $szPeriodType ?>C關帳。R退刷。E取消。N放棄。</td>
  </tr>
  <?php
  		break;
		default: break;
		}
	?>
</table>
<?php 
} else {
// 其他資料處理。
//………
echo "無此訂單";
}
}
catch (Exception $e)
{
// 例外錯誤處理。
echo "例外錯誤處理";
}
?>
</body>
</html>