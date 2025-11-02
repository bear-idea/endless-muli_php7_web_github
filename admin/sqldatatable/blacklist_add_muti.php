<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
	
  foreach($_POST['id'] as $key => $value) {
	  
	  $colname_RecordSearchmailGet = "-1";
	  if (isset($value)) {
		$colname_RecordSearchmailGet = $value;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordSearchmailGet = sprintf("SELECT mail FROM mail_searchdata WHERE id = %s", GetSQLValueString($colname_RecordSearchmailGet, "text"));
	  $RecordSearchmailGet = mysqli_query($DB_Conn, $query_RecordSearchmailGet) or die(mysqli_error($DB_Conn));
	  $row_RecordSearchmailGet = mysqli_fetch_assoc($RecordSearchmailGet);
	  $totalRows_RecordSearchmailGet = mysqli_num_rows($RecordSearchmailGet);
	  
	  $dt = new DateTime();
  
	  $insertSQL = sprintf("INSERT INTO mail_blacklist (title, type, postdate, indicate, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($row_RecordSearchmailGet['mail'], "text"),
						   GetSQLValueString("搜尋 E-mail", "text"),
						   GetSQLValueString($dt->format('Y-m-d'), "date"),
						   GetSQLValueString("1", "int"),
						   GetSQLValueString("", "text"),
						   GetSQLValueString("zh-tw", "text"),
						   GetSQLValueString($w_userid, "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  
	  

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  
	  
  }
  
  $deleteSQL = sprintf("DELETE FROM mail_searchdata WHERE id in (%s)", implode(",", $_POST['id']));
  
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  
}

?>
<?php
mysqli_free_result($RecordBlacklist);
?>
