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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebuser = "SELECT * FROM demo_admin WHERE name != '' ORDER BY webname";
$RecordWebuser = mysqli_query($DB_Conn, $query_RecordWebuser) or die(mysqli_error($DB_Conn));
$row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
$totalRows_RecordWebuser = mysqli_num_rows($RecordWebuser);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
/*$query_RecordBnb = "SELECT demo_admin.id, demo_admin.account, demo_admin.webname, demo_admin.hot, demo_bnb.name, demo_bnb.userid, demo_bnb.skeyword, demo_bnb.sdescription, demo_bnb.addr, demo_bnb.addrx, demo_bnb.addry FROM demo_admin LEFT OUTER JOIN demo_bnb ON demo_admin.id = demo_bnb.userid WHERE  demo_bnb.name != '' ORDER BY demo_admin.hot DESC, demo_bnb.visit DESC, demo_admin.id DESC";
$RecordBnb = mysqli_query($DB_Conn, $query_RecordBnb) or die(mysqli_error($DB_Conn));
$row_RecordBnb = mysqli_fetch_assoc($RecordBnb);
$totalRows_RecordBnb = mysqli_num_rows($RecordBnb);*/

if ((isset($_POST["MM_Account"])) && ($_POST["MM_Account"] == "1")) {
	$_SESSION['MM_Username'] = $_POST['account_web'];
}
if ((isset($_POST["MM_Account"])) && ($_POST["MM_Account"] == "3")) {
	$_SESSION['MM_Username'] = $_POST['account_iweb'];
}
if ((isset($_POST["MM_Account"])) && ($_POST["MM_Account"] == "2")) {
	$_SESSION['MM_Username'] = $_POST['account_bnb'];
}

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 帳號 <small>更換</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-retweet"></i> 切換帳號</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action=""  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">網站帳號選擇<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <select name="account_web" class="form-control" id="account_web" data-parsley-trigger="blur" required="">
              <option value="">-- 選擇欲切換之帳號 --</option>
              <?php
do {  
?>
              <option value="<?php echo $row_RecordWebuser['account']?>"><?php echo $row_RecordWebuser['name']?>
                <?php if ($row_RecordWebuser['webname'] != "") { ?>
                【<?php echo $row_RecordWebuser['webname']?>】
  <?php } ?>
              </option>
              <?php
} while ($row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser));
  $rows = mysqli_num_rows($RecordWebuser);
  if($rows > 0) {
      mysqli_data_seek($RecordWebuser, 0);
	  $row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
  }
?>
            </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="MM_Account" type="hidden" id="MM_Account" value="1" />
          </div>
      </div>
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordWebuser);
?>

