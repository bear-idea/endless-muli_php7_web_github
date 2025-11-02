<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

 $search_startdate = $_GET['year'] . "-" . $i_month;

$colsearch_RecordScaleorder_clearance = "-1";
if (isset($_GET['type'])) {
  $colsearch_RecordScaleorder_clearance = $_GET['type'];
}

$coluserid_RecordScaleorder_clearance = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleorder_clearance = $w_userid;
}

$dt = new DateTime($search_startdate);
$dt->modify('first day of this month');
$colstartdate_RecordScaleorder_clearance = $dt->format('Y-m-d');
/*if (isset($search_startdate) && $search_startdate != "") {
  $colstartdate_RecordScaleorder_clearance = $search_startdate;
}*/

$dt = new DateTime($search_startdate);
$dt->modify('last day of this month');
 $colenddate_RecordScaleorder_clearance = $dt->format('Y-m-d');

$colnamelang_RecordScaleorder_clearance = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleorder_clearance = $_SESSION['lang'];
}

$query_RecordScaleorder_clearance = sprintf("SELECT tb_o.title, erp_scalepricelist.startdate, erp_scalepricelist.enddate, erp_scalepricelist.price, erp_scalepricelist.mode, erp_scalepricelist.name, COUNT(tb_o.type) AS Count_Type, SUM(tb_o.Totalweight) AS Sum_Totalweight, SUM(tb_o.Minweight) AS Sum_Minweight, tb_o.code, tb_o.type, tb_o.bigtype, tb_o.Totalweight, tb_o.Minweight, tb_o.userid, tb_o.carnumber, tb_o.oserial, tb_o.wastecode, tb_o.postdate, tb_o.id, tb_o.lang FROM (SELECT * FROM erp_scaleorderclearancedetail WHERE lang = %s && userid=%s) AS tb_o LEFT OUTER JOIN erp_scalepricelist ON tb_o.code = erp_scalepricelist.code && tb_o.postdate BETWEEN erp_scalepricelist.startdate AND erp_scalepricelist.enddate + INTERVAL 1 DAY GROUP BY tb_o.type HAVING tb_o.postdate BETWEEN %s AND %s && (tb_o.type LIKE binary %s) $orderSql", GetSQLValueString($collang_RecordScaleorder_clearance, "text"),GetSQLValueString($coluserid_RecordScaleorder_clearance, "int"),GetSQLValueString($colstartdate_RecordScaleorder_clearance, "date"),GetSQLValueString($colenddate_RecordScaleorder_clearance, "date"),GetSQLValueString('%'.$colsearch_RecordScaleorder_clearance.'%', "text"));

$RecordScaleorder_clearance = mysqli_query($DB_Conn, $query_RecordScaleorder_clearance) or die(mysqli_error($DB_Conn));
$row_RecordScaleorder_clearance = mysqli_fetch_assoc($RecordScaleorder_clearance);
$totalRows_RecordScaleorder_clearance = mysqli_num_rows($RecordScaleorder_clearance);

?>
<?php if ($row_RecordScaleorder_clearance['Totalweight'] == "") { $row_RecordScaleorder_clearance['Totalweight']=0; }?>
<?php echo "{ 'label' : $i_month, 'value'  :".$row_RecordScaleorder_clearance['Totalweight'].", 'color' : COLOR_RED }"; ?>
<?php if($i_month < 12) {echo ",";} ?>
<?php
mysqli_free_result($RecordScaleorder_clearance);
?>
