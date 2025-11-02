<?php

use App\Eloquent\Admin\Permission;
use App\Eloquent\Admin\Permissiongrouptype;
use App\Eloquent\Admin\Permissionitem;

?>
<?php
$RecordPermissionLevelGroup = Permissionitem::select('*')
    ->where('list_id', '=', '1')
    ->where(function ($query) {
        $query->where('userid', '=', $_SESSION['w_userid'])
            ->orWhere('userid', '=', '1');
    })
    ->get();

$totalRows_RecordPermissionLevelGroup = $RecordPermissionLevelGroup->count();

$MM_authorizedUsers = "";

if($totalRows_RecordPermissionLevelGroup > 0) {
    foreach ($RecordPermissionLevelGroup as $row_RecordPermissionLevelGroup) {
		if($_SESSION['MM_UserGroup'] == $row_RecordPermissionLevelGroup['itemvalue'] && $_SESSION['MM_UserGroup'] != "superadmin" && $_SESSION['MM_UserGroup'] != "admin" && $UseMod != "" && $_GET['Opt'] != "")
		{
			
			// echo "取得 PermissionGroupType";
            $RecordPermissionLevelGroupTypeGet = Permissiongrouptype::select('*')
                ->where('userid', '=', $w_userid)
                ->where('itemid', '=', $row_RecordPermissionLevelGroup['item_id'])
                ->toArray();

            $row_RecordPermissionLevelGroupTypeGet = $RecordPermissionLevelGroupTypeGet;
		
			// 取得權限類別 ADD EDIT...
			$MM_LevelGroupType = array();
			$MM_LevelGroupType = mb_split(",",$row_RecordPermissionLevelGroupTypeGet['grouptype']);
			$MM_LevelGroupType = implode("|",$MM_LevelGroupType);
			
			// 取得 目前頁面 權限規則 比對 當 有勾選規則時
            $RecordPermissionGet = Permission::select('*')
                ->where(function ($query) {
                    $query->where('userid', '=', $w_userid)
                        ->orWhere('userid', '=', '1');
                })
                ->where('module', '=', $UseMod)
                ->where('opt', '=', $_GET['Opt'])
                ->get();

            $totalRows_RecordPermissionGet = $RecordPermissionGet->count();
			
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
		
		
	}
}

$MM_authorizedUsers = "superadmin,admin" . $MM_authorizedUsers;
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
    $isValid = false; // 預設為未授權狀態

    // 當訪客登錄到這個站點時，Session 變量 MM_Username 被設置為他們的用戶名。
    // 因此，如果 Session 變量為空，我們知道用戶未登錄。
    if (!empty($UserName)) {
        // 解析逗號分隔的用戶列表和組列表成為數組
        $arrUsers = explode(",", $strUsers);
        $arrGroups = explode(",", $strGroups);

        // 如果用戶名在允許的用戶列表中，則授權通過
        if (in_array($UserName, $arrUsers)) {
            $isValid = true;
        }

        // 或者，如果用戶組在允許的組列表中，則授權通過
        if (in_array($UserGroup, $arrGroups)) {
            $isValid = true;
        }

        // 如果 $strUsers 是空的且 false，也允許訪問（這部分看起來有點混淆，不太清楚用意）
        // 可能應該是 if ($strUsers == "" && false) 改為 if ($strUsers == "" && $strGroups == "")
        // 如果沒有任何用戶和組限制，則默認授權通過
        if ($strUsers == "" && $strGroups == "") {
            $isValid = true;
        }
    }

    return $isValid;
}

//echo $grouptype . "-------------";

//mysqli_free_result($RecordPermissionLevelGroup);


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