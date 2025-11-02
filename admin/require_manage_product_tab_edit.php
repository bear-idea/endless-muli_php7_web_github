<?php require_once('../Connections/DB_Conn.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Product")) {
  $updateSQL = sprintf("UPDATE demo_product SET content1=%s, content2=%s, content1title=%s, content2title=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['content1'], "text"),
                       GetSQLValueString($_POST['content2'], "text"),
					   GetSQLValueString($_POST['content1title'], "text"),
                       GetSQLValueString($_POST['content2title'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$colname_RecordProduct = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordProduct = $_GET['id_edit'];
}
$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProduct, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageNewsEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageNewsEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageNewsEditorSelect == '1' || $ManageNewsEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content1',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	CKEDITOR.replace( 'content2',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Product']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁籤名稱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="頁籤內容需要填寫資訊才會顯示頁籤分頁，留空則不會顯示，請試需求增加，最多新增二分頁。頁籤會顯示數目會依您是否有填寫頁籤內容而決定。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      <input name="content1title" type="text"  class="form-control" id="content1title" value="<?php echo $row_RecordProduct['content1title']; ?>" maxlength="50" placeholder="Ex:退換貨說明" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁籤內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content1" id="content1" cols="100%" rows="35" class="form-control"><?php echo $row_RecordProduct['content1']; ?></textarea>  
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁籤名稱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="頁籤內容需要填寫資訊才會顯示頁籤分頁，留空則不會顯示，請試需求增加，最多新增二分頁。頁籤會顯示數目會依您是否有填寫頁籤內容而決定。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      <input name="content2title" type="text"  class="form-control" id="content2title" value="<?php echo $row_RecordProduct['content2title']; ?>" maxlength="50" placeholder="Ex:其他注意事項" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁籤內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content2" id="content2" cols="100%" rows="35" class="form-control"><?php echo $row_RecordProduct['content2']; ?></textarea>  
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Product" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordProduct);
?>
