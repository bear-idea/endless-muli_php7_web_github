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

$colname_RecordAccounts_summonsorder = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordAccounts_summonsorder = $_GET['aid'];
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

$colname_RecordAccounts_summonsListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListType = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListType = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListType, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListType, "int"));
$RecordAccounts_summonsListType = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
$totalRows_RecordAccounts_summonsListType = mysqli_num_rows($RecordAccounts_summonsListType);

$colname_RecordAccounts_summonsdetail = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordAccounts_summonsdetail = $_GET['id_edit'];
}
$coluserid_RecordAccounts_summonsdetail = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsdetail = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsdetail = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsdetail, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"));
$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
$totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($RecordAccounts_summonsdetail);

/* 當類別無傳值進來時則給定初始值 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Accounts_summons")) {
	if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
	if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
	if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
	if($_POST['type4'] == NULL){$_POST['type4'] = '-1';}
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Accounts_summons")) {

	$updateSQL = sprintf("UPDATE invoicing_accounts_summonsdetail SET title=%s, ordertype=%s, type=%s, type1=%s, type2=%s, type3=%s, type4=%s, debitamount=%s, creditamount=%s, editdate=%s, notes1=%s, lang=%s WHERE id=%s",
						   GetSQLValueString($_POST['title'], "text"),
						   GetSQLValueString($_POST['ordertype'], "text"),
						   GetSQLValueString($_POST['type'], "text"),
						   GetSQLValueString($_POST['type1'], "text"),
						   GetSQLValueString($_POST['type2'], "text"),
						   GetSQLValueString($_POST['type3'], "text"),
						   GetSQLValueString($_POST['type4'], "text"),
						   GetSQLValueString($_POST['debitamount'], "text"),
						   GetSQLValueString($_POST['creditamount'], "text"),
						   GetSQLValueString($_POST['editdate'], "date"),
						   GetSQLValueString($_POST['notes1'], "text"),
						   GetSQLValueString($_POST['lang'], "text"),
						   GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
        $aid = $_POST['aid'];
		$ordertype = $_POST['ordertype'];

	    // 取得所有細項並更新
		require("require_manage_accounts_summons_detail_get_and_update.php");
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "inner_accounts_summons.php?Opt=detailpage&lang=" . $_POST['lang'] . '&aid=' . $_POST['aid'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 會計傳票細項 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="inner_accounts_summons.php?wshop=<?php echo $wshop; ?>&amp;Opt=detailpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">

  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bdetailed" data-parsley-validate="" method="post">
	  
	  <div class="clone_main">
	  <div class="clone_group">
	  
	  <div class="form-group row">
          <label class="col-md-2 col-form-label">日期<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" required="" class="form-control" id="postdate" autocomplete="off" value="<?php $dt = new DateTime($row_RecordAccounts_summonsdetail['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" readonly="readonly"  data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW"/> 
                 
          </div>
      </div>
	
		  <div class="form-group row">
          <label class="col-md-2 col-form-label">會計科目<span class="text-red">*</span></label>
          <div class="col-md-10">
          <div class="row p-10">
                  
                    
                    <select name="type1" id="type1" class="form-control col-md-3" style="display:inline-block" data-parsley-trigger="blur">
                      <option value="">-- 選擇會計科目 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordAccounts_summonsListType['item_id']?>"><?php echo $row_RecordAccounts_summonsListType['itemname']?></option>
                      <?php
} while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType));
  $rows = mysqli_num_rows($RecordAccounts_summonsListType);
  if($rows > 0) {
      mysqli_data_seek($RecordAccounts_summonsListType, 0);
	  $row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType);
  }
?>
                    </select>
                    
                    <select name="type2" id="type2" class="form-control col-md-3" style="display:inline-block">
                      <option value="-1">-- 選擇分類2 --</option>
                    </select>

                    
                    <select name="type3" id="type3" class="form-control col-md-3" style="display:inline-block">
                      <option value="-1">-- 選擇分類3 --</option>
                    </select>
                    
                    <select name="type4" id="type4" class="form-control col-md-3" style="display:inline-block">
                      <option value="-1">-- 選擇分類4 --</option>
                    </select>
                    
                    
</div>
</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">會計項目<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <input name="type" type="text" class="form-control" id="type"  maxlength="200" readonly="readonly" data-parsley-trigger="blur" required="required"/>   
			</div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">項目名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <input name="title" type="text" class="form-control" id="title"  maxlength="200" readonly="readonly" data-parsley-trigger="blur" required="required"/>   
			</div>
      </div>
		  
     <div class="form-group row">
          <label class="col-md-2 col-form-label">借方金額<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="debitamount" id="debitamount" value="<?php echo $row_RecordAccounts_summonsdetail['debitamount']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required="" <?php if ($row_RecordAccounts_summonsorder['type'] == '收入') { echo 'readonly="readonly"';} ?>/>                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">貸方金額<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="creditamount" id="creditamount" value="<?php echo $row_RecordAccounts_summonsdetail['creditamount']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required="" <?php if ($row_RecordAccounts_summonsorder['type'] == '支出') { echo 'readonly="readonly"';} ?>/>                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" value="<?php echo $row_RecordAccounts_summonsdetail['notes1']; ?>" size="50" maxlength="50" class="form-control"/>    
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
			<input name="id" type="hidden" id="id" value="<?php echo $row_RecordAccounts_summonsdetail['id']; ?>" />  
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input name="summonsnumber" type="hidden" id="summonsnumber" value="<?php echo $row_RecordAccounts_summonsorder['summonsnumber']; ?>" />
			<input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
            <input name="ordertype" type="hidden" id="ordertype" value="<?php echo $row_RecordAccounts_summonsorder['type']; ?>" />
            <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordAccounts_summonsdetail['type1']; ?>,<?php echo $row_RecordAccounts_summonsdetail['type2']; ?>,<?php echo $row_RecordAccounts_summonsdetail['type3']; ?>,<?php echo $row_RecordAccounts_summonsdetail['type4']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Accounts_summons" />
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

<script type="text/javascript">
// 下拉連動選單設定
//function myFunction() {
$(function () {
    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }
    
    // 設定預設選項
    if (defaultValue) {
        $('#type1').selectOptions($fullIdPath[0]); 
    }
    
	//$("#type2").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type3").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type4").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#type1').on('change', function() {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");//若是要刪掉全部則框號內置入/./
        $('#type2').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/accounts_summons_add.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () { 
					// 設定預設選項
					if (defaultValue) {
						$(this).selectOptions($fullIdPath[1]).trigger('change');
					} else {
						$(this).selectOptions().trigger('change');
					}
					// 設定欄位隱藏/開啟
					if( $('#type1 option:selected').val() != '' && $('#type2 option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#type2").show();
						
					}else{
						$("#type2").hide();
					}
				}
            ).on('change', function() {
            // 觸發第三階下拉式選單
				$('#type3').removeOption(/.?/).ajaxAddOption(
					'selectbox_action/accounts_summons_add.php?<?php echo time();?>', 
					{ 'id': $(this).val(), 'lv': 2 }, 
					false, 
					function () {

						// 設定預設選項
						if (defaultValue) {
							$(this).selectOptions($fullIdPath[2]);
						}
						// 設定欄位隱藏/開啟
						if( $('#type2 option:selected').val() != '' && $('#type3 option:selected').val() != '')
						// 值=val() // 標籤=text
						{
							$("#type3").show();
							//$("#type4").show();
							// 觸發第四階下拉式選單
							$('#type4').removeOption(/.?/).ajaxAddOption(
								'selectbox_action/accounts_summons_add.php?&<?php echo time();?>', 
								{ 'id': $(this).val(), 'lv': 3 }, 
								false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
								function () { 
										// 設定預設選項
										if (defaultValue) {
											$(this).selectOptions($fullIdPath[3]).trigger('change');
										} else {
											$(this).selectOptions().trigger('change');
										}
										// 設定欄位隱藏/開啟
										if( $('#type3 option:selected').val() != '' && $('#type4 option:selected').val() != '')
										// 值=val() // 標籤=text
										{
											$("#type4").show();
										}else{
											$("#type4").hide();
										}
									}
							);
							
						}else{
							$("#type3").hide(); 
							$("#type4").hide(); 
						}
					}
				).on('change', function() {
            // 觸發第四階下拉式選單
				$('#type4').removeOption(/.?/).ajaxAddOption(
					'selectbox_action/accounts_summons_add.php?<?php echo time();?>', 
					{ 'id': $(this).val(), 'lv': 3 }, 
					false, 
					function () {

						// 設定預設選項
						if (defaultValue) {
							$(this).selectOptions($fullIdPath[3]);
						}
						// 設定欄位隱藏/開啟
						if( $('#type3 option:selected').val() != '' && $('#type4 option:selected').val() != '')
						// 值=val() // 標籤=text
						{
							$("#type4").show();
						}else{
							$("#type4").hide();
						}
					}
				);
            });
            });

    }).trigger('change');
});
//}
</script> 

<script type="text/javascript">
	$(document).ready(function() {
		$('#type4').on('change', function(e) { 
			 //$('#type').val($('#type4').val()); 
			 $.ajax({
                  type :"GET",
                  url  : "ajax/accountingsubjects_code.php",
                  data : { 
                      item_id : $('#type4').val(),
                      },
                  dataType : "json",
                  success : function(msg) { 
					  //alert(msg['itemvalue']);
					  $("#type").val(msg['itemvalue']);
					  $("#title").val(msg['itemname']);
              }
       		 });
		});
		
		$('#type').on('change', function(e) { 
			 //$('#type').val($('#type4').val()); 
			 $.ajax({
                  type :"GET",
                  url  : "ajax/accountingsubjects_code.php",
                  data : { 
                      itemvalue : $('#type').val(),
                      },
                  dataType : "json",
                  success : function(msg) { 
					  //console.info(msg);
					  ////////////////////////////////////////////////////////////////////////////////////////

					  ////////////////////////////////////////////////////////////////////////////////////////
					  //$("#type4").val(msg[3]);
					  //$("#fullIdPath").val(msg[0],msg[1],msg[2],msg[3]);
					  //console.info(msg[0]+msg[1]+msg[2]+msg[3]);
					  //mutiboxselect();
              }
       		 });
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
			
		$('#debitamount').on('change', function(e) { 
			 $('#creditamount').val(0); 
			
		});
		
		$('#creditamount').on('change', function(e) { 
			 $('#debitamount').val(0); 
			
		});
	});
</script>
