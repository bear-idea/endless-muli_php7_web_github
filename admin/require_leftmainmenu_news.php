
<ul class="nav">
    <li><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可利用此公佈最新活動訊息文章，也可上傳圖片，增加網站可看性及易讀性。" data-toggle="tooltip" data-placement="right"><i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['News']; ?></span></a></li> 
    <li><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增資料</span></a></li>
    <li><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=seo&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fas fa-heartbeat"></i><span id="Step_Add">SEO優化</span></a></li>
    <?php if ($MSNewsQA == '1' || $_SESSION['MM_UserGroup'] == 'superadmin') { ?>
    <li><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=searchpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-comments"></i><span>問答紀錄</span></a></li>
    <?php } ?>
    <?php //if ($ManageNewsListSelect == '1') { ?>
    <li><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li> 
    <?php //} ?>
</ul>


