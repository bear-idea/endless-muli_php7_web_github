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

if ((isset($_POST["MM_choose"])) && ($_POST["MM_choose"] == "Form_Choose") && $_POST['id_choose'] != "") 
{
	$datatable_mix = "demo_". strtolower($UseMod);
	//foreach($_POST['id'] as $key => $val){
		$updateSQL = sprintf("UPDATE $datatable_mix SET productmixid=%s WHERE id =%s",
                       GetSQLValueString($_POST['MSTmpSelect'], "int"),
                       GetSQLValueString($_POST['id_choose'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  
	  $_SESSION['DB_Edit'] = "Success";
 
	  $updateGoTo = "manage_".strtolower($UseMod).".php?Opt=viewpage&lang=" . $_POST['lang'];
	  /*if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }*/
	  header(sprintf("Location: %s", $updateGoTo));
	//}
}

/* 取得類別資料 */
$colname_RecordProductListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProductListType = $_GET['lang'];
}
$coluserid_RecordProductListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListType = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordProductListType, "text"),GetSQLValueString($coluserid_RecordProductListType, "int"));
$RecordProductListType = mysqli_query($DB_Conn, $query_RecordProductListType) or die(mysqli_error($DB_Conn));
$row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
$totalRows_RecordProductListType = mysqli_num_rows($RecordProductListType);



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
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/product_datatable_mix.js"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<style>
.cards tbody tr{float:left;width:10rem;margin:.3rem;border:none;border-radius:.35rem;box-shadow:0 0 2px rgba(0,0,0,.2),0 4px 4px -2px rgba(0,0,0,.2)}.cards tbody td{display:block}.cards tbody td .hidden-text{width:9rem;overflow:hidden;height:20px} .table.table-bordered.dataTable tbody tr:first-child td {border-top:solid #e2e7eb 1px !important;}
</style>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Product']; ?> <small>總覽</small> <?php require("require_lang_show.php"); ?></h4>
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
      <div class="col-md-5 m-b-10">
        <div class="input-group" data-column="type1"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 分類</span></span>
            <select name="type1" class="form-control search_filter" id="coltype1_filter">
                      <option value="-1">全部</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordProductListType['item_id']?>"><?php echo $row_RecordProductListType['itemname']?></option>
                      <?php
} while ($row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType));
  $rows = mysqli_num_rows($RecordProductListType);
  if($rows > 0) {
      mysqli_data_seek($RecordProductListType, 0);
	  $row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
  }
?>
             </select>
             
          <select name="type2" class="form-control search_filter" id="coltype2_filter">
              <option value="-1">-- 選擇分類2 --</option>
             </select>
             
          <select name="type3" class="form-control search_filter" id="coltype3_filter">
              <option value="-1">-- 選擇分類3 --</option>
             </select>
            
          <input id="fullIdPath" type="hidden" />
        </div>
      </div>
      <div class="col-md-2 m-b-10">
        <div class="input-group" data-column="3"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span></span>
            <select name="indicate" class="form-control search_filter" id="col3_filter">
              <option value="">全部</option>
              <option value="上架">上架</option>
              <option value="下架">下架</option>
            </select>
        </div>
      </div>
      <div class="col-md-5 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題/型號</span></span>
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
    <form action="<?php echo $editFormAction; ?>" method="POST" name="Form_Choose" id="Form_Choose" data-parsley-validate=""> 
    <table id="data-table-default" class="table table-bordered table-hover cards" style="width:100%">
      <thead>
        <tr> 
          <th data-priority="1"><strong>可選擇項目</strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td align="left">
          <span class="label label-danger p-10"><div class='radio radio-css radio-inline'><input type='radio' name='MSTmpSelect' value='' id='MSTmpSelect_none' data-parsley-trigger='blur' data-parsley-errors-container='#error_action'><label for='MSTmpSelect_none' class='text-white'>不使用任何選項</label></div></span>
          <button type="button" id="reset_table" class="btn btn-default btn-sm pull-right"><i class="fa fa-sync"></i> 清除狀態</button>
          </td>
        </tr>
      </tfoot>
    </table>
    <button type="submit" class="btn btn btn-primary btn-block m-t-10">送出</button>
    <input type="hidden" name="MM_choose" value="Form_Choose" />
    <input type="hidden" name="id_choose" value="<?php echo $_GET['id_choose'] ?>" />
    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
    </form>
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
                element: '#Step_List',
                intro: '您可以點選按鈕設置清單或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_product.php?wshop=<?php echo $wshop;?>&Opt=listpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往設置清單</a></span></div>'
              },
			  {
                element: '#Step_Add',
                intro: '您可以點選按鈕新增資料或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_product.php?wshop=<?php echo $wshop;?>&Opt=addpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往新增資料</a></span></div>'
              },
              {
                element: '#Step_View',
                intro: '設置完後您可在此頁面觀看資料總覽。',
                position: 'bottom'
              },
              {
                element: '#Step_Sub',
                intro: '<img src="images/tip/tip063.jpg" width="266" height="37" /><br /><br />點選可進入下層分類。',
                position: 'bottom'
              },
              {
                element: '#Step_Edit',
                intro: '<img src="images/tip/tip059.jpg" width="500" height="71" /><br /><br />點選文字可直接修改。',
                position: 'bottom'
              },
              {
                element: '#Step_Home',
                intro: '<img src="images/tip/tip064.jpg" width="454" height="282" /><br /><br />欲使用首頁顯示功能需搭配首頁模組，可以指定商品隨機顯示或自訂顯示。',
                position: 'bottom'
              },
              {
                element: '#Step_Sort',
                intro: '<img src="images/tip/tip060.jpg" width="126" height="102" /><br /><br />點選文字可直接修改，更改數字即可排序。',
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
    
	//$("#type2").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type3").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#coltype1_filter').change(function () {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");若是要刪掉全部則框號內置入/./
        $('#coltype2_filter').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/product_show.php?&<?php echo time();?>', 
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
				if( $('#coltype1_filter option:selected').val() != '' && $('#coltype2_filter option:selected').val() != '')
				// 值=val() // 標籤=text
				{
					$("#coltype2_filter").show(); // 
				}else{
					$("#coltype2_filter").hide(); //
				}
            }
        ).change(function () {
            // 觸發第三階下拉式選單
            $('#coltype3_filter').removeOption(/.?/).ajaxAddOption(
                'selectbox_action/product_show.php?<?php echo time();?>', 
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
						$("#coltype3_filter").show(); // 
					}else{
						$("#coltype3_filter").hide(); //
					}
					}
            );
        });
    }).trigger('change');
});
</script>
<?php
mysqli_free_result($RecordProductListType);
?>
