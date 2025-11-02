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

$colname_RecordNewsReply = "-1";
if (isset($row_RecordNewsPost['id'])) {
  $colname_RecordNewsReply = $row_RecordNewsPost['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsReply = sprintf("SELECT * FROM demo_newsreply WHERE pid = %s ORDER BY rid DESC", GetSQLValueString($colname_RecordNewsReply, "int"));
$RecordNewsReply = mysqli_query($DB_Conn, $query_RecordNewsReply) or die(mysqli_error($DB_Conn));
$row_RecordNewsReply = mysqli_fetch_assoc($RecordNewsReply);
$totalRows_RecordNewsReply = mysqli_num_rows($RecordNewsReply);

$queryString_RecordNewsReply = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageReply") == false && 
        stristr($param, "totalRows_RecordNewsReply") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordNewsReply = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordNewsReply = sprintf("&totalRows_RecordNewsReply=%d%s", $totalRows_RecordNewsReply, $queryString_RecordNewsReply);
?>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordNewsReply > 0) { // Show if recordset not empty 
?>
    <?php do { ?>
		<div style="background-color:#ebeff8; padding:5px; margin-top:5px;">
          回覆：<br />
          <?php echo nl2br($row_RecordNewsReply['content']);?>
		</div>
    <?php } while ($row_RecordNewsReply = mysqli_fetch_assoc($RecordNewsReply)); ?>

<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php
mysqli_free_result($RecordNewsReply);
?>
