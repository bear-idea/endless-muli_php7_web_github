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
  $updateSQL = sprintf("UPDATE demo_setting_fr SET GoogleLoginAppID=%s, GoogleLoginSecret=%s, FacebookLoginAppID=%s, FacebookLoginSecret=%s, LINELoginAppID=%s, LINELoginSecret=%s WHERE id=%s",
                       GetSQLValueString($_POST['GoogleLoginAppID'], "text"),
					   GetSQLValueString($_POST['GoogleLoginSecret'], "text"),
					   GetSQLValueString($_POST['FacebookLoginAppID'], "text"),
					   GetSQLValueString($_POST['FacebookLoginSecret'], "text"),
					   GetSQLValueString($_POST['LINELoginAppID'], "text"),
					   GetSQLValueString($_POST['LINELoginSecret'], "text"),
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 第三方帳號登入 <small>API串接</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 串接一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <div class="table-responsive">
								<table class="table table-striped m-b-0">
									<thead>
										<tr>
											<th width="150">#</th>
											<th>狀態</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong><i class="fab fa-facebook"></i> Facebook</strong></td>
											<td><?php if ($row_RecordSettingFr['FacebookLoginAppID'] == "" && $row_RecordSettingFr['FacebookLoginSecret'] == "") { ?><div style="color:#F00; font-weight:bolder;">尚未串接 Facebook Login，會員不可透過 Facebook 帳號登入</div><?php } else { ?>
          <div style="color:#0C0; font-weight:bolder;">已串接 Facebook Login，會員可透過 Facebook 帳號登入</div>
          <?php } ?></td>
										</tr>
										<tr>
											<td><strong><i class="fab fa-line"></i> LINE</strong></td>
											<td><?php if ($row_RecordSettingFr['LINELoginAppID'] == "" && $row_RecordSettingFr['LINELoginSecret'] == "") { ?>
            <div style="color:#F00; font-weight:bolder;">尚未串接 LINE Login，會員不可透過 LINE 帳號登入</div>
          <?php } else { ?>
          <div style="color:#0C0; font-weight:bolder;">已串接 LINE Login，會員可透過 LINE 帳號登入</div>
          <?php } ?></td>
										</tr>
										<tr>
											<td><strong><i class="fab fa-google"></i> Google</strong></td>
											<td><?php if ($row_RecordSettingFr['GoogleLoginAppID'] == "" && $row_RecordSettingFr['GoogleLoginSecret'] == "") { ?>
          <div style="color:#F00; font-weight:bolder;">尚未串接 Google Login，會員不可透過 Google 帳號登入</div>
          <?php } else { ?>
          <div style="color:#0C0; font-weight:bolder;">已串接 Google Login，會員可透過 Google 帳號登入</div>
          <?php } ?></td>
										</tr>
									</tbody>
								</table>
							</div>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 資料修改</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
    <?php $url=(empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; ?>
    <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> Facebook</span></div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Facebook設定</label>
          <div class="col-md-10">
              
            <a href="https://developers.facebook.com/?locale=zh_TW" class="btn btn-link" target="_blank">https://developers.facebook.com/?locale=zh_TW</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Callback URL</label>
          <div class="col-md-10">
              
                  <?php echo dirname(dirname($url));?>/<?php echo $row_RecordWebuser['webname']; ?>Thirdparty/facebook/oauth/callback.php?wshop=<?php echo $wshop; ?><br />

<?php echo dirname(dirname($url));?>/<?php echo $row_RecordWebuser['webname']; ?>admin/Thirdparty/facebook/oauth/callback.php
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">應用程式編號</label>
          <div class="col-md-10">
              
            <input name="FacebookLoginAppID" type="text" id="FacebookLoginAppID" value="<?php echo $row_RecordSettingFr['FacebookLoginAppID']; ?>" size="50" maxlength="50" class="form-control"/>
                                        
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">應用程式密碼</label>
          <div class="col-md-10">
              
            <input name="FacebookLoginSecret" type="text" id="FacebookLoginSecret" value="<?php echo $row_RecordSettingFr['FacebookLoginSecret']; ?>" size="50" maxlength="50" class="form-control"/>
                                        
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> LINE</span></div>
      </div>
      
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">LINE設定</label>
          <div class="col-md-10">
              
                  <a href="https://developers.line.me" class="btn btn-link" target="_blank">https://developers.line.me</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Callback URL</label>
          <div class="col-md-10">
              
                  <?php echo dirname(dirname($url));?>/<?php echo $row_RecordWebuser['webname']; ?>Thirdparty/line/oauth/callback.php<br />

<?php echo dirname(dirname($url));?>/<?php echo $row_RecordWebuser['webname']; ?>admin/Thirdparty/line/oauth/callback.php
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">應用程式編號</label>
          <div class="col-md-10">
              
                  <input name="LINELoginAppID" type="text" id="LINELoginAppID" value="<?php echo $row_RecordSettingFr['LINELoginAppID']; ?>" size="50" maxlength="50" class="form-control"/>
                                        
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">應用程式密碼</label>
          <div class="col-md-10">
              
                  <input name="LINELoginSecret" type="text" id="LINELoginSecret" value="<?php echo $row_RecordSettingFr['LINELoginSecret']; ?>" size="50" maxlength="50" class="form-control"/>
                                        
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> Google</span></div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Google設定</label>
          <div class="col-md-10">
              
                  <a href="https://console.developers.google.com/?hl=zh-tw" class="btn btn-link" target="_blank">https://console.developers.google.com/?hl=zh-tw</a>
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">Callback URL</label>
          <div class="col-md-10">
              <div class="alert alert-warning fade show"><i class="fa fa-info-circle"></i> <b>須啟用Google+ API</b></div>
                  <?php echo dirname(dirname($url));?>/<?php echo $row_RecordWebuser['webname']; ?>Thirdparty/google/oauth/callback.php<br />

<?php echo dirname(dirname($url));?>/<?php echo $row_RecordWebuser['webname']; ?>admin/Thirdparty/google/oauth/callback.php
                                      
          
                      
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">應用程式編號</label>
          <div class="col-md-10">
              
                  <input name="GoogleLoginAppID" type="text" id="GoogleLoginAppID" value="<?php echo $row_RecordSettingFr['GoogleLoginAppID']; ?>" size="50" maxlength="50" class="form-control"/>
                                        
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">應用程式密碼</label>
          <div class="col-md-10">
              
                  <input name="GoogleLoginSecret" type="text" id="GoogleLoginSecret" value="<?php echo $row_RecordSettingFr['GoogleLoginSecret']; ?>" size="50" maxlength="50" class="form-control"/>
                                        
                 
          </div>
      </div>
 
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" id="Step_Send">送出</button>
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
<?php } ?>

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

