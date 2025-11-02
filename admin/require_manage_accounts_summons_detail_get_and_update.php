<?php
// 傳入值 aid
// 傳入值 ordertype
// 取得所有細項
	     // 取得所有細項
	    $colname_RecordAccounts_summonsdetail = "-1";
		if (isset($aid)) {
		  $colname_RecordAccounts_summonsdetail = $aid;
		}
		$coluserid_RecordAccounts_summonsdetail = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordAccounts_summonsdetail = $w_userid;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordAccounts_summonsdetail = sprintf("SELECT SUM(debitamount) AS sum_debitamount, SUM(creditamount) AS sum_creditamount, ordertype, userid FROM invoicing_accounts_summonsdetail WHERE aid = %s && userid=%s", GetSQLValueString($colname_RecordAccounts_summonsdetail, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsdetail, "int"));
		$RecordAccounts_summonsdetail = mysqli_query($DB_Conn, $query_RecordAccounts_summonsdetail) or die(mysqli_error($DB_Conn));
		$row_RecordAccounts_summonsdetail = mysqli_fetch_assoc($RecordAccounts_summonsdetail);
		$totalRows_RecordAccounts_summonsdetail = mysqli_num_rows($RecordAccounts_summonsdetail);
		
		if ($row_RecordAccounts_summonsdetail['ordertype'] == '收入'){
			$sumamount = $row_RecordAccounts_summonsdetail['sum_creditamount'];
		}
		
		if ($row_RecordAccounts_summonsdetail['ordertype'] == '支出'){
			$sumamount = $row_RecordAccounts_summonsdetail['sum_debitamount'];
		}
		
		if ($row_RecordAccounts_summonsdetail['ordertype'] == '轉帳'){
			if($row_RecordAccounts_summonsdetail['sum_creditamount'] == $row_RecordAccounts_summonsdetail['sum_debitamount']){
				$sumamount = $row_RecordAccounts_summonsdetail['sum_creditamount'];
				$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET errorcheck=%s WHERE id=%s",
					       GetSQLValueString(0, "int"),
                           GetSQLValueString($aid, "int"));

				  //mysqli_select_db($database_DB_Conn, $DB_Conn);
				  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			}else{
				$sumamount = '';
				$errorcheck = 1;
				$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET errorcheck=%s WHERE id=%s",
					       GetSQLValueString($errorcheck, "int"),
                           GetSQLValueString($aid, "int"));

				  //mysqli_select_db($database_DB_Conn, $DB_Conn);
				  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			}
		}
		
		// 更新
		$updateSQL = sprintf("UPDATE invoicing_accounts_summonsorder SET sumamount=%s WHERE id=%s",
					       GetSQLValueString($sumamount, "text"),
                           GetSQLValueString($aid, "int"));

		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		  
		  
		  ////////////////////////////////////////////////////////////////////////////////////
$coluserid_RecordAccounts_summonssetting = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonssetting = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonssetting = sprintf("SELECT * FROM invoicing_accounts_setting WHERE userid=%s LIMIT 1", GetSQLValueString($coluserid_RecordAccounts_summonssetting, "int"));
$RecordAccounts_summonssetting = mysqli_query($DB_Conn, $query_RecordAccounts_summonssetting) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonssetting = mysqli_fetch_assoc($RecordAccounts_summonssetting);
$totalRows_RecordAccounts_summonssetting = mysqli_num_rows($RecordAccounts_summonssetting);

		$_GET['itemvalue'] = $row_RecordAccounts_summonssetting['CashAccountID'];
	   
	  require("require_manage_accounts_summons_order_copy_accountingsubjects_code_get.php");


		// 取得所有細項(系統新增)
			$colname_RecordAccounts_summonsstate = "-1";
			if (isset($aid)) {
			  $colname_RecordAccounts_summonsstate = $aid;
			}
			$coluserid_RecordAccounts_summonsstate = "-1";
			if (isset($w_userid)) {
			  $coluserid_RecordAccounts_summonsstate = $w_userid;
			}
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordAccounts_summonsstate = sprintf("SELECT * FROM invoicing_accounts_summonsdetail WHERE aid = %s && userid=%s && state=%s", GetSQLValueString($colname_RecordAccounts_summonsstate, "int"),GetSQLValueString($coluserid_RecordAccounts_summonsstate, "int"),GetSQLValueString('system', "text"));
			$RecordAccounts_summonsstate = mysqli_query($DB_Conn, $query_RecordAccounts_summonsstate) or die(mysqli_error($DB_Conn));
			$row_RecordAccounts_summonsstate = mysqli_fetch_assoc($RecordAccounts_summonsstate);
			$totalRows_RecordAccounts_summonsstate = mysqli_num_rows($RecordAccounts_summonsstate);
			
			// $row_RecordAccounts_summonsstate['id']
			
			
	    if ($row_RecordAccounts_summonsdetail['ordertype'] == '收入'){
			if($totalRows_RecordAccounts_summonsstate == 0){ /* 借方為總和為0*/
				$insertSQL = sprintf("INSERT INTO invoicing_accounts_summonsdetail (aid, title, summonsnumber, ordertype, type, type1, type2, type3, type4, debitamount, creditamount, state, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($aid, "int"),
							   GetSQLValueString($accountingsubjects['itemname'], "text"),
							   GetSQLValueString($_POST['summonsnumber'], "text"),
							   GetSQLValueString($row_RecordAccounts_summonsdetail['ordertype'], "text"),
							   GetSQLValueString($accountingsubjects['itemvalue'], "text"),
							   GetSQLValueString($accountingsubjects[0], "text"),
							   GetSQLValueString($accountingsubjects[1], "text"),
							   GetSQLValueString($accountingsubjects[2], "text"),
							   GetSQLValueString($accountingsubjects[3], "text"),
							   GetSQLValueString($sumamount, "text"), /* 需輸入金額 */
							   GetSQLValueString('0', "text"), /* 已輸入金額 */
							   GetSQLValueString('system', "text"), /* 記錄此項由系統新增 */
							   GetSQLValueString($_POST['postdate'], "date"),
							   GetSQLValueString('1', "int"),
							   GetSQLValueString('借方科目現金項目', "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
	
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
			}

			if($totalRows_RecordAccounts_summonsstate > 0){ /* 借方為總和>0*/
				$updateSQL = sprintf("UPDATE invoicing_accounts_summonsdetail SET debitamount=%s, editdate=%s, lang=%s WHERE id=%s",
						   GetSQLValueString($sumamount, "text"),
						   GetSQLValueString($_POST['editdate'], "date"),
						   GetSQLValueString($_POST['lang'], "text"),
						   GetSQLValueString($row_RecordAccounts_summonsstate['id'], "int"));

			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			}
			
		}
		
		if ($row_RecordAccounts_summonsdetail['ordertype'] == '支出'){
			if($totalRows_RecordAccounts_summonsstate == 0){ /* 貸方為總和為0*/
				$insertSQL = sprintf("INSERT INTO invoicing_accounts_summonsdetail (aid, title, summonsnumber, ordertype, type, type1, type2, type3, type4, debitamount, creditamount, state, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($aid, "int"),
							   GetSQLValueString($accountingsubjects['itemname'], "text"),
							   GetSQLValueString($_POST['summonsnumber'], "text"),
							   GetSQLValueString($row_RecordAccounts_summonsdetail['ordertype'], "text"),
							   GetSQLValueString($accountingsubjects['itemvalue'], "text"),
							   GetSQLValueString($accountingsubjects[0], "text"),
							   GetSQLValueString($accountingsubjects[1], "text"),
							   GetSQLValueString($accountingsubjects[2], "text"),
							   GetSQLValueString($accountingsubjects[3], "text"),
							   GetSQLValueString('0', "text"), /* 已輸入金額 */
							   GetSQLValueString($sumamount, "text"), /* 需輸入金額 */
							   GetSQLValueString('system', "text"), /* 記錄此項由系統新增 */
							   GetSQLValueString($_POST['postdate'], "date"),
							   GetSQLValueString('1', "int"),
							   GetSQLValueString('貸方科目現金項目', "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
	
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
			}
			
			if($totalRows_RecordAccounts_summonsstate > 0){ /* 貸方為總和>0*/
				$updateSQL = sprintf("UPDATE invoicing_accounts_summonsdetail SET creditamount=%s, editdate=%s, lang=%s WHERE id=%s",
						   GetSQLValueString($sumamount, "text"),
						   GetSQLValueString($_POST['editdate'], "date"),
						   GetSQLValueString($_POST['lang'], "text"),
						   GetSQLValueString($row_RecordAccounts_summonsstate['id'], "int"));

			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			}
		}
		////////////////////////////////////////////////////////////////////////////////////
?>
