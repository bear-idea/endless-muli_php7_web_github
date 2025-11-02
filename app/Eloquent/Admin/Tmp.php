<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use App\Eloquent\Traits\DatatablesTraits;
use App\Eloquent\Traits\LikeScope;
use Illuminate\Http\Request;

class Tmp extends BaseEloquent
{
    use LikeScope;
    use DatatablesTraits;

    protected $table = 'demo_tmp';

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

        $result = Tmp::select('*')
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->get();
        //->toArray();

        return $result;
    }

    /**
     * 取得編輯資料
     *
     * @param Request $request
     * @return mixed
     */
    function getByID(Request $request){

        $useModuleUri = $request->input('useModuleUri');

        $result = Tmp::select('*')
            //->where('module_uri', $useModuleUri)
            ->where('id', '=', $request->input('id'))
            ->where('lang', '=', $request->input('lang') ?? 'zh_TW')
            ->where('userid', '=', $_SESSION['w_userid'])
            ->first();
        //->toArray();

        return $result;
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
     * 删除给定的 ID 或 ID 数组对应的记录
     *
     * @param mixed $ids 单个 ID 或包含多个 ID 的数组
     * @return void
     */
    public function removeByIds($ids): void
    {
        $this->destroy($ids);
    }

    public function tmpheaderbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpheaderbackground');
    }

    public function tmpwrpbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpwrpbackground');
    }

    public function tmpleftbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpleftbackground');
    }

    public function tmprightbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmprightbackground');
    }

    public function tmpmiddlebackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpmiddlebackground');
    }

    public function tmpfooterbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpfooterbackground');
    }

    public function tmptitlebackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmptitlebackground');
    }

    public function tmpbodybackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpbodybackground');
    }

    public function tmptitlelinebackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmptitlelinebackground');
    }

    public function tmpanimebackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpanimebackground');
    }

    public function tmpbottombackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpbottombackground');
    }

    public function tmphomebodybackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmphomebodybackground');
    }

    public function tmphomeanimebackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmphomeanimebackground');
    }

    public function tmphomebottombackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmphomebottombackground');
    }

    // 暫時
    public function tmpnewsevenbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpnewsevenbackground');
    }

    // 暫時
    public function tmpnewsoddbackground()
    {
        return $this->hasOne(Tmpbackground::class, 'id', 'tmpnewsoddbackground');
    }

    public function tmphomeboard()
    {
        return $this->hasOne(Tmpboard::class, 'id', 'tmphomeboard');
    }

    public function tmpwrpboard()
    {
        return $this->hasOne(Tmpboard::class, 'id', 'tmpwrpboard');
    }

    public function tmpbannerboard()
    {
        return $this->hasOne(Tmpboard::class, 'id', 'tmpbannerboard');
    }

    public function tmpviewlineboard()
    {
        return $this->hasOne(Tmpboard::class, 'id', 'tmpviewlineboard');
    }

    public function tmpmiddleboard()
    {
        return $this->hasOne(Tmpboard::class, 'id', 'tmpmiddleboard');
    }

    public function tmptitleboard()
    {
        return $this->hasOne(Tmpboard::class, 'id', 'tmptitleboard');
    }

    public function tmpleftmenu()
    {
        return $this->hasOne(Tmpleftmenu::class, 'id', 'tmpleftmenu');
    }

    public function tmpmainmenu()
    {
        return $this->hasOne(Tmpmainmenu::class, 'id', 'tmpmainmenu');
    }

    public function tmplogo()
    {
        return $this->hasOne(Tmplogo::class, 'id', 'tmplogoid');
    }

    public function tmphomelogo()
    {
        return $this->hasOne(Tmplogo::class, 'id', 'tmphomelogoid');
    }

    public function tmpdefaultlogo()
    {
        return $this->hasOne(Tmplogo::class, 'id', 'TmpLogoID');
    }

    public function tmpblock()
    {
        return $this->hasOne(Tmpblock::class, 'id', 'tmpblock');
    }

}
?>
