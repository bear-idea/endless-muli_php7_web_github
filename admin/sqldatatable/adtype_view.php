<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php //require_once('inc_setting.php'); ?>
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

if(isset($_POST['search_indicate'])){
	$search_indicate = $_POST['search_indicate'];
}else{
	$search_indicate = "";
}

//$search_type1 = $_POST['search_type1'];
//$search_type2 = $_POST['search_type2'];
//$search_type3 = $_POST['search_type3'];

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
        //case 1;$orderSql = " ORDER BY name ".$order_dir;break;
        //case 2;$orderSql = " ORDER BY sortid ".$order_dir;break;
        //case 3;$orderSql = " ORDER BY indicate ".$order_dir;break;
        default;$orderSql = '';
    }
}
if($orderSql == "") {
	$orderSql = $orderSql . "ORDER BY act_id DESC";
}else{
	$orderSql = $orderSql . ",act_id DESC";
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

$maxRows_RecordAdtype = $length;
$startRow_RecordAdtype = $start;

$colsearch_RecordAdtype = "%";
if (isset($DT_search)) {
  $colsearch_RecordAdtype = $DT_search;
}

//$colnamelang_RecordAdtype = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAdtype = $_SESSION['lang'];
}

$colindicate_RecordAdtype = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordAdtype = $search_indicate;
}

$coluserid_RecordAdtype = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAdtype = $w_userid;
}

$coltype1_RecordAdtype = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordAdtype = $search_type1;
}
$coltype2_RecordAdtype = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordAdtype = $search_type2;
}
$coltype3_RecordAdtype = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordAdtype = $search_type3;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_adtype WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordAdtype, "int"),GetSQLValueString($colnamelang_RecordAdtype, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordAdtype = sprintf("SELECT * FROM demo_adtype WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordAdtype, "text"), GetSQLValueString($colindicate_RecordAdtype, "text"),GetSQLValueString($coluserid_RecordAdtype, "int"),GetSQLValueString($collang_RecordAdtype, "text"));

$query_RecordCount = sprintf("SELECT count(act_id) as sum FROM demo_adtype WHERE lang = %s && userid=%s && type='banner'",GetSQLValueString($collang_RecordAdtype, "text"),GetSQLValueString($coluserid_RecordAdtype, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordAdtype = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype.bwight, demo_adtype.bhight, demo_adtype.swight, demo_adtype.shight, demo_adtype.velocity, demo_adtype.numbers, demo_adtype.navigation, demo_adtype.thumbs, demo_adtype.label, demo_adtype.interval, demo_adtype.hideTools, demo_adtype.dots, demo_adtype.sdescription, demo_adtype.indicate, demo_adtype.author, demo_adtype.postdate, demo_adtype.style, demo_adtype.modstyle, demo_adtype.navigationstate, demo_adtype.tool, demo_adtype.theme, demo_adtype_sub.pic, demo_adtype.sortid, demo_adtype_sub.actphoto_id, demo_adtype.lang, count(demo_adtype_sub.act_id) AS photonum FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id GROUP BY demo_adtype.act_id HAVING (demo_adtype.lang = %s) && demo_adtype.userid=%s && demo_adtype.type='banner' ORDER BY demo_adtype.act_id DESC", GetSQLValueString($collang_RecordAdtype, "text"),GetSQLValueString($coluserid_RecordAdtype, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordAdtype = mysqli_query($DB_Conn, $query_RecordAdtype) or die(mysqli_error($DB_Conn));
	$row_RecordAdtype = mysqli_fetch_assoc($RecordAdtype);
	$totalRows_RecordAdtype = mysqli_num_rows($RecordAdtype);
	
}else{
	//分頁
	$query_limit_RecordAdtype = sprintf("%s LIMIT %d, %d", $query_RecordAdtype, $startRow_RecordAdtype, $maxRows_RecordAdtype);
	$RecordAdtype = mysqli_query($DB_Conn, $query_limit_RecordAdtype) or die(mysqli_error($DB_Conn));
	$row_RecordAdtype = mysqli_fetch_assoc($RecordAdtype);
	
	if (isset($_GET['totalRows_RecordAdtype'])) {
	  $totalRows_RecordAdtype = $_GET['totalRows_RecordAdtype'];
	} else {
	  $all_RecordAdtype = mysqli_query($DB_Conn, $query_RecordAdtype);
	  $totalRows_RecordAdtype = mysqli_num_rows($all_RecordAdtype);
	}
	$totalPages_RecordAdtype = ceil($totalRows_RecordAdtype/$maxRows_RecordAdtype)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordAdtype > '0') { ?>
<?php do { ?>
  <?php
    // 取得內頁圖片數量 
    /*$colname_RecordAdtypePhotoCount = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $colname_RecordAdtypePhotoCount = $_SESSION['lang'];
	}
	$colaid_RecordAdtypePhotoCount = "-1";
	if (isset($row_RecordAdtype['act_id'])) {
	  $colaid_RecordAdtypePhotoCount = $row_RecordAdtype['act_id'];
	}
	$coluserid_RecordAdtypePhotoCount = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordAdtypePhotoCount = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordAdtypePhotoCount = sprintf("SELECT * FROM demo_adtypephoto WHERE lang=%s && aid = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAdtypePhotoCount, "text"),GetSQLValueString($colaid_RecordAdtypePhotoCount, "int"),GetSQLValueString($coluserid_RecordAdtypePhotoCount, "int"));
	$RecordAdtypePhotoCount = mysqli_query($DB_Conn, $query_RecordAdtypePhotoCount) or die(mysqli_error($DB_Conn));
	$row_RecordAdtypePhotoCount = mysqli_fetch_assoc($RecordAdtypePhotoCount);
	$totalRows_RecordAdtypePhotoCount = mysqli_num_rows($RecordAdtypePhotoCount);*/
  ?>
  <?php 
  
    $link_add = "manage_ads.php?wshop=".$wshop."&amp;Opt=photoaddpage&amp;lang=".$_SESSION['lang']."&amp;act_id=".$row_RecordAdtype['act_id'];
	
	$link_style = "manage_ads.php?wshop=".$wshop."&amp;Opt=ads_select&amp;lang=".$_SESSION['lang']."&amp;act_id=".$row_RecordAdtype['act_id'];
	
	$link_set = "manage_ads.php?wshop=".$wshop."&amp;Opt=ads_set&amp;lang=".$_SESSION['lang']."&amp;act_id=".$row_RecordAdtype['act_id'];
	
	$link_mutiphoto = "manage_ads.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;act_id=".$row_RecordAdtype['act_id'];
	//$link_copy = "manage_adtype.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAdtype['act_id'];
	//$link_edit = "manage_adtype.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAdtype['act_id'];
	//$link_start = "manage_adtype.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	//$link_mainphoto = "uplod_adtype.php?id_edit=".$row_RecordAdtype['act_id']."&amp;lang=".$_SESSION['lang'];
	//$link_mutiphoto = "inner_adtype.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordAdtype['act_id']."&amp;tn=".$row_RecordAdtype['name'];
	//$link_tab = "inner_adtype.php?wshop=".$wshop."&amp;Opt=edittabpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordAdtype['act_id'];
	
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	
	$but_style = "<a href='".$link_style."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-star'></i> 樣式切換</a>";
	
	$but_set = "<a href='".$link_set."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-cog'></i> 參數設定</a>";
	
	$but_mutiphoto = "<a href='".$link_mutiphoto."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-image'></i> 圖片一覽</a>";
	//$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	//$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	//$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordAdtype["act_id"].",\"".$row_RecordAdtype["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
	//$but_more = "<a href='#' class='btn btn-xs btn-default hidden-xs'>更多</a><a href='#' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'></a><ul class='dropdown-menu pull-left'>";
	//$but_more .= "<li><a href='".$link_mainphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 主要相片</a></li>";
	//$but_more .= "<li><a href='".$link_mutiphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 內頁相片(".$totalRows_RecordAdtypePhotoCount.")</a></li>";
	//$but_more .= "<li><a href='".$link_tab."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 細部資料</a></li>";
	//if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { $but_more .= "<li><a href='#'>特殊規格</a></li>"; }
	//$but_more .= "</ul>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordAdtype["act_id"];
	
	$dvalue['pic'] = "";
	
	if($row_RecordAdtype['modstyle'] == '0') {
		if ($row_RecordAdtype['label'] == 'true') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_label.png' /></div>";}
		if ($row_RecordAdtype['tool'] == '1') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_num.png' /></div>";}
		if ($row_RecordAdtype['tool'] == '2') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_dot.png' /></div>";}
		if ($row_RecordAdtype['tool'] == '3') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_dotswithpreview.png' /></div>";}
		if ($row_RecordAdtype['theme'] == '') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow1.png' /></div>";}
		if ($row_RecordAdtype['theme'] == 'clean') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow2.png' /></div>";}
		if ($row_RecordAdtype['theme'] == 'minimalist') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow3.png' /></div>";}
		if ($row_RecordAdtype['theme'] == 'round') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow4.png' /></div>";}
		if ($row_RecordAdtype['theme'] == 'square') {$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow5.png' /></div>";}
		$dvalue['pic'] .= "<img src='images/bmod_bk_green.png' />";
	} else if($row_RecordAdtype['modstyle'] == '1') {
		if ($row_RecordAds['theme'] == "" && $row_RecordAds['tool'] == "0") {
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow6.png' /></div>";
		} else if ($row_RecordAds['theme'] == "1" && $row_RecordAds['tool'] == "0"){
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow7.png' /></div>";
		} else if ($row_RecordAds['theme'] == "2" && $row_RecordAds['tool'] == "0"){
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow8.png' /></div>";
		} else if ($row_RecordAds['theme'] == "3" && $row_RecordAds['tool'] == "0"){
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow9.png' /></div>"; 
	    } else if ($row_RecordAds['theme'] == "4" && $row_RecordAds['tool'] == "0"){ 
		    $dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow10.png' /></div>";
		} else { 
		    $dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_arrow6.png' /></div>";
		}
		if ($row_RecordAds['tool'] == "0") {
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_thumb_default.png' /></div>";
		} else if ($row_RecordAds['tool'] == "1"){ 
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_thumb_small.png' /></div>";
		} else if ($row_RecordAds['tool'] == "2"){
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_thumb_large.png' /></div>";
		} else {  
			$dvalue['pic'] .= "<div style='position: absolute;'><img src='images/bmod_thumb_default.png' /></div>";
		}
		$dvalue['pic'] .= "<img src='images/bmod_bk_red.png' />";
	} else {
		$dvalue['pic'] .= "<img src='images/bmod_bk_animation.png' />";
	}
	//$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
  	$dvalue['chk'] = "<input name='delAdtype[]' type='checkbox' id='delAdtype[]' value='".$row_RecordAdtype["act_id"]."\'/>";
	
	$dvalue['title'] = "<span id='title_".$row_RecordAdtype["act_id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordAdtype["act_id"]."' data-placement='top'>".$row_RecordAdtype["title"]."</span>";
	
	if($row_RecordAdtype["sdescription"] != ""){
		$dvalue['title'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordAdtype["act_id"]."' class='ed_sdescription text-lime-darker' data-type='textarea' data-pk='".$row_RecordAdtype["act_id"]."' data-placement='top'>".$row_RecordAdtype["sdescription"]."</span></div>";
	}else{
		$dvalue['title'] .= "<div><span class='label label-lime'>描述</span> <span id='sdescription_".$row_RecordAdtype["act_id"]."' class='ed_sdescription editable-click editable-empty' data-type='textarea' data-pk='".$row_RecordAdtype["act_id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['bwight'] = "<span id='bwight_".$row_RecordAdtype["act_id"]."' class='bwight' data-type='text' data-pk='".$row_RecordAdtype["act_id"]."' data-placement='top'>".$row_RecordAdtype["bwight"]."</span>";
	
	$dvalue['swight'] = "<span id='swight_".$row_RecordAdtype["act_id"]."' class='swight' data-type='text' data-pk='".$row_RecordAdtype["act_id"]."' data-placement='top'>".$row_RecordAdtype["swight"]."</span>";
	
	$dvalue['photonum'] = $row_RecordAdtype["photonum"];
	
	
	$dvalue['action'] = "<div class='btn-group'>".$but_add.$but_style.$but_set.$but_mutiphoto."</div>";
	//$dvalue['content'] = $row_RecordAdtype["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordAdtype = mysqli_fetch_assoc($RecordAdtype)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordAdtype), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordAdtype);
?>
