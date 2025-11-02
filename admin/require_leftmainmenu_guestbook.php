
<ul class="nav">
            <li><a href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="瀏覽者可以和管理者作互動，在版上留言提出問題和回答。" data-toggle="tooltip" data-placement="right"><?php echo $ModuleName['Guestbook']; ?></a></li> 
            <li><a href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增主題</a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
