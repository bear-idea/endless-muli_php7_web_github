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

if ((isset($_GET['account'])) && ($_GET['account'] != "")) {
	
	$colname_RecordMember = "-1";
	if (isset($_GET['account'])) {
	  $colname_RecordMember = $_GET['account'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMember = sprintf("SELECT * FROM demo_member WHERE account = %s", GetSQLValueString($colname_RecordMember, "text"));
	$RecordMember = mysqli_query($DB_Conn, $query_RecordMember) or die(mysqli_error($DB_Conn));
	$row_RecordMember = mysqli_fetch_assoc($RecordMember);
	$totalRows_RecordMember = mysqli_num_rows($RecordMember);
	
	if($totalRows_RecordMember > 0  && $row_RecordMember['auth'] == $_GET['auth']) {
	
		$deleteSQL = sprintf("UPDATE demo_member SET level=%s, auth = 1 WHERE account=%s && auth=%s",
						   GetSQLValueString('Wshop_Member', "text"),
						   GetSQLValueString($_GET['account'], "text"),
						   GetSQLValueString($_GET['auth'], "text"));
	
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		 $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
	
		//$deleteGoTo = "../login_member.php?authcode=ok";
		$deleteGoTo = "../member.php?wshop=" . $_GET['wshop'] . "&Opt=viewpage&tp=Member&lang=" . $_SESSION['lang'] . "&authcode=ok";
		if (isset($_SERVER['QUERY_STRING'])) {
			$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
			$deleteGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $deleteGoTo));
	}
}
?>
