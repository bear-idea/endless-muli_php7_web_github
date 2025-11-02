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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Bulletin") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Bulletin")) {
  $updateSQL = sprintf("UPDATE demo_bulletin SET title=%s, link=%s, sdescription=%s, indicate=%s, postdate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString(htmlspecialchars($_POST['title']), "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString(htmlspecialchars($_POST['sdescription']), "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_bulletin.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得最新訊息資料 */
$colname_RecordBulletin = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordBulletin = $_GET['id_edit'];
}
$coluserid_RecordBulletin = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBulletin = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBulletin = sprintf("SELECT * FROM demo_bulletin WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordBulletin, "int"),GetSQLValueString($coluserid_RecordBulletin, "int"));
$RecordBulletin = mysqli_query($DB_Conn, $query_RecordBulletin) or die(mysqli_error($DB_Conn));
$row_RecordBulletin = mysqli_fetch_assoc($RecordBulletin);
$totalRows_RecordBulletin = mysqli_num_rows($RecordBulletin);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageBulletinEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageBulletinEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageBulletinEditorSelect == '1' || $ManageBulletinEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName_Bulletin; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordBulletin['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">      
          <a href="uplod_bulletin.php?id_edit=<?php echo $row_RecordBulletin['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordBulletin['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordBulletin['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordBulletin['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網址</label>
          <div class="col-md-10">
          
                      <input name="link" class="form-control" id="link" placeholder="http://www.yoururl.com" pattern= "/^(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?$/i" value="<?php echo $row_RecordBulletin['link']; ?>" maxlength="200" data-parsley-type="url" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordBulletin['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordBulletin['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordBulletin['lang']; ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Bulletin" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordBulletin);
?>
