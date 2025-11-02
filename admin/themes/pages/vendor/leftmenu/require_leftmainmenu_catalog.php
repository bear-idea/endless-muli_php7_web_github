
<ul class="nav flex-column">
            <li class="menu-item"><a class="menu-link" href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="會依所上傳的檔案以圖示顯示(PDF,WORD,EXCEL,圖片)，並提供下載，適用於型錄、資料分享等等...。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span id="Step_View"><?php echo $ModuleName['Catalog'] ?></span></a></li>
            <li class="menu-item"><a class="menu-link" href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_s&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span>新增資料</span></a></li>
            <?php //if ($ManageCatalogListSelect == '1') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list-ul"></i><span>次分類設定</span></a></li>
            <?php //} ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
