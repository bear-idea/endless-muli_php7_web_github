<div class="row mb-2">
    <div class="col-xl-6">
    </div>
    <div class="col-xl-6">
    </div>
</div>
<div class="row mb-2">
    <div class="col-xl-7">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-module">
            <div class="panel-heading">
                <h4 class="panel-title">模組一覽 <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
                <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
            </div>
            <div class="panel-body">
                <div id="container_freewall">
                    <?php

                    //echo 'SiteModChoose'. $SiteModChoose;

                    switch($SiteModChoose)
                    {
                        case "0":
                            require($page_view_path_component."require_manage_home_mod_select_view.php");
                            break;
                        case "1":
                            require($page_view_path_component."require_manage_home_mod_select_view_scale.php");
                            break;
                        case "2":
                            if($_SESSION['MM_UserGroup'] == 'superadmin') {
                                require($page_view_path_component."require_manage_home_mod_select_view_invoicing.php");
                            }else if($_SESSION['MM_UserGroup'] == 'admin'){
                                require($page_view_path_component."require_manage_home_mod_select_view_invoicing_admin.php");
                            }else if($_SESSION['MM_UserGroup'] == 'subadmin'){
                                require($page_view_path_component."require_manage_home_mod_select_view_invoicing_subadmin.php");
                            }else if($_SESSION['MM_UserGroup'] == 'subuser'){
                                require($page_view_path_component."require_manage_home_mod_select_view_invoicing_subuser.php");
                            }
                            break;
                        case "3":
                            require($page_view_path_component."require_manage_home_mod_select_view_salary.php");
                            break;
                        case "4":
                            require($page_view_path_component."require_manage_home_mod_select_view_mail.php");
                            break;
                        default:
                            //require($page_view_path_component."require_manage_home_mod_select_view.php");
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- end panel -->

        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-trends">
            <div class="panel-heading">
                <h4 class="panel-title">Google Trends</h4>
                <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
            </div>
            <div class="list-group">
                <a href="https://trends.google.com/trends/?geo=TW" class="list-group-item rounded-0 list-group-item-action d-flex justify-content-between align-items-center text-ellipsis" target="_blank">
                    <i class="fas fa-lg fa-chart-area"></i> 探索世界搜尋趨勢
                    <span class="badge bg-teal fs-10px">GO</span>
                </a>
                <a href="https://trends.google.com/trends/trendingsearches/daily?geo=TW" class="list-group-item rounded-0 list-group-item-action d-flex justify-content-between align-items-center text-ellipsis" target="_blank">
                    <i class="fas fa-lg fa-chart-area"></i> 台灣每日搜尋趨勢
                    <span class="badge bg-teal fs-10px">GO</span>
                </a>
                <a href="https://trends.google.com.tw/trends/explore" class="list-group-item rounded-0 list-group-item-action d-flex justify-content-between align-items-center text-ellipsis" target="_blank">
                    <i class="fas fa-lg fa-chart-area"></i> 探索趨勢
                    <span class="badge bg-teal fs-10px">GO</span>
                </a>
            </div>
        </div>
        <!-- end panel -->

        <div class="row mb-2">
            <div class="col-xl-6">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="ui-widget-trends-rise">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="fal fa-code-branch"></i> 每日搜尋趨勢</h4>
                        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
                    </div>
                    <div class="panel-body">
                        <script type="text/javascript"> trends.embed.renderWidget("dailytrends", "", {"geo":"TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <div class="col-xl-6">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-widget-trends-tab">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="fal fa-code-branch"></i> 探索</h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#tab-trends-1" data-bs-toggle="tab" class="nav-link active"><i class="fa fa-newspaper"></i> <span class="d-none d-md-inline">新聞</span></a></li>
                            <li class="nav-item"><a href="#tab-trends-2" data-bs-toggle="tab" class="nav-link"><i class="fa fa-map-marker"></i> <span class="d-none d-md-inline">網頁</span></a></li>
                            <li class="nav-item"><a href="#tab-trends-3" data-bs-toggle="tab" class="nav-link"><i class="fab fa-youtube"></i> <span class="d-none d-md-inline">YOUTUBE</span></a></li>
                            <li class="nav-item"><a href="#tab-trends-4" data-bs-toggle="tab" class="nav-link"><i class="fa fa-shopping-cart"></i> <span class="d-none d-md-inline">購物</span></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-trends-1">
                                <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":"news"}, {"exploreQuery":"date=today%203-m&geo=TW&gprop=news","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                            </div>
                            <div class="tab-pane fade" id="tab-trends-2">
                                <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":""}, {"exploreQuery":"date=today%203-m&geo=TW","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                            </div>
                            <div class="tab-pane fade" id="tab-trends-3">
                                <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":"youtube"}, {"exploreQuery":"date=today%203-m&geo=TW&gprop=youtube","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                            </div>
                            <div class="tab-pane fade" id="tab-trends-4">
                                <script type="text/javascript"> trends.embed.renderExploreWidget("RELATED_QUERIES", {"comparisonItem":[{"geo":"TW","time":"today 3-m"}],"category":0,"property":"froogle"}, {"exploreQuery":"date=today%203-m&geo=TW&gprop=froogle","guestPath":"https://trends.google.com.tw:443/trends/embed/"}); </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END panel -->
            </div>
        </div>

        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-widget-reset">
            <div class="panel-heading">
                <h4 class="panel-title">&nbsp;</h4>
                <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
            </div>
            <div class="panel-body">
                <a href="javascript:;" class="text-nowrap btn btn-default d-block w-100 rounded-pill" data-toggle="reset-local-storage"><b>重設版面</b></a>
            </div>
        </div>
        <!-- end panel -->


    </div>
    <div class="col-xl-5">
        <!-- begin panel -->
        <div class="panel panel-default" data-sortable-id="ui-widget-weather">
            <div class="panel-heading">
                <h4 class="panel-title"><i class="fas fa-clouds"></i> Weather</h4>
                <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
            </div>
            <div class="panel-body">
                <a class="weatherwidget-io" href="https://forecast7.com/zh_TW/25d03121d57/taipei-city/" data-label_1="Taiwan" data-label_2="WEATHER" data-font="微軟正黑體 (Microsoft JhengHei)" data-icons="Climacons" data-theme="pure" >Taiwan WEATHER</a>
                <script>
                    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                </script>
            </div>
        </div>
        <!-- end panel -->

        <div class="row mb-2">
            <div class="col-xl-6">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-enable">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
                    </div>
                    <div class="panel-body cl_red_n" style=" color:#FFF; overflow: hidden;">
                        <div class="stats-icon stats-icon-lg" style="font-size: 128px;right: 0px;color: #fff;width: 128px;height: 50px; line-height: 50px; text-shadow: 3px 7px rgba(0,0,0,0.25);opacity: .15; float:right;"><i class="fa fa-user fa-fw"></i></div>
                        <div class="box" style="margin:0; background-color:transparent">
                            <!-- default, danger, warning, info, success -->

                            <div class="box-title">
                                <!-- add .noborder class if box-body is removed -->
                                <h4 style="color:#FFF"><?php echo $row_RecordAccount['name'];?></h4>
                                <small class="block">&nbsp;</small> <i class="fa fa-address-book-o" aria-hidden="true"></i> </div>
                            <div class="box-body text-left" style="height: 60px;"> 啟用日：
                                <?php if($row_RecordAccount['webenabledate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['webenabledate']); echo $dt->format('Y-m-d');} ?>
                                /

                                續約日：
                                <?php if($row_RecordAccount['webrenewdate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['webrenewdate']); echo $dt->format('Y-m-d');} ?>
                                <br>
                                到期日：
                                <?php
                                if($row_RecordAccount['webrenewdate'] == ''){$row_RecordAccount['webrenewdate'] = $row_RecordAccount['webenabledate'];}
                                if($row_RecordAccount['usetime'] == ''){$row_RecordAccount['usetime'] = 0;}
                                if($row_RecordAccount['webenabledate'] != ''){
                                    $endday = count_date($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
                                    echo $endday;
                                } else { echo "------";}
                                ?>
                                /
                                尚餘天數：
                                <?php if ($row_RecordAccount['webrenewdate'] != '' && $row_RecordAccount['usetime'] != '') { ?>
                                    <?php
                                    $t_end = count_date($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
                                    $t_now = date("Y-m-d");
                                    $t_dt = margin($t_now, $t_end);
                                    //echo $t_dt;
                                    ?>
                                    <?php
                                    if($t_dt <= 0){
                                        $t_dt = 0;
                                        ?>
                                        <strong><?php echo $t_dt . "天"; ?></strong><span style="background-color:#999; color:#FFF; padding:2px; margin-left:5px;"><?php echo '已到期'; ?></span>
                                        <?php
                                    } else if ($t_dt <= 90){
                                        ?>
                                        <strong><?php echo $t_dt . "天"; ?></strong><span style=" background-color:#FF9933; color:#FFF; padding:2px; margin-left:5px;"><?php echo '<三個月'; ?></span>
                                        <?php
                                    } else if ($t_dt <= 30){
                                        ?>
                                        <strong><?php echo $t_dt . "天"; ?></strong><span style=" background-color:#C00; color:#FFF; padding:2px; margin-left:5px;"><?php echo '<一個月'; ?></span>
                                        <?php
                                    } else {
                                        ?>
                                        <?php echo $t_dt . "天"; ?>
                                        <?php
                                    }
                                    ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <div class="col-xl-6">
                <!-- begin panel -->
                <div class="panel panel-default" data-sortable-id="ui-widget-count">
                    <div class="panel-heading">
                        <h4 class="panel-title">&nbsp;</h4>
                        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
                    </div>
                    <div class="panel-body cl_orange_n" style=" color:#FFF; overflow: hidden;">
                        <div class="stats-icon stats-icon-lg" style="font-size: 128px;right: 0px;color: #fff;width: 128px;height: 50px; line-height: 50px; text-shadow: 3px 7px rgba(0,0,0,0.25);opacity: .15; float:right;"><i class="fa fa-signal fa-fw"></i></div>
                        <div class="box" style="margin:0; background-color:transparent;">

                            <!-- default, danger, warning, info, success -->

                            <div class="box-title">
                                <!-- add .noborder class if box-body is removed -->
                                <h4 style="color:#FFF"><?php echo $row_RecordAccount['hot'];?> 總瀏覽人次</h4>
                                <small class="block">&nbsp;</small> <i class="fa fa-bar-chart-o"></i> </div>
                            <div class="box-body text-left" style="height: 60px;"> 今日：<?php echo $row_RecordAccount['nhot'];?> /
                                昨日：<?php echo $row_RecordAccount['yhot'];?> /
                                本月：<?php echo $row_RecordAccount['yhot'];?> /
                                上月：<?php echo $row_RecordAccount['ymhot'];?> </div>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>

        <!-- begin panel -->
        <div class="panel panel-default" data-sortable-id="ui-widget-overview">
            <div class="panel-heading">
                <h4 class="panel-title">OverView</h4>
                <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
            </div>
            <div class="panel-body">
                <?php //require_once("require_overview_list2.php"); ?>
            </div>
        </div>
        <!-- end panel -->

        <!-- BEGIN panel -->
        <div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-widget-trends-speedup">
            <div class="panel-heading">
                <h4 class="panel-title"><i class="fal fa-code-branch"></i> <?php echo date("Y")-1; ?> 年度排行</h4>
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#tab-trends-speed-1" data-bs-toggle="tab" class="nav-link active"><i class="fas fa-key"></i> <span class="d-none d-md-inline">關鍵字</span></a></li>
                    <li class="nav-item"><a href="#tab-trends-speed-2" data-bs-toggle="tab" class="nav-link"><i class="fas fa-users"></i> <span class="d-none d-md-inline">人物</span></a></li>
                    <li class="nav-item"><a href="#tab-trends-speed-3" data-bs-toggle="tab" class="nav-link"><i class="fas fa-user-secret"></i> <span class="d-none d-md-inline">政治人物</span></a></li>
                    <li class="nav-item"><a href="#tab-trends-speed-4" data-bs-toggle="tab" class="nav-link"><i class="fas fa-quote-right"></i> <span class="d-none d-md-inline">議題</span></a></li>
                    <li class="nav-item"><a href="#tab-trends-speed-5" data-bs-toggle="tab" class="nav-link"><i class="fas fa-video"></i> <span class="d-none d-md-inline">戲劇</span></a></li>
                    <li class="nav-item"><a href="#tab-trends-speed-6" data-bs-toggle="tab" class="nav-link"><i class="fas fa-camera-movie"></i> <span class="d-none d-md-inline">電影</span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-trends-speed-1">
                        <script type="text/javascript"> trends.embed.renderTopChartsWidget("88cd19ae-3328-4deb-a066-fcd6b2cd26d0", {"geo":"TW","guestPath":"https://trends.google.com:443/trends/embed/"}, <?php echo date("Y")-1; ?>); </script>
                    </div>
                    <div class="tab-pane fade" id="tab-trends-speed-2">
                        <script type="text/javascript"> trends.embed.renderTopChartsWidget("3d4093a3-cb79-44c3-b183-f6a6874eb71b", {"geo":"TW","guestPath":"https://trends.google.com:443/trends/embed/"}, <?php echo date("Y")-1; ?>); </script>
                    </div>
                    <div class="tab-pane fade" id="tab-trends-speed-3">
                        <script type="text/javascript"> trends.embed.renderTopChartsWidget("5cc344f7-63e2-433b-8bf2-53a61cd88392", {"geo":"TW","guestPath":"https://trends.google.com:443/trends/embed/"}, <?php echo date("Y")-1; ?>); </script>
                    </div>
                    <div class="tab-pane fade" id="tab-trends-speed-4">
                        <script type="text/javascript"> trends.embed.renderTopChartsWidget("b2594324-41f2-4494-bc99-4f7e066f82f9", {"geo":"TW","guestPath":"https://trends.google.com:443/trends/embed/"}, <?php echo date("Y")-1; ?>); </script>
                    </div>
                    <div class="tab-pane fade" id="tab-trends-speed-5">
                        <script type="text/javascript"> trends.embed.renderTopChartsWidget("5f753780-a668-402a-8a86-4e58928a5331", {"geo":"TW","guestPath":"https://trends.google.com:443/trends/embed/"}, <?php echo date("Y")-1; ?>); </script>
                    </div>
                    <div class="tab-pane fade" id="tab-trends-speed-6">
                        <script type="text/javascript"> trends.embed.renderTopChartsWidget("7b8753a7-b33d-4e7a-89d5-1a965a1b6a58", {"geo":"TW","guestPath":"https://trends.google.com:443/trends/embed/"}, <?php echo date("Y")-1; ?>); </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- END panel -->

        <!-- begin panel -->
        <div class="panel panel-default" data-sortable-id="ui-widget-calendar">
            <div class="panel-heading">
                <h4 class="panel-title">Calendar</h4>
                <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
            </div>
            <div class="panel-body">
                <div id="datepicker-inline" class="datepicker-full-width overflow-y-scroll position-relative"><div></div></div>
            </div>
        </div>
        <!-- end panel -->


    </div>
</div>
