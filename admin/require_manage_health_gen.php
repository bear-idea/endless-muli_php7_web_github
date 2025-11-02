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

$coluserid_RecordHealth = "-1";
if (isset($w_userid)) {
  $coluserid_RecordHealth = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordHealth = sprintf("SELECT * FROM salary_health WHERE userid=%s",GetSQLValueString($coluserid_RecordHealth, "int"));
$RecordHealth = mysqli_query($DB_Conn, $query_RecordHealth) or die(mysqli_error($DB_Conn));
$row_RecordHealth = mysqli_fetch_assoc($RecordHealth);
$totalRows_RecordHealth = mysqli_num_rows($RecordHealth);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Health") && $totalRows_RecordHealth > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_health WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_health.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Health") && $totalRows_RecordHealth == 0 ) {
	
  foreach($_POST['InsuranceMoney'] as $key => $val){
	  
	// 普保(級距*費率*投保天數*負擔比例 )+就保(級距*費率*投保天數*負擔比例 )  
	// ROUND(11100 * 0.1(普保費率)*0.7**30/30) + ROUND(11100 * 0.01(就保費率)*0.7**30/30)
	
	$HealthSharing =  round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyBase']*$_POST['PersonBurden']);
	
	$EmployerSharing = round($_POST['InsuranceMoney'][$key]*$_POST['InsuranceMoneyBase']*$_POST['CompanyBurden']*1.61);
	
    $insertSQL = sprintf("INSERT INTO salary_health (type, InsuranceLevel, InsuranceMoney, HealthSharingAdd1, HealthSharingAdd2, HealthSharingAdd3, HealthSharing, EmployerSharing, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(0, "int"), /* 本國籍 */
                       GetSQLValueString(($key+1), "text"),
                       GetSQLValueString($_POST['InsuranceMoney'][$key], "text"),
                       GetSQLValueString($HealthSharing*2, "text"),
					   GetSQLValueString($HealthSharing*3, "text"),
					   GetSQLValueString($HealthSharing*4, "text"),
                       GetSQLValueString($HealthSharing, "text"),
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
 
  $insertGoTo = "manage_health.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageHealthEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageHealthEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageHealthEditorSelect == '1' || $ManageHealthEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 健保費表 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>健保 = 級距*費率*負擔比例 (機關加*1.61平均眷口人數)</b></div>

<div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>健保身障補助計算：個人健保費*補助比率 (無條件進位)																										
</b></div>

<div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>健保級距及分攤表(108.01.01適用)																										
</b></div>
  
  <?php if($totalRows_RecordHealth == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
  
     <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 健保</span></div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">費率<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="InsuranceMoneyBase" id="InsuranceMoneyBase" class="form-control" data-parsley-trigger="blur" required="">
                    
                       <option value="0.0469">4.69%</option>
                       
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
                       <option value="0.6" selected="selected">60%</option>
                       <option value="0.7">70%</option>
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
                       <option value="0.2">20%</option>
                       <option value="0.3" selected="selected">30%</option>
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
      
      
      <?php $InsuranceMoneyDefaultValue = array("23100","24000","25200","26400","27600","28800","30300","31800","33300","34800","36300","38200","40100","42000","43900","45800","48200","50600","53000","55400","57800","60800","63800","66800","69800","72800","76500","80200","83900","87600","92100","96600","101100","105600","110100","115500","120900","126300","131700","137100","142500","147900","150000","156400","162800","169200","175600"); ?>
      <?php for($i=1; $i<=47; $i++) { ?>
      
      
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
      <input type="hidden" name="MM_insert" value="form_Health" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordHealth > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Health" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
