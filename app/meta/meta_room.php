<?php require_once('Connections/DB_Conn.php'); ?>
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

$collang_RecordRoomViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordRoomViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomViewLine_l1 = sprintf("SELECT * FROM demo_roomitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordRoomViewLine_l1, "text"),GetSQLValueString($coluserid_RecordRoomViewLine_l1, "int"));
$RecordRoomViewLine_l1 = mysqli_query($DB_Conn, $query_RecordRoomViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1);
$totalRows_RecordRoomViewLine_l1 = mysqli_num_rows($RecordRoomViewLine_l1);

$colname_RecordRoomKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoomKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomKeyWord = sprintf("SELECT name, sdescription, skeyword, content FROM demo_room WHERE id = %s", GetSQLValueString($colname_RecordRoomKeyWord, "int"));
$RecordRoomKeyWord = mysqli_query($DB_Conn, $query_RecordRoomKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordRoomKeyWord = mysqli_fetch_assoc($RecordRoomKeyWord);
$totalRows_RecordRoomKeyWord = mysqli_num_rows($RecordRoomKeyWord);

if (isset($_GET['type1'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordRoomViewLine_l1['item_id'], $_GET['type1']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype1 =  $row_RecordRoomViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordRoomViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordRoomViewLine_l1['skeyword'];}
	} while ($row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1));
	$rows = mysqli_num_rows($RecordRoomViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordRoomViewLine_l1, 0);
		  $row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1);
	  }
}
if (isset($_GET['type2'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordRoomViewLine_l1['item_id'], $_GET['type2']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype2 =  $row_RecordRoomViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordRoomViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordRoomViewLine_l1['skeyword'];}
	} while ($row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1));
	$rows = mysqli_num_rows($RecordRoomViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordRoomViewLine_l1, 0);
		  $row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1);
	  }
}
if (isset($_GET['type3'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordRoomViewLine_l1['item_id'], $_GET['type3']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype3 =  $row_RecordRoomViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordRoomViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordRoomViewLine_l1['skeyword'];}
	} while ($row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1));
	$rows = mysqli_num_rows($RecordRoomViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordRoomViewLine_l1, 0);
		  $row_RecordRoomViewLine_l1 = mysqli_fetch_assoc($RecordRoomViewLine_l1);
	  }
}

if(isset($row_RecordRoomKeyWord['name']))
{
	$Title_Word = $row_RecordRoomKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Room'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Room'] . " - " . $SiteName;
	}
}

if(isset($row_RecordRoomKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordRoomKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordRoomKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordRoomKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordRoomKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordRoomKeyWord);
?>
