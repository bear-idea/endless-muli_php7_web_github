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
$query_RecordProductPhotoAlbum = sprintf("SELECT * FROM demo_productphoto WHERE aid = %s && lang = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductPhotoAlbum, "int"),GetSQLValueString($collang_RecordProductPhotoAlbum, "text"));
$RecordProductPhotoAlbum = mysqli_query($DB_Conn, $query_RecordProductPhotoAlbum) or die(mysqli_error($DB_Conn));
$row_RecordProductPhotoAlbum = mysqli_fetch_assoc($RecordProductPhotoAlbum);
$totalRows_RecordProductPhotoAlbum = mysqli_num_rows($RecordProductPhotoAlbum);$colname_RecordProductPhotoAlbum = "-1";

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
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.galleryview-3.0-dev.css" />

<script type="text/javascript">
	$(function(){
		$('#myGallery').galleryView({
			 // General Options
			transition_speed: 350, 		
			transition_interval: 5000, 		
			// Panel Options
			show_panels: true, 				
			show_panel_nav: true, 			
			enable_overlays: true, 
			panel_width: 380, 				
			panel_height: 380, 	
			panel_animation: 'fade', 		// (crossfade,fade,slide,none)
			panel_scale: 'fit', 			// crop , fit
			overlay_position: 'bottom', 	// (bottom, top)
			pan_images: false,				// 圖片是否可拖動
			pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
			// Filmstrip Options
			start_frame: 1, 				
			show_filmstrip: true, 			
			show_filmstrip_nav: true, 		
			enable_slideshow: true,			
			autoplay: false,				
			show_captions: false, 			
			filmstrip_size: 3, 				
			filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
			filmstrip_position: 'bottom', 	//(bottom, top, left, right)
			frame_width: 50, 				
			frame_height: 50, 				
			frame_opacity: 0.7, 			
			frame_scale: 'fit', 			
			frame_gap: 5, 					
			
			// Info Bar Options
			show_infobar: true,				//BOOLEAN - flag to show or hide infobar
			infobar_opacity: 1				//FLOAT - transparency for info bar
		});
	});
</script>
<?php if ($totalRows_RecordProductPhotoAlbum > 0) { ?>
<ul id="myGallery">
  <?php do { ?>
    <li><img data-frame="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProductPhotoAlbum['pic']; ?>" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProductPhotoAlbum['pic']; ?>" title="<?php echo $row_RecordProductChange['name']; ?>" data-description="<?php echo $row_RecordProductPhotoAlbum['sdescription']; ?>"></li>
    <?php } while ($row_RecordProductPhotoAlbum = mysqli_fetch_assoc($RecordProductPhotoAlbum)); ?>
</ul>
<?php } else { ?>
<?php //$arrpic = getimagesize("upload/image/product/" . $row_RecordProductChange['pic']); // 取得圖片資訊?>
<ul id="myGallery">
    <li><img data-frame="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProduct['pic']; ?>" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProduct['pic']; ?>" title="<?php echo $row_RecordProduct['name']; ?>" data-description="<?php echo $row_RecordProduct['sdescription']; ?>"></li>
</ul>
<?php } ?>

<?php
mysqli_free_result($RecordProductPhotoAlbum);

mysqli_free_result($RecordProductChange);
?>
