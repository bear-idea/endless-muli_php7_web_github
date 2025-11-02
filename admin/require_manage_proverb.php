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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProverb = "SELECT * FROM demo_proverb  order by rand() limit 1";
$RecordProverb = mysqli_query($DB_Conn, $query_RecordProverb) or die(mysqli_error($DB_Conn));
$row_RecordProverb = mysqli_fetch_assoc($RecordProverb);
$totalRows_RecordProverb = mysqli_num_rows($RecordProverb);
?>
<style type="text/css">
div#proverb{position:relative; overflow:hidden; height:25px; text-align:left;}
div#proverb ul, div#proverb li{list-style:none}
div#proverb ul{text-align:center; margin-top:0; margin-bottom:0; position:absolute; width:100%; margin-left:0; margin-right:0;}
div#proverb ul li a{display:block; overflow:hidden; height:25px; line-height:25px; text-decoration:none; color:#FFF}
div#proverb ul li a:hover{ font-weight: normal;}
</style>
<script type="text/javascript">
$(function(){function f(){var d=a.position().top/c,d=(j?d-1+b.length:d+1)%b.length;a.animate({top:d*c},h,function(){d==b.length-1?a.css("top",b.length/2*c-c):0==d&&a.css("top",b.length/2*c)});e=setTimeout(f,g)}var a=$("div#proverb ul"),b=a.append(a.html()).children(),c=-1*$("div#proverb").height(),h=600,e,g=3E3+h,j=0;a.css("top",b.length/2*c);b.hover(function(){clearTimeout(e)},function(){e=setTimeout(f,g)});e=setTimeout(f,g);$("a").focus(function(){this.blur()})});
</script>
<div id="proverb" class="hidden-xs">
		<ul>
			<li><a><i class="fa fa-tags"></i> <?php echo $row_RecordProverb['title']; ?> --- <i class="fa fa-user"></i> <?php echo $row_RecordProverb['source']; ?></a></li>
            <?php if ($row_RecordProverb['title_en'] != '') { ?>
			<li><a><i class="fa fa-tags"></i> <?php echo $row_RecordProverb['title_en']; ?> --- <i class="fa fa-user"></i> <?php echo $row_RecordProverb['source_en']; ?></a></li>
            <?php } ?>
		</ul>
</div>
<?php
mysqli_free_result($RecordProverb);
?>
