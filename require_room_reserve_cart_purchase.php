<?php require_once('Connections/DB_Conn.php'); ?>
<?php 
	if(!isset($_SESSION['Room_Cart_OrderID'])){
		$_SESSION['Room_Cart_OrderID'] = date("YmdHis") . substr(md5(uniqid(rand())), 0, 10);  
	}
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.Cart_Purchase {
}
.Cart_Purchase tr{
}
.Cart_Purchase tr td{
	margin: 5px;
	padding: 5px;
	border: 1px solid #ddd;
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script><script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td>
	  <?php echo $Lang_Title_Cart_Purchase; // 標題文字 ?></td>
    </tr>
</table>
<?php
#
# ============== [/title] ============== #
?> 
<br />

<?php if(isset($_SESSION['Room_Cart_' . $_GET['wshop']] )){ ?>
<form id="form1" name="form1" method="post" action="cart.php?Opt=purchasecheckpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
訂單編號：<font color="#0033FF"><?php echo $_SESSION['OrderID']; ?></font> <br />
<br />

  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Cart_Purchase">
    <tr>
      <td width="150" align="right"><span class="Form_Required_Item">*</span>姓名：</td>
      <td><span id="CartName">
        <label for="ocname"></label>
        <input name="ocname" type="text" id="ocname" maxlength="20" />
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span><span class="Form_Caption_Word">請填寫真實的中文姓名。</span></td>
    </tr>
    <tr>
      <td align="right">電話：</td>
      <td><span id="Carttel">
        <label for="octel"></label>
        <input name="octel" type="text" id="octel" maxlength="30" />
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span><span class="Form_Caption_Word">建議填寫，以便聯絡。</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>行動電話：</td>
      <td><span id="CartPhone">
      <label for="ocphone"></label>
      <input type="text" name="ocphone" id="ocphone" />
      <span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldRequiredMsg">需要有一個值。</span></span><span class="Form_Caption_Word">建議填寫，以便聯絡。</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>信箱：</td>
      <td><span id="CartMail">
      <label for="ocmail"></label>
      <input name="ocmail" type="text" id="ocmail" />
      <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
    </tr>
    <tr>
      <td align="right" valign="top">補充訊息：</td>
      <td><span id="CartNotes1">
        <label for="ocnotes1"></label>
        <textarea name="ocnotes1" id="ocnotes1" cols="45" rows="5"></textarea>
        <span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="reset" name="button" id="button" value="清空" />
      <input type="submit" name="button2" id="button2" value="下一步" />
      <input type="button" name="button3" id="button3" value="回上一頁" onclick="history.back(-1)"/>
      <input type="hidden" name="hiddenField" id="hiddenField" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php } else { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><p>您購物車中的商品已全部移除！ <br />
或尚未選購商品！ <br />
若您想繼續選購，請按下方「繼續購物」鈕<br />
<br />
<a href="product.php?Opt=viewpage&amp;tp=Product&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></p></td>
  </tr>
</table>
<?php } ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("CartName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("Carttel", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("CartPhone", "phone_number", {validateOn:["blur"], format:"phone_custom", pattern:"0000000000"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("CartMail", "email", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("CartNotes1", {validateOn:["blur"], isRequired:false, maxChars:200});
</script>
<?php } else { ?>
<?php include($TplPath . "/reserve_purchase.php"); ?>
<?php } ?>
