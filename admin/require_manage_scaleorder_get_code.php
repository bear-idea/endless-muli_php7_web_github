<?php 

if($row_RecordCartDetailed['code'] != "") {$row_RecordScaleorder['code'] = $row_RecordCartDetailed['code'];}

$colname_RecordScale = "-1";
if (isset($row_RecordScaleorder['code'])) {
  $colname_RecordScale = $row_RecordScaleorder['code'];
}
$coluserid_RecordScale = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScale = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"));
$RecordScale = mysqli_query($DB_Conn, $query_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);
$totalRows_RecordScale = mysqli_num_rows($RecordScale);

//////////

$collang_RecordScaleViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordScaleViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordScaleViewLine_l1 = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleViewLine_l1 = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scaleitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordScaleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordScaleViewLine_l1, "int"));
$RecordScaleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordScaleViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
$totalRows_RecordScaleViewLine_l1 = mysqli_num_rows($RecordScaleViewLine_l1);


if ($row_RecordScale['type1'] != '') {
	do {  //比較字串
		if (!(strcmp($row_RecordScaleViewLine_l1['item_id'], $row_RecordScale['type1']))) { $row_RecordScaleorder['code'] =  $row_RecordScaleViewLine_l1['itemname']; 
		}
	} while ($row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1));
	$rows = mysqli_num_rows($RecordScaleViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordScaleViewLine_l1, 0);
		  $row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
	  }
}

echo $row_RecordScaleorder['code'];
 ?>
<?php
mysqli_free_result($RecordScale);
?>
