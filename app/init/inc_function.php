<?php 
/*將搜索文字做提示 */
function highLight($str, $keywords, $HighlightSelect, $color = "red") {
	if($HighlightSelect == "1")
	{
		if (empty($keywords)) {
			return $str;
		}
		$keywords = explode("[ \t\r\n,]+", $keywords);
		foreach($keywords as $val) {
			$tvar = preg_match('/'.$val.'/i', $str, $regs);
			$finalrep    = "<font color=". $color . ">" . $regs[0] . "</font>";
		}
		$str = str_ireplace($regs[0], $finalrep, $str);
		return $str;
		}else{
		return $str;
	}
}
 
// Trim by length (by FELIXONE.it)
function TrimByLength($str, $len, $word) {
  $end = "";
  if (strlen($str) > $len) $end = "...";
  $str = mb_substr($str, 0, $len, "UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}

/** 
* 将URL中的某参数设为某值 
*/  
function url_set_value($url,$key,$value)  
{  
$a=explode('?',$url);  
$url_f=$a[0];
	if(isset($a[1])){
		$query=$a[1];
		parse_str($query,$arr);  
		$arr[$key]=$value;  
		return $url_f.'?'.http_build_query($arr);
	}else{
		return $url_f;
	}
}  

/*取得 php 執行頁面之時間 */
function getMicroTime()
{
    $time = microtime();
    list($msec, $sec) = explode(" ", $time);
    return (float)$sec+(float)$msec;
}

function getRunTime($start, $end)
{
    return $end - $start;
}

/*
 *页面开头定义：$startTime = getMicroTime();
 *页面结尾定义： $endTime = getMicroTime();
 *最后调用函数： echo getRunTime($startTime, $endTime);
*/


/*
 * 二个常用的方法 
 * 如何计算两个日期相差天数  
 */
function margin($begin, $end){  
	$datetime_start = new DateTime($begin);  
	$datetime_end = new DateTime($end);  
	$day = $datetime_start->diff($datetime_end)->days;
	if($datetime_start > $datetime_end){
		return -$day;
	}else{
		return $day;
	}
     
}   
  //$begin='2000-01-01';    
  //$end=date("Y-m-d"); 
   
//一个加零函数，写计数器应该用的着！ 
function add_zero($_){ 
     if($_<10){$_="000000".$_;} 
     elseif($_<100){$_="00000".$_;} 
     elseif($_<1000){$_="0000".$_;} 
     elseif($_<10000){$_="000".$_;} 
     elseif($_<100000){$_="00".$_;} 
     elseif($_<1000000){$_="0".$_;} 
     return $_; 
} 



function GetIP() { 
    if ($_SERVER["HTTP_X_FORWARDED_FOR"])
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
     else if ($_SERVER["HTTP_CLIENT_IP"]) 

        $ip = $_SERVER["HTTP_CLIENT_IP"];
     else if ($_SERVER["REMOTE_ADDR"])
        $ip = $_SERVER["REMOTE_ADDR"];
     else if (getenv("HTTP_X_FORWARDED_FOR")) 
        $ip = getenv("HTTP_X_FORWARDED_FOR");
     else if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
     else if (getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
     else
        $ip = "Unknown";
     return $ip;
}

/*
// + n day
*/
function DateAdd($date, $int, $unit = "d") { 
    $dt = new DateTime($date);
	$day  = new DateInterval('P'.$int.'D'); // 兩年四天六小時又八分，中間的 T 是時間的意思
	$dt->add($day); 
	return $dt->format('Y-m-d') ;
}

/*
// 星期幾
*/
function GetWeekDay($date) { 
	$dateweekday = new DateTime($date);
	$week = $dateweekday->format("w");
    return $week;
}

/*
// + n year
*/
function count_date($input_date,$add_years)
{  
	$date = new DateTime($input_date);
	$day = new DateInterval('P'.$add_years.'Y'); // 兩年四天六小時又八分，中間的 T 是時間的意思
	$date->add($day); 
	$done_date = $date->format('Y-m-d') ;
    
    return $done_date;
}

/*
//計算 3  年後的 2007-01-02 是幾號
//echo count_date('2007-01-02','3');
*/

/*轉換金錢格式 */
/* フォーマットの金額。(10,000,000) */
function doFormatMoney($money){
	$format_money = "";
    $tmp_money = strrev($money);
    /* $format_money = "$"; */
    for($i = 3;$i<strlen($money);$i+=3){
        $format_money .= substr($tmp_money,0,3).",";
         $tmp_money = substr($tmp_money,3);
     }
    $format_money .=$tmp_money;
    $format_money = strrev($format_money); /* 顛倒字串順序 */
    return $format_money;
}

?>
<?php   
/*
 * GetFileExtend ( $File ) : String;  
 * 取得檔案附檔名並轉成小寫(判斷最後一個"."之後的皆為附檔名)  
 * 傳回小寫副檔名並包含"."  
*/  
function GetFileExtend( $filename ){   
 return strtolower(strrchr($filename, "."));   
}   
/*
 * GetFileNameNoExt ( $File ) : String;  
 * 取得檔案檔名並轉成小寫(判斷第一個"."之前的皆為檔名)  
 * 傳回小寫檔名並不包含最後一個 "."  
*/  
function GetFileNameNoExt( $filename ){   
 return strtolower(substr($filename,0,strrpos($filename,'.')));   
}   
/*
 * GetBaseName ( $Path ) : String;  
 * 取得檔案名稱並轉成小寫  
 * 傳回檔案名稱加副檔名  
*/  
function GetBaseName( $path ){   
 return strtolower(basename($path));   
}   
/*
 * GetPathName ( $Path ) : String;  
 * 取得目錄名稱並轉成小寫  
 * 傳回目錄名稱  
*/  
function GetPathName( $path ){   
 return strtolower(dirname($path));   
}   
/*
 * GetPathName ( $Path ) : String;  
 * 取得檔案名稱並副檔名轉成小寫  
 * 傳回檔案名稱+副檔名  
*/
function GetFileThumbExtend( $filename ){   
 return substr($filename,0,strrpos($filename,'.')) . strtolower(strrchr($filename, "."));   
} 

/* 檢查是否有相同圖檔名稱 */   
function checkName($imageName){    
    $imageDirPath = 'huiyu';   
    $imageDir = dir($imageDirPath);   
    while ($readName = $imageDir->read()){   
        if(!is_dir($imageDirPath.'/'.$readName)){   
        $main = substr($readName,0,strrpos($readName,'.'));   
        $extend = array_pop(explode('.',$readName));      
            if($readName == $imageName &&!$reCkeck){     
                $imageName = "copy-$main.$extend";   
                $imageDir->rewind();   
                continue;   
            }   
        }   
    }   
    $imageDir->close();   
    return $imageName;   
}  

  
/* 身份證檢查 */
   
function checkNick($id){   
    $head = array('A'=>1,'I'=>39,'O'=>48,'B'=>10,'C'=>19,'D'=>28,   
                  'E'=>37,'F'=>46,'G'=>55,'H'=>64,'J'=>73,'K'=>82,   
                  'L'=>2,'M'=>11,'N'=>20,'P'=>29,'Q'=>38,'R'=>47,   
                  'S'=>56,'T'=>65,'U'=>74,'V'=>83,'W'=>21,'X'=>3,   
                  'Y'=>12,'Z'=>30);      
    $multiply = array(8,7,6,5,4,3,2,1);      
    if (ereg("^[a-zA-Z][1-2][0-9]+$",$id) && strlen($id) == 10){   
        $len = strlen($id);   
        for($i=0; $i<$len; $i++){   
            $stringArray[$i] = substr($id,$i,1);   
        }      
        $total = $headPoint[array_shift($stringArray)];    
        $point = array_pop($stringArray);      
        $len = count($stringArray) ;  
        for($j=0; $j<$len; $j++){   
            $total += $stringArray[$j]*$multiply[$j];   
        }      
        if (($total%10 == 0 )?0:10-$total%10 != $point) {   
            return false;   
        } else {   
            return true;   
        }   
    }  else {   
       return false;   
    }   
}  

/*使用簡易單位顯示檔案大小 */
function ShowBytes($size) {
    $size=doubleval($size);
    $sizes = array(
        " Bytes", 
        " KB", 
        " MB", 
        " GB", 
        " TB"
    );
    if ($size == 0) { 
        return('n/a'); 
    } else {
        $i = floor( log($size, 1024) );
        return (round( $size/pow(1024, $i), 2) . $sizes[$i]); 
    }
}
function forceDownload($filename) { 
 
    if (false == file_exists($filename)) { 
        return false; 
    } 
     
    header('Content-Type: application-x/force-download'); 
    header('Content-Disposition: attachment; filename="' . basename($filename) .'"'); 
    header('Content-length: ' . filesize($filename)); 
 
    if (false === strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6')) { 
        header('Cache-Control: no-cache, must-revalidate'); 
    } 
    header('Pragma: no-cache'); 
         
    return readfile($filename);; 
}

/* FCKEditor分页处理 */
function pageBreak($content)
{
	$content  = $content;
	$pattern = "/<div style=\"page-break-after: always;?\">\s*<span style=\"display: none;?\">&nbsp;<\/span>\s*<\/div>/"; 
	$strSplit = preg_split($pattern, $content, -1, PREG_SPLIT_NO_EMPTY); 
	$count    = count($strSplit);   
	$outStr   = ""; 
	$i        = 1;  
	if ($count > 1 ) {
		$outStr   = "<div id='page_break'>";
		foreach($strSplit as $value) {
			if ($i <= 1) {
				$outStr .= "<div id='page_$i'>$value</div>";
			} else {
				$outStr .= "<div id='page_$i' class='collapse'>$value</div>";
			}
			$i++;
		}
		
		$outStr .= "<div class='num'>";
		for ($i = 1; $i <= $count; $i++) {
			$outStr .= "<li>$i</li>";
		}
		$outStr .= "</div></div>";
		return $outStr;
	} else {
		return $content;
	}
}

/* 谷歌ping服务的PHP代 */
function postUrl($url, $postvar) {
    $ch = curl_init();
	$headers = array(
            "POST ".$url." HTTP/1.0",
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Content-length: ".strlen($postvar)
        );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvar);
    $res = curl_exec ($ch);
    curl_close ($ch);
    return $res;
}
/* 更新版權  */
function autoUpdatingCopyright($startYear){
    $startYear = intval($startYear);
    $year = intval(date('Y'));
    if ($year > $startYear)
        return $startYear .' - '. $year;
    else
        return $startYear;
}

/* 去除空白(含內文) 斷行 */
function DeleteSpace($string_date){
	$string_date = strip_tags($string_date);
	preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($string_date)); //正则表达式去除所有空格和html标签（包括换行 空格 &nbsp;）
	$string_date = trim($string_date); // 移除前後空白字
    $string_date = preg_replace( "/\s/", "" , $string_date ); //利用正規表示式將內容的斷行(\r\n)字元去除
	$string_date = preg_replace('/\s(?=\s)/', '', $string_date); // 移除重覆的空白
    $string_date = preg_replace('/[\n\r\t]/', '', $string_date);// 移除非空白的間距變成一般的空白
	$string_date = trim($string_date); // 移除前後空白字
    return $string_date;
}

/* 去除空白(含內文) 斷行 + 擷取字串 */
function TrimSummary($string_date) {
  $string_date = strip_tags($string_date);
  $string_date = trim($string_date); // 移除前後空白字
  $string_date = preg_replace( "/\s/", "" , $string_date ); //利用正規表示式將內容的斷行(\r\n)字元去除
  $string_date = preg_replace('/\s(?=\s)/', '', $string_date); // 移除重覆的空白
  $string_date = preg_replace('/[\n\r\t]/', '', $string_date);// 移除非空白的間距變成一般的空白
  $end = "";
  $string_date = trim($string_date); // 移除前後空白字
  if (strlen($string_date) > 150) {$end = "...";}
  $string_date = mb_substr($string_date, 0, 150, "UTF-8");
  return $string_date.$end;
}

/**
* 計算兩組經緯度座標間的距離
* params:lat1緯度1,lng1經度1,lat2緯度2,lng2經度2,len_type(1:m|2:km);
* Echo GetDistance($lat1,$lng1,$lat2,$lng2).'米';
*/
function GetDistance($lat1,$lng1,$lat2,$lng2,$len_type=2,$decimal=2){
$EARTH_RADIUS=6378.137;	 //地球半徑,假設地球是規則的球體
$PI=3.1415926;	 //圓周率
$radLat1 = $lat1 * $PI / 180.0;
$radLat2 = $lat2 * $PI / 180.0;
$a = $radLat1 - $radLat2;
$b = ($lng1 * $PI / 180.0) - ($lng2 * $PI / 180.0);
$s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
$s = $s * $EARTH_RADIUS;
$s = Round($s*1000);
if($len_type>1){
$s /= 1000;
}
return Round($s,$decimal);
}

//PHP获取当前URL并替换指定参数。  
//$url = "http://www.baidu.com/a.php?idfa=&mac=&ip=&vv=";
//echo url_set_val($url , array('idfa'=>'cccc' , 'mac'=>'cccss' , 'ip'=>'192.168.1.101' ) );
/*
*@des 替换当前url中的参数值
*@params url
*@replace 需要替换的值 格式如下: array('name'=>'wangjian' , 'age'=>'1111' , 'sex'=> 1   ) 第一个是参数 第二个是替换的值
*/
function url_set_val($url , $replace = array() ){
    if(empty($replace)){
        return $url ;
    }
    list($url_f , $query ) = explode('?',$url);
    parse_str($query,$arr);
    if($arr){
        foreach($arr as $kk => $vv ){
            if(array_key_exists($kk , $replace) ){
                $arr[$kk] = $replace[$kk] ;
            }
        }
    }
    return $url_f.'?'.http_build_query($arr);
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

function mysqli_field_name($result, $field_offset) {
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

/* 網址重構 */
//将url转换成静态url 
function url_rewrite($file,$params = array (),$html = "",$rewrite = "1")  
{   
	if ($rewrite == '1') {       //开发阶段是不要rewrite,所在开发的时候，把$rewrite = false 
		$url = ($file == 'index') ? '' : '' . $file; 
		if (!empty ($params) && is_array($params)) 
		
		
		    if($file == 'index'){
				//$url .= '' . implode('/', $params);
				if($params['wshop'] != "") {
					$url = $params['wshop'] . "/" . $file;
					unset($params['wshop']);
					$url .= '/' . implode('/', $params);
		        }
				
			}else{
				/*$url .= '/' . implode('/', $params);*/
				if($params['wshop'] != "") {
					$url = $params['wshop'] . "/" . $file;
					unset($params['wshop']);
					$url .= '/' . implode('/', $params);
		        }
            } 
			
			
		if (!empty ($html)) $url .= '.' . $html; 
	} else { 
		$url = ($file == 'index') ? 'index.php' : '' . $file; 
		if (substr($url, -4) != '.php' && $file != 'index') $url .= '.php'; 
		if (!empty ($params) && is_array($params)) $url .= '?' . http_build_query($params); 
	} 
 
	return $url; 
}

/** 
* function 16进制颜色转换为RGB色值
* author www.phpernote.com
hex2rgb[r] hex2rgb[g] hex2rgb[b]
*/ 
function hex2rgb($hexColor){
	$color=str_replace('#','',$hexColor);
	if (strlen($color)> 3){
		$rgb=array(
			'r'=>hexdec(substr($color,0,2)),
			'g'=>hexdec(substr($color,2,2)),
			'b'=>hexdec(substr($color,4,2))
		);
	}else{
		$color=str_replace('#','',$hexColor);
		$r=substr($color,0,1). substr($color,0,1);
		$g=substr($color,1,1). substr($color,1,1);
		$b=substr($color,2,1). substr($color,2,1);
		$rgb=array( 
			'r'=>hexdec($r),
			'g'=>hexdec($g),
			'b'=>hexdec($b)
		);
	}
	return $rgb;
}

/**
 * 安全IP检测，支持IP段检测
 * @param string $ip 要检测的IP
 * @param string|array $ips  白名单IP或者黑名单IP
 * @return boolean true 在白名单或者黑名单中，否则不在
 */
function is_safe_ip($ip="",$ips=""){ 
    if(!$ip) $ip = get_client_ip();  //获取客户端IP
    if($ips){
        if(is_string($ips)){ //ip用"," 例如白名单IP：192.168.1.13,123.23.23.44,193.134.*.*
            $ips = explode(",", $ips);
        }
    }
	if(isset($ips)) {
    if(in_array($ip, $ips)){
        return true;
    }
	}
	if(isset($ips)) {
    $ipregexp = implode('|', str_replace( array('*','.'), array('\d+','\.') ,$ips));  
    $rs = preg_match("/^(".$ipregexp.")$/", $ip);
	if($rs) return true;
	}  
    
    return ;
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

function encryptDecrypt($key, $string, $decrypt){ 
    if($decrypt){ 
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12"); 
        return trim($decrypted); 
    }else{ 
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key)))); 
        return $encrypted; 
    } 
}

//以下是将字符串“Helloweba欢迎您”分别加密和解密 
//加密： 
//echo encryptDecrypt('password', 'Helloweba欢迎您',0); 
//解密： 
//echo encryptDecrypt('password', 'z0JAx4qMwcF+db5TNbp/xwdUM84snRsXvvpXuaCa4Bk=',1);


/* 主機使用記憶體 */
if (!function_exists("memory_usage")) {
	function memory_usage() { 
	$memory = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB'; 
	return $memory; 
	}
}

?>