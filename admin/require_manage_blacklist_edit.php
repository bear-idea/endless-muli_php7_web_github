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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Blacklist")) {
  $updateSQL = sprintf("UPDATE mail_blacklist SET title=%s, type=%s, postdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_blacklist.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordBlacklistListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordBlacklistListType = $_GET["lang"];
}
$coluserid_RecordBlacklistListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBlacklistListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlacklistListType = sprintf("SELECT * FROM mail_blacklistitem WHERE list_id = 1 && lang=%s && (userid=%s || userid=1)", GetSQLValueString($colname_RecordBlacklistListType, "text"),GetSQLValueString($coluserid_RecordBlacklistListType, "int"));
$RecordBlacklistListType = mysqli_query($DB_Conn, $query_RecordBlacklistListType) or die(mysqli_error($DB_Conn));
$row_RecordBlacklistListType = mysqli_fetch_assoc($RecordBlacklistListType);
$totalRows_RecordBlacklistListType = mysqli_num_rows($RecordBlacklistListType);

/* 取得最新訊息資料 */
$colname_RecordBlacklist = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordBlacklist = $_GET['id_edit'];
}
$coluserid_RecordBlacklist = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBlacklist = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlacklist = sprintf("SELECT * FROM mail_blacklist WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordBlacklist, "int"),GetSQLValueString($coluserid_RecordBlacklist, "int"));
$RecordBlacklist = mysqli_query($DB_Conn, $query_RecordBlacklist) or die(mysqli_error($DB_Conn));
$row_RecordBlacklist = mysqli_fetch_assoc($RecordBlacklist);
$totalRows_RecordBlacklist = mysqli_num_rows($RecordBlacklist);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 黑名單 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="email" class="form-control" id="title" value="<?php echo $row_RecordBlacklist['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordBlacklist['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordBlacklistListType['itemvalue']?>"<?php if (!(strcmp($row_RecordBlacklistListType['itemname'], $row_RecordBlacklist['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordBlacklistListType['itemname']?></option>
                  <?php
} while ($row_RecordBlacklistListType = mysqli_fetch_assoc($RecordBlacklistListType));
  $rows = mysqli_num_rows($RecordBlacklistListType);
  if($rows > 0) {
      mysqli_data_seek($RecordBlacklistListType, 0);
	  $row_RecordBlacklistListType = mysqli_fetch_assoc($RecordBlacklistListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordBlacklist['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordBlacklist['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordBlacklist['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordBlacklist['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordBlacklist['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordBlacklist['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Blacklist" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordBlacklistListType);

mysqli_free_result($RecordBlacklist);
?>
