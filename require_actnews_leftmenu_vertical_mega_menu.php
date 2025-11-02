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

$collang_RecordMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMultiLeftMenu_l1 = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_actnewsitem WHERE list_id = 1 && lang = %s ORDER BY item_id DESC", GetSQLValueString($collang_RecordMultiLeftMenu_l1, "text"));
$RecordMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1);
$totalRows_RecordMultiLeftMenu_l1 = mysqli_num_rows($RecordMultiLeftMenu_l1);
?>
<script type='text/javascript' src='js/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script><script type='text/javascript' src='<?php echo $TplJsPath; ?>/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-1').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'right'
	});
});
</script>
<link href="css/vertical-mega-menu/vertical_menu_basic.css" rel="stylesheet" type="text/css" />
<div class="dcjq-vertical-mega-menu">
        <ul id="mega-1" class="menu">
        <?php do { ?>
             <li class="child">
            <a href="actnews.php?Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Actnews&searchkey=<?php echo urlencode($row_RecordMultiLeftMenu_l1['itemname']); ?>"><?php echo $row_RecordMultiLeftMenu_l1['itemname']; ?>
            </a>
            </li>
        <?php } while ($row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1)); ?>
        </ul>
</div>
<?php
mysqli_free_result($RecordMultiLeftMenu_l1);
?>
