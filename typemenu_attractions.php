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
$collang_RecordAttractionsMultiTypeMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAttractionsMultiTypeMenu_l1 = $_GET['lang'];
}
$coluserid_RecordAttractionsMultiTypeMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAttractionsMultiTypeMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractionsMultiTypeMenu_l1 = sprintf("SELECT * FROM demo_attractionsitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordAttractionsMultiTypeMenu_l1, "text"),GetSQLValueString($coluserid_RecordAttractionsMultiTypeMenu_l1, "int"));
$RecordAttractionsMultiTypeMenu_l1 = mysqli_query($DB_Conn, $query_RecordAttractionsMultiTypeMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordAttractionsMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordAttractionsMultiTypeMenu_l1);
$totalRows_RecordAttractionsMultiTypeMenu_l1 = mysqli_num_rows($RecordAttractionsMultiTypeMenu_l1);
?>
<?php if ($totalRows_RecordAttractionsMultiTypeMenu_l1 > 0) { // Show if recordset not empty ?>
<?php do { ?>
                <span class="child btn typemenu_btn">
                <a href="<?php echo $SiteBaseUrl . url_rewrite("attractions",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $key_params . urlencode($row_RecordAttractionsMultiTypeMenu_l1['itemname']); ?>"><?php echo $row_RecordAttractionsMultiTypeMenu_l1['itemname']; ?>
                </a>
                </span>
            <?php } while ($row_RecordAttractionsMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordAttractionsMultiTypeMenu_l1)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordAttractionsMultiTypeMenu_l1);
?>