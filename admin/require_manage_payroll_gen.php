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

$coluserid_RecordPayroll = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPayroll = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPayroll = sprintf("SELECT * FROM salary_payroll WHERE userid=%s",GetSQLValueString($coluserid_RecordPayroll, "int"));
$RecordPayroll = mysqli_query($DB_Conn, $query_RecordPayroll) or die(mysqli_error($DB_Conn));
$row_RecordPayroll = mysqli_fetch_assoc($RecordPayroll);
$totalRows_RecordPayroll = mysqli_num_rows($RecordPayroll);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Payroll") && $totalRows_RecordPayroll > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_payroll WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_payroll.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Payroll") && $totalRows_RecordPayroll == 0 ) {
	
  foreach($_POST['title'] as $key => $val){
	  
	// 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )  
	// ROUND(11100 * 0.1(普保費率)*0.7**30/30) + ROUND(11100 * 0.01(就保費率)*0.7**30/30)
	
	if($_POST['enable'][$key] == 1 && $_POST['title'][$key] != "") {
	
    $insertSQL = sprintf("INSERT INTO salary_payroll (title, type, taxable, FixedSalary, PublicProject, DefaultAmount, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'][$key], "text"),
					   GetSQLValueString($_POST['type'][$key], "text"),
                       GetSQLValueString($_POST['taxable'][$key], "text"),
                       GetSQLValueString($_POST['FixedSalary'][$key], "text"),
					   GetSQLValueString($_POST['PublicProject'][$key], "text"),
					   GetSQLValueString($_POST['DefaultAmount'][$key], "text"),
					   GetSQLValueString(date("Y-m-d"), "date"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString("", "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  }
  
  }
 
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_payroll.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManagePayrollEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManagePayrollEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManagePayrollEditorSelect == '1' || $ManagePayrollEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 薪資項目 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <?php if($totalRows_RecordPayroll == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
     <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>此功能將自動產生基本薪資項目。</b></div>	
     
     <?php 
	   $title = array("本薪","全勤獎金","責任津貼","作業獎金","證照津貼","伙食費(午)","伙食費(晚)","補假","油資補貼","交通津貼","公司宿舍","借支","其他津貼");	
	   $type = array("0","0","0","0","0","0","0","0","0","0","1","1","0");	
	   $taxable = array("1","1","1","1","1","1","1","1","1","1","1","1","1");	
	   $FixedSalary = array("1","1","1","1","1","1","1","1","1","1","1","1","1");
	   $PublicProject = array("1","1","1","1","1","1","1","1","0","0","0","1","1");
	   $DefaultAmount = array("25000","1000","1000","1000","1000","1000","1000","1000","1000","1000","1000","1000","1000");	
	   $enable = array("1","1","1","1","1","1","1","1","0","0","0","1","1");	
	 ?>
     <?php for($i=1; $i<=13; $i++) { ?>
     <div class="form-group row">

          <div class="col-md-2">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                   <input name="title[]" type="text" class="form-control col-md-12" id="title[]"  value="<?php echo $title[$i-1]; ?>" data-parsley-trigger="blur" >
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-1">
          <div class="input-group p-0">

            <!--<div class="input-group-prepend"><span class="input-group-text">類別</span></div>-->
                   <select name="type[]" id="type[]" class="form-control" data-parsley-trigger="blur">
                    <option value="0" <?php if (!(strcmp(0, $type[$i-1]))) {echo "selected=\"selected\"";} ?>>應領薪資</option>
                    <option value="1" <?php if (!(strcmp(1, $type[$i-1]))) {echo "selected=\"selected\"";} ?>>應扣薪資</option>
				    </select>
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-1">
          <div class="input-group p-0">

           <!-- <div class="input-group-prepend"><span class="input-group-text">含稅</span></div>-->
                   <select name="taxable[]" id="taxable[]" class="form-control" data-parsley-trigger="blur" >
                      <option value="0" <?php if (!(strcmp(0, $taxable[$i-1]))) {echo "selected=\"selected\"";} ?>>不含稅</option>
                     <option value="1" <?php if (!(strcmp(1, $taxable[$i-1]))) {echo "selected=\"selected\"";} ?>>含稅</option>
                    </select>
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-2">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">固定所得</span></div>
                   <select name="FixedSalary[]" id="FixedSalary[]" class="form-control" data-parsley-trigger="blur" >
                  <option value="0" <?php if (!(strcmp(0, $FixedSalary[$i-1]))) {echo "selected=\"selected\"";} ?>>否</option>
                  <option value="1" <?php if (!(strcmp(1, $FixedSalary[$i-1]))) {echo "selected=\"selected\"";} ?>>是</option>
                </select>
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-2">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">公用項目</span></div>
                   <select name="PublicProject[]" id="PublicProject[]" class="form-control" data-parsley-trigger="blur" >
                  <option value="0" <?php if (!(strcmp(0, $PublicProject[$i-1]))) {echo "selected=\"selected\"";} ?>>否</option>
                  <option value="1" <?php if (!(strcmp(1, $PublicProject[$i-1]))) {echo "selected=\"selected\"";} ?>>是</option>
                </select>
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-2">
          <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">預設金額</span></div>
                   <input name="DefaultAmount[]" type="number" class="form-control col-md-12" id="DefaultAmount[]" step="1" value="<?php echo $DefaultAmount[$i-1]; ?>" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">元</span></div>
                                      
            </div> 
                 
          </div>
          
          <div class="col-md-2">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">是否產生</span></div>
                   <select name="enable[]" id="enable[]" class="form-control" data-parsley-trigger="blur" >
                      <option value="0" <?php if (!(strcmp(0, $enable[$i-1]))) {echo "selected=\"selected\"";} ?>>否</option>
                     <option value="1" <?php if (!(strcmp(1, $enable[$i-1]))) {echo "selected=\"selected\"";} ?>>是</option>
                    </select>
                                      
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
      <input type="hidden" name="MM_insert" value="form_Payroll" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordPayroll > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Payroll" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
