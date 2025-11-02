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

$colaid_RecordDfPageViewLine_l1 = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPageViewLine_l1 = $_GET['aid'];
}
$collang_RecordDfPageViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordDfPageViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfPageViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageViewLine_l1 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageViewLine_l1, "int"), GetSQLValueString($collang_RecordDfPageViewLine_l1, "text"),GetSQLValueString($coluserid_RecordDfPageViewLine_l1, "int"));
$RecordDfPageViewLine_l1 = mysqli_query($DB_Conn, $query_RecordDfPageViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfPageViewLine_l1 = mysqli_fetch_assoc($RecordDfPageViewLine_l1);
$totalRows_RecordDfPageViewLine_l1 = mysqli_num_rows($RecordDfPageViewLine_l1);
?>
<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
  <li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
  <?php if (($_GET['Opt'] == 'subpage') && $totalRows_RecordDfPageViewLine_l1 >0) { ?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('dfpage',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','aid'=>$_GET['aid'],'type1'=>$_GET['type1']),'',$UrlWriteEnable);?>">
  <?php do {  //比較字串 ?>
  <?php //echo $totalRows_RecordDfPageViewLine_l1 ?>
		  <?php if (!(strcmp($row_RecordDfPageViewLine_l1['item_id'], $_GET['type1']))) { echo $row_RecordDfPageViewLine_l1['itemname']; } ?>
		  <?php
} while ($row_RecordDfPageViewLine_l1 = mysqli_fetch_assoc($RecordDfPageViewLine_l1));
  $rows = mysqli_num_rows($RecordDfPageViewLine_l1);
  if($rows > 0) {
      mysqli_data_seek($RecordDfPageViewLine_l1, 0);
	  $row_RecordDfPageViewLine_l1 = mysqli_fetch_assoc($RecordDfPageViewLine_l1);
  }
  ?>
  </a>
  </li>
  <?php } ?>
  <?php if(isset($_GET['Opt']) && $_GET['Opt']=='detailed'){  ?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecorddfpageKeyWord['title']; ?></a></li>
  <?php } else if($_GET['Opt'] == 'search'){  ?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $Lang_Dfpage_Search; //文章搜尋 ?></a></li>
  <?php } else {  ?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php if ((isset($_GET['id'])) && ($_GET['id'] != "")) { echo $row_RecorddfpageKeyWord['title'];}else if(isset($_GET['type1']) && $_GET['type1'] != ""){echo $row_RecorddfpageKeyWordType['title'];}else{echo $row_RecorddfpageKeyWordHome['title'];};?></a></li>
  <?php }  ?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordDfPageViewLine_l1);
?>