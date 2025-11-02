<?
// top page onload
$time_start = microtime_float();

require_once('Connections/DB_Conn.php'); 

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


    //計時函式
function runtime($mode=0) {
    static $t;
    if(!$mode) {
     $t = microtime();
     return;
    }
    $t1 = microtime();
    list($m0,$s0) = explode(" ",$t);
    list($m1,$s1) = explode(" ",$t1);
    return sprintf("%.3f ms",($s1+$m1-$s0-$m0)*1000);
   }


   runtime();


// 指定單一網站
$_GET['wshop'] = 'playweb';
// 是否為shop3500
$web_only_exclusive = "1";

$colname_RecordAccount = "-1";
if (isset($_GET['wshop'])) {
  $colname_RecordAccount = $_GET['wshop'];
}

$query_RecordAccount = sprintf("SELECT * FROM demo_admin WHERE webname = %s", GetSQLValueString($colname_RecordAccount, "text"));
$RecordAccount = mysqli_query($DB_Conn, $query_RecordAccount) or die(mysqli_error($DB_Conn));
$row_RecordAccount = mysqli_fetch_assoc($RecordAccount);
$totalRows_RecordAccount = mysqli_num_rows($RecordAccount);


//計時結束.
echo runtime(1);

function memory_usage() 
{
	$memory	 = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB';
	return $memory;
}

function microtime_float() 
{
	$mtime = microtime();
	$mtime = explode(' ', $mtime);
	return $mtime[1] + $mtime[0];
}

function formatsize($size) 
{
	$danwei=array(' B ',' K ',' M ',' G ',' T ');
	$allsize=array();
	$i=0;

	for($i = 0; $i <5; $i++) 
	{
		if(floor($size/pow(1024,$i))==0){break;}
	}

	for($l = $i-1; $l >=0; $l--) 
	{
		$allsize1[$l]=floor($size/pow(1024,$l));
		$allsize[$l]=$allsize1[$l]-$allsize1[$l+1]*1024;
	}

	$len=count($allsize);

	for($j = $len-1; $j >=0; $j--) 
	{
		$fsize=$fsize.$allsize[$j].$danwei[$j];
	}	
	return $fsize;
}
// print
?>

<br>
<? $run_time = sprintf('%0.4f', microtime_float() - $time_start);?>Processed in <?php echo $run_time?> seconds. 
<?php echo memory_usage();?> memory usage.