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

$collang_RecordWebSiteViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordWebSiteViewLine = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebSiteViewLine = sprintf("SELECT * FROM demo_websiteitem WHERE list_id = 1 && lang=%s", GetSQLValueString($collang_RecordWebSiteViewLine, "text"));
$RecordWebSiteViewLine = mysqli_query($DB_Conn, $query_RecordWebSiteViewLine) or die(mysqli_error($DB_Conn));
$row_RecordWebSiteViewLine = mysqli_fetch_assoc($RecordWebSiteViewLine);
$totalRows_RecordWebSiteViewLine = mysqli_num_rows($RecordWebSiteViewLine);

$collang_RecordWebSiteCompare = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordWebSiteCompare = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebSiteCompare = sprintf("SELECT * FROM demo_websiteitem WHERE list_id = 1 && lang=%s", GetSQLValueString($collang_RecordWebSiteCompare, "text"));
$RecordWebSiteCompare = mysqli_query($DB_Conn, $query_RecordWebSiteCompare) or die(mysqli_error($DB_Conn));
$row_RecordWebSiteCompare = mysqli_fetch_assoc($RecordWebSiteCompare);
$totalRows_RecordWebSiteCompare = mysqli_num_rows($RecordWebSiteCompare);
?>


<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordWebSiteViewLine > 0 && $_GET['Opt']=='typepage') { // Show if recordset not empty ?>
    <li><a href="website.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=WebSite&amp;lang=<?php echo $_SESSION['lang'] ?>">網站資訊</a>
   <ul>
    <?php do { ?>
      <li><a href="website.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=WebSite&amp;lang=<?php echo $_SESSION['lang'] ?>&amp;searchkey=<?php echo urlencode($row_RecordWebSiteViewLine['itemname']); ?>"><?php echo $row_RecordWebSiteViewLine['itemname']; ?></a></li>
      <?php } while ($row_RecordWebSiteViewLine = mysqli_fetch_assoc($RecordWebSiteViewLine)); ?>
  </ul>
    </li>
    <li class="<?php if (isset($_GET['Opt']) && ($_GET['Opt']=='viewpage' || $_GET['Opt']=='typepage')) {echo 'current';} ?>"><a href="#">
		  <?php
            //if($_GET['mn']==''){$_GET['mn']='About'; }// 初始化
            do {  //比較字串
          ?>
          <?php if (!(strcmp($row_RecordWebSiteCompare['itemname'], urldecode($_GET['searchkey'])))) { echo $row_RecordWebSiteCompare['itemname']; } ?>
          <?php
			} while ($row_RecordWebSiteCompare = mysqli_fetch_assoc($RecordWebSiteCompare));
			  $rows = mysqli_num_rows($RecordWebSiteCompare);
			  if($rows > 0) {
				  mysqli_data_seek($RecordWebSiteCompare, 0);
				  $row_RecordWebSiteCompare = mysqli_fetch_assoc($RecordWebSiteCompare);
			  }
		  ?>
    </a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><a href="website.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=WebSite&amp;lang=<?php echo $_SESSION['lang'] ?>">網站資訊</a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><a>內頁</a></li>
    <?php } ?>
    <?php } ?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordWebSiteViewLine);

mysqli_free_result($RecordWebSiteCompare);
?>