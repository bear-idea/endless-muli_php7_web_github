
<ul class="nav">
    <li><a href="manage_searchdata.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right"><i class="fa fa-eye"></i><span id="Step_View">Mail搜尋</span></a></li> 
    <?php //if ($ManageNewsListSelect == '1') { ?>
    <li><a href="manage_searchdata.php?wshop=<?php echo $wshop;?>&amp;Opt=mergepage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right"><i class="fa fa-clone"></i><span id="Step_List">群組合併</span></a></li> 
    <li><a href="manage_searchdata.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li> 
    <?php //} ?>
</ul>


