
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="可自行做連結相關友站，以圖片顯示，增加網站可看性及易讀性，此功能顯示於網站側邊，設定完後請至【自訂欄位】中加入/移除顯示。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['Frilink']; ?></span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_s&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增資料</span></a></li>
            <?php //if ($ManageFrilinkListSelect == '1') {?>
            <li class="menu-item"><a class="menu-link" href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li>
            <?php //} ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
            <!--<li class="menu-item"><a class="menu-link" href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_step_map&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可以依著步驟點選連結來建立您的外部連結" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-map"></i><span>步驟地圖</span></a></li>-->
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
