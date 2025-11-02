<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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
  $updateSQL = sprintf("UPDATE demo_setting_otr SET erpcompanycode=%s, erpcompanyordernum=%s WHERE id=%s",
                       GetSQLValueString($_POST['erpcompanycode'], "text"),
					   GetSQLValueString($_POST['erpcompanyordernum'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 參數 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-cog"></i> 出庫單號設置</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" id="form1" name="form1" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出庫單號抬頭<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="新增出庫單號時預設抬頭，會顯示在編號之前，一般以公司簡寫代表。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
                <input name="erpcompanycode" type="text" class="form-control" id="erpcompanycode" value="<?php echo $row_RecordSettingFr['erpcompanycode']; ?>" size="50" maxlength="50"/>  
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">連單編號抬頭<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="連單編號固定抬頭。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
                <input name="erpcompanyordernum" type="text" class="form-control" id="erpcompanyordernum" value="<?php echo $row_RecordSettingFr['erpcompanyordernum']; ?>" size="50" maxlength="50"/>  
             
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingFr['id']; ?>" />
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
mysqli_free_result($RecordSettingFr);
?>
