<?php
namespace App\Controller;

use Naucon\Breadcrumbs\Breadcrumbs;

$breadcrumbs = new Breadcrumbs();

$breadcrumbs_home = $SiteBaseUrl . url_rewrite('index', array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']), '', $UrlWriteEnable);
$breadcrumbs_mod = $SiteBaseUrl . url_rewrite($Tp_MdName,array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);

$breadcrumbs->add("<i class='fa fa-home'></i> ".$Lang_Home, $breadcrumbs_home);
$breadcrumbs->add($ModuleName[$Tp_Page], $breadcrumbs_mod);

switch($_GET['Opt'])
{
    case "viewpage":
		
        include('app/Repositories/require_' . $Tp_MdName . '_page_index.php');
        $view_page = $TplPath . '/view/'. $Tp_MdName .'_page_index.php';
		
		include('app/Repositories/require_' . $Tp_MdName . '_component_selectbox.php');
		
		include('app/Repositories/require_' . $Tp_MdName . '_component_hashtag.php');
		
		/* 導覽列 */
        //$breadcrumbs->add($about['title']);
		
        break;
    case "search":
        include('app/Repositories/require_' . $Tp_MdName . '_page_search.php');
        $view_page = $TplPath . '/view/'. $Tp_MdName .'_page_search.php';
		
        break;
    case "detailed":

        include('app/Repositories/require_' . $Tp_MdName . '_page_detailed.php');
        $view_page = $TplPath . '/view/'. $Tp_MdName .'_page_detailed.php';
		
		include('app/Repositories/require_' . $Tp_MdName . '_component_selectbox.php');
		
		include('app/Repositories/require_' . $Tp_MdName . '_component_hashtag.php');
		
		/* 導覽列 */
        //$breadcrumbs->add($about['title']);
		
        break;				
    default:
		
		include('app/Repositories/require_' . $Tp_MdName . '_page_index.php');
        $view_page = $TplPath . '/view/'. $Tp_MdName .'_page_index.php';
		
		include('app/Repositories/require_' . $Tp_MdName . '_component_selectbox.php');
		
		include('app/Repositories/require_' . $Tp_MdName . '_component_hashtag.php');
		
        break;
}
?>