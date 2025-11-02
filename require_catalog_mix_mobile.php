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

$currentPage = $_SERVER["PHP_SELF"];

$collang_RecordCatalogMix = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCatalogMix = $_SESSION['lang'];
}
$coluserid_RecordCatalogMix = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCatalogMix = $_SESSION['userid'];
}
$colproductid_RecordCatalogMix = "-1";
if (isset($_GET['id'])) {
  $colproductid_RecordCatalogMix = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogMix = sprintf("SELECT * FROM demo_catalog WHERE userid = %s && lang = %s && productmixid = %s ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordCatalogMix, "int"),GetSQLValueString($collang_RecordCatalogMix, "text"),GetSQLValueString($colproductid_RecordCatalogMix, "int"));
$RecordCatalogMix = mysqli_query($DB_Conn, $query_RecordCatalogMix) or die(mysqli_error($DB_Conn));
$row_RecordCatalogMix = mysqli_fetch_assoc($RecordCatalogMix);
$totalRows_RecordCatalogMix = mysqli_num_rows($RecordCatalogMix);

$queryString_RecordCatalogMix = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageMix") == false && 
        stristr($param, "totalRows_RecordCatalogMix") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordCatalogMix = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordCatalogMix = sprintf("&totalRows_RecordCatalogMix=%d%s", $totalRows_RecordCatalogMix, $queryString_RecordCatalogMix);
?> 
<?php if ($totalRows_RecordCatalogMix > 0) { // Show if recordset not empty ?>
<div class="recent-projects">
      <h4 class="title"><span><?php echo $Lang_Mix_Catalog; ?></span></h4>
      <div class="custom-carousel show-one-slide touch-carousel" data-appeared-items="2">
          <?php $i=0; ?>
          <?php do { ?>
          <!-- Start Project Item -->
          <div class="portfolio-item item">
              <div class="portfolio-border">
                  <!-- Start Project Thumb -->   
                  <div class="portfolio-thumb" style="float:left; margin:5px;">
                      
                  </div>
                  
                  <!-- End Project Thumb -->
                  <!-- Start Project Details -->
                  <div class="portfolio-details">
                      <a href="#">
                          <span><?php if ($row_RecordCatalogMix['auth'] == '0' || $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Dealer') { ?>
						 <?php if ($row_RecordCatalogMix['pic'] != "") { ?>
                         
                           <?php
                                    switch(GetFileExtend($row_RecordCatalogMix['pic']))
                                    {
                                        case ".pdf":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_01.png\" alt=\"ADOBE PDF\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";
                                            break;
                                        case ".xlsx":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_02.png\" alt=\"EXCEL\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".xls":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_02.png\" alt=\"EXCEL\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".doc":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_03.png\" alt=\"WORD\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".docx":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_03.png\" alt=\"WORD\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".rar":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_04.png\" alt=\"ZIP\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".zip":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_04.png\" alt=\"ZIP\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";	
                                            break;
                                        case ".avi":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_07.png\" alt=\"VIDEO\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";	
                                            break;
                                        case ".ppt":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_08.png\" alt=\"POWERPOINT\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".pptx":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_08.png\" alt=\"POWERPOINT\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".jpg":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_05.png\" alt=\"IMAGE\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".gif":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_05.png\" alt=\"IMAGE\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".png":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_05.png\" alt=\"IMAGE\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";			
                                            break;
                                        case ".bmp":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_05.png\" alt=\"IMAGE\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";
                                            break;
                                        case ".jpeg":
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\" title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_05.png\" alt=\"IMAGE\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";	
                                            break;	
                                        default:
                                            echo "<a href=\"download.php?wshop=" . $_GET['wshop'] . "&f=" . $row_RecordCatalogMix['pic']. "&ty=catalog" . "\"  title=\"" . $row_RecordCatalogMix['title'] . "\" rel=\"tipsy_n\"><img src=\"images/sicon/cat_06.png\" alt=\"UNKNOWN\"/>" . $row_RecordCatalogMix['title'] . "</a>\n";
                                            break;
                                    }
                                ?>
                           <?php } else { ?>
                           <?php if ($row_RecordCatalogMix['link'] != "") {?>
                           <a href="<?php echo $row_RecordCatalogMix['link'] ?>" title="<?php echo $row_RecordCatalogMix['title']; ?>" rel="tipsy_n" target="_blank"><img src="images/sicon/cat_link.png" width="35" height="35" /><?php echo $row_RecordCatalogMix['title']; ?></a>
                           <?php } else { ?>
                           <img src="images/sicon/cat_09.png" width="35" height="35" />
                           <?php } ?>
                           
                         <?php }  ?>
                         <?php } else { ?>
                           <a href="#" title="<?php echo $Lang_Classify_Context_Auth . "【" .$row_RecordCatalogMix['title'] . "】"; ?>" rel="tipsy_n"><img src="images/sicon/cat_lock.png" width="35" height="35" /><?php echo $Lang_Classify_Context_Auth . "【" .$row_RecordCatalogMix['title'] . "】"; ?></a>
                         <?php } ?></span>
                      </a>
				  </div>
                  <!-- End Project Details -->
              </div>
          </div>
          <!-- End Project Item -->	
		  <?php $i++; ?>  
          <?php } while ($row_RecordCatalogMix = mysqli_fetch_assoc($RecordCatalogMix)); ?>
      </div>
</div>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordCatalogMix);
?>