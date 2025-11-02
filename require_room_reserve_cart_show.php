<?php require_once('Connections/DB_Conn.php'); ?>
<?php 
// 修改商品的數量
if (isset($_POST['Modify'])) 
{
  // [數量]文字欄位的索引值
  $j = 0;
  // 巡迴購物車內的所有商品
  foreach ($_SESSION['Room_Cart_' . $_GET['wshop']] as $i => $val) 
  {
    // 有商品
    if (isset($_SESSION['Room_Cart_' . $_GET['wshop']][$i])) 
    {
	  // 商品的索引值不一定等於數量文字欄位的索引值
	  // 如果商品被刪除,那麼商品的索引值不會改變,但是數量文字欄位的索引值會重新編號
	  
	  // 重新設定商品的數量
      $_SESSION['Room_Quantity'][$i] = $_POST['Modify'][$j];
	}
	// [數量]文字欄位的索引值
	$j++;
  } 
}
if (isset($_POST['Modify1'])) 
{
  // [數量]文字欄位的索引值
  $j = 0;
  // 巡迴購物車內的所有商品
  foreach ($_SESSION['Room_Cart_' . $_GET['wshop']] as $i => $val) 
  {
	 if(is_array($_SESSION['PlusId'][$val]))    //add
      {
		foreach($_SESSION['PlusId'][$val] as $k => $val2) 
		{
			if (isset($_SESSION['PlusId'][$val][$k])) 
			{
			   $_SESSION['PlusRoom_Quantity'][$val][$k] = $_POST['Modify1'][$j];
			   //echo 'sssss   ';
			  //echo $_POST['Modify1'][$j];
			}
			$j++;
		}
	  }
	
	// [數量]文字欄位的索引值
  } 
}
?>
<?php 
/* 刪除資料 */
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
	$ii = $_GET['id_del'];
	
			unset ($_SESSION['Room_Cart_' . $_GET['wshop']][$ii]);
		unset ($_SESSION['Room_Name'][$ii]);
		unset ($_SESSION['Room_RoomPrice'][$ii]);
		unset ($_SESSION['Room_RoomNum'][$ii]);
		unset ($_SESSION['Room_PeopleNum'][$ii]);
		unset ($_SESSION['Room_Date'][$ii]);
		unset ($_SESSION['Room_Quantity'][$ii]);

	$valp = $_GET['pdid'];
	if(is_array($_SESSION['PlusId'][$valp])) { 	
		foreach($_SESSION['PlusId'][$valp] as $q => $valdel)
		{					
			unset ($_SESSION['PlusId'][$valp][$q]);
			unset ($_SESSION['PlusName'][$valp][$q]);
			unset ($_SESSION['PlusPrice'][$valp][$q]);
			unset ($_SESSION['PlusQuantity'][$valp][$q]);
			unset ($_SESSION['PlusitemTotal'][$valp][$q]);
		}
	}
}
if ((isset($_GET['plusid_del'])) && ($_GET['plusid_del'] != "")) {

	$valp = $_GET['pdid'];
	$valq = $_GET['plusid_del'];
	if(is_array($_SESSION['PlusId'][$valp])) { 	
		foreach($_SESSION['PlusId'][$valp] as $q => $valdel)
		{					
			unset ($_SESSION['PlusId'][$valp][$valq]);
			unset ($_SESSION['PlusName'][$valp][$valq]);
			unset ($_SESSION['PlusPrice'][$valp][$valq]);
			unset ($_SESSION['PlusQuantity'][$valp][$valq]);
			unset ($_SESSION['PlusitemTotal'][$valp][$valq]);
		}
	}
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/reserve_show.php"); ?>
<?php } ?>