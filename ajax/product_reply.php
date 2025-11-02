<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// securimage 驗證碼
	require_once ('../securimage/securimage.php');
      $securimage = new Securimage();

      if ($securimage->check($_POST['ct_captcha']) == false) {
        //$errors['captcha_error'] = 'Incorrect security code entered<br />';
		//$insertGoTo = $SiteBaseUrl . url_rewrite('contact',array('wshop'=>$_POST['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable) . $operate_params . "CheckError";
  if (isset($_SERVER['QUERY_STRING'])) {
    //$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    //$insertGoTo .= $_SERVER['QUERY_STRING'];
	//header(sprintf("Location: %s", $insertGoTo));
  //setcookie("CookieGsValue",$_SERVER["REMOTE_ADDR"],time()+360); // 0.5hr
  echo "CheckError";
  //ob_end_flush(); // 輸出緩衝區結束
  exit;}
      }
// securimage END
	
date_default_timezone_set('Asia/Taipei');
$pid = $_POST['pid'];
$content = $_POST['content'];
$author = $_POST['author'];
$postdate = date("Y-m-d H:i:s");
$memberid = $_POST['mid'];
$userid = $_SESSION['userid'];

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
//list($field, $id) = explode('_', $id);

//$updateSQL = sprintf("INSERT INTO demo_productpost (content) VALUES ('Los Angeles'");
////mysqli_select_db($database_DB_Conn, $DB_Conn);
//$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//echo $_POST['writer'];
if($content != '' && $author != '' && $_SESSION['Bot_Check_Value'] == true) {
	
$insertSQL = sprintf("INSERT INTO demo_productpost (author, content, pid, postdate, memberid, userid) VALUES ('$author','$content', '$pid', '$postdate', '$memberid', '$userid')");

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  //echo $content;
  echo '<div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px; background-color:#D0E8FF">' . $_POST['content'] . '</div>'; 
}
  //echo json_encode($_POST);
?>