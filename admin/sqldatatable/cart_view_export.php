<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

//获取Datatables发送的参数 必要
if(isset($_POST['draw'])){
	$draw = $_POST['draw'];//这个值作者会直接返回给前台
}else{
	$draw = "";
}

//搜索
if(isset($_POST['search']['value'])){
	$DT_search = $_POST['search']['value'];//获取前台传过来的过滤条件
}else{
	$DT_search = "";
}

// 取得自定變數
//$tb_filter_title = $_POST['tb_filter_title'];
//$tb_filter_sortid = $_POST['tb_filter_sortid'];
//$tb_filter_indicate = $_POST['tb_filter_indicate'];

if(isset($_POST['search_state'])){
	$search_state = $_POST['search_state'];
}else{
	$search_state = "";
}
if(isset($_POST['search_postdate'])){
	$search_postdate = $_POST['search_postdate'];
}else{
	$search_postdate = "";
}

if(isset($search_postdate)){
	$search_postdate_spile = explode(" ",$search_postdate);
	$search_startdate = $search_postdate_spile[0];
	if(isset($search_postdate_spile[2])){
		$search_enddate = $search_postdate_spile[2];
	}
}

//排序
if(isset($_POST['order']['0']['column'])){
	$order_column = $_POST['order']['0']['column'];//那一列排序，从0开始
}else{
	$order_column = "";
}
if(isset($_POST['order']['0']['dir'])){
	$order_dir = $_POST['order']['0']['dir'];//ase desc 升序或者降序
}else{
	$order_dir = "";
}

//拼接排序sql
$orderSql = "";
if(isset($order_column)){
    $i = intval($order_column);
    switch($i){
        //case 0;$orderSql = " ORDER BY id ".$order_dir;break;
        //case 1;$orderSql = " ORDER BY oserial ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY ocbuyname ".$order_dir;break;
		//case 3;$orderSql = " ORDER BY ocbuyphone ".$order_dir;break;
        //case 4;$orderSql = " ORDER BY postdate ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY payment ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY ocfreightstate ".$order_dir;break;
		//case 7;$orderSql = " ORDER BY state ".$order_dir;break;
		//case 8;$orderSql = " ORDER BY state ".$order_dir;break;
		//case 9;$orderSql = " ORDER BY people ".$order_dir;break;
		////case 10;$orderSql = " ORDER BY bound ".$order_dir;break;
		//case 11;$orderSql = " ORDER BY author ".$order_dir;break;
		//case 12;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY postdate DESC";
}else{
	$orderSql = $orderSql . ",postdate DESC";
}

//分页
if(isset($_POST['start'])){
	$start = $_POST['start'];//从多少开始
}else{
	$start = "";
}
if(isset($_POST['length'])){
	$length = $_POST['length'];//数据长度 共幾筆資料
}else{
	$length = "";
}
$limitSql = '';
$limitFlag = isset($_POST['start']) && $length != -1 ;
if ($limitFlag ) {
    $limitSql = " LIMIT ".intval($start).", ".intval($length);
}

//条件过滤后记录数 必要
$recordsFiltered = 0;
//表的总记录数 必要
$recordsTotal = 0;

$maxRows_RecordCart = $length;
$startRow_RecordCart = $start;

$colsearch_RecordCart = "%";
if (isset($DT_search)) {
  $colsearch_RecordCart = $DT_search;
}

//$colnamelang_RecordCart = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCart = $_SESSION['lang'];
}

$colindicate_RecordCart = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordCart = $search_indicate;
}

$coltype_RecordCart = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordCart = $search_type;
}

$colpeople_RecordCart = "%";
if (isset($search_people) && $search_people != "") {
  $colpeople_RecordCart = $search_people;
}

$coloserial_RecordCart = "%";
if (isset($search_oserial) && $search_oserial != "") {
  $coloserial_RecordCart = $search_oserial;
}

$colstate_RecordCart = "%";
if (isset($search_state) && $search_state != "") {
  $colstate_RecordCart = $search_state;
}

$coluserid_RecordCart = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCart = $w_userid;
}

$colstartdate_RecordCart = "%";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordCart = $search_startdate;
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordCart = $dt->format('Y-m-d');
$colenddate_RecordCart .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordCart = $dt->format('Y-m-d');
  $colenddate_RecordCart .= " 23:59:59";
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scaleorder_out WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordCart, "int"),GetSQLValueString($colnamelang_RecordCart, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordCart = sprintf("SELECT * FROM erp_scaleorder_out WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordCart, "text"), GetSQLValueString($colindicate_RecordCart, "text"),GetSQLValueString($coluserid_RecordCart, "int"),GetSQLValueString($collang_RecordCart, "text"));

$query_RecordCount = sprintf("SELECT count(oid) as sum FROM demo_cartorders WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordCart, "text"),GetSQLValueString($coluserid_RecordCart, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordCart = sprintf("SELECT * FROM demo_cartorders WHERE ((oserial LIKE binary %s) || (ocbuyname LIKE binary %s)) && lang = %s  && (state LIKE %s) && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $DT_search . "%", "text"),GetSQLValueString("%" . $DT_search . "%", "text"),GetSQLValueString($collang_RecordCart, "text"),GetSQLValueString("%" . $colstate_RecordCart . "%", "text"),GetSQLValueString($coluserid_RecordCart, "int"),GetSQLValueString($colstartdate_RecordCart, "date"),GetSQLValueString($colenddate_RecordCart, "date"));

if($draw == "" || $length == '-1') {
    //無分頁
	$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
	$row_RecordCart = mysqli_fetch_assoc($RecordCart);
	$totalRows_RecordCart = mysqli_num_rows($RecordCart);
	
}else{
	//分頁
	$query_limit_RecordCart = sprintf("%s LIMIT %d, %d", $query_RecordCart, $startRow_RecordCart, $maxRows_RecordCart);
	$RecordCart = mysqli_query($DB_Conn, $query_limit_RecordCart) or die(mysqli_error($DB_Conn));
	$row_RecordCart = mysqli_fetch_assoc($RecordCart);
	
	if (isset($_GET['totalRows_RecordCart'])) {
	  $totalRows_RecordCart = $_GET['totalRows_RecordCart'];
	} else {
	  $all_RecordCart = mysqli_query($DB_Conn, $query_RecordCart);
	  $totalRows_RecordCart = mysqli_num_rows($all_RecordCart);
	}
	$totalPages_RecordCart = ceil($totalRows_RecordCart/$maxRows_RecordCart)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordCart > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_view = "manage_cart_index_detailed.php?Serial=" . $row_RecordCart['oserial'] . "&amp;lang=" . $_SESSION['lang'];
    $link_add = "manage_cart.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_cart.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCart['oid'];
	$link_edit = "manage_cart.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCart['oid'];
	$link_start = "manage_cart.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary colorbox_iframe' style='text-align:center'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(\"".$row_RecordCart["oserial"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordCart["oid"];
	
	$dvalue['oserial'] = $row_RecordCart["oserial"];
	
	$dt = new DateTime($row_RecordCart['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordCart["oid"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".$dt->format('Y-m-d H:i A')."</span>";
	
  	//$dvalue['chk'] = "<input name='delCart[]' type='checkbox' id='delCart[]' value='".$row_RecordCart["oid"]."\'/>";

	$dvalue['ocbuyname'] = $row_RecordCart["ocbuyname"];
	
	$dvalue['ocbuymail'] = $row_RecordCart["ocbuymail"];
	
	$dvalue['ocbuytel'] = $row_RecordCart["ocbuytel"];
	
	$dvalue['ocbuyphone'] = $row_RecordCart["ocbuyphone"];
	
	$dvalue['ocname'] = $row_RecordCart["ocname"];
	
	$dvalue['ocmail'] = $row_RecordCart["ocmail"];
	
	$dvalue['octel'] = $row_RecordCart["octel"];
	
	$dvalue['ocphone'] = $row_RecordCart["ocphone"];
	
	$dvalue['ocaddr'] = $row_RecordCart['oczip'].$row_RecordCart['occounty'].$row_RecordCart['ocdistrict'].$row_RecordCart['ocaddr'];
	
	if(isset($row_RecordCart['invoiceformat'])) {
		switch($row_RecordCart['invoiceformat'])
		{
			case "0":
			//echo "不開發票";
			$ocinvoiceformat = "不開發票";
			break;
			case "1":
			//echo "二聯式發票";
			$ocinvoiceformat = "二聯式發票";
			break;
			case "2":
			//echo "三聯式發票";
			$ocinvoiceformat = "三聯式發票";
			break;
			case "3":
			//echo "電子式發票";
			$ocinvoiceformat = "電子式發票";
			break;
			case "4":
			//echo "收據";
			$ocinvoiceformat = "收據";
			break;
			case "5":
			//echo "捐給慈善單位";
			$ocinvoiceformat = "捐給慈善單位";
			break;
		}
	}else{
		$ocinvoiceformat = "";
	}
	
	$dvalue['invoiceformat'] = $ocinvoiceformat;
	
	if(isset($row_RecordCart['ocinvoiceetselect'])) {
		switch($row_RecordCart['ocinvoiceetselect'])
		{
			case "0":
			$ocinvoiceetselect = "列印寄給我";
			break;
			case "1":
			$ocinvoiceetselect = "載具條碼：" . $row_RecordCart['ocinvoicesupportno'];
			break;
			case "2":
			$ocinvoiceetselect = "愛心碼：" . $row_RecordCart['ocinvoiceloveno'];		
			break;
		}
	}else{
		$ocinvoiceetselect = "";
	}
	
	$dvalue['ocinvoiceetselect'] = "";
	
	$dvalue['ocinvoicecompanyno'] = $row_RecordCart["ocinvoicecompanyno"];
	
	$dvalue['ocinvoicetitle'] = $row_RecordCart["ocinvoicetitle"];
	
	$dvalue['ocinvoiceusername'] = $row_RecordCart["ocinvoiceusername"];
	
	$dvalue['ocinvoiceaddr'] = $row_RecordCart["ocinvoiceaddr"];
	
	switch($row_RecordCart['ocpaymentselect'])
	{
		case "payondelivery":
		$dvalue['payment'] = "貨到付款";
		break;
		case "lingui":
		$dvalue['payment'] = "金融匯款";
		break;
		case "atm":
		$dvalue['payment'] = "ATM轉帳";
		break;
		case "postoffice":
		$dvalue['payment'] = "郵政劃撥";
		break;
		case "other":
		$dvalue['payment'] = "其他付款方式";
		break;
		case "paypal":
		$dvalue['payment'] = "PAYPAL";
		break;
		case "allpay":
		case "allpay_Credit":
		case "allpay_BARCODE":
		case "allpay_CVS":
		$dvalue['payment'] = "綠界";	
		break;
		case "pchomepay":
		$dvalue['payment'] = "支付連";
		break;
		default:
		$dvalue['payment'] = $row_RecordCart['ocpaymentselect'];
		break;
	}
	
	switch($row_RecordCart['ocfreightstate'])
	{
		case "0":
			$row_RecordCart["ocfreightstate"] = "需自行確認"; 
			break;
		case "1":
			$row_RecordCart["ocfreightstate"] = "等待貨款";
			break;
		case "2":
			$row_RecordCart["ocfreightstate"] = "已收到貨款"; 
			break;
		default:
		    $row_RecordCart["ocfreightstate"] = "需自行確認"; 
			break;
		break;
	}
	
	$dvalue['ocfreightstate'] = $row_RecordCart["ocfreightstate"];
	
	$dvalue['ocfreightdate'] = $row_RecordCart["ocfreightdate"];
	
	$dvalue['ocfreightno'] = $row_RecordCart["ocfreightno"];
	
	$dvalue['ocpaymentpredate'] = $row_RecordCart["ocpaymentpredate"];
	
	$coluserid_RecordCartPayment = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCartPayment = $w_userid;
	}
	$colitemid_RecordCartPayment = "-1";
	if (isset($row_RecordCart['ocfreightselect'])) {
	  $colitemid_RecordCartPayment = $row_RecordCart['ocfreightselect'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartPayment = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && userid=%s && item_id = %s", GetSQLValueString($coluserid_RecordCartPayment, "int"),GetSQLValueString($colitemid_RecordCartPayment, "int"));
	$RecordCartPayment = mysqli_query($DB_Conn, $query_RecordCartPayment) or die(mysqli_error($DB_Conn));
	$row_RecordCartPayment = mysqli_fetch_assoc($RecordCartPayment);
	$totalRows_RecordCartPayment = mysqli_num_rows($RecordCartPayment);


	if ($row_RecordCart['ocfreightselect'] == "sevenshop")
	{
		$dvalue['transit'] = "7-11 超商取貨(取貨付款)";
	}
	elseif ($row_RecordCart['ocfreightselect'] == "sevenshopnopay")
	{
		$dvalue['transit'] = "7-11 超商取貨(純配送)";
	}
	elseif ($row_RecordCart['ocfreightselect'] == "familyshop")
	{
		$dvalue['transit'] = "全家超商取貨(取貨付款)";
	}
	elseif ($row_RecordCart['ocfreightselect'] == "familyshopnopay")
	{
		$dvalue['transit'] = "全家超商取貨(純配送)";
	}else{
		$dvalue['transit'] = "";
	}
	
	if($totalRows_RecordCartPayment > 0) { 
		$dvalue['transit'] = $row_RecordCartPayment['itemname'];
 	} 
	
    $dvalue['ocfreightselect'] = $dvalue['transit'];
	
	if($row_RecordCart['ocCVSStoreName'] != "") { $dvalue['ocfreightselect'] .= "【".$row_RecordCart['ocCVSStoreName'] ."】"; }	
	
	$dvalue['state'] = $row_RecordCart['state'];
	
	$dvalue['ocpaymentdate'] = $row_RecordCart['ocpaymentdate'];
	
	$dvalue['ocpaymentno'] = $row_RecordCart['ocpaymentno'];
	
	$dvalue['ocreceipt'] = $row_RecordCart['ocreceipt'];
	
	$dvalue['ocpdprice'] = $row_RecordCart['ocpdprice']; /////////  ???  檢查  商品金額
	
	$dvalue['ocfreightprice'] = $row_RecordCart['ocfreightprice']; /////////  ???  檢查  運費
	
	$dvalue['ocfreepricedesc'] = $row_RecordCart['ocfreepricedesc'];
	
	$dvalue['ocfreightstateonly'] = "";
	if ($row_RecordCart['ocfreightstateonly'] == "1") {
		$dvalue['ocfreightstateonly'] = "消費者自填運費";
	}
	if ($row_RecordCart['ocfreightstateonly'] == "2") {
		$dvalue['ocfreightstateonly'] = "業者填寫運費";
	}
	if ($row_RecordCart['ocfreightstateonly'] == "3") {
		$dvalue['ocfreightstateonly'] = "滿額免運費";
	}
	
	$dvalue['ocexprice'] = $row_RecordCart['ocexprice']; /////////  ???  檢查  額外費用
	
	$dvalue['ocexpricename'] = $row_RecordCart['ocexpricename'];
	
	$dvalue['ocinvoiceprice'] = $row_RecordCart['ocinvoiceprice'];  /////////  ???  檢查  發票稅
	
	$dvalue['ocotherprice'] = $row_RecordCart['ocotherprice'];  /////////  ???  檢查  金物流加收
	
	$pricedesc = "商品價格".$row_RecordCart['ocpdprice'];
	if ($row_RecordCart['ocfreightprice'] != "") {
		$pricedesc .= "+運費".$row_RecordCart['ocfreightprice'];
	}
	if ($row_RecordCart['ocotherprice'] != "") { 
	$pricedesc .= "+金物流加收".$row_RecordCart['ocotherprice'];
	}
	if ($row_RecordCart['ocexprice'] != "" && $row_RecordCart['ocexprice'] != "0") { 
	$pricedesc .= "+自訂額外費用".$row_RecordCart['ocexprice']; 
	}
	if ($row_RecordCart['ocinvoiceprice'] != "" && $row_RecordCart['ocinvoiceprice'] != 0) { 
	$pricedesc .= "+5%發票稅".$row_RecordCart['ocinvoiceprice'];
	} 
	if ($row_RecordCart['ocDiscountShowAlldiscount_type_5'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_5'] != 0) {
    $pricedesc .= "-全單滿額折扣".$row_RecordCart['ocDiscountShowAlldiscount_type_5'];
	}
	if ($row_RecordCart['ocDiscountShowAlldiscount_type_6'] != "" && $row_RecordCart['ocDiscountShowAlldiscount_type_6'] != 0) { 
	$pricedesc .= "-全單滿額減價".$row_RecordCart['ocDiscountShowAlldiscount_type_6']; 
	}
	
	$dvalue['totolprice'] = $row_RecordCart['ocpdprice']+$row_RecordCart['ocfreightprice']+$row_RecordCart['ocotherprice']+$row_RecordCart['ocexprice']+$row_RecordCart['ocinvoiceprice']-$row_RecordCart['ocDiscountShowAlldiscount_type_5']-$row_RecordCart['ocDiscountShowAlldiscount_type_6'] . " <i class='fa fa-info-circle text-orange' data-original-title='".$pricedesc."' data-toggle='tooltip' data-placement='top'></i>";
	
	if ($row_RecordCart['ocfreepricedesc'] != "") {
		$dvalue['totolprice'] .= "<i class='fa fa-exclamation-circle'></i>" . $row_RecordCart['ocfreepricedesc'];
	}

	if(isset($row_RecordCart["notes1"])){
		$dvalue['notes1'] = "<span id=notes1_".$row_RecordCart["oid"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".$row_RecordCart["notes1"]."</span>";
	}else{
		$dvalue['notes1'] = "<span id=notes1_".$row_RecordCart["oid"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	if(isset($row_RecordCart["notes2"])){
		$dvalue['notes2'] = "<span id=notes2_".$row_RecordCart["oid"]."' class='ed_notes2 text-lime-darker' data-type='text' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".$row_RecordCart["notes2"]."</span>";
	}else{
		$dvalue['notes2'] = "<span id=notes2_".$row_RecordCart["oid"]."' class='ed_notes2 editable-click editable-empty' data-type='text' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	if(isset($row_RecordCart["notes3"])){
		$dvalue['notes3'] = "<span id=notes3_".$row_RecordCart["oid"]."' class='ed_notes3 text-lime-darker' data-type='text' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".$row_RecordCart["notes3"]."</span>";
	}else{
		$dvalue['notes3'] = "<span id=notes3_".$row_RecordCart["oid"]."' class='ed_notes3 editable-click editable-empty' data-type='text' data-pk='".$row_RecordCart["oid"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	//$dvalue['action'] = "<div class='btn-group'>".$but_view.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordCart["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
	mysqli_free_result($RecordCartPayment);
  ?>
<?php } while ($row_RecordCart = mysqli_fetch_assoc($RecordCart)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordCart), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordCart);
?>
