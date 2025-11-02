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
  $updateSQL = sprintf("UPDATE demo_setting_otr SET freeprice=%s, freepriceignorth=%s, freepriceigcenter=%s, freepriceigsourth=%s, freepriceigeast=%s, freepriceigouter=%s, freepriceignotaiwan=%s, freepriceenable=%s WHERE id=%s",
                       GetSQLValueString($_POST['freeprice'], "int"),
                       GetSQLValueString(isset($_POST['freepriceignorth']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['freepriceigcenter']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['freepriceigsourth']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['freepriceigeast']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['freepriceigouter']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['freepriceignotaiwan']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['freepriceenable'], "int"),
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 滿額免運費 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 基本設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post"> 
      <div class="form-group row">
          <label class="col-md-2 col-form-label">滿額免運費<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="是否要開啟滿額免運費功能。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceenable'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="freepriceenable" id="freepriceenable_1" value="0" />
              <label for="freepriceenable_1">關閉</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceenable'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="freepriceenable" id="freepriceenable_2" value="1" />
              <label for="freepriceenable_2">開啟</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">滿額免運費金額</label>
          <div class="col-md-10">
                      <input name="freeprice" id="freeprice" value="<?php echo $row_RecordSettingOtr['freeprice']; ?>" maxlength="10" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" /><?php if ($OptionCartSelect == '1') {?><small class="f-s-12 text-grey-darker">當購物超過此金額時免運費。</small><?php } ?>
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">滿額免運費忽略地區<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="滿額免運費不適用地區，即一定要運費。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceignorth'],1))) {echo "checked=\"checked\"";} ?> name="freepriceignorth" type="checkbox" id="freepriceignorth" value="1" />
                  <label for="freepriceignorth">北部</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceigcenter'],1))) {echo "checked=\"checked\"";} ?> name="freepriceigcenter" type="checkbox" id="freepriceigcenter" value="1"  />
                  <label for="freepriceigcenter">中部</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceigsourth'],1))) {echo "checked=\"checked\"";} ?> name="freepriceigsourth" type="checkbox" id="freepriceigsourth" value="1"  />
                  <label for="freepriceigsourth">南部</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceigeast'],1))) {echo "checked=\"checked\"";} ?> name="freepriceigeast" type="checkbox" id="freepriceigeast" value="1" />
                  <label for="freepriceigeast">東部</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceigouter'],1))) {echo "checked=\"checked\"";} ?> name="freepriceigouter" type="checkbox" id="freepriceigouter" value="1" />
                  <label for="freepriceigouter">外島</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['freepriceignotaiwan'],1))) {echo "checked=\"checked\"";} ?> name="freepriceignotaiwan" type="checkbox" id="freepriceignotaiwan" value="1" />
                  <label for="freepriceignotaiwan">非台灣地區</label>
              </div>   
              
              <div><small class="f-s-12 text-grey-darker">此項目不包含使用全家或7-11取貨，依所設定之運費價格而定。</small></div>
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
