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

$search_people = $_POST['search_people'];
$search_author = $_POST['search_author'];
$search_arrivals = $_POST['search_arrivals'];
$search_oserial = $_POST['search_oserial'];

$search_arrivals_spile = explode(" ",$search_arrivals);
$search_startdate = $search_arrivals_spile[0];
$search_enddate = $search_arrivals_spile[2];

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
        case 1;$orderSql = " ORDER BY code ".$order_dir;break;
        case 2;$orderSql = " ORDER BY type ".$order_dir;break;
		case 3;$orderSql = " ORDER BY title ".$order_dir;break;
        case 4;$orderSql = " ORDER BY snumber ".$order_dir;break;
		case 5;$orderSql = " ORDER BY Totalweight ".$order_dir;break;
		case 6;$orderSql = " ORDER BY price ".$order_dir;break;
		case 7;$orderSql = " ORDER BY Totalprice ".$order_dir;break;
		case 8;$orderSql = " ORDER BY carnumber ".$order_dir;break;
		case 9;$orderSql = " ORDER BY arrivals ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY id DESC";
}else{
	$orderSql = $orderSql . ",id DESC";
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

$maxRows_RecordScaleorder = $length;
$startRow_RecordScaleorder = $start;

$colsearch_RecordScaleorder = "%";
if (isset($DT_search)) {
  $colsearch_RecordScaleorder = $DT_search;
}

//$colnamelang_RecordScaleorder = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder = $_SESSION['lang'];
}

$coltype_RecordScaleorder = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordScaleorder = $search_type;
}

$colpeople_RecordScaleorder = "%";
if (isset($search_people) && $search_people != "") {
  $colpeople_RecordScaleorder = $search_people;
}

$coloserial_RecordScaleorder = "%";
if (isset($search_oserial) && $search_oserial != "") {
  $coloserial_RecordScaleorder = $search_oserial;
}

$colauthor_RecordScaleorder = "%";
if (isset($search_author) && $search_author != "") {
  $colauthor_RecordScaleorder = $search_author;
}

$coluserid_RecordScaleorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder = $w_userid;
}

$dt = new DateTime();
$dt->modify('first day of -2 month');
$colstartdate_RecordScaleorder = $dt->format('Y-m-d');
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder = $search_startdate;
}

$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordScaleorder = $dt->format('Y-m-d');
$colenddate_RecordScaleorder .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordScaleorder = $dt->format('Y-m-d');
  $colenddate_RecordScaleorder .= " 23:59:59";
}

$dt = new DateTime();
//$interval = new DateInterval('P1M');
//$dt->add($interval);
$colenddate_RecordScaleorder_postdate = $dt->format('Y-m-d');
$colenddate_RecordScaleorder_postdate .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1M');
  //$dt->add($interval);
  $colenddate_RecordScaleorder_postdate = $dt->format('Y-m-d');
  $colenddate_RecordScaleorder_postdate .= " 23:59:59";
}


//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scaleorder_out WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScaleorder, "int"),GetSQLValueString($colnamelang_RecordScaleorder, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScaleorder = sprintf("SELECT * FROM erp_scaleorder_out WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScaleorder, "text"), GetSQLValueString($colindicate_RecordScaleorder, "text"),GetSQLValueString($coluserid_RecordScaleorder, "int"),GetSQLValueString($collang_RecordScaleorder, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scaleorderindetail WHERE lang = %s && userid=%s && bound ='out'",GetSQLValueString($collang_RecordScaleorder, "text"),GetSQLValueString($coluserid_RecordScaleorder, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

$query_RecordScaleorder = sprintf("SELECT tb_o.title, erp_scalepricelist.startdate, erp_scalepricelist.enddate, erp_scalepricelist.price, erp_scalepricelist.name, tb_o.code, tb_o.type, tb_o.Totalweight, tb_o.Minweight, erp_scaleorderout.snumber, erp_scaleorderout.snumber8, erp_scaleorderout.snumber7, erp_scaleorderout.snumber9, erp_scaleorderout.userid, erp_scaleorderout.carnumber, erp_scaleorderout.oserial, erp_scaleorderout.oid, erp_scaleorderout.arrivals, erp_scaleorderout.lang FROM (SELECT * FROM erp_scaleorderindetail WHERE bound ='out' && lang = %s && userid=%s && postdate BETWEEN %s AND %s) AS tb_o LEFT OUTER JOIN erp_scaleorderout ON erp_scaleorderout.oserial = tb_o.oserial LEFT OUTER JOIN erp_scalepricelist ON tb_o.code = erp_scalepricelist.code && erp_scaleorderout.arrivals BETWEEN erp_scalepricelist.startdate AND erp_scalepricelist.enddate + INTERVAL 1 DAY HAVING erp_scaleorderout.arrivals BETWEEN %s AND %s && (tb_o.title LIKE binary %s) ORDER BY erp_scaleorderout.arrivals DESC", GetSQLValueString($collang_RecordScaleorder, "text"),GetSQLValueString($coluserid_RecordScaleorder, "int"),GetSQLValueString($colstartdate_RecordScaleorder, "date"),GetSQLValueString($colenddate_RecordScaleorder_postdate, "date"),GetSQLValueString($colstartdate_RecordScaleorder, "date"),GetSQLValueString($colenddate_RecordScaleorder, "date"),GetSQLValueString('%'.$colsearch_RecordScaleorder.'%', "text"));


if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
	$totalRows_RecordScaleorder = mysqli_num_rows($RecordScaleorder);
	
}else{
	//分頁
	$query_limit_RecordScaleorder = sprintf("%s LIMIT %d, %d", $query_RecordScaleorder, $startRow_RecordScaleorder, $maxRows_RecordScaleorder);
	$RecordScaleorder = mysqli_query($DB_Conn, $query_limit_RecordScaleorder) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
	
	if (isset($_GET['totalRows_RecordScaleorder'])) {
	  $totalRows_RecordScaleorder = $_GET['totalRows_RecordScaleorder'];
	} else {
	  $all_RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder);
	  $totalRows_RecordScaleorder = mysqli_num_rows($all_RecordScaleorder);
	}
	$totalPages_RecordScaleorder = ceil($totalRows_RecordScaleorder/$maxRows_RecordScaleorder)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScaleorder > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder['id'];
	$link_edit = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder['id'];
	$link_start = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScaleorder["id"].",event);'><i class='far fa-trash-alt'></i> 移至入庫</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScaleorder["id"];
	
  	$dvalue['chk'] = "<input name='delScaleorder_in[]' type='checkbox' id='delScaleorder_in[]' value='".$row_RecordScaleorder["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordScaleorder["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordScaleorder["id"]."' data-placement='top'>".$row_RecordScaleorder["title"]."</span>";
	
	$dvalue['type'] = "<span id='type_".$row_RecordScaleorder["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordScaleorder["id"]."' data-placement='top'>".$row_RecordScaleorder["type"]."</span>";
	
	
	
	// -- 取得物料 --
	$colname_RecordScale = "-1";
	if (isset($row_RecordScaleorder['code'])) {
	  $colname_RecordScale = $row_RecordScaleorder['code'];
	}
	$coluserid_RecordScale = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordScale = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
	$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
	$row_RecordScale = mysqli_fetch_assoc($RecordScale);
	$totalRows_RecordScale = mysqli_num_rows($RecordScale);
	// -- 取得物料 --
	
	// -- 取得分類 --
	$collang_RecordScaleViewLine_l1 = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordScaleViewLine_l1 = $_SESSION['lang'];
	}
	$coluserid_RecordScaleViewLine_l1 = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordScaleViewLine_l1 = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordScaleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordScaleViewLine_l1, "int"));
	$RecordScaleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordScaleViewLine_l1) or die(mysqli_error($DB_Conn));
	$row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
	$totalRows_RecordScaleViewLine_l1 = mysqli_num_rows($RecordScaleViewLine_l1);
	
	if ($row_RecordScale['type1'] != '') {
		do {  //比較字串
			if (!(strcmp($row_RecordScaleViewLine_l1['item_id'], $row_RecordScale['type1']))) { $code =  $row_RecordScaleViewLine_l1['itemname']; 
			}
		} while ($row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1));
		$rows = mysqli_num_rows($RecordScaleViewLine_l1);
		  if($rows > 0) {
			  mysqli_data_seek($RecordScaleViewLine_l1, 0);
			  $row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
		  }
	}
	// -- 取得分類 --

	$dvalue['code'] = $code;
	
	$dvalue['type'] = "";
	
	$dvalue['title'] = $row_RecordScaleorder['title'];
	
	$dvalue['snumber'] = "";
	
	if($row_RecordScaleorder['Oriweight'] == "" || ($row_RecordScaleorder['Totalweight'] > 0 && $row_RecordScaleorder['Oriweight'] == "0")) {
		$dvalue['Totalweight'] = $row_RecordScaleorder['Totalweight'] - $row_RecordScaleorder['Minweight'];
	}else{
		$dvalue['Totalweight'] = $row_RecordScaleorder['Oriweight'];
	}
	
	$dvalue['price'] = $row_RecordScaleorder['price'];
	
	if($row_RecordScaleorder['Oriweight'] == "" || ($row_RecordScaleorder['Totalweight'] > 0 && $row_RecordScaleorder['Oriweight'] == "0")) 
	{
		$dvalue['Totalprice'] = ($row_RecordScaleorder['Totalweight']-$row_RecordScaleorder['Minweight']) * $row_RecordScaleorder['price'];
	}else{
		$dvalue['Totalprice'] = $row_RecordScaleorder['Oriweight']*$row_RecordScaleorder['price'];
	} 
	
	$dvalue['carnumber'] = $row_RecordScaleorder['carnumber'];
	
	$dt = new DateTime($row_RecordScaleorder['arrivals']); 
	$dvalue['arrivals'] = "<span id='arrivals_".$row_RecordScaleorder["id"]."' class='ed_arrivals' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordScaleorder["id"]."' data-placement='top'>".$dt->format('Y-m-d H:i A')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordScaleorder["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScaleorder), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScaleorder);
?>
