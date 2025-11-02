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

$colname_RecordProductReply = "-1";
if (isset($_GET['post_id'])) {
  $colname_RecordProductReply = $_GET['post_id'];
}
$coluserid_RecordProductReply = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductReply = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductReply = sprintf("SELECT * FROM demo_productpost WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProductReply, "int"),GetSQLValueString($coluserid_RecordProductReply, "int"));
$RecordProductReply = mysqli_query($DB_Conn, $query_RecordProductReply) or die(mysqli_error($DB_Conn));
$row_RecordProductReply = mysqli_fetch_assoc($RecordProductReply);
$totalRows_RecordProductReply = mysqli_num_rows($RecordProductReply);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_ProductReply")) {
  $insertSQL = sprintf("INSERT INTO demo_productreply (pid, pdid, content, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['pid'], "int"),
					   GetSQLValueString($_POST['pd_id'], "int"),
                       GetSQLValueString($_POST['content'], "text"),  
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Add'] = "Success";
  $insertGoTo = "inner_product.php?Opt=replypage&lang=" . $_POST['lang'] . "&post_id=" . $_POST['pid'] . "&pd_id=" . $_POST['pd_id'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<!-- fck編輯器 -->
<?php $CKEtoolbar = 'Basic'; ?>

<?php //if ($ManageProductPostEditorSelect == '1' || $ManageProductPostEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php //} ?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 回應紀錄 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
      <div class="form-group row">
          <label class="col-md-2 col-form-label">問題</label>
          <div class="col-md-10">
                      <?php echo $row_RecordProductReply['content']; ?>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">提問者</label>
          <div class="col-md-10">
                      <?php echo $row_RecordProductReply['author']; ?>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control" data-parsley-trigger="blur" required=""></textarea>  
          </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="" size="50" maxlength="50"/>    
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['post_id']; ?>" />
                    <input name="pdname" type="hidden" id="pdname" value="<?php echo $_GET['pdname']; ?>" />
                    <input name="pd_id" type="hidden" id="pd_id" value="<?php echo $_GET['pd_id']; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_ProductReply" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordProductReply);
?>
