<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
?>
<?php $Lang_GeneralPath = '../lang/' . $_SESSION['lang'] . '/lang_cart.php'; // 通用語系檔 ?>
<?php require_once($Lang_GeneralPath); /* 通用語系檔連結 */ ?>
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

/* 取得商品資訊 */
$colname_RecordProduct = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProduct = $_GET['id'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProduct, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);

/* 取得商品規格 */
$colname_RecordProductFormat = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductFormat = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductFormat = sprintf("SELECT * FROM demo_productformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductFormat, "text"));
$RecordProductFormat = mysqli_query($DB_Conn, $query_RecordProductFormat) or die(mysqli_error($DB_Conn));
$row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat);
$totalRows_RecordProductFormat = mysqli_num_rows($RecordProductFormat);

if ($totalRows_RecordProductFormat > 0) 
{
    $i = 0;
    do {
        if($i == $totalRows_RecordProductFormat-1){
            $fmt .= $row_RecordProductFormat['formatname'] . ":" . $_GET['fmt' . $i];
        }else{
            $fmt .= $row_RecordProductFormat['formatname'] . ":" . $_GET['fmt' . $i] . ";";
        }
        $i++;
    } while ($row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat));
}

$colname_RecordSystemConfigFr = "-1";
if (isset($_SESSION['userid'])) {
    $colname_RecordSystemConfigFr = $_SESSION['userid'];
}

$query_RecordSystemConfigFr = sprintf("SELECT CartRegSelect FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordSystemConfigFr, "int"));
$RecordSystemConfigFr = mysqli_query($DB_Conn, $query_RecordSystemConfigFr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigFr = mysqli_fetch_assoc($RecordSystemConfigFr);
$totalRows_RecordSystemConfigFr = mysqli_num_rows($RecordSystemConfigFr);


$CartRegSelect = $row_RecordSystemConfigFr['CartRegSelect']; // 是否要開啟註冊後購物功能

/* 取得會員資料 */
require_once('../require_member_get.php');	

$colname_RecordCartlist = "-1";
if (isset($_GET['id'])) {
  $colname_RecordCartlist = $_GET['id'];
}
$colfmt_RecordCartlist = "-1";
if (isset($fmt)) {
  $colfmt_RecordCartlist = $fmt;
}
$coluserid_RecordCartlist = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCartlist = $_SESSION['userid'];
}
$colmemberid_RecordCartlist = "-1";
if (isset($row_RecordMember['id'])) {
  $colmemberid_RecordCartlist = $row_RecordMember['id'];
}
$colUserAccessuniqid_RecordCartlist = "-1";
if (isset($_SESSION['UserAccess'])) {
  $colUserAccessuniqid_RecordCartlist = $_SESSION['UserAccess'];
}
$collang_RecordCartlist = "-1";
if (isset($_SESSION['lang'])) {
  $collang_RecordCartlist = $_SESSION['lang'];
}

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
    if($totalRows_RecordProductFormat > 0){
        $query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE pid = %s && Format = %s && userid=%s && memberid=%s && lang=%s ORDER BY id DESC", GetSQLValueString($colname_RecordCartlist, "text"), GetSQLValueString($colfmt_RecordCartlist, "text"),GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colmemberid_RecordCartlist, "int"),GetSQLValueString($collang_RecordCartlist, "text"));
    }else{
        $query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE pid = %s && userid=%s && memberid=%s && lang=%s ORDER BY id DESC", GetSQLValueString($colname_RecordCartlist, "text"),GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colmemberid_RecordCartlist, "int"),GetSQLValueString($collang_RecordCartlist, "text"));
    }
	
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);

}else{
	/* 取得購物車清單 無會員 */
	if($totalRows_RecordProductFormat > 0){
        $query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE pid = %s && Format = %s && userid=%s && UserAccessuniqid=%s && lang=%s ORDER BY id DESC", GetSQLValueString($colname_RecordCartlist, "text"), GetSQLValueString($colfmt_RecordCartlist, "text"),GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlist, "text"),GetSQLValueString($collang_RecordCartlist, "text"));
    }else{
        $query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE pid = %s && userid=%s && UserAccessuniqid=%s && lang=%s ORDER BY id DESC", GetSQLValueString($colname_RecordCartlist, "text"),GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlist, "text"),GetSQLValueString($collang_RecordCartlist, "text"));
    }
	
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}
?>
<?php
if($row_RecordProduct['inventorynotsale'] == "1" && $row_RecordProduct['inventory'] <= 0) {
	if(($CartRegSelect =='1' && $totalRows_RecordMember > 0) || $CartRegSelect =='0'){ /* 網站需要會原註冊且已登入狀態 */
        echo $Lang_Classify_Product_Sold_Out;  /* 已售完 */
    }else{
        echo "需登入會員";
	}
}else if($row_RecordProduct['inventorynotsale'] == "1" && ($row_RecordProduct['inventory']-$_GET['qu'])<0){
	if(($CartRegSelect =='1' && $totalRows_RecordMember > 0) || $CartRegSelect =='0'){ /* 網站需要會原註冊且已登入狀態 */
	/* 購買數量不可高於庫存量 */
	echo $Lang_Classify_Product_Insufficient_Number_Of; 
	/*echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(\"".$Lang_Classify_Product_Insufficient_Number_Of."\", 'warning');});</script>";*/
	}else{
        echo "需登入會員";
	}
}else{
    //if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] != "") {
	if(($CartRegSelect =='1' && $totalRows_RecordMember > 0) || $CartRegSelect =='0'){ /* 網站需要會原註冊且已登入狀態 */
    if ($totalRows_RecordCartlist > 0) {
		echo $Lang_Classify_Do_Not_Repeat_The_Purchase; /* 該商品已存在購物清單中 */
			/*echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(\"".$Lang_Classify_Do_Not_Repeat_The_Purchase."\", 'warning');});</script>";*/
		}else{
			
			/*$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][] = $_GET['id'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][] = $row_RecordProduct['pdseries'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][] = $row_RecordProduct['name'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][] = $_GET['pr'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][] = $_GET['prsp'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][] = $_GET['qu'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][] = '';
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][] = $fmt;
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][] = $_GET['spfmt'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Pic'][] = $_GET['pic'];*/
			//echo $_GET['pic'];
			$insertSQL = sprintf("INSERT INTO demo_cart (pid, name, pdseries, price, spprice, quantity, pic, Format, SpFormat, discounttype, discountid, notes1, lang, memberid, UserAccessuniqid, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['id'], "text"),
                       GetSQLValueString($row_RecordProduct['name'], "text"),
                       GetSQLValueString($row_RecordProduct['pdseries'], "text"),
                       GetSQLValueString($_GET['pr'], "int"),
                       GetSQLValueString($_GET['prsp'], "int"),
                       GetSQLValueString($_GET['qu'], "int"),
					   GetSQLValueString($_GET['pic'], "text"),
					   GetSQLValueString(@$fmt, "text"),
					   GetSQLValueString(@$_GET['spfmt'], "text"),
					   GetSQLValueString($row_RecordProduct['discounttype'], "int"),
					   GetSQLValueString($row_RecordProduct['discountid'], "int"),
                       GetSQLValueString('', "text"),
					   GetSQLValueString($_SESSION['lang'], "text"),
					   GetSQLValueString($row_RecordMember['id'], "int"),
					   GetSQLValueString($_SESSION['UserAccess'], "text"),
                       GetSQLValueString($_SESSION['userid'], "int"));
		
		    //mysqli_select_db($database_DB_Conn, $DB_Conn);
		    $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
			echo $Lang_Classify_Added_To_Cart;
			/*echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(\"".$Lang_Classify_Added_To_Cart."\",'success');});</script>";*/
		}
	/*}else{
		    if ($totalRows_RecordProductFormat > 0) 
			{
			$i = 0;
			do {
				if($i == $totalRows_RecordProductFormat-1){
					$fmt .= $row_RecordProductFormat['formatname'] . ":" . $_GET['fmt' . $i];
				}else{
					$fmt .= $row_RecordProductFormat['formatname'] . ":" . $_GET['fmt' . $i] . ";";
				}
				$i++;
			} while ($row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat));
		    }
		    $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][] = $_GET['id'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][] = $row_RecordProduct['pdseries'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][] = $row_RecordProduct['name'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][] = $_GET['pr'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][] = $_GET['prsp'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][] = $_GET['qu'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][] = '';
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][] = $fmt;
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][] = $_GET['spfmt'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Pic'][] = $_GET['pic'];
			echo $Lang_Classify_Added_To_Cart; 
			
	}*/
	}else{
        echo "需登入會員";
	}
}
?>
<?php
mysqli_free_result($RecordProduct);

mysqli_free_result($RecordProductFormat);

mysqli_free_result($RecordCartlist);
?>
