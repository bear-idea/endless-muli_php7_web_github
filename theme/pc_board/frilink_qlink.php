<style type="text/css">
/* 友站連結 */
.div_table-cell_frilinkqlink{overflow:hidden;  margin-left:auto; margin-right:auto;}
.div_table-cell_frilinkqlink{text-align:center; vertical-align:middle; padding-top:2px; padding-bottom:2px;}
.div_table-cell_frilinkqlink hover{}
.div_table-cell_frilinkqlink span{height:100%; display:inline-block; background-image:none; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none}
.div_table-cell_frilinkqlink *{vertical-align:middle}
</style>
<?php if ($totalRows_RecordFrilinkQLinkQLink > 0) { // Show if recordset not empty ?>
<?php $fri_conut=1; ?>
<?php do { ?>
<div class="div_table-cell_frilinkqlink2">
<?php if ($row_RecordFrilinkQLinkQLink['typemenu'] == 'Link') { ?>
	<?php if ($row_RecordFrilinkQLinkQLink['link'] != "" && $row_RecordFrilinkQLinkQLink['link'] != "http://#") { ?>
		<?php if ($row_RecordFrilinkQLinkQLink['modselect'] == "1") { ?>
			<?php if ($row_RecordFrilinkQLinkQLink['pic'] != "") { ?>
            <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
            <?php } else { ?>
            <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl; ?>images/fri_noimage.jpg" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
            <?php } ?>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordFrilinkQLinkQLink['name']; ?></div></a><a href="<?php echo $row_RecordFrilinkQLinkQLink['link']; ?>" target="_blank"><img src="<?php echo $SiteBaseUrl; ?>images/link/<?php echo $row_RecordFrilinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
        <?php } ?>
    <?php } else { ?>
		<?php if ($row_RecordFrilinkQLinkQLink['modselect'] == "1") { ?>
        <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></div>
        <?php } else { ?>
        <div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><div style="position:absolute; width:188px; line-height:30px; text-align:right; color:#FFF; padding:5px; margin-top:20px;"><?php echo $row_RecordFrilinkQLinkQLink['name']; ?></div><img src="<?php echo $SiteBaseUrl; ?>images/link/<?php echo $row_RecordFrilinkQLinkQLink['picname']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></div>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
<div data-scroll-reveal="enter left after <?php echo $fri_conut/10; ?>s"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordFrilinkQLinkQLink['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/frilink/<?php echo $row_RecordFrilinkQLinkQLink['pic']; ?>" alt="<?php echo $row_RecordFrilink['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a></div>
<?php } ?>
</div>
<?php $fri_conut+=2; ?>
<?php } while ($row_RecordFrilinkQLinkQLink = mysqli_fetch_assoc($RecordFrilinkQLinkQLink)); ?>
<!--<div style="text-align:right;"><a href="frilink.php?wshop=<?php //echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php //echo $_SESSION['lang'] ?>">[更多...]</a></div>-->
<?php } ?>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell_frilinkqlink img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>