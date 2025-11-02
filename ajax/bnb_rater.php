<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
ob_start(); // 開啟輸出緩衝區 
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
//echo "\n第{$_REQUEST['number']}颗星星，值为{$_REQUEST['value']} 为{$_REQUEST['id']}";
$starnumber = $_REQUEST['number'];
$starvalue = $_REQUEST['value'];
$userid = $_REQUEST['id'];
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

$colname_RecordBnbRater = "-1";
if (isset($_GET['id'])) {
  $colname_RecordBnbRater = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBnbRater = sprintf("SELECT * FROM demo_bnbrater WHERE userid = %s", GetSQLValueString($colname_RecordBnbRater, "int"));
$RecordBnbRater = mysqli_query($DB_Conn, $query_RecordBnbRater) or die(mysqli_error($DB_Conn));
$row_RecordBnbRater = mysqli_fetch_assoc($RecordBnbRater);
$totalRows_RecordBnbRater = mysqli_num_rows($RecordBnbRater);

if(!isset($_SESSION['bnb_rater_count'])){ //先檢查Session變數ratercount是否存在
	$_SESSION['bnb_rater_count'][]=''; // 必須先給定陣列起始直
  }
  if(in_array("bnb_rater_".$_GET['id'], $_SESSION['bnb_rater_count']) == false){ // 未進入過的網站才會執行(當瀏覽器開啟時)
  if ($_COOKIE["bnb_rater_".$_GET['id']]!=$_SERVER["REMOTE_ADDR"] || !isset($_COOKIE["bnb_rater_".$_GET['id']])){
	  $_COOKIE["bnb_rater_".$_GET['id']] = $_SERVER["REMOTE_ADDR"];
	  $_SESSION['bnb_rater_count'][$_GET['id']] = "bnb_rater_".$_GET['id'];  		   //新增Session變數view，值為1
// 預設資料新增
if($totalRows_RecordBnbRater == 0)
{
	for($i=1; $i<=10; $i++)
	{
		$insertSQL = sprintf("INSERT INTO demo_bnbrater (starnumber, userid) VALUES ('$i','$userid')");
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
}
//$updateSQL = sprintf("UPDATE demo_news SET (rater) VALUES ('$rater') WHERE (id) VALUES ('$id')");

// 更新評分
$updateSQL = sprintf("UPDATE demo_bnbrater SET starvalue=starvalue+1 WHERE starnumber=%s && userid=%s",
					 GetSQLValueString($_GET['number'], "int"),
					 GetSQLValueString($_GET['id'], "int"));
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

// 投票次數
$updateSQL1 = sprintf("UPDATE demo_bnb SET ratercount=ratercount+1 WHERE userid=%s",
					 GetSQLValueString($_GET['id'], "int"));
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL1) or die(mysqli_error($DB_Conn));


echo '您的評分為' . $_REQUEST['value'] . '顆星';

setcookie("bnb_rater_".$_GET['id'] ,$_SERVER["REMOTE_ADDR"],time()+886400);
	}else{echo '請勿重複評分!!';}
  }else{echo '請勿重複評分!!';}
/*echo json_encode($_POST);*/

mysqli_free_result($RecordBnbRater);
?>
