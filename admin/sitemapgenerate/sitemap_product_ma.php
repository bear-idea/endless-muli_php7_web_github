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



        /* 取得類別列表 */

//mysqli_select_db($database_DB_Conn, $DB_Conn);
        $query_RecordProductListType = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && item_id=%s",GetSQLValueString($row_RecordProduct['type1'], "int"));
        $RecordProductListType = mysqli_query($DB_Conn, $query_RecordProductListType) or die(mysqli_error($DB_Conn));
        $row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
        $totalRows_RecordProductListType = mysqli_num_rows($RecordProductListType);


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



array_push($data_array_ma, array(
        'SKU'=>$row_RecordProduct['id'],
        'Name'=>$row_RecordProduct['name'],
    'Description'=>$row_RecordProduct['sdescription'],
        'URL'=>$seo_loc,
        'Price'=>$row_RecordProduct['price'],
        'LargeImage'=>$seo_url . '/site/' .$wshop .'/image/product/'. $row_RecordProduct['pic'],
        'SalePrice'=>$row_RecordProduct['spprice'],
        'UPC'=>'',
        'ISBN'=>'',
        'MPN'=>'',
        'Manufacturer'=>'',
        'Brand'=>'',
        'Category'=>$row_RecordProductListType['itemname'],
        'EAN'=>'',
        'Condition'=>''
)); 
?>       
<?php $product_i++; ?>
<?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProduct);
?>