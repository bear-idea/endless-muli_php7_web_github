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

$colname_RecordAccounts_summonsListType4 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListType4 = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListType4 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListType4 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListType4 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && endnode = 'child' && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListType4, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListType4, "int"));
$RecordAccounts_summonsListType4 = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType4) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4);
$totalRows_RecordAccounts_summonsListType4 = mysqli_num_rows($RecordAccounts_summonsListType4);

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

$coluserid_RecordAccounts_summonsLastID = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsLastID = $w_userid;
}
$collang_RecordAccounts_summonsLastID = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAccounts_summonsLastID = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsLastID = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE userid=%s && lang=%s ORDER BY id DESC LIMIT 1",GetSQLValueString($coluserid_RecordAccounts_summonsLastID, "int"),GetSQLValueString($collang_RecordAccounts_summonsLastID, "text"));
$RecordAccounts_summonsLastID = mysqli_query($DB_Conn, $query_RecordAccounts_summonsLastID) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsLastID = mysqli_fetch_assoc($RecordAccounts_summonsLastID);
$totalRows_RecordAccounts_summonsLastID = mysqli_num_rows($RecordAccounts_summonsLastID);

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

$colname_RecordAccounts_summonsdetail = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordAccounts_summonsdetail = $_GET['id_edit'];
}
$coluserid_RecordAccounts_summonsdetail = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsdetail = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE aid = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsdetail, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"));
$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
$totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($RecordAccounts_summonsdetail);

if($totalRows_RecordAccounts_summonsLastID == 0){
	$summonsnumber = date("Ymd") . str_pad(1,3,"0",STR_PAD_LEFT);
}else{
	$summonsnumber = date("Ymd") . str_pad($row_RecordAccounts_summonsLastID['id']+1,3,"0",STR_PAD_LEFT);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Accounts_summons")) {

	  $insertSQL = sprintf("INSERT INTO invoicing_accounts_summonsorder (summonsnumber, totalnumber, sourcedocument, type, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($_POST['summonsnumber'], "text"),
						   GetSQLValueString($_POST['totalnumber'], "text"),
						   GetSQLValueString($_POST['sourcedocument'], "text"),
						   GetSQLValueString($_POST['type'], "text"),
						   GetSQLValueString($_POST['postdate'], "date"),
						   GetSQLValueString(1, "int"),
						   GetSQLValueString($_POST['notes1'], "text"),
						   GetSQLValueString($_POST['lang'], "text"),
						   GetSQLValueString($_POST['userid'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  
	  $coluserid_RecordAccounts_summonsLastID = "-1";
	  if (isset($w_userid)) {
		$coluserid_RecordAccounts_summonsLastID = $w_userid;
	  }
	  $collang_RecordAccounts_summonsLastID = "zh-tw";
	  if (isset($_GET['lang'])) {
		$collang_RecordAccounts_summonsLastID = $_GET['lang'];
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordAccounts_summonsLastID = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE userid=%s && lang=%s ORDER BY id DESC LIMIT 1",GetSQLValueString($coluserid_RecordAccounts_summonsLastID, "int"),GetSQLValueString($collang_RecordAccounts_summonsLastID, "text"));
	  $RecordAccounts_summonsLastID = mysqli_query($DB_Conn, $query_RecordAccounts_summonsLastID) or die(mysqli_error($DB_Conn));
	  $row_RecordAccounts_summonsLastID = mysqli_fetch_assoc($RecordAccounts_summonsLastID);
	  $totalRows_RecordAccounts_summonsLastID = mysqli_num_rows($RecordAccounts_summonsLastID);
	  
	  $aid = $lastId = $row_RecordAccounts_summonsLastID['id'];
	  
	  foreach($_POST['detail_id'] as $key => $val){
		  
		  if($_POST['deltype'][$key] != 1 && $_POST['accountingsubjects_code'][$key] != "" && $_POST['debitamount'][$key] != "" && $_POST['creditamount'][$key] != "") {
		  // 傳值到 accountingsubjects_code
			  $_GET['itemvalue'] = $_POST['accountingsubjects_code'][$key];
			  require("require_manage_accounts_summons_order_copy_accountingsubjects_code_get.php");
			  
			  $insertSQL = sprintf("INSERT INTO invoicing_accounts_summonsdetail (aid, title, summonsnumber, ordertype, type, type1, type2, type3, type4, debitamount, creditamount, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($lastId, "int"),
							   GetSQLValueString($accountingsubjects['itemname'], "text"),
							   GetSQLValueString($_POST['summonsnumber'], "text"),
							   GetSQLValueString($_POST['type'], "text"),
							   GetSQLValueString($accountingsubjects['itemvalue'], "text"),
							   GetSQLValueString($accountingsubjects[0], "text"),
							   GetSQLValueString($accountingsubjects[1], "text"),
							   GetSQLValueString($accountingsubjects[2], "text"),
							   GetSQLValueString($accountingsubjects[3], "text"),
							   GetSQLValueString($_POST['debitamount'][$key], "text"),
							   GetSQLValueString($_POST['creditamount'][$key], "text"),
							   GetSQLValueString($_POST['postdate'], "date"),
							   GetSQLValueString('1', "int"),
							   GetSQLValueString($_POST['notes1'][$key], "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
	
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
		  }
	  }
	  
	    //$aid = $_POST['aid'];
		$ordertype = $_POST['type'];

	    // 取得所有細項並更新
		require("require_manage_accounts_summons_detail_get_and_update.php");
		  
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_accounts_summons.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 會計傳票 <small>複增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 複增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>複增時會一併新增目前傳票之細項。</b></div>
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      
	  <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 表頭</span></div>
      </div>
      <div class="card bg-aqua-transparent-1 m-10">
      <div class="card-block">
      <div class="row">
      	   <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">日期<span class="text-red">*</span></span></div>
                             <input name="postdate" type="text" class="form-control date-picker" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
           
           <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">類別<span class="text-red">*</span></span></div>
                             <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="" required >
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
                       
                  <!--</div>-->
              </div>
           </div>
           
           <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">傳票編號<span class="text-red">*</span></span></div>
                             <input name="summonsnumber" type="text" class="form-control" id="summonsnumber" value="<?php echo $summonsnumber; ?>" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>              
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
           
           <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">傳票總號 <i class="fa fa-info-circle text-gray" data-original-title="可稽核是否跳號，並在傳票憑證列印出排序後的號碼。" data-toggle="tooltip" data-placement="top"></i></span></div>
                             <input name="totalnumber" type="text" class="form-control" id="totalnumber" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>           
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
       </div>
       <div class="row m-t-10">   
           <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">來源單據</span></div>
                             <input name="sourcedocument" type="text" class="form-control" id="sourcedocument" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>             
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
           
           <div class="col-md-9">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">備註</span></div>
                             <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>            
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
           
           
      </div>
      </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 細項</span></div>
      </div>
		  
      <?php if($totalRows_RecordAccounts_summonsdetail > 0) { ?>
      <?php do {?>
      <div class="card bg-aqua-transparent-1 m-10">
      <div class="card-block">
      <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">會計項目<span class="text-red">*</span></span></div>
                            <select name="accountingsubjects_code[]" id="accountingsubjects_code[]" class="form-control select2" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordAccounts_summonsdetail['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇會計項目 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordAccounts_summonsListType4['itemvalue']?>"<?php if (!(strcmp($row_RecordAccounts_summonsListType4['itemvalue'], $row_RecordAccounts_summonsdetail['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAccounts_summonsListType4['itemname']?></option>
                  <?php
} while ($row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4));
  $rows = mysqli_num_rows($RecordAccounts_summonsListType4);
  if($rows > 0) {
      mysqli_data_seek($RecordAccounts_summonsListType4, 0);
	  $row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4);
  }
?>
                </select> 
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">借方金額<span class="text-red">*</span></span></div>
                            <input name="debitamount[]" id="debitamount[]" value="<?php echo $row_RecordAccounts_summonsdetail['debitamount']; ?>" maxlength="11" class="form-control" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required="" <?php if ($row_RecordAccounts_summonsorder['type'] == '收入') { echo 'readonly="readonly"';} ?>/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">貸方金額<span class="text-red">*</span></span></div>
                            <input name="creditamount[]" id="creditamount[]" value="<?php echo $row_RecordAccounts_summonsdetail['creditamount']; ?>" maxlength="11" class="form-control" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required="" <?php if ($row_RecordAccounts_summonsorder['type'] == '支出') { echo 'readonly="readonly"';} ?>/>               
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">備註</span></div>
                            <input name="notes1[]" type="text" id="notes1[]" value="<?php echo $row_RecordAccounts_summonsdetail['notes1']; ?>" class="form-control" data-parsley-trigger="blur"/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordAccounts_summonsdetail['id']; ?>" value="1" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordAccounts_summonsdetail['id']; ?>">是否取消新增</label>
                            </div>          
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <input name="detail_id[]" type="hidden" id="detail_id[]" value="<?php echo $row_RecordAccounts_summonsdetail['id']; ?>" />
              
      </div>
      </div>
      </div>
      <?php } while ($row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail));?>
	  <?php }?>
      
      <div class="clone_main">
	  <div class="clone_group">
      	<div class="card bg-aqua-transparent-1 m-10">
      <div class="card-block">
      <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">會計項目<span class="text-red">*</span></span></div>
                            <select name="accountingsubjects_code[]" id="accountingsubjects_code[]" class="form-control select2" data-parsley-trigger="blur">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordAccounts_summonsdetail['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇會計項目 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordAccounts_summonsListType4['itemvalue']?>"><?php echo $row_RecordAccounts_summonsListType4['itemname']?></option>
                  <?php
} while ($row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4));
  $rows = mysqli_num_rows($RecordAccounts_summonsListType4);
  if($rows > 0) {
      mysqli_data_seek($RecordAccounts_summonsListType4, 0);
	  $row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4);
  }
?>
                </select> 
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">借方金額<span class="text-red">*</span></span></div>
                            <input name="debitamount[]" id="debitamount[]" value="0" maxlength="11" class="form-control" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" <?php if ($row_RecordAccounts_summonsorder['type'] == '收入') { echo 'readonly="readonly"';} ?>/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">貸方金額<span class="text-red">*</span></span></div>
                            <input name="creditamount[]" id="creditamount[]" value="0" maxlength="11" class="form-control" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" <?php if ($row_RecordAccounts_summonsorder['type'] == '支出') { echo 'readonly="readonly"';} ?>/>               
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">備註</span></div>
                            <input name="notes1[]" type="text" id="notes1[]" value="" class="form-control" data-parsley-trigger="blur"/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <a href="javascript:;" class="btn btn-danger dictpush-plus btn-block" ><i class="fa fa-plus"></i></a>         
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <input name="detail_id[]" hidden="hidden" id="detail_id[]" class="detail_id" value="" />
      </div>
      </div>
      </div>
      </div>
      </div>
      
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="aid" type="hidden" id="aid" value="<?php echo $row_RecordAccounts_summonsorder['id']; ?>" /> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <!--<input id="fullIdPath" type="hidden" value="<?php echo $row_RecordProduct['type1']; ?>,<?php echo $row_RecordProduct['type2']; ?>,<?php echo $row_RecordProduct['type3']; ?>",130" />-->
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Accounts_summons" />
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
	var $i=1;
    $(".dictpush-plus").click(function(){  
        if($(this).hasClass("dictpush-plus")){//这个是添加一组元素的  
		    //$(this).parents(".clone_group").find('.select2').select2('destroy');
			
			//$(".select2").find('select').select2('destroy');
			
			$(".clone_main").find(".select2").each(function(){
				if ($(this).data('select2')) {
					$(this).select2('destroy');
				}
			});
		
            $(this).parents(".clone_group").clone(true).appendTo($(".clone_main"));
            $(this).children().removeClass("fa-plus").removeClass("green").addClass("fa-minus").addClass("red");  
            $(this).removeClass("dictpush-plus").addClass("dictpush-minus");
			
			//$(this).children().find('detail_id').val(12);
			/* 動態給定值 */
			$(this).parents(".clone_group").find('.detail_id').val("clone"+$i);
			$i++;
			//$(this).children().(".detail_id").val(12);
			//$(this).children(".detail_id").val(12);
			
			//$(this).children(".select2").select2("destroy");
			//$(this).children(".select2").removeAttr("data-select2-id tabindex aria-hidden");
			//$(this).children(".select2").removeAttr("data-select2-id");
			//var ids="AA"+i++;
			//克隆后需要附上新的id值，赋值select2初始化会有问题
			//var newSel=$(".select2").attr("id",ids);
			//$(this).children(".select2").append(newSel);
			//$(this).("select").removeAttr("data-select2-id tabindex aria-hidden");
            //$(this).("option").removeAttr("data-select2-id");
			$('.select2').select2();
			
			//销毁select2
			//$(".select2").select2("destroy");
			//克隆后需要附上新的id值，赋值select2初始化会有   
			
			//console.log($(this).children("select"));
			//$('select.select2').select2('destroy');
			//$('.select2').select2('destroy');
			//$('.select2').select2();
            //$clone = $latest_tr.clone();

			
			
        }else if($(this).hasClass("dictpush-minus")){//这个判断是为了删除元素用的，不能用bind或者click的方法，试了都不行  
            $(this).parents(".clone_group").remove();  
        }  
    });  
});  
</script>