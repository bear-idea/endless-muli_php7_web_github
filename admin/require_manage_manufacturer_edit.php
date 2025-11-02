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

/* 更新資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Manufacturer")) {
  $updateSQL = sprintf("UPDATE erp_manufacturer SET code=%s, name=%s, type=%s, editdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['editdate'], "date"),
					   GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_manufacturer.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordManufacturerListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordManufacturerListType = $_GET["lang"];
}
$coluserid_RecordManufacturerListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturerListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturerListType = sprintf("SELECT * FROM erp_manufactureritem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordManufacturerListType, "text"),GetSQLValueString($coluserid_RecordManufacturerListType, "int"));
$RecordManufacturerListType = mysqli_query($DB_Conn, $query_RecordManufacturerListType) or die(mysqli_error($DB_Conn));
$row_RecordManufacturerListType = mysqli_fetch_assoc($RecordManufacturerListType);
$totalRows_RecordManufacturerListType = mysqli_num_rows($RecordManufacturerListType);

/* 取得最新訊息資料 */
$colname_RecordManufacturer = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordManufacturer = $_GET['id_edit'];
}
$coluserid_RecordManufacturer = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturer = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturer = sprintf("SELECT * FROM erp_manufacturer WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordManufacturer, "int"),GetSQLValueString($coluserid_RecordManufacturer, "int"));
$RecordManufacturer = mysqli_query($DB_Conn, $query_RecordManufacturer) or die(mysqli_error($DB_Conn));
$row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
$totalRows_RecordManufacturer = mysqli_num_rows($RecordManufacturer);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageManufacturerEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageManufacturerEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageManufacturerEditorSelect == '1' || $ManageManufacturerEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 廠商管理 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">代碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="code" type="text" class="form-control" id="code" value="<?php echo $row_RecordManufacturer['code']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $row_RecordManufacturer['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordManufacturer['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordManufacturerListType['itemname']?>"<?php if (!(strcmp($row_RecordManufacturerListType['itemname'], $row_RecordManufacturer['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordManufacturerListType['itemname']?></option>
                  <?php
} while ($row_RecordManufacturerListType = mysqli_fetch_assoc($RecordManufacturerListType));
  $rows = mysqli_num_rows($RecordManufacturerListType);
  if($rows > 0) {
      mysqli_data_seek($RecordManufacturerListType, 0);
	  $row_RecordManufacturerListType = mysqli_fetch_assoc($RecordManufacturerListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordManufacturer['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordManufacturer['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordManufacturer['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordManufacturer['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordManufacturer['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Manufacturer" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
$(document).ready(function() {
  $('#postdate').daterangepicker({
    //timePicker: true,
    //startDate: moment().startOf('hour'),
    //endDate: moment().startOf('hour').add(32, 'hour'),
	autoUpdateInput: false,
	singleDatePicker: false,
	//startDate: "2019-01-01",
    //endDate: "2016-11-28",
	singleDatePicker: true,
	showDropdowns: true,
	autoApply: true,
	showWeekNumbers : false, //是否显示第几周
    timePicker : true, //是否显示小时和分钟
    //timePickerIncrement : 60, //时间的增量，单位为分钟
    //timePicker12Hour : true, //是否使用12小时制来显示时间
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
		 //format: 'YYYY-MM-DD'
		 format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
    }
  });
  
  $('#postdate').on('apply.daterangepicker', function(ev, picker) {
		  $(this).parsley().validate(); 
	   });
	   
});
</script>

<?php
mysqli_free_result($RecordManufacturerListType);

mysqli_free_result($RecordManufacturer);
?>
