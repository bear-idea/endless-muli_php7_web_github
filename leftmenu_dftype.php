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

$colname_RecordDfTypeMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDfTypeMultiLeftMenu_l1 = $_GET['lang'];
}
$coluserid_RecordDfTypeMultiLeftMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfTypeMultiLeftMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfTypeMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && indicate=1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colname_RecordDfTypeMultiLeftMenu_l1, "text"),GetSQLValueString($coluserid_RecordDfTypeMultiLeftMenu_l1, "int"));
$RecordDfTypeMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfTypeMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfTypeMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiLeftMenu_l1);
$totalRows_RecordDfTypeMultiLeftMenu_l1 = mysqli_num_rows($RecordDfTypeMultiLeftMenu_l1);
?>
<?php if ($totalRows_RecordDfTypeMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>
<?php do { ?>
<li class="list-group-item">
<?php if ($row_RecordDfTypeMultiLeftMenu_l1['typemenu'] == 'Link') { ?>
	<a href="<?php echo $row_RecordDfTypeMultiLeftMenu_l1['link']; ?>" target="_blank"><?php echo $row_RecordDfTypeMultiLeftMenu_l1['title']; ?></a>
<?php } else if ($row_RecordDfTypeMultiLeftMenu_l1['typemenu'] == 'LinkPage'){ ?>
    <a href="<?php echo $row_RecordDfTypeMultiLeftMenu_l1['link']; ?>"><?php echo $row_RecordDfTypeMultiLeftMenu_l1['title']; ?></a>
<?php } else if($row_RecordDfTypeMultiLeftMenu_l1['typemenu'] == 'DfPage' || $row_RecordDfTypeMultiLeftMenu_l1['typemenu'] == 'DfType') { ?>
    <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiLeftMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','aid'=>$row_RecordDfTypeMultiLeftMenu_l1['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfTypeMultiLeftMenu_l1['title']; ?></a>
<?php } else if ($row_RecordDfTypeMultiLeftMenu_l1['typemenu'] == 'Home') { ?>
    <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfTypeMultiLeftMenu_l1['title']; ?></a>
<?php } else { ?>
    <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiLeftMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfTypeMultiLeftMenu_l1['title']; ?></a>
<?php } ?>
<?php require("leftmenu_dfpage.php"); ?>
</li>
<?php } while ($row_RecordDfTypeMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiLeftMenu_l1)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordDfTypeMultiLeftMenu_l1);
?>
