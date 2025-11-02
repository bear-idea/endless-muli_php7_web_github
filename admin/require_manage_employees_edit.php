<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Employees")) {
  
  $_POST['serviceid']=implode(",",$_POST['serviceid']);
   
  $updateSQL = sprintf("UPDATE demo_employees SET name=%s, type=%s, serviceid=%s, cellphone=%s, mail=%s, postdate=%s, indicate=%s, sdescription=%s, skeyword=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['serviceid'], "text"),
					   GetSQLValueString($_POST['cellphone'], "text"),
					   GetSQLValueString($_POST['mail'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_employees.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordEmployeesListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordEmployeesListType = $_GET["lang"];
}
$coluserid_RecordEmployeesListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployeesListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployeesListType = sprintf("SELECT * FROM demo_employeesitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordEmployeesListType, "text"),GetSQLValueString($coluserid_RecordEmployeesListType, "int"));
$RecordEmployeesListType = mysqli_query($DB_Conn, $query_RecordEmployeesListType) or die(mysqli_error($DB_Conn));
$row_RecordEmployeesListType = mysqli_fetch_assoc($RecordEmployeesListType);
$totalRows_RecordEmployeesListType = mysqli_num_rows($RecordEmployeesListType);

/* 取得最新訊息資料 */
$colname_RecordEmployees = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordEmployees = $_GET['id_edit'];
}
$coluserid_RecordEmployees = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployees = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployees = sprintf("SELECT * FROM demo_employees WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordEmployees, "int"),GetSQLValueString($coluserid_RecordEmployees, "int"));
$RecordEmployees = mysqli_query($DB_Conn, $query_RecordEmployees) or die(mysqli_error($DB_Conn));
$row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees);
$totalRows_RecordEmployees = mysqli_num_rows($RecordEmployees);

$collang_RecordService = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordService = $_GET['lang'];
}
$coluserid_RecordService = "-1";
if (isset($w_userid)) {
  $coluserid_RecordService = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordService = sprintf("SELECT * FROM demo_service WHERE userid=%s && lang=%s",GetSQLValueString($coluserid_RecordService, "int"),GetSQLValueString($collang_RecordService, "int"));
$RecordService = mysqli_query($DB_Conn, $query_RecordService) or die(mysqli_error($DB_Conn));
$row_RecordService = mysqli_fetch_assoc($RecordService);
$totalRows_RecordService = mysqli_num_rows($RecordService);

?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 員工管理 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="title" value="<?php echo $row_RecordEmployees['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordEmployees['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordEmployeesListType['itemname']?>"<?php if (!(strcmp($row_RecordEmployeesListType['itemname'], $row_RecordEmployees['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordEmployeesListType['itemname']?></option>
                  <?php
} while ($row_RecordEmployeesListType = mysqli_fetch_assoc($RecordEmployeesListType));
  $rows = mysqli_num_rows($RecordEmployeesListType);
  if($rows > 0) {
      mysqli_data_seek($RecordEmployeesListType, 0);
	  $row_RecordEmployeesListType = mysqli_fetch_assoc($RecordEmployeesListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">服務項目</label>
          <div class="col-md-10">
              <select name="serviceid[]" id="serviceid[]" class="form-control selectpicker" data-parsley-trigger="blur" multiple="multiple" data-live-search="true" required="">
              <?php 
			  	$serviceid = explode(",", $row_RecordEmployees['serviceid']); 
			  ?>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordService['id']?>" <?php if ((in_array($row_RecordService['id'], $serviceid))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordService['name']?></option>
                  <?php
} while ($row_RecordService = mysqli_fetch_assoc($RecordService));
  $rows = mysqli_num_rows($RecordService);
  if($rows > 0) {
      mysqli_data_seek($RecordService, 0);
	  $row_RecordService = mysqli_fetch_assoc($RecordService);
  }
?>
                </select>  
                 
          </div>
      </div>
	  
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">手機</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" class="form-control" id="cellphone" value="<?php echo $row_RecordEmployees['cellphone']; ?>" maxlength="30" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>

      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件</label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" value="<?php echo $row_RecordEmployees['mail']; ?>" maxlength="100" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">      
          <a href="uplod_employees.php?id_edit=<?php echo $row_RecordEmployees['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>                    
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordEmployees['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordEmployees['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordEmployees['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordEmployees['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordEmployees['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordEmployees['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordEmployees['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordEmployees['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row_RecordEmployees['pic']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Employees" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<?php
mysqli_free_result($RecordEmployeesListType);

mysqli_free_result($RecordEmployees);
?>
