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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
/* 新增類別項目 */
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_PermissionItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_permissionitem (list_id, itemname, lang, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
//var_dump($_POST['grouptype']);
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_PermissionItemEdit")) {
	

	foreach($_POST['item_id'] as $key => $val){
		 	 
		if($_POST['grouptype'."_".$val] != ''){
		   $grouptype = implode(",",$_POST['grouptype'."_".$val]);
		}
		  
		// 判斷此使用者是否有值
		if($grouptype != ''){
			
		// 取得 PermissionGroupType 是否有設定
		$coluserid_RecordPermissionGroupTypeGet = "-1";
		if (isset($w_userid)) {
		  $coluserid_RecordPermissionGroupTypeGet = $w_userid;
		}
		$colitemid_RecordPermissionGroupTypeGet = "-1";
		if (isset($val)) {
		  $colitemid_RecordPermissionGroupTypeGet = $val;
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordPermissionGroupTypeGet = sprintf("SELECT * FROM demo_permissiongrouptype WHERE itemid=%s && userid=%s",GetSQLValueString($colitemid_RecordPermissionGroupTypeGet, "int"),GetSQLValueString($coluserid_RecordPermissionGroupTypeGet, "int"));
		$RecordPermissionGroupTypeGet = mysqli_query($DB_Conn, $query_RecordPermissionGroupTypeGet) or die(mysqli_error($DB_Conn));
		$row_RecordPermissionGroupTypeGet = mysqli_fetch_assoc($RecordPermissionGroupTypeGet);
		$totalRows_RecordPermissionGroupTypeGet = mysqli_num_rows($RecordPermissionGroupTypeGet);
		  
		  if($totalRows_RecordPermissionGroupTypeGet == 0) {
			  $insertSQL = sprintf("INSERT INTO demo_permissiongrouptype (grouptype, itemid, lang, userid) VALUES (%s, %s, %s, %s)",
						   GetSQLValueString($grouptype, "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"),
						   GetSQLValueString($_GET["lang"], "text"),
						   GetSQLValueString($w_userid, "int"));
	
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
		  }
		  
		  if($totalRows_RecordPermissionGroupTypeGet > 0) {
			  $updateSQL = sprintf("UPDATE demo_permissiongrouptype SET grouptype=%s WHERE itemid=%s",
								   GetSQLValueString($grouptype, "text"), 
								   GetSQLValueString($_POST['item_id'][$key], "int"));
			
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result2 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		  }
		  
		}else{
			  $deleteSQL = sprintf("DELETE FROM demo_permissiongrouptype WHERE itemid = %s && userid=%s",
                       GetSQLValueString($_POST['item_id'][$key], "int"),
                       GetSQLValueString($w_userid, "int"));

			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
		}
		
	}
}

$collang_RecordPermissionListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordPermissionListItem = $_GET['lang'];
}
$coluserid_RecordPermissionListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionListItem = $w_userid;
}

$collistid_RecordPermissionListItem = "1";
/*if (isset($_GET['list_id'])) {
  $collistid_RecordPermissionListItem = $_GET['list_id'];
}*/
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionListItem = sprintf("SELECT demo_permissionitem.item_id, demo_permissionitem.userid, demo_permissionlist.list_id, demo_permissionlist.listname, demo_permissionitem.itemname, demo_permissionitem.itemvalue, demo_permissionitem.grouptype, demo_permissionitem.sortid, demo_permissionitem.indicate, demo_permissionitem.lang FROM demo_permissionlist LEFT OUTER JOIN demo_permissionitem ON demo_permissionlist.list_id = demo_permissionitem.list_id WHERE demo_permissionlist.list_id = %s && ((demo_permissionitem.userid=%s || demo_permissionitem.userid=1)) ORDER BY demo_permissionitem.sortid ASC, demo_permissionitem.item_id DESC", GetSQLValueString($collistid_RecordPermissionListItem, "int"),GetSQLValueString($coluserid_RecordPermissionListItem, "int"));
$RecordPermissionListItem = mysqli_query($DB_Conn, $query_RecordPermissionListItem) or die(mysqli_error($DB_Conn));
$row_RecordPermissionListItem = mysqli_fetch_assoc($RecordPermissionListItem);
$totalRows_RecordPermissionListItem = mysqli_num_rows($RecordPermissionListItem);


$coluserid_RecordPermissionListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionListType = sprintf("SELECT * FROM demo_permissionitem WHERE list_id = 2 && (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordPermissionListType, "int"));
$RecordPermissionListType = mysqli_query($DB_Conn, $query_RecordPermissionListType) or die(mysqli_error($DB_Conn));
$row_RecordPermissionListType = mysqli_fetch_assoc($RecordPermissionListType);
$totalRows_RecordPermissionListType = mysqli_num_rows($RecordPermissionListType);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 權限 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

                    
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改功能</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordPermissionListItem > 0) { // Show if recordset not empty ?>
    <form id="form_PermissionItemEdit" name="form_PermissionItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <div id="card_sortable">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1" data-post-id="<?php echo $row_RecordPermissionListItem['item_id']; ?>">
          <div class="card-block">
              <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱 <i class="fa fa-info-circle" data-original-title="設定顯示的名稱，為使用者檢視用。" data-toggle="tooltip" data-placement="top"></i></span></div>
                            <input name="itemname[]" type="text" required="" class="form-control" id="itemname[]" value="<?php echo $row_RecordPermissionListItem['itemname']; ?>" readonly="readonly" data-parsley-trigger="blur"/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <?php 
			  
		    // 取得 PermissionGroupType 是否有設定
			/*$colname_RecordPermissionGroupType = "zh-tw";
			if (isset($_GET["lang"])) {
			  $colname_RecordPermissionGroupType = $_GET["lang"];
			}*/
			$coluserid_RecordPermissionGroupType = "-1";
			if (isset($w_userid)) {
			  $coluserid_RecordPermissionGroupType = $w_userid;
			}
			$colitemid_RecordPermissionGroupType = "-1";
			if (isset($row_RecordPermissionListItem['item_id'])) {
			  $colitemid_RecordPermissionGroupType = $row_RecordPermissionListItem['item_id'];
			}
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordPermissionGroupType = sprintf("SELECT * FROM demo_permissiongrouptype WHERE itemid=%s && userid=%s",GetSQLValueString($colitemid_RecordPermissionGroupType, "int"),GetSQLValueString($coluserid_RecordPermissionGroupType, "int"));
			$RecordPermissionGroupType = mysqli_query($DB_Conn, $query_RecordPermissionGroupType) or die(mysqli_error($DB_Conn));
			$row_RecordPermissionGroupType = mysqli_fetch_assoc($RecordPermissionGroupType);
			$totalRows_RecordPermissionGroupType = mysqli_num_rows($RecordPermissionGroupType);
		
			  $grouptype = array();
			  $grouptype = mb_split(",",$row_RecordPermissionGroupType['grouptype']); 
			  ?>
              <?php do {  ?>
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="grouptype_<?php echo $row_RecordPermissionListItem['item_id']; ?>[]" type="checkbox" id="grouptype_<?php echo $row_RecordPermissionListItem['item_id']; ?>_<?php echo $row_RecordPermissionListType['item_id']?>" value="<?php echo $row_RecordPermissionListType['itemvalue']?>" <?php if(in_array($row_RecordPermissionListType['itemvalue'], $grouptype)) { echo "checked='checked'"; }?>/>
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                            <label for="grouptype_<?php echo $row_RecordPermissionListItem['item_id']; ?>_<?php echo $row_RecordPermissionListType['item_id']?>"><?php echo $row_RecordPermissionListType['itemname']?></label>
                            </div>          
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <?php
				} while ($row_RecordPermissionListType = mysqli_fetch_assoc($RecordPermissionListType));
				  $rows = mysqli_num_rows($RecordPermissionListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordPermissionListType, 0);
					  $row_RecordPermissionListType = mysqli_fetch_assoc($RecordPermissionListType);
				  }
				?>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordPermissionListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordPermissionListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordPermissionListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />       
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordPermissionListItem = mysqli_fetch_assoc($RecordPermissionListItem)); ?> 
    </div>
        <input type="hidden" name="MM_update" value="form_PermissionItemEdit" />
      </form>
      <?php } // Show if recordset not empty ?>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script>
$( "#card_sortable" ).sortable({
	start: function(e, ui){
        ui.placeholder.height(ui.item.height());
    },
	update  : function(event, ui)
	{
		var post_order_ids = new Array();
		$('#card_sortable card').each(function(){
			post_order_ids.push($(this).data("post-id"));
		});
		/*$.ajax({
			url:"ajax_upload.php",
			method:"POST",
			data:{id:post_order_ids},
			success:function(data)
			{
			 if(data){
			 	$(".alert-danger").hide();
			 	$(".alert-success ").show();
			 }else{
			 	$(".alert-success").hide();
			 	$(".alert-danger").show();
			 }
			}
		});*/
	}
});
</script>
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
<script type="text/javascript">
$(document).ready(function() {
		$('.sumoselect').SumoSelect({ okCancelInMulti: true, selectAll: true });
	});
</script>
<?php
mysqli_free_result($RecordPermissionListType);

mysqli_free_result($RecordPermissionListItem);
?>
