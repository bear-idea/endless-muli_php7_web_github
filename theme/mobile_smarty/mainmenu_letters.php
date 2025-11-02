<?php if ($totalRows_RecordLettersMultiTopMenu_l1 > 0) { ?>
<ul class="dropdown-menu <?php if (((int)$totalRows_RecordDfTypeMultiTopMenu_l1 - (int)$Count_TypeMultiTopMenu) < 2) { ?>pull-right<?php } ?>">
        <?php do { ?>
            <li class="<?php if(isset($row_RecordLettersMultiTopMenu_l1['endnode'])) { echo $row_RecordLettersMultiTopMenu_l1['endnode']; } ?>">
                 <a href="<?php echo $SiteBaseUrl . url_rewrite("letters",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordLettersMultiTopMenu_l1['itemname']; ?>"><?php echo $row_RecordLettersMultiTopMenu_l1['itemname']; ?></a>
            </li>
        <?php } while ($row_RecordLettersMultiTopMenu_l1 = mysqli_fetch_assoc($RecordLettersMultiTopMenu_l1)); ?> 
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordLettersMultiTopMenu_l1);
?>