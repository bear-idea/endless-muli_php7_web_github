<div class="collapse navbar-collapse pull-left" id="top-navbar">
      <ul class="nav navbar-nav">
        <li class="dropdown"><a href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><strong><i class="fa fa-home fa-fw"></i> 回後台首頁</strong></a></li>
        <li class="dropdown"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-database fa-fw"></i> 網站管理 <b class="caret"></b> </a>
        <ul class="dropdown-menu" role="menu">
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAboutSelect == '1') { ?>
							<li><a href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['About'] //關於我們 ?></span></a>
						  </li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionNewsSelect == '1') { ?>
							<li><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['News'] //最新訊息 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionLettersSelect == '1') { ?>
							<li><a href="manage_letters.php?wshop=<?php echo $wshop;?>&amp;Opt_Letters=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Letters'] //新聞快報 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionActnewsSelect == '1') { ?>
							<li><a href="manage_actnews.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Actnews'] //活動快訊 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProjectSelect == '1') { ?>
							<li><a href="manage_project.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Project'] //工程實績 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionProductSelect == '1') { ?>
							<li><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Product'] //產品維護 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionKnowledgeSelect == '1') { ?>
							<li><a href="manage_knowledge.php?wshop=<?php echo $wshop;?>&amp;Opt_Knowledge=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Knowledge'] //知識學習 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionArticleSelect == '1') { ?>
							<li><a href="manage_article.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Article'] //文章管理 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCartSelect == '1') { ?>
							<li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Cart'] //購物車管理 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMeetingSelect == '1') { ?>
							<li><a href="manage_meeting.php?wshop=<?php echo $wshop;?>&amp;Opt_Meeting=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Meeting'] //會議紀錄 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDonationSelect == '1') { ?>
							<li><a href="manage_donation.php?wshop=<?php echo $wshop;?>&amp;Opt_Donation=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Donation'] //捐款名錄 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCatalogSelect == '1') { ?>
							<li><a href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Catalog'] //型錄下載 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAlbumSelect == '1') { ?>
							<li><a href="manage_album.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Album'] //相簿展示 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTicketsSelect == '1') { ?>
							<li><a href="manage_tickets.php?wshop=<?php echo $wshop;?>&amp;Opt_Tickets=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><strong>訂票系統</strong></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionOrgSelect == '1') { ?>
							<li><a href="manage_org.php?wshop=<?php echo $wshop;?>&amp;Opt_Org=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Org'] //組織成員 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionEPaperSelect == '1') { ?>
							<li><a href="manage_epaper.php?wshop=<?php echo $wshop;?>&amp;Opt_EPaper=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['EPaper'] //電子期刊 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionVideoSelect == '1') { ?>
							<li><a href="manage_video.php?wshop=<?php echo $wshop;?>&amp;Opt_Video=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Video'] // 影片共享 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMemberSelect == '1') { ?>
							<li><a href="manage_member.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Member'] //會員管理 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionSponsorSelect == '1') { ?>
							<li><a href="manage_sponsor.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Sponsor'] //贊助企業 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionCareersSelect == '1') { ?>
							<li><a href="manage_careers.php?wshop=<?php echo $wshop;?>&amp;Opt_Careers=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Careers'] //求職徵才 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionGuestbookSelect == '1') { ?>
							<li><a href="manage_guestbook.php?wshop=<?php echo $wshop;?>&amp;Opt_Guestbook=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Guestbook'] //留言管理 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionActivitiesSelect == '1') { ?>
							<li><a href="manage_activities.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Activities'] //活動花絮 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionWebSiteSelect == '1') { ?>
							<li><a href="manage_website.php?wshop=<?php echo $wshop;?>&amp;Opt_WebSite=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><strong>網站資訊</strong></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionForumSelect == '1') { ?>
							<li><a href="manage_forum.php?wshop=<?php echo $wshop;?>&amp;Opt_Forum=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Forum'] //討論專區 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionContactSelect == '1') { ?>
							<li><a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Contact'] //聯絡我們 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionDfPageSelect == '1') { ?>
							<li><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=typepage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>自訂頁面</span></a>
							</li>
							<?php } ?>
					  </ul>
        </li>
        <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionTmpSelect == '1') { ?>
        <li> <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"> <i class="fa fa-gem fa-fw"></i> 版型設計 </a> </li>
        <?php } ?>
        <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPublishSelect == '1' || $OptionOtrlinkSelect == '1' || $OptionFaqSelect == '1' || $OptionAdsSelect == '1') { ?>
        <li class="dropdown"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cube fa-fw"></i> 擴充功能 <b class="caret"></b> </a>
        <ul class="dropdown-menu" role="menu">
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPublishSelect == '1') { ?>
							<li><a href="manage_publish.php?wshop=<?php echo $wshop;?>&amp;Opt_Publish=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Publish'] //公布資訊 ?></span></a>
						  </li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionOtrlinkSelect == '1') { ?>
							<li><a href="manage_frilink.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Frilink'] //友站連結 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionOtrlinkSelect == '1') { ?>
							<li><a href="manage_otrlink.php?wshop=<?php echo $wshop;?>&amp;Opt_Otrlink=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Otrlink'] //相關連結 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFaqSelect == '1') { ?>
							<li><a href="manage_faq.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Faq'] //常見問答 ?></span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAdsSelect == '1') { ?>
							<li><a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>輪播系統</span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionPartantSelect == '1') { ?>
							<li><a href="manage_partner.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span><?php echo $ModuleName['Partner'] //合作夥伴 ?></span></a>
							</li>
							<?php } ?>
					  </ul>
        </li>
        <?php } ?>
        <li class="dropdown"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-archive fa-fw"></i> 工具 <b class="caret"></b> </a>
        <ul class="dropdown-menu" role="menu">
				<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionFileMangSelect == '1') { ?>
							<li><a onclick="openKCFinder(this)"><span style="cursor: pointer;">檔案管理</span></a>
						  </li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
							<li><a href="calendar/index.php" class="colorbox_iframe_cd" title="備忘記事"><span>備忘記事</span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionAnalysisSelect == '1') { ?>
							<li><a href="manage_analysis.php?wshop=<?php echo $wshop;?>&amp;Opt_Analysis=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>統計資料</span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
							<li><a href="manage_proverb.php?wshop=<?php echo $wshop;?>&amp;Opt_Proverb=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>諺語管理</span></a>
							</li>
							<?php } ?>
					  </ul>
        </li>
        <li class="dropdown"> <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cogs fa-fw"></i> 設定 <b class="caret"></b> </a>
        <ul class="dropdown-menu" role="menu">
				<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
							<li><a href="manage_systemconfig.php?wshop=<?php echo $wshop;?>&amp;Opt_SystemConfig=settingpage_fr&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>系統設定</span></a>
						  </li><li class="divider"></li>
							<li><a href="manage_systemconfig.php?wshop=<?php echo $wshop;?>&amp;Opt_SystemConfig=ms&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>功能選擇</span></a>
							</li><li class="divider"></li>
							<?php } ?>
							<li><a href="manage_config.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_ap&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>基本設定</span></a>
							</li><li class="divider"></li>
							<li><a href="manage_keyword.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage_ky&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>關鍵字設定</span></a>
							</li><li class="divider"></li>
							<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
							<li><a href="manage_config.php?wshop=<?php echo $wshop;?>&amp;Opt=configpage_list&amp;lang=<?php echo $_SESSION['lang']; ?>"><span>功能分類清單</span></a>
							</li><li class="divider"></li>

							<li><a href="#"><span>權限管理[Building...]</span></a>
							</li>
							<?php }?>
					  </ul>
        </li>
        <li class="dropdown"><a href="<?php echo $logoutAction ?>"><strong><i class="fa fa-sign-out-alt fa-fw"></i> 登出</strong></a></li>
     </ul>
</div>
<script type="text/javascript">
	function openKCFinder( textarea ) {
		window.KCFinder = {
			callBackMultiple: function ( files ) {
				window.KCFinder = null;
				textarea.value = "";
				for ( var i = 0; i < files.length; i++ )
					textarea.value += files[ i ] + "\n";
			}
		};
		window.open( '../ckeditor/kcfinder/browse.php?type=images',
			'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
			'directories=0, resizable=1, scrollbars=0, width=800, height=600'
		);
	}
</script>
<?php //echo $_SESSION['lang']; ?>