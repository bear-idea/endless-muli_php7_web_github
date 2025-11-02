<?php if ($totalRows_RecordRoomMultiTopMenu_l1 > 0) { ?>
<ul class="dropdown-menu <?php if (((int)$totalRows_RecordDfTypeMultiTopMenu_l1 - (int)$Count_TypeMultiTopMenu) < 2) { ?>pull-right<?php } ?>">
        <?php do { ?>
            <li class="<?php if(isset($row_RecordRoomMultiTopMenu_l1['endnode'])) { echo $row_RecordRoomMultiTopMenu_l1['endnode']; } ?>">
                 <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordRoomMultiTopMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordRoomMultiTopMenu_l1['itemname']; ?></a>
            </li>
        <?php } while ($row_RecordRoomMultiTopMenu_l1 = mysqli_fetch_assoc($RecordRoomMultiTopMenu_l1)); ?> 
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordRoomMultiTopMenu_l1);
?>