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

$colname_RecordDfType = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordDfType = $_GET['searchkey'];
}
$coluserid_RecordDfType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfType = $w_userid;
}
$colnamelang_RecordDfType = "zh_TW";
if (isset($_GET['lang'])) {
  $colnamelang_RecordDfType = $_GET['lang'];
}
$colaid_RecordDfType = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfType = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfType = sprintf("SELECT * FROM demo_dfpage WHERE ((title LIKE %s)) && lang = %s && aid=%s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordDfType . "%", "text"),GetSQLValueString($colnamelang_RecordDfType, "text"),GetSQLValueString($colaid_RecordDfType, "int"),GetSQLValueString($coluserid_RecordDfType, "int"));
$RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType) or die(mysqli_error($DB_Conn));
$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
$totalRows_RecordDfType = mysqli_num_rows($RecordDfType);


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
	if ((isset($_POST['id_check'])) && ($_POST['id_check'] != "")) {
		// 初始化此頁面所有文章
	  $updateResetSQL = sprintf("UPDATE demo_dfpage SET home=0 WHERE id in (%s)", implode(",", $_POST['id']));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result = mysqli_query($DB_Conn, $updateResetSQL) or die(mysqli_error($DB_Conn));
	  // 更新選取文章
	  $updateSQL = sprintf("UPDATE demo_dfpage SET home=1 WHERE id = %s",
                       GetSQLValueString($_POST['id_check'], "int"));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

	  $_SESSION['DB_Set'] = "Success";

	  $insertGoTo = "manage_dfpage.php?Opt=viewpage&lang=" . $_POST['lang'] . "&aid=" . $_POST['aid'];
	  /*if (isset($_SERVER['QUERY_STRING'])) {
		$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
		$insertGoTo .= $_SERVER['QUERY_STRING'];
	  }*/
	  header(sprintf("Location: %s", $insertGoTo));
	}
}
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['DfType']; ?> <small>設定</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="text-nowrap btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-star"></i> 設定起始頁</h4>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body p-0">

  <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>此處的設定為 <span class="label label-danger "><?php echo $row_RecordLTpt['title']; ?></span> 選單的入口頁設置。</b></div>
  <form action="<?php echo $request->getRequestUri(); ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">

      <?php do { ?>
      <div class="form-group row">

        <div class="col-md-12">
                      <div class="checkbox checkbox-css">
                          <input name="id_check" <?php if (!(strcmp($row_RecordDfType['home'],1))) {echo "checked=\"checked\"";} ?> value="<?php echo $row_RecordDfType['id']; ?>" class="form-check-input"  type="radio" id="id_check_<?php echo $row_RecordDfType['id']; ?>" data-parsley-trigger="blur" required=""/>
                        <label for="id_check_<?php echo $row_RecordDfType['id']; ?>"><?php echo $row_RecordDfType['title']; ?></label>
                        <?php if($row_RecordDfType['home'] == 1){ ?>
                        <button type='button' class='btn btn-warning btn-xs float-end'><i class='fa fa-check-circle'></i> 起始頁</button>
                        <?php } else { ?>
                        <button type='button' class='btn btn-gray btn-xs float-end'><i class='fa fa-circle'></i> 起始頁</button>
                        <?php } ?>
                        <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordDfType['id']; ?>" />
                      </div>
        </div>
      </div>
      <?php } while ($row_RecordDfType = mysqli_fetch_assoc($RecordDfType)); ?>
      <div class="form-group row">

          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form" />
  </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordDfType);
?>
