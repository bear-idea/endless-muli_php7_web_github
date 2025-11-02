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

$collang_RecordProjectMix = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProjectMix = $_SESSION['lang'];
}
$coluserid_RecordProjectMix = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProjectMix = $_SESSION['userid'];
}
$colproductid_RecordProjectMix = "-1";
if (isset($_GET['id'])) {
  $colproductid_RecordProjectMix = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectMix = sprintf("SELECT * FROM demo_projectalbumphoto WHERE userid = %s && lang = %s && productmixid = %s ORDER BY sortid ASC, actphoto_id DESC", GetSQLValueString($coluserid_RecordProjectMix, "int"),GetSQLValueString($collang_RecordProjectMix, "text"),GetSQLValueString($colproductid_RecordProjectMix, "int"));
$RecordProjectMix = mysqli_query($DB_Conn, $query_RecordProjectMix) or die(mysqli_error($DB_Conn));
$row_RecordProjectMix = mysqli_fetch_assoc($RecordProjectMix);
$totalRows_RecordProjectMix = mysqli_num_rows($RecordProjectMix);

$queryString_RecordProjectMix = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordProjectMix") == false && 
        stristr($param, "totalRows_RecordProjectMix") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProjectMix = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProjectMix = sprintf("&totalRows_RecordProjectMix=%d%s", $totalRows_RecordProjectMix, $queryString_RecordProjectMix);
?> 
<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
<script type="text/javascript" src="js/jquery.alsEN-1.0.min.js" ></script>
<style type="text/css">
/* 外框 */
.div_table-cell-project-mix{
	overflow:hidden;
	height: 80px; /* 設定區塊高度 */
	width: 80px;
}

/* 圖片hide外框 */
.div_table-cell-project-mix{
	text-align: center;
	vertical-align: middle;
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
	display: inline-block;
}


/* IE6 hack */
.div_table-cell-project-mix span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_table-cell-project-mix *{ vertical-align:middle;}
/* Circular Content Carousel Style */
.ca-container{
	position:relative;
	margin:3px auto 3px auto;
	width:240px;;
	height:80px;
}
.ca-wrapper{
	width:100%;
	height:100%;
	position:relative;
}
.ca-item{
	position:relative;
	float:left;
	width:80px;
	height:100%;
	text-align:center;
}
.ca-more{
	position: absolute;
	bottom: 10px;
	right:0px;
	padding:4px 15px;
	font-weight:bold;
	background: #ccbda2;
	text-align:center;
	color: white;
	font-family: "Georgia","Times New Roman",serif;
	font-style:italic;
	text-shadow:1px 1px 1px #897c63;
}
.ca-close{
	position:absolute;
	top:10px;
	right:10px;
	background:#fff url(images/cross.png) no-repeat center center;
	width:27px;
	height:27px;
	text-indent:-9000px;
	outline:none;
	-moz-box-shadow:1px 1px 2px rgba(0,0,0,0.2);
	-webkit-box-shadow:1px 1px 2px rgba(0,0,0,0.2);
	box-shadow:1px 1px 2px rgba(0,0,0,0.2);
	opacity:0.7;
}
.ca-close:hover{
	opacity:1.0;
}
.ca-item-main{
	padding:0px;
	position:absolute;
	top:5px;
	left:5px;
	right:5px;
	bottom:5px;
	background:#fff;
	overflow:hidden;
	-moz-box-shadow:1px 1px 2px rgba(0,0,0,0.2);
	-webkit-box-shadow:1px 1px 2px rgba(0,0,0,0.2);
	box-shadow:1px 1px 2px rgba(0,0,0,0.2);
}
.ca-icon{
	width:233px;
	height:189px;
	position:relative;
	margin:0 auto;
	background:transparent url(images/animal1.png) no-repeat center center;
}

.ca-content-wrapper{
	background:#b0ccc6;
	position:absolute;
	width:0px; /* expands to width of the wrapper minus 1 element */
	height:440px;
	top:5px;
	text-align:left;
	z-index:10000;
	overflow:hidden;
}
.ca-content{
	width:660px;
	overflow:hidden;
}

.ca-nav span{
	width:25px;
	height:38px;
	background:transparent url(images/arrows.png) no-repeat top left;
	position:absolute;
	top:50%;
	margin-top:-19px;
	left:-30px;
	text-indent:-9000px;
	opacity:0.7;
	cursor:pointer;
	z-index:100;
}
.ca-nav span.ca-nav-next{
	background-position:top right;
	left:auto;
	right:-30px;
}
.ca-nav span:hover{
	opacity:1.0;
}
</style>
<?php if ($totalRows_RecordProjectMix > 0) { // Show if recordset not empty ?>
<div class="recent-projects">
    <h4 class="title"><span><?php echo $ModuleName['Project']; ?></span></h4>
    <div class="custom-carousel show-one-slide touch-carousel" data-appeared-items="3">
        <?php $i=0; ?>
                    <?php do { ?>
                    <?php if(is_file($SiteImgUrl.$_GET['wshop']."/image/project/". $row_RecordProjectMix['pic'])) {  ?>
        <!-- Start Project Item -->
        <div class="portfolio-item item">
            <div class="portfolio-border">
                <!-- Start Project Thumb -->
                <div class="portfolio-thumb">
                    <a class="lightbox" title="<?php echo $row_RecordProjectMix['name']; ?>" href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/project/<?php echo $row_RecordProjectMix['pic']; ?>">
                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                        <img alt="" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/project/<?php echo $row_RecordProjectMix['pic']; ?>" />
                    </a>
                </div>
                <!-- End Project Thumb -->
                
                <!-- End Project Details -->
            </div>
        </div>
        <!-- End Project Item -->
        <?php $i++; ?>  
                    <?php } ?> 
                    <?php } while ($row_RecordProjectMix = mysqli_fetch_assoc($RecordProjectMix)); ?>
    </div>
</div>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordProjectMix);
?>