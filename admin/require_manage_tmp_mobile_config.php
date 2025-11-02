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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET Mobile_Enable=%s WHERE id=%s",
                       GetSQLValueString($_POST['Mobile_Enable'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfig = "SELECT id, userid, lang, Mobile_Enable FROM demo_setting_fr WHERE userid = $w_userid";
$RecordSystemConfig = mysqli_query($DB_Conn, $query_RecordSystemConfig) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfig = mysqli_fetch_assoc($RecordSystemConfig);
$totalRows_RecordSystemConfig = mysqli_num_rows($RecordSystemConfig);


if ((isset($_POST["MM_Mt_Change"])) && ($_POST["MM_Mt_Change"] == "Mt_Change")) {
	$_SESSION['mt'] = $_POST['Mt_View'];
}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 版型顯示 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-cog"></i> 模式選擇</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" id="form1" name="form1" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">瀏覽外觀<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="網頁外觀顯示方式。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Mobile_Enable'],"1"))) {echo "checked=\"checked\"";} ?>  type="radio" name="Mobile_Enable" id="Mobile_Enable_1" value="1" />
                <label for="Mobile_Enable_1">雙版型顯示 <i class="fa fa-info-circle text-orange" data-original-title="雙版型模式可在桌面裝置及行動裝置分別設置不同外觀。" data-toggle="tooltip" data-placement="top"></i></label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfig['Mobile_Enable'],"0"))) {echo "checked=\"checked\"";} ?>  type="radio" name="Mobile_Enable" id="Mobile_Enable_0" value="0" />
                <label for="Mobile_Enable_0">單版型顯示 <i class="fa fa-info-circle text-orange" data-original-title="單版型模式則僅能設置一種外觀。" data-toggle="tooltip" data-placement="top"></i></label>
            </div>
             
        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
          <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemConfig['id']; ?>" />
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
mysqli_free_result($RecordSystemConfig);
?>
