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


if($_POST['year'] != "" && $_POST['month'] != "") {
	$dt = new DateTime($_POST['year']."-".$_POST['month']);
	$dt->modify('first day of this month');
	$search_startdate = $dt->format('Y-m-d');
	
	$dt = new DateTime($_POST['year']."-".$_POST['month']);
	$dt->modify('last day of this month');
	$search_enddate = $dt->format('Y-m-d');
}
?>

<?php 
		// 設定變數
		// 多少筆換下一業
		// echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) 最後一筆
		$ChangePageNumber = 35;
		?>
    
        <?php $i = 0; ?>
        <?php //do { ?>
    	<?php //if($i%$ChangePageNumber == "0") { ?>
        <section class="sheet padding-10mm">
        <article>
        <?php //} ?>
        <?php //if($i%$ChangePageNumber == "0") { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <thead style="display:table-header-group;font-weight:bold">  
          <tr>
            <td colspan="4" style="text-align:center">綜合損益表</td>
          </tr>
          <tr>
            <td><?php echo $search_startdate; ?> ~  <?php echo $search_enddate; ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>項目</td>
            <td>小計</td>
            <td>合計</td>
            <td>百分比</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          </thead>  
		  <?php //} ?>
          <?php 
		  		// 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
			    // 營業收入項目幾個 
			    require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_operating_profit.php");
		  ?>
        <?php //if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordSplit-1) { ?>
        
          <tr>
            <td>
			<?php 
			    $itemvalue = '4';
				require("require_manage_accounts_report_profitlosslist_print_get_type.php");  
				echo $row_RecordAccounts_summonsListTypeGetItemID['itemname']; 
			?>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>
			<?php 
			    $itemvalue = '41';
				require("require_manage_accounts_report_profitlosslist_print_get_type.php");  
				echo $row_RecordAccounts_summonsListTypeGetItemID['itemname']; 
			?>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>
			<?php 
			    $itemvalue = '411';
				require("require_manage_accounts_report_profitlosslist_print_get_type.php");  
				echo $row_RecordAccounts_summonsListTypeGetItemID['itemname']; 
				//echo $totalRows_RecordAccounts_summonsListType;
			?>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <?php do { ?>
          <tr>
            <td><?php echo $row_RecordAccounts_summonsListType['itemname'] ?></td>
            <td>
			 <?php
	                //$row_RecordAccounts_summonsListType['itemvalue'];
			 		require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
			 		echo $NowBalanceSelect; 
			 ?>
            </td>
            <td></td>
            <td></td>
          </tr>
          <?php } while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType)); ?>
          
          <tr>
            <td>
			<?php 
			    $itemvalue = '412';
				require("require_manage_accounts_report_profitlosslist_print_get_type.php");  
				echo $row_RecordAccounts_summonsListTypeGetItemID['itemname']; 
				//echo $totalRows_RecordAccounts_summonsListType;
			?>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <?php do { ?>
          <tr>
            <td><?php echo $row_RecordAccounts_summonsListType['itemname'] ?></td>
            <td>
			 <?php
			 		require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
			 		echo $NowBalanceSelect; 
			 ?>
            </td>
            <td></td>
            <td></td>
          </tr>
          <?php } while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType)); ?>
          
          <tr>
            <td>
			<?php 
			    $itemvalue = '413';
				require("require_manage_accounts_report_profitlosslist_print_get_type.php");  
				echo $row_RecordAccounts_summonsListTypeGetItemID['itemname']; 
				//echo $totalRows_RecordAccounts_summonsListType;
			?>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <?php do { ?>
          <tr>
            <td><?php echo $row_RecordAccounts_summonsListType['itemname'] ?></td>
            <td>
			 <?php
			 		require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
			 		echo $NowBalanceSelect; 
			 ?>
            </td>
            <td></td>
            <td></td>
          </tr>
          <?php } while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType)); ?>
          
          <tr>
            <td>
			<?php 
			    $itemvalue = '414';
				require("require_manage_accounts_report_profitlosslist_print_get_type.php");  
				echo $row_RecordAccounts_summonsListTypeGetItemID['itemname']; 
				//echo $totalRows_RecordAccounts_summonsListType;
			?>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <?php do { ?>
          <tr>
            <td><?php echo $row_RecordAccounts_summonsListType['itemname'] ?></td>
            <td>
			 <?php
			 		require("require_manage_accounts_report_profitlosslist_print_get_trialbalance.php"); 
			 		echo $NowBalanceSelect; 
			 ?>
            </td>
            <td></td>
            <td></td>
          </tr>
          <?php } while ($row_RecordAccounts_summonsListType = mysqli_fetch_assoc($RecordAccounts_summonsListType)); ?>
        <tfoot>
        <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td colspan="4" style="text-align:right">年終結算日 <?php echo $_POST['particularyear']+1 . "-01" . "-01";?></td>
          </tr>
        </tfoot>
        </table>
			<?php require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_all.php"); ?>
        <?php //} ?>

        
        
        
        
			<?php //if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordSplit-1) { ?>
            </article>
            </section>
            <?php //} ?>
            
            <?php //$i++; ?>
           
		  <?php //} while ($row_RecordSplit = mysqli_fetch_assoc($RecordSplit)); ?>