<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

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

$maxRows_RecordProductPost = 10;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordProductPost = $pagePost * $maxRows_RecordProductPost;

$colname_RecordProductPost = "-1";
if (isset($_GET['pid'])) {
  $colname_RecordProductPost = $_GET['pid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPost = sprintf("SELECT * FROM demo_productpost WHERE pid = %s ORDER BY postdate DESC", GetSQLValueString($colname_RecordProductPost, "int"));
$query_limit_RecordProductPost = sprintf("%s LIMIT %d, %d", $query_RecordProductPost, $startRow_RecordProductPost, $maxRows_RecordProductPost);
$RecordProductPost = mysqli_query($DB_Conn, $query_limit_RecordProductPost) or die(mysqli_error($DB_Conn));
$row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost);
if (isset($_GET['totalRows_RecordProductPost'])) {
  $totalRows_RecordProductPost = $_GET['totalRows_RecordProductPost'];
} else {
  $all_RecordProductPost = mysqli_query($DB_Conn, $query_RecordProductPost);
  $totalRows_RecordProductPost = mysqli_num_rows($all_RecordProductPost);
}
$totalPages_RecordProductPost = ceil($totalRows_RecordProductPost/$maxRows_RecordProductPost)-1;

$queryString_RecordProductPost = "";
$queryString_RecordProductPost = sprintf("&totalRows_RecordProductPost=%d%s", $totalRows_RecordProductPost, $queryString_RecordProductPost);
?>

<?php 
// 倒序
$floor = (($totalPages_RecordProductPost - $pagePost) * $maxRows_RecordProductPost) + ($totalRows_RecordProductPost - ($maxRows_RecordProductPost*$totalPages_RecordProductPost));
?>

<?php //$floor = min($startRow_RecordProductPost + $maxRows_RecordProductPost, $totalRows_RecordProductPost); ?>

                  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordProductPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordProductPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordProductPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php echo $row_RecordProductPost['content'];?>                          
						<?php require("../require_productreply.php");?>
                        </td>
                      </tr>
                    </table>
                    <?php $floor--;?>
                  </div> 
                  <?php } while ($row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost)); ?>
                  
<?php
mysqli_free_result($RecordProductPost);
?>
