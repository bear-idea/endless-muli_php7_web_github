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

$colname_RecordDfTypeMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDfTypeMultiTopMenu_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfTypeMultiTopMenu_l1 = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString($colname_RecordDfTypeMultiTopMenu_l1, "text"));
$RecordDfTypeMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfTypeMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1);
$totalRows_RecordDfTypeMultiTopMenu_l1 = mysqli_num_rows($RecordDfTypeMultiTopMenu_l1);
?>
<?php do { ?>
<li><a class="fNiv" href="dfpage.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=<?php echo $row_RecordDfTypeMultiTopMenu_l1['typemenu']; ?>&amp;lang=<?php echo $_SESSION['lang'] ?>&amp;aid=<?php echo $row_RecordDfTypeMultiTopMenu_l1['id']; ?>"><?php echo $row_RecordDfTypeMultiTopMenu_l1['title']; ?></a>
	<?php require("mainmenu_dfpage.php"); ?>
</li>
<?php } while ($row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1)); ?>
<?php
mysqli_free_result($RecordDfTypeMultiTopMenu_l1);
?>
