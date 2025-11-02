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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Scaleorder_source")) {
	
	/* 解析 title */
	list($pdname, $pdcode) = explode('_', $_POST['title']);
	
   $updateSQL = sprintf("UPDATE erp_scaleordersourcedetail SET title=%s, code=%s, num=%s, author=%s, warehouse=%s, Totalweight=%s, Minweight=%s, Oriweight=%s, carnumber=%s, postdate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($pdname, "text"),
					   GetSQLValueString($pdcode, "text"),
					   GetSQLValueString($_POST['num'], "text"),
					   GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['warehouse'], "text"),
                       GetSQLValueString($_POST['Totalweight'], "text"),
                       GetSQLValueString($_POST['Minweight'], "text"),
					   GetSQLValueString($_POST['Totalweight']-$_POST['Minweight'], "text"),
					   GetSQLValueString($_POST['carnumber'], "text"),
						GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_scaleorder_source.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scalesource WHERE userid=%s ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

$coluserid_RecordWarehouse = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWarehouse = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWarehouse = sprintf("SELECT * FROM erp_warehouse WHERE userid=%s",GetSQLValueString($coluserid_RecordWarehouse, "int"));
$RecordWarehouse = mysqli_query($DB_Conn, $query_RecordWarehouse) or die(mysqli_error($DB_Conn));
$row_RecordWarehouse = mysqli_fetch_assoc($RecordWarehouse);
$totalRows_RecordWarehouse = mysqli_num_rows($RecordWarehouse);

$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE userid=%s",GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);

$colname_RecordScaleorder = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordScaleorder = $_GET['id_edit'];
}
$coluserid_RecordScaleorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleorder = sprintf("SELECT * FROM erp_scaleordersourcedetail WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordScaleorder, "int"),GetSQLValueString($coluserid_RecordScaleorder, "int"));
$RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder) or die(mysqli_error($DB_Conn));
$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
$totalRows_RecordScaleorder = mysqli_num_rows($RecordScaleorder);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageScaleorder_sourceEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageScaleorder_sourceEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageScaleorder_sourceEditorSelect == '1' || $ManageScaleorder_sourceEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 貨源庫存 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label ">倉庫</label>
          <div class="col-md-10">
              <select name="warehouse" id="warehouse" class="form-control" data-parsley-trigger="blur" required="">
                        <option value="-1" <?php if (!(strcmp(-1, $row_RecordScaleorder['warehouse']))) {echo "selected=\"selected\"";} ?>>-- 選擇倉庫 --</option>
                        <?php
				do {  
				?>
                        <option value="<?php echo $row_RecordWarehouse['name']?>" <?php if (!(strcmp($row_RecordWarehouse['name'], $row_RecordScaleorder['warehouse']))) {echo "selected=\"selected\"";} ?>>[<?php echo $row_RecordWarehouse['code']?>] <?php echo $row_RecordWarehouse['name']; ?></option>
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
          <label class="col-md-2 col-form-label ">商品</label>
          <div class="col-md-10">
              <select name="title" id="title" class="form-control" data-parsley-trigger="blur" required="">
                <option value="-1" <?php if (!(strcmp(-1, $row_RecordScaleorder['title']))) {echo "selected=\"selected\"";} ?>>-- 選擇商品 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordScale['name']?>_<?php echo $row_RecordScale['code']?>" <?php if (!(strcmp($row_RecordScale['name'], $row_RecordScaleorder['title']))) {echo "selected=\"selected\"";} ?>>[<?php echo $row_RecordScale['code']?>] <?php echo $row_RecordScale['name']?></option>
                      <?php
				} while ($row_RecordScale = mysqli_fetch_assoc($RecordScale));
				  $rows = mysqli_num_rows($RecordScale);
				  if($rows > 0) {
					  mysqli_data_seek($RecordScale, 0);
					  $row_RecordScale = mysqli_fetch_assoc($RecordScale);
				  }
				?>
                    </select>
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連單號碼</label>
          <div class="col-md-10">
                      <input name="num" type="text" class="form-control" id="num" value="<?php echo $row_RecordScaleorder['num'] ?>" maxlength="200" data-parsley-trigger="blur" />
                      
        </div>
      </div>
	  
	  <div class="form-group row">
        <label class="col-md-2 col-form-label">車號<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="carnumber" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇車號 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordCarnumber['name']?>" <?php if (!(strcmp($row_RecordCarnumber['name'], $row_RecordScaleorder['carnumber']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCarnumber['name']?></option>
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
          <label class="col-md-2 col-form-label">總重<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="Totalweight" type="number" required="" class="form-control" id="Totalweight" step="0.1" value="<?php echo $row_RecordScaleorder['Totalweight'] ?>" maxlength="20" data-parsley-min="0" data-parsley-type="number" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">扣重<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="Minweight" type="number" required="" class="form-control" id="Minweight" step="0.1" value="<?php echo $row_RecordScaleorder['Minweight'] ?>" maxlength="20" data-parsley-min="0" data-parsley-type="number" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php echo $row_RecordScaleorder['postdate'] ?>" maxlength="20" data-provide="datetimepicker" data-date-format="yyyy-mm-dd h:i:s" data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordScaleorder_source['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordScaleorder['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="author" type="hidden" id="author" value="<?php echo $row_RecordAccount['truename'] ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Scaleorder_source" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordScale);

mysqli_free_result($RecordWarehouse);
?>

