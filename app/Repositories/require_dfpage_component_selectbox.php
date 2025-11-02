<?php
namespace App\Repositories;

use App\Eloquent\Dfpage;
use Naucon\Breadcrumbs\Breadcrumbs;

$columns = ['id', 'title']; // 返回的欄位陣列

$resultSelectbox[$Tp_Page] = Dfpage::select($columns)
    ->where('lang', '=', $collang[$Tp_Page])
    ->where('indicate', '=', '1')
    ->where('userid', '=', $coluserid[$Tp_Page])
    ->where('aid', '=', $colaid[$Tp_Page])
    ->get()
    ->toArray();


$resultSelectbox[$Tp_Page]['total'] = count($resultSelectbox[$Tp_Page]);


$data_Selectbox = new Breadcrumbs();

foreach ($resultSelectbox[$Tp_Page] as $dfpage_Selectbox) {
    $row_data_Selectbox['id'] = $dfpage_Selectbox['id'];
    $row_data_Selectbox['title'] = $dfpage_Selectbox['title'];

    $data_Selectbox_Url = $SiteBaseUrl . url_rewrite($Tp_MdName, array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','aid'=>$colaid[$Tp_Page],'type1'=>$dfpage_Selectbox['type1'],'type2'=>$dfpage_Selectbox['type2'],'type3'=>$dfpage_Selectbox['type3']),'',$UrlWriteEnable) . $id_params . $row_data_Selectbox['id'];;
    $data_Selectbox->add($row_data_Selectbox['title'], $data_Selectbox_Url);
}
?>
