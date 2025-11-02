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

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
	$coluserid_RecordCartlistShowType = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlistShowType = $_SESSION['userid'];
	}
	$colmemberid_RecordCartlistShowType = "-1";
	if (isset($row_RecordMember['id'])) {
	  $colmemberid_RecordCartlistShowType = $row_RecordMember['id'];
	}
	$collang_RecordCartlistShowType = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlistShowType = $_SESSION['lang'];
	}
	$colaid_RecordCartlistShowType = "-1";
	if (isset($row_RecordCartlist['discountid'])) {
	  $colaid_RecordCartlistShowType = $row_RecordCartlist['discountid'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlistShowType = sprintf("SELECT * FROM demo_cart WHERE userid=%s && memberid=%s && lang=%s && discountid = %s ORDER BY price ASC",GetSQLValueString($coluserid_RecordCartlistShowType, "int"),GetSQLValueString($colmemberid_RecordCartlistShowType, "int"),GetSQLValueString($collang_RecordCartlistShowType, "text"),GetSQLValueString($colaid_RecordCartlistShowType, "int"));
	$RecordCartlistShowType = mysqli_query($DB_Conn, $query_RecordCartlistShowType) or die(mysqli_error($DB_Conn));
	$row_RecordCartlistShowType = mysqli_fetch_assoc($RecordCartlistShowType);
	$totalRows_RecordCartlistShowType = mysqli_num_rows($RecordCartlistShowType);
}else{
	/* 取得購物車清單 無會員 */
	$coluserid_RecordCartlistShowType = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlistShowType = $_SESSION['userid'];
	}
	$colUserAccessuniqid_RecordCartlistShowType = "-1";
	if (isset($_SESSION['UserAccess'])) {
	  $colUserAccessuniqid_RecordCartlistShowType = $_SESSION['UserAccess'];
	}
	$collang_RecordCartlistShowType = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlistShowType = $_SESSION['lang'];
	}
	$colaid_RecordCartlistShowType = "-1";
	if (isset($row_RecordCartlist['discountid'])) {
	  $colaid_RecordCartlistShowType = $row_RecordCartlist['discountid'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlistShowType = sprintf("SELECT * FROM demo_cart WHERE userid=%s && UserAccessuniqid=%s && lang=%s && discountid = %s ORDER BY price ASC",GetSQLValueString($coluserid_RecordCartlistShowType, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlistShowType, "text"),GetSQLValueString($collang_RecordCartlistShowType, "text"),GetSQLValueString($colaid_RecordCartlistShowType, "int"));
	$RecordCartlistShowType = mysqli_query($DB_Conn, $query_RecordCartlistShowType) or die(mysqli_error($DB_Conn));
	$row_RecordCartlistShowType = mysqli_fetch_assoc($RecordCartlistShowType);
	$totalRows_RecordCartlistShowType = mysqli_num_rows($RecordCartlistShowType);
}

unset($DiscountProductID);
unset($DiscountProductQuantity);
unset($DiscountProductPrice);

$DiscountProductID[] = "";
$DiscountProductQuantity[] = "";
$DiscountProductPrice[] = "";
$totalDiscountCountQuantity = 0;
$totalDiscountCountPrice = 0;
$CanDiscount = '0';
$CanDiscountType = "";


do
{
    /* PHP 新版加陣列括弧*/
    //$DiscountProductID[] = $row_RecordCartlistShowType['pid'];
	$DiscountProductID[] = $row_RecordCartlistShowType['id'] . '_' . $row_RecordCartlistShowType['pid'];
	$DiscountProductQuantity[] = $row_RecordCartlistShowType['quantity'];
	$DiscountProductPrice[] = $row_RecordCartlistShowType['price'];
	$totalDiscountCountQuantity += $row_RecordCartlistShowType['quantity']; /* 全部購買件數 */
	$totalDiscountCountPrice += $row_RecordCartlistShowType['price']*$row_RecordCartlistShowType['quantity']; /* 全部購買金額 */
} while ($row_RecordCartlistShowType = mysqli_fetch_assoc($RecordCartlistShowType));
 //echo $totalDiscountCountQuantity;
//echo "-------------------------------------------------";


if($row_RecordDiscountShow['type'] == '0') { /* 滿件折扣 */
	if(is_int($totalDiscountCountQuantity/$row_RecordDiscountShow['discountPieces'])){
		$CanDiscountType = "All"; /* All - 全部皆可折扣 */
		$CanDiscount = $totalDiscountCountQuantity; /* 可折扣數量 */
		//$DiscountShowAll[$key]['pieces'][] = $CanDiscount;
	}else if($totalDiscountCountQuantity >= $row_RecordDiscountShow['discountPieces']){
        // 舊的折扣方式
		//$i=1;
		$CanDiscountProduct = $totalDiscountCountQuantity - ($totalDiscountCountQuantity % $row_RecordDiscountShow['discountPieces']); /* 全部購買清單可折扣數量 例如全部購買10件 3件可折扣1次 可折扣數量為9件 */
		foreach ($DiscountProductID as $key => $value) {
			//if($row_RecordCartlist['pid'] == $DiscountProductID[$key]) // 如果為目前商品
			//echo "第".$i."次執行";
			if(($row_RecordCartlist['id'] . '_' .$row_RecordCartlist['pid']) == $DiscountProductID[$key]) // 如果為目前商品
			{	
                // 舊的折扣方式
				if($row_RecordDiscountShow['type'] == '0') { /* 滿件折扣 */
					if(is_int($totalDiscountCountQuantity/$row_RecordDiscountShow['discountPieces'])){
						$CanDiscountType = "All"; /* All - 全部皆可折扣 */
						$CanDiscount = $totalDiscountCountQuantity; /* 可折扣數量 */
					}else if($totalDiscountCountQuantity >= $row_RecordDiscountShow['discountPieces']){
						$CanDiscountType = "All"; /* All - 全部皆可折扣 */
						$CanDiscount = $totalDiscountCountQuantity; /* 可折扣數量 */
					}else{
						$CanDiscountType = "None"; /* None - 不折扣 */
						$CanDiscount = 0; /* 可折扣數量 */
					}
				}
				//echo "目前商品購買數量(單個)" . $DiscountProductQuantity[$key] . "<br>";;
				//echo "可折扣總數量" . $CanDiscount . "<br>";
				//echo $DiscountShowAll[$key]['pieces'][] = $CanDiscount;
				//echo '鍵值為' . $key;
				
			}
			//$i++;
			//$DiscountProductQuantity[$key] = 
			$CanDiscountProduct = $CanDiscountProduct - $DiscountProductQuantity[$key];
			//echo "目前扣除後剩餘可折扣數量" . $CanDiscountProduct;
		}
        //echo "-------------------------------------------------";
	}else{
		$CanDiscountType = "None"; /* None - 不折扣 */
		$CanDiscount = 0; /* 可折扣數量 */
		//$DiscountShowAll[$key]['pieces'][] = $CanDiscount;
	}
}
if($row_RecordDiscountShow['type'] == '1') { /* 滿件減價 */
	if(is_int($totalDiscountCountQuantity/$row_RecordDiscountShow['discountPieces'])){
		$CanDiscountType = "All"; /* All - 全部皆可折扣 */
		$CanDiscount = $totalDiscountCountQuantity; /* 可折扣數量 */
		//$DiscountShowAll[$key]['pieces'][] = $CanDiscount;
	}else if($totalDiscountCountQuantity >= $row_RecordDiscountShow['discountPieces']){
        // 舊的折扣方式
		//$i=1;
		$CanDiscountProduct = $totalDiscountCountQuantity - ($totalDiscountCountQuantity % $row_RecordDiscountShow['discountPieces']); /* 全部購買清單可折扣數量 例如全部購買10件 3件可折扣1次 可折扣數量為9件 */
		foreach ($DiscountProductID as $key => $value) {
			//if($row_RecordCartlist['pid'] == $DiscountProductID[$key]) // 如果為目前商品
			//echo "第".$i."次執行";
			if(($row_RecordCartlist['id'] . '_' .$row_RecordCartlist['pid']) == $DiscountProductID[$key]) // 如果為目前商品
			{	
                // 舊的折扣方式
				if($CanDiscountProduct >= $DiscountProductQuantity[$key]) // 可折扣
				{
					    //echo "全部皆可折扣";
						$CanDiscountType = "All"; // All - 全部皆可折扣 
						$CanDiscount = $DiscountProductQuantity[$key]; // 可折扣數量 
				}else if($DiscountProductQuantity[$key] >= $row_RecordDiscountShow['discountPieces']){		
						$CanDiscountType = "Part"; // Part - 部分可折扣 
						$CanDiscount = $CanDiscountProduct; // 可折扣數量 
					    //echo "--->---";
				}else if($DiscountProductQuantity[$key] < $row_RecordDiscountShow['discountPieces']){		
						$CanDiscountType = "Part"; // Part - 部分可折扣 
					    if($CanDiscountProduct > 0){ // 若相減為0
							$CanDiscount = $CanDiscountProduct; // 可折扣數量 
						}else{
							$CanDiscount = 0; // 可折扣數量 
						}
					    //echo "---<---";
				}else{	
						$CanDiscountType = "None"; // None - 不折扣 
						$CanDiscount = 0; // 可折扣數量
				}  
				//echo "目前商品購買數量(單個)" . $DiscountProductQuantity[$key] . "<br>";;
				//echo "可折扣總數量" . $CanDiscount . "<br>";
				//echo $DiscountShowAll[$key]['pieces'][] = $CanDiscount;
				//echo '鍵值為' . $key;
				
			}
			//$i++;
			//$DiscountProductQuantity[$key] = 
			$CanDiscountProduct = $CanDiscountProduct - $DiscountProductQuantity[$key];
			//echo "目前扣除後剩餘可折扣數量" . $CanDiscountProduct;
		}
        //echo "-------------------------------------------------";
	}else{
		$CanDiscountType = "None"; /* None - 不折扣 */
		$CanDiscount = 0; /* 可折扣數量 */
		//$DiscountShowAll[$key]['pieces'][] = $CanDiscount;
	}
}

if($row_RecordDiscountShow['type'] == '4') { /* 件數 */
	if(is_int($totalDiscountCountQuantity/$row_RecordDiscountShow['discountPieces'])){
		$CanDiscountType = "All"; /* All - 全部皆可折扣 */
		$DiscountShowAlldiscount = $CanDiscount = $totalDiscountCountQuantity; /* 可折扣數量 */
	}else if($totalDiscountCountQuantity >= $row_RecordDiscountShow['discountPieces']){
        // 舊的折扣方式
		$CanDiscountProduct = $totalDiscountCountQuantity - ($totalDiscountCountQuantity % $row_RecordDiscountShow['discountPieces']); /* 全部購買清單可折扣數量 例如全部購買10件 3件可折扣1次 可折扣數量為9件 */
		foreach ($DiscountProductID as $key => $value) {
            
			if($row_RecordCartlist['pid'] == $DiscountProductID[$key]) // 如果為目前商品
			{
				//echo "目前商品購買數量(單個)" . $DiscountProductQuantity[$key];
				//echo "可折扣總數量" . $CanDiscountProduct;
				//$DiscountShowAlldiscount += $CanDiscount;
                // 舊的折扣方式
				if($CanDiscountProduct >= $DiscountProductQuantity[$key]) // 可折扣
				{
					    //echo "全部皆可折扣";
						$CanDiscountType = "All"; // All - 全部皆可折扣 
						$CanDiscount = $DiscountProductQuantity[$key]; // 可折扣數量 
				}else if($DiscountProductQuantity[$key] >= $row_RecordDiscountShow['discountPieces']){		
						$CanDiscountType = "Part"; // Part - 部分可折扣 
						$CanDiscount = $CanDiscountProduct; // 可折扣數量 
				}else if($DiscountProductQuantity[$key] < $row_RecordDiscountShow['discountPieces']){		
						$CanDiscountType = "Part"; // Part - 部分可折扣 
					    if($CanDiscountProduct > 0){ // 若相減為0
							$CanDiscount = $CanDiscountProduct; // 可折扣數量 
						}else{
							$CanDiscount = 0; // 可折扣數量  
						}
				}else{	
						$CanDiscountType = "None"; // None - 不折扣 
						$CanDiscount = 0; // 可折扣數量
				}  
				echo "目前商品購買數量(單個)" . $DiscountProductQuantity[$key];
				echo "可折扣總數量" . $CanDiscountProduct;
				echo "可89折扣總數量" . $CanDiscount;
			}
			//$DiscountProductQuantity[$key] =
			$CanDiscountProduct = $CanDiscountProduct - $DiscountProductQuantity[$key];
		}
        //echo "-------------------------------------------------";
	}else{
		$CanDiscountType = "None"; /* None - 不折扣 */
		$CanDiscount = 0; /* 可折扣數量 */
	}
}

if($row_RecordDiscountShow['type'] == '2' || $row_RecordDiscountShow['type'] == '3') { /* 金額 */
	if($totalDiscountCountPrice >=$row_RecordDiscountShow['discountFullamount']){
		$CanDiscountType = "All"; /* All - 全部皆可折扣 */
		$CanDiscount = $totalDiscountCountPrice; /* 可折扣價錢 */
	}else{
		$CanDiscountType = "None"; /* None - 不折扣 */
		$CanDiscount = 0; /* 可折扣價錢 */
	}
}

?>

<?php
mysqli_free_result($RecordCartlistShowType);
?>
