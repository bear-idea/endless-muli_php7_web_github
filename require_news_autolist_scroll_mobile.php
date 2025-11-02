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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordNewsAutoListScroll = 30;
$pageAutoListScroll = 0;
if (isset($_GET['pageAutoListScroll'])) {
  $pageAutoListScroll = $_GET['pageAutoListScroll'];
}
$startRow_RecordNewsAutoListScroll = $pageAutoListScroll * $maxRows_RecordNewsAutoListScroll;

$collang_RecordNewsAutoListScroll = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsAutoListScroll = $_GET['lang'];
}
$coluserid_RecordNewsAutoListScroll = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsAutoListScroll = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsAutoListScroll = sprintf("SELECT * FROM demo_news WHERE indicate=1 && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($collang_RecordNewsAutoListScroll, "text"),GetSQLValueString($coluserid_RecordNewsAutoListScroll, "int"));
$query_limit_RecordNewsAutoListScroll = sprintf("%s LIMIT %d, %d", $query_RecordNewsAutoListScroll, $startRow_RecordNewsAutoListScroll, $maxRows_RecordNewsAutoListScroll);
$RecordNewsAutoListScroll = mysqli_query($DB_Conn, $query_limit_RecordNewsAutoListScroll) or die(mysqli_error($DB_Conn));
$row_RecordNewsAutoListScroll = mysqli_fetch_assoc($RecordNewsAutoListScroll);

if (isset($_GET['totalRows_RecordNewsAutoListScroll'])) {
  $totalRows_RecordNewsAutoListScroll = $_GET['totalRows_RecordNewsAutoListScroll'];
} else {
  $all_RecordNewsAutoListScroll = mysqli_query($DB_Conn, $query_RecordNewsAutoListScroll);
  $totalRows_RecordNewsAutoListScroll = mysqli_num_rows($all_RecordNewsAutoListScroll);
}
$totalPages_RecordNewsAutoListScroll = ceil($totalRows_RecordNewsAutoListScroll/$maxRows_RecordNewsAutoListScroll)-1;
?>
<?php if ($totalRows_RecordNewsAutoListScroll > 0) { // Show if recordset not empty ?>
<ul class="list-group list-group-bordered list-group-noicon uppercase">
    <?php do { ?>
      <li class="list-group-item"><a href="<?php echo $SiteBaseUrl . url_rewrite("news",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordNewsAutoListScroll['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordNewsAutoListScroll['title']; ?></a></li>
      <?php } while ($row_RecordNewsAutoListScroll = mysqli_fetch_assoc($RecordNewsAutoListScroll)); ?>
  </ul>

<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordNewsAutoListScroll);
?>
