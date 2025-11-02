<?php require_once('../Connections/DB_Conn.php'); ?>
<?
include("../admin/counter_setting.php");
$root_path = "/";
include("../admin" . $root_path . $lang);

$ip = getenv("REMOTE_ADDR");
$time = time();
$visit = $_SERVER["HTTP_REFERER"];
$refer = $_GET["refer"];

$sql = "SELECT `time`, `ip` FROM demo_counterrecord WHERE `ip`= \"$ip\" ORDER BY `id` DESC;";
$result = mysqli_query($DB_Conn, $sql);
$old = mysqli_fetch_array($result);

$left = $time - $old[time];

$i = 0;
while ($ignore_ip[$i])
{
	if ($ip == "$ignore_ip[$i]")
	$ip = "ignore";
	$i++;
$i++;
}

if ($enable_refer == "1")
{
	$temp = strstr($refer, "http://");
	if (($refer != "") && ($temp == FALSE))
	$refer = "ignore";
	$i = 0;
	while ($ignore_refer_word[$i])
	{
		$temp = strstr($refer, $ignore_refer_word[$i]);
		if ($temp)
		$refer = str_replace($temp, "", $refer);
	$i++;
	}
	$i = 0;
	while ($ignore_refer_page[$i])
	{
		if ($refer == "$ignore_refer_page[$i]")
		$refer = "ignore";
		$i++;
	}
	$i = 0;
	while ($ignore_refer_url[$i])
	{
		$temp = strstr($refer, $ignore_refer_url[$i]);
		if ($temp)
		$refer = "ignore";
		$i++;
	}
	if (($refer != "ignore") && ($ip != "ignore"))
	{
		$sql = "SELECT * FROM demo_counterrefer WHERE `pages`= \"$refer\";";
		$result = mysqli_query($DB_Conn, $sql);
		$a = mysqli_fetch_array($result);

		if (empty($a))
		{
			$sql = "INSERT INTO demo_counterrefer (`pages`, `times`) VALUES (\"$refer\", 1);";
			mysqli_query($DB_Conn, $sql);
		}
		else
		{
			$sql = "UPDATE demo_counterrefer SET `times` = `times` + 1 WHERE `pages` = \"$refer\";";
			mysqli_query($DB_Conn, $sql);
		}
	}
}
else
$refer="";

if ($enable_visit == "1")
{
	$i = 0;
	while ($ignore_visit_word[$i])
	{
		$temp = strstr($visit, $ignore_visit_word[$i]);
		if ($temp)
		$visit = str_replace($temp, "", $visit);
		$i++;
	}
	$i = 0;
	while ($ignore_visit_page[$i])
	{
		if ($visit == "$ignore_visit_page[$i]")
		$visit = "ignore";
		$i++;
	}
	$i = 0;
	while ($ignore_visit_url[$i])
	{
		$temp = strstr($visit, $ignore_visit_url[$i]);
		if ($temp)
		$visit = "ignore";
		$i++;
	}
	if (($visit != "ignore") && ($visit != "") && ($ip != "ignore") && ($refer != "ignore"))
	{
		$sql="SELECT * FROM demo_countervisit WHERE `pages` = \"$visit\";";
		$result = mysqli_query($DB_Conn, $sql);
		$a = mysqli_fetch_array($result);

		if (empty($a))
		{
			$sql = "INSERT INTO demo_countervisit (`pages`, `times`) VALUES (\"$visit\", 1);";
			mysqli_query($DB_Conn, $sql);
		}
		else
		{
			$sql = "UPDATE demo_countervisit SET `times` = `times` + 1 WHERE `pages` = \"$visit\";";
			mysqli_query($DB_Conn, $sql);
		}
	}
}
else
$visit="";

if (($left > $next) && ($visit != "ignore") && ($refer != "ignore") && ($ip != "ignore"))
{
	$sql = "INSERT INTO demo_counterrecord (`id`, `time`, `ip`, `refer`, `visit`) VALUES (\"\", \"$time\", \"$ip\", \"$refer\", \"$visit\");";
	mysqli_query($DB_Conn, $sql);
}

if($enable_software = "1")
{
	$agent = $_SERVER["HTTP_USER_AGENT"];

	if (preg_match('/'.'win'.'/i', $agent) && strpos($agent, "95"))
		$os = "Windows 95";
	elseif (preg_match('/'.'win 9x'.'/i', $agent) && strpos($agent, "4.90"))
		$os = "Windows ME";
		elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'nt 6.0'.'/i', $agent)) 
		$os = "Vista";
	else if (eregi('win', $agent) && preg_match('/'.'nt 6.2'.'/i', $agent))
        $os = 'Windows 8';
	elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'nt 6.1'.'/i', $agent))
		$os = "Windows 7";
	elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'98'.'/i', $agent))
		$os = "Windows 98";
	elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'nt 5.1'.'/i', $agent))
		$os = "Windows XP";
	elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'nt 5'.'/i', $agent))
		$os = "Windows 2000";
	elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'nt'.'/i', $agent))
		$os = "Windows NT";
	elseif (preg_match('/'.'win'.'/i', $agent) && preg_match('/'.'32'.'/i', $agent))
		$os = "Windows 32";
	elseif (preg_match('/'.'linux'.'/i', $agent))
		$os = "Linux";
	elseif (preg_match('/'.'unix'.'/i', $agent))
		$os = "Unix";
	elseif (preg_match('/'.'sun'.'/i', $agent) && preg_match('/'.'os'.'/i', $agent))
		$os = "SunOS";
	elseif (preg_match('/'.'ibm'.'/i', $agent) && preg_match('/'.'os'.'/i', $agent))
		$os = "IBM OS/2";
	elseif (preg_match('/'.'Mac'.'/i', $agent) && preg_match('/'.'PC'.'/i', $agent))
		$os = "Macintosh";
	elseif (preg_match('/'.'PowerPC'.'/i', $agent))
		$os = "PowerPC";
	elseif (preg_match('/'.'AIX'.'/i', $agent))
		$os = "AIX";
	elseif (preg_match('/'.'HPUX'.'/i', $agent))
		$os = "HPUX";
	elseif (preg_match('/'.'NetBSD'.'/i', $agent))
		$os = "NetBSD";
	elseif (preg_match('/'.'BSD'.'/i', $agent))
		$os = "BSD";
	elseif (preg_match('/'.'OSF1'.'/i', $agent))
		$os = "OSF1";
	elseif (preg_match('/'.'IRIX'.'/i', $agent))
		$os = "IRIX";
	elseif (preg_match('/'.'FreeBSD'.'/i', $agent))
		$os = "FreeBSD";

	if ($os == "")
		$os = "unknown";

	if ($left > $next)
	{
		$sql = "SELECT * FROM demo_counteros WHERE `os` = \"$os\";";
		$result = mysqli_query($DB_Conn, $sql);
		$a = mysqli_fetch_array($result);
		if (empty($a))
		{
			$sql = "INSERT INTO demo_counteros (`os`, `times`) VALUES (\"$os\", 1);";
			mysqli_query($DB_Conn, $sql);
		}
		else
		{
			$sql = "UPDATE demo_counteros SET `times` = `times` + 1 WHERE `os` = \"$os\";";
			mysqli_query($DB_Conn, $sql);
		}
	}

	$browsers = array("Lynx", "MOSAIC", "AOL", "Opera", "JAVA", "MacWeb", "WebExplorer", "OmniWeb");
	$agent = $_SERVER["HTTP_USER_AGENT"];

	for ($i=0, $sum=count($browsers); $i<$sum; $i++)
	{
		if (strpos($agent, $browsers[$i]))
		{
			$browser = $browsers[$i];
			$browserver = "";
		}
	}
	////////////////////////////////////////////////////////////////////////////////////	
    function getBrowser(){
		 if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPod')) {
			$browser = 'iPhone';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
			$browser = 'iPad';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
			$browser = 'Android';
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Maxthon')) {
			$browser = 'Maxthon';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 12.0')) {
			$browser = 'IE12.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 11.0')) {
			$browser = 'IE11.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')) {
			$browser = 'IE10.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')) {
			$browser = 'IE9.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) {
			$browser = 'IE8.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {
			$browser = 'IE7.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
			$browser = 'IE6.0';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'NetCaptor')) {
			$browser = 'NetCaptor';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {
			$browser = 'Netscape';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx')) {
			$browser = 'Lynx';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
			$browser = 'Opera';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
			$browser = 'Chrome';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
			$browser = 'Firefox';
		} elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
			$browser = 'Safari';
		}else {
			$browser = 'Other';
		}
			return $browser;
	}
		$browseinfo = getBrowser();
	/////////////////////////////////////////////////////////////////////////////////////////
	
	if ($left > $next)
	{
		$sql = "SELECT * FROM demo_counterbrowser WHERE `browser` = \"$browseinfo\";";
		$result = mysqli_query($DB_Conn, $sql);
		$a = mysqli_fetch_array($result);

		if (empty($a))
		{
			$sql = "INSERT INTO demo_counterbrowser (`browser`, `times`) VALUES (\"$browseinfo\" , 1);";
			mysqli_query($DB_Conn, $sql);
		}
		else
		{
			$sql = "UPDATE demo_counterbrowser SET `times` = `times` + 1 WHERE `browser` = \"$browseinfo\";";
			mysqli_query($DB_Conn, $sql);
		}
	}
}
mysqli_free_result($result);
mysqli_close($db);
?>