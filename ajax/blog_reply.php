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

$colname_RecordBlogReTitle = "-1";
if (isset($_POST['pid'])) {
  $colname_RecordBlogReTitle = $_POST['pid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogReTitle = sprintf("SELECT title, wshop FROM demo_blog WHERE id = %s", GetSQLValueString($colname_RecordBlogReTitle, "int"));
$RecordBlogReTitle = mysqli_query($DB_Conn, $query_RecordBlogReTitle) or die(mysqli_error($DB_Conn));
$row_RecordBlogReTitle = mysqli_fetch_assoc($RecordBlogReTitle);
$totalRows_RecordBlogReTitle = mysqli_num_rows($RecordBlogReTitle);
?>
<?php
date_default_timezone_set('Asia/Taipei');
$pid = $_POST['pid'];
$indicate = $_POST['indicate'];
$retitle = 'Re：' . $row_RecordBlogReTitle['title'];
$blogauthor = $row_RecordBlogReTitle['blogauthor'];
$content = $_POST['content'];
$author = $_POST['author'];
$remail = $_POST['remail'];
$reurl = $_POST['reurl'];
$postdate = date("Y-m-d H-i-s");
//$userid = $_POST['userid'];

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
//list($field, $id) = explode('_', $id);

//$updateSQL = sprintf("INSERT INTO demo_blogpost (content) VALUES ('Los Angeles'");
////mysqli_select_db($database_DB_Conn, $DB_Conn);
//$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//echo $_POST['writer'];
if($content != '' && $author != '') {
$insertSQL = sprintf("INSERT INTO demo_blogpost (author,blogauthor,retitle,remail,reurl,indicate,content, pid, postdate) VALUES ('$author','$blogauthor','$retitle','$remail','$reurl','$indicate','$content', '$pid', '$postdate')");

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $updateSQL = "UPDATE demo_blog SET replycount=replycount+1 WHERE id = " . $_POST['pid'];
  /*執行更新動作*/
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  //echo $content;
  echo '<div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px; background-color:#D0E8FF">' . $_POST['content'] . '</div>'; 
}
  //echo json_encode($_POST);
?>