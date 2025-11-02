
<?php $count =  $_GET['id']; ?>
<?php for($j=1;$j<=$count;$j++) { ?>
<?php 
	//$data[$j] = $j; 
	$data[$j] = $_GET['id'];
?>
<?php } ?>
<?php 
	echo json_encode($data);
?>

