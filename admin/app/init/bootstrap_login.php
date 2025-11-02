<?php
ob_start(); // 開啟輸出緩衝區
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
    {
        global $DB_Conn;
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

//require(dirname(__DIR__).'/vendor/autoload.php');
//require_once("inc_setting.php");
//require_once('app/init/inc_permission.php');
require_once("../inc/inc_function.php");
//require_once("app/init/inc_lang.php"); // 取得目前語系
//require_once("app/init/inc_mdname.php"); // 取得模組名稱
//require_once('upload_get_admin.php');
?>