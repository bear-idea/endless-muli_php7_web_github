
<ul class="nav">
            <li><a href="manage_room.php?wshop=<?php echo $wshop;?>&amp;Opt_Room=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $ModuleName['Room']; ?></a></li> 
            <li><a href="manage_room.php?wshop=<?php echo $wshop;?>&amp;Opt_Room=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增資料</a></li>
            <?php if ($MSRoomQA == '1') { ?>
            <li><a href="manage_room.php?wshop=<?php echo $wshop;?>&amp;Opt_Room=postsearchpage&amp;lang=<?php echo $_SESSION['lang']; ?>">問答紀錄</a></li>
            <?php } ?>
            <li><a href="manage_room.php?wshop=<?php echo $wshop;?>&amp;Opt_Room=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>    
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <li><a href="manage_room.php?wshop=<?php echo $wshop;?>&amp;Opt_Room=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li> 
            <?php } ?>
		</ul> 
    </div>
    <br />
	<?php require_once("require_leftmainmenu_room_list.php"); ?>
<?php //echo $_SESSION['lang']; ?>
