<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

/* 刪除資料 */
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $_GET['userid'] == $w_userid) {
  $deleteSQL = sprintf("DELETE FROM demo_tmp WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  @unlink($SiteImgFilePathAdmin . $wshop . '/image/tmp/' . $_GET['pic']);
  
  // 刪除樣板橫幅
  $deleteSQLBanner = sprintf("DELETE FROM demo_tmpbanner WHERE tmpname=%s",
                       GetSQLValueString($_GET['tmpname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultBanner = mysqli_query($DB_Conn, $deleteSQLBanner) or die(mysqli_error($DB_Conn));
  
  // 刪除樣板橫幅_SUB
  $deleteSQLBannerSub = sprintf("DELETE FROM demo_tmpbanner_sub WHERE act_id = (SELECT act_id FROM demo_tmpbanner WHERE tmpname=%s)",
                       GetSQLValueString($_GET['tmpname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultBannerSub = mysqli_query($DB_Conn, $deleteSQLBannerSub) or die(mysqli_error($DB_Conn));
}

/* 刪除多筆資料 */
if ((isset($_POST['deltmp'])) && ($_POST['deltmp'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_tmp WHERE id in (%s)", implode(",", $_POST['deltmp']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

/* 重複區域 */
$maxRows_RecordTmp = 25;
$pageNum_RecordTmp = 0;
if (isset($_GET['pageNum_RecordTmp'])) {
  $pageNum_RecordTmp = $_GET['pageNum_RecordTmp'];
}
$startRow_RecordTmp = $pageNum_RecordTmp * $maxRows_RecordTmp;

$colname_RecordTmp = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmp = $_GET['searchkey'];
}
$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}
$coltype_RecordTmp = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmp = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE ((name LIKE %s))  && (type LIKE %s) && (userid=%s) ORDER BY sortid ASC, id DESC, type DESC", GetSQLValueString("%" . $colname_RecordTmp . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmp . "%", "text"),GetSQLValueString($coluserid_RecordTmp, "int"));
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

/* 取得類別資料 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListType = "SELECT * FROM demo_tmpitem WHERE list_id = 1";
$RecordTmpListType = mysqli_query($DB_Conn, $query_RecordTmpListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
$totalRows_RecordTmpListType = mysqli_num_rows($RecordTmpListType);

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

$coluserid_RecordTmpShowSlect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = (SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlect, "int"));
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);

$coluserid_RecordTmpShowSlectRwd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlectRwd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlectRwd = sprintf("SELECT * FROM demo_tmp WHERE id = (SELECT MSTmpSelectRwd FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlectRwd, "int"));
$RecordTmpShowSlectRwd = mysqli_query($DB_Conn, $query_RecordTmpShowSlectRwd) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlectRwd = mysqli_fetch_assoc($RecordTmpShowSlectRwd);
$totalRows_RecordTmpShowSlectRwd = mysqli_num_rows($RecordTmpShowSlectRwd);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = "SELECT id, userid, lang, Mobile_Enable FROM demo_setting_fr WHERE userid = $w_userid";
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);

/* 取得發佈者資料 */
?>


<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
<!-- ================== END Datatables CSS ================== -->

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN Datatables JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>-->
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/tmp_datatable.js?<?php echo time(); ?>"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 樣板 <small>總覽</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 目前使用版型</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="alert alert-warning m-b-0"><i class="fa fa-info-circle"></i> <b>模式可選擇雙版型模式及單版型模式，雙版型模式可在桌面裝置及行動裝置有各自外觀；單版型模式則在桌面裝置及行動裝置僅會使用相同外觀。<a href="manage_mobile.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_mobile_config&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 選擇模式</a></b></div>
    <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>一般傳統版型(對電腦瀏覽器相容性高/行動裝置不易閱讀/適於電腦操作)，RWD版型(僅支援IE9+以上瀏覽器/適用行動裝置/適於觸控操作)。請自行對您的客戶群做判斷調整。</b></div>
    
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
    <div class="alert alert-danger m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>隨機版型演示連結。<a href="../tmp_demo_radom.php" class="btn btn-primary btn-xs" data-original-title="" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 隨機展示</a></b></div>
    <?php } ?>
    
    <?php if($row_RecordSystemConfig['Mobile_Enable'] == "1") {  ?>
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-danger">雙版型</span> <span class="label label-warning">電腦 / 筆電</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpShowSlect['title'] != "" && $row_RecordTmpShowSlect['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlect['id']; ?></span>
              <?php if ($row_RecordTmpShowSlect['pic'] != "") { ?>
				  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlect['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlect['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlect['name'] == "board009" || $row_RecordTmpShowSlect['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlect['type'];?></span> <?php echo $row_RecordTmpShowSlect['title']; ?></div>
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pc.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>
            
            <?php } ?>
          </div>
        </div>
      </div>
      
      
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">雙版型</span> <span class="label label-warning">平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpShowSlectRwd['title'] != "" && $row_RecordTmpShowSlectRwd['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlectRwd['id']; ?></span>
              <?php if ($row_RecordTmpShowSlectRwd['pic'] != "") { ?>
              	  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlectRwd['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlectRwd['name'] == "board009" || $row_RecordTmpShowSlectRwd['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?>
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlectRwd['type'];?></span> <?php echo $row_RecordTmpShowSlectRwd['title']; ?></div>
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_rwd&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_mobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_rwd&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>
            
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php } else if($row_RecordSystemConfig['Mobile_Enable'] == "0" || $row_RecordSystemConfig['Mobile_Enable'] == "0") { ?>
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">單版型</span> <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpShowSlect['title'] != "" && $row_RecordTmpShowSlect['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlect['id']; ?></span>
              <?php if ($row_RecordTmpShowSlect['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlect['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlect['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlect['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlect['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlect['name'] == "board009" || $row_RecordTmpShowSlect['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlect['type'];?></span> <?php echo $row_RecordTmpShowSlect['title']; ?></div>
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_a&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_a&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>
            
            <?php } ?>
          </div>
        </div>
      </div>
      
    </div>
    <?php } else { ?>
    <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">單版型</span> <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpShowSlectRwd['title'] != "" && $row_RecordTmpShowSlectRwd['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpShowSlectRwd['id']; ?></span>
              <?php if ($row_RecordTmpShowSlectRwd['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpShowSlect['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpShowSlectRwd['webname']; ?>/image/tmp/<?php echo $row_RecordTmpShowSlectRwd['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpShowSlectRwd['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpShowSlectRwd['name'] == "board009" || $row_RecordTmpShowSlectRwd['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } else { ?>
              <span class="label label-lime" data-original-title="舊系統顯示模式，但可向下相容於XP系統" data-toggle="tooltip" data-placement="top">傳統</span>
              <?php } ?>
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlectRwd['type'];?></span> <?php echo $row_RecordTmpShowSlectRwd['title']; ?></div>
            
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_x&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_x&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary m-t-10" data-original-title="更換您目前所使用之版型" data-toggle="tooltip" data-placement="top">替換板型 <i class="fa fa-chevron-circle-right"></i></a>
            
            <?php if ($row_RecordTmpShowSlect['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?>
            <a href="tmp_config_<?php echo $row_RecordTmpShowSlect['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之版型" data-toggle="tooltip" data-placement="top">版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 當目前使用者不為作者則不能修改 ?>
            
            <?php if ($OptionTmpHomeSelect == '1' && $row_RecordTmpShowSlect['userid'] == $w_userid) { // 是否開啟首頁功能 ?>
            <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpShowSlect['id']; ?>" class="btn btn-primary m-t-10 colorbox_iframe_cd" data-original-title="修改您目前所使用之首頁版型" data-toggle="tooltip" data-placement="top">首頁版型設定 <i class="fa fa-chevron-circle-right"></i></a>
            <?php } // 是否開啟首頁功能 ?>
            
            <?php } ?>
          </div>
        </div>
      </div>
    <?php }  ?>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel --> 

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="row justify-content-end">
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="4"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span></span>
            <select name="type" class="form-control search_filter" id="col5_filter">
            <option value="" selected="selected">全部</option>
              <?php
do {  
?>
              <option value="<?php echo $row_RecordTmpListType['itemname']?>"><?php echo $row_RecordTmpListType['itemname']?></option>
                  <?php
} while ($row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType));
  $rows = mysqli_num_rows($RecordTmpListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpListType, 0);
	  $row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
  }
?>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="3"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 風格</span></span>
            <select name="name" class="form-control search_filter" id="col4_filter">
              <option value="">全部</option>
              <?php if ($SiteOldMode == '1' || $SiteOldMode == "") { /* 是否使用舊系統相容模式 */ ?>
              <option value="board001">風格1</option>
              <option value="board002">風格2</option>
              <option value="board003">風格3</option>
              <option value="board004">風格4</option>
              <option value="board005">風格5</option>
              <option value="board006">風格6</option>
              <option value="board007">風格7</option>
              <option value="board008">風格8</option>
              <?php } ?>
              <option value="board009">雙欄式版面 - RWD</option>
              <option value="board010">單欄示版面 - RWD</option>
            </select>
        </div>
      </div>
      <div class="col-md-5 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題</span></span>
          <input type="text" class="form-control global_filter" placeholder="" id="global_filter">
          <div class="input-group-append" style="display:none">
            <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#collapseOne"> <span class="caret"></span> </button>
          </div>
        </div>
      </div>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body bg-aqua-transparent-1 m-t-10">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
    </div>
    
    <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed">
      <thead>
        <tr>
          
          <th width="1%" data-priority="1"><strong>圖片</strong></th>
          <th width="" data-priority="1"><strong>標題</strong></th>
          <th width="1%" class="desktop"><strong>首頁風格</strong></th>
          <th width="1%" class="desktop"><strong>內頁風格</strong></th>
          <th width="70" class="desktop"><strong>類別</strong></th>
          <th width="80"><strong>首頁頁面 <i class="fa fa-info-circle text-orange" data-original-title="此版型是否開啟首頁頁面。" data-toggle="tooltip" data-placement="top"></i></strong></th>
          <th width="100"><strong>作者</strong></th>
          <th width="1%" class="desktop"><strong>操作</strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
         
          <td></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><button type="button" id="reset_table" class="btn btn-default btn-sm pull-right"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel --> 

<script>
	//$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {
		TableManageDefault.init();		
	});
</script> 

<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_NowSelect',
                intro: '目前區塊代表目前網站所套用的版面。'
              },
			  {
                element: '#Step_Copy',
                intro: '您可以透過複製的功能來創建您的個人化版型。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="template_get.php?lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往創建個人版型</a></span></div>'
              },
              {
                element: '#Step_Create',
                intro: '<img src="images/tip/tip073.jpg" width="131" height="77" /><br /><br />當您建立完成後您可以透過版型設定的按鈕來設計您的網站外觀。',
              },
              {
                element: '#Step_TmpUse',
                intro: '當您辛苦設計完成您的版型後，不要忘了套用目前的外觀。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="template_home.php?lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往套用版型</a></span></div>',
                position: 'bottom'
              },
              {
                element: '#Step_Home',
                intro: '<img src="images/tip/tip074.jpg" width="144" height="53" /><br /><br />若您的網站有首頁的功能您可點擊按鈕設置您的首頁。',
                position: 'bottom'
              },
              {
                element: '#Step_Home_Select',
                intro: '<img src="images/tip/tip075.jpg" width="423" height="442" /><br /><br />首頁有多種模式可供選擇替換。',
                position: 'bottom'
              },
              {
                element: '#Step_HomeOpen',
                intro: '<img src="images/tip/tip076.jpg" width="223" height="207" /><br /><br />點選文字可直接修改，更改此版型是否要開啟首頁。',
                position: 'bottom'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });
          
          intro.start();
}
</script>

<?php if(isset($_SESSION['DB_Add']) && $_SESSION['DB_Add'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Add"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Edit']) && $_SESSION['DB_Edit'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Edit"]); ?>
<?php } ?>
<?php if(isset($_SESSION['DB_Set']) && $_SESSION['DB_Set'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料設定成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Set"]); ?>
<?php } ?>

<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpListType);

mysqli_free_result($RecordTmpSelect);

mysqli_free_result($RecordTmpShowSlect);

mysqli_free_result($RecordTmpShowSlectRwd);

mysqli_free_result($RecordTmpSelectRwd);
?>
