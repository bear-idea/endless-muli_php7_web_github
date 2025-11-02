<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

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

$coluserid_RecordPermissionLevelGroup = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPermissionLevelGroup = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionLevelGroup = sprintf("SELECT * FROM demo_permissionitem WHERE list_id = 1 && (userid=%s || userid=1)",GetSQLValueString($coluserid_RecordPermissionLevelGroup, "int"));
$RecordPermissionLevelGroup = mysqli_query($DB_Conn, $query_RecordPermissionLevelGroup) or die(mysqli_error($DB_Conn));
$row_RecordPermissionLevelGroup = mysqli_fetch_assoc($RecordPermissionLevelGroup);
$totalRows_RecordPermissionLevelGroup = mysqli_num_rows($RecordPermissionLevelGroup);
//echo $_SESSION['MM_UserGroup'];

$MM_authorizedUsers = "";

if($totalRows_RecordPermissionLevelGroup > 0) {
	do{
		if($_SESSION['MM_UserGroup'] == $row_RecordPermissionLevelGroup['itemvalue'] && $_SESSION['MM_UserGroup'] != "superadmin" && $_SESSION['MM_UserGroup'] != "admin" && $UseMod != "" && $_GET['Opt'] != "")
		{
			
			// echo "取得 PermissionGroupType";
			$coluserid_RecordPermissionLevelGroupTypeGet = "-1";
			if (isset($w_userid)) {
			  $coluserid_RecordPermissionLevelGroupTypeGet = $w_userid;
			}
			$colitemid_RecordPermissionLevelGroupTypeGet = "-1";
			if (isset($row_RecordPermissionLevelGroup['item_id'])) {
			  $colitemid_RecordPermissionLevelGroupTypeGet = $row_RecordPermissionLevelGroup['item_id'];
			}
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordPermissionLevelGroupTypeGet = sprintf("SELECT * FROM demo_permissiongrouptype WHERE itemid=%s && userid=%s",GetSQLValueString($colitemid_RecordPermissionLevelGroupTypeGet, "int"),GetSQLValueString($coluserid_RecordPermissionLevelGroupTypeGet, "int"));
			$RecordPermissionLevelGroupTypeGet = mysqli_query($DB_Conn, $query_RecordPermissionLevelGroupTypeGet) or die(mysqli_error($DB_Conn));
			$row_RecordPermissionLevelGroupTypeGet = mysqli_fetch_assoc($RecordPermissionLevelGroupTypeGet);
			$totalRows_RecordPermissionLevelGroupTypeGet = mysqli_num_rows($RecordPermissionLevelGroupTypeGet);
		
			// 取得權限類別 ADD EDIT...
			$MM_LevelGroupType = array();
			$MM_LevelGroupType = mb_split(",",$row_RecordPermissionLevelGroupTypeGet['grouptype']);
			$MM_LevelGroupType = implode("|",$MM_LevelGroupType);
			
			// 取得 目前頁面 權限規則 比對 當 有勾選規則時
			$coluserid_RecordPermissionGet = "-1";
			if (isset($w_userid)) {
			  $coluserid_RecordPermissionGet = $w_userid;
			}
			$colmodule_RecordPermissionGet = "-1";
			if (isset($UseMod)) {
			  $colmodule_RecordPermissionGet = $UseMod;
			}
			$coltype_RecordPermissionGet = "-1";
			if (isset($MM_LevelGroupType)) {
			  $coltype_RecordPermissionGet = $MM_LevelGroupType;
			}
			$coltopt_RecordPermissionGet = "-1";
			if (isset($_GET['Opt'])) {
			  $colopt_RecordPermissionGet = $_GET['Opt'];
			}
			/*$colusegroup_RecordPermissionGet = "-1";
			if (isset($_SESSION['MM_UserGroup'])) {
			  $colusegroup_RecordPermissionGet = $_SESSION['MM_UserGroup'];
			}*/
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$query_RecordPermissionGet = sprintf("SELECT * FROM demo_permission WHERE (userid=%s || userid=1) && module=%s && opt=%s",GetSQLValueString($coluserid_RecordPermissionGet, "int"),GetSQLValueString($colmodule_RecordPermissionGet, "text"),GetSQLValueString($colopt_RecordPermissionGet, "text"));
			$RecordPermissionGet = mysqli_query($DB_Conn, $query_RecordPermissionGet) or die(mysqli_error($DB_Conn));
			$row_RecordPermissionGet = mysqli_fetch_assoc($RecordPermissionGet);
			$totalRows_RecordPermissionGet = mysqli_num_rows($RecordPermissionGet);
			
			if($totalRows_RecordPermissionGet == 0) {
				// 未設定規則
				$Rule_GroupType = "open";
			}else{
				
				$Permission_TypeCheck = mb_split(",",$row_RecordPermissionLevelGroupTypeGet['grouptype']);
				
				if(in_array($row_RecordPermissionGet['type'], $Permission_TypeCheck)) 
				{ 
					$Rule_GroupType = "open";
				}else{
					$Rule_GroupType = "close";
				}
			}
			
			$Rule_UseGroup = "open";
			
			if($totalRows_RecordPermissionGet > 0)
			{
				$Rule_UseGroup = "close";
				// 取得 PermissionRuleUsegroup 是否有設定
				// 二次規則判斷 當此規則 有設定時 在欄位找到其值
				$coluserid_RecordPermissionRuleUsegroupGet = "-1";
				if (isset($w_userid)) {
				  $coluserid_RecordPermissionRuleUsegroupGet = $w_userid;
				}
				$colitemid_RecordPermissionRuleUsegroupGet = "-1";
				if (isset($row_RecordPermissionGet['id'])) {
				  $colitemid_RecordPermissionRuleUsegroupGet = $row_RecordPermissionGet['id'];
				}
				$colusegroup_RecordPermissionGet = "-1";
				if (isset($_SESSION['MM_UserGroup'])) {
				  $colusegroup_RecordPermissionGet = $_SESSION['MM_UserGroup'];
				}
				//mysqli_select_db($database_DB_Conn, $DB_Conn);
				$query_RecordPermissionRuleUsegroupGet = sprintf("SELECT * FROM demo_permissionruleusegroup WHERE itemid=%s && userid=%s",GetSQLValueString($colitemid_RecordPermissionRuleUsegroupGet, "int"),GetSQLValueString($coluserid_RecordPermissionRuleUsegroupGet, "int"));
				$RecordPermissionRuleUsegroupGet = mysqli_query($DB_Conn, $query_RecordPermissionRuleUsegroupGet) or die(mysqli_error($DB_Conn));
				$row_RecordPermissionRuleUsegroupGet = mysqli_fetch_assoc($RecordPermissionRuleUsegroupGet);
				$totalRows_RecordPermissionRuleUsegroupGet = mysqli_num_rows($RecordPermissionRuleUsegroupGet);
				
				if($totalRows_RecordPermissionRuleUsegroupGet == 0) {
					// 未設定規則
					$Rule_UseGroup = "open";
				}else{
					$Permission_UsegroupCheck = mb_split(",",$row_RecordPermissionRuleUsegroupGet['grouptype']);
					
					if(in_array($_SESSION['MM_UserGroup'], $Permission_UsegroupCheck)) 
					{ 
						$Rule_UseGroup = "open";
					}else{
						$Rule_UseGroup = "close";
					}
				}
			}
			
			// 當 權限規則 有勾選時
			if($Rule_GroupType == "open" && $Rule_UseGroup == "open") {} else {$_GET['Opt'] = "error";}
		}
		
		// 印出所有權限群組 SUBADMIN....
		$MM_authorizedUsers = $MM_authorizedUsers . "," . $row_RecordPermissionLevelGroup['itemvalue'];
		
		
	} while ($row_RecordPermissionLevelGroup = mysqli_fetch_assoc($RecordPermissionLevelGroup));
}

$MM_authorizedUsers = "superadmin,admin" . $MM_authorizedUsers;
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

//echo $grouptype . "-------------";

mysqli_free_result($RecordPermissionLevelGroup); 


$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
} 


// 登出
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>