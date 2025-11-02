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

$coluserid_RecordSalaryform = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSalaryform = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSalaryform = sprintf("SELECT * FROM salary_salaryform WHERE userid=%s",GetSQLValueString($coluserid_RecordSalaryform, "int"));
$RecordSalaryform = mysqli_query($DB_Conn, $query_RecordSalaryform) or die(mysqli_error($DB_Conn));
$row_RecordSalaryform = mysqli_fetch_assoc($RecordSalaryform);
$totalRows_RecordSalaryform = mysqli_num_rows($RecordSalaryform);

$coluserid_RecordSalaryformCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSalaryformCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSalaryformCount = sprintf("SELECT code FROM salary_salaryform WHERE userid=%s GROUP BY code",GetSQLValueString($coluserid_RecordSalaryformCount, "int"));
$RecordSalaryformCount = mysqli_query($DB_Conn, $query_RecordSalaryformCount) or die(mysqli_error($DB_Conn));
$row_RecordSalaryformCount = mysqli_fetch_assoc($RecordSalaryformCount);
$totalRows_RecordSalaryformCount = mysqli_num_rows($RecordSalaryformCount);

$coluserid_RecordStaffCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaffCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaffCount = sprintf("SELECT code FROM salary_staff WHERE userid=%s GROUP BY code",GetSQLValueString($coluserid_RecordStaffCount, "int"));
$RecordStaffCount = mysqli_query($DB_Conn, $query_RecordStaffCount) or die(mysqli_error($DB_Conn));
$row_RecordStaffCount = mysqli_fetch_assoc($RecordStaffCount);
$totalRows_RecordStaffCount = mysqli_num_rows($RecordStaffCount);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Salaryform") && $totalRows_RecordSalaryform > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_salaryform WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_salaryform.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_updata"])) && ($_POST["MM_updata"] == "form_Salaryform") && $totalRows_RecordSalaryform > 0 ) {
	
	$colname_RecordStaff = "-1";
	if (isset($_POST['lang'])) {
	  $colname_RecordStaff = $_POST['lang'];
	}
	$coluserid_RecordStaff = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordStaff = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordStaff, "text"),GetSQLValueString($coluserid_RecordStaff, "int"));
	$RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff) or die(mysqli_error($DB_Conn));
	$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
	$totalRows_RecordStaff = mysqli_num_rows($RecordStaff);
	
	if($totalRows_RecordStaff > 0) {
	
    do 
	{
		
		$colname_RecordSalaryform = "-1";
		if (isset($row_RecordStaff['code'])) {
		  $colname_RecordSalaryform = $row_RecordStaff['code'];
		}
		$coluserid_RecordSalaryform = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordSalaryform = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordSalaryform = sprintf("SELECT * FROM salary_salaryform WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordSalaryform, "int"),GetSQLValueString($coluserid_RecordSalaryform, "int"));
		$RecordSalaryform = mysqli_query($DB_Conn, $query_RecordSalaryform) or die(mysqli_error($DB_Conn));
		$row_RecordSalaryform = mysqli_fetch_assoc($RecordSalaryform);
		$totalRows_RecordSalaryform = mysqli_num_rows($RecordSalaryform);
		
		if($totalRows_RecordSalaryform == 0)
		{
			$colname_RecordPayroll = "-1";
		if (isset($_POST['lang'])) {
		  $colname_RecordPayroll = $_POST['lang'];
		}
		$coluserid_RecordPayroll = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordPayroll = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordPayroll = sprintf("SELECT * FROM salary_payroll WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordPayroll, "text"),GetSQLValueString($coluserid_RecordPayroll, "int"));
		$RecordPayroll = mysqli_query($DB_Conn, $query_RecordPayroll) or die(mysqli_error($DB_Conn));
		$row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
		$totalRows_RecordPayroll = mysqli_num_rows($RecordPayroll);
		
		do{
	
			$insertSQL = sprintf("INSERT INTO salary_salaryform (name, code, type, Amount, taxable, FixedSalary, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($row_RecordPayroll['title'], "text"),
							   GetSQLValueString($row_RecordStaff['code'], "text"),
							   GetSQLValueString($row_RecordPayroll['type'], "text"),
							   GetSQLValueString($row_RecordPayroll['DefaultAmount'], "text"),
							   GetSQLValueString($row_RecordPayroll['taxable'], "text"),
							   GetSQLValueString($row_RecordPayroll['FixedSalary'], "text"),
							   GetSQLValueString(date("Y-m-d"), "date"),
							   GetSQLValueString(1, "int"),
							   GetSQLValueString("", "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  
	  } while ($row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll));
		}
  
   } while ($row_RecordStaff = mysqli_fetch_assoc($RecordStaff));
   
}
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_salaryform.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Salaryform") && $totalRows_RecordSalaryform == 0 ) {
	
	$colname_RecordStaff = "-1";
	if (isset($_POST['lang'])) {
	  $colname_RecordStaff = $_POST['lang'];
	}
	$coluserid_RecordStaff = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordStaff = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordStaff, "text"),GetSQLValueString($coluserid_RecordStaff, "int"));
	$RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff) or die(mysqli_error($DB_Conn));
	$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
	$totalRows_RecordStaff = mysqli_num_rows($RecordStaff);
	
	if($totalRows_RecordStaff > 0) {
	
    do 
	{
		
		$colname_RecordPayroll = "-1";
		if (isset($_POST['lang'])) {
		  $colname_RecordPayroll = $_POST['lang'];
		}
		$coluserid_RecordPayroll = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordPayroll = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordPayroll = sprintf("SELECT * FROM salary_payroll WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordPayroll, "text"),GetSQLValueString($coluserid_RecordPayroll, "int"));
		$RecordPayroll = mysqli_query($DB_Conn, $query_RecordPayroll) or die(mysqli_error($DB_Conn));
		$row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
		$totalRows_RecordPayroll = mysqli_num_rows($RecordPayroll);
		
		do{
	
			$insertSQL = sprintf("INSERT INTO salary_salaryform (name, code, type, Amount, taxable, FixedSalary, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($row_RecordPayroll['title'], "text"),
							   GetSQLValueString($row_RecordStaff['code'], "text"),
							   GetSQLValueString($row_RecordPayroll['type'], "text"),
							   GetSQLValueString($row_RecordPayroll['DefaultAmount'], "text"),
							   GetSQLValueString($row_RecordPayroll['taxable'], "text"),
							   GetSQLValueString($row_RecordPayroll['FixedSalary'], "text"),
							   GetSQLValueString(date("Y-m-d"), "date"),
							   GetSQLValueString(1, "int"),
							   GetSQLValueString("", "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  
	  } while ($row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll));
  
   } while ($row_RecordStaff = mysqli_fetch_assoc($RecordStaff));
   
}
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_salaryform.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageSalaryformEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageSalaryformEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageSalaryformEditorSelect == '1' || $ManageSalaryformEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 薪資列表 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 產生資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <?php if($totalRows_RecordSalaryform == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
     <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>此功能將自動產生基本薪資列表，產生條件為薪資項目中所設定之公用項目 。</b></div>	

      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">產生個人薪資列表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Salaryform" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordSalaryform > 0 && $totalRows_RecordStaffCount == $totalRows_RecordSalaryformCount) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前員工資料筆數<?php echo $totalRows_RecordStaffCount; ?>筆，新資列料表筆數<?php echo $totalRows_RecordSalaryformCount; ?>筆，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Salaryform" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordSalaryform > 0 && $totalRows_RecordStaffCount > $totalRows_RecordSalaryformCount) { ?>
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>目前員工資料筆數<?php echo $totalRows_RecordStaffCount; ?>筆，新資列料表筆數<?php echo $totalRows_RecordSalaryformCount; ?>筆，是否要將新增之<?php echo $totalRows_RecordStaffCount-$totalRows_RecordSalaryformCount; ?>筆員工自動產生薪資列表</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">產生個人薪資列表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_updata" value="form_Salaryform" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
