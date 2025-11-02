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

$colname_RecordContactMail = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordContactMail = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactMail = sprintf("SELECT id, userid, SiteMail, SiteAuthor, contacttitle, contacttitleindicate, contactdesc, contactcontent, SiteSName, SiteAddr, SiteAddrX, SiteAddrY, SiteDecsHome, googlemapindicate, SitePhone, SiteCell, SiteFax FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordContactMail, "int"));
$RecordContactMail = mysqli_query($DB_Conn, $query_RecordContactMail) or die(mysqli_error($DB_Conn));
$row_RecordContactMail = mysqli_fetch_assoc($RecordContactMail);
$totalRows_RecordContactMail = mysqli_num_rows($RecordContactMail);

$colname_RecordContactListType = "zh-tw";
if (isset($_SESSION['lang'])) {
  $colname_RecordContactListType = $_SESSION['lang'];
}
$coluserid_RecordContactListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordContactListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactListType = sprintf("SELECT * FROM demo_contactitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordContactListType, "text"),GetSQLValueString($coluserid_RecordContactListType, "int"));
$RecordContactListType = mysqli_query($DB_Conn, $query_RecordContactListType) or die(mysqli_error($DB_Conn));
$row_RecordContactListType = mysqli_fetch_assoc($RecordContactListType);
$totalRows_RecordContactListType = mysqli_num_rows($RecordContactListType);
?>
<script src="http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.tinyMap-2.4.4.min.js"></script>
<style type="text/css">
#map {
	background: #fff; border: 4px solid #fff; position: relative; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,.2); -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2); -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); text-align:center; margin-bottom:20px; height:400px; width:80%;
}
/* 表格版面: 481px 到 768px。樣式繼承自: 行動版面。 */

@media only screen and (min-width: 481px) {
	#map { width:auto;}

/* 若瀏覽區域的寬度大於796像素，則下方的CSS描述就會立即被套用： */

@media only screen and (min-width: 769px) {
	#map { width:auto;}
}
.labels{ width:200px; height:50px;}
<?php if($row_RecordContactMail['SiteAddrX'] == "" && $row_RecordContactMail['SiteAddrY'] == "") { ?>
.Mobile_Home_Right {float:none; width:100%; margin-left:0px;}
<?php } ?>
</style>
<div id="map"></div>
<script type="text/javascript">
$('#map').tinyMap({
    center: {
        x: '<?php echo $row_RecordContactMail['SiteAddrX']; ?>',
        y: '<?php echo $row_RecordContactMail['SiteAddrY']; ?>'
    },
	marker: [
        {addr: ['<?php echo $row_RecordContactMail['SiteAddrX']; ?>', '<?php echo $row_RecordContactMail['SiteAddrY']; ?>'], text: '<div style=\"width:300px;text-align:left;\"></div></div><div style=\"width:95%;text-align:left;margin:5px;\"><?php if ($row_RecordContactMail['SitePhone'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><img src=\"images/googlemap/tel.png\" width=\"14\" height=\"14\" /> <?php echo $Lang_Footer_Tel; ?>：<?php echo $row_RecordContactMail['SitePhone']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteCell'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><img src=\"images/googlemap/cell.png\" width=\"14\" height=\"14\" /> <?php echo $Lang_Footer_Cell; ?>：<?php echo $row_RecordContactMail['SiteCell']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteFax'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><img src=\"images/googlemap/fox.png\" width=\"14\" height=\"14\" /> <?php echo $Lang_Footer_Fax; ?>：<?php echo $row_RecordContactMail['SiteFax']; ?></div><?php } ?><?php if ($row_RecordContactMail['SiteAddr'] != '') { ?><div style=\"line-height:14px; vertical-align: middle;margin-bottom:3px\"><img src=\"images/googlemap/addr.png\" width=\"14\" height=\"14\" /> <?php echo $Lang_Footer_Addr; ?>：<?php echo $row_RecordContactMail['SiteAddr']; ?></div><?php } ?></div><div style=\"width:300px;text-align:left;\"></div>', label: '<?php echo $row_RecordContactMail['SiteSName']; ?>'},
    ],
    zoom: 16
});
</script>
<?php 
mysqli_free_result($RecordContactMail);

mysqli_free_result($RecordContactListType);
?>