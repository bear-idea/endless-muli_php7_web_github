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
  $updateSQL = sprintf("UPDATE invoicing_accounts_setting SET CurrentYear=%s, closeYM=%s WHERE id=%s",
                       GetSQLValueString($_POST['CurrentYear'], "text"),
					   GetSQLValueString($_POST['closeYM'], "text"),
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

$coluserid_RecordAccounts_summonssetting = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonssetting = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonssetting = sprintf("SELECT * FROM invoicing_accounts_setting WHERE userid=%s LIMIT 1", GetSQLValueString($coluserid_RecordAccounts_summonssetting, "int"));
$RecordAccounts_summonssetting = mysqli_query($DB_Conn, $query_RecordAccounts_summonssetting) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonssetting = mysqli_fetch_assoc($RecordAccounts_summonssetting);
$totalRows_RecordAccounts_summonssetting = mysqli_num_rows($RecordAccounts_summonssetting);

if($row_RecordAccounts_summonssetting['CurrentYear'] == ''){

    $query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE userid=%s ORDER BY postdate ASC LIMIT 1", GetSQLValueString($w_userid, "int"));
    $RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
    $row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
    $totalRows_RecordAccounts_summonsorder = mysqli_num_rows($RecordAccounts_summonsorder);

    //echo $row_RecordAccounts_summonsorder['postdate']; 

    $dt = new DateTime($row_RecordAccounts_summonsorder['postdate']);
    $interval = new DateInterval('P1Y');
    $dt->sub($interval);
    $CurrentYear = $dt->format('Y');

    if($totalRows_RecordAccounts_summonsorder > 0){
        $updateSQL = sprintf("UPDATE invoicing_accounts_setting SET CurrentYear=%s WHERE id=%s",
                       GetSQLValueString($CurrentYear, "text"),
                       GetSQLValueString($row_RecordAccounts_summonsorder['id'], "int"));

        $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
    }

}

if($row_RecordAccounts_summonssetting['closeYM'] == ''){

    $query_RecordAccounts_summonsorder = sprintf("SELECT * FROM invoicing_accounts_summonsorder WHERE userid=%s ORDER BY postdate ASC LIMIT 1", GetSQLValueString($w_userid, "int"));
    $RecordAccounts_summonsorder = mysqli_query($DB_Conn, $query_RecordAccounts_summonsorder) or die(mysqli_error($DB_Conn));
    $row_RecordAccounts_summonsorder = mysqli_fetch_assoc($RecordAccounts_summonsorder);
    $totalRows_RecordAccounts_summonsorder = mysqli_num_rows($RecordAccounts_summonsorder);

    $dt = new DateTime($row_RecordAccounts_summonsorder['postdate']);
    $interval = new DateInterval('P1M');
    $dt->sub($interval);
    $closeYM = $dt->format('Y-m') ;

    if($totalRows_RecordAccounts_summonsorder > 0){
        $updateSQL = sprintf("UPDATE invoicing_accounts_setting SET closeYM=%s WHERE id=%s",
                       GetSQLValueString($closeYM, "text"),
                       GetSQLValueString($row_RecordAccounts_summonsorder['id'], "int"));

        $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
    }

}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 月底關帳 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
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
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>關帳後，即不可再異動關帳年月(含)以前的會計相關資料。</b></div>

    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>會計現行年度預設為空白，當建立傳票後，會依第一張傳票建立的日期帶入</b></div>

    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>若執行年度結轉，則會將會計現行年度替換執行結轉年度的隔年。</b></div>

    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>關帳日期預設為空白，當建立傳票後，會依第一張傳票建立的日期帶入，例如建立2020/01/02，則【目前關帳年月】會自動預設為2019/12。</b></div>

    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>關帳年度不可大於現年行度。</b></div>

    <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
    <div class="form-group row">
        <label class="col-md-2 col-form-label">會計現行年度<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                  <input type="text" class="form-control"  name="CurrentYear" id="CurrentYear" value="<?php $dt = new DateTime($row_RecordAccounts_summonssetting['CurrentYear']); echo $dt->format('Y'); ?>" data-parsley-trigger="blur" data-date-language="zh-TW" data-provide="datepicker" data-date-format="yyyy" autocomplete="off"/>
                 
              </div>
          </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label">關帳日期<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                <input type="text" class="form-control"  name="closeYM" id="closeYM" value="<?php $dt = new DateTime($row_RecordAccounts_summonssetting['closeYM']); echo $dt->format('Y-m'); ?>" data-parsley-trigger="blur" data-date-language="zh-TW" data-provide="datepicker" data-date-format="yyyy-mm" autocomplete="off"/> 
                 
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

<script type="text/javascript">
	$(document).ready(function() {
		$('#closeYM').datepicker({
			format: "yyyy-mm",
			viewMode: "month", 
			minViewMode: "months"
		}).on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 

        $('#CurrentYear').datepicker({
			format: "yyyy",
			viewMode: "year", 
			minViewMode: "years"
		}).on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
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
mysqli_free_result($RecordAccounts_summonssetting);
?>

