<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
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

if(isset($_POST['search_usetime'])){
	$search_usetime = $_POST['search_usetime'];
}else{
	$search_usetime = "";
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
        //case 0;$orderSql = " ORDER BY demo_admin.id ".$order_dir;break;
        case 1;$orderSql = " ORDER BY demo_admin.name ".$order_dir;break;
        case 2;$orderSql = " ORDER BY demo_admin.webname ".$order_dir;break;
        case 3;$orderSql = " ORDER BY demo_admin.account ".$order_dir;break;
		//case 4;$orderSql = " ORDER BY indicate ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY postdate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY demo_admin.id DESC";
}else{
	$orderSql = $orderSql . ",demo_admin.id DESC";
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

$maxRows_RecordWebuser = $length;
$startRow_RecordWebuser = $start;

$colsearch_RecordWebuser = "%";
if (isset($DT_search)) {
  $colsearch_RecordWebuser = $DT_search;
}

//$colnamelang_RecordWebuser = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWebuser = $_SESSION['lang'];
}

$colindicate_RecordWebuser = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordWebuser = $search_indicate;
}

$coltype_RecordWebuser = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordWebuser = $search_type;
}

$coluserid_RecordWebuser = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWebuser = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_webuser WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordWebuser, "int"),GetSQLValueString($colnamelang_RecordWebuser, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordWebuser = sprintf("SELECT * FROM demo_webuser WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordWebuser, "text"), GetSQLValueString($colindicate_RecordWebuser, "text"),GetSQLValueString($coluserid_RecordWebuser, "int"),GetSQLValueString($collang_RecordWebuser, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_admin WHERE grouptype='main'");
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


//$query_RecordWebuser = sprintf("SELECT * FROM demo_admin WHERE (name LIKE %s || webname LIKE %s) && grouptype='main' $orderSql", GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"), GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"));

if($search_usetime == "used") {
	$query_RecordWebuser = sprintf("SELECT demo_admin.id, demo_admin.account, demo_admin.psw, demo_admin.name, demo_admin.webname, demo_admin.level, demo_admin.hot, demo_admin.plushot, demo_admin.webrenewdate, demo_admin.usetime, demo_setting_fr.SiteDecsHome, demo_setting_fr.userid, demo_setting_fr.SiteFBShowImage, demo_setting_fr.SiteIndicate FROM demo_admin LEFT OUTER JOIN demo_setting_fr ON demo_admin.id = demo_setting_fr.userid WHERE (demo_admin.name LIKE %s || demo_admin.webname LIKE %s) && demo_setting_fr.SiteIndicate=1 && (DATEDIFF(demo_admin.webrenewdate,NOW())+365*demo_admin.usetime >= 0 || demo_admin.usetime = 0) && demo_admin.grouptype='main' $orderSql", GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"), GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"));
}else if ($search_usetime == "noused"){
	$query_RecordWebuser = sprintf("SELECT demo_admin.id, demo_admin.account, demo_admin.psw, demo_admin.name, demo_admin.webname, demo_admin.level, demo_admin.hot, demo_admin.plushot, demo_admin.webrenewdate, demo_admin.usetime, demo_setting_fr.SiteDecsHome, demo_setting_fr.userid, demo_setting_fr.SiteFBShowImage, demo_setting_fr.SiteIndicate FROM demo_admin LEFT OUTER JOIN demo_setting_fr ON demo_admin.id = demo_setting_fr.userid WHERE (demo_admin.name LIKE %s || demo_admin.webname LIKE %s) && demo_setting_fr.SiteIndicate=1 && (DATEDIFF(demo_admin.webrenewdate,NOW())+365*demo_admin.usetime < 0) && demo_admin.grouptype='main' $orderSql", GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"), GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"));
}else{
	$query_RecordWebuser = sprintf("SELECT demo_admin.id, demo_admin.account, demo_admin.psw, demo_admin.name, demo_admin.webname, demo_admin.level, demo_admin.hot, demo_admin.plushot, demo_admin.webrenewdate, demo_admin.usetime, demo_setting_fr.SiteDecsHome, demo_setting_fr.userid, demo_setting_fr.SiteFBShowImage, demo_setting_fr.SiteIndicate FROM demo_admin LEFT OUTER JOIN demo_setting_fr ON demo_admin.id = demo_setting_fr.userid WHERE (demo_admin.name LIKE %s || demo_admin.webname LIKE %s) && demo_setting_fr.SiteIndicate=1 && demo_admin.grouptype='main' $orderSql", GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"), GetSQLValueString("%" . $colsearch_RecordWebuser . "%", "text"));
}



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordWebuser = mysqli_query($DB_Conn, $query_RecordWebuser) or die(mysqli_error($DB_Conn));
	$row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
	$totalRows_RecordWebuser = mysqli_num_rows($RecordWebuser);
	
}else{
	//分頁
	$query_limit_RecordWebuser = sprintf("%s LIMIT %d, %d", $query_RecordWebuser, $startRow_RecordWebuser, $maxRows_RecordWebuser);
	$RecordWebuser = mysqli_query($DB_Conn, $query_limit_RecordWebuser) or die(mysqli_error($DB_Conn));
	$row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
	
	if (isset($_GET['totalRows_RecordWebuser'])) {
	  $totalRows_RecordWebuser = $_GET['totalRows_RecordWebuser'];
	} else {
	  $all_RecordWebuser = mysqli_query($DB_Conn, $query_RecordWebuser);
	  $totalRows_RecordWebuser = mysqli_num_rows($all_RecordWebuser);
	}
	$totalPages_RecordWebuser = ceil($totalRows_RecordWebuser/$maxRows_RecordWebuser)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordWebuser > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_add = "manage_webuser.php?wshop=".$wshop."&amp;Opt=modselectpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_webuser.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordWebuser['id'];
	$link_edit = "manage_webuser.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordWebuser['id'];
	$link_state = "manage_webuser.php?wshop=".$wshop."&amp;Opt=statepage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordWebuser['id'];
	$link_mod = "manage_webuser.php?wshop=".$wshop."&amp;Opt=editbackpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordWebuser['id'];
    //$link_del = "#modal-alert";
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordWebuser["id"].",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	$but_state = "<a href='".$link_state."' class='btn btn-xs btn-warning' style=text-align:center'><i class='far fa-calendar-alt'></i> 網站狀態以及租賃時間</a>";
	$but_mod = "<a href='".$link_mod."' class='btn btn-xs btn-warning' style=text-align:center'><i class='fab fa-codepen'></i> 模組啟用以及相關設定</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordWebuser["id"];
	
  	//$dvalue['chk'] = "<input name='delWebuser[]' type='checkbox' id='delWebuser[]' value='".$row_RecordWebuser["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordWebuser["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordWebuser["id"]."' data-placement='top'>".$row_RecordWebuser["name"]."</span>";
	
	if(isset($row_RecordWebuser["truename"])){
			$dvalue['name'] .= "<div class='m-t-0'><span class='label label-lime'>聯絡人</span> <span id=truename_".$row_RecordWebuser["id"]."' class='ed_truename text-lime-darker' data-type='text' data-pk='".$row_RecordWebuser["id"]."' data-placement='top'>".$row_RecordWebuser["truename"]."</span></div>";
		}else{
			$dvalue['name'] .= "<div class='m-t-0'><span class='label label-lime'>聯絡人</span> <span id='truename_".$row_RecordWebuser["id"]."' class='ed_truename editable-click editable-empty' data-type='text' data-pk='".$row_RecordWebuser["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	if(isset($row_RecordWebuser["phone"])){
			$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>電話</span> <span id=phone_".$row_RecordWebuser["id"]."' class='ed_phone text-lime-darker' data-type='text' data-pk='".$row_RecordWebuser["id"]."' data-placement='top'>".$row_RecordWebuser["phone"]."</span></div>";
		}else{
			$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>電話</span> <span id='phone_".$row_RecordWebuser["id"]."' class='ed_phone editable-click editable-empty' data-type='text' data-pk='".$row_RecordWebuser["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['webname'] = $row_RecordWebuser["webname"];
	
	$dvalue['account'] = $row_RecordWebuser["account"] . "<br>" . $row_RecordWebuser["psw"];

	//$dvalue['sortid'] = "<span id='sortid_".$row_RecordWebuser["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordWebuser["id"]."' data-placement='top'>".$row_RecordWebuser["sortid"]."</span>";
	
	
	if ($row_RecordWebuser['usetime'] != 0) {
		if ($row_RecordWebuser['webrenewdate'] != '' && $row_RecordWebuser['usetime'] != '') { 
			  $t_end = count_date($row_RecordWebuser['webrenewdate'],$row_RecordWebuser['usetime']);
			  $t_now = date("Y-m-d");
			  $t_dt = margin($t_now, $t_end);
			  
				if($t_dt <= 0){ 	
					$t_dt = 0;
					$dvalue['usetime'] = $t_dt."天" . " <span class='label label-danger'>已到期</span>";
				} else if ($t_dt <= 90){
					$dvalue['usetime'] = $t_dt."天" . " <span class='label label-pink'>小於三個月</span>";
				} else if ($t_dt <= 30){
					$dvalue['usetime'] = $t_dt."天" . " <span class='label label-warning'>小於一個月</span>";
				} else {
					$dvalue['usetime'] = $t_dt."天";
				}
		}
	}else{
		$dvalue['usetime'] = "∞天" . " <span class='label label-indigo'>無限</span>";
	}
                    
	//$dvalue['usetime'] = $t_dt;
	
	$dvalue['action'] = "<div><div class='btn-group'>".$but_add.$but_edit.$but_del."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_state."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_mod."</div></div>";
	//$dvalue['content'] = $row_RecordWebuser["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordWebuser), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordWebuser);
?>
