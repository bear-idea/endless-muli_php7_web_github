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
$draw = $_POST['draw'];//这个值作者会直接返回给前台

//搜索
$DT_search = $_POST['search']['value'];//获取前台传过来的过滤条件

// 取得自定變數
//$tb_filter_title = $_POST['tb_filter_title'];
//$tb_filter_sortid = $_POST['tb_filter_sortid'];
//$tb_filter_indicate = $_POST['tb_filter_indicate'];

$search_people = $_POST['search_people'];
$search_author = $_POST['search_author'];
$search_postdate = $_POST['search_postdate'];

$search_postdate_spile = explode(" ",$search_postdate);
$search_startdate = $search_postdate_spile[0];
$search_enddate = $search_postdate_spile[2];

//排序
$order_column = $_POST['order']['0']['column'];//那一列排序，从0开始
$order_dir = $_POST['order']['0']['dir'];//ase desc 升序或者降序

//拼接排序sql
$orderSql = "";
if(isset($order_column)){
    $i = intval($order_column);
    switch($i){
        //case 0;$orderSql = " ORDER BY id ".$order_dir;break;
        case 1;$orderSql = " ORDER BY code ".$order_dir;break;
        case 2;$orderSql = " ORDER BY title ".$order_dir;break;
        case 3;$orderSql = " ORDER BY num ".$order_dir;break;
		case 4;$orderSql = " ORDER BY Totalweight ".$order_dir;break;
		case 5;$orderSql = " ORDER BY Minweight ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
		case 7;$orderSql = " ORDER BY warehouse ".$order_dir;break;
		case 8;$orderSql = " ORDER BY people ".$order_dir;break;
		case 9;$orderSql = " ORDER BY bound ".$order_dir;break;
		case 10;$orderSql = " ORDER BY author ".$order_dir;break;
		//case 11;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY postdate DESC";
}else{
	$orderSql = $orderSql . ",postdate DESC";
}

//分页
$start = $_POST['start'];//从多少开始
$length = $_POST['length'];//数据长度 共幾筆資料
$limitSql = '';
$limitFlag = isset($_POST['start']) && $length != -1 ;
if ($limitFlag ) {
    $limitSql = " LIMIT ".intval($start).", ".intval($length);
}

//条件过滤后记录数 必要
$recordsFiltered = 0;
//表的总记录数 必要
$recordsTotal = 0;

$maxRows_RecordScaleorder_source = $length;
$startRow_RecordScaleorder_source = $start;

$colsearch_RecordScaleorder_source = "%";
if (isset($DT_search)) {
  $colsearch_RecordScaleorder_source = $DT_search;
}

//$colnamelang_RecordScaleorder_source = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder_source = $_SESSION['lang'];
}

$colindicate_RecordScaleorder_source = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordScaleorder_source = $search_indicate;
}

$coltype_RecordScaleorder_source = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordScaleorder_source = $search_type;
}

$colpeople_RecordScaleorder_source = "%";
if (isset($search_people) && $search_people != "") {
  $colpeople_RecordScaleorder_source = $search_people;
}

$colauthor_RecordScaleorder_source = "%";
if (isset($search_author) && $search_author != "") {
  $colauthor_RecordScaleorder_source = $search_author;
}

$coluserid_RecordScaleorder_source = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder_source = $w_userid;
}

$colstartdate_RecordScaleorder_source = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder_source = $search_startdate;
}

$dt = new DateTime();
$interval = new DateInterval('P1D');
$dt->add($interval);
$colenddate_RecordScaleorder_source = $dt->format('Y-m-d');
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  $interval = new DateInterval('P1D');
  $dt->add($interval);
  $colenddate_RecordScaleorder_source = $dt->format('Y-m-d');
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM erp_scalesourceorder_source WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordScaleorder_source, "int"),GetSQLValueString($colnamelang_RecordScaleorder_source, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordScaleorder_source = sprintf("SELECT * FROM erp_scalesourceorder_source WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordScaleorder_source, "text"), GetSQLValueString($colindicate_RecordScaleorder_source, "text"),GetSQLValueString($coluserid_RecordScaleorder_source, "int"),GetSQLValueString($collang_RecordScaleorder_source, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM erp_scaleordersourcedetail WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordScaleorder_source, "text"),GetSQLValueString($coluserid_RecordScaleorder_source, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordScaleorder_source = sprintf("SELECT * FROM erp_scaleordersourcedetail WHERE (title LIKE binary %s || num = %s) && (author LIKE binary %s || author IS NULL) && (people LIKE binary %s || people IS NULL) && indicate LIKE %s && (type LIKE %s || type IS NULL) && lang = %s && userid=%s && bound ='in' && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordScaleorder_source . "%", "text"), GetSQLValueString( $colsearch_RecordScaleorder_source, "text"), GetSQLValueString("%" . $colauthor_RecordScaleorder_source . "%", "text"), GetSQLValueString("%" . $colpeople_RecordScaleorder_source . "%", "text"), GetSQLValueString($colindicate_RecordScaleorder_source, "text"), GetSQLValueString($coltype_RecordScaleorder_source, "text"),GetSQLValueString($collang_RecordScaleorder_source, "text"),GetSQLValueString($coluserid_RecordScaleorder_source, "int"),GetSQLValueString($colstartdate_RecordScaleorder_source, "date"),GetSQLValueString($colenddate_RecordScaleorder_source, "date"));

if($draw == "" || $length == '-1') {
    //無分頁
	$RecordScaleorder_source = mysqli_query($DB_Conn, $query_RecordScaleorder_source) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_source = mysqli_fetch_assoc($RecordScaleorder_source);
	$totalRows_RecordScaleorder_source = mysqli_num_rows($RecordScaleorder_source);
	
}else{
	//分頁
	$query_limit_RecordScaleorder_source = sprintf("%s LIMIT %d, %d", $query_RecordScaleorder_source, $startRow_RecordScaleorder_source, $maxRows_RecordScaleorder_source);
	$RecordScaleorder_source = mysqli_query($DB_Conn, $query_limit_RecordScaleorder_source) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder_source = mysqli_fetch_assoc($RecordScaleorder_source);
	
	if (isset($_GET['totalRows_RecordScaleorder_source'])) {
	  $totalRows_RecordScaleorder_source = $_GET['totalRows_RecordScaleorder_source'];
	} else {
	  $all_RecordScaleorder_source = mysqli_query($DB_Conn, $query_RecordScaleorder_source);
	  $totalRows_RecordScaleorder_source = mysqli_num_rows($all_RecordScaleorder_source);
	}
	$totalPages_RecordScaleorder_source = ceil($totalRows_RecordScaleorder_source/$maxRows_RecordScaleorder_source)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordScaleorder_source > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_scaleorder_source.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_scaleorder_source.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_source['id'];
	$link_edit = "manage_scaleorder_source.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordScaleorder_source['id'];
	$link_start = "manage_scaleorder_source.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".$link_del."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordScaleorder_source["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordScaleorder_source["id"];
	
  	$dvalue['chk'] = "<input name='delScaleorder_source[]' type='checkbox' id='delScaleorder_source[]' value='".$row_RecordScaleorder_source["id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordScaleorder_source["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["title"]."</span>";
	
	if($row_RecordScaleorder_source["notes1"] != ""){
		$dvalue['title'] .= "<div><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordScaleorder_source["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["notes1"]."</span></div>";
	}else{
		$dvalue['title'] .= "<div><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordScaleorder_source["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['type'] = "<span id='type_".$row_RecordScaleorder_source["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["type"]."</span>";
	
	
	
	// -- 取得物料 --
	$colname_RecordScale = "-1";
	if (isset($row_RecordScaleorder_source['code'])) {
	  $colname_RecordScale = $row_RecordScaleorder_source['code'];
	}
	$coluserid_RecordScale = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordScale = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScale = sprintf("SELECT * FROM erp_scalesource WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
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
	$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scalesourceitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordScaleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordScaleViewLine_l1, "int"));
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
	
	if($row_RecordScaleorder_source["num"] != ""){
		$dvalue['num'] = "<span id=num_".$row_RecordScaleorder_source["id"]."' class='ed_num text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["num"]."</span>";
	}else{
		$dvalue['num'] = "<span id=num_".$row_RecordScaleorder_source["id"]."' class='ed_num editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".'Empty'."</span>";
	}
	
	if($row_RecordScaleorder_source["carnumber"] != ""){
		$dvalue['num'] .= "<div><span class='label label-lime'>車號</span> <span id=carnumber_".$row_RecordScaleorder_source["id"]."' class='ed_carnumber text-lime-darker' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["carnumber"]."</span></div>";
	}else{
		$dvalue['num'] .= "<div><span class='label label-lime'>車號</span> <span id=carnumber_".$row_RecordScaleorder_source["id"]."' class='ed_carnumber editable-click editable-empty' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['Totalweight'] = $row_RecordScaleorder_source["Totalweight"];
	
	$dvalue['Minweight'] = $row_RecordScaleorder_source["Minweight"];
	
	$dvalue['Oriweight'] = $row_RecordScaleorder_source["Totalweight"] - $row_RecordScaleorder_source["Minweight"];
	
	$dvalue['warehouse'] = $row_RecordScaleorder_source["warehouse"];
	
	$dvalue['carnumber'] = "<span id='carnumber_".$row_RecordScaleorder_source["id"]."' class='ed_carnumber' data-type='select' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["carnumber"]."</span>";
	
	if($row_RecordScaleorder_source["bound"] == 'in') { $dvalue['bound'] = "入庫"; }
	if($row_RecordScaleorder_source["bound"] == 'out') { $dvalue['bound'] = "出庫"; }
	
	$dvalue['author'] = $row_RecordScaleorder_source["author"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordScaleorder_source["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["sortid"]."</span>";
	
	if($row_RecordScaleorder_source["indicate"] == '1') {$row_RecordScaleorder_source["indicate"] = "公佈";}else{$row_RecordScaleorder_source["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordScaleorder_source["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$row_RecordScaleorder_source["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordScaleorder_source['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordScaleorder_source["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordScaleorder_source["id"]."' data-placement='top'>".$dt->format('Y-m-d H:i A')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordScaleorder_source["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordScaleorder_source = mysqli_fetch_assoc($RecordScaleorder_source)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordScaleorder_source), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordScaleorder_source);
?>
