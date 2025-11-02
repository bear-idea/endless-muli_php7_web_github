
<ul class="nav flex-column">
    <li class="menu-item"><a class="menu-link" href="manage_searchdata.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View">Mail搜尋</span></a></li>
    <?php //if ($ManageNewsListSelect == '1') { ?>
    <li class="menu-item"><a class="menu-link" href="manage_searchdata.php?wshop=<?php echo $wshop;?>&amp;Opt=mergepage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-clone"></i><span id="Step_List">群組合併</span></a></li>
    <li class="menu-item"><a class="menu-link" href="manage_searchdata.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li>
    <?php //} ?>
</ul>


