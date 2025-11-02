<?php

use App\Eloquent\Admin\Modules;
use App\Eloquent\Admin\Routes;

$useModuleUri = $request->input('useModuleUri');
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>


<?php

/*foreach($RecordModules as $row_RecordModules) {

    $results = Routes::select('*')
        ->where('module_uri', '=', $row_RecordModules['uri'])
        ->where('prefix', '=', 'admin')
        ->where(function ($query) {
            $query->where('userid', '=', $_SESSION['w_userid'])
                ->orWhere('userid', '=', '1');
        })
        ->get();

    echo '$uri[\'' . $row_RecordModules['uri'] . '\'] = [';
    foreach ($results as $result) {
        echo '\'' . $result['uri'] . '\', ';
    }
    echo '];';
    echo '<br>';

echo '$controller_action[\'' . $row_RecordModules['uri'] . '\'] = [';
    foreach ($results as $result) {
        echo '\'' . $result['controller_action'] . '\', ';
    }
    echo '];';
    echo '<br>';

echo '$name[\'' . $row_RecordModules['uri'] . '\'] = [';
    foreach ($results as $result) {
        echo '\'' . $result['name'] . '\', ';
    }
    echo '];';
    echo '<br><br>';

}*/



/*foreach($RecordModules as $row_RecordModules) {

    $results = Routes::select('*')
        ->where('module_uri', '=', $row_RecordModules['uri'])
        ->where('prefix', '=', '')
        ->where(function ($query) {
            $query->where('userid', '=', $_SESSION['w_userid'])
                ->orWhere('userid', '=', '1');
        })
        ->get();

    echo '$uri[\'' . $row_RecordModules['uri'] . '\'] = [';
    foreach ($results as $result) {
        echo '\'' . $result['uri'] . '\', ';
    }
    echo '];';
    echo '<br>';

echo '$controller_action[\'' . $row_RecordModules['uri'] . '\'] = [';
    foreach ($results as $result) {
        echo '\'' . $result['controller_action'] . '\', ';
    }
    echo '];';
    echo '<br>';

echo '$name[\'' . $row_RecordModules['uri'] . '\'] = [';
    foreach ($results as $result) {
        echo '\'' . $result['name'] . '\', ';
    }
    echo '];';
    echo '<br><br>';

}*/




?>



<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">

        <ul class="nav nav-tabs nav-tabs-v2 px-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#tab-1" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">
                    <span class="d-sm-block"><i class="fa-solid fa-road-spikes"></i> 路由(後)</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tab-2" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                    <span class="d-sm-block"><i class="fa-solid fa-road-spikes"></i> 路由(前)</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tab-3" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                    <span class="d-sm-block"><i class="fa-solid fa-layer-group"></i> 選單(後)</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#tab-4" data-bs-toggle="tab" class="nav-link" aria-selected="false" role="tab" tabindex="-1">
                    <span class="d-sm-block"><i class="fa-solid fa-layer-group"></i> 選單(前)</span>
                </a>
            </li>
        </ul>

        <div class="tab-content panel rounded-0 p-0 m-0">
            <div class="tab-pane fade active show" id="tab-1" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th nowrap="">name</th>
                            <th nowrap="">prefix</th>
                            <th nowrap="">uri</th>
                            <th nowrap="">controller_name</th>
                            <th nowrap="">controller_action</th>
                            <th nowrap="">middleware</th>
                            <th nowrap="">methods</th>
                            <th nowrap="">user_group</th>
                            <th nowrap="">module_class</th>
                            <th nowrap="">postdate</th>
                            <th nowrap="">indicate</th>
                            <th nowrap="">notes1</th>
                            <th nowrap="">sortid</th>
                            <th nowrap="">module_uri</th>
                            <th nowrap="">lang</th>
                            <th nowrap="">userid</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($RecordModules as $row_RecordModules) { ?>
                            <?php
                            $uri=[];
                            $controller_action=[];
                            $name=[];
                            //$i=1;
                            $prefix = 'admin';
                            $lang = 'zh_TW';
                            $userid = '1';
                            $sortid = '50';
                            $indicate = '1';
                            //$name = 'admin.'.toSpinalCase($row_RecordModules['uri']);
                            $methods = 'get,post';

                            $uri['Routes'] = ['routes', 'routes/add', 'routes/edit/{id}', 'routes/list', 'routes/listitem/{list_id}', 'routes/upload/{id}', 'routes/copy/{module_uri}', 'routes/delete', 'routes/db-show', ];
                            $controller_action['Routes'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', 'dbShow', ];
                            $name['Routes'] = ['admin.routes.index', 'admin.routes.add', 'admin.routes.edit', 'admin.routes.list', 'admin.routes.listitem', 'admin.routes.upload', 'admin.routes.copy', 'admin.routes.delete', 'admin.routes.db-show', ];

                            $uri['MenuBackend'] = ['menu-backend', 'menu-backend/add', 'menu-backend/edit/{id}', 'menu-backend/list', 'menu-backend/listitem/{list_id}', 'menu-backend/upload/{id}', 'menu-backend/sort', 'menu-backend/copy/{id}', 'menu-backend/muti-copy/{module_uri}', 'menu-backend/delete', ];
                            $controller_action['MenuBackend'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'sort', 'copy', 'mutiCopy', 'delete', ];
                            $name['MenuBackend'] = ['admin.menu-backend.index', 'admin.menu-backend.add', 'admin.menu-backend.edit', 'admin.menu-backend.list', 'admin.menu-backend.listitem', 'admin.menu-backend.upload', 'admin.menu-backend.sort', 'admin.menu-backend.copy', 'admin.menu-backend.muti-copy', 'admin.menu-backend.delete', ];

                            $uri['Modules'] = ['modules', 'modules/add', 'modules/edit/{id}', 'modules/copy/{id}', 'modules/list', 'modules/listitem/{list_id}', 'modules/upload/{id}', 'modules/delete', ];
                            $controller_action['Modules'] = ['index', 'add', 'edit', 'copy', 'list', 'listitem', 'upload', 'delete', ];
                            $name['Modules'] = ['admin.modules.index', 'admin.modules.add', 'admin.modules.edit', 'admin.modules.copy', 'admin.modules.list', 'admin.modules.listitem', 'admin.modules.upload', 'admin.modules.delete', ];

                            $uri['About'] = ['about', 'about/add', 'about/edit/{id}', 'about/list', 'about/listitem/{list_id}', 'about/upload/{id}', 'about/copy/{id}', 'about/start', 'about/delete', ];
                            $controller_action['About'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'start', 'delete', ];
                            $name['About'] = ['admin.about.index', 'admin.about.add', 'admin.about.edit', 'admin.about.list', 'admin.about.listitem', 'admin.about.upload', 'admin.about.copy', 'admin.about.start', 'admin.about.delete', ];

                            $uri['News'] = ['news/upload/{id}', 'news/list', 'news/listitem/{list_id}', 'news/edit/{id}', 'news/add', 'news', 'news/copy/{id}', 'news/delete', 'news/multi-listitem/{list_id}/{parent_id?}', ];
                            $controller_action['News'] = ['upload', 'list', 'listitem', 'edit', 'add', 'index', 'copy', 'delete', 'sublistitem', ];
                            $name['News'] = ['admin.news.upload', 'admin.news.list', 'admin.news.listitem', 'admin.news.edit', 'admin.news.add', 'admin.news.index', 'admin.news.copy', 'admin.news.delete', 'admin.news.sublistitem', ];

                            $uri['TestModel'] = ['test-model/upload/{id}', 'test-model/list', 'test-model/listitem/{list_id}', 'test-model/edit/{id}', 'test-model/add', 'test-model', 'test-model/copy/{id}', 'test-model/delete', 'test-model/multi-listitem/{list_id}/{parent_id?}', ];
                            $controller_action['TestModel'] = ['upload', 'list', 'listitem', 'edit', 'add', 'index', 'copy', 'delete', 'sublistitem', ];
                            $name['TestModel'] = ['admin.test-model.upload', 'admin.test-model.list', 'admin.test-model.listitem', 'admin.test-model.edit', 'admin.test-model.add', 'admin.test-model.index', 'admin.test-model.copy', 'admin.test-model.delete', 'admin.test-model.sublistitem', ];

                            $uri['ActNews'] = ['act-news', 'act-news/add', 'act-news/edit/{id}', 'act-news/list', 'act-news/listitem/{list_id}', 'act-news/upload/{id}', 'act-news/copy/{id}', 'act-news/delete', ];
                            $controller_action['ActNews'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['ActNews'] = ['admin.act-news.index', 'admin.act-news.add', 'admin.act-news.edit', 'admin.act-news.list', 'admin.act-news.listitem', 'admin.act-news.upload', 'admin.act-news.copy', 'admin.act-news.delete', ];

                            $uri['Product'] = ['product', 'product/add', 'product/edit/{id}', 'product/list', 'product/listitem/{list_id}', 'product/upload/{id}', 'product/copy/{id}', 'product/delete', ];
                            $controller_action['Product'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Product'] = ['admin.product.index', 'admin.product.add', 'admin.product.edit', 'admin.product.list', 'admin.product.listitem', 'admin.product.upload', 'admin.product.copy', 'admin.product.delete', ];

                            $uri['FriLink'] = ['fri-link', 'fri-link/add', 'fri-link/edit/{id}', 'fri-link/list', 'fri-link/listitem/{list_id}', 'fri-link/upload/{id}', 'fri-link/copy/{id}', 'fri-link/delete', ];
                            $controller_action['FriLink'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['FriLink'] = ['admin.fri-link.index', 'admin.fri-link.add', 'admin.fri-link.edit', 'admin.fri-link.list', 'admin.fri-link.listitem', 'admin.fri-link.upload', 'admin.fri-link.copy', 'admin.fri-link.delete', ];

                            $uri['Contact'] = [];
                            $controller_action['Contact'] = [];
                            $name['Contact'] = [];

                            $uri['Bulletin'] = ['bulletin', 'bulletin/add', 'bulletin/edit/{id}', 'bulletin/list', 'bulletin/listitem/{list_id}', 'bulletin/upload/{id}', 'bulletin/copy/{id}', 'bulletin/delete', ];
                            $controller_action['Bulletin'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Bulletin'] = ['admin.bulletin.index', 'admin.bulletin.add', 'admin.bulletin.edit', 'admin.bulletin.list', 'admin.bulletin.listitem', 'admin.bulletin.upload', 'admin.bulletin.copy', 'admin.bulletin.delete', ];

                            $uri['Cart'] = [];
                            $controller_action['Cart'] = [];
                            $name['Cart'] = [];

                            $uri['SocialChat'] = [];
                            $controller_action['SocialChat'] = [];
                            $name['SocialChat'] = [];

                            $uri['History'] = ['history', 'history/add', 'history/edit/{id}', 'history/list', 'history/listitem/{list_id}', 'history/upload/{id}', 'history/copy/{id}', 'history/delete', ];
                            $controller_action['History'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['History'] = ['admin.history.index', 'admin.history.add', 'admin.history.edit', 'admin.history.list', 'admin.history.listitem', 'admin.history.upload', 'admin.history.copy', 'admin.history.delete', ];

                            $uri['ImageShow'] = ['image-show', 'image-show/add', 'image-show/edit/{id}', 'image-show/list', 'image-show/listitem/{list_id}', 'image-show/upload/{id}', 'image-show/copy/{id}', 'image-show/delete', ];
                            $controller_action['ImageShow'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['ImageShow'] = ['admin.image-show.index', 'admin.image-show.add', 'admin.image-show.edit', 'admin.image-show.list', 'admin.image-show.listitem', 'admin.image-show.upload', 'admin.image-show.copy', 'admin.image-show.delete', ];

                            $uri['Album'] = ['album', 'album/add', 'album/edit/{id}', 'album/list', 'album/listitem/{list_id}', 'album/upload/{id}', 'album/copy/{id}', 'album/delete', ];
                            $controller_action['Album'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Album'] = ['admin.album.index', 'admin.album.add', 'admin.album.edit', 'admin.album.list', 'admin.album.listitem', 'admin.album.upload', 'admin.album.copy', 'admin.album.delete', ];

                            $uri['Org'] = ['org', 'org/add', 'org/edit/{id}', 'org/list', 'org/listitem/{list_id}', 'org/upload/{id}', 'org/copy/{id}', 'org/delete', ];
                            $controller_action['Org'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Org'] = ['admin.org.index', 'admin.org.add', 'admin.org.edit', 'admin.org.list', 'admin.org.listitem', 'admin.org.upload', 'admin.org.copy', 'admin.org.delete', ];

                            $uri['Video'] = ['video', 'video/add', 'video/edit/{id}', 'video/list', 'video/listitem/{list_id}', 'video/upload/{id}', 'video/copy/{id}', 'video/delete', ];
                            $controller_action['Video'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Video'] = ['admin.video.index', 'admin.video.add', 'admin.video.edit', 'admin.video.list', 'admin.video.listitem', 'admin.video.upload', 'admin.video.copy', 'admin.video.delete', ];

                            $uri['Sponsor'] = ['sponsor', 'sponsor/add', 'sponsor/edit/{id}', 'sponsor/list', 'sponsor/listitem/{list_id}', 'sponsor/upload/{id}', 'sponsor/copy/{id}', 'sponsor/delete', ];
                            $controller_action['Sponsor'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Sponsor'] = ['admin.sponsor.index', 'admin.sponsor.add', 'admin.sponsor.edit', 'admin.sponsor.list', 'admin.sponsor.listitem', 'admin.sponsor.upload', 'admin.sponsor.copy', 'admin.sponsor.delete', ];

                            $uri['Carees'] = ['carees', 'carees/add', 'carees/edit/{id}', 'carees/list', 'carees/listitem/{list_id}', 'carees/upload/{id}', 'carees/copy/{id}', 'carees/delete', ];
                            $controller_action['Carees'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Carees'] = ['admin.carees.index', 'admin.carees.add', 'admin.carees.edit', 'admin.carees.list', 'admin.carees.listitem', 'admin.carees.upload', 'admin.carees.copy', 'admin.carees.delete', ];

                            $uri['Guestbook'] = ['guestbook', 'guestbook/add', 'guestbook/edit/{id}', 'guestbook/list', 'guestbook/listitem/{list_id}', 'guestbook/upload/{id}', 'guestbook/copy/{id}', 'guestbook/delete', ];
                            $controller_action['Guestbook'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Guestbook'] = ['admin.guestbook.index', 'admin.guestbook.add', 'admin.guestbook.edit', 'admin.guestbook.list', 'admin.guestbook.listitem', 'admin.guestbook.upload', 'admin.guestbook.copy', 'admin.guestbook.delete', ];

                            $uri['Activities'] = ['activities', 'activities/add', 'activities/edit/{id}', 'activities/list', 'activities/listitem/{list_id}', 'activities/upload/{id}', 'activities/copy/{id}', 'activities/delete', ];
                            $controller_action['Activities'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Activities'] = ['admin.activities.index', 'admin.activities.add', 'admin.activities.edit', 'admin.activities.list', 'admin.activities.listitem', 'admin.activities.upload', 'admin.activities.copy', 'admin.activities.delete', ];

                            $uri['Publish'] = ['publish', 'publish/add', 'publish/edit/{id}', 'publish/list', 'publish/listitem/{list_id}', 'publish/upload/{id}', 'publish/copy/{id}', 'publish/delete', ];
                            $controller_action['Publish'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Publish'] = ['admin.publish.index', 'admin.publish.add', 'admin.publish.edit', 'admin.publish.list', 'admin.publish.listitem', 'admin.publish.upload', 'admin.publish.copy', 'admin.publish.delete', ];

                            $uri['Otrlink'] = ['otr-link', 'otr-link/add', 'otr-link/edit/{id}', 'otr-link/list', 'otr-link/listitem/{list_id}', 'otr-link/upload/{id}', 'otr-link/copy/{id}', 'otr-link/delete', ];
                            $controller_action['Otrlink'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Otrlink'] = ['admin.otr-link.index', 'admin.otr-link.add', 'admin.otr-link.edit', 'admin.otr-link.list', 'admin.otr-link.listitem', 'admin.otr-link.upload', 'admin.otr-link.copy', 'admin.otr-link.delete', ];

                            $uri['Article'] = ['article', 'article/add', 'article/edit/{id}', 'article/list', 'article/listitem/{list_id}', 'article/upload/{id}', 'article/copy/{id}', 'article/delete', ];
                            $controller_action['Article'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Article'] = ['admin.article.index', 'admin.article.add', 'admin.article.edit', 'admin.article.list', 'admin.article.listitem', 'admin.article.upload', 'admin.article.copy', 'admin.article.delete', ];

                            $uri['Letters'] = ['letters', 'letters/add', 'letters/edit/{id}', 'letters/list', 'letters/listitem/{list_id}', 'letters/upload/{id}', 'letters/copy/{id}', 'letters/delete', ];
                            $controller_action['Letters'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Letters'] = ['admin.letters.index', 'admin.letters.add', 'admin.letters.edit', 'admin.letters.list', 'admin.letters.listitem', 'admin.letters.upload', 'admin.letters.copy', 'admin.letters.delete', ];

                            $uri['Faq'] = ['faq', 'faq/add', 'faq/edit/{id}', 'faq/list', 'faq/listitem/{list_id}', 'faq/upload/{id}', 'faq/copy/{id}', 'faq/delete', ];
                            $controller_action['Faq'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Faq'] = ['admin.faq.index', 'admin.faq.add', 'admin.faq.edit', 'admin.faq.list', 'admin.faq.listitem', 'admin.faq.upload', 'admin.faq.copy', 'admin.faq.delete', ];

                            $uri['Partner'] = ['partner', 'partner/add', 'partner/edit/{id}', 'partner/list', 'partner/listitem/{list_id}', 'partner/upload/{id}', 'partner/copy/{id}', 'partner/delete', ];
                            $controller_action['Partner'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Partner'] = ['admin.partner.index', 'admin.partner.add', 'admin.partner.edit', 'admin.partner.list', 'admin.partner.listitem', 'admin.partner.upload', 'admin.partner.copy', 'admin.partner.delete', ];

                            $uri['Artlist'] = ['art-list', 'art-list/add', 'art-list/edit/{id}', 'art-list/list', 'art-list/listitem/{list_id}', 'art-list/upload/{id}', 'art-list/copy/{id}', 'art-list/delete', ];
                            $controller_action['Artlist'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Artlist'] = ['admin.art-list.index', 'admin.art-list.index', 'admin.art-list.edit', 'admin.art-list.list', 'admin.art-list.listitem', 'admin.art-list.upload', 'admin.art-list.copy', 'admin.art-list.delete', ];

                            $uri['Forum'] = [];
                            $controller_action['Forum'] = [];
                            $name['Forum'] = [];

                            $uri['Knowledge'] = ['knowledge', 'knowledge/add', 'knowledge/edit/{id}', 'knowledge/list', 'knowledge/listitem/{list_id}', 'knowledge/upload/{id}', 'knowledge/copy/{id}', 'knowledge/delete', ];
                            $controller_action['Knowledge'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Knowledge'] = ['admin.knowledge.index', 'admin.knowledge.add', 'admin.knowledge.edit', 'admin.knowledge.list', 'admin.knowledge.listitem', 'admin.knowledge.upload', 'admin.knowledge.copy', 'admin.knowledge.delete', ];

                            $uri['Project'] = ['project', 'project/add', 'project/edit/{id}', 'project/list', 'project/listitem/{list_id}', 'project/upload/{id}', 'project/copy/{id}', 'project/delete', ];
                            $controller_action['Project'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Project'] = ['admin.project.index', 'admin.project.add', 'admin.project.edit', 'admin.project.list', 'admin.project.listitem', 'admin.project.upload', 'admin.project.copy', 'admin.project.delete', ];

                            $uri['Catalog'] = ['catalog', 'catalog/add', 'catalog/edit/{id}', 'catalog/list', 'catalog/listitem/{list_id}', 'catalog/upload/{id}', 'catalog/copy/{id}', 'catalog/delete', ];
                            $controller_action['Catalog'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Catalog'] = ['admin.catalog.index', 'admin.catalog.add', 'admin.catalog.edit', 'admin.catalog.list', 'admin.catalog.listitem', 'admin.catalog.upload', 'admin.catalog.copy', 'admin.catalog.delete', ];

                            $uri['Stronghold'] = ['stronghold', 'stronghold/add', 'stronghold/edit/{id}', 'stronghold/list', 'stronghold/listitem/{list_id}', 'stronghold/upload/{id}', 'stronghold/copy/{id}', 'stronghold/delete', ];
                            $controller_action['Stronghold'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Stronghold'] = ['admin.stronghold.index', 'admin.stronghold.add', 'admin.stronghold.edit', 'admin.stronghold.list', 'admin.stronghold.listitem', 'admin.stronghold.upload', 'admin.stronghold.copy', 'admin.stronghold.delete', ];

                            $uri['Dealer'] = ['dealer', 'dealer/add', 'dealer/edit/{id}', 'dealer/list', 'dealer/listitem/{list_id}', 'dealer/upload/{id}', 'dealer/copy/{id}', 'dealer/delete', ];
                            $controller_action['Dealer'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Dealer'] = ['admin.dealer.index', 'admin.dealer.add', 'admin.dealer.edit', 'admin.dealer.list', 'admin.dealer.listitem', 'admin.dealer.upload', 'admin.dealer.copy', 'admin.dealer.delete', ];

                            $uri['BannerShow'] = [];
                            $controller_action['BannerShow'] = [];
                            $name['BannerShow'] = [];

                            $uri['Banner'] = ['banner', 'banner/add', 'banner/edit/{id}', 'banner/list', 'banner/listitem/{list_id}', 'banner/upload/{id}', 'banner/delete', ];
                            $controller_action['Banner'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'delete', ];
                            $name['Banner'] = ['admin.banner.index', 'admin.banner.add', 'admin.banner.edit', 'admin.banner.list', 'admin.banner.listitem', 'admin.banner.upload', 'admin.banner.delete', ];

                            $uri['Logo'] = [];
                            $controller_action['Logo'] = [];
                            $name['Logo'] = [];

                            $uri['Tmp'] = ['tmp', 'tmp/add', 'tmp/edit/{id}', 'tmp/list', 'tmp/listitem/{list_id}', 'tmp/upload/{id}', 'tmp/copy/{id}', 'tmp/delete', 'tmp/select-theme', 'tmp/config-theme/{theme}/{mainLayout}/{id}', ];
                            $controller_action['Tmp'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', 'selectTheme', 'configTheme', ];
                            $name['Tmp'] = ['admin.tmp.index', 'admin.tmp.add', 'admin.tmp.edit', 'admin.tmp.list', 'admin.tmp.listitem', 'admin.tmp.upload', 'admin.tmp.copy', 'admin.tmp.delete', 'admin.tmp.select-theme', 'admin.tmp.config-theme', ];

                            $uri['Page'] = ['page', 'page/add', 'page/edit/{id}', 'page/list', 'page/listitem/{list_id}', 'page/upload/{id}', 'page/copy/{id}', 'page/delete', ];
                            $controller_action['Page'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'copy', 'delete', ];
                            $name['Page'] = ['admin.page.index', 'admin.page.index', 'admin.page.edit', 'admin.page.list', 'admin.page.listitem', 'admin.page.upload', 'admin.page.copy', 'admin.page.delete', ];

                            $uri['MenuManagement'] = [];
                            $controller_action['MenuManagement'] = [];
                            $name['MenuManagement'] = [];

                            $uri['Slider'] = [];
                            $controller_action['Slider'] = [];
                            $name['Slider'] = [];

                            $uri['ModLink'] = [];
                            $controller_action['ModLink'] = [];
                            $name['ModLink'] = [];

                            $uri['Member'] = ['member', 'member/add', 'member/edit/{id}', 'member/list', 'member/listitem/{list_id}', 'member/upload/{id}', 'member/delete', ];
                            $controller_action['Member'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'delete', ];
                            $name['Member'] = ['admin.member.index', 'admin.member.add', 'admin.member.edit', 'admin.member.list', 'admin.member.listitem', 'admin.member.upload', 'admin.member.delete', ];

                            $uri['Account'] = [];
                            $controller_action['Account'] = [];
                            $name['Account'] = [];

                            $uri['Permission'] = [];
                            $controller_action['Permission'] = [];
                            $name['Permission'] = [];

                            $uri['Keyword'] = [];
                            $controller_action['Keyword'] = [];
                            $name['Keyword'] = [];

                            $uri['Photo'] = ['photo', 'photo/add', 'photo/edit/{id}', 'photo/upload/{id}', 'photo/delete', ];
                            $controller_action['Photo'] = ['index', 'add', 'edit', 'upload', 'delete', ];
                            $name['Photo'] = ['admin.photo.index', 'admin.photo.add', 'admin.photo.edit', 'admin.photo.upload', 'admin.photo.delete', ];

                            $uri['ListMenu'] = ['list-menu/list', 'list-menu/listitem/{list_id}', 'list-menu/edit/{id}', 'list-menu/add', 'list-menu', 'list-menu/copy/{id}', 'list-menu/delete', ];
                            $controller_action['ListMenu'] = ['list', 'listitem', 'edit', 'add', 'index', 'copy', 'delete', ];
                            $name['ListMenu'] = ['admin.list-menu.list', 'admin.list-menu.listitem', 'admin.list-menu.edit', 'admin.list-menu.add', 'admin.list-menu.index', 'admin.list-menu.copy', 'admin.list-menu.delete', ];

                            $uri['ListItemMenu'] = ['list-item-menu/{module_uri}/{list_alias}/getJsonChildren', 'list-item-menu/edit/{id}', 'list-item-menu/add', 'list-item-menu', 'list-item-menu/copy/{id}', 'list-item-menu/delete', ];
                            $controller_action['ListItemMenu'] = ['getJsonChildren', 'edit', 'add', 'index', 'copy', 'delete', ];
                            $name['ListItemMenu'] = ['admin.list-item-menu.getJsonChildren', 'admin.list-item-menu.edit', 'admin.list-item-menu.add', 'admin.list-item-menu.index', 'admin.list-item-menu.copy', 'admin.list-item-menu.delete', ];

                            $uri['Home'] = ['home', ];
                            $controller_action['Home'] = ['index', ];
                            $name['Home'] = ['admin.home.index', ];

                            $uri['WebUser'] = ['web-user', 'web-user/add', 'web-user/edit/{id}', 'web-user/delete', 'web-user/change-account', 'web-user/change-mod/{id}', 'web-user/change-state/{id}', ];
                            $controller_action['WebUser'] = ['index', 'add', 'edit', 'delete', 'changeAccount', 'changeMod', 'changeState', ];
                            $name['WebUser'] = ['admin.web-user.index', 'admin.web-user.add', 'admin.web-user.edit', 'admin.web-user.delete', 'admin.web-user.change-account', 'admin.web-user.change-mod', 'admin.web-user.change-state', ];

                            $uri['MenuFrontend'] = ['menu-frontend', 'menu-frontend/add', 'menu-frontend/edit/{id}', 'menu-frontend/list', 'menu-frontend/listitem/{list_id}', 'menu-frontend/upload/{id}', 'menu-frontend/delete', ];
                            $controller_action['MenuFrontend'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'delete', ];
                            $name['MenuFrontend'] = ['admin.menu-frontend.index', 'admin.menu-frontend.add', 'admin.menu-frontend.edit', 'admin.menu-frontend.list', 'admin.menu-frontend.listitem', 'admin.menu-frontend.upload', 'admin.menu-frontend.delete', ];

                            $uri['MenuManagement'] = ['menu-management', 'menu-management/add', 'menu-management/edit/{id}', 'menu-management/list', 'menu-management/listitem/{list_id}', 'menu-management/upload/{id}', 'menu-management/delete', ];
                            $controller_action['MenuManagement'] = ['index', 'add', 'edit', 'list', 'listitem', 'upload', 'delete', ];
                            $name['MenuManagement'] = ['admin.menu-management.index', 'admin.menu-management.add', 'admin.menu-management.edit', 'admin.menu-management.list', 'admin.menu-management.listitem', 'admin.menu-management.upload', 'admin.menu-management.delete', ];

                            $uri['SiteSetting'] = ['site-setting', 'site-setting/state', ];
                            $controller_action['SiteSetting'] = ['index', 'state', ];
                            $name['SiteSetting'] = ['admin.site-setting.index', 'admin.site-setting.state', ];



                            foreach($controller_action[$row_RecordModules['uri']] as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $name[$row_RecordModules['uri']][$key];; ?></td>
                                    <td><?php echo $prefix; ?></td>
                                    <td><?php echo $uri[$row_RecordModules['uri']][$key]; ?></td>
                                    <td><?php echo $row_RecordModules['uri']; ?>Controller</td>
                                    <td><?php echo $controller_action[$row_RecordModules['uri']][$key]; ?></td>
                                    <td></td>
                                    <td><?php echo $methods; ?></td>
                                    <td></td>
                                    <td><?php echo $row_RecordModules['class']; ?></td>
                                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                    <td><?php echo $indicate; ?></td>
                                    <td></td>
                                    <td><?php echo $sortid; ?></td>
                                    <td><?php echo $row_RecordModules['uri']; ?></td>
                                    <td><?php echo $lang; ?></td>
                                    <td><?php echo $userid; ?></td>
                                </tr>
                                <?php $i++;  ?>
                            <?php }  ?>
                            <?php $i++;  ?>
                        <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th nowrap="">name</th>
                            <th nowrap="">prefix</th>
                            <th nowrap="">uri</th>
                            <th nowrap="">controller_name</th>
                            <th nowrap="">controller_action</th>
                            <th nowrap="">middleware</th>
                            <th nowrap="">methods</th>
                            <th nowrap="">user_group</th>
                            <th nowrap="">module_class</th>
                            <th nowrap="">postdate</th>
                            <th nowrap="">indicate</th>
                            <th nowrap="">notes1</th>
                            <th nowrap="">sortid</th>
                            <th nowrap="">module_uri</th>
                            <th nowrap="">lang</th>
                            <th nowrap="">userid</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($RecordModules as $row_RecordModules) { ?>
                            <?php
                            $uri=[];
                            $controller_action=[];
                            $name=[];
                            //$i=1;
                            $prefix = '';
                            $lang = 'zh_TW';
                            $userid = '1';
                            $sortid = '50';
                            $indicate = '1';
                            //$name = 'admin.'.toSpinalCase($row_RecordModules['uri']);
                            $methods = 'get,post';


                            $uri['Routes'] = [];
                            $controller_action['Routes'] = [];
                            $name['Routes'] = [];

                            $uri['MenuBackend'] = [];
                            $controller_action['MenuBackend'] = [];
                            $name['MenuBackend'] = [];

                            $uri['Modules'] = [];
                            $controller_action['Modules'] = [];
                            $name['Modules'] = [];

                            $uri['About'] = ['about', 'about/detailed/{id}', ];
                            $controller_action['About'] = ['index', 'detailed', ];
                            $name['About'] = ['about.index', 'about.detailed', ];

                            $uri['News'] = ['news', 'news/detailed/{id}', ];
                            $controller_action['News'] = ['index', 'detailed', ];
                            $name['News'] = ['news.index', 'news.detailed', ];

                            $uri['ActNews'] = ['act-news', 'act-news/detailed/{id}', ];
                            $controller_action['ActNews'] = ['index', 'detailed', ];
                            $name['ActNews'] = ['act-news.index', 'act-news.detailed', ];

                            $uri['Product'] = ['product', 'product', ];
                            $controller_action['Product'] = ['index', 'detailed', ];
                            $name['Product'] = ['product.index', 'product.detailed', ];

                            $uri['FriLink'] = ['fri-link', 'fri-link/detailed/{id}', ];
                            $controller_action['FriLink'] = ['index', 'detailed', ];
                            $name['FriLink'] = ['fri-link.index', 'fri-link.detailed', ];

                            $uri['Contact'] = ['contact', ];
                            $controller_action['Contact'] = ['index', ];
                            $name['Contact'] = ['contact.index', ];

                            $uri['Bulletin'] = ['bulletin', 'bulletin/detailed/{id}', ];
                            $controller_action['Bulletin'] = ['index', 'detailed', ];
                            $name['Bulletin'] = ['bulletin.index', 'bulletin.detailed', ];

                            $uri['Cart'] = [];
                            $controller_action['Cart'] = [];
                            $name['Cart'] = [];

                            $uri['SocialChat'] = [];
                            $controller_action['SocialChat'] = [];
                            $name['SocialChat'] = [];

                            $uri['History'] = ['history', 'history/detailed/{id}',];
                            $controller_action['History'] = ['index', 'detailed',];
                            $name['History'] = ['history.index', 'history.detailed', ];

                            $uri['ImageShow'] = ['image-show', 'image-show/detailed/{id}', ];
                            $controller_action['ImageShow'] = ['index', 'detailed', ];
                            $name['ImageShow'] = ['image-show.index', 'image-show.detailed', ];

                            $uri['Album'] = ['album', 'album/detailed/{id}', ];
                            $controller_action['Album'] = ['index', 'detailed', ];
                            $name['Album'] = ['album.index', 'album.detailed', ];

                            $uri['Org'] = ['org', 'org/detailed/{id}', ];
                            $controller_action['Org'] = ['index', 'detailed', ];
                            $name['Org'] = ['org.index', 'org.detailed', ];

                            $uri['Video'] = ['video', 'video/detailed/{id}', ];
                            $controller_action['Video'] = ['index', 'detailed', ];
                            $name['Video'] = ['video.index', 'video.detailed', ];

                            $uri['Sponsor'] = ['sponsor', 'sponsor/detailed/{id}', ];
                            $controller_action['Sponsor'] = ['index', 'detailed', ];
                            $name['Sponsor'] = ['sponsor.index', 'sponsor.detailed', ];

                            $uri['Carees'] = ['carees', 'carees/detailed/{id}', ];
                            $controller_action['Carees'] = ['index', 'detailed', ];
                            $name['Carees'] = ['carees.index', 'carees.detailed', ];

                            $uri['Guestbook'] = [];
                            $controller_action['Guestbook'] = [];
                            $name['Guestbook'] = [];

                            $uri['Activities'] = ['activities', 'activities/detailed/{id}', ];
                            $controller_action['Activities'] = ['index', 'detailed', ];
                            $name['Activities'] = ['activities.index', 'activities.detailed', ];

                            $uri['Publish'] = ['publish', 'publish/detailed/{id}', ];
                            $controller_action['Publish'] = ['index', 'detailed', ];
                            $name['Publish'] = ['publish.index', 'publish.detailed', ];

                            $uri['Otrlink'] = ['otr-link', 'otr-link/detailed/{id}', ];
                            $controller_action['Otrlink'] = ['index', 'detailed', ];
                            $name['Otrlink'] = ['otr-link.index', 'otr-link.detailed', ];

                            $uri['Article'] = ['article', 'article/detailed/{id}', ];
                            $controller_action['Article'] = ['index', 'detailed', ];
                            $name['Article'] = ['article.index', 'article.detailed', ];

                            $uri['Letters'] = ['letters', 'letters/detailed/{id}', ];
                            $controller_action['Letters'] = ['index', 'detailed', ];
                            $name['Letters'] = ['letters.index', 'letters.detailed', ];

                            $uri['Faq'] = ['faq', 'faq/detailed/{id}', ];
                            $controller_action['Faq'] = ['index', 'detailed', ];
                            $name['Faq'] = ['faq.index', 'faq.detailed', ];

                            $uri['Partner'] = ['partner', 'partner/detailed/{id}', ];
                            $controller_action['Partner'] = ['index', 'detailed', ];
                            $name['Partner'] = ['partner.index', 'partner.detailed', ];

                            $uri['Artlist'] = ['art-list', 'art-list/detailed/{id}', ];
                            $controller_action['Artlist'] = ['index', 'detailed', ];
                            $name['Artlist'] = ['art-list.index', 'art-list.detailed', ];

                            $uri['Forum'] = [];
                            $controller_action['Forum'] = [];
                            $name['Forum'] = [];

                            $uri['Knowledge'] = ['knowledge', 'knowledge/detailed/{id}', ];
                            $controller_action['Knowledge'] = ['index', 'detailed', ];
                            $name['Knowledge'] = ['knowledge.index', 'knowledge.detailed', ];

                            $uri['Project'] = ['project', 'project/detailed/{id}', ];
                            $controller_action['Project'] = ['index', 'detailed', ];
                            $name['Project'] = ['project.index', 'project.detailed', ];

                            $uri['Catalog'] = ['catalog', ];
                            $controller_action['Catalog'] = ['index', ];
                            $name['Catalog'] = ['catalog.index', ];

                            $uri['Stronghold'] = [];
                            $controller_action['Stronghold'] = [];
                            $name['Stronghold'] = [];

                            $uri['Dealer'] = [];
                            $controller_action['Dealer'] = [];
                            $name['Dealer'] = [];

                            $uri['BannerShow'] = [];
                            $controller_action['BannerShow'] = [];
                            $name['BannerShow'] = [];

                            $uri['Banner'] = [];
                            $controller_action['Banner'] = [];
                            $name['Banner'] = [];

                            $uri['Logo'] = [];
                            $controller_action['Logo'] = [];
                            $name['Logo'] = [];

                            $uri['Tmp'] = [];
                            $controller_action['Tmp'] = [];
                            $name['Tmp'] = [];

                            $uri['Page'] = [];
                            $controller_action['Page'] = [];
                            $name['Page'] = [];

                            $uri['MenuManagement'] = [];
                            $controller_action['MenuManagement'] = [];
                            $name['MenuManagement'] = [];

                            $uri['Slider'] = [];
                            $controller_action['Slider'] = [];
                            $name['Slider'] = [];

                            $uri['ModLink'] = [];
                            $controller_action['ModLink'] = [];
                            $name['ModLink'] = [];

                            $uri['Member'] = [];
                            $controller_action['Member'] = [];
                            $name['Member'] = [];

                            $uri['Account'] = [];
                            $controller_action['Account'] = [];
                            $name['Account'] = [];

                            $uri['Permission'] = [];
                            $controller_action['Permission'] = [];
                            $name['Permission'] = [];

                            $uri['Keyword'] = [];
                            $controller_action['Keyword'] = [];
                            $name['Keyword'] = [];

                            $uri['Photo'] = [];
                            $controller_action['Photo'] = [];
                            $name['Photo'] = [];

                            $uri['ListMenu'] = [];
                            $controller_action['ListMenu'] = [];
                            $name['ListMenu'] = [];

                            $uri['ListItemMenu'] = [];
                            $controller_action['ListItemMenu'] = [];
                            $name['ListItemMenu'] = [];

                            $uri['Home'] = ['home', ];
                            $controller_action['Home'] = ['index', ];
                            $name['Home'] = ['home.index', ];

                            $uri['WebUser'] = [];
                            $controller_action['WebUser'] = [];
                            $name['WebUser'] = [];

                            $uri['MenuFrontend'] = [];
                            $controller_action['MenuFrontend'] = [];
                            $name['MenuFrontend'] = [];

                            foreach($controller_action[$row_RecordModules['uri']] as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $name[$row_RecordModules['uri']][$key];; ?></td>
                                    <td><?php echo $prefix; ?></td>
                                    <td><?php echo $uri[$row_RecordModules['uri']][$key]; ?></td>
                                    <td><?php echo $row_RecordModules['uri']; ?>Controller</td>
                                    <td><?php echo $controller_action[$row_RecordModules['uri']][$key]; ?></td>
                                    <td></td>
                                    <td><?php echo $methods; ?></td>
                                    <td></td>
                                    <td><?php echo $row_RecordModules['class']; ?></td>
                                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                    <td><?php echo $indicate; ?></td>
                                    <td></td>
                                    <td><?php echo $sortid; ?></td>
                                    <td><?php echo $row_RecordModules['uri']; ?></td>
                                    <td><?php echo $lang; ?></td>
                                    <td><?php echo $userid; ?></td>
                                </tr>
                                <?php $i++;  ?>
                            <?php }  ?>
                            <?php $i++;  ?>
                        <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th nowrap="">title</th>
                            <th nowrap="">subtitle</th>
                            <th nowrap="">url</th>
                            <th nowrap="">icon</th>
                            <th nowrap="">img</th>
                            <th nowrap="">label</th>
                            <th nowrap="">badge</th>
                            <th nowrap="">tooltip</th>
                            <th nowrap="">colorclass</th>
                            <th nowrap="">route_name</th>
                            <th nowrap="">module_uri</th>
                            <th nowrap="">permission</th>
                            <th nowrap="">caret</th>
                            <th nowrap="">highlight</th>
                            <th nowrap="">sub_menu</th>
                            <th nowrap="">parent_id</th>
                            <th nowrap="">position</th>
                            <th nowrap="">postdate</th>
                            <th nowrap="">created_at</th>
                            <th nowrap="">updated_at</th>
                            <th nowrap="">is_home</th>
                            <th nowrap="">is_submenu</th>
                            <th nowrap="">indicate</th>
                            <th nowrap="">sortid</th>
                            <th nowrap="">lang</th>
                            <th nowrap="">userid</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($RecordModules as $row_RecordModules) { ?>
                            <?php
                            //$i=1;
                            $title = $row_RecordModules['name'];
                            $subtitle = $row_RecordModules['$subtitle'];
                            $lang = 'zh_TW';
                            $userid = '1';
                            $sortid = '50';
                            $indicate = '1';
                            //$name = 'admin.'.toSpinalCase($row_RecordModules['uri']);
                            $methods = 'get,post';
                            $is_home = 0;
                            $is_submenu = 0;





                            foreach($row_RecordModules['routes'] as $row_Route) {
                                ?>
                                <?php if($row_Route['prefix'] == 'admin') { ?>
                                    <?php

                                    $is_home = 0;
                                    $is_submenu = 0;
                                    $subtitle = '';
                                    $icon = '';

                                    if($row_Route['controller_action'] == 'index'){
                                        $subtitle = '檢視資料';
                                        $icon = $row_RecordModules['icon'];
                                        $is_home = 1;
                                        $is_submenu = 1;
                                    }
                                    if($row_Route['controller_action'] == 'add'){
                                        $subtitle = '新增資料';
                                        $icon = 'fa-solid fa-plus';
                                        $is_home = 0;
                                        $is_submenu = 1;
                                    }
                                    if($row_Route['controller_action'] == 'start'){
                                        $subtitle = '起始頁設定';
                                        $icon = 'fa-solid fa-paper-plane';
                                        $is_home = 0;
                                        $is_submenu = 1;
                                    }
                                    if($row_Route['controller_action'] == 'edit'){
                                        $subtitle = '修改資料';
                                        $icon = 'fa-solid fa-pen-to-square';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'list'){
                                        $subtitle = '清單設定';
                                        $icon = 'fa-regular fa-rectangle-list';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'listitem'){
                                        $subtitle = '項目設定';
                                        $icon = 'fa-solid fa-list-ul';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'upload'){
                                        $subtitle = '上傳資料';
                                        $icon = 'fa-solid fa-cloud-arrow-up';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'copy'){
                                        $subtitle = '複增資料';
                                        $icon = 'fa-solid fa-copy';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'delete'){
                                        $subtitle = '刪除資料';
                                        $icon = 'fa-solid fa-trash-can';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'dbShow'){
                                        $subtitle = '資料匯入表';
                                        $icon = 'mdi:database-arrow-left';
                                        $is_submenu = 1;
                                        $is_home = 0;
                                    }
                                    if($row_Route['controller_action'] == 'sort'){
                                        $subtitle = '選單排序';
                                        $icon = 'fa-solid fa-sort';
                                        $is_submenu = 1;
                                        $is_home = 0;
                                    }
                                    if($row_Route['controller_action'] == 'mutiCopy'){
                                        $subtitle = '多筆複增';
                                        $icon = 'fa-solid fa-paste';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'sublistitem'){
                                        $subtitle = '多層項目';
                                        $icon = 'fa-solid fa-list-ul';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'getJsonChildren'){
                                        $subtitle = '取得選單子項目';
                                        $icon = 'bi:filetype-json';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }
                                    if($row_Route['controller_action'] == 'changeAccount'){
                                        $subtitle = '更換帳號';
                                        $icon = 'solar:ghost-line-duotone';
                                        $is_home = 1;
                                        $is_submenu = 1;
                                        $title = '用戶切換';
                                    }
                                    if($row_Route['controller_action'] == 'changeMod'){
                                        $subtitle = '模組啟用以及相關設定';
                                        $icon = 'far fa-calendar-alt';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                        $title = '平台用戶';
                                    }
                                    if($row_Route['controller_action'] == 'changeState'){
                                        $subtitle = '網站狀態以及租賃時間';
                                        $icon = 'fab fa-codepen';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                        $title = '平台用戶';
                                    }

                                    if($row_Route['controller_action'] == 'state'){
                                        $subtitle = '狀態資訊';
                                        $icon = 'fa-solid fa-book';
                                        $is_home = 0;
                                        $is_submenu = 1;
                                        $title = '網站設定';
                                    }

                                    if($row_Route['controller_action'] == 'selectTheme'){
                                        $subtitle = '選擇主板型';
                                        $icon = 'fa-solid fa-mountain-sun';
                                        $is_home = 0;
                                        $is_submenu = 1;
                                        $title = '版面調整';
                                    }

                                    if($row_Route['controller_action'] == 'configTheme'){
                                        $subtitle = '設定主板型';
                                        $icon = 'fa-solid fa-pen-ruler';
                                        $is_home = 0;
                                        $is_submenu = 0;
                                        $title = '版面調整';
                                    }



                                    $color = 'cl_green';
                                    if($row_RecordModules['uri'] == 'Routes'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'MenuBackend'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'Modules'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'ListMenu'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'Photo'){
                                        $color = 'cl_blue4';
                                    }



                                    if($row_RecordModules['uri'] == 'WebUser'){
                                        $color = 'cl_yellow2';
                                    }


                                    if($row_RecordModules['uri'] == 'News'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'ActNews'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'Product'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'FriLink'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'Contact'){
                                        $color = 'cl_orange';
                                    }

                                    if($row_RecordModules['uri'] == 'Page'){
                                        $color = 'cl_purple';
                                    }
                                    if($row_RecordModules['uri'] == 'MenuFrontend'){
                                        $color = 'cl_purple';
                                    }
                                    if($row_RecordModules['uri'] == 'Slider'){
                                        $color = 'cl_purple';
                                    }
                                    if($row_RecordModules['uri'] == 'ModLink'){
                                        $color = 'cl_purple';
                                    }


                                    if($row_RecordModules['uri'] == 'Logo'){
                                        $color = 'cl_blue2';
                                    }
                                    if($row_RecordModules['uri'] == 'Tmp'){
                                        $color = 'cl_blue2';
                                    }

                                    if($row_RecordModules['uri'] == 'SiteSetting'){
                                        $color = 'cl_brown';
                                    }






                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $subtitle; ?></td>
                                        <td></td>
                                        <td><?php echo $icon; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $color; ?></td>
                                        <td><?php echo $row_Route['name']; ?></td>
                                        <td><?php echo $row_Route['module_uri']; ?></td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                        <td><?php echo $is_home; ?></td>
                                        <td><?php echo $is_submenu; ?></td>
                                        <td>1</td>
                                        <td>50</td>
                                        <td><?php echo $lang; ?></td>
                                        <td><?php echo $userid; ?></td>
                                    </tr>
                                    <?php $i++;  ?>
                                <?php }  ?>
                            <?php }  ?>
                            <?php $i++;  ?>
                        <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-4" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th nowrap="">title</th>
                            <th nowrap="">subtitle</th>
                            <th nowrap="">url</th>
                            <th nowrap="">icon</th>
                            <th nowrap="">img</th>
                            <th nowrap="">label</th>
                            <th nowrap="">badge</th>
                            <th nowrap="">tooltip</th>
                            <th nowrap="">colorclass</th>
                            <th nowrap="">route_name</th>
                            <th nowrap="">module_uri</th>
                            <th nowrap="">permission</th>
                            <th nowrap="">caret</th>
                            <th nowrap="">highlight</th>
                            <th nowrap="">sub_menu</th>
                            <th nowrap="">parent_id</th>
                            <th nowrap="">position</th>
                            <th nowrap="">postdate</th>
                            <th nowrap="">created_at</th>
                            <th nowrap="">updated_at</th>
                            <th nowrap="">is_home</th>
                            <th nowrap="">is_submenu</th>
                            <th nowrap="">indicate</th>
                            <th nowrap="">sortid</th>
                            <th nowrap="">lang</th>
                            <th nowrap="">userid</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($RecordModules as $row_RecordModules) { ?>
                            <?php
                            //$i=1;
                            $title = $row_RecordModules['name'];
                            $subtitle = $row_RecordModules['$subtitle'];
                            $lang = 'zh_TW';
                            $userid = '1';
                            $sortid = '50';
                            $indicate = '1';
                            //$name = 'admin.'.toSpinalCase($row_RecordModules['uri']);
                            $methods = 'get,post';
                            $is_home = 0;
                            $is_submenu = 0;

                            foreach($row_RecordModules['routes'] as $row_Route) {
                                ?>
                                <?php if($row_Route['prefix'] == '') { ?>
                                    <?php

                                    $is_home = 0;
                                    $is_submenu = 0;
                                    $subtitle = '';
                                    $icon = '';

                                    if($row_Route['controller_action'] == 'index'){
                                        $subtitle = '檢視資料';
                                        $icon = $row_RecordModules['icon'];
                                        $is_home = 1;
                                        $is_submenu = 1;
                                    }
                                    if($row_Route['controller_action'] == 'detailed'){
                                        $subtitle = '詳細資料';
                                        $icon = $row_RecordModules['icon'];
                                        $is_home = 0;
                                        $is_submenu = 0;
                                    }



                                    $color = 'cl_green';
                                    if($row_RecordModules['uri'] == 'Routes'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'MenuBackend'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'Modules'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'ListMenu'){
                                        $color = 'cl_blue4';
                                    }
                                    if($row_RecordModules['uri'] == 'Photo'){
                                        $color = 'cl_blue4';
                                    }



                                    if($row_RecordModules['uri'] == 'WebUser'){
                                        $color = 'cl_yellow2';
                                    }


                                    if($row_RecordModules['uri'] == 'News'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'ActNews'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'Product'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'FriLink'){
                                        $color = 'cl_orange';
                                    }
                                    if($row_RecordModules['uri'] == 'Contact'){
                                        $color = 'cl_orange';
                                    }

                                    if($row_RecordModules['uri'] == 'Page'){
                                        $color = 'cl_purple';
                                    }
                                    if($row_RecordModules['uri'] == 'MenuFrontend'){
                                        $color = 'cl_purple';
                                    }
                                    if($row_RecordModules['uri'] == 'Slider'){
                                        $color = 'cl_purple';
                                    }
                                    if($row_RecordModules['uri'] == 'ModLink'){
                                        $color = 'cl_purple';
                                    }


                                    if($row_RecordModules['uri'] == 'Logo'){
                                        $color = 'cl_blue2';
                                    }
                                    if($row_RecordModules['uri'] == 'Tmp'){
                                        $color = 'cl_blue2';
                                    }






                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $subtitle; ?></td>
                                        <td></td>
                                        <td><?php echo $icon; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $color; ?></td>
                                        <td><?php echo $row_Route['name']; ?></td>
                                        <td><?php echo $row_Route['module_uri']; ?></td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                        <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                        <td><?php echo $is_home; ?></td>
                                        <td><?php echo $is_submenu; ?></td>
                                        <td>1</td>
                                        <td>50</td>
                                        <td><?php echo $lang; ?></td>
                                        <td><?php echo $userid; ?></td>
                                    </tr>
                                    <?php $i++;  ?>
                                <?php }  ?>
                            <?php }  ?>
                            <?php $i++;  ?>
                        <?php }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>

