<?php require_once('Connections/DB_Conn.php'); ?>
<?php 
//namespace App\Init;
use Detection\MobileDetect;
use Illuminate\Container\Container;
use Illuminate\Support\Collection; 
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model as Eloquent; 
use Illuminate\Http\Request;
use App\Eloquent\Admin;
use Carbon\Carbon;
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

$viewcount_today = date("Y-m-d");

$colname_RecordTotleGetViewCount = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordTotleGetViewCount = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTotleGetViewCount = sprintf("SELECT * FROM demo_viewcount WHERE userid = %s", GetSQLValueString($colname_RecordTotleGetViewCount, "int"));
$RecordTotleGetViewCount = mysqli_query($DB_Conn,$query_RecordTotleGetViewCount) or die(mysqli_error($DB_Conn));
$row_RecordTotleGetViewCount = mysqli_fetch_assoc($RecordTotleGetViewCount);
$totalRows_RecordTotleGetViewCount = mysqli_num_rows($RecordTotleGetViewCount);

$colname_RecordGetAdminHot = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordGetAdminHot = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordGetAdminHot = sprintf("SELECT hot, webenabledate, plushot FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordGetAdminHot, "int"));
$RecordGetAdminHot = mysqli_query($DB_Conn,$query_RecordGetAdminHot) or die(mysqli_error($DB_Conn));
$row_RecordGetAdminHot = mysqli_fetch_assoc($RecordGetAdminHot);
$totalRows_RecordGetAdminHot = mysqli_num_rows($RecordGetAdminHot);

// 清空資料表 Start
$viewcount_today = date("Y-m-d"); // 取得今天日期

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordGetToday = "SELECT view_time, id FROM demo_viewcount ORDER BY id DESC limit 1";
$RecordGetToday = mysqli_query($DB_Conn, $query_RecordGetToday) or die(mysqli_error($DB_Conn));
$row_RecordGetToday = mysqli_fetch_assoc($RecordGetToday);
$totalRows_RecordGetToday = mysqli_num_rows($RecordGetToday);

// 清空資料表
$Last_View_Date = date("Y-m-d",strtotime($row_RecordGetToday['view_time']));
if($Last_View_Date != $viewcount_today){
	$sql = "TRUNCATE TABLE demo_viewcount;";
	mysqli_query($DB_Conn, $sql);
}
// 清空資料表 End
$view_ytime = date('Y-m-d',strtotime($row_RecordAccount['yhotdate']));
$view_mtime = date('Y-m',strtotime($row_RecordAccount['yhotdate']));

if(strtotime($view_ytime) < strtotime(date("Y-m-d"))) {
    $updateAdminSQLyHot = "UPDATE demo_admin SET yhot=nhot WHERE id = " . $_SESSION['userid']; // 保留昨日人數
	$ResultyHot = mysqli_query($DB_Conn, $updateAdminSQLyHot) or die(mysqli_error($DB_Conn));	
	
	$updateAdminSQLyHot = "UPDATE demo_admin SET mhot=mhot+nhot WHERE id = " . $_SESSION['userid']; // 保留昨日人數
	$ResultyHot = mysqli_query($DB_Conn, $updateAdminSQLyHot) or die(mysqli_error($DB_Conn));	
	
	$updateAdminSQLnHot = "UPDATE demo_admin SET nhot=0 WHERE id = " . $_SESSION['userid']; // 初始化當日人數
	$ResultnHot = mysqli_query($DB_Conn, $updateAdminSQLnHot) or die(mysqli_error($DB_Conn));
}
if(strtotime($view_mtime) < strtotime(date("Y-m"))) {
	$updateAdminSQLyHot = "UPDATE demo_admin SET ymhot=mhot WHERE id = " . $_SESSION['userid']; // 保留昨日人數
	$ResultyHot = mysqli_query($DB_Conn, $updateAdminSQLyHot) or die(mysqli_error($DB_Conn));	
	
	$updateAdminSQLyHot = "UPDATE demo_admin SET mhot=0 WHERE id = " . $_SESSION['userid']; // 初始化當月人數
	$ResultyHot = mysqli_query($DB_Conn, $updateAdminSQLyHot) or die(mysqli_error($DB_Conn));
}
/*if($view_ytime < date("Y-m-d", strtotime('-1 day'))) { // 更新當日時間
	$updateAdminSQL = "UPDATE demo_admin SET nhot=0 WHERE id = " . $_SESSION['userid'];
	
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
}*/
?>
<?php 
	function margin_cut($begin, $end){ 
		$datetime_start = new DateTime($begin);  
		$datetime_end = new DateTime($end);  
		$day = $datetime_start->diff($datetime_end)->days;
		if($datetime_start > $datetime_end){
			return -$day;
		}else{
			return $day;
		}
   } 
?>
<?php 
// 整站統計
if(!isset($_SESSION['viewcount'])){ //先檢查Session變數viewcount是否存在
	$_SESSION['viewcount'][]=''; // 必須先給定陣列起始直
}
if(in_array($_GET['wshop'], $_SESSION['viewcount']) == false && $_GET['wshop'] != ''){ // 未進入過的網站才會執行(當瀏覽器開啟時)
	if (isset($_COOKIE["wshop_".$_GET['wshop']]) && $_COOKIE["wshop_".$_GET['wshop']] == $_SERVER["REMOTE_ADDR"]){
	}else{
	  $_COOKIE["wshop_".$_GET['wshop']] = $_SERVER["REMOTE_ADDR"];
//if(!isset($_SESSION['view'][])){ //先檢查Session變數view是否存在
	$_SESSION['viewcount'][$_GET['wshop']] = $_GET['wshop'];  		   //新增Session變數view，值為1
	$view_time=date("Y-m-d H:i:s");    //變數$viewtime瀏覽時間
	$view_ip=$_SERVER['REMOTE_ADDR'];  //變數$viewip記錄瀏覽者的IP
	$view_shop=$_SESSION['userid'];
	
	//指定新增資料至viewcount資料表的SQL指令
	$insertView="INSERT INTO demo_viewcount (view_time,view_ip,userid) VALUES ('$view_time', '$view_ip', '$view_shop')";
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$Result = mysqli_query($DB_Conn,$insertView) or die(mysqli_error($DB_Conn));
	
	// 計算相差天數
	$nt_end = date('Y-m-d',strtotime($row_RecordGetAdminHot['webenabledate'])); // 網站啟用時間
	$nt_now = date("Y-m-d"); // 目前時間
	$nt_dt = margin_cut($nt_end, $nt_now); // 相差天數
	//echo $nt_dt;
	
	// 取得目前計數(Hot值)
	if ($totalRows_RecordGetAdminHot > 0 ){$now_hot = $row_RecordGetAdminHot['hot'];}else{$now_hot = 0;} 
	
	if($nt_dt <= 3){ // 3天之內 自動提升排名(最大化)
	    $plus_hot  = 1000000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
	}else if ($nt_dt > 3 && $nt_dt <= 7){ // 3-7天之內 排名(500000)
	    $plus_hot  = 500000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));  
	}else if ($nt_dt > 7 && $nt_dt <= 15){ // 7-15天之內 排名(100000)
	    $plus_hot  = 100000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
	}else if ($nt_dt > 15 && $nt_dt <= 20){ // 15-20天之內 排名(+5000)
	    $plus_hot  = 50000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
	}else if ($nt_dt > 20 && $nt_dt <= 24){ // 15-30天之內 排名(+5000)
		$plus_hot  = 25000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));  
	}else if ($nt_dt > 24 && $nt_dt <= 28){ // 15-30天之內 排名(+5000)
		$plus_hot  = 10000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
	}else if ($nt_dt > 28 && $nt_dt < 30){ // 15-30天之內 排名(+5000)
		$plus_hot  = 5000;
		$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
	}else{
		if($row_RecordGetAdminHot['plushot'] != 0) {
			$plus_hot  = 0;
			$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW(), plushot=" . $plus_hot . " WHERE id = " . $_SESSION['userid'];
		  /*執行更新動作*/
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
		}else{
			$updateAdminSQL = "UPDATE demo_admin SET hot=hot+1, nhot=nhot+1, yhotdate=NOW() WHERE id = " . $_SESSION['userid'];
		  /*執行更新動作*/
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result = mysqli_query($DB_Conn, $updateAdminSQL) or die(mysqli_error($DB_Conn));
		}
	}
	setcookie("wshop_".$_GET['wshop'] ,$_SERVER["REMOTE_ADDR"],time()+43200); // 12hr
}
}

/*$deleteSQL = sprintf("DELETE FROM demo_viewcount WHERE userid=%s",
                       GetSQLValueString("16", "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn,$deleteSQL) or die(mysqli_error($DB_Conn));*/

// 更新Blog人氣值
if (isset($_GET['tp']) && $_GET['tp'] == 'Blog' && $_GET['Opt'] == 'detailed')
{
	if(in_array($_GET['wshop'], $_SESSION['viewcount']) == false){ // 未進入過的網站才會執行(當瀏覽器開啟時)
	if ($_COOKIE["blog_wshop_".$_GET['wshop']]!=$_SERVER["REMOTE_ADDR"] || !isset($_COOKIE["blog_wshop_".$_GET['wshop']])){
	  $_COOKIE["blog_wshop_".$_GET['wshop']] = $_SERVER["REMOTE_ADDR"];
	  $updateSQL = "UPDATE demo_blog SET viewcount=viewcount+1 WHERE id = " . $_SESSION['userid'];
	  /*執行更新動作*/
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn,$updateSQL) or die(mysqli_error($DB_Conn));
	  setcookie("blog_wshop_".$_GET['wshop'] ,$_SERVER["REMOTE_ADDR"],time()+43200);
	}
	}
}
?>
<?php
mysqli_free_result($RecordTotleGetViewCount);

mysqli_free_result($RecordGetAdminHot);

mysqli_free_result($RecordGetToday);
?>