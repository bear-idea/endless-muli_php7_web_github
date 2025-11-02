
<ul class="nav">
            <li><a href="manage_timeline.php?wshop=<?php echo $wshop;?>&amp;Opt_Timeline=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="此模組可放置圖片、影片、文字並以時間軸的方式顯示在畫面上，適合用於作品展示實積展示，例如攝影、繪圖、建築之類之網站適用。" data-toggle="tooltip" data-placement="right"><?php echo $ModuleName['Timeline']; ?></a></li> 
            <li><a href="manage_timeline.php?wshop=<?php echo $wshop;?>&amp;Opt_Timeline=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_timeline.php?wshop=<?php echo $wshop;?>&amp;Opt_Timeline=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
