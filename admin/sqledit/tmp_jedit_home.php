<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php
$_POST['id'] = $_POST['name'] . "_" . $_POST['pk'];

$id = $_POST['id'];
$value = trim(htmlspecialchars($_POST['value']));

if($value == '開啟頁面'){$homeselect = 1;}
if($value == '關閉頁面'){$homeselect = 0;}

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
list($field, $id) = explode('_', $id);

//mysql query
$updateSQL = sprintf("UPDATE demo_tmp SET $field='$homeselect' WHERE id='$id'");
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//將值傳回前端
if($homeselect == '1'){echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> ".$value;}
if($homeselect == '0'){echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> ".$value;}
?>
