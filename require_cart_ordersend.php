<?php if ($MSTMP == 'default') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td>
	  <?php echo $Lang_Title_Cart_Send; // 標題文字 ?></td>
    </tr>
</table>
<br />
<?php if($_GET['ID'] != "" && $_GET['PR'] != ""){ ?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" valign="center" align="center">恭喜，訂單送出成功！請記下您的訂單號，以便日後查詢。<br />
      <br />
      您的訂單號碼是：<strong><?php echo $_GET['ID']; ?></strong>    <br />
      本次交易金額為：<strong><?php echo $_GET['PR']; ?></strong>元</td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><p> 若您想繼續選購，請按下方「繼續購物」鈕<br />
<br />
<a href="product.php?Opt=viewpage&amp;tp=Product&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></p></td>
  </tr>
</table>
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
<?php } else { ?>
<?php include($TplPath . "/cart_ordersend.php"); ?>
<?php } ?>