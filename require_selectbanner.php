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

/* 讀取資料 */
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
//$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$coltplid_RecordAds = "-1";
if (isset($tplid)) {
  $coltplid_RecordAds = $tplid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT * FROM demo_bannershow WHERE id = (SELECT tmpselectbannerid FROM demo_tmp WHERE id=%s)", GetSQLValueString($coltplid_RecordAds, "int"));
$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);
$totalRows_RecordAds = mysqli_num_rows($RecordAds);
?>
<?php if ($totalRows_RecordAds > 0) { ?>
	<?php if ($SiteImgUrlOuter != '' && $row_RecordAds['userid'] == '1') {  ?>
        <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordAds['webname']; ?>/image/bannershow/<?php echo $row_RecordAds['pic']; ?>" style="width:100%"/>
    <?php } else {  ?>
    	<img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordAds['webname']; ?>/image/bannershow/<?php echo $row_RecordAds['pic']; ?>" style="width:100%"/>
    <?php } ?>
<?php }  ?>
<?php
mysqli_free_result($RecordAds);
?>
