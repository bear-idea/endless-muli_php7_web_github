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
$query_RecordCart = sprintf("SELECT * FROM demo_cartorders WHERE oserial = %s", GetSQLValueString($colname_RecordCart, "text"));
$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
$row_RecordCart = mysqli_fetch_assoc($RecordCart);
$totalRows_RecordCart = mysqli_num_rows($RecordCart);

$colname_RecordCartDetailed = "-1";
if (isset($_GET['Serial'])) {
  $colname_RecordCartDetailed = $_GET['Serial'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartDetailed = sprintf("SELECT * FROM demo_cartdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
$RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
$row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
$totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);

$colname_RecordCartListFreight = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListFreight = $_GET['lang'];
}
$coluserid_RecordCartListFreight = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCartListFreight = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListFreight = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListFreight, "text"),GetSQLValueString($coluserid_RecordCartListFreight, "int"));
$RecordCartListFreight = mysqli_query($DB_Conn, $query_RecordCartListFreight) or die(mysqli_error($DB_Conn));
$row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
$totalRows_RecordCartListFreight = mysqli_num_rows($RecordCartListFreight);
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
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
<style>
.TBSort_spboard{background-color:#666; -webkit-border-radius: 3px;-moz-border-radius: 3px; border-radius: 3px; padding:2px; color:#FFF; margin:2px;}
.keytag a{background-color:#F5F5F5;padding:3px 5px;margin:2px;color:#000;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;display:inline-block}
.keytag a:link{background-color:#F5F5F5;padding:3px 5px;margin:2px;color:#000;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 2px inset;display:inline-block}
.keytag a:visited{text-decoration:none;color:#000}
.keytag a:hover{text-decoration:none;background-color:#F90;color:#FFF}
</style>
</head>

<body>

<div style="background-color:#d3d3d3; padding:2px 2px; width:98%; margin-right:auto; margin-left:auto; margin-top:10px; " class="rounded ">
  <?php if ($totalRows_RecordCart > 0) { // Show if recordset not empty ?>
  <div style="background-color:#f1f1f1; padding:5px;" class="rounded">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
      <tr>
        <td><h4><sapn style="color#756b5b">訂單編號：<?php echo $row_RecordCart['oserial']; ?></span><span style="float:right">訂購日期：<?php echo date('Y-m-d g:i A',strtotime($row_RecordCart['postdate'])); ?></span></h4></td>
        </tr>
    </table>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      <tr>
        <td width="50%">
          <p>
            訂購人：<?php echo $row_RecordCart['ocbuyname']; ?><br />
            <?php if ($row_RecordCart['ocbuytel'] !="" || $row_RecordCart['ocbuyphone'] != "") {?>
            連絡電話：<?php } ?><?php echo $row_RecordCart['ocbuytel']; ?>
            <?php if ($row_RecordCart['ocbuyphone'] !="" && $row_RecordCart['ocbuytel'] != "") {echo " / ";}?>
            <?php echo $row_RecordCart['ocbuyphone']; ?></p>
            電子郵件：<?php echo $row_RecordCart['ocbuymail']; ?>
          </td>
        <td width="50%">
          <p>
            收貨人：<?php echo $row_RecordCart['ocname']; ?><br />
            <?php if ($row_RecordCart['octel'] !="" || $row_RecordCart['ocphone'] != "") {?>
            連絡電話：<?php } ?><?php echo $row_RecordCart['octel']; ?>
            <?php if ($row_RecordCart['ocphone'] !="" && $row_RecordCart['octel'] != "") {echo " / ";}?>
            <?php echo $row_RecordCart['ocphone']; ?></p>
            電子郵件：<?php echo $row_RecordCart['ocmail']; ?>
          </td>
        </tr>
    </table>
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      <thead>
        <tr>
          <th width="50">編號</th>
          <th width="100" align="left">貨號</th>
          <th align="left"><strong>商品名稱</strong></th>
          <th width="70"><strong>商品數量</strong></th>
          <th width="200">備註</th>
          <th width="120">折扣後小計<strong></strong></th>
          </tr>
      </thead>
      <tbody><?php $i=1; ?>
        <?php do { ?>
          <tr>
            <td align="center"><?php echo $i; ?></td>
            <td><?php echo $row_RecordCartDetailed['pdseries']; ?></td>
            <td><?php echo $row_RecordCartDetailed['dcproductname']; ?><?php if ($row_RecordCartDetailed['dcstate'] == '1') {?>&nbsp;<span style="font-size:9px; background-color:#FF8000; color:#FFF; padding:2px;">加購</span><?php } ?><?php if($row_RecordCartDetailed['dcformat'] != "") { ?>
                              <span class="keytag">
                                <?php $arr_tag = explode(';', $row_RecordCartDetailed['dcformat']); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<a>".$arr_tag[$fi]."</a>";}?>
                              </span>
                              <?php } ?>
                              <?php if($row_RecordCartDetailed['dcspformat'] != "") { ?><div class="keytag"><?php echo "<a>".$row_RecordCartDetailed['dcspformat']."</a>";?></div><?php } ?>
                              </td>
            <td align="center"><?php echo $row_RecordCartDetailed['dcquantiry']; ?></td>
            <td><?php echo $row_RecordCartDetailed['dcnotes1']; ?></td>
            <td align="center"><?php echo $row_RecordCartDetailed['dcitemtotal']; ?></td>
          </tr>
          
          <?php $i++; ?>
          <?php } while ($row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed)); ?>
        <tr>
          <td colspan="6" align="center"><br />
            <div>
            <span class="TBSort_spboard">商品總額</span><?php echo $row_RecordCart['ocpdprice'];?>
            <?php if ($row_RecordCart['ocfreightprice'] != "") { ?>
            +<span class="TBSort_spboard">運費</span><?php echo $row_RecordCart['ocfreightprice'];?>
            <?php } ?>
            <?php if ($row_RecordCart['ocotherprice'] != "") { ?>
            +<span class="TBSort_spboard">金物流加收</span><?php echo $row_RecordCart['ocotherprice'];?>
            <?php } ?>
            <?php if ($row_RecordCart['ocexprice'] != "" && $row_RecordCart['ocexprice'] != "0") { ?>
            +<span class="TBSort_spboard"><?php echo $row_RecordCart['ocexpricename'];?></span><?php echo $row_RecordCart['ocexprice'];?>
            <?php } ?>
            <?php if ($row_RecordCart['ocinvoiceprice'] != "" && $row_RecordCart['ocinvoiceprice'] != 0) { ?>
            +<span class="TBSort_spboard">發票稅</span><?php echo $row_RecordCart['ocinvoiceprice'];?>
            <?php } ?>
            <?php if ($row_RecordCart['ocDiscountShowAlldiscount_type_5'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_5'] != 0) { ?>
            -<span class="TBSort_spboard">全單滿額折扣</span><?php echo $row_RecordCart['ocDiscountShowAlldiscount_type_5'];?>
            <?php } ?>
            <?php if ($row_RecordCart['ocDiscountShowAlldiscount_type_6'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_6'] != 0) { ?>
            -<span class="TBSort_spboard">全單滿額減價</span><?php echo $row_RecordCart['ocDiscountShowAlldiscount_type_6'];?>
            <?php } ?>
            = <span style="color:#900; font-weight:bolder; font-size:36px"><?php echo $row_RecordCart['ocpdprice']+$row_RecordCart['ocfreightprice']+$row_RecordCart['ocotherprice']+$row_RecordCart['ocexprice']+$row_RecordCart['ocinvoiceprice']-$row_RecordCart['ocDiscountShowAlldiscount_type_5']-$row_RecordCart['ocDiscountShowAlldiscount_type_6']; ?></span>
            </div>
            <div style="font-size:14px">
                            <?php if ($row_RecordCart['ocfreepricedesc'] != "") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> <?php echo $row_RecordCart['ocfreepricedesc'] ?></span><?php } ?><?php if ($row_RecordCart['ocfreightstateonly'] == "1") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> 消費者自填運費</span><?php } ?><?php if ($row_RecordCart['ocfreightstateonly'] == "2") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> 業者填寫運費</span><?php } ?><?php if ($row_RecordCart['ocfreightstateonly'] == "3") { ?><br/><span style="color:#F00; font-weight:bolder"><i class="fa fa-exclamation-circle"></i> 滿額免運費</span><?php } ?>
                            </div>
                             <div style="height:5px;"></div>
            <br />
            <br /></td>
        </tr>
      </tbody>
      <tfoot>
        
      </tfoot>
    </table>
    <div style="height:5px;"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
      <tr>
        <td colspan="2">
        <?php if($row_RecordCart['ocinvoiceformat'] != "") { ?>
        <div>
        <strong style="color:#333; font-size:18px">【發票資訊】</strong><br />
        <div style="margin-left:8px;">
        <span class="TBSort_spboard">發票類型</span>
          <?php 
			   switch($row_RecordCart['ocinvoiceformat'])
			        {
						case "0":
						echo "不開發票";
						$ocinvoiceformat = "不開發票";
						break;
						case "1":
						echo "二聯式發票";
						$ocinvoiceformat = "二聯式發票";
						break;
						case "2":
						echo "三聯式發票";
						$ocinvoiceformat = "三聯式發票";
						break;
						case "3":
						echo "電子式發票";
						$ocinvoiceformat = "電子式發票";
						if ($row_RecordCart['ocinvoiceetselect'] == '0') {
							echo "<span class=\"TBSort_spboard\">需列印寄送</span>";
						}
						if ($row_RecordCart['ocinvoiceetselect'] == '1') {
							echo "<span class=\"TBSort_spboard\">載具條碼</span>";
							echo $row_RecordCart['ocinvoicesupportno'];
						}
						if ($row_RecordCart['ocinvoiceetselect'] == '2') {
							echo "<span class=\"TBSort_spboard\">愛心碼</span>";
							echo $row_RecordCart['ocinvoiceloveno'];
						}
						break;
						case "4":
						echo "收據";
						$ocinvoiceformat = "收據";
						break;
						case "5":
						echo "捐給慈善單位";
						$ocinvoiceformat = "捐給慈善單位";
						break;
					}
			  ?> 
              <?php if ($row_RecordCart['ocinvoiceusername'] != "") { ?>
              <span class="TBSort_spboard">收件人</span><?php echo $row_RecordCart['ocinvoiceusername']; ?>
              <?php } ?>
              <?php if ($row_RecordCart['ocinvoicetitle'] != "") { ?>
              <span class="TBSort_spboard">發票抬頭</span><?php echo $row_RecordCart['ocinvoicetitle']; ?>
              <?php } ?>
              <?php if ($row_RecordCart['ocinvoicecompanyno'] != "") { ?>
              <span class="TBSort_spboard">統一編號</span><?php echo $row_RecordCart['ocinvoicecompanyno']; ?>
              <?php } ?>
              <?php if ($row_RecordCart['ocinvoiceaddr'] != "") { ?>
              <div style="height:5px;"></div><span class="TBSort_spboard">收件地址</span><?php echo $row_RecordCart['ocinvoiceaddr']; ?>
              <?php } ?>
              </div>
              <hr>
              </div>
        <?php } ?>
              <div style="height:5px;"></div>  
              <div style="margin-left:8px;">
              <span class="TBSort_spboard">付款方式</span>
              <?php 
			  	if ($row_RecordCart['ocpaymentselect'] == 'lingui') {
					$ocpaymentselect = "金融匯款";
				}else if ($row_RecordCart['ocpaymentselect'] == 'atm'){
					$ocpaymentselect = "ATM轉帳";
				}else if ($row_RecordCart['ocpaymentselect'] == 'postoffice'){
					$ocpaymentselect = "郵政劃撥";
				}else if ($row_RecordCart['ocpaymentselect'] == 'other'){
					$ocpaymentselect = "其他付款方式";
				}else if ($row_RecordCart['ocpaymentselect'] == 'payondelivery'){
					$ocpaymentselect = "貨到付款";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay'){
					$ocpaymentselect = "綠界金流";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay_Credit'){
					$ocpaymentselect = "綠界金流 - 信用卡一次付清";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay_BARCODE'){
					$ocpaymentselect = "綠界金流 - 超商條碼";
				}else if ($row_RecordCart['ocpaymentselect'] == 'allpay_CVS'){
					$ocpaymentselect = "綠界金流 - 超商代碼";
				}else if ($row_RecordCart['ocpaymentselect'] == 'pchomepay'){
					$ocpaymentselect = "PCHOMEPAY";
				}else if ($row_RecordCart['ocpaymentselect'] == 'paypal'){
					$ocpaymentselect = "PAYPAL";
				}
					echo $ocpaymentselect;
			  ?>
              <div style="height:5px;"></div>
              <span class="TBSort_spboard">運送方式</span> <?php require("require_manage_cart_index_transit.php"); ?>
              <div style="height:5px;"></div>
              <span class="TBSort_spboard">配送地址</span> <?php echo $row_RecordCart['ocaddr']; ?><?php if($row_RecordCart['ocCVSStoreName'] != "") { ?>【<?php echo $row_RecordCart['ocCVSStoreName']; // 商店名稱?>】<?php } ?>
              <div style="height:5px;"></div>  
              <span class="TBSort_spboard">補充說明</span><?php echo $row_RecordCart['ocnotes1']; ?>
              <div style="height:5px;"></div>  
              <span class="TBSort_spboard">業者備註</span><?php echo $row_RecordCart['ocnotes3']; ?>
              </div>
          </td>
      </tr>
      <tr>
        <td width="120" align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_RecordCart == 0) { // Show if recordset empty ?>
    目前資料庫無此訂單資料
  <?php } // Show if recordset empty ?>
</div>
</body>
</html>
<?php
mysqli_free_result($RecordCart);

mysqli_free_result($RecordCartDetailed);

mysqli_free_result($RecordCartListFreight);
?>
