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
$search_type = $_POST['search_type'];

//排序
$order_column = $_POST['order']['0']['column'];//那一列排序，从0开始
$order_dir = $_POST['order']['0']['dir'];//ase desc 升序或者降序

//拼接排序sql
$orderSql = "";
if(isset($order_column)){
    $i = intval($order_column);
    switch($i){
        //case 0;$orderSql = " ORDER BY id ".$order_dir;break;
        case 1;$orderSql = " ORDER BY name ".$order_dir;break;
        case 2;$orderSql = " ORDER BY swiftcode ".$order_dir;break;
        case 3;$orderSql = " ORDER BY bankaccount ".$order_dir;break;
		case 4;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 5;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY id DESC";
}else{
	$orderSql = $orderSql . ",id DESC";
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

$maxRows_RecordBank = $length;
$startRow_RecordBank = $start;

$colsearch_RecordBank = "%";
if (isset($DT_search)) {
  $colsearch_RecordBank = $DT_search;
}

//$colnamelang_RecordBank = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordBank = $_SESSION['lang'];
}

$colindicate_RecordBank = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordBank = $search_indicate;
}

$coluserid_RecordBank = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBank = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM invoicing_bank WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordBank, "int"),GetSQLValueString($colnamelang_RecordBank, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordBank = sprintf("SELECT * FROM invoicing_bank WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordBank, "text"), GetSQLValueString($colindicate_RecordBank, "text"),GetSQLValueString($coluserid_RecordBank, "int"),GetSQLValueString($collang_RecordBank, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM invoicing_bank WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordBank, "text"),GetSQLValueString($coluserid_RecordBank, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordBank = sprintf("SELECT * FROM invoicing_bank WHERE name LIKE %s && indicate LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordBank . "%", "text"), GetSQLValueString($colindicate_RecordBank, "text"),GetSQLValueString($collang_RecordBank, "text"),GetSQLValueString($coluserid_RecordBank, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordBank = mysqli_query($DB_Conn, $query_RecordBank) or die(mysqli_error($DB_Conn));
	$row_RecordBank = mysqli_fetch_assoc($RecordBank);
	$totalRows_RecordBank = mysqli_num_rows($RecordBank);
	
}else{
	//分頁
	$query_limit_RecordBank = sprintf("%s LIMIT %d, %d", $query_RecordBank, $startRow_RecordBank, $maxRows_RecordBank);
	$RecordBank = mysqli_query($DB_Conn, $query_limit_RecordBank) or die(mysqli_error($DB_Conn));
	$row_RecordBank = mysqli_fetch_assoc($RecordBank);
	
	if (isset($_GET['totalRows_RecordBank'])) {
	  $totalRows_RecordBank = $_GET['totalRows_RecordBank'];
	} else {
	  $all_RecordBank = mysqli_query($DB_Conn, $query_RecordBank);
	  $totalRows_RecordBank = mysqli_num_rows($all_RecordBank);
	}
	$totalPages_RecordBank = ceil($totalRows_RecordBank/$maxRows_RecordBank)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordBank > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_bank.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_bank.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordBank['id'];
	$link_edit = "manage_bank.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordBank['id'];
	$link_start = "manage_bank.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".$link_del."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordBank["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordBank["id"];
	
  	//$dvalue['chk'] = "<input name='delBank[]' type='checkbox' id='delBank[]' value='".$row_RecordBank["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordBank["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordBank["id"]."' data-placement='top'>".$row_RecordBank["name"]."</span>";
	
	if($row_RecordBank["notes1"] != ""){
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordBank["id"]."' class='ed_notes1 text-lime-darker' data-type='text' data-pk='".$row_RecordBank["id"]."' data-placement='top'>".$row_RecordBank["notes1"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>備註</span> <span id=notes1_".$row_RecordBank["id"]."' class='ed_notes1 editable-click editable-empty' data-type='text' data-pk='".$row_RecordBank["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['swiftcode'] = $row_RecordBank["swiftcode"];
	
	$dvalue['bankaccount'] = $row_RecordBank["bankaccount"];

	$dvalue['sortid'] = "<span id='sortid_".$row_RecordBank["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordBank["id"]."' data-placement='top'>".$row_RecordBank["sortid"]."</span>";
	
	if($row_RecordBank["indicate"] == '1') {$row_RecordBank["indicate"] = "公佈";}else{$row_RecordBank["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordBank["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordBank["id"]."' data-placement='top'>".$row_RecordBank["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordBank['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordBank["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordBank["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_del."</div>";
	//$dvalue['content'] = $row_RecordBank["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordBank = mysqli_fetch_assoc($RecordBank)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordBank), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordBank);
?>
