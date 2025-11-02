<?php if ($totalRows_RecordFrilinkQLinkQLink > 0) { // Show if recordset not empty ?>
<style type="text/css">
.div_mod_frilinkqlink{position:absolute; line-height:30px; text-align:right; color:#FFF;  margin-top:20px; padding:5px; right:20px;}
@media (min-width: 1200px){.div_mod_frilinkqlink{ margin-top:30px;}}
</style>
<?php $fri_conut=1; ?>
<?php do { ?>
<div class="div_table-cell_frilinkqlink" style="position:relative">
<?php if ($row_RecordFrilinkQLinkQLink['typemenu'] == 'Link') { ?>
	<?php if ($row_RecordFrilinkQLinkQLink['link'] != "" && $row_RecordFrilinkQLinkQLink['link'] != "http://#") { ?>
		<?php if ($row_RecordFrilinkQLinkQLink['modselect'] == "1") { ?>
			<?php if ($row_RecordFrilinkQLinkQLink['pic'] != "") { ?>
            <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>"  class="img-responsive"/></a></div>
            <?php } else { ?>
            <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl; ?>images/fri_noimage.jpg" alt="<?php echo $row_RecordFrilink['sdescription']; ?>"   class="img-responsive"/></a></div>
            <?php } ?>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><div class="div_mod_frilinkqlink"><?php echo $row_RecordFrilinkQLinkQLink['name']; ?></div></a><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl; ?>images/link/<?php echo $row_RecordFrilinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>"  class="img-responsive"/></a></div>
        <?php } ?>
    <?php } else { ?>
		<?php if ($row_RecordFrilinkQLinkQLink['modselect'] == "1") { ?>
        <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>"  class="img-responsive"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><div class="div_mod_frilinkqlink"><?php echo $row_RecordFrilinkQLinkQLink['name']; ?></div><img src="<?php echo $SiteBaseUrl; ?>images/link/<?php echo $row_RecordFrilinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>"  class="img-responsive"/></a></div>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
<div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordFrilinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" class="img-responsive"/></a></div>
<?php } ?>
</div>
<?php $fri_conut+=2; ?>
<?php } while ($row_RecordFrilinkQLinkQLink = mysqli_fetch_assoc($RecordFrilinkQLinkQLink)); ?>
<!--<div style="text-align:right;"><a href="frilink.php?wshop=<?php //echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php //echo $_SESSION['lang'] ?>">[更多...]</a></div>-->
<?php } ?>