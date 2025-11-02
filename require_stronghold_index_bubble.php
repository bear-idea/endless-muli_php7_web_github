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

$maxRows_RecordStronghold = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordStronghold = $page * $maxRows_RecordStronghold;

$colname_RecordStronghold = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordStronghold = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStronghold = sprintf("SELECT * FROM demo_stronghold WHERE lang = %s && indicate = 1 ORDER BY rand()", GetSQLValueString($colname_RecordStronghold, "text"));
$query_limit_RecordStronghold = sprintf("%s LIMIT %d, %d", $query_RecordStronghold, $startRow_RecordStronghold, $maxRows_RecordStronghold);
$RecordStronghold = mysqli_query($DB_Conn, $query_limit_RecordStronghold) or die(mysqli_error($DB_Conn));
$row_RecordStronghold = mysqli_fetch_assoc($RecordStronghold);

if (isset($_GET['totalRows_RecordStronghold'])) {
  $totalRows_RecordStronghold = $_GET['totalRows_RecordStronghold'];
} else {
  $all_RecordStronghold = mysqli_query($DB_Conn, $query_RecordStronghold);
  $totalRows_RecordStronghold = mysqli_num_rows($all_RecordStronghold);
}
$totalPages_RecordStronghold = ceil($totalRows_RecordStronghold/$maxRows_RecordStronghold)-1;
?>
<style type="text/css">
<!--
.Stronghold_Wrp_Bubble_wrp {
	padding: 0px;
	width: 100%;
	background-color: #FFF;
	height: 100px;
	border: 1px solid #999;
}

.Stronghold_Wrp_Bubble_Content{
	padding: 2px;
	float: left;
	border: 3px solid #E7E7E7;
	background-color: #FFF;
	margin: 10px;
	width: 96px;
	height: 60px;
}

.Stronghold_Wrp_Bubble_Content a{
	position: absolute;
	z-index: 10;
}

.Stronghold_Wrp_Bubble_Content a:hover{
	z-index: 100;
	margin-top:10px;
}

.Stronghold_Wrp_Bubble_Content img {
	position: absolute;
	border: 2px solid #E8E8E8;
	overflow: hidden;
	background-color: #FFF;
	margin: 0px;
	padding: 5px;
}
-->
</style>
<?php
/*********************************************************************
 # 主頁面贊助廠商
 *********************************************************************/
?>
<?php
#
# 標題部分
?>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td width="50%">贊助廠商</td>
      <td align="right"><a href="stronghold.php?Opt_Stronghold=viewpage&amp;navi=<?php echo $_GET['navi']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $Lang_Content_Title_More; // 更多?></a></td>
    </tr>
</table>
</div>
<?php
?>
<div></div>
<?php 
if ($totalRows_RecordStronghold > 0) {
#
# [if]
# 在此判斷式之內放置要顯示之內容 
?> 
<br /> 
<div class="Stronghold_Wrp_Bubble_wrp">
    <?php 
	#
	# [do]
    # 重複印出所有資料
    do { 
    ?>
        <div class="Stronghold_Wrp_Bubble_Content" ><a href="<?php echo $row_RecordStronghold['link']; ?>" target="_blank"><img src="upload/image/stronghold/<?php echo $row_RecordStronghold['pic']; ?>" alt="<?php echo $row_RecordStronghold['name']; ?>" /></a> 
</div>
    <?php 
    } while ($row_RecordStronghold = mysqli_fetch_assoc($RecordStronghold));
    # [while]
    ?>
</div>
<?php 
# [/if]
} 
else {
#
# [else]
# 在此判斷式之內放置當無資料時顯示之內容
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      <tr>
        <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
      </tr>
    </table>
<?php 
# [/else]
} 
?>
<script language="javascript">
jQuery(document).ready(function() {
  	$(".Stronghold_Wrp_Bubble_Content img").bubbleup({tooltip: false, scale:150});
});
</script>
<?php
mysqli_free_result($RecordStronghold);
?>
