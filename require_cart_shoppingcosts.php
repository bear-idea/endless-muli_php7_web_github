<?php 
/* ******************************************************************************************** */
// 計算運費
/* ******************************************************************************************** */
?>
<?php if ($_POST['ocfreightselectno'] != 1) {   // 當有設定貨運方式才會判斷 1代表沒有貨運方式   
	switch($_POST['ocfreightselect'])
	{
		case "sevenshop": // 7-11 超商取貨付款
			$_POST['ocfreight'] = $row_RecordSystemConfigOtr['sevenshopshipment'];
			$rFreight = "7-11 超商取貨(取貨付款)"; // 運費名稱
		break;
		case "sevenshopnopay": // 7-11 超商取貨不付款       
			$_POST['ocfreight'] = $row_RecordSystemConfigOtr['sevenshopnopayshipment'];
			$rFreight = "7-11 超商取貨(純配送)"; // 運費名稱
		break;
		case "familyshop": // 全家超商取貨付款               sevenshopnopayshipment
			$_POST['ocfreight'] = $row_RecordSystemConfigOtr['familyshopshipment'];
			$rFreight = "全家超商取貨(取貨付款)"; // 運費名稱
		break;
		case "familyshopnopay": // 全家超商取貨不付款            
			$_POST['ocfreight'] = $row_RecordSystemConfigOtr['familyshopnopayshipment'];
			$rFreight = "全家超商取貨(純配送)"; // 運費名稱
		break;
		default:
			/*****************************************************************************************/
			// 自訂運費判斷
			/*****************************************************************************************/
			do {  
				  if (!(strcmp($row_RecordCartListFreight['item_id'], $_POST['ocfreightselect']))) {
				  $rFreight = $row_RecordCartListFreight['itemname']; // 運費名稱
				  // --------- 運費價格計算 ----------
				  switch($row_RecordCartListFreight['mode'])
				  {
					case "0":
						$_POST['ocfreight'] = 0;
						break;
					case "1":
						if($row_RecordCartListFreight['modeselect'] == 0) // 全國
						{
							$_POST['ocfreight'] = $row_RecordCartListFreight['countryprice'];
						}
						if($row_RecordCartListFreight['modeselect'] == 1) // 分區
						{
							switch($_POST['occounty'])
							{
								//北部
								case "基隆市":
								case "台北市":
								case "新北市":
								case "新竹市":
								case "新竹縣":
								case "桃園市":
								case "桃園縣":
								$_POST['ocfreight'] = $row_RecordCartListFreight['northprice'];
								break;
								//中部
								case "台中市":
								case "彰化縣":
								case "苗栗縣":
								case "南投縣":
								$_POST['ocfreight'] = $row_RecordCartListFreight['centralprice'];
								break;
								//南部
								case "嘉義市":
								case "嘉義縣":
								case "雲林縣":
								case "台南市":
								case "高雄市":
								case "屏東縣":
								$_POST['ocfreight'] = $row_RecordCartListFreight['southprice'];
								break;
								//東部
								case "宜蘭縣":
								case "台東縣":
								case "花蓮縣":
								$_POST['ocfreight'] = $row_RecordCartListFreight['eastprice'];
								break;
								//外島
								case "金門縣":
								case "連江縣":
								case "澎湖縣":
								$_POST['ocfreight'] = $row_RecordCartListFreight['outerprice'];
								break;
								//非本國
								case "非台灣地區":
								$_POST['ocfreight'] = "-1";
								break;
							}
						}
						break;
					case "2":
						$_POST['ocfreight'] = "-1";
						break;
					case "3":
						$_POST['ocfreight'] = $_POST['userinputfreight' . $row_RecordCartListFreight['item_id']];
						break;
				  }
				  // --------- 是否要向消費者加收手續費? ----------
				  //echo $row_RecordCartListFreight['productcomeselect'];
				  switch($row_RecordCartListFreight['productcomeselect'])
				  {
					case "0":
					break;
					case "1":
					$ocotherprice = $row_RecordCartListFreight['fixedprice']; // 固定加收
					break;
					case "2":
					// 依代收金額
					for($pi=0; $pi<=7; $pi++){
						if($pi==0)
						{
							$price_arr[] = 0;
						}else{
							if($row_RecordCartListFreight['dynamicprice' . $pi] != "") {
								$price_arr[] = $row_RecordCartListFreight['dynamicprice' . $pi];
							}
						}
					}
					/*for($pi=0; $pi<=count($price_arr); $pi++){
						echo $price_arr[$pi] . "<br/>";
					}*/
					$compare = $_SESSION['Total'];
					$checkprice = "0";
					for($i=0;$i<count($price_arr);$i++){
						//echo "如果" . $compare . "大於等於" . $price_arr[$i] . "且" . "如果" . $compare . "小於等於" . $price_arr[$i+1] . "<br/>";
						if( $compare>=$price_arr[$i] && $compare<=$price_arr[$i+1])
						{
							$checkprice=$i;
						}
					}
					break;
				  }
				  //echo $_POST['ocfreight'];
				  // --------- 運費價格計算 ----------
				   //echo $row_RecordCartListFreight['itemname'];
				   } 
			} while ($row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight));
			  $rows = mysqli_num_rows($RecordCartListFreight);
			  if($rows > 0) {
				  mysqli_data_seek($RecordCartListFreight, 0);
				  $row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
			  }
			  /*****************************************************************************************/
			  // 自訂運費判斷
			  /*****************************************************************************************/
					break;
			  } //\switch
} // \當有設定貨運方式才會判斷 1代表沒有貨運方式 if
?>
<!--<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">運費</div>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">+<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); ?></div>-->
<?php  
/* ******************************************************************************************** */
// \計算運費
/* ******************************************************************************************** */
?>


<div class="clearfix"></div>


<?php 
/* ******************************************************************************************** */
// 計算免運費條件
/* ******************************************************************************************** */ 
?>
<?php 
// --------- 滿額免運費計算 ----------
$freepriceok = 0; /* 0:有運費(預設值) / 1:免運 */
// echo "是否啟用滿額免運費" . $row_RecordSystemConfigOtr['freepriceenable']; /* 除錯 */
if($row_RecordSystemConfigOtr['freepriceenable'] == "1") // 是否啟用滿額免運費
{
	// 開始判斷滿額免運費";
	if($_SESSION['Total'] >= $row_RecordSystemConfigOtr['freeprice']) // 金額條件限制
	{
		// 超商取貨運費判斷 (超商取貨並不會送出忽略地區)
		switch($_POST['ocfreightselect'])
		{
			case "sevenshop": // 7-11 超商取貨付款
			case "sevenshopnopay": // 7-11 超商取貨不付款
			case "familyshop": // 全家超商取貨付款
			case "familyshopnopay": // 全家超商取貨不付款
			
			$_POST['ocfreight'] = 0; // 滿額免運
			$freepriceok=1; // 滿額免運確認
			//echo "測試開始判斷滿額免運費";
			break;
		}
		// 
		// 忽略地區
		switch($_POST['occounty'])
		  {
			  //北部
			  case "基隆市":
			  case "台北市":
			  case "新北市":
			  case "新竹市":
			  case "新竹縣":
			  case "桃園市":
			  case "桃園縣":
			  if($row_RecordSystemConfigOtr['freepriceignorth'] == '1') {
			  }else{
				  $_POST['ocfreight'] = 0; // 滿額免運
				  $freepriceok=1; // 滿額免運確認
			  }
			  break;
			  //中部
			  case "台中市":
			  case "彰化縣":
			  case "苗栗縣":
			  case "南投縣":
			  if($row_RecordSystemConfigOtr['freepriceigcenter'] == '1') {
			  }else{
				  $_POST['ocfreight'] = 0; // 滿額免運
				  $freepriceok=1; // 滿額免運確認
			  }
			  break;
			  //南部
			  case "嘉義市":
			  case "嘉義縣":
			  case "雲林縣":
			  case "台南市":
			  case "高雄市":
			  case "屏東縣":
			  if($row_RecordSystemConfigOtr['freepriceigsourth'] == '1') {
			  }else{
				  $_POST['ocfreight'] = 0; // 滿額免運
				  $freepriceok=1; // 滿額免運確認
			  }
			  break;
			  //東部
			  case "宜蘭縣":
			  case "台東縣":
			  case "花蓮縣":
			  if($row_RecordSystemConfigOtr['freepriceigeast'] == '1') {
			  }else{
				  $_POST['ocfreight'] = 0; // 滿額免運
				  $freepriceok=1; // 滿額免運確認
			  }
			  break;
			  //外島
			  case "金門縣":
			  case "連江縣":
			  case "澎湖縣":
			  if($row_RecordSystemConfigOtr['freepriceigouter'] == '1') {
			  }else{
				  $_POST['ocfreight'] = 0; // 滿額免運
				  $freepriceok=1; // 滿額免運確認
			  }
			  break;
			  //非本國
			  case "非台灣地區":
			  if($row_RecordSystemConfigOtr['freepriceignotaiwan'] == '1') {
			  }else{
				  $_POST['ocfreight'] = 0; // 滿額免運
				  $freepriceok=1; // 滿額免運確認
			  }
			  break;
		  }
	}
	
}
?>

<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php if($_POST['ocfreight'] >= 0 && $_POST['ocfreight'] != "") { echo "運費"; } 
?>
<?php if ($freepriceok != 1) { /* 0:有運費(預設值) / 1:免運 */ ?>
	<?php if($_POST['ocfreight'] == '-1') { /* $_POST['ocfreight'] 運費價格 -1代表運費錯誤 目前此功能未開放 */  ?>
    <?php $ocfreight = 0; $ocfreightprice = ""; $ocfreightdesc = "等待商家報價"; $freepricedesc = "等待商家報價"; $ocfreightstateonly = "2"; ?>
    <span style="color:#FF0000">(<?php echo $Lang_Classify_Context_Waiting_For_Business_Offer; //等待商家報價 ?>)</span>
    <?php } else if($_POST['ocfreight'] == '0'){ /* 免運費 */ ?>
    <?php $ocfreightstateonly = "0"; ?>
    <!--<span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); ?></span>-->
    <?php $ocfreightprice = $ocfreight = $_POST['ocfreight']; ?>
    <?php } else if($_POST['ocfreight'] == ''){ /* 不開放 */ ?>
		<?php if ($_POST['ocfreightselectno'] == 1) { // 當有設定貨運方式才會判斷(1為未設定) ?>
        <?php $ocfreightstateonly = "0"; ?>
        <!--<span style="color:#FF0000">(購物車無貨運方式)</span>-->
        <?php } else { // 當有設定貨運方式才會判斷 ?>
        <?php $ocfreight = 0; $ocfreightprice = ""; $ocfreightdesc = "買家尚未填寫運費"; $freepricedesc = "買家尚未填寫運費"; $ocfreightstateonly = "1"; ?>
        <span style="color:#FF0000">(<?php echo $Lang_Classify_Context_Buye_Has_Not_Yet_Filled_In_Freight; //買家尚未填寫運費 ?>)</span>
        <?php } // 當有設定貨運方式才會判斷 ?>
	<?php } else { ?>
	<?php $ocfreightstateonly = "0"; ?>
    <!--<span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); ?></span>-->
    <?php $ocfreightprice = $ocfreight = $_POST['ocfreight']; ?>
    <?php } ?>
<?php } else {  ?>
<?php $ocfreight = 0; $ocfreightprice = 0; $ocfreightdesc = "滿額免運費"; ?>
	<!--<span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); ?></span> --><span style="color:#FF0000">(<?php echo $Lang_Classify_Context_Free_Shipping; //滿額免運費 ?>)</span>
<?php } ?>

<?php if ($_POST['ocfreightselectno'] != 1) { // 當有設定貨運方式才會判斷(1為未設定) ?>
【<?php echo $rFreight; // 運費名稱 ?>】
<?php } // 當有設定貨運方式才會判斷(1為未設定) ?>
<?php //} // 當有設定貨運方式才會判斷 ?>
<?php // 比較傳送過來之表單值 將標籤名稱顯示出來 END ?>

<input name="ocfreightdesc" type="hidden" id="ocfreightdesc" value="<?php echo $ocfreightdesc; ?>" />
<?php 
			  switch($checkprice)
			  {
				  case "0":
				  if($row_RecordCartListFreight['dynamicpriceunit1'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay1'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay1']/100);
				  }
				  break;
				  case "1":
				  if($row_RecordCartListFreight['dynamicpriceunit2'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay2'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay2']/100);
				  }
				  break;
				  case "2":
				  if($row_RecordCartListFreight['dynamicpriceunit3'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay3'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay3']/100);
				  }
				  break;
				  case "3":
				  if($row_RecordCartListFreight['dynamicpriceunit4'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay4'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay4']/100);
				  }
				  break;
				  case "4":
				  if($row_RecordCartListFreight['dynamicpriceunit5'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay5'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay5']/100);
				  }
				  break;
				  case "5":
				  if($row_RecordCartListFreight['dynamicpriceunit6'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay6'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay6']/100);
				  }
				  break;
			  }
			  ?>
<?php // 貨到付款加收 -------------------------------------- ?>
</div>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">
<?php 
if($_POST['ocfreight'] >= 0 && $_POST['ocfreight'] != "") { echo "+" . $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); } 
?>
</div>
<?php if($_POST['ocpaymentselect'] == 'payondelivery') { // 當貨運為貨到付款時才會計算否則價格為0 ?>
<?php if($ocotherprice != "") {?>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo $Lang_Classify_Context_Cart_Cash_On_Delivery_Plus; //貨到付款外加 ?></div><div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">+<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($ocotherprice);  ?><input name="ocotherprice" type="hidden" id="ocotherprice" value="<?php echo $ocotherprice; ?>" /></div>
<?php } ?>
<?php } else { ?>
<?php $ocotherprice = 0; ?>
<?php } ?>
<?php // 貨到付款加收 -------------------------------------- ?>


<div class="clearfix"></div>


<?php // 額外金額 -------------------------------------- ?>
<?php $exprice=0; ?>
<?php if($row_RecordSystemConfigOtr['expriceenable'] == "1") { ?>
<?php 
			  		if($_POST['ocexpriceselect'] == '1') // 消費者選擇加收
					{
						// 計算額外費用
						switch($row_RecordSystemConfigOtr['expricecomputeselect'])
						{
							case "0":
								//echo "固定金額";
								$expricecomputedesc = $row_RecordSystemConfigOtr['expricefixed'] . "元";
								$exprice = $row_RecordSystemConfigOtr['expricefixed'];
								echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" style=\"text-align:right; color:#666;\">";
								echo $row_RecordSystemConfigOtr['expricename'];
								echo "</div>";
								echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" style=\"text-align:right; color:#666;\">";
								if($exprice >= 0) {echo "+";}else if($exprice < 0){echo "-";}
								echo $Lang_Classify_Context_Currency_units . doFormatMoney($exprice);
								echo "</div>";
								break;
							case "1":
								//echo "比例金額";
								$expercent = ceil($_SESSION['Total']*$row_RecordSystemConfigOtr['expricepercent']/100);
								$exprice = $expercent;
								$expricecomputedesc = $Lang_Classify_Context_Cart_Commodity_Amount/*商品金額*/ . "[". $_SESSION['Total'] .$Lang_Classify_Context_Cart_Money_Unit/*元*/."] * " . $row_RecordSystemConfigOtr['expricepercent'] . "% = " . $expercent . $Lang_Classify_Context_Cart_Money_Unit/*元*/;
								echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" style=\"text-align:right; color:#666;\">";
								echo $row_RecordSystemConfigOtr['expricename'];
								echo "</div>";
								echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" style=\"text-align:right; color:#666;\">";
								if($exprice >= 0) {echo "+";}else if($exprice < 0){echo "-";}
								echo $Lang_Classify_Context_Currency_units . doFormatMoney($exprice);
								echo "</div>";
								break;
							case "2":
								//echo "比例金額+運費";
								if($_POST['ocfreight'] == "-1")
								{
									// 等待廠商報價
									//$ocfreight=0; // 計算用
									//$ocfreightdesc
									//$ocfreightprice = "";
								}
								if($_POST['ocfreight'] == "")
								{
									// 未填運費
									//$ocfreightprice = "";
								}
								if($ocfreightprice == "") {
									// 當運費不可知時
									$expricecomputedesc = "[".$Lang_Classify_Context_Cart_Commodity_Amount/*商品金額*/ . "[". $_SESSION['Total'] .$Lang_Classify_Context_Cart_Money_Unit/*元*/."]+".$Lang_Classify_Context_Cart_Freight/*運費*/."[" . $ocfreightdesc . "]] * " . $row_RecordSystemConfigOtr['expricepercentfull'] . "%";
									$exprice = "-1";
									echo $row_RecordSystemConfigOtr['expricename'] . "：<div style=\"color:#FF0000\">" . $expricecomputedesc. "</div>";
								}else{
									$expercent = ceil(($_SESSION['Total']+$ocfreightprice)*$row_RecordSystemConfigOtr['expricepercent']/100);
									$exprice = $expercent;
									$expricecomputedesc = "[".$Lang_Classify_Context_Cart_Commodity_Amount/*商品金額*/."[". $_SESSION['Total'] .$Lang_Classify_Context_Cart_Money_Unit/*元*/."]+".$Lang_Classify_Context_Cart_Freight/*運費*/."[" . $ocfreightprice . $Lang_Classify_Context_Cart_Money_Unit/*元*/ ."]] * " . $row_RecordSystemConfigOtr['expricepercentfull'] . "%";
									//echo $row_RecordSystemConfigOtr['expricename'] . "：<span style=\"color:#FF0000\">$" . doFormatMoney($exprice). "</span><br/>";
								}
								
								break;
						}
					}
			  ?>
<?php } ?>
<?php // 額外金額 -------------------------------------- ?>


<div class="clearfix"></div>


<?php // 發票5%稅 -------------------------------------- ?>
<?php 
			  $invoicetaxprice = 0;
			  if($_POST['invoiceformat'] != 0 /*選擇開發票*/&& $row_RecordSystemConfigOtr['invoiceenable'] == '1'/*發票功能啟用*/) {
				  // 發票稅 = 商品金額+運費+自訂額外價格
				  // 貨到付款額外加收不計算發票稅
				  if($row_RecordSystemConfigOtr['invoiceburden'] == '1') // 1:消費者負擔 /0:店家負擔
				  {
					  if($row_RecordSystemConfigOtr['burdenuserdecide'] == '1') {
					  }else{
					  	$invoicetaxprice = ceil(($_SESSION['Total'] + $ocfreight + $exprice)*0.05);
						echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" style=\"text-align:right; color:#666;\">";
						echo "發票稅 5%";
						echo "</div>";
						echo "<div class=\"col-md-6 col-sm-6 col-xs-6\" style=\"text-align:right; color:#666;\">";
						if($exprice >= 0) {echo "+";}else if($exprice < 0){echo "-";}
						echo $Lang_Classify_Context_Currency_units . doFormatMoney($invoicetaxprice);
						echo "</div>";
					  }
				  }
			  }
			  ?>
<?php // 發票5%稅 -------------------------------------- ?>