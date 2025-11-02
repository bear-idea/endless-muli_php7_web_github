<?php
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	if($_SESSION['lang'] != '' && isset($_GET['lang'])) {
	switch($_GET['lang'])
	{
		case "zh-tw":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "繁體";
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "簡體";
			break;
		case "en":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "英文";
			break;	
		case "jp":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "日文";
			break;	
		case "kr":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "韓文";
			break;
		case "sp":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "西班牙語";
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
			$langname = "繁體";
			break;	
	}
	}
 ?>


<?php 
    if(isset($UseMod)){
		switch($UseMod)
		{
			case "Dfpage":
				$lang_home_opt = "typepage";
				break;	
			default:
				$lang_home_opt = "viewpage";
				break;	
		}
	}else{
		$lang_home_opt = "viewpage";
	}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php //require("require_mainmenu_viewline.php"); ?></td>
    <td align="right" valign="middle">
	<?php if ($LangChooseZHTW == '1' || $defaultlang == 'zh-tw') { ?>
    <?php if ($_SESSION['lang'] == 'zh-tw') {?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=zh-tw" title="繁體中文" rel="tipsy_l"><img src="images/lang/tw.png" alt="繁體中文" width="25" height="25"/></a> 
    <?php } else { ?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=zh-tw" title="繁體中文" rel="tipsy_l"><img src="images/lang/tw_n.png" alt="繁體中文" width="25" height="25"/></a>
    <?php } ?>
    <?php } ?> 
	<?php if ($LangChooseZHCN == '1' || $defaultlang == 'zh-cn') { ?>
    <?php if ($_SESSION['lang'] == 'zh-cn') {?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=zh-cn" title="简体中文" rel="tipsy_l"><img src="images/lang/cn.png" alt="简体中文" width="25" height="25"/></a>
    <?php } else { ?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=zh-cn" title="简体中文" rel="tipsy_l"><img src="images/lang/cn_n.png" alt="简体中文" width="25" height="25"/></a>
    <?php } ?>
    <?php } ?>
	<?php if ($LangChooseEN == '1' || $defaultlang == 'en') { ?>
    <?php if ($_SESSION['lang'] == 'en') {?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=en" title="English" rel="tipsy_l"><img src="images/lang/us.png" alt="English" width="25" height="25"/></a>
    <?php } else { ?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=en" title="English" rel="tipsy_l"><img src="images/lang/us_n.png" alt="English" width="25" height="25"/></a>
    <?php } ?>
    <?php } ?>
    <?php if ($LangChooseJP == '1') { ?>
    <?php if ($_SESSION['lang'] == 'jp' || $defaultlang == 'jp') { ?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=jp" title="日本語" rel="tipsy_l"><img src="images/lang/jp.png" alt="日本語" width="25" height="25"/></a> 
    <?php } else { ?>
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $wshop; ?>&amp;Opt=<?php echo $lang_home_opt; ?>&amp;lang=jp" title="日本語" rel="tipsy_l"><img src="images/lang/jp_n.png" alt="日本語" width="25" height="25"/></a>
    <?php } ?>
    <?php } ?>
    <?php if ($LangChooseKR == '1') { ?>
    <?php if ($_SESSION['lang'] == 'kr' || $defaultlang == 'kr') { ?>
    <a href="<?php echo url_set_value($_SERVER['REQUEST_URI'],"lang","kr"); ?>" title="韓文" rel="tipsy_l"><img src="images/lang/kr.png" alt="韓文" width="25" height="25"/></a> 
    <?php } else { ?>
    <a href="<?php echo url_set_value($_SERVER['REQUEST_URI'],"lang","kr"); ?>" title="韓文" rel="tipsy_l"><img src="images/lang/kr_n.png" alt="韓文" width="25" height="25"/></a>
    <?php } ?>
    <?php } ?>
    <?php if ($LangChooseSP == '1') { ?>
    <?php if ($_SESSION['lang'] == 'sp' || $defaultlang == 'sp') { ?>
    <a href="<?php echo url_set_value($_SERVER['REQUEST_URI'],"lang","sp"); ?>" title="西班牙語" rel="tipsy_l"><img src="images/lang/sp.png" alt="西班牙語" width="25" height="25"/></a> 
    <?php } else { ?>
    <a href="<?php echo url_set_value($_SERVER['REQUEST_URI'],"lang","sp"); ?>" title="西班牙語" rel="tipsy_l"><img src="images/lang/sp_n.png" alt="西班牙語" width="25" height="25"/></a>
    <?php } ?>
    <?php } ?>
</td>
  </tr>
</table>

