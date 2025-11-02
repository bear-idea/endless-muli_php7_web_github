
<ul class="nav flex-column">

            <?php if ($_GET['Opt'] == 'settingpage_ap' || $_GET['Opt'] == 'viewpage') {?> 
            <li class="menu-item"><a class="menu-link" href="manage_setting.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_ap&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-retweet"></i><span>帳號密碼修改</span></a></li>
            <?php } ?> 
            <?php if ($_GET['Opt'] == 'settingpage_bs') {?> 
            <li class="menu-item"><a class="menu-link" href="manage_setting.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-view"></i><span>網站基本資料</span></a></li>
            <?php } ?> 
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?> 
            <li class="menu-item"><a class="menu-link" href="manage_setting.php?wshop=<?php echo $wshop;?>&amp;Opt=configpage_list&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-list-alt"></i><span>功能分類清單</span></a></li> 
            <li class="menu-item"><a class="menu-link" href="manage_setting.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_list&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list"></i><span>次分類設定</span></a></li>
            <?php } ?> 
           
</ul>
