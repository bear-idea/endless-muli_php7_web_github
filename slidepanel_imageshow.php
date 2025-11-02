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
$collang_RecordImageshowMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordImageshowMultiLeftMenu_l1 = $_GET['lang'];
}
$coluserid_RecordImageshowMultiLeftMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordImageshowMultiLeftMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordImageshowMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_imageshowitem WHERE list_id = 1 && lang = %s && userid=%s ORDER BY item_id DESC", GetSQLValueString($collang_RecordImageshowMultiLeftMenu_l1, "text"),GetSQLValueString($coluserid_RecordImageshowMultiLeftMenu_l1, "int"));
$RecordImageshowMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordImageshowMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordImageshowMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordImageshowMultiLeftMenu_l1);
$totalRows_RecordImageshowMultiLeftMenu_l1 = mysqli_num_rows($RecordImageshowMultiLeftMenu_l1);
?>
<?php if ($totalRows_RecordImageshowMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>
<ul class="list-group">
<?php do { ?>
                <li class="child list-group-item">
                <a href="<?php echo $SiteBaseUrl . url_rewrite("imageshow",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $key_params . urlencode($row_RecordImageshowMultiLeftMenu_l1['itemname']); ?>"><?php echo $row_RecordImageshowMultiLeftMenu_l1['itemname']; ?>
                </a>
                </li>
            <?php } while ($row_RecordImageshowMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordImageshowMultiLeftMenu_l1)); ?>
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordImageshowMultiLeftMenu_l1);
?>