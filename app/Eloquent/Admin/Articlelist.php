<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Articlelist extends BaseEloquent
{
    protected $table = 'demo_articlelist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}