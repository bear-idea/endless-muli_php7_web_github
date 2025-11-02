
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=typepage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="查看目前所有選單，目前你所能新增的選單至多【<?php echo $Site_DfPage_Limit_Page_Num; ?>】個，此模組同模組連結，僅顯示於不同位置，您可將多餘模組配置於其中。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View">分類選單</span></a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=typeaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="新增主選單項目" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-plus"></i><span id="Step_Add">增修主分類</span></a></li>
            <?php } ?>
             <?php if ($MSHome == '0') {?> 
             <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=startpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="替網站設定起始進入畫面，您必須指定一個選單，否則是不能讀取到目前的網站。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-star"></i><span id="Step_Home">起始首頁設定</span></a></li>
             <?php } ?> 
             
</ul>
