<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once("inc/inc_function.php"); ?>
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

$colname_RecordPublish = "-1";
if (isset($_GET['id'])) {
  $colname_RecordPublish = $_GET['id'];
}
$coluserid_RecordPublish = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPublish = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublish = sprintf("SELECT * FROM demo_publish WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordPublish, "int"),GetSQLValueString($coluserid_RecordPublish, "int"));
$RecordPublish = mysqli_query($DB_Conn, $query_RecordPublish) or die(mysqli_error($DB_Conn));
$row_RecordPublish = mysqli_fetch_assoc($RecordPublish);
$totalRows_RecordPublish = mysqli_num_rows($RecordPublish);
?>
<?php if ($MSTMP == 'default') { ?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Publish; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                     <!-- **************************************************************** -->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td width="50%"><!-- **************************************************************** -->
                           <strong><?php echo $row_RecordPublish['title']; ?></strong>
                           <!-- **************************************************************** --></td>
                         <td width="50%" align="right">&laquo; <a href="javascript:history.back()"><?php echo $Lang_BackPage ?></a></td>
                       </tr>
                     </table>
                
                     <!-- **************************************************************** -->
                    
						<?php echo pageBreak($row_RecordPublish['content']); ?>
				   
                        
                        
                          
                           
                            <!-- **************************************************************** -->

                </div>
            </div>
        </div>        
</div>
<?php } else { ?>
<?php include($TplPath . "/publish_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordPublish);
?>
