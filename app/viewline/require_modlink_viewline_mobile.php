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

$collang_RecordModlinkViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordModlinkViewLine = $_GET['lang'];
}
$coluserid_RecordModlinkViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordModlinkViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkViewLine = sprintf("SELECT * FROM demo_modlinkitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordModlinkViewLine, "text"),GetSQLValueString($coluserid_RecordModlinkViewLine, "int"));
$RecordModlinkViewLine = mysqli_query($DB_Conn, $query_RecordModlinkViewLine) or die(mysqli_error($DB_Conn));
$row_RecordModlinkViewLine = mysqli_fetch_assoc($RecordModlinkViewLine);
$totalRows_RecordModlinkViewLine = mysqli_num_rows($RecordModlinkViewLine);
?>


<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordModlinkViewLine > 0 && $_GET['Opt']=='typepage') { // Show if recordset not empty ?>
    <li><a href="<?php echo $SiteBaseUrl . url_rewrite('modlink',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Modlink']; //友站連結 ?></a>
    </li>
    <li class="<?php if (isset($_GET['Opt']) && ($_GET['Opt']=='viewpage' || $_GET['Opt']=='typepage')) {echo 'current';} ?>"><a href="#">
		  <?php
            //if($_GET['mn']==''){$_GET['mn']='About'; }// 初始化
            do {  //比較字串
          ?>
          <?php if (!(strcmp($row_RecordModlinkViewLine['itemname'], urldecode($_GET['searchkey'])))) { echo $row_RecordModlinkViewLine['itemname']; } ?>
          <?php
			} while ($row_RecordModlinkViewLine = mysqli_fetch_assoc($RecordModlinkViewLine));
			  $rows = mysqli_num_rows($RecordModlinkViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordModlinkViewLine, 0);
				  $row_RecordModlinkViewLine = mysqli_fetch_assoc($RecordModlinkViewLine);
			  }
		  ?>
    </a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><a href="<?php echo $SiteBaseUrl . url_rewrite('modlink',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Modlink']; //友站連結 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><a>內頁</a></li>
    <?php } ?>
    <?php } ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordModlinkViewLine);
?>