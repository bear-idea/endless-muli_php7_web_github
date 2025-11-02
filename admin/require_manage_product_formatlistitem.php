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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_ProductItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_productformat (aid, formatname, formatselect, pid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['aid'], "int"),
                       GetSQLValueString(trim($_POST['formatname']), "text"),
					   GetSQLValueString($_POST['formatselect'], "text"),
					   GetSQLValueString($_POST['pid'], "int"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_ProductItemEdit")) {
	foreach($_POST['pid'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_productformat SET aid=%s, sortid=%s, indicate=%s, formatname=%s, formatselect=%s, lang=%s WHERE pid=%s",
						   GetSQLValueString($_POST['aid'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString(trim($_POST['formatname'][$key]), "text"),
						   GetSQLValueString($_POST['formatselect'][$key], "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['pid'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productformat WHERE pid in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordProductListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListItem = $w_userid;
}
$colname_RecordProductListItem = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordProductListItem = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListItem = sprintf("SELECT * FROM demo_productformat WHERE aid = %s && userid=%s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductListItem, "text"),GetSQLValueString($coluserid_RecordProductListItem, "int"));
$RecordProductListItem = mysqli_query($DB_Conn, $query_RecordProductListItem) or die(mysqli_error($DB_Conn));
$row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem);
$totalRows_RecordProductListItem = mysqli_num_rows($RecordProductListItem);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 規格 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

                    
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordProductListItem > 0) { // Show if recordset not empty ?>
    <form id="form_ProductItemEdit" name="form_ProductItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="formatname[]" type="text" id="formatname[]" value="<?php echo $row_RecordProductListItem['formatname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                  <div class="input-group p-0">
                    <div class="input-group-prepend"><span class="input-group-text">規格選項</span></div>
                        <input name="formatselect[]" type="text" required="" class="form-control" id="formatselect[]" placeholder="請用【;】分開，例如：紅色;黃色;藍色。" value="<?php echo $row_RecordProductListItem['formatselect']; ?>" data-parsley-trigger="blur"/>
                                      
                    </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">排序</span></div>
                            <input name="sortid[]" type="number" id="sortid[]" value="<?php echo $row_RecordProductListItem['sortid']; ?>" class=" form-control" maxlength="10" data-parsley-trigger="blur" required=""/>
                                      
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
                  <option <?php if (!(strcmp(1, $row_RecordProductListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="1" >顯示</option>
                  <option <?php if (!(strcmp(0, $row_RecordProductListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="0" >隱藏</option>
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
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordProductListItem['pid']; ?>" value="<?php echo $row_RecordProductListItem['pid']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordProductListItem['pid']; ?>">是否刪除</label>
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
                            <input name="pid[]" type="hidden" id="pid[]" value="<?php echo $row_RecordProductListItem['pid']; ?>" />
                            <input name="aid[]" type="hidden" id="aid[]" value="<?php echo $row_RecordProductListItem['aid']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordProductListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />       
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem)); ?> 
        <input type="hidden" name="MM_update" value="form_ProductItemEdit" />
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
      <form id="form_ProductItemAdd" name="form_ProductItemAdd" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="formatname" type="text" id="formatname" class="form-control" data-parsley-trigger="blur" required="" placeholder="例如：顏色"/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">規格選項</span></div>
                            <input name="formatselect" type="text" id="formatselect" class="form-control" data-parsley-trigger="blur" required="" placeholder="請用【;】分開，例如：紅色;黃色;藍色。"/>
                                      
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
                              <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
                              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" /> 
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              
              </div>
      </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_ProductItemAdd" />
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
<?php
mysqli_free_result($RecordProductListItem);
?>
