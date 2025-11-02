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

if(isset($_POST['search_type1'])){
	$search_type1 = $_POST['search_type1'];
}else{
	$search_type1 = "-1";
}
if(isset($_POST['search_type2'])){
	$search_type2 = $_POST['search_type2'];
}else{
	$search_type2 = "-1";
}
if(isset($_POST['search_type3'])){
	$search_type3 = $_POST['search_type3'];
}else{
	$search_type3 = "-1";
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
        case 2;$orderSql = " ORDER BY name ".$order_dir;break;
		case 3;$orderSql = " ORDER BY plot ".$order_dir;break;
        case 4;$orderSql = " ORDER BY sortid ".$order_dir;break;
        case 5;$orderSql = " ORDER BY indicate ".$order_dir;break;
		case 6;$orderSql = " ORDER BY postdate ".$order_dir;break;
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

$maxRows_RecordProduct = $length;
$startRow_RecordProduct = $start;

$colsearch_RecordProduct = "%";
if (isset($DT_search)) {
  $colsearch_RecordProduct = $DT_search;
}

//$colnamelang_RecordProduct = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProduct = $_SESSION['lang'];
}

$colindicate_RecordProduct = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "上架") {$search_indicate = '1';}
  if($search_indicate == "下架") {$search_indicate = '0';}
  $colindicate_RecordProduct = $search_indicate;
}

$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}

$coltype1_RecordProduct = "%";
if (isset($search_type1) && $search_type1 != "" && $search_type1 != "-1") {
  $coltype1_RecordProduct = $search_type1;
}
$coltype2_RecordProduct = "%";
if (isset($search_type2) && $search_type2 != "" && $search_type2 != "-1") {
  $coltype2_RecordProduct = $search_type2;
}
$coltype3_RecordProduct = "%";
if (isset($search_type3) && $search_type3 != "" && $search_type3 != "-1") {
  $coltype3_RecordProduct = $search_type3;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_product WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordProduct, "int"),GetSQLValueString($colnamelang_RecordProduct, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordProduct, "text"), GetSQLValueString($colindicate_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"),GetSQLValueString($collang_RecordProduct, "text"));

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_product WHERE lang = %s && userid=%s",GetSQLValueString($collang_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);


$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE (name LIKE %s || pdseries LIKE %s) && indicate LIKE %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && lang = %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordProduct . "%", "text"), GetSQLValueString("%" . $colsearch_RecordProduct . "%", "text"), GetSQLValueString($colindicate_RecordProduct, "text"),GetSQLValueString($coltype1_RecordProduct, "text"),GetSQLValueString($coltype2_RecordProduct, "text"),GetSQLValueString($coltype3_RecordProduct, "text"),GetSQLValueString($collang_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));



if($draw == "" || $length == '-1') {
    //無分頁
	$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
	$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
	$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
	
}else{
	//分頁
	$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
	$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
	$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
	
	if (isset($_GET['totalRows_RecordProduct'])) {
	  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
	} else {
	  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
	  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
	}
	$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;
}


?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordProduct > '0') { ?>
<?php do { ?>
  <?php
    // 取得內頁圖片數量 
    $colname_RecordProductPhotoCount = "zh-tw";
	if (isset($_SESSION['lang'])) {
	  $colname_RecordProductPhotoCount = $_SESSION['lang'];
	}
	$colaid_RecordProductPhotoCount = "-1";
	if (isset($row_RecordProduct['id'])) {
	  $colaid_RecordProductPhotoCount = $row_RecordProduct['id'];
	}
	$coluserid_RecordProductPhotoCount = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordProductPhotoCount = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordProductPhotoCount = sprintf("SELECT * FROM demo_productphoto WHERE lang=%s && aid = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordProductPhotoCount, "text"),GetSQLValueString($colaid_RecordProductPhotoCount, "int"),GetSQLValueString($coluserid_RecordProductPhotoCount, "int"));
	$RecordProductPhotoCount = mysqli_query($DB_Conn, $query_RecordProductPhotoCount) or die(mysqli_error($DB_Conn));
	$row_RecordProductPhotoCount = mysqli_fetch_assoc($RecordProductPhotoCount);
	$totalRows_RecordProductPhotoCount = mysqli_num_rows($RecordProductPhotoCount);
  ?>
  <?php 
  
    if($row_RecordProduct['pic'] !=""){
    	$link_pic = $SiteImgUrlAdmin.$wshop.'/image/product/thumb/small_'.GetFileThumbExtend($row_RecordProduct['pic']);
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
	
    $link_add = "manage_product.php?wshop=".$wshop."&amp;Opt=addpage&amp;lang=".$_SESSION['lang'];
	$link_copy = "manage_product.php?wshop=".$wshop."&amp;Opt=copypage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProduct['id'];
	$link_edit = "manage_product.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProduct['id'];
	$link_start = "manage_product.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
    //$link_del = "#modal-alert";
	$link_mainphoto = "uplod_product.php?id_edit=".$row_RecordProduct['id']."&amp;lang=".$_SESSION['lang'];
	$link_mutiphoto = "inner_product.php?wshop=".$wshop."&amp;Opt=photoviewpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordProduct['id']."&amp;tn=".$row_RecordProduct['name'];
	$link_tab = "inner_product.php?wshop=".$wshop."&amp;Opt=edittabpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordProduct['id'];
	$link_format = "inner_product.php?wshop=".$wshop."&amp;Opt=formatpage&amp;lang=".$_SESSION['lang']."&amp;aid=".$row_RecordProduct['id']."&amp;tn=".$row_RecordProduct['name'];
	
	
	
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 新增</a>";
	$but_copy = "<a href='".$link_copy."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-copy'></i> 複增</a>";
	$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 修改</a>";
	$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordProduct["id"].",\"".$row_RecordProduct["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	
	$but_more = "<a href='#' class='btn btn-xs btn-default hidden-xs'>更多</a><a href='#' class='btn btn-xs btn-default dropdown-toggle' data-toggle='dropdown'></a><ul class='dropdown-menu pull-left'>";
	$but_more .= "<li><a href='".$link_mainphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 主要相片</a></li>";
	$but_more .= "<li><a href='".$link_mutiphoto."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 內頁相片(".$totalRows_RecordProductPhotoCount.")</a></li>";
	$but_more .= "<li><a href='".$link_tab."' class='colorbox_iframe_cd'><i class='fa fa-angle-right'></i> 細部資料</a></li>";
	
	$but_mainphoto = "<a href='".$link_mainphoto."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-image'></i> 主要相片</a>";
	$but_mutiphoto = "<a href='".$link_mutiphoto."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-images'></i> 內頁相片</a>";
	$but_tab = "<a href='".$link_tab."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='far fa-list-alt'></i> 細部資料</a>";
	$but_format = "<a href='".$link_format."' class='btn btn-xs btn-primary colorbox_iframe_cd' style='text-align:center'><i class='fa fa-list'></i> 規格設定</a>";
	
	
	
	if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { $but_more .= "<li><a href='#'>特殊規格</a></li>"; }
	$but_more .= "</ul>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordProduct["id"];
	
	$dvalue['pic'] = "<div class='imgLiquidFill' style='width:120px; height:120px;'><img src=".$link_pic." class='img-fluid'></div>";
	
  	$dvalue['chk'] = "<input name='delProduct[]' type='checkbox' id='delProduct[]' value='".$row_RecordProduct["id"]."\'/>";
	
	$dvalue['name'] = "<span id='name_".$row_RecordProduct["id"]."' class='ed_name' data-type='text' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$row_RecordProduct["name"]."</span>";
	
	if($row_RecordProduct["model"] != ""){
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>規格</span> <span id=model_".$row_RecordProduct["id"]."' class='ed_model text-lime-darker' data-type='text' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$row_RecordProduct["model"]."</span></div>";
	}else{
		$dvalue['name'] .= "<div class='m-t-5'><span class='label label-lime'>規格</span> <span id=model_".$row_RecordProduct["id"]."' class='ed_model editable-click editable-empty' data-type='text' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['homeshow'] = "<span id='homeshow_".$row_RecordProduct["id"]."' class='ed_homeshow' data-type='select' data-pk='".$row_RecordProduct["id"]."'>".$row_RecordProduct["homeshow"]."</span>";
	
	
  switch($row_RecordProduct['plot'])
	  {
		  case "1":
			  $row_RecordProduct['plot'] = "Hot";			
			  break;
		  case "2":
			  $row_RecordProduct['plot']="Act";			
			  break;
		  case "3":
			  $row_RecordProduct['plot']="Sale";			
			  break;
		  case "4":
			  $row_RecordProduct['plot']="New";			
			  break;	
		  default:
			  $row_RecordProduct['plot']="None";
			  break;			
	  }

    
        $colid_RecordDiscountSelect = "-1";
        if (isset($row_RecordProduct["discountid"])) {
          $colid_RecordDiscountSelect = $row_RecordProduct["discountid"];
        }
        //mysqli_select_db($database_DB_Conn, $DB_Conn);
        $query_RecordDiscountSelect = sprintf("SELECT * FROM demo_productdiscount WHERE id=%s", GetSQLValueString($colid_RecordDiscountSelect, "int"));
        $RecordDiscountSelect = mysqli_query($DB_Conn, $query_RecordDiscountSelect) or die(mysqli_error($DB_Conn));
        $row_RecordDiscountSelect = mysqli_fetch_assoc($RecordDiscountSelect);
        $totalRows_RecordDiscountSelect = mysqli_num_rows($RecordDiscountSelect);
    
    
    $dvalue['discountid'] = $row_RecordDiscountSelect['name'];
    
    
    switch($row_RecordDiscountSelect['type'])
    {
        case "0":
            $row_RecordDiscountSelect['type'] = "指定商品 - 滿件折扣(%)";
            break;
        case "1":
            $row_RecordDiscountSelect['type'] = "指定商品 - 滿件減價(-)";
            break;
        case "2":
            $row_RecordDiscountSelect['type'] = "指定商品 - 滿額折扣(%)";
            break;
        case "3":
            $row_RecordDiscountSelect['type'] = "指定商品 - 滿額減價(-)";
            break;
        case "4":
            $row_RecordDiscountSelect['type'] = "指定商品 - 任選優惠";
            break;
        case "5":
            $row_RecordDiscountSelect['type'] = "全單滿額 - 滿額折扣(%)";
            break;
        case "6":
            $row_RecordDiscountSelect['type'] = "全單滿額 - 滿額減價(-)";
            break;
        case "7":
            $row_RecordDiscountSelect['type'] = "全單滿額 - 滿額贈禮";
            break;
        case "8":
            break;
        default:
            $row_RecordDiscountSelect['type'] = "無";
            break;
    } 	
    
    $dvalue['discounttype'] = $row_RecordDiscountSelect['type'];
                            
	$dvalue['plot'] = "<span class='label label-danger'><span id='plot_".$row_RecordProduct["id"]."' class='ed_plot' data-type='select' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$row_RecordProduct["plot"]."</span></span>";
	
	if($row_RecordProduct["pdseries"] != ""){
		$dvalue['pdseries'] = "<span id='pdseries_".$row_RecordProduct["id"]."' class='ed_pdseries' data-type='text' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$row_RecordProduct["pdseries"]."</span>";
	} else {
		$dvalue['pdseries'] = "<span id=pdseries_".$row_RecordProduct["id"]."' class='ed_pdseries editable-click editable-empty' data-type='text' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".'Empty'."</span></div>";
	}
	
	$dvalue['sortid'] = "<span id='sortid_".$row_RecordProduct["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$row_RecordProduct["sortid"]."</span>";
	
	if($row_RecordProduct["indicate"] == '1') {$row_RecordProduct["indicate"] = "上架";}else{$row_RecordProduct["indicate"] = "下架";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordProduct["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$row_RecordProduct["indicate"]."</span>";
	
	$dt = new DateTime($row_RecordProduct['postdate']); 
	$dvalue['postdate'] = "<span id='postdate_".$row_RecordProduct["id"]."' class='ed_postdate' data-type='date' data-format='yyyy-mm-dd' data-pk='".$row_RecordProduct["id"]."' data-placement='top'>".$dt->format('Y-m-d')."</span>";

	
	//$dvalue['content'] = $row_RecordProduct["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
  ?>
<?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordProduct), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordProduct);
?>
