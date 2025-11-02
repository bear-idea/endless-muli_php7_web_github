<?php 
$colname_RecordDiscountGetType5 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDiscountGetType5 = $_GET['lang'];
}
$coluserid_RecordDiscountGetType5 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDiscountGetType5 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscountGetType5 = sprintf("SELECT * FROM demo_productdiscount WHERE lang=%s && userid=%s && type=5 && (DATEDIFF(enddate,NOW()) >= 0 || limitdate = 0) && indicate=1 ORDER BY discountFullamount DESC", GetSQLValueString($colname_RecordDiscountGetType5, "text"),GetSQLValueString($coluserid_RecordDiscountGetType5, "int"));
$RecordDiscountGetType5 = mysqli_query($DB_Conn, $query_RecordDiscountGetType5) or die(mysqli_error($DB_Conn));
$row_RecordDiscountGetType5 = mysqli_fetch_assoc($RecordDiscountGetType5);
$totalRows_RecordDiscountGetType5 = mysqli_num_rows($RecordDiscountGetType5);


// 計算目前優惠價符合全單優惠條件
//echo "--------------------------";

if ($totalRows_RecordDiscountGetType5 > 0) {
do{
	if($_SESSION['Total'] >= $row_RecordDiscountGetType5['discountFullamount'])
	{
		// 記錄目前優惠
		if(!in_array('DiscountGetType5', (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = 'DiscountGetType5'; /* 記錄優惠筆數 */}
		$DiscountShowAll['DiscountGetType5']['name'] = $row_RecordDiscountGetType5['name'];
		$DiscountShowAll['DiscountGetType5']['type'] = $row_RecordDiscountGetType5['type'];
		$DiscountShowAll['DiscountGetType5']['discountFullamount'] = $row_RecordDiscountGetType5['discountFullamount'];
		$DiscountShowAll['DiscountGetType5']['discountFoldnumber'] = $row_RecordDiscountGetType5['discountFoldnumber'];
		$DiscountShowAll['DiscountGetType5']['discount'] = ceil($_SESSION['Total']*((100-$row_RecordDiscountGetType5['discountFoldnumber'])/100));
		break;
	}
	$DiscountGetType5Count++;
	if($DiscountGetType5Count == $totalRows_RecordDiscountGetType5)
	{
		if(!in_array('DiscountGetType5', (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = 'DiscountGetType5'; /* 記錄優惠筆數 */}
		$DiscountShowAll['DiscountGetType5']['name'] = $row_RecordDiscountGetType5['name'];
		$DiscountShowAll['DiscountGetType5']['type'] = $row_RecordDiscountGetType5['type'];
		$DiscountShowAll['DiscountGetType5']['discountFullamount'] = $row_RecordDiscountGetType5['discountFullamount'];
		$DiscountShowAll['DiscountGetType5']['discountFoldnumber'] = $row_RecordDiscountGetType5['discountFoldnumber'];
		$DiscountShowAll['DiscountGetType5']['discountnot'] = $row_RecordDiscountGetType5['discountFullamount']-$_SESSION['Total'];
	}
	
} while ($row_RecordDiscountGetType5 = mysqli_fetch_assoc($RecordDiscountGetType5));
}

//echo $DiscountGetType5Count . "------------------------";


$colname_RecordDiscountGetType6 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDiscountGetType6 = $_GET['lang'];
}
$coluserid_RecordDiscountGetType6 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDiscountGetType6 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscountGetType6 = sprintf("SELECT * FROM demo_productdiscount WHERE lang=%s && userid=%s && type=6 && (DATEDIFF(enddate,NOW()) >= 0 || limitdate = 0) && indicate=1 ORDER BY discountFullamount DESC", GetSQLValueString($colname_RecordDiscountGetType6, "text"),GetSQLValueString($coluserid_RecordDiscountGetType6, "int"));
$RecordDiscountGetType6 = mysqli_query($DB_Conn, $query_RecordDiscountGetType6) or die(mysqli_error($DB_Conn));
$row_RecordDiscountGetType6 = mysqli_fetch_assoc($RecordDiscountGetType6);
$totalRows_RecordDiscountGetType6 = mysqli_num_rows($RecordDiscountGetType6);

// 目前優會總價格
//echo $_SESSION['Total'];

// 計算目前優惠價符合全單優惠條件
if ($totalRows_RecordDiscountGetType6 > 0) {
do{
	if($_SESSION['Total'] >= $row_RecordDiscountGetType6['discountFullamount'])
	{
		// 記錄目前優惠
		if(!in_array('DiscountGetType6', (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = 'DiscountGetType6'; /* 記錄優惠筆數 */}
		$DiscountShowAll['DiscountGetType6']['name'] = $row_RecordDiscountGetType6['name'];
		$DiscountShowAll['DiscountGetType6']['type'] = $row_RecordDiscountGetType6['type'];
		$DiscountShowAll['DiscountGetType6']['discountFullamount'] = $row_RecordDiscountGetType6['discountFullamount'];
		$DiscountShowAll['DiscountGetType6']['discountNowfold'] = $row_RecordDiscountGetType6['discountNowfold'];
		$DiscountShowAll['DiscountGetType6']['discount'] = $row_RecordDiscountGetType6['discountNowfold'];
		break;
	}
	$DiscountGetType6Count++;
	if($DiscountGetType6Count == $totalRows_RecordDiscountGetType6)
	{
		if(!in_array('DiscountGetType6', (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = 'DiscountGetType6'; /* 記錄優惠筆數 */}
		$DiscountShowAll['DiscountGetType6']['name'] = $row_RecordDiscountGetType6['name'];
		$DiscountShowAll['DiscountGetType6']['type'] = $row_RecordDiscountGetType6['type'];
		$DiscountShowAll['DiscountGetType6']['discountFullamount'] = $row_RecordDiscountGetType6['discountFullamount'];
		$DiscountShowAll['DiscountGetType6']['discountNowfold'] = $row_RecordDiscountGetType6['discountNowfold'];
		$DiscountShowAll['DiscountGetType6']['discountnot'] = $row_RecordDiscountGetType6['discountFullamount']-$_SESSION['Total'];
	}
	
} while ($row_RecordDiscountGetType6 = mysqli_fetch_assoc($RecordDiscountGetType6));
}

$colname_RecordDiscountGetType7 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDiscountGetType7 = $_GET['lang'];
}
$coluserid_RecordDiscountGetType7 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDiscountGetType7 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscountGetType7 = sprintf("SELECT * FROM demo_productdiscount WHERE lang=%s && userid=%s && type=7 && (DATEDIFF(enddate,NOW()) >= 0 || limitdate = 0) && indicate=1 ORDER BY discountFullamount DESC", GetSQLValueString($colname_RecordDiscountGetType7, "text"),GetSQLValueString($coluserid_RecordDiscountGetType7, "int"));
$RecordDiscountGetType7 = mysqli_query($DB_Conn, $query_RecordDiscountGetType7) or die(mysqli_error($DB_Conn));
$row_RecordDiscountGetType7 = mysqli_fetch_assoc($RecordDiscountGetType7);
$totalRows_RecordDiscountGetType7 = mysqli_num_rows($RecordDiscountGetType7);

// 計算目前優惠價符合全單優惠條件
if ($totalRows_RecordDiscountGetType7 > 0) {
do{
	if($_SESSION['Total'] >= $row_RecordDiscountGetType7['discountFullamount'])
	{
		// 記錄目前優惠
		if(!in_array('DiscountGetType7', (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = 'DiscountGetType7'; /* 記錄優惠筆數 */}
		$DiscountShowAll['DiscountGetType7']['name'] = $row_RecordDiscountGetType7['name'];
		$DiscountShowAll['DiscountGetType7']['type'] = $row_RecordDiscountGetType7['type'];
		$DiscountShowAll['DiscountGetType7']['discountFullamount'] = $row_RecordDiscountGetType7['discountFullamount'];
		
		/* 取得贈品資料 */
		$colname_RecordDiscountGift = "zh-tw";
		if (isset($_GET['lang'])) {
		  $colname_RecordDiscountGift = $_GET['lang'];
		}
		$coluserid_RecordDiscountGift = "-1";
		if (isset($_SESSION['userid'])) {
		  $coluserid_RecordDiscountGift = $_SESSION['userid'];
		}
		$colgiftid_RecordDiscountGift = "-1";
		if (isset($row_RecordDiscountGetType7['discountGiftID'])) {
		  $colgiftid_RecordDiscountGift = $row_RecordDiscountGetType7['discountGiftID'];
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordDiscountGift = sprintf("SELECT * FROM demo_productgift WHERE lang=%s && userid=%s && id=%s ORDER BY id DESC", GetSQLValueString($colname_RecordDiscountGift, "text"),GetSQLValueString($coluserid_RecordDiscountGift, "int"),GetSQLValueString($colgiftid_RecordDiscountGift, "int"));
		$RecordDiscountGift = mysqli_query($DB_Conn, $query_RecordDiscountGift) or die(mysqli_error($DB_Conn));
		$row_RecordDiscountGift = mysqli_fetch_assoc($RecordDiscountGift);
		$totalRows_RecordDiscountGift = mysqli_num_rows($RecordDiscountGift);
		/* \取得贈品資料 */
		$DiscountShowAll['DiscountGetType7']['discountGiftID'] = $row_RecordDiscountGift['id'];
		$DiscountShowAll['DiscountGetType7']['discountGiftPic'] = $row_RecordDiscountGift['pic'];
		//$DiscountShowAll['DiscountGetType7']['discountGiftName'] = $row_RecordDiscountGift['name'];
		$DiscountShowAll['DiscountGetType7']['discountGift'] = $row_RecordDiscountGift['name'];
		$DiscountShowAll['DiscountGetType7']['discount'] = 1;
		break;
	}
	$DiscountGetType7Count++;
	if($DiscountGetType7Count == $totalRows_RecordDiscountGetType7)
	{
		if(!in_array('DiscountGetType7', (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = 'DiscountGetType7'; /* 記錄優惠筆數 */}
		$DiscountShowAll['DiscountGetType7']['name'] = $row_RecordDiscountGetType7['name'];
		$DiscountShowAll['DiscountGetType7']['type'] = $row_RecordDiscountGetType7['type'];
		$DiscountShowAll['DiscountGetType7']['discountFullamount'] = $row_RecordDiscountGetType7['discountFullamount'];
		
		/* 取得贈品資料 */
		$colname_RecordDiscountGift = "zh-tw";
		if (isset($_GET['lang'])) {
		  $colname_RecordDiscountGift = $_GET['lang'];
		}
		$coluserid_RecordDiscountGift = "-1";
		if (isset($_SESSION['userid'])) {
		  $coluserid_RecordDiscountGift = $_SESSION['userid'];
		}
		$colgiftid_RecordDiscountGift = "-1";
		if (isset($row_RecordDiscountGetType7['discountGiftID'])) {
		  $colgiftid_RecordDiscountGift = $row_RecordDiscountGetType7['discountGiftID'];
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordDiscountGift = sprintf("SELECT * FROM demo_productgift WHERE lang=%s && userid=%s && id=%s ORDER BY id DESC", GetSQLValueString($colname_RecordDiscountGift, "text"),GetSQLValueString($coluserid_RecordDiscountGift, "int"),GetSQLValueString($colgiftid_RecordDiscountGift, "int"));
		$RecordDiscountGift = mysqli_query($DB_Conn, $query_RecordDiscountGift) or die(mysqli_error($DB_Conn));
		$row_RecordDiscountGift = mysqli_fetch_assoc($RecordDiscountGift);
		$totalRows_RecordDiscountGift = mysqli_num_rows($RecordDiscountGift);
		/* \取得贈品資料 */
		
		$DiscountShowAll['DiscountGetType7']['discountGift'] = $row_RecordDiscountGift['name'];
		$DiscountShowAll['DiscountGetType7']['discountnot'] = $row_RecordDiscountGetType7['discountFullamount']-$_SESSION['Total'];;
	}
	
} while ($row_RecordDiscountGetType7 = mysqli_fetch_assoc($RecordDiscountGetType7));
}
?>

<?php require("require_cart_discount_show_gift.php");  /* 列出商品全部優惠情形 */?>

<?php if(count($DiscountShowAllOk) > 0) {?>
<div style="height:5px;"></div>
<div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
  <h4>已符合折扣活動 </h4>
  <div style="color:#428bca;"><i class="fa fa-check-circle" aria-hidden="true"></i> 已符合<?php echo count($DiscountShowAllOk); ?>項活動 <?php if(count($DiscountShowAllOk) > 3) {?><a href="javascript:;" onclick="jQuery('#DiscountShowAll').slideToggle();" style="float:right;">查看全部 <i class="fa fa-angle-down" aria-hidden="true"></i></a><?php } ?></div>
  <div id="DiscountShowAll" <?php if(count($DiscountShowAllOk) > 3) {?>style="display:none;"<?php } ?>>
  <div class="divider double-line" style="margin:5px 0"></div>
  <?php 
foreach ($DiscountShowAll as $key => $value) { 
	$DiscountShowAlldiscount = 0; /* 每個ID初始化一次 */
	if(count($DiscountShowAll[$key]['discount']) > 0) {
		/*
		-滿件折扣 $DiscountShowAlldiscount 為 折扣後的價錢累計
		-滿件減價 $DiscountShowAlldiscount 為 可折扣的數量
		-滿額折扣 $DiscountShowAlldiscount 為 折扣後的價錢累計
		-滿額減價 $DiscountShowAlldiscount 為 總金額
		-任選優惠 $DiscountShowAlldiscount 為 可折扣的數量 (計算折扣 -> 全部總價 -  [未折扣的商品價格 + (可折扣數量/滿多少件折扣)*多少錢])
		*/
	    
		switch($DiscountShowAll[$key]['type'])
		{
			case "0":
			    //echo "滿件折扣";
				//echo $key;
				//var_dump($DiscountShowAll[$key]['discount']);
				if(is_array($DiscountShowAll[$key]['discount']) && !empty($DiscountShowAll[$key]['discount'])){  	
					foreach ($DiscountShowAll[$key]['discount'] as $value2) { 
						$DiscountShowAlldiscount += $value2;
					}
				}
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">折扣</span>".$Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿件折扣</span>";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
				echo "滿" . $DiscountShowAll[$key]['discountPieces'] . "件" . $DiscountShowAll[$key]['discountFoldnumber']/10 . "折";
				}else{
				echo "滿" . $DiscountShowAll[$key]['discountPieces'] . "件" . $DiscountShowAll[$key]['discountFoldnumber'] . "折";
				}
				$DiscountShowAlldiscount_type_0 += $DiscountShowAlldiscount; /* 計算此折扣所有折價 */
				break;
			case "1":
				//echo "滿件減價";
				//echo '目前使用折扣活動之id為' . $key . "<br>";
			    //var_dump($DiscountShowAll[$key]['pieces']). "<br>";
				if(is_array($DiscountShowAll[$key]['pieces']) && !empty($DiscountShowAll[$key]['pieces'])){  	
					foreach ($DiscountShowAll[$key]['pieces'] as $value2) { 
						$DiscountShowAlldiscount += $value2;
					}
				}
				echo "可折扣數量" . $DiscountShowAlldiscount . "<br>";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">現折</span>".$Lang_Classify_Context_Currency_units . doFormatMoney(($DiscountShowAlldiscount/$DiscountShowAll[$key]['discountPieces'])*$DiscountShowAll[$key]['discountNowfold']). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿件減價</span>";
				echo "滿" . $DiscountShowAll[$key]['discountPieces'] . "件減" . $DiscountShowAll[$key]['discountNowfold'] . "";
                //echo '---'.$DiscountShowAlldiscount . '---';
				$DiscountShowAlldiscount_type_1 += ($DiscountShowAlldiscount/$DiscountShowAll[$key]['discountPieces'])*$DiscountShowAll[$key]['discountNowfold']; /* 計算此折扣所有折價 */
                //echo '***'.$DiscountShowAlldiscount_type_1 . '***';
				break;
			case "2":
				//echo "滿額折扣";
				if(is_array($DiscountShowAll[$key]['discount']) && !empty($DiscountShowAll[$key]['discount'])){  	
					foreach ($DiscountShowAll[$key]['discount'] as $value2) { 
						$DiscountShowAlldiscount += $value2;
					}
				}
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">折扣</span>".$Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿額折扣</span>";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber']/10 . "折";
				}else{
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber'] . "折";
				}
				$DiscountShowAlldiscount_type_2 += $DiscountShowAlldiscount; /* 計算此折扣所有折價 */
				break;
			case "3":
				//echo "滿額減價";
				if(is_array($DiscountShowAll[$key]['itemprice']) && !empty($DiscountShowAll[$key]['itemprice'])){  	
					foreach ($DiscountShowAll[$key]['itemprice'] as $value2) { 
						$DiscountShowAlldiscount += $value2;
					}
				}
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">現折</span>".$Lang_Classify_Context_Currency_units . doFormatMoney(floor($DiscountShowAlldiscount/$DiscountShowAll[$key]['discountFullamount'])*$DiscountShowAll[$key]['discountNowfold']). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿額減價</span>";
				echo "滿" . $DiscountShowAll[$key]['discountFullamount'] . "減" . $DiscountShowAll[$key]['discountNowfold'] . "";
				$DiscountShowAlldiscount_type_3 += floor($DiscountShowAlldiscount/$DiscountShowAll[$key]['discountFullamount'])*$DiscountShowAll[$key]['discountNowfold']; /* 計算此折扣所有折價 */
				break;
			case "4":
				//echo "任選優惠";
				//可折扣的數量 (計算折扣 -> 全部總價 -  [未折扣的商品價格 + (可折扣數量/滿多少件折扣)*多少錢])
				// 全部總價
				$DiscountShowAlldiscount_itemprice = 0;
				if(is_array($DiscountShowAll[$key]['itemprice']) && !empty($DiscountShowAll[$key]['itemprice'])){  	
					foreach ($DiscountShowAll[$key]['itemprice'] as $value2) { 
						$DiscountShowAlldiscount_itemprice += $value2;
					}
				}
				//echo "全部總價" . $DiscountShowAlldiscount_itemprice . "<br>";
				
				// 可折扣數量
				$DiscountShowAlldiscount_pieces = 0;
				if(is_array($DiscountShowAll[$key]['pieces']) && !empty($DiscountShowAll[$key]['pieces'])){  	
					foreach ($DiscountShowAll[$key]['pieces'] as $value2) { 
						$DiscountShowAlldiscount_pieces += $value2;
					}
				}
				//echo "可折扣數量" . $DiscountShowAlldiscount_pieces . "<br>";
				
				// 未折扣的商品價格
				$DiscountShowAlldiscount_price = 0;
				if(is_array($DiscountShowAll[$key]['price']) && !empty($DiscountShowAll[$key]['price'])){  	
					foreach ($DiscountShowAll[$key]['price'] as $value2) { 
						$DiscountShowAlldiscount_price += $value2;
					}
				}
				//echo "未折扣的商品價格" . $DiscountShowAlldiscount_price . "<br>";

				$DiscountShowAlldiscount = $DiscountShowAlldiscount_itemprice - ($DiscountShowAlldiscount_price+(($DiscountShowAlldiscount_pieces/$DiscountShowAll[$key]['discountPieces'])*$DiscountShowAll[$key]['discountNowfold']));
				
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">現折</span>".$Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 任選優惠</span>";
				echo "任選" . $DiscountShowAll[$key]['discountPieces'] . "件" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$key]['discountNowfold']) . "";
				$DiscountShowAlldiscount_type_4 += $DiscountShowAlldiscount;
				break;
			case "5":
				//echo "滿額折扣(全單)";
				//if(in_array('DiscountGetType5', (array)$DiscountShowAllNotOk)){
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">折扣</span>".$Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll['DiscountGetType5']['discount']). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 全單滿額</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿額折扣</span>";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber']/10 . "折";
				}else{
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber'] . "折";
				}
				$DiscountShowAlldiscount_type_5 = $DiscountShowAll['DiscountGetType5']['discount']; /* 計算此折扣所有折價 */
				//}
				break;
			case "6":
				//echo "滿額減價(全單)";
				//if(in_array('DiscountGetType6', (array)$DiscountShowAllNotOk)){
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">現折</span>".$Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll['DiscountGetType6']['discount']). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 全單滿額</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿額減價</span>";
				echo "滿" . $DiscountShowAll[$key]['discountFullamount'] . "減" . $DiscountShowAll['DiscountGetType6']['discountNowfold'] . "";
				$DiscountShowAlldiscount_type_6 = $DiscountShowAll['DiscountGetType6']['discountNowfold']; /* 計算此折扣所有折價 */
				//}
				break;
			case "7":
				//echo "滿額贈禮(全單)";
				//if(in_array('DiscountGetType7', (array)$DiscountShowAllNotOk)){
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">送</span>".$DiscountShowAll['DiscountGetType7']['discountGift']. " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#337ab7;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 全單滿額</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#d9534f;font-weight:bolder;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> 滿額贈禮</span>";
				echo "滿" . $DiscountShowAll[$key]['discountFullamount'] . "送" . $DiscountShowAll['DiscountGetType7']['discountGift'] . "";
				echo $DiscountShowAlldiscount_type_7 = $row_RecordDiscountGetType7['discountGiftID']; /* 取得贈品ID */
				//}
				break;
			default:
				break;
		}
		echo "<br>" . "<div style=\"margin-top:5px;color:#666;\">" . $DiscountShowAll[$key]['name'] . "</div>";
		echo "<div class=\"divider\" style=\"margin:10px 0\"></div>";
	}
}
?>
</div>
</div>
<?php } ?>
<?php if(count($DiscountShowAllNotOk) > 0) {?>
<div style="height:5px;"></div>
<div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
  <h4>未符合折扣活動</h4>
  <div style="color:#666;"><i class="fa fa-times-circle" aria-hidden="true"></i> 未符合<?php echo count($DiscountShowAllNotOk); ?>項活動 <?php if(count($DiscountShowAllNotOk) > 3) {?><a href="javascript:;" onclick="jQuery('#DiscountShowAllNot').slideToggle();" style="float:right;">查看全部 <i class="fa fa-angle-down" aria-hidden="true"></i></a><?php } ?></div>
  <div id="DiscountShowAllNot" <?php if(count($DiscountShowAllNotOk) > 3) {?>style="display:none;"<?php } ?>>
    <div class="divider double-line" style="margin:5px 0" ></div>
    <?php 
foreach ($DiscountShowAll as $key => $value) {
	$DiscountShowAlldiscountnot = 0; /* 每個ID初始化一次 */
	if(count($DiscountShowAll[$key]['discountnot']) > 0) {
		if(is_array($DiscountShowAll[$key]['discountnot']) && !empty($DiscountShowAll[$key]['discountnot'])){  	
			foreach ($DiscountShowAll[$key]['discountnot'] as $value2) {
				$DiscountShowAlldiscountnot += $value2;
			}
		}
		
		switch($DiscountShowAll[$key]['type'])
		{
			case "0":
			    //echo "滿件折扣";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $DiscountShowAll[$key]['numnot'] . "件折扣</span>".$Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAlldiscountnot)." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿件折扣</span>";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
				echo "滿" . $DiscountShowAll[$key]['discountPieces'] . "件" . $DiscountShowAll[$key]['discountFoldnumber']/10 . "折";	
				}else{
				echo "滿" . $DiscountShowAll[$key]['discountPieces'] . "件" . $DiscountShowAll[$key]['discountFoldnumber'] . "折";
				}
				break;
			case "1":
				//echo "滿件減價";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $DiscountShowAll[$key]['numnot'] . "件現折</span>".$Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountNowfold'])." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿件減價</span>";
				echo "滿" . $DiscountShowAll[$key]['discountPieces'] . "件減" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountNowfold']) . "";
				break;
			case "2":
				//echo "滿額折扣";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['numnot']) . " 折扣</span>".$Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAlldiscountnot)." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿額折扣</span>";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber']/10 . "折";
				}else{
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber'] . "折";
				}
				break;
			case "3":
				//echo "滿額減價";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['numnot']) . " 現折</span>".$Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountNowfold'])." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿額減價</span>";
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . "元減" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountNowfold']) . "";
				break;
			case "4":
				//echo "任選優惠";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">"."<span style=\"font-size:14px;color:#337ab7;\">再湊".$DiscountShowAll[$key]['numnot'] . "件" ."</span>". $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$key]['discountNowfold']). " <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 指定商品</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 任選優惠</span>";
				echo "任選" . $DiscountShowAll[$key]['discountPieces'] . "件" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$key]['discountNowfold']) . "";
				break;
			case "5":
				//echo "滿額折扣(全單)";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
					echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll['DiscountGetType5']['discountnot']) . " 全單</span>".($DiscountShowAll[$key]['discountFoldnumber']/10)."折"." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				}else{
					echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll['DiscountGetType5']['discountnot']) . " 全單</span>".($DiscountShowAll[$key]['discountFoldnumber'])."折"." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				}
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 全單滿額</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿額折扣</span>";
				if(is_int($DiscountShowAll[$key]['discountFoldnumber']/10)){
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber']/10 . "折";
				}else{
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . " " . $DiscountShowAll[$key]['discountFoldnumber'] . "折";
				}
				break;
			 case "6":
				//echo "滿額減價(全單)";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll['DiscountGetType6']['discountnot']) . " 現折</span>".$Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountNowfold'])." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 全單滿額</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿額減價</span>";
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . "元減" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountNowfold']) . "";
				break;
			  case "7":
				//echo "滿額贈禮(全單)";
				echo "<a href=\"" . $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable) . $discount_params . $key. "\">";
				echo "<h4 style=\"float:right;color:#337ab7;\">" ."<span style=\"font-size:14px;color:#337ab7;\">再湊". $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll['DiscountGetType7']['discountnot']) . " 送</span>".$DiscountShowAll['DiscountGetType7']['discountGift']." <i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>" . "</h4>";
				echo "</a>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 全單滿額</span>";
				echo "<span class=\"label label-light\" style=\"margin-right:2px;color:#666;font-weight:bolder;\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i> 滿額贈禮</span>";
				echo "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($DiscountShowAll[$key]['discountFullamount']) . "元送" . $DiscountShowAll['DiscountGetType7']['discountGift'] . "";
				break;
			default:
				break;
		}
		echo "<br>" . "<div style=\"margin-top:5px;color:#666;\">" . $DiscountShowAll[$key]['name'] . "</div>";
		echo "<div class=\"divider\" style=\"margin:10px 0\"></div>";
	}
}
?>
  </div>
</div>
<?php } ?>

<?php
mysqli_free_result($RecordDiscountGetType5);

mysqli_free_result($RecordDiscountGetType6);

mysqli_free_result($RecordDiscountGetType7);
?>


