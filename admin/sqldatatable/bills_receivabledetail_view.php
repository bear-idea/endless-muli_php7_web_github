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

$search_indicate = $_POST['search_indicate'];
$search_clientelecode = $_POST['search_clientelecode'];
$search_company = $_POST['search_company'];
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
        case 1;$orderSql = " ORDER BY clientele ".$order_dir;break;
        case 2;$orderSql = " ORDER BY clientelecode ".$order_dir;break;
        case 3;$orderSql = " ORDER BY company ".$order_dir;break;
		case 4;$orderSql = " ORDER BY amountr ".$order_dir;break;
		case 5;$orderSql = " ORDER BY chequenumber ".$order_dir;break;
		//case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordBills_receivable = $length;
$startRow_RecordBills_receivable = $start;

$colsearch_RecordBills_receivable = "%";
if (isset($DT_search)) {
  $colsearch_RecordBills_receivable = $DT_search;
}

//$colnamelang_RecordBills_receivable = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordBills_receivable = $_SESSION['lang'];
}

$colindicate_RecordBills_receivable = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordBills_receivable = $search_indicate;
}

$colcompany_RecordBills_receivable = "%";
if (isset($search_company) && $search_company != "") {
  $colcompany_RecordBills_receivable = $search_company;
}

$colclientelecode_RecordBills_receivable = "%";
if (isset($search_clientelecode) && $search_clientelecode != "") {
  $colclientelecode_RecordBills_receivable = $search_clientelecode;
}

$coluserid_RecordBills_receivable = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBills_receivable = $w_userid;
}

$colstartdate_RecordBills_receivable = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordBills_receivable = $search_startdate;
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordBills_receivable = $dt->format('Y-m-d');
$colenddate_RecordBills_receivable .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordBills_receivable = $dt->format('Y-m-d');
  $colenddate_RecordBills_receivable .= " 23:59:59";
}

$colstate_RecordBills_receivable = 'AR';

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM invoicing_bills_receivable WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordBills_receivable, "int"),GetSQLValueString($colnamelang_RecordBills_receivable, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordBills_receivable = sprintf("SELECT * FROM invoicing_bills_receivable WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordBills_receivable, "text"), GetSQLValueString($colindicate_RecordBills_receivable, "text"),GetSQLValueString($coluserid_RecordBills_receivable, "int"),GetSQLValueString($collang_RecordBills_receivable, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM invoicing_bills_receivabledetail WHERE lang = %s && userid=%s && state=%s",GetSQLValueString($collang_RecordBills_receivable, "text"),GetSQLValueString($coluserid_RecordBills_receivable, "int"),GetSQLValueString($colstate_RecordBills_receivable, "text"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

$query_RecordBills_receivable = sprintf("SELECT * FROM invoicing_bills_receivabledetail WHERE IFNULL(notes1,1) LIKE %s && IFNULL(clientelecode,1) LIKE %s && IFNULL(company,1) LIKE %s && indicate LIKE %s && lang = %s && userid=%s && state=%s && postdate BETWEEN %s AND %s $orderSql", GetSQLValueString("%" . $colsearch_RecordBills_receivable . "%", "text"), GetSQLValueString($colclientelecode_RecordBills_receivable, "text"), GetSQLValueString($colcompany_RecordBills_receivable, "text"), GetSQLValueString($colindicate_RecordBills_receivable, "text"),GetSQLValueString($collang_RecordBills_receivable, "text"), GetSQLValueString($coluserid_RecordBills_receivable, "int"),GetSQLValueString($colstate_RecordBills_receivable, "text"),GetSQLValueString($colstartdate_RecordBills_receivable, "date"),GetSQLValueString($colenddate_RecordBills_receivable, "date"));


if($draw == "" || $length == '-1') {
    //無分頁
	$RecordBills_receivable = mysqli_query($DB_Conn, $query_RecordBills_receivable) or die(mysqli_error($DB_Conn));
	$row_RecordBills_receivable = mysqli_fetch_assoc($RecordBills_receivable);
	$totalRows_RecordBills_receivable = mysqli_num_rows($RecordBills_receivable);
	
}else{
	//分頁
	$query_limit_RecordBills_receivable = sprintf("%s LIMIT %d, %d", $query_RecordBills_receivable, $startRow_RecordBills_receivable, $maxRows_RecordBills_receivable);
	$RecordBills_receivable = mysqli_query($DB_Conn, $query_limit_RecordBills_receivable) or die(mysqli_error($DB_Conn));
	$row_RecordBills_receivable = mysqli_fetch_assoc($RecordBills_receivable);
	
	if (isset($_GET['totalRows_RecordBills_receivable'])) {
	  $totalRows_RecordBills_receivable = $_GET['totalRows_RecordBills_receivable'];
	} else {
	  $all_RecordBills_receivable = mysqli_query($DB_Conn, $query_RecordBills_receivable);
	  $totalRows_RecordBills_receivable = mysqli_num_rows($all_RecordBills_receivable);
	}
	$totalPages_RecordBills_receivable = ceil($totalRows_RecordBills_receivable/$maxRows_RecordBills_receivable)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordBills_receivable > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_bills_receivable.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_bills_receivable.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordBills_receivable['id'];
	$link_edit = "manage_bills_receivable.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordBills_receivable['id'];
	$link_start = "manage_bills_receivable.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".$link_del."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordBills_receivable["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordBills_receivable["id"];
	
  	//$dvalue['chk'] = "<input name='delbills_receivable[]' type='checkbox' id='delbills_receivable[]' value='".$row_RecordBills_receivable["id"]."\'/>";
	
	$dvalue['clientele'] = "<span id='clientele_".$row_RecordBills_receivable["id"]."' class='ed_clientele' data-type='text' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".$row_RecordBills_receivable["clientele"]."</span>";
	
	if($row_RecordBills_receivable["notes1"] != ""){
		$dvalue['clientele'] .= "<div class='m-t-5'><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordBills_receivable["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".$row_RecordBills_receivable["notes1"]."</span></div>";
	}else{
		$dvalue['clientele'] .= "<div class='m-t-5'><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordBills_receivable["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['clientele'] .= "<div class='m-t-5'><span class='label label-lime'>託收帳號</span> ".$row_RecordBills_receivable["collectionaccountid"]."</div>";
	
	$dvalue['clientele'] .= "<div class='m-t-5'><span class='label label-lime'>到期日</span> ".$row_RecordBills_receivable["expirydate"]."</div>";
	
	if($row_RecordBills_receivable["clientelecode"] == ''){
		
		$colname_RecordClientele = "-1";
		if (isset($row_RecordBills_receivable["clientele"])) {
		  $colname_RecordClientele = $row_RecordBills_receivable["clientele"];
		}
		
		$coluserid_RecordClientele = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordClientele = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordClientele = sprintf("SELECT * FROM invoicing_clientele WHERE userid=%s && name=%s",GetSQLValueString($coluserid_RecordClientele, "int"),GetSQLValueString($colname_RecordClientele, "text"));
		$RecordClientele = mysqli_query($DB_Conn, $query_RecordClientele) or die(mysqli_error($DB_Conn));
		$row_RecordClientele = mysqli_fetch_assoc($RecordClientele);
		$totalRows_RecordClientele = mysqli_num_rows($RecordClientele);
		
		//echo '<br>';
		
		if($totalRows_RecordClientele > 0) {
			echo $updateSQL = sprintf("UPDATE invoicing_bills_receivabledetail SET clientelecode=%s WHERE id=%s",
						   GetSQLValueString($row_RecordClientele['code'], "text"),
						   GetSQLValueString($row_RecordBills_receivable["id"], "int"));

			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		}
		
		
	}
	
	$dvalue['clientelecode'] = $row_RecordBills_receivable["clientelecode"];
	
	$dvalue['company'] = $row_RecordBills_receivable["company"];
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordBills_receivable["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".$row_RecordBills_receivable["sortid"]."</span>";
	
	$dvalue['amountr'] = "<span id='amountr_".$row_RecordBills_receivable["id"]."' class='ed_amountr' data-type='text' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".$row_RecordBills_receivable["amountr"]."</span>";
	
	$dvalue['chequenumber'] = $row_RecordBills_receivable["chequenumber"];
	
	if($row_RecordBills_receivable["indicate"] == '1') {$row_RecordBills_receivable["indicate"] = "公佈";}else{$row_RecordBills_receivable["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordBills_receivable["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".$row_RecordBills_receivable["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordBills_receivable['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordBills_receivable["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordBills_receivable["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del.$but_more."</div>";
	//$dvalue['content'] = $row_RecordBills_receivable["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordBills_receivable = mysqli_fetch_assoc($RecordBills_receivable)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordBills_receivable), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordBills_receivable);
?>
