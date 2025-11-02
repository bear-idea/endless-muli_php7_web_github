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
<table class="calendar_blog" cellpadding="0" cellspacing="0">
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
          print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=viewpage&amp;tp=Blog&amp;lang=".$_SESSION['lang']."&MM=".$preMonth."&YY=".$preYear.">←</a>");
          print("".strftime("%b %Y",mktime (0,0,0,$MM,1,$YYYY))."");
          print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=viewpage&amp;tp=Blog&amp;lang=".$_SESSION['lang']."&MM=".$nextMonth."&YY=".$nextYear.">→</a>");
//<--------上一年,下一年,上月,下月;?束--------->
?>
</td>

</td>
</tr>
<tr align=center class="week_text">
<?php
echo "<td class='red_text'>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td>";
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
echo "<td align=center ".bgcolor($MM,$bgtoday,1,$YYYY)."><font color=".font_color($MM,1,$YYYY).">".font_style($MM,1,$YYYY);
//echo "1";
//mysqli_select_db($database_DB_Conn, $DB_Conn);
            $query_RecordsetCat = "SELECT postdate FROM demo_blog where date(postdate)='" .($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))."' && userid=". $_SESSION['userid'];
            $RecordsetCat = mysqli_query($DB_Conn, $query_RecordsetCat) or die(mysqli_error($DB_Conn));
            $row_RecordsetCat = mysqli_fetch_assoc($RecordsetCat);	
            if(($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))==date("Y-m-d",strtotime($row_RecordsetCat['postdate']))){
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
echo "<td align=center ".bgcolor($MM,$bgtoday,$i,$YYYY)."><font color=".font_color($MM,$i,$YYYY).">".font_style($MM,$i,$YYYY);
//echo $i."*";
//mysqli_select_db($database_DB_Conn, $DB_Conn);
            $query_RecordsetCa = "SELECT postdate FROM demo_blog where date(postdate)='" .($YYYY . "-" . $MM ."-" . substr("0" . $i,-2))."' && userid=". $_SESSION['userid'];
            $RecordsetCa = mysqli_query($DB_Conn, $query_RecordsetCa) or die(mysqli_error($DB_Conn));
            $row_RecordsetCa = mysqli_fetch_assoc($RecordsetCa);	
            if(($YYYY . "-" . $MM ."-" . substr("0" . $i,-2))==date("Y-m-d",strtotime($row_RecordsetCa['postdate']))){
            print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=viewpage&amp;tp=Blog&amp;lang=".$_SESSION['lang']."&MM=".$MM."&YY=".$YYYY."&DD=" . substr("0" . $i,-2) . "><b>$i</b></a>");
            }else{
            	echo $i;
            }
echo "</font></td>\n";
if(date("w",mktime(0,0,0,$MM,$i,$YYYY))==6)//判斷該日是否星期六
{
echo "</tr>\n";
}
}
?>
</table>
</div>