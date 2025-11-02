<?php

$requestPattern = '目前 Menu：'.$row_RecordMenuModule['title'].' / '.$row_RecordMenuModule['subtitle'] . '</br></br>';

$requestPattern .= '$request->input(\'module_uri\')：'.$request->input('module_uri') . '</br></br>';

$requestPattern .= 'Request 參數<br>';
foreach ($request->all() as $key => $value) {
    $requestPattern .= "$key => $value<br>";
}

$requestPattern .= '<br>RoutesUri：'.$row_RecordMenuModule['routes']['uri'] . '</br>';
$requestPattern .= 'Controller：'.$row_RecordMenuModule['routes']['controller_name'].'@'.$row_RecordMenuModule['routes']['controller_action'] . '</br>';

addNotification(renderNotificationTitle('fa fa-bell', 'bg-success', 'DEBUG'), $requestPattern, true, 0, 'gritter-success');

