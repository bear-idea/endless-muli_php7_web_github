<style>
.icon_block div, .icon_wrapper {
    text-align: center;
}
.badge.badge-corner-f{
	top: -8px !important;
    /*right: -6px !important;*/
    position: absolute !important;
    color: #fff !important;
}
</style>
<?php 
if ($row_RecordAccount != NULL && $tplname != '' && $OptionMemberSelect == '1') { 
	$col_footer_menu = "3";
}else{
	$col_footer_menu = "4";
}
?>
<div class="hidden-lg" id="cart_footmenu">
<?php if ($OptionCartSelect == '1' && $tplrwdfootmenuindicate == '1') { /* 購物車用選單 */ ?>
<nav class="navbar navbar-default navbar-fixed-bottom" style="height:<?php if ($tplrwdfootmenufontindicate == "0") { echo "50px"; } else { echo "80px"; } ?>">
    <div class="row" style="padding-top:10px;">
        <?php if (count($row_RecordAccount) > 0 && $tplname != '' && $OptionMemberSelect == '1') { ?>
        <div class="col-xs-<?php echo $col_footer_menu; ?> icon_wrapper">
            <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>">
                <div class="icon_block">
                    <i class="fa fa-user fa-2x mobile_icon" aria-hidden="true"></i>
                    <div class="mobile_label" <?php if ($tplrwdfootmenufontindicate == "0") { ?>style="display:none;"<?php } ?>><?php echo $Lang_Footer_Menu_Member; //會員 ?></div>
                </div>
            </a>
        </div>
        <?php } ?>
        <div class="col-xs-<?php echo $col_footer_menu; ?> icon_wrapper">
        <?php 
		// sidepanel_mainmenu_btn 使用自訂頁面
		// sidepanel_btn 使用商品
		?>
            <a href="#" id="<?php if ($TmpFootmenuData == '0') { ?>sidepanel_btn<?php } else { ?>sidepanel_mainmenu_btn<?php } ?>">
                <div class="icon_block">
                    <i class="fa fa-th-list fa-2x mobile_icon" aria-hidden="true"></i>
                    <div class="mobile_label" <?php if ($tplrwdfootmenufontindicate == "0") { ?>style="display:none;"<?php } ?>><?php echo $Lang_Footer_Menu_Catalog; //產品目錄 ?></div>
                </div>
            </a>
        </div>
        <div class="col-xs-<?php echo $col_footer_menu; ?> icon_wrapper">
            <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>">
                <div class="icon_block">
                    <i class="fa fa-question-circle fa-2x mobile_icon" aria-hidden="true"></i>
                    <div class="mobile_label" <?php if ($tplrwdfootmenufontindicate == "0") { ?>style="display:none;"<?php } ?>><?php echo $Lang_Footer_Menu_ShoppingNotes; //購物須知 ?></div>
                </div>
            </a>
        </div>
        <div class="col-xs-<?php echo $col_footer_menu; ?> icon_wrapper">
            <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><span id="cart_counter" class="badge badge-red btn-xs badge-corner-f"><?php if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])) { ?><?php $Cart_Counter=0; $j=0; ?><?php foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) {/*購物車檢視畫面*/if(isset($_POST['Modify']) && $_GET['Opt'] == 'showpage'){$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]=$_POST['Modify'][$j];$j++;}/*\購物車檢視畫面*/$Cart_Counter += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];} ?><?php echo $Cart_Counter; ?><?php } ?></span>
                <div class="icon_block">
                    <i id="footer_cart_qty_container" class="fa fa-shopping-cart fa-2x mobile_icon" aria-hidden="true"></i>
                    <div class="mobile_label" <?php if ($tplrwdfootmenufontindicate == "0") { ?>style="display:none;"<?php } ?>><?php echo $Lang_Footer_Menu_Cart; //購物車 ?></div>
                </div>
            </a>
        </div>
    </div>
</nav>
<?php } ?>

<?php if ($TmpFootmenuData == '0') { ?>
<div id="sidepanel" class="sidepanel-light <?php if ($TmpMainmenuPosition == '1') { ?>sidepanel-inverse<?php } ?>" style="overflow-y:scroll; overflow-x:hidden;">
	<a id="sidepanel_close" href="#"><!-- close -->
		<i class="glyphicon glyphicon-remove"></i>
	</a>
    <div class="sidepanel-content">
    <?php include("slidepanel_product_footer.php"); ?>
    </div>
</div>
<?php } ?>
</div>
<!-- /SIDE PANEL -->
<script>    
var windowTop=0;//初始话可视区域距离页面顶端的距离
var $footer=$("#cart_footmenu nav");
jQuery(window).scroll(function() {
	
	scrolls = $(this).scrollTop();//获取当前可视区域距离页面顶端的距离

	  if(scrolls>windowTop){//当B>A时，表示页面在向下滑
	    //console.log($(this).scrollTop());
		if($(this).scrollTop() <=50) {
			$footer.css({"margin-bottom":0-$(this).scrollTop()+"px"});
		}else{
			<?php if($tplrwdfootmenufontindicate == "1") { ?>
			$footer.css({"margin-bottom":"-80px"});
			<?php } else { ?>
			$footer.css({"margin-bottom":"-50px"});
			<?php } ?>
		}
		windowTop=scrolls;
	  }else{
		$footer.css({"margin-bottom":"0px"});

		windowTop=scrolls;
		//console.log('打開');
		
		//console.log($window.scrollTop());
	  }
});
</script>