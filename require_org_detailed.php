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

$colname_RecordOrg = "-1";
if (isset($_GET['id'])) {
  $colname_RecordOrg = $_GET['id'];
}
$coluserid_RecordOrg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordOrg = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOrg = sprintf("SELECT * FROM demo_org WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordOrg, "int"),GetSQLValueString($coluserid_RecordOrg, "int"));
$RecordOrg = mysqli_query($DB_Conn, $query_RecordOrg) or die(mysqli_error($DB_Conn));
$row_RecordOrg = mysqli_fetch_assoc($RecordOrg);
$totalRows_RecordOrg = mysqli_num_rows($RecordOrg);
?>
<?php if ($MSTMP == 'default') { ?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Org; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                     <!-- **************************************************************** -->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td width="50%"><!-- **************************************************************** -->
                           <strong><?php echo $row_RecordOrg['title']; ?></strong>
                           <!-- **************************************************************** --></td>
                         <td width="50%" align="right">&laquo; <a href="javascript:history.back()"><?php echo $Lang_BackPage ?></a></td>
                       </tr>
                     </table>
                     <?php if ($MSOrgGood == '1') { ?>
                     <script language="javascript">
var $url = '<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
$url = $url.replace(/&amp;/gi, '&');
$url = encodeURIComponent($url);

document.write('<iframe  src="http://www.facebook.com/plugins/like.php?href=' + $url + '" scrolling="no"  frameborder="0" style="height: 25px; width: 100%"  allowTransparency="true"></iframe>');
                     </script>
                     <?php } ?>
                     <!-- **************************************************************** -->
                    
						<?php echo pageBreak($row_RecordOrg['content']); ?>
                        <?php require("require_sharelink.php"); ?>
                        <hr>
     <?php if ($MSOrgQA == '1') { ?>
     <div class="columns on-1">
        <div class="container board">
            <div class="column">
			  <script>
                $(function() {
                    $( "#tabs" ).tabs({
                        //event: "mouseover"
							error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			
                    });
                });
                </script>
                <!--Tab-->
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Facebook回應</a></li>
                        <li><a href="require_orgpost.php?id=<?php echo $row_RecordOrg['id']; ?>">問答紀錄</a></li>
                    </ul>
                    <div id="tabs-1">
                    	<div class="container left_ct_board">
                        	<div id="fb-root"></div>
							<script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) {return;}
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>

							<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-num-posts="2" data-width="500"></div>
                        </div> 
                    </div>
                </div>  
                <!--Tab-->             
            </div>
        </div>
  </div> 
  <?php } ?>                      
                        
                          
                           
                            <!-- **************************************************************** -->

                </div>
            </div>
        </div>        
</div>
<?php } else { ?>
	<?php if ($row_RecordOrg['title'] != '') { // 當id無資料時跳回?>
        <?php include($TplPath . "/org_detailed.php"); ?>
    <?php } else { ?>
        <?php 
		 	$originUrl = "org.php?wshop=" . $_GET['wshop'] . "&Opt=viewpage&tp=Org&lang=" . $_SESSION['lang']; // 上一頁的網址
    		echo("<script language='javascript'>location.href='".$originUrl."'</script>");
		?>
    <?php } ?>
<?php } ?>
<?php
mysqli_free_result($RecordOrg);
?>
