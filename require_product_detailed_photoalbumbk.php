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
?>

<link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery/jquery.ad-gallery.css">
<script type="text/javascript" src="js/jquery.ad-gallery/jquery.ad-gallery.js"></script>
<script type="text/javascript">
$(function(){ 
   $('.ad-gallery').adGallery({
	   loader_image: 'css/jquery.ad-gallery/loader.gif',
	   width: 480, // Width of the image, set to false and it will read the CSS width
       height: 350, // Height of the image, set to false and it will read the CSS height
	   slideshow: {
			enable: false, // 是否啟用開始和暫停功能 
			autostart: true, // 是否自動播放 
			speed: 5000,
			start_label: 'Start', // 開始按鈕顯示的內容，可以為圖片按鈕 
			stop_label: 'Stop', // 停止按鈕顯示的內容，可以為圖片按鈕 
			stop_on_scroll: true, // Should the slideshow stop if the user scrolls the thumb list?
			countdown_prefix: '(', // Wrap around the countdown
			countdown_sufix: ')',
			onStart: function() {
			  // Do something wild when the slideshow starts
			},
			onStop: function() {
			  // Do something wild when the slideshow stops
			}
		  },
	   effect: 'slide-hori', // or 'slide-vert', 'resize', 'fade', 'none' or false
	   display_back_and_forward: true, // 是否顯示縮圖導航按鈕
	   display_back_and_forward: true, // 是否顯示縮圖導航按鈕
	   display_next_and_prev: true, // 是否顯示上一張下一張導航按鈕
	   thumb_opacity: 0.5 // 縮圖透明度
   }) 
}); 
</script>
<div class="ad-gallery"><!--相冊的包含層-->
  <div class="ad-image-wrapper"><!--放置所有大图片-->
  </div>
  <div class="ad-controls"><!--放置控制按钮如开始和暂停-->
  </div>
  <div class="ad-nav">
    <div class="ad-thumbs"><!--用来放置缩略图-->
      <ul class="ad-thumb-list">
        <?php do { ?>
            <li>
              <a href="upload/image/product/<?php echo $row_RecordProductPhotoAlbum['pic']; ?>"><img src="upload/image/product/thumb/small_<?php echo $row_RecordProductPhotoAlbum['pic']; ?>" alt="<?php echo $row_RecordProductPhotoAlbum['sdescription']; ?>" title= "" longdesc=""></a>
            </li>
        <?php } while ($row_RecordProductPhotoAlbum = mysqli_fetch_assoc($RecordProductPhotoAlbum)); ?>
      </ul>
    </div>
  </div>
</div>
<?php
mysqli_free_result($RecordProductPhotoAlbum);
?>
