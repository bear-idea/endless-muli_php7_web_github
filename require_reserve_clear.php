<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
	/*
			foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val){
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i];
		echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i];
	}*/
	unset ($_SESSION['PlusTotal']);
	unset ($_SESSION['Total']);
	
	foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val){
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]);
		unset ($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i]);
	}
	

	
	if(is_array($_SESSION['PlusId'])) {
	foreach($_SESSION['PlusId'] as $i => $val1){
		foreach($val1 as $j => $val2){
			unset ($_SESSION['PlusId'][$i][$j]);
			unset ($_SESSION['PlusName'][$i][$j]);
			unset ($_SESSION['PlusPrice'][$i][$j]);
			unset ($_SESSION['PlusQuantity'][$i][$j]);
			unset ($_SESSION['PlusitemTotal'][$i][$j]);
		}
	}
	}
	
	unset ($_SESSION['OrderID']); // 清除訂單編號
	
	header("Location:cart.php?wshop=" . $_GET['wshop'] . "&Opt=showpage&tp=Cart&lang=" . $_SESSION['lang']);
	ob_end_flush(); // 輸出緩衝區結束	
?>