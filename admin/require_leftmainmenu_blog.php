
<ul class="nav">
            <li><a href="manage_blog.php?wshop=<?php echo $wshop;?>&amp;Opt_Blog=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">文章一覽</a></li>
			
            <li><a href="manage_blog.php?wshop=<?php echo $wshop;?>&amp;Opt_Blog=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增文章</a></li>
            
            <li><a href="manage_blog.php?wshop=<?php echo $wshop;?>&amp;Opt_Blog=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>
			 <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
             <!--<li><a href="blog_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_small" data-original-title="首頁設定">首頁設定</a></li>-->
            
            <li><a href="manage_blog.php?wshop=<?php echo $wshop;?>&amp;Opt_Blog=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>" >後台參數設定</a></li> 
                    
            <?php } ?>
            
</ul><br />

<?php require_once("require_leftmainmenu_blog_list.php"); ?>
<br />

<?php //require_once("require_leftmainmenu_blog_alllist.php"); ?>
