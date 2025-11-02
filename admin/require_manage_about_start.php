<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

$colname_RecordAbout = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAbout = $_GET['searchkey'];
}
$coluserid_RecordAbout = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAbout = $w_userid;
}
$colnamelang_RecordAbout = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAbout = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAbout = sprintf("SELECT * FROM demo_about WHERE ((title LIKE %s)) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordAbout . "%", "text"),GetSQLValueString($colnamelang_RecordAbout, "text"),GetSQLValueString($coluserid_RecordAbout, "int"));
$RecordAbout = mysqli_query($DB_Conn, $query_RecordAbout) or die(mysqli_error($DB_Conn));
$row_RecordAbout = mysqli_fetch_assoc($RecordAbout);
$totalRows_RecordAbout = mysqli_num_rows($RecordAbout);


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
	if ((isset($_POST['id_check'])) && ($_POST['id_check'] != "")) {
		// 初始化此頁面所有文章
	  $updateResetSQL = sprintf("UPDATE demo_about SET home=0 WHERE id in (%s)", implode(",", $_POST['id']));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateResetSQL) or die(mysqli_error($DB_Conn));
	  // 更新選取文章
	  $updateSQL = sprintf("UPDATE demo_about SET home=1 WHERE id = %s",
                       GetSQLValueString($_POST['id_check'], "int"));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  
	  $_SESSION['DB_Set'] = "Success";

	  $insertGoTo = "manage_about.php?Opt=viewpage&lang=" . $_POST['lang'];
	  /*if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }*/
	  header(sprintf("Location: %s", $insertGoTo));
	}
}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-star"></i> 設定起始頁</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
      <?php do { ?>
      <div class="form-group row">
          
        <div class="col-md-12">
                      <div class="checkbox checkbox-css">
                          <input name="id_check" <?php if (!(strcmp($row_RecordAbout['home'],1))) {echo "checked=\"checked\"";} ?> value="<?php echo $row_RecordAbout['id']; ?>" type="radio" id="id_check_<?php echo $row_RecordAbout['id']; ?>" data-parsley-trigger="blur" required=""/>
                        <label for="id_check_<?php echo $row_RecordAbout['id']; ?>"><?php echo $row_RecordAbout['title']; ?></label>
                        <?php if($row_RecordAbout['home'] == 1){ ?>
                        <button type='button' class='btn btn-warning btn-xs pull-right'><i class='fa fa-check-circle'></i> 起始頁</button>
                        <?php } else { ?>
                        <button type='button' class='btn btn-grey btn-xs pull-right'><i class='fa fa-circle'></i> 起始頁</button>
                        <?php } ?>
                        <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordAbout['id']; ?>" />
                      </div>
        </div>
      </div>
      <?php } while ($row_RecordAbout = mysqli_fetch_assoc($RecordAbout)); ?>
      <div class="form-group row">
 
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordAbout);
?>
