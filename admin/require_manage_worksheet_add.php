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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Worksheet")) {
  $insertSQL = sprintf("INSERT INTO salary_worksheet (code, title, worktimestart, worktimeend, worktimelate, resttimestart, resttimeend, overtime, overtimeunit, everydayworkhour, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['worktimestart'], "date"),
                       GetSQLValueString($_POST['worktimeend'], "date"),
                       GetSQLValueString($_POST['worktimelate'], "date"),
                       GetSQLValueString($_POST['resttimestart'], "date"),
                       GetSQLValueString($_POST['resttimeend'], "date"),
                       GetSQLValueString($_POST['overtime'], "date"),
                       GetSQLValueString($_POST['overtimeunit'], "text"),
					   GetSQLValueString($_POST['everydayworkhour'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_worksheet.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 日排班表 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>休息時間：指中段休息時間。依勞基法第35條規定：「勞工繼續工作四小時，至少應有30分鐘之休息....」。</b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">班別代號<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="code" type="text" class="form-control" id="code"  maxlength="100" data-parsley-trigger="blur" required="" placeholder="例如：A"/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" id="title" maxlength="200" class="form-control" data-parsley-trigger="blur" required="" placeholder="例如：正常班、跨夜班、夜班"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上班<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="worktimestart" type="text" class="form-control" id="worktimestart" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" placeholder="例如：16:00，為24小時制" required=""/>
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="worktimeend" type="text" class="form-control" id="worktimeend" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" placeholder="例如：16:00，為24小時制" required=""/>
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">遲到<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">超過</span></div>
                   <input name="worktimelate" type="text" class="form-control" id="worktimelate" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" placeholder="例如：16:00，為24小時制，超過此時間須請假，否則以曠職論" required=""/>
                                      
              </div>
                 
          </div>
          
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">休息<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="resttimestart" type="text" class="form-control" id="resttimestart" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" placeholder="例如：16:00，為24小時制" required=""/>
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="resttimeend" type="text" class="form-control" id="resttimestart" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" placeholder="例如：16:00，為24小時制" required=""/>
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">加班</label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">超過</span></div>
                   <input name="overtime" type="text" class="form-control" id="overtime" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/" placeholder="例如：16:00，為24小時制，超過此時間得出勤計入加班，留空則不計加班" />
                                      
              </div>
                 
          </div>
          
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">加班單位<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="overtimeunit" id="overtimeunit" class="form-control" data-parsley-trigger="blur" required="">
                		<option value="0.5">0.5 小時</option>
                		<option value="1">1 小時</option>
				    </select>       
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">每天上班時數<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="everydayworkhour" id="everydayworkhour" class="form-control" data-parsley-trigger="blur" required="">
                        <?php for($i=0.5; $i<=24; $i+=0.5) { ?>
                		<option value="<?php echo $i; ?>" <?php if($i==8) { ?>selected="selected"<?php } ?>><?php echo $i; ?> 小時</option>
                        <?php } ?>
				    </select>       
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
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Worksheet" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		
		$('#worktimestart,#worktimeend,#worktimelate,#resttimestart,#resttimestart,#overtime').datetimepicker({
			format: 'HH:mm',
	    }); 
		
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>
