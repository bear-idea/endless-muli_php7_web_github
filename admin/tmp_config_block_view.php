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

$colname_RecordTmpBlock = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBlock = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBlock = sprintf("SELECT * FROM demo_tmpblock WHERE id = %s", GetSQLValueString($colname_RecordTmpBlock, "int"));
$RecordTmpBlock = mysqli_query($DB_Conn, $query_RecordTmpBlock) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlock = mysqli_fetch_assoc($RecordTmpBlock);
$totalRows_RecordTmpBlock = mysqli_num_rows($RecordTmpBlock);
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
}
</style>
<?php if ($totalRows_RecordTmpBlock > 0) { ?>
	<?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpBlock['userid'] == '1') { ?>
    <div class="div_table-cell">	
        <div style="border: <?php echo $row_RecordTmpBlock['tmp_block_width']; ?>px <?php echo $row_RecordTmpBlock['tmp_block_style']; ?> <?php echo $row_RecordTmpBlock['tmp_block_color']; ?>; background-color:<?php echo $row_RecordTmpBlock['tmp_block_background_color']; ?>;">
            <div style="color:<?php echo $row_RecordTmpBlock['tmp_a_font_color']; ?>;line-height: <?php echo $row_RecordTmpBlock['tmp_b_t_hight']; ?>px;text-align: left;padding-left: <?php echo $row_RecordTmpBlock['tmp_b_t_left']; ?>;background-image: url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_title_pic']; ?>);background-repeat: <?php echo $row_RecordTmpBlock['tmp_b_t_repet']; ?>;background-position: left top;">&nbsp;</div>
            <div style="background-image: url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_middle_pic']; ?>);background-repeat: <?php echo $row_RecordTmpBlock['tmp_b_m_repet']; ?>;background-position: left top;">&nbsp;</div>
            <div style="background-image: url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_bottom_pic']; ?>); background-repeat:no-repeat; background-position:left top">&nbsp;</div>
        </div>
    </div>
    <?php } else { ?>
    <div class="div_table-cell">	
        <div style="border: <?php echo $row_RecordTmpBlock['tmp_block_width']; ?>px <?php echo $row_RecordTmpBlock['tmp_block_style']; ?> <?php echo $row_RecordTmpBlock['tmp_block_color']; ?>; background-color:<?php echo $row_RecordTmpBlock['tmp_block_background_color']; ?>;">
            <div style="color:<?php echo $row_RecordTmpBlock['tmp_a_font_color']; ?>;line-height: <?php echo $row_RecordTmpBlock['tmp_b_t_hight']; ?>px;text-align: left;padding-left: <?php echo $row_RecordTmpBlock['tmp_b_t_left']; ?>;background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_title_pic']; ?>);background-repeat: <?php echo $row_RecordTmpBlock['tmp_b_t_repet']; ?>;background-position: left top;">&nbsp;</div>
            <div style="background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_middle_pic']; ?>);background-repeat: <?php echo $row_RecordTmpBlock['tmp_b_m_repet']; ?>;background-position: left top;">&nbsp;</div>
            <div style="background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_bottom_pic']; ?>); background-repeat:no-repeat; background-position:left top">&nbsp;</div>
        </div>
    </div>
    <?php } ?>
<?php } else { ?>
<div class="bk_wrp">
<img src="images/no_bg.jpg" width="100" height="100"/> 
</div>
<?php } ?> 
<?php
mysqli_free_result($RecordTmpBlock);
?>
