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
  $updateSQL = sprintf("UPDATE salary_staff SET code=%s, name=%s, englishname=%s, marriage=%s, bloodgroup=%s, sex=%s, personid=%s, cardid=%s, nationality=%s, birthplace=%s, birthday=%s, tel=%s, cellphone=%s, fax=%s, job=%s, mail=%s, addr1=%s, addr2=%s, department=%s, EmergencyContact=%s, EmergencyRelation=%s, EmergencyTel1=%s, EmergencyTel2=%s, EmergencyAddr=%s, arrivaldate=%s, leavedate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['code'], "text"),
					   GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['englishname'], "text"),
					   GetSQLValueString($_POST['marriage'], "text"),
					   GetSQLValueString($_POST['bloodgroup'], "text"),
					   GetSQLValueString($_POST['sex'], "text"),
					   GetSQLValueString($_POST['personid'], "text"),
					   GetSQLValueString($_POST['cardid'], "text"),
					   GetSQLValueString($_POST['nationality'], "text"),
					   GetSQLValueString($_POST['birthplace'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
					   GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
					   GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
					   GetSQLValueString($_POST['addr1'], "text"),
					   GetSQLValueString($_POST['addr2'], "text"),
					   GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['EmergencyContact'], "text"),
					   GetSQLValueString($_POST['EmergencyRelation'], "text"),
					   GetSQLValueString($_POST['EmergencyTel1'], "text"),
					   GetSQLValueString($_POST['EmergencyTel2'], "text"),
					   GetSQLValueString($_POST['EmergencyAddr'], "text"),
					   GetSQLValueString($_POST['arrivaldate'], "date"),
					   GetSQLValueString($_POST['leavedate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
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

/* 取得類別資料 */
$colname_RecordStaffListDepartment = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordStaffListDepartment = $_GET["lang"];
}
$coluserid_RecordStaffListDepartment = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaffListDepartment = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaffListDepartment = sprintf("SELECT * FROM salary_staffitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordStaffListDepartment, "text"),GetSQLValueString($coluserid_RecordStaffListDepartment, "int"));
$RecordStaffListDepartment = mysqli_query($DB_Conn, $query_RecordStaffListDepartment) or die(mysqli_error($DB_Conn));
$row_RecordStaffListDepartment = mysqli_fetch_assoc($RecordStaffListDepartment);
$totalRows_RecordStaffListDepartment = mysqli_num_rows($RecordStaffListDepartment);

/* 取得作者資料 */
$colname_RecordStaffListJob = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordStaffListJob = $_GET['lang'];
}
$coluserid_RecordStaffListJob = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaffListJob = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaffListJob = sprintf("SELECT * FROM salary_staffitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordStaffListJob, "text"),GetSQLValueString($coluserid_RecordStaffListJob, "int"));
$RecordStaffListJob = mysqli_query($DB_Conn, $query_RecordStaffListJob) or die(mysqli_error($DB_Conn));
$row_RecordStaffListJob = mysqli_fetch_assoc($RecordStaffListJob);
$totalRows_RecordStaffListJob = mysqli_num_rows($RecordStaffListJob);

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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 員工名冊 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
                      <input name="code" type="text"  class="form-control" id="code" value="<?php echo $row_RecordStaff['code']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $row_RecordStaff['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">英文姓名</label>
          <div class="col-md-10">
                      
                      <input name="englishname" type="text" class="form-control" id="englishname" value="<?php echo $row_RecordStaff['englishname']; ?>" maxlength="200" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">婚姻狀況</label>
          <div class="col-md-10">
                 
                    <select name="marriage" id="marriage" class="form-control" data-parsley-trigger="blur">
                		<option value="" <?php if (!(strcmp(-1, $row_RecordStaff['marriage']))) {echo "selected=\"selected\"";} ?>>-- 選擇婚姻狀況 --</option>
                		<option value="已婚"<?php if (!(strcmp("已婚", $row_RecordStaff['marriage']))) {echo "selected=\"selected\"";} ?>>已婚</option>
                		<option value="未婚"<?php if (!(strcmp("未婚", $row_RecordStaff['marriage']))) {echo "selected=\"selected\"";} ?>>未婚</option>
                		<option value="其他"<?php if (!(strcmp("其他", $row_RecordStaff['marriage']))) {echo "selected=\"selected\"";} ?>>其他</option>
				    </select>     
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">血型</label>
          <div class="col-md-10">
                 
                    <select name="bloodgroup" id="bloodgroup" class="form-control" data-parsley-trigger="blur">
                		<option value="" <?php if (!(strcmp(-1, $row_RecordStaff['bloodgroup']))) {echo "selected=\"selected\"";} ?>>-- 選擇血型 --</option>
                		<option value="A"<?php if (!(strcmp("A", $row_RecordStaff['bloodgroup']))) {echo "selected=\"selected\"";} ?>>A</option>
                		<option value="B"<?php if (!(strcmp("B", $row_RecordStaff['bloodgroup']))) {echo "selected=\"selected\"";} ?>>B</option>
                		<option value="AB"<?php if (!(strcmp("AB", $row_RecordStaff['bloodgroup']))) {echo "selected=\"selected\"";} ?>>AB</option>
                        <option value="O"<?php if (!(strcmp("O", $row_RecordStaff['bloodgroup']))) {echo "selected=\"selected\"";} ?>>O</option>
				    </select>     
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">性別<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordStaff['sex'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" id="sex_1" value="男" />
              <label for="sex_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordStaff['sex'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" id="sex_2" value="女" />
              <label for="sex_2">女</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">身分証字號</label>
          <div class="col-md-10">
          
                      <input name="personid" type="text" class="form-control" id="personid" value="<?php echo $row_RecordStaff['personid']; ?>" maxlength="20" data-parsley-trigger="blur" data-parsley-pattern="/^[A-Z]{1}[1-2]{1}[0-9]{8}$/" data-parsley-pattern-message="請輸入正確的身分証字號"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">國籍</label>
          <div class="col-md-10">
          
                      <input name="nationality" type="text" class="form-control" id="nationality" value="<?php echo $row_RecordStaff['nationality']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">籍貫</label>
          <div class="col-md-10">
          
                      <input name="birthplace" type="text" class="form-control" id="birthplace" value="<?php echo $row_RecordStaff['birthplace']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出生日期</label>
          <div class="col-md-10">
            <input name="birthday" type="text" class="form-control" id="birthday" value="<?php echo $row_RecordStaff['birthday']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 聯絡資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
          
                      <input name="tel" type="text" class="form-control" id="tel" value="<?php echo $row_RecordStaff['tel']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" class="form-control" id="cellphone" value="<?php echo $row_RecordStaff['cellphone']; ?>" maxlength="30" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
          
                      <input name="fax" type="text" class="form-control" id="fax" value="<?php echo $row_RecordStaff['fax']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件</label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" value="<?php echo $row_RecordStaff['mail']; ?>" maxlength="100" data-parsley-trigger="blur"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">戶籍地址</label>
          <div class="col-md-10">
          
                      <input name="addr1" type="text" class="form-control" id="addr1" value="<?php echo $row_RecordStaff['addr1']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連絡地址</label>
          <div class="col-md-10">
          
                      <input name="addr2" type="text" class="form-control" id="addr2" value="<?php echo $row_RecordStaff['addr1']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 緊急聯絡資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡人</label>
          <div class="col-md-10">
                      <input name="EmergencyContact" type="text" class="form-control" id="EmergencyContact" value="<?php echo $row_RecordStaff['EmergencyContact']; ?>" maxlength="100" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關係</label>
          <div class="col-md-10">
                      <input name="EmergencyRelation" type="text" class="form-control" id="EmergencyRelation" value="<?php echo $row_RecordStaff['EmergencyRelation']; ?>" maxlength="20" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡電話1</label>
          <div class="col-md-10">
                      <input name="EmergencyTel1" type="text" class="form-control" id="EmergencyTel1" value="<?php echo $row_RecordStaff['EmergencyTel1']; ?>" maxlength="20" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡電話2</label>
          <div class="col-md-10">
                      <input name="EmergencyTel2" type="text" class="form-control" id="EmergencyTel2" value="<?php echo $row_RecordStaff['EmergencyTel2']; ?>" maxlength="20" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡地址</label>
          <div class="col-md-10">
                      <input name="EmergencyAddr" type="text" class="form-control" id="EmergencyAddr" value="<?php echo $row_RecordStaff['EmergencyAddr']; ?>" maxlength="200" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">刷卡卡號</label>
          <div class="col-md-10">
          
                      <input name="cardid" type="text" class="form-control" id="cardid" value="<?php echo $row_RecordStaff['cardid']; ?>" maxlength="20" data-parsley-trigger="blur" data-parsley-pattern="/^[A-Za-z0-9]+$/" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">就職日期<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="arrivaldate" type="text" class="form-control" id="arrivaldate" value="<?php $dt = new DateTime($row_RecordStaff['arrivaldate']); if($row_RecordStaff['arrivaldate'] != "") { echo $dt->format('Y-m-d'); } ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" autocomplete="off" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">離職日期</label>
          <div class="col-md-10">
              <input name="leavedate" type="text" class="form-control" id="leavedate" value="<?php $dt = new DateTime($row_RecordStaff['leavedate']); if($row_RecordStaff['leavedate'] != "") {echo $dt->format('Y-m-d'); } ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">部門<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="department" id="department" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordStaff['department']))) {echo "selected=\"selected\"";} ?>>-- 選擇部門 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordStaffListDepartment['itemname']?>"<?php if (!(strcmp($row_RecordStaffListDepartment['itemname'], $row_RecordStaff['department']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordStaffListDepartment['itemname']?></option>
                  <?php
} while ($row_RecordStaffListDepartment = mysqli_fetch_assoc($RecordStaffListDepartment));
  $rows = mysqli_num_rows($RecordStaffListDepartment);
  if($rows > 0) {
      mysqli_data_seek($RecordStaffListDepartment, 0);
	  $row_RecordStaffListDepartment = mysqli_fetch_assoc($RecordStaffListDepartment);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">職稱<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="job" id="job" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordStaff['job']))) {echo "selected=\"selected\"";} ?>>-- 選擇職稱 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordStaffListJob['itemname']?>"<?php if (!(strcmp($row_RecordStaffListJob['itemname'], $row_RecordStaff['job']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordStaffListJob['itemname']?></option>
                  <?php
} while ($row_RecordStaffListJob = mysqli_fetch_assoc($RecordStaffListJob));
  $rows = mysqli_num_rows($RecordStaffListJob);
  if($rows > 0) {
      mysqli_data_seek($RecordStaffListJob, 0);
	  $row_RecordStaffListJob = mysqli_fetch_assoc($RecordStaffListJob);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordStaff['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordStaff['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordStaff['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
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

<?php
mysqli_free_result($RecordStaffListDepartment);

mysqli_free_result($RecordStaffListJob);

mysqli_free_result($RecordStaff);
?>
