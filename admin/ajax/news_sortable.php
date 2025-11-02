<?php require_once('../../Connections/DB_Conn.php'); ?>
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
?>
<?php
if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
	foreach($_POST['id'] as $i => $val){
	}
}

//$post_order = isset($_POST["post_order_ids"]) ? $_POST["post_order_ids"] : [];

if(count($post_order)>0){
	for($order_no= 0; $order_no < count($post_order); $order_no++)
	{
	 $query = "UPDATE demo_newsitem SET sortid = '".($order_no+1)."' WHERE post_id = '".$post_order[$order_no]."'";
	 mysqli_query($con, $query);
	}
	echo true; 
}else{
	echo false; 
}

?>
