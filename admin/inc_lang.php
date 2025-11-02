<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['lang'])) {
	switch(@$_GET['lang'])
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
			$langname = "韓語";
			break;
		case "sp":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "西班牙語";
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
			//$langname = "繁體";
	}
}else{
	$_SESSION['lang'] = $defaultlang;
}
?>