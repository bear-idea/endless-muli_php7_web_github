
<ul class="nav">
            <li><a href="manage_otrlink.php?wshop=<?php echo $wshop;?>&amp;Opt_Otrlink=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="採以條列式顯示發布的連結資訊，適用於需要一次顯示較多的連結，例如經銷商、代理商、組織單位的聯結。" data-toggle="tooltip" data-placement="right"><?php echo $ModuleName['Otrlink']; ?></a></li> 
            <li><a href="manage_otrlink.php?wshop=<?php echo $wshop;?>&amp;Opt_Otrlink=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            <?php if ($ManageOtrlinkListSelect == '1') {?>
            <li><a href="manage_otrlink.php?wshop=<?php echo $wshop;?>&amp;Opt_Otrlink=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>
            <?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_otrlink.php?wshop=<?php echo $wshop;?>&amp;Opt_Otrlink=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
