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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Company")) {
  $updateSQL = sprintf("UPDATE invoicing_company SET type=%s, title=%s, code=%s, sname=%s, leader=%s, contactperson=%s, sales=%s, mail=%s, tel=%s, tel2=%s, cellphone=%s, companyaddr=%s, shipmentsaddr=%s, invoiceaddr=%s, invoicetittle=%s, fax=%s, VATnumber=%s, editdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
					   GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['sname'], "text"),
                       GetSQLValueString($_POST['leader'], "text"),
                       GetSQLValueString($_POST['contactperson'], "text"),
                       GetSQLValueString($_POST['sales'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['tel2'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['companyaddr'], "text"),
                       GetSQLValueString($_POST['shipmentsaddr'], "text"),
                       GetSQLValueString($_POST['invoiceaddr'], "text"),
                       GetSQLValueString($_POST['invoicetittle'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['VATnumber'], "text"),
                       GetSQLValueString($_POST['editdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_company.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordCompanyListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordCompanyListType = $_GET["lang"];
}
$coluserid_RecordCompanyListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCompanyListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCompanyListType = sprintf("SELECT * FROM invoicing_companyitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCompanyListType, "text"),GetSQLValueString($coluserid_RecordCompanyListType, "int"));
$RecordCompanyListType = mysqli_query($DB_Conn, $query_RecordCompanyListType) or die(mysqli_error($DB_Conn));
$row_RecordCompanyListType = mysqli_fetch_assoc($RecordCompanyListType);
$totalRows_RecordCompanyListType = mysqli_num_rows($RecordCompanyListType);

/* 取得最新訊息資料 */
$colname_RecordCompany = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordCompany = $_GET['id_edit'];
}
$coluserid_RecordCompany = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCompany = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCompany = sprintf("SELECT * FROM invoicing_company WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordCompany, "int"),GetSQLValueString($coluserid_RecordCompany, "int"));
$RecordCompany = mysqli_query($DB_Conn, $query_RecordCompany) or die(mysqli_error($DB_Conn));
$row_RecordCompany = mysqli_fetch_assoc($RecordCompany);
$totalRows_RecordCompany = mysqli_num_rows($RecordCompany);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageCompanyEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageCompanyEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageCompanyEditorSelect == '1' || $ManageCompanyEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 公司資料 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">公司名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordCompany['title']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">代碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="code" type="text" class="form-control" id="code" value="<?php echo $row_RecordCompany['code']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">簡稱</label>
          <div class="col-md-10">
                      
                      <input name="sname" type="text" class="form-control" id="sname" value="<?php echo $row_RecordCompany['sname']; ?>" maxlength="200" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordCompany['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordCompanyListType['itemname']?>"<?php if (!(strcmp($row_RecordCompanyListType['itemname'], $row_RecordCompany['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCompanyListType['itemname']?></option>
                  <?php
} while ($row_RecordCompanyListType = mysqli_fetch_assoc($RecordCompanyListType));
  $rows = mysqli_num_rows($RecordCompanyListType);
  if($rows > 0) {
      mysqli_data_seek($RecordCompanyListType, 0);
	  $row_RecordCompanyListType = mysqli_fetch_assoc($RecordCompanyListType);
  }
?>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">負責人</label>
          <div class="col-md-10">
          
                      <input name="leader" type="text" class="form-control" id="leader" value="<?php echo $row_RecordCompany['leader']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">統一編號</label>
          <div class="col-md-10">
          
                      <input name="VATnumber" type="text" class="form-control" id="VATnumber" value="<?php echo $row_RecordCompany['VATnumber']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 聯絡資訊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-5">
                      <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">主要</span></span>
                      <input name="tel" type="text" class="form-control" id="tel" value="<?php echo $row_RecordCompany['tel']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      </div>
                      
                 
          </div>

          <div class="col-md-5">
                      <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">次要</span></span>
                      <input name="tel2" type="text" class="form-control" id="tel2" value="<?php echo $row_RecordCompany['tel2']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      </div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" class="form-control" id="cellphone" value="<?php echo $row_RecordCompany['cellphone']; ?>" maxlength="30" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
          
                      <input name="fax" type="text" class="form-control" id="fax" value="<?php echo $row_RecordCompany['fax']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件</label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" value="<?php echo $row_RecordCompany['mail']; ?>" maxlength="100" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">營業地址</label>
          <div class="col-md-10">
          
                      <input name="companyaddr" type="text" class="form-control" id="companyaddr" value="<?php echo $row_RecordCompany['companyaddr']; ?>" maxlength="300" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發貨地址</label>
          <div class="col-md-10">
          
                      <input name="shipmentsaddr" type="text" class="form-control" id="shipmentsaddr" value="<?php echo $row_RecordCompany['shipmentsaddr']; ?>" maxlength="300" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯絡人</label>
          <div class="col-md-10">
          
                      <input name="contactperson" type="text" class="form-control" id="contactperson" value="<?php echo $row_RecordCompany['contactperson']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">業務人員</label>
          <div class="col-md-10">
          
                      <input name="sales" type="text" class="form-control" id="sales" value="<?php echo $row_RecordCompany['sales']; ?>" maxlength="100" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
  
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票抬頭</label>
          <div class="col-md-10">
          
                      <input name="invoicetittle" type="text" class="form-control" id="invoicetittle" value="<?php echo $row_RecordCompany['invoicetittle']; ?>" maxlength="200" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票地址</label>
          <div class="col-md-10">
          
                      <input name="invoiceaddr" type="text" class="form-control" id="invoiceaddr" value="<?php echo $row_RecordCompany['invoiceaddr']; ?>" maxlength="300" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCompany['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCompany['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他資訊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordCompany['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordCompany['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordCompany['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Company" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordCompanyListType);

mysqli_free_result($RecordCompany);
?>
