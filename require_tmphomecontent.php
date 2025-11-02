<?php require_once('Connections/DB_Conn.php'); ?>
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

$coluserid_RecordHomeContent = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordHomeContent = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordHomeContent = sprintf("SELECT homecontenttw, homecontentcn, homecontenten FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($coluserid_RecordHomeContent, "int"));
$RecordHomeContent = mysqli_query($DB_Conn, $query_RecordHomeContent) or die(mysqli_error($DB_Conn));
$row_RecordHomeContent = mysqli_fetch_assoc($RecordHomeContent);
$totalRows_RecordHomeContent = mysqli_num_rows($RecordHomeContent);
?>
<?php if ($_SESSION['lang'] == 'cn') { ?>
	<?php if ($row_RecordHomeContent['homecontentcn'] != '') { ?>
		<?php echo $row_RecordHomeContent['homecontentcn']; ?>
    <?php } else { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00" style="padding-top:150px;">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                  <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">您可登入後台之維護介面：  <strong style="color:#090;">版型修改  →  樣板  →  首頁版型設定  →  版型設定</strong> 來建立新資料</td>
          </tr>
        </table>
	<?php }  ?>
<?php } else if ($_SESSION['lang'] == 'en') { ?>
	<?php if ($row_RecordHomeContent['homecontenten'] != '') { ?>
		<?php echo $row_RecordHomeContent['homecontenten']; ?>
    <?php } else { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00" style="padding-top:150px;">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                  <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">您可登入後台之維護介面：  <strong style="color:#090;">版型修改  →  樣板  →  首頁版型設定  →  版型設定</strong> 來建立新資料</td>
          </tr>
        </table>
	<?php }  ?>
<?php } else { ?>
	<?php if ($row_RecordHomeContent['homecontenttw'] != '') { ?>
		<?php echo $row_RecordHomeContent['homecontenttw']; ?>
    <?php } else { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00" style="padding-top:150px;">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                  <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">您可登入後台之維護介面：  <strong style="color:#090;">版型修改  →  樣板  →  首頁版型設定  →  版型設定</strong> 來建立新資料</td>
          </tr>
        </table>
	<?php }  ?>
<?php } ?>
<?php
mysqli_free_result($RecordHomeContent);
?>
