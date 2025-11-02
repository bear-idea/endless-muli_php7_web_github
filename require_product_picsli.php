 
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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_Recordset1 = "SELECT * FROM demo_product ";
$Recordset1 = mysqli_query($DB_Conn, $query_Recordset1) or die(mysqli_error($DB_Conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_Recordset1 = "SELECT * FROM demo_product WHERE `state` = 'true'";
$Recordset1 = mysqli_query($DB_Conn, $query_Recordset1) or die(mysqli_error($DB_Conn));
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>

<style type="text/css">

.anyClass {
	
}
.anyClass img{
	margin: 5px;
	padding: 5px;
	border: 1px solid #CCC;	
}

</style>
<script type="text/javascript" src="js/jcarousellite_1.0.1.min.js"></script>

<div class="anyClass">
    <ul>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
          <li><img name="" src="admin/images/actphoto_noimage.jpg" width="120" height="80" alt=""></li>
    </ul>
</div>

<script type="text/javascript">
   $(function() {
    $(".anyClass").jCarouselLite({
        /*btnNext: ".next",
        btnPrev: ".prev",*/
		 auto: 800,
		 visible: 7,
    speed: 1000


    });
});
</script> 
<?php
mysqli_free_result($Recordset1);
?>
