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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Catalog")) {
  $updateSQL = sprintf("UPDATE demo_catalog SET title=%s, author=%s, type=%s, sdescription=%s, postdate=%s, indicate=%s, auth=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['sdescription'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['auth'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_catalog.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */
$colname_RecordCatalogListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCatalogListType = $_GET['lang'];
}
$coluserid_RecordCatalogListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCatalogListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogListType = sprintf("SELECT * FROM demo_catalogitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCatalogListType, "text"),GetSQLValueString($coluserid_RecordCatalogListType, "int"));
$RecordCatalogListType = mysqli_query($DB_Conn, $query_RecordCatalogListType) or die(mysqli_error($DB_Conn));
$row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType);
$totalRows_RecordCatalogListType = mysqli_num_rows($RecordCatalogListType);

/* 取得贊助企業資料 */
$colname_RecordCatalog = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordCatalog = $_GET['id_edit'];
}
$coluserid_RecordCatalog = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCatalog = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalog = sprintf("SELECT * FROM demo_catalog WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordCatalog, "int"),GetSQLValueString($coluserid_RecordCatalog, "int"));
$RecordCatalog = mysqli_query($DB_Conn, $query_RecordCatalog) or die(mysqli_error($DB_Conn));
$row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog);
$totalRows_RecordCatalog = mysqli_num_rows($RecordCatalog);

$colname_RecordCatalogListAuthor = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCatalogListAuthor = $_GET['lang'];
}
$coluserid_RecordCatalogListAuthor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCatalogListAuthor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogListAuthor = sprintf("SELECT * FROM demo_catalogitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCatalogListAuthor, "text"),GetSQLValueString($coluserid_RecordCatalogListAuthor, "int"));
$RecordCatalogListAuthor = mysqli_query($DB_Conn, $query_RecordCatalogListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordCatalogListAuthor = mysqli_fetch_assoc($RecordCatalogListAuthor);
$totalRows_RecordCatalogListAuthor = mysqli_num_rows($RecordCatalogListAuthor);

?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Catalog']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" required="" class="form-control" id="title" value="<?php echo $row_RecordCatalog['title']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordCatalog['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordCatalogListType['itemname']?>"<?php if (!(strcmp($row_RecordCatalogListType['itemname'], $row_RecordCatalog['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCatalogListType['itemname']?></option>
                  <?php
} while ($row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType));
  $rows = mysqli_num_rows($RecordCatalogListType);
  if($rows > 0) {
      mysqli_data_seek($RecordCatalogListType, 0);
	  $row_RecordCatalogListType = mysqli_fetch_assoc($RecordCatalogListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">發佈者<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="author" id="author" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordCatalog['author']))) {echo "selected=\"selected\"";} ?>>-- 選擇發佈者 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordCatalogListAuthor['itemname']?>"<?php if (!(strcmp($row_RecordCatalogListAuthor['itemname'], $row_RecordCatalog['author']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCatalogListAuthor['itemname']?></option>
<?php
} while ($row_RecordCatalogListAuthor = mysqli_fetch_assoc($RecordCatalogListAuthor));
  $rows = mysqli_num_rows($RecordCatalogListAuthor);
  if($rows > 0) {
      mysqli_data_seek($RecordCatalogListAuthor, 0);
	  $row_RecordCatalogListAuthor = mysqli_fetch_assoc($RecordCatalogListAuthor);
  }
?>
                </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">檔案<span class="text-red">*</span></label>
          <div class="col-md-10">
                 <a href="uplod_catalog.php?id_edit=<?php echo $row_RecordCatalog['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 檔案修改</a>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">限制<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="此項目須搭配經銷專區模組，特定權限用戶才可下載。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCatalog['auth'],"0"))) {echo "checked=\"checked\"";} ?> name="auth" type="radio" id="auth_2" value="0" />
                <label for="auth_2">無</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordCatalog['auth'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="auth" id="auth_1" value="1" <?php if ($OptionDealerSelect != '1') { ?>disabled="disabled"<?php } ?> />
                <label for="auth_1">僅經銷商</label>
            </div>
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCatalog['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCatalog['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述</label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordCatalog['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordCatalog['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordCatalog['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="menutype" type="hidden" id="menutype" value="file" /></td>
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Catalog" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordCatalogListType);

mysqli_free_result($RecordCatalogListAuthor);

mysqli_free_result($RecordCatalog);
?>
