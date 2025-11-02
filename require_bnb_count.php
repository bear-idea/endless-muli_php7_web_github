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

$colname_RecordBnbDate = "-1";
if (isset($_GET['id'])) {
  $colname_RecordBnbDate = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBnbDate = sprintf("SELECT id, postdate, visit, plusscore, monthvisit, regdate FROM demo_bnb WHERE userid = %s", GetSQLValueString($colname_RecordBnbDate, "int"));
$RecordBnbDate = mysqli_query($DB_Conn, $query_RecordBnbDate) or die(mysqli_error($DB_Conn));
$row_RecordBnbDate = mysqli_fetch_assoc($RecordBnbDate);
$totalRows_RecordBnbDate = mysqli_num_rows($RecordBnbDate);

// 民宿熱門
// visit*0.3+postdate
  if(!isset($_SESSION['bnb_viewcount'])){ //先檢查Session變數viewcount是否存在
	$_SESSION['bnb_viewcount'][]=''; // 必須先給定陣列起始直
  }
  if(in_array("bnb_".$_GET['id'], $_SESSION['bnb_viewcount']) == false){ // 未進入過的網站才會執行(當瀏覽器開啟時)
  if ($_COOKIE["bnb_wshop_".$_GET['id']]!=$_SERVER["REMOTE_ADDR"] || !isset($_COOKIE["bnb_wshop_".$_GET['id']])){
	  $_COOKIE["bnb_wshop_".$_GET['id']] = $_SERVER["REMOTE_ADDR"];
	  $_SESSION['bnb_viewcount'][$_GET['id']] = "bnb_".$_GET['id'];  		   //新增Session變數view，值為1
// 瀏覽數 - 熱門
  function getvisitmonth($date) // 取得月份
		{
			$strtime = $date;
			$strtimes = explode(" ",$strtime);
			$timearray = explode("-",$strtimes[0]);
			$year = $timearray[0];
			$month = $timearray[1];
			$day = $timearray[2];
			return $month;
		}
  
  $updateSQL = sprintf("UPDATE demo_bnb SET visit=visit+1 WHERE userid=%s",
                       GetSQLValueString($_GET['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultVisit = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $now_visit_month = getvisitmonth($row_RecordBnbDate['postdate']); // 取得拜訪月份
  $now_system_month = getvisitmonth(date("Y-m-d")); // 取得系統月份
  
  // 每月更新
  if($now_system_month - $now_visit_month == 0)
  {
	  $updateMonthSQL = sprintf("UPDATE demo_bnb SET monthvisit=monthvisit+1 WHERE userid=%s",
                       GetSQLValueString($_GET['id'], "int"));

 		 //mysqli_select_db($database_DB_Conn, $DB_Conn);
  		$ResultMonthVisit = mysqli_query($DB_Conn, $updateMonthSQL) or die(mysqli_error($DB_Conn));
  }else{
	  $updateMonthSQL = sprintf("UPDATE demo_bnb SET monthvisit=1 WHERE userid=%s",
                       GetSQLValueString($_GET['id'], "int"));

 		 //mysqli_select_db($database_DB_Conn, $DB_Conn);
  		$ResultMonthVisit = mysqli_query($DB_Conn, $updateMonthSQL) or die(mysqli_error($DB_Conn));
  }
  
  setcookie("bnb_wshop_".$_GET['id'] ,$_SERVER["REMOTE_ADDR"],time()+43200);
	}
  }

mysqli_free_result($RecordBnbDate);
?>
<?php require_once('require_bnb_travel_count.php'); ?>