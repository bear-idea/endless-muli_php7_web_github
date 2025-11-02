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

$coluserid_RecordAlbum = "1";
if (isset($w_userid)) {
  $coluserid_RecordAlbum = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAlbum = sprintf("SELECT demo_album.act_id, demo_album.userid, demo_album.title, demo_album.type, demo_album.sdescription, demo_album.indicate, demo_album.author, demo_album.postdate, demo_albumphoto.pic, demo_album.sortid, demo_albumphoto.actphoto_id, demo_album.lang, count(demo_albumphoto.act_id) AS photonum FROM demo_album LEFT OUTER JOIN demo_albumphoto ON demo_album.act_id = demo_albumphoto.act_id GROUP BY demo_album.act_id HAVING demo_album.userid=%s && demo_album.indicate=1 ORDER BY demo_album.act_id DESC", GetSQLValueString($coluserid_RecordAlbum, "int"));
$RecordAlbum = mysqli_query($DB_Conn, $query_RecordAlbum) or die(mysqli_error($DB_Conn));
$row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum);
$totalRows_RecordAlbum = mysqli_num_rows($RecordAlbum);
?>
<?php 
if ($totalRows_RecordAlbum > 0) { 
$album_i=0;
do { 
if($row_RecordAlbum['photonum'] > 0 ) {
$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("album",array('wshop'=>$wshop,'lang'=>$row_RecordAlbum['lang'],'Opt'=>'detailed','id'=>$row_RecordAlbum['act_id']),'',$UrlWriteEnable));

//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 

 $album_i++;
}
} while ($row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum)); 

}
?>
<?php
mysqli_free_result($RecordAlbum);
?>