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

$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE userid=%s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
?>
<?php if ($totalRows_RecordProduct > 0) { // Show if recordset not empty ?>
<?php $product_i=0;?>
<?php do { ?>
<?php // 判斷商品所在之層級
                                if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] != '-1') { $level='2'; }
                                else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] == '-1') { $level='1'; }
                                else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] == '-1' && $row_RecordProduct['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
<?php 

    if ($level == '2') {
		$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("product",array('wshop'=>$wshop,'lang'=>$row_RecordProduct['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable) . $id_params . $row_RecordProduct['id']);
	} else if ($level == '1') {
		$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("product",array('wshop'=>$wshop,'lang'=>$row_RecordProduct['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable) . $id_params . $row_RecordProduct['id']);
	} else if ($level == '0') {
		$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("product",array('wshop'=>$wshop,'lang'=>$row_RecordProduct['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable) . $id_params . $row_RecordProduct['id']);
	} else { 
     	$seo_loc = $seo_url . "/" . htmlentities(url_rewrite("product",array('wshop'=>$wshop,'lang'=>$row_RecordProduct['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable) . $id_params . $row_RecordProduct['id']);
	}
	
//动态添加数组的例子
array_push($data_array, array(
        'loc'=>$seo_loc,
        'priority'=>'0.8',
        'lastmod'=>date("Y-m-d",time()),
        'changefreq'=>'weekly'
)); 
?>       
<?php $product_i++; ?>
<?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProduct);
?>