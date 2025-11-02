
<ul class="nav">
            <li><a href="manage_contact.php?wshop=<?php echo $wshop;?>&amp;Opt_Contact=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">聯絡我們</a></li>
			
            <li><a href="manage_contact.php?wshop=<?php echo $wshop;?>&amp;Opt_Contact=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增文章</a></li>
            
            <li><a href="manage_contact.php?wshop=<?php echo $wshop;?>&amp;Opt_Contact=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li> 
             <li><a href="contact_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_small" data-original-title="首頁設定">首頁設定</a></li> 
             
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?> 
            <li><a href="manage_contact.php?wshop=<?php echo $wshop;?>&amp;Opt_Contact=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>" >後台參數設定</a></li> 
                    
            <?php } ?>
            
</ul><br />

<?php require_once("require_leftmainmenu_contact_list.php"); ?>
