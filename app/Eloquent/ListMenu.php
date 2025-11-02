<?php
namespace App\Eloquent;

use App\Eloquent\ListItemMenu;
use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ListMenu extends BaseEloquent
{

    use LikeScope;

    protected $table = 'demo_list';

    public $timestamps = false;

    protected $guarded = ['id'];

    /**
     * 取得所有資料
     *
     * @param Request $request
     * @return mixed
     */
    function getAll(Request $request){
        $result = ListMenu::select('*')
            //->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            //->where('userid', '=', $_SESSION['w_userid'])
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 關聯 Modules
     *
     */
    public function modules(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Modules::class, 'uri', 'module_uri');
    }

    /**
     * 關聯 ListItemMenu
     *
     */
    public function listItemMenu(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListItemMenu::class, 'list_id', 'id');
    }

    /**
     * 關聯 ListItemMenu
     *
     */
    public function listItemMenuAlias(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListItemMenu::class, 'list_alias', 'alias');
    }

}
