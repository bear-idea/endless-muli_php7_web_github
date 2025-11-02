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

/* 更新資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Attendance")) {
  $updateSQL = sprintf("UPDATE salary_attendance SET code=%s, title=%s, calculate=%s, coefficient=%s, FixedAmount=%s, postdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['code'], "text"),
					   GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['calculate'], "int"),
                       GetSQLValueString($_POST['coefficient'], "int"),
					   GetSQLValueString($_POST['FixedAmount'], "int"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_attendance.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得最新訊息資料 */
$colname_RecordAttendance = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordAttendance = $_GET['id_edit'];
}
$coluserid_RecordAttendance = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAttendance = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttendance = sprintf("SELECT * FROM salary_attendance WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordAttendance, "int"),GetSQLValueString($coluserid_RecordAttendance, "int"));
$RecordAttendance = mysqli_query($DB_Conn, $query_RecordAttendance) or die(mysqli_error($DB_Conn));
$row_RecordAttendance = mysqli_fetch_assoc($RecordAttendance);
$totalRows_RecordAttendance = mysqli_num_rows($RecordAttendance);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageAttendanceEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageAttendanceEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageAttendanceEditorSelect == '1' || $ManageAttendanceEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i>  出勤紀錄 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>勞動基準法第30條：勞工每日正常工作時間不得超過8小時，每週正常工作時數不得超過40小時。</b></div>
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>勞動基準法第32條：雇主延長勞工之工作時間連同正常工作時間，1日不得超過12小時。延長之工作時間，1個月不得超過46小時</b></div>
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>平常上班日、休息日:前2小時：原時薪+ (原時薪 x 1/3) ; 第3小時起之後每小時： 原時薪 + (原時薪 x 2/3)</b></div>
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>國定假日、例假日(未滿8小時也以1天計) 加班費=原日薪 x 2 「例假日」除給加班費，還要再讓勞工補休一天</b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">假別代號<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="code" type="text" required="" class="form-control" id="code" value="<?php echo $row_RecordAttendance['code']; ?>" maxlength="100" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordAttendance['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">計算基準<span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordAttendance['calculate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="calculate" id="calculate_0" value="0" />
                <label for="calculate_0">固定所得-(固定所得x扣款係數)</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordAttendance['calculate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="calculate" id="calculate_1" value="1" />
                <label for="calculate_1">薪資總額-(薪資總額x扣款係數)</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordAttendance['calculate'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="calculate" id="calculate_2" value="2" />
                <label for="calculate_2">固定金額</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">扣款係數<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="該假別薪資少1/2代表係數為50；該假別無薪資代表係數為100；該假別不扣薪資代表係數為0。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="input-group p-0">

                   <input name="coefficient" type="number" class="form-control col-md-4" id="coefficient" step="1" value="<?php echo $row_RecordAttendance['coefficient']; ?>" data-parsley-min="100" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">%</span></div>
                                      
            </div> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">固定金額<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="當計算基準選擇固定金額時此項值才會套用。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="input-group p-0">

                   <input name="FixedAmount" type="number" class="form-control col-md-4" id="FixedAmount" step="1" value="<?php echo $row_RecordAttendance['FixedAmount']; ?>" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">元</span></div>
                                      
            </div> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordAttendance['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordAttendance['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordAttendance['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordAttendance['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordAttendance['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordAttendance['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Attendance" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
			$("#change_unit01").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:left;\" />");
			});
			
			$("#change_unit02").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:right;\" />");
			});
			
			$("#change_unit03").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:none;\" /><br />");
			});
			
			$("#change_unit04").click(function(){
					CKEDITOR.instances.content.insertHtml("<p style=\"text-align:center\"><img alt=\"\" height=\"180\" src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" style=\"display: block; margin: auto;\" width=\"240\" /></p>");
			});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<?php
mysqli_free_result($RecordAttendance);
?>
