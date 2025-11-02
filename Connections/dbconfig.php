<?php //require_once('../../../Connections/DB_Conn.php'); ?>
<?php
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		mysqli_connect("localhost","root","min") or
         die("Could not connect: " . mysqli_error());
    //change to your database name
		mysqli_select_db("sample") or 
		     die("Could not select database: " . mysqli_error());
	}
}
?>