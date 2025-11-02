<style type="text/css">
.div_table-cell_modlinkqlink{overflow:hidden; height:60px; width:198px; margin-left:auto; margin-right:auto;}
.div_table-cell_modlinkqlink{text-align:center; vertical-align:middle; padding-top:2px; padding-bottom:2px;}
.div_table-cell_modlinkqlink hover{}
.div_table-cell_modlinkqlink span{height:100%; display:inline-block; background-image:none; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none}
.div_table-cell_modlinkqlink *{vertical-align:middle}
</style>
<?php if ($totalRows_RecordModlinkQLinkQLink > 0) { // Show if recordset not empty ?>
<?php $mod_conut=1; ?>
<?php do { ?>
<div class="div_table-cell_modlinkqlink">
<?php if ($row_RecordModlinkQLinkQLink['typemenu'] == 'Link') { ?>1
<div data-scroll-reveal="enter left after <?php echo $mod_conut/10;?>s"><a href="<?php echo $row_RecordModlinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
<?php } else if($row_RecordModlinkQLinkQLink['typemenu'] == 'Cart_Pay'){ ?>
    <?php if ($row_RecordModlinkQLinkQLink['modselect'] == "1") { ?>
		<?php if ($row_RecordModlinkQLinkQLink['pic'] != "") { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><img src="images/fri_noimage.jpg" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } ?>
    <?php } else { ?>
    <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordModlinkQLinkQLink['name']; ?></div></a><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><img src="images/link/<?php echo $row_RecordModlinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
    <?php } ?>
<?php } else if($row_RecordModlinkQLinkQLink['typemenu'] == 'Cart_Note'){ ?>
    <?php if ($row_RecordModlinkQLinkQLink['modselect'] == "1") { ?>
		<?php if ($row_RecordModlinkQLinkQLink['pic'] != "") { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><img src="images/fri_noimage.jpg" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } ?>
    <?php } else { ?>
    <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordModlinkQLinkQLink['name']; ?></div></a><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><img src="images/link/<?php echo $row_RecordModlinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
    <?php } ?>
<?php } else { ?>
	<?php if ($row_RecordModlinkQLinkQLink['modselect'] == "1") { ?>
		<?php if ($row_RecordModlinkQLinkQLink['pic'] != "") { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/modlink/<?php echo $row_RecordModlinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="images/fri_noimage.jpg" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } ?>
    <?php } else { ?>
    <div data-scroll-reveal="enter left after <?php echo $mod_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>>"><div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordModlinkQLinkQLink['name']; ?></div></a><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordModlinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="images/link/<?php echo $row_RecordModlinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordModlink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
    <?php } ?>
<?php } ?>
</div>
<?php $mod_conut++; ?>
<?php } while ($row_RecordModlinkQLinkQLink = mysqli_fetch_assoc($RecordModlinkQLinkQLink)); ?>
<?php } ?>
<div style="clear:both"></div>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>