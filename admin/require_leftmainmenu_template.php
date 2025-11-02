
<ul class="nav">
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?> 
	<!--<li><a>區塊</a>
    	<ul>
            <li><a href="manage_template.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">區塊一覽</a></li>
			
            <li><a href="manage_template.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">新增區塊</a></li> 
        </ul>
    </li>-->
<?php } ?> 
    <li class="has-sub"><a href="javascript:;" data-original-title="網頁版型的設定及設定網頁的外觀" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-th-large"></i><span>樣板</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看目前所有的版型" data-toggle="tooltip" data-placement="right">樣板一覽</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=selectpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="選擇目前網站的版型" data-toggle="tooltip" data-placement="right">樣板套用</a></li>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?> 
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新版型，此選項需從頭開始設計，必須對各個區塊做設定調整，若需設定參考，建議一開始可由下方的複製樣版來開始熟悉。" data-toggle="tooltip" data-placement="right">新增樣板</a></li>
            <?php } ?> 
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=getpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="由官方版型複製來建立自己的版型，此選項可由所複製的版型修改設計較易上手。" data-toggle="tooltip" data-placement="right">複製樣板</a></li>
            <!--<li><a href="template_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_cd" data-original-title="更換您目前網頁所要使用的版型" data-toggle="tooltip" data-placement="right">樣板套用</a></li> -->
            <!--<li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_step_map&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可以依著步驟點選連結來建立您的樣板" data-toggle="tooltip" data-placement="right">步驟地圖</a></li>--> 
            </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="Logo的設定" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fab fa-adn"></i><span>Logo</span></a>
      <ul class="sub-menu">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=logoviewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看目前所有Logo" data-toggle="tooltip" data-placement="right">Logo一覽</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=logoaddpage_s&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新Logo" data-toggle="tooltip" data-placement="right">新增Logo</a></li>
            <li><a href="manage_logo.php?wshop=<?php echo $wshop;?>&amp;Opt=step_map&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="更換目前網頁Logo" data-toggle="tooltip" data-placement="right">Logo指定</a></li> 
            </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="網頁的上方主選單設定" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-bars"></i><span>主選單</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpmainmenu&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看網頁的主選單樣式" data-toggle="tooltip" data-placement="right">主選單一覽</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpaddmainmenu&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新主選單" data-toggle="tooltip" data-placement="right">新增主選單</a></li>
        </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="網頁各個區塊的背景設定" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-industry"></i><span>區塊背景</span></a>
    	<ul class="sub-menu">
            
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看目前所有區塊背景" data-toggle="tooltip" data-placement="right">整站背景</a></li>
            <li class="has-sub expand"><a href="javascript:;" data-original-title="依各個區塊的背景來查看" data-toggle="tooltip" data-placement="right"><b class="caret"></b><span>區塊背景分類</span></a>
            <ul class="sub-menu" style="display:block">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;outwrp=1" data-original-title="查看網頁主架構外的背景樣式，為整個頁面的底圖設定，通常以素色、簡單為主" data-toggle="tooltip" data-placement="right">外框架</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;outwrpsp=1" data-original-title="查看網頁主架構外的背景樣式，用以增添下層圖層的質感，此區適合放置不會覆蓋下層圖層之背景圖片。" data-toggle="tooltip" data-placement="right">外框架(裝飾圖層)</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;wrp=1" data-original-title="查看網頁主架構的背景樣式，此區塊裡面會放置所有網頁的內容，同時也包含所有的區塊" data-toggle="tooltip" data-placement="right">主框架</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;hd=1" data-original-title="查看網頁上方區塊的背景樣式，此區塊會放置主選單、Logo" data-toggle="tooltip" data-placement="right">頁首區塊</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;col=1" data-original-title="查看網頁左方欄位區塊的背景樣式，此區塊會放置左選單、Facebook紛絲專欄等..." data-toggle="tooltip" data-placement="right">欄位區塊</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;mid=1" data-original-title="查看網頁中央區塊的背景樣式，此區塊會放置主要網頁內容" data-toggle="tooltip" data-placement="right">中央區塊</a></li>
             <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;foot=1" data-original-title="查看網頁頁尾區塊的背景樣式，此區塊會放置公司相關資訊" data-toggle="tooltip" data-placement="right">頁尾區塊</a></li>
              <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;icon=1" data-original-title="查看網頁中央區塊之標題前方的小圖" data-toggle="tooltip" data-placement="right">標題小圖示</a></li>
               <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpbk&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tl=1" data-original-title="查看網頁中央區塊之標題的背景樣式" data-toggle="tooltip" data-placement="right">標題背景</a></li>
               </ul></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpaddbk&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新背景，並選擇此背景適用於哪個區塊中" data-toggle="tooltip" data-placement="right">新增背景</a></li>
            <!--<li><a href="tmpbackground_home.php?lang=<?php echo $_SESSION['lang']; ?>" class="colorbox_iframe_cd" data-original-title="更換您目前網頁所要使用的版型" data-toggle="tooltip" data-placement="right">背景指定</a></li> -->
        </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="網頁各個區塊外圍樣式" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="far fa-square"></i><span>區塊外框</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpboard&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看網頁主框架、中央區塊及中央區塊內之標題區塊的樣式" data-toggle="tooltip" data-placement="right">外框一覽</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpaddboard&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新外框" data-toggle="tooltip" data-placement="right">新增外框</a></li>
        </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="網頁左方欄位區塊的樣式" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-list-alt"></i><span>側邊裝飾外框</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpblock&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看網頁的側邊裝飾外框樣式，此樣式會依各個功能來做區分，每個功能皆會有一個樣式，例如左方欄位放置了左選單，Facebook粉絲頁連結等，則每個功能視為一個區塊，各會帶入您的樣式" data-toggle="tooltip" data-placement="right">側邊裝飾外框一覽</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpaddblock&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新側邊裝飾外框" data-toggle="tooltip" data-placement="right">新增側邊裝飾外框</a></li>
        </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="網頁左方欄位區塊中的選單樣式" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-th-list"></i><span>側邊選單</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpleftmenu&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看網頁的側邊選單樣式" data-toggle="tooltip" data-placement="right">側邊選單一覽</a></li>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpaddleftmenu&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立側邊選單樣式" data-toggle="tooltip" data-placement="right">新增側邊選單</a></li>
        </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="此功能可更加豐富您的左邊的欄位區塊，例如選擇是否要加入左選單、連結等等...亦或是透過編輯空白的欄位區塊加上YouTube、時鐘、年曆、廣告，類似於部落格新增欄位的功能，網路上更有許多寫好的程式碼可供使用，可搜索《部落格小玩意》。" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-list"></i><span>自訂欄位</span></a>
    	<ul class="sub-menu">
            <?php if ($Shop3500_Limit_Mod != "Shop3500_Blog") {?>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定網頁欄位區塊所要放置的功能" data-toggle="tooltip" data-placement="right">欄位設定</a></li> 
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $Tmp_Column_Plus_Limit == '1') { ?>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolumn_plus&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定網頁欄位(+)區塊所要放置的功能" data-toggle="tooltip" data-placement="right">欄位設定(+)</a></li> 
            <?php } ?> 
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_column_step_map&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可以依著步驟點選連結來建立您的欄位" data-toggle="tooltip" data-placement="right">步驟地圖</a></li>
			<?php } ?> 
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionBlogSelect == '1') { ?>
            <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpblogcolumn&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定網頁左邊欄位區塊所要放置的功能(部落格)" data-toggle="tooltip" data-placement="right">欄位設定(Blog)</a></li>
            <?php } ?>
        </ul>
    </li>
	<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
    <li class="has-sub"><a href="javascript:;"><b class="caret"></b><i class="fa fa-cog"></i><span>設定</span></a>
    	<ul class="sub-menu">
           <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="您可在此新增下拉選單的內容，例如：類別、發布者等項目的清單。" data-toggle="tooltip" data-placement="right">次分類設定</a></li>
           <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpcolorget&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">圖片顏色抓取</a></li>
           <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpmainmenu_c&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">主選單顏色搜尋</a></li>
               
           <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=configpage&amp;lang=<?php echo $_SESSION['lang']; ?>">後台參數設定</a></li>
           	   
         </ul>
    </li>           
     <?php } ?> 
     <li class="has-sub"><a href="javascript:;"><b class="caret"></b><i class="fa fa-mobile-alt"></i><span>行動裝置外觀</span></a>
    	<ul class="sub-menu">
           <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_mobile_config&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">參數設定</a></li>
           <!--<li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmp_mobile&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">自訂外觀</a></li>-->
           	   
         </ul>
    </li>      
    <li><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=tmpagree&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="使用條款同意聲明" data-toggle="tooltip" data-placement="right"><i class="fa fa-book"></i><span>同意聲明</span></a></li>  
            
</ul>
