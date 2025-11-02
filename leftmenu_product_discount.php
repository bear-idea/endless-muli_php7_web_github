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

$collang_RecordProductDiscountMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductDiscountMultiLeftMenu_l1 = $_GET['lang'];
}
$coluserid_RecordProductDiscountMultiLeftMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductDiscountMultiLeftMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductDiscountMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_productdiscount WHERE lang = %s && menuindicate = '1' && userid=%s ORDER BY sortid ASC", GetSQLValueString($collang_RecordProductDiscountMultiLeftMenu_l1, "text"),GetSQLValueString($coluserid_RecordProductDiscountMultiLeftMenu_l1, "int"));
$RecordProductDiscountMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordProductDiscountMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordProductDiscountMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordProductDiscountMultiLeftMenu_l1);
$totalRows_RecordProductDiscountMultiLeftMenu_l1 = mysqli_num_rows($RecordProductDiscountMultiLeftMenu_l1);
?>
<?php if ($totalRows_RecordProductDiscountMultiLeftMenu_l1 > 0) { ?>
        <?php do { ?>
            <li class="child list-group-item <?php if($row_RecordTmpConfig['tmpcolumnmenumode'] == "1") { echo "dropdown";} ?>">
                 <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'discount'),'',$UrlWriteEnable);?><?php echo $discount_params; ?><?php echo $row_RecordProductDiscountMultiLeftMenu_l1['id']; ?>"><?php echo $row_RecordProductDiscountMultiLeftMenu_l1['menuname']; ?></a>
            </li>
        <?php } while ($row_RecordProductDiscountMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordProductDiscountMultiLeftMenu_l1)); ?> 
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProductDiscountMultiLeftMenu_l1);
?>