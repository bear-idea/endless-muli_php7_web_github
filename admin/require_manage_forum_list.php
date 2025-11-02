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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumList = "SELECT * FROM demo_forumlist";
$RecordForumList = mysqli_query($DB_Conn, $query_RecordForumList) or die(mysqli_error($DB_Conn));
$row_RecordForumList = mysqli_fetch_assoc($RecordForumList);
$totalRows_RecordForumList = mysqli_num_rows($RecordForumList);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Forum']; ?> <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 清單一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
                        	<!-- begin table-responsive -->
                        	<div class="table-responsive">
								<table class="table table-striped">
									<tbody>
										<?php do { ?>
                                       <tr>     
                                         <td width="100" valign="middle">清單名稱</td>
                                         <td class="with-btn">
                                         <?php if ($row_RecordForumList['mulitype'] == '0') { // 單層?>
                                         <a class="btn btn-default btn-sm" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordForumList['list_id']; ?>"><?php echo $row_RecordForumList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>
                                         <?php } else if ($row_RecordForumList['mulitype'] == '1') { // 多層 ?>
                                         <a class="btn btn-default btn-sm" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt=mulilistitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordForumList['list_id']; ?>"><?php echo $row_RecordForumList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>
                                         <?php }  else if ($row_RecordForumList['mulitype'] == '2') { // 單層+隱藏+sort ?>
                                         <a class="btn btn-default btn-sm" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt=advlistitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordForumList['list_id']; ?>"><?php echo $row_RecordForumList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>                
                                         <?php } else if ($row_RecordForumList['mulitype'] == '3') { // 單層+隱藏+sort+值 ?>
                                         <a class="btn btn-default btn-sm" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt=adminlistitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordForumList['list_id']; ?>"><?php echo $row_RecordForumList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>          
                                         <?php } else if ($row_RecordForumList['mulitype'] == '4') { // 規格選擇 ?>
                                         <a class="btn btn-default btn-sm" href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt=formatlistitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordForumList['list_id']; ?>"><?php echo $row_RecordForumList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>                 
                                         <?php } ?>
                                         </td>    
                                       </tr>
                                       <?php } while ($row_RecordForumList = mysqli_fetch_assoc($RecordForumList)); ?>
									</tbody>
								</table>
	</div>
							<!-- end table-responsive -->
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordForumList);
?>