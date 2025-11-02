<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

?>
<?php 
require('vendor/autoload.php');
$Tp_Page = "Home"; // 目前頁面所使用之分類(tp)
$Tp_MdName = strtolower($Tp_Page);
require_once('app/init/bootstrap.php');
if ($row_RecordAccount != NULL && $tplname != '' && $OptionModuleSelect[$Tp_Page] == '1') {
	require_once($Lang_GeneralPath);
	require_once('app/counter/require_count.php');  
    require_once('app/meta/meta_'.$Tp_MdName.'.php'); // 此頁面標題
	if($tplname == "mobile_smarty"){
	  // 手機板
		switch($HomeStyle) /*  判斷要使用的首頁版型 */
		{
			case "homeboard001":
				include($TplPath . "/main.php");
				break;
			case "homeboard002":
				//include($TplPath . "/main_free.php");
				include($TplPath . "/main_single.php");
				break;
			case "homeboard003":
			case "homeboard004":
			case "homeboard005":
			case "homeboard006":	
				include($TplPath . "/main.php");
				break;
			case "homeboard007":
			case "homeboard008":
			case "homeboard009":
			case "homeboard010":
			case "homeboard011":
			case "homeboard012":
			case "homeboard013":	
				include($TplPath . "/main_mod.php");
				break;						
			case "homeboard014":
			case "homeboard015":
			case "homeboard016":
			case "homeboard017":
			case "homeboard018":
			case "homeboard019":
			case "homeboard020":
				include($TplPath . "/main_mod_muti.php");
				break;
			case "homeboard021":
				include($TplPath . "/main_image_fullscreen.php");
				break;
			default:
				include($TplPath . "/main.php");
				break;
		}	
	}else{
	  // 電腦版
	  switch($HomeStyle) /*  判斷要使用的首頁版型 */
		{
			case "homeboard001":
				include($TplPath . "/main.php");
				break;
			case "homeboard002":
				//include($TplPath . "/main_free.php");
				include($TplPath . "/main_single.php");
				break;
			case "homeboard003":
				include($TplPath . "/main_image.php");
				break;
			case "homeboard004":
				include($TplPath . "/main_single_free.php");
				break;
			case "homeboard005":
				include($TplPath . "/main_single_free_nobanner.php");
				break;
			case "homeboard006":
				include($TplPath . "/main_image_full.php");
				break;
			case "homeboard007":
			case "homeboard008":
			case "homeboard009":
			case "homeboard010":
			case "homeboard011":
			case "homeboard012":
			case "homeboard013":
				include($TplPath . "/main_mod.php");
				break;
			case "homeboard014":
			case "homeboard015":
			case "homeboard016":
			case "homeboard017":
			case "homeboard018":
			case "homeboard019":
			case "homeboard020":
				include($TplPath . "/main_mod_muti.php");
				break;
			case "homeboard021":
				include($TplPath . "/main_image_fullscreen.php");
				break;
			default:
				include($TplPath . "/main.php");
				break;
		}	
	}
} else { ?>
<body onload='window.location="404.php"'>
<?php } ?>