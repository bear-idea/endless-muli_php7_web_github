
<ul class="nav">
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可以將您所提供的服務與產品項目做個別並詳細的說明，其中可以包含產品規格或使用說明等，讓您的客戶明確找到所需的產品與服務。" data-toggle="tooltip" data-placement="right"><i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['Product']; ?></span></a></li>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增資料</span></a></li>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=seo&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fas fa-heartbeat"></i><span id="Step_Add">SEO優化</span></a></li>
            <?php if ($OptionCartSelect == '1') { ?>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=postsearchpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-comments"></i><span>問答紀錄</span></a></li>
            <?php } ?>
            
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { ?>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=inventory&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="商品庫存設定" data-toggle="tooltip" data-placement="right"><i class="fa fa-clipboard"></i><span>庫存檢視</span></a></li>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=pricecheck&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="確認目前價格審核狀態及修改價格" data-toggle="tooltip" data-placement="right"><i class="fa fa-dollar-sign"></i><span>價格審核</span></a></li>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=pricecheck_st&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="在新增商品時是否要審核價格後消費者才行購買" data-toggle="tooltip" data-placement="right"><i class="fa fa-pound-sign"></i><span>價格審核設定</span></a></li>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=chinesetoid&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="將分類轉換為ID" data-toggle="tooltip" data-placement="right"><i class="fa fa-exclamation"></i><span>分類轉ID</span></a></li>
            <?php } ?>
            <li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=datachange&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="將商品資料移動到不同分類" data-toggle="tooltip" data-placement="right"><i class="fa fa-exchange-alt"></i><span>資料轉移</span></a></li>
		</ul> 

  
	<?php //require_once("require_leftmainmenu_product_list.php"); ?>
<?php //echo $_SESSION['lang']; ?>
