<?php require_once('../Connections/DB_Conn.php'); ?>
<?php include('dbcconv.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Form_Get")) {


/* 取得產品資訊 */

/* 當類別無傳值進來時則給定初始值 */
if($_POST['oldtype1'] == NULL){$_POST['oldtype1'] = '-1';}
if($_POST['oldtype2'] == NULL){$_POST['oldtype2'] = '-1';}
if($_POST['oldtype3'] == NULL){$_POST['oldtype3'] = '-1';}

$maxRows_RecordSearchdata = 999;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordSearchdata = $page * $maxRows_RecordSearchdata;

$coluserid_RecordSearchdata = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdata = $w_userid;
}
$coltype1_RecordSearchdata = "-1";
if (isset($_POST['oldtype1'])) {
  $coltype1_RecordSearchdata = $_POST['oldtype1'];
}


//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSearchdata = sprintf("SELECT * FROM mail_searchdata WHERE type = %s && userid=%s ORDER BY sortid ASC, id DESC",GetSQLValueString($coltype1_RecordSearchdata, "int"),GetSQLValueString($coluserid_RecordSearchdata, "int"));
$query_limit_RecordSearchdata = sprintf("%s LIMIT %d, %d", $query_RecordSearchdata, $startRow_RecordSearchdata, $maxRows_RecordSearchdata);
$RecordSearchdata = mysqli_query($DB_Conn, $query_limit_RecordSearchdata) or die(mysqli_error($DB_Conn));
$row_RecordSearchdata = mysqli_fetch_assoc($RecordSearchdata);
$totalRows_RecordSearchdata = mysqli_num_rows($RecordSearchdata);

//echo $totalRows_RecordSearchdata;

if ($totalRows_RecordSearchdata > 0) { 

do {

/* 當類別無傳值進來時則給定初始值 */
if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}


  $updateSQL = sprintf("UPDATE mail_searchdata SET type=%s WHERE id=%s",
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($row_RecordSearchdata['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $tipshow = "已更新至新分類<br/>";


} while ($row_RecordSearchdata = mysqli_fetch_assoc($RecordSearchdata));

echo "<script type=\"text/javascript\">swal({ title: '".$tipshow."', text: '', type: 'success',buttonsStyling: false,confirmButtonText: '確認',confirmButtonClass: 'btn btn-primary m-5'});</script>\n";		
}


}

/* 取得類別列表 */
$coluserid_RecordSearchdataListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdataListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSearchdataListType = sprintf("SELECT * FROM mail_searchdataitem WHERE list_id = 1 && userid=%s",GetSQLValueString($coluserid_RecordSearchdataListType, "int"));
$RecordSearchdataListType = mysqli_query($DB_Conn, $query_RecordSearchdataListType) or die(mysqli_error($DB_Conn));
$row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
$totalRows_RecordSearchdataListType = mysqli_num_rows($RecordSearchdataListType);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> Mail搜尋 <small>群組合併</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-exchange-alt"></i> 資料轉移</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <?php if ($_POST['Step'] == '2') { ?>
  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  <div class="form-group row">
          <label class="col-md-2 col-form-label">目標分類(new)<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                    <label for="type1"></label>
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>

<?php if ($_POST['type1'] != $row_RecordSearchdataListType['item_id']) { ?>

                      <option value="<?php echo $row_RecordSearchdataListType['item_id']?>"><?php echo $row_RecordSearchdataListType['itemname']?> - <?php echo $row_RecordSearchdataListType['sdescription']?> - <?php echo $row_RecordSearchdataListType['sdescription']?></option>
                      
<?php } ?>
                      
                      
                      <?php
} while ($row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType));
  $rows = mysqli_num_rows($RecordSearchdataListType);
  if($rows > 0) {
      mysqli_data_seek($RecordSearchdataListType, 0);
	  $row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
  }
?>

                    </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">資料複製轉移</button>
             <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
                    <input name="oldtype1" type="hidden" id="oldtype1" value="<?php echo $_POST['type1']; ?>" />
                    <input name="oldtype2" type="hidden" id="oldtype2" value="<?php echo $_POST['type2']; ?>" />
                    <input name="oldtype3" type="hidden" id="oldtype3" value="<?php echo $_POST['type3']; ?>" />
                    <input name="Step" type="hidden" id="Step" value="3" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="Form_Get" />
  </form>
  <?php } else { ?>

  <form action="<?php echo $editFormAction;?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">來源分類(old)<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                    <label for="type1"></label>
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordSearchdataListType['item_id']?>" ><?php echo $row_RecordSearchdataListType['itemname']?> - <?php echo $row_RecordSearchdataListType['sdescription']?></option>
                      <?php
} while ($row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType));
  $rows = mysqli_num_rows($RecordSearchdataListType);
  if($rows > 0) {
      mysqli_data_seek($RecordSearchdataListType, 0);
	  $row_RecordSearchdataListType = mysqli_fetch_assoc($RecordSearchdataListType);
  }
?>
                    </select>
                    
                    
</div>
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">下一步 - 選擇要放置的目標分類</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="Step" type="hidden" id="Step" value="2" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <?php } ?>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
<?php
mysqli_free_result($RecordSearchdataListType);
?>
