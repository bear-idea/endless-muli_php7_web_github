<?php
namespace App\Eloquent;

use App\Eloquent\ListMenu;
use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListItemMenu extends BaseEloquent
{

    use LikeScope;

    protected $table = 'demo_listitem';

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = ListItemMenu::select('*')
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 根據 $list_alias 取得資料清單
     *
     * @param Request $request
     * @param $list_alias
     * @return mixed
     */
    public function getListItemMenuTypeByAlias(Request $request, $list_alias, $useModuleUri){

        //$useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('list_alias', '=', $list_alias)
            ->where('module_uri', '=', $useModuleUri)
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->orderBy('sortid', 'ASC')
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 關聯 ListMenu
     *
     */
    public function listMenu(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ListMenu::class, 'list_id', 'id');
    }

    /**
     * 關聯 listMenuAlias
     *
     */
    public function listMenuAlias(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ListMenu::class, 'list_alias', 'alias');
    }

    /**
     * 關聯 ListItemMenu
     *
     * @return void
     */
    public function sub(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListItemMenu::class, 'parent_id', 'id');
    }


}
