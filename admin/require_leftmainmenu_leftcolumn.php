
<ul class="nav">
	<li><a href="manage_leftcolumn.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定網頁欄位區塊所要放置的功能" data-toggle="tooltip" data-placement="right"><i class="fa fa-eye"></i><span>欄位設定</span></a></li>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $Tmp_Column_Plus_Limit == '1') { ?>
    <li><a href="manage_leftcolumn.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn_plus&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定網頁欄位區塊(+)所要放置的功能" data-toggle="tooltip" data-placement="right"><i class="fa fa-eye"></i><span>欄位設定(+)</span></a></li> 
    <?php } ?> 
            <!--<li><a href="manage_leftcolumn.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_column_step_map&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可以依著步驟點選連結來建立您的欄位" data-toggle="tooltip" data-placement="right">步驟地圖</a></li>-->         
            
</ul>
