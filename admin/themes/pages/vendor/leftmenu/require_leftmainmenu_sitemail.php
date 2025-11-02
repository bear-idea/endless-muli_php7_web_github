
<ul class="nav flex-column">
    <li class="menu-item"><a class="menu-link" href="manage_sitemail.php?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">站內信件</a></li> 
	<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
    <li class="menu-item"><a class="menu-link" href="manage_sitemail.php?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=draftpage&amp;lang=<?php echo $_SESSION['lang']; ?>">編寫草稿</a></li> 
    <li class="menu-item"><a class="menu-link" href="manage_sitemail.php?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=backuppage&amp;lang=<?php echo $_SESSION['lang']; ?>">寄件備份</a></li> 
    <li class="menu-item"><a class="menu-link" href="manage_sitemail.php?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=sendpage&amp;lang=<?php echo $_SESSION['lang']; ?>">發送信件</a></li> 
    <li class="menu-item"><a class="menu-link" href="manage_sitemail.php?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right">次分類設定</a></li>
    <?php } ?>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
    <li class="menu-item"><a class="menu-link" href="manage_sitemail.php?wshop=<?php echo $wshop;?>&amp;Opt_Sitemail=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
    <?php } ?>
</ul>


