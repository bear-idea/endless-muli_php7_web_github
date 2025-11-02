<?php 
// 自訂頁面
$colnamelang_RecordDfType = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordDfType = $_GET['lang'];
}
$coluserid_RecordDfType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfType = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordDfType, "text"),GetSQLValueString($coluserid_RecordDfType, "int"));
$RecordDfType = mysqli_query($DB_Conn, $query_RecordDfType) or die(mysqli_error($DB_Conn));
$row_RecordDfType = mysqli_fetch_assoc($RecordDfType);
$totalRows_RecordDfType = mysqli_num_rows($RecordDfType);

// 商品櫥窗
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
$SEO_Product=0;
if($totalRows_RecordProduct > 0 ){
	do
	{
		if($row_RecordProduct['sdescription']!="" && $row_RecordProduct['skeyword']!=""){
			$SEO_Product++;
		}
	} while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); 
}

// 最新訊息
$colnamelang_RecordNews = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordNews = $_GET['lang'];
}
$coluserid_RecordNews = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNews = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordNews, "text"),GetSQLValueString($coluserid_RecordNews, "int"));
$RecordNews = mysqli_query($DB_Conn, $query_RecordNews) or die(mysqli_error($DB_Conn));
$row_RecordNews = mysqli_fetch_assoc($RecordNews);
$totalRows_RecordNews = mysqli_num_rows($RecordNews);
$SEO_News=0;
if($totalRows_RecordNews > 0 ){
	do
	{
		if($row_RecordNews['sdescription']!="" && $row_RecordNews['skeyword']!=""){
			$SEO_News++;
		}
	} while ($row_RecordNews = mysqli_fetch_assoc($RecordNews)); 
}

// 聯絡我們分類
$collang_RecordContactListItem = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordContactListItem = $_GET['lang'];
}
$coluserid_RecordContactListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordContactListItem = $w_userid;
}
$collistid_RecordContactListItem = "1";
if (isset($_GET['list_id'])) {
  $collistid_RecordContactListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactListItem = sprintf("SELECT demo_contactitem.item_id, demo_contactitem.userid, demo_contactlist.list_id, demo_contactlist.listname, demo_contactitem.itemname, demo_contactitem.lang FROM demo_contactlist LEFT OUTER JOIN demo_contactitem ON demo_contactlist.list_id = demo_contactitem.list_id WHERE demo_contactlist.list_id = %s && demo_contactitem.lang=%s && demo_contactitem.userid=%s", GetSQLValueString($collistid_RecordContactListItem, "int"),GetSQLValueString($collang_RecordContactListItem, "text"),GetSQLValueString($coluserid_RecordContactListItem, "int"));
$RecordContactListItem = mysqli_query($DB_Conn, $query_RecordContactListItem) or die(mysqli_error());
$row_RecordContactListItem = mysqli_fetch_assoc($RecordContactListItem);
$totalRows_RecordContactListItem = mysqli_num_rows($RecordContactListItem);

// 版型
$colname_RecordTmp = $row_RecordSystemConfigFr['MSTmpSelect'];
if (isset($_GET['id_edit'])) {
  $colname_RecordTmp = $_GET['id_edit'];
}
$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordTmp, "int"),GetSQLValueString($coluserid_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);

$colname_RecordTmpRWD = $row_RecordSystemConfigFr['MSTmpSelectRwd'];
if (isset($_GET['id_edit'])) {
  $colname_RecordTmpRWD = $_GET['id_edit'];
}
$coluserid_RecordTmpRWD = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpRWD = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpRWD = sprintf("SELECT * FROM demo_tmp WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordTmpRWD, "int"),GetSQLValueString($coluserid_RecordTmpRWD, "int"));
$RecordTmpRWD = mysqli_query($DB_Conn, $query_RecordTmpRWD) or die(mysqli_error($DB_Conn));
$row_RecordTmpRWD = mysqli_fetch_assoc($RecordTmpRWD);
$totalRows_RecordTmpRWD = mysqli_num_rows($RecordTmpRWD);

// 版型
$coluserid_RecordTmpShowSlect = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlect = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT userid FROM demo_tmp WHERE id = (SELECT MSTmpSelect FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlect, "int"));
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);

$coluserid_RecordTmpShowSlectRwd = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpShowSlectRwd = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlectRwd = sprintf("SELECT userid FROM demo_tmp WHERE id = (SELECT MSTmpSelectRwd FROM demo_setting_fr WHERE userid=%s)", GetSQLValueString($coluserid_RecordTmpShowSlectRwd, "int"));
$RecordTmpShowSlectRwd = mysqli_query($DB_Conn, $query_RecordTmpShowSlectRwd) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlectRwd = mysqli_fetch_assoc($RecordTmpShowSlectRwd);
$totalRows_RecordTmpShowSlectRwd = mysqli_num_rows($RecordTmpShowSlectRwd);
?>

              <ul class="list-group list-group-flush">
                <li class="list-group-item"><div class="row">
                        <div class="col-md-6">網站基本資訊 <a href="#" data-toggle="tooltip" data-original-title="填寫您的網站基本資料，標題以及公司基本資訊等" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <?php 
					// 計算百分比
					$BaseWeb_Percent = "40";
					if($_SESSION[ 'lang' ] == "zh-tw") {
						if($row_RecordSystemConfigFr['SiteName'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteDecsHome'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteSName'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SitePhone'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteCell'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAddr'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteMail'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAuthor'] != "") {$BaseWeb_Percent+=5;}
					}
					if($_SESSION[ 'lang' ] == "zh-cn") {
						if($row_RecordSystemConfigFr['SiteName_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteDecsHome_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteSName_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SitePhone_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteCell_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAddr_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteMail_cn'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAuthor_cn'] != "") {$BaseWeb_Percent+=5;}
					}
					if($_SESSION[ 'lang' ] == "en") {
						if($row_RecordSystemConfigFr['SiteName_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteDecsHome_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteSName_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SitePhone_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteCell_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAddr_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteMail_en'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAuthor_en'] != "") {$BaseWeb_Percent+=5;}
					}
					if($_SESSION[ 'lang' ] == "jp") {
						if($row_RecordSystemConfigFr['SiteName_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteDecsHome_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteSName_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SitePhone_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteCell_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAddr_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteMail_jp'] != "") {$BaseWeb_Percent+=5;}
						if($row_RecordSystemConfigFr['SiteAuthor_jp'] != "") {$BaseWeb_Percent+=5;}
					}
					?>
                    <div class="progress" style="margin-bottom:0px;">
                            <div class="progress-bar progress-bar-warning" style="width:<?php echo $BaseWeb_Percent; ?>%"><?php echo $BaseWeb_Percent; ?>%</div>
                          </div>
                  </div>
                        <div class="col-md-2"> <a href="manage_siteconfig.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_bs&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                <li class="list-group-item"><div class="row">
                        <div class="col-md-6">基礎關鍵字優化 <a href="#" data-toggle="tooltip" data-original-title="替您的網站打入最基本的關鍵字及描述" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <?php 
					// 計算百分比
					$BaseKey_Percent = "25";
					if($_SESSION[ 'lang' ] == "zh-tw") {
						if($row_RecordSystemConfigFr['SiteName'] != "") {$BaseKey_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteKeyWord'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteDesc'] != "") {$BaseWeb_Percent+=25;}
					}
					if($_SESSION[ 'lang' ] == "zh-cn") {
						if($row_RecordSystemConfigFr['SiteName_cn'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteKeyWord_cn'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteDesccn'] != "") {$BaseWeb_Percent+=25;}
					}
					if($_SESSION[ 'lang' ] == "en") {
						if($row_RecordSystemConfigFr['SiteName_en'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteKeyWord_en'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteDesc_en'] != "") {$BaseWeb_Percent+=25;}
					}
					if($_SESSION[ 'lang' ] == "jp") {
						if($row_RecordSystemConfigFr['SiteName_jp'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteKeyWord_jp'] != "") {$BaseWeb_Percent+=25;}
						if($row_RecordSystemConfigFr['SiteDesc_jp'] != "") {$BaseWeb_Percent+=25;}
					}
					?>
                    <div class="progress" style="margin-bottom:0px;">
                            <div class="progress-bar progress-bar-warning" style="width:<?php echo $BaseKey_Percent; ?>%"><?php echo $BaseKey_Percent; ?>%</div>
                          </div>
                  </div>
                        <div class="col-md-2"> <a href="manage_keyword.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_ky&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                      
                      <li class="list-group-item"><div class="row">
                        <div class="col-md-6">Google Analytics(GA) <a href="#" data-toggle="tooltip" data-original-title="Google 分析工具" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <?php if($row_RecordSystemConfigFr['GoogleAnalyticsCodeID'] != "") { ?>
                    <button type="button" class="btn btn-warning btn-xs btn-block">已設定</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-default btn-xs btn-block">未設定</button>
                    <?php } ?>
                  </div>
                        <div class="col-md-2"> <a href="manage_webanalytics.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                      
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6">Google Map API <a href="#" data-toggle="tooltip" data-original-title="Google Map API 設定" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <?php if($row_RecordSystemConfigFr['GoogleMapAPICode1'] != "") { ?>
                    <button type="button" class="btn btn-warning btn-xs btn-block">已設定</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-default btn-xs btn-block">未設定</button>
                    <?php } ?>
                  </div>
                        <div class="col-md-2"> <a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=gapi&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                      
                      
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6">網站主選單 <a href="#" data-toggle="tooltip" data-original-title="已新增選單數目及主選單限制數目" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                        
                        <?php 
					// 計算百分比
					if($row_RecordSystemConfig['dfpage_limit_page_num'] < $totalRows_RecordDfType)
					{
						$row_RecordSystemConfig['dfpage_limit_page_num'] = $totalRows_RecordDfType;
					}
					$BaseDfType_Percent = floor($totalRows_RecordDfType/$row_RecordSystemConfig['dfpage_limit_page_num']*100);
					?>
                    <div class="progress" style="margin-bottom:0px;">
                            <div class="progress-bar progress-bar-warning" style="width:<?php echo $BaseDfType_Percent; ?>%"><?php echo $totalRows_RecordDfType; ?> / <?php echo $row_RecordSystemConfig['dfpage_limit_page_num']; ?></div>
                          </div>
                  </div>
                        <div class="col-md-2"> <a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=typepage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                      
                      
                      <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProductSelect == '1') { ?>
                      
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6"><?php echo $ModuleName['Product']; // 產品維護?>SEO優化 <a href="#" data-toggle="tooltip" data-original-title="請將各頁面之頁面關鍵字及頁面描述填入" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4"> 
					<?php if($totalRows_RecordProduct > 0 && $SEO_Product >= 0){ ?>
                    <?php 
					// 計算百分比
					$BaseSEOProduct_Percent = floor($SEO_Product/$totalRows_RecordProduct*100);
					?>
                    <div class="progress" style="margin-bottom:0px;">
                            <div class="progress-bar progress-bar-warning" style="width:<?php echo $BaseSEOProduct_Percent; ?>%"><?php echo $SEO_Product; ?>/<?php echo $totalRows_RecordProduct; ?></div>
                          </div>
                     <?php } else { ?>
                     <button type="button" class="btn btn-default btn-xs btn-block">尚無資料</button>
                     <?php } ?>
                  </div>
                        <div class="col-md-2"> <a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=seo&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                      <?php } ?>
                      
                      <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionNewsSelect == '1') { ?>
                      
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6"><?php echo $ModuleName['News']; // 產品維護?>SEO優化 <a href="#" data-toggle="tooltip" data-original-title="請將各頁面之頁面關鍵字及頁面描述填入" data-placement="bottom"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
					<?php if($totalRows_RecordNews > 0 && $SEO_News >= 0){ ?>
                    <?php 
					// 計算百分比
					$BaseSEONews_Percent = floor($SEO_News/$totalRows_RecordNews*100);
					?>
                    <div class="progress" style="margin-bottom:0px;">
                            <div class="progress-bar progress-bar-warning" style="width:<?php echo $BaseSEONews_Percent; ?>%"><?php echo $SEO_News; ?>/<?php echo $totalRows_RecordNews; ?></div>
                          </div>
                     <?php } else { ?>
                     <button type="button" class="btn btn-default btn-xs btn-block">尚無資料</button>
                     <?php } ?>
                  </div>
                        <div class="col-md-2"> <a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=seo&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                      </div></li>
                      <?php } ?>
                      
                      
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6"><?php echo $ModuleName['Contact']; // 聯絡我們?>分類及MAIL設定 <a href="#" data-toggle="tooltip" data-original-title="Mail相關資訊" data-placement="top"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <?php if($totalRows_RecordContactListItem > 0 && $row_RecordSystemConfigFr['SiteMail'] && $row_RecordSystemConfigFr['SiteAuthor']) { ?>
                    <button type="button" class="btn btn-warning btn-xs btn-block">已設定</button>
                    <?php } else if($totalRows_RecordContactListItem == 0){ ?>
                    <button type="button" class="btn btn-default btn-xs btn-block">分類未設定</button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-default btn-xs btn-block">Mail資訊未填</button>
                    <?php } ?>
                  </div>
                  <?php if($totalRows_RecordContactListItem > 0 && $row_RecordSystemConfigFr['SiteMail'] && $row_RecordSystemConfigFr['SiteAuthor']) { ?>
                    <div class="col-md-2"> <a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                    <?php } else if($totalRows_RecordContactListItem == 0){ ?>
                    <div class="col-md-2"> <a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=1" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                    <?php } else { ?>
                    <div class="col-md-2"> <a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-default btn-xs btn-block">前往修改</a> </div>
                    <?php } ?>

                        
                      </div></li>
                      
                      <?php if ($row_RecordSystemConfigFr['Mobile_Enable'] == "1") {  ?>
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6">目前網站版型(PC) <a href="#" data-toggle="tooltip" data-original-title="若使用版型編號1-100為官方預設的版型，若欲修改請自行建立。" data-placement="top"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <button type="button" class="btn btn-warning btn-xs btn-block">No.<?php echo $row_RecordSystemConfigFr['MSTmpSelect'] ?><?php if($row_RecordTmpShowSlect['userid'] != $w_userid) {echo "(不可編輯)";} ?></button>
                  </div>
                        <div class="col-md-1"> 
                        <?php if($row_RecordTmpShowSlect['userid'] != $w_userid) { ?>
                        <a href="template_get.php?lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="由官方版型複製來建立自己的版型。" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">建立</a> 
                        <?php } else { ?>
                        <a href="tmp_config_<?php echo $row_RecordTmp['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordSystemConfigFr['MSTmpSelect']; ?>" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">修改</a> 
                        <?php } ?>
                        </div>
						<div class="col-md-1"> 
                        <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="替換你的網站版型。" target="_blank" class="btn btn-default btn-xs btn-block">更換</a> 
                        </div>
                      </div></li>
                      
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6">目前網站版型(行動) <a href="#" data-toggle="tooltip" data-original-title="若使用版型編號101~200為官方預設的版型，若欲修改請自行建立。" data-placement="top"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <button type="button" class="btn btn-warning btn-xs btn-block">No.<?php echo $row_RecordSystemConfigFr['MSTmpSelectRwd'] ?><?php if($row_RecordTmpShowSlectRwd['userid'] != $w_userid)  {echo "(不可編輯)";} ?></button>
                  </div>
				        
                        <div class="col-md-1"> 
                        <?php if($row_RecordTmpShowSlectRwd['userid'] != $w_userid) { ?>
                        <a href="template_get_rwd.php?lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="由官方版型複製來建立自己的版型。" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">建立</a> 
                        <?php } else { ?>
                        <a href="tmp_config_<?php echo $row_RecordTmpRWD['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordSystemConfigFr['MSTmpSelectRwd']; ?>" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">修改</a> 
                        <?php } ?>
                        </div>
						<div class="col-md-1"> 
                        <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_rwd&amp;lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="替換你的網站版型。" target="_blank" class="btn btn-default btn-xs btn-block">更換</a> 
                        </div>
						
                      </div></li>
                      <?php }  ?>
                      <?php if ($row_RecordSystemConfigFr['Mobile_Enable'] == "0") {  ?>
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6">目前網站版型(電腦和行動裝置) <a href="#" data-toggle="tooltip" data-original-title="若使用版型編號1-100為官方預設的版型，若欲修改請自行建立。" data-placement="top"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <button type="button" class="btn btn-warning btn-xs btn-block">No.<?php echo $row_RecordSystemConfigFr['MSTmpSelect'] ?><?php if($row_RecordTmpShowSlect['userid'] != $w_userid) {echo "(不可編輯)";} ?></button>
                  </div>
                        <div class="col-md-1"> 
                        <?php if($row_RecordTmpShowSlect['userid'] != $w_userid) { ?>
                        <a href="template_get.php?lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="由官方版型複製來建立自己的版型。" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">建立</a> 
                        <?php } else { ?>
                        <a href="tmp_config_<?php echo $row_RecordTmp['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordSystemConfigFr['MSTmpSelect']; ?>" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">修改</a> 
                        <?php } ?>
                        </div>
						<div class="col-md-1"> 
                        <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_b&amp;lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="替換你的網站版型。" target="_blank" class="btn btn-default btn-xs btn-block">更換</a> 
                        </div>
                      </div></li>
                      <?php }  ?>
                      <?php if ($row_RecordSystemConfigFr['Mobile_Enable'] == "2") {  ?>
                      <li class="list-group-item"><div class="row">
                        
                        <div class="col-md-6">目前網站版型(電腦和行動裝置) <a href="#" data-toggle="tooltip" data-original-title="若使用版型編號101~200為官方預設的版型，若欲修改請自行建立。" data-placement="top"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
                        <div class="col-md-4">
                    <button type="button" class="btn btn-warning btn-xs btn-block">No.<?php echo $row_RecordSystemConfigFr['MSTmpSelectRwd'] ?><?php if($row_RecordTmpShowSlectRwd['userid'] != $w_userid) {echo "(不可編輯)";} ?></button>
                  </div>
				        
                        <div class="col-md-1"> 
                        <?php if($row_RecordTmpShowSlectRwd['userid'] != $w_userid) { ?>
                        <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=changepage_rwd&amp;lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="由官方版型複製來建立自己的版型。" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">建立</a> 
                        <?php } else { ?>
                        <a href="tmp_config_<?php echo $row_RecordTmpRWD['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordSystemConfigFr['MSTmpSelectRwd']; ?>" target="_blank" class="btn btn-default btn-xs btn-block colorbox_iframe_cd">修改</a> 
                        <?php } ?>
                        </div>
						<div class="col-md-1"> 
                        <a href="template_rwd_home.php?lang=<?php echo $_SESSION['lang']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="替換你的網站版型。" target="_blank" class="btn btn-default btn-xs btn-block">更換</a> 
                        </div>
						
                      </div></li>
                      <?php }  ?>
                      
              </ul>
                 
<?php
mysqli_free_result($RecordDfType);
mysqli_free_result($RecordProduct);
mysqli_free_result($RecordNews);
mysqli_free_result($RecordContactListItem);
mysqli_free_result($RecordTmpShowSlect);
mysqli_free_result($RecordTmpShowSlectRwd);
?>