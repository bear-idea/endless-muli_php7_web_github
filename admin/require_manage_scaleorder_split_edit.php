<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../ScriptLibrary/incResize.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->path = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/scaleorder_split";
	$ppu->extensions = "JPG,PNG,GIF,JPEG";
	$ppu->formName = "form_Scaleorder_split";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "3000";
	$ppu->nameConflict = "timeuniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "1500";
	$ppu->maxHeight = "1500";
	$ppu->saveWidth = "";
	$ppu->saveHeight = "";
	$ppu->timeout = "600";
	$ppu->progressBar = "fileCopyProgress.htm";
	$ppu->progressWidth = "300";
	$ppu->progressHeight = "100";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}
$GP_uploadAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING']."&GP_upload=true";
	} else {
		$GP_uploadAction .= "?".$_SERVER['QUERY_STRING'];
	}
} else {
  $GP_uploadAction .= "?"."GP_upload=true";
}

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

// Smart Image Processor 1.0.4
if (isset($_GET['GP_upload'])) {
  $sip = new resizeUploadedFiles($ppu);
  $sip->component = "GD2";
  $sip->resizeImages = "true";
  $sip->aspectImages = "true";
  $sip->maxWidth = "1000";
  $sip->maxHeight = "1000";
  $sip->quality = "100";
  $sip->makeThumb = "true";
  $sip->pathThumb = $SiteImgFilePathAdmin . $_POST['wshop'] . "/image/scaleorder_split/thumb";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = "380";
  $sip->maxHeightThumb = "380";
  $sip->qualityThumb = "100";
  $sip->checkVersion("1.0.4");
  $sip->doResize();
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!preg_match("/GP_upload=true/i", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

/* 取得類別列表 */
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE userid=%s && splitscale=1 ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

$coluserid_RecordCarnumber = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumber = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumber = sprintf("SELECT * FROM erp_carnumber WHERE userid=%s && indicate=1 ORDER BY sortid ASC, code ASC, name ASC",GetSQLValueString($coluserid_RecordCarnumber, "int"));
$RecordCarnumber = mysqli_query($DB_Conn, $query_RecordCarnumber) or die(mysqli_error($DB_Conn));
$row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
$totalRows_RecordCarnumber = mysqli_num_rows($RecordCarnumber);


$colstartdate_RecordSplitorderNowSerialGet = date('Y-m-d');

$dt = new DateTime();
$interval = new DateInterval('P1D');
$dt->add($interval);
$colenddate_RecordSplitorderNowSerialGet = $dt->format('Y-m-d');

$coluserid_RecordSplitorderNowSerialGet = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderNowSerialGet = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderNowSerialGet = sprintf("SELECT * FROM erp_splitorder WHERE postdate BETWEEN %s AND %s && userid=%s", GetSQLValueString($colstartdate_RecordSplitorderNowSerialGet, "date"), GetSQLValueString($colenddate_RecordSplitorderNowSerialGet, "date"),GetSQLValueString($coluserid_RecordSplitorderNowSerialGet, "int"));
$RecordSplitorderNowSerialGet = mysqli_query($DB_Conn, $query_RecordSplitorderNowSerialGet) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderNowSerialGet = mysqli_fetch_assoc($RecordSplitorderNowSerialGet);
$totalRows_RecordSplitorderNowSerialGet = mysqli_num_rows($RecordSplitorderNowSerialGet);

$colname_RecordSplitorder = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSplitorder = $_GET['id_edit'];
}
$coluserid_RecordSplitorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorder = sprintf("SELECT * FROM erp_splitorder WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordSplitorder, "int"),GetSQLValueString($coluserid_RecordSplitorder, "int"));
$RecordSplitorder = mysqli_query($DB_Conn, $query_RecordSplitorder) or die(mysqli_error($DB_Conn));
$row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder);
$totalRows_RecordSplitorder = mysqli_num_rows($RecordSplitorder);

$colname_RecordSplitorderPhoto_before = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSplitorderPhoto_before = $_GET['id_edit'];
}
$coluserid_RecordSplitorderPhoto_before = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderPhoto_before = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderPhoto_before = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s && userid=%s && state='before'", GetSQLValueString($colname_RecordSplitorderPhoto_before, "int"),GetSQLValueString($coluserid_RecordSplitorderPhoto_before, "int"));
$RecordSplitorderPhoto_before = mysqli_query($DB_Conn, $query_RecordSplitorderPhoto_before) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderPhoto_before = mysqli_fetch_assoc($RecordSplitorderPhoto_before);
$totalRows_RecordSplitorderPhoto_before = mysqli_num_rows($RecordSplitorderPhoto_before);

if($totalRows_RecordSplitorderPhoto_before > 0){
	do{
		$SplitorderPhoto_before['id'][] = $row_RecordSplitorderPhoto_before['pid'];
		$SplitorderPhoto_before['pic'][] = $row_RecordSplitorderPhoto_before['pic'];
	} while ($row_RecordSplitorderPhoto_before = mysqli_fetch_assoc($RecordSplitorderPhoto_before));
}

$colname_RecordSplitorderPhoto_after = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSplitorderPhoto_after = $_GET['id_edit'];
}
$coluserid_RecordSplitorderPhoto_after = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderPhoto_after = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderPhoto_after = sprintf("SELECT * FROM erp_splitorderphoto WHERE aid = %s && userid=%s && state='after'", GetSQLValueString($colname_RecordSplitorderPhoto_after, "int"),GetSQLValueString($coluserid_RecordSplitorderPhoto_after, "int"));
$RecordSplitorderPhoto_after = mysqli_query($DB_Conn, $query_RecordSplitorderPhoto_after) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderPhoto_after = mysqli_fetch_assoc($RecordSplitorderPhoto_after);
$totalRows_RecordSplitorderPhoto_after = mysqli_num_rows($RecordSplitorderPhoto_after);

if($totalRows_RecordSplitorderPhoto_after > 0){
	do{
		$SplitorderPhoto_after['id'][] = $row_RecordSplitorderPhoto_after['pid'];
		$SplitorderPhoto_after['pic'][] = $row_RecordSplitorderPhoto_after['pic'];
	} while ($row_RecordSplitorderPhoto_after = mysqli_fetch_assoc($RecordSplitorderPhoto_after));
}

$colname_RecordSplitorderDetailed = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordSplitorderDetailed = $_GET['id_edit'];
}
$coluserid_RecordSplitorderDetailed = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSplitorderDetailed = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorderDetailed = sprintf("SELECT * FROM erp_splitorderdetial WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordSplitorderDetailed, "int"),GetSQLValueString($coluserid_RecordSplitorderDetailed, "int"));
$RecordSplitorderDetailed = mysqli_query($DB_Conn, $query_RecordSplitorderDetailed) or die(mysqli_error($DB_Conn));
$row_RecordSplitorderDetailed = mysqli_fetch_assoc($RecordSplitorderDetailed);
$totalRows_RecordSplitorderDetailed = mysqli_num_rows($RecordSplitorderDetailed);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Scaleorder_split")) {

  $updateSQL = sprintf("UPDATE erp_splitorder SET oserial=%s, startdate=%s, Estimatedday=%s, carnumber=%s, bigweight=%s, enddate=%s, notes1=%s WHERE oid=%s",
                       GetSQLValueString($_POST['oserial'], "text"),
                       GetSQLValueString($_POST['startdate'], "date"),
                       GetSQLValueString($_POST['Estimatedday'], "text"),
					   GetSQLValueString($_POST['carnumber'], "text"),
					   GetSQLValueString($_POST['bigweight'], "text"),
                       GetSQLValueString($_POST['enddate'], "date"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['oid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  for($i=0; $i<count($_POST['pic_before']); $i++) {
	  if($_POST['pic_before'][$i] != "") {	  
		  $insertSQL3 = sprintf("INSERT INTO erp_splitorderphoto (aid, pic, state, lang, userid) VALUES (%s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['oid'], "int"),
							   GetSQLValueString($_POST['pic_before'][$i], "text"),
							   GetSQLValueString("before", "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result3 = mysqli_query($DB_Conn, $insertSQL3) or die(mysqli_error($DB_Conn));
	  }
  }
  
  for($i=0; $i<count($_POST['pic_after']); $i++) {	  
	  if($_POST['pic_after'][$i] != "") {	
		  $insertSQL4 = sprintf("INSERT INTO erp_splitorderphoto (aid, pic, state, lang, userid) VALUES (%s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['oid'], "int"),
							   GetSQLValueString($_POST['pic_after'][$i], "text"),
							   GetSQLValueString("after", "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result4 = mysqli_query($DB_Conn, $insertSQL4) or die(mysqli_error($DB_Conn));
	  }
  }

  foreach ($_POST['title'] as $key => $value) {  
  //
  if($_POST['title'][$key] != "" && ($_POST['weight'][$key] != "" || $_POST['percent'][$key] != "")) {

	  if($_POST['percent'][$key] != "" && $_POST['weight'][$key] == "" && $_POST['bigweight'] != "") { 
		$_POST['weight'][$key] =  $_POST['bigweight'] * $_POST['percent'][$key] * 0.01;
		$_POST['weight'][$key] = round($_POST['weight'][$key]);
	  }
	  
	  if($_POST['percent'][$key] == "" && $_POST['weight'][$key] != "" && $_POST['bigweight'] != "") { 
		$_POST['percent'][$key] = $_POST['weight'][$key] / $_POST['bigweight'] * 100;
		$_POST['percent'][$key] = round($_POST['percent'][$key]);
	  }
		
	  list($pdname, $pdcode) = explode('_', $value);
	  
	  if($_POST['splitdetail_id'][$key] == "") {
		  $insertSQL2 = sprintf("INSERT INTO erp_splitorderdetial (oserial, oid, title, code, weight, percent, postdate, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($_POST['oserial'], "text"),
							   GetSQLValueString($_POST['oid'], "int"),
							   GetSQLValueString($pdname, "text"),
							   GetSQLValueString($pdcode, "text"),
							   GetSQLValueString($_POST['weight'][$key], "text"),
							   GetSQLValueString($_POST['percent'][$key], "text"),
							   GetSQLValueString($_POST['postdate'], "date"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result2 = mysqli_query($DB_Conn, $insertSQL2) or die(mysqli_error($DB_Conn));
	  }else{
		  $updateSQL = sprintf("UPDATE erp_splitorderdetial SET oserial=%s, oid=%s, title=%s, code=%s, weight=%s, percent=%s WHERE id=%s",
							   GetSQLValueString($_POST['oserial'], "text"),
							   GetSQLValueString($_POST['oid'], "int"),
							   GetSQLValueString($pdname, "text"),
							   GetSQLValueString($pdcode, "text"),
							   GetSQLValueString($_POST['weight'][$key], "text"),
							   GetSQLValueString($_POST['percent'][$key], "text"),
							   GetSQLValueString($_POST['splitdetail_id'][$key], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  }
	  
	  
	  
	  }
  }
  
  /* 有物料參數送入 */ 
  
  $_SESSION['DB_Edit'] = "Success";
 
  $updateGoTo = "manage_scaleorder_split.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
} 
?>

<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 拆分紀錄 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>拆分狀態中的重量跟比率可以選擇一種填寫。</b></div>
  
  <form action="<?php echo $editFormAction;?><?php echo '&amp;GP_upload=true'; ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" id="form-split" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-md-2 col-form-label">拆分單號<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="oserial" type="text" class="form-control" id="oserial" value="<?php echo $row_RecordSplitorder['oserial']; ?>" size="50" maxlength="50" data-parsley-trigger="blur" required=""/>    
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">拆分日期<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="startdate" type="text" required="" class="form-control" id="startdate" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/" autocomplete="off" value="<?php echo $row_RecordSplitorder['startdate']; ?>" size="50" maxlength="50" data-parsley-trigger="blur" date-language="zh-TW" />    
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">預估天數</label>
          <div class="col-md-10">
                 
                    <select name="Estimatedday" id="Estimatedday" class="form-control" data-parsley-trigger="blur" >
                <option value="" <?php if (!(strcmp(-1, $row_RecordSplitorder['Estimatedday']))) {echo "selected=\"selected\"";} ?>>-- 選擇天數 --</option>
                <?php for($i=1; $i<=60; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if (!(strcmp($i, $row_RecordSplitorder['Estimatedday']))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?> 天</option>
						<?php } ?>	
				    </select>
                    
 
                   
</div>
      </div>
   
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">車號<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="carnumber" id="carnumber" class="form-control" data-parsley-trigger="blur" required="">
                <option value="" <?php if (!(strcmp(-1, $row_RecordSplitorder['carnumber']))) {echo "selected=\"selected\"";} ?>>-- 選擇車號 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordCarnumber['name']?>" <?php if (!(strcmp($row_RecordCarnumber['name'], $row_RecordSplitorder['carnumber']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCarnumber['name']?></option>
                      <?php
				} while ($row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber));
				  $rows = mysqli_num_rows($RecordCarnumber);
				  if($rows > 0) {
					  mysqli_data_seek($RecordCarnumber, 0);
					  $row_RecordCarnumber = mysqli_fetch_assoc($RecordCarnumber);
				  }
				?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">總重量<span class="text-red">*</span></label>
          <div class="col-md-3">
            <div class="input-group p-0">

                  <input name="bigweight" type="number" required="" class="form-control" id="bigweight" step="0.01" value="<?php echo $row_RecordSplitorder['bigweight']; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="999999" data-parsley-type="number" data-parsley-errors-container="#error_bigweight" data-parsley-trigger="blur">
                      <div class="input-group-append"><span class="input-group-text">公斤</span></div>                
              </div>
              <div id="error_bigweight"></div>
                      
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">完工日期</label>
          <div class="col-md-10">
              <input name="enddate" type="text" class="form-control" id="enddate" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/" autocomplete="off" value="<?php echo $row_RecordSplitorder['enddate']; ?>" size="50" maxlength="50" data-parsley-trigger="blur" date-language="zh-TW" />    
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">拆分前圖片</label>
          <div class="col-md-10">
               <input id="pic_before" name="pic_before[]" type="file" size="50" maxlength="300" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_before" multiple="multiple"/>
               <div id="error_pic_before"></div>
               
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">拆分後圖片</label>
          <div class="col-md-10">
               <input id="pic_after" name="pic_after[]" type="file" size="50" maxlength="300" class="file"  data-parsley-trigger="blur" data-parsley-errors-container="#error_pic_after" multiple="multiple"/>
               <div id="error_pic_after"></div>
               
        </div>
      </div>
      
      <?php 
	  if($totalRows_RecordSplitorderDetailed > 0){
			do{
				$SplitorderDetailed['id'][] = $row_RecordSplitorderDetailed['id'];
				$SplitorderDetailed['title'][] = $row_RecordSplitorderDetailed['title'];
				$SplitorderDetailed['code'][] = $row_RecordSplitorderDetailed['code'];
				$SplitorderDetailed['weight'][] = $row_RecordSplitorderDetailed['weight'];
				$SplitorderDetailed['percent'][] = $row_RecordSplitorderDetailed['percent'];
			} while ($row_RecordSplitorderDetailed = mysqli_fetch_assoc($RecordSplitorderDetailed));
	  }
	  ?>
      <?php for($splitestatecount=0; $splitestatecount<=6; $splitestatecount++) { ?>
      <input name="splitdetail_id[]" type="hidden" id="splitdetail_id[]" value="<?php echo $SplitorderDetailed['id'][$splitestatecount]; ?>" />
      <div class="form-group row split_list">
        <label class="col-md-2 col-form-label">拆分狀態</label>
          <div class="col-md-3">
                 <div class="input-group p-0 split_title">
                 <div class="input-group-prepend"><span class="input-group-text">物料</span></div>
                    <select name="title[]" id="title[]" class="form-control" data-parsley-trigger="blur">
                <option value="" <?php if (!(strcmp(-1, $SplitorderDetailed['title'][$splitestatecount]))) {echo "selected=\"selected\"";} ?>>-- 選擇物料 --</option>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordScale['name']?>_<?php echo $row_RecordScale['code']?>" <?php if (!(strcmp($row_RecordScale['code'], $SplitorderDetailed['code'][$splitestatecount]))) {echo "selected=\"selected\"";} ?>>[<?php echo $row_RecordScale['code']?>] <?php echo $row_RecordScale['name']?></option>
                      <?php
				} while ($row_RecordScale = mysqli_fetch_assoc($RecordScale));
				  $rows = mysqli_num_rows($RecordScale);
				  if($rows > 0) {
					  mysqli_data_seek($RecordScale, 0);
					  $row_RecordScale = mysqli_fetch_assoc($RecordScale);
				  }
				?>
                    </select>
                    </div>
                    
 
                   
</div>


          <div class="col-md-2">
            <div class="input-group p-0 split_weight">
              <div class="input-group-prepend"><span class="input-group-text">重量</span></div>
                  <input name="weight[]" type="number" class="form-control" id="weight[]" step="0.01" value="<?php echo $SplitorderDetailed['weight'][$splitestatecount]; ?>" maxlength="11" data-parsley-min="0" data-parsley-max="999999" data-parsley-type="number" data-parsley-errors-container="#error_weight<?php echo $splitestatecount; ?>" data-parsley-trigger="blur">
                      <div class="input-group-append"><span class="input-group-text">公斤</span></div>                
            </div>
              <div id="error_weight<?php echo $splitestatecount; ?>"></div>
                      
          </div>
          
          
          <div class="col-md-2 split_percent">
                 <div class="input-group p-0">
                 <div class="input-group-prepend"><span class="input-group-text">比例</span></div>
                    <select name="percent[]" id="percent[]" class="form-control" data-parsley-errors-container="#error_percent<?php echo $$splitestatecount; ?>" data-parsley-trigger="blur">
                <option value="" <?php if (!(strcmp(-1, $SplitorderDetailed['percent'][$splitestatecount]))) {echo "selected=\"selected\"";} ?>>-- 選擇百分比 --</option>
                <?php for($i=1; $i<=100; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if (!(strcmp($i, $SplitorderDetailed['percent'][$splitestatecount]))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
						<?php } ?>	
				    </select>
                    <div class="input-group-append"><span class="input-group-text">%</span></div>
                    
 
                </div> 
                <div id="error_percent<?php echo $$splitestatecount; ?>"></div>  
         </div>
         <?php $i++; ?>
          
      </div>
      <?php } ?>
      
      <div id="clone_split_sub">
      </div>
      
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordSplitorder['notes1']; ?>" size="50" maxlength="300"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input name="author" type="hidden" id="author" value="<?php echo $row_RecordAccount['truename'] ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="oid" type="hidden" id="oid" value="<?php echo $row_RecordSplitorder['oid']; ?>" />
            <input name="postdate" type="hidden" id="author" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Scaleorder_split" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
<script>
<?php 
/*
文檔
https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
*/
?>
$(document).ready(function() {
	$("#pic_before").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步(true) 此为同步(false)
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文檔後綴
		//resizeImage: true,
		maxImageWidth: 1500,
		maxImageHeight: 1500,
		//resizePreference: 'width',
		//maxFileCount:10,
		maxFileSize: 3000,
		overwriteInitial: false, // 上傳圖片時是否會覆蓋預覽圖  
		showRemove :true, //显示移除按钮
		initialPreview: [<?php for($i=0; $i<count($SplitorderPhoto_before['id']); $i++) { echo "'" . $SiteImgUrlAdmin . $wshop ."/image/scaleorder_split/" . $SplitorderPhoto_before['pic'][$i] .  "'"; if((count($SplitorderPhoto_before['id'])-1) != $i) { echo ","; } } ?>],
		initialPreviewConfig: [<?php for($i=0; $i<count($SplitorderPhoto_before['id']); $i++) { echo "{url: 'sqldatatable/scaleorder_split_photo_del.php?id_del=".$SplitorderPhoto_before['id'][$i]."', key: ".$SplitorderPhoto_before['id'][$i].", extra: {id:".$SplitorderPhoto_before['id'][$i]."} }"; if((count($SplitorderPhoto_before['id'])-1) != $i) { echo ","; } } ?>],
		initialPreviewAsData: true // 确定你是否仅发送预览数据，而不是原始标记
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		}).on('filepredelete', function(event, id) {
			//console.log(id);
			//return new Promise(function(resolve, reject) {
			var aborted = !window.confirm("確定删除? 此動作將無法恢復。");
			if (aborted) {	
			    //window.alert('File deletion was aborted! ');
				/*swal({
					title: '確定删除?',
					text: "此動作將無法恢復。",
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: '取消',
					confirmButtonText: '確定',
					showLoaderOnConfirm: true,
					buttonsStyling: false,
					confirmButtonClass: 'btn btn-danger m-5',
					cancelButtonClass: 'btn btn-default m-5',
					preConfirm: function() {},
					allowOutsideClick: false
				});*/
				return aborted;
			}
			//});
		}).on('filedeleted', function() {
			//setTimeout(function() {
				swal({
                        title: '已刪除',
                        text: '資料刪除成功！',
                        type: 'success',
						buttonsStyling: false,
						confirmButtonText: '確定',
						confirmButtonClass: "btn btn-primary m-5"
                    })
			//}, 900);
		});
		
		
		$("#pic_after").fileinput({
		showUpload:true, 
		uploadAsync: false, //设置上传同步异步(true) 此为同步(false)
		//uploadUrl: "index.php", //上传的地址  
		allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文檔後綴
		//resizeImage: true,
		maxImageWidth: 1500,
		maxImageHeight: 1500,
		//resizePreference: 'width',
		//maxFileCount:10,
		maxFileSize: 3000,  
		overwriteInitial: false, // 上傳圖片時是否會覆蓋預覽圖  
		showRemove :true, //显示移除按钮
		initialPreview: [<?php for($i=0; $i<count($SplitorderPhoto_after['id']); $i++) { echo "'" . $SiteImgUrlAdmin . $wshop ."/image/scaleorder_split/" . $SplitorderPhoto_after['pic'][$i] .  "'"; if((count($SplitorderPhoto_after['id'])-1) != $i) { echo ","; } } ?>],
		initialPreviewConfig: [<?php for($i=0; $i<count($SplitorderPhoto_after['id']); $i++) { echo "{url: 'sqldatatable/scaleorder_split_photo_del.php?id_del=".$SplitorderPhoto_after['id'][$i]."', key: ".$SplitorderPhoto_after['id'][$i].", extra: {id:".$SplitorderPhoto_after['id'][$i]."} }"; if((count($SplitorderPhoto_after['id'])-1) != $i) { echo ","; } } ?>],
		initialPreviewAsData: true // 确定你是否仅发送预览数据，而不是原始标记
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		}).on('filepredelete', function(event, id) {
			//console.log(id);
			//return new Promise(function(resolve, reject) {
			//if (window.confirm==true)
			var aborted = !window.confirm("確定删除? 此動作將無法恢復。");
			if (aborted) {	
				/*swal({
					title: '確定删除?',
					text: "此動作將無法恢復。",
					type: 'warning',
					showCancelButton: true,
					cancelButtonText: '取消',
					confirmButtonText: '確定',
					showLoaderOnConfirm: true,
					buttonsStyling: false,
					confirmButtonClass: 'btn btn-danger m-5',
					cancelButtonClass: 'btn btn-default m-5',
					preConfirm: function() {},
					allowOutsideClick: false
				});
				return aborted;*/
			}
			//});
		}).on('filedeleted', function() {
			//setTimeout(function() {
				swal({
                        title: '已刪除',
                        text: '資料刪除成功！',
                        type: 'success',
						buttonsStyling: false,
						confirmButtonText: '確定',
						confirmButtonClass: "btn btn-primary m-5"
                    })
			//}, 900);
		});

});
</script>

<script>
$(document).ready(function() {
	
  $('#startdate, #enddate').datetimepicker({
	   locale:moment.locale("zh-tw"),
	   format:'YYYY-MM-DD HH:mm:ss',
  }).on('dp.change', function(e) { 
			 $(this).parsley().validate(); 
  }); 
  
});
</script>

  
<?php
mysqli_free_result($RecordScale);

mysqli_free_result($RecordCarnumber);

mysqli_free_result($RecordSplitorderNowSerialGet);

mysqli_free_result($RecordSplitorder);

mysqli_free_result($RecordSplitorderPhoto_before);

mysqli_free_result($RecordSplitorderPhoto_after);

mysqli_free_result($RecordSplitorderDetailed);
?>
