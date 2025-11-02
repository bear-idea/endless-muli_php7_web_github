
<ul class="nav">
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo "房型資料"; ?></a></li> 
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=gen&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定該月份的房間價格及可訂購的房間，須設定才會啟用使用者該月份的訂購功能。" data-toggle="tooltip" data-placement="right">訂房設定</a></li>
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=sv&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定各個房型該天是否可訂。" data-toggle="tooltip" data-placement="right">訂房保留</a></li>
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=state&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看房間的訂房狀況和該天的訂單。" data-toggle="tooltip" data-placement="right"><span id="Step_MState">訂房狀況</span></a></li>
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=order&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查詢房客的訂單並可設定該訂單的處理狀況。" data-toggle="tooltip" data-placement="right">訂單查詢</a></li>
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=odpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="此為填寫使用者在填寫訂單時的補充說明。" data-toggle="tooltip" data-placement="right">補充說明</a></li>
            <!--<li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=gen_st&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定在啟用房間訂單時的產生條件。" data-toggle="tooltip" data-placement="right">啟用設定</a></li>-->
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：訂單狀態等項目的清單。" data-toggle="tooltip" data-placement="right"><span id="Step_List">次分類設定</span></a></li>
            <li><a href="manage_reserve.php?wshop=<?php echo $wshop;?>&amp;Opt_Reserve=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="是否開啟訂房功能。" data-toggle="tooltip" data-placement="right"><span id="Step_List">功能設定</span></a></li>
		</ul> 
    </div>
    <br />
	<?php //require_once("require_leftmainmenu_room_list.php"); ?>
<?php //echo $_SESSION['lang']; ?>
