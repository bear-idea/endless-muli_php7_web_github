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

$colname_RecordCartListState = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListState = $_GET['lang'];
}
$coluserid_RecordCartListState = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListState = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListState = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListState, "text"),GetSQLValueString($coluserid_RecordCartListState, "int"));
$RecordCartListState = mysqli_query($DB_Conn, $query_RecordCartListState) or die(mysqli_error($DB_Conn));
$row_RecordCartListState = mysqli_fetch_assoc($RecordCartListState);
$totalRows_RecordCartListState = mysqli_num_rows($RecordCartListState);

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
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/cart_datatable_export.js"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 訂單 <small>總覽</small> 
      <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b><?php if($row_RecordSystemConfigOtr['inventorycorrection'] == "1") { ?>目前<span style="color:#900">【已開啟】</span>庫存校正功能，<span style="color:#900">【刪除訂單】</span>時會<span style="color:#900">【自動修正】</span>商品庫存量。<?php } else { ?>目前<span style="color:#900">【未開啟】</span>庫存校正功能，<span style="color:#900">【刪除訂單】</span>時會<span style="color:#900">【保留】</span>目前商品庫存量。<?php } ?><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=ivcpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 選擇模式</a></b></div>
  
    <div class="row justify-content-end">
      <div class="col-md-3 col-sm-12 m-b-10">
          <div class="input-group" data-column="1">
              <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 訂購日期</span></span>
              <input name="postdate" type="text" class="form-control search_filter" placeholder="" id="col1_filter" autocomplete="off"/><?php /* 加上autocomplete="off"后，自动提示就没有了 */ ?>
              
          </div>
      </div>
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="23"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 出貨狀態</span></span>
            <select name="state" class="form-control search_filter" id="col23_filter">
                <option value="">全部</option>
                <option value="未處理">未處理</option>
                <option value="未出貨">未出貨</option>
                <option value="缺貨中">缺貨中</option>
                <option value="處理中">處理中</option>
                <option value="備貨中">備貨中</option>
                <option value="已出貨">已出貨</option>
                <option value="交易完成">交易完成</option>
                <option value="交易取消">交易取消</option>
                <?php if ($totalRows_RecordCartListState > 0) { // Show if recordset not empty ?>
				<?php
            do {  
            ?>
                <option value="<?php echo $row_RecordCartListState['itemname']?>"><?php echo $row_RecordCartListState['itemname']?></option>
                <?php
            } while ($row_RecordCartListState = mysqli_fetch_assoc($RecordCartListState));
              $rows = mysqli_num_rows($RecordCartListState);
              if($rows > 0) {
                  mysqli_data_seek($RecordCartListState, 0);
                  $row_RecordCartListState = mysqli_fetch_assoc($RecordCartListState);
              }
            ?><?php } // Show if recordset not empty ?>
              </select>
        </div>
      </div>
      <div class="col-md-3 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 訂單編號 / 訂購人</span></span>
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
			<th width="150"><strong>訂單編號</strong></th>
			<th width="150"><strong>購買日期</strong></th>
			<th width="150"><strong>訂購人</strong></th>
			<th width="150"><strong>訂購人E-mail</strong></th>
			<th width="100"><strong>訂購人室話</strong></th>
			<th width="100"><strong>訂購人行動</strong></th>
			<th width="150"><strong>收貨人</strong></th>
			<th width="150"><strong>收貨人E-mail</strong></th>
			<th width="100"><strong>收貨人室話</strong></th>
			<th width="100"><strong>收貨人行動</strong></th>
			<th width="300"><strong>收貨人地址</strong></th>
			<th width="120"><strong>發票類型</strong></th>
			<th width="200"><strong>電子發票</strong></th>
			<th width="100"><strong>統一編號</strong></th>
			<th width="100"><strong>發票抬頭</strong></th>
			<th width="100"><strong>發票收件人</strong></th>
			<th width="300"><strong>發票收件地址</strong></th>
			<th width="100"><strong>付款方式</strong></th>
			<th width="100"><strong>貨款狀態</strong></th>
			<th width="100"><strong>匯款日期</strong></th>
			<th width="100"><strong>帳號後五碼</strong></th>
			<th width="100"><strong>貨運方式</strong></th>
			<th width="100"><strong>出貨狀態</strong></th>
            <th width="100"><strong>預計出貨日期</strong></th>
            <th width="100"><strong>出貨日期</strong></th>
            <th width="100"><strong>出貨單號</strong></th>
            <th width="100"><strong>收貨時間</strong></th>
            <th width="100"><strong>商品金額</strong></th>
            <th width="100"><strong>運費</strong></th>
            <th width="200"><strong>運費備註</strong></th>
            <th width="150"><strong>運費狀態</strong></th>
            <th width="100"><strong>額外費用</strong></th>
            <th width="100"><strong>額外費用名稱</strong></th>
            <th width="100"><strong>發票稅</strong></th>
            <th width="100"><strong>金物流加收</strong></th>
            <th width="100"><strong>總金額</strong></th>
            <th width="500"><strong>客戶備註</strong></th>
            <th width="500"><strong>業者備註(業者自己備註用，消費者不可以看到)</strong></th>
            <th width="500"><strong>業者備註(業者提醒消費者用，消費者可以看到)</strong></th>
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
<script>
$(document).ready(function() {
  $('input[name="postdate"]').daterangepicker({
    //timePicker: true,
    //startDate: moment().startOf('hour'),
    //endDate: moment().startOf('hour').add(32, 'hour'),
	autoUpdateInput: false,
	singleDatePicker: false,
	//startDate: "<?php $dt = new DateTime(); echo $dt->format('Y-01-01'); ?>",
    //endDate: "2016-11-28",
	singleDatePicker: false,
	showDropdowns: true,
	autoApply: true,
	//showWeekNumbers : false, //是否显示第几周
    //timePicker : true, //是否显示小时和分钟
    //timePickerIncrement : 60, //时间的增量，单位为分钟
    //timePicker12Hour : false, //是否使用12小时制来显示时间
	ranges: {
           '今天': [moment(), moment()],
           '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '最近一周': [moment().subtract(6, 'days'), moment()],
           '最近一月': [moment().subtract(29, 'days'), moment()],
           '本月': [moment().startOf('month'), moment().endOf('month')],
           '上個月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
		   '今年': [moment().startOf('year'), moment().endOf('year')],
		   '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
    locale: {	
		 applyLabel : '確定',
		 cancelLabel : '取消',
		 fromLabel : '起始時間',
		 toLabel : '結束時間',
		 customRangeLabel : '自定日期',
		 daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
		 monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
		 firstDay : 1,
		 format: 'YYYY-MM-DD'
		 //format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
    }
  });
  
  //选择时间后触发重新加载的方法
       $('input[name="postdate"]').on('apply.daterangepicker',function(){
           //当选择时间后，出发dt的重新加载数据的方法
           reload_table();
           //获取dt请求参数
       });

      $('input[name="postdate"]').on('keyup change',function() {
            reload_table();
        });

	  $('input[name="postdate"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		  reload_table();
	  });
	
	  $('input[name="postdate"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
		  reload_table();
	  });
	  
	  $('.clearBtns').on('click','.clearBtns',function(){
          $('input[name="postdate"]').val('');
		  reload_table();
      });
	   
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
mysqli_free_result($RecordCartListState);
?>
