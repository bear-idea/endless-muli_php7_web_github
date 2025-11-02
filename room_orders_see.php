<?php require_once('Connections/DB_Conn.php'); ?>
<?php header("Content-Type:text/html;charset=utf-8"); /* 指定頁面編碼方式 IE BUG*/  ?>
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

$colname_RecordCart = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCart = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCart = sprintf("SELECT * FROM demo_roomorders WHERE oserial = %s", GetSQLValueString($colname_RecordCart, "text"));
$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
$row_RecordCart = mysqli_fetch_assoc($RecordCart);
$totalRows_RecordCart = mysqli_num_rows($RecordCart);

$colname_RecordCartDetailed = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed = sprintf("SELECT * FROM demo_roomdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
$RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
$totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username_' . $_GET['wshop']] = NULL;
  $_SESSION['MM_UserGroup_' . $_GET['wshop']] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username_' . $_GET['wshop']]);
  unset($_SESSION['MM_UserGroup_' . $_GET['wshop']]);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['success_line_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_google_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_fb_login_backstage_'.$_GET['wshop']]);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once("inc/inc_function.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富視網科技網頁設計" />
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />
<meta name="webcrawlers" content="all" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<title>訂單查詢</title>
<!-- ╭───────────────  JS LINK ────────────────╮ -->
<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<link href="admin/css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />


</head>

<body>

      	<div style="padding:20px;	border: 1px solid #CCC; margin:10px;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h4><font color="#756b5b">訂單編號：<?php echo $row_RecordCart['oserial']; ?></font></h4></td>
        </tr>
      </table><br />

      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
          <tr>
            <td width="50%">&nbsp;</td>
            <td width="50%" align="right">訂購日期：<?php echo date('Y-m-d g:i A',strtotime($row_RecordCart['postdate'])); ?></td>
          </tr>
        </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter">
<thead>
  <tr>
    <td colspan="2"><strong> 訂房者資訊</strong></td>
  </tr>
</thead>
<tbody>
  <tr>
    <td width="150" align="right">訂房者姓名：</td>
    <td><?php echo $row_RecordCart['ocname']; ?></td>
  </tr>
  <tr>
    <td align="right">身分證字號/護照號碼：</td>
    <td><?php echo $row_RecordCart['ocsn']; ?></td>
  </tr>
  <tr>
    <td align="right">連絡電話：</td>
    <td><?php echo $row_RecordCart['octel']; ?>
             <?php if ($row_RecordCart['ocphone'] !="" && $row_RecordCart['octel'] != "") {echo " / ";}?>
			 <?php echo $row_RecordCart['ocphone']; ?></td>
  </tr>
  <tr>
    <td align="right">居住地：</td>
    <td><?php echo $row_RecordCart['occountry']; ?></td>
  </tr>
  <tr>
    <td align="right">信箱：</td>
    <td><?php echo $row_RecordCart['ocmail']; ?></td>
  </tr>
  </tbody>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter">
<thead>
  <tr>
    <td colspan="2"><strong> 住房者資訊</strong></td>
  </tr>
</thead>
<tbody>
  <tr>
    <td width="150" align="right">住房者姓名：</td>
    <td><?php echo $row_RecordCart['ocinname']; ?></td>
  </tr>
  <tr>
    <td align="right">身分證字號/護照號碼：</td>
    <td><?php echo $row_RecordCart['ocinsn']; ?></td>
  </tr>
  </tbody>
</table>
      <br />
 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter">
<thead>
  <tr>
    <td colspan="2"><strong> 住房需求</strong></td>
  </tr>
</thead>
<tbody>
  <tr>
    <td width="150" align="right">補充訊息：</td>
    <td><?php echo $row_RecordCart['ocnotes1']; ?></td>
  </tr>
  </tbody>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter">
<thead>
  <tr>
    <td colspan="2"><strong>訂房資訊</strong></td>
  </tr>
</thead>
</table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
          <thead>
    <tr>
      <th width="50">編號</th>
      <th width="100" align="left"><strong>住宿日期</strong></th>
      <th align="left"><strong>房型</strong></th>
      <th width="70"><strong>價格</strong></th>
      <th width="70"><strong>房間數</strong></th>
      <th width="120">小計<strong></strong></th>
      </tr>
    </thead>
    <tbody><?php $i=1; ?>
      <?php do { ?>
        <tr>
          <td align="center"><?php echo $i; ?></td>
          <td><?php echo $row_RecordCartDetailed['dcroomdate']; ?></td>
          <td><?php echo $row_RecordCartDetailed['dcproductname']; ?><?php if ($row_RecordCartDetailed['dcstate'] == '1') {?>&nbsp;<span style="font-size:9px; background-color:#FF8000; color:#FFF; padding:2px;">加購</span><?php } ?></td>
          <td align="center"><?php echo $row_RecordCartDetailed['dcprice']; ?></td>
          <td align="center"><?php echo $row_RecordCartDetailed['dcquantiry']; ?></td>
          <td align="center"><?php echo $row_RecordCartDetailed['dcitemtotal']; ?></td>
        </tr>
        
        <?php $i++; ?>
        <?php } while ($row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed)); ?>
        <tr>
          <td colspan="5" align="right"><br />
            商品總金額：<br />
            
            總金額：<br />
            <br /></td>
          <td align="center" valign="top"><br />            <?php echo '$' . doFormatMoney($row_RecordCart['ocpdprice']); ?><br />
            
            <?php echo '$' . doFormatMoney($row_RecordCart['octotal']); ?><br />
            <br /></td>
        </tr>
    </tbody>
       <tfoot>

        </tfoot>
</table>

</div>
</body>
</html>
<?php
mysqli_free_result($RecordCart);

mysqli_free_result($RecordCartDetailed);
?>
