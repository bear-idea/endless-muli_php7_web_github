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
  $updateSQL = sprintf("UPDATE demo_setting_fr SET magic_background=%s, magic_snow_image_enable=%s, magic_snow_image=%s, magic_snow_min=%s, magic_snow_max=%s, magic_snow_count=%s, magic_snow_zindex=%s, magic_firefly=%s, magic_flower=%s WHERE id=%s",
                       GetSQLValueString($_POST['magic_background'], "int"),
                       GetSQLValueString($_POST['magic_snow_image_enable'], "int"),
                       GetSQLValueString($_POST['magic_snow_image'], "text"),
                       GetSQLValueString($_POST['magic_snow_min'], "int"),
                       GetSQLValueString($_POST['magic_snow_max'], "int"),
                       GetSQLValueString($_POST['magic_snow_count'], "int"),
                       GetSQLValueString($_POST['magic_snow_zindex'], "int"),
                       GetSQLValueString($_POST['magic_firefly'], "int"),
                       GetSQLValueString($_POST['magic_flower'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingFr = sprintf("SELECT * FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingFr, "int"));
$RecordSettingFr = mysqli_query($DB_Conn, $query_RecordSettingFr) or die(mysqli_error($DB_Conn));
$row_RecordSettingFr = mysqli_fetch_assoc($RecordSettingFr);
$totalRows_RecordSettingFr = mysqli_num_rows($RecordSettingFr);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingListType = "SELECT * FROM demo_settingitem WHERE list_id = 1";
$RecordSettingListType = mysqli_query($DB_Conn, $query_RecordSettingListType) or die(mysqli_error($DB_Conn));
$row_RecordSettingListType = mysqli_fetch_assoc($RecordSettingListType);
$totalRows_RecordSettingListType = mysqli_num_rows($RecordSettingListType);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 魔法特效 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
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
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form_Tmp" name="form_Tmp">
       
      <div class="form-group row">
        <label class="col-md-2 col-form-label">特效模組<span class="text-red">*</span></label>
          
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['magic_background'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="magic_background" id="magic_background_0" value="0" checked />
                <label for="magic_background_0">不使用</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingFr['magic_background'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="magic_background" id="magic_background_4" value="4" />
                <label for="magic_background_4">飄落特效</label>
            </div>
        </div>
      </div>
       <div class="form-group row">
          <label class="col-md-2 col-form-label">飄落特效圖片<span class="text-red">*</span></label>
          <div class="col-md-10">
          
           
                    
                         <?php for ($i=1; $i<=9; $i++) { ?>
                             <div class="card pull-left m-5">
                                  <img src="images/magic_flower_0<?php echo $i; ?>.jpg" alt="" width="100" height="100" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordSettingFr['magic_flower'],$i-1))) {echo "checked=\"checked\"";} ?> type="radio" name="magic_flower" value="<?php echo $i-1; ?>" id="magic_flower_0<?php echo $i; ?>"  />
                                            <label for="magic_flower_0<?php echo $i; ?>">樣式<?php echo $i; ?></label>
                                      </div>
                                  </div>
                              </div> 
                          <?php } ?>
                          
                          <?php for ($i=10; $i<=15; $i++) { ?>
                             <div class="card pull-left m-5">
                                  <img src="images/magic_flower_<?php echo $i; ?>.jpg" alt="" width="100" height="100" />
                                  <div class="card-block">
                                      <div class="radio radio-css radio-inline">
                                            <input <?php if (!(strcmp($row_RecordSettingFr['magic_flower'],$i-1))) {echo "checked=\"checked\"";} ?> type="radio" name="magic_flower" value="<?php echo $i-1; ?>" id="magic_flower_<?php echo $i; ?>"  />
                                            <label for="magic_flower_<?php echo $i; ?>">樣式<?php echo $i; ?></label>
                                      </div>
                                  </div>
                              </div> 
                          <?php } ?>
                             
                     
                 
             
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

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSettingFr);

mysqli_free_result($RecordSettingListType);
?>
