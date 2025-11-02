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

$colname_RecordLTpt = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordLTpt = $_GET['aid'];
}
$collang_RecordLTpt = "zh_TW";
if (isset($_SESSION['lang'])) {
  $collang_RecordLTpt = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLTpt = sprintf("SELECT title FROM demo_dftype WHERE id = %s && lang=%s", GetSQLValueString($colname_RecordLTpt, "int"),GetSQLValueString($collang_RecordLTpt, "text"));
$RecordLTpt = mysqli_query($DB_Conn, $query_RecordLTpt) or die(mysqli_error($DB_Conn));
$row_RecordLTpt = mysqli_fetch_assoc($RecordLTpt);
$totalRows_RecordLTpt = mysqli_num_rows($RecordLTpt);
?>

<ul class="nav flex-column">
            <li class="nav-header"><span class="badge badge-default"><i class="fa fa-paper-plane"></i> <?php echo $row_RecordLTpt['title']; ?></span></li>

            <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordLTpt['title']; ?>" data-bs-original-title="查看目前項目全部頁面內容" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-eye"></i><span>文章一覽</span></a></li>

            <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordLTpt['title']; ?>" data-bs-original-title="新增頁面內容" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-plus"></i><span>新增文章</span></a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
            <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordLTpt['title']; ?>" data-bs-original-title="新增子選單項目" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-list"></i><span>增修子分類</span></a></li>
            <?php } ?>
             <li class="menu-item"><a class="menu-link" href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=startpage_sub&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordLTpt['title']; ?>" data-bs-original-title="替目前選單設定起始頁，您必須選定一個頁面內容，否則該選單是不會抓取到頁面。" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-star"></i><span>首頁設定</span></a></li>




</ul><br />
<?php
mysqli_free_result($RecordLTpt);
?>
