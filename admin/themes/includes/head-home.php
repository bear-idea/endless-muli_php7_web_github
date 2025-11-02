    <link href="<?php echo $SiteAdminPath; ?>assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />

    <style type="text/css">
        #Tip_Box{padding:20px}
        .InnerPage_design{float:right;margin:1px 1px 1px 5px}
        .InnerPage_design a{font-weight:700;border:1px solid #337fed;-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px;text-shadow:1px 1px 0 #1570cd;-webkit-box-shadow:inset 1px 1px 0 0 #97c4fe;-moz-box-shadow:inset 1px 1px 0 0 #97c4fe;box-shadow:inset 1px 1px 0 0 #97c4fe;white-space:nowrap;vertical-align:middle;color:#fff;background:transparent;cursor:pointer;background-color:#3d94f6;padding:2px;text-decoration:none}
        .InnerPage_design a:hover,.InnerPage_design a:focus{filter:progid: DXImageTransform.Microsoft.gradient(startColorstr='#1e62d0',endColorstr='#3d94f6');background:0 color-stop(100%,#3d94f6));background-color:#1e62d0}
        #Mg_Logo img:hover{background-image:url(images/slogo_nw2.png)}
        .Menu_ListView_Icon_Board{-moz-background-size:cover;-webkit-background-size:cover;-o-background-size:cover;background-size:cover;text-shadow:#e0e0e0 0 0 11px;color:#000;font-weight:bolder;font-size:1em}
        .Menu_ListView_Icon_Board_Block{-moz-background-size:cover;-webkit-background-size:cover;-o-background-size:cover;background-size:cover;text-shadow:#e0e0e0 0 0 11px;color:#000;font-weight:bolder;font-size:1em;margin:5px}
        .cl_green{background-color:#b2df81;background-image:url(images/mt_color_style01.png)}
        .cl_green2{background-color:#79d5b3;background-image:url(images/mt_color_style01.png)}
        .cl_purple{background-color:#C0C0E0;background-image:url(images/mt_color_style01.png)}
        .cl_purple2{background-color:#84909f;background-image:url(images/mt_color_style01.png)}
        .cl_blue{background-color:#ebf0a8;background-image:url(images/mt_color_style01.png)}
        .cl_blue2{background-color:#95c7e4;background-image:url(images/mt_color_style01.png)}
        .cl_blue3{background-color:#9eb880;background-image:url(images/mt_color_style01.png)}
        .cl_blue4{background-color:#ffae9a;background-image:url(images/mt_color_style01.png)}
        .cl_red{background-color:#f48181;background-image:url(images/mt_color_style01.png)}
        .cl_red_n{background-color:#f48181;background-image:url(images/mt_color_style14.png)}
        .cl_orange{background-color:#f3ad79;background-image:url(images/mt_color_style01.png)}
        .cl_orange_n{background-color:#f3ad79;background-image:url(images/mt_color_style14.png)}
        .cl_pink{background-color:#94999f;background-image:url(images/mt_color_style01.png)}
        .cl_pink2{background-color:#d3a4c6;background-image:url(images/mt_color_style01.png)}
        .cl_yellow{background-color:#f5d6a4;background-image:url(images/mt_color_style01.png)}
        .cl_yellow2{background-color:#f5e7a4;background-image:url(images/mt_color_style01.png)}
        .cl_brown{background-color:#d4c0aa;background-image:url(images/mt_color_style01.png)}
        .cl_gray{background-color:#acb8c3;background-image:url(images/mt_color_style01.png)}
        .cl_gray2{background-color:#dcdee1;background-image:url(images/mt_color_style01.png)}
        #container_freewall,#container_freewall0,#container_freewall1,#container_freewall2,#container_freewall3,#container_freewall4,#container_freewall5{width:100%}
        #container_freewall .Menu_ListView_Icon_Board,#container_freewall0 .Menu_ListView_Icon_Board,#container_freewall1 .Menu_ListView_Icon_Board,#container_freewall2 .Menu_ListView_Icon_Board,#container_freewall3 .Menu_ListView_Icon_Board,#container_freewall4 .Menu_ListView_Icon_Board,#container_freewall5 .Menu_ListView_Icon_Board{width:100px;height:100px;border:1px solid #E3E3E3;box-shadow:rgba(0,0,0,0.1) 0 0 8px;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
        #container_freewall .Menu_ListView_Icon_Board:hover,#container_freewall0 .Menu_ListView_Icon_Board:hover,#container_freewall1 .Menu_ListView_Icon_Board:hover,#container_freewall2 .Menu_ListView_Icon_Board:hover,#container_freewall3 .Menu_ListView_Icon_Board:hover,#container_freewall4 .Menu_ListView_Icon_Board:hover,#container_freewall5 .Menu_ListView_Icon_Board:hover{background-color:#C7E3F1;box-shadow:rgba(0,0,0,0.1) 0 0 8px;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 8px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
        .home_lang{position:absolute;color:#FFF;width:120px;height:30px;right:10px;top:70px;text-align:right}
        @media only screen and (max-width: 991px) {
            .home_lang{left:10px;right:inherit;top:66px}
        }
        .demo-modal{background-color:#FFF;box-shadow:0 11px 15px -7px rgba(0,0,0,0.2),0 24px 38px 3px rgba(0,0,0,0.14),0 9px 46px 8px rgba(0,0,0,0.12);padding:24px;width:60%;position:relative;display:none}
        .demo-close{display:block;position:absolute;top:-35px;right:0;z-index:10000;outline:none;font-size:30px;line-height:30px;transition:transform .3s ease-in-out;color:#FFF}
        .demo-close:hover{transform:rotate(360deg);color:#FFF}
    </style>