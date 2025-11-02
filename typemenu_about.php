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

$collang_RecordAboutMultiTypeMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAboutMultiTypeMenu = $_GET['lang'];
}
$coluserid_RecordAboutMultiTypeMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutMultiTypeMenu = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutMultiTypeMenu = sprintf("SELECT * FROM demo_about WHERE lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC", GetSQLValueString($collang_RecordAboutMultiTypeMenu, "text"),GetSQLValueString($coluserid_RecordAboutMultiTypeMenu, "int"));
$RecordAboutMultiTypeMenu = mysqli_query($DB_Conn, $query_RecordAboutMultiTypeMenu) or die(mysqli_error($DB_Conn));
$row_RecordAboutMultiTypeMenu = mysqli_fetch_assoc($RecordAboutMultiTypeMenu);
$totalRows_RecordAboutMultiTypeMenu = mysqli_num_rows($RecordAboutMultiTypeMenu);
?>
<?php if ($totalRows_RecordAboutMultiTypeMenu > 0) { // Show if recordset not empty ?>
        <?php do { ?>
            
          <span class="<?php echo $row_RecordAboutMultiTypeMenu['endnode']; ?> btn typemenu_btn">
            <?php if ($row_RecordAboutMultiTypeMenu['endnode'] != 'child') { ?>
            <a href="<?php echo $SiteBaseUrl . url_rewrite("about",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordAboutMultiTypeMenu['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordAboutMultiTypeMenu['title']; ?></a>
            <?php }  ?>
          </span>
          
          <?php } while ($row_RecordAboutMultiTypeMenu = mysqli_fetch_assoc($RecordAboutMultiTypeMenu)); ?>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordAboutMultiTypeMenu);
?>