<?php require_once('../Connections/DB_Conn.php'); ?>
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
$colname_RecordManufacturer = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordManufacturer = $_GET['lang'];
}
$coluserid_RecordManufacturer = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturer = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturer = sprintf("SELECT * FROM erp_manufacturer WHERE lang=%s && userid=%s", GetSQLValueString($colname_RecordManufacturer, "text"),GetSQLValueString($coluserid_RecordManufacturer, "int"));
$RecordManufacturer = mysqli_query($DB_Conn, $query_RecordManufacturer) or die(mysqli_error($DB_Conn));
$row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
$totalRows_RecordManufacturer = mysqli_num_rows($RecordManufacturer);

$colname_RecordCarnumber = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCarnumber = $_GET['lang'];
}
$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE lang=%s && userid=%s", GetSQLValueString($colname_RecordCarnumber, "text"),GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);
?>
<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
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
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/scaleorder_clearance_datatable_month.js"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 清運明細月報表 <small>總覽</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

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
      <div class="col-md-3 col-sm-12 m-b-10">
          <div class="input-group" data-column="9">
              <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 時間</span></span>
              <input name="postdate" type="text" class="form-control" id="col9_filter" autocomplete="off" size="50" maxlength="50" data-parsley-trigger="blur"  date-language="zh-TW"/>	
          </div>
      </div>
      
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="7"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span></span>
            <select name="mode" class="form-control search_filter" id="col7_filter">
              <option value="">全部</option>
              <option value="sell">應收(對方付費，我方收款)</option>
              <option value="pay">應付(我方付費，對方取款)</option>
              <option value="free">無償(無須付費)</option>
            </select>
        </div>
      </div>

      <div class="col-md-3 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 種類細項</span></span>
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
          <th width="16"></th>
          <th width="-1" data-priority="1"><strong>種類大項</strong></th>
          <th width="-1" data-priority="1"><strong>種類細項</strong></th>
          <th width="70" data-priority="1"><strong>廢棄物代碼</strong></th>
          <th width="1%" data-priority="1"><strong>總重</strong></th>
          <th width="1%" data-priority="1"><strong>扣重</strong></th>
          <th width="1%" data-priority="1"><strong>淨重</strong></th>
          <th width="70"><strong>單價</strong></th>
          <th width="70"><strong>總價</strong></th>
          <th width="100"><strong>清運日期</strong></th>
          <th width="100"><strong>備註</strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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

<script>
$(document).ready(function() {
	
  $('#col9_filter').datetimepicker({
	   defaultDate: "<?php $dt = new DateTime(); echo $dt->format('Y-m'); ?>",
	   locale:moment.locale("zh-tw"),
	   format:'YYYY-MM',
  }).on('dp.change', function(e) { 
		reload_table();
  }); 
  
});
</script>
 
<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_List',
                intro: '您可以點選按鈕設置清單或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_manufacturer.php?wshop=<?php echo $wshop;?>&Opt=listpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往設置清單</a></span></div>'
              },
			  {
                element: '#Step_Add',
                intro: '您可以點選按鈕新增資料或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_manufacturer.php?wshop=<?php echo $wshop;?>&Opt=addpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往新增資料</a></span></div>'
              },
              {
                element: '#Step_View',
                intro: '設置完後您可在此頁面觀看資料總覽。',
                position: 'bottom'
              },
              {
                element: '#Step_Edit',
                intro: '<img src="images/tip/tip059.jpg" width="500" height="71" /><br /><br />點選文字可直接修改。',
                position: 'bottom'
              },
              {
                element: '#Step_Sort',
                intro: '<img src="images/tip/tip060.jpg" width="126" height="102" /><br /><br />點選文字可直接修改，更改數字即可排序。',
                position: 'bottom'
              },
              {
                element: '#Step_MList',
                intro: '<img src="images/tip/tip062.jpg" width="123" height="98" /><br /><br />點選文字可直接修改。',
                position: 'bottom'
              },
              {
                element: '#Step_Indicate',
                intro: '<img src="images/tip/tip061.jpg" width="106" height="86" /><br /><br />點選文字可直接修改，勾選為公佈、反之則隱藏。',
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
mysqli_free_result($RecordManufacturer);

mysqli_free_result($RecordCarnumber);
?>
