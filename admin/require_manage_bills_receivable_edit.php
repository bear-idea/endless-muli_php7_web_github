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

$coluserid_RecordClientele = "-1";
if (isset($w_userid)) {
  $coluserid_RecordClientele = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordClientele = sprintf("SELECT * FROM invoicing_clientele WHERE userid=%s ORDER BY code",GetSQLValueString($coluserid_RecordClientele, "int"));
$RecordClientele = mysqli_query($DB_Conn, $query_RecordClientele) or die(mysqli_error($DB_Conn));
$row_RecordClientele = mysqli_fetch_assoc($RecordClientele);
$totalRows_RecordClientele = mysqli_num_rows($RecordClientele);

$coluserid_RecordCompany = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCompany = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCompany = sprintf("SELECT * FROM invoicing_company WHERE userid=%s",GetSQLValueString($coluserid_RecordCompany, "int"));
$RecordCompany = mysqli_query($DB_Conn, $query_RecordCompany) or die(mysqli_error($DB_Conn));
$row_RecordCompany = mysqli_fetch_assoc($RecordCompany);
$totalRows_RecordCompany = mysqli_num_rows($RecordCompany);

$colname_RecordBills_receivable = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordBills_receivable = $_GET['id_edit'];
}
$coluserid_RecordBills_receivable = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBills_receivable = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBills_receivable = sprintf("SELECT * FROM invoicing_bills_receivabledetail WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordBills_receivable, "int"),GetSQLValueString($coluserid_RecordBills_receivable, "int"));
$RecordBills_receivable = mysqli_query($DB_Conn, $query_RecordBills_receivable) or die(mysqli_error($DB_Conn));
$row_RecordBills_receivable = mysqli_fetch_assoc($RecordBills_receivable);
$totalRows_RecordBills_receivable = mysqli_num_rows($RecordBills_receivable);

$coluserid_RecordBank = "-1";
if (isset($w_userid)) {
  $coluserid_RecordBank = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBank = sprintf("SELECT * FROM invoicing_bank WHERE userid=%s",GetSQLValueString($coluserid_RecordBank, "int"));
$RecordBank = mysqli_query($DB_Conn, $query_RecordBank) or die(mysqli_error($DB_Conn));
$row_RecordBank = mysqli_fetch_assoc($RecordBank);
$totalRows_RecordBank = mysqli_num_rows($RecordBank);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Bills_receivable")) {
	
	$colcode_RecordClientele = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordClientele = $w_userid;
		}
		$colid_RecordClientele = "-1";
		if (isset($_POST['clientele'])) {
		  $colid_RecordClientele = $_POST['clientele'];
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordClientele = sprintf("SELECT * FROM invoicing_clientele WHERE userid=%s && code=%s LIMIT 1",GetSQLValueString($coluserid_RecordClientele, "int"),GetSQLValueString($colid_RecordClientele, "text"));
		$RecordClientele = mysqli_query($DB_Conn, $query_RecordClientele) or die(mysqli_error($DB_Conn));
		$row_RecordClientele = mysqli_fetch_assoc($RecordClientele);
		$totalRows_RecordClientele = mysqli_num_rows($RecordClientele);
	
	$updateSQL = sprintf("UPDATE invoicing_bills_receivabledetail SET company=%s, clientele=%s, clientelecode=%s, chequenumber=%s, amountr=%s, collectionaccountid=%s, postdate=%s, editdate=%s, indicate=%s, notes1=%s, lang=%s WHERE id=%s",
	                   GetSQLValueString($_POST['company'], "text"),
                       GetSQLValueString($row_RecordClientele['name'], "text"),
                       GetSQLValueString($row_RecordClientele['code'], "text"),
					   GetSQLValueString($_POST['chequenumber'], "text"),
                       GetSQLValueString($_POST['amountr'], "text"),
                       GetSQLValueString($_POST['collectionaccountid'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
					   GetSQLValueString($_POST['editdate'], "date"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_bills_receivable.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 應收票據 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">

  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
	  
	  <div class="clone_main">
	  <div class="clone_group">
	  
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">日期<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control date-picker postdate" id="postdate" value="<?php $dt = new DateTime($row_RecordBills_receivable['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
          </div>
      </div>
	
		  <div class="form-group row">
        <label class="col-md-2 col-form-label">收款公司<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="company" id="company" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇收款公司 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordCompany['code']?>"<?php if (!(strcmp($row_RecordBills_receivable['company'], $row_RecordCompany['code']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCompany['code']?> <?php echo $row_RecordCompany['title']?></option>
											  <?php
						} while ($row_RecordCompany = mysqli_fetch_assoc($RecordCompany));
						  $rows = mysqli_num_rows($RecordCompany);
						  if($rows > 0) {
							  mysqli_data_seek($RecordCompany, 0);
							  $row_RecordCompany = mysqli_fetch_assoc($RecordCompany);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">請款客戶<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="clientele" id="clientele" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇請款客戶 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordClientele['code']?>"<?php if (!(strcmp($row_RecordBills_receivable['clientelecode'], $row_RecordClientele['code']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordClientele['code']?> <?php echo $row_RecordClientele['name']?></option>
											  <?php
						} while ($row_RecordClientele = mysqli_fetch_assoc($RecordClientele));
						  $rows = mysqli_num_rows($RecordClientele);
						  if($rows > 0) {
							  mysqli_data_seek($RecordClientele, 0);
							  $row_RecordClientele = mysqli_fetch_assoc($RecordClientele);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">支票號碼<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="chequenumber" type="text" id="chequenumber" value="<?php echo $row_RecordBills_receivable['chequenumber']; ?>" size="50" maxlength="50" class="form-control" required=""/>    
          </div>
      </div>
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">支票金額<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="amountr" id="amountr" value="<?php echo $row_RecordBills_receivable['amountr']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>                      
                 
        </div>
      </div>
      
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">到期日<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="應收票據的到期日。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
              <input name="expirydate" type="text" class="form-control date-picker expirydate" id="expirydate" value="<?php $dt = new DateTime($row_RecordBills_receivable['expirydate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">託收帳號<span class="text-red">*</span><i class="fa fa-info-circle text-orange" data-original-title="系統會依到期日當日，將金額兌現增加至【託收帳號】的銀行。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                    <select name="collectionaccountid" id="collectionaccountid" class="form-control" data-parsley-trigger="blur" required="">
                      <option value="">-- 選擇託收帳號 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordBank['bankaccount']?>"<?php if (!(strcmp($row_RecordBills_receivable['collectionaccountid'], $row_RecordBank['bankaccount']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordBank['swiftcode']?> <?php echo $row_RecordBank['bankaccount']?> <?php echo $row_RecordBank['name']?></option>
											  <?php
						} while ($row_RecordBank = mysqli_fetch_assoc($RecordBank));
						  $rows = mysqli_num_rows($RecordBank);
						  if($rows > 0) {
							  mysqli_data_seek($RecordBank, 0);
							  $row_RecordBank = mysqli_fetch_assoc($RecordBank);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">收款人</label>
          <div class="col-md-10">
              <input name="payee" type="text" id="payee" value="<?php echo $row_RecordBills_receivable['payee']; ?>" size="50" maxlength="50" class="form-control"/>    
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordBills_receivable['notes1']; ?>" size="50" maxlength="50" class="form-control"/>    
          </div>
      </div>
		  
	  <div class="form-group row" style="display: none">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
              <a href="javascript:;" class="btn btn-success dictpush-plus btn-block" ><i class="fa fa-plus green"></i></a> 
          </div>
      </div>
		  
		  
	  </div>
	  </div>
	  
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
			<input name="id" type="hidden" id="id" value="<?php echo $row_RecordBills_receivable['id']; ?>" />  
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
			<input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Bills_receivable" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		$('.postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<script>
	//$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {
		TableManageDefault.init();		
	});
</script> 

<script>
	$(function(){         
    //add row  
    $(".dictpush-plus").click(function(){  
        if($(this).hasClass("dictpush-plus")){//这个是添加一组元素的  
            $(this).parents(".clone_group").clone(true).appendTo($(".clone_main"));  
            $(this).children().removeClass("fa-plus").removeClass("green").addClass("fa-minus").addClass("red");  
            $(this).removeClass("dictpush-plus").addClass("dictpush-minus");  
			$('.postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		   }); 
        }else if($(this).hasClass("dictpush-minus")){//这个判断是为了删除元素用的，不能用bind或者click的方法，试了都不行  
            $(this).parents(".clone_group").remove();  
        }  
    });  
});  

 
	</script>
