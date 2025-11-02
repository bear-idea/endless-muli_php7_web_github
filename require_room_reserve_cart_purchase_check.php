<?php require_once('Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { // 已被訂
foreach($_POST['dcproductname'] as $j => $val){	
		$N_Date = $_POST['dcroomdate'][$j];
		$row_RecordRoomCalendar['roomid'] = $_POST['roomid'][$j];
		require("require_room_reserve_list_show_chickinpeople.php");
		require("require_room_reserve_list_show_getroom.php");
		$chickroomnum = $row_RecordRoomGetRoomNum['roomnum'] - $row_RecordsetCat['chickinpeople'] - $_POST['dcquantiry'][$j];
		if($chickroomnum < 0)
		{
			$MM_redirectError = "room.php?wshop=" . $_POST['wshop'] . "&Opt=sendpage&lang=" . $_SESSION['lang'] . "&ST=" . "Error";
			echo("<script language='javascript'>location.href='".$MM_redirectError."'</script>");
			exit;
		}
	}
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO demo_roomorders (oserial, ocname, ocsn, ocphone, ocmail, ocpdprice, octel, occountry, ocinname, ocinsn, ocpayment, octotal, postdate, ocnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['ocname'], "text"),
                       GetSQLValueString($_POST['ocsn'], "text"),
                       GetSQLValueString($_POST['ocphone'], "text"),
                       GetSQLValueString($_POST['ocmail'], "text"),
                       GetSQLValueString($_POST['ocpdprice'], "text"),
                       GetSQLValueString($_POST['octel'], "text"),
                       GetSQLValueString($_POST['occountry'], "text"),
                       GetSQLValueString($_POST['ocinname'], "text"),
					   GetSQLValueString($_POST['ocinsn'], "text"),
					   GetSQLValueString($_POST['ocpayment'], "text"),
                       GetSQLValueString($_POST['octotal'], "int"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['ocnotes1'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	foreach($_POST['dcproductname'] as $i => $val){	
  $insertSQL = sprintf("INSERT INTO demo_roomdetail (dcserial, dcroomdate, dcproductname, dcprice, dcquantiry, dcitemtotal, roomid, dcnotes1, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['D_OrderID'], "text"),
                       GetSQLValueString($_POST['dcroomdate'][$i], "date"),
                       GetSQLValueString($_POST['dcproductname'][$i], "text"),
                       GetSQLValueString($_POST['dcprice'][$i], "text"),
                       GetSQLValueString($_POST['dcquantiry'][$i], "text"),
                       GetSQLValueString($_POST['dcitemtotal'][$i], "text"),
					   GetSQLValueString($_POST['roomid'][$i], "text"),
					   GetSQLValueString($_POST['dcnotes1'][$i], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
	
	//foreach($_POST['dcproductname'] as $i => $val){
if(is_array($_POST['dcproductplusname'])) // 判斷是否為array型態
{
	  foreach($_POST['dcproductplusname'] as $k => $val2) {
		  $insertSQL = sprintf("INSERT INTO demo_roomdetail (dcserial, dcstate, dcproductname, dcprice, dcquantiry, dcitemtotal, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
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
	$insertGoTo = "room.php?wshop=" . $_POST['wshop'] . "&Opt=sendpage&lang=" . $_SESSION['lang'] . "&ID=" . $_POST['D_OrderID'] . "&PR=" . $_POST['octotal'];
	  
  /* 清空購物車 */
  foreach($_SESSION['Room_Cart_' . $_GET['wshop']] as $i => $val){
		unset ($_SESSION['Room_Cart_' . $_GET['wshop']][$i]);
		unset ($_SESSION['Room_Name'][$i]);
		unset ($_SESSION['Room_RoomPrice'][$i]);
		unset ($_SESSION['Room_RoomNum'][$i]);
		unset ($_SESSION['Room_PeopleNum'][$i]);
		unset ($_SESSION['Room_Date'][$i]);
		unset ($_SESSION['Room_ID'][$i]);
		unset ($_SESSION['Room_Quantity'][$i]);
	}
	unset ($_SESSION['Room_Cart_OrderID']); // 清除訂單編號
	
if(is_array($_SESSION['PlusId'])) // 判斷是否為array型態
{
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
	  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/room_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "親愛的 " . $_POST['ocname'] . " 您好！\n" 
			. "歡迎您在『" . $SiteName . "』訂房。\n"
			. "您的訂單編號：" . $_POST['D_OrderID'] . " \n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url . " \n\n"
			. "本信件為系統自動發送(請勿回信！！！)";
	
	  $From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $_POST['ocmail'] . "> \n\r";
	  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  $Header = $From . $Type;
	  $Subject = "=?UTF-8?B?" . base64_encode($SiteName . " 訂購成功確認通知") . "?=";
		
	  mail($_POST['ocmail'], $Subject, $Body, $Header);
	  
	  // 發送訂購通知(商家)
	  if($SiteMail != "" && $Subject != "") { // 若未填寫資訊則不寄送
	  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
	  $Url = "http://" . $DefaultSiteUrl . "/room_orders_see.php?wshop=" . $_POST['wshop']. "&Serial=" . $_POST['D_OrderID'];
	  $Body = "您的客戶 " . $_POST['ocname'] . "！於您的網站訂房\n" 
			. "訂單編號：" . $_POST['D_OrderID'] . "\n"
			. "訂購日期：" . $_POST['postdate'] . "\n"
			. "以下為所訂購詳細資訊\n\n"
			. "連結為" . $Url
			. "";
	
	  $From= "From: " . "=?UTF-8?B?" . base64_encode($SiteName) . "?=" . " <" . $SiteMail . "> \n\r";
	  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
	  $Header = $From . $Type;
	  $Subject = "=?UTF-8?B?" . base64_encode($SiteName . "訂購通知") . "?=";
		
	  mail($SiteMail, $Subject, $Body, $Header); 
	  }
	  //
	
  //header(sprintf("Location: %s", $insertGoTo));
  echo("<script language='javascript'>location.href='".$insertGoTo."'</script>");
  //ob_end_flush(); // 輸出緩衝區結束
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/reserve_purchase_check.php"); ?>
<?php } ?>
