
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="瀏覽者可以和管理者作互動，在版上留言提出問題和回答。" data-bs-toggle="tooltip" data-bs-placement="right"><?php echo $ModuleName['Guestbook']; ?></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增主題</a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li class="menu-item"><a class="menu-link" href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
