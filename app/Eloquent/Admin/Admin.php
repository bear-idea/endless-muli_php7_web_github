<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Admin extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_admin';
    public $timestamps = false;
    protected $guarded = ['id'];

    /**
     * 告訴 Eloquent 包含 full_route_name
     *
     * @var array
     */
    protected $appends = ['account_switch'];

    /**
     * 定義一個 accessor 來生成完整的 route_name
     *
     * @return string
     */
    public function getAccountSwitchAttribute()
    {
        return $this->name . ' - ' . $this->webname;
    }

    /**
     * 取得母帳號所有資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getMainAccountWithAll(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('grouptype', '=', 'main')
            ->orderBy('webname' , 'ASC')
            ->get();

        return $result;
    }

    /**
     * 取得子帳號所有資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getSubAccountWithAll(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('grouptype', '=', 'sub')
            ->get();

        return $result;
    }

    public function changeAccount(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $_SESSION['MM_Username'] = $request->input('selectAccount');
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    public function getByID(Request $request): mixed
    {
        $useModuleUri = $request->input('useModuleUri');

        $result = $this->select('*')
            ->where('id', '=', $request->input('id'))
            ->first();

        return $result;
    }

    /**
     * 更新用户的登录信息，包括登录日期和登录次数。
     *
     * @param string $username 用户名（账号）
     * @return void
     */
    public function updateLoginInfo($username): void
    {
        $this->where('account', $username)
            ->update([
                'logindate' => Carbon::now(),
                'logincount' => $this::raw('logincount + 1'),
            ]);
    }

    /**
     * 新增資料
     *
     * @param Request $request
     * @return void
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $this->create($data);
    }

    /**
     * 編輯資料
     *
     * @param Request $request
     * @return void
     */
    function edit(Request $request)
    {
        $data = $request->all();
        Admin::where('id', '=', $request->input('id'))
            ->update([
                'account' => $request->input('account'),
                'psw' => $request->input('psw'),
                'name' => $request->input('name'),
                'webname' => $request->input('webname'),
                'level' => $request->input('level'),
                'notes1' => $request->input('notes1'),
            ]);
    }

    /**
     * 删除给定的 ID 或 ID 数组对应的记录
     *
     * @param mixed $ids 单个 ID 或包含多个 ID 的数组
     * @return void
     */
    public function removeByIds($ids): void
    {
        $this->destroy($ids);
    }

}
