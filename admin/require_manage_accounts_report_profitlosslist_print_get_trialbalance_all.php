<?php
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
$query_RecordAccounts_summonsdetail_trialbalance = sprintf("SELECT type, lang, userid, postdate, SUM(debitamount) AS NowDebitBalance, COUNT(debitamount) AS NumDebit, SUM(creditamount) AS NowCreditBalance, COUNT(creditamount) AS NumCredit FROM invoicing_accounts_summonsdetail WHERE userid=%s && postdate BETWEEN %s AND %s GROUP BY type",GetSQLValueString($coluserid_RecordAccounts_summonsdetail_trialbalance, "int"),GetSQLValueString($colstartdate_RecordAccounts_summonsdetail_trialbalance, "date"),GetSQLValueString($colenddate_RecordAccounts_summonsdetail_trialbalance, "date"));
$RecordAccounts_summonsdetail_trialbalance = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail_trialbalance) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsdetail_trialbalance = mysqli_fetch_assoc($RecordAccounts_summonsdetail_trialbalance);
$totalRows_RecordAccounts_summonsdetail_trialbalance = mysqli_num_rows($RecordAccounts_summonsdetail_trialbalance);	

do{
	echo $row_RecordAccounts_summonsdetail_trialbalance['type'];
	echo ' ';
	echo $NowBalanceSelect = ($row_RecordAccounts_summonsdetail_trialbalance['NowDebitBalance']) - ($row_RecordAccounts_summonsdetail_trialbalance['NowCreditBalance']);	
	echo '<br>';
} while ($row_RecordAccounts_summonsdetail_trialbalance = mysqli_fetch_assoc($RecordAccounts_summonsdetail_trialbalance)); 

?>