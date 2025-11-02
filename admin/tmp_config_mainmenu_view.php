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

$colname_RecordTmpMainMenu = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpMainMenu = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenu = sprintf("SELECT * FROM demo_tmpmainmenu WHERE id = %s", GetSQLValueString($colname_RecordTmpMainMenu, "int"));
$RecordTmpMainMenu = mysqli_query($DB_Conn, $query_RecordTmpMainMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenu = mysqli_fetch_assoc($RecordTmpMainMenu);
$totalRows_RecordTmpMainMenu = mysqli_num_rows($RecordTmpMainMenu);
?>
<link rel="stylesheet" href="css/ini.css" type="text/css" />
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBasePath; } else { echo $SiteBaseUrl . $SiteBasePath; } ?>css/css3menu.css" type="text/css" />
<style type="text/css">
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 250px;
	margin: 5px;
}

/* 圖片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	/*background-image:url(images/ap_p_u.jpg);*/
	border: 0px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}

.div_table-cell img{
	
}

.InnerPage{display:none;}
</style>
<?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpMainMenu['userid'] == '1') { ?>
<div class="div_table-cell">	
<div style="position:absolute; z-index:100; margin-top:1px; margin-left:1px;"><a href="#"  data-original-title="選單文字顏色" data-toggle="tooltip" data-placement="top"><span style="width:20px; height:20px; background-color:<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_color']; ?>;"><img src="images/s_word.png" width="20" height="20" /></span></a></div>
           <div style="position:absolute; z-index:100; margin-top:1px; margin-left:21px;"><a href="#"  data-original-title="選單文字顏色(滑鼠移入)" data-toggle="tooltip" data-placement="top"><span style="width:20px; height:20px; background-color:<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hovercolor']; ?>;"><img src="images/s_word.png" width="20" height="20" /></span></a></div>
          <ul id="navcss3" style="width:500px;">
			<span class="topmainmenu_l" style="display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_l_img']; ?>"/></span>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image<?php echo $i; ?>','','<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>',0)"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; id="Image<?php echo $i; ?>" /></a></li>
            <?php } else { ?>
           <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image<?php echo $i; ?>','','<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>',0)"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; id="Image<?php echo $i; ?>" /></a></li>
            <?php } else { ?>
           <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
  			<span class="topmainmenu_r" style="display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_r_img']; ?>"/></span>
        </ul>
      </div>
<?php } else { ?>
<div class="div_table-cell">	
<div style="position:absolute; z-index:100; margin-top:1px; margin-left:1px;"><a href="#"  data-original-title="選單文字顏色" data-toggle="tooltip" data-placement="top"><span style="width:20px; height:20px; background-color:<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_color']; ?>;"><img src="images/s_word.png" width="20" height="20" /></span></a></div>
           <div style="position:absolute; z-index:100; margin-top:1px; margin-left:21px;"><a href="#"  data-original-title="選單文字顏色(滑鼠移入)" data-toggle="tooltip" data-placement="top"><span style="width:20px; height:20px; background-color:<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hovercolor']; ?>;"><img src="images/s_word.png" width="20" height="20" /></span></a></div>
          <ul id="navcss3" style="width:500px;">
			<span class="topmainmenu_l" style="display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_l_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_l_img']; ?>"/></span>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image<?php echo $i; ?>','','<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>',0)"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; id="Image<?php echo $i; ?>" /></a></li>
            <?php } else { ?>
           <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
            <?php if($row_RecordTmpMainMenu['tmp_mainmenu_hover_img'] != "") { ?>
            <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image<?php echo $i; ?>','','<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_hover_img']; ?>',0)"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_img']; ?>" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; id="Image<?php echo $i; ?>" /></a></li>
            <?php } else { ?>
           <li style="line-height:<?php echo $row_RecordTmpMainMenu['tmp_mainmenupic_height']; ?>px;"><a href="#"><img src="images/block.png" width="<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_width']; ?>px"; /></a></li>
            <?php } ?>
  			<span class="topmainmenu_r" style="display:<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_r_img'] == '') {echo 'none'; } ?>"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenu['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenu['tmp_mainmenu_r_img']; ?>"/></span>
        </ul>
      </div>
<?php } ?>
<!--<div class="bk_wrp">
<img src="images/no_bg.jpg" width="100" height="100"/> 
</div> -->
<?php
mysqli_free_result($RecordTmpMainMenu);
?>
