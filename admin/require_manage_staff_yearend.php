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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Staff")) {
  $updateSQL = sprintf("UPDATE salary_staff SET bonusYearendtype=%s, bonusYearendprice=%s, bonusYearendparameter1=%s, bonusYearendpricebasic=%s, bonusYearendparameter2=%s, bonusspecialindicate=%s, bonusspecialtype=%s, bonusspecialprice=%s, bonusYearendparameterprice=%s, monthprice=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['bonusYearendtype'], "int"),
                       GetSQLValueString($_POST['bonusYearendprice'], "text"),
                       GetSQLValueString($_POST['bonusYearendparameter1'], "text"),
                       GetSQLValueString($_POST['bonusYearendpricebasic'], "text"),
                       GetSQLValueString($_POST['bonusYearendparameter2'], "text"),
                       GetSQLValueString($_POST['bonusspecialindicate'], "int"),
                       GetSQLValueString($_POST['bonusspecialtype'], "int"),
                       GetSQLValueString($_POST['bonusspecialprice'], "text"),
                       GetSQLValueString($_POST['bonusYearendparameterprice'], "text"),
                       GetSQLValueString($_POST['monthprice'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_staff.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得最新訊息資料 */
$colname_RecordStaff = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordStaff = $_GET['id_edit'];
}
$coluserid_RecordStaff = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStaff = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordStaff, "int"),GetSQLValueString($coluserid_RecordStaff, "int"));
$RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff) or die(mysqli_error($DB_Conn));
$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
$totalRows_RecordStaff = mysqli_num_rows($RecordStaff);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageStaffEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageStaffEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageStaffEditorSelect == '1' || $ManageStaffEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 新資規則 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>年終獎金：依勞基法施行細則第十條：「本公司視當年度營運狀況，於年度終了時得發與員工1.5個月年終獎金，員工服務未滿三3個月者不發與年終獎金；員工服務滿三3個月未滿1年者，年終獎金按實際服務時日依比例遞減發給，計算基準為：月薪 x 1.5個月 / 12個月ｘ實際工作月份，當月未滿一個月者以(30-到職日+1) / 30計算。」。</b></div>
  
  <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>年終獎金 = 基本年終 + 特別加給</b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 年終獎金</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">月薪</label>
          <div class="col-md-10">
          
            <div class="input-group m-b-10">

                <input name="monthprice" id="monthprice" value="<?php echo $row_RecordStaff['monthprice']; ?>" maxlength="11" class="form-control col-md-4 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
              <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
            
        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">基本年終<span class="text-red">*</span></label>
          <div class="col-md-10">
                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusYearendtype'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusYearendtype" id="bonusYearendtype_0" value="0" required="" />
                  <label for="bonusYearendtype_0" class="p-b-5">無</label>
                        </div>
                        </span>
                    </div>

 
                </div>
                
                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusYearendtype'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusYearendtype" id="bonusYearendtype_1" value="1" required="" />
                  <label for="bonusYearendtype_1">固定年終</label>
                        </div>
                        </span>
                    </div>
                    
                    
                    <input name="bonusYearendprice" id="bonusYearendprice" value="<?php echo $row_RecordStaff['bonusYearendprice']; ?>" maxlength="11" class="form-control col-md-4 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                    <div class="input-group-append"><span class="input-group-text">元 </span></div>
 
                </div>
                
                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusYearendtype'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusYearendtype" id="bonusYearendtype_2" value="2" required="" />
                  <label for="bonusYearendtype_2" class="p-b-5">月薪 x</label>
                        </div>
                        </span>
                    </div>
                    <select name="bonusYearendparameter1" id="bonusYearendparameter1" class="form-control col-md-1" data-parsley-trigger="blur">
                        <?php for($i=0.5; $i<=5; $i+=0.1) { ?>
                		<option value="<?php echo $i; ?>" <?php if (!(strcmp($row_RecordStaff['bonusYearendparameter1'],$i))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
                		<?php } ?>
				    </select>
                    <div class="input-group-append"><span class="input-group-text">個月 x (今年工作月份 / 12個月) </span></div>

 
                </div>
                
                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusYearendtype'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusYearendtype" id="bonusYearendtype_3" value="3" required="" />
                  <label for="bonusYearendtype_3">自訂金額</label>
                        </div>
                        </span>
                    </div>
                    
                    
                    <input name="bonusYearendpricebasic" id="bonusYearendpricebasic" value="<?php echo $row_RecordStaff['bonusYearendpricebasic']; ?>" maxlength="11" class="form-control col-md-1 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                    <div class="input-group-append"><span class="input-group-text">元 x </span></div>
                    <select name="bonusYearendparameter2" id="bonusYearendparameter2" class="form-control col-md-1" data-parsley-trigger="blur">
                        <?php for($i=0.1; $i<=5; $i+=0.1) { ?>
                		<option value="<?php echo $i; ?>"<?php if (!(strcmp($row_RecordStaff['bonusYearendparameter2'],$i))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
                		<?php } ?>
				    </select>
                    <div class="input-group-append"><span class="input-group-text">倍 x (今年工作月份 / 12個月)</span></div>
 
                </div>
                      
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">特別加給計算條件<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input type="radio" name="bonusspecialindicate" id="bonusspecialindicate_0" value="0" <?php if (!(strcmp($row_RecordStaff['bonusspecialindicate'],"0"))) {echo "checked=\"checked\"";} ?>/>
              <label for="bonusspecialindicate_0">年資不限</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="bonusspecialindicate" id="bonusspecialindicate_1" value="1" <?php if (!(strcmp($row_RecordStaff['bonusspecialindicate'],"1"))) {echo "checked=\"checked\"";} ?>/>
              <label for="bonusspecialindicate_1">年資須大於一年</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">年資尾數計算準則<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input type="radio" name="dayruletype" id="dayruletype_0" value="0" <?php if (!(strcmp($row_RecordStaff['dayruletype'],"0"))) {echo "checked=\"checked\"";} ?>/>
              <label for="dayruletype_0"> 小餘30日不列入年終計算</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="dayruletype" id="dayruletype_1" value="1" <?php if (!(strcmp($row_RecordStaff['dayruletype'],"1"))) {echo "checked=\"checked\"";} ?>/>
              <label for="dayruletype_1">15日~30日年終以加一個月計算 </label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="dayruletype" id="dayruletype_2" value="2" <?php if (!(strcmp($row_RecordStaff['dayruletype'],"2"))) {echo "checked=\"checked\"";} ?>/>
              <label for="dayruletype_2">大餘1日年終以加半個月計算 </label>
            </div>
            <div class="radio radio-css radio-inline">
              <input type="radio" name="dayruletype" id="dayruletype_3" value="3" <?php if (!(strcmp($row_RecordStaff['dayruletype'],"3"))) {echo "checked=\"checked\"";} ?>/>
              <label for="dayruletype_3">大餘1日年終以加一個月計算 </label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">特別加給<span class="text-red">*</span></label>
          <div class="col-md-10">
                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusspecialtype'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusspecialtype" id="bonusspecialtype_0" value="0" required="" />
                  <label for="bonusspecialtype_0" class="p-b-5">無</label>
                        </div>
                        </span>
                    </div>

 
                </div>
                
                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusspecialtype'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusspecialtype" id="bonusspecialtype_1" value="1" required="" />
                  <label for="bonusspecialtype_1">固定加給</label>
                        </div>
                        </span>
                    </div>
                    
                    
                    <input name="bonusspecialprice" id="bonusspecialprice" value="<?php echo $row_RecordStaff['bonusspecialprice']; ?>" maxlength="11" class="form-control col-md-4 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                    <div class="input-group-append"><span class="input-group-text">元 </span></div>
 
                </div>

                <div class="input-group m-b-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text label label-default">
                        <div class="radio radio-css radio-inline">
                          <input <?php if (!(strcmp($row_RecordStaff['bonusspecialtype'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="bonusspecialtype" id="bonusspecialtype_2" value="2" required="" />
                  <label for="bonusspecialtype_2">年資 x </label>
                        </div>
                        </span>
                    </div>
                    <input name="bonusYearendparameterprice" id="bonusYearendparameterprice" value="<?php echo $row_RecordStaff['bonusYearendparameterprice']; ?>" maxlength="11" class="form-control col-md-1 parsley-success" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" >
                    
                    <div class="input-group-append"><span class="input-group-text">元 </span></div>
 
                </div>
                      
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordStaff['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordStaff['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Staff" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate,#arrivaldate,#leavedate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<script type="text/javascript">
<!--
function CheckFields()
{	
	
	if($('input[name=bonusYearendtype]:checked').val() == '1'){
		if($("#bonusYearendprice").val() == "")
		{
			alert("需填寫固定年終");
			return false;
		}
	}
	
	if($('input[name=bonusYearendtype]:checked').val() == '2'){
		if($("#monthprice").val() == "")
		{
			alert("需填寫月薪");
			return false;
		}
	}
	
	if($('input[name=bonusYearendtype]:checked').val() == '3'){
		if($("#bonusYearendpricebasic").val() == "")
		{
			alert("需填寫自訂金額");
			return false;
		}
		
		if($("#bonusYearendparameterprice").val() == "")
		{
			alert("需填寫年資加給");
			return false;
		}
	}
}
</script>

<?php
mysqli_free_result($RecordStaff);
?>
