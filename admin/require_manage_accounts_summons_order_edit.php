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

$colname_RecordAccounts_summonsListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListType = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListType = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsListType, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListType, "int"));
$RecordAccounts_summonsListType = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
$totalRows_RecordAccounts_summonsListType = mysqli_num_rows($RecordAccounts_summonsListType);

$colname_RecordAccounts_summonsorder = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordAccounts_summonsorder = $_GET['id_edit'];
}
$coluserid_RecordAccounts_summonsorder = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsorder = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsorder, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsorder, "int"));
$RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
$totalRows_RecordAccounts_summonsorder = mysqli_num_rows($RecordAccounts_summonsorder);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Accounts_summonsorder")) {

	$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET postdate=%s, type=%s, summonsnumber=%s, totalnumber=%s, sourcedocument=%s, editdate=%s, notes1=%s, lang=%s WHERE id=%s",
					       GetSQLValueString($_POST['postdate'], "date"),
						   GetSQLValueString($_POST['type'], "text"),
						   GetSQLValueString($_POST['summonsnumber'], "text"),
						   GetSQLValueString($_POST['totalnumber'], "text"),
						   GetSQLValueString($_POST['sourcedocument'], "text"),
						   GetSQLValueString($_POST['editdate'], "date"),
						   GetSQLValueString($_POST['notes1'], "text"),
						   GetSQLValueString($_POST['lang'], "text"),
                           GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $updateSQL = sprintf("UPDATE invoicing_accounts_summonsdetail SET ordertype=%s, postdate=%s WHERE aid=%s",
					       GetSQLValueString($_POST['type'], "text"),
						   GetSQLValueString($_POST['postdate'], "date"),
                           GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_accounts_summons.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 應收帳款 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
              <input name="postdate" type="text" class="form-control date-picker postdate" id="postdate" value="<?php $dt = new DateTime($row_RecordAccounts_summonsorder['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
          </div>
      </div>
	
		  <div class="form-group row">
        <label class="col-md-2 col-form-label">類別<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="" required>
                      <option value="">-- 選擇類別 --</option>
                      <?php
						do {  
						?>
											  <option value="<?php echo $row_RecordAccounts_summonsListType['itemname']?>"<?php if (!(strcmp($row_RecordAccounts_summonsorder['type'], $row_RecordAccounts_summonsListType['itemname']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAccounts_summonsListType['itemname']?></option>
											  <?php
						} while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType));
						  $rows = mysqli_num_rows($RecordAccounts_summonsListType);
						  if($rows > 0) {
							  mysqli_data_seek($RecordAccounts_summonsListType, 0);
							  $row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
						  }
						?>
                    </select>
                    
 
                   
</div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">傳票編號</label>
          <div class="col-md-10">
                    <input name="summonsnumber" type="text" class="form-control" id="summonsnumber" value="<?php echo $row_RecordAccounts_summonsorder['summonsnumber']; ?>" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>   
			</div>
      </div>
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">傳票總號 <i class="fa fa-info-circle text-orange" data-original-title="可稽核是否跳號，並在傳票憑證列印出排序後的號碼。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      <input name="totalnumber" type="text" class="form-control" id="totalnumber" value="<?php echo $row_RecordAccounts_summonsorder['totalnumber']; ?>" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>                  
        </div>
      </div>
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">來源單據</label>
          <div class="col-md-10">
                       <input name="sourcedocument" type="text" class="form-control" id="sourcedocument" value="<?php echo $row_RecordAccounts_summonsorder['sourcedocument']; ?>" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>                  
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordAccounts_summonsorder['notes1']; ?>" size="50" maxlength="50" class="form-control"/>    
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
			<input name="id" type="hidden" id="id" value="<?php echo $row_RecordAccounts_summonsorder['id']; ?>" />  
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
			<input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Accounts_summonsorder" />
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
