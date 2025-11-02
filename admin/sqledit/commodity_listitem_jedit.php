<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php
$_POST['id'] = $_POST['name'] . "_" . $_POST['pk'];

$id = $_POST['id'];
$value = trim(htmlspecialchars($_POST['value']));

//將$_POST['id']用explode函式拆解為$field和$id兩個變數
list($field, $id) = explode('_', $id);

//mysql query
$updateSQL = sprintf("UPDATE invoicing_commodityitem SET $field='$value' WHERE item_id='$id'");
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

//將值傳回前端
echo $value;
?>
