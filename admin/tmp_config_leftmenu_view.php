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

$colname_RecordTmpLeftMenu = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpLeftMenu = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE id = %s", GetSQLValueString($colname_RecordTmpLeftMenu, "int"));
$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);
$totalRows_RecordTmpLeftMenu = mysqli_num_rows($RecordTmpLeftMenu);
?>
<style type="text/css">
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 100px;
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
	width:100px;
}

.InnerPage{display:none;}
</style>
<?php //if ($row_RecordTmpLeftMenu['bgimage'] != "") { ?>
<div class="div_table-cell">
        <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpLeftMenu['userid'] == '1') { ?>
            <?php if ($row_RecordTmpLeftMenu['tmp_title_pic'] != '') { ?>
            <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_title_pic']; ?>" alt=""/>
            <?php } ?>
            <?php if ($row_RecordTmpLeftMenu['tmp_middle_o_pic'] != '') { ?>
            <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_o_pic']; ?>" style="display:block"/>
            <?php } else { ?>
            <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>" style="display:block"/>
            <?php } ?>
            <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>" alt=""/>
            <?php if ($row_RecordTmpLeftMenu['tmp_bottom_pic'] != '') { ?>
            <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_bottom_pic']; ?>" alt=""/>
            <?php } ?>
        <?php } else { ?>
			<?php if ($row_RecordTmpLeftMenu['tmp_title_pic'] != '') { ?>
            <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_title_pic']; ?>" alt=""/>
            <?php } ?>
            <?php if ($row_RecordTmpLeftMenu['tmp_middle_o_pic'] != '') { ?>
            <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_o_pic']; ?>" style="display:block"/>
            <?php } else { ?>
            <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>" style="display:block"/>
            <?php } ?>
            <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>" alt=""/>
            <?php if ($row_RecordTmpLeftMenu['tmp_bottom_pic'] != '') { ?>
            <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_bottom_pic']; ?>" alt=""/>
            <?php } ?>
        <?php } ?>
        </div>
<?php //} else { ?>
<!--<div class="bk_wrp">
<img src="images/no_bg.jpg" width="100" height="100"/> 
</div> -->
<?php //} ?> 
<?php
mysqli_free_result($RecordTmpLeftMenu);
?>
