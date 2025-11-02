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

$coluserid_RecordWorksheet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWorksheet = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWorksheet = sprintf("SELECT * FROM salary_worksheet WHERE userid=%s",GetSQLValueString($coluserid_RecordWorksheet, "int"));
$RecordWorksheet = mysqli_query($DB_Conn, $query_RecordWorksheet) or die(mysqli_error($DB_Conn));
$row_RecordWorksheet = mysqli_fetch_assoc($RecordWorksheet);
$totalRows_RecordWorksheet = mysqli_num_rows($RecordWorksheet);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Worksheet") && $totalRows_RecordWorksheet > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_worksheet WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_worksheet.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Worksheet") && $totalRows_RecordWorksheet == 0 ) {
	
  $dt = new DateTime(); $postdate = $dt->format('Y-m-d');
  
  $_POST['code'] = array("A1","B1","B2","B3"); 
  $_POST['title'] = array("正常班","早班","晚班","夜班"); 
  $_POST['worktimestart'] = array("09:00","07:00","15:00","23:00"); 
  $_POST['worktimeend'] = array("17:00","15:00","23:00","07:00"); 
  $_POST['worktimelate'] = array("09:10","07:10","15:10","23:10"); 
  $_POST['resttimestart'] = array("12:00","11:00","19:00","03:00");
  $_POST['resttimeend'] = array("13:00","12:00","20:00","04:00");
  $_POST['overtime'] = array("19:00","","","");
  $_POST['overtimeunit'] = array("0.5","0.5","0.5","0.5");
  $_POST['everydayworkhour'] = array("8","8","8","8");
  
  foreach($_POST['code'] as $key => $val){
	  
	// 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )  
	// ROUND(11100 * 0.1(普保費率)*0.7**30/30) + ROUND(11100 * 0.01(就保費率)*0.7**30/30)
	
    $insertSQL = sprintf("INSERT INTO salary_worksheet (code, title, worktimestart, worktimeend, worktimelate, resttimestart, resttimeend, overtime, overtimeunit, everydayworkhour, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['code'][$key], "text"),
                       GetSQLValueString($_POST['title'][$key], "text"),
                       GetSQLValueString($_POST['worktimestart'][$key], "date"),
                       GetSQLValueString($_POST['worktimeend'][$key], "date"),
                       GetSQLValueString($_POST['worktimelate'][$key], "date"),
                       GetSQLValueString($_POST['resttimestart'][$key], "date"),
                       GetSQLValueString($_POST['resttimeend'][$key], "date"),
                       GetSQLValueString($_POST['overtime'][$key], "date"),
                       GetSQLValueString($_POST['overtimeunit'][$key], "text"),
					   GetSQLValueString($_POST['everydayworkhour'][$key], "text"),
                       GetSQLValueString($postdate, "date"),
                       GetSQLValueString("1", "int"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  }
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_worksheet.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageWorksheetEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageWorksheetEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageWorksheetEditorSelect == '1' || $ManageWorksheetEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 日排班表 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
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
  
<div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>此表會自動產生基本之班表，產生後您可將之再行修改。</b></div>
  
  <?php if($totalRows_RecordWorksheet == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">

      <?php 
	  
	  ?>
      
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">產生資料</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Worksheet" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordWorksheet > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Worksheet" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
