<?php header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
require('vendor/autoload.php');
$Tp_Page = "Knowledge"; // 目前頁面所使用之分類(tp)
$Tp_MdName = strtolower($Tp_Page);
require_once('app/init/bootstrap.php');
if ($row_RecordAccount != NULL && $tplname != '' && $OptionModuleSelect[$Tp_Page] == '1') {
	require_once($Lang_GeneralPath);
	require_once('app/counter/require_count.php');  
    require_once('app/meta/meta_'.$Tp_MdName.'.php'); // 此頁面標題
    require_once($TplPath . '/'.$Tp_MdName.'.php');
} else { ?>
<body onload='window.location="404.php"'>
<?php } ?>
