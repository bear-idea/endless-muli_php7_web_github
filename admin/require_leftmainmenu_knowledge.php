
<ul class="nav">
    <li>
        <a href="manage_knowledge.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可自訂分類，並可編輯整頁內容，適用於新聞資訊、產品訊息等功能。" data-toggle="tooltip" data-placement="right">
            <i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['Knowledge']; ?></span>
        </a>
    </li>
    <li>
        <a href="manage_knowledge.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
            <i class="fa fa-plus"></i><span>新增資料</span>
        </a>
    </li>
    <?php //if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
    <li>
        <a href="manage_knowledge.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">
            <i class="fa fa-list-ul"></i><span>次分類設定</span>
        </a>
    </li>
    <?php //} ?>
</ul>
