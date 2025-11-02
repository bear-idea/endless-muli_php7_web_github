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

$colname_RecordScale = "-1";
if (isset($_GET['code'])) {
  $colname_RecordScale = $_GET['code'];
}
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

$colname_RecordScalePricelist = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordScalePricelist = $_GET['id_edit'];
}
$coluserid_RecordScalePricelist = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalePricelist = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScalePricelist = sprintf("SELECT * FROM erp_scalepricelist WHERE id = %s", GetSQLValueString($colname_RecordScalePricelist, "int"));
$RecordScalePricelist = mysqli_query($DB_Conn, $query_RecordScalePricelist) or die(mysqli_error($DB_Conn));
$row_RecordScalePricelist = mysqli_fetch_assoc($RecordScalePricelist);
$totalRows_RecordScalePricelist = mysqli_num_rows($RecordScalePricelist);

$colname_RecordManufacturer = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordManufacturer = $_GET['lang'];
}
$coluserid_RecordManufacturer = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturer = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturer = sprintf("SELECT * FROM erp_manufacturer WHERE lang=%s && userid=%s && indicate=1", GetSQLValueString($colname_RecordManufacturer, "text"),GetSQLValueString($coluserid_RecordManufacturer, "int"));
$RecordManufacturer = mysqli_query($DB_Conn, $query_RecordManufacturer) or die(mysqli_error($DB_Conn));
$row_RecordManufacturer = mysqli_fetch_assoc($RecordManufacturer);
$totalRows_RecordManufacturer = mysqli_num_rows($RecordManufacturer);


/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Scalepricelist")) {
  $updateSQL = sprintf("UPDATE erp_scalepricelist SET name=%s, code=%s, price=%s, mode=%s, startdate=%s, enddate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString(htmlspecialchars($_POST['name']), "text"),
                       GetSQLValueString($_POST['code'], "text"),
					   GetSQLValueString($_POST['price'], "text"),
					   GetSQLValueString($_POST['mode'], "int"),
					   GetSQLValueString($_POST['startdate'], "date"),
					   GetSQLValueString($_POST['enddate'], "date"),
                       GetSQLValueString(htmlspecialchars($_POST['notes1']), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";
 
  $updateGoTo = "inner_scale.php?Opt=pricelist&lang=" . $_POST['lang']."&code=" . $_GET['code']."&id=" . $_POST['id'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 物料價格 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="inner_scale.php?wshop=<?php echo $wshop; ?>&amp;Opt=pricelist&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;code=<?php echo $_GET['code']; ?>&amp;id=<?php echo $row_RecordScale['id']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" required="" class="form-control" id="name" value="<?php echo $row_RecordScalePricelist['name']; ?>" maxlength="200" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">價格<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="price" type="number" required="required" class="form-control col-md-4" id="price" step="0.1" value="<?php echo $row_RecordScalePricelist['price']; ?>" maxlength="11" data-parsley-min="-9999999" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur"/>
                      
                 
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">日期範圍<span class="text-red">*</span></label>
          <div class="col-md-10">
              <div class="input-group input-daterange">
                  <input  name="startdate" type="text" required="" class="form-control" id="startdate" autocomplete="off" value="<?php echo $row_RecordScalePricelist['startdate']; ?>" data-parsley-trigger="blur" data-date-language="zh-TW" data-provide="datepicker" data-date-format="yyyy-mm-dd"/>
                  <span class="input-group-addon">to</span>
                  <input name="enddate" type="text" required="" class="form-control" id="enddate" autocomplete="off" value="<?php echo $row_RecordScalePricelist['enddate']; ?>" data-provide="datepicker" data-date-format="yyyy-mm-dd"  data-parsley-trigger="blur" data-date-language="zh-TW"/> 
              </div>
              
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">計費方式<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordScalePricelist['mode'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="mode" id="mode_1" value="0" />
                <label for="mode_1">依重量</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordScalePricelist['mode'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="mode" id="mode_2" value="1" />
                <label for="mode_2">依趟次</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordScalePricelist['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordScalePricelist['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordScalePricelist['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input name="code" type="hidden" id="code" value="<?php echo $_GET['code']; ?>" />
            <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Scalepricelist" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.input-daterange').datepicker({
			language: "zh-TW",
			todayHighlight: true,
			format: 'yyyy-mm-dd'
 	    }); 
		
		$('#startdate, #endtdate').datepicker({
		    }).on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<?php
mysqli_free_result($RecordScale);

mysqli_free_result($RecordScalePricelist);
?>
