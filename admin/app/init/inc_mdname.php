<?php
use App\Eloquent\Admin\Configitem;
use App\Eloquent\Admin\Dftype;
use App\Eloquent\Admin\Modlink;

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

// 取得預設模組名稱
////mysqli_select_db($database_DB_Conn, $DB_Conn);

$RecordMDName = ConfigItem::select('itemname', 'customname', 'customname_en', 'customname_cn', 'customname_kr', 'customname_jp', 'itemvalue')->get();
$totalRows_RecordMDName = $RecordMDName->count();

$colname_RecordDfTypeMDName  = $request->input("lang") ?: 'zh_TW';
$coluserid_RecordDfTypeMDName = $w_userid ?: '-1';

$RecordDfTypeMDName = DfType::select('typemenu', 'lang', 'sortid', 'title')
	->where('lang', $colname_RecordDfTypeMDName)
	->where('indicate', 1)
	->where('userid', $coluserid_RecordDfTypeMDName)
	->orderBy('sortid', 'asc')
	->orderBy('id', 'desc')
	->get();
$totalRows_RecordDfTypeMDName = $RecordDfTypeMDName->count();

$colnamelang_RecordModlinkMDName  = $request->input("lang") ?: 'zh_TW';
$coluserid_RecordModlinkMDName = $w_userid ?: '-1';

$RecordModlinkMDName = Modlink::where('lang', $colnamelang_RecordModlinkMDName)
	->where('userid', $coluserid_RecordModlinkMDName)
	->orderBy('sortid', 'ASC')
	->orderBy('id', 'DESC')
	->get();
?>
<?php foreach($RecordMDName as $row_RecordMDName){ ?>
<?php

switch($row_RecordMDName['itemvalue']) // 抓取模組代碼
{
	case "News":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['News'] = $MD_Name;
		break;
    case "Coupons":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Coupons'] = $MD_Name;
		break;
	case "Timeline":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Timeline'] = $MD_Name;
		break;
	case "Imageshow":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Imageshow'] = $MD_Name;
		break;
	case "Stronghold":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Stronghold'] = $MD_Name;
		break;
	case "Picasa":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Picasa'] = $MD_Name;
		break;
	case "About":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['About'] = $MD_Name;
		break;
	case "Article":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Article'] = $MD_Name;
		break;
	case "Product":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Product'] = $MD_Name;
		break;
	case "Guestbook":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Guestbook'] = $MD_Name;
		break;
	case "Activities":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Activities'] = $MD_Name;
		break;
	case "Project":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Project'] = $MD_Name;
		break;
	case "Frilink":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Frilink'] = $MD_Name;
		break;
	case "Modlink":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Modlink'] = $MD_Name;
		break;
	case "Otrlink":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Otrlink'] = $MD_Name;
		break;
	case "Sponsor":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Sponsor'] = $MD_Name;
		break;
	case "Publish":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Publish'] = $MD_Name;
		break;
	case "Letters":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Letters'] = $MD_Name;
		break;
	case "Meeting":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Meeting'] = $MD_Name;
		break;
	case "Donation":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Donation'] = $MD_Name;
		break;
	case "Org":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Org'] = $MD_Name;
		break;
	case "Member":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Member'] = $MD_Name;
		break;
	case "Careers":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Careers'] = $MD_Name;
		break;
	case "Actnews":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Actnews'] = $MD_Name;
		break;
	case "Faq":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Faq'] = $MD_Name;
		break;
	case "Catalog":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Catalog'] = $MD_Name;
		break;
	case "Cart":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Cart'] = $MD_Name;
		break;
	case "Forum":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Forum'] = $MD_Name;
		break;
	case "Contact":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Contact'] = $MD_Name;
		break;
	case "Blog":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Blog'] = $MD_Name;
		break;
	case "Album":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Album'] = $MD_Name;
		break;
	case "MailSend":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['MailSend'] = $MD_Name;
		break;
	case "Knowledge":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Knowledge'] = $MD_Name;
		break;
	case "EPaper":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['EPaper'] = $MD_Name;
		break;
	case "Partner":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Partner'] = $MD_Name;
		break;
	case "AD":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['AD'] = $MD_Name;
		break;
	case "Video":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Video'] = $MD_Name;
		break;
	case "Artlist":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Artlist'] = $MD_Name;
		break;
	case "Room":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Room'] = $MD_Name;
		break;
	case "Attractions":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Attractions'] = $MD_Name;
		break;
	case "DfType":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['DfType'] = $MD_Name;
		break;
	case "DfPage":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
	    $ModuleName['DfPage'] = $MD_Name;
		break;
	case "Home":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
	    $ModuleName['Home'] = $MD_Name;
		break;
	case "Dealer":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'zh-cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
	    $ModuleName['Dealer'] = $MD_Name;
		break;
	case "Booking":
	    if($_SESSION['lang'] == 'en') {$MD_Name = $row_RecordMDName['customname_en'];} else if ($_SESSION['lang'] == 'cn'){$MD_Name = $row_RecordMDName['customname_cn'];} else if ($_SESSION['lang'] == 'jp'){$MD_Name = $row_RecordMDName['customname_jp'];} else if ($_SESSION['lang'] == 'kr'){$MD_Name = $row_RecordMDName['customname_kr'];} else if ($_SESSION['lang'] == 'sp'){$MD_Name = $row_RecordMDName['customname_sp'];}else {$MD_Name = $row_RecordMDName['customname'];}
		$ModuleName['Booking'] = $MD_Name;
		break;
	default:
		break;
}
?>
<?php }  ?>


<?php foreach($RecordModlinkMDName as $row_RecordModlinkMDName){ ?>
<?php
	if (isset($row_RecordModlinkMDName) && isset($row_RecordModlinkMDName['typemenu'])) {
		switch ($row_RecordModlinkMDName['typemenu']) {
			case "News":
				$ModuleName['News'] = $row_RecordModlinkMDName['name'];
				break;
			case "About":
				$ModuleName['About'] = $row_RecordModlinkMDName['name'];
				break;
			case "Contact":
				$ModuleName['Contact'] = $row_RecordModlinkMDName['name'];
				break;
			case "Letters":
				$ModuleName['Letters'] = $row_RecordModlinkMDName['name'];
				break;
			case "Actnews":
				$ModuleName['Actnews'] = $row_RecordModlinkMDName['name'];
				break;
			case "Faq":
				$ModuleName['Faq'] = $row_RecordModlinkMDName['name'];
				break;
			case "Product":
				$ModuleName['Product'] = $row_RecordModlinkMDName['name'];
				break;
			case "Cart":
				$ModuleName['Cart'] = $row_RecordModlinkMDName['name'];
				break;
			case "Meeting":
				break;
			case "Project":
				$ModuleName['Project'] = $row_RecordModlinkMDName['name'];
				break;
			case "Sponsor":
				$ModuleName['Sponsor'] = $row_RecordModlinkMDName['name'];
				break;
			case "Frilink":
				$ModuleName['Frilink'] = $row_RecordModlinkMDName['name'];
				break;
			case "Careers":
				$ModuleName['Careers'] = $row_RecordModlinkMDName['name'];
				break;
			case "Artlist":
				$ModuleName['Artlist'] = $row_RecordModlinkMDName['name'];
				break;
			case "Publish":
				$ModuleName['Publish'] = $row_RecordModlinkMDName['name'];
				break;
			case "Guestbook":
				$ModuleName['Guestbook'] = $row_RecordModlinkMDName['name'];
				break;
			case "Activities":
				$ModuleName['Activities'] = $row_RecordModlinkMDName['name'];
				break;
			case "Article":
				$ModuleName['Article'] = $row_RecordModlinkMDName['name'];
				break;
			case "Catalog":
				$ModuleName['Catalog'] = $row_RecordModlinkMDName['name'];
				break;
			case "Knowledge":
				$ModuleName['Knowledge'] = $row_RecordModlinkMDName['name'];
				break;
			case "Org":
				$ModuleName['Org'] = $row_RecordModlinkMDName['name'];
				break;
			case "Member":
				$ModuleName['Member'] = $row_RecordModlinkMDName['name'];
				break;
			case "Forum":
				$ModuleName['Forum'] = $row_RecordModlinkMDName['name'];
				break;
			case "Blog":
				$ModuleName['Blog'] = $row_RecordModlinkMDName['name'];
				break;
			case "Coupons":
				$ModuleName['Coupons'] = $row_RecordModlinkMDName['name'];
				break;
			case "Timeline":
				$ModuleName['Timeline'] = $row_RecordModlinkMDName['name'];
				break;
			case "Imageshow":
				$ModuleName['Imageshow'] = $row_RecordModlinkMDName['name'];
				break;
			case "Video":
				$ModuleName['Video'] = $row_RecordModlinkMDName['name'];
				break;
			case "Stronghold":
				$ModuleName['Stronghold'] = $row_RecordModlinkMDName['name'];
				break;
			case "Album":
				$ModuleName['Album'] = $row_RecordModlinkMDName['name'];
				break;
			case "Dealer":
				$ModuleName['Dealer'] = $row_RecordDfTypeMDName['title'];
				break;
			case "Booking":
				$ModuleName['Booking'] = $row_RecordDfTypeMDName['title'];
				break;
		}
	}
?>
<?php } ?>
<?php foreach($RecordDfTypeMDName as $row_RecordDfTypeMDName){ ?>
<?php
	switch($row_RecordDfTypeMDName['typemenu'])
	{
		case "News":
		$ModuleName['News'] = $row_RecordDfTypeMDName['title'];
		break;
		case "About":
		$ModuleName['About'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Contact":
		$ModuleName['Contact'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Letters":
		$ModuleName['Letters'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Actnews":
		$ModuleName['Actnews'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Faq":
		$ModuleName['Faq'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Product":
		$ModuleName['Product'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Cart":
		$ModuleName['Cart'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Meeting":
		break;
		case "Project":
		$ModuleName['Project'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Sponsor":
		$ModuleName['Sponsor'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Frilink":
		$ModuleName['Frilink'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Careers":
		$ModuleName['Careers'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Artlist":
		$ModuleName['Artlist'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Publish":
		$ModuleName['Publish'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Guestbook":
		$ModuleName['Guestbook'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Activities":
		$ModuleName['Activities'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Article":
		$ModuleName['Article'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Catalog":
		$ModuleName['Catalog'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Knowledge":
		$ModuleName['Knowledge'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Org":
		$ModuleName['Org'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Member":
		$ModuleName['Member'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Forum":
		$ModuleName['Forum'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Blog":
		$ModuleName['Blog'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Coupons":
		$ModuleName['Coupons'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Timeline":
		$ModuleName['Timeline'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Imageshow":
		$ModuleName['Imageshow'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Video":
		$ModuleName['Video'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Stronghold":
		$ModuleName['Stronghold'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Album":
		$ModuleName['Album'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Dealer":
		$ModuleName['Dealer'] = $row_RecordDfTypeMDName['title'];
		break;
		case "Booking":
		$ModuleName['Booking'] = $row_RecordDfTypeMDName['title'];
		break;
	}
?>
<?php } ?>


<?php $ModuleName_Bulletin = "公告資訊"; ?>
