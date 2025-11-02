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

$colname_RecordAccounts_beginningamount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_beginningamount = $_GET['lang'];
}
$coluserid_RecordAccounts_beginningamount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_beginningamount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_beginningamount = sprintf("SELECT * FROM invoicing_accounts_beginningamount WHERE type = 3351 && lang=%s && userid=%s ORDER BY postdate ASC", GetSQLValueString($colname_RecordAccounts_beginningamount, "text"),GetSQLValueString($coluserid_RecordAccounts_beginningamount, "int"));
$RecordAccounts_beginningamount = mysqli_query($DB_Conn, $query_RecordAccounts_beginningamount) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_beginningamount = mysqli_fetch_assoc($RecordAccounts_beginningamount);
$totalRows_RecordAccounts_beginningamount = mysqli_num_rows($RecordAccounts_beginningamount);

if($totalRows_RecordAccounts_beginningamount > 0){
    do{
        $dt = new DateTime($row_RecordAccounts_beginningamount['postdate']); 
        $row_RecordAccounts_beginningamount['postdate'] = $dt->format('Y');
    } while ($row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   
    if($_POST['startdate'] == $_POST['enddate'] && !in_array($_POST['startdate']+1,(array)$row_RecordAccounts_beginningamount['postdate'])){
        // 判斷目前已執行年度結轉的年份
        $colstartdate_RecordAccounts_summonsdetail_trialbalance = "1900-01-01";
        if (isset($_POST['startdate']) && $_POST['startdate'] != "") {
          $colstartdate_RecordAccounts_summonsdetail_trialbalance = $_POST['startdate'] . '-01-01';
        }
        $colenddate_RecordAccounts_summonsdetail_trialbalance = date("Y-m-d");
        if (isset($_POST['enddate']) && $_POST['enddate'] != "") {
          $colenddate_RecordAccounts_summonsdetail_trialbalance = date($_POST['enddate'] . "-12-t");
        }

        $query_RecordAccounts_summonsdetail_trialbalance = sprintf("SELECT type, title, type1, type2, type3, type4, type5, lang, userid, postdate, SUM(debitamount) AS NowDebitBalance, COUNT(debitamount) AS NumDebit, SUM(creditamount) AS NowCreditBalance, COUNT(creditamount) AS NumCredit FROM invoicing_accounts_summonsdetail WHERE lang=%s && userid=%s && postdate BETWEEN %s AND %s GROUP BY type ORDER BY type ASC",GetSQLValueString($_GET['lang'], "text"),GetSQLValueString($w_userid, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsdetail_trialbalance, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsdetail_trialbalance, "date"));
        $RecordAccounts_summonsdetail_trialbalance = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail_trialbalance) or die(mysqli_error($DB_Conn));
        $row_RecordAccounts_summonsdetail_trialbalance = mysqli_fetch_assoc($RecordAccounts_summonsdetail_trialbalance);
        $totalRows_RecordAccounts_summonsdetail_trialbalance = mysqli_num_rows($RecordAccounts_summonsdetail_trialbalance);
        
		
		if($totalRows_RecordAccounts_summonsdetail_trialbalance > 0){
        do{ 
            
            $colitem_id_RecordAccounts_summonsListType1 = "-1";
            if (isset($row_RecordAccounts_summonsdetail_trialbalance['type1'])) {
              $colitem_id_RecordAccounts_summonsListType1 = $row_RecordAccounts_summonsdetail_trialbalance['type1'];
            }
            $colname_RecordAccounts_summonsListType1 = "zh-tw";
            if (isset($_GET['lang'])) {
              $colname_RecordAccounts_summonsListType1 = $_GET['lang'];
            }
            $coluserid_RecordAccounts_summonsListType1 = "-1";
            if (isset($w_userid)) {
              $coluserid_RecordAccounts_summonsListType1 = $w_userid;
            }
            //mysqli_select_db($database_DB_Conn, $DB_Conn);
            $query_RecordAccounts_summonsListType1 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE item_id = %s && list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colitem_id_RecordAccounts_summonsListType1, "text"), GetSQLValueString($colname_RecordAccounts_summonsListType1, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListType1, "int"));
            $RecordAccounts_summonsListType1 = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListType1) or die(mysqli_error($DB_Conn));
            $row_RecordAccounts_summonsListType1 = mysqli_fetch_assoc($RecordAccounts_summonsListType1);
            $totalRows_RecordAccounts_summonsListType1 = mysqli_num_rows($RecordAccounts_summonsListType1);
            
            switch($row_RecordAccounts_summonsListType1['itemvalue'])
            {
              case 1:   // 1 資產 借方+ 貸方-
              case 5:   // 5 營業成本 借方+ 貸方-
              case 6:   // 6 營業費用 借方+ 貸方-
                if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] > $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於借方
                  $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'];
                  $NowBalanceSelect = $NowBalanceSelect;
				  $BeginningDebitBalance = $NowBalanceSelect;
				  $BeginningCreditBalance = 0;
				  
                }else if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] < $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於貸方
                  $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'];
                  $NowBalanceSelect = 0 - $NowBalanceSelect;
				  
				  $BeginningDebitBalance = 0;
				  $BeginningCreditBalance = abs($NowBalanceSelect);
				  
                }else{
                  $NowBalanceSelect = 0;
				  $BeginningDebitBalance = 0;
				  $BeginningCreditBalance = 0;
                }
              break;
              case 2:   // 2 負債 借方- 貸方+
              case 3:   // 3 權益 借方- 貸方+
              case 4:   // 4 營業收入 借方- 貸方+
              case 7:   // 7 營業外收益及費損 借方- 貸方+
              case 8:   // 8 綜合損益總額 借方- 貸方+
                if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] > $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於借方
                  $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'];
                  $NowBalanceSelect = 0 - $NowBalanceSelect;
				  $BeginningDebitBalance = abs($NowBalanceSelect);
				  $BeginningCreditBalance = 0;
                }else if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] < $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於貸方
                  $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'];
                  $NowBalanceSelect = $NowBalanceSelect;
				  $BeginningDebitBalance = 0;
				  $BeginningCreditBalance = $NowBalanceSelect;
                }else{
                  $NowBalanceSelect = 0;
				  $BeginningDebitBalance = 0;
				  $BeginningCreditBalance = 0;
                }
              break;
            }
            
            $TotalNowBalanceSelect = 0;
            //$NowBalanceSelect = 0;
            //echo $row_RecordAccounts_summonsdetail_trialbalance['type'] . ' ' . $row_RecordAccounts_summonsListType1['itemvalue'];
            $TotalNowBalanceSelect = $NowBalanceSelect;
            //echo '<br>';
  
            switch($row_RecordAccounts_summonsListType1['itemvalue'])
            {
              case 1:   // 1 資產 借方+ 貸方-
                    break;
              case 5:   // 5 營業成本 借方+ 貸方-
                    $Totaloperatingcosts = $TotalNowBalanceSelect;
                    $Operatingmargin = $Totaloperatingincome - $Totaloperatingcosts;
                    break;
              case 6:   // 6 營業費用 借方+ 貸方-
                    $Totaloperatingexpenses = $TotalNowBalanceSelect;
                    $Operatingprofit = $Operatingmargin - $Totaloperatingexpenses;
                    break;
              case 2:   // 2 負債 借方- 貸方+
                    break;
              case 3:   // 3 權益 借方- 貸方+
                    break;
              case 4:   // 4 營業收入 借方- 貸方+
                    $Totaloperatingincome = $TotalNowBalanceSelect;
                    break;
              case 7:   // 7 營業外收益及費損 借方- 貸方+
                    $Totalnonoperatingincomeandexpenses = $TotalNowBalanceSelect;
                    $Pretaxincome = $Operatingprofit + $Totalnonoperatingincomeandexpenses;
                    break;
              case 8:   // 8 綜合損益總額 借方- 貸方+
                    $Interestratefee = $TotalNowBalanceSelect;
                    $Totalconsolidatedprofitandlossfortheperiod = $Pretaxincome - $Interestratefee;
                    break;
            }

            $insertSQL = sprintf("INSERT INTO invoicing_accounts_beginningamount (title, type, type1, type2, type3, type4, type5, BeginDebitBalance, BeginCreditBalance, BeginDebitAmount, BeginCreditAmount, postdate, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['title'], "text"),
					   GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['type'], "text"),
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['type1'], "text"),
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['type2'], "text"),
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['type3'], "text"),
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['type4'], "text"),
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['type5'], "text"), 
                       GetSQLValueString($BeginningDebitBalance, "text"),
                       GetSQLValueString($BeginningCreditBalance, "text"),
					   GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'], "text"),
                       GetSQLValueString($row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'], "text"),
					   GetSQLValueString(($_POST['startdate']+1).'-01-01', "text"),
                       GetSQLValueString($_GET['lang'], "text"),
                       GetSQLValueString($w_userid, "int"));

          //mysqli_select_db($database_DB_Conn, $DB_Conn);
          $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
            
        } while ($row_RecordAccounts_summonsdetail_trialbalance = mysqli_fetch_assoc($RecordAccounts_summonsdetail_trialbalance));
		
		}
        
        // 綜合損益
        $Totaloperatingincome = $Totaloperatingincome; //4
        $Operatingprofit = $Operatingmargin - $Totaloperatingexpenses; // 6
        $Operatingmargin = $Totaloperatingincome - $Totaloperatingcosts; //5
        $Pretaxincome = $Operatingprofit + $Totalnonoperatingincomeandexpenses; //8
        $Totalconsolidatedprofitandlossfortheperiod = $Pretaxincome - $Interestratefee;
        $Accumulatedsurplus_3351 = $Totalconsolidatedprofitandlossfortheperiod; // 累積盈餘
        // 3351 若 > 0 位於貸方 < 0 位於借方
        if($Accumulatedsurplus_3351 > 0) { 
            $BeginDebitBalance = $Totalconsolidatedprofitandlossfortheperiod;
            $BeginCreditBalance = 0;
        }
        
        if($Accumulatedsurplus_3351 < 0) { 
            $BeginDebitBalance = 0;
            $BeginCreditBalance = $Totalconsolidatedprofitandlossfortheperiod;
        }
		
		if($Accumulatedsurplus_3351 == 0) { 
            $BeginDebitBalance = $BeginCreditBalance = 0;
        }
        
        
        // 傳值到 accountingsubjects_code
        $_GET['itemvalue'] = '3351';
        require("require_manage_accounts_summons_order_copy_accountingsubjects_code_get.php");
        
        //$accountingsubjects['itemvalue'];
        if($accountingsubjects[0] == NULL){$accountingsubjects[0] = '-1';}
        if($accountingsubjects[1] == NULL){$accountingsubjects[1] = '-1';}
        if($accountingsubjects[2] == NULL){$accountingsubjects[2] = '-1';}
        if($accountingsubjects[3] == NULL){$accountingsubjects[3] = '-1';}
        if($accountingsubjects[4] == NULL){$accountingsubjects[4] = '-1';}

        $insertSQL = sprintf("INSERT INTO invoicing_accounts_beginningamount (title, type, type1, type2, type3, type4, type5, BeginDebitBalance, BeginCreditBalance, postdate, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($accountingsubjects['itemname'], "text"),
					   GetSQLValueString($accountingsubjects['itemvalue'], "text"),
                       GetSQLValueString($accountingsubjects[0], "text"),
                       GetSQLValueString($accountingsubjects[1], "text"),
                       GetSQLValueString($accountingsubjects[2], "text"),
                       GetSQLValueString($accountingsubjects[3], "text"),
                       GetSQLValueString($accountingsubjects[4], "text"), 
                       GetSQLValueString($BeginDebitBalance, "text"),
                       GetSQLValueString($BeginCreditBalance, "text"),
					   GetSQLValueString(($_POST['startdate']+1).'-01-01', "text"),
                       GetSQLValueString($_GET['lang'], "text"),
                       GetSQLValueString($w_userid, "int"));

          //mysqli_select_db($database_DB_Conn, $DB_Conn);
          $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
    }
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
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 年度結轉 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
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
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>結算當年度各項目實帳戶之年度餘額，並結轉作為下一年度的期初金額。</b></div>
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>結算當年度之損益，結轉作下一年度的上期損益金額。</b></div>
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>若結轉後，再異動已結算過的會計傳票，請務必重新再做一次當年度的結轉。</b></div>
    
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>請於每年年底資料結算時執行。</b></div>
      
    <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b><?php if($totalRows_RecordAccounts_beginningamount > 0) { echo '目前已結轉年度' .
     implode(",",((array)$row_RecordAccounts_beginningamount['postdate'])); } else { echo '目前尚未結轉'; }?></b></div>
    
    <form class="form-horizontal form-bordered" data-parsley-validate="" method="post" action="<?php echo $editFormAction; ?>" id="form1" name="form1" > 
    <div class="form-group row">
        <label class="col-md-2 col-form-label">結轉年度<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
              <div class="input-group input-daterange">
                  <input type="text" class="form-control"  name="startdate" id="startdate" value="<?php $dt = new DateTime(); echo $dt->format('Y'); ?>" data-parsley-trigger="blur" data-date-language="zh-TW" data-provide="datepicker" data-date-format="yyyy" autocomplete="off"/>
                  <span class="input-group-addon">to</span>
                  <input type="text" class="form-control" name="enddate" value="<?php $dt = new DateTime(); echo $dt->format('Y'); ?>" data-provide="datepicker" data-date-format="yyyy" id="enddate"  data-parsley-trigger="blur" data-date-language="zh-TW" autocomplete="off"/> 
              </div>
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
		$('#postdate').datepicker({
			format: "yyyy",
			viewMode: "year", 
			minViewMode: "years"
		}).on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.input-daterange').datepicker({
			language: "zh-TW",
			todayHighlight: true,
			format: "yyyy",
			viewMode: "year", 
			minViewMode: "years"
 	    });  
  
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
		
		/*$('#startdate, #endtdate').datepicker({
		    }).on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); */
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

