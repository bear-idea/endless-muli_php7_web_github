<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
	//if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])){
	if(in_array($_POST['id'], $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) /*&& $_POST['price'] == NULL*/){
			//header("Content-Type:text/html;charset=utf-8");
			//die("<a href=javascript:history.back(-1)>商品已在購物車內</a>");
			//ob_end_flush(); // 輸出緩衝區結束
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php //include($TplPath . "/cart_add.php"); ?>
<?php } ?>
<?php
		}else{
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][] = $_POST['id'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][] = $_POST['pdseries'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][] = $_POST['name'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][] = $_POST['price'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][] = $_POST['spprice'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][] = $_POST['quantity'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][] = '';
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Pic'][] = '';
			
			if(is_array($_POST['plusid'])) { 
			foreach($_POST['plusid'] as $k => $val) { 
				if ((isset($_POST['pluscheck'][$k])) && ($_POST['pluscheck'][$k] != "")) {
			//$_SESSION['PlusPrice'][$_POST['id']][] = $_POST['plusprice'][$k];
					//echo '<br />';
					$_SESSION['PlusId'][$_POST['id']][] = $_POST['plusid'][$k];
					//echo '<br />';
					$_SESSION['PlusName'][$_POST['id']][] = $_POST['plusname'][$k];
					//echo '<br />';
					$_SESSION['PlusPrice'][$_POST['id']][] = $_POST['plusprice'][$k];
					//echo '<br />';
					$_SESSION['PlusQuantity'][$_POST['id']][] = $_POST['plusquantity'][$k];
					
					$_SESSION['PlusPic'][$_POST['id']][] = $_POST['pluspic'][$k];
				}
				//echo $_POST['plusprice'][$k];
			}
			}
		}
	//}
?>