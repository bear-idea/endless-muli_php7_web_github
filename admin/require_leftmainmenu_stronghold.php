
<ul class="nav">
            <li><a href="manage_stronghold.php?wshop=<?php echo $wshop;?>&amp;Opt_Stronghold=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="會在Google Map 標示公司的資訊，並在在地圖中檢視全部商家地點，適用於有多個營運處、子公司等等...。" data-toggle="tooltip" data-placement="right"><?php echo $ModuleName['Stronghold']; ?></a></li> 
            <li><a href="manage_stronghold.php?wshop=<?php echo $wshop;?>&amp;Opt_Stronghold=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            <?php if ($ManageStrongholdListSelect == '1') {?>
            <li><a href="manage_stronghold.php?wshop=<?php echo $wshop;?>&amp;Opt_Stronghold=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>
            <?php } ?>
            <li><a href="manage_stronghold.php?wshop=<?php echo $wshop;?>&amp;Opt_Stronghold=settingpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此設定您的地圖中心位置及地圖縮放層級。" data-toggle="tooltip" data-placement="right">參數設定</a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_stronghold.php?wshop=<?php echo $wshop;?>&amp;Opt_Stronghold=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
