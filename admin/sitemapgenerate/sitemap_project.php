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

$coluserid_RecordProject = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProject = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProject = sprintf("SELECT demo_projectalbum.act_id, demo_projectalbum.userid, demo_projectalbum.title, demo_projectalbum.type, demo_projectalbum.sdescription, demo_projectalbum.indicate, demo_projectalbum.author, demo_projectalbum.postdate, demo_projectalbumphoto.pic, demo_projectalbumphoto.actphoto_id, demo_projectalbum.lang, count(demo_projectalbumphoto.act_id) AS photonum FROM demo_projectalbum LEFT OUTER JOIN demo_projectalbumphoto ON demo_projectalbum.act_id = demo_projectalbumphoto.act_id GROUP BY demo_projectalbum.act_id HAVING userid=%s ORDER BY demo_projectalbum.sortid ASC, demo_projectalbum.act_id DESC",GetSQLValueString($coluserid_RecordProject, "int"));
$RecordProject = mysqli_query($DB_Conn, $query_RecordProject) or die(mysqli_error($DB_Conn));
$row_RecordProject = mysqli_fetch_assoc($RecordProject);
$totalRows_RecordProject = mysqli_num_rows($RecordProject);
?>
<?php 

$project_i=0;
do {
	if ($row_RecordProject['photonum'] > 0 && $row_RecordProject['pic'] != "") {
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("project",array('wshop'=>$wshop,'lang'=>$row_RecordProject['lang'],'Opt'=>'detailed','id'=>$row_RecordProject['act_id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'daily'
)); 

$project_i++;
}
} while ($row_RecordProject = mysqli_fetch_assoc($RecordProject));

?>                
<?php
mysqli_free_result($RecordProject);
?>
