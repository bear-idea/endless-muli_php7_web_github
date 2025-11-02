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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_DfPageItemAdd")) {
  $insertSQL = sprintf("INSERT INTO demo_dfpageitem (aid, itemname, subitem_id, lang, level) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['aid'], "int"),
                       GetSQLValueString(trim($_POST['itemname']), "text"),
					   GetSQLValueString($_POST['subitem_id'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['level'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  // 更新父節點 目前新增為子節點
  $updateSQL2 = sprintf("UPDATE demo_dfpageitem SET endnode='parent' WHERE item_id=%s",
                       GetSQLValueString($_GET['item_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result2 = mysqli_query($DB_Conn, $updateSQL2) or die(mysqli_error($DB_Conn));
}
/* 更新類別項目 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_DfPageItemEdit")) {
	foreach($_POST['item_id'] as $key => $val){
	  $updateSQL = sprintf("UPDATE demo_dfpageitem SET aid=%s, sortid=%s, indicate=%s, itemname=%s, lang=%s, level=%s WHERE item_id=%s",
						   GetSQLValueString($_POST['aid'][$key], "int"),
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
		  		$MM_dupKeyRedirect="manage_dfpage.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&aid=" . $_GET['aid'] . "&item_id=" . $_GET['item_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorP";
				break;
				case "2":
		  		$MM_dupKeyRedirect="manage_dfpage.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&aid=" . $_GET['aid'] . "&item_id=" . $_GET['item_id'] . "&subitem_id=" . $_GET['subitem_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorP";
				break;
				default:
				break;
		  }
		  switch($_GET['level'])
		  {
			  	case "1":
		  		$LoginRS__query = sprintf("SELECT * FROM demo_dfpage WHERE type2=%s", GetSQLValueString($loginUsername, "int")); // 分類
				break;
				case "2":
		  		$LoginRS__query = sprintf("SELECT * FROM demo_dfpage WHERE type3=%s", GetSQLValueString($loginUsername, "int")); // 分類
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
		  		$MM_dupKeyRedirect="manage_dfpage.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&aid=" . $_GET['aid'] . "&item_id=" . $_GET['item_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorT";
				break;
				case "2":
		  		$MM_dupKeyRedirect="manage_dfpage.php?wshop=" . $wshop . "&Opt=sub_mulilistitempage&lang=" . $_GET['lang'] . "&aid=" . $_GET['aid'] . "&item_id=" . $_GET['item_id'] . "&subitem_id=" . $_GET['subitem_id'] . "&level=" . $_GET['level'] . "&Operate=delErrorT";
				break;
				default:
				break;
		  }
		  $loginUsername = $_POST['deltype'][$key];
		  $LoginRS__query = sprintf("SELECT * FROM demo_dfpageitem WHERE subitem_id=%s", GetSQLValueString($loginUsername, "int")); // 分類
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
  $deleteSQL = sprintf("DELETE FROM demo_dfpageitem WHERE item_id in (%s)", implode(",", $_POST['deltype']));

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
$query_RecordDateCount = sprintf("SELECT * FROM demo_dfpageitem WHERE subitem_id = %s && userid=%s", GetSQLValueString($colname_RecordDateCount, "int"), GetSQLValueString($coluserid_RecordDateCount, "int"));
$RecordDateCount = mysqli_query($DB_Conn, $query_RecordDateCount) or die(mysqli_error($DB_Conn));
$row_RecordDateCount = mysqli_fetch_assoc($RecordDateCount);
$totalRows_RecordDateCount = mysqli_num_rows($RecordDateCount);

  if($totalRows_RecordDateCount == 0)
  {
	// 更新父節點為根節點
  	$updateSQL3 = sprintf("UPDATE demo_dfpageitem SET endnode='child' WHERE item_id=%s",
                       GetSQLValueString($_GET['item_id'], "int"));

  	//mysqli_select_db($database_DB_Conn, $DB_Conn);
  	$Result3 = mysqli_query($DB_Conn, $updateSQL3) or die(mysqli_error($DB_Conn));
  }
}

$collang_RecordDfPageListItem = "zh_TW";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageListItem = $_GET['lang'];
}
$coluserid_RecordDfPageListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfPageListItem = $w_userid;
}
$colitemid_RecordDfPageListItem = "-1";
if (isset($_GET['item_id'])) {
  $colitemid_RecordDfPageListItem = $_GET['item_id'];
}
$collevel_RecordDfPageListItem = "0";
if (isset($_GET['level'])) {
  $collevel_RecordDfPageListItem = $_GET['level'];
}
$collistid_RecordDfPageListItem = "-1";
if (isset($_GET['aid'])) {
  $collistid_RecordDfPageListItem = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageListItem = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang=%s && level = %s && subitem_id = %s && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collistid_RecordDfPageListItem, "int"),GetSQLValueString($collang_RecordDfPageListItem, "text"),GetSQLValueString($collevel_RecordDfPageListItem, "int"),GetSQLValueString($colitemid_RecordDfPageListItem, "int"),GetSQLValueString($coluserid_RecordDfPageListItem, "int"));
$RecordDfPageListItem = mysqli_query($DB_Conn, $query_RecordDfPageListItem) or die(mysqli_error($DB_Conn));
$row_RecordDfPageListItem = mysqli_fetch_assoc($RecordDfPageListItem);
$totalRows_RecordDfPageListItem = mysqli_num_rows($RecordDfPageListItem);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<div>
    <div>

      <?php
	  switch($_POST['Operate'])
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料修改成功！！','information');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料刪除成功！！','warning');});</script>\n";
			break;
		  default:
		  	   switch($_GET['Operate'])
			  {
				  case "delErrorT":
					//if($_POST['step'] == '2'){
					echo "<div class=\"ErrorTipMessage\">";
					echo "刪除失敗！！該項目下方尚有分類！！";
					echo "</div>\n";
					//}
					break;
				  case "delErrorP":
					//if($_POST['step'] == '2'){
					echo "<div class=\"ErrorTipMessage\">";
					echo "刪除失敗！！此分類尚有資料！！";
					echo "</div>\n";
					//}
					break;
				  default:
					break;
			  }
		  	break;
	  }
	  ?>


      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b"><span style="color:#CC6600">[<?php echo $row_RecordTpt['title'] ?>]</span> 次分類設定 - <?php echo $row_RecordDfPageListItem['listname']; ?> [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>



      <?php if ($ManageDfPageListSelect == '1') { ?>
      <?php if ($totalRows_RecordDfPageListItem > 0) { // Show if recordset not empty ?>
  <form id="form_DfPageItemEdit" name="form_DfPageItemEdit" method="POST" action="<?php echo $editFormAction; ?>">

      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
        <tr>
          <td width="100" align="right">編輯欄位：</td>
          <td width="300"><strong>分類</strong></td>
          <td width="80"><strong>排序</strong></td>
          <td width="250"><strong>狀態(公布:1/隱藏:0)</strong></td>
          <td><strong>操作</strong></td>
        </tr><?php $i = 1; ?>
        <?php do { ?>
          <tr>
            <td width="100" align="right">項目名稱：</td>
            <td width="300"><label for="sortid[]"></label>
              <input name="itemname[]" type="text" id="itemname[]" value="<?php echo $row_RecordDfPageListItem['itemname']; ?>" maxlength="30" /><span class = "InnerPage">&nbsp;&nbsp;&nbsp;
                <?php if ($_GET['level'] == '') { ?>
                <a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $_GET['item_id']; ?>&amp;level=1&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>" onfocus="undefined" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-folder-open-o"></i> 子分類</a>
                <?php } ?>
                <?php if ($_GET['level'] == '1') { ?>
                <a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordDfPageListItem['item_id']; ?>&amp;subitem_id=<?php echo $row_RecordDfPageListItem['subitem_id']; ?>&amp;level=2&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>" onfocus="undefined" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-folder-open-o"></i> 子分類</a>
                <?php } ?>
                <?php if ($_GET['level'] == '2') { ?>
                <!--<a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=sub_mulilistitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordDfPageListItem['item_id']; ?>&amp;level=3&amp;aid=<?php echo $_GET['aid']; ?>" onfocus="undefined" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="right"><i class="fa fa-folder-open-o"></i> 子分類</a>-->
                <?php } ?>
                </span>

            </td>
            <td width="80"><input name="sortid[]" type="text" id="sortid[]" value="<?php echo $row_RecordDfPageListItem['sortid']; ?>" size="10" maxlength="10" /></td>
            <td><span id="sprytextfield<?php echo $i; ?>">
              <input name="indicate[]" type="text" id="indicate[]" value="<?php echo $row_RecordDfPageListItem['indicate']; ?>" size="10" maxlength="1" />
              <span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldMinCharsMsg">值必須為0或1。</span><span class="textfieldMaxCharsMsg">值必須為0或1。</span><span class="textfieldMinValueMsg">值必須為0或1。</span><span class="textfieldMaxValueMsg">值必須為0或1。</span></span></td>
            <td>刪除：
              <input name="deltype[]" class="form-check-input" type="checkbox" id="deltype[]" value="<?php echo $row_RecordDfPageListItem['item_id']; ?>" />
              <label for="deltype[]">
                <input name="item_id[]" type="hidden" id="item_id[]" value="<?php echo $row_RecordDfPageListItem['item_id']; ?>" />
                <input name="aid[]" type="hidden" id="aid[]" value="<?php echo $row_RecordDfPageListItem['aid']; ?>" />
                <input name="lang[]" type="hidden" id="lang[]" value="<?php echo $row_RecordDfPageListItem['lang']; ?>" />
                <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
                <input name="level[]" type="hidden" id="level[]" value="<?php echo $_GET['level']; ?>" />
              </label>
              <input type="submit" name="button3" id="button3" value="送出修改資料" /></td>
          </tr><?php $i++; ?>
          <?php } while ($row_RecordDfPageListItem = mysqli_fetch_assoc($RecordDfPageListItem)); ?>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
    <input type="hidden" name="MM_update" value="form_DfPageItemEdit" />
  </form>
  <?php } // Show if recordset not empty ?>
  <form id="form_DfPageItemAdd" name="form_DfPageItemAdd" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="right">新增欄位：</td>
                  	<td></td>
                  </tr>

                <tr>
                      <td width="100" align="right">項目名稱：</td>
                      <td><span id="DfPageItem">
                        <label for="itemname"></label>
                      <input name="itemname" type="text" id="itemname" maxlength="30" />
                      <span class="textfieldRequiredMsg">欄位不可為空。</span></span>
                      <input type="submit" name="button" id="button" value="送出新增資料" />
                      <input type="reset" name="button2" id="button2" value="重置新增資料" />
                  <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
                  <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                  <input name="Operate" type="hidden" id="Operate" value="addSuccess" />
                  <input name="subitem_id" type="hidden" id="subitem_id" value="<?php echo $_GET['item_id']; ?>" />
                  <input name="level" type="hidden" id="level" value="<?php echo $_GET['level']; ?>" />
                  <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" /></td>
        </tr>

				  <tr>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form_DfPageItemAdd" />
      </form>
      <?php } else {?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font color="#FF0000">您未擁有編輯此區塊的權限！！</font></td>
        </tr>
      </table>
      <?php } ?>


  </div>
</div>

<script type="text/javascript">
var sprytextfield0 = new Spry.Widget.ValidationTextField("DfPageItem", "none", {validateOn:["blur"]});
<?php for($i=1; $i <= $totalRows_RecordDfPageListItem; $i++) { ?>
var sprytextfield<?php echo $i; ?> = new Spry.Widget.ValidationTextField("sprytextfield<?php echo $i; ?>", "integer", {validateOn:["blur"], isRequired:false, minChars:1, maxChars:1, minValue:0, maxValue:1});
<?php } ?>
</script>
<?php
mysqli_free_result($RecordDfPageListItem);

//mysqli_free_result($RecordDateCount);
?>
