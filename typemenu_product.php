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

$collang_RecordProductMultiTypeMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductMultiTypeMenu_l1 = $_GET['lang'];
}
$coluserid_RecordProductMultiTypeMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductMultiTypeMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductMultiTypeMenu_l1 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordProductMultiTypeMenu_l1, "text"),GetSQLValueString($coluserid_RecordProductMultiTypeMenu_l1, "int"));
$RecordProductMultiTypeMenu_l1 = mysqli_query($DB_Conn, $query_RecordProductMultiTypeMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordProductMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordProductMultiTypeMenu_l1);
$totalRows_RecordProductMultiTypeMenu_l1 = mysqli_num_rows($RecordProductMultiTypeMenu_l1);
?>
<?php if ($totalRows_RecordProductMultiTypeMenu_l1 > 0) { ?>
        <?php do { ?>
            <span class="<?php echo $row_RecordProductMultiTypeMenu_l1['endnode']; ?> btn typemenu_btn">
            <?php if ($row_RecordProductMultiTypeMenu_l1['endnode'] != 'child') { ?>
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTypeMenu_l1['item_id']),'',$UrlWriteEnable);?>" class="dropdown-toggle"><?php echo $row_RecordProductMultiTypeMenu_l1['itemname']; ?></a>
			<?php } else { ?>
                 <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$row_RecordProductMultiTypeMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordProductMultiTypeMenu_l1['itemname']; ?></a>
            <?php }  ?>
            </span>
        <?php } while ($row_RecordProductMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordProductMultiTypeMenu_l1)); ?> 
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProductMultiTypeMenu_l1);
?>