<?php if ($totalRows_RecordProjectMultiTopMenu_l1 > 0) { ?>
<ul class="dropdown-menu <?php if (((int)$totalRows_RecordDfTypeMultiTopMenu_l1 - (int)$Count_TypeMultiTopMenu) < 2) { ?>pull-right<?php } ?>">
        <?php do { ?>
            <li class="<?php if(isset($row_RecordProjectMultiTopMenu_l1['endnode'])) { echo $row_RecordProjectMultiTopMenu_l1['endnode']; } ?>">
                 <a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $type_params; ?><?php echo urlencode($row_RecordProjectMultiTopMenu_l1['itemname']); ?>"><?php echo $row_RecordProjectMultiTopMenu_l1['itemname']; ?></a>
            </li>
        <?php } while ($row_RecordProjectMultiTopMenu_l1 = mysqli_fetch_assoc($RecordProjectMultiTopMenu_l1)); ?> 
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProjectMultiTopMenu_l1);
?>