<?php require_once('Connections/DB_Conn.php'); ?>
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

$colname_RecordProductFormat = "-1";
if (isset($_POST['id'])) {
  $colname_RecordProductFormat = $_POST['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductFormat = sprintf("SELECT * FROM demo_productformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductFormat, "text"));
$RecordProductFormat = mysqli_query($DB_Conn, $query_RecordProductFormat) or die(mysqli_error($DB_Conn));
$row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat);
$totalRows_RecordProductFormat = mysqli_num_rows($RecordProductFormat);
 if ((isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers)) || $CartRegSelect == 0) {  ?>
<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
	if($_POST['inventorynotsale'] == "1" && $_POST['inventory'] <= 0) {
	}else if($_POST['inventorynotsale'] == "1" && ($_POST['inventory']-$_POST['qu'])<=0){
	// 購買數量不可高於庫存量
}else{
	//if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])){
	if(in_array($_POST['id'], $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) /*&& $_POST['price'] == NULL*/){
			//header("Content-Type:text/html;charset=utf-8");
			//die("<a href=javascript:history.back(-1)>商品已在購物車內</a>");
			//ob_end_flush(); // 輸出緩衝區結束
?>
<?php if ($MSTMP == 'default') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><h3><?php echo $Lang_Classify_Exist_In_Shopping_List; //您所選擇的商品已存在您的購物清單中!! ?></h3><br />
      <?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom; //若您想檢視您的購物清單，請按下方「檢視購物車」鈕 ?> <br />
      <?php echo $Lang_Classify_Context_Cart_Continue_View_Buttom; //若您想繼續選購，請按下方「繼續購物」鈕 ?><br />
      <br />
      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a> <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Show ?></a></td>
  </tr>
</table>
<?php } else { ?>
<?php include($TplPath . "/cart_add.php"); ?>
<?php } ?>
<?php
		}else{
			if ($totalRows_RecordProductFormat > 0) 
			{
			do {
				if($i == $totalRows_RecordProductFormat-1){
					$fmt .= $row_RecordProductFormat['formatname'] . ":" . $_POST['formatselect' . $row_RecordProductFormat['pid']];
				}else{
					$fmt .= $row_RecordProductFormat['formatname'] . ":" . $_POST['formatselect' . $row_RecordProductFormat['pid']] . ";";
				}
				$i++;
			} while ($row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat));
		    }
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][] = $_POST['id'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][] = $_POST['pdseries'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][] = $_POST['name'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][] = $_POST['price'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][] = $_POST['spprice'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][] = $_POST['quantity'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][] = '';
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][] = $fmt;
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][] = $_POST['spformat'];
			$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Pic'][] = $_POST['pic'];
			
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
			//echo $_POST['spformat'];
			$cartGoTo = $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);
	
			header(sprintf("Location: %s", $cartGoTo));

			ob_end_flush(); // 輸出緩衝區結束
		}
	//}
	}
?>
<?php } else { ?>
<?php include($TplPath . "/cart_reg.php"); ?>
<?php } 
mysqli_free_result($RecordProductFormat);
?>