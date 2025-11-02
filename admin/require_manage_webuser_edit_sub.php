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

$coluserid_RecordPermissionListAuthor = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionListAuthor = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionListAuthor = sprintf("SELECT * FROM demo_permissionitem WHERE list_id = 1 && (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordPermissionListAuthor, "int"));
$RecordPermissionListAuthor = mysqli_query($DB_Conn, $query_RecordPermissionListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordPermissionListAuthor = mysqli_fetch_assoc($RecordPermissionListAuthor);
$totalRows_RecordPermissionListAuthor = mysqli_num_rows($RecordPermissionListAuthor);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Webuser")) {
  $updateSQL = sprintf("UPDATE demo_admin SET account=%s, psw=%s, level=%s, email=%s, truename=%s, phone=%s WHERE id=%s",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
					   GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['truename'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_webuser_sub.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordWebuser = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordWebuser = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebuser = sprintf("SELECT * FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordWebuser, "int"));
$RecordWebuser = mysqli_query($DB_Conn, $query_RecordWebuser) or die(mysqli_error($DB_Conn));
$row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
$totalRows_RecordWebuser = mysqli_num_rows($RecordWebuser);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站使用者 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  <?php if(isset($_GET['RegMsg']) && $_GET['RegMsg'] == "error") { ?>
  <div class="alert alert-danger fade show m-10">
      <span class="close" data-dismiss="alert">×</span>
     <i class="fa fa-info-circle"></i> 帳號或網站域名重複！！
  </div>
  <?php } ?>                                 
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">帳號<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="account" type="text" required="" class="form-control" id="account" onblur="this.value = this.value.toLowerCase();" value="<?php echo $row_RecordWebuser['account']; ?>" maxlength="30" readonly="readonly" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="psw" type="password" required="" class="form-control" id="psw" value="<?php echo $row_RecordWebuser['psw']; ?>" maxlength="30" data-parsley-length="[4, 30]" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">確認密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <input name="pswchk" type="password" required="" class="form-control" id="pswchk" value="<?php echo $row_RecordWebuser['psw']; ?>" maxlength="100" data-parsley-trigger="blur" data-parsley-length="[4, 30]" data-parsley-equalto="#psw" data-parsley-errors-container="#error_pswchk"/>
                    <div id="error_pswchk"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">等級<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <select name="level" id="level" data-parsley-trigger="blur" class="form-control" required="">
            <option value="" <?php if (!(strcmp("", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>-- 選擇權限 -- </option>
            <!--<option value="admin" <?php if (!(strcmp("admin", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>管理者</option>-->
            <?php if ($totalRows_RecordPermissionListAuthor > 0) { ?>
                <?php
				do {  
				?>
                                <option value="<?php echo $row_RecordPermissionListAuthor['itemvalue']?>"<?php if (!(strcmp($row_RecordPermissionListAuthor['itemvalue'], $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordPermissionListAuthor['itemname']?> - <?php echo $row_RecordPermissionListAuthor['itemvalue']?></option>
                                
								<?php
				} while ($row_RecordPermissionListAuthor = mysqli_fetch_assoc($RecordPermissionListAuthor));
				  $rows = mysqli_num_rows($RecordPermissionListAuthor);
				  if($rows > 0) {
					  mysqli_data_seek($RecordPermissionListAuthor, 0);
					  $row_RecordPermissionListAuthor = mysqli_fetch_assoc($RecordPermissionListAuthor);
				  }
				?>
                <?php } ?>
            
          </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="truename" type="text" required="" class="form-control" id="truename" value="<?php echo $row_RecordWebuser['truename']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
                      
                      <input name="phone" type="text"  class="form-control" id="phone" value="<?php echo $row_RecordWebuser['phone']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="email" type="email" required="" class="form-control" id="email" value="<?php echo $row_RecordWebuser['email']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
     
      
     
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
           <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="groupid" type="hidden" id="groupid" value="<?php echo $row_RecordAccount['id'] ?>" />
                    <input name="groupwebname" type="hidden" id="groupwebname" value="<?php echo $row_RecordAccount['webname'] ?>" />
                    <input name="grouptype" type="hidden" id="grouptype" value="sub" />
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordWebuser['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Webuser" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordWebuser);

mysqli_free_result($RecordPermissionListAuthor);
?>
