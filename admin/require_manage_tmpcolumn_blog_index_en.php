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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $_GET['userid'] == $w_userid) {
  $deleteSQL = sprintf("DELETE FROM demo_tmpblogcolumn WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));
  if($_GET['type'] == 'frilink' || $_GET['type'] == 'articlelist' || $_GET['type'] == 'fbfan' || $_GET['type'] == 'alllist' || $_GET['type'] == 'newslist' || $_GET['type'] == 'blogplist' || $_GET['type'] == 'blogcalendar' || $_GET['type'] == 'bloglist' || $_GET['type'] == 'blogrlist' || $_GET['type'] == 'blogviewcount' || $_GET['type'] == 'blogwhoscount')
  {
	  // 鎖定
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=0 WHERE userid=%s",
	                       GetSQLValueString($_GET['type'] . "Lock_en", "none"),
						   GetSQLValueString($_GET['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $deleteGoTo = "manage_tmp.php?wshop=" . $wshop . "&Opt=tmpblogcolumn&lang=" . $_SESSION['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $deleteGoTo));
  ob_end_flush(); // 輸出緩衝區結束
  exit;
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "TmpColumnFree")) {
  $insertSQL = sprintf("INSERT INTO demo_tmpblogcolumn (type, style, dftname, customname, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['type'], "text"),
					   GetSQLValueString($_POST['style'], "text"),
					   GetSQLValueString($_POST['dftname'], "text"),
					   GetSQLValueString($_POST['dftname'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));
					   
  if($_POST['type'] == 'productlist' || $_POST['type'] == 'frilink' || $_POST['type'] == 'articlelist' || $_POST['type'] == 'fbfan' || $_POST['type'] == 'alllist' || $_POST['type'] == 'newslist' || $_POST['type'] == 'blogplist' || $_POST['type'] == 'blogcalendar' || $_POST['type'] == 'bloglist' || $_POST['type'] == 'blogrlist' || $_POST['type'] == 'blogviewcount' || $_POST['type'] == 'blogwhoscount')
  {
	  // 鎖定
	  $_POST['type'];
	  $updateSQLLock = sprintf("UPDATE demo_setting_fr SET %s=1 WHERE userid=%s",
	  					   GetSQLValueString($_POST['type'] . "Lock_en", "none"),
						   GetSQLValueString($_POST['userid'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultLock = mysqli_query($DB_Conn, $updateSQLLock) or die(mysqli_error($DB_Conn));
  }

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordTmpColumn = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpColumn = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpColumn = sprintf("SELECT * FROM demo_tmpblogcolumn WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpColumn, "int"));
$RecordTmpColumn = mysqli_query($DB_Conn, $query_RecordTmpColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn);
$totalRows_RecordTmpColumn = mysqli_num_rows($RecordTmpColumn);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpAddColumn = "SELECT * FROM demo_tmpaddcolumn WHERE class != 'site'";
$RecordTmpAddColumn = mysqli_query($DB_Conn, $query_RecordTmpAddColumn) or die(mysqli_error($DB_Conn));
$row_RecordTmpAddColumn = mysqli_fetch_assoc($RecordTmpAddColumn);
$totalRows_RecordTmpAddColumn = mysqli_num_rows($RecordTmpAddColumn);

$coluserid_RecordSettingLock = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingLock = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingLock = sprintf("SELECT productlistLock_en, frilinkLock_en, fbfanLock_en, articlelistLock_en, alllistLock_en, newslistLock_en, blogplistLock_en, blogcalendarLock_en, blogrlistLock_en, bloglistLock_en, blogviewcountLock_en, blogwhoscountLock_en FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($coluserid_RecordSettingLock, "int"));
$RecordSettingLock = mysqli_query($DB_Conn, $query_RecordSettingLock) or die(mysqli_error($DB_Conn));
$row_RecordSettingLock = mysqli_fetch_assoc($RecordSettingLock);
$totalRows_RecordSettingLock = mysqli_num_rows($RecordSettingLock);
?>


<style type="text/css">
.TB_General_style01 tr td{
	border: solid 1px #CCCCCC;
}
</style>

<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">BLOG 欄位設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><form id="form_TmpColumnList" name="form_TmpColumnList" method="post" action="">    
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td width="100" align="center"><strong>欄位型態</strong></td>
                  	<td align="center"><strong>自訂欄位標題</strong></td>
                  	<td width="100" align="center"><strong>排序</strong></td>
                  	<td width="90" align="center"><strong>操作</strong></td>
               	  </tr>
				  <?php do { ?>
                   <tr>
                     <?php if ($totalRows_RecordTmpColumn > 0) { // Show if recordset not empty ?>
  <td width="100" align="right"><?php echo $row_RecordTmpColumn['dftname']; ?></td>
                     <td><span class="ed_customname" id="customname_<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['customname']; ?></span></td>
                     <td align="center"><span class="sortid" id="sortid_<?php echo $row_RecordTmpColumn['id']; ?>"><?php echo $row_RecordTmpColumn['sortid']; ?></span></td>
                     <td><?php if ($row_RecordTmpColumn['style'] == 'free') { ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpblogcolumn_setting_free&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else if($row_RecordTmpColumn['style'] == 'menu') { ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpblogcolumn_setting_menu&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else { ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpblogcolumn_setting&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } ?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpblogcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id_del=<?php echo $row_RecordTmpColumn['id']; ?>&amp;userid=<?php echo $row_RecordTmpColumn['userid']; ?>&amp;type=<?php echo $row_RecordTmpColumn['type']; ?>"><img src="images/del.gif" width="45" height="18" /></a></td>
                       <?php } // Show if recordset not empty ?>
                   </tr>
				   <?php } while ($row_RecordTmpColumn = mysqli_fetch_assoc($RecordTmpColumn)); ?>
              </table>
      </form></td>
        <td width="50%" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-left:10px; margin-right:10px;border:solid 1px #CCCCCC;" class="TB_General_style01">
          <tr>
            <td colspan="2" align="center"><strong>可新增欄位</strong></td>
          </tr>
		  <?php do { ?>
          <?php if (
		  ($row_RecordTmpAddColumn['type'] == 'blogwhoscount' && ($row_RecordSettingLock['blogwhoscountLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'blogviewcount' && ($row_RecordSettingLock['blogviewcountLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'blogrlist' && ($row_RecordSettingLock['blogrlistLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'bloglist' && ($row_RecordSettingLock['bloglistLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'blogcalendar' && ($row_RecordSettingLock['blogcalendarLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'blogplist' && ($row_RecordSettingLock['blogplistLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'frilink' && ($row_RecordSettingLock['frilinkLock_en'] == '1' OR $OptionFrilinkSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'productlist' && ($row_RecordSettingLock['productlistLock_en'] == '1' OR $OptionProductSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'articlelist' && ($row_RecordSettingLock['articlelistLock_en'] == '1' OR $OptionArticleSelect == '0')) || 
		  ($row_RecordTmpAddColumn['type'] == 'fbfan' && ($row_RecordSettingLock['fbfanLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'alllist' && ($row_RecordSettingLock['alllistLock_en'] == '1')) || 
		  ($row_RecordTmpAddColumn['type'] == 'newslist' && ($row_RecordSettingLock['newslistLock_en'] == '1' OR $OptionNewsSelect == '0'))
		  ) { ?>
          <?php } else { ?>
          <form name="TmpColumn" action="<?php echo $editFormAction; ?>" method="POST" id="TmpColumn<?php echo $row_RecordTmpAddColumn['type']; ?>">
          <tr>  
              <td align="center" valign="middle"><?php echo $row_RecordTmpAddColumn['dftname']; ?><br />
                <span style=" color:#090;"><?php echo $row_RecordTmpAddColumn['desc']; ?></span>
                <input name="type" type="hidden" id="type" value="<?php echo $row_RecordTmpAddColumn['type']; ?>" />
                <input name="dftname" type="hidden" id="dftname" value="<?php echo $row_RecordTmpAddColumn['dftname']; ?>" />
                <input name="id" type="hidden" id="id" value="<?php echo $row_RecordTmpAddColumn['id']; ?>" />
                <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
                <input name="style" type="hidden" id="style" value="<?php echo $row_RecordTmpAddColumn['style']; ?>" /></td>
              <td width="50" align="center" valign="middle"><input type="submit" name="button" id="button" value="新增" /></td>
              
          </tr>
          <input type="hidden" name="MM_insert" value="TmpColumnFree" />
          </form>
          <?php } ?>
		  <?php } while ($row_RecordTmpAddColumn = mysqli_fetch_assoc($RecordTmpAddColumn)); ?>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
          </tr>
        </table>
          
        
        </td>
      </tr>
    </table>
    
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".sortid").editable("sqledit/tmpblogcolumn_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".ed_customname").editable("sqledit/tmpblogcolumn_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "250px"
	});
});
</script>
<?php
mysqli_free_result($RecordTmpColumn);

mysqli_free_result($RecordTmpAddColumn);

mysqli_free_result($RecordSettingLock);
?>
