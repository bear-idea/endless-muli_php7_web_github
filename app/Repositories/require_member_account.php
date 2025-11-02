<?php
namespace App\Repositories;
use App\Eloquent\Member;

$collang[$Tp_Page] = "zh-tw";
if (isset($_GET['lang'])) {
    $collang[$Tp_Page] = $_GET['lang'];
}

$coluserid[$Tp_Page] = "-1";
if (isset($_SESSION['userid'])) {
    $coluserid[$Tp_Page] = $_SESSION['userid'];
}

$colname_RecordMember = "-1";
$account = "account";
if (isset($_SESSION['MM_Username_' . $_GET['wshop']])) {
    $colname_RecordMember = $_SESSION['MM_Username_' . $_GET['wshop']];
}else if (isset($_SESSION['fb_id']) && $_SESSION['success_fb_login_backstage_'.$_GET['wshop']] == '1') {
    $colname_RecordMember = $_SESSION['fb_id'];
    $account = "fbid";
}else if (isset($_SESSION['line_id']) && $_SESSION['success_line_login_backstage_'.$_GET['wshop']] == '1') {
    $colname_RecordMember = $_SESSION['line_id'];
    $account = "lineid";
}else if (isset($_SESSION['google_id']) && $_SESSION['success_google_login_backstage_'.$_GET['wshop']] == '1') {
    $colname_RecordMember = $_SESSION['google_id'];
    $account = "googleid";
}

$RecordMember = Member::select($columns)
    ->where('lang', '=', $collang[$Tp_Page])
    ->where($account, '=', $colname_RecordMember)
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->first();
    //->toArray();

if($RecordMember != NULL)
{
    $RecordMember->toArray();
    $row_RecordMember = $RecordMember;
    $totalRows_RecordMember = count($RecordMember);
}else{
    $totalRows_RecordMember = 0;
}


?>