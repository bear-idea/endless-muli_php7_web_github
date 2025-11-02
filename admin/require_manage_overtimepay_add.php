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

/* 取得類別列表 */
$colname_RecordOvertimepayListLevel = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordOvertimepayListLevel = $_GET['lang'];
}
$coluserid_RecordOvertimepayListLevel = "-1";
if (isset($w_userid)) {
  $coluserid_RecordOvertimepayListLevel = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOvertimepayListLevel = sprintf("SELECT * FROM salary_overtimepayitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordOvertimepayListLevel, "text"),GetSQLValueString($coluserid_RecordOvertimepayListLevel, "int"));
$RecordOvertimepayListLevel = mysqli_query($DB_Conn, $query_RecordOvertimepayListLevel) or die(mysqli_error($DB_Conn));
$row_RecordOvertimepayListLevel = mysqli_fetch_assoc($RecordOvertimepayListLevel);
$totalRows_RecordOvertimepayListLevel = mysqli_num_rows($RecordOvertimepayListLevel);

$colname_RecordOvertimepayListTimeSlot = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordOvertimepayListTimeSlot = $_GET['lang'];
}
$coluserid_RecordOvertimepayListTimeSlot = "-1";
if (isset($w_userid)) {
  $coluserid_RecordOvertimepayListTimeSlot = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOvertimepayListTimeSlot = sprintf("SELECT * FROM salary_overtimepayitem WHERE list_id = 2 && lang=%s && (userid=%s || userid=1)", GetSQLValueString($colname_RecordOvertimepayListTimeSlot, "text"),GetSQLValueString($coluserid_RecordOvertimepayListTimeSlot, "int"));
$RecordOvertimepayListTimeSlot = mysqli_query($DB_Conn, $query_RecordOvertimepayListTimeSlot) or die(mysqli_error($DB_Conn));
$row_RecordOvertimepayListTimeSlot = mysqli_fetch_assoc($RecordOvertimepayListTimeSlot);
$totalRows_RecordOvertimepayListTimeSlot = mysqli_num_rows($RecordOvertimepayListTimeSlot);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Overtimepay") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Overtimepay")) {
  $insertSQL = sprintf("INSERT INTO salary_overtimepay (title, level, TimeSlot, calculate, coefficient, FixedAmount, unit, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['TimeSlot'], "text"),
                       GetSQLValueString($_POST['calculate'], "int"),
                       GetSQLValueString($_POST['coefficient'], "int"),
					   GetSQLValueString($_POST['FixedAmount'], "int"),
					   GetSQLValueString($_POST['unit'], "text"),
					   GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_overtimepay.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageOvertimepayEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageOvertimepayEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageOvertimepayEditorSelect == '1' || $ManageOvertimepayEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 加班費表 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
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
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="title" type="text" id="title" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">加班等級<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="level" id="level" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇加班等級 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordOvertimepayListLevel['itemname']?>"><?php echo $row_RecordOvertimepayListLevel['itemname']?></option>
								<?php
				} while ($row_RecordOvertimepayListLevel = mysqli_fetch_assoc($RecordOvertimepayListLevel));
				  $rows = mysqli_num_rows($RecordOvertimepayListLevel);
				  if($rows > 0) {
					  mysqli_data_seek($RecordOvertimepayListLevel, 0);
					  $row_RecordOvertimepayListLevel = mysqli_fetch_assoc($RecordOvertimepayListLevel);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">加班時段<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="TimeSlot" id="TimeSlot" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇加班時段 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordOvertimepayListTimeSlot['itemname']?>"><?php echo $row_RecordOvertimepayListTimeSlot['itemname']?></option>
											  <?php
						} while ($row_RecordOvertimepayListTimeSlot = mysqli_fetch_assoc($RecordOvertimepayListTimeSlot));
						  $rows = mysqli_num_rows($RecordOvertimepayListTimeSlot);
						  if($rows > 0) {
							  mysqli_data_seek($RecordOvertimepayListTimeSlot, 0);
							  $row_RecordOvertimepayListTimeSlot = mysqli_fetch_assoc($RecordOvertimepayListTimeSlot);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">計算基準<span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input name="calculate" type="radio" id="calculate_0" value="0" checked="checked" />
                <label for="calculate_0">固定所得 x 加班係數</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="calculate" id="calculate_1" value="1" />
                <label for="calculate_1">薪資總額 x 加班係數</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="calculate" id="calculate_2" value="2" />
                <label for="calculate_2">固定金額</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">加班係數<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="薪資多1/3代表係數為133；薪資多1/2代表係數為150；薪資多2/3代表係數為166；薪資多2倍代表係數為200。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="input-group p-0">

                   <input name="coefficient" type="number" class="form-control col-md-4" id="coefficient" step="1" value="<?php echo $row_RecordOvertimepay['coefficient']; ?>" data-parsley-min="100" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">%</span></div>
                                      
            </div> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">固定金額<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="當計算基準選擇固定金額時此項值才會套用。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="input-group p-0">

                   <input name="FixedAmount" type="number" class="form-control col-md-4" id="FixedAmount" step="1" value="0" data-parsley-min="0" data-parsley-max="9999999" data-parsley-type="number" data-parsley-trigger="blur" >
                   <div class="input-group-append"><span class="input-group-text">元</span></div>
                                      
            </div> 
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">單位<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="unit" id="unit" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="hour">時</option>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control date-picker" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>    
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
      <input type="hidden" name="MM_insert" value="form_Overtimepay" />
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
mysqli_free_result($RecordOvertimepayListLevel);

mysqli_free_result($RecordOvertimepayListTimeSlot);
?>
