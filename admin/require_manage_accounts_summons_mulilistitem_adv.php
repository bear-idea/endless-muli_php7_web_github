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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Accounts_summonsItemAdd")) {
  $insertSQL = sprintf("INSERT INTO invoicing_accounts_summonsitem (list_id, itemname, itemvalue, subitem_id, state, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString(trim($_POST['itemvalue']), "text"),
					   GetSQLValueString($_POST['subitem_id'], "int"),
					   GetSQLValueString($_POST['state'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	
  $_GET['itemvalue'] = trim($_POST['itemvalue']);
  require("require_manage_accounts_summons_listitem_levellistid_get_and_update.php");
	
  $updateSQL = sprintf("UPDATE invoicing_accounts_summonsitem SET levellistid=%s WHERE item_id=%s",
						   GetSQLValueString(json_encode($accountingsubjects), "text"),
						   GetSQLValueString($row_RecordAccounts_summonsListType['item_id'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Accounts_summonsItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE invoicing_accounts_summonsitem SET list_id=%s, sortid=%s, indicate=%s, state=%s, itemname=%s, itemvalue=%s, lang=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString($_POST['state'][$key], "text"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString(trim($_POST['itemvalue'][$key]), "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  
	  $_GET['itemvalue'] = trim($_POST['itemvalue'][$key]);
	  require("require_manage_accounts_summons_listitem_levellistid_get_and_update.php");
	
	  $updateSQL = sprintf("UPDATE invoicing_accounts_summonsitem SET levellistid=%s WHERE item_id=%s",
						   GetSQLValueString(json_encode($accountingsubjects), "text"),
						   GetSQLValueString($_POST['item_id'][$key], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}
/* 刪除類別項目 */
if ((isset($_POST['deltype'])) && ($_POST['deltype'] != "")) {
	// 判斷該項目是否有資料
	$MM_flag="MM_update";
		if (isset($_POST[$MM_flag])) {
		foreach($_POST['deltype'] as $key => $val){
		  $MM_dupKeyRedirect="manage_accounts_summons.php?wshop=" . $wshop . "&Opt=mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&Operate=delErrorP";
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM invoicing_accounts_summons WHERE type1=%s", GetSQLValueString($loginUsername, "int")); // 分類
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
		  $loginFoundUser = mysqli_num_rows($LoginRS);
		
		  //if there is a row in the database, the username was found - can not add the requested username		 
		  if($loginFoundUser){
			$MM_qsChar = "?";
			//append the username to the redirect page
			if (substr_count($MM_dupKeyRedirect,"?") >=1) {
				$MM_qsChar = "&";
				$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
			}
			header ("Location: $MM_dupKeyRedirect");
			ob_end_flush(); // 輸出緩衝區結束
			exit;
		  } // if
		} //foreach
	} //if
	if (isset($_POST[$MM_flag])) {
		foreach($_POST['deltype'] as $key => $val){
		  $MM_dupKeyRedirect="manage_accounts_summons.php?wshop=" . $wshop . "&Opt=mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&Operate=delErrorT";
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE subitem_id=%s", GetSQLValueString($loginUsername, "int")); // 分類
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
		  $loginFoundUser = mysqli_num_rows($LoginRS);
	
		  //if there is a row in the database, the username was found - can not add the requested username		 
		  if($loginFoundUser){
			$MM_qsChar = "?";
			//append the username to the redirect page
			if (substr_count($MM_dupKeyRedirect,"?") >=1) {
				$MM_qsChar = "&";
				$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
			}
			header ("Location: $MM_dupKeyRedirect");
			ob_end_flush(); // 輸出緩衝區結束
			exit;
		  } // if
		} //foreach
	} //if
	//$MM_flag="MM_update";
  $deleteSQL = sprintf("DELETE FROM invoicing_accounts_summonsitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$collang_RecordAccounts_summonsListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAccounts_summonsListItem = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListItem = $w_userid;
}
$collistid_RecordAccounts_summonsListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAccounts_summonsListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListItem = sprintf("SELECT invoicing_accounts_summonsitem.item_id, invoicing_accounts_summonsitem.userid, invoicing_accounts_summonslist.list_id, invoicing_accounts_summonslist.listname, invoicing_accounts_summonsitem.itemname, invoicing_accounts_summonsitem.itemvalue, invoicing_accounts_summonsitem.sortid, invoicing_accounts_summonsitem.indicate, invoicing_accounts_summonsitem.state, invoicing_accounts_summonsitem.lang FROM invoicing_accounts_summonslist LEFT OUTER JOIN invoicing_accounts_summonsitem ON invoicing_accounts_summonslist.list_id = invoicing_accounts_summonsitem.list_id WHERE invoicing_accounts_summonslist.list_id = %s && invoicing_accounts_summonsitem.lang=%s && invoicing_accounts_summonsitem.level=0 && invoicing_accounts_summonsitem.userid=%s ORDER BY invoicing_accounts_summonsitem.sortid ASC, invoicing_accounts_summonsitem.itemvalue ASC;", GetSQLValueString($collistid_RecordAccounts_summonsListItem, "int"),GetSQLValueString($collang_RecordAccounts_summonsListItem, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListItem, "int"));
$RecordAccounts_summonsListItem = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListItem) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListItem = mysqli_fetch_assoc($RecordAccounts_summonsListItem);
$totalRows_RecordAccounts_summonsListItem = mysqli_num_rows($RecordAccounts_summonsListItem);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 會計傳票 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

                    
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>隱藏時僅會隱藏該分類，並不會將產品作隱藏，知道連結還是可做查看，若要隱藏產品請至個別產品做編輯。</b></div>
    
    <?php if ($totalRows_RecordAccounts_summonsListItem > 0) { // Show if recordset not empty ?>
    <form id="form_Accounts_summonsItemEdit" name="form_Accounts_summonsItemEdit" method="POST" action="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=<?php echo $_GET['Opt'] ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=<?php echo $_GET['list_id']; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordAccounts_summonsListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
			  <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">代碼</span></div>
                            <input name="itemvalue[]" type="text" id="itemvalue[]" value="<?php echo $row_RecordAccounts_summonsListItem['itemvalue']; ?>" class="form-control" data-parsley-trigger="blur"  required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">借貸別</span></div>
                            <select class="form-control" name="state[]" id="state[]">
				  <option <?php if (!(strcmp(0, $row_RecordAccounts_summonsListItem['state']))) {echo "selected=\"selected\"";} ?> value="0" >---</option>
                  <option <?php if (!(strcmp(1, $row_RecordAccounts_summonsListItem['state']))) {echo "selected=\"selected\"";} ?> value="1" >借</option>
                  <option <?php if (!(strcmp(-1, $row_RecordAccounts_summonsListItem['state']))) {echo "selected=\"selected\"";} ?> value="-1" >貸</option>
                </select>
                                      
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
                  <option <?php if (!(strcmp(1, $row_RecordAccounts_summonsListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="1" >顯示</option>
                  <option <?php if (!(strcmp(0, $row_RecordAccounts_summonsListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="0" >隱藏</option>
                </select>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                      <a class="btn btn-info btn-block" href="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage_adv&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordAccounts_summonsListItem['item_id']; ?>&amp;level=1&amp;list_id=<?php echo $_GET['list_id']; ?>" data-original-title="點選查看下層的分類項目" data-toggle="tooltip" data-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i><?php require("require_manage_accounts_summons_mulilistitem_count.php"); ?></a>           
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordAccounts_summonsListItem['item_id']; ?>" value="<?php echo $row_RecordAccounts_summonsListItem['item_id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordAccounts_summonsListItem['item_id']; ?>">是否刪除</label>
                            </div>          
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0"> 
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordAccounts_summonsListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordAccounts_summonsListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordAccounts_summonsListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />       
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>

              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordAccounts_summonsListItem = mysqli_fetch_assoc($RecordAccounts_summonsListItem)); ?> 
        <input type="hidden" name="MM_update" value="form_Accounts_summonsItemEdit" />
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
      <form id="form_Accounts_summonsItemAdd" name="form_Accounts_summonsItemAdd" method="POST" action="manage_accounts_summons.php?wshop=<?php echo $wshop;?>&amp;Opt=<?php echo $_GET['Opt'] ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=<?php echo $_GET['list_id']; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="itemname" type="text" id="itemname" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
				  
			  <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">代碼</span></div>
                            <input name="itemvalue" type="text" id="itemvalue" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
				  
			  <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">借貸別</span></div>
                            <select class="form-control" name="state" id="state">
				  <option <?php if (!(strcmp(0, $row_RecordAccounts_summonsListItem['state']))) {echo "selected=\"selected\"";} ?> value="0" >---</option>
                  <option <?php if (!(strcmp(1, $row_RecordAccounts_summonsListItem['state']))) {echo "selected=\"selected\"";} ?> value="1" >借</option>
                  <option <?php if (!(strcmp(-1, $row_RecordAccounts_summonsListItem['state']))) {echo "selected=\"selected\"";} ?> value="-1" >貸</option>
                </select>
                                      
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
      <input type="hidden" name="MM_insert" value="form_Accounts_summonsItemAdd" />
    </form>                  	
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
<?php if($_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if($_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if($_GET['Operate'] == "delErrorT") { ?>
<script type="text/javascript">
swal({ title: "刪除失敗！！該項目下方尚有分類！！!", text: "", type: "warning",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if($_GET['Operate'] == "delErrorP") { ?>
<script type="text/javascript">
swal({ title: "刪除失敗！！此分類尚有資料！！", text: "", type: "warning",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php
mysqli_free_result($RecordAccounts_summonsListItem);
?>
