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
  
  
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Employees")) {
	
  if($_POST['WorkingTimeFrom'] < $_POST['LunchBreakFrom'] && $_POST['WorkingTimeTo'] > $_POST['LunchBreakTo'] && $_POST['WorkingTimeFrom'] < $_POST['WorkingTimeTo'] && $_POST['LunchBreakFrom'] < $_POST['LunchBreakTo'])
  {
	
	  for($i=0; $i<count($_POST['day']); $i++) {
		  
		    $colname_RecordEmployees = "-1";
			if (isset($_POST['day'][$i])) {
			  $colname_RecordEmployees = $_POST['day'][$i];
			}
			$coluserid_RecordEmployees = "-1";
			if (isset($w_userid)) {
			  $coluserid_RecordEmployees = $w_userid;
			}
			$colaid_RecordEmployees = "-1";
			if (isset($_POST['aid'])) {
			  $colaid_RecordEmployees = $_POST['aid'];
			}
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordEmployees = sprintf("SELECT * FROM demo_employeesworktime WHERE day = %s && userid=%s && aid=%s", GetSQLValueString($colname_RecordEmployees, "text"),GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($colaid_RecordEmployees, "int"));
			$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
			$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
			$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);

          if($totalRows_RecordEmployees == 0) {
			  $insertSQL = sprintf("INSERT INTO demo_employeesworktime (day, WorkingTimeFrom, WorkingTimeTo, LunchBreakFrom, LunchBreakTo, postdate, indicate, notes1, lang, aid, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
								   GetSQLValueString($_POST['day'][$i], "text"),
								   GetSQLValueString($_POST['WorkingTimeFrom'], "date"),
								   GetSQLValueString($_POST['WorkingTimeTo'], "date"),
								   GetSQLValueString($_POST['LunchBreakFrom'], "date"),
								   GetSQLValueString($_POST['LunchBreakTo'], "date"),
								   GetSQLValueString($_POST['postdate'], "date"),
								   GetSQLValueString($_POST['indicate'], "int"),
								   GetSQLValueString($_POST['notes1'], "text"),
								   GetSQLValueString($_POST['lang'], "text"),
								   GetSQLValueString($_POST['aid'], "int"),
								   GetSQLValueString($_POST['userid'], "int"));
			
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
		  }
	  }
	  
	  $_SESSION['DB_Add'] = "Success";
	 
	  $insertGoTo = "inner_employees.php?Opt=worktimeviewpage&lang=" . $_POST['lang'] . "&aid=" . $_POST['aid'];
	  /*if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }*/
	  header(sprintf("Location: %s", $insertGoTo));
  
  }else{
	  echo("<script type=\"text/javascript\">");
	  echo("swal({ title: \"休息時間需介於在上班時間之內!!\", text: \"\", type: \"warning\",buttonsStyling: false,confirmButtonText: \"確認\",confirmButtonClass: \"btn btn-primary m-5\"});");
      echo("</script>");
  }
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 基本排班 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="inner_employees.php?wshop=<?php echo $wshop; ?>&amp;Opt=worktimeviewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>您可以一次選擇多個日期做新增,但若該日期已新增過則不會再新增。</b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-2 col-form-label">日期<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day[]" id="day[]" class="form-control selectpicker" data-parsley-trigger="blur" multiple="multiple" data-live-search="true" required="">
								<option value="Monday">星期一</option>
                                <option value="Tuesday">星期二</option>
                                <option value="Wednesday">星期三</option>
                                <option value="Thursday">星期四</option>
                                <option value="Friday">星期五</option>
                                <option value="Saturday">星期六</option>
                                <option value="Sunday">星期日</option>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上班<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="WorkingTimeFrom" type="text" required="" class="form-control" id="WorkingTimeFrom" placeholder="例如：16:00，為24小時制" value="08:00" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="WorkingTimeTo" type="text" required="" class="form-control" id="WorkingTimeTo" placeholder="例如：16:00，為24小時制" value="17:00" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">休息<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="LunchBreakFrom" type="text" required="" class="form-control" id="LunchBreakFrom" placeholder="例如：16:00，為24小時制" value="12:00" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="LunchBreakTo" type="text" required="" class="form-control" id="LunchBreakTo" placeholder="例如：16:00，為24小時制" value="13:00" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">上班日</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">休假日</label>
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
            <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Employees" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		
		$('#WorkingTimeFrom,#WorkingTimeTo,#LunchBreakFrom,#LunchBreakTo').datetimepicker({
			format: 'HH:mm',
	    }); 
		
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
		
	});
</script>
