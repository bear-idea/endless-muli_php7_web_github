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

/* 取得類別資料 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardListType = "SELECT * FROM demo_tmpitem WHERE list_id = 3";
$RecordTmpBoardListType = mysqli_query($DB_Conn, $query_RecordTmpBoardListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType);
$totalRows_RecordTmpBoardListType = mysqli_num_rows($RecordTmpBoardListType);
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
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/tmpboard_datatable.js?<?php echo time(); ?>"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<style>
.cards tbody tr{float:left;width:20rem;margin:.5rem;border:none;border-radius:.35rem;box-shadow:0 0 2px rgba(0,0,0,.2),0 4px 4px -2px rgba(0,0,0,.2)}.cards tbody td{display:block}.cards tbody td .hidden-text{width:9rem;overflow:hidden;height:20px}.mdl{min-height:1px;_height:1px}.mdl_t{position:relative;font-size:12px}.mdl_t_l,.mdl_t_r{position:absolute;top:0;font-size:1px;overflow:hidden}.mdl_t_l{left:0}.mdl_t_r{right:0;float:right}.mdl_t_m{position:absolute;text-align:left;height:20px;line-height:20px}.mdl_t_m h3{font-size:14px;width:120px}.mdl_t_c{position:relative;text-align:left;overflow:hidden}.mdl_t_c span.a_a{text-decoration:none}.mdl_c{position:relative;overflow:hidden}.mdl_c .mdl_m_t,.mdl_c .mdl_m_c,.mdl_c .mdl_m_b{padding:0 2px}.mdl_c .mdl_m_t,.mdl_c .mdl_m_b{text-align:left}.mdl_c_l,.mdl_c_r{position:absolute;top:0;font-size:1px}.mdl_c_l{left:0}.mdl_c_r{right:0}.mdl_c_c{position:relative;zoom:1}.mdl_b{position:relative;overflow:hidden}.mdl_b_l,.mdl_b_r{position:absolute;top:0;font-size:1px}.mdl_b_l{left:0}.mdl_b_r{right:0}.g_p_fill{padding-bottom:32767px;margin-bottom:-32767px}.g_p_hide{overflow:hidden;display:block!important;display:inline-block}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 區塊外框 <small>總覽</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="row justify-content-end">
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="2"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span></span>
            <select name="type" class="form-control search_filter" id="col2_filter">
            <option value="" selected="selected">全部</option>
              <?php
do {  
?>
              <option value="<?php echo $row_RecordTmpBoardListType['itemname']?>"><?php echo $row_RecordTmpBoardListType['itemname']?></option>
                  <?php
} while ($row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType));
  $rows = mysqli_num_rows($RecordTmpBoardListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpBoardListType, 0);
	  $row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType);
  }
?>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="4"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span></span>
            <select name="indicate" class="form-control search_filter" id="col4_filter">
              <option value="">全部</option>
              <option value="公佈">公佈</option>
              <option value="隱藏">隱藏</option>
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
          <th width="16"><input type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
          <th width="200" data-priority="1"><strong>圖片</strong></th>
          <th width="-2" data-priority="1"><strong>標題</strong></th>
          <th width="100" data-priority="1"><strong>類別</strong></th>
          <th width="70"><strong>排序</strong></th>
          <th width="70"><strong>狀態</strong></th>
          <th width="100"><strong>作者</strong></th>
          <th width="1%" class="desktop"><strong>操作</strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td>└</td>
          <td><button type="button" class="btn btn-default btn-sm" onclick="delete_muti_datatables(event);"><i class="far fa-trash-alt"></i> 刪除選取項目</button></td>
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
mysqli_free_result($RecordTmpBoardListType);
?>
