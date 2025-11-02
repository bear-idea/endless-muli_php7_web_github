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

$maxRows_RecordNewsListRandom = 5;
$pageListRandom = 0;
if (isset($_GET['pageListRandom'])) {
  $pageListRandom = $_GET['pageListRandom'];
}
$startRow_RecordNewsListRandom = $pageListRandom * $maxRows_RecordNewsListRandom;

$collang_RecordNewsListRandom = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsListRandom = $_GET['lang'];
}
$coluserid_RecordNewsListRandom = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsListRandom = $_SESSION['userid'];
}
$colid_RecordNewsListRandom = "-1";
if (isset($_GET['id'])) {
  $colid_RecordNewsListRandom = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsListRandom = sprintf("SELECT * FROM demo_news WHERE lang = %s && id != %s && userid=%s ORDER BY rand()", GetSQLValueString($collang_RecordNewsListRandom, "text"),GetSQLValueString($colid_RecordNewsListRandom, "int"),GetSQLValueString($coluserid_RecordNewsListRandom, "int"));
$query_limit_RecordNewsListRandom = sprintf("%s LIMIT %d, %d", $query_RecordNewsListRandom, $startRow_RecordNewsListRandom, $maxRows_RecordNewsListRandom);
$RecordNewsListRandom = mysqli_query($DB_Conn, $query_limit_RecordNewsListRandom) or die(mysqli_error($DB_Conn));
$row_RecordNewsListRandom = mysqli_fetch_assoc($RecordNewsListRandom);

if (isset($_GET['totalRows_RecordNewsListRandom'])) {
  $totalRows_RecordNewsListRandom = $_GET['totalRows_RecordNewsListRandom'];
} else {
  $all_RecordNewsListRandom = mysqli_query($DB_Conn, $query_RecordNewsListRandom);
  $totalRows_RecordNewsListRandom = mysqli_num_rows($all_RecordNewsListRandom);
}
$totalPages_RecordNewsListRandom = ceil($totalRows_RecordNewsListRandom/$maxRows_RecordNewsListRandom)-1;
  
?>
<style>
.wrp_list{
	height: 170px;
	overflow-y:hidden;
	padding: 5px;
}
.wrp_list:hover{
	background-color: #E6E8FB;
}
.wrp_list_img{
	margin-right: auto;
	margin-left: auto;
	width: 100px;
	height: 100px;
	overflow-y:hidden;
	text-align: center;
	padding: 2px;
	border: 1px solid #CCC;
	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
	background-color: #FFF;
}
.wrp_list_txt{
	padding: 5px;
}
.wrp_list_img img{
	max-width: 100px;
	margin-right: auto;
	margin-left: auto;
}
/* IE6 hack */
.wrp_list_img span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.wrp_list_img *{ vertical-align:middle;}
</style>
<?php
function getlistrandomimage($text)
{
//取得第一個img標籤，並儲存至陣列match（regex語法與上述同義）  
	preg_match('/<img[^>]*>/Ui', $text, $match);  
//印出match  
	if($match[0] != ''){
		echo $match[0]; 
	}else{
		echo"<img src=\"images/100x100.jpg\" width=\"100\" height=\"100\"/>"
 ."";
	}
}
?>
<br />
<strong><?php echo $Lang_Random_Article //隨機文章 ?></strong>
<div class="columns on-5">
          <div class="container board">        
		    <?php do { ?>
            <div class="column">
              <div class="container ct_board">
              <div class="wrp_list">
              <a href="news.php?wshop=<?php echo $_GET['wshop']; ?>&Opt=detailed&tp=<?php echo $_GET['tp']; ?>&lang=<?php echo $_SESSION['lang']; ?>&id=<?php echo $row_RecordNewsListRandom['id']; ?>">
              
              	<div class="wrp_list_img"> 
                  <?php getlistrandomimage($row_RecordNewsListRandom['content']);?><span></span>
              </div>
                <div class="wrp_list_txt"><?php echo $row_RecordNewsListRandom['title']; ?></div>
              </a>
              </div>
              </div>
            </div>
            <?php } while ($row_RecordNewsListRandom = mysqli_fetch_assoc($RecordNewsListRandom)); ?>
          </div>
</div>
<?php 
mysqli_free_result($RecordNewsListRandom);
?>
