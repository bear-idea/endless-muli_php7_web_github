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

$maxRows_RecordSponsor = 6;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordSponsor = $page * $maxRows_RecordSponsor;

$colname_RecordSponsor = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordSponsor = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSponsor = sprintf("SELECT * FROM demo_sponsor WHERE lang = %s && indicate = 1 ORDER BY rand()", GetSQLValueString($colname_RecordSponsor, "text"));
$query_limit_RecordSponsor = sprintf("%s LIMIT %d, %d", $query_RecordSponsor, $startRow_RecordSponsor, $maxRows_RecordSponsor);
$RecordSponsor = mysqli_query($DB_Conn, $query_limit_RecordSponsor) or die(mysqli_error($DB_Conn));
$row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor);

if (isset($_GET['totalRows_RecordSponsor'])) {
  $totalRows_RecordSponsor = $_GET['totalRows_RecordSponsor'];
} else {
  $all_RecordSponsor = mysqli_query($DB_Conn, $query_RecordSponsor);
  $totalRows_RecordSponsor = mysqli_num_rows($all_RecordSponsor);
}
$totalPages_RecordSponsor = ceil($totalRows_RecordSponsor/$maxRows_RecordSponsor)-1;
?>
<?php
/*********************************************************************
 # 主頁面贊助廠商
 *********************************************************************/
?>
<?php
#
# 標題部分
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td width="50%">贊助廠商</td>
      <td align="right"><a href="sponsor.php?Opt_Sponsor=viewpage&amp;navi=<?php echo $_GET['navi']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $Lang_Content_Title_More; // 更多?></a></td>
    </tr>
</table>
<?php
?>

<?php 
if ($totalRows_RecordSponsor > 0) {
#
# [if]
# 在此判斷式之內放置要顯示之內容 
?> 
<br /> 
    <?php 
	#
	# [do]
    # 重複印出所有資料
    do { 
    ?>
        <div class="sponsor_board"><a href="<?php echo $row_RecordSponsor['link']; ?>" target="_blank"><img src="upload/image/sponsor/<?php echo $row_RecordSponsor['pic']; ?>" alt="<?php echo $row_RecordSponsor['name']; ?>"  class="reflect" /></a> 
</div>
    <?php 
    } while ($row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor));
    # [while]
    ?>

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

<?php
mysqli_free_result($RecordSponsor);
?>
