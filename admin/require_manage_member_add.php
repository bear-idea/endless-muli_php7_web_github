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

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="manage_member.php?wshop=".$wshop."&Opt=addpage&RegMsg=error&lang=" . $_POST['lang'];
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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Member")) {
  $insertSQL = sprintf("INSERT INTO demo_member (accountid, account, psw, name, nickname, sex, birthday, mail, tel, cellphone, addr1, fax, serviceunits, web, job, indicate, notes1, lang, auth, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['accountid'], "text"),
					   GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString(md5($_POST['psw']), "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['serviceunits'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['auth'], "text"),
					   GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_member.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Member']; ?> <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
          
            <input name="account" type="text" id="account" maxlength="30" class="form-control" data-parsley-trigger="blur" required="" data-parsley-length="[6, 30]"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
            <input name="psw" type="text" class="form-control" id="psw"  maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[6, 30]"  data-parsley-errors-container="#error_password"/>
            <div id="passwordStrengthDiv" class="is0 m-t-5 is10"></div>
            <div id="error_password"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">確認密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
            <input name="pswchk" type="text" class="form-control" id="pswchk" maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[6, 30]" data-parsley-equalto="#psw" data-parsley-errors-container="#error_pswchk"/>
                    <div id="error_pswchk"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 會員編號</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">編號</label>
          <div class="col-md-10">
          
            <input name="accountid" type="text" id="accountid" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 個人資料</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
          
            <input name="name" type="text" id="name" maxlength="30" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">暱稱</label>
          <div class="col-md-10">
          
            <input name="nickname" type="text" id="nickname" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">性別<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input type="radio" name="sex" id="sex_1" value="男" checked />
              <label for="sex_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="sex" id="sex_2" value="女" />
              <label for="sex_2">女</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出生日期</label>
          <div class="col-md-10">
            <input name="birthday" type="text" class="form-control" id="birthday" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" maxlength="100" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
          
                      <input name="tel" type="text" id="tel" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" id="cellphone" maxlength="30" class="form-control" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
          
                      <input name="fax" type="text" id="fax" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網頁</label>
          <div class="col-md-10">
          
                      <input name="web" type="url" id="web" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">職稱</label>
          <div class="col-md-10">
          
                      <input name="job" type="text" id="job" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">服務單位</label>
          <div class="col-md-10">
          
                      <input name="serviceunits" type="text" id="serviceunits" maxlength="50" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">地址</label>
          <div class="col-md-10">
          
                      <input name="addr1" type="text" id="addr1" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">

          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>    
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
              <input type="radio" name="auth" id="auth_1" value="1" checked />
              <label for="auth_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="auth" id="auth_2" value="0" />
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
            <input name="indicate" type="hidden" id="indicate" value="1" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Member" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->