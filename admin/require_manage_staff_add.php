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
$colname_RecordStaffListDepartment = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordStaffListDepartment = $_GET['lang'];
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

/* 取得作者列表 */
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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Staff")) {
  $insertSQL = sprintf("INSERT INTO salary_staff (code, department, personid, cardid, name, englishname, sex, nationality, birthplace, marriage, bloodgroup, birthday, mail, tel, cellphone, addr1, addr2, fax, job, EmergencyContact, EmergencyRelation, EmergencyTel1, EmergencyTel2, EmergencyAddr, indicate, arrivaldate, leavedate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['personid'], "text"),
                       GetSQLValueString($_POST['cardid'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['englishname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['nationality'], "text"),
                       GetSQLValueString($_POST['birthplace'], "text"),
                       GetSQLValueString($_POST['marriage'], "text"),
                       GetSQLValueString($_POST['bloodgroup'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['addr2'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['EmergencyContact'], "text"),
                       GetSQLValueString($_POST['EmergencyRelation'], "text"),
                       GetSQLValueString($_POST['EmergencyTel1'], "text"),
                       GetSQLValueString($_POST['EmergencyTel2'], "text"),
                       GetSQLValueString($_POST['EmergencyAddr'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['arrivaldate'], "date"),
                       GetSQLValueString($_POST['leavedate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_staff.php?Opt=viewpage&lang=" . $_POST['lang'];
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 員工名冊 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">員工編號<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="code" type="text" class="form-control" id="code" maxlength="100" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" id="name" maxlength="100" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">英文姓名</label>
          <div class="col-md-10">
          
                      <input name="englishname" type="text" id="englishname" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">婚姻狀況</label>
          <div class="col-md-10">
                 
                    <select name="marriage" id="marriage" class="form-control" data-parsley-trigger="blur">
                		<option value="">-- 選擇婚姻狀況 --</option>
                		<option value="已婚">已婚</option>
                		<option value="未婚">未婚</option>
                		<option value="其他">其他</option>
				    </select>       
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">血型</label>
          <div class="col-md-10">
                 
                    <select name="bloodgroup" id="bloodgroup" class="form-control" data-parsley-trigger="blur">
                		<option value="">-- 選擇血型 --</option>
                		<option value="A">A</option>
                		<option value="B">B</option>
                		<option value="AB">AB</option>
                        <option value="O">O</option>
				    </select>       
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">性別<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input type="radio" name="sex" id="sex_1" value="男" checked />
              <label for="sex_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="sex" id="sex_2" value="女" />
              <label for="sex_2">女</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">身分証字號</label>
          <div class="col-md-10">
          
                      <input name="personid" type="text" class="form-control" id="personid" maxlength="20" data-parsley-trigger="blur" data-parsley-pattern="/^[A-Z]{1}[1-2]{1}[0-9]{8}$/" data-parsley-pattern-message="請輸入正確的身分証字號"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">國籍</label>
          <div class="col-md-10">
          
                      <input name="nationality" type="text" id="nationality" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">籍貫</label>
          <div class="col-md-10">
          
                      <input name="birthplace" type="text" id="birthplace" maxlength="200" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出生日期</label>
          <div class="col-md-10">
            <input name="birthday" type="text" class="form-control" id="birthday" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 聯絡資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
          
                      <input name="tel" type="text" id="tel" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" id="cellphone" maxlength="30" class="form-control" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
          
                      <input name="fax" type="text" id="fax" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件</label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" maxlength="100" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">戶籍地址</label>
          <div class="col-md-10">
          
                      <input name="addr1" type="text" id="addr1" maxlength="200" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連絡地址</label>
          <div class="col-md-10">
          
                      <input name="addr2" type="text" id="addr2" maxlength="200" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 緊急聯絡資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡人</label>
          <div class="col-md-10">
                      <input name="EmergencyContact" type="text" id="EmergencyContact" maxlength="100" class="form-control" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">關係</label>
          <div class="col-md-10">
                      <input name="EmergencyRelation" type="text" id="EmergencyRelation" maxlength="20" class="form-control" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡電話1</label>
          <div class="col-md-10">
                      <input name="EmergencyTel1" type="text" id="EmergencyTel1" maxlength="20" class="form-control" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡電話2</label>
          <div class="col-md-10">
                      <input name="EmergencyTel2" type="text" id="EmergencyTel2" maxlength="20" class="form-control" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">緊急連絡地址</label>
          <div class="col-md-10">
                      <input name="EmergencyAddr" type="text" id="EmergencyAddr" maxlength="200" class="form-control" data-parsley-trigger="blur" />
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他資料</span></div>
      </div>
       <div class="form-group row">
          <label class="col-md-2 col-form-label">刷卡卡號</label>
          <div class="col-md-10">
          
                      <input name="cardid" type="text" class="form-control" id="cardid" maxlength="20" data-parsley-trigger="blur" data-parsley-pattern="/^[A-Za-z0-9]+$/" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">就職日期<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="arrivaldate" type="text" class="form-control" id="arrivaldate" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">離職日期</label>
          <div class="col-md-10">
              <input name="leavedate" type="text" class="form-control" id="leavedate" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" /> 
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">部門<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="department" id="department" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇部門 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordStaffListDepartment['itemname']?>"><?php echo $row_RecordStaffListDepartment['itemname']?></option>
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
        <label class="col-md-2 col-form-label">職稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="job" id="department" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇職稱 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordStaffListJob['itemname']?>"><?php echo $row_RecordStaffListJob['itemname']?></option>
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
      <input type="hidden" name="MM_insert" value="form_Staff" />
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
?>
