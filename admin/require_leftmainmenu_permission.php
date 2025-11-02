
<ul class="nav">
    <li><a href="manage_permission.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right"><i class="fa fa-eye"></i><span id="Step_View">權限設定</span></a></li> 
    <li><a href="manage_permission.php?wshop=<?php echo $wshop;?>&amp;Opt=rulepage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right"><i class="fa fa-cog"></i><span id="Step_View">權限規則</span></a></li> 
    <li><a href="manage_permission.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_rule&amp;lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-plus"></i><span id="Step_Add">新增規則</span></a></li>
    <li><a href="manage_permission.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage_group&amp;lang=<?php echo $_SESSION['lang']; ?>&list_id=1"><i class="fa fa-users"></i><span id="Step_Add">群組(Group)</span></a></li>
    <li><a href="manage_permission.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&list_id=2"><i class="fa fa-unlock-alt"></i><span id="Step_Add">權限類別(GroupType)</span></a></li>
    <?php //if ($ManageNewsListSelect == '1') { ?>
    <!--<li><a href="manage_permission.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right"><i class="fa fa-list-ul"></i><span id="Step_List">次分類設定</span></a></li> -->
    <?php //} ?>
</ul>


