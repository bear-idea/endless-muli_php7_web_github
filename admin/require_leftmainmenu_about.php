
<ul class="nav">
    <li>
        <a href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可在此說明產品特色，競爭優勢，闡述經營理念，公司沿革等等資訊，讓來到您網站的客戶或使用者對您有夠進一步的瞭解。" data-toggle="tooltip" data-placement="right">
            <i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['About']; ?></span>
        </a>
    </li>
    <li>
        <a href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
            <i class="fa fa-plus"></i><span>新增資料</span>
        </a>
    </li>
    <li>
        <a href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=startpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="替目前選單設定起始頁，您必須選定一個頁面內容，否則該選單是不會抓取到頁面。" data-toggle="tooltip" data-placement="right">
            <i class="fa fa-star"></i><span id="Step_Home">起始頁設定</span>
        </a>
    </li>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
    <li>
        <a href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">
            <i class="fa fa-list-ul"></i><span>次分類設定</span>
        </a>
    </li>
    <?php } ?>
</ul>

<?php require_once("require_leftmainmenu_about_list.php"); ?>