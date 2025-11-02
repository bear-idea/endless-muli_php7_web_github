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

$colname_RecordProductReply = "-1";
if (isset($row_RecordProductPost['id'])) {
  $colname_RecordProductReply = $row_RecordProductPost['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductReply = sprintf("SELECT * FROM demo_productreply WHERE pid = %s ORDER BY rid DESC", GetSQLValueString($colname_RecordProductReply, "int"));
$RecordProductReply = mysqli_query($DB_Conn, $query_RecordProductReply) or die(mysqli_error($DB_Conn));
$row_RecordProductReply = mysqli_fetch_assoc($RecordProductReply);
$totalRows_RecordProductReply = mysqli_num_rows($RecordProductReply);

$queryString_RecordProductReply = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageReply") == false && 
        stristr($param, "totalRows_RecordProductReply") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProductReply = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProductReply = sprintf("&totalRows_RecordProductReply=%d%s", $totalRows_RecordProductReply, $queryString_RecordProductReply);
?>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordProductReply > 0) { // Show if recordset not empty 
?>
    <?php do { ?>
		<div style="background-color:#ebeff8; padding:5px; margin-top:5px;">
          回覆：<br />
          <?php echo nl2br($row_RecordProductReply['content']);?>
		</div>
    <?php } while ($row_RecordProductReply = mysqli_fetch_assoc($RecordProductReply)); ?>

<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php
mysqli_free_result($RecordProductReply);
?>
