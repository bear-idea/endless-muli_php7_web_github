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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Cart")) {
	// 更新計算訂單總價格
if($_POST['ocpdprice'] == ""){$_POST['ocpdprice']=0;}
if($_POST['ocfreightprice'] == ""){$_POST['ocfreightprice']=0;}
if($_POST['ocotherprice'] == ""){$_POST['ocotherprice']=0;}
if($_POST['ocexprice'] == ""){$_POST['ocexprice']=0;}
if($_POST['ocinvoiceprice'] == ""){$_POST['ocinvoiceprice']=0;}
$octotal = $_POST['ocpdprice'] + $_POST['ocfreightprice'] + $_POST['ocotherprice'] + $_POST['ocexprice'] + $_POST['ocinvoiceprice'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Cart") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Cart")) {
  $updateSQL = sprintf("UPDATE demo_cartorders SET ocname=%s, ocaddr=%s, ocphone=%s, ocmail=%s, ocgender=%s, ocbuyname=%s, ocbuyphone=%s, ocbuytel=%s, ocbuymail=%s, ocbuygender=%s, octel=%s, ocfreightprice=%s, ocfreightselect=%s, ocpaymentselect=%s, ocreceipt=%s, octotal=%s, ocfreightstate=%s, ocfreightstateonly=%s, ocfreightdate=%s, ocfreightno=%s, ocexpricename=%s, ocexprice=%s, ocotherprice=%s, ocpaymentpredate=%s, ocpaymentdate=%s, ocpaymentno=%s, ocinvoiceformat=%s, ocinvoicecompanyno=%s, ocinvoicetitle=%s, ocinvoiceusername=%s, ocinvoiceaddr=%s, ocinvoiceetselect=%s, ocinvoicesupportno=%s, ocinvoiceloveno=%s, ocinvoiceprice=%s, ocfreepricedesc=%s, `state`=%s, ocnotes1=%s, ocnotes2=%s, ocnotes3=%s, lang=%s WHERE oid=%s",
                       GetSQLValueString($_POST['ocname'], "text"),
                       GetSQLValueString($_POST['ocaddr'], "text"),
                       GetSQLValueString($_POST['ocphone'], "text"),
                       GetSQLValueString($_POST['ocmail'], "text"),
                       GetSQLValueString($_POST['ocgender'], "text"),
                       GetSQLValueString($_POST['ocbuyname'], "text"),
                       GetSQLValueString($_POST['ocbuyphone'], "text"),
                       GetSQLValueString($_POST['ocbuytel'], "text"),
                       GetSQLValueString($_POST['ocbuymail'], "text"),
                       GetSQLValueString($_POST['ocbuygender'], "text"),
                       GetSQLValueString($_POST['octel'], "text"),
                       GetSQLValueString($_POST['ocfreightprice'], "text"),
                       GetSQLValueString($_POST['ocfreightselect'], "text"),
					   GetSQLValueString($_POST['ocpaymentselect'], "text"),
                       GetSQLValueString($_POST['ocreceipt'], "text"),
					   GetSQLValueString($octotal, "int"),
                       GetSQLValueString($_POST['ocfreightstate'], "text"),
					   GetSQLValueString($_POST['ocfreightstateonly'], "int"),
                       GetSQLValueString($_POST['ocfreightdate'], "date"),
                       GetSQLValueString($_POST['ocfreightno'], "text"),
                       GetSQLValueString($_POST['ocexpricename'], "text"),
                       GetSQLValueString($_POST['ocexprice'], "int"),
                       GetSQLValueString($_POST['ocotherprice'], "int"),
                       GetSQLValueString($_POST['ocpaymentpredate'], "date"),
                       GetSQLValueString($_POST['ocpaymentdate'], "date"),
                       GetSQLValueString($_POST['ocpaymentno'], "text"),
                       GetSQLValueString($_POST['ocinvoiceformat'], "text"),
                       GetSQLValueString($_POST['ocinvoicecompanyno'], "text"),
                       GetSQLValueString($_POST['ocinvoicetitle'], "text"),
                       GetSQLValueString($_POST['ocinvoiceusername'], "text"),
                       GetSQLValueString($_POST['ocinvoiceaddr'], "text"),
                       GetSQLValueString($_POST['ocinvoiceetselect'], "int"),
                       GetSQLValueString($_POST['ocinvoicesupportno'], "text"),
                       GetSQLValueString($_POST['ocinvoiceloveno'], "text"),
                       GetSQLValueString($_POST['ocinvoiceprice'], "text"),
                       GetSQLValueString($_POST['ocfreepricedesc'], "text"),
                       GetSQLValueString($_POST['state'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['notes2'], "text"),
                       GetSQLValueString($_POST['notes3'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['oid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_cart.php?Operate=editSuccess&Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */

/* 取得作者資料 */

/* 取得最新訊息資料 */
$colname_RecordCart = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordCart = $_GET['id_edit'];
}
$coluserid_RecordCart = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCart = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCart = sprintf("SELECT * FROM demo_cartorders WHERE oid = %s && userid=%s", GetSQLValueString($colname_RecordCart, "int"),GetSQLValueString($coluserid_RecordCart, "int"));
$RecordCart = mysqli_query($DB_Conn, $query_RecordCart) or die(mysqli_error($DB_Conn));
$row_RecordCart = mysqli_fetch_assoc($RecordCart);
$totalRows_RecordCart = mysqli_num_rows($RecordCart);

$colname_RecordCartListFreight = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListFreight = $_GET['lang'];
}
$coluserid_RecordCartListFreight = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListFreight = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListFreight = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListFreight, "text"),GetSQLValueString($coluserid_RecordCartListFreight, "int"));
$RecordCartListFreight = mysqli_query($DB_Conn, $query_RecordCartListFreight) or die(mysqli_error($DB_Conn));
$row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
$totalRows_RecordCartListFreight = mysqli_num_rows($RecordCartListFreight);

$colname_RecordCartListPayment = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListPayment = $_GET['lang'];
}
$coluserid_RecordCartListPayment = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListPayment = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListPayment = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 3 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListPayment, "text"),GetSQLValueString($coluserid_RecordCartListPayment, "int"));
$RecordCartListPayment = mysqli_query($DB_Conn, $query_RecordCartListPayment) or die(mysqli_error($DB_Conn));
$row_RecordCartListPayment = mysqli_fetch_assoc($RecordCartListPayment);
$totalRows_RecordCartListPayment = mysqli_num_rows($RecordCartListPayment);

$colname_RecordRecordCartListState = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordRecordCartListState = $_GET['lang'];
}
$coluserid_RecordRecordCartListState = "-1";
if (isset($w_userid)) {
  $coluserid_RecordRecordCartListState = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRecordCartListState = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordRecordCartListState, "text"),GetSQLValueString($coluserid_RecordRecordCartListState, "int"));
$RecordRecordCartListState = mysqli_query($DB_Conn, $query_RecordRecordCartListState) or die(mysqli_error($DB_Conn));
$row_RecordRecordCartListState = mysqli_fetch_assoc($RecordRecordCartListState);

$totalRows_RecordRecordCartListState = mysqli_num_rows($RecordRecordCartListState);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageCartEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageCartEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageCartEditorSelect == '1' || $ManageCartEditorSelect == '2') { ?>
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 訂單 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 訂購人基本資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="ocbuyname" type="text" class="form-control" id="ocbuyname" value="<?php echo $row_RecordCart['ocbuyname']; ?>" maxlength="30" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓別</label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocbuygender'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocbuygender" id="ocbuygender_1" value="男" />
                <label for="ocbuygender_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocbuygender'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocbuygender" id="ocbuygender_2" value="女" />
                <label for="ocbuygender_2">女</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">手機號碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="ocbuyphone" type="text" class="form-control" id="ocbuyphone" value="<?php echo $row_RecordCart['ocbuyphone']; ?>" maxlength="30" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
          
                      <input name="ocbuytel" type="text" class="form-control" id="ocbuytel" value="<?php echo $row_RecordCart['ocbuytel']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label> 
          <div class="col-md-10">
              <input name="ocbuymail" type="email" class="form-control" id="ocbuymail" value="<?php echo $row_RecordCart['ocbuymail']; ?>" maxlength="100" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 收貨人基本資料</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="ocname" type="text" class="form-control" id="ocname" value="<?php echo $row_RecordCart['ocname']; ?>" maxlength="30" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">姓別</label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocgender'],"男"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocgender" id="ocgender_1" value="男" required=""/>
                <label for="ocgender_1">男</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocgender'],"女"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocgender" id="ocgender_2" value="女" />
                <label for="ocgender_2">女</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">手機號碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="ocphone" type="text" class="form-control" id="ocphone" value="<?php echo $row_RecordCart['ocphone']; ?>" maxlength="30" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
          
                      <input name="octel" type="text" class="form-control" id="octel" value="<?php echo $row_RecordCart['octel']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label> 
          <div class="col-md-10">
              <input name="ocmail" type="email" class="form-control" id="ocmail" value="<?php echo $row_RecordCart['ocmail']; ?>" maxlength="100" data-parsley-trigger="blur" required=""/> 
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 發票內容</span></div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票類型<span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceformat'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceformat" id="ocinvoiceformat_0" value="0" onclick="return Checkinvoiceformat();" required=""/>
                <label for="ocinvoiceformat_0">不需開發票</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceformat'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceformat" id="ocinvoiceformat_1" value="1" onclick="return Checkinvoiceformat();"/>
                <label for="ocinvoiceformat_1">二聯式發票(個人)</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceformat'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceformat" id="ocinvoiceformat_2" value="2" onclick="return Checkinvoiceformat();"/>
                <label for="ocinvoiceformat_2">三聯式發票</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceformat'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceformat" id="ocinvoiceformat_3" value="3" onclick="return Checkinvoiceformat();"/>
                <label for="ocinvoiceformat_3">電子式發票</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceformat'],"4"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceformat" id="ocinvoiceformat_4" value="4" onclick="return Checkinvoiceformat();"/>
                <label for="ocinvoiceformat_4">收據</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceformat'],"5"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceformat" id="ocinvoiceformat_5" value="5" onclick="return Checkinvoiceformat();"/>
                <label for="ocinvoiceformat_5">捐給慈善單位</label>
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電子發票</label>
          <div class="col-md-2">
            <div class="input-group m-b-10 pull-left">
            <div class="input-group-prepend">
            <span class="input-group-text label p-b-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocinvoiceetselect'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocinvoiceetselect" id="ocinvoiceetselect_0" value="0" onclick="return Checkinvoiceformat();"/>
                <label for="ocinvoiceetselect_0">列印寄給我</label>
            </div>
            </span>
            </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="input-group m-b-10 pull-left">
              <div class="input-group-prepend">
                <span class="input-group-text label">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordCart['ocinvoiceetselect'],"1"))) {echo "checked=\"checked\"";} ?> name="ocinvoiceetselect" type="radio" id="ocinvoiceetselect_1" value="1" onclick="return Checkinvoiceformat();"/>
                      <label for="ocinvoiceetselect_1" >載具條碼 </label>
                    </div>
                    </span>
                </div>
                <input name="ocinvoicesupportno" type="text" class="form-control" id="ocinvoicesupportno" value="<?php echo $row_RecordCart['ocinvoicesupportno']; ?>" maxlength="50" data-parsley-trigger="blur" />
                   
            </div>
          </div>
          <div class="col-md-4"> 
            <div class="input-group m-b-10 pull-left">
              <div class="input-group-prepend">
                <span class="input-group-text label">
                    <div class="radio radio-css radio-inline">
                      <input <?php if (!(strcmp($row_RecordCart['ocinvoiceetselect'],"2"))) {echo "checked=\"checked\"";} ?> name="ocinvoiceetselect" type="radio" id="ocinvoiceetselect_2" value="2" onclick="return Checkinvoiceformat();"/>
                      <label for="ocinvoiceetselect_2" >愛心碼 </label>
                    </div>
                    </span>
                </div>
                <input name="ocinvoiceloveno" type="text" class="form-control" id="ocinvoiceloveno" value="<?php echo $row_RecordCart['ocinvoiceloveno']; ?>" maxlength="50" data-parsley-trigger="blur" />
                   
            </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">統一編號</label>
          <div class="col-md-10">
                      
                      <input name="ocinvoicecompanyno" type="text" class="form-control" id="ocinvoicecompanyno" value="<?php echo $row_RecordCart['ocinvoicecompanyno']; ?>" maxlength="30" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票抬頭</label>
          <div class="col-md-10">
                      
                      <input name="ocinvoicetitle" type="text" class="form-control" id="ocinvoicetitle" value="<?php echo $row_RecordCart['ocinvoicetitle']; ?>" maxlength="30" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票收件人</label>
          <div class="col-md-10">
                      
                      <input name="ocinvoiceusername" type="text" class="form-control" id="ocinvoiceusername" value="<?php echo $row_RecordCart['ocinvoiceusername']; ?>" maxlength="30" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票收件地址</label>
          <div class="col-md-10">
                      
                      <input name="ocinvoiceaddr" type="text" class="form-control" id="ocinvoiceaddr" value="<?php echo $row_RecordCart['ocinvoiceaddr']; ?>" maxlength="300" data-parsley-trigger="blur"  />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 付款、出貨資料</span></div>
        </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">付款方式<span class="text-red">*</span></label>
          <div class="col-md-10">
              <select name="ocpaymentselect" id="ocpaymentselect" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp("", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>-- 選擇付款方式 --</option>
                  <option value="payondelivery" <?php if (!(strcmp("payondelivery", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>貨到付款</option>
                  <option value="lingui" <?php if (!(strcmp("lingui", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>金融匯款</option>
                  <option value="atm" <?php if (!(strcmp("atm", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>ATM轉帳</option>
                  <option value="postoffice" <?php if (!(strcmp("postoffice", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>郵政劃撥</option>
                  <option value="paypal" <?php if (!(strcmp("paypal", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>PAYPAL</option>
                  <option value="allpay" <?php if (!(strcmp("allpay", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>綠界(付款全開啟)</option>
                  <option value="allpay_Credit" <?php if (!(strcmp("allpay_Credit", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>綠界(信用卡一次付清)</option>
                  <option value="allpay_BARCODE" <?php if (!(strcmp("allpay_BARCODE", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>綠界(超商條碼)</option>
                  <option value="allpay_CVS" <?php if (!(strcmp("allpay_CVS", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>綠界(超商代碼)</option>
                  <option value="pchomepay" <?php if (!(strcmp("pchomepay", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>支付連(信用卡一次付清)</option>
                  <option value="other" <?php if (!(strcmp("other", $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>>其他付款方式</option>
<?php if ($totalRows_RecordCartListPayment > 0) { ?>
<?php
do {  
?>
                  <option value="<?php echo $row_RecordCartListPayment['itemname']?>"<?php if (!(strcmp($row_RecordCartListPayment['itemname'], $row_RecordCart['ocpaymentselect']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCartListPayment['itemname']?></option>
<?php
} while ($row_RecordCartListPayment = mysqli_fetch_assoc($RecordCartListPayment));
  $rows = mysqli_num_rows($RecordCartListPayment);
  if($rows > 0) {
      mysqli_data_seek($RecordCartListPayment, 0);
	  $row_RecordCartListPayment = mysqli_fetch_assoc($RecordCartListPayment);
  }
?>
<?php } ?>
                </select> 
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">貨款狀態<span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstate" id="ocfreightstate_0" value="0"  required=""/>
                <label for="ocfreightstate_0">需自行確認</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstate" id="ocfreightstate_1" value="1" />
                <label for="ocfreightstate_1">等待貨款</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstate'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstate" id="ocfreightstate_2" value="2" />
                <label for="ocfreightstate_2">已收到貨款</label>
            </div>
            
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">匯款狀態</label>
          <div class="col-md-5">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">匯款日期</span></div>
                   <input name="ocfreightdate" type="text" class="form-control" id="ocfreightdate" value="<?php echo $row_RecordCart['ocfreightdate']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">帳號後五碼</span></div>
                   <input name="ocfreightno" class="form-control" id="ocfreightno" value="<?php echo $row_RecordCart['ocfreightno']; ?>" data-parsley-min="0" data-parsley-max="99999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                                      
              </div>
                 
          </div>
      </div>
      
      <div class="form-group row">
        
        <label class="col-md-2 col-form-label">貨運方式</label>
          <div class="col-md-10">
                    <div class="alert alert-warning m-t-0 m-b-10"><i class="fa fa-info-circle"></i> <b>修改貨運方式並不會修正運費價格，請自行修改運費價格!!</b></div>
                    <select name="ocfreightselect" id="ocfreightselect" class="form-control" data-parsley-trigger="blur" >
                  <option value="" <?php if (!(strcmp("", $row_RecordCart['ocfreightselect']))) {echo "selected=\"selected\"";} ?>>-- 選擇貨運方式 --</option>
<option value="sevenshop" <?php if (!(strcmp("sevenshop", $row_RecordCart['ocfreightselect']))) {echo "selected=\"selected\"";} ?>>7-11 超商取貨(取貨付款)</option>
<option value="sevenshopnopay" <?php if (!(strcmp("sevenshopnopay", $row_RecordCart['ocfreightselect']))) {echo "selected=\"selected\"";} ?>>7-11 超商取貨(純配送)</option>
<option value="familyshop" <?php if (!(strcmp("familyshop", $row_RecordCart['ocfreightselect']))) {echo "selected=\"selected\"";} ?>>全家超商取貨(取貨付款)</option>
<option value="familyshopnopay" <?php if (!(strcmp("familyshopnopay", $row_RecordCart['ocfreightselect']))) {echo "selected=\"selected\"";} ?>>全家超商取貨(純配送)</option>
<?php if ($totalRows_RecordCartListFreight  > 0 ) { ?>
<?php
do {  
?>
                  <option value="<?php echo $row_RecordCartListFreight['item_id']?>"<?php if (!(strcmp($row_RecordCartListFreight['item_id'], $row_RecordCart['ocfreightselect']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordCartListFreight['itemname']?></option>
<?php
} while ($row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight));
  $rows = mysqli_num_rows($RecordCartListFreight);
  if($rows > 0) {
      mysqli_data_seek($RecordCartListFreight, 0);
	  $row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
  }
?>
<?php } ?>

                </select>
               
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">出貨</label>
          <div class="col-md-2">
          <div class="input-group" data-column="4"> <span class="input-group-prepend"><span class="input-group-text">狀態</span></span>
              <select name="state" id="state" class="form-control" data-parsley-trigger="blur" >
                  <option value="未處理" <?php if (!(strcmp("未處理", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>未處理</option>
                  <option value="未出貨" <?php if (!(strcmp("未出貨", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>未出貨</option>
                  <option value="缺貨中" <?php if (!(strcmp("缺貨中", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>缺貨中</option>
                  <option value="處理中" <?php if (!(strcmp("處理中", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>處理中</option>
                  <option value="備貨中" <?php if (!(strcmp("備貨中", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>備貨中</option>
                  <option value="已出貨" <?php if (!(strcmp("已出貨", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>已出貨</option>
                  <option value="交易完成" <?php if (!(strcmp("交易完成", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>交易完成</option>
                  <option value="交易取消" <?php if (!(strcmp("交易取消", $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>>交易取消</option>
                  <?php if ($totalRows_RecordRecordCartListState  > 0 ) { ?>
                  <?php
do {  
?>
<option value="<?php echo $row_RecordRecordCartListState['itemname']?>"<?php if (!(strcmp($row_RecordRecordCartListState['itemname'], $row_RecordCart['state']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordRecordCartListState['itemname']?></option>
                  <?php
} while ($row_RecordRecordCartListState = mysqli_fetch_assoc($RecordRecordCartListState));
  $rows = mysqli_num_rows($RecordRecordCartListState);
  if($rows > 0) {
      mysqli_data_seek($RecordRecordCartListState, 0);
	  $row_RecordRecordCartListState = mysqli_fetch_assoc($RecordRecordCartListState);
  }
?>
<?php } ?>
                </select> 
                </div>
                 
          </div>
          
          <div class="col-md-3">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">預計出貨日期</span></div>
                   <input name="ocpaymentpredate" type="text" class="form-control" id="ocpaymentpredate" value="<?php echo $row_RecordCart['ocpaymentpredate']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          
          <div class="col-md-3">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">出貨日期</span></div>
                   <input name="ocpaymentdate" type="text" class="form-control" id="ocpaymentdate" value="<?php echo $row_RecordCart['ocpaymentdate']; ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          
          <div class="col-md-2">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">出貨單號</span></div>
                   <input name="ocpaymentno" type="text" class="form-control" id="ocpaymentno" value="<?php echo $row_RecordCart['ocpaymentno']; ?>" maxlength="30" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">收件地址</label>
          <div class="col-md-10">
          
                      <input name="ocaddr" type="text" class="form-control" id="ocaddr" value="<?php echo $row_RecordMember['ocaddr']; ?>" maxlength="300" data-parsley-trigger="blur" />
                      <?php if($row_RecordCart['ocCVSStoreName'] != "") { ?>【<?php echo $row_RecordCart['ocCVSStoreName']; // 商店名稱?><?php if($row_RecordCart['ocCVSStoreID'] != "") { ?> - <?php echo $row_RecordCart['ocCVSStoreID']; // 商店名稱?><?php } ?>】<?php } ?>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">收貨時間</label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocreceipt'],"不拘"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocreceipt" id="ocreceipt_1" value="不拘" />
                <label for="ocreceipt_1">不拘</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocreceipt'],"早上"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocreceipt" id="ocreceipt_2" value="早上" />
                <label for="ocreceipt_2">早上</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocreceipt'],"下午"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocreceipt" id="ocreceipt_3" value="下午" />
                <label for="ocreceipt_3">下午</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocreceipt'],"晚上"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocreceipt" id="ocreceipt_4" value="晚上" />
                <label for="ocreceipt_4">晚上</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 訂單金額</span></div>
        </div>
       <div class="form-group row">
          <label class="col-md-2 col-form-label">商品金額</label>
          <div class="col-md-10">
                      
                      <input name="ocpdprice" type="text" required="" class="form-control" id="ocpdprice" value="<?php echo $row_RecordCart['ocpdprice']; ?>" maxlength="30" readonly="readonly" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">運費</label>
          <div class="col-md-2">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">價格</span></div>
                   <input name="ocfreightprice" id="ocfreightprice" value="<?php echo $row_RecordCart['ocfreightprice']; ?>" maxlength="11" class="form-control" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                                      
              </div>
                 
          </div>
          
          <div class="col-md-3">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">運費備註</span></div>
                   <input name="ocfreepricedesc" type="text" class="form-control" id="ocfreepricedesc" value="<?php echo $row_RecordCart['ocfreepricedesc']; ?>" maxlength="300" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          
          <div class="col-md-1 col-form-label "><label class="col-form-label">運費狀態</label></div>
          
          <div class="col-md-4">
             <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstateonly'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstateonly" id="ocfreightstateonly_1" value="0" />
                <label for="ocfreightstateonly_1">無</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstateonly'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstateonly" id="ocfreightstateonly_2" value="1" />
                <label for="ocfreightstateonly_2">消費者自填運費</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstateonly'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstateonly" id="ocfreightstateonly_3" value="2" />
                <label for="ocfreightstateonly_3">業者填寫運費</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordCart['ocfreightstateonly'],"3"))) {echo "checked=\"checked\"";} ?> type="radio" name="ocfreightstateonly" id="ocfreightstateonly_4" value="3" />
                <label for="ocfreightstateonly_4">滿額免運費</label>
            </div>
                 
          </div>
          
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">額外費用</label>
          <div class="col-md-2">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">價格</span></div>
                   <input name="ocexprice" id="ocexprice" value="<?php echo $row_RecordCart['ocexprice']; ?>" maxlength="11" class="form-control" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                                      
              </div>
                 
          </div>
          
          <div class="col-md-3">
             <div class="input-group p-0">
            
              <div class="input-group-prepend"><span class="input-group-text">額外費用名稱</span></div>
                   <input name="ocexpricename" type="text" class="form-control" id="ocexpricename" value="<?php echo $row_RecordCart['ocexpricename']; ?>" maxlength="50" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
  
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">發票稅</label>
          <div class="col-md-10">
                      <input name="ocinvoiceprice" id="ocinvoiceprice" value="<?php echo $row_RecordCart['ocinvoiceprice']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">金物流加收</label>
          <div class="col-md-10">
                      <input name="ocotherprice" id="ocotherprice" value="<?php echo $row_RecordCart['ocotherprice']; ?>" maxlength="11" class="form-control col-md-4 " data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" />
                            
        </div>
      </div>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 備註資料</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">客戶備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordCart['notes1']; ?>" size="50" maxlength="200"/>
              <small class="f-s-12 text-grey-darker">客戶提醒業者資訊。</small> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">業者備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordCart['notes1']; ?>" size="50" maxlength="200"/>
              <small class="f-s-12 text-grey-darker">業者自己備註用，消費者不可以看到 !!</small> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">業者備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordCart['notes1']; ?>" size="50" maxlength="200"/>
              <small class="f-s-12 text-grey-darker">業者提醒消費者用，消費者可以看到 !!</small> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="oid" type="hidden" id="oid" value="<?php echo $row_RecordCart['oid']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordCart['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Cart" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
function Checkinvoiceformat()
{
	if($('input[name=invoiceformat]:checked').val() == "0" || $('input[name=invoiceformat]:checked').val() == "5") 
	{	
	    $('#ocinvoicetitle').attr('disabled', true);
		$('#ocinvoiceusername').attr('disabled', true);
		$('#ocinvoiceaddr').attr('disabled', true);
		$('#autoinputreceiver').attr('disabled', true);
		$('#ocinvoicesupportno').attr('disabled', true);
		$('#ocinvoiceloveno').attr('disabled', true);
		$('#ocinvoicecompanyno').attr('disabled', true);
		$("input[name=ocinvoiceetselect]").attr("disabled",true);
	}
	if($('input[name=invoiceformat]:checked').val() == "1") 
	{	
		$('#ocinvoicetitle').attr('disabled', false);
		$('#ocinvoiceusername').attr('disabled', false);
		$('#ocinvoiceaddr').attr('disabled', false);
		$('#autoinputreceiver').attr('disabled', false);
		$('#ocinvoicesupportno').attr('disabled', true);
		$('#ocinvoiceloveno').attr('disabled', true);
		$('#ocinvoicecompanyno').attr('disabled', true);
		$("input[name=ocinvoiceetselect]").attr("disabled",true);
		
	}
	if($('input[name=invoiceformat]:checked').val() == "2"  || $('input[name=invoiceformat]:checked').val() == "4") 
	{	
	    $('#ocinvoicetitle').attr('disabled', false);
		$('#ocinvoiceusername').attr('disabled', false);
		$('#ocinvoiceaddr').attr('disabled', false);
		$('#autoinputreceiver').attr('disabled', false);
		$('#ocinvoicesupportno').attr('disabled', true);
		$('#ocinvoiceloveno').attr('disabled', true);
		$('#ocinvoicecompanyno').attr('disabled', false);
		$("input[name=ocinvoiceetselect]").attr("disabled",true);
	}
	
	if($('input[name=invoiceformat]:checked').val() == "3") 
	{	
	    $('#ocinvoicetitle').attr('disabled', true);
		$('#ocinvoiceusername').attr('disabled', true);
		$('#ocinvoiceaddr').attr('disabled', true);
		$('#autoinputreceiver').attr('disabled', true);
		$('#ocinvoicesupportno').attr('disabled', true);
		$('#ocinvoiceloveno').attr('disabled', true);
		$('#ocinvoicecompanyno').attr('disabled', true);
		$("input[name=ocinvoiceetselect]").attr("disabled",false);
		if($('input[name=ocinvoiceetselect]:checked').val() == "0")
		{
			$('#ocinvoicecompanyno').attr('disabled', false);
			$('#ocinvoicetitle').attr('disabled', false);
			$('#ocinvoiceusername').attr('disabled', false);
			$('#ocinvoiceaddr').attr('disabled', false);
			$('#ocinvoicesupportno').attr('disabled', true);
			$('#ocinvoiceloveno').attr('disabled', true);
		}
		if($('input[name=ocinvoiceetselect]:checked').val() == "1")
		{
			$('#ocinvoicecompanyno').attr('disabled', true);
			$('#ocinvoicetitle').attr('disabled', true);
			$('#ocinvoiceusername').attr('disabled', true);
			$('#ocinvoiceaddr').attr('disabled', true);
			$('#ocinvoicesupportno').attr('disabled', false);
			$('#ocinvoiceloveno').attr('disabled', true);
		}
		if($('input[name=ocinvoiceetselect]:checked').val() == "2")
		{
			$('#ocinvoicecompanyno').attr('disabled', true);
			$('#ocinvoicetitle').attr('disabled', true);
			$('#ocinvoiceusername').attr('disabled', true);
			$('#ocinvoiceaddr').attr('disabled', true);
			$('#ocinvoicesupportno').attr('disabled', true);
			$('#ocinvoiceloveno').attr('disabled', false);
		}
	}
}
</script>

<?php
mysqli_free_result($RecordCart);

mysqli_free_result($RecordCartListFreight);

mysqli_free_result($RecordCartListPayment);

mysqli_free_result($RecordRecordCartListState);
?>
