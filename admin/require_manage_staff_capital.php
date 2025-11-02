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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Staff")) {
  $updateSQL = sprintf("UPDATE salary_staff SET capitaltype=%s, monthprice=%s, dayprice=%s, hourprice=%s, bonusFullattendance=%s, Paytaxes=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['capitaltype'], "text"),
                       GetSQLValueString($_POST['monthprice'], "text"),
                       GetSQLValueString($_POST['dayprice'], "text"),
                       GetSQLValueString($_POST['hourprice'], "text"),
                       GetSQLValueString($_POST['bonusFullattendance'], "text"),
                       GetSQLValueString($_POST['Paytaxes'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_staff.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得最新訊息資料 */
$colname_RecordStaff = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordStaff = $_GET['id_edit'];
}
$coluserid_RecordStaff = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaff = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordStaff, "int"),GetSQLValueString($coluserid_RecordStaff, "int"));
$RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff) or die(mysqli_error($DB_Conn));
$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
$totalRows_RecordStaff = mysqli_num_rows($RecordStaff);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageStaffEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageStaffEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageStaffEditorSelect == '1' || $ManageStaffEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 新資設定 <small>修改</small> 
      <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>年終獎金：依勞基法施行細則第十條：「本公司視當年度營運狀況，於年度終了時得發與員工1.5個月年終獎金，員工服務未滿三3個月者不發與年終獎金；員工服務滿三3個月未滿1年者，年終獎金按實際服務時日依比例遞減發給，計算基準為：月薪 x 1.5個月 / 12個月ｘ實際工作月份，當月未滿一個月者以(30-到職日+1) / 30計算。」。</b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <!--<div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 計薪方式</span></div>
      </div>-->
      <!--<div class="form-group row">
          <label class="col-md-2 col-form-label">計薪條件<span class="text-red">*</span></label>
          <div class="col-md-10">
          
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-default">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordStaff['capitaltype'],"month"))) {echo "checked=\"checked\"";} ?> type="radio" name="capitaltype" id="capitaltype_1" value="month" required="" />
              <label for="capitaltype_1">月薪</label>
                    </div>
                    </span>
                </div>
                
                
                <input name="monthprice" id="monthprice" value="<?php echo $row_RecordStaff['monthprice']; ?>" maxlength="11" class="form-control col-md-4 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
            
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-default">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordStaff['capitaltype'],"day"))) {echo "checked=\"checked\"";} ?> type="radio" name="capitaltype" id="capitaltype_2" value="day" />
              <label for="capitaltype_2">日薪</label>
                    </div>
                    </span>
                </div>
                
                
              <input name="dayprice" id="dayprice" value="<?php echo $row_RecordStaff['dayprice']; ?>" maxlength="11" class="form-control col-md-4 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
            
            <div class="input-group m-b-0">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-default">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordStaff['capitaltype'],"hour"))) {echo "checked=\"checked\"";} ?> type="radio" name="capitaltype" id="capitaltype_3" value="hour" />
              <label for="capitaltype_3">時薪</label>
                    </div>
                    </span>
                </div>
                
                
                <input name="hourprice" id="hourprice" value="<?php echo $row_RecordStaff['hourprice']; ?>" maxlength="11" class="form-control col-md-4 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
             
        </div>
      </div>-->
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 考勤資訊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">打卡卡號</label>
          <div class="col-md-10">
                      <input name="WorkCardNumber" type="text"  class="form-control" id="WorkCardNumber" value="<?php echo $row_RecordStaff['WorkCardNumber']; ?>" maxlength="100" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">加班等級</label>
          <div class="col-md-10">
                 
                    <select name="OvertimeLevel" id="OvertimeLevel" class="form-control" data-parsley-trigger="blur">
                		<option value="" <?php if (!(strcmp(-1, $row_RecordStaff['OvertimeLevel']))) {echo "selected=\"selected\"";} ?>>-- 選擇等級 --</option>
                		<!--<option value="A"<?php if (!(strcmp("A", $row_RecordStaff['OvertimeLevel']))) {echo "selected=\"selected\"";} ?>>A</option>-->
				    </select>     
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 勞保資訊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">勞保卡號</label>
          <div class="col-md-10">
                      <input name="LaborInsuranceCardNumber" type="text"  class="form-control" id="LaborInsuranceCardNumber" value="<?php echo $row_RecordStaff['LaborInsuranceCardNumber']; ?>" maxlength="100" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">投保身分<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordStaff['InsuredIdentity'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="InsuredIdentity" id="InsuredIdentity_1" value="0" />
              <label for="InsuredIdentity_1">受雇者</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordStaff['InsuredIdentity'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="InsuredIdentity" id="InsuredIdentity_2" value="1" />
              <label for="InsuredIdentity_2">雇主</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordStaff['InsuredIdentity'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="InsuredIdentity" id="InsuredIdentity_3" value="2" />
              <label for="InsuredIdentity_3">非本國籍員工</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">勞保投保日期</label>
          <div class="col-md-10">
            <input name="InsuredDate" type="text" class="form-control" id="InsuredDate" value="<?php echo $row_RecordStaff['InsuredDate']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">勞保投保金額</label>
          <div class="col-md-10">
            <div class="input-group m-b-0">
                      <input name="bonusFullattendance" class="form-control col-md-4" id="bonusFullattendance" value="<?php echo $row_RecordStaff['bonusFullattendance']; ?>" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      <div class="input-group-append"><span class="input-group-text">元</span></div>
                      </div>
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 健保資訊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">健保卡號</label>
          <div class="col-md-10">
                      <input name="HealthInsuranceCardNumber" type="text"  class="form-control" id="HealthInsuranceCardNumber" value="<?php echo $row_RecordStaff['HealthInsuranceCardNumber']; ?>" maxlength="100" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">健保投保金額</label>
          <div class="col-md-10">
            <div class="input-group m-b-0">
                      <input name="HealthInsurancePrice" class="form-control col-md-4" id="HealthInsurancePrice" value="<?php echo $row_RecordStaff['HealthInsurancePrice']; ?>" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      <div class="input-group-append"><span class="input-group-text">元</span></div>
                      </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">扶養人數</label>
          <div class="col-md-10">
            <div class="input-group m-b-0">
                      <input name="NumberOfDependents" class="form-control col-md-4" id="NumberOfDependents" value="<?php echo $row_RecordStaff['NumberOfDependents']; ?>" data-parsley-min="0" data-parsley-max="10" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      <div class="input-group-append"><span class="input-group-text">人</span></div>
                      </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">眷口人數</label>
          <div class="col-md-10">
            <div class="input-group m-b-0">
                      <input name="NumberOfMouthfuls" class="form-control col-md-4" id="NumberOfMouthfuls" value="<?php echo $row_RecordStaff['NumberOfMouthfuls']; ?>" data-parsley-min="0" data-parsley-max="10" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      <div class="input-group-append"><span class="input-group-text">人</span></div>
                      </div>
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 銀行資訊</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">撥款銀行</label>
          <div class="col-md-10">
                      <input name="AppropriationBank" type="text"  class="form-control" id="AppropriationBank" value="<?php echo $row_RecordStaff['AppropriationBank']; ?>" maxlength="100" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">銀行帳號</label>
          <div class="col-md-10">
                      <input name="BankAccount" type="text"  class="form-control" id="BankAccount" value="<?php echo $row_RecordStaff['BankAccount']; ?>" maxlength="100" data-parsley-trigger="blur"/>
                      
        </div>
      </div>
      
      <!--<div class="form-group row">
          <label class="col-md-2 col-form-label">全勤獎金</label>
          <div class="col-md-10">
            <div class="input-group m-b-0">
                      <input name="bonusFullattendance" class="form-control col-md-4" id="bonusFullattendance" value="<?php echo $row_RecordStaff['bonusFullattendance']; ?>" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      <div class="input-group-append"><span class="input-group-text">元</span></div>
                      </div>
          </div>
      </div>-->
      
      <!--<div class="form-group row">
          <label class="col-md-2 col-form-label">扣繳稅額</label>
          <div class="col-md-10">
            <div class="input-group m-b-0">
                      <input name="Paytaxes" class="form-control col-md-4" id="Paytaxes" value="<?php echo $row_RecordStaff['Paytaxes']; ?>" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      <div class="input-group-append"><span class="input-group-text">元</span></div>
                      </div>
          </div>
      </div>-->
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordStaff['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordStaff['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Staff" />
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

<script type="text/javascript">
<!--
function CheckFields()
{	
	if($('input[name=capitaltype]:checked').val() == 'month'){
		if($("#monthprice").val() == "")
		{
			alert("需填寫月薪");
			return false;
		}
	}
	
	if($('input[name=capitaltype]:checked').val() == 'day'){
		if($("#dayprice").val() == "")
		{
			alert("需填寫日薪");
			return false;
		}
	}
	
	if($('input[name=capitaltype]:checked').val() == 'hour'){
		if($("#hourprice").val() == "")
		{
			alert("需填寫時薪");
			return false;
		}
	}
}
</script>

<?php
mysqli_free_result($RecordStaff);
?>
