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

$collang_RecordModlinkMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordModlinkMultiTopMenu_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkMultiTopMenu_l1 = sprintf("SELECT * FROM demo_modlinkitem WHERE list_id = 1 && lang = %s ORDER BY item_id DESC", GetSQLValueString($collang_RecordModlinkMultiTopMenu_l1, "text"));
$RecordModlinkMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordModlinkMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordModlinkMultiTopMenu_l1 = mysqli_fetch_assoc($RecordModlinkMultiTopMenu_l1);
$totalRows_RecordModlinkMultiTopMenu_l1 = mysqli_num_rows($RecordModlinkMultiTopMenu_l1);
?>
        <ul>
            <?php do { ?>
                <li class="child">
                <a href="modlink.php?Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Modlink&searchkey=<?php echo urlencode($row_RecordModlinkMultiTopMenu_l1['itemname']); ?>"><?php echo $row_RecordModlinkMultiTopMenu_l1['itemname']; ?>
                </a>
                </li>
            <?php } while ($row_RecordModlinkMultiTopMenu_l1 = mysqli_fetch_assoc($RecordModlinkMultiTopMenu_l1)); ?>
            </ul>
<?php
mysqli_free_result($RecordModlinkMultiTopMenu_l1);
?>