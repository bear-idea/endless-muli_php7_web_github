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

$coluserid_RecordAbsence = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAbsence = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAbsence = sprintf("SELECT * FROM salary_absence WHERE userid=%s",GetSQLValueString($coluserid_RecordAbsence, "int"));
$RecordAbsence = mysqli_query($DB_Conn, $query_RecordAbsence) or die(mysqli_error($DB_Conn));
$row_RecordAbsence = mysqli_fetch_assoc($RecordAbsence);
$totalRows_RecordAbsence = mysqli_num_rows($RecordAbsence);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Absence") && $totalRows_RecordAbsence > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_absence WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_absence.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Absence") && $totalRows_RecordAbsence == 0 ) {
	
  foreach($_POST['AbsenceListArrCode'] as $key => $val){
	  
	// 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )  
	// ROUND(11100 * 0.1(普保費率)*0.7**30/30) + ROUND(11100 * 0.01(就保費率)*0.7**30/30)
	
    $insertSQL = sprintf("INSERT INTO salary_absence (code, title, calculate, coefficient, FixedAmount, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['AbsenceListArrCode'][$key], "text"),
					   GetSQLValueString($_POST['AbsenceListArrTitle'][$key], "text"),
                       GetSQLValueString(0, "int"),
                       GetSQLValueString($_POST['AbsenceListArrCoefficient'][$key], "int"),
					   GetSQLValueString(0, "int"),
					   GetSQLValueString(date("Y-m-d"), "date"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString("", "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  }
 
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_absence.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageAbsenceEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageAbsenceEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageAbsenceEditorSelect == '1' || $ManageAbsenceEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 缺勤扣款 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <?php if($totalRows_RecordAbsence == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
     <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>此功能將自動產生缺勤扣款項目。</b></div>	
     
     <?php 
	   $AbsenceListArrCode = array("H001","H002","H003","H004","H005","H006","H007","H008","H009","H010","H011");	
	   $AbsenceListArrTitle = array("遲到早退","事假","病假","曠職","年假","公假","婚假","產假","陪產假","喪假","出差","無薪假");	
	   $AbsenceListArrCoefficient = array("50","0","50","100","0","0","0","0","0","0","0","100");	
	 ?>
     <?php for($i=1; $i<=11; $i++) { ?>
     <div class="form-group row">
          <label class="col-md-2 col-form-label">假別<?php if($i<10) { echo "0";}?><?php echo $i; ?><span class="text-red">*</span></label>
          
          <div class="col-md-3">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">代號</span></div>
                   <input name="AbsenceListArrCode[]" type="text" class="form-control col-md-12" id="AbsenceListArrCode[]"  value="<?php echo $AbsenceListArrCode[$i-1]; ?>" data-parsley-trigger="blur" >
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-3">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                   <input name="AbsenceListArrTitle[]" type="text" class="form-control col-md-12" id="AbsenceListArrTitle[]"  value="<?php echo $AbsenceListArrTitle[$i]; ?>" data-parsley-trigger="blur" >
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-3">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">扣款係數 <i class="fa fa-info-circle" data-original-title="該假別薪資少1/2代表係數為50；該假別無薪資代表係數為100；該假別不扣薪資代表係數為0。" data-toggle="tooltip" data-placement="top"></i></span></div>
                   <input name="AbsenceListArrCoefficient[]" type="number" class="form-control col-md-12" id="AbsenceListArrCoefficient[]" step="1" value="<?php echo $AbsenceListArrCoefficient[$i]; ?>" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">%</span></div>
                                      
            </div> 
                 
          </div>
          
          
      </div>
      <?php } ?>

      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">產生基本缺勤扣款項目</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Absence" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordAbsence > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Absence" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
