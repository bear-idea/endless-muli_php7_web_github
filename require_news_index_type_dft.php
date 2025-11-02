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


$maxRows_RecordNewsTab = 30;
$pageTab = 0;
if (isset($_GET['pageTab'])) {
  $pageTab = $_GET['pageTab'];
}
$startRow_RecordNewsTab = $pageTab * $maxRows_RecordNewsTab;

$collang_RecordNewsTab = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsTab = $_GET['lang'];
}
$coluserid_RecordNewsTab = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsTab = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsTab = sprintf("SELECT * FROM demo_news WHERE lang=%s && indicate=1 && userid=%s", GetSQLValueString($collang_RecordNewsTab, "text"),GetSQLValueString($coluserid_RecordNewsTab, "int"));
$query_limit_RecordNewsTab = sprintf("%s LIMIT %d, %d", $query_RecordNewsTab, $startRow_RecordNewsTab, $maxRows_RecordNewsTab);
$RecordNewsTab = mysqli_query($DB_Conn, $query_limit_RecordNewsTab) or die(mysqli_error($DB_Conn));
$row_RecordNewsTab = mysqli_fetch_assoc($RecordNewsTab);

if (isset($_GET['totalRows_RecordNewsTab'])) {
  $totalRows_RecordNewsTab = $_GET['totalRows_RecordNewsTab'];
} else {
  $all_RecordNewsTab = mysqli_query($DB_Conn, $query_RecordNewsTab);
  $totalRows_RecordNewsTab = mysqli_num_rows($all_RecordNewsTab);
}
$totalPages_RecordNewsTab = ceil($totalRows_RecordNewsTab/$maxRows_RecordNewsTab)-1;
	////////////////////////////
?>
<style>
.NewsTab{
}
.NewsTab tr{
}
.NewsTab tr td{
	margin: 5px;
	padding: 5px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: dotted;
	border-top-color: #CCC;
	border-right-color: #CCC;
	border-bottom-color: #CCC;
	border-left-color: #CCC;
}

</style>

	<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="NewsTab">
	<?php do { ?>
      <tr>
        <td>
			<?php if($row_RecordNewsTab['type'] != "") {  ?>
              <span class="TipTypeStyle">[<?php echo $row_RecordNewsTab['type']; ?>]</span> 
            <?php  } ?>
		    <a href="news.php?Opt=detailed&amp;tp=<?php echo $_GET['tp']; ?>&amp;lang=<?php echo $_GET['lang']; ?>&amp;id=<?php echo $row_RecordNewsTab['id']; ?>"><?php echo $row_RecordNewsTab['title']; ?></a></td>   
        <td width="90"><?php echo date('Y/m/d',strtotime($row_RecordNewsTab['postdate'])); ?></td>
      </tr>
    <?php } while ($row_RecordNewsTab = mysqli_fetch_assoc($RecordNewsTab)); ?>
    </table>
	
  
<?php
	//break;			
//}
?>
<?php
mysqli_free_result($RecordNewsTab);
?>
