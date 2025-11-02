<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
include("../admin/counter_setting.php");
$root_path="./";
include("../admin/" . $lang);

$sql = "SELECT `id` FROM demo_counterrecord;";
$result = mysqli_query($DB_Conn, $sql);
$row = mysqli_num_rows($result);
?>
<body  style="background-color:transparent">
<?php 

switch ($counter_style)
{
	case (0):
?>
<table width="190" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="190" height="20">
    <?php 
	$row += $counterstartnum;
	$pic .= "<img src=\"images/" . $counterstyle . "/ct_0011_Right.png\" border=\"0\">";
	$pic .= "<img src=\"images/" . $counterstyle . "/ct_0012_Mid.png\" border=\"0\">";
	for ($i=0; $i<strlen($row); $i++)
	{
		$temp = substr($row, $i, 1);
		if ($temp == "0")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0000_00.png\" border=\"0\">";
		elseif ($temp == "1")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0001_01.png\" border=\"0\">";
		elseif ($temp == "2")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0002_02.png\" border=\"0\">";
		elseif ($temp == "3")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0003_03.png\" border=\"0\">";
		elseif ($temp == "4")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0004_04.png\" border=\"0\">";
		elseif ($temp == "5")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0005_05.png\" border=\"0\">";
		elseif ($temp == "6")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0006_06.png\" border=\"0\">";
		elseif ($temp == "7")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0007_07.png\" border=\"0\">";
		elseif ($temp == "8")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0008_08.png\" border=\"0\">";
		elseif ($temp == "9")
		$pic .= "<img src=\"images/" . $counterstyle . "/ct_0009_09.png\" border=\"0\">";		
	}
	$pic .= "<img src=\"images/" . $counterstyle . "/ct_0010_Left.png\" border=\"0\">";
	?>
	<?php echo $pic; ?>
    </td>
  </tr>
</table>
<?php 
mysqli_free_result($result);
break;
	default:
$ip = getenv("REMOTE_ADDR");
$time = time();

$sql = "SELECT `time`, `ip` FROM demo_counterrecord WHERE `ip`= \"$ip\" ORDER BY `id` DESC;";
$result = mysqli_query($DB_Conn, $sql);
$old = mysqli_fetch_row($result);

$left = $time - $old[0];

$count = $time + 86400;
for ($i=0; $i<=2; $i++)
{
	$temp = date("Y-m-d", $count);
	$div[$i] = strtotime($temp);
	$count -= 86400;
}

$div[3] = $time - 10800;

for ($i=0; $i<=1; $i++)
{
	$temp = $div[$i+1];
	$sql = "SELECT `time` FROM demo_counterrecord WHERE `time` < \"$div[$i]\" AND `time` >= \"$temp\";";
	$result = mysqli_query($DB_Conn, $sql);
	$stat[$i] = mysqli_num_rows($result);
}

$sql = "SELECT `time` FROM demo_counterrecord WHERE `time` >= \"$div[3]\";";
$result = mysqli_query($DB_Conn, $sql);
$stat[2] = mysqli_num_rows($result);

$time = $next - $left;

$time = $time < 1 ? 3600 : $time;

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20">
    <marquee width="150" scrolldelay="100" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();" style="line-height=14px">
			<a>
			<span style="font-size:12px;"><?php echo $lang_c[total]; ?>:<b><?php echo $row; ?></b> <?php echo $lang_c[day]; ?>:<b><?php echo $stat[0]; ?></b><?php echo  $lang_c[yday]; ?>:<b><?php echo $stat[1]; ?></b> <?php echo $lang_c[thr]; ?>:<b><?php echo $stat[2]; ?></b> <?php echo $lang_c[remain]; ?>:<b><?php echo $time ?></b> <?php echo $lang_c[sec]; ?></span>
			</a>
			</marquee>
     </td>
  </tr>
</table>
<?php 
mysqli_free_result($result);
break;
}
?>