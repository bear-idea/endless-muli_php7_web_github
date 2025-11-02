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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET invoiceenable=%s, invoiceformat1=%s, invoiceformat2=%s, invoiceformat3=%s, invoiceformat4=%s, invoiceformat5=%s, invoiceburden=%s, burdenuserdecide=%s, invoicedesc=%s WHERE id=%s",
                       GetSQLValueString($_POST['invoiceenable'], "int"),
                       GetSQLValueString(isset($_POST['invoiceformat1']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['invoiceformat2']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['invoiceformat3']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['invoiceformat4']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['invoiceformat5']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['invoiceburden'], "int"),
                       GetSQLValueString(isset($_POST['burdenuserdecide']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['invoicedesc'], "text"),
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
<!-- fck編輯器 -->

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'invoicedesc',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : 'Full'} );
};
</script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 發票 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  
      <div class="form-group row">
          <label class="col-md-2 col-form-label">是否需開立發票<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="選擇開發票則會出現發票格式欄位供購買者填寫。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceenable'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="invoiceenable" id="invoiceenable_1" value="0" />
              <label for="invoiceenable_1">不開發票</label>
            </div>
            <div class="radio radio-css ">
              <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceenable'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="invoiceenable" id="invoiceenable_2" value="1" />
              <label for="invoiceenable_2">開立發票 </label>
            </div>
            
            <div class="alert alert-secondary fade show m-t-10 m-l-25">
              
              <div><strong><i class="fa fa-exclamation-circle"></i> 啟用的發票格式</strong></div>

              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceformat1'],1))) {echo "checked=\"checked\"";} ?> name="invoiceformat1" type="checkbox" id="invoiceformat1" value="1" />
                  <label for="invoiceformat1">二聯式發票</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceformat2'],1))) {echo "checked=\"checked\"";} ?> name="invoiceformat2" type="checkbox" id="invoiceformat2" value="1"  />
                  <label for="invoiceformat2">三聯式發票</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceformat3'],1))) {echo "checked=\"checked\"";} ?> name="invoiceformat3" type="checkbox" id="invoiceformat3" value="1"  />
                  <label for="invoiceformat3">電子式發票</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceformat4'],1))) {echo "checked=\"checked\"";} ?> name="invoiceformat4" type="checkbox" id="invoiceformat4" value="1" />
                  <label for="invoiceformat4">收據</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceformat5'],1))) {echo "checked=\"checked\"";} ?> name="invoiceformat5" type="checkbox" id="invoiceformat5" value="1" />
                  <label for="invoiceformat5">捐給慈善單位</label>
              </div>
              
              <div><small class="f-s-12 text-grey-darker">購物車中會出現 <u>發票格式</u>、<u>發票收件人</u>、<u>發票地址</u>、<u>公司抬頭</u>、<u>統編</u> 欄位讓消費者填寫。</small></div>
          
              
              
            </div>
            
            <div class="alert alert-secondary fade show m-t-10 m-l-25">
            
              <div><strong><i class="fa fa-exclamation-circle"></i> 發票稅5%由誰負擔? (營業稅)</strong></div>
              
              <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceburden'],0))) {echo "checked=\"checked\"";} ?> type="radio" name="invoiceburden" id="invoiceburden_1" value="0" data-parsley-multiple="invoiceburden">
                <label for="invoiceburden_1">店家負擔【結帳時不需外加5%】</label>
              </div>
              <br>
              <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSettingOtr['invoiceburden'],1))) {echo "checked=\"checked\"";} ?> type="radio" name="invoiceburden" id="invoiceburden_2" value="1" data-parsley-multiple="invoiceburden">

                <label for="invoiceburden_2">消費者負擔【結帳時需外加5%】</label>
              </div>
              <div class="row m-l-10 m-t-10">
                    <div class="col-md-12">
                        <div class="input-group p-0">
                        
                          <div class="checkbox checkbox-css checkbox-inline">
                              <input <?php if (!(strcmp($row_RecordSettingOtr['burdenuserdecide'],1))) {echo "checked=\"checked\"";} ?> name="burdenuserdecide" type="checkbox" id="burdenuserdecide" value="1" />
                              <label for="burdenuserdecide">消費者可否選擇要不要開立發票【當消費者選不開發票時，不外加5%】</label>
                          </div>
                                  
                      </div>
              
        
                   </div>
            </div>
             
          </div>
      </div>
      </div>
            
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票說明 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="invoicedesc" id="invoicedesc" cols="45" rows="30"><?php echo $row_RecordSettingOtr['invoicedesc']; ?></textarea>  
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
	if($('input[name=invoiceenable]:checked').val() == '1'){
		if(!$("#invoiceformat1").prop('checked') && !$("#invoiceformat2").prop('checked') && !$("#invoiceformat3").prop('checked') && !$("#invoiceformat4").prop('checked') && !$("#invoiceformat5").prop('checked'))
		{
			alert("發票格式至少要選擇一種");
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
