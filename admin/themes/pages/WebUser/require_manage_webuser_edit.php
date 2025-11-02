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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Webuser")) {
  $updateSQL = sprintf("UPDATE demo_admin SET account=%s, psw=%s, name=%s, webname=%s, `level`=%s, notes1=%s WHERE id=%s",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_webuser.php?Opt=viewpage&lang=" . $_POST['lang'];
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

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站使用者 <small>修改</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $request->getRequestUri(); ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $row_RecordWebuser['name']; ?>" maxlength="30" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <?php if ($SiteModChoose != "4") { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站域名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="webname" type="text" required="" class="form-control" id="webname" value="<?php echo $row_RecordWebuser['webname']; ?>" maxlength="20" readonly="readonly" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <?php } ?>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">帳號<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="account" type="text" required="" class="form-control" id="account" onblur="this.value = this.value.toLowerCase();" value="<?php echo $row_RecordWebuser['account']; ?>" maxlength="30" readonly="readonly" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="psw" type="password" required="" class="form-control" id="psw" value="<?php echo $row_RecordWebuser['psw']; ?>" data-parsley-length="[8, 30]" maxlength="30" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">確認密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <input name="pswchk" type="password" class="form-control" id="pswchk" maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[8, 30]" data-parsley-equalto="#psw" data-parsley-errors-container="#error_pswchk"/>
                    <div id="error_pswchk"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">等級<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <select name="level" id="level" class="form-control" data-parsley-trigger="blur" required="">
            <option value="" <?php if (!(strcmp("", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>-- 選擇權限 -- </option>
            <option value="superadmin" <?php if (!(strcmp("superadmin", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>最高管理者</option>
            <option value="admin" <?php if (!(strcmp("admin", $row_RecordWebuser['level']))) {echo "selected=\"selected\"";} ?>>一般會員</option>
          </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordWebuser['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary w-100 btn-block" onclick="return CheckFields();">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordWebuser['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordWebuser['lang']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
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
?>
