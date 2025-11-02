<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Actnewslist extends BaseEloquent
{
    protected $table = 'demo_actnewslist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}