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
$colname_RecordSupplierListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordSupplierListType = $_GET['lang'];
}
$coluserid_RecordSupplierListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSupplierListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSupplierListType = sprintf("SELECT * FROM invoicing_supplieritem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordSupplierListType, "text"),GetSQLValueString($coluserid_RecordSupplierListType, "int"));
$RecordSupplierListType = mysqli_query($DB_Conn, $query_RecordSupplierListType) or die(mysqli_error($DB_Conn));
$row_RecordSupplierListType = mysqli_fetch_assoc($RecordSupplierListType);
$totalRows_RecordSupplierListType = mysqli_num_rows($RecordSupplierListType);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Supplier")) {
  $insertSQL = sprintf("INSERT INTO invoicing_supplier (type, code, vendornumber, name, sname, leader, contactperson, sales, mail, tel, tel2, cellphone, companyaddr, shipmentsaddr, invoiceaddr, invoicetittle, fax, VATnumber, createdate, monthcloseday, transactionlimit, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['code'], "text"),
                       GetSQLValueString($_POST['vendornumber'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
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
                       GetSQLValueString($_POST['createdate'], "date"),
                       GetSQLValueString($_POST['monthcloseday'], "text"),
                       GetSQLValueString($_POST['transactionlimit'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_supplier.php?Opt=viewpage&lang=" . $_POST['lang'];
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
	<?php if ($ManageSupplierEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageSupplierEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageSupplierEditorSelect == '1' || $ManageSupplierEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 供應廠商 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">廠商代號<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="code" type="text" id="code" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">公司名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" id="name" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">簡稱</label>
          <div class="col-md-10">
                      
                      <input name="sname" type="text" class="form-control" id="sname" maxlength="200" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">分類<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                <option value="">-- 選擇類別 --</option>
                <?php
				do {  
				?>
								<option value="<?php echo $row_RecordSupplierListType['itemname']?>"><?php echo $row_RecordSupplierListType['itemname']?></option>
								<?php
				} while ($row_RecordSupplierListType = mysqli_fetch_assoc($RecordSupplierListType));
				  $rows = mysqli_num_rows($RecordSupplierListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordSupplierListType, 0);
					  $row_RecordSupplierListType = mysqli_fetch_assoc($RecordSupplierListType);
				  }
				?>
				    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">負責人</label>
          <div class="col-md-10">
          
                      <input name="leader" type="text" id="leader" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">統一編號</label>
          <div class="col-md-10">
          
                      <input name="VATnumber" type="text" id="VATnumber" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">廠商編號</label>
          <div class="col-md-10">
          
                      <input name="vendornumber" type="text" id="vendornumber" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
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
                      <input name="tel" type="text" id="tel" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      </div>
                      
                 
          </div>

          <div class="col-md-5">
                      <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text">次要</span></span>
                      <input name="tel2" type="text" id="tel2" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      </div>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
          
                      <input name="cellphone" type="text" id="cellphone" maxlength="30" class="form-control" data-parsley-trigger="blur" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" />
                      
                 
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
          
                      <input name="fax" type="text" id="fax" maxlength="30" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件</label> 
          <div class="col-md-10">
              <input name="mail" type="email" class="form-control" id="mail" maxlength="100" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" /> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">營業地址</label>
          <div class="col-md-10">
          
                      <input name="companyaddr" type="text" id="companyaddr" maxlength="300" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發貨地址</label>
          <div class="col-md-10">
          
                      <input name="shipmentsaddr" type="text" id="shipmentsaddr" maxlength="300" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">聯絡人</label>
          <div class="col-md-10">
          
                      <input name="contactperson" type="text" id="contactperson" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">業務人員</label>
          <div class="col-md-10">
          
                      <input name="sales" type="text" id="sales" maxlength="100" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 帳務資訊</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">月結日</label>
          <div class="col-md-10">
              <select name="monthcloseday" id="monthcloseday" class="form-control" data-parsley-trigger="blur">
                  <option value="" >-- 選擇月結日 --</option>
                  <?php for($i=1;$i<=31;$i++) { ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?> 日</option>
                  <?php } ?>
                </select>  
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">交易額度</label>
          <div class="col-md-10">
          
                      <input name="transactionlimit" class="form-control" id="transactionlimit"  maxlength="11" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票抬頭</label>
          <div class="col-md-10">
          
                      <input name="invoicetittle" type="text" id="invoicetittle" maxlength="200" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票地址</label>
          <div class="col-md-10">
          
                      <input name="invoiceaddr" type="text" id="invoiceaddr" maxlength="300" class="form-control" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 其他資訊</span></div>
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
              <input name="createdate" type="text" class="form-control" id="createdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required=""/> 
                 
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
      <input type="hidden" name="MM_insert" value="form_Supplier" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordSupplierListType);
?>
