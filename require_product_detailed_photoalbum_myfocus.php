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
<link type="text/css" rel="stylesheet" href="css/galleryview/galleryview.css" />
<script type="text/javascript" src="js/galleryview/jquery.galleryview-2.0.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#photos').galleryView({
			panel_width: 500,
			panel_height: 300,
			frame_width: 50,
			frame_height: 50,
      		transition_speed: 350,
     		easing: 'easeInOutQuad',
			filmstrip_position:'bottom', // 'top', 'right', 'bottom', 'left'
			show_panels: true, // 顯示面板
			show_filmstrip: true, // 顯示縮圖   
			nav_theme: 'dark', // light, dark
			show_captions: false,
            overlay_opacity: 0.5,
			transition_interval: 0
    
        });
    });
</script>



<div id="boxID" style="visibility:hidden"><!--焦点图盒子-->
  <div class="loading"><span>请稍候...</span></div><!--载入画面(可删除)-->
  <ul class="pic"><!--内容列表-->
  		<?php do { ?>
        <li><a href="#"><img src="upload/image/product/<?php echo $row_RecordProductPhotoAlbum['pic']; ?>" thumb="" alt="标题1" text="详细描述1" /></a></li>
        <?php } while ($row_RecordProductPhotoAlbum = mysqli_fetch_assoc($RecordProductPhotoAlbum)); ?>
  </ul>
</div>
<script type="text/javascript">
$('#boxID').myFocus({
    pattern:'mF_fscreen_tb',//风格应用的名称
    time:3,//切换时间间隔(秒)
    trigger:'click',//触发切换模式:'click'(点击)/'mouseover'(悬停)
    width:500,//设置图片区域宽度(像素)
    height:300,//设置图片区域高度(像素)
	autoZoom:true,
    txtHeight:'default'//文字层高度设置(像素),'default'为默认高度，0为隐藏
});
</script>

<?php
mysqli_free_result($RecordProductPhotoAlbum);

mysqli_free_result($RecordProductChange);
?>
