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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE invoicing_accounts_setting SET CashAccountID=%s, CurrentPLAccountID=%s, LastPLAccountID=%s WHERE id=%s",
                       GetSQLValueString($_POST['CashAccountID'], "text"),
					   GetSQLValueString($_POST['CurrentPLAccountID'], "text"),
					   GetSQLValueString($_POST['LastPLAccountID'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordAccounts_summonssetting = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonssetting = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonssetting = sprintf("SELECT * FROM invoicing_accounts_setting WHERE userid=%s LIMIT 1", GetSQLValueString($coluserid_RecordAccounts_summonssetting, "int"));
$RecordAccounts_summonssetting = mysqli_query($DB_Conn, $query_RecordAccounts_summonssetting) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonssetting = mysqli_fetch_assoc($RecordAccounts_summonssetting);
$totalRows_RecordAccounts_summonssetting = mysqli_num_rows($RecordAccounts_summonssetting);

if($totalRows_RecordAccounts_summonssetting == 0){
	$insertSQL = sprintf("INSERT INTO invoicing_accounts_setting (CashAccountID, CurrentPLAccountID, LastPLAccountID, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString('1111', "text"),
					   GetSQLValueString('3353', "text"),
					   GetSQLValueString('3351', "text"),
                       GetSQLValueString($w_userid, "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 現金與損益 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 資料修改</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>【現金項目】：系統預設1111庫存現金，此處是用來設定【會計傳票】傳票類別為收入和支出時，對方科目的預設，也有人常常支付或收款是活存，故有人把此項改為某一銀行的明細科目，但若您收入或支出時對方科目常不固定，則比較建議您直接用轉帳傳票輸入，就可以忽略這項設定了。</b></div>
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>【本期損益】：預設3353本期損益，是系統計算損益的科目，為避免帳不好查，故有限制傳票不能切立在這欄預設的科目，以防當您覺得計算有誤時，確裡面含有自行切的傳票，讓查帳變的不容易，故不允許切立此科目在傳票。</b></div>
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>【上期損益】：預設3351累積盈虧，這個科目是會在年底時，透過您執行的【會計年度結轉】作業，除了將虛帳戶會計項目結清為0下期不帶入及實帳戶會移轉下期外，也會將年底【3353本期損益】系統計算的結餘金額，移轉【資產負債表】的【3351累積盈虧】科目裡</b></div>
    
    <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">現金項目 <span class="text-red">*</span></label>
          <div class="col-md-10">
                  <select name="CashAccountID" id="CashAccountID" class="form-control select2" data-parsley-trigger="blur">
                  <!--<option value="" <?php if (!(strcmp(-1, $row_RecordAccounts_summonssetting['CashAccountID']))) {echo "selected=\"selected\"";} ?>>-- 選擇會計項目 --</option>-->
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordAccounts_summonsListType4['itemvalue'] ?>" <?php if (!(strcmp($row_RecordAccounts_summonsListType4['itemvalue'], $row_RecordAccounts_summonssetting['CashAccountID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAccounts_summonsListType4['itemvalue']?> <?php echo $row_RecordAccounts_summonsListType4['itemname']?></option>
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
      </div>
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">本期損益 <span class="text-red">*</span></label>
          <div class="col-md-10">
                <select name="CurrentPLAccountID" id="CurrentPLAccountID" class="form-control select2" data-parsley-trigger="blur">
                  <!--<option value="" <?php if (!(strcmp(-1, $row_RecordAccounts_summonssetting['CurrentPLAccountID']))) {echo "selected=\"selected\"";} ?>>-- 選擇會計項目 --</option>-->
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordAccounts_summonsListType4['itemvalue'] ?>" <?php if (!(strcmp($row_RecordAccounts_summonsListType4['itemvalue'], $row_RecordAccounts_summonssetting['CurrentPLAccountID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAccounts_summonsListType4['itemvalue']?> <?php echo $row_RecordAccounts_summonsListType4['itemname']?></option>
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
      </div>
      
      <div class="form-group row" id="Step_Reg">
          <label class="col-md-2 col-form-label">上期損益 <span class="text-red">*</span></label>
          <div class="col-md-10">
                <select name="LastPLAccountID" id="LastPLAccountID" class="form-control select2" data-parsley-trigger="blur">
                  <!--<option value="" <?php if (!(strcmp(-1, $row_RecordAccounts_summonssetting['LastPLAccountID']))) {echo "selected=\"selected\"";} ?>>-- 選擇會計項目 --</option>-->
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordAccounts_summonsListType4['itemvalue'] ?>" <?php if (!(strcmp($row_RecordAccounts_summonsListType4['itemvalue'], $row_RecordAccounts_summonssetting['LastPLAccountID']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordAccounts_summonsListType4['itemvalue']?> <?php echo $row_RecordAccounts_summonsListType4['itemname']?></option>
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
      </div>
 
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" id="Step_Send">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordAccounts_summonssetting['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
        </div>
      </div>
      
      
  <input type="hidden" name="MM_update" value="form1" />
  </form>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

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
mysqli_free_result($RecordAccounts_summonssetting);
?>

