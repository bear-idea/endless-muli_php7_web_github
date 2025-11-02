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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$coluserid_RecordScaleorder = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordScaleorder = $w_userid;
	}
	
    //mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScaleorder = sprintf("SELECT * FROM erp_scaleorderclearancedetail WHERE userid=%s", GetSQLValueString($coluserid_RecordScaleorder, "int"));
	$RecordScaleorder = mysqli_query($DB_Conn, $query_RecordScaleorder) or die(mysqli_error($DB_Conn));
	$row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder);
	$totalRows_RecordScaleorder = mysqli_num_rows($RecordScaleorder);
	
	do{

		//////////////////////////////////////////////////////////	
		
		
		// 取得分類
		
		if($row_RecordScaleorder['code'] != "") {
		
			$colname_RecordScaleGetCodeType = "-1";
			if (isset($row_RecordScaleorder['code'])) {
			  $colname_RecordScaleGetCodeType = $row_RecordScaleorder['code'];
			}
			
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordScaleGetCodeType = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($colname_RecordScaleGetCodeType, "text"), GetSQLValueString($coluserid_RecordScaleorder, "int"));
			$RecordScaleGetCodeType = mysqli_query($DB_Conn, $query_RecordScaleGetCodeType) or die(mysqli_error($DB_Conn));
			$row_RecordScaleGetCodeType = mysqli_fetch_assoc($RecordScaleGetCodeType);
			$totalRows_RecordScaleGetCodeType = mysqli_num_rows($RecordScaleGetCodeType);
		
		}else if($row_RecordScaleorder['title'] != ""){
			
			$colname_RecordScaleGetCodeType = "-1";
			if (isset($row_RecordScaleorder['title'])) {
			  $colname_RecordScaleGetCodeType = $row_RecordScaleorder['title'];
			}
			
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordScaleGetCodeType = sprintf("SELECT * FROM erp_scale WHERE name = %s && userid=%s", GetSQLValueString($colname_RecordScaleGetCodeType, "text"), GetSQLValueString($coluserid_RecordScaleorder, "int"));
			$RecordScaleGetCodeType = mysqli_query($DB_Conn, $query_RecordScaleGetCodeType) or die(mysqli_error($DB_Conn));
			$row_RecordScaleGetCodeType = mysqli_fetch_assoc($RecordScaleGetCodeType);
			$totalRows_RecordScaleGetCodeType = mysqli_num_rows($RecordScaleGetCodeType);
			
			//echo $row_RecordScaleGetCodeType['code'];	
			
			$updateSQL = sprintf("UPDATE erp_scaleorderclearancedetail SET code=%s WHERE id=%s",
							   GetSQLValueString($row_RecordScaleGetCodeType['code'], "text"),
							   GetSQLValueString($row_RecordScaleorder['id'], "int"));
		
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			
			//echo "<br>";
			
		}
			
		
		if($totalRows_RecordScaleGetCodeType > 0 )
		{
		
		$colitemid_RecordScaleViewLine_l1 = "-1";
		if (isset($row_RecordScaleGetCodeType['type1'])) {
		  $colitemid_RecordScaleViewLine_l1 = $row_RecordScaleGetCodeType['type1'];
		}
		
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordScaleViewLine_l1 = sprintf("SELECT * FROM erp_scaleitem WHERE item_id = %s && list_id = 1 ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colitemid_RecordScaleViewLine_l1, "text"));
		$RecordScaleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordScaleViewLine_l1) or die(mysqli_error($DB_Conn));
		$row_RecordScaleViewLine_l1 = mysqli_fetch_assoc($RecordScaleViewLine_l1);
		$totalRows_RecordScaleViewLine_l1 = mysqli_num_rows($RecordScaleViewLine_l1);
		
		
		///////////////////////////////////////////////////////////	
		
		$updateSQL = sprintf("UPDATE erp_scaleorderclearancedetail SET type=%s, wastecode=%s, bigtype=%s WHERE id=%s",
							   GetSQLValueString($row_RecordScaleViewLine_l1['itemname'], "text"),
							   GetSQLValueString($row_RecordScaleViewLine_l1['itemvalue'], "text"),
							   GetSQLValueString($row_RecordScaleGetCodeType['type'], "text"),
							   GetSQLValueString($row_RecordScaleorder['id'], "int"));
		
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		
	    }
	
	

} while ($row_RecordScaleorder = mysqli_fetch_assoc($RecordScaleorder));
	
	
}
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 清運明細類別 <small>維護</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-cog"></i> 類別維護</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" id="form1" name="form1" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      
      <div class="alert alert-danger fade show m-10"><i class=""></i> <i class="fa fa-info-circle"></i> <b>此維護會根據物料的分類同步於清運明細的分類</b></div>
     
      <div class="form-group row">
        <div class="col-md-12">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
          <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
        </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>