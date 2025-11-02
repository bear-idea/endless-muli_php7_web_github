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

$coluserid_RecordModlink = "-1";
if (isset($w_userid)) {
  $coluserid_RecordModlink = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlink = sprintf("SELECT * FROM demo_modlink WHERE userid=%s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordModlink, "int"));
$RecordModlink = mysqli_query($DB_Conn, $query_RecordModlink) or die(mysqli_error($DB_Conn));
$row_RecordModlink = mysqli_fetch_assoc($RecordModlink);
$totalRows_RecordModlink = mysqli_num_rows($RecordModlink);
?>
<?php if ($totalRows_RecordModlink > 0) { // Show if recordset not empty ?>
<?php $modlink_i=0; ?>
<?php do { ?>
<?php if ($row_RecordModlink['typemenu'] == 'Link') { ?>
<?php } else { ?>
    <?php
	    $seo_loc = $seo_url . "/" . htmlentities(url_rewrite('modlink',array('wshop'=>$wshop,'lang'=>$row_RecordModlink['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable));
		//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.9',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
	?>
<?php } ?>     
<?php $modlink_i++; ?>
<?php } while ($row_RecordModlink = mysqli_fetch_assoc($RecordModlink)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordModlink);
?>