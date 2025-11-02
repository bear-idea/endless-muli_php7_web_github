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
   $updateSQL = sprintf("UPDATE demo_setting_otr SET allpaypaymentnumber=%s, allpayfreightHashKey=%s, allpayfreightHashIV=%s WHERE id=%s",
                       GetSQLValueString($_POST['allpaypaymentnumber'], "text"),
                       GetSQLValueString($_POST['allpayfreightHashKey'], "text"),
                       GetSQLValueString($_POST['allpayfreightHashIV'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
   $updateSQL = sprintf("UPDATE demo_setting_otr SET allshopsender=%s, allshopsendercell=%s, allshopuseC2C=%s WHERE id=%s",
					   GetSQLValueString($_POST['allshopsender'], "text"),
					   GetSQLValueString($_POST['allshopsendercell'], "text"),
					   GetSQLValueString($_POST['allshopuseC2C'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result2 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 物流串接 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
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
                      <input name="allpayfreightHashKey" type="text" required="" class="form-control" id="allpayfreightHashKey" value="<?php echo $row_RecordDefaultPayment['allpayfreightHashKey']; ?>" data-parsley-trigger="blur" />              
            </div>
            
            <div class="input-group p-0 m-t-10">
                        
                  <div class="input-group-prepend"><span class="input-group-text">物流介接 HashIV</span></div>
                      <input name="allpayfreightHashIV" type="text" required="" class="form-control" id="allpayfreightHashIV" value="<?php echo $row_RecordDefaultPayment['allpayfreightHashIV']; ?>" data-parsley-trigger="blur" />              
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
<?php } ?>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 基本設定</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post"> 


      <div class="form-group row">
          <label class="col-md-2 col-form-label">超商取貨配送方式<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="請選擇您在綠界申請的物流配送方式 - 若欲更改配送方式請置綠界物流更改。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordDefaultPayment['allshopuseC2C'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="allshopuseC2C" id="allshopuseC2C_1" value="1" />
              <label for="allshopuseC2C_1">超商取貨-門市寄/取件 (C2C)</label>
            </div>
            <div class="radio radio-css radio-inline">
              <input <?php if (!(strcmp($row_RecordDefaultPayment['allshopuseC2C'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="allshopuseC2C" id="allshopuseC2C_2" value="0" />
              <label for="allshopuseC2C_2">超商取貨-大宗寄倉 (B2C) </label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">寄件人姓名<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="寄件人為寄送商品的人員，務必填寫正確，當店家到超商領回退貨時，必須出示寄件人的個人證件給店員看方能領貨。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="allshopsender" type="text" class="form-control" id="allshopsender" value="<?php echo $row_RecordDefaultPayment['allshopsender']; ?>" data-parsley-pattern="/^[\u4e00-\u9fa5]{1,5}$|^[\A-Za-z]{1,10}$/" data-parsley-pattern-message="限制5個中文字/10個英文字" maxlength="10" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">寄件人手機號碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="allshopsendercell" type="text" class="form-control" id="allshopsendercell" value="<?php echo $row_RecordDefaultPayment['allshopsendercell']; ?>" maxlength="20" data-parsley-pattern="/^[1][3-8]\d{9}$|^([6|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/" data-parsley-pattern-message="請輸入正確的手機號碼" data-parsley-trigger="blur" required="" />
                      
                 
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
