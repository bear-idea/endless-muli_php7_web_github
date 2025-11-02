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

$colname_RecordRoomPhotoAlbum = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoomPhotoAlbum = $_GET['id'];
}
$collang_RecordRoomPhotoAlbum = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomPhotoAlbum = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomPhotoAlbum = sprintf("SELECT * FROM demo_roomphoto WHERE aid = %s && lang = %s", GetSQLValueString($colname_RecordRoomPhotoAlbum, "int"),GetSQLValueString($collang_RecordRoomPhotoAlbum, "text"));
$RecordRoomPhotoAlbum = mysqli_query($DB_Conn, $query_RecordRoomPhotoAlbum) or die(mysqli_error($DB_Conn));
$row_RecordRoomPhotoAlbum = mysqli_fetch_assoc($RecordRoomPhotoAlbum);
$totalRows_RecordRoomPhotoAlbum = mysqli_num_rows($RecordRoomPhotoAlbum);$colname_RecordRoomPhotoAlbum = "-1";

$colname_RecordRoomChange = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoomChange = $_GET['id'];
}
$collang_RecordRoomChange = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomChange = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomChange = sprintf("SELECT * FROM demo_room WHERE id = %s && lang=%s", GetSQLValueString($colname_RecordRoomChange, "int"),GetSQLValueString($collang_RecordRoomChange, "text"));
$RecordRoomChange = mysqli_query($DB_Conn, $query_RecordRoomChange) or die(mysqli_error($DB_Conn));
$row_RecordRoomChange = mysqli_fetch_assoc($RecordRoomChange);
$totalRows_RecordRoomChange = mysqli_num_rows($RecordRoomChange);
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
			panel_width: 640, 				
			panel_height: 480, 	
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
<?php if ($totalRows_RecordRoomPhotoAlbum > 0) { ?>
<ul id="myGallery">
  <?php do { ?>
    <li><img data-frame="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/<?php echo $row_RecordRoomPhotoAlbum['pic']; ?>" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/<?php echo $row_RecordRoomPhotoAlbum['pic']; ?>" title="<?php echo $row_RecordRoomChange['name']; ?>" data-description="<?php echo $row_RecordRoomPhotoAlbum['sdescription']; ?>"></li>
    <?php } while ($row_RecordRoomPhotoAlbum = mysqli_fetch_assoc($RecordRoomPhotoAlbum)); ?>
</ul>
<?php } else { ?>
<?php //$arrpic = getimagesize("upload/image/room/" . $row_RecordRoomChange['pic']); // 取得圖片資訊?>
<ul id="myGallery">
    <li><img data-frame="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/<?php echo $row_RecordRoom['pic']; ?>" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/<?php echo $row_RecordRoom['pic']; ?>" title="<?php echo $row_RecordRoom['name']; ?>" data-description="<?php echo $row_RecordRoom['sdescription']; ?>"></li>
</ul>
<?php } ?>

<?php
mysqli_free_result($RecordRoomPhotoAlbum);

mysqli_free_result($RecordRoomChange);
?>
