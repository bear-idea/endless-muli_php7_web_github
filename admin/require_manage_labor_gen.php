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

$coluserid_RecordLabor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordLabor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLabor = sprintf("SELECT * FROM salary_labor WHERE userid=%s",GetSQLValueString($coluserid_RecordLabor, "int"));
$RecordLabor = mysqli_query($DB_Conn, $query_RecordLabor) or die(mysqli_error($DB_Conn));
$row_RecordLabor = mysqli_fetch_assoc($RecordLabor);
$totalRows_RecordLabor = mysqli_num_rows($RecordLabor);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Labor") && $totalRows_RecordLabor > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_labor WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_labor.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Labor") && $totalRows_RecordLabor == 0 ) {
	
  foreach($_POST['InsuranceMoney'] as $key => $val){
	  
	// 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )  
	// ROUND(11100 * 0.1(普保費率)*0.7**30/30) + ROUND(11100 * 0.01(就保費率)*0.7**30/30)
	
	$LaborSharing =  round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyBase']*$_POST['PersonBurden']) + round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyJob']*$_POST['PersonBurden']);
	
	$EmployerSharing = round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyBase']*$_POST['CompanyBurden']) + round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyJob']*$_POST['CompanyBurden']);
	
    $insertSQL = sprintf("INSERT INTO salary_labor (type, InsuranceLevel, InsuranceMoney, InsuranceDay, LaborSharing, EmployerSharing, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(0, "int"), /* 本國籍 */
                       GetSQLValueString(($key+1), "text"),
                       GetSQLValueString($_POST['InsuranceMoney'][$key], "text"),
                       GetSQLValueString(30, "text"),
                       GetSQLValueString($LaborSharing, "text"),
                       GetSQLValueString($EmployerSharing, "int"),
                       GetSQLValueString(date('Y-m-d'), "date"),
                       GetSQLValueString(1, "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  }
  
  
  foreach($_POST['InsuranceMoney'] as $key => $val){
	  
	// 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )  
	// ROUND(11100 * 0.1(普保費率)*0.7**30/30) + ROUND(11100 * 0.01(就保費率)*0.7**30/30)
	
	$LaborSharing =  round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyBase']*$_POST['PersonBurden']) + 0;
	
	$EmployerSharing = round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyBase']*$_POST['CompanyBurden']) + 0;
	
    $insertSQL = sprintf("INSERT INTO salary_labor (type, InsuranceLevel, InsuranceMoney, InsuranceDay, LaborSharing, EmployerSharing, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(1, "int"), /* 外國籍 */
                       GetSQLValueString(($key+1), "text"),
                       GetSQLValueString($_POST['InsuranceMoney'][$key], "text"),
                       GetSQLValueString(30, "text"),
                       GetSQLValueString($LaborSharing, "text"),
                       GetSQLValueString($EmployerSharing, "int"),
                       GetSQLValueString(date('Y-m-d'), "date"),
                       GetSQLValueString(1, "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  }
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_labor.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageLaborEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageLaborEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageLaborEditorSelect == '1' || $ManageLaborEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 勞保費表 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>勞保 = 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )																								
</b></div>

<div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>勞保身障補助計算：個人普保*補助比率 (四捨五入)+個人就保*補助比率 (四捨五入)																							
</b></div>

<div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>勞工保險普通事故保險費率自108年1月1日起由9.5％調整為10％，表列保險費金額係依現行勞工保險普通事故保險費率10%，就業保險費率1%，按被保險人負擔20%，投保單位負擔70%之比例計算。																										
</b></div>

<div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>勞保級距及分攤表(108.01.01適用)																										
</b></div>
  
  <?php if($totalRows_RecordLabor == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
  
     <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 勞保</span></div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">普通事故費率<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="InsuranceMoneyBase" id="InsuranceMoneyBase" class="form-control" data-parsley-trigger="blur" required="">
                       <option value="0.095">9.5%</option>
                       <option value="0.1" selected="selected">10%</option>
                       <option value="0.11">11%</option>
                       <option value="0.12">12%</option>
                       <option value="0.13">13%</option>
                       <option value="0.14">14%</option>
                       <option value="0.15">15%</option>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">就業保險費率<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="InsuranceMoneyJob" id="InsuranceMoneyJob" class="form-control" data-parsley-trigger="blur" required="">
                       <option value="0.01" selected="selected">1%</option>
                       <option value="0.011">1.1%</option>
                       <option value="0.012">1.2%</option>
                       <option value="0.013">1.3%</option>
                       <option value="0.014">1.4%</option>
                       <option value="0.015">1.5%</option>
                       <option value="0.016">1.6%</option>
				    </select>
                              
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">機關負擔<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="CompanyBurden" id="CompanyBurden" class="form-control" data-parsley-trigger="blur" required="">
                       <option value="0.1">10%</option>
                       <option value="0.2">20%</option>
                       <option value="0.3">30%</option>
                       <option value="0.4">40%</option>
                       <option value="0.5">50%</option>
                       <option value="0.6">60%</option>
                       <option value="0.7" selected="selected">70%</option>
                       <option value="0.8">80%</option>
                       <option value="0.9">90%</option>
				    </select>
                              
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">個人負擔<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="PersonBurden" id="PersonBurden" class="form-control" data-parsley-trigger="blur" required="">
                       <option value="0.1">10%</option>
                       <option value="0.2" selected="selected">20%</option>
                       <option value="0.3">30%</option>
                       <option value="0.4">40%</option>
                       <option value="0.5">50%</option>
                       <option value="0.6">60%</option>
                       <option value="0.7">70%</option>
                       <option value="0.8">80%</option>
                       <option value="0.9">90%</option>
				    </select>
                              
</div>
      </div>
  
  
  
     <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 級距</span></div>
      </div>
      
      
      <?php $InsuranceMoneyDefaultValue = array("11100","12540","13500","15840","16500","17280","17780","19047","20008","21009","22000","23100","24000","25200","26400","27600","28800","30300","31800","33300","34800","36300","38200","40100","42000","43900","45800"); ?>
      <?php for($i=1; $i<=27; $i++) { ?>
      
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">投保金額<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="input-group p-0">

            <div class="input-group-prepend"><span class="input-group-text">級距<?php if($i<10) { echo "0";}?><?php echo $i; ?></span></div>
                   <input name="InsuranceMoney[]" type="number" class="form-control col-md-4" id="InsuranceMoney[]" step="1" value="<?php echo $InsuranceMoneyDefaultValue[$i-1]; ?>" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">元</span></div>
                                      
            </div> 
                 
          </div>
      </div>
      <?php } ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Labor" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordLabor > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Labor" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
