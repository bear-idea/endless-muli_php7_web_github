<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ($_POST['startdate'] != "" && $_POST['enddate'] != "") {
  $search_startdate = $_POST['startdate'];
  $search_enddate = $_POST['enddate'];
}
?>

<?php
ob_start(); // 開啟輸出緩衝區
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：
?>
<?php require_once("inc_lang.php"); // 取得目前語系
?>
<?php require_once("inc_mdname.php"); // 取得模組名稱
?>
<?php require_once('upload_get_admin.php'); ?>
<!DOCTYPE html>
<html lang="zh-TW">
<!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <title>綜合損益表 <?php echo $search_startdate; ?> ~ <?php echo $search_enddate; ?> </title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="robots" content="noindex,nofollow" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link rel='icon' href='favicon.ico' type='image/x-icon' />
  <link rel='bookmark' href='favicon.ico' type='image/x-icon' />
  <link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />

  <?php //$SiteBaseAdminPath="admin_color/"; 
  ?>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="<?php if ($SiteBaseUrlOuter != "") {
                echo $SiteBaseUrlOuter . $SiteBaseAdminPath;
              } else {
                echo $SiteBaseUrl . $SiteBaseAdminPath;
              } ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl; ?>fonts/twemoji-awesome/dist/twemoji-awesome.min.css" />
  <link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
  <link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/glyphicon/css/glyphicon.min.css" rel="stylesheet" />
  <link href="<?php if ($SiteBaseUrlOuter != "") {
                echo $SiteBaseUrlOuter . $SiteBaseAdminPath;
              } else {
                echo $SiteBaseUrl . $SiteBaseAdminPath;
              } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <style>
    @page {
      size: A4
    }

    table.paleBlueRows {
      font-family: "Times New Roman", Times, serif;
      border: 1px solid #FFFFFF;
      text-align: left;
      border-collapse: collapse;
    }

    table.paleBlueRows td,
    table.paleBlueRows th {
      border: 1px solid #FFFFFF;
      /*padding: 2px 2px;*/
    }

    table.paleBlueRows tbody td {
      padding: 1px 10px;
    }

    table.paleBlueRows tr:nth-child(even) {
      background: #D0E4F5;
    }

    table.paleBlueRows thead {
      background: #0B6FA4;
      border-bottom: 5px solid #FFFFFF;
    }

    table.paleBlueRows thead th {
      font-weight: bold;
      color: #FFFFFF;
      text-align: center;
      border-left: 2px solid #FFFFFF;
      padding: 2px 2px;
    }

    table.paleBlueRows thead th:first-child {
      border-left: none;
    }

    table.paleBlueRows tfoot {
      font-weight: bold;
      color: #333333;
      background: #D0E4F5;
    }

    table.paleBlueRows tfoot td {}
  </style>

</head>
<!--<body class="A4 landscape">-->

<body class="A4">

  <?php
  // 設定變數
  // 多少筆換下一業
  // echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) 最後一筆
  $ChangePageNumber = 56;
  ?>

  <?php $i = 6; ?>
  <?php //do { 
  ?>
  <?php //if($i%$ChangePageNumber == "0") { 
  ?>
  <section class="sheet padding-10mm">
    <article>
      <?php //} 
      ?>
      <?php //if($i%$ChangePageNumber == "0") { 
      ?>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style="text-align:center">綜合損益表</td>
          </tr>
          <tr>
            <td><?php echo $search_startdate; ?> ~ <?php echo $search_enddate; ?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>項目</td>
            <td width="100">小計</td>
            <td width="100">合計</td>
            <td width="100">百分比</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>
      <?php $i += 1; ?>
      <?php
      // 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
      // 營業收入項目幾個 
      $TotalNowBalanceSelect = 0;
      $colitemvalue_RecordMultiLeftMenu_l1 = '4';
      require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>營業收入總計</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Totaloperatingincome = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>
      <?php $i += 2; ?>
      <?php
      // 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
      // 營業收入項目幾個 
      $TotalNowBalanceSelect = 0;
      $colitemvalue_RecordMultiLeftMenu_l1 = '5';
      require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_list.php");
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>營業成本總計</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Totaloperatingcosts = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>營業毛利(總營收-銷貨支出)</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Operatingmargin = $Totaloperatingincome - $Totaloperatingcosts; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>
      <?php $i += 2; ?>
      <?php
      // 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
      // 營業收入項目幾個 
      $TotalNowBalanceSelect = 0;
      $colitemvalue_RecordMultiLeftMenu_l1 = '6';
      require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_list.php");
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>營業費用總計</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Totaloperatingexpenses = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>營業淨利(營業毛利-營業費用總計)</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Operatingprofit = $Operatingmargin - $Totaloperatingexpenses; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>

      <?php $i += 2; ?>
      <?php
      // 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
      // 營業收入項目幾個 
      $TotalNowBalanceSelect = 0;
      $colitemvalue_RecordMultiLeftMenu_l1 = '7';
      require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_list.php");
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>營業外收益及費損總計</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Totalnonoperatingincomeandexpenses = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>稅前收入(營業淨利+營業外收益及費損總計)</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Pretaxincome = $Operatingprofit + $Totalnonoperatingincomeandexpenses; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>
      <?php $i += 2; ?>
      <?php
      // 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
      // 營業收入項目幾個 
      $TotalNowBalanceSelect = 0;
      $colitemvalue_RecordMultiLeftMenu_l1 = '8';
      require("require_manage_accounts_report_profitlosslist_print_get_trialbalance_list.php");
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>所得稅費用</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Interestratefee = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
          <tr>
            <td>本期綜合損益總額</td>
            <td width="100">&nbsp;</td>
            <td width="100"><?php echo $Totalconsolidatedprofitandlossfortheperiod = $Pretaxincome - $Interestratefee; ?></td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>

      <?php //if($i%$ChangePageNumber == $ChangePageNumber-1 || $i==$totalRows_RecordSplit-1) { 
      ?>
    </article>
  </section>
  <?php //} 
  ?>

  <?php //$i++; 
  ?>

  <?php //} while ($row_RecordSplit = mysqli_fetch_assoc($RecordSplit)); 
  ?>

</body>

</html>