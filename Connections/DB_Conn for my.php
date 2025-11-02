<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
date_default_timezone_set('Asia/Taipei');
$hostname_DB_Conn = "localhost";
$database_DB_Conn = "sample-muli";
$username_DB_Conn = "root";
$password_DB_Conn = "Jss218579";
$DB_Conn = mysqli_pconnect($hostname_DB_Conn, $username_DB_Conn, $password_DB_Conn) or trigger_error(mysqli_error(),E_USER_ERROR);
mysqli_query($DB_Conn, "SET NAMES 'utf8'",$DB_Conn); 
$SiteImgUrl = "site/"; // 前台圖片位置路徑
$SiteImgUrlAdmin = "../site/"; // 後台圖片位置路徑
$SiteImgFilePathAdmin = "../site/"; // 後台上傳圖片位置路徑(相對路徑)
?>