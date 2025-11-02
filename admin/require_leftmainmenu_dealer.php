
<ul class="nav">
            <li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $ModuleName['Dealer']; ?></a></li> 
            <?php if  ($ManageDealerAvatarSelect == '1') {?>
           <li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=addpagepureupload&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            <?php } else {?> 
           <!-- <li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=addpagepic&amp;lang=<?php //echo $_SESSION['lang']; ?>">新增(含頭像)</a></li>-->
             <li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
             <?php } ?> 
             <?php if ($ManageDealerMultiAddSelect == '1') { ?>
             <li><a href="dealer_csvUpload.php" target="_blank">多筆資料新增</a></li>
             <?php } ?>
            <!--<li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>-->
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
            <li><a href="manage_dealer.php?wshop=<?php echo $wshop;?>&amp;Opt_Dealer=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>">功能設定</a></li> 
            
</ul>
<?php //echo $_SESSION['lang']; ?>
