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

$colname_RecordTmpBackGround = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBackGround = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBackGround = sprintf("SELECT * FROM demo_tmpbackground WHERE id = %s", GetSQLValueString($colname_RecordTmpBackGround, "int"));
$RecordTmpBackGround = mysqli_query($DB_Conn, $query_RecordTmpBackGround) or die(mysqli_error($DB_Conn));
$row_RecordTmpBackGround = mysqli_fetch_assoc($RecordTmpBackGround);
$totalRows_RecordTmpBackGround = mysqli_num_rows($RecordTmpBackGround);
?>
<style type="text/css">
.bk_wrp {
	<?php if ($row_RecordTmpBackGround['type'] == "標題圖示") { ?>
	<?php echo "height: 30px;" ?>
	<?php } else { ?>
	<?php echo "height: 62px;" ?>
	<?php } ?>
	width: 62px;
	border: 1px solid #DDD;
}
.bk_wrp:hover {
	cursor: pointer;
}
.bk_wrp img{
	max-width: 62px;
}
.bk_wrp {
}
img {
	border:0px;
	vertical-align:bottom; /* 去除圖片下方5px空隙 */
}
</style>
<?php if ($row_RecordTmpBackGround['bgimage'] != "") { ?>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
	<?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpBackGround['userid'] == '1') { ?>
        <div class="bk_wrp" onclick="MM_openBrWindow('<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBackGround['webname']; ?>/image/tmpbackground/<?php echo $row_RecordTmpBackGround['bgimage']; ?>','預覽','location=no,resizable=yes,width=500,height=500')"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBackGround['webname']; ?>/image/tmpbackground/<?php echo $row_RecordTmpBackGround['bgimage']; ?>"/> 
        </div>
    <?php } else { ?>
        <div class="bk_wrp" onclick="MM_openBrWindow('<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBackGround['webname']; ?>/image/tmpbackground/<?php echo $row_RecordTmpBackGround['bgimage']; ?>','預覽','location=no,resizable=yes,width=500,height=500')"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBackGround['webname']; ?>/image/tmpbackground/<?php echo $row_RecordTmpBackGround['bgimage']; ?>"/> 
        </div>
    <?php }  ?>
    
<?php } else if ($row_RecordTmpBackGround['bgcolor'] != ""){ ?>
    <div style="background-color:<?php echo $row_RecordTmpBackGround['bgcolor']; ?>; height:58px; width:58x;border: 1px solid #DDD;">   
    </div>
<?php } else { ?>
    <div class="bk_wrp">
    <img src="images/no_bg.jpg" width="62" height="62"/> 
    </div> 
<?php } ?> 
<?php
mysqli_free_result($RecordTmpBackGround);
?>
