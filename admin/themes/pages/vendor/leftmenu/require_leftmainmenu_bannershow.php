
<ul class="nav flex-column"> 
            <li class="menu-item"><a class="menu-link" href="manage_bannershow.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="採以目前最夯的 Water Flow 排列方式來展示您的圖片，並可以設定分類項目，適用於展示作品、活動花絮之類的功能。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span>範例橫幅</span></a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?><li class="menu-item"><a class="menu-link" href="manage_bannershow.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span>新增資料</span></a></li><?php } ?>
            
</ul>
<?php //echo $_SESSION['lang']; ?>
