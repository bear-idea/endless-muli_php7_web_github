<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php
$_POST['id'] = $_POST['name'] . "_" . $_POST['pk'];

$id = $_POST['id'];
$value = trim(htmlspecialchars($_POST['value']));

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
list($field, $id) = explode('_', $id);

//mysql query
$updateSQL = sprintf("UPDATE demo_product SET $field='$value' WHERE id='$id'");
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//將值傳回前端
if($value == '0'){echo"---";}
if($value == '1'){echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Hot</span>";}
if($value == '2'){echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Act</span>";}
if($value == '3'){echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Sale</span>";}
if($value == '4'){echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">New</span>";}
?>
