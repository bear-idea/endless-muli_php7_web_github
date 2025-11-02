
<ul class="nav">
            <li><a href="manage_tickets.php?wshop=<?php echo $wshop;?>&amp;Opt_Tickets=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">餐會資料一覽</a></li> 
            <li><a href="manage_tickets.php?wshop=<?php echo $wshop;?>&amp;Opt_Tickets=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增餐會資料</a></li>
            <li><a href="manage_tickets.php?wshop=<?php echo $wshop;?>&amp;Opt_Tickets=multiaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>">快速選擇訂位</a></li>
            <?php if ($ManageTicketsListSelect == '1') { ?>
            <li><a href="manage_tickets.php?wshop=<?php echo $wshop;?>&amp;Opt_Tickets=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li> 
            <?php } ?>
</ul>
<?php //echo $_SESSION['lang']; ?>
