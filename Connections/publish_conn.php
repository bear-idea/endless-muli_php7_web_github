<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_publish_conn = "localhost";
$database_publish_conn = "sample-muli-test";
$username_publish_conn = "root";
$password_publish_conn = "Jss218579";
$publish_conn = mysql_pconnect($hostname_publish_conn, $username_publish_conn, $password_publish_conn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>