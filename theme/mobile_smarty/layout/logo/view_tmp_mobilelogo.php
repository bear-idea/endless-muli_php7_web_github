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
			if($TmpLogo_cn != '') {
			$TmpLogo =  $TmpLogo_cn;
			$TmpLogoWidth =  $TmpLogoWidth_cn;
			$TmpLogoHeight =  $TmpLogoHeight_cn;
			}
			$TmpLogoLogoName =  $TmpLogoLogoName_cn;
			break;
		case "en":
		    if($TmpLogoDefaultImg_en != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_en;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_en;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_en;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_en;
			if($TmpLogo_en != '') {
			$TmpLogo =  $TmpLogo_en;
			$TmpLogoWidth =  $TmpLogoWidth_en;
			$TmpLogoHeight =  $TmpLogoHeight_en;
			}
			$TmpLogoLogoName =  $TmpLogoLogoName_en;
			break;	
		case "jp":
		    if($TmpLogoDefaultImg_jp != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_jp;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_jp;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_kp;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_jp;
			if($TmpLogo_jp != '') {
			$TmpLogo =  $TmpLogo_jp;
			$TmpLogoWidth =  $TmpLogoWidth_jp;
			$TmpLogoHeight =  $TmpLogoHeight_jp;
			}
			$TmpLogoLogoName =  $TmpLogoLogoName_jp;
			break;	
		default:
		    break;
	}
?>
<?php if ($_GET['wshop'] == $tplwebname) { //如果目前之網頁為Logo之作者 則 使用個別樣板 之 Logo 設定 會依樣板之logo設定變動 ?>
<?php //if ($TmpMobileLogoType == 0) { //類型 ?>
    <?php if ($TmpLogo != "" && GetFileExtend($TmpLogo) != '.swf') { ?>
    	<a class="logo text-center-md" href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoWebname; ?>/logo/<?php echo $TmpLogo; ?>" alt="<?php echo $SiteName; ?>" class="img-responsive"/></a>
    <?php } else if (GetFileExtend($TmpLogo) == '.swf'){ ?>
    	<a class="logo text-center-md" href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $TmpLogoLogoName; ?></a> 
    <?php } else { ?>
    	<a class="logo text-center-md" href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $TmpLogoLogoName; ?></a>
    <?php }  ?>
    <?php //} else { // 類型 ?>
    	<!--<a class="logo text-center-md" href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $TmpLogoLogoName; ?></a>-->
    <?php //}  // 類型 ?>
<?php } else { // 若不為作者 則 使用此使用者個別設定黨之預設值 Logo 只有一個?>
<?php } ?>
    

