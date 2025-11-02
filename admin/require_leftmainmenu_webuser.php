
<ul class="nav">
   <?php if($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
    <li><a href="manage_webuser.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-eye"></i><span>網站使用者一覽</span></a></li> 
    <!--<li><a href="manage_webuser.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增使用者</a></li>-->
    <li><a href="manage_webuser.php?wshop=<?php echo $wshop;?>&amp;Opt=modselectpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可依訂製好的模組功能直接新增使用者。" data-toggle="tooltip" data-placement="right"><i class="fa fa-plus"></i><span>新增使用者及自動建立網站</span></a></li>
    <li><a href="manage_webuser.php?wshop=<?php echo $wshop;?>&amp;Opt=qrcode&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="QRCODE。" data-toggle="tooltip" data-placement="right"><i class="fa fa-qrcode"></i><span>登入 QRCODE</span></a></li>
    <?php } ?>
</ul>

