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

$maxRows_RecordAttractions = 6;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordAttractions = $page * $maxRows_RecordAttractions;

$colname_RecordAttractions = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAttractions = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractions = sprintf("SELECT * FROM demo_attractions WHERE lang = %s && indicate = 1 ORDER BY rand()", GetSQLValueString($colname_RecordAttractions, "text"));
$query_limit_RecordAttractions = sprintf("%s LIMIT %d, %d", $query_RecordAttractions, $startRow_RecordAttractions, $maxRows_RecordAttractions);
$RecordAttractions = mysqli_query($DB_Conn, $query_limit_RecordAttractions) or die(mysqli_error($DB_Conn));
$row_RecordAttractions = mysqli_fetch_assoc($RecordAttractions);

if (isset($_GET['totalRows_RecordAttractions'])) {
  $totalRows_RecordAttractions = $_GET['totalRows_RecordAttractions'];
} else {
  $all_RecordAttractions = mysqli_query($DB_Conn, $query_RecordAttractions);
  $totalRows_RecordAttractions = mysqli_num_rows($all_RecordAttractions);
}
$totalPages_RecordAttractions = ceil($totalRows_RecordAttractions/$maxRows_RecordAttractions)-1;
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
      <td align="right"><a href="attractions.php?Opt_Attractions=viewpage&amp;navi=<?php echo $_GET['navi']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $Lang_Content_Title_More; // 更多?></a></td>
    </tr>
</table>
<?php
?>

<?php 
if ($totalRows_RecordAttractions > 0) {
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
        <div class="attractions_board"><a href="<?php echo $row_RecordAttractions['link']; ?>" target="_blank"><img src="upload/image/attractions/<?php echo $row_RecordAttractions['pic']; ?>" alt="<?php echo $row_RecordAttractions['name']; ?>"  class="reflect" /></a> 
</div>
    <?php 
    } while ($row_RecordAttractions = mysqli_fetch_assoc($RecordAttractions));
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
mysqli_free_result($RecordAttractions);
?>
