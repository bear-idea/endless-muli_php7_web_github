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
  $insertSQL = sprintf("INSERT INTO demo_cartitem (list_id, itemname, content, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
                       GetSQLValueString($_POST['content'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_CartDefaultItemEdit")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET userid=%s, linguipaymentenable=%s, linguipaymentdesc=%s, atmpaymentenable=%s, atmpaymentdesc=%s, postofficepaymentenable=%s, postofficepaymentdesc=%s, otherpaymentenable=%s, otherpaymentdesc=%s, allpaypaymentenable=%s, allpaypaymentdesc=%s, allpaypaymentenable_Credit=%s, allpaypaymentdesc_Credit=%s, allpaypaymentenable_BARCODE=%s, allpaypaymentdesc_BARCODE=%s, allpaypaymentenable_CVS=%s, allpaypaymentdesc_CVS=%s, productcomedesc=%s, pchomepaypaymentenable=%s, pchomepaypaymentdesc=%s, paypalpaymentenable=%s, paypalpaymentdesc=%s WHERE id=%s",
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString(isset($_POST['linguipaymentenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['linguipaymentdesc'], "text"),
                       GetSQLValueString(isset($_POST['atmpaymentenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['atmpaymentdesc'], "text"),
                       GetSQLValueString(isset($_POST['postofficepaymentenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['postofficepaymentdesc'], "text"),
                       GetSQLValueString(isset($_POST['otherpaymentenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['otherpaymentdesc'], "text"),
                       GetSQLValueString(isset($_POST['allpaypaymentenable']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['allpaypaymentdesc'], "text"),
					   GetSQLValueString(isset($_POST['allpaypaymentenable_Credit']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['allpaypaymentdesc_Credit'], "text"),
					   GetSQLValueString(isset($_POST['allpaypaymentenable_BARCODE']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['allpaypaymentdesc_BARCODE'], "text"),
					   GetSQLValueString(isset($_POST['allpaypaymentenable_CVS']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['allpaypaymentdesc_CVS'], "text"),
                       GetSQLValueString($_POST['productcomedesc'], "text"),
					   GetSQLValueString(isset($_POST['pchomepaypaymentenable']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString($_POST['pchomepaypaymentdesc'], "text"),
					   GetSQLValueString(isset($_POST['paypalpaymentenable']) ? "true" : "", "defined","1","0"),
					   GetSQLValueString($_POST['paypalpaymentdesc'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_CartItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_cartitem SET list_id=%s, itemname=%s, indicate=%s, lang=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
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
$query_RecordCartListItem = sprintf("SELECT demo_cartitem.item_id, demo_cartitem.userid, demo_cartlist.list_id, demo_cartlist.listname, demo_cartitem.itemname, demo_cartitem.indicate, demo_cartitem.lang FROM demo_cartlist LEFT OUTER JOIN demo_cartitem ON demo_cartlist.list_id = demo_cartitem.list_id WHERE demo_cartlist.list_id = %s && demo_cartitem.lang=%s && demo_cartitem.userid=%s", GetSQLValueString($collistid_RecordCartListItem, "int"),GetSQLValueString($collang_RecordCartListItem, "text"),GetSQLValueString($coluserid_RecordCartListItem, "int"));
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
	CKEDITOR.replace( 'productcomedesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'linguipaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'atmpaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'postofficepaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'otherpaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'allpaypaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'pchomepaypaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'paypalpaymentdesc',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'allpaypaymentdesc_Credit',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'allpaypaymentdesc_BARCODE',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'allpaypaymentdesc_CVS',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
	CKEDITOR.replace( 'content',{width : '99.8%', height : '100px', toolbar : 'Basic'} );
};
</script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 付款方式 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 預設付款方式</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
    
    <form id="form_CartDefaultItemEdit" name="form_CartDefaultItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    
      
        <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>貨到付款需由【貨運及貨到付款】設定，不需由此頁設定。 <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=transititempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=1" target="_blank" class="btn btn-primary btn-xs" data-original-title="" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 前往觀看</a></b></div>
         
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
              <div class="checkbox checkbox-css inline">
              <input type="checkbox" id="autocheck" checked="checked" disabled="disabled"/>
              <label for="autocheck"><span class="text-red-darker">自動判斷</span> 貨到付款</label>
              </div>
        </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>填寫範例：<br />
貨品送達時，才將貨款付給物流公司，由物流公司代收貨款。</b></div>
            
            
              <div class="table-responsive">
                    <textarea name="productcomedesc" id="productcomedesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['productcomedesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <input <?php if (!(strcmp($row_RecordDefaultPayment['linguipaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="linguipaymentenable" id="linguipaymentenable" />
          <label for="linguipaymentenable">啟用 金融匯款</label>
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>填寫範例：<br />
購物完畢請匯款到 <br />
xx 銀行 xx分行 <br />
帳號：xxx-xx-xxxxxx-x <br />
戶名：xxx<br />
匯款好後，請來電確認。</b></div>
          
            
              <div class="table-responsive">
                    <textarea name="linguipaymentdesc" id="linguipaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['linguipaymentdesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <input <?php if (!(strcmp($row_RecordDefaultPayment['atmpaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="atmpaymentenable" id="atmpaymentenable" />
          <label for="atmpaymentenable">啟用 ATM轉帳</label>
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>填寫範例：<br />
購物完畢請於提款機輸入<br />
銀行代號：xxx<br />
轉帳帳號：xxxxxxxxxx <br />
匯款好後，請來電確認</b></div>
          
            
              <div class="table-responsive">
                    <textarea name="atmpaymentdesc" id="atmpaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['atmpaymentdesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <input <?php if (!(strcmp($row_RecordDefaultPayment['postofficepaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="postofficepaymentenable" id="postofficepaymentenable" />
          <label for="postofficepaymentenable">啟用 郵政劃撥</label>
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            
            <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>填寫範例：<br />
購物完畢請匯款到郵政劃撥帳號：xxxxxxxx<br />
戶名：xxx</b></div>
          
            
              <div class="table-responsive">
                    <textarea name="postofficepaymentdesc" id="postofficepaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['postofficepaymentdesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              <div class="checkbox checkbox-css">
                  <input <?php if (!(strcmp($row_RecordDefaultPayment['otherpaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="otherpaymentenable" id="otherpaymentenable" />
          <label for="otherpaymentenable">啟用 其他付款方式</label>
              </div>
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
            
            
            
              <div class="table-responsive">
                    <textarea name="otherpaymentdesc" id="otherpaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['otherpaymentdesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <div class="checkbox checkbox-css ">
        <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable" id="allpaypaymentenable"/>
          <label for="allpaypaymentenable">啟用 綠界(付款全開啟)</label>
          </div>
          <?php } else { ?>
          <div class="checkbox checkbox-css disabled"> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable" id="allpaypaymentenable" disabled="disabled"/>
          <label for="allpaypaymentenable">啟用 綠界(付款全開啟)</label>
          </div>
          <?php }  ?>
          
          <img src="images/allpaylogo.jpg" width="150" height="90" />
              
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
        <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <?php } else { ?>
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
        <?php } ?>
        
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>啟用此選項，消費者<span style="color:#090">送出訂單至綠界結帳</span>畫面會顯示多種金流付款方式。(包含信用卡付款、ATM、超商代碼、超商條碼、網路ATM)</b></div>
            
          
            
              <div class="table-responsive">
                    <textarea name="allpaypaymentdesc" id="allpaypaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['allpaypaymentdesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <div class="checkbox checkbox-css ">
        <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable_Credit'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable_Credit" id="allpaypaymentenable_Credit"/>
          <label for="allpaypaymentenable_Credit">啟用 綠界(信用卡一次付清)</label>
          </div>
          <?php } else { ?>
          <div class="checkbox checkbox-css disabled"> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable_Credit'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable_Credit" id="allpaypaymentenable_Credit" disabled="disabled"/>
          <label for="allpaypaymentenable_Credit">啟用 綠界(信用卡一次付清)</label>
          </div>
          <?php }  ?>
          
          <img src="images/allpaylogo.jpg" width="150" height="90" />
              
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
        <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <?php } else { ?>
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
        <?php } ?>
        
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>啟用此選項，消費者在<span style="color:#090">填寫訂單</span>時可直接選擇此項目</b></div>
            
          
            
              <div class="table-responsive">
                    <textarea name="allpaypaymentdesc_Credit" id="allpaypaymentdesc_Credit" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['allpaypaymentdesc_Credit']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <div class="checkbox checkbox-css ">
        <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable_BARCODE'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable_BARCODE" id="allpaypaymentenable_BARCODE"/>
          <label for="allpaypaymentenable_BARCODE">啟用 綠界(超商條碼)</label>
          </div>
          <?php } else { ?>
          <div class="checkbox checkbox-css disabled"> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable_BARCODE'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable_BARCODE" id="allpaypaymentenable_BARCODE" disabled="disabled"/>
          <label for="allpaypaymentenable_BARCODE">啟用 綠界(超商條碼)</label>
          </div>
          <?php }  ?>
          
          <img src="images/allpaylogo.jpg" width="150" height="90" />
              
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
        <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <?php } else { ?>
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
        <?php } ?>
        
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>啟用此選項，消費者在<span style="color:#090">填寫訂單</span>時可直接選擇此項目</b></div>
            
          
            
              <div class="table-responsive">
                <textarea name="allpaypaymentdesc_BARCODE" id="allpaypaymentdesc_BARCODE" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['allpaypaymentdesc_BARCODE']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              
                  <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <div class="checkbox checkbox-css ">
        <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable_CVS'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable_CVS" id="allpaypaymentenable_CVS"/>
          <label for="allpaypaymentenable_CVS">啟用 綠界(超商代碼)</label>
          </div>
          <?php } else { ?>
          <div class="checkbox checkbox-css disabled"> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['allpaypaymentenable_CVS'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="allpaypaymentenable_CVS" id="allpaypaymentenable_CVS" disabled="disabled"/>
          <label for="allpaypaymentenable_CVS">啟用 綠界(超商代碼)</label>
          </div>
          <?php }  ?>
          
          <img src="images/allpaylogo.jpg" width="150" height="90" />
              
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
        <?php if ($row_RecordDefaultPayment['allpaypaymentnumber'] != "" && $row_RecordDefaultPayment['allpaypaymentHashKey'] != "" && $row_RecordDefaultPayment['allpaypaymentHashIV'] != "") { ?>
        <?php } else { ?>
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
        <?php } ?>
        
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>啟用此選項，消費者在<span style="color:#090">填寫訂單</span>時可直接選擇此項目</b></div>
            
          
            
              <div class="table-responsive">
                <textarea name="allpaypaymentdesc_CVS" id="allpaypaymentdesc_CVS" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['allpaypaymentdesc_CVS']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              
                  <?php if ($row_RecordDefaultPayment['pchomepaypaymentAppid'] != "" && $row_RecordDefaultPayment['pchomepaypaymentSecret'] != "") { ?>
        <div class="checkbox checkbox-css ">
        <input <?php if (!(strcmp($row_RecordDefaultPayment['pchomepaypaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="pchomepaypaymentenable" id="pchomepaypaymentenable"/>
          <label for="pchomepaypaymentenable">啟用 PchomePay(信用卡一次付清)</label>
          </div>
          <?php } else { ?>
          <div class="checkbox checkbox-css disabled"> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['pchomepaypaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="pchomepaypaymentenable" id="pchomepaypaymentenable" disabled="disabled"/>
          <label for="pchomepaypaymentenable">啟用PchomePay(信用卡一次付清)</label>
          </div>
          <?php }  ?>
          
          <img src="images/pp-logo.jpg" alt="" class="img-fluid"/>
              
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
        <?php if ($row_RecordDefaultPayment['pchomepaypaymentAppid'] != "" && $row_RecordDefaultPayment['pchomepaypaymentSecret'] != "") { ?>
        <?php } else { ?>
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
        <?php } ?>
        
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>啟用此選項，消費者在<span style="color:#090">填寫訂單</span>時可直接選擇此項目</b></div>
            
          
            
              <div class="table-responsive">
                <textarea name="pchomepaypaymentdesc" id="pchomepaypaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['pchomepaypaymentdesc']; ?></textarea>  
              </div>

                      
        </div>
        
      </div>
      
      <div class="form-group row">
        <div class="col-md-2 col-sm-12 col-xs-12">
          
              
                  <?php if ($row_RecordDefaultPayment['paypalpaymentApiname'] != "" && $row_RecordDefaultPayment['paypalpaymentApipsw'] != "" && $row_RecordDefaultPayment['paypalpaymentSignature'] != "") { ?>
        <div class="checkbox checkbox-css ">
        <input <?php if (!(strcmp($row_RecordDefaultPayment['paypalpaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="paypalpaymentenable" id="paypalpaymentenable"/>
          <label for="paypalpaymentenable">啟用 PayPal(信用卡一次付清)</label>
          </div>
          <?php } else { ?>
          <div class="checkbox checkbox-css disabled"> 
          <input <?php if (!(strcmp($row_RecordDefaultPayment['paypalpaymentenable'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" name="paypalpaymentenable" id="paypalpaymentenable" disabled="disabled"/>
          <label for="paypalpaymentenable">啟用 PayPal(信用卡一次付清)</label>
          </div>
          <?php }  ?>
          
          <img src="images/PayPal.png" alt="" height="60" />
              
          </div>
          
        <div class="col-md-10 col-sm-12 col-xs-12">
          
        <?php if ($row_RecordDefaultPayment['paypalpaymentApiname'] != "" && $row_RecordDefaultPayment['paypalpaymentApipsw'] != "" && $row_RecordDefaultPayment['paypalpaymentSignature'] != "") { ?>
        <?php } else { ?>
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>無法設定啟用狀態，請先設定參數。</b></div>
        <?php } ?>
        
        <div class="alert alert-warning m-t-5 m-b-5"><i class="fa fa-info-circle"></i> <b>啟用此選項，消費者在<span style="color:#090">填寫訂單</span>時可直接選擇此項目</b></div>
            
          
            
              <div class="table-responsive">
                <textarea name="paypalpaymentdesc" id="paypalpaymentdesc" cols="45" rows="30"><?php echo $row_RecordDefaultPayment['paypalpaymentdesc']; ?></textarea>  
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
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 自訂付款方式</h4>
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
                      <a class="btn btn-info btn-block colorbox_iframe" href="cart_payment_config.php?item_id=<?php echo $row_RecordCartListItem['item_id']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top">詳細設定 <i class="fa fa-chevron-circle-right"></i></a>           
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
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增付款方式</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
      <form id="form_CartItemAdd" name="form_CartItemAdd" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      <input name="itemname" type="text" id="itemname" class="form-control" data-parsley-trigger="blur" required=""/>
                      
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">付款說明 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"></textarea>  
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

mysqli_free_result($RecordDefaultPayment);
?>
