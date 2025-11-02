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

$colname_RecordBlogReply = "-1";
if (isset($row_RecordBlogPost['id'])) {
  $colname_RecordBlogReply = $row_RecordBlogPost['id'];
}
$coluserid_RecordBlogReply = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordBlogReply = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogReply = sprintf("SELECT * FROM demo_blogreply WHERE pid = %s && userid=%s ORDER BY rid DESC", GetSQLValueString($colname_RecordBlogReply, "int"),GetSQLValueString($coluserid_RecordBlogReply, "int"));
$RecordBlogReply = mysqli_query($DB_Conn, $query_RecordBlogReply) or die(mysqli_error($DB_Conn));
$row_RecordBlogReply = mysqli_fetch_assoc($RecordBlogReply);
$totalRows_RecordBlogReply = mysqli_num_rows($RecordBlogReply);$colname_RecordBlogReply = "-1";
if (isset($row_RecordBlogPost['id'])) {
  $colname_RecordBlogReply = $row_RecordBlogPost['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogReply = sprintf("SELECT * FROM demo_blogreply WHERE pid = %s ORDER BY rid DESC", GetSQLValueString($colname_RecordBlogReply, "int"));
$RecordBlogReply = mysqli_query($DB_Conn, $query_RecordBlogReply) or die(mysqli_error($DB_Conn));
$row_RecordBlogReply = mysqli_fetch_assoc($RecordBlogReply);
$totalRows_RecordBlogReply = mysqli_num_rows($RecordBlogReply);

$queryString_RecordBlogReply = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordBlogReply") == false && 
        stristr($param, "totalRows_RecordBlogReply") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordBlogReply = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordBlogReply = sprintf("&totalRows_RecordBlogReply=%d%s", $totalRows_RecordBlogReply, $queryString_RecordBlogReply);
?>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordBlogReply > 0) { // Show if recordset not empty 
?>
    <?php do { ?>
		<div style="background-color:#ebeff8; padding:5px; margin-top:5px;">
          回覆：<span style="float:right; color:#666;"><?php echo date('Y-m-d',strtotime($row_RecordBlogReply['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordBlogReply['postdate'])); ?>&nbsp;&nbsp;</span><br />
          <?php echo nl2br($row_RecordBlogReply['content']);?>
		</div>
    <?php } while ($row_RecordBlogReply = mysqli_fetch_assoc($RecordBlogReply)); ?>

<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php
mysqli_free_result($RecordBlogReply);
?>
