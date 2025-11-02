<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
class Lunar {
var $MIN_YEAR = 1891;
var $MAX_YEAR = 2100;
var $lunarInfo = array(
array(0,2,9,21936),array(6,1,30,9656),array(0,2,17,9584),array(0,2,6,21168),array(5,1,26,43344),array(0,2,13,59728),
array(0,2,2,27296),array(3,1,22,44368),array(0,2,10,43856),array(8,1,30,19304),array(0,2,19,19168),array(0,2,8,42352),
array(5,1,29,21096),array(0,2,16,53856),array(0,2,4,55632),array(4,1,25,27304),array(0,2,13,22176),array(0,2,2,39632),
array(2,1,22,19176),array(0,2,10,19168),array(6,1,30,42200),array(0,2,18,42192),array(0,2,6,53840),array(5,1,26,54568),
array(0,2,14,46400),array(0,2,3,54944),array(2,1,23,38608),array(0,2,11,38320),array(7,2,1,18872),array(0,2,20,18800),
array(0,2,8,42160),array(5,1,28,45656),array(0,2,16,27216),array(0,2,5,27968),array(4,1,24,44456),array(0,2,13,11104),
array(0,2,2,38256),array(2,1,23,18808),array(0,2,10,18800),array(6,1,30,25776),array(0,2,17,54432),array(0,2,6,59984),
array(5,1,26,27976),array(0,2,14,23248),array(0,2,4,11104),array(3,1,24,37744),array(0,2,11,37600),array(7,1,31,51560),
array(0,2,19,51536),array(0,2,8,54432),array(6,1,27,55888),array(0,2,15,46416),array(0,2,5,22176),array(4,1,25,43736),
array(0,2,13,9680),array(0,2,2,37584),array(2,1,22,51544),array(0,2,10,43344),array(7,1,29,46248),array(0,2,17,27808),
array(0,2,6,46416),array(5,1,27,21928),array(0,2,14,19872),array(0,2,3,42416),array(3,1,24,21176),array(0,2,12,21168),
array(8,1,31,43344),array(0,2,18,59728),array(0,2,8,27296),array(6,1,28,44368),array(0,2,15,43856),array(0,2,5,19296),
array(4,1,25,42352),array(0,2,13,42352),array(0,2,2,21088),array(3,1,21,59696),array(0,2,9,55632),array(7,1,30,23208),
array(0,2,17,22176),array(0,2,6,38608),array(5,1,27,19176),array(0,2,15,19152),array(0,2,3,42192),array(4,1,23,53864),
array(0,2,11,53840),array(8,1,31,54568),array(0,2,18,46400),array(0,2,7,46752),array(6,1,28,38608),array(0,2,16,38320),
array(0,2,5,18864),array(4,1,25,42168),array(0,2,13,42160),array(10,2,2,45656),array(0,2,20,27216),array(0,2,9,27968),
array(6,1,29,44448),array(0,2,17,43872),array(0,2,6,38256),array(5,1,27,18808),array(0,2,15,18800),array(0,2,4,25776),
array(3,1,23,27216),array(0,2,10,59984),array(8,1,31,27432),array(0,2,19,23232),array(0,2,7,43872),array(5,1,28,37736),
array(0,2,16,37600),array(0,2,5,51552),array(4,1,24,54440),array(0,2,12,54432),array(0,2,1,55888),array(2,1,22,23208),
array(0,2,9,22176),array(7,1,29,43736),array(0,2,18,9680),array(0,2,7,37584),array(5,1,26,51544),array(0,2,14,43344),
array(0,2,3,46240),array(4,1,23,46416),array(0,2,10,44368),array(9,1,31,21928),array(0,2,19,19360),array(0,2,8,42416),
array(6,1,28,21176),array(0,2,16,21168),array(0,2,5,43312),array(4,1,25,29864),array(0,2,12,27296),array(0,2,1,44368),
array(2,1,22,19880),array(0,2,10,19296),array(6,1,29,42352),array(0,2,17,42208),array(0,2,6,53856),array(5,1,26,59696),
array(0,2,13,54576),array(0,2,3,23200),array(3,1,23,27472),array(0,2,11,38608),array(11,1,31,19176),array(0,2,19,19152),
array(0,2,8,42192),array(6,1,28,53848),array(0,2,15,53840),array(0,2,4,54560),array(5,1,24,55968),array(0,2,12,46496),
array(0,2,1,22224),array(2,1,22,19160),array(0,2,10,18864),array(7,1,30,42168),array(0,2,17,42160),array(0,2,6,43600),
array(5,1,26,46376),array(0,2,14,27936),array(0,2,2,44448),array(3,1,23,21936),array(0,2,11,37744),array(8,2,1,18808),
array(0,2,19,18800),array(0,2,8,25776),array(6,1,28,27216),array(0,2,15,59984),array(0,2,4,27424),array(4,1,24,43872),
array(0,2,12,43744),array(0,2,2,37600),array(3,1,21,51568),array(0,2,9,51552),array(7,1,29,54440),array(0,2,17,54432),
array(0,2,5,55888),array(5,1,26,23208),array(0,2,14,22176),array(0,2,3,42704),array(4,1,23,21224),array(0,2,11,21200),
array(8,1,31,43352),array(0,2,19,43344),array(0,2,7,46240),array(6,1,27,46416),array(0,2,15,44368),array(0,2,5,21920),
array(4,1,24,42448),array(0,2,12,42416),array(0,2,2,21168),array(3,1,22,43320),array(0,2,9,26928),array(7,1,29,29336),
array(0,2,17,27296),array(0,2,6,44368),array(5,1,26,19880),array(0,2,14,19296),array(0,2,3,42352),array(4,1,24,21104),
array(0,2,10,53856),array(8,1,30,59696),array(0,2,18,54560),array(0,2,7,55968),array(6,1,27,27472),array(0,2,15,22224),
array(0,2,5,19168),array(4,1,25,42216),array(0,2,12,42192),array(0,2,1,53584),array(2,1,21,55592),array(0,2,9,54560)
);
/**
* 将阳历转换为阴历
* @param year 公历-年
* @param month 公历-月
* @param date 公历-日
*/
function convertSolarToLunar($year,$month,$date){
//debugger;
$yearData = $this->lunarInfo[$year-$this->MIN_YEAR];
if($year==$this->MIN_YEAR&&$month<=2&&$date<=9){
return array(1891,'正月','初一','辛卯',1,1,'兔');
}
return $this->getLunarByBetween($year,$this->getDaysBetweenSolar($year,$month,$date,$yearData[1],$yearData[2]));
}

function convertSolarMonthToLunar($year,$month) {
$yearData = $this->lunarInfo[$year-$this->MIN_YEAR];
if($year==$this->MIN_YEAR&&$month<=2&&$date<=9){
return array(1891,'正月','初一','辛卯',1,1,'兔');
}
$month_days_ary = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
$dd = $month_days_ary[$month];
if($this->isLeapYear($year) && $month == 2) $dd++;
$lunar_ary = array();
for ($i = 1; $i < $dd; $i++) {
$array = $this->getLunarByBetween($year,$this->getDaysBetweenSolar($year, $month, $i, $yearData[1], $yearData[2]));
$array[] = $year . '-' . $month . '-' . $i;
$lunar_ary[$i] = $array;
}
return $lunar_ary;
}
/**
* 将阴历转换为阳历
* @param year 阴历-年
* @param month 阴历-月，闰月处理：例如如果当年闰五月，那么第二个五月就传六月，相当于阴历有13个月，只是有的时候第13个月的天数为0
* @param date 阴历-日
*/
function convertLunarToSolar($year,$month,$date){
$yearData = $this->lunarInfo[$year-$this->MIN_YEAR];
$between = $this->getDaysBetweenLunar($year,$month,$date);
$res = mktime(0,0,0,$yearData[1],$yearData[2],$year);
$res = date('Y-m-d', $res+$between*24*60*60);
$day = explode('-', $res);
$year = $day[0];
$month= $day[1];
$day = $day[2];
return array($year, $month, $day);
}
/**
* 判断是否是闰年
* @param year
*/
function isLeapYear($year){
return (($year%4==0 && $year%100 !=0) || ($year%400==0));
}
/**
* 获取干支纪年
* @param year
*/
function getLunarYearName($year){
$sky = array('庚','辛','壬','癸','甲','乙','丙','丁','戊','己');
$earth = array('申','酉','戌','亥','子','丑','寅','卯','辰','巳','午','未');
$year = $year.'';
return $sky[$year{3}].$earth[$year%12];
}
/**
* 根据阴历年获取生肖
* @param year 阴历年
*/
function getYearZodiac($year){
$zodiac = array('猴','鸡','狗','猪','鼠','牛','虎','兔','龙','蛇','马','羊');
return $zodiac[$year%12];
}
/**
* 获取阳历月份的天数
* @param year 阳历-年
* @param month 阳历-月
*/
function getSolarMonthDays($year,$month){
$monthHash = array('1'=>31,'2'=>$this->isLeapYear($year)?29:28,'3'=>31,'4'=>30,'5'=>31,'6'=>30,'7'=>31,'8'=>31,'9'=>30,'10'=>31,'11'=>30,'12'=>31);
return $monthHash["$month"];
}
/**
* 获取阴历月份的天数
* @param year 阴历-年
* @param month 阴历-月，从一月开始
*/
function getLunarMonthDays($year,$month){
$monthData = $this->getLunarMonths($year);
return $monthData[$month-1];
}
/**
* 获取阴历每月的天数的数组
* @param year
*/
function getLunarMonths($year){
$yearData = $this->lunarInfo[$year - $this->MIN_YEAR];
$leapMonth = $yearData[0];
$bit = decbin($yearData[3]);
for ($i = 0; $i < strlen($bit);$i ++) {
$bitArray[$i] = substr($bit, $i, 1);
}
for($k=0,$klen=16-count($bitArray);$k<$klen;$k++){
array_unshift($bitArray, '0');
}
$bitArray = array_slice($bitArray,0,($leapMonth==0?12:13));
for($i=0; $i<count($bitArray); $i++){
$bitArray[$i] = $bitArray[$i] + 29;
}
return $bitArray;
}
/**
* 获取农历每年的天数
* @param year 农历年份
*/
function getLunarYearDays($year){
$yearData = $this->lunarInfo[$year-$this->MIN_YEAR];
$monthArray = $this->getLunarYearMonths($year);
$len = count($monthArray);
return ($monthArray[$len-1]==0?$monthArray[$len-2]:$monthArray[$len-1]);
}
function getLunarYearMonths($year){
//debugger;
$monthData = $this->getLunarMonths($year);
$res=array();
$temp=0;
$yearData = $this->lunarInfo[$year-$this->MIN_YEAR];
$len = ($yearData[0]==0?12:13);
for($i=0;$i<$len;$i++){
$temp=0;
for($j=0;$j<=$i;$j++){
$temp+=$monthData[$j];
}
array_push($res, $temp);
}
return $res;
}
/**
* 获取闰月
* @param year 阴历年份
*/
function getLeapMonth($year){
$yearData = $this->lunarInfo[$year-$this->MIN_YEAR];
return $yearData[0];
}
/**
* 计算阴历日期与正月初一相隔的天数
* @param year
* @param month
* @param date
*/
function getDaysBetweenLunar($year,$month,$date){
$yearMonth = $this->getLunarMonths($year);
$res=0;
for($i=1;$i<$month;$i++){
$res +=$yearMonth[$i-1];
}
$res+=$date-1;
return $res;
}
/**
* 计算2个阳历日期之间的天数
* @param year 阳历年
* @param cmonth
* @param cdate
* @param dmonth 阴历正月对应的阳历月份
* @param ddate 阴历初一对应的阳历天数
*/
function getDaysBetweenSolar($year,$cmonth,$cdate,$dmonth,$ddate){
$a = mktime(0,0,0,$cmonth,$cdate,$year);
$b = mktime(0,0,0,$dmonth,$ddate,$year);
return ceil(($a-$b)/24/3600);
}
/**
* 根据距离正月初一的天数计算阴历日期
* @param year 阳历年
* @param between 天数
*/
function getLunarByBetween($year,$between){
//debugger;
$lunarArray = array();
$yearMonth=array();
$t=0;
$e=0;
$leapMonth=0;
$m='';
if($between==0){
array_push($lunarArray, $year,'正月','初一');
$t = 1;
$e = 1;
}else{
$year = $between>0? $year : ($year-1);
$yearMonth = $this->getLunarYearMonths($year);
$leapMonth = $this->getLeapMonth($year);
$between = $between>0?$between : ($this->getLunarYearDays($year)+$between);
for($i=0;$i<13;$i++){
if($between==$yearMonth[$i]){
$t=$i+2;
$e=1;
break;
}else if($between<$yearMonth[$i]){
$t=$i+1;
$e=$between-(empty($yearMonth[$i-1])?0:$yearMonth[$i-1])+1;
break;
}
}
$m = ($leapMonth!=0&&$t==$leapMonth+1)?('闰'.$this->getCapitalNum($t- 1,true)):$this->getCapitalNum(($leapMonth!=0&&$leapMonth+1<$t?($t-1):$t),true);
array_push($lunarArray,$year,$m,$this->getCapitalNum($e,false));
}
array_push($lunarArray,$this->getLunarYearName($year));// 天干地支
array_push($lunarArray,$t,$e);
array_push($lunarArray,$this->getYearZodiac($year));// 12生肖
array_push($lunarArray,$leapMonth);// 闰几月
return $lunarArray;
}
/**
* 获取数字的阴历叫法
* @param num 数字
* @param isMonth 是否是月份的数字
*/
function getCapitalNum($num,$isMonth){
$isMonth = $isMonth || false;
$dateHash=array('0'=>'','1'=>'一','2'=>'二','3'=>'三','4'=>'四','5'=>'五','6'=>'六','7'=>'七','8'=>'八','9'=>'九','10'=>'十 ');
$monthHash=array('0'=>'','1'=>'正月','2'=>'二月','3'=>'三月','4'=>'四月','5'=>'五月','6'=>'六月','7'=>'七月','8'=>'八月','9'=>'九月','10'=>'十月','11'=>'冬月','12'=>'腊月');
$res='';
if($isMonth){
$res = $monthHash[$num];
}else{
if($num<=10){
$res = '初'.$dateHash[$num];
}else if($num>10&&$num<20){
$res = '十'.$dateHash[$num-10];
}else if($num==20){
$res = "二十";
}else if($num>20&&$num<30){
$res = "廿".$dateHash[$num-20];
}else if($num==30){
$res = "三十";
}
}
return $res;
}
}

//計算中秋
//$lunar = new Lunar();
//$NowDate = $lunar->convertLunarToSolar(2019,8,15);
//echo $NowDate[2];
?>
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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$coluserid_RecordAttendance = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAttendance = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttendance = sprintf("SELECT * FROM salary_attendance WHERE userid=%s",GetSQLValueString($coluserid_RecordAttendance, "int"));
$RecordAttendance = mysqli_query($DB_Conn, $query_RecordAttendance) or die(mysqli_error($DB_Conn));
$row_RecordAttendance = mysqli_fetch_assoc($RecordAttendance);
$totalRows_RecordAttendance = mysqli_num_rows($RecordAttendance);

if ((isset($_POST["MM_del"])) && ($_POST["MM_del"] == "form_Attendance") && $totalRows_RecordAttendance > 0 ) {
  $deleteSQL = sprintf("DELETE FROM salary_attendance WHERE userid=%s",
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $insertGoTo = "manage_attendance.php?Opt=genpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Attendance") && $totalRows_RecordAttendance == 0 ) {
	
	        /* 取得日曆 */
	        $colname_RecordCalendar = "-1";
			if (isset($_SESSION['lang'])) {
			  $colname_RecordCalendar = $_SESSION['lang'];
			}
			$coluserid_RecordCalendar = "-1";
			if (isset($w_userid)) {
			  $coluserid_RecordCalendar = $w_userid;
			}
			$colhyear_RecordCalendar = "-1";
			if (isset($_POST["hyear"])) {
			  $colhyear_RecordCalendar = $_POST["hyear"];
			}
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordCalendar = sprintf("SELECT * FROM salary_calendar WHERE lang = %s && userid=%s && hyear=%s", GetSQLValueString($colname_RecordCalendar, "int"),GetSQLValueString($coluserid_RecordCalendar, "int"),GetSQLValueString($colhyear_RecordCalendar, "int"));
			$RecordCalendar = mysqli_query($DB_Conn, $query_RecordCalendar) or die(mysqli_error($DB_Conn));
			$row_RecordCalendar = mysqli_fetch_assoc($RecordCalendar);
			echo $totalRows_RecordCalendar = mysqli_num_rows($RecordCalendar);
 
		  $insertSQL = sprintf("INSERT INTO salary_attendance (weekday, hyear, hdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
							   GetSQLValueString($this_week, "text"),
							   GetSQLValueString($ThisYear, "text"),
							   GetSQLValueString($g_date, "text"),
							   GetSQLValueString($indicate, "int"),
							   GetSQLValueString($notes1, "text"),
							   GetSQLValueString($_POST['lang'], "text"),
							   GetSQLValueString($_POST['userid'], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		 // $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_attendance.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  //header(sprintf("Location: %s", $insertGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 年度出勤表 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 產生資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">

  <?php if($totalRows_RecordAttendance == 0) { ?>
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <?php 
	 	$dt = new DateTime(); $ThisYear = $dt->format('Y');
	  ?>
      
      <div class="alert alert-warning m-5"><i class="fa fa-info-circle"></i> <b>此年度出勤表會依據年度行事曆及周排班表來做產生。</b></div>
      
      <?php 
	  //計算中秋
      $lunar = new Lunar();
	  $Arr_MoonFestival = $lunar->convertLunarToSolar($ThisYear,8,15);
	  $MoonFestival = $Arr_MoonFestival[1]."-".$Arr_MoonFestival[2];
	  
	  //計算農曆除夕
	  $lunar = new Lunar();
	  $Arr_GetMonthDay = $lunar->getLunarMonths($ThisYear); /* 取得農曆12月天數 */

	  $lunar = new Lunar();
	  $Arr_NewYearsEve = $lunar->convertLunarToSolar($ThisYear-1,12,$Arr_GetMonthDay[0]);
	  $NewYearsEve = $Arr_NewYearsEve[1]."-".$Arr_NewYearsEve[2];
	  
	  $hdate = array("01-01",$NewYearsEve,"02-28","03-29","04-04","05-01","06-08",$MoonFestival,"10-10","10-25","10-31","11-12","12-25"); 
	  $title = array("元旦","農曆除夕","和平紀念日","青年節","婦幼節","勞工節","端午節","中秋節","國慶日","光復節","蔣公誕辰","行憲紀念日"); 
	  $indicate = array("1","1","1","0" ,"0","1","0","1","1","0","0","0"); 
	  
	  ?>
  
      <div class="form-group row">
        <label class="col-md-2 col-form-label">年份<span class="text-red">*</span></label>
          <div class="col-md-10">
                    <?php 
						$dt = new DateTime(); $ThisYear = $dt->format('Y');
						$dt = new DateTime(); $ThisMonth = $dt->format('m');
					?>
                    <select name="hyear" id="hyear" class="form-control" data-parsley-trigger="blur" required="">
                        <?php 
							for($i=$ThisYear-1; $i <=$ThisYear+1; $i++) { 
						?>
                        <option value="<?php echo $i ?>" <?php if (!(strcmp($i, $ThisYear))) {echo "selected=\"selected\"";} ?>><?php echo $i ?></option>
                        <?php 
							} 
						?>
				    </select>
        
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">例假日是否放假<i class="fa fa-info-circle text-orange" data-original-title="此設定為是否套用例假維護之項目。" data-toggle="tooltip" data-placement="top"></i><span class="text-red">*</span></label>                 	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildayindicate" id="hoildayindicate_1" value="1" checked />
                <label for="hoildayindicate_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildayindicate" id="hoildayindicate_2" value="0" />
                <label for="hoildayindicate_2">否</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">放假類別<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildaytype" id="hoildaytype_1" value="0" />
                <label for="hoildaytype_1">全年無休</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildaytype" id="hoildaytype_2" value="1" />
                <label for="hoildaytype_2">周休一日</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildaytype" id="hoildaytype_3" value="2" checked/>
                <label for="hoildaytype_3">周休二日</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildaytype" id="hoildaytype_4" value="3" />
                <label for="hoildaytype_4">每月單數周休一日，雙數周休二日</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="hoildaytype" id="hoildaytype_5" value="4" />
                <label for="hoildaytype_5">每月單數周休二日，雙數周休一日</label>
            </div>
             
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Attendance" />
  </form>
  <?php } ?>
  
  <?php if($totalRows_RecordAttendance > 0) { ?>
  <div class="alert alert-danger m-10"><i class="fa fa-info-circle"></i> <b>目前已有產生資料，若欲重新產生請將之清空</b></div>																					
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <div class="col-md-12">
            <button type="submit" class="btn btn btn-primary btn-block">清空資料表</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_del" value="form_Attendance" />
  </form>
  <?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordCalendar);
?>