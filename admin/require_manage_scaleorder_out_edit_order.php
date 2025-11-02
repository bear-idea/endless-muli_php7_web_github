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

$coluserid_RecordDriver = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDriver = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDriver = sprintf("SELECT * FROM erp_driver WHERE userid=%s && indicate=1 ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordDriver, "int"));
$RecordDriver = mysqli_query($DB_Conn, $query_RecordDriver) or die(mysqli_error($DB_Conn));
$row_RecordDriver = mysqli_fetch_assoc($RecordDriver);
$totalRows_RecordDriver = mysqli_num_rows($RecordDriver);

$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE userid=%s && indicate=1 ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);

$coluserid_RecordWarehouse = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWarehouse = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWarehouse = sprintf("SELECT * FROM erp_warehouse WHERE userid=%s",GetSQLValueString($coluserid_RecordWarehouse, "int"));
$RecordWarehouse = mysqli_query($DB_Conn, $query_RecordWarehouse) or die(mysqli_error($DB_Conn));
$row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse);
$totalRows_RecordWarehouse = mysqli_num_rows($RecordWarehouse);

///// 日期
$colstartdate_RecordScaleorder = date('Y-m-d');

$dt = new DateTime();
$interval = new DateInterval('P1D');
$dt->add($interval);
$colenddate_RecordScaleorder = $dt->format('Y-m-d');


$colname_RecordScaleorder = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordScaleorder = $_GET['id_edit'];
}
$coluserid_RecordScaleorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleorder = sprintf("SELECT * FROM erp_scaleorderout WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordScaleorder, "int"),GetSQLValueString($coluserid_RecordScaleorder, "int"));
$RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder) or die(mysqli_error($DB_Conn));
$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
$totalRows_RecordScaleorder = mysqli_num_rows($RecordScaleorder);


$coluserid_RecordManufacturer = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturer = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturer = sprintf("SELECT * FROM erp_manufacturer WHERE userid=%s && indicate=1",GetSQLValueString($coluserid_RecordManufacturer, "int"));
$RecordManufacturer = mysqli_query($DB_Conn, $query_RecordManufacturer) or die(mysqli_error($DB_Conn));
$row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
$totalRows_RecordManufacturer = mysqli_num_rows($RecordManufacturer);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_updata"])) && ($_POST["MM_updata"] == "form_Scaleorder")) {

  $updateSQL = sprintf("UPDATE erp_scaleorderout SET oserial=%s, snumber=%s, snumber2=%s, snumber7=%s, snumber8=%s, snumber9=%s, driver=%s, carnumber=%s, author=%s, warehouse=%s, postdate=%s, manufacturer=%s, arrivals=%s, havebigscale=%s, indicate=%s, notes1=%s, lang=%s WHERE oid=%s",
                       GetSQLValueString($_POST['oserial'], "text"),
					   GetSQLValueString($_POST['snumber'], "text"),
					   GetSQLValueString($_POST['snumber2'], "text"),
					   GetSQLValueString($_POST['snumber7'], "text"),
					   GetSQLValueString($_POST['snumber8'], "text"),
					   GetSQLValueString($_POST['snumber9'], "text"),
                       GetSQLValueString($_POST['driver'], "text"),
					   GetSQLValueString($_POST['carnumber'], "text"),
					   GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['warehouse'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['manufacturer'], "text"),
					   GetSQLValueString($_POST['arrivals'], "date"),
					   GetSQLValueString($_POST['havebigscale'], "int"),
					   GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['oid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
 
  $updateGoTo = "manage_scaleorder_out.php?Opt=viewpage_order&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 出庫單號 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>設定出貨單號及聯單編號固定預設抬頭，會顯示於編號之前。 <a href="manage_scaleorder_out.php?wshop=<?php echo $wshop;?>&amp;Opt=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="right"><i class="fa fa-chevron-right"></i> 設定</a></b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出貨單號</label>
          <div class="col-md-10">
              <input name="oserial" type="text" class="form-control" id="oserial" value="<?php echo $row_RecordScaleorder['oserial'] ?>" size="50" maxlength="50" readonly="readonly"/>    
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯單編號</label>
          <div class="col-md-10">
          <?php if ($row_RecordSystemConfigOtr['erpcompanyordernum'] != "") { ?>
          <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text"> <?php echo $row_RecordSystemConfigOtr['erpcompanyordernum']; ?></span></span>
              <input name="snumber" type="text" class="form-control" id="snumber" value="<?php echo $row_RecordScaleorder['snumber'] ?>" size="50" maxlength="50" />    
          </div>
          <?php } else { ?>
          <input name="snumber" type="text" class="form-control" id="snumber" value="<?php echo $row_RecordScaleorder['snumber'] ?>" size="50" maxlength="50" />
          <?php } ?>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯單編號(補充)</label>
          <div class="col-md-10">
          <?php if ($row_RecordSystemConfigOtr['erpcompanyordernum'] != "") { ?>
          <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text"> <?php echo $row_RecordSystemConfigOtr['erpcompanyordernum']; ?></span></span>
              <input name="snumber2" type="text" class="form-control" id="snumber2" value="<?php echo $row_RecordScaleorder['snumber2'] ?>" size="50" maxlength="50" />    
          </div>
          <?php } else { ?>
          <input name="snumber2" type="text" class="form-control" id="snumber2" value="<?php echo $row_RecordScaleorder['snumber2'] ?>" size="50" maxlength="50" />
          <?php } ?>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯單編號(應付)</label>
          <div class="col-md-10">
          <?php if ($row_RecordSystemConfigOtr['erpcompanyordernum'] != "") { ?>
          <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text"> <?php echo $row_RecordSystemConfigOtr['erpcompanyordernum']; ?></span></span>
              <input name="snumber8" type="text" class="form-control" id="snumber8" value="<?php echo $row_RecordScaleorder['snumber8'] ?>" size="50" maxlength="50" />    
          </div>
          <?php } else { ?>
          <input name="snumber8" type="text" class="form-control" id="snumber8" value="<?php echo $row_RecordScaleorder['snumber8'] ?>" size="50" maxlength="50" />
          <?php } ?>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯單編號(無償)</label>
          <div class="col-md-10">
          <?php if ($row_RecordSystemConfigOtr['erpcompanyordernum'] != "") { ?>
          <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text"> <?php echo $row_RecordSystemConfigOtr['erpcompanyordernum']; ?></span></span>
              <input name="snumber9" type="text" class="form-control" id="snumber9" value="<?php echo $row_RecordScaleorder['snumber9'] ?>" size="50" maxlength="50" />    
          </div>
          <?php } else { ?>
          <input name="snumber9" type="text" class="form-control" id="snumber9" value="<?php echo $row_RecordScaleorder['snumber9'] ?>" size="50" maxlength="50" />
          <?php } ?>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯單編號(應收)</label>
          <div class="col-md-10">
          <?php if ($row_RecordSystemConfigOtr['erpcompanyordernum'] != "") { ?>
          <div class="input-group">
              <span class="input-group-prepend"><span class="input-group-text"> <?php echo $row_RecordSystemConfigOtr['erpcompanyordernum']; ?></span></span>
              <input name="snumber7" type="text" class="form-control" id="snumber7" value="<?php echo $row_RecordScaleorder['snumber7'] ?>" size="50" maxlength="50" />    
          </div>
          <?php } else { ?>
          <input name="snumber7" type="text" class="form-control" id="snumber7" value="<?php echo $row_RecordScaleorder['snumber7'] ?>" size="50" maxlength="50" />
          <?php } ?>
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">廠區<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="warehouse" id="warehouse" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇廠區 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWarehouse['name']?>" <?php if (!(strcmp($row_RecordWarehouse['name'], $row_RecordScaleorder['warehouse']))) {echo "selected=\"selected\"";} ?>>[<?php echo $row_RecordWarehouse['code']?>] <?php echo $row_RecordWarehouse['name']; ?></option>
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
        <label class="col-md-2 col-form-label">司機<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="driver" id="driver" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇司機 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordDriver['name']?>" <?php if (!(strcmp($row_RecordDriver['name'], $row_RecordScaleorder['driver']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordDriver['name']; ?></option>
                      <?php
				} while ($row_RecordDriver = mysqli_fetch_assoc($RecordDriver));
				  $rows = mysqli_num_rows($RecordDriver);
				  if($rows > 0) {
					  mysqli_data_seek($RecordDriver, 0);
					  $row_RecordDriver = mysqli_fetch_assoc($RecordDriver);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">車號<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="carnumber" id="carnumber" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇車號 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordCarnumber['name']?>" <?php if (!(strcmp($row_RecordCarnumber['name'], $row_RecordScaleorder['carnumber']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCarnumber['name']?></option>
                      <?php
				} while ($row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber));
				  $rows = mysqli_num_rows($RecordCarnumber);
				  if($rows > 0) {
					  mysqli_data_seek($RecordCarnumber, 0);
					  $row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">送達地點<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="manufacturer" id="manufacturer" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇送達地點 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordManufacturer['name']?>" <?php if (!(strcmp($row_RecordManufacturer['name'], $row_RecordScaleorder['manufacturer']))) {echo "selected=\"selected\"";} ?>>[<?php echo $row_RecordManufacturer['code']?>] <?php echo $row_RecordManufacturer['name']?></option>
                      <?php
				} while ($row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer));
				  $rows = mysqli_num_rows($RecordManufacturer);
				  if($rows > 0) {
					  mysqli_data_seek($RecordManufacturer, 0);
					  $row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出貨時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php echo $row_RecordScaleorder['postdate'] ?>" maxlength="20"  data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">到達時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="arrivals" type="text" class="form-control" id="arrivals" value="<?php echo $row_RecordScaleorder['arrivals'] ?>" maxlength="20"  data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">鎖定<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="當到達時間填入後，將不可新增庫存物料至出貨單，您可以在此設定，強制放單。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" <?php if (!(strcmp($row_RecordScaleorder['indicate'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="indicate_1">鎖定</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" <?php if (!(strcmp($row_RecordScaleorder['indicate'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="indicate_2">不鎖定</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">大地磅品項<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="此出貨單是否包含特殊品項，須另外處理。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input type="radio" name="havebigscale" id="havebigscale_1" value="1" <?php if (!(strcmp($row_RecordScaleorder['havebigscale'],"1"))) {echo "checked=\"checked\"";} ?> />
                <label for="havebigscale_1">含</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="havebigscale" id="havebigscale_2" value="0" <?php if (!(strcmp($row_RecordScaleorder['havebigscale'],"0"))) {echo "checked=\"checked\"";} ?>/>
                <label for="havebigscale_2">不含</label>
            </div>
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
            <input name="oid" type="hidden" id="oid" value="<?php echo $row_RecordScaleorder['oid']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="author" type="hidden" id="author" value="<?php echo $row_RecordAccount['truename'] ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_updata" value="form_Scaleorder" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
$(document).ready(function() {
  $('#postdate, #arrivals').daterangepicker({
    //timePicker: true,
    //startDate: moment().startOf('hour'),
    //endDate: moment().startOf('hour').add(32, 'hour'),
	//singleDatePicker: false,
	//startDate: "<?php $dt = new DateTime(); echo $dt->format('Y-01-01'); ?>",
    //endDate: "2016-11-28",
	singleDatePicker: true,
	showDropdowns: true,
	autoApply: true,
	//showWeekNumbers : false, //是否显示第几周
    timePicker: true,
    timePickerSeconds: true,
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
		 format: 'YYYY-MM-DD HH:mm:ss'
		 //format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
    }
  });
	   
});
</script>

<?php
mysqli_free_result($RecordScale);

mysqli_free_result($RecordWarehouse);

mysqli_free_result($RecordDriver);

mysqli_free_result($RecordCarnumber);
?>
