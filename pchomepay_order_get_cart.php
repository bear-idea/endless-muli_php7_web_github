<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('pchomepay_get_admin.php'); ?>
<?php
//取得新的 token, 如果 token 還在有效期內的話請不要重複取得
//echo $row_RecordSystemConfigOtr['pchomepaypaymentlinkmod'];
if($PCHOMELinkmod == "1") {
	$str_url = 'https://api.pchomepay.com.tw/v1/token'; // 正式
}else{
	$str_url = 'https://sandbox-api.pchomepay.com.tw/v1/token'; // 測試
}

//$str_url = 'https://sandbox-api.pchomepay.com.tw/v1/token'; // 測試


$headers = array(
'Content-Type:application/json',
//將帳號密碼以 base64 encode 後帶在 header 中取得 token
'Authorization: Basic '.
base64_encode($PCHOMEAppid . ":" . $PCHOMESecret)
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
echo $result = curl_exec($ch);
curl_close($ch);
//echo $result;


//use the token to call api
$token = json_decode($result);


if($PCHOMELinkmod == "1") {
	$str_url = 'https://api.pchomepay.com.tw/v1/payment/' . $_GET['Serial']; // 正式
}else{
	$str_url = 'https://sandbox-api.pchomepay.com.tw/v1/payment/' . $_GET['Serial']; // 測試
}

$headers = array(
'Content-Type:application/json',
'pcpay-token:'.$token->token);


$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_URL,$str_url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);

$de_result = json_decode($result,true);
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

$colname_RecordCartOrder = "-1";
if (isset($de_result['order_id'])) {
  $colname_RecordCartOrder = $de_result['order_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartOrder = sprintf("SELECT * FROM demo_cartorders WHERE oserial = %s", GetSQLValueString($colname_RecordCartOrder, "text"));
$RecordCartOrder = mysqli_query($DB_Conn, $query_RecordCartOrder) or die(mysqli_error($DB_Conn));
$row_RecordCartOrder = mysqli_fetch_assoc($RecordCartOrder);
$totalRows_RecordCartOrder = mysqli_num_rows($RecordCartOrder);

$w_userid = $row_RecordCartOrder['userid'];
?>
<?php 

/*更改成此份訂單已修改*/

      if($de_result['status'] == "S") {$returnstate = "付款成功";$ocfreightstate=2;}else{$returnstate = "付款失敗";$ocfreightstate=1;}


	  $updateSQLCheck = sprintf("UPDATE demo_cartorders SET returnstate=%s ocfreightstate=%s WHERE oid=%s",
						 GetSQLValueString($returnstate, "text"),
						 GetSQLValueString($ocfreightstate, "int"),
						 GetSQLValueString($row_RecordCartOrder['oid'], "int"));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result2 = mysqli_query($DB_Conn, $updateSQLCheck) or die(mysqli_error($DB_Conn));
	  
	  print 'success';

mysqli_free_result($RecordCartOrder);
?>
