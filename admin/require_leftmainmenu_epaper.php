
<ul class="nav">
    <li><a href="manage_epaper.php?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $ModuleName['EPaper']; ?></a></li> 
    <li><a href="manage_epaper.php?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
    <li><a href="manage_epaper.php?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=mailpage&amp;lang=<?php echo $_SESSION['lang']; ?>">郵件列表</a></li>
    <?php //if ($ManageEPaperListSelect == '1') { ?>
    <li><a href="manage_epaper.php?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li> 
    <?php //} ?>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
    <li><a href="manage_epaper.php?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
    <?php } ?>
</ul>


