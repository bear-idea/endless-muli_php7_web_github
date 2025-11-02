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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_AboutItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_aboutitem (list_id, itemname, subitem_id, userid, lang, level) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['list_id'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString($_POST['subitem_id'], "int"),
					   GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['level'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  // 更新父節點 目前新增為子節點
  $updateSQL2 = sprintf("UPDATE demo_aboutitem SET endnode='parent' WHERE item_id=%s",
                       GetSQLValueString($_GET['item_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result2 = mysqli_query($DB_Conn, $updateSQL2) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_AboutItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_aboutitem SET list_id=%s, sortid=%s, indicate=%s, itemname=%s, lang=%s, level=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['list_id'][$key], "int"),
						   GetSQLValueString($_POST['sortid'][$key], "int"),
						   GetSQLValueString($_POST['indicate'][$key], "int"),
						   GetSQLValueString(trim($_POST['itemname'][$key]), "text"),
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
		  		$MM_dupKeyRedirect="manage_about.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorP";
				break;
				case "2":
		  		$MM_dupKeyRedirect="manage_about.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&subitem_id=" . $_GET['subitem_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorP";
				break;
				default:
				break;
		  }
		  switch($_GET['level'])
		  {
			  	case "1":
		  		$LoginRS__query = sprintf("SELECT * FROM demo_about WHERE type2=%s", GetSQLValueString($loginUsername, "int")); // 分類
				break;
				case "2":
		  		$LoginRS__query = sprintf("SELECT * FROM demo_about WHERE type3=%s", GetSQLValueString($loginUsername, "int")); // 分類
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
		  		$MM_dupKeyRedirect="manage_about.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorT";
				break;
				case "2":
		  		$MM_dupKeyRedirect="manage_about.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&list_id=" . $_GET['list_id'] . "&item_id=" . $_GET['item_id'] . "&subitem_id=" . $_GET['subitem_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorT";
				break;
				default:
				break;
		  }
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM demo_aboutitem WHERE subitem_id=%s", GetSQLValueString($loginUsername, "int")); // 分類
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
  $deleteSQL = sprintf("DELETE FROM demo_aboutitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

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
$query_RecordDateCount = sprintf("SELECT * FROM demo_aboutitem WHERE subitem_id = %s && userid=%s", GetSQLValueString($colname_RecordDateCount, "int"), GetSQLValueString($coluserid_RecordDateCount, "int"));
$RecordDateCount = mysqli_query($DB_Conn, $query_RecordDateCount) or die(mysqli_error($DB_Conn));
$row_RecordDateCount = mysqli_fetch_assoc($RecordDateCount);
$totalRows_RecordDateCount = mysqli_num_rows($RecordDateCount);

  if($totalRows_RecordDateCount == 0)
  {
	// 更新父節點為根節點
  	$updateSQL3 = sprintf("UPDATE demo_aboutitem SET endnode='child' WHERE item_id=%s",
                       GetSQLValueString($_GET['item_id'], "int"));

  	//mysqli_select_db($database_DB_Conn, $DB_Conn);
  	$Result3 = mysqli_query($DB_Conn, $updateSQL3) or die(mysqli_error($DB_Conn));
  }
}

$collang_RecordAboutListItem = "zh_TW";
if (isset($_GET['lang'])) {
  $collang_RecordAboutListItem = $_GET['lang'];
}
$coluserid_RecordAboutListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAboutListItem = $w_userid;
}
$colitemid_RecordAboutListItem = "-1";
if (isset($_GET['item_id'])) {
  $colitemid_RecordAboutListItem = $_GET['item_id'];
}
$collevel_RecordAboutListItem = "0";
if (isset($_GET['level'])) {
  $collevel_RecordAboutListItem = $_GET['level'];
}
$collistid_RecordAboutListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAboutListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutListItem = sprintf("SELECT * FROM demo_aboutitem WHERE list_id = %s && lang=%s && level = %s && subitem_id = %s && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collistid_RecordAboutListItem, "int"),GetSQLValueString($collang_RecordAboutListItem, "text"),GetSQLValueString($collevel_RecordAboutListItem, "int"),GetSQLValueString($colitemid_RecordAboutListItem, "int"),GetSQLValueString($coluserid_RecordAboutListItem, "int"));
$RecordAboutListItem = mysqli_query($DB_Conn, $query_RecordAboutListItem) or die(mysqli_error($DB_Conn));
$row_RecordAboutListItem = mysqli_fetch_assoc($RecordAboutListItem);
$totalRows_RecordAboutListItem = mysqli_num_rows($RecordAboutListItem);
?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>設定</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>


<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
      <?php require($page_view_path_vendor."require_panel_heading_back.php"); ?>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if ($totalRows_RecordAboutListItem > 0) { // Show if recordset not empty ?>
    <form id="form_AboutItemEdit" name="form_AboutItemEdit" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
    <?php do { ?>
    <div class="widget-card bg-cyan-transparent-1">
          <div class="card-body">
              <div class="row">
              <div class="col-md-3">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">名稱</span></div>
                            <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordAboutListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required=""/>

                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">排序</span></div>
                            <input name="sortid[]" type="number" id="sortid[]" value="<?php echo $row_RecordAboutListItem['sortid']; ?>" class=" form-control" maxlength="10" data-parsley-trigger="blur" required=""/>

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
                  <option <?php if (!(strcmp(1, $row_RecordAboutListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="1" >顯示</option>
                  <option <?php if (!(strcmp(0, $row_RecordAboutListItem['indicate']))) {echo "selected=\"selected\"";} ?> value="0" >隱藏</option>
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
                      <a class="btn btn-info w-100 btn-block" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $_GET['item_id']; ?>&amp;level=1&amp;list_id=<?php echo $_GET['list_id']; ?>" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i><?php require("require_manage_about_mulilistitem_count.php"); ?></a>
                      <?php } ?>
                      <?php if ($_GET['level'] == '1') { ?>
                      <a class="btn btn-info w-100 btn-block" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordAboutListItem['item_id']; ?>&amp;subitem_id=<?php echo $row_RecordAboutListItem['subitem_id']; ?>&amp;level=2&amp;list_id=<?php echo $_GET['list_id']; ?>" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i><?php require("require_manage_about_mulilistitem_count.php"); ?></a>
                      <?php } ?>
                      <?php if ($_GET['level'] == '2') { ?>
                      <!--<a class="btn btn-info w-100 btn-block" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $_GET['item_id']; ?>&amp;level=1&amp;list_id=<?php echo $_GET['list_id']; ?>" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i></a>-->
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
                              <input name="deltype[]" class="form-check-input" type="checkbox" id="deltype<?php echo $row_RecordAboutListItem['item_id']; ?>" value="<?php echo $row_RecordAboutListItem['item_id']; ?>" />
                             <!-- <input type="checkbox" id="cssCheckbox1" />-->
                              <label for="deltype<?php echo $row_RecordAboutListItem['item_id']; ?>">是否刪除</label>
                            </div>
                      </div>

                  <!--</div>-->
              </div>
              </div>
              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
                            <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordAboutListItem['item_id']; ?>" />
                            <input name="list_id[]" type="hidden" id="list_id[]" value="<?php echo $row_RecordAboutListItem['list_id']; ?>" />
                            <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordAboutListItem['lang']; ?>" />
                            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
                            <input name="level[]" type="hidden" id="level[]" value="<?php echo $_GET['level']; ?>" />
                          <input name="prePage" type="hidden" id="prePage" value="<?php echo $prePage; ?>" />
                      </div>

                  <!--</div>-->
              </div>
              </div>


              </div>



          </div>
      </div>
    <?php } while ($row_RecordAboutListItem = mysqli_fetch_assoc($RecordAboutListItem)); ?>
        <input type="hidden" name="MM_update" value="form_AboutItemEdit" />
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
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增次分類</h4>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body">
      <form id="form_AboutItemAdd" name="form_AboutItemAdd" method="POST" action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered" data-parsley-validate="">
      <div class="widget-card bg-cyan-transparent-1">
          <div class="card-body">
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



              <div class="col-md-2">
              <div class="form-group row">
                  <!--<div class="col-md-6" style="border:0">-->
                      <div class="input-group p-0">
                            <button type="submit" class="btn btn btn-primary w-100 btn-block">送出</button>
                            <input name="list_id" type="hidden" id="list_id" value="<?php echo $_GET['list_id']; ?>" />
                              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                              <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                              <input name="subitem_id" type="hidden" id="subitem_id" value="<?php echo $_GET['item_id']; ?>" />
                              <input name="level" type="hidden" id="level" value="<?php echo $_GET['level']; ?>" />
                              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                          <input name="prePage" type="hidden" id="prePage" value="<?php echo $prePage; ?>" />
                      </div>

                  <!--</div>-->
              </div>
              </div>




              </div>
      </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_AboutItemAdd" />
    </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordAboutListItem);
?>
