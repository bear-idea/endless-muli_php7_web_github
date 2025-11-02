<?php
session_start();
$validate = strtolower($_POST['validate']);
if($validate == strtolower($_SESSION['code'])){
echo  1;
}
?>