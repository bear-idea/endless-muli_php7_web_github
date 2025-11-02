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

$coluserid_RecordArticleMultiSiteMap_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticleMultiSiteMap_l1 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiSiteMap_l1 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($coluserid_RecordArticleMultiSiteMap_l1, "int"));
$RecordArticleMultiSiteMap_l1 = mysqli_query($DB_Conn, $query_RecordArticleMultiSiteMap_l1) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiSiteMap_l1 = mysqli_fetch_assoc($RecordArticleMultiSiteMap_l1);
$totalRows_RecordArticleMultiSiteMap_l1 = mysqli_num_rows($RecordArticleMultiSiteMap_l1);
?>
<?php if ($totalRows_RecordArticleMultiSiteMap_l1 > 0) { // Show if recordset not empty ?>  
<?php $article_i=0; ?>  	
	
        <?php do { ?>
            
            
            <?php if ($row_RecordArticleMultiSiteMap_l1['endnode'] != 'child') { ?>   
            <?php } else { ?>
<?php 
// 第一層
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite('article',array('wshop'=>$wshop,'lang'=>$row_RecordArticleMultiSiteMap_l1['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiSiteMap_l1['item_id']),'',$UrlWriteEnable));
	
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>
            <?php }  ?>
            <?php if ($row_RecordArticleMultiSiteMap_l1['endnode'] != 'child') { // 若第一層節點不為child則印出下層選單 ?>
           
              <?php
					 $coluserid_RecordArticleMultiSiteMap_l2 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticleMultiSiteMap_l2 = $w_userid;
}
$colsubitem_id_RecordArticleMultiSiteMap_l2 = "-1";
if (isset($row_RecordArticleMultiSiteMap_l1['item_id'])) {
  $colsubitem_id_RecordArticleMultiSiteMap_l2 = $row_RecordArticleMultiSiteMap_l1['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiSiteMap_l2 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && level = '1' && subitem_id = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colsubitem_id_RecordArticleMultiSiteMap_l2, "int"),GetSQLValueString($coluserid_RecordArticleMultiSiteMap_l2, "int"));
$RecordArticleMultiSiteMap_l2 = mysqli_query($DB_Conn, $query_RecordArticleMultiSiteMap_l2) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiSiteMap_l2 = mysqli_fetch_assoc($RecordArticleMultiSiteMap_l2);
$totalRows_RecordArticleMultiSiteMap_l2 = mysqli_num_rows($RecordArticleMultiSiteMap_l2);
					?>
              <?php do { ?>
                
                  <?php if ($row_RecordArticleMultiSiteMap_l2['endnode'] != 'child') { ?>
                  <?php } else { ?>
<?php 
// 第二層
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite('article',array('wshop'=>$wshop,'lang'=>$row_RecordArticleMultiSiteMap_l2['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiSiteMap_l1['item_id'],'type2'=>$row_RecordArticleMultiSiteMap_l2['item_id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>
                  <?php } ?>
                  <?php if ($row_RecordArticleMultiSiteMap_l2['endnode'] != 'child') { // 若第二層節點不為child則印出下層選單 ?>
                  
                    <?php
                         $coluserid_RecordArticleMultiSiteMap_l3 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticleMultiSiteMap_l3 = $w_userid;
}
$colsubitem_id_RecordArticleMultiSiteMap_l3 = "-1";
if (isset($row_RecordArticleMultiSiteMap_l2['item_id'])) {
  $colsubitem_id_RecordArticleMultiSiteMap_l3 = $row_RecordArticleMultiSiteMap_l2['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMultiSiteMap_l3 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && level = '2' && subitem_id = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colsubitem_id_RecordArticleMultiSiteMap_l3, "int"),GetSQLValueString($coluserid_RecordArticleMultiSiteMap_l3, "int"));
$RecordArticleMultiSiteMap_l3 = mysqli_query($DB_Conn, $query_RecordArticleMultiSiteMap_l3) or die(mysqli_error($DB_Conn));
$row_RecordArticleMultiSiteMap_l3 = mysqli_fetch_assoc($RecordArticleMultiSiteMap_l3);
$totalRows_RecordArticleMultiSiteMap_l3 = mysqli_num_rows($RecordArticleMultiSiteMap_l3);
?>
                    <?php do { ?>
                      
                        <?php if ($row_RecordArticleMultiSiteMap_l3['endnode'] != 'child') { ?>
                        <?php } else { ?>
 <?php 
// 第三層
	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite('article',array('wshop'=>$wshop,'lang'=>$row_RecordArticleMultiSiteMap_l3['lang'],'Opt'=>'subpage','type1'=>$row_RecordArticleMultiSiteMap_l1['item_id'],'type2'=>$row_RecordArticleMultiSiteMap_l2['item_id'],'type3'=>$row_RecordArticleMultiSiteMap_l3['item_id']),'',$UrlWriteEnable));
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>
<?php $article_i++;?>
                        <?php } ?>
                      
                      <?php } while ($row_RecordArticleMultiSiteMap_l3 = mysqli_fetch_assoc($RecordArticleMultiSiteMap_l3)); ?>
                    <?php mysqli_free_result($RecordArticleMultiSiteMap_l3);?>
                  
                  <?php } // Show if recordset not empty ?>
               
                <?php $article_i++;?>
                <?php } while ($row_RecordArticleMultiSiteMap_l2 = mysqli_fetch_assoc($RecordArticleMultiSiteMap_l2)); ?>
              <?php mysqli_free_result($RecordArticleMultiSiteMap_l2);?>
          
<?php } // Show if recordset not empty ?>
         
          <?php $article_i++;?>
          <?php } while ($row_RecordArticleMultiSiteMap_l1 = mysqli_fetch_assoc($RecordArticleMultiSiteMap_l1)); ?>
       
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordArticleMultiSiteMap_l1);
?>