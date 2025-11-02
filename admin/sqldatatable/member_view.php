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
//$tb_filter_auth = $_POST['tb_filter_auth'];

if(isset($_POST['search_auth'])){
	$search_auth = $_POST['search_auth'];
}else{
	$search_auth = "";
}
if(isset($_POST['search_type'])){
	$search_type = $_POST['search_type'];
}else{
	$search_type = "";
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
        case 2;$orderSql = " ORDER BY account ".$order_dir;break;
        case 3;$orderSql = " ORDER BY mail ".$order_dir;break;
		case 4;$orderSql = " ORDER BY sortid ".$order_dir;break;
		case 5;$orderSql = " ORDER BY auth ".$order_dir;break;
		case 6;$orderSql = " ORDER BY regdate ".$order_dir;break;
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

$maxRows_RecordMember = $length;
$startRow_RecordMember = $start;

$colsearch_RecordMember = "%";
if (isset($DT_search)) {
  $colsearch_RecordMember = $DT_search;
}

//$colnamelang_RecordMember = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordMember = $_SESSION['lang'];
}

$colauth_RecordMember = "%";
if (isset($search_auth) && $search_auth != "") {
  if($search_auth == "是") {$search_auth = '1';}
  if($search_auth == "否") {$search_auth = '0';}
  $colauth_RecordMember = $search_auth;
}

$coltype_RecordMember = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordMember = $search_type;
}

$coluserid_RecordMember = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMember = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_member WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordMember, "int"),GetSQLValueString($colnamelang_RecordMember, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordMember = sprintf("SELECT * FROM demo_member WHERE title LIKE %s && auth LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordMember, "text"), GetSQLValueString($colauth_RecordMember, "text"),GetSQLValueString($coluserid_RecordMember, "int"),GetSQLValueString($collang_RecordMember, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_member WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordMember, "text"),GetSQLValueString($coluserid_RecordMember, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordMember = sprintf("SELECT * FROM demo_member WHERE (name LIKE %s || mail LIKE %s || account LIKE %s) && auth LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordMember . "%", "text"), GetSQLValueString("%" . $colsearch_RecordMember . "%", "text"), GetSQLValueString("%" . $colsearch_RecordMember . "%", "text"), GetSQLValueString($colauth_RecordMember, "text"),GetSQLValueString($collang_RecordMember, "text"),GetSQLValueString($coluserid_RecordMember, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordMember = mysqli_query($DB_Conn, $query_RecordMember) or die(mysqli_error($DB_Conn));
	$row_RecordMember = mysqli_fetch_assoc($RecordMember);
	$totalRows_RecordMember = mysqli_num_rows($RecordMember);
	
}else{
	//分頁
	$query_limit_RecordMember = sprintf("%s LIMIT %d, %d", $query_RecordMember, $startRow_RecordMember, $maxRows_RecordMember);
	$RecordMember = mysqli_query($DB_Conn, $query_limit_RecordMember) or die(mysqli_error($DB_Conn));
	$row_RecordMember = mysqli_fetch_assoc($RecordMember);
	
	if (isset($_GET['totalRows_RecordMember'])) {
	  $totalRows_RecordMember = $_GET['totalRows_RecordMember'];
	} else {
	  $all_RecordMember = mysqli_query($DB_Conn, $query_RecordMember);
	  $totalRows_RecordMember = mysqli_num_rows($all_RecordMember);
	}
	$totalPages_RecordMember = ceil($totalRows_RecordMember/$maxRows_RecordMember)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordMember > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_member.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_member.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordMember['id'];
	$link_edit = "manage_member.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordMember['id'];
	$link_auth = "member_mail_auth_send.php?wshop=".$wshop."&amp;lang=".$_SESSION['lang']."&amp;id=".$row_RecordMember['id'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordMember["id"].",\"".""."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordMember["id"];
	
  	$dvalue['chk'] = "<input name='delMember[]' type='checkbox' id='delMember[]' value='".$row_RecordMember["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordMember["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordMember["id"]."' data-placement='top'>".$row_RecordMember["name"]."</span>";
	
	$dvalue['account'] = $row_RecordMember["account"];
	
	$dvalue['mail'] = "<span id='mail_".$row_RecordMember["id"]."' class='ed_mail' data-type='text' data-pk='".$row_RecordMember["id"]."' data-placement='top'>".$row_RecordMember["mail"]."</span>";
	
	 if($row_RecordMember['auth'] != 1){$dvalue['mail'] = $dvalue['mail']."<a href='".$link_auth."' class='btn btn-warning btn-xs pull-right colorbox_iframe' data-original-title='發送認證信,會員需登入信箱認證' data-toggle='tooltip' data-placement='top'><i class='fa fa-check-circle'></i> 發送認證信<a>";}else{}
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordMember["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordMember["id"]."' data-placement='top'>".$row_RecordMember["sortid"]."</span>";
	
	if($row_RecordMember["auth"] == '1') {$row_RecordMember["auth"] = "是";}else{$row_RecordMember["auth"] = "否";}
	$dvalue['auth'] = "<span id='auth_".$row_RecordMember["id"]."' class='ed_auth' data-type='select' data-pk='".$row_RecordMember["id"]."' data-placement='top'>".$row_RecordMember["auth"]."</span>";
	
	$dt = new DateTime($row_RecordMember['regdate']); 
	$dvalue['regdate'] = "<span id='regdate_".$row_RecordMember["id"]."' class='ed_regdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordMember["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	//$dvalue['content'] = $row_RecordMember["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordMember = mysqli_fetch_assoc($RecordMember)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordMember), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordMember);
?>
