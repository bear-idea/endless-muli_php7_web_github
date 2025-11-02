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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Yearend")) {
  $updateSQL = sprintf("UPDATE salary_yearend SET code=%s, name=%s, job=%s, arrivaldate=%s, leavedate=%s, FuneralDay=%s, LeaveDay=%s, SickDay=%s, LetterDay=%s, TotalRestHour=%s, Assessment=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['arrivaldate'], "date"),
                       GetSQLValueString($_POST['leavedate'], "date"),
                       GetSQLValueString($_POST['FuneralDay'], "text"),
                       GetSQLValueString($_POST['LeaveDay'], "text"),
                       GetSQLValueString($_POST['SickDay'], "text"),
                       GetSQLValueString($_POST['LetterDay'], "text"),
                       GetSQLValueString($_POST['TotalRestHour'], "text"),
                       GetSQLValueString($_POST['Assessment'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_yearend.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得作者資料 */
$colname_RecordYearendListJob = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordYearendListJob = $_GET['lang'];
}
$coluserid_RecordYearendListJob = "-1";
if (isset($w_userid)) {
  $coluserid_RecordYearendListJob = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordYearendListJob = sprintf("SELECT * FROM salary_staffitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordYearendListJob, "text"),GetSQLValueString($coluserid_RecordYearendListJob, "int"));
$RecordYearendListJob = mysqli_query($DB_Conn, $query_RecordYearendListJob) or die(mysqli_error($DB_Conn));
$row_RecordYearendListJob = mysqli_fetch_assoc($RecordYearendListJob);
$totalRows_RecordYearendListJob = mysqli_num_rows($RecordYearendListJob);

/* 取得最新訊息資料 */
$colname_RecordYearend = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordYearend = $_GET['id_edit'];
}
$coluserid_RecordYearend = "-1";
if (isset($w_userid)) {
  $coluserid_RecordYearend = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordYearend = sprintf("SELECT * FROM salary_yearend WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordYearend, "int"),GetSQLValueString($coluserid_RecordYearend, "int"));
$RecordYearend = mysqli_query($DB_Conn, $query_RecordYearend) or die(mysqli_error($DB_Conn));
$row_RecordYearend = mysqli_fetch_assoc($RecordYearend);
$totalRows_RecordYearend = mysqli_num_rows($RecordYearend);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageYearendEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageYearendEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageYearendEditorSelect == '1' || $ManageYearendEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 年終獎金 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">員工編號<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="code" type="text" required=""  class="form-control" id="code" value="<?php echo $row_RecordYearend['code']; ?>" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $row_RecordYearend['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">職稱<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="job" id="job" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordYearend['job']))) {echo "selected=\"selected\"";} ?>>-- 選擇職稱 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordYearendListJob['itemname']?>"<?php if (!(strcmp($row_RecordYearendListJob['itemname'], $row_RecordYearend['job']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordYearendListJob['itemname']?></option>
                  <?php
} while ($row_RecordYearendListJob = mysqli_fetch_assoc($RecordYearendListJob));
  $rows = mysqli_num_rows($RecordYearendListJob);
  if($rows > 0) {
      mysqli_data_seek($RecordYearendListJob, 0);
	  $row_RecordYearendListJob = mysqli_fetch_assoc($RecordYearendListJob);
  }
?>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">就職日期<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="arrivaldate" type="text" required="" class="form-control" id="arrivaldate" autocomplete="off" value="<?php $dt = new DateTime($row_RecordYearend['arrivaldate']); if($row_RecordYearend['arrivaldate'] != "") { echo $dt->format('Y-m-d'); } ?>" maxlength="10" readonly="readonly" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">離職日期</label>
          <div class="col-md-10">
              <input name="leavedate" type="text" class="form-control" id="leavedate" autocomplete="off" value="<?php $dt = new DateTime($row_RecordYearend['leavedate']); if($row_RecordYearend['leavedate'] != "") {echo $dt->format('Y-m-d'); } ?>" maxlength="10" readonly="readonly" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur"/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">公殤</label>
          <div class="col-md-10">
                      <input name="FuneralDay" id="FuneralDay" value="<?php echo $row_RecordYearend['FuneralDay']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">事假</label>
          <div class="col-md-10">
                      <input name="LeaveDay" id="LeaveDay" value="<?php echo $row_RecordYearend['LeaveDay']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">病假</label>
          <div class="col-md-10">
                      <input name="SickDay" id="SickDay" value="<?php echo $row_RecordYearend['SickDay']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">遲到早退</label>
          <div class="col-md-10">
                      <input name="LetterDay" id="LetterDay" value="<?php echo $row_RecordYearend['LetterDay']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">總休息(H)</label>
          <div class="col-md-10">
                      <input name="TotalRestHour" id="TotalRestHour" value="<?php echo $row_RecordYearend['TotalRestHour']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">主管考核</label>
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordYearend['Assessment'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="Assessment" id="Assessment_1" value="1" />
                <label for="Assessment_1">已審核</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordYearend['Assessment'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="Assessment" id="Assessment_2" value="0" />
                <label for="Assessment_2">未審核</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordYearend['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordYearend['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordYearend['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordYearend['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordYearend['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Yearend" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate,#arrivaldate,#leavedate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<?php
mysqli_free_result($RecordYearendListJob);

mysqli_free_result($RecordYearend);
?>
