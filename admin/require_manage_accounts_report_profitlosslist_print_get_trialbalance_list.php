<?php

$collang_RecordMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMultiLeftMenu_l1 = $_GET['lang'];
}
$coluserid_RecordMultiLeftMenu_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMultiLeftMenu_l1 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMultiLeftMenu_l1 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && itemvalue = %s && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($colitemvalue_RecordMultiLeftMenu_l1, "text"), GetSQLValueString($collang_RecordMultiLeftMenu_l1, "text"),GetSQLValueString($coluserid_RecordMultiLeftMenu_l1, "int"));
$RecordMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1);
$totalRows_RecordMultiLeftMenu_l1 = mysqli_num_rows($RecordMultiLeftMenu_l1);

//$NowBalanceSelect = ($dvalue['NowDebitBalance']) - ($dvalue['NowCreditBalance']);
?>
<style>	
ul{
	list-style-type:none;
	margin: 0px;
	padding: 0px;
}
li{
	list-style-type:none;
	margin-left: 0px;
	padding-left: 0px;
}
li div{
	width: 100px;
	float: right;
}
</style>
<?php if ($totalRows_RecordMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>
<ul>
        <?php do { ?>
          <li><?php echo $row_RecordMultiLeftMenu_l1['itemname']; ?>
          <?php if ($row_RecordMultiLeftMenu_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
          <ul>
            <?php
					 $collang_RecordMultiLeftMenu_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordMultiLeftMenu_l2 = $_SESSION['lang'];
					}
					$colsubitem_id_RecordMultiLeftMenu_l2 = "-1";
					if (isset($row_RecordMultiLeftMenu_l1['item_id'])) {
					  $colsubitem_id_RecordMultiLeftMenu_l2 = $row_RecordMultiLeftMenu_l1['item_id'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordMultiLeftMenu_l2 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l2, "int"));
					$RecordMultiLeftMenu_l2 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l2) or die(mysqli_error($DB_Conn));
					$row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2);
					$totalRows_RecordMultiLeftMenu_l2 = mysqli_num_rows($RecordMultiLeftMenu_l2);
					?>
            <?php do { ?>
              <li><?php echo $row_RecordMultiLeftMenu_l2['itemvalue']; ?> <?php echo $row_RecordMultiLeftMenu_l2['itemname']; ?>
                <?php if ($row_RecordMultiLeftMenu_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                <ul>
                  <?php
                         $collang_RecordMultiLeftMenu_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordMultiLeftMenu_l3 = $_SESSION['lang'];
                        }
                        $colsubitem_id_RecordMultiLeftMenu_l3 = "-1";
                        if (isset($row_RecordMultiLeftMenu_l2['item_id'])) {
                          $colsubitem_id_RecordMultiLeftMenu_l3 = $row_RecordMultiLeftMenu_l2['item_id'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordMultiLeftMenu_l3 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l3, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l3, "int"));
                        $RecordMultiLeftMenu_l3 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordMultiLeftMenu_l3);
                        $totalRows_RecordMultiLeftMenu_l3 = mysqli_num_rows($RecordMultiLeftMenu_l3);
                        ?>
                  <?php do { ?>
                    <li><?php echo $row_RecordMultiLeftMenu_l3['itemvalue']; ?> <?php echo $row_RecordMultiLeftMenu_l3['itemname']; ?>
						<?php if ($row_RecordMultiLeftMenu_l3['endnode'] == 'child') { ?>
                        <?php 
                            $row_RecordAccounts_summonsListType['itemvalue'] = $row_RecordMultiLeftMenu_l3['itemvalue']; 
                            $row_RecordAccounts_summonsListType['state'] = $row_RecordMultiLeftMenu_l3['state']; 
                            $row_RecordAccounts_summonsListType['level0'] = $row_RecordMultiLeftMenu_l1['itemvalue'];
                            require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
                            $TotalNowBalanceSelect += $NowBalanceSelect;
                        ?>
                        <div>&nbsp;<!--百分比--></div><div>&nbsp;<!--合計--></div><div><?php echo $NowBalanceSelect; //小計 ?></div>
                        <?php } ?>
						<?php if ($row_RecordMultiLeftMenu_l3['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
						<ul>
						  <?php
								 $collang_RecordMultiLeftMenu_l4 = "zh-tw";
								if (isset($_GET['lang'])) {
								  $collang_RecordMultiLeftMenu_l4 = $_SESSION['lang'];
								}
								$colsubitem_id_RecordMultiLeftMenu_l4 = "-1";
								if (isset($row_RecordMultiLeftMenu_l3['item_id'])) {
								  $colsubitem_id_RecordMultiLeftMenu_l4 = $row_RecordMultiLeftMenu_l3['item_id'];
								}
								//mysqli_select_db($database_DB_Conn, $DB_Conn);
								$query_RecordMultiLeftMenu_l4 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '3' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l4, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l4, "int"));
								$RecordMultiLeftMenu_l4 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l4) or die(mysqli_error($DB_Conn));
								$row_RecordMultiLeftMenu_l4 = mysqli_fetch_assoc($RecordMultiLeftMenu_l4);
								$totalRows_RecordMultiLeftMenu_l4 = mysqli_num_rows($RecordMultiLeftMenu_l4);
								?>
						  <?php do { ?>
							<li><?php echo $row_RecordMultiLeftMenu_l4['itemname']; ?>
								<?php if ($row_RecordMultiLeftMenu_l4['endnode'] == 'child') { ?>
								<?php 
									$row_RecordAccounts_summonsListType['itemvalue'] = $row_RecordMultiLeftMenu_l4['itemvalue']; 
									$row_RecordAccounts_summonsListType['state'] = $row_RecordMultiLeftMenu_l4['state']; 
									$row_RecordAccounts_summonsListType['level0'] = $row_RecordMultiLeftMenu_l1['itemvalue'];
									require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
									$TotalNowBalanceSelect += $NowBalanceSelect;
								?>
								<div>&nbsp;<!--百分比--></div><div>&nbsp;<!--合計--></div><div><?php echo $NowBalanceSelect; //小計 ?></div>
								<?php } ?>
								<?php if ($row_RecordMultiLeftMenu_l4['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
								<ul>
								  <?php
										 $collang_RecordMultiLeftMenu_l5 = "zh-tw";
										if (isset($_GET['lang'])) {
										  $collang_RecordMultiLeftMenu_l5 = $_SESSION['lang'];
										}
										$colsubitem_id_RecordMultiLeftMenu_l5 = "-1";
										if (isset($row_RecordMultiLeftMenu_l4['item_id'])) {
										  $colsubitem_id_RecordMultiLeftMenu_l5 = $row_RecordMultiLeftMenu_l4['item_id'];
										}
										//mysqli_select_db($database_DB_Conn, $DB_Conn);
										$query_RecordMultiLeftMenu_l5 = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang = %s && level = '4' && subitem_id = %s && indicate = '1' ORDER BY itemvalue ASC, item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l5, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l5, "int"));
										$RecordMultiLeftMenu_l5 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l5) or die(mysqli_error($DB_Conn));
										$row_RecordMultiLeftMenu_l5 = mysqli_fetch_assoc($RecordMultiLeftMenu_l5);
										$totalRows_RecordMultiLeftMenu_l5 = mysqli_num_rows($RecordMultiLeftMenu_l5);
										?>
								  <?php do { ?>
									<li><?php echo $row_RecordMultiLeftMenu_l5['itemname']; ?>
										<?php if ($row_RecordMultiLeftMenu_l5['endnode'] != 'child') { ?>
										<?php 
											$row_RecordAccounts_summonsListType['itemvalue'] = $row_RecordMultiLeftMenu_l5['itemvalue']; 
											$row_RecordAccounts_summonsListType['state'] = $row_RecordMultiLeftMenu_l5['state']; 
											$row_RecordAccounts_summonsListType['level0'] = $row_RecordMultiLeftMenu_l1['itemvalue'];
											require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
											$TotalNowBalanceSelect += $NowBalanceSelect;
										?>
										<div>&nbsp;<!--百分比--></div><div>&nbsp;<!--合計--></div><div><?php echo $NowBalanceSelect; //小計 ?></div><?php } ?>
									</li>
									 <?php if($i%$ChangePageNumber == "0") { echo "</article></section><section class='sheet padding-10mm'><article>"; } ?>
									 <?php $i++; } while ($row_RecordMultiLeftMenu_l5 = mysqli_fetch_assoc($RecordMultiLeftMenu_l5)); ?>
								  <?php mysqli_free_result($RecordMultiLeftMenu_l5);?>
								</ul>
								<?php } // Show if recordset not empty ?>
							</li>
							 <?php if($i%$ChangePageNumber == "0") { echo "</article></section><section class='sheet padding-10mm'><article>"; } ?>
							 <?php $i++; } while ($row_RecordMultiLeftMenu_l4 = mysqli_fetch_assoc($RecordMultiLeftMenu_l4)); ?>
						  <?php mysqli_free_result($RecordMultiLeftMenu_l4);?>
						</ul>
						<?php } // Show if recordset not empty ?>
					</li>
					 <?php if($i%$ChangePageNumber == "0") { echo "</article></section><section class='sheet padding-10mm'><article>"; } ?>
                     <?php $i++; } while ($row_RecordMultiLeftMenu_l3 = mysqli_fetch_assoc($RecordMultiLeftMenu_l3)); ?>
                  <?php mysqli_free_result($RecordMultiLeftMenu_l3);?>
                </ul>
                <?php } // Show if recordset not empty ?>
              </li>
			   <?php if($i%$ChangePageNumber == "0") { echo "</article></section><section class='sheet padding-10mm'><article>"; } ?>
               <?php $i++; } while ($row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2)); ?>
            <?php mysqli_free_result($RecordMultiLeftMenu_l2);?>
          </ul>
          <?php } // Show if recordset not empty ?>
          </li>
	      <?php if($i%$ChangePageNumber == "0") { echo "</article></section><section class='sheet padding-10mm'><article>"; } ?>
          <?php $i++; } while ($row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1)); ?>
</ul>

<?php } // Show if recordset not empty ?>