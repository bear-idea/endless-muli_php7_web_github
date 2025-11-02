
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="可以將您所提供的服務與產品項目做個別並詳細的說明，其中可以包含產品規格或使用說明等，讓您的客戶明確找到所需的產品與服務。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View">產品管理</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增資料</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li>
		</ul> 

  
	<?php //require_once("require_leftmainmenu_commodity_list.php"); ?>
<?php //echo $_SESSION['lang']; ?>
