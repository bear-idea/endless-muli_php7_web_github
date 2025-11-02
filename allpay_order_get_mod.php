<?php require_once('Connections/DB_Conn.php'); ?>
<?php include("AllPay.Payment.Integration.php"); ?>
<?php 
/*
* 接收訂單資料產生完成的範例程式碼。
*/
try
{
$oPayment = new AllInOne();
/* 服務參數 */
/*$oPayment->HashKey = "5294y06JbISpM5x9";
$oPayment->HashIV = "v77hoKGq4kWxNNIS";
$oPayment->MerchantID ="2000132";*/
/* 正式 */
$oPayment->HashKey = "JQa2L5rldLhDuFtI";
$oPayment->HashIV = "Qvmk6zxyNKlFPFnt";
$oPayment->MerchantID ="3001259";
/* 取得回傳參數 */
$arFeedback = $oPayment->CheckOutFeedback();
/* 檢核與變更訂單狀態 */

//echo sizeof($arFeedback);
if (sizeof($arFeedback) > 0) {
foreach ($arFeedback as $key => $value) {
switch ($key)
{
/* 支付後的回傳的基本參數 */
case "MerchantID": $szMerchantID = $value; break;
case "MerchantTradeNo": $szMerchantTradeNo = $value; break;
case "PaymentDate": $szPaymentDate = $value; break;
case "PaymentType": $szPaymentType = $value; break;
case "PaymentTypeChargeFee": $szPaymentTypeChargeFee = $value; break;
case "RtnCode": $szRtnCode = $value; break;
case "RtnMsg": $szRtnMsg = $value; break;
case "SimulatePaid": $szSimulatePaid = $value; break;
case "TradeAmt": $szTradeAmt = $value; break;
case "TradeDate": $szTradeDate = $value; break;
case "TradeNo": $szTradeNo = $value; break;
default: break;
}
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

$colname_RecordCartDetailed = "-1";
if (isset($szMerchantTradeNo)) {
  $colname_RecordCartDetailed = $szMerchantTradeNo;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed = sprintf("SELECT * FROM demo_exmodcartdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
$RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
$totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);

$w_userid = $row_RecordCartDetailed['userid'];
?>
<?php 

// 其他資料處理。
//………
  do { 
    if($row_RecordCartDetailed['pdseries'] == "Lease") {
		$colname_RecordWebState = "-1";
		if (isset($w_userid)) {
		  $colname_RecordWebState = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordWebState = sprintf("SELECT * FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordWebState, "int"));
		$RecordWebState = mysqli_query($DB_Conn, $query_RecordWebState) or die(mysqli_error($DB_Conn));
		$row_RecordWebState = mysqli_fetch_assoc($RecordWebState);
		$totalRows_RecordWebState = mysqli_num_rows($RecordWebState);
		
		if($row_RecordCartDetailed['dcquantiry'] != "") {
			$usetime = $row_RecordCartDetailed['dcquantiry'];
		}else{
			$usetime = "1";
		}
		
		if($row_RecordWebState['webenabledate'] != "") {
			// 保留首次註冊時間
			$webenabledate =  $row_RecordWebState['webenabledate'];
		}else{
			$webenabledate =  date("Y-m-d H:i:s");
		}
		
		// 計算目前網站到期日
		if($row_RecordWebState['usetime'] == ''){$row_RecordWebState['usetime'] = 0;}
		if($row_RecordWebState['webenabledate'] != ''){
			$years = date("Y",strtotime($row_RecordWebState['webrenewdate'])); 
			$months = date("m",strtotime($row_RecordWebState['webrenewdate']));
			$days = date("d",strtotime($row_RecordWebState['webrenewdate'])); 
			$endday = date("Y-m-d",mktime(0,0,0,$months,$days,$years+$row_RecordWebState['usetime']));
			//echo $endday; 
		}else{
			//$endday = date("Y-m-d H:i:s");
		}
				
		if($row_RecordWebState['webrenewdate'] != "") {
			// 取代時間	
			//$webrenewdate =  date("Y-m-d H:i:s");	
			if(strtotime($endday)>strtotime(date("Y-m-d H:i:s"))){ 
			//echo "Y"; 
			//$webrenewdate =  date("Y-m-d H:i:s",strtotime($endday . "+" . $usetime . "year"));
			$webrenewdate =  $endday;
			} 
			else{ 
			//echo "N"; 
			$webrenewdate =  date("Y-m-d H:i:s");
			} 
			
		}else{
			$webrenewdate =  date("Y-m-d H:i:s");
		}
		
		$updateSQL = sprintf("UPDATE demo_admin SET webenabledate=%s, webrenewdate=%s, usetime=%s, testuse=%s WHERE id=%s",	
							 GetSQLValueString($webenabledate, "date"),
							 GetSQLValueString($webrenewdate, "date"),
							 GetSQLValueString($usetime, "int"),
							 GetSQLValueString("0", "int"),
							 GetSQLValueString($w_userid, "int"));
	  
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}else{
	  $modcolumn = "Option" . $row_RecordCartDetailed['pdseries'] . "Select";
	  $updateSQL = sprintf("UPDATE demo_setting SET `$modcolumn`=%s WHERE userid=%s",
						 GetSQLValueString("1", "int"),
						 GetSQLValueString($w_userid, "int"));	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
	  // 更改成此份訂單已修改
	  $updateSQLCheck = sprintf("UPDATE demo_exmodcartdetail SET beused=%s WHERE did=%s",
						 GetSQLValueString("1", "int"),
						 GetSQLValueString($row_RecordCartDetailed['did'], "int"));	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result2 = mysqli_query($DB_Conn, $updateSQLCheck) or die(mysqli_error($DB_Conn));
  } while ($row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed));

  ob_get_clean();
  print '1|OK';

} else {
print '0|Fail';
//echo $arFeedback;
}
}
catch (Exception $e)
{
// 例外錯誤處理。
print '0|' . $e->getMessage();
}

mysqli_free_result($RecordCartDetailed);
?>