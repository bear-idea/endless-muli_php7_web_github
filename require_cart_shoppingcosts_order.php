<?php 
/* ******************************************************************************************** */
// 取得 全單滿額 - 滿額折扣
/* ******************************************************************************************** */
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

if ($totalRows_RecordDiscountGetType5 > 0) {
do{
	if($OCTotal >= $row_RecordDiscountGetType5['discountFullamount'])
	{
		$discountFullamountGetType5 =  $row_RecordDiscountGetType5['discountFullamount'];
		$discountFoldnumberGetType5 =  $row_RecordDiscountGetType5['discountFoldnumber'];
		break;
	}
} while ($row_RecordDiscountGetType5 = mysqli_fetch_assoc($RecordDiscountGetType5));
}
/* ******************************************************************************************** */
// \取得 全單滿額 - 滿額折扣
/* ******************************************************************************************** */
?>
<?php if ($totalRows_RecordDiscountGetType5 > 0 && $discountFullamountGetType5 != "") { ?>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">
<?php 
if(is_int($discountFoldnumberGetType5/10)){
echo "全單滿" . $Lang_Classify_Context_Currency_units . doFormatMoney($discountFullamountGetType5) . "元" . $discountFoldnumberGetType5/10 . "折";
}else{
echo "全單滿" . $Lang_Classify_Context_Currency_units . doFormatMoney($discountFullamountGetType5) . "元" . $discountFoldnumberGetType5 . "折";
}
$DiscountShowAlldiscount_type_5 = ceil($OCTotal*((100-$discountFoldnumberGetType5)/100));
?>
</div>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "-"; ?><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_5); ?></div>
<?php } ?>
<?php  
/* ******************************************************************************************** */
// 取得 全單滿額 - 滿額減價
/* ******************************************************************************************** */
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

if ($totalRows_RecordDiscountGetType6 > 0) {
do{
	if($OCTotal >= $row_RecordDiscountGetType6['discountFullamount'])
	{
		$discountFullamountGetType6 =  $row_RecordDiscountGetType6['discountFullamount'];
		$discountNowfoldGetType6 =  $row_RecordDiscountGetType6['discountNowfold'];
		break;
	}
} while ($row_RecordDiscountGetType6 = mysqli_fetch_assoc($RecordDiscountGetType6));
}

/* ******************************************************************************************** */
// \取得 全單滿額 - 滿額減價
/* ******************************************************************************************** */
?>
<?php if ($totalRows_RecordDiscountGetType6 > 0 && $discountFullamountGetType6 != "") { ?>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">
<?php 
$DiscountShowAlldiscount_type_6 = $discountNowfoldGetType6;
echo "全單滿" . $Lang_Classify_Context_Currency_units . doFormatMoney($discountFullamountGetType6) . "減" . $discountNowfoldGetType6 . "元";
?>
</div>
<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "-"; ?><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_6); ?></div>
<?php } ?>

<?php  
mysqli_free_result($RecordDiscountGetType5);

mysqli_free_result($RecordDiscountGetType6);
?>