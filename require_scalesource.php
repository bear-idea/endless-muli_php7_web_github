<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('require_member_get.php'); ?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/scalesource_view.php"); ?>
<?php } ?>