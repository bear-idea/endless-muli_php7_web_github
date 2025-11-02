<?php 
// 檔案下載
/*
使用方法：
之後將download.php上傳到主機中，http://xxxx.xxx.xxx/download.php?f=檔案名稱。
如：要http://localhost/download.php?f=123.gif。
*/
if($_GET['f']!=""){
	$file_name=$_GET['f'];//檔案名稱
	$wshop=$_GET['wshop'];//檔案名稱
	//echo dirname(__FILE__);
    header("Content-type:text/html;charset=utf-8");
//    $file_name="cookie.jpg";
    //用以解决中文不能显示出来的问题
    $file_name=iconv("utf-8","Big5",$file_name);
    $file_sub_path=dirname(__FILE__) . "\\site\\" . $wshop . "\\image\\" . $_GET['ty'] . "\\"; //路徑位置;
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

}else{
	echo "找不到相關檔案....";
}
?>