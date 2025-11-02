<?php require_once('../Connections/DB_Conn.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

$coluserid_RecordCartPayment = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCartPayment = $w_userid;
}
$colitemid_RecordCartPayment = "-1";
if (isset($row_RecordCart['ocfreightselect'])) {
  $colitemid_RecordCartPayment = $row_RecordCart['ocfreightselect'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartPayment = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && userid=%s && item_id = %s", GetSQLValueString($coluserid_RecordCartPayment, "int"),GetSQLValueString($colitemid_RecordCartPayment, "int"));
$RecordCartPayment = mysqli_query($DB_Conn, $query_RecordCartPayment) or die(mysqli_error($DB_Conn));
$row_RecordCartPayment = mysqli_fetch_assoc($RecordCartPayment);
$totalRows_RecordCartPayment = mysqli_num_rows($RecordCartPayment);
}			
?>
<?php if($totalRows_RecordCartPayment > 0) { ?>
<?php echo $row_RecordCartPayment['itemname']; ?>
<?php } ?>

<?php 
if ($row_RecordCart['ocfreightselect'] == "sevenshop")
{
	echo "7-11 超商取貨(取貨付款)";
}
if ($row_RecordCart['ocfreightselect'] == "sevenshopnopay")
{
	echo "7-11 超商取貨(純配送)";
}
if ($row_RecordCart['ocfreightselect'] == "familyshop")
{
	echo "全家超商取貨(取貨付款)";
}
if ($row_RecordCart['ocfreightselect'] == "familyshopnopay")
{
	echo "全家超商取貨(純配送)";
}
?>

<?php
mysqli_free_result($RecordCartPayment);
?>