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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_NationalmailItemAdd")) {
  $insertSQL = sprintf("INSERT INTO mail_nationalmailitem (list_id, itemname, itemvalue, fullname, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString(trim($_POST['itemvalue']), "text"),
					   GetSQLValueString(trim($_POST['fullname']), "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

/* 更新類別項目 */ 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Edit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE mail_nationalmailitem SET list_id=%s, sortid=%s, indicate=%s, itemname=%s, itemvalue=%s, fullname=%s, lang=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString(trim($_POST['itemvalue'][$key]), "text"),
						   GetSQLValueString(trim($_POST['fullname'][$key]), "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
  $deleteSQL = sprintf("DELETE FROM mail_nationalmailitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordNationalmailListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNationalmailListItem = $_GET['lang'];
}
$coluserid_RecordNationalmailListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNationalmailListItem = $w_userid;
}
$collistid_RecordNationalmailListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordNationalmailListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNationalmailListItem = sprintf("SELECT mail_nationalmailitem.item_id, mail_nationalmailitem.userid, mail_nationalmaillist.list_id, mail_nationalmaillist.listname, mail_nationalmailitem.itemname, mail_nationalmailitem.itemvalue, mail_nationalmailitem.fullname, mail_nationalmailitem.sortid, mail_nationalmailitem.indicate, mail_nationalmailitem.lang FROM mail_nationalmaillist LEFT OUTER JOIN mail_nationalmailitem ON mail_nationalmaillist.list_id = mail_nationalmailitem.list_id WHERE mail_nationalmaillist.list_id = %s && mail_nationalmailitem.lang=%s && mail_nationalmailitem.userid=%s ORDER BY mail_nationalmailitem.sortid ASC, mail_nationalmailitem.item_id DESC", GetSQLValueString($collistid_RecordNationalmailListItem, "int"),GetSQLValueString($collang_RecordNationalmailListItem, "text"),GetSQLValueString($coluserid_RecordNationalmailListItem, "int"));
$RecordNationalmailListItem = mysqli_query($DB_Conn, $query_RecordNationalmailListItem) or die(mysqli_error($DB_Conn));
$row_RecordNationalmailListItem = mysqli_fetch_assoc($RecordNationalmailListItem);
$totalRows_RecordNationalmailListItem = mysqli_num_rows($RecordNationalmailListItem);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 各國Mail <small>設定</small> 
      <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

                    
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="manage_nationalmail.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordNationalmailListItem > 0) { // Show if recordset not empty ?>
    <form id="form_NationalmailItemEdit" name="form_NationalmailItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <div id="card_sortable">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1" data-post-id="<?php echo $row_RecordNationalmailListItem['item_id']; ?>">
          <div class="card-block">
              <div class="row">
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordNationalmailListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">國家代號</span></div>
                            <input name="itemvalue[]" type="text" id="itemvalue[]" value="<?php echo $row_RecordNationalmailListItem['itemvalue']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">國家全名</span></div>
                            <input name="fullname[]" type="text" id="fullname[]" value="<?php echo $row_RecordNationalmailListItem['fullname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">排序</span></div>
                            <input name="sortid[]" type="number" id="sortid[]" value="<?php echo $row_RecordNationalmailListItem['sortid']; ?>" class=" form-control" maxlength="10" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">狀態</span></div>
                            <select class="form-control" name="indicate[]" id="indicate[]">
                  <option <?php if (!(strcmp(1, $row_RecordNationalmailListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="1" >顯示</option>
                  <option <?php if (!(strcmp(0, $row_RecordNationalmailListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="0" >隱藏</option>
                </select>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordNationalmailListItem['item_id']; ?>" value="<?php echo $row_RecordNationalmailListItem['item_id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordNationalmailListItem['item_id']; ?>">是否刪除</label>
                            </div>          
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出<?php require("require_manage_nationalmail_count.php"); ?></button>
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordNationalmailListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordNationalmailListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordNationalmailListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" /> 
                            <input type="hidden" name="MM_update" value="form_Edit" />      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordNationalmailListItem = mysqli_fetch_assoc($RecordNationalmailListItem)); ?> 
    </div>
        <input type="hidden" name="MM_update" value="form_Edit" />
      </form>
      <?php } // Show if recordset not empty ?>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增次分類</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
      <form id="form_NationalmailItemAdd" name="form_NationalmailItemAdd" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="itemname" type="text" id="itemname" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">國家代號</span></div>
                            <input name="itemvalue" type="text" id="itemvalue" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">國家全名</span></div>
                            <input name="fullname" type="text" id="fullname" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>     
                            <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
                              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                              <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                              <input name="subitem_id" type="hidden" id="subitem_id" value="0" />
                              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" /> 
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              
              </div>
      </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_NationalmailItemAdd" />
    </form>                  	
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
<?php
mysqli_free_result($RecordNationalmailListItem);
?>
