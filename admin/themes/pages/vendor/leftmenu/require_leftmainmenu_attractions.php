
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_attractions.php?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $ModuleName['Attractions']; ?></a></li> 
            <li class="menu-item"><a class="menu-link" href="manage_attractions.php?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            <?php //if ($ManageAttractionsListSelect == '1') {?>
            <li class="menu-item"><a class="menu-link" href="manage_attractions.php?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right">次分類設定</a></li>
            <?php //} ?>
            <li class="menu-item"><a class="menu-link" href="manage_attractions.php?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=gapi&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="設置Google Map API 金鑰。" data-bs-toggle="tooltip" data-bs-placement="right"><span id="Step_List">API參數</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_attractions.php?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=settingpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此設定您的地圖中心位置及地圖縮放層級。" data-bs-toggle="tooltip" data-bs-placement="right">參數設定</a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li class="menu-item"><a class="menu-link" href="manage_attractions.php?wshop=<?php echo $wshop;?>&amp;Opt_Attractions=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
