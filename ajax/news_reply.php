<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
date_default_timezone_set('Asia/Taipei');
$pid = $_POST['pid'];
$content = $_POST['content'];
$author = $_POST['author'];
$postdate = date("Y-m-d H-i-s");
//$userid = $_POST['userid'];

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
//list($field, $id) = explode('_', $id);

//$updateSQL = sprintf("INSERT INTO demo_newspost (content) VALUES ('Los Angeles'");
////mysqli_select_db($database_DB_Conn, $DB_Conn);
//$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//echo $_POST['writer'];
if($content != '' && $author != '') {
$insertSQL = sprintf("INSERT INTO demo_newspost (author,content, pid, postdate) VALUES ('$author','$content', '$pid', '$postdate')");

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  //echo $content;
  echo '<div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px; background-color:#D0E8FF">' . $_POST['content'] . '</div>'; 
}
  //echo json_encode($_POST);
?>