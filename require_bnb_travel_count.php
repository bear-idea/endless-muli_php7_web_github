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

if($_GET['htp'] == "travel" && $_GET['tid'] != "") {

$coltid_RecordTravelDate = "-1";
if (isset($_GET['tid'])) {
  $coltid_RecordTravelDate = $_GET['tid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTravelDate = sprintf("SELECT id, postdate, visit, monthvisit FROM demo_travel WHERE id = %s", GetSQLValueString($coltid_RecordTravelDate, "int"));
$RecordTravelDate = mysqli_query($DB_Conn, $query_RecordTravelDate) or die(mysqli_error($DB_Conn));
$row_RecordTravelDate = mysqli_fetch_assoc($RecordTravelDate);
$totalRows_RecordTravelDate = mysqli_num_rows($RecordTravelDate);

// 民宿熱門
// visit*0.3+postdate
  if(!isset($_SESSION['travel_viewcount'])){ //先檢查Session變數viewcount是否存在
	$_SESSION['travel_viewcount'][]=''; // 必須先給定陣列起始直
  }
  if(in_array("travel_".$_GET['tid'], $_SESSION['travel_viewcount']) == false){ // 未進入過的網站才會執行(當瀏覽器開啟時)
  if ($_COOKIE["travel_wshop_".$_GET['tid']]!=$_SERVER["REMOTE_ADDR"] || !isset($_COOKIE["travel_wshop_".$_GET['tid']])){
	  $_COOKIE["travel_wshop_".$_GET['tid']] = $_SERVER["REMOTE_ADDR"];
	  $_SESSION['travel_viewcount'][$_GET['tid']] = "travel_".$_GET['tid'];  		   //新增Session變數view，值為1
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
  
  $updateSQL = sprintf("UPDATE demo_travel SET visit=visit+1 WHERE id=%s",
                       GetSQLValueString($_GET['tid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultVisit = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $now_visit_month = getvisitmonth($row_RecordTravelDate['postdate']); // 取得拜訪月份
  $now_system_month = getvisitmonth(date("Y-m-d")); // 取得系統月份
  
  // 每月更新
  if($now_system_month - $now_visit_month == 0)
  {
	  $updateMonthSQL = sprintf("UPDATE demo_travel SET monthvisit=monthvisit+1 WHERE id=%s",
                       GetSQLValueString($_GET['tid'], "int"));

 		 //mysqli_select_db($database_DB_Conn, $DB_Conn);
  		$ResultMonthVisit = mysqli_query($DB_Conn, $updateMonthSQL) or die(mysqli_error($DB_Conn));
  }else{
	  $updateMonthSQL = sprintf("UPDATE demo_travel SET monthvisit=1 WHERE id=%s",
                       GetSQLValueString($_GET['tid'], "int"));

 		 //mysqli_select_db($database_DB_Conn, $DB_Conn);
  		$ResultMonthVisit = mysqli_query($DB_Conn, $updateMonthSQL) or die(mysqli_error($DB_Conn));
  }
  
  setcookie("travel_wshop_".$_GET['tid'] ,$_SERVER["REMOTE_ADDR"],time()+43200);
	}
  }

mysqli_free_result($RecordTravelDate);
}


?>
