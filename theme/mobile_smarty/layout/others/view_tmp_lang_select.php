

      <?php 
						if ($_SESSION['lang'] == 'en') {
							$Lg_Dp_Show_Lang = " English"; $Lg_Dp_Show_Flag = "us";
						}elseif($_SESSION['lang'] == 'zh-cn'){
							$Lg_Dp_Show_Lang = " 简体中文"; $Lg_Dp_Show_Flag = "cn";
						}elseif($_SESSION['lang'] == 'jp'){
							$Lg_Dp_Show_Lang = " 日本語"; $Lg_Dp_Show_Flag = "jp";
						}elseif($_SESSION['lang'] == 'zh-tw'){
							$Lg_Dp_Show_Lang = " 繁體中文"; $Lg_Dp_Show_Flag = "tw";
						}elseif($_SESSION['lang'] == 'kr'){
							$Lg_Dp_Show_Lang = " 한국어"; $Lg_Dp_Show_Flag = "kr";
						}elseif($_SESSION['lang'] == 'sp'){
							$Lg_Dp_Show_Lang = " Español"; $Lg_Dp_Show_Flag = "sp";
						}
					?>
      
      <ul class="top-links list-inline pull-right" >
        <li id="Step_End"> <a href="javascript:void(0);" onclick="startIntro_All();" id="startButton"><i class="fa fa-tag fa-lg" aria-hidden="true"></i></a></li>
        
        <?php if ($OptionCartSelect == "1") { ?>
        <li id="Step_End"> <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" ><i class="fa fa-shopping-bag fa-lg" aria-hidden="true"></i></a></li>
        <?php } ?>
        
        <?php if ($OptionMemberSelect == "1") { ?>
        <li id="Step_End"> <a href="<?php echo $SiteBaseUrl . url_rewrite("member",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" ><i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></a></li>
        <?php } ?>
		
		<?php if ($row_RecordTmpConfig['tmptoplinelangshow'] == "0") { /* 0 為 下拉顯示 */ ?>
        <li> <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><img src="<?php echo $SiteBaseUrl ?>images/flags/<?php echo $Lg_Dp_Show_Flag; ?>.png" width="20" height="20" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/><?php echo $Lg_Dp_Show_Lang; ?></a>
          <ul class="dropdown-langs dropdown-menu">
            <?php if ($LangChooseZHTW == '1' && $_SESSION['lang'] != 'zh-tw') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-tw'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/tw.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 繁體中文</a></li>
            <?php } ?>
            <?php if ($LangChooseZHCN == '1' && $_SESSION['lang'] != 'zh-cn') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-cn'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/cn.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 简体中文</a></li>
            <?php } ?>
            <?php if ($LangChooseEN == '1' && $_SESSION['lang'] != 'en') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'en'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/us.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> English</a></li>
            <?php } ?>
            <?php if ($LangChooseJP == '1' && $_SESSION['lang'] != 'jp') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'jp'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/jp.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 日本語</a></li>
            <?php } ?>
            <?php if ($LangChooseKR == '1' && $_SESSION['lang'] != 'kr') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'kr'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/kr.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 한국어</a></li>
            <?php } ?>
            <?php if ($LangChooseSP == '1' && $_SESSION['lang'] != 'sp') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'sp'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/sp.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> Español</a></li>
            <?php } ?>
          </ul>
        </li>
		<?php } /* 1 為 下拉顯示 */ ?>
        
        <?php if ($row_RecordTmpConfig['tmptoplinelangshow'] == "2") { /* 2 為 橫向顯示 */ ?>
        
        <?php if ($LangChooseZHTW == '1') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-tw'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/tw.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?><?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?><?php } ?>/> 繁體中文</a></li>
            <?php } ?>
            <?php if ($LangChooseZHCN == '1') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-cn'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/cn.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 简体中文</a></li>
            <?php } ?>
            <?php if ($LangChooseEN == '1') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'en'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/us.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> English</a></li>
            <?php } ?>
            <?php if ($LangChooseJP == '1') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'jp'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/jp.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 日本語</a></li>
            <?php } ?>
            <?php if ($LangChooseKR == '1') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'kr'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/kr.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> 한국어</a></li>
            <?php } ?>
            <?php if ($LangChooseSP == '1') { ?>
            <li><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'sp'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/flags/sp.png" width="15" height="15" <?php if ($row_RecordTmpConfig['tmptoplinelangicon'] == "0") { ?>style="display:none;"<?php } ?>/> Español</a></li>
            <?php } ?>
            
        <?php } /* 0 為 下拉顯示 */ ?>
        
        <?php if (isset($totalRows_RecordUserAccount) && $totalRows_RecordUserAccount > 0) { ?>
        <li><a href="<?php echo $SiteBaseUrl ?>admin/index.php"><img src="<?php echo $SiteBaseUrl ?>images/st.png" width="20" height="20" /></a></li>
        <?php } ?>
      </ul>
