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

$collang_RecordForumViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordForumViewLine_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumViewLine_l1 = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordForumViewLine_l1, "text"));
$RecordForumViewLine_l1 = mysqli_query($DB_Conn, $query_RecordForumViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
$totalRows_RecordForumViewLine_l1 = mysqli_num_rows($RecordForumViewLine_l1);

$collang_RecordForumViewLine_l2 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordForumViewLine_l2 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumViewLine_l2 = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 2 && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordForumViewLine_l2, "text"));
$RecordForumViewLine_l2 = mysqli_query($DB_Conn, $query_RecordForumViewLine_l2) or die(mysqli_error($DB_Conn));
$row_RecordForumViewLine_l2 = mysqli_fetch_assoc($RecordForumViewLine_l2);
$totalRows_RecordForumViewLine_l2 = mysqli_num_rows($RecordForumViewLine_l2);

$colname_RecordForumKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordForumKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumKeyWord = sprintf("SELECT name, sdescription, skeyword, content FROM demo_forum WHERE id = %s", GetSQLValueString($colname_RecordForumKeyWord, "int"));
$RecordForumKeyWord = mysqli_query($DB_Conn, $query_RecordForumKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordForumKeyWord = mysqli_fetch_assoc($RecordForumKeyWord);
$totalRows_RecordForumKeyWord = mysqli_num_rows($RecordForumKeyWord);

if (isset($_GET['type1'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordForumViewLine_l1['item_id'], $_GET['type1']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype1 =  $row_RecordForumViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordForumViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordForumViewLine_l1['skeyword'];}
	} while ($row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1));
	$rows = mysqli_num_rows($RecordForumViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordForumViewLine_l1, 0);
		  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
	  }
}
if (isset($_GET['type2'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordForumViewLine_l1['item_id'], $_GET['type2']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype2 =  $row_RecordForumViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordForumViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordForumViewLine_l1['skeyword'];}
	} while ($row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1));
	$rows = mysqli_num_rows($RecordForumViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordForumViewLine_l1, 0);
		  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
	  }
}
if (isset($_GET['type3'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordForumViewLine_l1['item_id'], $_GET['type3']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype3 =  $row_RecordForumViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordForumViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordForumViewLine_l1['skeyword'];}
	} while ($row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1));
	$rows = mysqli_num_rows($RecordForumViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordForumViewLine_l1, 0);
		  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
	  }
}

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordForumViewLine_l2['itemname'], urldecode($_GET['searchkey'])))) { $ViewLinetype =  $row_RecordForumViewLine_l2['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordForumViewLine_l2['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordForumViewLine_l2['skeyword'];}
	} while ($row_RecordForumViewLine_l2 = mysqli_fetch_assoc($RecordForumViewLine_l2));
			  $rows = mysqli_num_rows($RecordForumViewLine_l2);
			  if($rows > 0) {
				  mysqli_data_seek($RecordForumViewLine_l2, 0);
				  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l2);
			  }
}

if(isset($row_RecordForumKeyWord['name']))
{
	$Title_Word = $row_RecordForumKeyWord['name'] . " - " . $SiteName;
}else {
	if($ViewLinetype != "") {
		$Title_Word = $ViewLinetype . " - " . $ModuleName['Forum'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Forum'] . " - " . $SiteName;
	}
}

if(isset($row_RecordForumKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordForumKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordForumKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordForumKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordForumKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordForumKeyWord);
?>
