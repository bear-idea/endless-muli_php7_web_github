
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_album.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-eye"></i><span><?php echo $ModuleName['Album']; ?></span></a></li> 
            <li class="menu-item"><a class="menu-link" href="manage_album.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增主題</span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_album.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li>
</ul>
<?php //echo $_SESSION['lang']; ?>
