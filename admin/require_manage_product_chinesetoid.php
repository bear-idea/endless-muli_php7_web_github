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
	
	$coluserid_RecordProduct = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordProduct = $w_userid;
	}
	
    //mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE userid=%s", GetSQLValueString($coluserid_RecordProduct, "int"));
	$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
	$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
	$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
	
	do{

		//////////////////////////////////////////////////////////	
		
		
		// 取得分類
		$_GET['list_id'] = "1";
		
		$coluserid_RecordProductListItem = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordProductListItem = $w_userid;
		}
		$collistid_RecordProductListItem = "-1";
		if (isset($_GET['list_id'])) {
		  $collistid_RecordProductListItem = $_GET['list_id'];
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordProductListItem = sprintf("SELECT demo_productitem.item_id, demo_productitem.userid, demo_productlist.list_id, demo_productlist.listname, demo_productitem.itemname, demo_productitem.sortid, demo_productitem.indicate, demo_productitem.level FROM demo_productlist LEFT OUTER JOIN demo_productitem ON demo_productlist.list_id = demo_productitem.list_id WHERE demo_productlist.list_id = %s && demo_productitem.userid=%s ORDER BY demo_productitem.sortid ASC, demo_productitem.item_id DESC", GetSQLValueString($collistid_RecordProductListItem, "int"),GetSQLValueString($coluserid_RecordProductListItem, "int"));
		$RecordProductListItem = mysqli_query($DB_Conn, $query_RecordProductListItem) or die(mysqli_error($DB_Conn));
		$row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem);
		$totalRows_RecordProductListItem = mysqli_num_rows($RecordProductListItem);
		
		
		do{
			
		
		
		if(trim($row_RecordProductListItem['itemname']) == trim($row_RecordProduct['type1']) && $row_RecordProductListItem['level'] == '0')
		{
		$updateSQL = sprintf("UPDATE demo_product SET type1=%s WHERE id=%s",
							   GetSQLValueString($row_RecordProductListItem['item_id'], "int"),
							   GetSQLValueString($row_RecordProduct['id'], "int"));
		
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		}
		
		if(trim($row_RecordProductListItem['itemname']) == trim($row_RecordProduct['type2']) && $row_RecordProductListItem['level'] == '1')
		{
		$updateSQL = sprintf("UPDATE demo_product SET type2=%s WHERE id=%s",
							   GetSQLValueString($row_RecordProductListItem['item_id'], "int"),
							   GetSQLValueString($row_RecordProduct['id'], "int"));
		
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		}
		
		if(trim($row_RecordProductListItem['itemname']) == trim($row_RecordProduct['type3']) && $row_RecordProductListItem['level'] == '2')
		{
		$updateSQL = sprintf("UPDATE demo_product SET type3=%s WHERE id=%s",
							   GetSQLValueString($row_RecordProductListItem['item_id'], "int"),
							   GetSQLValueString($row_RecordProduct['id'], "int"));
		
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		}
		
		} while ($row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem));
		
	

} while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct));
	
	
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
      
      <div class="alert alert-danger fade show m-10"><i class=""></i> <i class="fa fa-info-circle"></i> <b>將分類轉換為ID(須輸入產品及產品分類)</b></div>
     
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