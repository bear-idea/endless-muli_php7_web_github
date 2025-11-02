<?php if ($MSTMP == 'userdefault') { ?>
<style type="text/css">
body{
	<?php //if($TmpBodySelect == '0') { // 共用 ?> 
	/*background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpBgWebName; ?>/image/tmpbackground/<?php echo $TmpBgImage; ?>);
	background-attachment: <?php echo $TmpBgAttachment; ?>;	
	background-repeat: <?php echo $TmpBgRepeat; ?>;
	background-position: <?php echo $TmpBgPosition; ?>;
	background-color: <?php echo $TmpBgColor; ?>;*/
	<?php //} else if ($TmpBodySelect == '1') { // 獨立 ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpBodyWebName; ?>/image/tmpbackground/<?php echo $TmpBodyBgImage; ?>);
	background-attachment: <?php echo $TmpBodyBgAttachment; ?>;	
	background-repeat: <?php echo $TmpBodyBgRepeat; ?>;
	background-position: <?php echo $TmpBodyBgPosition; ?>;
	background-color: <?php echo $TmpBodyBgColor; ?>;
	<?php //} ?>
	font-size: <?php echo $TmpWordSize; ?>;
	color: <?php echo $TmpWordColor; ?>;	
}

a:link {
	color: <?php echo $TmpLink; ?>;
}
a:visited {
	color: <?php echo $TmpLinkVisit; ?>;
}
a:hover {
	color: <?php echo $TmpLinkHover; ?>;
}

#Middle_Wrapper{
	width:<?php echo ($TmpWebWidth + $Tmp_Wrp_R_M_Width + $Tmp_Wrp_L_M_Width) .  $TmpWebWidthUnit; ?>;
}

#logo{
	margin-top: <?php echo $TmpLogoMarginTop; ?>px;
	margin-left: <?php echo $TmpLogoMarginLeft; ?>px;
	height: <?php echo $TmpLogoHeight; ?>px;
	width: <?php echo $TmpLogoWidth; ?>px;
}
#Homelogo{
	margin-top: <?php echo $TmpHomeLogoMarginTop; ?>px;
	margin-left: <?php echo $TmpHomeLogoMarginLeft; ?>px;
	height: <?php echo $TmpHomeLogoHeight; ?>px;
	width: <?php echo $TmpHomeLogoWidth; ?>px;
}

#wrapper{
	width:<?php echo $TmpWebWidth .  $TmpWebWidthUnit; ?>;
}
<?php if ($totalRows_RecordTmpWrpBg > 0) {  ?>
#wrapper {
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpWrpBgWebName; ?>/image/tmpbackground/<?php echo $TmpWrpBgImage; ?>);
	background-repeat: <?php echo $TmpWrpBgRepeat; ?>;
	background-position: <?php echo $TmpWrpBgPosition; ?>;
	background-color: <?php echo $TmpWrpBgColor; ?>;
}
<?php }  ?>
<?php if ($totalRows_RecordTmpAnimeBg > 0) {  ?>
/*動態背景圖層*/
#Bk_Anime_Wrapper {
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpAnimeBgWebName; ?>/image/tmpbackground/<?php echo $TmpAnimeBgImage; ?>);	
	background-repeat: <?php echo $TmpAnimeBgRepeat; ?>;
	background-position: <?php echo $TmpAnimeBgPosition; ?>;
	background-color: <?php echo $TmpAnimeBgColor; ?>;
	background-attachment: <?php echo $TmpAnimeBgAttachment; ?>;
}
<?php }  ?>
<?php if ($totalRows_RecordTmpBottomBg > 0) {  ?>
/*背景圖層*/
#Bk_Bottom_Wrapper {
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpBottomBgWebName; ?>/image/tmpbackground/<?php echo $TmpBottomBgImage; ?>);	
	background-repeat: <?php echo $TmpBottomBgRepeat; ?>;
	background-position: <?php echo $TmpBottomBgPosition; ?>;
	background-color: <?php echo $TmpBottomBgColor; ?>;
	background-attachment: <?php echo $TmpBottomBgAttachment; ?>;
}
<?php }  ?>
<?php if ($totalRows_RecordTmpHomeAnimeBg > 0) {  ?>
/*Home動態背景圖層*/
#Bk_Home_Anime_Wrapper {
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpHomeAnimeBgWebName; ?>/image/tmpbackground/<?php echo $TmpHomeAnimeBgImage; ?>);	
	background-repeat: <?php echo $TmpHomeAnimeBgRepeat; ?>;
	background-position: <?php echo $TmpHomeAnimeBgPosition; ?>;
	background-color: <?php echo $TmpHomeAnimeBgColor; ?>;
	background-attachment: <?php echo $TmpHomeAnimeBgAttachment; ?>;
}
<?php }  ?>
<?php if ($totalRows_RecordTmpHomeBottomBg > 0) {  ?>
/*Home背景圖層*/
#Bk_Home_Bottom_Wrapper {
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpHomeBottomBgWebName; ?>/image/tmpbackground/<?php echo $TmpHomeBottomBgImage; ?>);	
	background-repeat: <?php echo $TmpHomeBottomBgRepeat; ?>;
	background-position: <?php echo $TmpHomeBottomBgPosition; ?>;
	background-color: <?php echo $TmpHomeBottomBgColor; ?>;
	background-attachment: <?php echo $TmpHomeBottomBgAttachment; ?>;
}
<?php }  ?>
#wrapper #header #context{
	<?php if ($totalRows_RecordTmpHeaderBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpHeaderBgWebName; ?>/image/tmpbackground/<?php echo $TmpHeaderBgImage; ?>);	
	background-repeat: <?php echo $TmpHeaderBgRepeat; ?>;
	background-position: <?php echo $TmpHeaderBgPosition; ?>;
	background-color: <?php echo $TmpHeaderBgColor; ?>;
	<?php }  ?>
	<?php if ($TmpHeaderMinHeight != '') { ?>
	min-height: <?php echo $TmpHeaderMinHeight; ?>px;
	<?php }  ?>
	padding: <?php echo $TmpHeaderPaddingTop; ?>px <?php echo $TmpHeaderPaddingRight; ?>px <?php echo $TmpHeaderPaddingBottom; ?>px <?php echo $TmpHeaderPaddingLeft; ?>px;
}
#wrapper #banner #context{
	padding: <?php echo $TmpBannerPaddingTop; ?>px <?php echo $TmpBannerPaddingRight; ?>px <?php echo $TmpBannerPaddingBottom; ?>px <?php echo $TmpBannerPaddingLeft; ?>px;
}
#wrapper #Left_column #context{
	<?php if ($totalRows_RecordTmpLeftBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpLeftBgWebName; ?>/image/tmpbackground/<?php echo $TmpLeftBgImage; ?>);	
	background-repeat: <?php echo $TmpLeftBgRepeat; ?>;
	background-position: <?php echo $TmpLeftBgPosition; ?>;
	background-color: <?php echo $TmpLeftBgColor; ?>;
	<?php }  ?>
	<?php if ($TmpLeftMinHeight != '') { ?>
	min-height: <?php echo $TmpLeftMinHeight; ?>px;
	<?php }  ?>
	padding: <?php echo $TmpLeftPaddingTop; ?>px <?php echo $TmpLeftPaddingRight; ?>px <?php echo $TmpLeftPaddingBottom; ?>px <?php echo $TmpLeftPaddingLeft; ?>px;
}
#wrapper #Content_containter #Main_content #context {
	<?php if ($totalRows_RecordTmpMiddleBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMiddleBgWebName; ?>/image/tmpbackground/<?php echo $TmpMiddleBgImage; ?>);
	background-repeat: <?php echo $TmpMiddleBgRepeat; ?>;
	background-position: <?php echo $TmpMiddleBgPosition; ?>;
	background-color: <?php echo $TmpMiddleBgColor; ?>;
	<?php }  ?>
	min-height: <?php echo $TmpMiddleMinHeight; ?>px;
	padding: <?php echo $TmpMiddlePaddingTop; ?>px <?php echo $TmpMiddlePaddingRight; ?>px <?php echo $TmpMiddlePaddingBottom; ?>px <?php echo $TmpMiddlePaddingLeft; ?>px;
}
#wrapper #Content_containter #Rght_column #context{
	<?php if ($totalRows_RecordTmpRightBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpRightBgWebName; ?>/image/tmpbackground/<?php echo $TmpRightBgImage; ?>);	
	background-repeat: <?php echo $TmpRightBgRepeat; ?>;
	background-position: <?php echo $TmpRightBgPosition; ?>;
	background-color: <?php echo $TmpRightBgColor; ?>;
	<?php }  ?>
	min-height: <?php echo $TmpRightMinHeight; ?>px;
	padding: <?php echo $TmpRightPaddingTop; ?>px <?php echo $TmpRightPaddingRight; ?>px <?php echo $TmpRightPaddingBottom; ?>px <?php echo $TmpRightPaddingLeft; ?>px;
}
#wrapper #footer #context{
	<?php if ($totalRows_RecordTmpFooterBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpFooterBgWebName; ?>/image/tmpbackground/<?php echo $TmpFooterBgImage; ?>);	
	background-repeat: <?php echo $TmpFooterBgRepeat; ?>;
	background-position: <?php echo $TmpFooterBgPosition; ?>;
	background-color: <?php echo $TmpFooterBgColor; ?>;
	<?php }  ?>
	color: <?php echo $TmpFooterFontColor; ?>;
	min-height: <?php echo $TmpFooterMinHeight; ?>px;
	padding: <?php echo $TmpFooterPaddingTop; ?>px <?php echo $TmpFooterPaddingRight; ?>px <?php echo $TmpFooterPaddingBottom; ?>px <?php echo $TmpFooterPaddingLeft; ?>px;
}
#wrapper #Content_containter #Main_content #context .titlesicon{
	height:100%; 
	display:inline-block;
}

#wrapper #Content_containter #Main_content #context .titlesicon img{
	max-width: 50px;
	display:inline-block;
	padding-bottom: 2px;
}

#Main_Wrapper #Middle_Wrapper {
}

#Main_Wrapper #Left_Background {
}

#Main_Wrapper #Right_Background {

}

/* 九宮格外框樣式 */
<?php if ($totalRows_RecordTmpWrpBoard > 0) {  ?>
/* 整體 */
div.WrpBoardStyle{/* 大外框 */
	color: <?php echo $Tmp_Wrp_W_Font_Color; ?>;
	background-color: <?php echo $Tmp_Wrp_W_Background_Color; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_W_Background_Img; ?>);
	background-repeat: no-repeat;
	margin: <?php echo $Tmp_Wrp_W_Marge_Top; ?>px <?php echo $Tmp_Wrp_W_Marge_Left; ?>px <?php echo $Tmp_Wrp_W_Marge_Bottom; ?>px <?php echo $Tmp_Wrp_W_Marge_Right; ?>px;
	padding: <?php echo $Tmp_Wrp_W_Padding_Top; ?>px <?php echo $Tmp_Wrp_W_Padding_Left; ?>px <?php echo $Tmp_Wrp_W_Padding_Bottom; ?>px <?php echo $Tmp_Wrp_W_Padding_Right; ?>px;
	border: <?php echo $Tmp_Wrp_W_Board_Width; ?>px <?php echo $Tmp_Wrp_W_Board_Style; ?> <?php echo $Tmp_Wrp_W_Board_Color; ?>;
	-webkit-border-radius: <?php echo $Tmp_Wrp_BorderRadius_T_L; ?>px <?php echo $Tmp_Wrp_BorderRadius_T_R; ?>px <?php echo $Tmp_Wrp_BorderRadius_B_R; ?>px <?php echo $Tmp_Wrp_BorderRadius_B_L; ?>px;
	-moz-border-radius: <?php echo $Tmp_Wrp_BorderRadius_T_L; ?>px <?php echo $Tmp_Wrp_BorderRadius_T_R; ?>px <?php echo $Tmp_Wrp_BorderRadius_B_R; ?>px <?php echo $Tmp_Wrp_BorderRadius_B_L; ?>px;
	border-radius: <?php echo $Tmp_Wrp_BorderRadius_T_L; ?>px <?php echo $Tmp_Wrp_BorderRadius_T_R; ?>px <?php echo $Tmp_Wrp_BorderRadius_B_R; ?>px <?php echo $Tmp_Wrp_BorderRadius_B_L; ?>px;
	-webkit-box-shadow: <?php echo $Tmp_Wrp_BoxShadow_X; ?>px <?php echo $Tmp_Wrp_BoxShadow_Y; ?>px <?php echo $Tmp_Wrp_BoxShadow_Size; ?>px <?php echo $Tmp_Wrp_BoxShadow_Color; ?>;
	-moz-box-shadow: <?php echo $Tmp_Wrp_BoxShadow_X; ?>px <?php echo $Tmp_Wrp_BoxShadow_Y; ?>px <?php echo $Tmp_Wrp_BoxShadow_Size; ?>px <?php echo $Tmp_Wrp_BoxShadow_Color; ?>;
	box-shadow: <?php echo $Tmp_Wrp_BoxShadow_X; ?>px <?php echo $Tmp_Wrp_BoxShadow_Y; ?>px <?php echo $Tmp_Wrp_BoxShadow_Size; ?>px <?php echo $Tmp_Wrp_BoxShadow_Color; ?>;
	<?php if($Tmp_Wrp_LinearGradient_Top != '' || $Tmp_Wrp_LinearGradient_Bottom != '') { ?>
	background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>), to(<?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>));
	background: -webkit-linear-gradient(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>, <?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>);
	background: -moz-linear-gradient(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>, <?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>);
	background: -ms-linear-gradient(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>, <?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>);
	background: -o-linear-gradient(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>, <?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>);
	background: linear-gradient(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>, <?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>);
	-pie-background: linear-gradient(<?php echo $Tmp_Wrp_LinearGradient_Top; ?>, <?php echo $Tmp_Wrp_LinearGradient_Bottom; ?>);
	<?php } ?>
	behavior: url(http://easy.fullvision.net/PIE.htc);
}
div.WrpBoardStyle .mdl_t{}/* 上半部 */
div.WrpBoardStyle .mdl_t_l{
	width:<?php echo $Tmp_Wrp_L_T_Width; ?>px;
	height:<?php echo $Tmp_Wrp_L_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_L_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_L_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.WrpBoardStyle .mdl_t_c{
	height:<?php echo $Tmp_Wrp_M_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_M_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_M_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Wrp_R_T_Width; ?>px 0px <?php echo $Tmp_Wrp_L_T_Width; ?>px;
}
div.WrpBoardStyle .mdl_t_r{
	width:<?php echo $Tmp_Wrp_R_T_Width; ?>px;
	height:<?php echo $Tmp_Wrp_R_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_R_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_R_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.WrpBoardStyle .mdl_t_m{} /* 中央 */
div.WrpBoardStyle .mdl_c_l{
	width:<?php echo $Tmp_Wrp_L_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_L_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_L_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.WrpBoardStyle .mdl_c_c{
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_M_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_M_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Wrp_R_M_Width; ?>px 0px <?php echo $Tmp_Wrp_L_M_Width; ?>px;
}
div.WrpBoardStyle .mdl_c_r{
	width:<?php echo $Tmp_Wrp_R_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_R_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_R_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.WrpBoardStyle .mdl_b{} /* 下半部 */
div.WrpBoardStyle .mdl_b_l{
    width:<?php echo $Tmp_Wrp_L_B_Width; ?>px;
	height:<?php echo $Tmp_Wrp_L_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_L_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_L_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.WrpBoardStyle .mdl_b_c{
	height:<?php echo $Tmp_Wrp_M_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_M_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_M_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Wrp_R_B_Width; ?>px 0px <?php echo $Tmp_Wrp_L_B_Width; ?>px;
}
div.WrpBoardStyle .mdl_b_r{
	width:<?php echo $Tmp_Wrp_R_B_Width; ?>px;
	height:<?php echo $Tmp_Wrp_R_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Wrp_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Wrp_R_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Wrp_R_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php }  ?>
<?php if ($totalRows_RecordTmpBannerBoard > 0) {  ?>
/* 橫幅 */
div.BannerBoardStyle{/* 大外框 */
	color: <?php echo $Tmp_Banner_W_Font_Color; ?>;
	background-color: <?php echo $Tmp_Banner_W_Background_Color; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_W_Background_Img; ?>);
	background-repeat: no-repeat;
	margin: <?php echo $Tmp_Banner_W_Marge_Top; ?>px <?php echo $Tmp_Banner_W_Marge_Right; ?>px <?php echo $Tmp_Banner_W_Marge_Bottom; ?>px <?php echo $Tmp_Banner_W_Marge_Left; ?>px;
	padding: <?php echo $Tmp_Banner_W_Padding_Top; ?>px <?php echo $Tmp_Banner_W_Padding_Right; ?>px <?php echo $Tmp_Banner_W_Padding_Bottom; ?>px <?php echo $Tmp_Banner_W_Padding_Left; ?>px;
	border: <?php echo $Tmp_Banner_W_Board_Width; ?>px <?php echo $Tmp_Banner_W_Board_Style; ?> <?php echo $Tmp_Banner_W_Board_Color; ?>;
	-webkit-border-radius: <?php echo $Tmp_Banner_BorderRadius_T_L; ?>px <?php echo $Tmp_Banner_BorderRadius_T_R; ?>px <?php echo $Tmp_Banner_BorderRadius_B_R; ?>px <?php echo $Tmp_Banner_BorderRadius_B_L; ?>px;
	-moz-border-radius: <?php echo $Tmp_Banner_BorderRadius_T_L; ?>px <?php echo $Tmp_Banner_BorderRadius_T_R; ?>px <?php echo $Tmp_Banner_BorderRadius_B_R; ?>px <?php echo $Tmp_Banner_BorderRadius_B_L; ?>px;
	border-radius: <?php echo $Tmp_Banner_BorderRadius_T_L; ?>px <?php echo $Tmp_Banner_BorderRadius_T_R; ?>px <?php echo $Tmp_Banner_BorderRadius_B_R; ?>px <?php echo $Tmp_Banner_BorderRadius_B_L; ?>px;
	-webkit-box-shadow: <?php echo $Tmp_Banner_BoxShadow_X; ?>px <?php echo $Tmp_Banner_BoxShadow_Y; ?>px <?php echo $Tmp_Banner_BoxShadow_Size; ?>px <?php echo $Tmp_Banner_BoxShadow_Color; ?>;
	-moz-box-shadow: <?php echo $Tmp_Banner_BoxShadow_X; ?>px <?php echo $Tmp_Banner_BoxShadow_Y; ?>px <?php echo $Tmp_Banner_BoxShadow_Size; ?>px <?php echo $Tmp_Banner_BoxShadow_Color; ?>;
	box-shadow: <?php echo $Tmp_Banner_BoxShadow_X; ?>px <?php echo $Tmp_Banner_BoxShadow_Y; ?>px <?php echo $Tmp_Banner_BoxShadow_Size; ?>px <?php echo $Tmp_Banner_BoxShadow_Color; ?>;
	
	<?php if($Tmp_Banner_LinearGradient_Top != '' || $Tmp_Banner_LinearGradient_Bottom != '') { ?>
	background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $Tmp_Banner_LinearGradient_Top; ?>), to(<?php echo $Tmp_Banner_LinearGradient_Bottom; ?>));
	background: -webkit-linear-gradient(<?php echo $Tmp_Banner_LinearGradient_Top; ?>, <?php echo $Tmp_Banner_LinearGradient_Bottom; ?>);
	background: -moz-linear-gradient(<?php echo $Tmp_Banner_LinearGradient_Top; ?>, <?php echo $Tmp_Banner_LinearGradient_Bottom; ?>);
	background: -ms-linear-gradient(<?php echo $Tmp_Banner_LinearGradient_Top; ?>, <?php echo $Tmp_Banner_LinearGradient_Bottom; ?>);
	background: -o-linear-gradient(<?php echo $Tmp_Banner_LinearGradient_Top; ?>, <?php echo $Tmp_Banner_LinearGradient_Bottom; ?>);
	background: linear-gradient(<?php echo $Tmp_Banner_LinearGradient_Top; ?>, <?php echo $Tmp_Banner_LinearGradient_Bottom; ?>);
	-pie-background: linear-gradient(<?php echo $Tmp_Banner_LinearGradient_Top; ?>, <?php echo $Tmp_Banner_LinearGradient_Bottom; ?>);
	<?php } ?>
	behavior: url(http://easy.fullvision.net/PIE.htc);
}
div.BannerBoardStyle .mdbanner_t{}/* 上半部 */
div.BannerBoardStyle .mdbanner_t_l{
	width:<?php echo $Tmp_Banner_L_T_Width; ?>px;
	height:<?php echo $Tmp_Banner_L_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_L_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_L_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.BannerBoardStyle .mdbanner_t_c{
	height:<?php echo $Tmp_Banner_M_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_M_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_M_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Banner_R_T_Width; ?>px 0px <?php echo $Tmp_Banner_L_T_Width; ?>px;
}
div.BannerBoardStyle .mdbanner_t_r{
	width:<?php echo $Tmp_Banner_R_T_Width; ?>px;
	height:<?php echo $Tmp_Banner_R_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_R_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_R_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.BannerBoardStyle .mdbanner_t_m{} /* 中央 */
div.BannerBoardStyle .mdbanner_c_l{
	width:<?php echo $Tmp_Banner_L_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_L_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_L_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.BannerBoardStyle .mdbanner_c_c{
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_M_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_M_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Banner_R_M_Width; ?>px 0px <?php echo $Tmp_Banner_L_M_Width; ?>px;
}
div.BannerBoardStyle .mdbanner_c_r{
	width:<?php echo $Tmp_Banner_R_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_R_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_R_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.BannerBoardStyle .mdbanner_b{} /* 下半部 */
div.BannerBoardStyle .mdbanner_b_l{
    width:<?php echo $Tmp_Banner_L_B_Width; ?>px;
	height:<?php echo $Tmp_Banner_L_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_L_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_L_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.BannerBoardStyle .mdbanner_b_c{
	height:<?php echo $Tmp_Banner_M_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_M_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_M_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Banner_R_B_Width; ?>px 0px <?php echo $Tmp_Banner_L_B_Width; ?>px;
}
div.BannerBoardStyle .mdbanner_b_r{
	width:<?php echo $Tmp_Banner_R_B_Width; ?>px;
	height:<?php echo $Tmp_Banner_R_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Banner_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Banner_R_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Banner_R_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php } ?>

/* 圖片限制大小 */
/* 橫幅 */
.mdbanner img{max-width:<?php //echo ($TmpWebWidth - $Tmp_Banner_R_M_Width - $Tmp_Banner_L_M_Width) . $TmpWebWidthUnit; ?>}

/* Middle */
<?php if ($totalRows_RecordTmpMiddleBoard > 0) {  ?>
div.MiddleBoardStyle{/* 大外框 */
	color: <?php echo $Tmp_Middle_W_Font_Color; ?>;
	background-color: <?php echo $Tmp_Middle_W_Background_Color; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_W_Background_Img; ?>);
	background-repeat: no-repeat;
	margin: <?php echo $Tmp_Middle_W_Marge_Top; ?>px <?php echo $Tmp_Middle_W_Marge_Left; ?>px <?php echo $Tmp_Middle_W_Marge_Bottom; ?>px <?php echo $Tmp_Middle_W_Marge_Right; ?>px;
	padding: <?php echo $Tmp_Middle_W_Padding_Top; ?>px <?php echo $Tmp_Middle_W_Padding_Left; ?>px <?php echo $Tmp_Middle_W_Padding_Bottom; ?>px <?php echo $Tmp_Middle_W_Padding_Right; ?>px;
	border: <?php echo $Tmp_Middle_W_Board_Width; ?>px <?php echo $Tmp_Middle_W_Board_Style; ?> <?php echo $Tmp_Middle_W_Board_Color; ?>;
	-webkit-border-radius: <?php echo $Tmp_Middle_BorderRadius_T_L; ?>px <?php echo $Tmp_Middle_BorderRadius_T_R; ?>px <?php echo $Tmp_Middle_BorderRadius_B_R; ?>px <?php echo $Tmp_Middle_BorderRadius_B_L; ?>px;
	-moz-border-radius: <?php echo $Tmp_Middle_BorderRadius_T_L; ?>px <?php echo $Tmp_Middle_BorderRadius_T_R; ?>px <?php echo $Tmp_Middle_BorderRadius_B_R; ?>px <?php echo $Tmp_Middle_BorderRadius_B_L; ?>px;
	border-radius: <?php echo $Tmp_Middle_BorderRadius_T_L; ?>px <?php echo $Tmp_Middle_BorderRadius_T_R; ?>px <?php echo $Tmp_Middle_BorderRadius_B_R; ?>px <?php echo $Tmp_Middle_BorderRadius_B_L; ?>px;
	-webkit-box-shadow: <?php echo $Tmp_Middle_BoxShadow_X; ?>px <?php echo $Tmp_Middle_BoxShadow_Y; ?>px <?php echo $Tmp_Middle_BoxShadow_Size; ?>px <?php echo $Tmp_Middle_BoxShadow_Color; ?>;
	-moz-box-shadow: <?php echo $Tmp_Middle_BoxShadow_X; ?>px <?php echo $Tmp_Middle_BoxShadow_Y; ?>px <?php echo $Tmp_Middle_BoxShadow_Size; ?>px <?php echo $Tmp_Middle_BoxShadow_Color; ?>;
	box-shadow: <?php echo $Tmp_Middle_BoxShadow_X; ?>px <?php echo $Tmp_Middle_BoxShadow_Y; ?>px <?php echo $Tmp_Middle_BoxShadow_Size; ?>px <?php echo $Tmp_Middle_BoxShadow_Color; ?>;
	
	<?php if($Tmp_Middle_LinearGradient_Top != '' || $Tmp_Middle_LinearGradient_Bottom != '') { ?>
	background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $Tmp_Middle_LinearGradient_Top; ?>), to(<?php echo $Tmp_Middle_LinearGradient_Bottom; ?>));
	background: -webkit-linear-gradient(<?php echo $Tmp_Middle_LinearGradient_Top; ?>, <?php echo $Tmp_Middle_LinearGradient_Bottom; ?>);
	background: -moz-linear-gradient(<?php echo $Tmp_Middle_LinearGradient_Top; ?>, <?php echo $Tmp_Middle_LinearGradient_Bottom; ?>);
	background: -ms-linear-gradient(<?php echo $Tmp_Middle_LinearGradient_Top; ?>, <?php echo $Tmp_Middle_LinearGradient_Bottom; ?>);
	background: -o-linear-gradient(<?php echo $Tmp_Middle_LinearGradient_Top; ?>, <?php echo $Tmp_Middle_LinearGradient_Bottom; ?>);
	background: linear-gradient(<?php echo $Tmp_Middle_LinearGradient_Top; ?>, <?php echo $Tmp_Middle_LinearGradient_Bottom; ?>);
	-pie-background: linear-gradient(<?php echo $Tmp_Middle_LinearGradient_Top; ?>, <?php echo $Tmp_Middle_LinearGradient_Bottom; ?>);
	<?php } ?>
	behavior: url(http://easy.fullvision.net/PIE.htc);
}
<?php if ($TmpMergerTitleAndMiddle == '0') { ?>
div.MiddleBoardStyle .mdmiddle_t{}/* 上半部 */
div.MiddleBoardStyle .mdmiddle_t_l{
	width:<?php echo $Tmp_Middle_L_T_Width; ?>px;
	height:<?php echo $Tmp_Middle_L_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_L_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_L_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.MiddleBoardStyle .mdmiddle_t_c{
	height:<?php echo $Tmp_Middle_M_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_M_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_M_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Middle_R_T_Width; ?>px 0px <?php echo $Tmp_Middle_L_T_Width; ?>px;
}
div.MiddleBoardStyle .mdmiddle_t_r{
	width:<?php echo $Tmp_Middle_R_T_Width; ?>px;
	height:<?php echo $Tmp_Middle_R_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_R_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_R_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php } ?>
div.MiddleBoardStyle .mdmiddle_t_m{} /* 中央 */
div.MiddleBoardStyle .mdmiddle_c_l{
	width:<?php echo $Tmp_Middle_L_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_L_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_L_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.MiddleBoardStyle .mdmiddle_c_c{
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_M_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_M_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Middle_R_M_Width; ?>px 0px <?php echo $Tmp_Middle_L_M_Width; ?>px;
}
div.MiddleBoardStyle .mdmiddle_c_r{
	width:<?php echo $Tmp_Middle_R_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_R_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_R_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.MiddleBoardStyle .mdmiddle_b{} /* 下半部 */
div.MiddleBoardStyle .mdmiddle_b_l{
    width:<?php echo $Tmp_Middle_L_B_Width; ?>px;
	height:<?php echo $Tmp_Middle_L_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_L_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_L_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.MiddleBoardStyle .mdmiddle_b_c{
	height:<?php echo $Tmp_Middle_M_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_M_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_M_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Middle_R_B_Width; ?>px 0px <?php echo $Tmp_Middle_L_B_Width; ?>px;
}
div.MiddleBoardStyle .mdmiddle_b_r{
	width:<?php echo $Tmp_Middle_R_B_Width; ?>px;
	height:<?php echo $Tmp_Middle_R_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Middle_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Middle_R_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Middle_R_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php }  ?>

/* 圖片限制大小 */
/* Middle */
.mdmiddle img{max-width:<?php //echo ($TmpWebWidth - $Tmp_Middle_R_M_Width - $Tmp_Middle_L_M_Width) . $TmpWebWidthUnit; ?>}

/* Title */
.ct_title{
	<?php if ($totalRows_RecordTmpTitleLineBg > 0) {  ?>
	background-color:<?php echo $TmpTitleLineBgColor; ?>;
	background-image:url(<?php echo $SiteImgUrl; ?><?php echo $TmpTitleLineBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleLineBgImage; ?>);
	background-repeat:<?php echo $TmpTitleLineBgRepeat; ?>;
	background-position:<?php echo $TmpTitleLineBgPosition; ?>;
	<?php } ?>
	color:<?php echo $TmpTitleLineFontColor; ?>;
	min-height:<?php echo $TmpTitleLineHeight ?>px;
	line-height:<?php echo $TmpTitleLineHeight ?>px;
	padding-left:<?php echo $TmpTitleLineX; ?>px;
	vertical-align:middle;
	/*display:table-cell;*/
}
.ct_title *{ vertical-align:middle;}/* 讓table-cell下的所有元素都居中 */
<?php if ($totalRows_RecordTmpTitleBoard > 0) {  ?>
div.TitleBoardStyle{/* 大外框 */
	color: <?php echo $Tmp_Title_W_Font_Color; ?>;
	background-color: <?php echo $Tmp_Title_W_Background_Color; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_W_Background_Img; ?>);
	background-repeat: no-repeat;
	margin: <?php echo $Tmp_Title_W_Marge_Top; ?>px <?php echo $Tmp_Title_W_Marge_Right; ?>px <?php echo $Tmp_Title_W_Marge_Bottom; ?>px <?php echo $Tmp_Title_W_Marge_Left; ?>px;
	padding: <?php echo $Tmp_Title_W_Padding_Top; ?>px <?php echo $Tmp_Title_W_Padding_Right; ?>px <?php echo $Tmp_Title_W_Padding_Bottom; ?>px <?php echo $Tmp_Title_W_Padding_Left; ?>px;
	border: <?php echo $Tmp_Title_W_Board_Width; ?>px <?php echo $Tmp_Title_W_Board_Style; ?> <?php echo $Tmp_Title_W_Board_Color; ?>;
	-webkit-border-radius: <?php echo $Tmp_Title_BorderRadius_T_L; ?>px <?php echo $Tmp_Title_BorderRadius_T_R; ?>px <?php echo $Tmp_Title_BorderRadius_B_R; ?>px <?php echo $Tmp_Title_BorderRadius_B_L; ?>px;
	-moz-border-radius: <?php echo $Tmp_Title_BorderRadius_T_L; ?>px <?php echo $Tmp_Title_BorderRadius_T_R; ?>px <?php echo $Tmp_Title_BorderRadius_B_R; ?>px <?php echo $Tmp_Title_BorderRadius_B_L; ?>px;
	border-radius: <?php echo $Tmp_Title_BorderRadius_T_L; ?>px <?php echo $Tmp_Title_BorderRadius_T_R; ?>px <?php echo $Tmp_Title_BorderRadius_B_R; ?>px <?php echo $Tmp_Title_BorderRadius_B_L; ?>px;
	-webkit-box-shadow: <?php echo $Tmp_Title_BoxShadow_X; ?>px <?php echo $Tmp_Title_BoxShadow_Y; ?>px <?php echo $Tmp_Title_BoxShadow_Size; ?>px <?php echo $Tmp_Title_BoxShadow_Color; ?>;
	-moz-box-shadow: <?php echo $Tmp_Title_BoxShadow_X; ?>px <?php echo $Tmp_Title_BoxShadow_Y; ?>px <?php echo $Tmp_Title_BoxShadow_Size; ?>px <?php echo $Tmp_Title_BoxShadow_Color; ?>;
	box-shadow: <?php echo $Tmp_Title_BoxShadow_X; ?>px <?php echo $Tmp_Title_BoxShadow_Y; ?>px <?php echo $Tmp_Title_BoxShadow_Size; ?>px <?php echo $Tmp_Title_BoxShadow_Color; ?>;
	
	<?php if($Tmp_Title_LinearGradient_Top != '' || $Tmp_Title_LinearGradient_Bottom != '') { ?>
	background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $Tmp_Title_LinearGradient_Top; ?>), to(<?php echo $Tmp_Title_LinearGradient_Bottom; ?>));
	background: -webkit-linear-gradient(<?php echo $Tmp_Title_LinearGradient_Top; ?>, <?php echo $Tmp_Title_LinearGradient_Bottom; ?>);
	background: -moz-linear-gradient(<?php echo $Tmp_Title_LinearGradient_Top; ?>, <?php echo $Tmp_Title_LinearGradient_Bottom; ?>);
	background: -ms-linear-gradient(<?php echo $Tmp_Title_LinearGradient_Top; ?>, <?php echo $Tmp_Title_LinearGradient_Bottom; ?>);
	background: -o-linear-gradient(<?php echo $Tmp_Title_LinearGradient_Top; ?>, <?php echo $Tmp_Title_LinearGradient_Bottom; ?>);
	background: linear-gradient(<?php echo $Tmp_Title_LinearGradient_Top; ?>, <?php echo $Tmp_Title_LinearGradient_Bottom; ?>);
	-pie-background: linear-gradient(<?php echo $Tmp_Title_LinearGradient_Top; ?>, <?php echo $Tmp_Title_LinearGradient_Bottom; ?>);
	<?php } ?>
	behavior: url(http://easy.fullvision.net/PIE.htc);
}
div.TitleBoardStyle .mdtitle_t{}/* 上半部 */
div.TitleBoardStyle .mdtitle_t_l{
	width:<?php echo $Tmp_Title_L_T_Width; ?>px;
	height:<?php echo $Tmp_Title_L_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_L_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_L_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.TitleBoardStyle .mdtitle_t_c{
	height:<?php echo $Tmp_Title_M_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_M_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_M_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Title_R_T_Width; ?>px 0px <?php echo $Tmp_Title_L_T_Width; ?>px;
}
div.TitleBoardStyle .mdtitle_t_r{
	width:<?php echo $Tmp_Title_R_T_Width; ?>px;
	height:<?php echo $Tmp_Title_R_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_R_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_R_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.TitleBoardStyle .mdtitle_t_m{} /* 中央 */
div.TitleBoardStyle .mdtitle_c_l{
	width:<?php echo $Tmp_Title_L_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_L_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_L_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.TitleBoardStyle .mdtitle_c_c{
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_M_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_M_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Title_R_M_Width; ?>px 0px <?php echo $Tmp_Title_L_M_Width; ?>px;
}
div.TitleBoardStyle .mdtitle_c_r{
	width:<?php echo $Tmp_Title_R_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_R_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_R_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php if ($TmpMergerTitleAndMiddle == '0') { ?>
div.TitleBoardStyle .mdtitle_b{} /* 下半部 */
div.TitleBoardStyle .mdtitle_b_l{
    width:<?php echo $Tmp_Title_L_B_Width; ?>px;
	height:<?php echo $Tmp_Title_L_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_L_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_L_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.TitleBoardStyle .mdtitle_b_c{
	height:<?php echo $Tmp_Title_M_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_M_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_M_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Title_R_B_Width; ?>px 0px <?php echo $Tmp_Title_L_B_Width; ?>px;
}
div.TitleBoardStyle .mdtitle_b_r{
	width:<?php echo $Tmp_Title_R_B_Width; ?>px;
	height:<?php echo $Tmp_Title_R_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Title_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Title_R_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Title_R_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php }  ?>
<?php }  ?>
/* 圖片限制大小 */
/* Title */
/*.mdtitle img{max-width:<?php //echo ($TmpWebWidth - $Tmp_Title_R_M_Width - $Tmp_Title_L_M_Width) . $TmpWebWidthUnit; ?>}*/

<?php if ($totalRows_RecordTmpHomeBoard > 0) {  ?>
/* 首頁 */
div.HomeBoardStyle{/* 大外框 */
	color: <?php echo $Tmp_Home_W_Font_Color; ?>;
	background-color: <?php echo $Tmp_Home_W_Background_Color; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_W_Background_Img; ?>);
	background-repeat: no-repeat;
	margin: <?php echo $Tmp_Home_W_Marge_Top; ?>px <?php echo $Tmp_Home_W_Marge_Right; ?>px <?php echo $Tmp_Home_W_Marge_Bottom; ?>px <?php echo $Tmp_Home_W_Marge_Left; ?>px;
	padding: <?php echo $Tmp_Home_W_Padding_Top; ?>px <?php echo $Tmp_Home_W_Padding_Right; ?>px <?php echo $Tmp_Home_W_Padding_Bottom; ?>px <?php echo $Tmp_Home_W_Padding_Left; ?>px;
	border: <?php echo $Tmp_Home_W_Board_Width; ?>px <?php echo $Tmp_Home_W_Board_Style; ?> <?php echo $Tmp_Home_W_Board_Color; ?>;
	-webkit-border-radius: <?php echo $Tmp_Home_BorderRadius_T_L; ?>px <?php echo $Tmp_Home_BorderRadius_T_R; ?>px <?php echo $Tmp_Home_BorderRadius_B_R; ?>px <?php echo $Tmp_Home_BorderRadius_B_L; ?>px;
	-moz-border-radius: <?php echo $Tmp_Home_BorderRadius_T_L; ?>px <?php echo $Tmp_Home_BorderRadius_T_R; ?>px <?php echo $Tmp_Home_BorderRadius_B_R; ?>px <?php echo $Tmp_Home_BorderRadius_B_L; ?>px;
	border-radius: <?php echo $Tmp_Home_BorderRadius_T_L; ?>px <?php echo $Tmp_Home_BorderRadius_T_R; ?>px <?php echo $Tmp_Home_BorderRadius_B_R; ?>px <?php echo $Tmp_Home_BorderRadius_B_L; ?>px;
	-webkit-box-shadow: <?php echo $Tmp_Home_BoxShadow_X; ?>px <?php echo $Tmp_Home_BoxShadow_Y; ?>px <?php echo $Tmp_Home_BoxShadow_Size; ?>px <?php echo $Tmp_Home_BoxShadow_Color; ?>;
	-moz-box-shadow: <?php echo $Tmp_Home_BoxShadow_X; ?>px <?php echo $Tmp_Home_BoxShadow_Y; ?>px <?php echo $Tmp_Home_BoxShadow_Size; ?>px <?php echo $Tmp_Home_BoxShadow_Color; ?>;
	box-shadow: <?php echo $Tmp_Home_BoxShadow_X; ?>px <?php echo $Tmp_Home_BoxShadow_Y; ?>px <?php echo $Tmp_Home_BoxShadow_Size; ?>px <?php echo $Tmp_Home_BoxShadow_Color; ?>;
	
	<?php if($Tmp_Home_LinearGradient_Top != '' || $Tmp_Home_LinearGradient_Bottom != '') { ?>
	background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $Tmp_Home_LinearGradient_Top; ?>), to(<?php echo $Tmp_Home_LinearGradient_Bottom; ?>));
	background: -webkit-linear-gradient(<?php echo $Tmp_Home_LinearGradient_Top; ?>, <?php echo $Tmp_Home_LinearGradient_Bottom; ?>);
	background: -moz-linear-gradient(<?php echo $Tmp_Home_LinearGradient_Top; ?>, <?php echo $Tmp_Home_LinearGradient_Bottom; ?>);
	background: -ms-linear-gradient(<?php echo $Tmp_Home_LinearGradient_Top; ?>, <?php echo $Tmp_Home_LinearGradient_Bottom; ?>);
	background: -o-linear-gradient(<?php echo $Tmp_Home_LinearGradient_Top; ?>, <?php echo $Tmp_Home_LinearGradient_Bottom; ?>);
	background: linear-gradient(<?php echo $Tmp_Home_LinearGradient_Top; ?>, <?php echo $Tmp_Home_LinearGradient_Bottom; ?>);
	-pie-background: linear-gradient(<?php echo $Tmp_Home_LinearGradient_Top; ?>, <?php echo $Tmp_Home_LinearGradient_Bottom; ?>);
	<?php } ?>
	behavior: url(http://easy.fullvision.net/PIE.htc);
}
div.HomeBoardStyle .mdbanner_t{}/* 上半部 */
div.HomeBoardStyle .mdbanner_t_l{
	width:<?php echo $Tmp_Home_L_T_Width; ?>px;
	height:<?php echo $Tmp_Home_L_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_L_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_L_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.HomeBoardStyle .mdbanner_t_c{
	height:<?php echo $Tmp_Home_M_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_M_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_M_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Home_R_T_Width; ?>px 0px <?php echo $Tmp_Home_L_T_Width; ?>px;
}
div.HomeBoardStyle .mdbanner_t_r{
	width:<?php echo $Tmp_Home_R_T_Width; ?>px;
	height:<?php echo $Tmp_Home_R_T_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_R_T_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_R_T_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.HomeBoardStyle .mdbanner_t_m{} /* 中央 */
div.HomeBoardStyle .mdbanner_c_l{
	width:<?php echo $Tmp_Home_L_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_L_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_L_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.HomeBoardStyle .mdbanner_c_c{
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_M_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_M_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Home_R_M_Width; ?>px 0px <?php echo $Tmp_Home_L_M_Width; ?>px;
}
div.HomeBoardStyle .mdbanner_c_r{
	width:<?php echo $Tmp_Home_R_M_Width; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_R_M_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_R_M_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.HomeBoardStyle .mdbanner_b{} /* 下半部 */
div.HomeBoardStyle .mdbanner_b_l{
    width:<?php echo $Tmp_Home_L_B_Width; ?>px;
	height:<?php echo $Tmp_Home_L_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_L_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_L_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
div.HomeBoardStyle .mdbanner_b_c{
	height:<?php echo $Tmp_Home_M_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_M_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_M_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
	margin:0px <?php echo $Tmp_Home_R_B_Width; ?>px 0px <?php echo $Tmp_Home_L_B_Width; ?>px;
}
div.HomeBoardStyle .mdbanner_b_r{
	width:<?php echo $Tmp_Home_R_B_Width; ?>px;
	height:<?php echo $Tmp_Home_R_B_Height; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $Tmp_Home_W_Background_WebName; ?>/image/tmpboard/<?php echo $Tmp_Home_R_B_Background_Img; ?>);
	background-repeat: <?php echo $Tmp_Home_R_B_Repeat; ?>;
	background-attachment: scroll;
	background-position: left top;
}
<?php } ?>

/* 圖片限制大小 */
/* 首頁 */
.mdbanner img{max-width:<?php //echo ($TmpWebWidth - $Tmp_Home_R_M_Width - $Tmp_Home_L_M_Width) . $TmpWebWidthUnit; ?>}

/* 左選單 */
/*外框*/
.BlockWrp {
	background-color:<?php echo $TmpBlockBgColor; ?>;
	border: <?php echo $TmpBlockWidth; ?>px <?php echo $TmpBlockStyle; ?> <?php echo $TmpBlockColor; ?>;
}
.BlockTitle {
	color:<?php echo $TmpBlockTitleFontColor; ?>;
	line-height: <?php echo $TmpBlockTitleHight; ?>px;
	text-align: left;
	padding-left: <?php echo $TmpBlockTitleLeft; ?>px;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockTitlePic; ?>);
	background-repeat: <?php echo $TmpBlockTitleRepet; ?>;
	background-position: <?php echo $TmpBlockTitlePosition; ?>;
}
.BlockContent {
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockMiddlePic; ?>);
	background-repeat: <?php echo $TmpBlockMiddleRepet; ?>;
	background-position: <?php echo $TmpBlockMiddlePosition; ?>;
}
.dcjq-vertical-mega-menu .menu{ 
	font-weight: bold;
}
.dcjq-vertical-mega-menu .menu li a {
	color: <?php echo $TmpLeftMenuFontColor; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpLeftMenuWebName; ?>/image/tmpleftmenu/<?php echo $TmpLeftMenuMiddlePic; ?>);
	background-repeat: repeat-y;
	background-position: center 0;
}
.dcjq-vertical-mega-menu .menu li a:hover{
	color: <?php echo $TmpLeftMenuFontOColor; ?>;
	<?php if ($TmpLeftMenuMiddleOPic != '') { ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpLeftMenuWebName; ?>/image/tmpleftmenu/<?php echo $TmpLeftMenuMiddleOPic; ?>);
	<?php } ?>
	background-repeat: repeat-y;
	background-position: center 0;
}
/*模組*/
/* 前台表格隔行變色 - 最新訊息用*/
tr.TR_News_Odd_Color_Style{
	<?php if ($totalRows_RecordTmpNewsOddBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpNewsOddBgWebName; ?>/image/tmpbackground/<?php echo $TmpNewsOddBgImage; ?>);
	background-repeat: <?php echo $TmpNewsOddBgRepeat; ?>;
	background-position: <?php echo $TmpNewsOddBgPosition; ?>;
	background-color: <?php echo $TmpNewsOddBgColor; ?>;
	<?php } ?>
}
tr.TR_News_Even_Color_Style{
	<?php if ($totalRows_RecordTmpNewsEvenBg > 0) {  ?>
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpNewsEvenBgWebName; ?>/image/tmpbackground/<?php echo $TmpNewsEvenBgImage; ?>);
	background-repeat: <?php echo $TmpNewsEvenBgRepeat; ?>;
	background-position: <?php echo $TmpNewsEvenBgPosition; ?>;
	background-color: <?php echo $TmpNewsEvenBgColor; ?>;
	<?php } ?>
}
tr.TR_News_Top_Color_Style, tr.TR_News_Even_Color_Style, tr.TR_News_Odd_Color_Style{
	border-width:0px 0px 1px 0px; border-color:#DDD; border-style:dotted;
}

<?php //if ($totalRows_RecordTmpMainMenu > 0) {  ?>
/* 主選單 */
#navcss3 li {
	line-height: <?php echo $TmpMainMenuHeight; ?>px; /*主選單高度user*/
	font-size: <?php echo $TmpMainMenuFontSize; ?>;
	font-weight: <?php echo $TmpMainMenuFontStyle; ?>;
}
#navcss3 a {
	color: <?php echo $TmpMainMenuColor; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuImg; ?>);
	width: <?php echo $TmpMainMenuWidth; ?>px;
}

#navcss3 .mactive{
	color: <?php echo $TmpMainMenuHoverColor; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuHoverImg; ?>);
}

#navcss3 a:hover {
	color: <?php echo $TmpMainMenuHoverColor; ?>;
	background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuHoverImg; ?>);
}
<?php //}  ?>
</style>
<?php } ?>
