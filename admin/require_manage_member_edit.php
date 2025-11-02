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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Member")) {
  $updateSQL = sprintf("UPDATE demo_member SET accountid=%s, account=%s, name=%s, nickname=%s, sex=%s, birthday=%s, mail=%s, regdate=%s, auth=%s, tel=%s, cellphone=%s, addr1=%s, fax=%s, serviceunits=%s, web=%s, job=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['accountid'], "text"),
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['regdate'], "date"),
                       GetSQLValueString($_POST['auth'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['serviceunits'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_member.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得資料 */
$colname_RecordMember = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordMember = $_GET['id_edit'];
}
$coluserid_RecordMember = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMember = $w_userid;
}
$collang_RecordMember = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMember = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMember = sprintf("SELECT * FROM demo_member WHERE id = %s && lang = %s && userid=%s", GetSQLValueString($colname_RecordMember, "int"),GetSQLValueString($collang_RecordMember, "text"),GetSQLValueString($coluserid_RecordMember, "int"));
$RecordMember = mysqli_query($DB_Conn, $query_RecordMember) or die(mysqli_error($DB_Conn));
$row_RecordMember = mysqli_fetch_assoc($RecordMember);
$totalRows_RecordMember = mysqli_num_rows($RecordMember);

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="manage_member.php?wshop=" . $wshop . "&Opt=editpage&RegMsg=error&lang=" . $_POST['lang'];
  $loginUsername = $_POST['account'];
  $LoginRS__query = sprintf("SELECT account FROM demo_member WHERE account=%s", GetSQLValueString($loginUsername, "text"));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}
?>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Member']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  <?php if ($_GET["RegMsg"] == "error") { ?>
  <div class="alert alert-danger fade show m-10">
      <span class="close" data-dismiss="alert">×</span>
      你註冊的帳號已被使用！！請重新註冊！！
  </div>
  <?php } ?>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 帳號資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">帳號<span class="text-red">*</span></label>
          <div class="col-md-10">
          
            <input name="account" type="text" required="" class="form-control" id="account" value="<?php echo $row_RecordMember['account']; ?>" maxlength="30" readonly="readonly" data-parsley-trigger="blur" data-parsley-length="[6, 30]"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 會員編號</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">編號</label>
          <div class="col-md-10">
          
            <input name="accountid" type="text" class="form-control" id="accountid" value="<?php echo $row_RecordMember['accountid']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 個人資料</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
          
            <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordMember['name']; ?>" maxlength="30" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">暱稱</label>
          <div class="col-md-10">
          
            <input name="nickname" type="text" class="form-control" id="nickname" value="<?php echo $row_RecordMember['nickname']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">性別<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordMember['sex'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" id="sex_1" value="男" />
              <label for="sex_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordMember['sex'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" id="sex_2" value="女" />
              <label for="sex_2">女</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出生日期</label>
          <div class="col-md-10">
            <input name="birthday" type="text" class="form-control" id="birthday" value="<?php echo $row_RecordMember['birthday']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label> 
          <div class="col-md-10">
              <input name="mail" type="email" required="" class="form-control" id="mail" value="<?php echo $row_RecordMember['mail']; ?>" maxlength="100" data-parsley-trigger="blur"/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
          
                      <input name="tel" type="text" class="form-control" id="tel" value="<?php echo $row_RecordMember['tel']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" class="form-control" id="cellphone" value="<?php echo $row_RecordMember['cellphone']; ?>" maxlength="30" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
          
                      <input name="fax" type="text" class="form-control" id="fax" value="<?php echo $row_RecordMember['fax']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網頁</label>
          <div class="col-md-10">
          
                      <input name="web" type="url" class="form-control" id="web" value="<?php echo $row_RecordMember['web']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">職稱</label>
          <div class="col-md-10">
          
                      <input name="job" type="text" class="form-control" id="job" value="<?php echo $row_RecordMember['job']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務單位</label>
          <div class="col-md-10">
          
                      <input name="serviceunits" type="text" class="form-control" id="serviceunits" value="<?php echo $row_RecordMember['serviceunits']; ?>" maxlength="50" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">地址</label>
          <div class="col-md-10">
          
                      <input name="addr1" type="text" class="form-control" id="addr1" value="<?php echo $row_RecordMember['addr1']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">

          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordMember['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 會員狀態</span></div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">認證<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordMember['auth'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="auth" id="auth_1" value="1" />
              <label for="auth_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordMember['auth'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="auth" id="auth_2" value="0" />
              <label for="auth_2">否</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordMember['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Member" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordMember);
?>
