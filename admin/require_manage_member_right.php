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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_MemberRightItemAdd")) {
	
$colname_RecordMemberRight = "-1";
if (isset($_GET['lang'])) {
  $colname_RecordMemberRight = $_GET['lang'];
}
$coluserid_RecordMemberRight = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMemberRight = $w_userid;
}
$collevel_RecordMemberRight = "-1";
if (isset($_POST['level'])) {
  $collevel_RecordMemberRight = $_POST['level'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMemberRight = sprintf("SELECT * FROM demo_memberright WHERE lang = %s && userid=%s && level=%s", GetSQLValueString($colname_RecordMemberRight, "text"),GetSQLValueString($coluserid_RecordMemberRight, "int"),GetSQLValueString($collevel_RecordMemberRight, "text"));
$RecordMemberRight = mysqli_query($DB_Conn, $query_RecordMemberRight) or die(mysqli_error($DB_Conn));
$row_RecordMemberRight = mysqli_fetch_assoc($RecordMemberRight);
$totalRows_RecordMemberRight = mysqli_num_rows($RecordMemberRight);

if($totalRows_RecordMemberRight == 0){
  $insertSQL = sprintf("INSERT INTO demo_memberright (name, level, discount, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
					   GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['discount'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}else{

  $_SESSION['DB_Add'] = "Error";

}

}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_MemberRightItemEdit")) {
	foreach($_POST['id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_memberright SET name=%s, discount=%s WHERE id=%s",
						   GetSQLValueString($_POST['name'][$key], "text"),
						   GetSQLValueString($_POST['discount'][$key], "int"),
						   GetSQLValueString($_POST['id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_memberright WHERE id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$colname_RecordMemberRight = "-1";
if (isset($_GET['lang'])) {
  $colname_RecordMemberRight = $_GET['lang'];
}
$coluserid_RecordMemberRight = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMemberRight = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMemberRight = sprintf("SELECT * FROM demo_memberright WHERE lang = %s && userid=%s", GetSQLValueString($colname_RecordMemberRight, "text"),GetSQLValueString($coluserid_RecordMemberRight, "int"));
$RecordMemberRight = mysqli_query($DB_Conn, $query_RecordMemberRight) or die(mysqli_error($DB_Conn));
$row_RecordMemberRight = mysqli_fetch_assoc($RecordMemberRight);
$totalRows_RecordMemberRight = mysqli_num_rows($RecordMemberRight);
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
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改權限</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordMemberRight > 0) { // Show if recordset not empty ?>
    <form id="form_MemberRightItemEdit" name="form_MemberRightItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <div id="card_sortable">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1" data-post-id="<?php echo $row_RecordMemberRight['id']; ?>">
          <div class="card-block">
              <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="name[]" type="text" id="name[]" value="<?php echo $row_RecordMemberRight['name']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">代號 <i class="fa fa-info-circle text-gray" data-original-title="此代號必須唯一，並且新增后不可修改。" data-toggle="tooltip" data-placement="top"></i></span></div>
                            <input name="level[]" type="text" required="" class=" form-control" id="level[]" value="<?php echo $row_RecordMemberRight['level']; ?>" readonly="readonly" data-parsley-trigger="blur"/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">折扣 <i class="fa fa-info-circle text-gray" data-original-title="例如:80代表8折/10代表1折。" data-toggle="tooltip" data-placement="top"></i></span></div>
                            <select name="discount[]" id="discount[]" class="form-control" data-parsley-trigger="blur" required="">
                      <?php for($i=10; $i<=99; $i++) { ?>
                      <option value="<?php echo $i; ?>" <?php if (!(strcmp($i, $row_RecordMemberRight['discount']))) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
                      <?php } ?>
				    </select>
                    <div class="input-group-append"><span class="input-group-text">折</span></div>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordMemberRight['id']; ?>" value="<?php echo $row_RecordMemberRight['id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordMemberRight['id']; ?>">是否刪除</label>
                            </div>          
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
                            <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordMemberRight['id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordMemberRight['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordMemberRight['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />       
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordMemberRight = mysqli_fetch_assoc($RecordMemberRight)); ?> 
    </div>
        <input type="hidden" name="MM_update" value="form_MemberRightItemEdit" />
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
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增權限</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
      <form id="form_MemberRightItemAdd" name="form_MemberRightItemAdd" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="name" type="text" id="name" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">代號 <i class="fa fa-info-circle text-gray" data-original-title="此代號必須唯一，並且新增后不可修改。" data-toggle="tooltip" data-placement="top"></i></span></div>
                            <input name="level" type="text" id="level" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">折扣 <i class="fa fa-info-circle text-gray" data-original-title="例如:80代表8折/10代表1折。" data-toggle="tooltip" data-placement="top"></i></span></div>
                            <select name="discount" id="discount" class="form-control" data-parsley-trigger="blur" required="">
                      <?php for($i=10; $i<=99; $i++) { ?>
                      <option value="<?php echo $i; ?>" <?php if ($i==80) {echo "selected=\"selected\"";} ?>><?php echo $i; ?></option>
                      <?php } ?>
				    </select>
                    <div class="input-group-append"><span class="input-group-text">折</span></div>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>     
                              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                              <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" /> 
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              
              </div>
      </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_MemberRightItemAdd" />
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
<?php if($_SESSION['DB_Add'] == "Error") { ?>
<script type="text/javascript">
swal({ title: "新增失敗！！代號重複！！!", text: "", type: "warning",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php unset($_SESSION["DB_Add"]); ?>
<?php } ?>
<?php
mysqli_free_result($RecordMemberRight);
?>
