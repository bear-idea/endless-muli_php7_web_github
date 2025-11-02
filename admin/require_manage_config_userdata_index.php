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
  $updateSQL = sprintf("UPDATE demo_admin SET nickname=%s, email=%s, truename=%s, sex=%s, birthday=%s, phone=%s, addr=%s WHERE id=%s",
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['truename'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['birthday'], "date"),
                       GetSQLValueString($_POST['phone'], "text"),
                       GetSQLValueString($_POST['addr'], "text"),
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 個人資料 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 網站資訊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網域網址</label>
          <div class="col-md-10">
                      
                      <?php $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
echo dirname(dirname($url));?>/<?php echo $row_RecordSystemConfigAp['webname'];; ?>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網域名稱</label>
          <div class="col-md-10">
                      
                      <?php echo $row_RecordSystemConfigAp['name']; ?>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 個人資訊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">個人頭像</label>
          <div class="col-md-10">      
          <a href="uplod_userphoto.php?id_edit=<?php echo $row_RecordSystemConfigAp['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="truename" type="text" class="form-control" id="truename" value="<?php echo $row_RecordSystemConfigAp['truename']; ?>" maxlength="50" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">性別</label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigAp['sex'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" id="sex_1" value="男" />
                <label for="sex_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigAp['sex'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="sex" id="sex_2" value="女" />
                <label for="sex_2">女</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">出生日期</label>
          <div class="col-md-10">
                      <input name="birthday" type="text" class="form-control" id="birthday" value="<?php echo $row_RecordSystemConfigAp['birthday']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" />  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">暱稱</label>
          <div class="col-md-10">
                      
                      <input name="nickname" type="text" id="birthday" value="<?php echo $row_RecordSystemConfigAp['nickname']; ?>" maxlength="15" data-parsley-trigger="blur" class="form-control"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
                      
                      <input name="phone" type="text" id="phone" value="<?php echo $row_RecordSystemConfigAp['phone']; ?>" maxlength="20" data-parsley-trigger="blur" class="form-control"/>
                      
                 
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label">Mail<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="email" type="email" id="email" value="<?php echo $row_RecordSystemConfigAp['email']; ?>" size="100" maxlength="150" data-parsley-trigger="blur" class="form-control" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">地址</label>
          <div class="col-md-10">
                      
                      <input name="addr" type="text" id="addr" value="<?php echo $row_RecordSystemConfigAp['addr']; ?>" size="50" maxlength="200"  data-parsley-trigger="blur" class="form-control" />
                      
                 
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

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSystemConfigAp);
?>
