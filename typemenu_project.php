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

$collang_RecordProjectMultiTypeMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProjectMultiTypeMenu_l1 = $_GET['lang'];
}
$coluserid_RecordProjectMultiTypeMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProjectMultiTypeMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectMultiTypeMenu_l1 = sprintf("SELECT * FROM demo_projectitem WHERE list_id = 1 && lang = %s && userid=%s ORDER BY item_id DESC", GetSQLValueString($collang_RecordProjectMultiTypeMenu_l1, "text"),GetSQLValueString($coluserid_RecordProjectMultiTypeMenu_l1, "int"));
$RecordProjectMultiTypeMenu_l1 = mysqli_query($DB_Conn, $query_RecordProjectMultiTypeMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordProjectMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordProjectMultiTypeMenu_l1);
$totalRows_RecordProjectMultiTypeMenu_l1 = mysqli_num_rows($RecordProjectMultiTypeMenu_l1);
?>
<?php if ($totalRows_RecordProjectMultiTypeMenu_l1 > 0) { // Show if recordset not empty ?>
<?php do { ?>
                    <span class="child btn typemenu_btn">
                    <a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $type_params; ?><?php echo urlencode($row_RecordProjectMultiTypeMenu_l1['itemname']); ?>"><?php echo $row_RecordProjectMultiTypeMenu_l1['itemname']; ?>
                    </a>
                    </span>
                <?php } while ($row_RecordProjectMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordProjectMultiTypeMenu_l1)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProjectMultiTypeMenu_l1);
?>