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
  $updateSQL = sprintf("UPDATE demo_setting_fr SET GoogleMapAPICode1=%s, GoogleMapAPITime1=%s, GoogleMapAPICode2=%s WHERE id=%s",
                       GetSQLValueString($_POST['GoogleMapAPICode1'], "text"),
                       GetSQLValueString($_POST['GoogleMapAPITime1'], "int"),
                       GetSQLValueString($_POST['GoogleMapAPICode2'], "text"),
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
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Google Map API <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-key"></i> 金鑰設置</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" id="form1" name="form1" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">預設<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="使用 Google Map 所需要的金鑰，每一個應用程式專案有一定的配額限制(25,000次/天)，若是使用量太大以致於超出配額，就必須要付費另外購買配額。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
                      
                      <input name="GoogleMapAPICode1" type="text" class="form-control" id="GoogleMapAPICode1" value="<?php echo $row_RecordSettingFr['GoogleMapAPICode1']; ?>" maxlength="100" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備用<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="由於每天的地圖載入(Pageview)次數限制為25,000次/天(免費)，超過需收費，因此您可輸入一個備用金鑰作切換。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
                      
                      <input name="GoogleMapAPICode2" type="text" class="form-control" id="GoogleMapAPICode2" value="<?php echo $row_RecordSettingFr['GoogleMapAPICode2']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">每日切換時間點<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="當有設置備用API時，在此時間會更換成備用 API。" data-toggle="tooltip" data-placement="top"></i></label> 
          <div class="col-md-10">
              <select name="GoogleMapAPITime1" id="GoogleMapAPITime1" class="form-control" data-parsley-trigger="blur" required="">
				<?php for($i=12; $i<22; $i++) { ?>
                  <option value="<?php echo $i ?>" <?php if (!(strcmp($i, $row_RecordSettingFr['GoogleMapAPITime1']))) {echo "selected=\"selected\"";} ?>><?php echo $i ?>:00 PM</option>
                <?php } ?>
              </select> 
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

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-book"></i> 申請及說明</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" id="form1" name="form1" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Google 說明網址</label>                       	
          <div class="col-md-10"><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" class="btn btn-link">https://developers.google.com/maps/documentation/javascript/get-api-key</a></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">申請網址</label>                       	
          <div class="col-md-10"><a href="https://console.developers.google.com/?hl=zh-tw" target="_blank" class="btn btn-link">https://console.developers.google.com/?hl=zh-tw</a></div>
      </div>
      <div class="form-group row">
      <div class="col-md-12">
      <div class="row">
      <div class="card col-md-4">
      <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse">STEP1</b></div>
          <img class="card-img-top" src="images/tip/tip127.jpg" alt="" />
          <div class="card-block">
              <p class="card-text">STEP1:使用Google 帳戶登入申請網址。</p>
          </div>
      </div>
      <div class="card col-md-4">
      <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse">STEP2</b></div><strong></strong>
      <img class="card-img-top" src="images/tip/tip128.jpg" alt="" />
        <div class="card-block">
              <p class="card-text">STEP2:建立新專案。</p>
          </div>
      </div>
      <div class="card col-md-4">
      <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse">STEP3</b></div>
      <img class="card-img-top" src="images/tip/tip129.jpg" alt="" />
        <div class="card-block">
              <p class="card-text">STEP3:在目前專案點選啟用API和服務。</p>
          </div>
      </div>
      <div class="card col-md-4">
      <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse">STEP4</b></div>
      <img class="card-img-top" src="images/tip/tip130.jpg" alt="" />
        <div class="card-block">
              <p class="card-text">STEP4:搜尋並啟用Geocoding API 及 Maps JavaScript API。</p>
          </div>
      </div>
      <div class="card col-md-4">
      <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse">STEP5</b></div>
      <img class="card-img-top" src="images/tip/tip131.jpg" alt="" />
        <div class="card-block">
              <p class="card-text">STEP5:替目前專案建立一個憑證。</p>
          </div>
      </div>
      <div class="card col-md-4">
      <div class="m-b-10 f-s-10 m-t-10"><b class="text-inverse">STEP6</b></div>
      <img class="card-img-top" src="images/tip/tip132.jpg" alt="" />
        <div class="card-block">
              <p class="card-text">STEP6:複製此金鑰貼入至後台即可。</p>
          </div>
      </div>
      
      
      </div>
      </div>
      </div>
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
