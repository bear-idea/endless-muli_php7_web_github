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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_TmpColumn")) {
  $updateSQL = sprintf("UPDATE demo_tmpcolumn SET customname=%s, sortid=%s, indicatewrp=%s, indicatetitle=%s, indicatemiddle=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['customname'], "text"),
                       GetSQLValueString($_POST['sortid'], "int"),
					   GetSQLValueString($_POST['indicatewrp'], "int"),
					   GetSQLValueString($_POST['indicatetitle'], "int"),
					   GetSQLValueString($_POST['indicatemiddle'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_tmp.php?Opt=tmpcolumn&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別列表 */

$colname_RecordTmpColumn = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmpColumn = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmpcolumn WHERE id = %s", GetSQLValueString($colname_RecordTmpColumn, "int"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);
/* 插入資料 */
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $row_RecordTmpColumn['dftname']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本設定</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">自訂標題<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="此名稱您可至 版型設定 > 欄位區塊 > 更多設定 > 區塊標題名稱 畫面中設定是否顯示" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="customname" type="text" class="form-control" id="customname" value="<?php echo $row_RecordTmpColumn['customname']; ?>" maxlength="50" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">排序</label>
          <div class="col-md-10">
                      
                      <input name="sortid" class="form-control" id="sortid" value="<?php echo $row_RecordTmpColumn['sortid']; ?>" maxlength="3" data-parsley-min="0" data-parsley-max="100" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 側邊裝飾外框</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">外框區塊顯示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前此區塊功能是否要套用側邊裝飾外框中的《整體外框》樣式，您可在側邊裝飾外框的新增/修改頁面觀看範例圖和項目。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpColumn['indicatewrp'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatewrp" id="indicatewrp_1" value="1" />
                <label for="indicatewrp_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpColumn['indicatewrp'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatewrp" id="indicatewrp_2" value="0" />
                <label for="indicatewrp_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題區塊顯示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前此區塊功能是否要套用側邊裝飾外框中的《標題部分》樣式，您可在側邊裝飾外框的新增/修改頁面觀看範例圖和項目。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpColumn['indicatetitle'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatetitle" id="indicatetitle_1" value="1" />
                <label for="indicatetitle_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpColumn['indicatetitle'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatetitle" id="indicatetitle_2" value="0" />
                <label for="indicatetitle_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">內容/底部區塊顯示<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="設定目前此區塊功能是否要套用側邊裝飾外框中的《標題部分》樣式，您可在側邊裝飾外框的新增/修改頁面觀看範例圖和項目。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpColumn['indicatemiddle'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatemiddle" id="indicatemiddle_1" value="1" />
                <label for="indicatemiddle_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordTmpColumn['indicatemiddle'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicatemiddle" id="indicatemiddle_2" value="0" />
                <label for="indicatemiddle_2">隱藏</label>
            </div>
             
          </div>
      </div>
      
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
             <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
             <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_TmpColumn" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordTmpColumn);
?>
