<?php 
switch($_GET['lang'])
	{
		case "zh-tw":
			break;
		case "zh-cn":
		    if($TmpLogoDefaultImg_cn != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_cn;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_cn;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_cn;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_cn;
			if($TmpHomeLogo_cn != '') {
			$TmpHomeLogo =  $TmpHomeLogo_cn;
			$TmpHomeLogoWidth =  $TmpHomeLogoWidth_cn;
			$TmpHomeLogoHeight =  $TmpHomeLogoHeight_cn;
			}
			$TmpHomeLogoName =  $TmpHomeLogoName_cn;
			break;
		case "en":
		    if($TmpLogoDefaultImg_en != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_en;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_en;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_en;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_en;
			if($TmpHomeLogo_en != '') {
			$TmpHomeLogo =  $TmpHomeLogo_en;
			$TmpHomeLogoWidth =  $TmpHomeLogoWidth_en;
			$TmpHomeLogoHeight =  $TmpHomeLogoHeight_en;
			}
			$TmpHomeLogoName =  $TmpHomeLogoName_en;
			break;	
		case "jp":
		    if($TmpLogoDefaultImg_jp != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_jp;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_jp;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_jp;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_jp;
			if($TmpHomeLogo_jp != '') {
			$TmpHomeLogo =  $TmpHomeLogo_jp;
			$TmpHomeLogoWidth =  $TmpHomeLogoWidth_jp;
			$TmpHomeLogoHeight =  $TmpHomeLogoHeight_jp;
			}
			$TmpHomeLogoName =  $TmpHomeLogoName_jp;
			break;	
		default:
		    break;
	}
?>
<style type="text/css">
#apDiv_outmenu {height: <?php echo $TmpMainMenuHeight; ?>px; width: 100%; z-index: 10; right: 0px; <?php if ($TmpMainMenuLocation == '0') { // 當自定選單採用100%寬度時採用?>position: absolute; top: <?php echo $TmpDftMenu_Y; ?>px;<?php } ?> background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuOImg; ?>); background-repeat: repeat-x;}
#apDiv_dftmenu {position: absolute;z-index: 10;margin-left: auto;margin-right: 0px;right: <?php echo $TmpDftMenu_X; ?>px;top: 0px;}
#apDiv_picmenu {position: absolute;z-index: 10;left: <?php echo $TmpPicMenu_X; ?>px;top: <?php echo $TmpPicMenu_Y; ?>px;float: right;}
</style>
<?php if ($_GET['wshop'] == $tplwebname) { //如果目前之網頁為Logo之作者 則 使用個別樣板 之 Logo 設定 會依樣板之logo設定變動 ?>
    <div id="Homelogo" style="position:absolute;">
    <?php if ($TmpHomeLogoType == 0) { //類型 ?>
    <?php if ($TmpHomeLogo != "" && GetFileExtend($TmpHomeLogo) != '.swf') { ?>
        <span data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpHomeLogoWebname; ?>/logo/<?php echo $TmpHomeLogo; ?>" width="<?php echo $TmpHomeLogoWidth; ?>" height="<?php echo $TmpHomeLogoHeight; ?>"/></a></span>
    <?php } else if (GetFileExtend($TmpHomeLogo) == '.swf'){ ?>
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop'] ?>/logo/<?php echo $TmpHomeLogo; ?>" width="<?php echo $TmpHomeLogoWidth; ?>" height="<?php echo $TmpHomeLogoHeight; ?>" play="true" loop="true" quality="high" pluginspage="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" wmode="transparent"> </embed></span>
    <?php } else { ?>
    <div id="Homelogo" style="position:absolute;">
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><img src="images/logo_default_tmp.png" width="149" height="50" /></span>
    </div>
    <?php }  ?>
    <?php } else { // 類型 ?>
    <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="index.php?wshop=<?php echo $_GET['wshop'] ?>"><?php echo $TmpHomeLogoName; ?></a></span>
    <?php }  // 類型 ?>
    </div>
<?php } else { // 若不為作者 則 使用此使用者個別設定黨之預設值 Logo 只有一個?>
	<div id="Homelogo" style="position:absolute;">
       <?php if ($TmpLogoDefaultLogoType == 0) { //類型 ?>
       <?php if ($TmpLogoDefaultImg != "" && GetFileExtend($TmpLogoDefaultImg) != '.swf') { ?>
        <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoDefaultWebName; ?>/logo/<?php echo $TmpLogoDefaultImg; ?>" /></a></span>
    <?php } else if (GetFileExtend($TmpLogoDefaultImg) == '.swf'){ ?>
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoDefaultWebName; ?>/logo/<?php echo $TmpLogoDefaultImg; ?>" width="<?php echo $TmpLogoDefaultWidth; ?>" height="<?php echo $TmpLogoDefaultHeight; ?>" play="true" loop="true" quality="high" pluginspage="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" wmode="transparent"> </embed></span>
    <?php } else { ?>
    <div id="Homelogo" style="position:absolute;">
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><img src="images/logo_default.png" width="149" height="50" /></span>
    </div>
    <?php }  ?>
    <?php } else { // 類型 ?>
    <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $TmpLogoDefaultLogoName; ?></a></span>
    <?php }  // 類型 ?>
    </div>
<?php } ?>

