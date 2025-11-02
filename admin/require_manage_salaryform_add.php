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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Salaryform")) {
  $insertSQL = sprintf("INSERT INTO salary_salaryform (name, code, type, Amount, taxable, FixedSalary, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['name'], "text"),
							   GetSQLValueString($_POST['code'], "text"),
							   GetSQLValueString($_POST['type'], "text"),
							   GetSQLValueString($_POST['Amount'], "text"),
							   GetSQLValueString($_POST['taxable'], "text"),
							   GetSQLValueString($_POST['FixedSalary'], "text"),
							   GetSQLValueString($_POST['postdate'], "date"),
							   GetSQLValueString($_POST['indicate'], "int"),
							   GetSQLValueString($_POST['notes1'], "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_salaryform.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 

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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 薪資列表 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
        <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="name" id="name" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇薪資項目 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordPayroll['title']?>"><?php echo $row_RecordPayroll['title']?></option>
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
                <option value="">-- 選擇類別 --</option>
                <option value="0" selected="selected">應領薪資</option>
                <option value="1">應扣薪資</option>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">含稅<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="taxable" id="taxable" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇含稅 --</option>
                      <option value="0">否</option>
                     <option value="1" selected="selected">是</option>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">固定所得<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="FixedSalary" id="FixedSalary" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" >-- 選擇固定所得 --</option>
                  <option value="0">否</option>
                  <option value="1" selected="selected" >是</option>
                </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">金額<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="此值為預設代入的金額。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="input-group p-0">

                   <input name="Amount" type="number" class="form-control col-md-4" id="Amount" step="1" value="0" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">元</span></div>
                                      
            </div> 
                 
          </div>
      </div>
    
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control date-picker" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
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
            <input name="code" type="hidden" id="code" value="<?php echo $_GET['code']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Salaryform" />
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
