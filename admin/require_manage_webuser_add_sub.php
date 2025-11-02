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

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
	$MM_dupKeyRedirect="manage_webuser_sub.php?wshop=&Opt=addpage&RegMsg=error&lang=" . $_POST['lang'];
	$loginUsername = $_POST['account'];
	$loginWebname = $_POST['webname'];
	$LoginRS__query = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($loginUsername, "text"));
	$LoginRS__query_Webname = sprintf("SELECT * FROM demo_admin WHERE webname = %s", GetSQLValueString($loginWebname, "text"));
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
	$row_LoginRS = mysqli_fetch_assoc($LoginRS);
	$totalRows_LoginRS = mysqli_num_rows($LoginRS);
	$loginFoundUser = mysqli_num_rows($LoginRS); //取得結果中列的數目
	
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$LoginRS_Webname=mysqli_query($DB_Conn, $LoginRS__query_Webname) or die(mysqli_error($DB_Conn));
	$row_LoginRS_Webname = mysqli_fetch_assoc($LoginRS_Webname);
	$totalRows_LoginRS_Webname = mysqli_num_rows($LoginRS_Webname);
	$loginFoundUser_Webname = mysqli_num_rows($LoginRS_Webname); //取得結果中列的數目

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser || $loginFoundUser_Webname){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
	ob_end_flush(); // 輸出緩衝區結束
    exit;
  }
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


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Webuser")) {
  $insertSQL = sprintf("INSERT INTO demo_admin (account, psw, email, truename, phone, `level`, groupid, groupwebname, grouptype, notes1) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['truename'], "text"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
					   GetSQLValueString($_POST['groupid'], "int"),
					   GetSQLValueString($_POST['groupwebname'], "text"),
					   GetSQLValueString($_POST['grouptype'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  isset($_SESSION['DB_Add']) && $_SESSION['DB_Add'] == "Success";
  
  $insertGoTo = "manage_webuser_sub.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站使用者 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
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
                      
                      <input name="account" type="text" required="" class="form-control" id="account" maxlength="30" data-parsley-trigger="blur" onblur="this.value = this.value.toLowerCase();"/>
                      
                 
          </div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="psw" type="password" required="" class="form-control" id="psw" data-parsley-length="[4, 30]" maxlength="30" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">確認密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <input name="pswchk" type="password" class="form-control" id="pswchk" maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[4, 30]" data-parsley-equalto="#psw" data-parsley-errors-container="#error_pswchk"/>
                    <div id="error_pswchk"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">等級<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <select name="level" id="level" class="form-control" data-parsley-trigger="blur" required="">
            <option value="">-- 選擇權限 -- </option>
            <!--<option value="admin">管理者</option>-->
            <?php if ($totalRows_RecordPermissionListAuthor > 0) { ?>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordPermissionListAuthor['itemvalue']?>"><?php echo $row_RecordPermissionListAuthor['itemname']?> - <?php echo $row_RecordPermissionListAuthor['itemvalue']?></option>
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
                      
                      <input name="truename" type="text" required="" class="form-control" id="truename" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
                      
                      <input name="phone" type="text"  class="form-control" id="phone" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="email" type="email" required="" class="form-control" id="email" maxlength="100" data-parsley-trigger="blur" />
                      
                 
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
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Webuser" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordPermissionListAuthor);
?>