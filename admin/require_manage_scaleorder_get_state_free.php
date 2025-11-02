<?php 

$colname_RecordScale = "-1";
if (isset($row_RecordCartDetailed_free['code'])) {
  $colname_RecordScale = $row_RecordCartDetailed_free['code'];
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

///echo $row_RecordScale['state'];



 ?>
<?php
mysqli_free_result($RecordScale);
?>
