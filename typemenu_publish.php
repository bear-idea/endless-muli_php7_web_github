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

$collang_RecordPublishMultiTypeMenu_l1 = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordPublishMultiTypeMenu_l1 = $_SESSION['lang'];
}
$coluserid_RecordPublishMultiTypeMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPublishMultiTypeMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublishMultiTypeMenu_l1 = sprintf("SELECT * FROM demo_publishitem WHERE list_id = 1 && lang = %s && userid=%s ORDER BY item_id DESC", GetSQLValueString($collang_RecordPublishMultiTypeMenu_l1, "text"),GetSQLValueString($coluserid_RecordPublishMultiTypeMenu_l1, "int"));
$RecordPublishMultiTypeMenu_l1 = mysqli_query($DB_Conn, $query_RecordPublishMultiTypeMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordPublishMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordPublishMultiTypeMenu_l1);
$totalRows_RecordPublishMultiTypeMenu_l1 = mysqli_num_rows($RecordPublishMultiTypeMenu_l1);
?>
<?php if ($totalRows_RecordPublishMultiTypeMenu_l1 > 0) { // Show if recordset not empty ?>
<?php do { ?>
                <span class="child btn typemenu_btn">
                <a href="<?php echo $SiteBaseUrl . url_rewrite("publish",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $type_params; ?><?php echo urlencode($row_RecordPublishMultiTypeMenu_l1['itemname']); ?>"><?php echo $row_RecordPublishMultiTypeMenu_l1['itemname']; ?>
                </a>
                </span>
            <?php } while ($row_RecordPublishMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordPublishMultiTypeMenu_l1)); ?>
<?php } // Show if recordset not empty ?>

<?php
mysqli_free_result($RecordPublishMultiTypeMenu_l1);
?>