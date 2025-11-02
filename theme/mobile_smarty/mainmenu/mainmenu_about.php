<?php if ($totalRows_RecordAboutMultiTopMenu_l1 > 0) { ?>
<ul class="dropdown-menu <?php if (((int)$totalRows_RecordDfTypeMultiTopMenu_l1 - (int)$Count_TypeMultiTopMenu) < 2) { ?>pull-right<?php } ?>">
        <?php do { ?>
            <li class="<?php if(isset($row_RecordAboutMultiTopMenu_l1['endnode'])) { echo $row_RecordAboutMultiTopMenu_l1['endnode']; } ?>">
                 <a href="<?php echo $SiteBaseUrl . url_rewrite("about",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordAboutMultiTopMenu_l1['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordAboutMultiTopMenu_l1['title']; ?></a>
            </li>
        <?php } while ($row_RecordAboutMultiTopMenu_l1 = mysqli_fetch_assoc($RecordAboutMultiTopMenu_l1)); ?> 
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordAboutMultiTopMenu_l1);
?>