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
  $updateSQL = sprintf("UPDATE demo_admin SET psw=%s WHERE id=%s",
                       //GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$colname_RecordSystemConfigAp = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordSystemConfigAp = $_SESSION['MM_Username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigAp = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($colname_RecordSystemConfigAp, "text"));
$RecordSystemConfigAp = mysqli_query($DB_Conn, $query_RecordSystemConfigAp) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigAp = mysqli_fetch_assoc($RecordSystemConfigAp);
$totalRows_RecordSystemConfigAp = mysqli_num_rows($RecordSystemConfigAp);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 帳號 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-retweet"></i> 帳號密碼修改</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">帳號</label>
          <div class="col-md-10">
                 
                    
                    <label class="col-form-label"><?php echo $row_RecordSystemConfigAp['account']; ?></label>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
            <input name="password" type="password" class="form-control" id="password"  maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[8, 30]"  data-parsley-errors-container="#error_password"/>
            <div id="passwordStrengthDiv" class="is0 m-t-5 is10"></div>
            <div id="error_password"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">確認密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <input name="pswchk" type="password" class="form-control" id="pswchk" maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[8, 30]" data-parsley-equalto="#password" data-parsley-errors-container="#error_pswchk"/>
                    <div id="error_pswchk"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemConfigAp['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
//$(document).ready(function() {
//has uppercase
window.Parsley.addValidator('uppercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var uppercases = value.match(/[A-Z]/g) || [];
    return uppercases.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) uppercase letter.'
  }
});

//has lowercase
window.Parsley.addValidator('lowercase', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var lowecases = value.match(/[a-z]/g) || [];
    return lowecases.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) lowercase letter.'
  }
});

//has number
window.Parsley.addValidator('havenumber', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var numbers = value.match(/[0-9]/g) || [];
    return numbers.length >= requirement;
  },
  messages: {
	en: 'Your password must contain at least (%s) number.',
    zh_tw: '密碼至少包含 (%s) 數字'
  }
});


//has special char
window.Parsley.addValidator('havespecial', {
  requirementType: 'number',
  validateString: function(value, requirement) {
    var specials = value.match(/[^a-zA-Z0-9]/g) || [];
    return specials.length >= requirement;
  },
  messages: {
    en: 'Your password must contain at least (%s) special characters.'
  }
});
//});

$('#password').passwordStrength({});

</script>

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSystemConfigAp);
?>
