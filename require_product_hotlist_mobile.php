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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordProductHotList = 5;
$pageNewsList = 0;
if (isset($_GET['pageNewsList'])) {
  $pageNewsList = $_GET['pageNewsList'];
}
$startRow_RecordProductHotList = $pageNewsList * $maxRows_RecordProductHotList;

$collang_RecordProductHotList = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductHotList = $_GET['lang'];
}
$coluserid_RecordProductHotList = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductHotList = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductHotList = sprintf("SELECT * FROM demo_product WHERE indicate=1 && plot=1 && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($collang_RecordProductHotList, "text"),GetSQLValueString($coluserid_RecordProductHotList, "int"));
$query_limit_RecordProductHotList = sprintf("%s LIMIT %d, %d", $query_RecordProductHotList, $startRow_RecordProductHotList, $maxRows_RecordProductHotList);
$RecordProductHotList = mysqli_query($DB_Conn, $query_limit_RecordProductHotList) or die(mysqli_error($DB_Conn));
$row_RecordProductHotList = mysqli_fetch_assoc($RecordProductHotList);

if (isset($_GET['totalRows_RecordProductHotList'])) {
  $totalRows_RecordProductHotList = $_GET['totalRows_RecordProductHotList'];
} else {
  $all_RecordProductHotList = mysqli_query($DB_Conn, $query_RecordProductHotList);
  $totalRows_RecordProductHotList = mysqli_num_rows($all_RecordProductHotList);
}
$totalPages_RecordProductHotList = ceil($totalRows_RecordProductHotList/$maxRows_RecordProductHotList)-1;
?>
<?php if ($totalRows_RecordProductHotList > 0) { // Show if recordset not empty ?>

    <div class="owl-carousel featured nomargin" data-plugin-options='{"singleItem": true, "stopOnHover":false, "autoPlay":false, "autoHeight": false, "navigation": true, "pagination": false}'>     
        
            <ul class="list-unstyled nomargin text-left padding-top-10">
            <?php do { ?>
     <?php // 判斷商品所在之層級
                                if($row_RecordProductHotList['type1'] != '-1' && $row_RecordProductHotList['type2'] != '-1' && $row_RecordProductHotList['type3'] != '-1') { $level='2'; }
                                else if($row_RecordProductHotList['type1'] != '-1' && $row_RecordProductHotList['type2'] != '-1' && $row_RecordProductHotList['type3'] == '-1') { $level='1'; }
                                else if($row_RecordProductHotList['type1'] != '-1' && $row_RecordProductHotList['type2'] == '-1' && $row_RecordProductHotList['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                <li class="clearfix"><!-- item -->
                    <div class="thumbnail featured pull-left">
                        <a href="#">
                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProductHotList['pic']); ?>" width="80" height="80" alt="<?php echo $row_RecordProductHotList['sdescription']; ?>">
                        </a>
                    </div>
                    <?php if ($level == '2') { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductHotList['type1'],'type2'=>$row_RecordProductHotList['type2'],'type3'=>$row_RecordProductHotList['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductHotList['id']; ?>" class="block"><?php echo $row_RecordProductHotList['name']; ?></a>
                      <?php } else if ($level == '1') { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductHotList['type1'],'type2'=>$row_RecordProductHotList['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductHotList['id']; ?>" class="block"><?php echo $row_RecordProductHotList['name']; ?></a>
                      <?php } else if ($level == '0') { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductHotList['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductHotList['id']; ?>" class="block"><?php echo $row_RecordProductHotList['name']; ?></a>
                      <?php } else { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductHotList['id']; ?>" class="block"><?php echo $row_RecordProductHotList['name']; ?></a>
                      <?php } ?>
                </li><!-- /item -->
            <?php } while ($row_RecordProductHotList = mysqli_fetch_assoc($RecordProductHotList)); ?>
            </ul>
        
    </div>

<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProductHotList);
?>
