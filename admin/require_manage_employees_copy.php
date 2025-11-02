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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Employees")) {
  $insertSQL = sprintf("INSERT INTO demo_employees (title, type, cellphone, mail, postdate, indicate, sdescription, skeyword, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['cellphone'], "text"),
					   GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_employees.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
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
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 員工管理 <small>複增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-copy"></i> 複增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordEmployees['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
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
          <label class="col-md-2 col-form-label">手機</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" class="form-control" id="cellphone" value="<?php echo $row_RecordEmployees['cellphone']; ?>" maxlength="30" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>

      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件</label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" value="<?php echo $row_RecordEmployees['email']; ?>" maxlength="100" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
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
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required="" autocomplete="off"/> 
                 
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
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Employees" />
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
