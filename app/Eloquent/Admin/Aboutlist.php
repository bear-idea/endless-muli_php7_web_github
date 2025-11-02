<?php
namespace App\Eloquent\Admin;

use App\Eloquent\Contracts\BaseEloquent;
use Illuminate\Http\Request;

class Aboutlist extends BaseEloquent
{
    protected $table = 'demo_aboutlist';

    public function getList(Request $request){
        return $this->select('*')
            ->get();
    }

}