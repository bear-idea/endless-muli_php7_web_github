<style type="text/css">
.div_mod_modlinkqlink{position:absolute; line-height:30px; text-align:right; color:#FFF;  margin-top:20px; padding:5px; right:20px;}
@media (min-width: 1200px){.div_mod_modlinkqlink{ margin-top:30px;}}
</style>
<?php if ($totalRows_RecordModlinkQLinkQLink > 0) { // Show if recordset not empty ?>
<?php $mod_conut=1; ?>
<?php do { ?>
<div class="div_table-cell_modlinkqlink">
<?php if ($row_RecordModlinkQLinkQLink['typemenu'] == 'Link') { ?>
<div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $row_RecordModlinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
<?php } else if($row_RecordModlinkQLinkQLink['typemenu'] == 'Cart_Note'){ ?>
    <?php if ($row_RecordModlinkQLinkQLink['modselect'] == "1") { ?>
		<?php if ($row_RecordModlinkQLinkQLink['pic'] != "") { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl?>images/fri_noimage.jpg" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
        <?php } ?>
    <?php } else { ?>
    <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><div class="div_mod_modlinkqlink"><?php echo $row_RecordModlinkQLinkQLink['name']; ?></div></a><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl?>images/link/<?php echo $row_RecordModlinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordModlinkQLinkQLink['sdescription']; ?>" class="img-responsive"/></a></div>
    <?php } ?>
<?php } else if($row_RecordModlinkQLinkQLink['typemenu'] == 'Cart_Pay'){ ?>
    <?php if ($row_RecordModlinkQLinkQLink['modselect'] == "1") { ?>
		<?php if ($row_RecordModlinkQLinkQLink['pic'] != "") { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl?>images/fri_noimage.jpg" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
        <?php } ?>
    <?php } else { ?>
    <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><div class="div_mod_modlinkqlink"><?php echo $row_RecordModlinkQLinkQLink['name']; ?></div></a><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl?>images/link/<?php echo $row_RecordModlinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordModlinkQLinkQLink['sdescription']; ?>" class="img-responsive"/></a></div>
    <?php } ?>
<?php } else { ?>
	<?php if ($row_RecordModlinkQLinkQLink['modselect'] == "1") { ?>
		<?php if ($row_RecordModlinkQLinkQLink['pic'] != "") { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="images/fri_noimage.jpg" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
        <?php } ?>
    <?php } else { ?>
    <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><div class="div_mod_modlinkqlink"><?php echo $row_RecordModlinkQLinkQLink['name']; ?></div></a><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl?>images/link/<?php echo $row_RecordModlinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" class="img-responsive"/></a></div>
    <?php } ?>
<?php } ?>
</div>
<?php $mod_conut++; ?>
<?php } while ($row_RecordModlinkQLinkQLink = mysqli_fetch_assoc($RecordModlinkQLinkQLink)); ?>
<?php } ?>