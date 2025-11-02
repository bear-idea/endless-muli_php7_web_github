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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET inventorycorrection=%s WHERE id=%s",
                       GetSQLValueString($_POST['inventorycorrection'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingOtr, "int"));
$RecordSettingOtr = mysqli_query($DB_Conn, $query_RecordSettingOtr) or die(mysqli_error($DB_Conn));
$row_RecordSettingOtr = mysqli_fetch_assoc($RecordSettingOtr);
$totalRows_RecordSettingOtr = mysqli_num_rows($RecordSettingOtr);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 庫存校正 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>當商品有設置自動停賣功能和有設置庫存量時，刪除訂單後才會加回庫存量，例如原先商品庫存為20件，訂購商品為2件則刪除訂單後會更改商品庫存為22件。<a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=inventory&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 設定庫存</a></b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
         
      <div class="form-group row">
          <label class="col-md-2 col-form-label">庫存校正<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingOtr['inventorycorrection'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="inventorycorrection" id="inventorycorrection_1" value="1" />
                <label for="inventorycorrection_1">開啟</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingOtr['inventorycorrection'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="inventorycorrection" id="inventorycorrection_2" value="0" />
                <label for="inventorycorrection_2">關閉</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingOtr['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSettingOtr);
?>
