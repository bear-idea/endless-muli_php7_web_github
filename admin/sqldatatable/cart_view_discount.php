<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../../inc/inc_function.php'); ?>
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
if(isset($_POST['search_indicate'])){
	$search_indicate = $_POST['search_indicate'];
}else{
	$search_indicate = "";
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
        case 1;$orderSql = " ORDER BY name ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY ocbuyname ".$order_dir;break;
		case 3;$orderSql = " ORDER BY type ".$order_dir;break;
        case 4;$orderSql = " ORDER BY menuindicate ".$order_dir;break;
		case 5;$orderSql = " ORDER BY menuname ".$order_dir;break;
		case 6;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 7;$orderSql = " ORDER BY limitdate ".$order_dir;break;
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

$colstartdate_RecordCart = "1900-01-01";
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

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_productdiscount WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordCart, "text"),GetSQLValueString($coluserid_RecordCart, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordCart = sprintf("SELECT * FROM demo_productdiscount WHERE ((name LIKE binary %s) || (sdescription LIKE binary %s)) && lang = %s  && (type LIKE %s) && (indicate LIKE %s) && userid=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $DT_search . "%", "text"),GetSQLValueString("%" . $DT_search . "%", "text"),GetSQLValueString($collang_RecordCart, "text"),GetSQLValueString("%" . $coltype_RecordCart . "%", "text"),GetSQLValueString($colindicate_RecordCart, "text"),GetSQLValueString($coluserid_RecordCart, "int"),GetSQLValueString($colstartdate_RecordCart, "date"),GetSQLValueString($colenddate_RecordCart, "date"));

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
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordCart > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_view = "manage_cart_index_detailed.php?Serial=" . $row_RecordCart['oserial'] . "&amp;lang=" . $_SESSION['lang'];
    $link_add = "manage_cart.php?wshop=".$wshop."&amp;Opt=discount_add"."&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_cart.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCart['id'];
	$link_edit = "manage_cart.php?wshop=".$wshop."&amp;Opt=discount_edit_".($row_RecordCart['type']+1)."&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCart['id'];
	$link_start = "manage_cart.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
	$link_designated = "manage_cart.php?wshop=".$wshop."&amp;Opt=discount_designated&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCart['id'];
    $link_designated_cancel = "manage_cart.php?wshop=".$wshop."&amp;Opt=discount_designated_cancel&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordCart['id'];
    //$link_del = "#modal-alert";
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary colorbox_iframe' style='text-align:center'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(\"".$row_RecordCart["id"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	switch($row_RecordCart['type'])
	{
		case "0":
		case "1":
		case "2":
		case "3":
		case "4":
			$but_designated = "<a href='".$link_designated."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus-circle'></i> 指定折扣商品</a>";
            $but_designated_cancel = "<a href='".$link_designated_cancel."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-minus-circle'></i> 取消折扣商品</a>";
		break;
		default:
			$but_designated = "<a href='".$link_designated."' class='btn btn-xs btn-primary disabled' style='text-align:center'><i class='fa fa-plus-circle'></i> 指定折扣商品</a>";
            $but_designated_cancel = "<a href='".$link_designated_cancel."' class='btn btn-xs btn-primary disabled' style='text-align:center'><i class='fa fa-minus-circle'></i> 取消折扣商品</a>";
		break;
	}
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordCart["id"];
	
  	$dvalue['chk'] = "<input name='delCart[]' type='checkbox' id='delCart[]' value='".$row_RecordCart["id"]."\'/>";
	
	$dvalue['name'] = "<span id='title_".$row_RecordCart["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".$row_RecordCart["name"]."</span>";
	
	if($row_RecordCart["sdescription"] != ""){
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>描述</span> <span id=sdescription_".$row_RecordCart["id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".$row_RecordCart["sdescription"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>描述</span> <span id=sdescription_".$row_RecordCart["id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	switch($row_RecordCart['type'])
			{
				case "0":
				    $row_RecordCart["type"] =  "指定商品 - 滿件折扣(%)";
					if(is_int($row_RecordCart['discountFoldnumber']/10)){
					$dvalue['discounttype'] = "滿" . $row_RecordCart['discountPieces'] . "件" . $row_RecordCart['discountFoldnumber']/10 . "折";	
					}else{
					$dvalue['discounttype'] = "滿" . $row_RecordCart['discountPieces'] . "件" . $row_RecordCart['discountFoldnumber'] . "折";
					}
					break;
				case "1":
				    $row_RecordCart["type"] =  "指定商品 - 滿件減價(-)";
					$dvalue['discounttype'] = "滿" . $row_RecordCart['discountPieces'] . "件減" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountNowfold']) . "";
					break;
				case "2":
				    $row_RecordCart["type"] =  "指定商品 - 滿額折扣(%)";
					if(is_int($row_RecordCart['discountFoldnumber']/10)){
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . " " . $row_RecordCart['discountFoldnumber']/10 . "折";
					}else{
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . " " . $row_RecordCart['discountFoldnumber'] . "折";
					}
					break;
				case "3":
				    $row_RecordCart["type"] =  "指定商品 - 滿額減價(-)";
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . "元減" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountNowfold']) . "";
					break;
				case "4":
				    $row_RecordCart["type"] =  "指定商品 - 任選優惠";
					$dvalue['discounttype'] = "任選" . $row_RecordCart['discountPieces'] . "件" . $Lang_Classify_Context_Currency_units . doFormatMoney($row_RecordCart['discountNowfold']) . "";
					break;
				case "5":
				    $row_RecordCart["type"] =  "全單滿額 - 滿額折扣(%)";
					if(is_int($row_RecordCart['discountFoldnumber']/10)){
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . " " . $row_RecordCart['discountFoldnumber']/10 . "折";
					}else{
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . " " . $row_RecordCart['discountFoldnumber'] . "折";
					}
					break;
				case "6":
				    $row_RecordCart["type"] =  "全單滿額 - 滿額減價(-)";
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . "元減" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountNowfold']) . "";
					break;
				case "7":
				    $row_RecordCart["type"] =  "全單滿額 - 滿額贈禮";
					
					/* 取得贈品資料 */
					$colname_RecordDiscountGift = "zh-tw";
					if (isset($_SESSION['lang'])) {
					  $colname_RecordDiscountGift = $_SESSION['lang'];
					}
					$coluserid_RecordDiscountGift = "-1";
					if (isset($w_userid)) {
					  $coluserid_RecordDiscountGift = $w_userid;
					}
					$colgiftid_RecordDiscountGift = "-1";
					if (isset($row_RecordCart['discountGiftID'])) {
					  $colgiftid_RecordDiscountGift = $row_RecordCart['discountGiftID'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordDiscountGift = sprintf("SELECT * FROM demo_productgift WHERE lang=%s && userid=%s && id=%s ORDER BY id DESC", GetSQLValueString($colname_RecordDiscountGift, "text"),GetSQLValueString($coluserid_RecordDiscountGift, "int"),GetSQLValueString($colgiftid_RecordDiscountGift, "int"));
					$RecordDiscountGift = mysqli_query($DB_Conn, $query_RecordDiscountGift) or die(mysqli_error($DB_Conn));
					$row_RecordDiscountGift = mysqli_fetch_assoc($RecordDiscountGift);
					$totalRows_RecordDiscountGift = mysqli_num_rows($RecordDiscountGift);
		
					$dvalue['discounttype'] = "滿" . $Lang_Classify_Context_Currency_units.doFormatMoney($row_RecordCart['discountFullamount']) . "元送" . $row_RecordDiscountGift['name'] . "";
					break;
				default:
					break;
			} 
	
	$dvalue['type'] = $row_RecordCart["type"];
    
	//$dvalue['discounttype'] = "";
	
	if($row_RecordCart["menuindicate"] == '1') {$row_RecordCart["menuindicate"] = "是";}else{$row_RecordCart["menuindicate"] = "否";}
	$dvalue['menuindicate'] = "<span id='menuindicate_".$row_RecordCart["id"]."' class='ed_menuindicate' data-type='select' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".$row_RecordCart["menuindicate"]."</span>";
	
	if($row_RecordCart["menuname"] != ""){
		$dvalue['menuname'] = "<span id='menuname_".$row_RecordCart["id"]."' class='ed_menuname' data-type='text' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".$row_RecordCart["menuname"]."</span>";
	}else{
		$dvalue['menuname'] = "<span id='menuname_".$row_RecordCart["id"]."' class='ed_menuname editable-click editable-empty' data-type='text' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	if($row_RecordCart["indicate"] == '1') {$row_RecordCart["indicate"] = "上架";}else{$row_RecordCart["indicate"] = "下架";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordCart["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".$row_RecordCart["indicate"]."</span>";
	
	if ($row_RecordCart['limitdate'] == "0") { $dvalue['limitdate'] = "永久有效";} else { 
	    $dt_startdate = new DateTime($row_RecordCart['startdate']);
		$dt_enddate = new DateTime($row_RecordCart['enddate']);
        $dvalue['limitdate'] = $dt_startdate->format('Y-m-d') . " - " . $dt_enddate->format('Y-m-d');
	}
	
	$dt = new DateTime($row_RecordCart['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordCart["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordCart["id"]."' data-placement='top'>".$dt->format('Y-m-d H:i A')."</span>";
	
    $dvalue['action'] = "<div><div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_designated.$but_designated_cancel."</div>";
	//$dvalue['content'] = $row_RecordCart["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
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

mysqli_free_result($RecordCartPayment);
?>
