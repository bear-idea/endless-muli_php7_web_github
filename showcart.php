<?php session_start(); ?>
<?php 
	if(isset($_POST['Modify'])){
		foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'] as $i => $val) {
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i] = $_POST['Modify'][$i];
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>商品編號</td>
    <td>商品名稱</td>
    <td>單價</td>
    <td>數量</td>
    <td>小計</td>
  </tr>
  <?php foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) { ?>
  <tr>
    <td><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]; ?></td>
    <td><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]; ?></td>
    <td><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]; ?></td>
    <td><input name="Modify[]" type="text" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]; ?>"/></td>
    <td><?php
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i] =  $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i] * $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
		$_SESSION['Total'] += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i];
	?></td>
  </tr>
  <?php } ?>
</table>
<?php echo $_SESSION['Total'] ?>
</body>
</html>