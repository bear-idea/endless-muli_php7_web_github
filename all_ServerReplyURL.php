<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
require('vendor/autoload.php');
require_once('app/init/bootstrap.php');
require_once($Lang_GeneralPath);
?>
<style>
#__paymentButton{width:97%; margin-left:auto; margin-right:auto}
/* BOOTSTRAP REWRITE */
#__paymentButton {
	height:40px;
}
#__paymentButton {
	height:auto;
}
#__paymentButton {
	line-height:26px;
}

#__paymentButton {
	line-height:25px;
	margin-bottom:3px;
}
#__paymentButton {
	border-bottom: 3px solid rgba(0,0,0,.15);
}
#__paymentButton:hover {
	  opacity: 0.9;
	  filter: alpha(opacity=90);
	}
#__paymentButton.btn-link {
		border-bottom:0;
	}
#__paymentButton { background-color: #C02942; color: #FFF !important; }
</style>
<script language="javascript">
function passBackToParent() 
{ 
  opener.document.form1.ocCVSStoreID.value = document.childForm.CVSStoreID.value;
  opener.document.form1.ocCVSStoreName.value = document.childForm.CVSStoreName.value;
  opener.document.form1.ocaddr.value = document.childForm.CVSAddress.value; 
  window.close(); 
     
} 
</script>
<body onLoad="passBackToParent();">
<form name="childForm"> 
<table width="100%" border="0">
  <tr>
    <td width="150">超商店舖編號</td>
    <td><input name="CVSStoreID" type="text" id="CVSStoreID" value="<?php echo $_POST['CVSStoreID']; ?>" ></td>
  </tr>
  <tr>
    <td width="150">超商店舖名稱</td>
    <td><input name="CVSStoreName" type="text" id="CVSStoreName" value="<?php echo $_POST['CVSStoreName']; ?>" ></td>
  </tr>
  <tr>
    <td>超商店鋪地址</td>
    <td><input name="CVSAddress" type="text" id="CVSAddress" value="<?php echo $_POST['CVSAddress']; ?>" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div id="autoclickme">
<input type="button" value="取得超商店舖資訊" onClick="javascript: passBackToParent()">
</div>
</form>
</body>
<?php //} else { ?>
<!--<body onload='window.location="404.php"'>-->
<?php //} ?>