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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET shoppingnotescontext=%s WHERE id=%s",
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSystemSetting = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemSetting = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemSetting = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemSetting, "int"));
$RecordSystemSetting = mysqli_query($DB_Conn, $query_RecordSystemSetting) or die(mysqli_error($DB_Conn));
$row_RecordSystemSetting = mysqli_fetch_assoc($RecordSystemSetting);
$totalRows_RecordSystemSetting = mysqli_num_rows($RecordSystemSetting);
?>
<!-- fck編輯器 -->

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : 'Full'} );
};
</script>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 購物須知 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
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
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSystemSetting['shoppingnotescontext']; ?></textarea>  
          </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">範例</label>
          <div class="col-md-10">
                <input type="image" src="images/tmp_smp_00.jpg" id="change_tmp00" onclick="return false" style="margin-right:5px;">
                <div style="color:#CC6600;">點選您想要的範例即可將【內容欄位】全部替換。</div> 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemSetting['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
	$(document).ready(function() {
		<?php 
		$Content_Show_Title1 = "購物須知";
		
		$Content_Show_Desc1 = "<strong>一、初次購買</strong><div>需加入會員，填寫資料成功加入後即可購買商品。</div><br /><strong>二、運費計算</strong><br /><div>單筆消費滿1000元免運，未滿1000元運費100元。<br /> 離島及海外地區另計，請來信詢問 </div><br /><strong>三、出貨時間</strong><br /><div>星期一~五，上午10:00前訂單當日出貨。<br /> 週六、日及國定假日不出貨，若有特殊需求請於下訂前來電詢問。<br /> 謝謝！</div><br /><strong>四、付款與配送方式</strong><br /><ul> <li>信用卡<br /> </li> <li>貨到付款<br /> </li> <li>網絡ATM<br /> </li> <li>超商代碼繳費</li></ul><br /><strong>五、退換貨說明</strong><br /><div>1. 如果發生商品錯誤寄送，或是寄送過程中產生瑕疵，我們將提供您退換貨的服務。</div><div>2. 本公司商品經嚴格品質管控出廠，開封後若發現產品品質不良或有異常狀況者，請將您的姓名/聯絡電話/訂單號碼/退換貨原因(瑕疵品請附照片檔)等， 先E-mail方式通知或撥消費者服務專線：00-000-0000。 本公司將立即派員為您處理與換上新品。</div><div>3. <em>退換貨處理</em>：</div><div>(1) 需要退換之貨品請盡量保持原始包裝，若包裝已經嚴重破損或產品發生崩裂情況，本公司保留接受退換貨與否之權利。可歸責於本公司或物流貨運公司之產品毀損不在此限，請您於收到貨品時先行檢查再簽收。其餘原因之退換貨，均須酌收運送商品的手續費及運費。</div><div>(2) 根據消保法規定， 中華筆莊消費者均享有商品到貨七天猶豫期之權益；但特別標定說明、特殊包裝商品、軟體類或影音光碟類產品不得拆封，否則恕不接受退貨。中華筆莊受理消費者的退換貨，從商品收訖起7天內為退換貨保證期，若超過此期間視同驗收完成不得退換貨。並請消費者注意以下事項：<br /> <strong>**無法比照七天商品鑑賞期退換貨處理準則的特別種類商品計有：</strong></div><div> &gt;</div><div> &gt;</div><div> &gt;</div><div> &gt;</div><br /><div>4. 特價商品(僅提供瑕疵換貨)</div><div>5. 附註條款： </div>";
		
		?>
			$("#change_tmp00").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><?php echo $Content_Show_Desc1; ?><br /><br /></div>");
			});
	});
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
mysqli_free_result($RecordSystemSetting);
?>
