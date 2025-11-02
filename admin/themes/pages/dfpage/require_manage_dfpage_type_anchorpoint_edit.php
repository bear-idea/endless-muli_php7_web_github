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

$colname_RecordDfType = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordDfType = $_GET['id_edit'];
}
$coluserid_RecordDfType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfType = sprintf("SELECT * FROM demo_dftype WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordDfType, "int"),GetSQLValueString($coluserid_RecordDfType, "int"));
$RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType) or die(mysqli_error($DB_Conn));
$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
$totalRows_RecordDfType = mysqli_num_rows($RecordDfType);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_DfType")) {
  $updateSQL = sprintf("UPDATE demo_dftype SET title=%s, indicate=%s, notes1=%s, link=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_dfpage.php?Opt=typepage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['DfType']; ?> <small>修改</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordDfType['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">錨點<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">#AnchorPoint_</span></div>
              <input name="link" required="" class="form-control" id="link" placeholder="" value="<?php echo $row_RecordDfType['link']; ?>" maxlength="200" data-parsley-trigger="blur"/>                       
              </div>

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="form-check form-check-inline">
                <input <?php if (!(strcmp($row_RecordDfType['indicate'],"1"))) {echo "checked=\"checked\"";} ?> class="form-check-input"  type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="form-check form-check-inline">
                <input <?php if (!(strcmp($row_RecordDfType['indicate'],"0"))) {echo "checked=\"checked\"";} ?> class="form-check-input"  type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordDfType['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDfType['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_DfType" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordDfType);
?>
