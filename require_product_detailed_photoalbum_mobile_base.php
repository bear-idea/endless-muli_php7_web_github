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

$colname_RecordProductPhotoAlbum = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductPhotoAlbum = $_GET['id'];
}
$collang_RecordProductPhotoAlbum = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductPhotoAlbum = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPhotoAlbum = sprintf("SELECT * FROM demo_productphoto WHERE aid = %s && lang = %s", GetSQLValueString($colname_RecordProductPhotoAlbum, "int"),GetSQLValueString($collang_RecordProductPhotoAlbum, "text"));
$RecordProductPhotoAlbum = mysqli_query($DB_Conn, $query_RecordProductPhotoAlbum) or die(mysqli_error($DB_Conn));
$row_RecordProductPhotoAlbum = mysqli_fetch_assoc($RecordProductPhotoAlbum);
$totalRows_RecordProductPhotoAlbum = mysqli_num_rows($RecordProductPhotoAlbum);

$colname_RecordProductChange = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductChange = $_GET['id'];
}
$collang_RecordProductChange = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductChange = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductChange = sprintf("SELECT * FROM demo_product WHERE id = %s && lang=%s", GetSQLValueString($colname_RecordProductChange, "int"),GetSQLValueString($collang_RecordProductChange, "text"));
$RecordProductChange = mysqli_query($DB_Conn, $query_RecordProductChange) or die(mysqli_error($DB_Conn));
$row_RecordProductChange = mysqli_fetch_assoc($RecordProductChange);
$totalRows_RecordProductChange = mysqli_num_rows($RecordProductChange);
?>
<?php if ($totalRows_RecordProductPhotoAlbum > 0) { ?>
<ul class="pgwSlideshow">
<?php do { ?>
    <li><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProductPhotoAlbum['pic']; ?>" alt="" data-description="<?php echo $row_RecordProductPhotoAlbum['sdescription']; ?>"></li>
<?php } while ($row_RecordProductPhotoAlbum = mysqli_fetch_assoc($RecordProductPhotoAlbum)); ?>
</ul>
<script>
$(document).ready(function() {
    $('.pgwSlideshow').pgwSlideshow({
	  touchControls : true,	
	  displayList : true,
      autoSlide: true
    });
});
</script>
<?php } else { ?>
<ul class="pgwSlideshow">
    <li><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProduct['pic']; ?>" alt="" data-description="<?php echo $row_RecordProduct['sdescription']; ?>"></li>
</ul>
<script>
$(document).ready(function() {
    $('.pgwSlideshow').pgwSlideshow({
	  touchControls : true,	
	  displayList : false,
      autoSlide: true
    });
});
</script>
<?php } ?>
<?php
mysqli_free_result($RecordProductPhotoAlbum);

mysqli_free_result($RecordProductChange);
?>
