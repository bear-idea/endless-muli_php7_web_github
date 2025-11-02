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

$coluserid_RecordActivities = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActivities = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivities = sprintf("SELECT demo_actalbum.act_id, demo_actalbum.userid, demo_actalbum.title, demo_actalbum.type, demo_actalbum.sdescription, demo_actalbum.indicate, demo_actalbum.author, demo_actalbum.postdate, demo_actalbumphoto.pic, demo_actalbumphoto.actphoto_id, demo_actalbum.lang, count(demo_actalbumphoto.act_id) AS photonum FROM demo_actalbum LEFT OUTER JOIN demo_actalbumphoto ON demo_actalbum.act_id = demo_actalbumphoto.act_id GROUP BY demo_actalbum.act_id HAVING userid=%s ORDER BY demo_actalbum.sortid ASC, demo_actalbum.act_id DESC",GetSQLValueString($coluserid_RecordActivities, "int"));
$RecordActivities = mysqli_query($DB_Conn, $query_RecordActivities) or die(mysqli_error($DB_Conn));
$row_RecordActivities = mysqli_fetch_assoc($RecordActivities);
$totalRows_RecordActivities = mysqli_num_rows($RecordActivities);
?>
<?php 

$activities_i=0;
do {
	if ($row_RecordActivities['photonum'] > 0 && $row_RecordActivities['pic'] != "") {
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("activities",array('wshop'=>$wshop,'lang'=>$row_RecordActivities['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'daily'
)); 

$activities_i++;
}
} while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities));

?>                
<?php
mysqli_free_result($RecordActivities);
?>
