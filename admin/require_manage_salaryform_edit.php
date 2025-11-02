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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Salaryform")) {
  $updateSQL = sprintf("UPDATE salary_salaryform SET name=%s, type=%s, Amount=%s, taxable=%s, FixedSalary=%s, postdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['Amount'], "text"),
					   GetSQLValueString($_POST['taxable'], "text"),
					   GetSQLValueString($_POST['FixedSalary'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_salaryform.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得最新訊息資料 */
$colname_RecordSalaryform = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSalaryform = $_GET['id_edit'];
}
$coluserid_RecordSalaryform = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSalaryform = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSalaryform = sprintf("SELECT * FROM salary_salaryform WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordSalaryform, "int"),GetSQLValueString($coluserid_RecordSalaryform, "int"));
$RecordSalaryform = mysqli_query($DB_Conn, $query_RecordSalaryform) or die(mysqli_error($DB_Conn));
$row_RecordSalaryform = mysqli_fetch_assoc($RecordSalaryform);
$totalRows_RecordSalaryform = mysqli_num_rows($RecordSalaryform);

$coluserid_RecordPayroll = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPayroll = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPayroll = sprintf("SELECT * FROM salary_payroll WHERE userid=%s",GetSQLValueString($coluserid_RecordPayroll, "int"));
$RecordPayroll = mysqli_query($DB_Conn, $query_RecordPayroll) or die(mysqli_error($DB_Conn));
$row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
$totalRows_RecordPayroll = mysqli_num_rows($RecordPayroll);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 薪資列表 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
        <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="name" id="name" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordSalaryform['name']))) {echo "selected=\"selected\"";} ?>>-- 選擇薪資項目 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordPayroll['title']?>"<?php if (!(strcmp($row_RecordPayroll['title'], $row_RecordSalaryform['name']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordPayroll['title']?></option>
<?php
} while ($row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll));
  $rows = mysqli_num_rows($RecordPayroll);
  if($rows > 0) {
      mysqli_data_seek($RecordPayroll, 0);
	  $row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
  }
?>
                </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">類別<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordSalaryform['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <option value="0" <?php if (!(strcmp(0, $row_RecordSalaryform['type']))) {echo "selected=\"selected\"";} ?>>應領薪資</option>
                  <option value="1" <?php if (!(strcmp(1, $row_RecordSalaryform['type']))) {echo "selected=\"selected\"";} ?>>應扣薪資</option>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">含稅<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="taxable" id="taxable" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordSalaryform['taxable']))) {echo "selected=\"selected\"";} ?>>-- 選擇含稅 --</option>
                  <option value="0" <?php if (!(strcmp(0, $row_RecordSalaryform['taxable']))) {echo "selected=\"selected\"";} ?>>否</option>
                  <option value="1" <?php if (!(strcmp(1, $row_RecordSalaryform['taxable']))) {echo "selected=\"selected\"";} ?>>是</option>
                </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">固定所得<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="FixedSalary" id="FixedSalary" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordSalaryform['FixedSalary']))) {echo "selected=\"selected\"";} ?>>-- 選擇固定所得 --</option>
                  <option value="0" <?php if (!(strcmp(0, $row_RecordSalaryform['FixedSalary']))) {echo "selected=\"selected\"";} ?>>否</option>
                  <option value="1" <?php if (!(strcmp(1, $row_RecordSalaryform['FixedSalary']))) {echo "selected=\"selected\"";} ?>>是</option>
                </select>
                    
 
                   
</div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">金額<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="input-group p-0">

                   <input name="Amount" type="number" class="form-control col-md-4" id="Amount" step="1" value="<?php echo $row_RecordSalaryform['Amount']; ?>" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">元</span></div>
                                      
            </div> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSalaryform['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSalaryform['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordSalaryform['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordSalaryform['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSalaryform['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordSalaryform['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Salaryform" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<?php
mysqli_free_result($RecordSalaryform);
?>
