
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_website.php?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">網站資訊一覽</a></li> 
            <li class="menu-item"><a class="menu-link" href="manage_website.php?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增網站資訊</a></li>
            <?php if ($ManageWebSiteListSelect == '1') {?>
            <li class="menu-item"><a class="menu-link" href="manage_website.php?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right">次分類設定</a></li>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li class="menu-item"><a class="menu-link" href="manage_website.php?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li class="menu-item"><a class="menu-link" href="manage_website.php?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=chartpage&amp;lang=<?php echo $_SESSION['lang']; ?>">圖表統計</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
