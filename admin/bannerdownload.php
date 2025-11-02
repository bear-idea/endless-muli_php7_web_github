<?php require_once('../Connections/DB_Conn.php'); ?>
<?php

if($_GET['f']!="" && $_GET['mod'] == "banner" ){
	$file_name = $_GET['f'];//檔案名稱
	$wshop = "playweb";//檔案名稱
	//echo dirname(__FILE__);
    header("Content-type:text/html;charset=utf-8");
//    $file_name="cookie.jpg";
    //用以解决中文不能显示出来的问题
    $file_name=iconv("utf-8","Big5",$file_name);
	

	if ($SiteBaseUrlOuter != '' && $_GET['linkmod'] == "outer") {
		$file_sub_path=$SiteImgUrlOuter . $wshop . "/image/bannershow/"; //路徑位置
		$file_path=$file_sub_path.$file_name;
		$url = $file_path;
		$filename = basename($url);
		header('Content-type:application/force-download');
		header('Content-Disposition:attachment;filename='.$filename);
		readfile($url);
	}else{
		$file_sub_path = dirname(dirname(__FILE__)) . "\\site\\" . $wshop . "\\image\\bannershow\\"; //路徑位置;
        $file_path=$file_sub_path.$file_name;
		
		//首先要判断给定的文件存在与否
		if(!file_exists($file_path)){
			echo "找不到相關檔案....";
			return ;
		}
		
		//打开文件
		$file = fopen($file_path,'r');
		//定义下载头部信息
		header("content-type:application/octet-stream");
		header("accept-ranges:bytes");
		//清理filesize()函数的缓存
		clearstatcache();
		header("accept-length:".filesize($file_path));
		header("content-disposition:attachement;filename=".$file_name);
		echo fread($file,filesize($file_path));
		fclose($file);
		exit;
		}


}else{
	echo "找不到相關檔案....";
}
?>