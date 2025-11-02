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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Searchdata")) {
  $updateSQL = sprintf("UPDATE mail_searchdata SET title=%s, type=%s, mail=%s, link=%s, postdate=%s, indicate=%s, sdescription=%s, skeyword=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
					   GetSQLValueString($_POST['link'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_searchdata.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordSearchdataListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordSearchdataListType = $_GET["lang"];
}
$coluserid_RecordSearchdataListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdataListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSearchdataListType = sprintf("SELECT * FROM mail_searchdataitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordSearchdataListType, "text"),GetSQLValueString($coluserid_RecordSearchdataListType, "int"));
$RecordSearchdataListType = mysqli_query($DB_Conn, $query_RecordSearchdataListType) or die(mysqli_error($DB_Conn));
$row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
$totalRows_RecordSearchdataListType = mysqli_num_rows($RecordSearchdataListType);

/* 取得最新訊息資料 */
$colname_RecordSearchdata = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSearchdata = $_GET['id_edit'];
}
$coluserid_RecordSearchdata = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdata = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSearchdata = sprintf("SELECT * FROM mail_searchdata WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordSearchdata, "int"),GetSQLValueString($coluserid_RecordSearchdata, "int"));
$RecordSearchdata = mysqli_query($DB_Conn, $query_RecordSearchdata) or die(mysqli_error($DB_Conn));
$row_RecordSearchdata = mysqli_fetch_assoc($RecordSearchdata);
$totalRows_RecordSearchdata = mysqli_num_rows($RecordSearchdata);
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
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordSearchdata['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordSearchdata['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordSearchdataListType['item_id']?>"<?php if (!(strcmp($row_RecordSearchdataListType['item_id'], $row_RecordSearchdata['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordSearchdataListType['itemname']?></option>
                  <?php
} while ($row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType));
  $rows = mysqli_num_rows($RecordSearchdataListType);
  if($rows > 0) {
      mysqli_data_seek($RecordSearchdataListType, 0);
	  $row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSearchdata['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSearchdata['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label> 
          <div class="col-md-10">
              <input name="mail" type="email" required="" class="form-control" id="mail" value="<?php echo $row_RecordSearchdata['mail']; ?>" maxlength="100" data-parsley-trigger="blur"/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網頁</label>
          <div class="col-md-10">
          
                      <input name="link" type="url" class="form-control" id="link" value="<?php echo $row_RecordSearchdata['link']; ?>" maxlength="300" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordSearchdata['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordSearchdata['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordSearchdata['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordSearchdata['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSearchdata['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordSearchdata['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Searchdata" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordSearchdataListType);

mysqli_free_result($RecordSearchdata);
?>
