<?php
date_default_timezone_set('Asia/Taipei');
$date = '2040-02-01';
$format = 'Y-m-d H:i:s';
$mydate1 = strtotime($date);
echo date($format, $mydate1); // Wednesday 01 February 2040 00:00 就是正確結果
?>
<?php
$date = '2040-02-01';
$format = 'l j F Y H:i';
$mydate2 = new DateTime($date);
echo $mydate2->format($format); // Wednesday 01 February 2040 00:00 就是正確結果

$date = '2040-02-01';
//$format = 'Y-m-d';
$mydate2 = new DateTime($date);
echo $mydate2->format("Y-m-d"); // Wednesday 01 February 2040 00:00 就是正確結果


//echo date("Y-m-d", strtotime($row_RecordNews['postdate']));

//$mydate2 = new DateTime($row_RecordNews['postdate']);
//echo $mydate2->format("Y-m-d"); // Wednesday 01 February 2040 00:00 就是正確結果

//$mydate2->format("Y-m-d");
//echo new DateTime($date)->format("Y-m-d");

//echo (new DateTime)->getTimestamp();
?>