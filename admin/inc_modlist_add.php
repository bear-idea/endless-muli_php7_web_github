         <?php
			switch($row_RecordModList['itemvalue'])
			{
				case "News":  // -------------------------------------------------
         ?>
         <?php if ($OptionNewsSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_001.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php
					break;
				case "Picasa":  // -------------------------------------------------
		 ?>
         <?php if ($OptionPicasaSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_052.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "About":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAboutSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_041.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;
				case "Timeline":  // -------------------------------------------------
		 ?>
         <?php if ($OptionTimelineSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_057.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;
				case "Imageshow":  // -------------------------------------------------
		 ?>
         <?php if ($OptionImageshowSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_058.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Product":  // -------------------------------------------------
		 ?>
         <?php if ($OptionProductSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_002.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Cart":  // -------------------------------------------------
		 ?>
         <?php if ($OptionCartSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_036.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Guestbook":  // -------------------------------------------------
		 ?>
         <?php if ($OptionGuestbookSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_007.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Activities":  // -------------------------------------------------
		 ?>
         <?php if ($OptionActivitiesSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_014.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Project":  // -------------------------------------------------
		 ?>
         <?php if ($OptionProjectSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_032.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Album":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAlbumSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_012.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Frilink":  // -------------------------------------------------
		 ?>
         <?php if ($OptionFrilinkSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_006.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Otrlink":  // -------------------------------------------------
		 ?>
         <?php if ($OptionOtrlinkSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_051.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Sponsor":  // -------------------------------------------------
		 ?>
         <?php if ($OptionSponsorSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_011.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Publish":  // -------------------------------------------------
		 ?>
         <?php if ($OptionPublishSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_003.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Letters":  // -------------------------------------------------
		 ?>
         <?php if ($OptionLettersSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_020.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Meeting":  // -------------------------------------------------
		 ?>
         <?php if ($OptionMeetingSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_009.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Donation":  // -------------------------------------------------
		 ?>
         <?php if ($OptionDonationSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_015.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Org":  // -------------------------------------------------
		 ?>
         <?php if ($OptionOrgSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_017.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Member":  // -------------------------------------------------
		 ?>
         <?php if ($OptionMemberSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_013.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "Careers":  // -------------------------------------------------
		 ?>
         <?php if ($OptionCareersSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_016.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Actnews":  // -------------------------------------------------
		 ?>
         <?php if ($OptionActnewsSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_021.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Faq":  // -------------------------------------------------
		 ?>
         <?php if ($OptionFaqSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_024.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>

		 <?php		
					break;	
				case "Catalog":  // -------------------------------------------------
		 ?>
         <?php if ($OptionCatalogSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_033.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Forum":  // -------------------------------------------------
		 ?>
         <?php if ($OptionForumSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_029.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Contact":  // -------------------------------------------------
		 ?>
         <?php if ($OptionContactSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_040.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Stronghold":  // -------------------------------------------------
		 ?>
         <?php if ($OptionStrongholdSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_059.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Blog":  // -------------------------------------------------
		 ?>
         <?php if ($OptionBlogSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_047.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Album":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAlbumSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_012.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "MailSend":  // -------------------------------------------------
		 ?>
         <?php if ($OptionMailSendSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_005.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "Knowledge":  // -------------------------------------------------
		 ?>
         <?php if ($OptionKnowledgeSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_031.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "EPaper":  // -------------------------------------------------
		 ?>
         <?php if ($OptionEPaperSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_022.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Partner":  // -------------------------------------------------
		 ?>
         <?php if ($OptionPartnerSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_026.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;
				case "AD":  // -------------------------------------------------
		 ?>
         <?php if (@$OptionADSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_025.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		;
					break;	
				case "Video":  // -------------------------------------------------
		 ?>
         <?php if ($OptionVideoSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_010.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "Artlist":  // -------------------------------------------------
		 ?>
         <?php if ($OptionArtlistSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_027.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Article":  // -------------------------------------------------
		 ?>
         <?php if ($OptionArticleSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_008.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Room":  // -------------------------------------------------
		 ?>
         <?php if ($OptionRoomSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_067.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Attractions":  // -------------------------------------------------
		 ?>
         <?php if ($OptionAttractionsSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_068.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
         <?php		
					break;	
				case "Dealer":  // -------------------------------------------------
		 ?>
         <?php if ($OptionDealerSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_077.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" />
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
					break;	
				case "DfPage":  // -------------------------------------------------
		 ?>
        <?php if ($OptionDfPageSelect == '1') {?>
         <div class="mod_board col-md-2 col-sm-3 col-xs-4"><div class="mod_pic"><img src="images/mt_043.png" width="60" height="60" /></div>
         <div class="mod_text">
         <div class="radio radio-css radio-inline">
              <input  type="radio" name="typemenu" value="<?php echo $row_RecordModList['itemvalue'] ?>" id="typemenu_<?php echo $i ?>" checked="checked"/>
              <label for="typemenu_<?php echo $i ?>"><?php echo $row_RecordModList['customname']; ?></label>
         </div>
         </div>
         </div>
         <?php } ?>
		 <?php		
				default:
					break;
			}
		?> 