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

$collang_RecordAboutMultiLeftMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAboutMultiLeftMenu = $_GET['lang'];
}
$coluserid_RecordAboutMultiLeftMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutMultiLeftMenu = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutMultiLeftMenu = sprintf("SELECT * FROM demo_about WHERE lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC", GetSQLValueString($collang_RecordAboutMultiLeftMenu, "text"),GetSQLValueString($coluserid_RecordAboutMultiLeftMenu, "int"));
$RecordAboutMultiLeftMenu = mysqli_query($DB_Conn, $query_RecordAboutMultiLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordAboutMultiLeftMenu = mysqli_fetch_assoc($RecordAboutMultiLeftMenu);
$totalRows_RecordAboutMultiLeftMenu = mysqli_num_rows($RecordAboutMultiLeftMenu);
?>
<?php if ($totalRows_RecordAboutMultiLeftMenu > 0) { // Show if recordset not empty ?>
<ul class="list-group">
<?php $pan_ct=0; ?>
        <?php do { ?>
          <li class="list-group-item">
          <a href="<?php echo $SiteBaseUrl . url_rewrite("about",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordAboutMultiLeftMenu['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordAboutMultiLeftMenu['title']; ?></a></li>
                    
          <?php } while ($row_RecordAboutMultiLeftMenu = mysqli_fetch_assoc($RecordAboutMultiLeftMenu)); ?>
</ul>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordAboutMultiLeftMenu);
?>