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
  <title>資產負債表 <?php echo $_POST['postdate']; ?> </title>
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
      size: A4 landscape
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

<body class="A4 landscape">

  <?php
  // 設定變數
  // 多少筆換下一業
  // echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) 最後一筆
  $ChangePageNumber = 40;
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
            <td colspan="4" style="text-align:center">資產負債表 - 資產</td>
          </tr>
          <tr>
            <td><?php echo $search_startdate; ?> ~ <?php echo $search_enddate; ?></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>項目</td>
            <td width="100">金額</td>
            <td width="100"></td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '11';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>流動資產合計</td>
            <td width="100"><?php echo $Totalcurrentassets = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '13';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>非流動資產合計</td>
            <td width="100"><?php echo $Totalnoncurrentassets = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>資產總額</td>
            <td width="100"><?php echo $Totalassets = $Totalcurrentassets + $Totalnoncurrentassets; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>

    </article>
  </section>


  <?php
  // 設定變數
  // 多少筆換下一業
  // echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) 最後一筆
  $ChangePageNumber = 40;
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
            <td colspan="4" style="text-align:center">資產負債表 - 負債</td>
          </tr>
          <tr>
            <td><?php echo $search_startdate; ?> ~ <?php echo $search_enddate; ?></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>項目</td>
            <td width="100">金額</td>
            <td width="100"></td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '21';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>流動負債合計</td>
            <td width="100"><?php echo $Totalcurrentliabilities = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '23';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>非流動負債合計</td>
            <td width="100"><?php echo $Totalnoncurrentliabilities = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>負債總額</td>
            <td width="100"><?php echo $Totalliabilities = $Totalcurrentliabilities + $Totalnoncurrentliabilities; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>

    </article>
  </section>


  <?php
  // 設定變數
  // 多少筆換下一業
  // echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) 最後一筆
  $ChangePageNumber = 40;
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
            <td colspan="4" style="text-align:center">資產負債表 - 權益</td>
          </tr>
          <tr>
            <td><?php echo $search_startdate; ?> ~ <?php echo $search_enddate; ?></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>項目</td>
            <td width="100">金額</td>
            <td width="100"></td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '31';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>資本(或股本)合計</td>
            <td width="100"><?php echo $Totalcapital = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '32';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>資本公積合計</td>
            <td width="100"><?php echo $Totalcapitalreserve = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '33';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <?php
      // 取得 營業收入(Operating Profit) = 毛利(Gross Profit)-營業支出
      // 營業收入項目幾個 
      //$TotalNowBalanceSelect = 0;
      //$colitemvalue_RecordMultiLeftMenu_l1 = '33';
      //require("require_manage_accounts_report_balancesheet_print_get_profitlosslist_list.php");
      //echo $i;
      ?>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>保留盈餘(或累積虧損)合計</td>
            <td width="100"><?php echo $Retainedsurplus = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '34';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>其他權益合計</td>
            <td width="100"><?php echo $Totalotherequity = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
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
      $colitemvalue_RecordMultiLeftMenu_l1 = '35';
      require("require_manage_accounts_report_balancesheet_print_get_trialbalance_list.php");
      //echo $i;
      ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead style="display:table-header-group;font-weight:bold">
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>庫藏股票合計</td>
            <td width="100"><?php echo $TotalTreasuryStocks = $TotalNowBalanceSelect; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>權益總額</td>
            <td width="100"><?php echo $Totalequity = $Totalcapital + $Totalcapitalreserve + $Retainedsurplus + $Totalotherequity + $TotalTreasuryStocks; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
          <tr>
            <td>負債與權益總額</td>
            <td width="100"><?php echo $Totalliabilitiesandequity = $Totalequity + $Totalliabilities; ?></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" style=" border-bottom:#333 double 2px;"></td>
          </tr>
        </thead>
        <?php //} 
        ?>
      </table>
      

    </article>
  </section>


</body>

</html>