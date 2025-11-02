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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET MSTmpSelect=%s WHERE userid=%s",
                       GetSQLValueString($_POST['MSTmpSelect'], "int"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmp = 30;
$pageNum_RecordTmp = 0;
if (isset($_GET['pageNum_RecordTmp'])) {
  $pageNum_RecordTmp = $_GET['pageNum_RecordTmp'];
}
$startRow_RecordTmp = $pageNum_RecordTmp * $maxRows_RecordTmp;

$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}

$colname_RecordTmp1 = "board001";
$colname_RecordTmp2 = "board002";
$colname_RecordTmp3 = "board003";
$colname_RecordTmp4 = "board004";
$colname_RecordTmp5 = "board005";
$colname_RecordTmp6 = "board006";
$colname_RecordTmp7 = "board007";
$colname_RecordTmp8 = "board008";
$colname_RecordTmp9 = "board009";
$colname_RecordTmp10 = "board010";

if (isset($_GET['s']) && $_GET['s'] == "mobile") {
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE (userid=%s || userid=1) && (name=%s || name=%s) ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordTmp, "int"), GetSQLValueString($colname_RecordTmp9, "text"), GetSQLValueString($colname_RecordTmp10, "text"));
$query_limit_RecordTmp = sprintf("%s LIMIT %d, %d", $query_RecordTmp, $startRow_RecordTmp, $maxRows_RecordTmp);
$RecordTmp = mysqli_query($DB_Conn, $query_limit_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
}else{
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE (userid=%s || userid=1) && (name=%s || name=%s || name=%s || name=%s || name=%s || name=%s || name=%s || name=%s) ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordTmp, "int"), GetSQLValueString($colname_RecordTmp1, "text"), GetSQLValueString($colname_RecordTmp2, "text"), GetSQLValueString($colname_RecordTmp3, "text"), GetSQLValueString($colname_RecordTmp4, "text"), GetSQLValueString($colname_RecordTmp5, "text"), GetSQLValueString($colname_RecordTmp6, "text"), GetSQLValueString($colname_RecordTmp7, "text"), GetSQLValueString($colname_RecordTmp8, "text"));
$query_limit_RecordTmp = sprintf("%s LIMIT %d, %d", $query_RecordTmp, $startRow_RecordTmp, $maxRows_RecordTmp);
$RecordTmp = mysqli_query($DB_Conn, $query_limit_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
}

if (isset($_GET['totalRows_RecordTmp'])) {
  $totalRows_RecordTmp = $_GET['totalRows_RecordTmp'];
} else {
  $all_RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp);
  $totalRows_RecordTmp = mysqli_num_rows($all_RecordTmp);
}
$totalPages_RecordTmp = ceil($totalRows_RecordTmp/$maxRows_RecordTmp)-1;

$coluserid_RecordTmpSelect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpSelect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpSelect = sprintf("SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpSelect, "int"));
$RecordTmpSelect = mysqli_query($DB_Conn, $query_RecordTmpSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpSelect = mysqli_fetch_assoc($RecordTmpSelect);
$totalRows_RecordTmpSelect = mysqli_num_rows($RecordTmpSelect);

$coluserid_RecordTmpShowSlect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = (SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlect, "int"));
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);

/* 取得類別資料 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListType = "SELECT * FROM demo_tmpitem WHERE list_id = 1";
$RecordTmpListType = mysqli_query($DB_Conn, $query_RecordTmpListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
$totalRows_RecordTmpListType = mysqli_num_rows($RecordTmpListType);
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
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/tmpget_datatable.js?<?php echo time(); ?>"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->


<style>
	.cards tbody tr {
		float: left;
		width: 10rem;
		margin: 0.5rem;
		border: none;
		border-radius: .35rem;
		box-shadow: 0 0 2px rgba(0,0,0,.2), 0 4px 4px -2px rgba(0,0,0,.2);
	}
	.cards tbody td {
		display: block;
	}
	.cards tbody td .hidden-text{
		width:9rem; overflow:hidden; height:20px;
	}
	
</style>
    
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 樣板 <small>套用</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 選擇板型</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <form action="<?php echo $editFormAction; ?>" method="POST" name="form" id="form" data-parsley-validate=""> 
    
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>一般傳統版型(對電腦瀏覽器相容性高/行動裝置不易閱讀/適於電腦操作)，RWD版型(僅支援IE9+以上瀏覽器/適用行動裝置/適於觸控操作)。請自行對您的客戶群做判斷調整。</b></div>
    
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>此頁面版型套用後即為您網站於 <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span> 的外觀。</b></div>
    
    <div class="row">
      <div class="col-md-6">
        <div class="m-b-10 f-s-10 m-t-0"><b class="text-inverse"><span class="label label-success">目前套用</span> <span class="label label-success">桌面裝置</span> <span class="label label-success">行動裝置</span> <span class="label label-danger">單版型</span> <span class="label label-warning">電腦 / 筆電 / 平板 / 手機</span></b></div>
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpShowSlect['title'] != "" && $row_RecordTmpShowSlect['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="right">#No.<?php echo $row_RecordTmpShowSlect['id']; ?></span>
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
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpShowSlect['type'];?></span> <?php echo $row_RecordTmpShowSlect['title']; ?></div>
            
            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            <?php } ?>
          </div>
        </div>
      </div>
      
    </div>
      
    <div class="row justify-content-end">
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="4"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span></span>
            <select name="type" class="form-control search_filter" id="col4_filter">
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
          <select name="name" class="form-control search_filter" id="col3_filter">
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
    
    <table id="data-table-default" class="table table-bordered table-hover cards" style="width:100%">
      <thead>
        <tr>
          
          <th data-priority="1"><strong>可選擇版型<div id="error_action"></div></strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
         
          <td><button type="button" id="reset_table" class="btn btn-default btn-sm pull-right"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
    </table>
    <button type="submit" class="btn btn btn-primary btn-block m-t-10">套用所選取的版型</button>
    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
    <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
    <input type="hidden" name="MM_update" value="form" />
  </form>  
  	<script>
	//$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {	
		TableManageDefault.init();	   
	});
	</script> 
  </div>
  <!-- end panel-body --> 
  
  
</div>
<!-- end panel --> 

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "版型套用成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpSelect);

mysqli_free_result($RecordTmpShowSlect);

mysqli_free_result($RecordTmpListType);
?>
