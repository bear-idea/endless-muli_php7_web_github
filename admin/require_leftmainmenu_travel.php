
<ul class="nav">
            <li><a href="manage_travel.php?wshop=<?php echo $wshop;?>&amp;Opt_Travel=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">旅遊景點</a></li> 
            <li><a href="manage_travel.php?wshop=<?php echo $wshop;?>&amp;Opt_Travel=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
             <li><a href="travel_csvUpload.php" target="_blank">多筆新增</a></li>
            <li><a href="manage_travel.php?wshop=<?php echo $wshop;?>&amp;Opt_Travel=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_travel.php?wshop=<?php echo $wshop;?>&amp;Opt_Travel=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
