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
$query_RecordAccounts_summonsListType4 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && endnode='child' && userid=%s ORDER BY itemvalue ASC", GetSQLValueString($colname_RecordAccounts_summonsListType4, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListType4, "int"));
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
						   GetSQLValueString($_POST['notes1_order'], "text"),
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
	  
	  //var_dump($_POST['detail_id']);
	
	  foreach($_POST['detail_id'] as $key => $val){
		  
		  if($_POST['deltype'][$key] != 1 && $_POST['accountingsubjects_code'][$key] != "" && $_POST['debitamount'][$key] != "" && $_POST['creditamount'][$key] != "") {
		  // 傳值到 accountingsubjects_code
			  $_GET['itemvalue'] = $_POST['accountingsubjects_code'][$key];
			  require("require_manage_accounts_summons_order_copy_accountingsubjects_code_get.php");
			  
			    if($accountingsubjects[0] == NULL){$accountingsubjects[0] = '-1';}
				if($accountingsubjects[1] == NULL){$accountingsubjects[1] = '-1';}
				if($accountingsubjects[2] == NULL){$accountingsubjects[2] = '-1';}
				if($accountingsubjects[3] == NULL){$accountingsubjects[3] = '-1';}
				if($accountingsubjects[4] == NULL){$accountingsubjects[4] = '-1';}

			  $insertSQL = sprintf("INSERT INTO invoicing_accounts_summonsdetail (aid, title, summonsnumber, ordertype, type, type1, type2, type3, type4, type5, debitamount, creditamount, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($lastId, "int"),
							   GetSQLValueString($accountingsubjects['itemname'], "text"),
							   GetSQLValueString($_POST['summonsnumber'], "text"),
							   GetSQLValueString($_POST['type'], "text"),
							   GetSQLValueString($accountingsubjects['itemvalue'], "text"),
							   GetSQLValueString($accountingsubjects[0], "text"),
							   GetSQLValueString($accountingsubjects[1], "text"),
							   GetSQLValueString($accountingsubjects[2], "text"),
							   GetSQLValueString($accountingsubjects[3], "text"),
                               GetSQLValueString($accountingsubjects[4], "text"),    
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
<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap4.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
<!-- ================== END Datatables CSS ================== -->

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN Datatables JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/KeyTable/js/keyTable.bootstrap4.min.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>-->
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="//cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/accounts_summonsdetail_datatable_add.js"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 會計傳票 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
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
                             <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="required"  onchange="typechange()">
                              <option value="">-- 選擇類別 --</option>
                              <?php
                                do {  
                                ?>
                                                      <option value="<?php echo $row_RecordAccounts_summonsListType['itemname']?>"<?php if (!(strcmp($row_RecordAccounts_summonsorder['type'], $row_RecordAccounts_summonsListType['itemname']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAccounts_summonsListType['itemvalue']?> <?php echo $row_RecordAccounts_summonsListType['itemname']?></option>
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
                             <input name="summonsnumber" type="number" class="form-control" id="summonsnumber" value="<?php echo $summonsnumber; ?>" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>              
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
           
           <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">傳票總號 <i class="fa fa-info-circle text-gray" data-original-title="可稽核是否跳號，並在傳票憑證列印出排序後的號碼。" data-toggle="tooltip" data-placement="top"></i></span></div>
                             <input name="totalnumber" type="number" class="form-control" id="totalnumber" maxlength="200" readonly="readonly" data-parsley-trigger="blur"/>           
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
                             <input name="notes1_order" type="text" id="notes1_order" size="50" maxlength="50" class="form-control"/>            
                      </div>
                       
                  <!--</div>-->
              </div>
           </div>
           
           
      </div>
      </div>
      </div>
	  
	  <div class="col-md-12 m-b-10">
	  <div class="row p-5">
	  <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed">
      <thead>
        <tr>
          <th width="16"><input type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
          <th width="350" data-priority="1"><strong>會計項目</strong></th>
		  <th width="150"><strong>借方金額</strong></th>
          <th width="150"><strong>貸方金額</strong></th>
          <th width="-1" data-priority="1"><strong>摘要</strong></th>
          <th width="1%" class="desktop"><strong>操作</strong></th>
        </tr>
      </thead>
	  <tbody>
		<tr class="clone_group">
		  <td></td>
          <td>
          	  <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                             <select name="accountingsubjects_code[]" id="accountingsubjects_code[]" class="form-control accountingsubjects_code select2" data-parsley-trigger="blur" required="required">
                              <option value="" <?php if (!(strcmp(-1, $row_RecordAccounts_summonsdetail['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇會計項目 --</option>
                              <?php
            do {  
            ?>
                              <option value="<?php echo $row_RecordAccounts_summonsListType4['itemvalue']?>"><?php echo $row_RecordAccounts_summonsListType4['itemvalue']?> <?php echo $row_RecordAccounts_summonsListType4['itemname']?></option>
                              <?php
            } while ($row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4));
              $rows = mysqli_num_rows($RecordAccounts_summonsListType4);
              if($rows > 0) {
                  mysqli_data_seek($RecordAccounts_summonsListType4, 0);
                  $row_RecordAccounts_summonsListType4 = mysqli_fetch_assoc($RecordAccounts_summonsListType4);
              }
            ?>
                            </select>
                           <!-- <span class="input-group-append"><span class="input-group-text"><i class="fas fa-ellipsis-h"></i></span></div>-->
						  <span class="input-group-append"><span class="input-group-text" href="#Ajax_detail_type" data-toggle="modal"><i class="fas fa-ellipsis-h"></i></span></span>
                            
                      </div>
                       
                  <!--</div>-->
              </div>
		  </td>
          <td>
			  <input name="debitamount[]" id="debitamount[]" value="0" maxlength="11" class="form-control debitamount" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" <?php if ($row_RecordAccounts_summonsorder['type'] == '收入') { echo 'readonly="readonly"';} ?> onfocus="this.select()" required="required"/>
		  </td>
          <td>
			  <input name="creditamount[]" id="creditamount[]" value="0" maxlength="11" class="form-control creditamount" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" <?php if ($row_RecordAccounts_summonsorder['type'] == '支出') { echo 'readonly="readonly"';} ?> onfocus="this.select()" required="required"/>               
		  </td>
		  <td>
			  <input name="notes1[]" type="text" id="notes1[]" value="" class="form-control notes1" data-parsley-trigger="blur"/>
		  </td>
          <td>
			  <a href="javascript:;" class="btn btn-danger dictpush-plus btn-block"><i class="fa fa-plus"></i></a>
			  <input name="detail_id[]" hidden="hidden" id="detail_id[]" class="detail_id" value="" />
			  <!--<input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordAccounts_summonsdetail['id']; ?>" value="1" />-->
		  </td>
		</tr>
	  </tbody>
      <tfoot>
        <tr>
          <td>└</td>
          <td><button type="button" class="btn btn-default btn-sm" onclick="delete_muti_datatables(event);"><i class="far fa-trash-alt"></i> 刪除選取項目</button></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><button type="button" id="reset_table" class="btn btn-default btn-sm pull-right"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
      </table>
	  </div>
	  </div>
	  
	  
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
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

<?php require("require_manage_accounts_summons_model_detail_type.php"); ?>

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
	//$.fn.editable.defaults.mode = 'inline';
	function typechange(){ 
			if($('#type').val() == "收入"){
				$('.debitamount').val(0);
				$('.creditamount').val(0);
				$('.debitamount').attr('readonly',true);
				$('.creditamount').attr('readonly',false);
			}else if($('#type').val() == "支出"){
				$('.debitamount').val(0);
				$('.creditamount').val(0);
				$('.debitamount').attr('readonly',false);
				$('.creditamount').attr('readonly',true);
			}else{
				$('.debitamount').attr('readonly',false);
				$('.creditamount').attr('readonly',false);
			}
		}
</script> 

<script>	
$(function(){         
    //add row  
	var $i=1;
	var $row_data_count=0;
	$(".dictpush-plus").on('click', function(){  
    //$(".dictpush-plus").click(function(){  
	
        if($(this).hasClass("dictpush-plus")){//这个是添加一组元素的  
		    //$(this).parents(".clone_group").find('.select2').select2('destroy');
			
			//$(".select2").find('select').select2('destroy');
			
			$("#data-table-default").find(".select2").each(function(){
				if ($(this).data('select2')) {
					$(this).select2('destroy');
				}
			});
         
			var row_data = [];
			var row_data_key = ['id','detail_type','debitamount','creditamount','notes1','action'];
			$(this).parents(".clone_group").find('td').each(function(row_data_count) {
				
				row_data[row_data_key[row_data_count]] = $(this).html();
				
				if(row_data_key[row_data_count] == 'action') { 
					row_data[row_data_key[row_data_count]] = "<a href='javascript:;' class='btn btn-danger dictpush-minus btn-block' onclick='delRow(this)'><i class='fa fa-minus'></i></a><input name='detail_id[]' hidden='hidden' id='detail_id[]' class='detail_id' />";
				}
				
				//row_data.push($(this).html());
				
				row_data_count++;
				//console.log($(this).html());
			});
			  
			$("#data-table-default").DataTable().row.add(row_data).draw();
			
            //$(this).parents(".clone_group").clone(true).appendTo($("#data-table-default"));
            //$(this).children().removeClass("fa-plus").removeClass("green").addClass("fa-minus").addClass("red");  
            //$(this).removeClass("dictpush-plus").addClass("dictpush-minus");
			
			/* 動態給定值 */
			$(this).parents(".clone_group").find('.detail_id').val("clone"+$i);
			
			//$(this).parents(".clone_group").find('.select2').val(1111);
			
			$i++;
			$('.select2').select2();
			//$('.debitamount').validate();
			//$('.creditamount').validate();
			
        }else if($(this).hasClass("dictpush-minus")){//这个判断是为了删除元素用的，不能用bind或者click的方法，试了都不行  
            $(this).parents(".clone_group").remove();  
        }  
    });  

}); 
</script>

<script>
	/*$("  #data-table-default").on("click",".edit-btn",function(){
           var tds=$(this).parents("tr").children();
           $.each(tds, function(i,val){
               var jqob=$(val);
               if(i < 1 || jqob.has('button').length ){return true;}//跳过第1项 序号,按钮
               var txt=jqob.text();
               var put=$("<input type='text'>");
               put.val(txt);
               jqob.html(put);
           });
           $(this).html("保存");
           $(this).toggleClass("edit-btn");
           $(this).toggleClass("save-btn");
       });*/
</script> 