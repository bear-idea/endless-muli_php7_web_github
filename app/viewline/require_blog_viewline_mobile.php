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

$collang_RecordBlogViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordBlogViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordBlogViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordBlogViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogViewLine_l1 = sprintf("SELECT * FROM demo_blogitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordBlogViewLine_l1, "text"),GetSQLValueString($coluserid_RecordBlogViewLine_l1, "int"));
$RecordBlogViewLine_l1 = mysqli_query($DB_Conn, $query_RecordBlogViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordBlogViewLine_l1 = mysqli_fetch_assoc($RecordBlogViewLine_l1);
$totalRows_RecordBlogViewLine_l1 = mysqli_num_rows($RecordBlogViewLine_l1);

$collang_RecordBlogCompare = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordBlogCompare = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogCompare = sprintf("SELECT * FROM demo_blogitem WHERE list_id = 1 && lang=%s", GetSQLValueString($collang_RecordBlogCompare, "text"));
$RecordBlogCompare = mysqli_query($DB_Conn, $query_RecordBlogCompare) or die(mysqli_error($DB_Conn));
$row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare);
$totalRows_RecordBlogCompare = mysqli_num_rows($RecordBlogCompare);

?>
<script type="text/javascript" src="js/xbreadcrumbs/xbreadcrumbs.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        //  Initialize xBreadcrumbsa
        $('#breadcrumbs-1').xBreadcrumbs();
	});
</script>
<link rel="stylesheet" href="css/xbreadcrumbs/xbreadcrumbs.css" />

<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
  <li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
  <?php if ($_GET['Opt'] != 'viewpage' && $row_RecordBlogViewLine_l1['itemname'] != '') { // Show if recordset not empty ?>
  <li>
  <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Blog&amp;lang=<?php echo $_SESSION['lang'] ?>">總覽</a>
  <ol>
    <?php do { ?>
      <li class="<?php echo $row_RecordBlogViewLine_l1['endnode']; ?>">
      <?php if ($row_RecordBlogViewLine_l1['endnode'] != 'child') { ?>
      <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=<?php echo $row_RecordBlogViewLine_l1['level']; ?>&type1=<?php echo $row_RecordBlogViewLine_l1['item_id']; ?>&subitem_id=<?php echo $row_RecordBlogViewLine_l1['subitem_id']; ?>"><?php echo $row_RecordBlogViewLine_l1['itemname']; ?></a>
      <?php } else { ?>
      <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=<?php echo $row_RecordBlogViewLine_l1['level']; ?>&type1=<?php echo $row_RecordBlogViewLine_l1['item_id']; ?>&subitem_id=<?php echo $row_RecordBlogViewLine_l1['subitem_id']; ?>"><?php echo $row_RecordBlogViewLine_l1['itemname']; ?></a>
      <?php }  ?>
      </li>
      <?php } while ($row_RecordBlogViewLine_l1 = mysqli_fetch_assoc($RecordBlogViewLine_l1)); ?>
  </ol>
  </li>
  <!-- 第一層分類 -->
  <?php if ($_GET['level']>=0 && $_GET['level'] != '') { ?>
  <li class="<?php if ($_GET['level']==0 && $_GET['Opt'] != 'detailed') { echo 'current';}?>"><a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=0&type1=<?php echo $_GET['type1']; ?>&type2=<?php echo $_GET['type2']; ?>&subitem_id=<?php echo $_GET['subitem_id']; ?>">
  <?php
		  	do {  //比較字串
  ?>
		  <?php if (!(strcmp($row_RecordBlogCompare['item_id'], $_GET['type1']))) { echo $row_RecordBlogCompare['itemname']; } ?>
		  <?php
} while ($row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare));
  $rows = mysqli_num_rows($RecordBlogCompare);
  if($rows > 0) {
      mysqli_data_seek($RecordBlogCompare, 0);
	  $row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare);
  }
  ?>
  </a>
	  <?php if ($_GET['level']>=1) {?>
      <ol>
        <?php
					 $collang_RecordBlogViewLine_l2 = "zh-tw";
					if (isset($_GET['lang'])) {
					  $collang_RecordBlogViewLine_l2 = $_GET['lang'];
					}
					$colsubitem_id_RecordBlogViewLine_l2 = "-1";
					if (isset($_GET['type1'])) {
					  $colsubitem_id_RecordBlogViewLine_l2 = $_GET['type1'];
					}
					//mysqli_select_db($database_DB_Conn, $DB_Conn);
					$query_RecordBlogViewLine_l2 = sprintf("SELECT * FROM demo_blogitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordBlogViewLine_l2, "text"),GetSQLValueString($colsubitem_id_RecordBlogViewLine_l2, "int"));
					$RecordBlogViewLine_l2 = mysqli_query($DB_Conn, $query_RecordBlogViewLine_l2) or die(mysqli_error($DB_Conn));
					$row_RecordBlogViewLine_l2 = mysqli_fetch_assoc($RecordBlogViewLine_l2);
					$totalRows_RecordBlogViewLine_l2 = mysqli_num_rows($RecordBlogViewLine_l2);
					?>
        <?php do { ?>
          <li class="<?php echo $row_RecordBlogViewLine_l2['endnode']; ?>">
            <?php if ($row_RecordBlogViewLine_l2['endnode'] != 'child') { ?>
            <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=1&type1=<?php echo $_GET['type1']; ?>&type2=<?php echo $row_RecordBlogViewLine_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordBlogViewLine_l2['subitem_id']; ?>"><?php echo $row_RecordBlogViewLine_l2['itemname']; ?></a>
            <?php } else { ?>
            <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=1&type1=<?php echo $_GET['type1']; ?>&type2=<?php echo $row_RecordBlogViewLine_l2['item_id']; ?>&subitem_id=<?php echo $row_RecordBlogViewLine_l2['subitem_id']; ?>"><?php echo $row_RecordBlogViewLine_l2['itemname']; ?></a>
            <?php } ?>
            
          </li>
          <?php } while ($row_RecordBlogViewLine_l2 = mysqli_fetch_assoc($RecordBlogViewLine_l2)); ?>
        <?php mysqli_free_result($RecordBlogViewLine_l2);?>
      </ol>
 	  <?php } ?>
  </li>
  <?php } ?>
  <!-- 第一層分類 END -->
  <!-- 第二層分類 -->
  <?php if ($_GET['level']>=1) {?>
    <li class="<?php if ($_GET['level']==1 && $_GET['Opt'] != 'detailed') { echo 'current';}?>"><a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=maintypepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=1&type1=<?php echo $_GET['type1']; ?>&type2=<?php echo $_GET['type2']; ?>&subitem_id=<?php echo $_GET['subitem_id']; ?>">
  <?php
		  	do {  //比較字串
  ?>
		  <?php if (!(strcmp($row_RecordBlogCompare['item_id'], $_GET['type2']))) { echo $row_RecordBlogCompare['itemname']; } ?>
		  <?php
} while ($row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare));
  $rows = mysqli_num_rows($RecordBlogCompare);
  if($rows > 0) {
      mysqli_data_seek($RecordBlogCompare, 0);
	  $row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare);
  }
  ?>
  </a>
  			<?php if ($_GET['level']>=2) {?>
            <ol>
              <?php
                         $collang_RecordBlogViewLine_l3 = "zh-tw";
                        if (isset($_GET['lang'])) {
                          $collang_RecordBlogViewLine_l3 = $_GET['lang'];
                        }
                        $colsubitem_id_RecordBlogViewLine_l3 = "-1";
                        if (isset($_GET['type2'])) {
                          $colsubitem_id_RecordBlogViewLine_l3 = $_GET['type2'];
                        }
                        //mysqli_select_db($database_DB_Conn, $DB_Conn);
                        $query_RecordBlogViewLine_l3 = sprintf("SELECT * FROM demo_blogitem WHERE list_id = 1 && lang = %s && level = '2' && subitem_id = %s && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordBlogViewLine_l3, "text"),GetSQLValueString($colsubitem_id_RecordBlogViewLine_l3, "int"));
                        $RecordBlogViewLine_l3 = mysqli_query($DB_Conn, $query_RecordBlogViewLine_l3) or die(mysqli_error($DB_Conn));
                        $row_RecordBlogViewLine_l3 = mysqli_fetch_assoc($RecordBlogViewLine_l3);
                        $totalRows_RecordBlogViewLine_l3 = mysqli_num_rows($RecordBlogViewLine_l3);
			   ?>
              <?php do { ?>
                <li class="<?php echo $row_RecordBlogViewLine_l3['endnode']; ?>">
                  <?php if ($row_RecordBlogViewLine_l3['endnode'] != 'child') { ?>
                  <a href="#"><?php echo $row_RecordBlogViewLine_l3['itemname']; ?>></a>
                  <?php } else { ?>
                  <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=2&type1=<?php echo $_GET['type1']; ?>&type2=<?php echo $_GET['type2']; ?>&type3=<?php echo $row_RecordBlogViewLine_l3['item_id']; ?>&subitem_id=<?php echo $row_RecordBlogViewLine_l3['subitem_id']; ?>"><?php echo $row_RecordBlogViewLine_l3['itemname']; ?></a>
                  <?php } ?>
                </li>
                <?php } while ($row_RecordBlogViewLine_l3 = mysqli_fetch_assoc($RecordBlogViewLine_l3)); ?>
              <?php mysqli_free_result($RecordBlogViewLine_l3); ?>
            </ol>
            <?php } ?>
  </li>
  <?php } ?>
  <!-- 第二層分類 END -->
  <!-- 第三層分類 -->
  <?php if ($_GET['level']>=2) {?>
     <li class="<?php if ($_GET['level']==2 && $_GET['Opt'] != 'detailed') { echo 'current';}?>"><a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=typepage&lang=<?php echo $_SESSION['lang']; ?>&tp=Blog&level=2&type1=<?php echo $_GET['type1']; ?>&type2=<?php echo $_GET['type2']; ?>&type3=<?php echo $_GET['type3']; ?>&subitem_id=<?php echo $_GET['subitem_id']; ?>">
  <?php
		  	do {  //比較字串
  ?>
		  <?php if (!(strcmp($row_RecordBlogCompare['item_id'], $_GET['type3']))) { echo $row_RecordBlogCompare['itemname'] . "111"; } ?>
		  <?php
} while ($row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare));
  $rows = mysqli_num_rows($RecordBlogCompare);
  if($rows > 0) {
      mysqli_data_seek($RecordBlogCompare, 0);
	  $row_RecordBlogCompare = mysqli_fetch_assoc($RecordBlogCompare);
  }
  ?>
  </a>
  </li>
  <?php } ?>
  <!-- 第三層分類 END -->
  <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
  <li class="current"><a><?php echo $row_RecordBlogKeyWord['title']; ?></a></li>
  <?php } ?>
  <?php } else { // Show if recordset not empty ?>
  <li class="current"><a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Blog&amp;lang=<?php echo $_SESSION['lang'] ?>">總覽</a></li>
  <?php }  ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordBlogViewLine_l1);
mysqli_free_result($RecordBlogCompare);
?>