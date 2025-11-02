<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
//echo "\n第{$_REQUEST['number']}颗星星，值为{$_REQUEST['value']} 为{$_REQUEST['id']}";
$starnumber = $_REQUEST['number'];
$starvalue = $_REQUEST['value'];
$pdid = $_REQUEST['id'];
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

$colname_RecordProductRater = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductRater = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductRater = sprintf("SELECT * FROM demo_productrater WHERE pdid = %s", GetSQLValueString($colname_RecordProductRater, "int"));
$RecordProductRater = mysqli_query($DB_Conn, $query_RecordProductRater) or die(mysqli_error($DB_Conn));
$row_RecordProductRater = mysqli_fetch_assoc($RecordProductRater);
$totalRows_RecordProductRater = mysqli_num_rows($RecordProductRater);

// 預設資料新增
if($totalRows_RecordProductRater == 0)
{
	for($i=1; $i<=10; $i++)
	{
		$insertSQL = sprintf("INSERT INTO demo_productrater (starnumber, pdid) VALUES ('$i','$pdid')");
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	}
}
//$updateSQL = sprintf("UPDATE demo_news SET (rater) VALUES ('$rater') WHERE (id) VALUES ('$id')");

// 更新評分
$updateSQL = sprintf("UPDATE demo_productrater SET starvalue=starvalue+1 WHERE starnumber=%s && pdid=%s",
					 GetSQLValueString($_GET['number'], "int"),
					 GetSQLValueString($_GET['id'], "int"));
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

// 投票次數
$updateSQL1 = sprintf("UPDATE demo_product SET ratercount=ratercount+1 WHERE id=%s",
					 GetSQLValueString($_GET['id'], "int"));
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$Result1 = mysqli_query($DB_Conn, $updateSQL1) or die(mysqli_error($DB_Conn));


echo '您的評分為' . $_REQUEST['value'] . '顆星';
//echo json_encode($_POST);

mysqli_free_result($RecordProductRater);
?>
