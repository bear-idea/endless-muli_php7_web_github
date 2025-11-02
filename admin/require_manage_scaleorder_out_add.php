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

/* 取得類別列表 */
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE userid=%s ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

$coluserid_RecordWarehouse = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWarehouse = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWarehouse = sprintf("SELECT * FROM erp_warehouse WHERE userid=%s",GetSQLValueString($coluserid_RecordWarehouse, "int"));
$RecordWarehouse = mysqli_query($DB_Conn, $query_RecordWarehouse) or die(mysqli_error($DB_Conn));
$row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse);
$totalRows_RecordWarehouse = mysqli_num_rows($RecordWarehouse);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Scaleorder_in")) {
	
	/* 解析 title */
	list($pdname, $pdcode) = explode('_', $_POST['title']);
	
  $insertSQL = sprintf("INSERT INTO erp_scaleorderindetail (title, code, author, scaleorder_out, Totalweight, Minweight, Oriweight, postdate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($pdname, "text"),
					   GetSQLValueString($pdcode, "text"),
					   GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['scaleorder_out'], "text"),
                       GetSQLValueString($_POST['Totalweight'], "text"),
                       GetSQLValueString($_POST['Minweight'], "text"),
                       GetSQLValueString($_POST['Totalweight']-$_POST['Minweight'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_scaleorder_out.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageScaleorder_inEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageScaleorder_inEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageScaleorder_inEditorSelect == '1' || $ManageScaleorder_inEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 出庫物料 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-2 col-form-label">廠區<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="warehouse" id="warehouse" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇廠區 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWarehouse['name']?>">[<?php echo $row_RecordWarehouse['code']?>] <?php echo $row_RecordWarehouse['name']?></option>
								<?php
				} while ($row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse));
				  $rows = mysqli_num_rows($RecordWarehouse);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWarehouse, 0);
					  $row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">商品<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="title" id="title" class="form-control" data-parsley-trigger="blur" required="">
                <option value="-1">-- 選擇商品 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordScale['name']?>_<?php echo $row_RecordScale['code']?>">[<?php echo $row_RecordScale['code']?>] <?php echo $row_RecordScale['name']?></option>
                      <?php
				} while ($row_RecordScale = mysqli_fetch_assoc($RecordScale));
				  $rows = mysqli_num_rows($RecordScale);
				  if($rows > 0) {
					  mysqli_data_seek($RecordScale, 0);
					  $row_RecordScale = mysqli_fetch_assoc($RecordScale);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">總重<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="Totalweight" id="Totalweight" maxlength="20" class="form-control" data-parsley-min="0" type="number" data-parsley-type="number" step="0.1" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">扣重<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="Minweight" id="Minweight" maxlength="20" class="form-control" data-parsley-min="0" type="number" data-parsley-type="number" step="0.1" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d H:i:s'); ?>" maxlength="20" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/" /> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Scaleorder_in" />
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
mysqli_free_result($RecordScale);

mysqli_free_result($RecordWarehouse);
?>
