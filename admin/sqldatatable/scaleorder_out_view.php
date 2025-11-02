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
if(isset($_POST['search_postdate'])){
	$search_postdate = $_POST['search_postdate'];
}else{
	$search_postdate = "";
}
$search_oserial = $_POST['search_oserial'];

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
        case 1;$orderSql = " ORDER BY code ".$order_dir;break;
        case 2;$orderSql = " ORDER BY title ".$order_dir;break;
		case 3;$orderSql = " ORDER BY oserial ".$order_dir;break;
        case 4;$orderSql = " ORDER BY num ".$order_dir;break;
		case 5;$orderSql = " ORDER BY Totalweight ".$order_dir;break;
		case 6;$orderSql = " ORDER BY Minweight ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
		case 8;$orderSql = " ORDER BY warehouse ".$order_dir;break;
		case 9;$orderSql = " ORDER BY people ".$order_dir;break;
		case 10;$orderSql = " ORDER BY bound ".$order_dir;break;
		case 11;$orderSql = " ORDER BY author ".$order_dir;break;
		case 12;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordScaleorder_in = $length;
$startRow_RecordScaleorder_in = $start;

$colsearch_RecordScaleorder_in = "%";
if (isset($DT_search)) {
  $colsearch_RecordScaleorder_in = $DT_search;
}

//$colnamelang_RecordScaleorder_in = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder_in = $_SESSION['lang'];
}

$colindicate_RecordScaleorder_in = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordScaleorder_in = $search_indicate;
}

$coltype_RecordScaleorder_in = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordScaleorder_in = $search_type;
}

$colpeople_RecordScaleorder_in = "%";
if (isset($search_people) && $search_people != "") {
  $colpeople_RecordScaleorder_in = $search_people;
}

$coloserial_RecordScaleorder_in = "%";
if (isset($search_oserial) && $search_oserial != "") {
  $coloserial_RecordScaleorder_in = $search_oserial;
}

$colauthor_RecordScaleorder_in = "%";
if (isset($search_author) && $search_author != "") {
  $colauthor_RecordScaleorder_in = $search_author;
}

$coluserid_RecordScaleorder_in = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder_in = $w_userid;
}

$colstartdate_RecordScaleorder_in = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder_in = $search_startdate;
}

$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordScaleorder_in = $dt->format('Y-m-d');
$colenddate_RecordScaleorder_in .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordScaleorder_in = $dt->format('Y-m-d');
  $colenddate_RecordScaleorder_in .= " 23:59:59";
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scaleorder_out WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($colnamelang_RecordScaleorder_in, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScaleorder_in = sprintf("SELECT * FROM erp_scaleorder_out WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScaleorder_in, "text"), GetSQLValueString($colindicate_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString($collang_RecordScaleorder_in, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scaleorderindetail WHERE lang = %s && userid=%s && bound ='out'",GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScaleorder_in = sprintf("SELECT * FROM erp_scaleorderindetail WHERE (title LIKE binary %s || num = %s) && (author LIKE binary %s || author IS NULL) && (people LIKE binary %s || people IS NULL) && indicate LIKE %s && (type LIKE %s || type IS NULL) && lang = %s && userid=%s && bound ='out' && oserial LIKE %s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordScaleorder_in . "%", "text"), GetSQLValueString( $colsearch_RecordScaleorder_in, "text"), GetSQLValueString("%" . $colauthor_RecordScaleorder_in . "%", "text"), GetSQLValueString("%" . $colpeople_RecordScaleorder_in . "%", "text"), GetSQLValueString($colindicate_RecordScaleorder_in, "text"), GetSQLValueString($coltype_RecordScaleorder_in, "text"),GetSQLValueString($collang_RecordScaleorder_in, "text"),GetSQLValueString($coluserid_RecordScaleorder_in, "int"),GetSQLValueString("%" . $coloserial_RecordScaleorder_in . "%", "text"),GetSQLValueString($colstartdate_RecordScaleorder_in, "date"),GetSQLValueString($colenddate_RecordScaleorder_in, "date"));

if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScaleorder_in = mysqli_query($DB_Conn, $query_RecordScaleorder_in) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in);
	$totalRows_RecordScaleorder_in = mysqli_num_rows($RecordScaleorder_in);
	
}else{
	//分頁
	$query_limit_RecordScaleorder_in = sprintf("%s LIMIT %d, %d", $query_RecordScaleorder_in, $startRow_RecordScaleorder_in, $maxRows_RecordScaleorder_in);
	$RecordScaleorder_in = mysqli_query($DB_Conn, $query_limit_RecordScaleorder_in) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in);
	
	if (isset($_GET['totalRows_RecordScaleorder_in'])) {
	  $totalRows_RecordScaleorder_in = $_GET['totalRows_RecordScaleorder_in'];
	} else {
	  $all_RecordScaleorder_in = mysqli_query($DB_Conn, $query_RecordScaleorder_in);
	  $totalRows_RecordScaleorder_in = mysqli_num_rows($all_RecordScaleorder_in);
	}
	$totalPages_RecordScaleorder_in = ceil($totalRows_RecordScaleorder_in/$maxRows_RecordScaleorder_in)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScaleorder_in > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_in['id'];
	$link_edit = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_in['id'];
	$link_start = "manage_scaleorder_out.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	$link_scaleorder1 = "uplod_scaleorder1.php?id_edit=".$row_RecordScaleorder_in['id']."&amp;lang=".$_SESSION['lang']; /* 地磅單 */
	$link_scaleorder2 = "uplod_scaleorder2.php?id_edit=".$row_RecordScaleorder_in['id']."&amp;lang=".$_SESSION['lang']; /* 五金地磅單 */
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScaleorder_in["id"].",event);'><i class='far fa-trash-alt'></i> 移至入庫</a>";
	
	if($row_RecordScaleorder_in["pic1"] == "") {
	    $but_scaleorder1 = "<a href='".$link_scaleorder1."' class='btn btn-xs bg-green-transparent-4 text-white colorbox_iframe_cd' style='text-align:center' data-original-title='此圖片您可放置物料圖片、秤重圖片、督導用圖片等，會在前台顯示於該物料之旁邊' data-toggle='tooltip' data-placement='bottom'><i class='far fa-image'></i> 主圖片</a>";
	}else{
		$but_scaleorder1 = "<a href='".$link_scaleorder1."' class='btn btn-xs btn-green colorbox_iframe_cd' style='text-align:center' data-original-title='此圖片您可放置物料圖片、秤重圖片、督導用圖片等，會在前台顯示於該物料之旁邊' data-toggle='tooltip' data-placement='bottom'><i class='far fa-image'></i> 主圖片</a>";
	}

	if($row_RecordScaleorder_in["pic2"] == "") {
	    $but_scaleorder2 = "<a href='".$link_scaleorder2."' class='btn btn-xs bg-green-transparent-4 text-white colorbox_iframe_cd' style='text-align:center' data-original-title='此圖片您可放置物料圖片、秤重圖片、督導用圖片等，會在前台顯示於該物料之旁邊' data-toggle='tooltip' data-placement='bottom'><i class='far fa-image'></i> 次圖片</a>";
	}else{
		$but_scaleorder2 = "<a href='".$link_scaleorder2."' class='btn btn-xs btn-green colorbox_iframe_cd' style='text-align:center' data-original-title='此圖片您可放置物料圖片、秤重圖片、督導用圖片等，會在前台顯示於該物料之旁邊' data-toggle='tooltip' data-placement='bottom'><i class='far fa-image'></i> 次圖片</a>";
	}
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScaleorder_in["id"];
	
  	$dvalue['chk'] = "<input name='delScaleorder_in[]' type='checkbox' id='delScaleorder_in[]' value='".$row_RecordScaleorder_in["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordScaleorder_in["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordScaleorder_in["id"]."' data-placement='top'>".$row_RecordScaleorder_in["title"]."</span>";
	
	if($row_RecordScaleorder_in["notes1"] != ""){
		$dvalue['title'] .= "<div><span class='label label-lime'>備註</span> <span id=ed_notes1_".$row_RecordScaleorder_in["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_in["id"]."' data-placement='top'>".$row_RecordScaleorder_in["notes1"]."</span></div>";
	}else{
		$dvalue['title'] .= "<div><span class='label label-lime'>備註</span> <span id='ed_notes1_".$row_RecordScaleorder_in["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_in["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['type'] = "<span id='type_".$row_RecordScaleorder_in["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordScaleorder_in["id"]."' data-placement='top'>".$row_RecordScaleorder_in["type"]."</span>";
	
	
	
	// -- 取得物料 --
	$colname_RecordScale = "-1";
	if (isset($row_RecordScaleorder_in['code'])) {
	  $colname_RecordScale = $row_RecordScaleorder_in['code'];
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
	
	$link_oserial = "manage_scale_index_detailed.php?wshop=".$wshop."&amp;Serial=".$row_RecordScaleorder_in["oserial"]."&amp;lang=".$_SESSION['lang'];
	
	$dvalue['oserial'] = "<a href='".$link_oserial."' class='btn btn-xs btn-link colorbox_iframe_cd' style='text-align:center'><i class='fa fa-link'></i> ".$row_RecordScaleorder_in["oserial"]."</a>";
	
	$dvalue['num'] = $row_RecordScaleorder_in["num"];
	
	$dvalue['Totalweight'] = $row_RecordScaleorder_in["Totalweight"];
	
	$dvalue['Minweight'] = $row_RecordScaleorder_in["Minweight"];
	
	$dvalue['Oriweight'] = $row_RecordScaleorder_in["Totalweight"] - $row_RecordScaleorder_in["Minweight"];
	
	$dvalue['warehouse'] = $row_RecordScaleorder_in["warehouse"];
	
	$dvalue['people'] = $row_RecordScaleorder_in["people"];
	
	if($row_RecordScaleorder_in["bound"] == 'in') { $dvalue['bound'] = "入庫"; }
	if($row_RecordScaleorder_in["bound"] == 'out') { $dvalue['bound'] = "出庫"; }
	
	$dvalue['author'] = $row_RecordScaleorder_in["author"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScaleorder_in["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScaleorder_in["id"]."' data-placement='top'>".$row_RecordScaleorder_in["sortid"]."</span>";
	
	if($row_RecordScaleorder_in["indicate"] == '1') {$row_RecordScaleorder_in["indicate"] = "公佈";}else{$row_RecordScaleorder_in["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScaleorder_in["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScaleorder_in["id"]."' data-placement='top'>".$row_RecordScaleorder_in["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordScaleorder_in['postdate']); 
	$dvalue['postdate'] = $dt->format('Y-m-d H:i A');
	
	$dvalue['action'] = "<div class='btn-group'>".$but_edit.$but_del.$but_more."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_scaleorder1.$but_scaleorder2."</div>";
	//$dvalue['content'] = $row_RecordScaleorder_in["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScaleorder_in = mysqli_fetch_assoc($RecordScaleorder_in)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScaleorder_in), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScaleorder_in);
?>
