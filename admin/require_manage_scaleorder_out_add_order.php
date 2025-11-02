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
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE userid=%s ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

$coluserid_RecordDriver = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDriver = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDriver = sprintf("SELECT * FROM erp_driver WHERE userid=%s && indicate=1 ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordDriver, "int"));
$RecordDriver = mysqli_query($DB_Conn, $query_RecordDriver) or die(mysqli_error($DB_Conn));
$row_RecordDriver = mysqli_fetch_assoc($RecordDriver);
$totalRows_RecordDriver = mysqli_num_rows($RecordDriver);

$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE userid=%s && indicate=1 ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);

$coluserid_RecordWarehouse = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWarehouse = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWarehouse = sprintf("SELECT * FROM erp_warehouse WHERE userid=%s",GetSQLValueString($coluserid_RecordWarehouse, "int"));
$RecordWarehouse = mysqli_query($DB_Conn, $query_RecordWarehouse) or die(mysqli_error($DB_Conn));
$row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse);
$totalRows_RecordWarehouse = mysqli_num_rows($RecordWarehouse);

///// 日期
$colstartdate_RecordScaleorder = date('Y-m-d');

$dt = new DateTime();
$interval = new DateInterval('P1D');
$dt->add($interval);
$colenddate_RecordScaleorder = $dt->format('Y-m-d');


$coluserid_RecordScaleorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleorder = sprintf("SELECT * FROM erp_scaleorderout WHERE postdate BETWEEN %s AND %s && userid=%s", GetSQLValueString($colstartdate_RecordScaleorder, "date"), GetSQLValueString($colenddate_RecordScaleorder, "date"),GetSQLValueString($coluserid_RecordScaleorder, "int"));
$RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder) or die(mysqli_error($DB_Conn));
$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
$totalRows_RecordScaleorder = mysqli_num_rows($RecordScaleorder);


$coluserid_RecordManufacturer = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturer = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturer = sprintf("SELECT * FROM erp_manufacturer WHERE userid=%s && indicate=1",GetSQLValueString($coluserid_RecordManufacturer, "int"));
$RecordManufacturer = mysqli_query($DB_Conn, $query_RecordManufacturer) or die(mysqli_error($DB_Conn));
$row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
$totalRows_RecordManufacturer = mysqli_num_rows($RecordManufacturer);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Scaleorder_in")) {

  $insertSQL = sprintf("INSERT INTO erp_scaleOrderOut (oserial, driver, carnumber, author, warehouse, manufacturer, havebigscale, postdate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['oserial'], "text"),
                       GetSQLValueString($_POST['driver'], "text"),
					   GetSQLValueString($_POST['carnumber'], "text"),
					   GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['warehouse'], "text"),
					   GetSQLValueString($_POST['manufacturer'], "text"),
					   GetSQLValueString($_POST['havebigscale'], "int"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  
  /* 有物料參數送入 */ 
  
  if($_POST['addscaleorder'] != "") 
  {
	  
	  $addscaleorder_arr = explode(",", $_POST['addscaleorder']);
	  
	  $desc_log_body="";
	  foreach($addscaleorder_arr as $i => $val){
		  
		  
		  // 取得含有此商品id訂單
	  $query_RecordCartlist = sprintf("SELECT * FROM erp_scaleorderindetail WHERE id=%s ORDER BY id DESC",GetSQLValueString($val, "int"));
	  $RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	  $row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	  $totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
	  
	  
	  
		  
		  $updateSQL = sprintf("UPDATE erp_scaleorderindetail SET oserial=%s, bound=%s, state=%s WHERE id =%s",
						   GetSQLValueString($_POST['oserial'], "text"),
						   GetSQLValueString('out', "text"),
						   GetSQLValueString(0, "int"),
						   GetSQLValueString($val, "int"));
	
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		  
		  
		  if($row_RecordCartlist['num'] !="") {
			 	 $desc_log_body .= "【地磅流水號】" . "【" . $row_RecordCartlist['num'] . "】" . "【" .$row_RecordCartlist['title']. "】" . "移入至出庫清單 ";
			  }else{
				  $desc_log_body .= "【" .$row_RecordCartlist['title']. "】" . "移入至出庫清單 ";
			  }
		  
		  
		  
	  }
	  
  }
  
  /* 有物料參數送入 */ 
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_scaleorder_out.php?Opt=viewpage_order&lang=" . $_POST['lang'];
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
	<?php if ($ManageScaleorder_inEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageScaleorder_inEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageScaleorder_inEditorSelect == '1' || $ManageScaleorder_inEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 出庫單號 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>設定出貨單號固定預設抬頭，會顯示於編號之前。 <a href="manage_scaleorder_out.php?wshop=<?php echo $wshop;?>&amp;Opt=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="right"><i class="fa fa-chevron-right"></i> 設定</a></b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出貨單號</label>
          <div class="col-md-10">
              <input name="oserial" type="text" class="form-control" id="oserial" value="<?php echo $row_RecordSystemConfigOtr['erpcompanycode']; ?><?php echo date("YmdHi") . $totalRows_RecordScaleorder+1; ?>" size="50" maxlength="50" data-parsley-trigger="blur" required=""/>    
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">廠區<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="warehouse" id="warehouse" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇廠區 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordWarehouse['name']?>">[<?php echo $row_RecordWarehouse['code']?>] <?php echo $row_RecordWarehouse['name']?></option>
								<?php
				} while ($row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse));
				  $rows = mysqli_num_rows($RecordWarehouse);
				  if($rows > 0) {
					  mysqli_data_seek($RecordWarehouse, 0);
					  $row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">司機<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="driver" id="driver" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇司機 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordDriver['name']?>"><?php echo $row_RecordDriver['name']?></option>
                      <?php
				} while ($row_RecordDriver = mysqli_fetch_assoc($RecordDriver));
				  $rows = mysqli_num_rows($RecordDriver);
				  if($rows > 0) {
					  mysqli_data_seek($RecordDriver, 0);
					  $row_RecordDriver = mysqli_fetch_assoc($RecordDriver);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">車號<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="carnumber" id="carnumber" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇車號 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordCarnumber['name']?>"><?php echo $row_RecordCarnumber['name']?></option>
                      <?php
				} while ($row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber));
				  $rows = mysqli_num_rows($RecordCarnumber);
				  if($rows > 0) {
					  mysqli_data_seek($RecordCarnumber, 0);
					  $row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">送達地點<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="manufacturer" id="manufacturer" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇送達地點 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordManufacturer['name']?>" >[<?php echo $row_RecordManufacturer['code']?>] <?php echo $row_RecordManufacturer['name']?></option>
                      <?php
				} while ($row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer));
				  $rows = mysqli_num_rows($RecordManufacturer);
				  if($rows > 0) {
					  mysqli_data_seek($RecordManufacturer, 0);
					  $row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">大地磅品項 <i class="fa fa-info-circle text-orange" data-original-title="此出貨單是否包含特殊品項，須另外處理。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input type="radio" name="havebigscale" id="havebigscale_1" value="1" checked />
                <label for="havebigscale_1">含</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="havebigscale" id="havebigscale_2" value="0" />
                <label for="havebigscale_2">不含</label>
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
            <input name="author" type="hidden" id="author" value="<?php echo $row_RecordAccount['truename'] ?>" />
            <?php /* 判斷是否有物料參數送入 */ ?>
            <input name="addscaleorder" type="hidden" id="addscaleorder" value="<?php echo implode(",", $_POST['addscaleorder']); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Scaleorder_in" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordScale);

mysqli_free_result($RecordWarehouse);

mysqli_free_result($RecordDriver);

mysqli_free_result($RecordCarnumber);

mysqli_free_result($RecordManufacturer);
?>
