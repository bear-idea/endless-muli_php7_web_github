<?php
if($_POST['postdate'] != ''){
  $search_enddate = $_POST['postdate'];

  $dt = new DateTime($_POST['postdate']);
  $search_startdate = $dt->format('Y') . '-01-01';

  /*if($CurrentYear != ''){
    $dt = new DateTime($CurrentYear);
    $interval = new DateInterval('P1Y');
    $dt->sub($interval);
    $search_startdate = $dt->format('Y-m-d');
  }*/

}

$coluserid_RecordAccounts_summonsdetail_trialbalance = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsdetail_trialbalance = $w_userid;
}
$colstartdate_RecordAccounts_summonsdetail_trialbalance = "1900-01-01";
if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordAccounts_summonsdetail_trialbalance = $search_startdate;
}
$dt = new DateTime();
//$interval = new DateInterval('P1D');
//$dt->add($interval);
$colenddate_RecordAccounts_summonsdetail_trialbalance = $dt->format('Y-m-d');
$colenddate_RecordAccounts_summonsdetail_trialbalance .= " 23:59:59";
if (isset($search_enddate) && $search_enddate != "") {
  $dt = new DateTime($search_enddate);
  //$interval = new DateInterval('P1D');
  //$dt->add($interval);
  $colenddate_RecordAccounts_summonsdetail_trialbalance = $dt->format('Y-m-d');
  $colenddate_RecordAccounts_summonsdetail_trialbalance .= " 23:59:59";
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsdetail_trialbalance = sprintf("SELECT type, lang, userid, postdate, SUM(debitamount) AS NowDebitBalance, COUNT(debitamount) AS NumDebit, SUM(creditamount) AS NowCreditBalance, COUNT(creditamount) AS NumCredit FROM invoicing_accounts_summonsdetail WHERE userid=%s && type=%s && postdate BETWEEN %s AND %s GROUP BY type",GetSQLValueString($coluserid_RecordAccounts_summonsdetail_trialbalance, "int"),GetSQLValueString($row_RecordAccounts_summonsListType['itemvalue'], "text"),GetSQLValueString($colstartdate_RecordAccounts_summonsdetail_trialbalance, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsdetail_trialbalance, "date"));
$RecordAccounts_summonsdetail_trialbalance = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail_trialbalance) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsdetail_trialbalance = mysqli_fetch_assoc($RecordAccounts_summonsdetail_trialbalance);
$totalRows_RecordAccounts_summonsdetail_trialbalance = mysqli_num_rows($RecordAccounts_summonsdetail_trialbalance);	

//echo $row_RecordAccounts_summonsListType['itemvalue']; // 目前會計代碼
$row_RecordAccounts_summonsListType['state']; // 目前借貸別
//echo $row_RecordAccounts_summonsListType['level0']; // 目前母分類會計代碼

// 貸方餘額(Credit Balance) 借方餘額 Debit balance
switch($row_RecordAccounts_summonsListType['level0'])
{
  case 1:   // 1 資產 借方+ 貸方-
  case 11:   // 1 資產 借方+ 貸方-
  case 13:   // 1 資產 借方+ 貸方-
  case 5:   // 5 營業成本 借方+ 貸方-
  case 6:   // 6 營業費用 借方+ 貸方-
    if($row_RecordAccounts_summonsListType['state'] == '1'){ // 位於借方
      $NowBalanceSelect = ($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance']) - ($row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']);
    }
    if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 位於貸方
      $NowBalanceSelect = 0 - ($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance']) - ($row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']);
    }if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] > $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於借方
      $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'];
      /*if($row_RecordAccounts_summonsListType['state'] == '1'){ // 會計項目為借方
        $NowBalanceSelect = $NowBalanceSelect;
      }
      if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 會計項目為貸方
        $NowBalanceSelect = 0 - $NowBalanceSelect;
      }*/
      $NowBalanceSelect = $NowBalanceSelect;
    }else if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] < $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於貸方
      $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'];
       /*if($row_RecordAccounts_summonsListType['state'] == '1'){ // 會計項目為借方
        $NowBalanceSelect = 0 - $NowBalanceSelect;
      }
      if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 會計項目為貸方
        $NowBalanceSelect = $NowBalanceSelect;
      }*/
      $NowBalanceSelect = 0 - $NowBalanceSelect;
    }else{
      $NowBalanceSelect = 0;
    }
  break;
  case 2:   // 2 負債 借方- 貸方+
  case 21:   // 2 負債 借方- 貸方+
  case 23:   // 2 負債 借方- 貸方+
  case 3:   // 3 權益 借方- 貸方+
  case 31:   // 3 權益 借方- 貸方+
  case 32:   // 3 權益 借方- 貸方+
  //case 33:   // 3 權益 借方- 貸方+
  case 34:   // 3 權益 借方- 貸方+
  case 35:   // 3 權益 借方- 貸方+
  case 4:   // 4 營業收入 借方- 貸方+
  case 7:   // 7 營業外收益及費損 借方- 貸方+
  case 8:   // 8 綜合損益總額 借方- 貸方+
    if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] > $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於借方
      $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'];
      /*if($row_RecordAccounts_summonsListType['state'] == '1'){ // 會計項目為借方
        $NowBalanceSelect = $NowBalanceSelect;
      }
      if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 會計項目為貸方
        $NowBalanceSelect = 0 - $NowBalanceSelect;
      }*/
      $NowBalanceSelect = 0 - $NowBalanceSelect;
    }else if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] < $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於貸方
      $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'];
       /*if($row_RecordAccounts_summonsListType['state'] == '1'){ // 會計項目為借方
        $NowBalanceSelect = 0 - $NowBalanceSelect;
      }
      if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 會計項目為貸方
        $NowBalanceSelect = $NowBalanceSelect;
      }*/
      $NowBalanceSelect = $NowBalanceSelect;
    }else{
      $NowBalanceSelect = 0;
    }
  break;
    case 33:   // 3 權益 借方- 貸方+
      if($row_RecordAccounts_summonsListType['itemvalue'] == '3353'){ // 本期損益
        $TotalNowBalanceSelect = 0;
        $colitemvalue_RecordMultiProfitlosslist_l1 = '4'; 
        require("require_manage_accounts_report_balancesheet_print_get_profitlosslist_list.php");
        $Totaloperatingincome = $TotalNowBalanceSelect; // 營業收入總計

        $TotalNowBalanceSelect = 0;
        $colitemvalue_RecordMultiProfitlosslist_l1 = '5';
        require("require_manage_accounts_report_balancesheet_print_get_profitlosslist_list.php");
        $Totaloperatingcosts = $TotalNowBalanceSelect; // 營業成本總計
        $Operatingmargin = $Totaloperatingincome - $Totaloperatingcosts; // 營業毛利(總營收-銷貨支出)

        $TotalNowBalanceSelect = 0;
        $colitemvalue_RecordMultiProfitlosslist_l1 = '6';
        require("require_manage_accounts_report_balancesheet_print_get_profitlosslist_list.php");
        $Totaloperatingexpenses = $TotalNowBalanceSelect; // 營業費用總計
        $Operatingprofit = $Operatingmargin - $Totaloperatingexpenses; // 營業淨利(營業毛利-營業費用總計)

        $TotalNowBalanceSelect = 0;
        $colitemvalue_RecordMultiProfitlosslist_l1 = '7';
        require("require_manage_accounts_report_balancesheet_print_get_profitlosslist_list.php");
        $Totalnonoperatingincomeandexpenses = $TotalNowBalanceSelect; // 營業外收益及費損總計
        $Pretaxincome = $Operatingprofit + $Totalnonoperatingincomeandexpenses; // 稅前收入(營業淨利+營業外收益及費損總計)

        $TotalNowBalanceSelect = 0;
        $colitemvalue_RecordMultiProfitlosslist_l1 = '8';
        require("require_manage_accounts_report_balancesheet_print_get_profitlosslist_list.php");
        $Interestratefee = $TotalNowBalanceSelect; // 所得稅費用
        $Totalconsolidatedprofitandlossfortheperiod = $Pretaxincome - $Interestratefee; //本期綜合損益總額
        $NowBalanceSelect = $Totalconsolidatedprofitandlossfortheperiod;
      }else{
        if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] > $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於借方
          $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'];
          /*if($row_RecordAccounts_summonsListType['state'] == '1'){ // 會計項目為借方
            $NowBalanceSelect = $NowBalanceSelect;
          }
          if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 會計項目為貸方
            $NowBalanceSelect = 0 - $NowBalanceSelect;
          }*/
          $NowBalanceSelect = 0 - $NowBalanceSelect;
        }else if($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'] < $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']){ // 位於貸方
          $NowBalanceSelect = $row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance'] - $row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance'];
           /*if($row_RecordAccounts_summonsListType['state'] == '1'){ // 會計項目為借方
            $NowBalanceSelect = 0 - $NowBalanceSelect;
          }
          if($row_RecordAccounts_summonsListType['state'] == '-1'){ // 會計項目為貸方
            $NowBalanceSelect = $NowBalanceSelect;
          }*/
          $NowBalanceSelect = $NowBalanceSelect;
        }else{
          $NowBalanceSelect = 0;
        }
      }
      
    break;
}
?>