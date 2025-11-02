
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="會計模組的主要作業，不論開帳、拋轉或自行建立的傳票皆建立於此作業" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View">會計傳票</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="新增空白傳票" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-plus"></i><span id="Step_Add">新增資料</span></a></li>
            <?php if($_SESSION['MM_UserGroup'] == 'superadmin' || $_SESSION['MM_UserGroup'] == 'subadmin') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=checkpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-check"></i><span id="Step_Add">會計審核</span></a></li>
            <?php } ?>
            <li class="menu-item"><a class="menu-link" href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：傳票類別、會計項目等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li>
	        <li class="menu-item"><a class="menu-link" href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=print_select&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-print"></i><span id="Step_List">傳票列印</span></a></li>
		</ul> 

  
	<?php //require_once("require_leftmainmenu_commodity_list.php"); ?>
<?php //echo $_SESSION['lang']; ?>
