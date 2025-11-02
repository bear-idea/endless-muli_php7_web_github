<?php require_once('../Connections/DB_Conn.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET expricename=%s, expricecomputeselect=%s, expriceuserselect=%s, expricefixed=%s, expricepercent=%s, expricepercentfull=%s, expriceenable=%s WHERE id=%s",
                       GetSQLValueString($_POST['expricename'], "text"),
                       GetSQLValueString($_POST['expricecomputeselect'], "int"),
                       GetSQLValueString($_POST['expriceuserselect'], "int"),
                       GetSQLValueString($_POST['expricefixed'], "text"),
                       GetSQLValueString($_POST['expricepercent'], "text"),
                       GetSQLValueString($_POST['expricepercentfull'], "text"),
                       GetSQLValueString($_POST['expriceenable'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingOtr, "int"));
$RecordSettingOtr = mysqli_query($DB_Conn, $query_RecordSettingOtr) or die(mysqli_error($DB_Conn));
$row_RecordSettingOtr = mysqli_fetch_assoc($RecordSettingOtr);
$totalRows_RecordSettingOtr = mysqli_num_rows($RecordSettingOtr);
?>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 額外費用 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 基本設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post"> 
      <div class="form-group row">
          <label class="col-md-2 col-form-label">額外費用<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="是否要開啟額外費用功能。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['expriceenable'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="expriceenable" id="expriceenable_1" value="0" />
              <label for="expriceenable_1">關閉</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['expriceenable'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="expriceenable" id="expriceenable_2" value="1" />
              <label for="expriceenable_2">開啟 </label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">額外費用名稱</label>
          <div class="col-md-10">
                      <input name="expricename" id="expricename" value="<?php echo $row_RecordSettingOtr['expricename']; ?>" maxlength="10" class="form-control col-md-4 " type="text" data-parsley-trigger="blur" required="" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">額外費用計算方式<span class="text-red">*</span></label>                       	
          <div class="col-md-10">         
                            
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-default">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordSettingOtr['expricecomputeselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="expricecomputeselect" id="expricecomputeselect_1" value="0" />
                      <label for="expricecomputeselect_1" >固定金額 = </label>
                    </div>
                    </span>
                </div>
                
                
                <input name="expricefixed" id="expricefixed" value="<?php echo $row_RecordSettingOtr['expricefixed']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
           
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-default">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordSettingOtr['expricecomputeselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="expricecomputeselect" id="expricecomputeselect_2" value="1" />
              <label for="expricecomputeselect_2">比例金額 = 商品金額 x </label>
                    </div>
                    </span>
                </div>
                <input name="expricepercent" id="expricepercent" value="<?php echo $row_RecordSettingOtr['expricepercent']; ?>" maxlength="3" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="100" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                <div class="input-group-append"><span class="input-group-text">%</span></div>  
            </div>

          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">額外費用選擇<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="當消費者結帳時，一定會計算此額外的費用；當消費者結帳時，可以選擇是否需加入此額外的費用 例如，消費者可以勾選是否需要包裝，需要包裝則結帳時多加 100 元。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['expriceuserselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="expriceuserselect" id="expriceuserselect_1" value="0" />
              <label for="expriceuserselect_1">不可選擇</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['expriceuserselect'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="expriceuserselect" id="expriceuserselect_2" value="1" />
              <label for="expriceuserselect_2">可以選擇 </label>
            </div>
             
          </div>
      </div>
      
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingOtr['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
<!--
function CheckFields()
{	
	if($('input[name=expriceenable]:checked').val() == '1'){
		if($("#expricename").val() == "")
		{
			alert("需填寫額外費用名稱");
			return false;
		}
	}
	if($('input[name=expricecomputeselect]:checked').val() == '0'){
		if($("#expricefixed").val() == "")
		{
			alert("需填寫固定價格");
			return false;
		}
	}
	if($('input[name=expricecomputeselect]:checked').val() == '1'){
		if($("#expricepercent").val() == "")
		{
			alert("需填寫計算百分比");
			return false;
		}
	}
	if($('input[name=expricecomputeselect]:checked').val() == '2'){
		if($("#expricepercentfull").val() == "")
		{
			alert("需填寫計算百分比");
			return false;
		}
	}
}
</script>

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSettingOtr);
?>
