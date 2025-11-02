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

if(isset($_POST['search_homeselect'])){
	$search_homeselect = $_POST['search_homeselect'];
}else{
	$search_homeselect = "";
}
if(isset($_POST['search_indicate'])){
	$search_indicate = $_POST['search_indicate'];
}else{
	$search_indicate = "";
}
if(isset($_POST['search_type'])){
	$search_type = $_POST['search_type'];
}else{
	$search_type = "";
}
if(isset($_POST['search_name'])){
	$search_name = $_POST['search_name'];
}else{
	$search_name = "";
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
        case 1;$orderSql = " ORDER BY title ".$order_dir;break;
        case 2;$orderSql = " ORDER BY name ".$order_dir;break;
        case 3;$orderSql = " ORDER BY type ".$order_dir;break;
		case 4;$orderSql = " ORDER BY homeselect ".$order_dir;break;
		//case 5;$orderSql = " ORDER BY webname ".$order_dir;break;
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

$maxRows_RecordTmp = $length;
$startRow_RecordTmp = $start;

$colsearch_RecordTmp = "%";
if (isset($DT_search)) {
  $colsearch_RecordTmp = $DT_search;
}

//$colnamelang_RecordTmp = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTmp = $_SESSION['lang'];
}

$colindicate_RecordTmp = "%";
if (isset($search_indicate) && $search_indicate != "") {
  if($search_indicate == "公佈") {$search_indicate = '1';}
  if($search_indicate == "隱藏") {$search_indicate = '0';}
  $colindicate_RecordTmp = $search_indicate;
}

$colname_RecordTmp = "%";
if (isset($search_name) && $search_name != "") {
  $colname_RecordTmp = $search_name;
}

$coltype_RecordTmp = "%";
if (isset($search_type) && $search_type != "") {
  $coltype_RecordTmp = $search_type;
}

$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}

//定义查询数据总记录数sql
//$sumSql = sprintf("SELECT count(id) as sum FROM demo_tmp WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordTmp, "int"),GetSQLValueString($colnamelang_RecordTmp, "text"));


//mysqli_select_db($database_DB_Conn, $DB_Conn);
//$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE title LIKE %s && indicate LIKE %s && userid=%s && lang=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($colsearch_RecordTmp, "text"), GetSQLValueString($colindicate_RecordTmp, "text"),GetSQLValueString($coluserid_RecordTmp, "int"),GetSQLValueString($collang_RecordTmp, "text"));

if ($SiteOldMode == '1' || $SiteOldMode == "") { /* 是否使用舊系統相容模式 */

$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmp WHERE userid=%s",GetSQLValueString($coluserid_RecordTmp, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE title LIKE %s && indicate LIKE %s && type LIKE %s && name LIKE %s && userid=%s $orderSql", GetSQLValueString("%" . $colsearch_RecordTmp . "%", "text"), GetSQLValueString($colindicate_RecordTmp, "text"), GetSQLValueString($coltype_RecordTmp, "text"), GetSQLValueString($colname_RecordTmp, "text"),GetSQLValueString($coluserid_RecordTmp, "int"));

}else{
	
$query_RecordCount = sprintf("SELECT count(id) as sum FROM demo_tmp WHERE userid=%s && name != 'board001' && name != 'board002' && name != 'board003' && name != 'board004' && name != 'board005' && name != 'board006' && name != 'board007' && name != 'board008'",GetSQLValueString($coluserid_RecordTmp, "int"));
$RecordCount = mysqli_query($DB_Conn, $query_RecordCount) or die(mysqli_error($DB_Conn));
$row_RecordCount = mysqli_fetch_assoc($RecordCount);

$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE title LIKE %s && indicate LIKE %s && type LIKE %s && name LIKE %s && userid=%s && name != 'board001' && name != 'board002' && name != 'board003' && name != 'board004' && name != 'board005' && name != 'board006' && name != 'board007' && name != 'board008' $orderSql", GetSQLValueString("%" . $colsearch_RecordTmp . "%", "text"), GetSQLValueString($colindicate_RecordTmp, "text"), GetSQLValueString($coltype_RecordTmp, "text"), GetSQLValueString($colname_RecordTmp, "text"),GetSQLValueString($coluserid_RecordTmp, "int"));

}

$coluserid_RecordTmpSelect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpSelect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpSelect = sprintf("SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpSelect, "int"));
$RecordTmpSelect = mysqli_query($DB_Conn, $query_RecordTmpSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpSelect = mysqli_fetch_assoc($RecordTmpSelect);
$totalRows_RecordTmpSelect = mysqli_num_rows($RecordTmpSelect);

$coluserid_RecordTmpSelectRwd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpSelectRwd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpSelectRwd = sprintf("SELECT MSTmpSelectRwd FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpSelect, "int"));
$RecordTmpSelectRwd = mysqli_query($DB_Conn, $query_RecordTmpSelectRwd) or die(mysqli_error($DB_Conn));
$row_RecordTmpSelectRwd = mysqli_fetch_assoc($RecordTmpSelectRwd);
$totalRows_RecordTmpSelectRwd = mysqli_num_rows($RecordTmpSelectRwd);

$query_RecordSystemConfigFr = "SELECT id, userid, lang, Mobile_Enable FROM demo_setting_fr WHERE userid = $w_userid";
$RecordSystemConfigFr = mysqli_query($DB_Conn, $query_RecordSystemConfigFr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigFr = mysqli_fetch_assoc($RecordSystemConfigFr);
$totalRows_RecordSystemConfigFr = mysqli_num_rows($RecordSystemConfigFr);

$coluserid_RecordSystemConfig = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfig = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = sprintf("SELECT id, OptionTmpHomeSelect FROM demo_setting WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfig, "int"));
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);


if($draw == "" || $length == '-1') {
    //無分頁
	$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
	$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
	$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);
	
}else{
	//分頁
	$query_limit_RecordTmp = sprintf("%s LIMIT %d, %d", $query_RecordTmp, $startRow_RecordTmp, $maxRows_RecordTmp);
	$RecordTmp = mysqli_query($DB_Conn, $query_limit_RecordTmp) or die(mysqli_error($DB_Conn));
	$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
	
	if (isset($_GET['totalRows_RecordTmp'])) {
	  $totalRows_RecordTmp = $_GET['totalRows_RecordTmp'];
	} else {
	  $all_RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp);
	  $totalRows_RecordTmp = mysqli_num_rows($all_RecordTmp);
	}
	$totalPages_RecordTmp = ceil($totalRows_RecordTmp/$maxRows_RecordTmp)-1;
}
?>
<?php 
$data = array();
$obj = new ArrayObject(array(), ArrayObject::STD_PROP_LIST); //建構子的地方，要先放入一個空陣列，轉換成 ArrayObject 型態
?>
<?php if ($totalRows_RecordTmp > '0') { ?>
<?php do { ?>
  <?php 
  
    $link_view = "../tmp_demo_". $row_RecordTmp['name'].".php?tmpid=".$row_RecordTmp['id'];
  
	if ($row_RecordTmp['pic'] != "") {
		if ($SiteBaseUrlOuter != '' && $row_RecordTmp['userid'] == '1') {
    		$link_pic = $SiteImgUrlOuter.$row_RecordTmp['webname'].'/image/tmp/'.GetFileThumbExtend($row_RecordTmp['pic']);
		}else{
			$link_pic = $SiteImgUrlAdmin.$row_RecordTmp['webname'].'/image/tmp/'.GetFileThumbExtend($row_RecordTmp['pic']);
		}
	}else{
		$link_pic = 'images/100x100_noimage.jpg';
	}
  
    $link_add = "manage_tmp.php?wshop=".$wshop."&amp;Opt=getpage&amp;lang=".$_SESSION['lang'];
	
	$link_edit = "manage_tmp.php?wshop=".$wshop."&amp;Opt=editpage&amp;lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmp['id'];
	
	$link_start = "manage_tmp.php?wshop=".$wshop."&amp;Opt=startpage&amp;lang=".$_SESSION['lang'];
	
	$link_select = "manage_tmp.php?wshop=".$wshop."&amp;Opt=selectpage&amp;lang=".$_SESSION['lang'];
	
	$link_mod = "manage_mobile.php?wshop=".$wshop."&amp;Opt=tmp_mobile_config&amp;lang=".$_SESSION['lang'];
	
	if ($row_RecordTmp['userid'] == $w_userid) { 
		$link_tmp = "tmp_config_".$row_RecordTmp['name'].".php?lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmp['id'];
	} 
	
	if ($row_RecordTmp['userid'] == $w_userid) { 
		$link_tmp_home = "tmp_config_home.php?lang=".$_SESSION['lang']."&amp;id_edit=".$row_RecordTmp['id'];
	} 
	
	
    //$link_del = "#modal-alert";
	
	$but_view = "<a href='".$link_view."' class='btn btn-xs btn-primary' style='text-align:center' target='_blank'><i class='fa fa-eye'></i> 檢視</a>";
	$but_add = "<a href='".$link_add."' class='btn btn-xs btn-primary' style='text-align:center'><i class='fa fa-plus'></i> 複增</a>";
	
	if ($row_RecordTmp['userid'] == $w_userid) {
		$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary' style=text-align:center'><i class='fa fa-edit'></i> 基本設定</a>";
	}else{
		$but_edit = "<a href='".$link_edit."' class='btn btn-xs btn-primary disabled' style=text-align:center'><i class='fa fa-edit'></i> 基本設定</a>";
	}
	
	if ($row_RecordTmp['userid'] == $w_userid) {
		$but_del = "<a href='".""."' class='btn btn-xs btn-danger' style='text-align:center' onclick='delete_datatables(".$row_RecordTmp["id"].",\"".$row_RecordTmp["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	}else{
		$but_del = "<a href='".""."' class='btn btn-xs btn-danger disabled' style='text-align:center' onclick='delete_datatables(".$row_RecordTmp["id"].",\"".$row_RecordTmp["pic"]."\",event);'><i class='far fa-trash-alt'></i> 刪除</a>";
	}
	
	if ($row_RecordTmp['userid'] == $w_userid) { 
		$but_tmp = "<a href='".$link_tmp."' class='btn btn-xs btn-primary colorbox_iframe_cd' style=text-align:center'><i class='fab fa-connectdevelop'></i> 版型設定</a>";
	}else{
		$but_tmp = "<a href='".$link_tmp."' class='btn btn-xs btn-primary disabled' style=text-align:center'><i class='fab fa-connectdevelop'></i> 版型設定</a>";
	}
	$but_tmp_home = "<a href='".$link_tmp_home."' class='btn btn-xs btn-primary colorbox_iframe_cd' style=text-align:center'><i class='fab fa-asymmetrik'></i> 首頁版型設定</a>";
	
  	//$nestedData = array();
	$dvalue['id'] = $row_RecordTmp["id"];
	
  	$dvalue['chk'] = "<input name='delTmp[]' type='checkbox' id='delTmp[]' value='".$row_RecordTmp["id"]."\'/>";
	
	$dvalue['pic'] = "<span class='label label-purple' data-original-title='版型編號' data-toggle='tooltip' data-placement='right'>#No.".$row_RecordTmp['id']."</span>"."<div class='img-thumbnail m-b-5 m-t-5'><div class='imgLiquidFill' style='width:100px;height:100px;'><img src=".$link_pic."></div></div>";
	  	   
	 if ($row_RecordTmp['userid'] == '1') { 
	 	$dvalue['title'] = "<span class='label label-danger' data-original-title='不可修改' data-toggle='tooltip' data-placement='top'>官方</span>";
	 } else { 
	    $dvalue['title'] = "<span class='label label-warning'>個人</span>";
	 }
	 
     if ($row_RecordTmp['name'] == "board009" || $row_RecordTmp['name'] == "board010") {
        $dvalue['title'] .= " <span class='label label-danger' data-original-title='可支援行動裝置瀏覽' data-toggle='tooltip' data-placement='top'>RWD</span>";
     }else{
		 $dvalue['title'] .= " <span class='label label-lime' data-original-title='舊系統顯示模式，但可向下相容於XP系統' data-toggle='tooltip' data-placement='top'>傳統</span>";
	 }
              
	if ($row_RecordTmp['userid'] == $w_userid) { 
		$dvalue['title'] .= " <span id='title_".$row_RecordTmp["id"]."' class='ed_title' data-type='text' data-pk='".$row_RecordTmp["id"]."' data-placement='top'>".$row_RecordTmp["title"]."</span>";
	}else{
		$dvalue['title'] .= $row_RecordTmp["title"];
	}
 
    if($row_RecordTmpSelect['MSTmpSelect'] == $row_RecordTmp['id'] && $row_RecordSystemConfigFr['Mobile_Enable'] == '1') {
	      $dvalue['title'] .= "<div class='m-b-10 f-s-10 m-t-10'><a  href='".$link_mod."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 雙版型</a> <a href='".$link_select."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 已選用　電腦 / 筆電</a></div>";
     } else if($row_RecordTmpSelect['MSTmpSelect'] == $row_RecordTmp['id'] && $row_RecordSystemConfigFr['Mobile_Enable'] == '0') {
		 $dvalue['title'] .= "<div class='m-b-10 f-s-10 m-t-10'><a  href='".$link_mod."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 單版型</a> <a href='".$link_select."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 已選用　電腦 / 筆電 / 平板 / 手機</a></div>";
     }else if($row_RecordTmpSelectRwd['MSTmpSelectRwd'] == $row_RecordTmp['id'] && $row_RecordSystemConfigFr['Mobile_Enable'] =='1') {
         $dvalue['title'] .= "<div class='m-b-10 f-s-10 m-t-10'><a  href='".$link_mod."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 雙版型</a> <a href='".$link_select."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 已選用　平板 / 手機</a></div>";
         } else if($row_RecordTmpSelectRwd['MSTmpSelectRwd'] == $row_RecordTmp['id'] && $row_RecordSystemConfigFr['Mobile_Enable'] =='2') {
          $dvalue['title'] .= "<div class='m-b-10 f-s-10 m-t-10'><a  href='".$link_mod."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 單版型</a> <a href='".$link_select."' class='btn btn-xs btn-warning'><i class='fa fa-check-circle'></i> 已選用　電腦 / 筆電 / 平板 / 手機</a></div>";
     }else{
		if($row_RecordSystemConfigFr['Mobile_Enable'] == '0' || $row_RecordSystemConfigFr['Mobile_Enable'] == '2'){ /* 單 */
			$dvalue['title'] .= "<div class='m-b-10 f-s-10 m-t-10'><a  href='#' class='btn btn-xs btn-secondary' onclick='change_datatables(".$row_RecordTmp["id"].",event);'><i class='fa fa-times'></i> 未選用</a></div>";
		}else if ($row_RecordSystemConfigFr['Mobile_Enable'] == '1'){ /* 雙 */
			$dvalue['title'] .= "<div class='m-b-10 f-s-10 m-t-10'><a  href='#' class='btn btn-xs btn-secondary' onclick='change_datatables_select(".$row_RecordTmp["id"].",event);'><i class='fa fa-times'></i> 未選用</a></div>";
		}
	 }
	
	switch($row_RecordTmp['name'])
			{
				case "board001":
					$dvalue['name'] = "<img src=\"images/sty01.jpg\" width=\"80\" height=\"80\" />";		
					break;
				case "board002":
				    $dvalue['name'] = "<img src=\"images/sty02.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "board003":
				    $dvalue['name'] = "<img src=\"images/sty03.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "board004":
				    $dvalue['name'] = "<img src=\"images/sty04.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "board005":
				    $dvalue['name'] = "<img src=\"images/sty05.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "board006":
				    $dvalue['name'] = "<img src=\"images/sty06.jpg\" width=\"80\" height=\"80\" />";	
					break;
				case "board007":
				    $dvalue['name'] = "<img src=\"images/sty07.jpg\" width=\"80\" height=\"80\" />";	
					break;
				case "board008":
				    $dvalue['name'] = "<img src=\"images/sty08.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "board009":
				    $dvalue['name'] = "<img src=\"images/sty09.jpg\" width=\"80\" height=\"80\" />";	
					break;
				case "board010":
				    $dvalue['name'] = "<img src=\"images/sty10.jpg\" width=\"80\" height=\"80\" />";
					break;
				default:	
					break;
			}
			
	switch($row_RecordTmp['homestyle'])
			{
				case "homeboard001":
					$dvalue['homestyle'] = "<img src=\"images/homesty01.jpg\" width=\"80\" height=\"80\" />";		
					break;
				case "homeboard002":
				case "homeboard005":
				    $dvalue['homestyle'] = "<img src=\"images/homesty09.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "homeboard003":
				    $dvalue['homestyle'] = "<img src=\"images/homesty03.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "homeboard004":
				    $dvalue['homestyle'] = "<img src=\"images/homesty05.jpg\" width=\"80\" height=\"80\" />";
					break;
				case "homeboard006":
				    $dvalue['homestyle'] = "<img src=\"images/homesty06.jpg\" width=\"80\" height=\"80\" />";	
					break;
				case "homeboard007":
				case "homeboard008":
				case "homeboard009":
				case "homeboard010":
				case "homeboard011":
				case "homeboard012":
				case "homeboard013":
				    $dvalue['homestyle'] = "<img src=\"images/homesty00.jpg\" width=\"80\" height=\"80\" />";	
					break;
				case "homeboard014":
				case "homeboard015":
				case "homeboard016":
				case "homeboard017":
				case "homeboard018":
				case "homeboard019":
				case "homeboard020":
				    $dvalue['homestyle'] = "<img src=\"images/homesty07.jpg\" width=\"80\" height=\"80\" />";	
					break;
				case "homeboard021":
				    $dvalue['homestyle'] = "<img src=\"images/homesty08.jpg\" width=\"80\" height=\"80\" />";	
					break;
				
				default:	
					break;
			}
	//$dvalue['name'] = $row_RecordTmp["name"];
	
	
	if ($row_RecordTmp['userid'] == $w_userid) { 
		$dvalue['type'] = "<span id='type_".$row_RecordTmp["id"]."' class='ed_type' data-type='select' data-pk='".$row_RecordTmp["id"]."' data-placement='top'>".$row_RecordTmp["type"]."</span>";
	}else{
		$dvalue['type'] = $row_RecordTmp["type"];
	}
	
	if ($row_RecordTmp['userid'] == $w_userid) { 
		$dvalue['sortid'] = "<span id='sortid_".$row_RecordTmp["id"]."' class='ed_sortid' data-type='text' data-pk='".$row_RecordTmp["id"]."' data-placement='top'>".$row_RecordTmp["sortid"]."</span>";
	}else{
		$dvalue['sortid'] = $row_RecordTmp["sortid"];
	}
	
	if ($row_RecordSystemConfig['OptionTmpHomeSelect'] == '1') { 
	 	if($row_RecordTmp['homeselect'] == "1") {
			$dvalue['homeselect'] = "<span id='homeselect_".$row_RecordTmp["id"]."' class='ed_homeselect' data-type='select' data-pk='".$row_RecordTmp["id"]."' data-placement='top'>"."開啟頁面"."</span>";
		}else{
			$dvalue['homeselect'] = "<span id='homeselect_".$row_RecordTmp["id"]."' class='ed_homeselect' data-type='select' data-pk='".$row_RecordTmp["id"]."' data-placement='top'>"."關閉頁面"."</span>";
		}
      } else { 
            $dvalue['homeselect'] = "<span class='label label-danger' data-original-title='目前暫無此模組' data-toggle='tooltip' data-placement='top'>功能未開</span>";
     } 
      
	if($row_RecordTmp["indicate"] == '1') {$row_RecordTmp["indicate"] = "公佈";}else{$row_RecordTmp["indicate"] = "隱藏";}
	$dvalue['indicate'] = "<span id='indicate_".$row_RecordTmp["id"]."' class='ed_indicate' data-type='select' data-pk='".$row_RecordTmp["id"]."' data-placement='top'>".$row_RecordTmp["indicate"]."</span>";
	
	$dvalue['webname'] = $row_RecordTmp["webname"];
	
	$dvalue['action'] = "<div><div class='btn-group'>".$but_view.$but_add.$but_edit.$but_del."</div>";
	$dvalue['action'] .= "<div class='btn-group'>".$but_tmp.$but_tmp_home."</div></div>";
	//$dvalue['content'] = $row_RecordTmp["content"];
	$data[] = $dvalue;
	//print_r(get_object_vars($obj));
	
	
	/*if($row_RecordTmp["id"] <= 200){
	$updateSQL = sprintf("UPDATE demo_tmp SET tmphomeboardtitleindicate=%s WHERE id=%s",
                       GetSQLValueString("0", "text"),
                       GetSQLValueString($row_RecordTmp["id"], "int"));
	$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}*/
	
	
  ?>
<?php } while ($row_RecordTmp = mysqli_fetch_assoc($RecordTmp)); ?>
<?php } ?>


<?php 
    $json_data = array(
	        //"draw"=> 1,
			//"recordsFiltered"=> 57,
            //"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal"    => intval($row_RecordCount['sum']),  // total number of records
            "recordsFiltered" => intval($totalRows_RecordTmp), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
	echo json_encode($json_data);
?>


<?php
mysqli_free_result($RecordTmp);
?>
