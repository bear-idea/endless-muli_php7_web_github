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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Nationalmail")) {
  $updateSQL = sprintf("UPDATE mail_nationalmail SET title=%s, type=%s, postdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
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

  $updateGoTo = "manage_nationalmail.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordNationalmailListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordNationalmailListType = $_GET["lang"];
}
$coluserid_RecordNationalmailListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNationalmailListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNationalmailListType = sprintf("SELECT * FROM mail_nationalmailitem WHERE list_id = 1 && lang=%s && (userid=%s || userid=1)", GetSQLValueString($colname_RecordNationalmailListType, "text"),GetSQLValueString($coluserid_RecordNationalmailListType, "int"));
$RecordNationalmailListType = mysqli_query($DB_Conn, $query_RecordNationalmailListType) or die(mysqli_error($DB_Conn));
$row_RecordNationalmailListType = mysqli_fetch_assoc($RecordNationalmailListType);
$totalRows_RecordNationalmailListType = mysqli_num_rows($RecordNationalmailListType);

/* 取得最新訊息資料 */
$colname_RecordNationalmail = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordNationalmail = $_GET['id_edit'];
}
$coluserid_RecordNationalmail = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNationalmail = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNationalmail = sprintf("SELECT * FROM mail_nationalmail WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordNationalmail, "int"),GetSQLValueString($coluserid_RecordNationalmail, "int"));
$RecordNationalmail = mysqli_query($DB_Conn, $query_RecordNationalmail) or die(mysqli_error($DB_Conn));
$row_RecordNationalmail = mysqli_fetch_assoc($RecordNationalmail);
$totalRows_RecordNationalmail = mysqli_num_rows($RecordNationalmail);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Mail搜尋 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">電子郵件後綴名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="type" class="form-control" id="title" value="<?php echo $row_RecordNationalmail['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordNationalmail['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordNationalmailListType['itemvalue']?>"<?php if (!(strcmp($row_RecordNationalmailListType['itemvalue'], $row_RecordNationalmail['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordNationalmailListType['itemname']?> / <?php echo $row_RecordNationalmailListType['itemvalue']?> / <?php echo $row_RecordNationalmailListType['fullname']?></option>
                  <?php
} while ($row_RecordNationalmailListType = mysqli_fetch_assoc($RecordNationalmailListType));
  $rows = mysqli_num_rows($RecordNationalmailListType);
  if($rows > 0) {
      mysqli_data_seek($RecordNationalmailListType, 0);
	  $row_RecordNationalmailListType = mysqli_fetch_assoc($RecordNationalmailListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordNationalmail['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordNationalmail['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordNationalmail['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordNationalmail['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordNationalmail['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordNationalmail['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Nationalmail" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordNationalmailListType);

mysqli_free_result($RecordNationalmail);
?>
