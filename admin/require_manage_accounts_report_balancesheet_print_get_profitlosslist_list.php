<?php
$collang_RecordMultiProfitlosslist_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMultiProfitlosslist_l1 = $_GET['lang'];
}
$coluserid_RecordMultiProfitlosslist_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMultiProfitlosslist_l1 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMultiProfitlosslist_l1 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && itemvalue = %s && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($colitemvalue_RecordMultiProfitlosslist_l1, "text"), GetSQLValueString($collang_RecordMultiProfitlosslist_l1, "text"),GetSQLValueString($coluserid_RecordMultiProfitlosslist_l1, "int"));
$RecordMultiProfitlosslist_l1 = mysqli_query($DB_Conn, $query_RecordMultiProfitlosslist_l1) or die(mysqli_error($DB_Conn));
$row_RecordMultiProfitlosslist_l1 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l1);
$totalRows_RecordMultiProfitlosslist_l1 = mysqli_num_rows($RecordMultiProfitlosslist_l1);

//$NowBalanceSelect = ($dvalue['NowDebitBalance']) - ($dvalue['NowCreditBalance']);
?>
<?php if ($totalRows_RecordMultiProfitlosslist_l1 > 0) { // Show if recordset not empty ?>
        <?php do { ?>
          <?php if ($row_RecordMultiProfitlosslist_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
            <?php
					 $collang_RecordMultiProfitlosslist_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordMultiProfitlosslist_l2 = $_SESSION['lang'];
					}
					$colsubitem_id_RecordMultiProfitlosslist_l2 = "-1";
					if (isset($row_RecordMultiProfitlosslist_l1['item_id'])) {
					  $colsubitem_id_RecordMultiProfitlosslist_l2 = $row_RecordMultiProfitlosslist_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordMultiProfitlosslist_l2 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiProfitlosslist_l2, "text"),GetSQLValueString($colsubitem_id_RecordMultiProfitlosslist_l2, "int"));
					$RecordMultiProfitlosslist_l2 = mysqli_query($DB_Conn, $query_RecordMultiProfitlosslist_l2) or die(mysqli_error($DB_Conn));
					$row_RecordMultiProfitlosslist_l2 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l2);
					$totalRows_RecordMultiProfitlosslist_l2 = mysqli_num_rows($RecordMultiProfitlosslist_l2);
					?>
            <?php do { ?>
                <?php if ($row_RecordMultiProfitlosslist_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                  <?php
                         $collang_RecordMultiProfitlosslist_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordMultiProfitlosslist_l3 = $_SESSION['lang'];
                        }
                        $colsubitem_id_RecordMultiProfitlosslist_l3 = "-1";
                        if (isset($row_RecordMultiProfitlosslist_l2['item_id'])) {
                          $colsubitem_id_RecordMultiProfitlosslist_l3 = $row_RecordMultiProfitlosslist_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordMultiProfitlosslist_l3 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiProfitlosslist_l3, "text"),GetSQLValueString($colsubitem_id_RecordMultiProfitlosslist_l3, "int"));
                        $RecordMultiProfitlosslist_l3 = mysqli_query($DB_Conn, $query_RecordMultiProfitlosslist_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordMultiProfitlosslist_l3 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l3);
                        $totalRows_RecordMultiProfitlosslist_l3 = mysqli_num_rows($RecordMultiProfitlosslist_l3);
                        ?>
                  <?php do { ?>
						<?php if ($row_RecordMultiProfitlosslist_l3['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
						  <?php
								 $collang_RecordMultiProfitlosslist_l4 = "zh-tw";
								if (isset($_GET['lang'])) {
								  $collang_RecordMultiProfitlosslist_l4 = $_SESSION['lang'];
								}
								$colsubitem_id_RecordMultiProfitlosslist_l4 = "-1";
								if (isset($row_RecordMultiProfitlosslist_l3['item_id'])) {
								  $colsubitem_id_RecordMultiProfitlosslist_l4 = $row_RecordMultiProfitlosslist_l3['item_id'];
								}
								//mysqli_select_db($database_DB_Conn, $DB_Conn);
								$query_RecordMultiProfitlosslist_l4 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '3' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiProfitlosslist_l4, "text"),GetSQLValueString($colsubitem_id_RecordMultiProfitlosslist_l4, "int"));
								$RecordMultiProfitlosslist_l4 = mysqli_query($DB_Conn, $query_RecordMultiProfitlosslist_l4) or die(mysqli_error($DB_Conn));
								$row_RecordMultiProfitlosslist_l4 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l4);
								$totalRows_RecordMultiProfitlosslist_l4 = mysqli_num_rows($RecordMultiProfitlosslist_l4);
								?>
						  <?php do { ?>
								<?php if ($row_RecordMultiProfitlosslist_l4['endnode'] == 'child') { ?>
								<?php 
									$row_RecordAccounts_summonsListType['itemvalue'] = $row_RecordMultiProfitlosslist_l4['itemvalue']; 
									$row_RecordAccounts_summonsListType['state'] = $row_RecordMultiProfitlosslist_l4['state']; 
									$row_RecordAccounts_summonsListType['level0'] = $row_RecordMultiProfitlosslist_l1['itemvalue'];
									require("require_manage_accounts_report_balancesheet_print_get_profitlosslist.php"); 
									$TotalNowBalanceSelect += $NowBalanceSelect;
								?>

								<?php } ?>
								<?php if ($row_RecordMultiProfitlosslist_l4['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
								
								  <?php
										 $collang_RecordMultiProfitlosslist_l5 = "zh-tw";
										if (isset($_GET['lang'])) {
										  $collang_RecordMultiProfitlosslist_l5 = $_SESSION['lang'];
										}
										$colsubitem_id_RecordMultiProfitlosslist_l5 = "-1";
										if (isset($row_RecordMultiProfitlosslist_l4['item_id'])) {
										  $colsubitem_id_RecordMultiProfitlosslist_l5 = $row_RecordMultiProfitlosslist_l4['item_id'];
										}
										//mysqli_select_db($database_DB_Conn, $DB_Conn);
										$query_RecordMultiProfitlosslist_l5 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '4' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiProfitlosslist_l5, "text"),GetSQLValueString($colsubitem_id_RecordMultiProfitlosslist_l5, "int"));
										$RecordMultiProfitlosslist_l5 = mysqli_query($DB_Conn, $query_RecordMultiProfitlosslist_l5) or die(mysqli_error($DB_Conn));
										$row_RecordMultiProfitlosslist_l5 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l5);
										$totalRows_RecordMultiProfitlosslist_l5 = mysqli_num_rows($RecordMultiProfitlosslist_l5);
										?>
								  <?php do { ?>
										<?php if ($row_RecordMultiProfitlosslist_l5['endnode'] != 'child') { ?>
										<?php 
											$row_RecordAccounts_summonsListType['itemvalue'] = $row_RecordMultiProfitlosslist_l5['itemvalue']; 
											$row_RecordAccounts_summonsListType['state'] = $row_RecordMultiProfitlosslist_l5['state']; 
											$row_RecordAccounts_summonsListType['level0'] = $row_RecordMultiProfitlosslist_l1['itemvalue'];
											require("require_manage_accounts_report_balancesheet_print_get_profitlosslist.php"); 
											$TotalNowBalanceSelect += $NowBalanceSelect;
										?>
										<?php } ?>
									 
									 <?php  } while ($row_RecordMultiProfitlosslist_l5 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l5)); ?>
								  <?php mysqli_free_result($RecordMultiProfitlosslist_l5);?>
								<?php } // Show if recordset not empty ?>
							 
							 <?php  } while ($row_RecordMultiProfitlosslist_l4 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l4)); ?>
						  <?php mysqli_free_result($RecordMultiProfitlosslist_l4);?>
						<?php } // Show if recordset not empty ?>
					 
                     <?php  } while ($row_RecordMultiProfitlosslist_l3 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l3)); ?>
                  <?php mysqli_free_result($RecordMultiProfitlosslist_l3);?>
                <?php } // Show if recordset not empty ?>
			   
               <?php  } while ($row_RecordMultiProfitlosslist_l2 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l2)); ?>
            <?php mysqli_free_result($RecordMultiProfitlosslist_l2);?>
          <?php } // Show if recordset not empty ?>
	      
          <?php  } while ($row_RecordMultiProfitlosslist_l1 = mysqli_fetch_assoc($RecordMultiProfitlosslist_l1)); ?>

<?php } // Show if recordset not empty ?>