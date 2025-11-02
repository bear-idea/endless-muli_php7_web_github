<style>
#Top_Content{overflow:visible}
.LangDropdown{position:relative;width:120px;margin:0 auto;line-height:30px; padding:0 5px;cursor: pointer; }
.LangDropdown img{vertical-align:middle; width:20px; height:20px; margin-top:5px; margin-bottom:5px;}
.LangDropdown:after{content:"";width:0;height:0;position:absolute;top:50%;right:15px;margin-top:-3px;border-width:6px 6px 0;border-style:solid;border-color:#999 transparent}
.LangDropdown .dropdownxx{position:absolute;top:100%;left:0;right:0;background:#fff;border-top:none;border-bottom:none;list-style:none;-webkit-transition:all .3s ease-out;-moz-transition:all .3s ease-out;-ms-transition:all .3s ease-out;-o-transition:all .3s ease-out;transition:all .3s ease-out;max-height:0;overflow:hidden}
.LangDropdown .dropdownxx li{padding:0 5px;margin-left:-40px;}
.LangDropdown .dropdownxx li a{display:block;text-decoration:none;color:#333;padding:5px 0;transition:all .3s ease-out;border-bottom:1px solid #e6e8ea;line-height:30px; vertical-align:middle}
.LangDropdown .dropdownxx li a img{vertical-align:middle}
.LangDropdown .dropdownxx li:last-of-type a{border:none}
.LangDropdown .dropdownxx li i{margin-right:5px;color:inherit;vertical-align:middle}
.LangDropdown .dropdownxx li:hover a{color:#57a9d9}
.LangDropdown.active{border-radius:5px 5px 0 0;background:#4cbeff;box-shadow:none;border-bottom:none;color:#fff}
.LangDropdown.active:after{border-color:#82d1ff transparent}
.LangDropdown.active .dropdownxx{border-bottom:1px solid rgba(0,0,0,0.2);max-height:400px}
</style>
<?php 
if ($_SESSION['lang'] == 'en') {
	$Lg_Dp_Show_Lang = " English"; $Lg_Dp_Show_Flag = "us";
}elseif($_SESSION['lang'] == 'zh-cn'){
	$Lg_Dp_Show_Lang = " 简体中文"; $Lg_Dp_Show_Flag = "cn";
}elseif($_SESSION['lang'] == 'jp'){
	$Lg_Dp_Show_Lang = " 日本語"; $Lg_Dp_Show_Flag = "jp";
}else{
	$Lg_Dp_Show_Lang = " 繁體中文"; $Lg_Dp_Show_Flag = "tw";
}
?>
<div id="Lg_Dp" class="LangDropdown" tabindex="1" style="margin-right:0px;">
    <span><!--<img src="<?php echo $SiteBaseUrl ?>images/flags/<?php echo $Lg_Dp_Show_Flag; ?>.png" />--><?php echo $Lg_Dp_Show_Lang; ?></span>
    <ul class="dropdownxx" style="margin-top:0px;">
        <?php if ($LangChooseZHTW == '1' && $_SESSION['lang'] != 'zh-tw') { ?>
        <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-tw'),'',$UrlWriteEnable);?>"><!--<img src="<?php echo $SiteBaseUrl ?>images/flags/tw.png" />--> 繁體中文</a></li>
        <?php } ?>
        <?php if ($LangChooseZHCN == '1' && $_SESSION['lang'] != 'zh-cn') { ?>
        <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-cn'),'',$UrlWriteEnable);?>"><!--<img src="<?php echo $SiteBaseUrl ?>images/flags/cn.png" />--> 简体中文</a></li>
        <?php } ?>
        <?php if ($LangChooseEN == '1' && $_SESSION['lang'] != 'en') { ?>
        <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'en'),'',$UrlWriteEnable);?>"><!--<img src="<?php echo $SiteBaseUrl ?>images/flags/us.png" />--> English</a></li>
        <?php } ?>
        <?php if ($LangChooseJP == '1' && $_SESSION['lang'] != 'jp') { ?>
        <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'jp'),'',$UrlWriteEnable);?>"><!--<img src="<?php echo $SiteBaseUrl ?>images/flags/jp.png" />--> 日本語</a></li>
        <?php } ?>
    </ul>
</div>
<script type="text/javascript">
function DropDown(a){this.dd=a;this.initEvents()}DropDown.prototype={initEvents:function(){var a=this;a.dd.on("click",function(b){$(this).toggleClass("active");b.stopPropagation()})}};$(function(){var a=new DropDown($("#Lg_Dp"));$(document).click(function(){$(".LangDropdown").removeClass("active")})});
</script>