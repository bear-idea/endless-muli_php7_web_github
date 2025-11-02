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
  
  foreach($_POST['id'] as $i => $val){
	  $colname_RecordCartlistMuliGet = "-1";
	  if (isset($val)) {
		$colname_RecordCartlistMuliGet = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordCartlistMuliGet = sprintf("SELECT * FROM erp_scaleorderout WHERE oid = %s", GetSQLValueString($colname_RecordCartlistMuliGet, "int"));
	  $RecordCartlistMuliGet = mysqli_query($DB_Conn, $query_RecordCartlistMuliGet) or die(mysqli_error($DB_Conn));
	  $row_RecordCartlistMuliGet = mysqli_fetch_assoc($RecordCartlistMuliGet);
	  $totalRows_RecordCartlistMuliGet = mysqli_num_rows($RecordCartlistMuliGet);
	  do 
	  {
		  // 取得出庫物料資料
		  $colname_RecordCartlistDetailMuliGet = "-1";
		  if (isset($row_RecordCartlistMuliGet['oserial'])) {
			$colname_RecordCartlistDetailMuliGet = $row_RecordCartlistMuliGet['oserial'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordCartlistDetailMuliGet = sprintf("SELECT * FROM erp_scaleorderindetail WHERE oserial = %s", GetSQLValueString($colname_RecordCartlistDetailMuliGet, "text"));
		  $RecordCartlistDetailMuliGet = mysqli_query($DB_Conn, $query_RecordCartlistDetailMuliGet) or die(mysqli_error($DB_Conn));
		  $row_RecordCartlistDetailMuliGet = mysqli_fetch_assoc($RecordCartlistDetailMuliGet);
		  $totalRows_RecordCartlistDetailMuliGet = mysqli_num_rows($RecordCartlistDetailMuliGet);
		  
		  if($totalRows_RecordCartlistDetailMuliGet > 0) {
			  do {
				  $updateSQLCart = sprintf("UPDATE erp_scaleorderindetail SET oserial=%s, bound=%s, state=%s WHERE id =%s",
								   GetSQLValueString("", "text"),
								   GetSQLValueString("in", "text"),
								   GetSQLValueString(1, "int"),
								   GetSQLValueString($row_RecordCartlistDetailMuliGet['id'], "int"));
			
				  //mysqli_select_db($database_DB_Conn, $DB_Conn);
				  $Result1 = mysqli_query($DB_Conn, $updateSQLCart) or die(mysqli_error($DB_Conn));
			  } while ($row_RecordCartlistDetailMuliGet = mysqli_fetch_assoc($RecordCartlistDetailMuliGet));
	      } 
			  
	  } while ($row_RecordCartlistMuliGet = mysqli_fetch_assoc($RecordCartlistMuliGet));
  }
  
  $deleteSQL = sprintf("DELETE FROM erp_scaleorderout WHERE oid in (%s)", implode(",", $_POST['id']));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));

}
?>
<?php
mysqli_free_result($RecordManufacturer);
?>
