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

$colnamelang_RecordProductMicroGalleryMicroGallery = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProductMicroGalleryMicroGallery = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductMicroGalleryMicroGallery = sprintf("SELECT * FROM demo_product WHERE lang = %s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordProductMicroGalleryMicroGallery, "text"));
$RecordProductMicroGalleryMicroGallery = mysqli_query($DB_Conn, $query_RecordProductMicroGalleryMicroGallery) or die(mysqli_error($DB_Conn));
$row_RecordProductMicroGalleryMicroGallery = mysqli_fetch_assoc($RecordProductMicroGalleryMicroGallery);
$totalRows_RecordProductMicroGalleryMicroGallery = mysqli_num_rows($RecordProductMicroGalleryMicroGallery);
?>
<link href="css/MinimalisticSlideshowGallery/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/MinimalisticSlideshowGallery/MinimalisticSlideshowGallery.js"></script>
<div id="msg_slideshow" class="msg_slideshow">
			<div id="msg_wrapper" class="msg_wrapper">
				</div>
			<div id="msg_controls" class="msg_controls"><!-- right has to animate to 15px, default -110px -->
				<a href="#" id="msg_grid" class="msg_grid"></a>
				<a href="#" id="msg_prev" class="msg_prev"></a>
				<a href="#" id="msg_pause_play" class="msg_pause"></a><!-- has to change to msg_play if paused-->
				<a href="#" id="msg_next" class="msg_next"></a>
			</div>
			<div id="msg_thumbs" class="msg_thumbs"><!-- top has to animate to 0px, default -230px -->
					<div class="msg_thumb_wrapper">
					<a href="#"><img src="images/thumbs/1.jpg" alt="images/1.jpg"/></a>
					<a href="#"><img src="images/thumbs/2.jpg" alt="images/2.jpg"/></a>
					<a href="#"><img src="images/thumbs/3.jpg" alt="images/3.jpg"/></a>
					<a href="#"><img src="images/thumbs/4.jpg" alt="images/4.jpg"/></a>
					<a href="#"><img src="images/thumbs/5.jpg" alt="images/5.jpg"/></a>
					<a href="#"><img src="images/thumbs/6.jpg" alt="images/6.jpg"/></a>
					</div>
					<div class="msg_thumb_wrapper" style="display:none;">
					<a href="#"><img src="images/thumbs/7.jpg" alt="images/7.jpg"/></a>
					<a href="#"><img src="images/thumbs/8.jpg" alt="images/8.jpg"/></a>
					<a href="#"><img src="images/thumbs/9.jpg" alt="images/9.jpg"/></a>
					<a href="#"><img src="images/thumbs/10.jpg" alt="images/10.jpg"/></a>
					<a href="#"><img src="images/thumbs/11.jpg" alt="images/11.jpg"/></a>
					<a href="#"><img src="images/thumbs/12.jpg" alt="images/12.jpg"/></a>
				    </div>
				<a href="#" id="msg_thumb_next" class="msg_thumb_next"></a>
				<a href="#" id="msg_thumb_prev" class="msg_thumb_prev"></a>
				<a href="#" id="msg_thumb_close" class="msg_thumb_close"></a>
				<span class="msg_loading"></span><!-- show when next thumb wrapper loading -->
				</div>
			</div>
<?php
mysqli_free_result($RecordProductMicroGalleryMicroGallery);
?>
