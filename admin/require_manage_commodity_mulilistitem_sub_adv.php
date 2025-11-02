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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_CommodityItemAdd")) {
  $insertSQL = sprintf("INSERT INTO invoicing_commodityitem (list_id, itemname, itemvalue, subitem_id, lang, level, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString(trim($_POST['itemvalue']), "text"),
					   GetSQLValueString($_POST['subitem_id'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['level'], "int"),
					   GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 更新父節點 目前新增為子節點
  $updateSQL2 = sprintf("UPDATE invoicing_commodityitem SET endnode='parent' WHERE item_id=%s",
                       GetSQLValueString($_GET['item_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result2 = mysqli_query($DB_Conn, $updateSQL2) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_CommodityItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE invoicing_commodityitem SET list_id=%s, sortid=%s, indicate=%s, itemname=%s, itemvalue=%s, lang=%s, level=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
						   GetSQLValueString(trim($_POST['itemvalue'][$key]), "text"),
						   GetSQLValueString($_POST['lang'][$key], "text"),
						   GetSQLValueString($_POST['level'][$key], "int"),
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
		  switch($_GET['level'])
		  {
			  	case "1":
		  		$MM_dupKeyRedirect="manage_commodity.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorP";
				break;
				case "2":
		  		$MM_dupKeyRedirect="manage_commodity.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&subitem_id=" . $_GET['subitem_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorP";
				break;
				default:
				break;
		  }
		  switch($_GET['level'])
		  {
			  	case "1":
		  		$LoginRS__query = sprintf("SELECT * FROM invoicing_commodity WHERE type2=%s", GetSQLValueString($loginUsername, "int")); // 分類
				break;
				case "2":
		  		$LoginRS__query = sprintf("SELECT * FROM invoicing_commodity WHERE type3=%s", GetSQLValueString($loginUsername, "int")); // 分類
				break;
				default:
				break;
		  }
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
		// 判斷該分類下層是否有類別
		foreach($_POST['deltype'] as $key => $val){
		  switch($_GET['level'])
		  {
			  	case "1":
		  		$MM_dupKeyRedirect="manage_commodity.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorT";
				break;
				case "2":
		  		$MM_dupKeyRedirect="manage_commodity.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&subitem_id=" . $_GET['subitem_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorT";
				break;
				default:
				break;
		  }
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM invoicing_commodityitem WHERE subitem_id=%s", GetSQLValueString($loginUsername, "int")); // 分類
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
  $deleteSQL = sprintf("DELETE FROM invoicing_commodityitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前清單個數 若為0 則更新父節點
  if (isset($_GET['item_id'])) {
    $colname_RecordDateCount = $_GET['item_id'];
  }
  $coluserid_RecordDateCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDateCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDateCount = sprintf("SELECT * FROM invoicing_commodityitem WHERE subitem_id = %s && userid=%s", GetSQLValueString($colname_RecordDateCount, "int"), GetSQLValueString($coluserid_RecordDateCount, "int"));
$RecordDateCount = mysqli_query($DB_Conn, $query_RecordDateCount) or die(mysqli_error($DB_Conn));
$row_RecordDateCount = mysqli_fetch_assoc($RecordDateCount);
$totalRows_RecordDateCount = mysqli_num_rows($RecordDateCount);
  
  if($totalRows_RecordDateCount == 0)
  {
	// 更新父節點為根節點
  	$updateSQL3 = sprintf("UPDATE invoicing_commodityitem SET endnode='child' WHERE item_id=%s",
                       GetSQLValueString($_GET['item_id'], "int"));

  	//mysqli_select_db($database_DB_Conn, $DB_Conn);
  	$Result3 = mysqli_query($DB_Conn, $updateSQL3) or die(mysqli_error($DB_Conn));
  }
}

$collang_RecordCommodityListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCommodityListItem = $_GET['lang'];
}
$coluserid_RecordCommodityListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListItem = $w_userid;
}
$colitemid_RecordCommodityListItem = "-1";
if (isset($_GET['item_id'])) {
  $colitemid_RecordCommodityListItem = $_GET['item_id'];
}
$collevel_RecordCommodityListItem = "0";
if (isset($_GET['level'])) {
  $collevel_RecordCommodityListItem = $_GET['level'];
}
$collistid_RecordCommodityListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCommodityListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListItem = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = %s && lang=%s && level = %s && subitem_id = %s && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collistid_RecordCommodityListItem, "int"),GetSQLValueString($collang_RecordCommodityListItem, "text"),GetSQLValueString($collevel_RecordCommodityListItem, "int"),GetSQLValueString($colitemid_RecordCommodityListItem, "int"),GetSQLValueString($coluserid_RecordCommodityListItem, "int"));
$RecordCommodityListItem = mysqli_query($DB_Conn, $query_RecordCommodityListItem) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListItem = mysqli_fetch_assoc($RecordCommodityListItem);
$totalRows_RecordCommodityListItem = mysqli_num_rows($RecordCommodityListItem);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 產品管理 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

                    
<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <?php if($_GET['level'] == '1'){ ?>
    <div class="btn-group pull-right"><a href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=mulilistitempage_adv&amp;lang=<?php echo $_SESSION['lang']; ?>&list_id=<?php echo $_GET['list_id'] ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <?php } ?>
    <?php if($_GET['level'] == '2'){ ?>
    <div class="btn-group pull-right"><a href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage_adv&amp;lang=<?php echo $_SESSION['lang']; ?>&item_id=<?php echo $_GET['subitem_id'] ?>&level=1&list_id=<?php echo $_GET['list_id'] ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <?php } ?>
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordCommodityListItem > 0) { // Show if recordset not empty ?>
    <form id="form_CommodityItemEdit" name="form_CommodityItemEdit" method="POST" action="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=<?php echo $_GET['Opt'] ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=<?php echo $_GET['list_id']; ?>&amp;item_id=<?php echo $_GET['item_id'] ?>&amp;subitem_id=<?php echo $_GET['subitem_id'] ?>&amp;level=<?php echo $_GET['level'] ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <?php do { ?>
    <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">品名</span></div>
                            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordCommodityListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
			  <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">代碼</span></div>
                            <input name="itemvalue[]" type="text" id="itemvalue[]" value="<?php echo $row_RecordCommodityListItem['itemvalue']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">排序</span></div>
                            <input name="sortid[]" type="number" id="sortid[]" value="<?php echo $row_RecordCommodityListItem['sortid']; ?>" class=" form-control" maxlength="10" data-parsley-trigger="blur" required=""/>
                                      
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
                  <option <?php if (!(strcmp(1, $row_RecordCommodityListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="1" >顯示</option>
                  <option <?php if (!(strcmp(0, $row_RecordCommodityListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="0" >隱藏</option>
                </select>
                                      
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                       <?php if ($_GET['level'] == '') { ?>
                      <a class="btn btn-info btn-block" href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage_adv&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $_GET['item_id']; ?>&amp;level=1&amp;list_id=<?php echo $_GET['list_id']; ?>" data-original-title="點選查看下層的分類項目" data-toggle="tooltip" data-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i><?php require("require_manage_commodity_mulilistitem_count.php"); ?></a>  
                       <?php } ?> 
                       <?php if ($_GET['level'] == '1') { ?>
                      <a class="btn btn-info btn-block" href="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage_adv&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordCommodityListItem['item_id']; ?>&amp;subitem_id=<?php echo $row_RecordCommodityListItem['subitem_id']; ?>&amp;level=2&amp;list_id=<?php echo $_GET['list_id']; ?>" data-original-title="點選查看下層的分類項目" data-toggle="tooltip" data-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i><?php require("require_manage_commodity_mulilistitem_count.php"); ?></a>  
                       <?php } ?>         
                      </div>

                       
                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-1">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                          <div class="checkbox checkbox-css">
                              <input name="deltype[]" type="checkbox" id="deltype<?php echo $row_RecordCommodityListItem['item_id']; ?>" value="<?php echo $row_RecordCommodityListItem['item_id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordCommodityListItem['item_id']; ?>">是否刪除</label>
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
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordCommodityListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordCommodityListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordCommodityListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />    
                            <input name="level[]" type="hidden" id="level[]" value="<?php echo $_GET['level']; ?>" />   
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              </div>
              
              
              
          </div>
      </div>
    <?php } while ($row_RecordCommodityListItem = mysqli_fetch_assoc($RecordCommodityListItem)); ?> 
        <input type="hidden" name="MM_update" value="form_CommodityItemEdit" />
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
      <form id="form_CommodityItemAdd" name="form_CommodityItemAdd" method="POST" action="manage_commodity.php?wshop=<?php echo $wshop;?>&amp;Opt=<?php echo $_GET['Opt'] ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=<?php echo $_GET['list_id']; ?>&amp;item_id=<?php echo $_GET['item_id'] ?>&amp;subitem_id=<?php echo $_GET['subitem_id'] ?>&amp;level=<?php echo $_GET['level'] ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="card bg-aqua-transparent-1">
          <div class="card-block">
              <div class="row">
              
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">品名</span></div>
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
                            <button type="submit" class="btn btn btn-primary btn-block">送出</button>     
                            <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
                              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                              <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                              <input name="subitem_id" type="hidden" id="subitem_id" value="<?php echo $_GET['item_id']; ?>" />
                              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" /> 
                              <input name="level" type="hidden" id="level" value="<?php echo $_GET['level']; ?>" />
                      </div>
                       
                  <!--</div>-->
              </div>
              </div>
              
              
              
              
              </div>
      </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_CommodityItemAdd" />
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
mysqli_free_result($RecordCommodityListItem);
?>
