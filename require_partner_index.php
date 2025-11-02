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

$maxRows_RecordPartner = 6;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordPartner = $page * $maxRows_RecordPartner;

$colname_RecordPartner = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordPartner = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPartner = sprintf("SELECT * FROM demo_partner WHERE lang = %s && indicate = 1 ORDER BY rand()", GetSQLValueString($colname_RecordPartner, "text"));
$query_limit_RecordPartner = sprintf("%s LIMIT %d, %d", $query_RecordPartner, $startRow_RecordPartner, $maxRows_RecordPartner);
$RecordPartner = mysqli_query($DB_Conn, $query_limit_RecordPartner) or die(mysqli_error($DB_Conn));
$row_RecordPartner = mysqli_fetch_assoc($RecordPartner);

if (isset($_GET['totalRows_RecordPartner'])) {
  $totalRows_RecordPartner = $_GET['totalRows_RecordPartner'];
} else {
  $all_RecordPartner = mysqli_query($DB_Conn, $query_RecordPartner);
  $totalRows_RecordPartner = mysqli_num_rows($all_RecordPartner);
}
$totalPages_RecordPartner = ceil($totalRows_RecordPartner/$maxRows_RecordPartner)-1;
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
      <td align="right"><a href="partner.php?Opt_Partner=viewpage&amp;navi=<?php echo $_GET['navi']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>"><?php echo $Lang_Content_Title_More; // 更多?></a></td>
    </tr>
</table>
<?php
?>

<?php 
if ($totalRows_RecordPartner > 0) {
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
        <div class="partner_board"><a href="<?php echo $row_RecordPartner['link']; ?>" target="_blank"><img src="upload/image/partner/<?php echo $row_RecordPartner['pic']; ?>" alt="<?php echo $row_RecordPartner['name']; ?>"  class="reflect" /></a> 
</div>
    <?php 
    } while ($row_RecordPartner = mysqli_fetch_assoc($RecordPartner));
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
mysqli_free_result($RecordPartner);
?>
