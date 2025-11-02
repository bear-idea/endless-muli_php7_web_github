<?php require_once('../Connections/DB_Conn.php'); ?>
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
/* 新增類別項目 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_CartItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_cartitem (list_id, itemname, `mode`, modeselect, countryprice, northprice, centralprice, southprice, eastprice, outerprice, addrindicate, productcome, productcomeprice, productcomeselect, fixedprice, dynamicprice1, dynamicprice2, dynamicprice3, dynamicprice4, dynamicprice5, dynamicprice6, dynamicpricepay1, dynamicpricepay2, dynamicpricepay3, dynamicpricepay4, dynamicpricepay5, dynamicpricepay6, dynamicpriceunit1, dynamicpriceunit2, dynamicpriceunit3, dynamicpriceunit4, dynamicpriceunit5, dynamicpriceunit6, content, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString($_POST['itemname'], "text"),
                       GetSQLValueString($_POST['mode'], "int"),
                       GetSQLValueString($_POST['modeselect'], "int"),
                       GetSQLValueString($_POST['countryprice'], "int"),
                       GetSQLValueString($_POST['northprice'], "int"),
                       GetSQLValueString($_POST['centralprice'], "int"),
                       GetSQLValueString($_POST['southprice'], "int"),
                       GetSQLValueString($_POST['eastprice'], "int"),
                       GetSQLValueString($_POST['outerprice'], "int"),
                       GetSQLValueString($_POST['addrindicate'], "int"),
                       GetSQLValueString($_POST['productcome'], "int"),
                       GetSQLValueString($_POST['productcomeprice'], "int"),
                       GetSQLValueString($_POST['productcomeselect'], "int"),
                       GetSQLValueString($_POST['fixedprice'], "int"),
					   GetSQLValueString($_POST['dynamicprice1'], "int"),
					   GetSQLValueString($_POST['dynamicprice2'], "int"),
					   GetSQLValueString($_POST['dynamicprice3'], "int"),
					   GetSQLValueString($_POST['dynamicprice4'], "int"),
					   GetSQLValueString($_POST['dynamicprice5'], "int"),
					   GetSQLValueString($_POST['dynamicprice6'], "int"),
					   GetSQLValueString($_POST['dynamicpricepay1'], "int"),
					   GetSQLValueString($_POST['dynamicpricepay2'], "int"),
					   GetSQLValueString($_POST['dynamicpricepay3'], "int"),
					   GetSQLValueString($_POST['dynamicpricepay4'], "int"),
					   GetSQLValueString($_POST['dynamicpricepay5'], "int"),
					   GetSQLValueString($_POST['dynamicpricepay6'], "int"),
					   GetSQLValueString($_POST['dynamicpriceunit1'], "text"),
					   GetSQLValueString($_POST['dynamicpriceunit2'], "text"),
					   GetSQLValueString($_POST['dynamicpriceunit3'], "text"),
					   GetSQLValueString($_POST['dynamicpriceunit4'], "text"),
					   GetSQLValueString($_POST['dynamicpriceunit5'], "text"),
					   GetSQLValueString($_POST['dynamicpriceunit6'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_CartDefaultItemEdit")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET userid=%s, sevenshopenable=%s, sevenshopdesc=%s, familyshopenable=%s, familyshopdesc=%s, sevenshopnopayenable=%s, sevenshopnopaydesc=%s, familyshopnopayenable=%s, familyshopnopaydesc=%s, sevenshopshipment=%s, familyshopshipment=%s, sevenshopnopayshipment=%s, familyshopnopayshipment=%s WHERE id=%s",
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString(isset($_POST['sevenshopenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['sevenshopdesc'], "text"),
                       GetSQLValueString(isset($_POST['familyshopenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['familyshopdesc'], "text"),
                       GetSQLValueString(isset($_POST['sevenshopnopayenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['sevenshopnopaydesc'], "text"),
                       GetSQLValueString(isset($_POST['familyshopnopayenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['familyshopnopaydesc'], "text"),
					   GetSQLValueString($_POST['sevenshopshipment'], "int"),
					   GetSQLValueString($_POST['familyshopshipment'], "int"),
					   GetSQLValueString($_POST['sevenshopnopayshipment'], "int"),
					   GetSQLValueString($_POST['familyshopnopayshipment'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_CartItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_cartitem SET list_id=%s, itemname=%s, lang=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_cartitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordCartListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCartListItem = $_GET['lang'];
}
$coluserid_RecordCartListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartListItem = $w_userid;
}
$collistid_RecordCartListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCartListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListItem = sprintf("SELECT demo_cartitem.item_id, demo_cartitem.userid, demo_cartlist.list_id, demo_cartlist.listname, demo_cartitem.itemname, demo_cartitem.itemvalue, demo_cartitem.lang FROM demo_cartlist LEFT OUTER JOIN demo_cartitem ON demo_cartlist.list_id = demo_cartitem.list_id WHERE demo_cartlist.list_id = %s && demo_cartitem.lang=%s && demo_cartitem.userid=%s", GetSQLValueString($collistid_RecordCartListItem, "int"),GetSQLValueString($collang_RecordCartListItem, "text"),GetSQLValueString($coluserid_RecordCartListItem, "int"));
$RecordCartListItem = mysqli_query($DB_Conn, $query_RecordCartListItem) or die(mysqli_error($DB_Conn));
$row_RecordCartListItem = mysqli_fetch_assoc($RecordCartListItem);
$totalRows_RecordCartListItem = mysqli_num_rows($RecordCartListItem);

$coluserid_RecordDefaultPayment = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDefaultPayment = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDefaultPayment = sprintf("SELECT * FROM demo_setting_otr WHERE userid = %s", GetSQLValueString($coluserid_RecordDefaultPayment, "int"));
$RecordDefaultPayment = mysqli_query($DB_Conn, $query_RecordDefaultPayment) or die(mysqli_error($DB_Conn));
$row_RecordDefaultPayment = mysqli_fetch_assoc($RecordDefaultPayment);
$totalRows_RecordDefaultPayment = mysqli_num_rows($RecordDefaultPayment);
?>

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.replace( 'content',{width : '99.8%', height : '150px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'sevenshopdesc',{width : '99.8%', height : '150px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'familyshopdesc',{width : '99.8%', height : '150px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'sevenshopnopaydesc',{width : '99.8%', height : '150px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'familyshopnopaydesc',{width : '99.8%', height : '150px', toolbar : 'Basic'} );
};
</script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 貨運及貨到付款 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 預設貨運方式</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
    
    <form id="form_CartDefaultItemEdit" name="form_CartDefaultItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    
      
        <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>運費以綠界公告為主。 <a href="https://www.ecpay.com.tw/IntroTransport/Service_Fee" target="_blank" class="btn btn-primary btn-xs" data-original-title="" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 前往觀看</a></b></div>
        
        <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>若輸入則表示由消費者負擔，若未填則表示由店家自行吸收運費。</b></div>
        
        
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
            <input <?php if (!(strcmp($row_RecordDefaultPayment['sevenshopenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="sevenshopenable" id="sevenshopenable" />
              <label for="sevenshopenable">啟用</label>
              <?php } else { ?> 
              <input <?php if (!(strcmp($row_RecordDefaultPayment['sevenshopenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="sevenshopenable" id="sevenshopenable" disabled="disabled"/>
              <label for="sevenshopenable">啟用</label>
              <?php }  ?>
              <br />
              <br />

              <img src="images/allpaylogo.jpg" alt="" width="50" height="30" /><img src="images/7-11_logo.jpg" width="29" height="30" /><br />
              7-11超商取貨<br />
              (取貨付款)
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
            <?php } else { ?>
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
            <?php } ?>
            
              <div class="table-responsive">
                    <textarea name="sevenshopdesc" id="sevenshopdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['sevenshopdesc']; ?></textarea>  
              </div>
              
          <div class="input-group p-0 m-t-10">
                  <div class="input-group-prepend"><span class="input-group-text">運費</span></div>
                  <input name="sevenshopshipment" id="sevenshopshipment" value="<?php echo $row_RecordDefaultPayment['sevenshopshipment']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                            
            </div>
                      
        </div>
        
      </div>
      
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
        <input <?php if (!(strcmp($row_RecordDefaultPayment['familyshopenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="familyshopenable" id="familyshopenable" />
          <label for="familyshopenable">啟用</label>
          <?php } else { ?> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['familyshopenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="familyshopenable" id="familyshopenable" disabled="disabled"/>
          <label for="sevenshopenable">啟用</label>
          <?php }  ?>
              <br />
              <br />

              <img src="images/allpaylogo.jpg" alt="" width="50" height="30" /><img src="images/family_logo.jpg" alt="" width="29" height="30" /><br />
              全家超商取貨<br />
              (取貨付款)
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
            <?php } else { ?>
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
            <?php } ?>
            
              <div class="table-responsive">
                    <textarea name="familyshopdesc" id="familyshopdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['familyshopdesc']; ?></textarea>  
              </div>
              
          <div class="input-group p-0 m-t-10">
                  <div class="input-group-prepend"><span class="input-group-text">運費</span></div>
                  <input name="familyshopshipment" id="familyshopshipment" value="<?php echo $row_RecordDefaultPayment['familyshopshipment']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                            
            </div>
                      
        </div>
        
      </div>
      
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
        <input <?php if (!(strcmp($row_RecordDefaultPayment['sevenshopnopayenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="sevenshopnopayenable" id="sevenshopnopayenable" />
          <label for="sevenshopnopayenable">啟用</label>
          <?php } else { ?> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['sevenshopnopayenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="sevenshopnopayenable" id="sevenshopnopayenable" disabled="disabled"/>
          <label for="sevenshopenable">啟用</label>
          <?php }  ?>
              <br />
              <br />

              <img src="images/allpaylogo.jpg" alt="" width="50" height="30" /><img src="images/7-11_logo.jpg" width="29" height="30" /><br />
              7-11超商取貨<br />
              (純配送)
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
            <?php } else { ?>
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
            <?php } ?>
            
              <div class="table-responsive">
                    <textarea name="sevenshopnopaydesc" id="sevenshopnopaydesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['sevenshopnopaydesc']; ?></textarea>  
              </div>
              
          <div class="input-group p-0 m-t-10">
                  <div class="input-group-prepend"><span class="input-group-text">運費</span></div>
                  <input name="sevenshopnopayshipment" id="sevenshopnopayshipment" value="<?php echo $row_RecordDefaultPayment['sevenshopnopayshipment']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                            
            </div>
                      
        </div>
        
      </div>
      
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
        <input <?php if (!(strcmp($row_RecordDefaultPayment['familyshopnopayenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="familyshopnopayenable" id="familyshopnopayenable" />
          <label for="familyshopnopayenable">啟用</label>
          <?php } else { ?> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['familyshopnopayenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="familyshopnopayenable" id="familyshopnopayenable" disabled="disabled"/>
          <label for="sevenshopenable">啟用</label>
          <?php }  ?>
              <br />
              <br />

              <img src="images/allpaylogo.jpg" alt="" width="50" height="30" /><img src="images/family_logo.jpg" alt="" width="29" height="30" /><br />
              全家超商取貨<br />
              (純配送)
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpayfreightHashKey'] != "" && $row_RecordDefaultPayment['allpayfreightHashIV'] != "") { ?>
            <?php } else { ?>
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
            <?php } ?>
            
              <div class="table-responsive">
                    <textarea name="familyshopnopaydesc" id="familyshopnopaydesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['familyshopnopaydesc']; ?></textarea>  
              </div>
              
          <div class="input-group p-0 m-t-10">
                  <div class="input-group-prepend"><span class="input-group-text">運費</span></div>
                  <input name="familyshopnopayshipment" id="familyshopnopayshipment" value="<?php echo $row_RecordDefaultPayment['familyshopnopayshipment']; ?>" maxlength="11" class="form-control col-md-4" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1" required=""/>
                            
            </div>
                      
        </div>
        
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block"  >送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDefaultPayment['id']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      
      
        <input type="hidden" name="MM_update" value="form_CartDefaultItemEdit" />
      </form>
      
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


                    
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 自訂貨運方式</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordCartListItem > 0) { // Show if recordset not empty ?>
    <form id="form_CartItemEdit" name="form_CartItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordCartListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordCartListItem['item_id']; ?>" value="<?php echo $row_RecordCartListItem['item_id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordCartListItem['item_id']; ?>">是否刪除</label>
                            </div>          
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                      <a class="btn btn-info btn-block colorbox_iframe" href="cart_transit_config.php?item_id=<?php echo $row_RecordCartListItem['item_id']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top">詳細設定 <i class="fa fa-chevron-circle-right"></i></a>           
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordCartListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordCartListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordCartListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />       
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordCartListItem = mysqli_fetch_assoc($RecordCartListItem)); ?> 
        <input type="hidden" name="MM_update" value="form_CartItemEdit" />
      </form>
      <?php } // Show if recordset not empty ?>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增貨運方式</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
      <form id="form_CartItemAdd" name="form_CartItemAdd" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="itemname" type="text" id="itemname" class="form-control" data-parsley-trigger="blur" required=""/>
                      <small class="f-s-12 text-grey-darker">例如郵局送貨、快遞送貨、黑貓宅急便、低溫宅配、到店取貨、由本店決定、貨到付款、面交。</small>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">是否需運費<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input name="mode" type="radio" id="mode_1" value="0" checked="checked" />
              <label for="mode_1">運費0元</label>
            </div>
            <div class="radio radio-css ">
              <input type="radio" name="mode" id="mode_2" value="1" />
              <label for="mode_2">需運費</label>
            </div>
            
            
            <div class="alert alert-secondary fade show m-t-10 m-l-25">
            
            <div class="col-md-10 p-0">         
                            
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-light">
                    <div class="radio radio-css radio-inline">
                      <input name="modeselect" type="radio" id="modeselect_1" value="0" checked="checked" />
                      <label for="modeselect_1" >固定運費 </label>
                    </div>
                    </span>
                </div>
                
                
                <input name="countryprice" id="countryprice" maxlength="11" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                <div class="input-group-append"><span class="input-group-text">元</span></div>   
                
                
            </div>
            <div class="table-responsive">
            <div class="input-group m-b-10">
                <div class="input-group-prepend">
                    <span class="input-group-text label label-light">
                    <div class="radio radio-css radio-inline">
                      <input type="radio" name="modeselect" id="modeselect_2" value="1" />
              <label for="modeselect_2">台灣分區運費</label>
                    </div>
                    </span>
                </div>
                <div class="input-group-prepend">
                    <span class="input-group-text">北部</span>
                </div>
                <input name="northprice" id="northprice" maxlength="4" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                <div class="input-group-prepend">
                    <span class="input-group-text">中部</span>
                </div>
                <input name="centralprice" id="centralprice" maxlength="4" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                
                <div class="input-group-prepend">
                    <span class="input-group-text">南部</span>
                </div>
                <input name="southprice" id="southprice" maxlength="4" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                
                <div class="input-group-prepend">
                    <span class="input-group-text">東部</span>
                </div>
                <input name="eastprice" id="eastprice" maxlength="4" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                
                <div class="input-group-prepend">
                    <span class="input-group-text">外島</span>
                </div>
                <input name="outerprice" id="outerprice" maxlength="4" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                
                <div class="input-group-append">
                	<span class="input-group-text">元</span>
                </div>  
                
            </div>
            </div>
            <ul>
              <li> 北部：台北市 基隆市 新北市 桃園縣 桃園市 新竹市 新竹縣</li>
              <li> 中部：苗栗縣 台中市 南投縣 彰化縣</li>
              <li> 南部：雲林縣 嘉義市 嘉義縣 台南市 高雄市 屏東縣</li>
              <li> 東部：宜蘭縣 花蓮縣 台東縣 。外島：澎湖縣 金門縣 連江縣</li>
            </ul>
            </div>
 
              
            </div>
            
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
            
            <div class="radio radio-css ">
              <input type="radio" name="mode" id="mode_3" value="2" />
              <label for="mode_3">運費另外報價 <i class="fa fa-info-circle text-orange" data-original-title="由於買家購買時運費無法確定，因此不支援金流付款。" data-toggle="tooltip" data-placement="top"></i></label>
            </div>
            
            <small class="f-s-12 text-grey-darker m-l-25">訂購完成後由商家再填入運費，並自行通知消費者運費報價</small>
            
            <div class="radio radio-css ">
              <input type="radio" name="mode" id="mode_4" value="3" />
              <label for="mode_4">消費者自填運費 <i class="fa fa-info-circle text-orange" data-original-title="由於買家購買時運費可能輸入錯誤，因此不支援金流付款。" data-toggle="tooltip" data-placement="top"></i></label>
            </div>
            
            <small class="f-s-12 text-grey-darker m-l-25">開放讓消費者自填運費，請於下方貨運說明詳述運費計算方式</small>
            
            <?php } ?>
      </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">送貨地址填寫<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="例如：面交、到店取貨消費者可不填寫送貨地址。" data-toggle="tooltip" data-placement="top"></i></label>                       	
        <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input type="radio" name="addrindicate" id="addrindicate_1" value="0" />
              <label for="addrindicate_1">選填</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input name="addrindicate" type="radio" id="addrindicate_2" value="1" checked="checked" />
              <label for="addrindicate_2">必填 </label>
          </div>
            
      </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">貨運說明 <i class="fa fa-info-circle text-orange" data-original-title="提醒費者的話。 例如：購買到生鮮食品時請選擇此低溫宅配的貨運方式。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="45" rows="30"></textarea>  
          </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">貨到付款<span class="text-red">*</span></label>
          <div class="col-md-10">
          
            <div class="alert alert-secondary fade show m-t-10">
          
              <strong><i class="fa fa-exclamation-circle"></i> 是否有提供貨到付款?</strong>
                
                <div class="col-md-10 p-0 m-t-10">         
                                
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcome" type="radio" id="productcome_1" value="0" checked="checked" />
                              <label for="productcome_1" >無提供 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                       
                        
                        
                    </div>
                    
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcome" type="radio" id="productcome_2" value="1" />
                              <label for="productcome_2" >有提供，且消費者可選擇是否要貨到付款 ，限購物低於 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                        <input name="productcomeprice" id="productcomeprice" maxlength="11" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                        <div class="input-group-append"><span class="input-group-text">元以下方可選擇使用貨到付款(不填為不限制)</span></div>   
                        
                        
                    </div>
                    
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcome" type="radio" id="productcome_3" value="2" />
                              <label for="productcome_3" >有提供，且必定是貨到付款 (例如：快遞代收貨款、到店取貨) </label>
                            </div>
                            </span>
                        </div>
                        
                        
                    </div>
                
                </div>
 
              
            </div>
            
            <div class="alert alert-secondary fade show m-t-10">
          
              <strong><i class="fa fa-exclamation-circle"></i> 貨到付款時，是否要向消費者加收手續費?</strong>
                
                <div class="col-md-10 p-0 m-t-10">         
                                
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcomeselect" type="radio" id="productcomeselect_1" value="0" checked="checked" />
                              <label for="productcomeselect_1" >不需要 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                       
                        
                        
                    </div>
                    
                    <div class="input-group m-b-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcomeselect" type="radio" id="productcomeselect_2" value="1" />
                              <label for="productcomeselect_2" >固定加收 </label>
                            </div>
                            </span>
                        </div>
                        
                        
                        <input name="fixedprice" id="fixedprice" maxlength="11" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                        <div class="input-group-append"><span class="input-group-text">元</span></div>   
                        
                        
                    </div>
                    
                    
                    <div class="bg-white">
                    
                    <div class="input-group m-b-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text label label-light">
                            <div class="radio radio-css radio-inline">
                              <input name="productcomeselect" type="radio" id="productcomeselect_3" value="2" />
                              <label for="productcomeselect_3" >依代收金額(由小到大填寫) </label>
                            </div>
                            </span>
                        </div>
                    </div>
                    
                    
                    <div class="alert alert-light fade show m-t-0 m-l-25">
                    <?php for($j=1; $j<=6; $j++){ ?>
                        <div class="input-group m-b-0 m-t-10">
                            
                            <input name="dynamicprice<?php echo $j ?>" id="dynamicprice<?php echo $j ?>" maxlength="11" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                            
                            <div class="input-group-prepend">
                                <span class="input-group-text">元以內加收</span>
                            </div>
                            
                            
                            <input name="dynamicpricepay<?php echo $j ?>" id="dynamicpricepay<?php echo $j ?>" maxlength="11" class="form-control col-md-1" data-parsley-min="0" data-parsley-max="9999999" type="number" data-parsley-type="number" data-parsley-trigger="blur" step="1"/>
                            
                            
                            <select name="dynamicpriceunit<?php echo $j ?>" id="dynamicpriceunit<?php echo $j ?>">
                              <option value="0">元</option>
                              <option value="1">%</option>
                            </select>
                            
                        
                        </div>
                    <?php } ?>
                    </div>
                    
                    </div>
                    
                
                </div>
 
              
            </div>
          
          </div>
      </div>
      
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();" >送出</button>
            <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
            <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
          </div>
      </div>
      
      <input type="hidden" name="MM_insert" value="form_CartItemAdd" />
    </form>                  	
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
<!--
function CheckFields()
{	
	if($('input[name=mode]:checked').val() == '1'){
		if($('input[name=modeselect]:checked').val() == '0' && $("#countryprice").val() == '') {
			alert("需填寫全國固定運費價格！！");
			return false;
		}
		if($('input[name=modeselect]:checked').val() == '1' && ( $("#northprice").val() == '' || $("#centralprice").val() == '' || $("#southprice").val() == '' || $("#eastprice").val() == '' || $("#outerprice").val() == '') ) {
			alert("需填齊分區運費價格！！");
			return false;
		}
		
	}
	if($('input[name=productcomeselect]:checked').val() == '1' && $("#fixedprice").val() == ''){
			alert("需填寫固定加收價格！！");
			return false;
	}
	if($('input[name=productcomeselect]:checked').val() == '2'){
			if($("#dynamicprice1").val() == '' && $("#dynamicpricepay1").val() == '')
			{
				alert("至少需填寫一項且需由最上方欄位依次填寫！！");
				return false;
			}
			<?php for ($j=1; $j<=6; $j++) { ?>
				if(($("#dynamicprice<?php echo $j; ?>").val() != "" && $("#dynamicpricepay<?php echo $j; ?>").val() == "") || ($("#dynamicprice<?php echo $j; ?>").val() == "" && $("#dynamicpricepay<?php echo $j; ?>").val() != ""))
				{
					alert("資料需填寫完整！！");
					return false;
				}
			<?php } ?>		
			<?php for ($j=1; $j<=5; $j++) { ?>
			    if($("#dynamicprice<?php echo $j+1; ?>").val() != "" && $("#dynamicprice<?php echo $j; ?>").val() != "")
				{
					if($("#dynamicprice<?php echo $j+1; ?>").val()-$("#dynamicprice<?php echo $j; ?>").val() <=0)
					{
						alert("價格須由小到大填寫！！");
						return false;
					}
				}
            <?php } ?>
	}
}
//-->
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
mysqli_free_result($RecordCartListItem);
?>
