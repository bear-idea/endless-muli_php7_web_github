
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="在此上傳您橫幅所用之圖片(公版橫幅)" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-clone"></i><span>內頁橫幅輪播</span></a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || ($OptionTmpSelect == '1' && $OptionTmpHomeSelect == '1')) { ?>
            <li class="menu-item"><a class="menu-link" href="manage_ads_home_image.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="為網站首頁之橫幅輪播圖" data-bs-toggle="tooltip" data-bs-placement="right"><i class="far fa-clone"></i><span>首頁橫幅輪播</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_ads_content_image.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="為網站區塊區之橫幅輪播圖管理，此區為【版型設計】之【首頁版型設定】的【功能區塊】所加入之【橫幅區塊】，您可在此統一管理" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-cubes"></i><span>區塊橫幅輪播</span></a></li>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || ($OptionTmpSelect == '1' && $OptionMobileSelect == '1')) { ?>
            <!--<li class="menu-item"><a class="menu-link" href="manage_ads_mobile_image.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">首頁橫幅輪播(行動裝置)</a></li> -->
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span>次分類設定</span></a></li>
            <?php } ?>
</ul>
