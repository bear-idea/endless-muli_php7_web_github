<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Newslist extends BaseEloquent
{
    protected $table = 'demo_newslist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}