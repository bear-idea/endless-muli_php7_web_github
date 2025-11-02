<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>最新訊息 - 主版面</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<body>
<!-- TemplateBeginEditable name="標頭部分" -->
<div class="columns on-1">
  <div class="container">
    <div class="column">
      <div class="container ct_board">
        <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Content_Title_News; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="分頁部分" -->
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
  <tr>
    <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordNews + 1) ?> - <?php echo min($startRow_RecordNews + $maxRows_RecordNews, $totalRows_RecordNews) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordNews ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
    <td width="50%" align="right"><?php if ($NewsSearchSelect == "1") { ?>
      <form id="form_News" name="form_News" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="<?php echo $TplImagePath; ?>/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_News; ?>" />
        </label>
      </form>
      <?php } ?>
      <div class="PageSelectBoard">
        <?php 
      # variable declaration
      $prev_RecordNews = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordNews = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordNews = buildNavigation($page,$totalPages_RecordNews,$prev_RecordNews,$next_RecordNews,$separator,$max_links,true); 
       ?>
        <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordNews); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
        <?php print $pages_navigation_RecordNews[0]; ?> <?php print $pages_navigation_RecordNews[1]; ?> <?php print $pages_navigation_RecordNews[2]; ?>
        <?php if ($page < $totalPages_RecordNews) { // Show if not last page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordNews, $queryString_RecordNews); ?>"><i class="fa fa-angle-double-right"></i></a>
        <?php } // Show if not last page ?>
        <?php if (ceil($totalRows_RecordNews/$maxRows_RecordNews) > 1) { ?>
        <span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordNews/$maxRows_RecordNews); ?></span>
        <?php } ?>
      </div></td>
  </tr>
</table>
<!-- TemplateEndEditable -->
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordNews > 0) { // Show if recordset not empty 
?>
<!-- TemplateBeginEditable name="主要內容" -->
  <div class="columns on-1">
    <div class="container board">
      <div class="column">
        <div class="container ct_board">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
            <!--
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_News; // 標題 ?> </td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_News; // 日期 ?></td>
      </tr>
      -->
            <?php if ($totalRows_RecordNewsPushTop > 0) { // Show if recordset not empty ?>
            <?php do { ?>
            <tr class= "TR_Even_Color_Style">
              <td width="20" align="center" valign="top"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist_top.gif" width="18" height="18" /></td>
              <td align="left" valign="top"><span class="TipTypeStyle">[<?php echo $row_RecordNewsPushTop['type']; ?>]</span> <a href="../theme/sinlonn/news.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=<?php echo $_GET['tp']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordNewsPushTop['id']; ?>"><?php echo $row_RecordNewsPushTop['title']; ?></a></td>
              <td width="158" valign="top"><?php echo date('Y-m-d',strtotime($row_RecordNewsPushTop['postdate'])); ?></td>
            </tr>
            <?php } while ($row_RecordNewsPushTop = mysqli_fetch_assoc($RecordNewsPushTop)); ?>
            <?php } // Show if recordset not empty ?>
            <?php
      #
      # ============== [do] ============== #
	  #
      # 重複印出所有資料
      do { 
      ?>
            <?php
		  #
		  # ============== [tr color change] ============== #
		  #
		  # 表格隔行換色
		  $oddtr=TR_Odd_Color_Style;
          $eventr=TR_Even_Color_Style;
          if(($startRow_RecordNews)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
            <tr class= "<?php echo $chahgecolorcount; ?>">
              <td align="center" valign="top"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" width="18" height="18" /></td>
              <td valign="top"><?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordNews['type'] != "") { 
              ?>
                <span class="TipTypeStyle">[<?php echo $row_RecordNews['type']; ?>]</span>
                <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
                <a href="../theme/sinlonn/news.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=<?php echo $_GET['tp']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordNews['id']; ?>"><?php echo $row_RecordNews['title']; ?></a></td>
              <td valign="top"><?php echo highLight(date('Y-m-d',strtotime($row_RecordNews['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td>
            </tr>
            <?php 
		   $startRow_RecordNews++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
            <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordNews = mysqli_fetch_assoc($RecordNews)); 
      ?>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- TemplateEndEditable -->
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>

<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordNews == 0) { // Show if recordset empty 
?>
  <!-- TemplateBeginEditable name="無資料部分" -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
    </tr>
  </table>
  <!-- TemplateEndEditable -->
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
</body>
</html>