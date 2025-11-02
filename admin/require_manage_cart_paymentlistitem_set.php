<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   $updateSQL = sprintf("UPDATE demo_setting_otr SET allpaypaymentnumber=%s, allpaypaymentHashKey=%s, allpaypaymentHashIV=%s WHERE id=%s",
                       GetSQLValueString($_POST['allpaypaymentnumber'], "text"),
                       GetSQLValueString($_POST['allpaypaymentHashKey'], "text"),
                       GetSQLValueString($_POST['allpaypaymentHashIV'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
   $updateSQL = sprintf("UPDATE demo_setting_otr SET pchomepaypaymentAppid=%s, pchomepaypaymentSecret=%s, pchomepaypaymentlinkmod=%s WHERE id=%s",
					   GetSQLValueString($_POST['pchomepaypaymentAppid'], "text"),
					   GetSQLValueString($_POST['pchomepaypaymentSecret'], "text"),
					   GetSQLValueString($_POST['pchomepaypaymentlinkmod'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result2 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
   $updateSQL = sprintf("UPDATE demo_setting_otr SET paypalpaymentApiname=%s, paypalpaymentApipsw=%s, paypalpaymentSignature=%s, paypalpaymentlinkmod=%s WHERE id=%s",
					   GetSQLValueString($_POST['paypalpaymentApiname'], "text"),
					   GetSQLValueString($_POST['paypalpaymentApipsw'], "text"),
					   GetSQLValueString($_POST['paypalpaymentSignature'], "text"),
					   GetSQLValueString($_POST['paypalpaymentlinkmod'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result3 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form4")) {
    $updateSQL = sprintf("UPDATE demo_setting_otr SET OFFER_ID=%s, Advertiser_ID=%s WHERE id=%s",
        GetSQLValueString($_POST['OFFER_ID'], "text"),
        GetSQLValueString($_POST['Advertiser_ID'], "text"),
        GetSQLValueString($_POST['id'], "int"));

    //mysqli_select_db($database_DB_Conn, $DB_Conn);
    $Result4 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

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


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 金流串接 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 參數設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post"> 


      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/allpaylogo.jpg" width="150" height="90" /></label>                       	
          <div class="col-md-10">
          
            <div class="alert alert-warning" id="Step_Login"><strong><i class="fa fa-exclamation-circle"></i>  登入到綠界點選 [基本資料查詢]可查到這三個參數 <a href="https://vendor.ecpay.com.tw" target="_blank">vendor.allpay.com.tw</a>。</strong></div>
            
            <div class="input-group p-0">
                        
                  <div class="input-group-prepend"><span class="input-group-text">商店代號</span></div>
                      <input name="allpaypaymentnumber" type="text" required="" class="form-control" id="allpaypaymentnumber" value="<?php echo $row_RecordDefaultPayment['allpaypaymentnumber']; ?>" data-parsley-trigger="blur" />              
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">物流介接 HashKey</span></div>
                      <input name="allpaypaymentHashKey" type="text" required="" class="form-control" id="allpaypaymentHashKey" value="<?php echo $row_RecordDefaultPayment['allpaypaymentHashKey']; ?>" data-parsley-trigger="blur" />              
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">物流介接 HashIV</span></div>
                      <input name="allpaypaymentHashIV" type="text" required="" class="form-control" id="allpaypaymentHashIV" value="<?php echo $row_RecordDefaultPayment['allpaypaymentHashIV']; ?>" data-parsley-trigger="blur" />              
            </div>
                
             
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDefaultPayment['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
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
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 參數設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post"> 


      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/pp-logo.jpg" alt="" class="img-fluid" /></label>                       	
          <div class="col-md-10">
          
            
                             	
          
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordDefaultPayment['pchomepaypaymentlinkmod'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="pchomepaypaymentlinkmod" id="pchomepaypaymentlinkmod_1" value="0" />
              <label for="pchomepaypaymentlinkmod_1">測試環境</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordDefaultPayment['pchomepaypaymentlinkmod'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="pchomepaypaymentlinkmod" id="pchomepaypaymentlinkmod_2" value="1" />
              <label for="pchomepaypaymentlinkmod_2">正式環境</label>
            </div>
             
          
    
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">APP ID</span></div>
                      <input name="pchomepaypaymentAppid" type="text" required="" class="form-control" id="pchomepaypaymentAppid" value="<?php echo $row_RecordDefaultPayment['pchomepaypaymentAppid']; ?>" data-parsley-trigger="blur" />              
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">SECRET</span></div>
                      <input name="pchomepaypaymentSecret" type="text" required="" class="form-control" id="pchomepaypaymentSecret" value="<?php echo $row_RecordDefaultPayment['pchomepaypaymentSecret']; ?>" data-parsley-trigger="blur" />              
            </div>
                
             
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDefaultPayment['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form2" />
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
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 參數設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post"> 


      <div class="form-group row">
          <label class="col-md-2 col-form-label"><img src="images/PayPal.png" alt="" height="60" /></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordDefaultPayment['paypalpaymentlinkmod'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="paypalpaymentlinkmod" id="paypalpaymentlinkmod_1" value="0" />
              <label for="paypalpaymentlinkmod_1">測試環境</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordDefaultPayment['paypalpaymentlinkmod'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="paypalpaymentlinkmod" id="paypalpaymentlinkmod_2" value="1" />
              <label for="paypalpaymentlinkmod_2">正式環境</label>
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">API 用戶名稱</span></div>
                      <input name="paypalpaymentApiname" type="text" required="" class="form-control" id="paypalpaymentApiname" value="<?php echo $row_RecordDefaultPayment['paypalpaymentApiname']; ?>" data-parsley-trigger="blur" />              
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">API 密碼</span></div>
                      <input name="paypalpaymentApipsw" type="text" required="" class="form-control" id="paypalpaymentApipsw" value="<?php echo $row_RecordDefaultPayment['paypalpaymentApipsw']; ?>" data-parsley-trigger="blur" />              
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">電子簽章</span></div>
                      <input name="paypalpaymentSignature" type="text" required="" class="form-control" id="paypalpaymentSignature" value="<?php echo $row_RecordDefaultPayment['paypalpaymentSignature']; ?>" data-parsley-trigger="blur" />              
            </div>
                
             
        </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDefaultPayment['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form3" />
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
            <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
            <h4 class="panel-title"><i class="fa fa-edit"></i> 參數設定</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body p-0">
            <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">


                <div class="form-group row">
                    <label class="col-md-2 col-form-label"><img src="https://img.shop.com/Image/resources/logos/shop-logo-tw.svg" width="100%" /></label>
                    <div class="col-md-10">

                        <div class="input-group p-0 m-t-10">

                            <div class="input-group-prepend"><span class="input-group-text">OFFER_ID</span></div>
                            <input name="OFFER_ID" type="text" required="" class="form-control" id="OFFER_ID" value="<?php echo $row_RecordDefaultPayment['OFFER_ID']; ?>" data-parsley-trigger="blur" />
                        </div>

                        <div class="input-group p-0 m-t-10">

                            <div class="input-group-prepend"><span class="input-group-text">Advertiser_ID</span></div>
                            <input name="Advertiser_ID" type="text" required="" class="form-control" id="Advertiser_ID" value="<?php echo $row_RecordDefaultPayment['Advertiser_ID']; ?>" data-parsley-trigger="blur" />
                        </div>


                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label"></label>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn btn-primary btn-block">送出</button>
                        <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDefaultPayment['id']; ?>" />
                        <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
                    </div>
                </div>
                <input type="hidden" name="MM_update" value="form4" />
            </form>
        </div>
        <!-- end panel-body -->
    </div>
    <!-- end panel -->
<?php } ?>

<script type="text/javascript">
function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_NowSelect',
                intro: '欲開通綠界金流需要設定商店代號、ALL IN ONE 介接 HashKey、ALL IN ONE 介接 HashIV 及 設定允許連結的主機ip位址。'
              },
			  {
                element: '#Step_Login',
                intro: '登入綠界後台查看參數。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="https://vendor.ecpay.com.tw" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往綠界廠商後台</a></span></div>'
              },
              {
                element: '#Step_Tip',
                intro: '<img src="images/tip/tip125.jpg" width="800" height="532" /><br /><br />查看參數及設定外聯主機ip。'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });
          
          intro.start();
}
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
mysqli_free_result($RecordDefaultPayment);
?>
