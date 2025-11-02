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

$maxRows_RecordProductNewsList = 5;
$pageNewsList = 0;
if (isset($_GET['pageNewsList'])) {
  $pageNewsList = $_GET['pageNewsList'];
}
$startRow_RecordProductNewsList = $pageNewsList * $maxRows_RecordProductNewsList;

$collang_RecordProductNewsList = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductNewsList = $_GET['lang'];
}
$coluserid_RecordProductNewsList = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductNewsList = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductNewsList = sprintf("SELECT * FROM demo_product WHERE indicate=1 && plot=4 && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($collang_RecordProductNewsList, "text"),GetSQLValueString($coluserid_RecordProductNewsList, "int"));
$query_limit_RecordProductNewsList = sprintf("%s LIMIT %d, %d", $query_RecordProductNewsList, $startRow_RecordProductNewsList, $maxRows_RecordProductNewsList);
$RecordProductNewsList = mysqli_query($DB_Conn, $query_limit_RecordProductNewsList) or die(mysqli_error($DB_Conn));
$row_RecordProductNewsList = mysqli_fetch_assoc($RecordProductNewsList);

if (isset($_GET['totalRows_RecordProductNewsList'])) {
  $totalRows_RecordProductNewsList = $_GET['totalRows_RecordProductNewsList'];
} else {
  $all_RecordProductNewsList = mysqli_query($DB_Conn, $query_RecordProductNewsList);
  $totalRows_RecordProductNewsList = mysqli_num_rows($all_RecordProductNewsList);
}
$totalPages_RecordProductNewsList = ceil($totalRows_RecordProductNewsList/$maxRows_RecordProductNewsList)-1;
?>
<?php if ($totalRows_RecordProductNewsList > 0) { // Show if recordset not empty ?>

    <div class="owl-carousel featured nomargin" data-plugin-options='{"singleItem": true, "stopOnHover":false, "autoPlay":false, "autoHeight": false, "navigation": true, "pagination": false}'>     
        
            <ul class="list-unstyled nomargin text-left padding-top-10">
            <?php do { ?>
     <?php // 判斷商品所在之層級
                                if($row_RecordProductNewsList['type1'] != '-1' && $row_RecordProductNewsList['type2'] != '-1' && $row_RecordProductNewsList['type3'] != '-1') { $level='2'; }
                                else if($row_RecordProductNewsList['type1'] != '-1' && $row_RecordProductNewsList['type2'] != '-1' && $row_RecordProductNewsList['type3'] == '-1') { $level='1'; }
                                else if($row_RecordProductNewsList['type1'] != '-1' && $row_RecordProductNewsList['type2'] == '-1' && $row_RecordProductNewsList['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                <li class="clearfix"><!-- item -->
                    <div class="thumbnail featured pull-left">
                        <a href="#">
                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProductNewsList['pic']); ?>" width="80" height="80" alt="<?php echo $row_RecordProductNewsList['sdescription']; ?>">
                        </a>
                    </div>
                    <?php if ($level == '2') { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductNewsList['type1'],'type2'=>$row_RecordProductNewsList['type2'],'type3'=>$row_RecordProductNewsList['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductNewsList['id']; ?>" class="block"><?php echo $row_RecordProductNewsList['name']; ?></a>
                      <?php } else if ($level == '1') { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductNewsList['type1'],'type2'=>$row_RecordProductNewsList['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductNewsList['id']; ?>" class="block"><?php echo $row_RecordProductNewsList['name']; ?></a>
                      <?php } else if ($level == '0') { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProductNewsList['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductNewsList['id']; ?>" class="block"><?php echo $row_RecordProductNewsList['name']; ?></a>
                      <?php } else { ?>
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProductNewsList['id']; ?>" class="block"><?php echo $row_RecordProductNewsList['name']; ?></a>
                      <?php } ?>
                </li><!-- /item -->
            <?php } while ($row_RecordProductNewsList = mysqli_fetch_assoc($RecordProductNewsList)); ?>
            </ul>
        
    </div>

<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProductNewsList);
?>
