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
  
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Employees")) {
	
  if($_POST['WorkingTimeFrom'] < $_POST['LunchBreakFrom'] && $_POST['WorkingTimeTo'] > $_POST['LunchBreakTo'] && $_POST['WorkingTimeFrom'] < $_POST['WorkingTimeTo'] && $_POST['LunchBreakFrom'] < $_POST['LunchBreakTo'])
  {
	
	  $updateSQL = sprintf("UPDATE demo_employeesworktime SET WorkingTimeFrom=%s, WorkingTimeTo=%s, LunchBreakFrom=%s, LunchBreakTo=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
						   GetSQLValueString($_POST['WorkingTimeFrom'], "date"),
						   GetSQLValueString($_POST['WorkingTimeTo'], "date"),
						   GetSQLValueString($_POST['LunchBreakFrom'], "date"),
						   GetSQLValueString($_POST['LunchBreakTo'], "date"),
						   GetSQLValueString($_POST['indicate'], "int"),
						   GetSQLValueString($_POST['notes1'], "text"),
						   GetSQLValueString($_POST['lang'], "text"),
						   GetSQLValueString($_POST['id'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  
	  $_SESSION['DB_Add'] = "Success";
	 
	  $updateGoTo = "inner_employees.php?Opt=worktimeviewpage&lang=" . $_POST['lang'] . "&aid=" . $_POST['aid'];
	  /*if (isset($_SERVER['QUERY_STRING'])) {
		$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
		$updateGoTo .= $_SERVER['QUERY_STRING'];
	  }*/
	  header(sprintf("Location: %s", $updateGoTo));
  
  }else{
	  echo("<script type=\"text/javascript\">");
	  echo("swal({ title: \"休息時間需介於在上班時間之內!!\", text: \"\", type: \"warning\",buttonsStyling: false,confirmButtonText: \"確認\",confirmButtonClass: \"btn btn-primary m-5\"});");
      echo("</script>");
  }
} 

$colid_RecordEmployees = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordEmployees = $_GET['id_edit'];
}

$colaid_RecordEmployees = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordEmployees = $_GET['aid'];
}

$coluserid_RecordEmployees = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployees = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployees = sprintf("SELECT * FROM demo_employeesworktime WHERE id = %s && userid=%s && aid=%s", GetSQLValueString($colid_RecordEmployees, "int"),GetSQLValueString($coluserid_RecordEmployees, "int"),GetSQLValueString($colaid_RecordEmployees, "int"));
$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);
			
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-2 col-form-label">日期<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="day" id="day" class="form-control selectpicker" data-parsley-trigger="blur" data-live-search="true" required="" disabled="disabled">
								<option value="Monday" <?php if (!(strcmp('Monday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期一</option>
                                <option value="Tuesday" <?php if (!(strcmp('Tuesday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期二</option>
                                <option value="Wednesday" <?php if (!(strcmp('Wednesday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期三</option>
                                <option value="Thursday" <?php if (!(strcmp('Thursday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期四</option>
                                <option value="Friday" <?php if (!(strcmp('Friday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期五</option>
                                <option value="Saturday" <?php if (!(strcmp('Saturday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期六</option>
                                <option value="Sunday" <?php if (!(strcmp('Sunday', $row_RecordEmployees['day']))) {echo "selected=\"selected\"";} ?>>星期日</option>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上班<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="WorkingTimeFrom" type="text" required="" class="form-control" id="WorkingTimeFrom" placeholder="例如：16:00，為24小時制" value="<?php echo $row_RecordEmployees['WorkingTimeFrom']; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="WorkingTimeTo" type="text" required="" class="form-control" id="WorkingTimeTo" placeholder="例如：16:00，為24小時制" value="<?php echo $row_RecordEmployees['WorkingTimeTo']; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">休息<span class="text-red">*</span></label>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">開始</span></div>
                   <input name="LunchBreakFrom" type="text" required="" class="form-control" id="LunchBreakFrom" placeholder="例如：16:00，為24小時制" value="<?php echo $row_RecordEmployees['LunchBreakFrom']; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">

              <div class="input-group-prepend"><span class="input-group-text">結束</span></div>
                   <input name="LunchBreakTo" type="text" required="" class="form-control" id="LunchBreakTo" placeholder="例如：16:00，為24小時制" value="<?php echo $row_RecordEmployees['LunchBreakTo']; ?>" maxlength="10" data-parsley-trigger="blur" data-parsley-pattern="/^(0\d{1}|1\d{1}|2[0-3]):([0-5]\d{1})$/"/>
                                      
              </div>
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
           <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordEmployees['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">上班日</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordEmployees['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">休假日</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordEmployees['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Employees" />
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
