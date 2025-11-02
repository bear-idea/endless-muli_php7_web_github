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
$id=$_GET['id']; // 取得點選的頁碼

$maxRows_RecordNewsPost = 30;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordNewsPost = $pagePost * $maxRows_RecordNewsPost;

$colname_RecordNewsPost = "-1";
if (isset($_GET['pid'])) {
  $colname_RecordNewsPost = $_GET['pid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsPost = sprintf("SELECT * FROM demo_newspost WHERE pid = %s ORDER BY id DESC", GetSQLValueString($colname_RecordNewsPost, "int"));
$startRow_RecordNewsPost=($id-1)*$maxRows_RecordNewsPost; // ajax 取得目前頁數起始直
$query_limit_RecordNewsPost = sprintf("%s LIMIT %d, %d", $query_RecordNewsPost, $startRow_RecordNewsPost, $maxRows_RecordNewsPost);
$RecordNewsPost = mysqli_query($DB_Conn, $query_limit_RecordNewsPost) or die(mysqli_error($DB_Conn));
$row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost);

if (isset($_GET['totalRows_RecordNewsPost'])) {
  $totalRows_RecordNewsPost = $_GET['totalRows_RecordNewsPost'];
} else {
  $all_RecordNewsPost = mysqli_query($DB_Conn, $query_RecordNewsPost);
  $totalRows_RecordNewsPost = mysqli_num_rows($all_RecordNewsPost);
}
$totalPages_RecordNewsPost = ceil($totalRows_RecordNewsPost/$maxRows_RecordNewsPost)-1;
?>
<?php //$floor = $startRow_RecordNewsPost; ?>
<?php $floor = min($startRow_RecordNewsPost + $maxRows_RecordNewsPost, $totalRows_RecordNewsPost); ?>
                  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordNewsPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordNewsPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordNewsPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php echo $row_RecordNewsPost['content'];?>                          
						<?php require("../require_newsreply.php");?>
                        </td>
                      </tr>
                    </table>
                    <?php $floor--;?>
                  </div> 
                    <?php } while ($row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost)); ?>
                  
<?php
mysqli_free_result($RecordNewsPost);
?>
