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

$maxRows_RecordBlogPost = 30;
$pageNum_RecordBlogPost = 0;
if (isset($_GET['pageNum_RecordBlogPost'])) {
  $pageNum_RecordBlogPost = $_GET['pageNum_RecordBlogPost'];
}
$startRow_RecordBlogPost = $pageNum_RecordBlogPost * $maxRows_RecordBlogPost;

$colname_RecordBlogPost = "-1";
if (isset($_GET['pid'])) {
  $colname_RecordBlogPost = $_GET['pid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogPost = sprintf("SELECT * FROM demo_blogpost WHERE pid = %s ORDER BY id DESC", GetSQLValueString($colname_RecordBlogPost, "int"));
$startRow_RecordBlogPost=($id-1)*$maxRows_RecordBlogPost; // ajax 取得目前頁數起始直
$query_limit_RecordBlogPost = sprintf("%s LIMIT %d, %d", $query_RecordBlogPost, $startRow_RecordBlogPost, $maxRows_RecordBlogPost);
$RecordBlogPost = mysqli_query($DB_Conn, $query_limit_RecordBlogPost) or die(mysqli_error($DB_Conn));
$row_RecordBlogPost = mysqli_fetch_assoc($RecordBlogPost);

if (isset($_GET['totalRows_RecordBlogPost'])) {
  $totalRows_RecordBlogPost = $_GET['totalRows_RecordBlogPost'];
} else {
  $all_RecordBlogPost = mysqli_query($DB_Conn, $query_RecordBlogPost);
  $totalRows_RecordBlogPost = mysqli_num_rows($all_RecordBlogPost);
}
$totalPages_RecordBlogPost = ceil($totalRows_RecordBlogPost/$maxRows_RecordBlogPost)-1;
?>
<?php //$floor = $startRow_RecordBlogPost; ?>
<?php $floor = min($startRow_RecordBlogPost + $maxRows_RecordBlogPost, $totalRows_RecordBlogPost); ?>
                  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordBlogPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordBlogPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordBlogPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php if ($row_RecordBlogPost['indicate']=='1' || ($row_RecordBlogPost['author'] == $_SESSION['wshopforckeditor'])){ ?>
                        <?php echo nl2br($row_RecordBlogPost['content']);?>                          
						<?php require("../require_blogreply.php");?>
                        <?php } else { ?>
                        <div style="color:#F00;">*** 私密留言 ***</div>
                        <?php } ?>
                        <?php echo $row_RecordBlogPost['content'];?>                          
                        </td>
                      </tr>
                    </table>
                    <?php $floor--;?>
                  </div> 
                    <?php } while ($row_RecordBlogPost = mysqli_fetch_assoc($RecordBlogPost)); ?>
                  
<?php
mysqli_free_result($RecordBlogPost);
?>
