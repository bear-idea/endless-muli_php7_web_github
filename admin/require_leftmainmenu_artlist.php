
<ul class="nav"> 
            <li><a href="manage_artlist.php?wshop=<?php echo $wshop;?>&amp;Opt_Artlist=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可上傳圖片，以條列式顯示，並可自定分類，適用於活動海報、展演活動、產品發布等等...。" data-toggle="tooltip" data-placement="right"><?php echo $ModuleName['Artlist']; ?></a></li> 
            <li><a href="manage_artlist.php?wshop=<?php echo $wshop;?>&amp;Opt_Artlist=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            <?php //if ($ManageArtlistListSelect == '1') { ?>
            <li><a href="manage_artlist.php?wshop=<?php echo $wshop;?>&amp;Opt_Artlist=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li> 
            <?php //} ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_artlist.php?wshop=<?php echo $wshop;?>&amp;Opt_Artlist=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
