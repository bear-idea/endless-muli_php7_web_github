<?php
	switch($_GET['Opt'])
	{
		case "profitlosslistpage_print":
		    if($_POST['show'] == 'base'){
				include("require_manage_accounts_report_profitlosslist_print_base.php");	
			}else if ($_POST['show'] == 'complex'){
				include("require_manage_accounts_report_profitlosslist_print_complex.php");	
			}	
			break;
		case "balancesheetpage_print":
			include("require_manage_accounts_report_balancesheet_print.php");		
			break;
		default:
			break;
	}
?>