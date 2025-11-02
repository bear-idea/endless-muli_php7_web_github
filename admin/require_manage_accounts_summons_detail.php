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

$colname_RecordAccounts_summonsListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListType = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListType = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListType, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListType, "int"));
$RecordAccounts_summonsListType = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
$totalRows_RecordAccounts_summonsListType = mysqli_num_rows($RecordAccounts_summonsListType);

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
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="//cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/accounts_summonsdetail_datatable.js"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 會計傳票 <small>總覽</small>
      <?php require("require_lang_show.php"); ?>
    </h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="inner_accounts_summons.php?wshop=<?php echo $wshop; ?>&amp;Opt=detailaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> 新增</a></div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <div class="row justify-content-end">
      <div class="col-md-12 m-b-10">
        <div class="input-group" data-column="type1"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 會計科目</span></span>
          <select name="type1" class="form-control search_filter" id="coltype1_filter">
            <option value="-1">全部</option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordAccounts_summonsListType['item_id']?>"><?php echo $row_RecordAccounts_summonsListType['itemname']?></option>
            <?php
} while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType));
  $rows = mysqli_num_rows($RecordAccounts_summonsListType);
  if($rows > 0) {
      mysqli_data_seek($RecordAccounts_summonsListType, 0);
	  $row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
  }
?>
          </select>
          <select name="type2" class="form-control search_filter" id="coltype2_filter">
            <option value="-1">-- 選擇分類2 --</option>
          </select>
          <select name="type3" class="form-control search_filter" id="coltype3_filter">
            <option value="-1">-- 選擇分類3 --</option>
          </select>
          <select name="type4" class="form-control search_filter" id="coltype4_filter">
            <option value="-1">-- 選擇分類4 --</option>
          </select>
          <input id="fullIdPath" type="hidden" />
        </div>
      </div>
	  <div class="col-md-3 col-sm-12 m-b-10">
        <div class="input-group" data-column="6"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 時間</span></span>
          <input name="postdate" type="text" class="form-control search_filter" placeholder="" id="col6_filter" autocomplete="off"/>
        </div>
      </div>
      
      <div class="col-md-2 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 備註</span></span>
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
          <div class="col-md-12"> </div>
        </div>
      </div>
    </div>
    <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th width="16"><input type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
          <th width="100" data-priority="1"><strong>會計項目</strong></th>
          <th width="100" data-priority="1"><strong>項目名稱</strong></th>
          <th width="-1" data-priority="1"><strong>摘要</strong></th>
          <th width="100"><strong>借方金額</strong></th>
          <th width="100"><strong>貸方金額</strong></th>
          <th width="100"><strong>日期</strong></th>
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
		TableManageDefault.init(<?php echo $_GET['aid']?>);		
	});
</script> 

<script type="text/javascript">
// 下拉連動選單設定
$(function () {
    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }
    
    // 設定預設選項
    if (defaultValue) {
        $('#coltype1_filter').selectOptions($fullIdPath[0]); 
    }
    
	//$("#coltype2_filter").hide(); //開始執行時先將第二層的選單藏起來
	//$("#coltype3_filter").hide(); //開始執行時先將第二層的選單藏起來
	//$("#coltype4_filter").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
	$('#coltype1_filter').on('change', function() {
        // 觸發第二階下拉式選單 
		//$('#data-table-default').DataTable().draw();
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");//若是要刪掉全部則框號內置入/./
		/////if( $('#coltype1_filter option:selected').val() != '-1') {
        $('#coltype2_filter').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/accounts_summons_show.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () { 
					// 設定預設選項
					if (defaultValue) {
						$(this).selectOptions($fullIdPath[1]).trigger('change');
					} else {
						$(this).selectOptions().trigger('change');
					}
					// 設定欄位隱藏/開啟
					if( $('#coltype1_filter option:selected').val() != '' && $('#coltype1_filter option:selected').val() != '-1' && $('#coltype2_filter option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#coltype2_filter").show();
						//$("#coltype2_filter").find(":selected").val();
					}else{
						$("#coltype2_filter").hide();
						$("#coltype3_filter").hide();
						$("#coltype4_filter").hide();
						$("#coltype2_filter").val('-1');
						$("#coltype3_filter").val('-1');
						$("#coltype4_filter").val('-1');
						// Event listener to the two range filtering inputs to redraw on input
						//alert('hide');
					}
					$('#data-table-default').DataTable().draw();
				}
            ).on('change', function() {
            // 觸發第三階下拉式選單
				$('#coltype3_filter').removeOption(/.?/).ajaxAddOption(
					'selectbox_action/accounts_summons_show.php?<?php echo time();?>', 
					{ 'id': $(this).val(), 'lv': 2 }, 
					false, 
					function () {

						// 設定預設選項
						if (defaultValue) {
							$(this).selectOptions($fullIdPath[2]);
						}
						// 設定欄位隱藏/開啟
						if( $('#coltype2_filter option:selected').val() != '' && $('#coltype3_filter option:selected').val() != '')
						// 值=val() // 標籤=text
						{
							$("#coltype3_filter").show();
							$('#data-table-default').DataTable().draw();
							//$("#coltype4_filter").show();
							// 觸發第四階下拉式選單
							$('#coltype4_filter').removeOption(/.?/).ajaxAddOption(
								'selectbox_action/accounts_summons_show.php?&<?php echo time();?>', 
								{ 'id': $(this).val(), 'lv': 3 }, 
								false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
								function () { 
										// 設定預設選項
										if (defaultValue) {
											$(this).selectOptions($fullIdPath[3]).trigger('change');
										} else {
											$(this).selectOptions().trigger('change');
										}
										// 設定欄位隱藏/開啟
										if( $('#coltype3_filter option:selected').val() != '' && $('#coltype4_filter option:selected').val() != '')
										// 值=val() // 標籤=text
										{
											$("#coltype4_filter").show();
											//$("#coltype4_filter").val(-1);
										}else{
											$("#coltype4_filter").hide();
											$("#coltype4_filter").val('-1');
										}
										$('#data-table-default').DataTable().draw();
									}
							);
							
						}else{
							$("#coltype3_filter").hide(); 
							$("#coltype4_filter").hide(); 
							$("#coltype3_filter").val('-1');
							$("#coltype4_filter").val('-1');
						}
					}
				).on('change', function() {
            // 觸發第四階下拉式選單
				$('#coltype4_filter').removeOption(/.?/).ajaxAddOption(
					'selectbox_action/accounts_summons_show.php?<?php echo time();?>', 
					{ 'id': $(this).val(), 'lv': 3 }, 
					false, 
					function () {

						// 設定預設選項
						if (defaultValue) {
							$(this).selectOptions($fullIdPath[3]);
						}
						// 設定欄位隱藏/開啟
						if( $('#coltype3_filter option:selected').val() != '' && $('#coltype4_filter option:selected').val() != '')
						// 值=val() // 標籤=text
						{
							$("#coltype4_filter").show();
						}else{
							$("#coltype4_filter").hide();
							$("#coltype4_filter").val('-1');
						}
						$('#data-table-default').DataTable().draw();
					}
				);
            });
            });
			/////}

    }).trigger('change');
	
});

</script> 

<script>
$(document).ready(function() {
  $('input[name="postdate"]').daterangepicker({
    //timePicker: true,
    //startDate: moment().startOf('hour'),
    //endDate: moment().startOf('hour').add(32, 'hour'),
	autoUpdateInput: false,
	startDate: "<?php $dt = new DateTime(); echo $dt->format('Y-01-01'); ?>",
    //endDate: "2016-11-28",
	singleDatePicker: false, //單日曆
	showDropdowns: true, //年月份下拉框
	autoApply: true, //選擇日期後自動提交;只有在不顯示時間的時候起作用timePicker:false
	//showWeekNumbers : false, //是否显示第几周
    //timePicker : true, //是否显示小时和分钟 顯示時間
    //timePickerIncrement : 60, //时间的增量，单位为分钟
    //timePicker12Hour : false, //是否使用12小时制来显示时间
	//timePickerSeconds: true, //時間顯示到秒
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
		 format: 'YYYY-MM-DD',
		 cancelLabel: '清除'
		 //format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
    }
  });
  
  //选择时间后触发重新加载的方法
       /*$('input[name="postdate"]').on('apply.daterangepicker',function(){
           //当选择时间后，出发dt的重新加载数据的方法
           reload_table();
           //获取dt请求参数
       });*/

	  $('input[name="postdate"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		  reload_table();
	   });

	 $('input[name="postdate"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
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
                intro: '您可以點選按鈕設置清單或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_news.php?wshop=<?php echo $wshop;?>&Opt=listpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往設置清單</a></span></div>'
              },
			  {
                element: '#Step_Add',
                intro: '您可以點選按鈕新增資料或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_news.php?wshop=<?php echo $wshop;?>&Opt=addpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往新增資料</a></span></div>'
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
<?php if($_SESSION['DB_Add'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Add"]); ?>
<?php } ?>
<?php if($_SESSION['DB_Edit'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Edit"]); ?>
<?php } ?>
<?php if($_SESSION['DB_Set'] == "Success") { ?>
<script type="text/javascript">
swal({ title: "資料設定成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Set"]); ?>
<?php } ?>
