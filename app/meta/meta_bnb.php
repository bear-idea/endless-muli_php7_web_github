<?php require_once('Connections/DB_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if((isset($_GET['id'])) && ($_GET['id'] != "") && $_GET['htp'] == 'view') {
$colname_RecordBnbKeyword = "-1";
if (isset($_GET['id'])) {
  $colname_RecordBnbKeyword = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBnbKeyword = sprintf("SELECT name, skeyword, sdescription FROM demo_bnb WHERE userid = %s", GetSQLValueString($colname_RecordBnbKeyword, "text"));
$RecordBnbKeyword = mysqli_query($DB_Conn, $query_RecordBnbKeyword) or die(mysqli_error($DB_Conn));
$row_RecordBnbKeyword = mysqli_fetch_assoc($RecordBnbKeyword);
$totalRows_RecordBnbKeyword = mysqli_num_rows($RecordBnbKeyword);
}

if($_GET['tid'] != "" && $_GET['htp'] == 'travel') {
$colname_RecordBnbTravelKeyword = "-1";
if (isset($_GET['tid'])) {
  $colname_RecordBnbTravelKeyword = $_GET['tid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBnbTravelKeyword = sprintf("SELECT name, skeyword, sdescription FROM demo_travel WHERE id = %s", GetSQLValueString($colname_RecordBnbTravelKeyword, "text"));
$RecordBnbTravelKeyword = mysqli_query($DB_Conn, $query_RecordBnbTravelKeyword) or die(mysqli_error($DB_Conn));
$row_RecordBnbTravelKeyword = mysqli_fetch_assoc($RecordBnbTravelKeyword);
$totalRows_RecordBnbTravelKeyword = mysqli_num_rows($RecordBnbTravelKeyword);
}

// 預設關鍵字
$bnb_title="台灣趴趴照民宿平台 - 免費刊登民宿民宿曝光廣告-飯店溫泉SPA館台灣旅遊網";
$bnb_key="民宿,旅遊, 居住廳, 摩鐵, MOTEL, HOTEL, QK, 不錯的溫泉民宿, 台灣民宿,台中民宿, 苗栗民宿, 新竹民宿, 台南民宿, 南投民宿, 宜蘭民宿, 花蓮民宿, 南庄民宿, 三義民宿, 大湖民宿,梨山民宿, 梨山SPA, 谷關SPA,谷關溫泉, 中部旅遊, 苗栗旅遊, 北部旅遊, 南庄旅遊,大湖採草莓, 苗栗SPA, 苗栗休閒農場, 新竹休閒農場, 內灣火車,北埔溫泉,苗栗溫泉,民宿網, 旅遊網,民宿王,民宿推薦,民宿包宿, 民宿訂房大台灣, 民宿資訊,住宿網, 住宿訂房, 住宿, 住宿比較王, 住宿比較網, 住宿傻惠網, 旅遊網, 旅行社, 旅遊景點介紹網, 旅遊網, 旅行網, 旅館, 旅遊展, 旅遊社, 旅遊資訊王, 旅遊景點, 旅遊網站, 旅遊網誌, 旅遊網大台灣, 旅遊網線上訂房, 旅遊網站推薦,愛玩家, 到處旅行,飯店, 三星級飯店, 五星級飯店, 六星級飯店, SPA館, 商會社,spa會館, 愛玩客官方網,旅行家,1號旅行家,play,溫泉, 溫泉會館, 溫SPA, 溫泉民宿, 溫泉飯店, 溫泉旅館, 溫泉渡假村, 溫泉煮蛋, 溫泉博物館, 溫泉季, 日式溫泉會館,投宿,北台灣旅遊, 中台灣旅遊, 南台灣旅遊, 我愛旅遊,全球華人民宿, 民宿通,日月潭飯店,阿里山民宿,海景民宿,墾丁海景飯店民宿,聖誕節渡假,過年渡假遊玩,兌溫泉,近車站交流道民宿飯店, 優質民宿飯店,近老街民宿飯店,教學農場,有機生態農場,人氣摩鐵,2人房,4人房,6人房,海邊民宿飯店,平價民宿飯店,溫泉會館,海畔民宿,古厝,渡假飯店,樹屋,海角七海民宿, 總鋪師民宿飯店,景觀民宿,泡湯渡假,泡湯溫泉,北埔冷泉,公寓民宿,森林遊樂區教育中心,芬多精,悠游渡假小木屋,休息,住宿, 蜜月館大飯店,精品旅館, 渡假旅店, 溫泉渡假飯店, 旅行者之家民宿, 休閒旅店, 溫泉湯苑會館, 生態休閒民宿, 主題飯店,森林會館, 商旅, 莊園民宿, 休閒民宿,酒店, 農莊";
$bnb_desc="提供各地民宿飯店等住宿資訊、是一個全新的民宿分享平台，幫你找到適合你的好地方 鄰近旅遊景點介紹、套裝行程及交通資訊等。 ... 進入地圖導覽 找尋民宿資訊交流網、免費刊登全省曝光、推薦旅遊景點、冬天泡溫泉、夏日渡假聖地、民宿旅館飯店休閒農場SPA館溫 ..";

if((isset($_GET['id'])) && ($_GET['id'] != "") && $_GET['htp'] == 'view') {
	if(isset($row_RecordBnbKeyword['name']))
	{
		$Title_Word = $row_RecordBnbKeyword['name'] . " - " . $bnb_title;
	}else {
		$Title_Word = $bnb_title;
	}
	
	if(isset($row_RecordBnbKeyword['skeyword']))
	{
		$Title_Keyword = $row_RecordBnbKeyword['skeyword'];
	}else {
		$Title_Keyword = $bnb_key;
	}
	
	if(isset($row_RecordBnbKeyword['sdescription']))
	{
		$Title_Desc = $row_RecordBnbKeyword['sdescription'];
	}else {
		$Title_Desc = $bnb_desc;
	}
}

if($_GET['tid'] != "" && $_GET['htp'] == 'travel') {
	if(isset($row_RecordBnbTravelKeyword['name']))
	{
		$Title_Word = $row_RecordBnbTravelKeyword['name'] . " - " . $bnb_title;
	}else {
		$Title_Word = $bnb_title;
	}
	
	if(isset($row_RecordBnbTravelKeyword['skeyword']))
	{
		$Title_Keyword = $row_RecordBnbTravelKeyword['skeyword'];
	}else {
		$Title_Keyword = $bnb_key;
	}
	
	if(isset($row_RecordBnbTravelKeyword['sdescription']))
	{
		$Title_Desc = $row_RecordBnbTravelKeyword['sdescription'];
	}else {
		$Title_Desc = $bnb_desc;
	}
}

if((isset($_GET['id'])) && ($_GET['id'] != "") && $_GET['htp'] == 'view') {
	mysqli_free_result($RecordBnbKeyword);
}
if($_GET['tid'] != "" && $_GET['htp'] == 'travel') {
	mysqli_free_result($RecordBnbTravelKeyword);
}
?>
