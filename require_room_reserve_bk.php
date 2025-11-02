<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordRoom,$prev_RecordRoom,$next_RecordRoom,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordRoom,$totalRows_RecordRoom;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordRoom && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordRoom)
			{
				$egp = $totalPages_RecordRoom+1;
				$fgp = $totalPages_RecordRoom - ($max_links-1) > 0 ? $totalPages_RecordRoom  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordRoom >= $max_links ? $max_links : $totalPages_RecordRoom+1;
		}
		if($totalPages_RecordRoom >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $page+1;
			$precedente = $page-1;
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordRoom</a>" :  "<span>$prev_RecordRoom</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordRoom) + 1;
					$max_l = ($a*$maxRows_RecordRoom >= $totalRows_RecordRoom) ? $totalRows_RecordRoom : ($a*$maxRows_RecordRoom);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $page)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?page=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $page+1;
			$offset_end = $totalPages_RecordRoom;
			$lastArray = ($page < $totalPages_RecordRoom) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordRoom</a>" : "<span>$next_RecordRoom</span>"; /* css */
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordRoom = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordRoom = $page * $maxRows_RecordRoom;

$colname_RecordRoom = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordRoom = $_GET['searchkey'];
}
$coluserid_RecordRoom = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoom = $_SESSION['userid'];
}
$coltype1_RecordRoom = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordRoom = $_GET['type1'];
}
$coltype2_RecordRoom = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordRoom = $_GET['type2'];
}
$coltype3_RecordRoom = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordRoom = $_GET['type3'];
}
$colnamelang_RecordRoom = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordRoom = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoom = sprintf("SELECT * FROM demo_room WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordRoom . "%", "text"),GetSQLValueString("%" . $colname_RecordRoom . "%", "text"),GetSQLValueString($colnamelang_RecordRoom, "text"),GetSQLValueString($coltype1_RecordRoom, "text"),GetSQLValueString($coltype2_RecordRoom, "text"),GetSQLValueString($coltype3_RecordRoom, "text"),GetSQLValueString($coluserid_RecordRoom, "int"));
$query_limit_RecordRoom = sprintf("%s LIMIT %d, %d", $query_RecordRoom, $startRow_RecordRoom, $maxRows_RecordRoom);
$RecordRoom = mysqli_query($DB_Conn, $query_limit_RecordRoom) or die(mysqli_error($DB_Conn));
$row_RecordRoom = mysqli_fetch_assoc($RecordRoom);

if (isset($_GET['totalRows_RecordRoom'])) {
  $totalRows_RecordRoom = $_GET['totalRows_RecordRoom'];
} else {
  $all_RecordRoom = mysqli_query($DB_Conn, $query_RecordRoom);
  $totalRows_RecordRoom = mysqli_num_rows($all_RecordRoom);
}
$totalPages_RecordRoom = ceil($totalRows_RecordRoom/$maxRows_RecordRoom)-1;

$queryString_RecordRoom = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordRoom") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordRoom = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordRoom = sprintf("&totalRows_RecordRoom=%d%s", $totalRows_RecordRoom, $queryString_RecordRoom);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php require_once('Connections/DB_Conn.php'); ?>
<?php

//<-------GET方法提交變更月份,年份;開始-------->

$MM=$_GET["MM"];   
$YYYY=$_GET["YY"];
if($_GET["YY"]=="")
{
$YYYY=date("Y");
}
if($_GET["MM"]=="")
{
$MM=date("m");
}
//<-------GET方法提交變更月份,年份;?束-------->

if($YYYY<1971)//年度最少到1971年，小於1971年，則需回到今年的日曆
{
$YYYY=date("Y");
}
?>
<style type="text/css">
.calendar_blog tr td{
	padding:2px;
}
</style>

<div align="center">
<table border="1" cellpadding="0" cellspacing="0" class="calendar_blog">
<tr align="center">
<td colspan="7">
<?php
//<-------月份超出1至12的處理;開始------->
if($MM<1)
{
$MM=12;
$YYYY-=1;
}
if($MM>12)
{
$MM=1;
$YYYY+=1;
}
//<-------月份超出1至12的處理;?束------->

//<---------上一年,下一年,上月,下月;開始--------->
/*echo "<a href=$_SERVER[PHP_SELF]?YY=".($YYYY-1)."&MM=".$MM."><<</a>".$YYYY."<a href=$_SERVER[PHP_SELF]?YY=".($YYYY+1)."&MM=".$MM.">>></a>"; //上下年
?>
<?php
echo "<a href=$_SERVER[PHP_SELF]?MM=".($MM-1)."&YY=".$YYYY."><<</a>".$MM."<a href=$_SERVER[PHP_SELF]?MM=".($MM+1)."&YY=".$YYYY.">>></a>";*///上下月
$stringDate = strftime("%d %b %Y",mktime (0,0,0,$MM,1,$YYYY));
        $days = strftime("%d",mktime (0,0,0,$MM+1,0,$YYYY));
        $firstDay = strftime("%w",mktime (0,0,0,$MM,1,$YYYY));
        $lastDay = strftime("%w",mktime (0,0,0,$MM,$days,$YYYY));
        $printDays = $days;
        $preMonth = strftime("%m",mktime (0,0,0,$MM-1,1,$YYYY));
        $preYear = strftime("%Y",mktime (0,0,0,$MM-1,1,$YYYY));
        $nextMonth = strftime("%m",mktime (0,0,0,$MM+1,1,$YYYY));
        $nextYear = strftime("%Y",mktime (0,0,0,$MM+1,1,$YYYY));
          print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=reserve&amp;tp=Room&amp;lang=".$_SESSION['lang']."&MM=".$preMonth."&YY=".$preYear.">←</a>");
          print("".strftime("%b %Y",mktime (0,0,0,$MM,1,$YYYY))."");
          print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=reserve&amp;tp=Room&amp;lang=".$_SESSION['lang']."&MM=".$nextMonth."&YY=".$nextYear.">→</a>");
//<--------上一年,下一年,上月,下月;?束--------->
?>
</td>

</td>
</tr>
<tr align=center class="week_text">
<?php
echo "<td class='red_text'>日</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td>";
echo "</tr>";
echo "<tr>";
$d=date("d");
$FirstDay=date("w",mktime(0,0,0,$MM,1,$YYYY));//取得任何一個月的一號是星期幾，來計自一號從第幾格開始。
$bgtoday=date("d");
function font_color($MM,$today,$YYYY)//計算星期天的字體顏色。
{
$sunday=date("w",mktime(0,0,0,$MM,$today,$YYYY));
if($sunday=="0")
{
$FontColor="red";
}
else
{
$FontColor="black";
}
return $FontColor;
}
function bgcolor($MM,$bgtoday,$today_i,$YYYY)//計算當日的背景顏色。
{
$show_today=date("d",mktime(0,0,0,$MM,$today_i,$YYYY));
$sys_today=date("d",mktime(0,0,0,$MM,$bgtoday,$YYYY));
if($show_today==$sys_today)
{
$bgcolor="bgcolor=#6699FF";
}
else
{
$bgcolor="";
}
return $bgcolor;
}
function font_style($MM,$today,$YYYY)//計算星期天的字體風格。
{
$sunday=date("w",mktime(0,0,0,$MM,$today,$YYYY));
if($sunday=="0")
{
$FontStyle="<strong>";
}
else
{
$FontStyle="";
}
return $FontStyle;
}
for($i=0;$i<=$FirstDay;$i++)//用for輸出每個月一號的位置
{
for($i;$i<$FirstDay;$i++)
{
echo "<td align=center>&nbsp;</td>\n";
}
if($i==$FirstDay)
{
echo "<td align=center".bgcolor($MM,$bgtoday,1,$YYYY)."><font color=".font_color($MM,1,$YYYY).">".font_style($MM,1,$YYYY);
//echo "1";
//mysqli_select_db($database_DB_Conn, $DB_Conn);
            $query_RecordsetCat = "SELECT checkindate FROM demo_roomorders where date(checkindate)='" .($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))."' && userid=". $_SESSION['userid'];
            $RecordsetCat = mysqli_query($DB_Conn, $query_RecordsetCat) or die(mysqli_error($DB_Conn));
            $row_RecordsetCat = mysqli_fetch_assoc($RecordsetCat);	
            if(($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))==date("Y-m-d",strtotime($row_RecordsetCat['checkindate']))){
            print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=viewpage&amp;tp=Blog&amp;lang=".$_SESSION['lang']."&MM=".$MM."&YY=".$YYYY."&DD=" . substr("0" . 1,-2) . "><b>1</b></a>");
            }else{
            	echo '1';
            }
echo "</font></td>\n";
if($FirstDay==6)//判斷1號是否星期六
{
echo "</tr>";
}
}
}
$countMonth=date("t",mktime(0,0,0,$MM,1,$YYYY));//某月的總天數
for($i=2;$i<=$countMonth;$i++)//輸出由1號定位,隨後2號直至月尾的所有號數
{
//echo "<td align=center>";
//echo $i."*";
//mysqli_select_db($database_DB_Conn, $DB_Conn);
            //$query_RecordsetCa = "SELECT checkindate FROM demo_roomorders where date(checkindate)='" .($YYYY . "-" . $MM ."-" . substr("0" . $i,-2))."' && userid=". $_SESSION['userid'];
			$query_RecordsetCa = "SELECT checkindate, checkoutdate FROM demo_roomorders where userid=". $_SESSION['userid'];
            $RecordsetCa = mysqli_query($DB_Conn, $query_RecordsetCa) or die(mysqli_error($DB_Conn));
            $row_RecordsetCa = mysqli_fetch_assoc($RecordsetCa);	
            if(strtotime($YYYY . "-" . $MM ."-" . substr("0" . $i,-2)) >= strtotime(date("Y-m-d",strtotime($row_RecordsetCa['checkindate'])))  && strtotime($YYYY . "-" . $MM ."-" . substr("0" . $i,-2)) <= strtotime(date("Y-m-d",strtotime($row_RecordsetCa['checkoutdate'])))){
            //print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=viewpage&amp;tp=Blog&amp;lang=".$_SESSION['lang']."&MM=".$MM."&YY=".$YYYY."&DD=" . substr("0" . $i,-2) . "><b>$i</b></a>");
			echo "<td align=center style=\"background-color:#456\">";
			    echo $i;
			    //echo "滿";
				echo $YYYY . "-" . $MM ."-" . substr("0" . $i,-2); // 目前此格之日期
				// date("Y-m-d",strtotime($row_RecordsetCa['checkindate']))
				//echo "x";
				//echo $begin = date("Y-m-d",strtotime($row_RecordsetCa['checkindate']));
				//echo $end = date("Y-m-d",strtotime($row_RecordsetCa['checkoutdate']));
				//echo margin($begin, $end);
				echo "</td>\n";
            }else{
				 echo "<td align=center>";
				//echo $i; // 顯示日期幾號
				echo $YYYY . "-" . $MM ."-" . substr("0" . $i,-2); // 目前此格之日期
				//echo $FirstDay; // 0 - 日 / 1 - 一 / ....
				$n_week = date("w",mktime(0,0,0,$MM,$i,$YYYY));
				switch($n_week)
				{
					case "0":
					$n_week_cg = "日";
					break;
					case "1":
					$n_week_cg = "一";
					break;
					case "2":
					$n_week_cg = "二";
					break;
					case "3":
					$n_week_cg = "三";
					break;
					case "4":
					$n_week_cg = "四";
					break;
					case "5":
					$n_week_cg = "五";
					break;
					case "6":
					$n_week_cg = "六";
					break;
				}
				echo "(" . $n_week_cg . ")"; // 判斷星期幾 // 0 - 日 / 1 - 一 / ....
				echo "</td>\n";
            	//echo "空";
				//echo $YYYY . "-" . $MM ."-" . substr("0" . $i,-2);
            }
//echo "</td>\n";
if(date("w",mktime(0,0,0,$MM,$i,$YYYY))==6)//判斷該日是否星期六
{
echo "</tr>\n";
}
}
?>
</table>
</div>
<?php } ?>

<?php
mysqli_free_result($RecordRoom);
?>